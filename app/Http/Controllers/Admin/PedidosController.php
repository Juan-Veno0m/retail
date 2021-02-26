<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Image;
use PDF;
use DB;

class PedidosController extends Controller
{

    public function index(Request $request)
    {
        // Filter
        $q = $request->input('q');
        if (!$q == "") {$No = $q - 9249582;}else{$No="";}

        $e = $request->input('estatus');
        $f = str_replace("/", "-", $request->input('daterange'));
        if (!$f) {
          // code...
          $from = date("Y-m-d");
          $to = date('Y-m-d', strtotime('-30 days'));
        }else{$from = substr($f, 0, 10);
          $to = substr($f,13,22);}
        // pedidos
        $pedidos = DB::table('orden as o')
                  ->join('orden_status as s','s.id','=','o.Orden_estatus')
                  ->join('orden_pago as p','p.OrdenID','=','o.OrdenID')
                  ->join('metodo_pago as mp','mp.MetodoID','=','p.Metodo')
                  ->join('asociados_usuario','asociados_usuario.UsuarioID','=','o.ClienteID')
                  ->join('asociados','asociados.AsociadosID','=','asociados_usuario.AsociadosID')
                  ->leftjoin('asociados_cupon as cp','cp.OrdenID','=','o.OrdenID')
                  ->leftjoin('cupones as c','c.id','=','cp.CuponID')
                  ->leftjoin('orden_pickup as op','op.OrdenID','o.OrdenID')
                  ->where('o.Orden_estatus','LIKE','%'.$e.'%')
                  ->where('o.OrdenID','LIKE','%'.$No.'%')
                  ->whereBetween('o.Fecha_requerida',[$from,$to])
                  ->select('o.OrdenID','o.OrdenId as key','o.Fecha_entrega','o.Fecha_requerida','mp.Tipo as MetodoPago',
                  'p.TotalProductos','s.status','asociados.ApellidoPaterno','asociados.ApellidoMaterno','asociados.Nombre','s.attribute',
                  'p.Total','p.Descuento','asociados.AsociadosID','c.descuento','c.code','o.Orden_estatus','o.TipoEnvio','op.Fecha','op.Hora')
                  ->orderBy('o.OrdenID','desc')
                  ->paginate(15);
        foreach ($pedidos as $key => $value) {$value->key = encrypt($value->key);}
        $from = str_replace("-", "/", $from);
        $to = str_replace("-", "/", $to);
        $data = ['pedidos'=>$pedidos,'q'=>$q,'e'=>$e,'from'=>$from,'to'=>$to];
        return view('admin.modules.Ordenes.Pedidos.index',$data);
    }
    // Get details from order
    public function read($NOrden)
    {
      $OrdenID = $NOrden - 9249582;
      $items = DB::table('orden_items as oi')
                ->join('productos as p','p.ProductosID','=','oi.ProductosID')
                ->where('oi.OrdenID','=',$OrdenID)
                ->select('p.ProductosID','p.ProductosNombre','oi.Cantidad as quantity','oi.Precio_lista','p.Cantidad','p.Unidad')
                ->get();
      $orden = DB::table('orden as o')
                ->join('orden_status as os','os.id','=','o.Orden_estatus')
                ->leftjoin('asociados_cupon as ac','ac.OrdenID','=','o.OrdenID')
                ->where('o.OrdenID','=',$OrdenID)
                ->select('o.Fecha_requerida','os.status','ac.CuponID','o.TipoEnvio')
                ->first();
      $pago = DB::table('orden_pago as op')
                ->join('metodo_pago as mp','mp.MetodoID','=','op.Metodo')
                ->leftjoin('orden_envio as oe','oe.OrdenID','op.OrdenID')
                ->where('op.OrdenID','=',$OrdenID)
                ->select('op.TotalProductos','op.Total','op.Descuento','op.Descuento','mp.Tipo','oe.Costo as CostoEnvio')
                ->first();
      if ($orden->TipoEnvio == 1) {
        // code...
        $TipoEnvio = DB::table('orden_envio as oe')
                  ->join('envio_usuarios as eu','eu.EnvioID','=','oe.EnvioUID')
                  ->join('estados as es','es.id','=','eu.EstadoID')
                  ->where('OrdenID','=',$OrdenID)
                  ->select('eu.*','es.estado')
                  ->first();
      }else{$TipoEnvio = DB::table('orden_pickup')->where('OrdenID',$OrdenID)->first();}
      $data = ['items'=>$items,'NOrden'=>$NOrden,'orden'=>$orden,'pago'=>$pago, 'TipoEnvio'=>$TipoEnvio];
      return view('admin.modules.Ordenes.Pedidos.detalles',$data);
    }
    // get historial de pagos
    public function historialpagos(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->Orden);
      } catch (DecryptException $e) {
          //
          return response()->json(['tipo' => 'error', 'mensaje' => $e]);
      }
      //
      $generales = DB::table('orden_pago')->where('OrdenID',$decrypted)->first();
      $pagosclientes = DB::table('pagosclientes')->where('OrdenID',$decrypted)->get();
      // return data
      return response()->json(['generales'=>$generales,'pagosclientes'=>$pagosclientes, 'Orden'=>$req->Orden]);
    }
    // pagos action
    public function actionpagos(Request $req)
    {
      if ($req->ajax()) {
        // code...
        $datos = json_decode($req->datos);
        // decrypt
        try {
            $OrdenID = decrypt($datos->OrdenID);
        } catch (DecryptException $e) {
            //
            return response()->json(['tipo' => 'error', 'mensaje' => $e]);
        }
        $file = $req->file('file'); $img = Image::make($file);
        $path = '/Pedido-'.($OrdenID+9249582).'/';
        $tag = $path.'PagosCliente/';
        $input['imagename'] = time().'.'.$file->getClientOriginalExtension();
        $img->resize(750, null, function ($constraint) {$constraint->aspectRatio();})->encode();
        $image = Storage::disk('upfiles')->put($tag.$input['imagename'], $img); // Save
        // action create
        if ($datos->action=='create') {
          // code...
          $id = DB::table('pagosclientes')->insertGetId(['fechaPago'=>$datos->fecha,'montoPC'=>$datos->monto,'comentarioPago'=>$datos->comentarios,
          'OrdenID'=>$OrdenID,'formaPagoP'=>$datos->formaPagoP,'folioPagoP'=>$datos->folio,'imagenPay'=>$tag.$input['imagename'],'created_at'=>now()]);
          if ($datos->saldo=="0.00") {
            // code...
            DB::table('orden')->where('OrdenID',$OrdenID)->update(['Orden_estatus'=>2,'updated_at'=>now()]);
            // fecha de liquidación
            DB::table('orden_pago')->where('OrdenID',$OrdenID)->update(['FechaLiquidado'=>$datos->fecha,'updated_at'=>now()]);
            // confirmar aquí, agregar puntos de la compra al acumulado del empresario con fecha de ultimo pago
            $Mes = substr($datos->fecha, 5,-3);
            $Año = substr($datos->fecha, 0, 4);
            $OrdenPuntos = (floatval($datos->total)+floatval($datos->cupon))/10;
            $p = DB::table('balance_puntos')
                      ->where('AsociadosID',$datos->key)
                      ->where('Mes',$Mes)
                      ->where('Año',$Año)
                      ->first();
            /* relación de la red */
            $r = DB::table('asociados_relacion')->where('AsociadosID',$datos->key)->first();
            // reportar puntos a los 3 niveles de la red
            if (isset($r)) {
              // code...
              if ($r->t1 !== null) {
                // Padre...
                $check = DB::table('balance_red as b')
                        ->where('b.Mes',$Mes)
                        ->where('b.Año',$Año)
                        ->where('b.AsociadosID',$r->t1)
                        ->select('b.Puntos')
                        ->first();
                if (isset($check)) {
                  // si existe registro...
                  $sum = floatval($check->Puntos) + floatval($OrdenPuntos);
                  DB::table('balance_red')->where('AsociadosID',$r->t1)
                              ->where('Mes',$Mes)
                              ->where('Año',$Año)
                              ->update(['Puntos'=>$sum,'updated_at'=>now()]);
                }else{$t1 = DB::table('balance_red')->insertGetId(['AsociadosID'=>$r->t1,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}
              }
              if ($r->t2 !== null) {
                // Abuelo...
                $check = DB::table('balance_red as b')
                        ->where('b.Mes',$Mes)
                        ->where('b.Año',$Año)
                        ->where('b.AsociadosID',$r->t2)
                        ->select('b.Puntos')
                        ->first();
                if (isset($check)) {
                  $sum = floatval($check->Puntos) + floatval($OrdenPuntos);
                  DB::table('balance_red')->where('AsociadosID',$r->t2)
                              ->where('Mes',$Mes)
                              ->where('Año',$Año)
                              ->update(['Puntos'=>$sum,'updated_at'=>now()]);
                }else{$t2 = DB::table('balance_red')->insertGetId(['AsociadosID'=>$r->t2,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}

              }
              if ($r->t3 !== null) {
                // Bisabuelo...
                $check = DB::table('balance_red as b')
                        ->where('b.Mes',$Mes)
                        ->where('b.Año',$Año)
                        ->where('b.AsociadosID',$r->t3)
                        ->select('b.Puntos')
                        ->first();
                if (isset($check)) {
                  $sum = floatval($check->Puntos) + floatval($OrdenPuntos);
                  DB::table('balance_red')->where('AsociadosID',$r->t3)
                              ->where('Mes',$Mes)
                              ->where('Año',$Año)
                              ->update(['Puntos'=>$sum,'updated_at'=>now()]);
                }else{$t3 = DB::table('balance_red')->insertGetId(['AsociadosID'=>$r->t3,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}

              }
            }
            // si existe sumar// else crear
            if (isset($p)) {
              /* */
              $sum = floatval($p->Puntos) + floatval($OrdenPuntos);
              DB::table('balance_puntos')->where('AsociadosID',$datos->key)
                          ->where('Mes',$Mes)
                          ->where('Año',$Año)
                          ->update(['Puntos'=>$sum,'updated_at'=>now()]);
            }
            else{
              $balance = DB::table('balance_puntos')
                        ->insertGetId(['AsociadosID'=>$datos->key,
                        'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,
                        'created_at'=>now()]);
            }
            return response()->json(['tipo'=>200,'mensaje'=>'saldo','estatus'=>'btn-primary']);
          }else{return response()->json(['tipo'=>200,'mensaje'=>'ok']);}
        }elseif ($datos->action=='update') {
          // code...
        }
      }else{abort(404);}
    }
    // Generate PDF
    public function ticketPDF($NOrden) {
      // retreive all records from db
      $OrdenID = $NOrden - 9249582;
      $orden = DB::table('orden')->join('orden_status','orden_status.id','orden.Orden_estatus')->where('OrdenID',$OrdenID)->first();
      $e = DB::table('asociados')
            ->join('asociados_usuario as a','a.AsociadosID','asociados.AsociadosID')
            ->join('asociados_telefono as tel','tel.AsociadosID','asociados.AsociadosID')
            ->where('a.UsuarioID',$orden->ClienteID)->first();
      $pago = DB::table('orden_pago')
            ->join('metodo_pago','metodo_pago.MetodoID','orden_pago.Metodo')
            ->leftjoin('asociados_cupon as c','c.OrdenID','orden_pago.OrdenID')
            ->leftjoin('cupones','cupones.id','c.CuponID')
            ->select('cupones.descuento as CuponDesc','metodo_pago.Tipo','orden_pago.*')
            ->where('orden_pago.OrdenID',$OrdenID)->first();
      $items = DB::table('orden_items')
            ->join('productos','productos.ProductosID','orden_items.ProductosID')
            ->where('OrdenID',$OrdenID)
            ->select('orden_items.ProductosID','orden_items.Cantidad as quantity','orden_items.Precio_lista','productos.*')
            ->get();
      // share data to view
      $view = \View::make('admin.modules.Ordenes.Pedidos.TicketPDF',compact('orden','e','pago','items'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('Empresario-No.'.$e->NoEmpresario.'_Pedido#'.($OrdenID+9249582).'.pdf');
    }
    // cambiar estatus de orden
    public function status(Request $req)
    {
      $OrdenID = $req->id - 9249582;
      $pagado = DB::table('pagosclientes')->where('OrdenID',$OrdenID)->sum('montoPC');
      $debe = DB::table('orden_pago')->where('OrdenID',$OrdenID)->sum('Total');
      /* permitir cambio /confirmar/ si no hay saldo pendiente - cancelar*/
      if (floatval($pagado) == floatval($debe) || $req->newstat == 6) {
        // code...
        $comment = DB::table('comentarios_status')->insertGetId(['OrdenID'=>$OrdenID,'UserID'=>Auth::id(),
        'oldstat'=>$req->oldstat,'newstat'=>$req->newstat,'aplicado'=>$req->fecha_hora,'comentario'=>$req->comment,'created_at'=>now()]);
        if (isset($comment)) {
          // cuando el saldo es 0 y no requirio un pago anexo
          if ($req->newstat == 2) { // confirmado
            // code...
            $cupon = DB::table('asociados_cupon as a')
                        ->join('cupones as c','c.id','=','a.CuponID')
                        ->where('a.OrdenID',$OrdenID)->sum('c.descuento');
            $Mes = substr($req->fecha_hora, 5,-9);
            $Año = substr($req->fecha_hora, 0, 4);
            $OrdenPuntos = (floatval($debe)+floatval($cupon))/10;
            $p = DB::table('balance_puntos')
                      ->where('AsociadosID',$req->key)
                      ->where('Mes',$Mes)
                      ->where('Año',$Año)
                      ->first();
            $r = DB::table('asociados_relacion')->where('AsociadosID',$req->key)->first();
            // reportar puntos a los 3 niveles de la red
            if (isset($r)) {
              // code...
              if ($r->t1 !== null) {
                // Padre...
                $check = DB::table('balance_red as b')
                        ->where('b.Mes',$Mes)
                        ->where('b.Año',$Año)
                        ->where('b.AsociadosID',$r->t1)
                        ->select('b.Puntos')
                        ->first();
                if (isset($check)) {
                  // si existe registro...
                  $sum = floatval($check->Puntos) + floatval($OrdenPuntos);
                  DB::table('balance_red')->where('AsociadosID',$r->t1)
                              ->where('Mes',$Mes)
                              ->where('Año',$Año)
                              ->update(['Puntos'=>$sum,'updated_at'=>now()]);
                }else{$t1 = DB::table('balance_red')->insertGetId(['AsociadosID'=>$r->t1,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}
              }
              if ($r->t2 !== null) {
                // Abuelo...
                $check = DB::table('balance_red as b')
                        ->where('b.Mes',$Mes)
                        ->where('b.Año',$Año)
                        ->where('b.AsociadosID',$r->t2)
                        ->select('b.Puntos')
                        ->first();
                if (isset($check)) {
                  $sum = floatval($check->Puntos) + floatval($OrdenPuntos);
                  DB::table('balance_red')->where('AsociadosID',$r->t2)
                              ->where('Mes',$Mes)
                              ->where('Año',$Año)
                              ->update(['Puntos'=>$sum,'updated_at'=>now()]);
                }else{$t2 = DB::table('balance_red')->insertGetId(['AsociadosID'=>$r->t2,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}

              }
              if ($r->t3 !== null) {
                // Bisabuelo...
                $check = DB::table('balance_red as b')
                        ->where('b.Mes',$Mes)
                        ->where('b.Año',$Año)
                        ->where('b.AsociadosID',$r->t3)
                        ->select('b.Puntos')
                        ->first();
                if (isset($check)) {
                  $sum = floatval($check->Puntos) + floatval($OrdenPuntos);
                  DB::table('balance_red')->where('AsociadosID',$r->t3)
                              ->where('Mes',$Mes)
                              ->where('Año',$Año)
                              ->update(['Puntos'=>$sum,'updated_at'=>now()]);
                }else{$t3 = DB::table('balance_red')->insertGetId(['AsociadosID'=>$r->t3,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}

              }
            }
            // si existe sumar// else crear
            if (isset($p)) {
              /* */
              $sum = floatval($p->Puntos) + floatval($OrdenPuntos);
              DB::table('balance_puntos')->where('AsociadosID',$req->key)
                          ->where('Mes',$Mes)
                          ->where('Año',$Año)
                          ->update(['Puntos'=>$sum,'updated_at'=>now()]);
            }else{$balance = DB::table('balance_puntos')->insertGetId(['AsociadosID'=>$req->key,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}
          }
          // code...
          DB::table('orden')->where('OrdenID',$OrdenID)->update(['Orden_estatus'=>$req->newstat,'updated_at'=>now()]);
          $status = DB::table('orden_status')->where('id',$req->newstat)->first();
          return response()->json(['tipo'=>200,'mensaje'=>'ok','status'=>$status]);
        }else{
          return response()->json(['tipo'=>500,'mensaje'=>'Error al guardar cambios']);
        }
      }else{return response()->json(['tipo'=>501,'mensaje'=>'Pago pendiente del pedido.']);}

    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmacionPedido;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use Image;
use PDF;
use DB;

class PedidosController extends Controller
{

    public function index(Request $request)
    {
        // Filter
        $q = $request->input('q');
        $cliente = $request->input('cliente');
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
                  ->where('asociados.NoEmpresario','LIKE','%'.$cliente.'%')
                  ->whereBetween('o.Fecha_requerida',[$from,$to])
                  ->select('o.OrdenID','o.OrdenId as key','o.Fecha_entrega','o.Fecha_requerida','mp.Tipo as MetodoPago',
                  'p.TotalProductos','s.status','asociados.ApellidoPaterno','asociados.ApellidoMaterno','asociados.Nombre','s.attribute',
                  'p.Total','p.Descuento','asociados.AsociadosID','c.descuento','c.code','o.Orden_estatus','o.TipoEnvio','op.Fecha','op.Hora')
                  ->orderBy('o.OrdenID','desc')
                  ->paginate(15)->appends(request()->except('page'));

        foreach ($pedidos as $key => $value) {$value->key = encrypt($value->key);}
        $from = str_replace("-", "/", $from);
        $to = str_replace("-", "/", $to);
        $data = ['pedidos'=>$pedidos,'q'=>$q,'e'=>$e,'from'=>$from,'to'=>$to,'cliente'=>$cliente];
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
                ->select('op.TotalProductos','op.Total','op.Descuento','op.Porcentaje','mp.Tipo','oe.Costo as CostoEnvio')
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
            $OrdenPuntos = ((floatval($datos->subtotal) - floatval($datos->descuento))+floatval($datos->cupon))/10;
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
          // restar acumulado cuando es cancelado...
          if ($req->newstat == 6) { // cancelado
            $u = DB::table('asociados_usuario')->where('AsociadosID',$req->key)->first();
            $user = User::find($u->UsuarioID);
            $user->cont = $user->cont - 1 ;
            $user->save();
          }
          DB::table('orden')->where('OrdenID',$OrdenID)->update(['Orden_estatus'=>$req->newstat,'updated_at'=>now()]);
          $status = DB::table('orden_status')->where('id',$req->newstat)->first();
          return response()->json(['tipo'=>200,'mensaje'=>'ok','status'=>$status]);
        }else{
          return response()->json(['tipo'=>500,'mensaje'=>'Error al guardar cambios']);
        }
      }else{return response()->json(['tipo'=>501,'mensaje'=>'Pago pendiente del pedido.']);}

    }
    // Generar orden de compra para cliente
    public function generar(Request $req)
    {
      $user = DB::table('asociados as a')->join('asociados_usuario as au','au.AsociadosID','a.AsociadosID')->get();
      $producto = DB::table('productos')->where('Descontinuado',0)->where('UnidadesEnStock','>=',1)->get();
      $data = ['user'=>$user,'producto'=>$producto];
      return view('admin.modules.Ordenes.Generar.index',$data);
    }
    // get puntos of month
    public function puntos(Request $req)
    {
      $Empresario = DB::table('asociados_usuario')->where('UsuarioID', $req->empresario)->first();
      $user = DB::table('users')->where('id',$req->empresario)->first();
      $fecha = $req->fecha;
      $Mes = substr($fecha, 5,-3); // current month
      $Mes = intval($Mes)- 1; // previus month
      $Año = substr($fecha, 0, 4);
      $p = DB::table('balance_puntos')
                ->where('AsociadosID',$Empresario->AsociadosID)
                ->where('Mes',$Mes)
                ->where('Año',$Año)
                ->first();
      return response()->json(['p'=>$p,'user'=>$user]);
    }
    // get address
    public function address(Request $req)
    {
      $envio = DB::table('envio_usuarios as u')
                  ->join('estados as e','e.id','u.EstadoID')
                  ->where('u.UsuarioID','=',$req->empresario)->get();
      return (['envio'=>$envio]);
    }
    // shipping action {create:update}
    public function shipping_action(Request $req)
    {
      if ($req->action=='create') {
        // code...
        $EnvioID = DB::table('envio_usuarios')
          ->insertGetId([
            'UsuarioID'=>$req->empresario,
            'NombreCompleto'=>$req->arraydata['fullname'],'Codigopostal'=>$req->arraydata['postalcode'],
            'Telefono'=>$req->arraydata['telefono'],'EstadoID'=>$req->arraydata['estado'],
            'Municipio'=>$req->arraydata['delegacion'],'Colonia'=>$req->arraydata['colonia'],
            'Calle'=>$req->arraydata['Calle'],'Exterior'=>$req->arraydata['exterior'],
            'Interior'=>$req->arraydata['interior'],'Calle1'=>$req->arraydata['Calle1'],
            'Calle2'=>$req->arraydata['Calle2'],'Adicional'=>$req->arraydata['adicional'],'created_at'=>now()
          ]);
        $envio = DB::table('envio_usuarios as u')->join('estados as e','e.id','u.EstadoID')->where('u.EnvioID','=',$EnvioID)->first();
        return (['respuesta'=>'ok','envio'=>$envio]);
      }else{
        return (['respuesta'=>'ok']);
      }
    }
    // store order
    public function store(Request $req)
    {
      $id = $req->arraydata['empresario'];
      $user = User::find($id);
      // insert orden
      $OrdenID = DB::table('orden')->insertGetId([
        'ClienteID'=>$id,
        'StaffID'=> 1, // get user
        'Orden_estatus'=>1, // initial
        'Fecha_requerida'=>now(), // fecha indicada en sistema
        'TiendaID'=>1, // Si es Pickup o envio local tienda cercana, pedido online tienda matriz
        'TipoEnvio'=>$req->arraydata['TipoEnvio'], // Tipo de Envio .-1 Envio Local .-2 Pickup .- Paqueteria
        'created_at'=>now()
      ]);
      // insert orden items
      for ($i=1; $i <= sizeof($req->items) ; $i++) {
        $ItemsID[] = DB::table('orden_items')->insertGetId([
          'OrdenID'=> $OrdenID,
          'ProductosID'=> $req->items[$i]['id'],
          'Cantidad'=>$req->items[$i]['cantidad'],
          'Precio_lista'=>$req->items[$i]['costo'],
          'Descuento'=>0.00
        ]);
        // reducir productos del inventario
      }
      // insert orden pago
      $PagoID = DB::table('orden_pago')->insertGetId([
        'OrdenID'=>$OrdenID,
        'Metodo'=>3, // Deposito / Transferencia
        'Total'=>$req->arraydata['total'], // Total de la orden
        'TotalProductos'=>$req->arraydata['subtotal'], // Total Productos
        'Descuento'=>$req->arraydata['descuento'], // Descuento aplicado
        'Porcentaje' => $req->arraydata['porcentaje'], // Descuento %
        'Moneda'=>1, // mxn
        'created_at'=>now()
      ]);
      // Si es la primer compra
      $cont = Auth::user()->cont;
      $user->cont = $cont+1;
      $user->save();
      // insert orden envio local si es necesario
      if($req->arraydata['TipoEnvio'] == 1 ){
        $OEnvioID = DB::table('orden_envio')->insertGetId([
          'OrdenID'=> $OrdenID,
          'EnvioUID'=> $req->arraydata['EnvioUID'],
          'Costo'=>$req->arraydata['costoenvio'], // Costo envío separado
          'created_at'=>now()
        ]);
      }elseif ($req->arraydata['TipoEnvio'] == 2) {
        // Pickup
        $PickupID = DB::table('orden_pickup')->insertGetId([
          'OrdenID'=>$OrdenID,
          'Fecha'=> $req->arraydata['fechaPick'],
          'Hora'=>$req->arraydata['horaPick'],
          'created_at'=>now()
        ]);
      }
      $OrdenID = $OrdenID + 9249582;
      $event = ['OrdenID'=>$OrdenID];
      $user->notify(new ConfirmacionPedido($event));
      return (['tipo' => 'Completado', 'mensaje' => 'Orden de pedido','OrdenID'=>$OrdenID]);
    }
    // get cliente
    public function getcliente(Request $req)
    {
      $data = DB::table('asociados')
              ->select('NoEmpresario',DB::raw("CONCAT(`asociados`.`Nombre`, ' ', `asociados`.`ApellidoPaterno`, ' ', `asociados`.`ApellidoMaterno`) as Full"))
              ->where(DB::raw("CONCAT(`asociados`.`Nombre`, ' ', `asociados`.`ApellidoPaterno`, ' ', `asociados`.`ApellidoMaterno`)"),'like','%'.$req['query'].'%')
              ->get();
      return response()->json(['tipo'=>200, 'data'=>$data]);
    }
}

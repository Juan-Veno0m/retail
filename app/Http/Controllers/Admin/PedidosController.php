<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
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
        $c = $request->input('categoria');
        $p = $request->input('proveedor');
        // pedidos
        $pedidos = DB::table('orden as o')
                  ->join('orden_status as s','s.id','=','o.Orden_estatus')
                  ->join('orden_envio as e','e.OrdenID','=','o.OrdenID')
                  ->join('orden_pago as p','p.OrdenID','=','o.OrdenID')
                  ->join('metodo_pago as mp','mp.MetodoID','=','p.Metodo')
                  ->join('envio_usuarios as u','u.EnvioID','=','e.EnvioUID')
                  ->join('asociados_usuario','asociados_usuario.UsuarioID','=','o.ClienteID')
                  ->join('asociados','asociados.AsociadosID','=','asociados_usuario.AsociadosID')
                  ->select('o.OrdenID','o.OrdenId as key','o.Fecha_entrega','o.Fecha_requerida','e.Costo as CostoEnvio','mp.Tipo as MetodoPago',
                  'p.TotalProductos','s.status','u.*','asociados.ApellidoPaterno','asociados.ApellidoMaterno','asociados.Nombre','s.attribute','p.Total','p.Descuento')
                  ->paginate(15);
        foreach ($pedidos as $key => $value) {$value->key = encrypt($value->key);}
        $data = ['pedidos'=>$pedidos];
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
                ->select('o.Fecha_requerida','os.status','ac.CuponID')
                ->first();
      $pago = DB::table('orden_pago as op')
                ->join('metodo_pago as mp','mp.MetodoID','=','op.Metodo')
                ->join('orden_envio as oe','oe.OrdenID','op.OrdenID')
                ->where('op.OrdenID','=',$OrdenID)
                ->select('op.TotalProductos','op.Total','op.Descuento','op.Descuento','mp.Tipo','oe.Costo as CostoEnvio')
                ->first();
      $orden_envio = DB::table('orden_envio as oe')
                ->join('envio_usuarios as eu','eu.EnvioID','=','oe.EnvioUID')
                ->join('estados as es','es.id','=','eu.EstadoID')
                ->where('OrdenID','=',$OrdenID)
                ->select('eu.*','es.estado')
                ->first();
      $data = ['items'=>$items,'NOrden'=>$NOrden,'orden'=>$orden,'pago'=>$pago, 'orden_envio'=>$orden_envio];
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
      return $pdf->stream('Empresario-No.'.$e->NoEmpresario.'_Pedido#'.($OrdenID+9249582));
    }
}

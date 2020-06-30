<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class OrdersController extends Controller
{
  function index()
  {
    $id = Auth::id();
    $pedidos = DB::table('orden as o')
              ->join('orden_status as s','s.id','=','o.Orden_estatus')
              ->join('orden_envio as e','e.OrdenID','=','o.OrdenID')
              ->join('orden_pago as p','p.OrdenID','=','o.OrdenID')
              ->join('metodo_pago as mp','mp.MetodoID','=','p.Metodo')
              ->join('envio_usuarios as u','u.EnvioID','=','e.EnvioUID')
              ->where('o.ClienteID','=',$id)
              ->select('o.OrdenID','o.Fecha_entrega','o.Fecha_requerida','e.Costo as CostoEnvio','mp.Tipo as MetodoPago',
              'p.Cantidad as Total','s.status','u.*')
              ->paginate(15);
    $data = ['pedidos'=>$pedidos];
    return view('ui.tienda.MisPedidos',$data);
  }
  // Get Detalles
  public function detalles($NOrden)
  {
    $OrdenID = $NOrden - 9249582;
    $items = DB::table('orden_items as oi')
              ->join('productos as p','p.ProductosID','=','oi.ProductosID')
              ->where('oi.OrdenID','=',$OrdenID)
              ->select('p.ProductosID','p.ProductosNombre','oi.Cantidad as quantity','oi.Precio_lista','p.Cantidad','p.Unidad')
              ->get();
    $orden = DB::table('orden as o')
              ->join('orden_status as os','os.id','=','o.Orden_estatus')
              ->where('o.OrdenID','=',$OrdenID)
              ->select('o.Fecha_requerida','os.status')
              ->first();
    $pago = DB::table('orden_pago as op')
              ->join('metodo_pago as mp','mp.MetodoID','=','op.Metodo')
              ->join('orden_envio as oe','oe.OrdenID','op.OrdenID')
              ->where('op.OrdenID','=',$OrdenID)
              ->select('op.Cantidad as Total','mp.Tipo','oe.Costo as CostoEnvio')
              ->first();
    $orden_envio = DB::table('orden_envio as oe')
              ->join('envio_usuarios as eu','eu.EnvioID','=','oe.EnvioUID')
              ->join('estados as es','es.id','=','eu.EstadoID')
              ->where('OrdenID','=',$OrdenID)
              ->select('eu.*','es.estado')
              ->first();
    $data = ['items'=>$items,'NOrden'=>$NOrden,'orden'=>$orden,
    'breadcrumb'=>'Detalles del pedido','pago'=>$pago, 'orden_envio'=>$orden_envio];
    return view('ui.tienda.DetallesPedido',$data);
  }
}

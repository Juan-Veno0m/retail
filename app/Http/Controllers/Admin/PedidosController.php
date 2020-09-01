<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                  ->join('users','users.id','=','o.ClienteID')
                  ->select('o.OrdenID','o.Fecha_entrega','o.Fecha_requerida','e.Costo as CostoEnvio','mp.Tipo as MetodoPago',
                  'p.TotalProductos','s.status','u.*','users.name','s.attribute')
                  ->paginate(15);
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
                ->where('o.OrdenID','=',$OrdenID)
                ->select('o.Fecha_requerida','os.status')
                ->first();
      $pago = DB::table('orden_pago as op')
                ->join('metodo_pago as mp','mp.MetodoID','=','op.Metodo')
                ->join('orden_envio as oe','oe.OrdenID','op.OrdenID')
                ->where('op.OrdenID','=',$OrdenID)
                ->select('op.TotalProductos','op.Descuento','mp.Tipo','oe.Costo as CostoEnvio')
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

}

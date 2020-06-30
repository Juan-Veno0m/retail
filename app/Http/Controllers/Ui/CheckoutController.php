<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class CheckoutController extends Controller
{
  // index view
  public function index()
  {
    $data = ['breadcrumb'=>'Checkout'];
    return view('ui.tienda.Checkout',$data);
  }
  // Store order
  public function store(Request $req)
  {
    $id = Auth::id();
    // insert orden
    $OrdenID = DB::table('orden')->insertGetId([
      'ClienteID'=>$id,
      'StaffID'=>1, // Asistente virtual <
      'Orden_estatus'=>1, // initial
      'Fecha_requerida'=>now(),
      'TiendaID'=>1 // Tienda en linea
    ]);
    // get session
    $cart = session()->get('cart');
    $total = 0;
    // insert orden items
    foreach(session('cart') as $id => $details){
      // decrytp
      try {
          $decrypted = decrypt($details['keygen']);
      } catch (DecryptException $e) {
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      // sumar
      $total += $details['price'] * $details['quantity'];
      $ItemsID[] = DB::table('orden_items')->insertGetId([
        'OrdenID'=> $OrdenID,
        'ProductosID'=>$decrypted,
        'Cantidad'=>$details['quantity'],
        'Precio_lista'=>$details['price'],
        'Descuento'=>0.00
      ]);
    }
    // insert orden pago
    $PagoID = DB::table('orden_pago')->insertGetId([
      'OrdenID'=>$OrdenID,
      'Metodo'=>1, // efectivo
      'Cantidad'=>$req->total,
      'Moneda'=>1, // mxn
      'created_at'=>now()
    ]);
    // insert orden envio
    $OEnvioID = DB::table('orden_envio')->insertGetId([
      'OrdenID'=> $OrdenID,
      'EnvioUID'=> $req->EnvioUID,
      'Costo'=>$req->envio,
      'created_at'=>now()
    ]);
    $OrdenID = $OrdenID + 9249582;
    session()->forget('cart'); // cart empty
    return (['tipo' => 'Completado', 'mensaje' => 'Orden de pedido','OrdenID'=>$OrdenID]);
  }
}

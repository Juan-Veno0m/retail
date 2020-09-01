<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Mail\ConfirmacionPedido;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use app\User;
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
    $user = User::find($id);
    // insert orden
    $OrdenID = DB::table('orden')->insertGetId([
      'ClienteID'=>$id,
      'StaffID'=>1, // Asistente virtual <
      'Orden_estatus'=>1, // initial
      'Fecha_requerida'=>now(),
      'TiendaID'=>1, // Tienda en linea
      'created_at'=>now()
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
      'Metodo'=>3, // Deposito / Transferencia
      'Total'=>$req->fixedTotal, // Total de la orden
      'TotalProductos'=>$req->total, // Total Productos
      'Descuento'=>$req->descuento, // Descuento aplicado
      'Moneda'=>1, // mxn
      'created_at'=>now()
    ]);
    // Si es la primer compra
    $cont = Auth::user()->cont;
    if (!$cont>0) {
      // code...
      $cupon = DB::table('asociados_cupon')->insertGetId(['CuponID'=>1,'OrdenID'=>$OrdenID]);
      $calculo= number_format($req->fixedTotal+1500/10, 2, '.', '');
      $puntos = DB::table('orden_puntos')->insertGetId(['OrdenID'=>$OrdenID,'Puntos'=>$calculo]);
    }// posteriormente contar
    $user->cont = $cont+1;
    $user->save();
    $calculo = number_format($req->fixedTotal/10, 2, '.', '');
    $puntos = DB::table('orden_puntos')->insertGetId(['OrdenID'=>$OrdenID,'Puntos'=>$calculo]);
    // insert orden envio
    $OEnvioID = DB::table('orden_envio')->insertGetId([
      'OrdenID'=> $OrdenID,
      'EnvioUID'=> $req->EnvioUID,
      'Costo'=>$req->envio, // Costo envío separado
      'created_at'=>now()
    ]);
    $OrdenID = $OrdenID + 9249582;
    $event = ['OrdenID'=>$OrdenID];
    $user->notify(new ConfirmacionPedido($event));
    session()->forget('cart'); // cart empty
    return (['tipo' => 'Completado', 'mensaje' => 'Orden de pedido','OrdenID'=>$OrdenID]);
  }

}

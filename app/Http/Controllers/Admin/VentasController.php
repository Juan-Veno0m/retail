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

class VentasController extends Controller
{

    public function index(Request $request)
    {
      $q = $request->input('q');
      $f = str_replace("/", "-", $request->input('daterange'));
      if (!$f) {
        // code...
        $to = date("Y-m-d");
        $from = date('Y-m-d', strtotime('-30 days'));
      }else{$from = substr($f, 0, 10);
        $to = substr($f,13,22);}
      $ventas = DB::table('ventas as v')
                ->join('ventas_pago as vp','vp.VentasID','=','v.VentasID')
                ->join('ventas_caja as vc','vc.id','=','v.CajaID')
                ->join('tienda as t','t.TiendaID','=','vc.TiendaID')
                ->join('payment_methods as pm','pm.idPaymentMethod','=','vp.idPaymentMethod')
                ->where('v.ventasID','LIKE','%'.$q.'%')
                ->whereBetween('v.created_at',[$from,$to])
                ->select('v.ventasID','vp.Total','pm.paymentMethodAdmin','v.CajaID','t.Nombre','v.created_at')
                ->paginate(25);
      $data = ['ventas'=>$ventas,'q'=>$q,'from'=>$from,'to'=>$to];
      return view('admin.modules.Ventas.ventas',$data);
    }
    public function POS(Request $request)
    {
      $user = DB::table('asociados as a')->join('asociados_usuario as au','au.AsociadosID','a.AsociadosID')->get();
      $producto = DB::table('productos')->where('Descontinuado',0)->where('UnidadesEnStock','>=',1)->get();
      $data = ['user'=>$user,'producto'=>$producto];
      return view('admin.modules.Ventas.index',$data);
    }
    // store order
    public function generar(Request $req)
    {
      // Venta al Publico
      if ($req->dataform['typeOfsale'] == 'public') {
        // insert venta
        $VentasID = DB::table('ventas')->insertGetId([
          'CajaID'=>1,// default
          'UsuarioID'=> Auth::id(), // get user
          'indicted_at'=>$req->dataform['fechaSet'], // indicar fecha anterior
          'created_at'=>now()
        ]);
        // insert items
        for ($i=0; $i < sizeof($req->items) ; $i++) {
          $ItemsID[] = DB::table('ventas_items')->insertGetId([
            'VentasID'=> $VentasID,
            'ProductosID'=> $req->items[$i]['id'],
            'Cantidad'=>$req->items[$i]['cantidad'],
            'Precio'=>$req->items[$i]['sub'],
            'Descuento'=>0.00
          ]);
          // reducir productos del inventario
        }
        // insert orden pago
        $PagoID = DB::table('ventas_pago')->insertGetId([
          'VentasID'=>$VentasID,
          'idPaymentMethod'=>1, // Default Efectivo
          'Subtotal'=>$req->dataform['subt'], // Total de la orden
          'Descuento'=>$req->dataform['descuento'], // Total Productos
          'Total'=>$req->dataform['Total'], // Descuento aplicado
          'Pago'=>$req->dataform['Pago'],
          'Cambio'=>$req->dataform['Cambio']
        ]);
        // Return ok
        return (['tipo' => 'Completado', 'mensaje' => 'Venta completada','VentasID'=>$VentasID,'venta'=>'public']);
      }
      else{
        if ($req->dataform['fechaSet'] !== null) {$fecha = $req->dataform['fechaSet'];}else{ $fecha = date("Y-m-d");}
        // Venta a Empresario
        $AU = DB::table('asociados_usuario as au')
                ->join('asociados as a','a.AsociadosID','=','au.AsociadosID')
                ->where('a.NoEmpresario','=',$req->dataform['Empresario'])
                ->select('au.AsociadosID','au.UsuarioID')->first();
        $user = User::find($AU->UsuarioID); // find empresario
        // insert orden
        $OrdenID = DB::table('orden')->insertGetId([
          'ClienteID'=>$AU->UsuarioID,
          'StaffID'=> 1, // corregir y relacionar con tabla usuarios
          'Orden_estatus'=>5, // Final ok
          'Fecha_requerida'=>$fecha, // fecha indicada en sistema
          'TiendaID'=>1, // Si es Pickup o envio local tienda cercana, pedido online tienda matriz
          'TipoEnvio'=> 4, // .-1 Envio Local .-2 Pickup .- 3 Paqueteria .- 4 En tienda
          'created_at'=>now()
        ]);
        // insert orden items
        for ($i=0; $i < sizeof($req->items) ; $i++) {
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
          'Metodo'=>1, // Deposito / Transferencia
          'Total'=> $req->dataform['Total'] , // Total de la orden
          'Pago'=> $req->dataform['Pago'],
          'Cambio'=> $req->dataform['Cambio'],
          'TotalProductos'=>$req->dataform['subt'], // Total Productos
          'Descuento'=>$req->dataform['descuento'], // Descuento aplicado
          'Porcentaje' => $req->dataform['Percent'], // Descuento %
          'Moneda'=>1, // mxn
          'FechaLiquidado'=>$fecha,
          'created_at'=>now()
        ]);
        // Agregar pago en tabla 'pagosclientes'
        $pc = DB::table('pagosclientes')->insertGetId([
          'fechaPago'=>$fecha,
          'montoPC'=>$req->dataform['Total'],
          'comentarioPago'=>'Pago en tienda',
          'OrdenID'=>$OrdenID,
          'formaPagoP'=>'Efectivo',
          'folioPagoP'=>'Efectivo',
          'created_at'=>now()
        ]);
        // generar puntos red
        $cupon = DB::table('asociados_cupon as a')
                    ->join('cupones as c','c.id','=','a.CuponID')
                    ->where('a.OrdenID',$OrdenID)->sum('c.descuento');
        $Mes = substr($fecha, 5, -3);
        $Año = substr($fecha, 0, 4);
        $OrdenPuntos = (floatval($req->dataform['Total'])+floatval($cupon))/10;
        $p = DB::table('balance_puntos')
                  ->where('AsociadosID',$AU->AsociadosID)
                  ->where('Mes',$Mes)
                  ->where('Año',$Año)
                  ->first();
        $r = DB::table('asociados_relacion')->where('AsociadosID',$AU->AsociadosID)->first();
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
          DB::table('balance_puntos')->where('AsociadosID',$AU->AsociadosID)
                      ->where('Mes',$Mes)
                      ->where('Año',$Año)
                      ->update(['Puntos'=>$sum,'updated_at'=>now()]);
        }else{$balance = DB::table('balance_puntos')->insertGetId(['AsociadosID'=>$AU->AsociadosID,'Mes'=>$Mes,'Año'=>$Año,'Puntos'=>$OrdenPuntos,'created_at'=>now()]);}
        // Si es la primer compra
        $cont = Auth::user()->cont;
        $user->cont = $cont+1;
        $user->save();
        $OrdenID = $OrdenID + 9249582;
        $event = ['OrdenID'=>$OrdenID];
        $user->notify(new ConfirmacionPedido($event));
        return (['tipo' => 'Completado', 'mensaje' => 'Orden de pedido','OrdenID'=>$OrdenID ,'venta'=>'private']);
      }

    }
    // get cliente
    public function search(Request $req)
    {
      $data = DB::table('asociados')
              ->select('NoEmpresario as value',DB::raw("CONCAT(`asociados`.`Nombre`, ' ', `asociados`.`ApellidoPaterno`, ' ', `asociados`.`ApellidoMaterno`) as label"))
              ->where(DB::raw("CONCAT(`asociados`.`Nombre`, ' ', `asociados`.`ApellidoPaterno`, ' ', `asociados`.`ApellidoMaterno`)"),'like','%'.$req['term'].'%')
              ->orWhere('NoEmpresario','like','%'.$req['term'].'%')
              ->get();
      return response()->json($data);
    }
    // get puntos of month
    public function puntos(Request $req)
    {
      $Empresario = DB::table('asociados as a')
                    ->join('asociados_usuario as au','au.AsociadosID','=','a.AsociadosID')
                    ->where('a.NoEmpresario', $req->empresario)
                    ->select('au.*')
                    ->first();
      $user = DB::table('users')->where('id',$Empresario->UsuarioID)->select('cont')->first();
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
    // Ticket
    public function ticket($No)
    {
      $venta = DB::table('ventas as v')
                ->join('ventas_pago as vp','vp.VentasID','=','v.VentasID')
                ->join('payment_methods as pm','pm.idPaymentMethod','=','vp.idPaymentMethod')
                ->join('ventas_caja as vc','vc.id','=','v.CajaID')
                ->join('tienda as t','t.TiendaID','=','vc.TiendaID')
                ->join('users as u','u.id','=','v.UsuarioID')
                ->join('estados as e','e.id','=','t.EstadoID')
                ->where('v.VentasID',$No)
                ->select('v.VentasID as No','v.created_at as fecha_venta','v.CajaID as Ncaja','t.Nombre as Tienda','t.Telefono','t.Direccion','t.Ciudad',
                'e.estado','t.codigo_postal','pm.PaymentMethod','vp.Subtotal','vp.Descuento','vp.Total','vp.Pago','vp.Cambio','u.name as Usuario','vc.id as Caja')->first();
      if (isset($venta)) {
        // code...
        $items = DB::table('ventas_items as vi')
                  ->join('productos as p','p.ProductosID','=','vi.ProductosID')
                  ->where('vi.ventasID','=',$No)->select('vi.*','p.ProductosNombre','p.PrecioBy')->get();
        $data = ['venta'=>$venta,'items'=>$items];
        // share data to view
        $view = \View::make('admin.modules.Ventas.ticket',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('TicketNo.'.$No.'.pdf');
        //return view('admin.modules.Ordenes.Ventas.ticket',$data);
      }else{dd('error');}

    }
}

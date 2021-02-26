<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use DB;

class MiCuentaController extends Controller
{
    // Index
    public function index(Request $request)
    {
      $asociado = DB::table('asociados_usuario as u')
                    ->join('asociados as a','a.AsociadosID','=','u.AsociadosID')
                    ->where('u.UsuarioID',Auth::id())
                    ->select('a.*')->first();
      $puntos = DB::table('orden_puntos as puntos')
                  ->join('orden_pago as pago','pago.OrdenID','=','puntos.OrdenID')
                  ->join('orden as o','o.OrdenID','=','puntos.OrdenID')
                  ->where('pago.FechaLiquidado','>=','2020-08-01')
                  ->where('pago.FechaLiquidado','<=','2020-08-31')
                  ->where('o.ClienteID',Auth::id())
                  ->sum('puntos.Puntos');
      return view('ui.tienda.Cuenta',['asociado'=>$asociado,'puntos'=>$puntos]);
    }
    /* Red */
    public function Red(Request $req)
    {
      //Filter
      $q = $req->input('q');
      $f = $req->input('f');
      ///
      $Mes = substr($f, 5,7); // get month
      $Año = substr($f, 0, 4); // get Year
      $asociado = DB::table('asociados_usuario as u')
                    ->where('u.UsuarioID',Auth::id())
                    ->select('u.AsociadosID')->first();
      $red = DB::table('asociados as a')
              ->join('asociados_relacion as l1','l1.AsociadosID','a.AsociadosID')
              ->leftjoin('asociados_relacion as l2','l2.AsociadosID','a.AsociadosID')
              ->leftjoin('asociados_relacion as l3','l3.AsociadosID','a.AsociadosID')
              ->where('l1.t1',$asociado->AsociadosID)
              ->orWhere('l2.t2',$asociado->AsociadosID)
              ->orWhere('l3.t3',$asociado->AsociadosID)
              ->select('l1.t1','l2.t2','l3.t3','a.*')->paginate(10);
      $consumo = DB::table('balance_puntos as b')
              ->where('b.Mes',$Mes)
              ->where('b.Año',$Año)->get();
      return view('ui.tienda.Red',['red'=>$red,'asociado'=>$asociado,'consumo'=>$consumo,'q'=>$q,'f'=>$f]);
    }
}

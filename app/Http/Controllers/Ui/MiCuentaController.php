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
}

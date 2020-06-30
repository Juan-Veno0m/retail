<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class ShippingController extends Controller
{
  // get if exits shipping info
  public function shipping()
  {
    $id = Auth::id();
    $envio = DB::table('envio_usuarios')->where('UsuarioID','=',$id)->first();
    return (['envio'=>$envio]);
  }
  // shipping action {create:update}
  public function shipping_action(Request $req)
  {
    $id = Auth::id();
    if ($req->action=='create') {
      // code...
      $EnvioID = DB::table('envio_usuarios')
        ->insertGetId([
          'UsuarioID'=>$id,
          'NombreCompleto'=>$req->arraydata['fullname'],'Codigopostal'=>$req->arraydata['postalcode'],
          'Telefono'=>$req->arraydata['telefono'],'EstadoID'=>$req->arraydata['estado'],
          'Municipio'=>$req->arraydata['delegacion'],'Colonia'=>$req->arraydata['colonia'],
          'Calle'=>$req->arraydata['Calle'],'Exterior'=>$req->arraydata['exterior'],
          'Interior'=>$req->arraydata['interior'],'Calle1'=>$req->arraydata['Calle1'],
          'Calle2'=>$req->arraydata['Calle2'],'Adicional'=>$req->arraydata['adicional'],'created_at'=>now()
        ]);
      return (['respuesta'=>'ok','EnvioID'=>$EnvioID]);
    }else{
      return (['respuesta'=>'ok']);
    }
  }
}

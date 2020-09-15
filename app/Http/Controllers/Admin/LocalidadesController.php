<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LocalidadesController extends Controller
{
    // Main View
    public function index(Request $request)
    {
      $local = DB::table('localidades')->join('estados as e','e.id','=','localidades.EstadoID')->paginate(15);
      foreach ($local as $key => $value) {$value->id = encrypt($value->id);}
      $data = ['local'=>$local];
      return view('admin.modules.Localidades.index',$data);
    }

}

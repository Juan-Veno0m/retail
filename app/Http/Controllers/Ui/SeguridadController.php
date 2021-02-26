<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use DB;

class SeguridadController extends Controller
{
    // Index
    public function index(Request $request)
    {
      $user = DB::table('users')->where('id',Auth::id())->first();
      return view('ui.tienda.seguridad',['user'=>$user]);
    }
    // update
    public function update(Request $req)
    {
      // Authorize
      $id = Auth::id();
      $user = User::where('id', $id)->first();
      if (!Hash::check($req->password, $user->password)) {
        return response()->json(['success'=>false, 'message' => 'Login Fail']);
      }
      // action
      if ($req->action=='name') {
        // code...
        $user->name = $req->replace;
        $user->save();
        return response()->json(['success'=>true, 'message' => 'Nombre actualizado correctamente']);
      }
      if ($req->action=='password') {
        // code...
        //User::where('id',$id)->update(['password'=>Hash::make($req->replace)])
        $user->password = Hash::make($req->replace);
        $user->save();
        return response()->json(['success'=>true, 'message' => 'Contraseña actualizada correctamente']);
      }
    }
}

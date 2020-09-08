<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class AsociadosController extends Controller
{

    public function index(Request $request)
    {
        // Filter
        $q = $request->input('q');
        $asociados = DB::table('asociados as a')
                ->where('a.NoEmpresario','LIKE','%'.$q.'%') // Filtro
                ->select('a.AsociadosID as id','a.NoEmpresario','a.ApellidoPaterno','a.ApellidoMaterno','a.Nombre','a.FechaSolicitud','a.Iniciales')
                ->paginate(10)->appends(request()->except('page'));

        $data = ['asociados'=>$asociados,'q'=>$q];
        return view('admin.modules.Asociados.index',$data);
    }
    /* crear nuevo asociado */
    public function action(Request $req)
    {
      if ($req->arraydata['action'] == 'create') {
        // check if exits
        $check = DB::table('asociados')->where('NoEmpresario',$req->arraydata['noasociado'])->first();
        if (!isset($check)) {
          $id = DB::table('asociados')->insertGetId(['NoEmpresario'=>$req->arraydata['noasociado'],'ApellidoPaterno'=>$req->arraydata['ApellidoP'],
          'ApellidoMaterno'=>$req->arraydata['ApellidoM'],'Nombre'=>$req->arraydata['nombre'],'Iniciales'=>$req->arraydata['iniciales'],
          'Sexo'=>$req->arraydata['Sexo'],'FechaNacimiento'=>$req->arraydata['Nacimiento'],'RFC'=>$req->arraydata['RFC'],
          'Homoclave'=>$req->arraydata['Homoclave'],'NoPresentador'=>$req->arraydata['NoPresentador'],'FechaSolicitud'=>$req->arraydata['fecha'],'created_at'=>now()]);
          // foreign keys
          $tel = DB::table('asociados_telefono')->insertGetId(['AsociadosID'=>$id,'Telefono'=>$req->arraydata['telefonoh'],'Tipo'=>1,'created_at'=>now()]);
          if (!$req->arraydata['telefonop']=="") {
            $tel2 = DB::table('asociados_telefono')->insertGetId(['AsociadosID'=>$id,'Telefono'=>$req->arraydata['telefonop'],'Tipo'=>2,'created_at'=>now()]);
          }
          // address
          $dir = DB::table('asociados_direccion')->insertGetId(['AsociadosID'=>$id,'Direccion'=>$req->arraydata['direccion'],'Colonia'=>$req->arraydata['Colonia'],
          'Ciudad'=>$req->arraydata['Ciudad'],'EstadoID'=>$req->arraydata['estado'],'CP'=>$req->arraydata['CP'],'created_at'=>now()]);
          // return ok
          return response()->json(['tipo' => 200,'mensaje'=>'Cambios aplicados correctamente.']);
        }else{return response()->json(['tipo' => 500,'mensaje'=>'El numero de Asociado ya existe.']);}
      }elseif ($req->arraydata['action'] == 'update') {
        // code...
      }
    }
    // read
    public function acceso(Request $request)
    {
      $data = DB::table('asociados_usuario as a')
              ->join('users as u','u.id','=','a.UsuarioID')
              ->where('a.AsociadosID',$request->id)
              ->select('u.*')
              ->first();

      return response()->json($data);
    }
    // create and update access to the system
    public function acceso_tx(Request $req)
    {
      $check = DB::table('users')->where('email',$req->array['email'])->first();
      if ($req->array['action'] == 'create') {
        // code...
        if (!isset($check)) {
          $id = DB::table('users')->insertGetId(['name'=>$req->array['name'],'email'=>$req->array['email'],
          'email_verified_at'=>now(),'password'=>Hash::make($req->array['password']),'created_at'=>now()]);
          //$this->notify(new VerifyEmail);
          $role = DB::table('role_user')->insertGetId(['role_id'=>3,'user_id'=>$id,'created_at'=>now()]);
          // asociados relacion
          $asociado = DB::table('asociados_usuario')->insertGetId(['AsociadosID'=> $req->array['AsociadosID'],'UsuarioID'=>$id,'created_at'=>now()]);
          if (isset($asociado)) {
            return response()->json(['tipo' => 200]);
          }else{return response()->json(['tipo' => 500]);}
        }else{
          $nd = DB::table('asociados_usuario')->where('UsuarioID',$check->id)->first();
          if (!isset($check)) {return response()->json(['tipo' => 501]);}
          else{return response()->json(['tipo' => 502]);}
        }
      }else{
          // update
          if ($req->array['password']!="") {
            // code...
            $id = DB::table('users')->where('id',$req->array['id'])->update(['password'=>Hash::make($req->array['password']),'updated_at'=>now()]);
          }else{
            $mail = DB::table('users')->where('id',$req->array['id'])->where('email',$req->array['email'])->first();
            if (!isset($mail) && !isset($check)) {$id = DB::table('users')->where('id',$req->array['id'])->update(['email'=>$req->array['email'],'updated_at'=>now()]);}
            else{return response()->json(['tipo' => 502]);}
          }
          return response()->json(['tipo' => 200]);
      }
    }
    /* get details */
    public function detalles(Request $req)
    {
      $data = DB::table('asociados')->where('AsociadosID',$req->id)->first();
      $dir = DB::table('asociados_direccion')->where('AsociadosID',$req->id)->first();
      $tel = DB::table('asociados_telefono')->where('AsociadosID',$req->id)->get();
      if (isset($data)) {return response()->json(['tipo' => 200,'data'=>$data,'dir'=>$dir,'tel'=>$tel]);}
      else{return response()->json(['tipo' => 500,'data'=>'not found']);}
    }

}
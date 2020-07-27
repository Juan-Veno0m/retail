<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProveedoresController extends Controller
{

    public function index(Request $request)
    {
        // Filter
        $q = $request->input('q');
        // proveedores
        $proveedores = DB::table('proveedores')
          ->where('EmpresaNombre','LIKE','%'.$q.'%') // Filtro Nombre
          ->select('ProveedorID','EmpresaNombre','ContactoNombre','ContactoTitulo','Direccion','Ciudad','Region','CodigoPostal','Pais',
          'Telefono','Web')->paginate(5);
        $data = ['proveedores'=>$proveedores,'q'=>$q];
        return view('admin.modules.Proveedores.index',$data);
    }
    // crear proveedor
    public function create(Request $req)
    {
        // proveedores
        $id = DB::table('proveedores')->insertGetId(
          ['EmpresaNombre' => $req->data['EmpresaNombre'],'ContactoNombre' => $req->data['ContactoNombre'],
              'ContactoTitulo'=> $req->data['ContactoTitulo'],'Direccion'=>$req->data['Direccion'] ,
              'Ciudad'=> $req->data['Ciudad'],'Region'=> $req->data['Region'],'Web'=> $req->data['Web'],
              'CodigoPostal'=> $req->data['CodigoPostal'],'Pais'=> $req->data['Pais'],'Telefono'=> $req->data['Telefono'],'created_at'=> now()]);
        $id = encrypt($id);
        return (['tipo' => 'success','mensaje'=>'Proveedor agregado correctamente','id'=>$id]);
    }
    // Get details
    public function read(Request $req)
    {
      $id = $req->key - 532359;
      $proveedores = DB::table('proveedores')
        ->where('ProveedorID','=',$id)
        ->select('ProveedorID','EmpresaNombre','ContactoNombre','ContactoTitulo','Direccion','Ciudad','Region','CodigoPostal','Pais',
        'Telefono','Web')->first();
      return (['tipo' => 'success', 'mensaje' => 'ok','proveedores'=>$proveedores]);
    }
    // update
    public function update(Request $req)
    {
      $id = $req->data['key'] - 532359;
      $affected = DB::table('proveedores')
      ->where('ProveedorID', $id)
      ->update(['EmpresaNombre' => $req->data['EmpresaNombre'],'ContactoNombre' => $req->data['ContactoNombre'],
            'ContactoTitulo'=> $req->data['ContactoTitulo'],'Direccion'=>$req->data['Direccion'] ,
            'Ciudad'=> $req->data['Ciudad'],'Region'=> $req->data['Region'],'Web'=> $req->data['Web'],
            'CodigoPostal'=> $req->data['CodigoPostal'],'Pais'=> $req->data['Pais'],'Telefono'=> $req->data['Telefono'],'updated_at'=> now()]);
      return (['tipo' => 'success','mensaje'=>'Proveedor editado correctamente']);
    }

}

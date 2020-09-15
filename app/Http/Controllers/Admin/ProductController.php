<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // Filter
        $q = $request->input('q');
        $c = $request->input('categoria');
        $p = $request->input('proveedor');
        // productos
        $productos = DB::table('productos as p')
          ->join('categorias as c','p.CategoriaID','=','c.CategoriaID')
          ->join('proveedores as prov','p.ProveedorID','=','prov.ProveedorID')
          ->where('p.ProductosNombre','LIKE','%'.$q.'%') // Filtro Nombre
          ->where('p.CategoriaID','LIKE','%'.$c.'%') // Filtro Categoria
          ->where('p.ProveedorID','LIKE','%'.$p.'%') // Filtro Proveedor
          ->wherenull('p.deleted_at')
          ->select('p.ProductosID','p.ProductosID as uk','p.ProductosNombre','p.CategoriaID','c.CategoriaNombre','p.ProveedorID','p.PrecioUnitario','p.UnidadesEnStock',
          'p.Cantidad','p.Unidad')
          ->paginate(15);
        foreach ($productos as $key => $value) {$value->ProductosID = encrypt($value->ProductosID);}
        // categorias
        $categorias = DB::table('categorias')->wherenull('Parent')->get();
        // Proveedores
        $proveedores = DB::table('proveedores')->get();
        // data array
        $data = ['productos' => $productos,'categorias'=>$categorias,'proveedores'=>$proveedores,'q'=>$q,'c'=>$c,'p'=>$p];
        return view('admin.modules.Productos.index', $data);
    }

    public function create(Request $req)
    {
        // productos
        $id = DB::table('productos')->insertGetId(
          ['ProductosNombre' => $req->data['producto'],'ProveedorID' => $req->data['proveedor'],
              'CategoriaID'=> $req->data['categoria'],'Descripcion'=>$req->data['descripcion'] ,'Cantidad'=> $req->data['cantidad'],'Unidad'=> $req->data['unidad'],
              'PrecioUnitario'=> $req->data['precio'],'created_at'=> now()]);
        $id = encrypt($id);
        return (['tipo' => 'success','mensaje'=>'Producto agregado correctamente','id'=>$id]);
    }

    public function read(Request $req)
    {
        // decrypt
        try {
            $decrypted = decrypt($req->id);
        } catch (DecryptException $e) {
            //
            return (['tipo' => 'error', 'mensaje' => $e]);
        }
        //
        $productos = DB::table('productos as p')
          ->join('categorias as c','p.CategoriaID','=','c.CategoriaID')
          ->join('proveedores as prov','p.ProveedorID','=','prov.ProveedorID')
          ->where('p.ProductosID','=',$decrypted)
          ->select('p.ProductosNombre','p.CategoriaID','c.CategoriaNombre','p.Descripcion','p.Cantidad','p.Unidad','p.ProveedorID','p.PrecioUnitario','p.UnidadesEnStock')
          ->first();

        return (['tipo' => 'success', 'mensaje' => 'ok','productos'=>$productos]);
    }

    public function update(Request $req)
    {
        // decrypt
        try {
            $decrypted = decrypt($req->data['id']);
        } catch (DecryptException $e) {
            //
            return (['tipo' => 'error', 'mensaje' => $e]);
        }
        // productos
        $affected = DB::table('productos')
              ->where('ProductosID', $decrypted)
              ->update(['ProductosNombre' => $req->data['producto'],'ProveedorID' => $req->data['proveedor'],
              'CategoriaID'=> $req->data['categoria'],'Descripcion'=>$req->data['descripcion'],'Cantidad'=> $req->data['cantidad'],'Unidad'=>$req->data['unidad'],
              'PrecioUnitario'=> $req->data['precio'],'updated_at'=> now()]);
        return (['tipo' => 'success','mensaje'=>'Producto actualizado correctamente']);
    }

    public function delete(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->id);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      // then check images product stored
      $files = DB::table('productos_imagenes')->where('ProductosID',$decrypted)->first();
      if (isset($files)) {
        $separate = explode('/', $files->img); $base= $separate[0];  $filename = $separate[2];
        Storage::disk('public')->deleteDirectory($base); // delete Directory
        // delete record database
        DB::table('productos_imagenes')->where('ProductosID','=',$decrypted)->delete();
      }
      DB::table('productos')->where('ProductosID','=',$decrypted)->delete();
      return (['tipo' => 'ok', 'mensaje' => 'borrado correctamente']);

    }
    // set stock
    public function stock(Request $req)
    {
      if ($req->ajax()) {
        // decrypt
        try {
            $decrypted = decrypt($req['key']);
        } catch (DecryptException $e) {
            //
            return (['tipo' => 'error', 'mensaje' => $e]);
        }
        // update
        DB::table('productos')->where('ProductosID',$decrypted)->update(['UnidadesEnStock'=>$req['stock'],'updated_at'=>now()]);
        // comment
        $id = DB::table('comentarios_stock')->insertGetId(['comentario'=>$req['comentarios'],'oldstock'=>$req['oldstock'],
        'ProductosID'=>$decrypted,'UserID'=>Auth::id(),'created_at'=>now()]);
        return (['tipo' => 200, 'mensaje' => 'Cambios aplicados','stock'=>$req['stock']]);
      }else{abort(404);}
    }
    // get localidades
    public function localidades(Request $req)
    {
      if ($req->ajax()) {
        // decrypt
        try {
            $decrypted = decrypt($req->id);
        } catch (DecryptException $e) {
            //
            return (['tipo' => 'error', 'mensaje' => $e]);
        }
        $local = DB::table('localidades')->get();
        $data = DB::table('productos_localidades')->where('ProductosID',$decrypted)->select('LocalidadID')->get();
        return (['tipo' => 200, 'local'=>$local,'plocal'=>$data]);
      }
      else{abort(404);}
    }
    // Localidades Create // Delete
    public function localidadesTx(Request $req)
    {
      if ($req->ajax()) {
        // decrypt
        try {
            $decrypted = decrypt($req->id);
        } catch (DecryptException $e) {
            //
            return (['tipo' => 'error', 'mensaje' => $e]);
        }
        /* eliminar */
        if (is_array($req->eliminar)) {
          for ($i=0; $i < sizeof($req->eliminar) ; $i++) {
            DB::table('productos_localidades')->where('ProductosID',$decrypted)->where('LocalidadID',$req->eliminar[$i])->delete();
          }
        }
        /* agregar */
        if (is_array($req->agregar)) {
          for ($i=0; $i < sizeof($req->agregar) ; $i++) {
            $id[] = DB::table('productos_localidades')->insertGetId(['ProductosID'=>$decrypted,'LocalidadID'=>$req->agregar[$i],'created_at'=>now()]);
          }
        }
        return (['tipo' => 200]);
      }else{abort(404);}
    }
}

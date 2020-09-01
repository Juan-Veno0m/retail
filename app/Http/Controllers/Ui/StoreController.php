<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Contacto;
use App\User;
use DB;

class StoreController extends Controller
{
    // Index
    public function index(Request $request)
    {
      $productos = DB::table('productos as p')
        ->join('proveedores as prov','prov.ProveedorID','=','p.ProveedorID')
        ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
        ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
        ->select('p.ProductosID','p.ProductosID as ID','p.ProductosNombre','p.PrecioUnitario','pi.img','cat.CategoriaNombre','p.Cantidad','p.Unidad')
        ->orderBy('p.ProductosID','desc')
        ->take(8)->get();
      foreach ($productos as $key => $value) {$value->ID = encrypt($value->ID);}
      $data = ['productos'=>$productos];
      return view('ui.tienda.index', $data);
    }
    // Producto view
    public function Producto($ProductosNombre,$ProductosID)
    {
      // Get Product info
      $id = $ProductosID-3301;
      $key = $ProductosID;
      $producto = DB::table('productos as p')
          ->join('proveedores as prov','prov.ProveedorID','=','p.ProveedorID')
          ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
          ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.featured')
          ->where('p.ProductosID','=',$id)
          ->select('p.ProductosNombre','prov.EmpresaNombre','cat.CategoriaNombre','cat.CategoriaID',
          'p.Descripcion','p.Cantidad','p.Unidad','p.PrecioUnitario','p.Featured','pi.img','p.ProveedorID')
          ->first();
      $related =  DB::table('productos as p')
        ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
        ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
        ->select('p.ProductosID','p.ProductosID as ID','p.ProductosNombre','p.PrecioUnitario','pi.img','cat.CategoriaNombre','p.ProveedorID','p.Cantidad','p.Unidad')
        ->whereNotIn('p.ProductosID',[$id])
        ->where('p..ProveedorID', 'LIKE','%'.$producto->ProveedorID.'%')
        ->orderBy('p.ProductosID','desc')
        ->take(4)->get();
      foreach ($related as $k => $value) {$value->ID = encrypt($value->ID);}
      $imagenes = DB::table('productos_imagenes')
          ->where('ProductosID','=',$id)->take(4)->get();
      $id = encrypt($id);
      $data = ['producto'=>$producto,'imagenes'=>$imagenes,'ProductosID'=>$ProductosID,
      'related'=>$related,'breadcrumb'=>$producto->ProductosNombre,'id'=>$id,'key'=>$key];
      return view('ui.tienda.ProductoSingle', $data);
    }
    // Tienda Route
    public function Tienda(Request $request)
    {
      return view('ui.tienda.Tienda');
    }
    // Email Contacto
    public function Contacto(Request $req)
    {
      $user = User::find(2);
      $event = ['nombre'=>$req->arraydata['nombre'],'correo'=>$req->arraydata['correo'],'telefono'=>$req->arraydata['telefono']
      ,'asunto'=>$req->arraydata['asunto'],'mensaje'=>$req->arraydata['mensaje']];
      $user->notify(new Contacto($event));
      return (['tipo' => 'Completado', 'mensaje' => 'ok']);
    }
    // Categorias
    public function Categorias($CategoriaNombre, $CategoriaID)
    {
      $node = str_replace('node','', $CategoriaID);
      $q = \Request::get('q');
      $productos = DB::table('productos as p')
        ->join('proveedores as prov','prov.ProveedorID','=','p.ProveedorID')
        ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
        ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
        ->where('cat.CategoriaID','=',$node)
        ->where('p.ProductosNombre', 'LIKE','%'.$q.'%')
        ->where('prov.Flag','=',0)
        ->select('p.ProductosID','p.ProductosID as ID','p.ProductosNombre','p.Cantidad','p.Unidad','p.PrecioUnitario','pi.img','cat.CategoriaNombre')
        ->orderBy('p.ProductosID','desc')
        ->simplePaginate(16)->appends(request()->except('page'));
      foreach ($productos as $key => $value) {$value->ID = encrypt($value->ID);}
      $CategoriaNombre = str_replace('-',' ', $CategoriaNombre);
      $data = ['productos'=>$productos,'q'=>$q,'node'=>$node,'CategoriaNombre'=>$CategoriaNombre];
      return view('ui.tienda.Categorias', $data);
    }
    /* SQL Departamentos 3 Niveles
    SELECT c1.CategoriaNombre as Departamento ,c2.CategoriaNombre as Sub,c3.CategoriaNombre as Categoría FROM categorias as c3
    LEFT JOIN categorias as c2 on c2.CategoriaID= c3.Parent
    LEFT JOIN categorias as c1 ON c1.CategoriaID = c2.Parent WHERE c3.CategoriaID=12
    */
    // Suggestions
    public function Suggestions(Request $req)
    {
      $data = DB::table('productos as p')
        ->join('proveedores as prov','prov.ProveedorID','=','p.ProveedorID')
        ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
        ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
        ->where('p.ProductosNombre', 'LIKE','%'.$req->term.'%')
        ->where('prov.Flag','=',0)
        ->select('p.ProductosID','p.ProductosID as ID','p.ProductosNombre','p.Cantidad','p.Unidad','p.PrecioUnitario','pi.img','cat.CategoriaNombre')
        ->take(8)->get();
      return response()->json(['data'=>$data]);
    }
}

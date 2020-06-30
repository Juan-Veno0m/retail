<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StoreController extends Controller
{

    public function index(Request $request)
    {
      $productos = DB::table('productos as p')
        ->join('proveedores as prov','prov.ProveedorID','=','p.ProveedorID')
        ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
        ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
        ->select('p.ProductosID','p.ProductosID as ID','p.ProductosNombre','p.PrecioUnitario','pi.img','cat.CategoriaNombre')
        ->take(8)->get();
      foreach ($productos as $key => $value) {$value->ID = encrypt($value->ID);}
      $data = ['productos'=>$productos];
      return view('ui.tienda.index', $data);
    }
    public function Producto($ProductosNombre,$ProductosID)
    {
      // Get Product info
      $id = $ProductosID-3301;
      $producto = DB::table('productos as p')
          ->join('proveedores as prov','prov.ProveedorID','=','p.ProveedorID')
          ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
          ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.featured')
          ->where('p.ProductosID','=',$id)
          ->select('p.ProductosNombre','prov.EmpresaNombre','cat.CategoriaNombre',
          'p.Descripcion','p.Cantidad','p.Unidad','p.PrecioUnitario','p.Featured','pi.img')
          ->first();
      $related =  DB::table('productos as p')
        ->join('categorias as cat','cat.CategoriaID','=','p.CategoriaID')
        ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
        ->select('p.ProductosID','p.ProductosNombre','p.PrecioUnitario','pi.img','cat.CategoriaNombre')
        ->whereNotIn('p.ProductosID',[$id])
        ->take(4)->get();
      $imagenes = DB::table('productos_imagenes')
          ->where('ProductosID','=',$id)->take(4)->get();
      $id = encrypt($id);
      $data = ['producto'=>$producto,'imagenes'=>$imagenes,'ProductosID'=>$ProductosID,
      'related'=>$related,'breadcrumb'=>$producto->ProductosNombre,'id'=>$id];
      return view('ui.tienda.ProductoSingle', $data);
    }
}

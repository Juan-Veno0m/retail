<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ProductImagesController extends Controller
{
    /* Product Images */
    public function read(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->id);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      // get images
      $data = DB::table('productos_imagenes as pi')
        ->where('pi.ProductosID','=',$decrypted)
        ->select('pi.ImagenesPID','pi.caption','pi.img')
        ->get();
      $featured = DB::table('productos')->select('Featured')->where('ProductosID','=',$decrypted)->first();
      return (['tipo' => 'success', 'mensaje' => 'ok','imagenes'=>$data,'featured'=>$featured]);
    }
    // Upload Image
    public function create(Request $req)
    {
      $input = $req->all();
  		$rules = array(
  		    'file' => 'image|max:3000',
  		);
  		$validation = Validator::make($input, $rules);
  		if ($validation->fails())
  		{
        return (['tipo' => 'error', 'mensaje' => 400,'details'=>'La imagen excede los 3MB']);
  		}
      // decrypt
      try {
          $decrypted = decrypt($input['producto']);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      $path = 'producto-'.($decrypted+3301).'';
      $file = Storage::disk('public')->putFile($path, $req->file('file'));
      $id = DB::table('productos_imagenes')->insertGetId(['ProductosID'=> $decrypted,
      'img'=>$file,'created_at'=>now()]);
      if( $file ) {
        return (['tipo' => 'success', 'mensaje' => 200]);
      } else {
        return (['tipo' => 'error', 'mensaje' => 400]);
      }
    }
    // Featured Image
    public function featured(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->productoid);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      $up = DB::table('productos')
        ->where('ProductosID','=',$decrypted)
        ->update(['Featured'=>$req->imagenid,'updated_at'=>now()]);
        return (['tipo' => 'success', 'mensaje' => 'Imagen principal actualizada']);
    }
    // Delete images
    public function delete(Request $req)
    {
      //
      for ($i=0; $i < sizeof($req->ImagenesPID); $i++) {
        // delete record
        $down = DB::table('productos_imagenes')->where('ImagenesPID','=',$req->ImagenesPID[$i][0])->delete();
        // delete file
        $erase = Storage::disk('public')->delete($req->ImagenesPID[$i][1]);
      }
      return (['tipo' => 'success', 'mensaje' => 'Imagenes eliminadas']);
    }
}

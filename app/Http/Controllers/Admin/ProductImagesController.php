<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
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
      $file = $req->file('file');
      $path = '/producto-'.($decrypted+3301).'/';
      // create an image manager instance with favored driver
      $img = Image::make($file);
      $original_photo_storage = $path.'original';
      $large_photos_storage = $path.'large/';
      $medium_photos_storage = $path.'medium/';
      $mobile_photos_storage = $path.'mobile/';
      /* 626 , 300, 150 */
      $Primary = Storage::disk('public')->putFile($original_photo_storage, $req->file('file')); // Save Original
      $separate = explode('/', $Primary);  $fullname = $separate[2];
      $img->resize(626, null, function ($constraint) {$constraint->aspectRatio();})->encode();
      $image = Storage::disk('public')->put($large_photos_storage.$fullname, $img); // Save Large
      $img->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->encode();
      $image = Storage::disk('public')->put($medium_photos_storage.$fullname, $img); // Save Medium
      $img->resize(150, null, function ($constraint) {$constraint->aspectRatio();})->encode();
      $image = Storage::disk('public')->put($mobile_photos_storage.$fullname, $img); // Save Mobile

      $id = DB::table('productos_imagenes')->insertGetId(['ProductosID'=> $decrypted,
      'img'=>$Primary,'created_at'=>now()]);

      if( $Primary ) {
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
        $separate = explode('/', $req->ImagenesPID[$i][1]); $base= $separate[0];  $filename = $separate[2];
        // delete file
        $erase = Storage::disk('public')->delete($req->ImagenesPID[$i][1]); // original
        if(strpos($separate[1], 'original') !== false){
          Storage::disk('public')->delete($base.'/large'.'/'.$filename); // large
          Storage::disk('public')->delete($base.'/medium'.'/'.$filename); // medium
          Storage::disk('public')->delete($base.'/mobile'.'/'.$filename); // mobile
        }
      }
      return (['tipo' => 'success', 'mensaje' => 'Imagenes eliminadas']);
    }
    // Regenerar imagenes Responsivas
    public function regenerate(Request $req)
    {
      for ($i=0; $i < sizeof($req->ImagenesPID); $i++) {
        $contents = Storage::get($req->ImagenesPID[$i][1]); // Get the old version
      }
    }
}

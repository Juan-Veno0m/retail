<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use DB;

class RegenerateController extends Controller
{
    // Main View
    public function index(Request $request)
    {
      $productos = DB::table('productos_imagenes')->where('img','not like','%large%')->count();
      $data = ['productos'=>$productos];
      return view('admin.modules.Thumbnails.index',$data);
    }
    // Regenerate
    public function regenerate(Request $req)
    {
      $productos = DB::table('productos_imagenes')->get();
      $updated=0; $errors=0;
      foreach ($productos as $key => $value) {
        // code...
        if(strpos($value->img, 'large') == false){
          // if not exits create and then delete de old file
          $file = Storage::disk('public')->get($value->img);
          $separate = explode('/', $value->img); $path= '/'.$separate[0].'/'; $fullname = $separate[1];
          $path2db = $separate[0].'/'.'large/';
          //$original_photo_storage = $path.'original/';
          $large_photos_storage = $path.'large/';
          $medium_photos_storage = $path.'medium/';
          $mobile_photos_storage = $path.'mobile/';
          $img = Image::make($file)->encode();
          /* put file */
          /* 626 , 300, 150 */
          //$image = Storage::disk('public')->put($original_photo_storage.$fullname, $img); // Save Original
          $img->resize(626, null, function ($constraint) {$constraint->aspectRatio();})->encode();
          $image = Storage::disk('public')->put($large_photos_storage.$fullname, $img); // Save Large
          $img->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->encode();
          $image = Storage::disk('public')->put($medium_photos_storage.$fullname, $img); // Save Medium
          $img->resize(150, null, function ($constraint) {$constraint->aspectRatio();})->encode();
          $image = Storage::disk('public')->put($mobile_photos_storage.$fullname, $img); // Save Mobile
          // update folder
          $update = DB::table('productos_imagenes')
                  ->where('ProductosID','=',$value->ProductosID)
                  ->update(['img'=>$path2db.$fullname,'updated_at'=>now()]);
         // delete old version
         $del = Storage::disk('public')->delete($value->img); // original
         if( $del ) {
           $updated++;
         } else {
           $errors++;
         }
        }
      }
      return (['tipo' => 'success', 'mensaje'=>'Actualizados '.$updated.' errores '.$errors]);
    }
    // Read
    public function read(Request $req)
    {
      $productos = DB::table('productos_imagenes')->where('img','not like','%large%')->count();
      return (['tipo' => 'success', 'productos'=>$productos]);
    }
}

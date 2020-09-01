<?php

namespace App\Http\Controllers\Ui;

use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{

    public function index(Request $request)
    {
      return view('ui.tienda.carrito');
    }
    /* Add to Cart */
    public function create(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->id);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      $id = $decrypted+3301;
      // Find Product
      $product = DB::table('productos as p')
            ->leftjoin('productos_imagenes as pi','pi.ImagenesPID','=','p.Featured')
            ->where('p.ProductosID','=',$decrypted)
            ->select('p.ProductosID as keygen','p.ProductosNombre','p.PrecioUnitario','pi.img','p.Cantidad','p.Unidad')
            ->first();
      if(!$product) {
            abort(404);
        }
        $price = $product->PrecioUnitario*2; $unidad = $product->Cantidad.' '.$product->Unidad;
        $cart = session()->get('cart');
        $keygen = encrypt($product->keygen);
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $req->quantity;
            session()->put('cart', $cart);
            return (['tipo' => 'success', 'mensaje' => 'Product added to cart successfully!','cart'=>$cart,'id'=>$id]);
        }
        // if item not exist in cart then add to cart with quantity required
        $cart[$id] = [
            "name" => $product->ProductosNombre,
            "quantity" => $req->quantity,
            "price" => $price,
            "photo" => $product->img,
            "keygen" => $keygen,
            "unidad"=>$unidad
        ];
        session()->put('cart', $cart);
        return (['tipo' => 'success', 'mensaje' => 'Product added to cart successfully!','cart'=>$cart,'id'=>$id]);
    }
    /* Get Cart Number */
    public function read()
    {
      //session()->forget('cart');
      $cart = session()->get('cart');
      return (['tipo' => 'success', 'mensaje' => 'Product readed','cart'=>$cart]);
    }
    // update item
    public function update(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->key);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      //
      $cart = session()->get('cart');
      if(isset($cart[$req->id])) {
          $cart[$req->id]['quantity'] = $req->quantity;
          session()->put('cart', $cart);
          return (['tipo' => 'success', 'mensaje' => 'Product updated from cart successfully!','cart'=>$cart]);
      }
    }
    // delete item
    public function delete(Request $req)
    {
      // decrypt
      try {
          $decrypted = decrypt($req->key);
      } catch (DecryptException $e) {
          //
          return (['tipo' => 'error', 'mensaje' => $e]);
      }
      //
      $cart = session()->get('cart');
      if(isset($cart[$req->id])) {
          unset($cart[$req->id]);
          session()->put('cart', $cart);
          return (['tipo' => 'success', 'mensaje' => 'Product deleted from cart successfully!','cart'=>$cart]);
      }
    }
}

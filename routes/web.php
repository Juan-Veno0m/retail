<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes...
Auth::routes(['verify' => true]);
// UI Store
Route::get('/', 'Ui\StoreController@index');
Route::get('/contacto', function () {return view('ui.tienda.contact');});
Route::get('/producto/{ProductosNombre}/{ProductosID}', 'Ui\StoreController@Producto');
Route::get('/tienda','Ui\StoreController@Tienda');
Route::post('/email/contacto','Ui\StoreController@Contacto');
/* Cart Routes */
Route::prefix('carrito')->group(function () {
  Route::get('/','Ui\CartController@index');
  Route::post('create','Ui\CartController@create');
  Route::get('read','Ui\CartController@read');
  Route::post('update','Ui\CartController@update');
  Route::post('delete','Ui\CartController@delete');
});
/* fix email address */
Route::post('/email/fix','Auth\VerificationController@fix');
/* Auth views user */
Route::middleware(['auth','verified'])->group(function () {
  // checkout
  Route::prefix('checkout')->group(function () {
    Route::get('/','Ui\CheckoutController@index');
    Route::post('/store','Ui\CheckoutController@store');
  });
  // shipping
  Route::prefix('shipping')->group(function () {
    Route::get('/','Ui\ShippingController@shipping');
    Route::post('/shipping_action','Ui\ShippingController@shipping_action');
  });
  /* Mi Perfil */
  Route::prefix('Cuenta')->group(function(){
    Route::get('/','Ui\MiCuentaController@index');
    // Mis Pedidos
    Route::prefix('MisPedidos')->group(function () {
      Route::get('/','Ui\OrdersController@index');
      Route::get('/{NOrden}','Ui\OrdersController@detalles');
    });
  });
});
// # Admin Views
Route::middleware(['auth','role.admin'])->group(function () {
  Route::get('/dashboard', 'HomeController@index')->name('home');
  //* Productos */
  Route::prefix('productos')->group(function () {
    Route::get('index', 'Admin\ProductController@index');
    Route::post('create','Admin\ProductController@create');
    Route::post('read','Admin\ProductController@read');
    Route::post('update','Admin\ProductController@update');
    // Imagenes de Productos
    Route::prefix('images')->group(function () {
      Route::post('read','Admin\ProductImagesController@read');
      Route::post('create','Admin\ProductImagesController@create');
      Route::post('delete','Admin\ProductImagesController@delete');
      Route::post('featured','Admin\ProductImagesController@featured');
    });
    //* Proveedores */
    Route::prefix('proveedores')->group(function () {
      Route::get('/', 'Admin\ProveedoresController@index');
      Route::post('create','Admin\ProveedoresController@create');
      Route::post('read','Admin\ProveedoresController@read');
      Route::post('update','Admin\ProveedoresController@update');
      Route::post('delete','Admin\ProveedoresController@delete');
      //
    });
  });
  //* Ordenes */
  Route::prefix('ordenes')->group(function () {
    // * Pedidos */
    Route::prefix('pedidos')->group(function () {
      Route::get('/', 'Admin\PedidosController@index');
      Route::get('/{NOrden}','Admin\PedidosController@read');
    });
    //
  });
  // Regenerar Miniaturas
  Route::prefix('thumbnails')->group(function () {
    Route::get('/', 'Admin\RegenerateController@index');
    Route::get('/read', 'Admin\RegenerateController@read');
    Route::get('/regenerate', 'Admin\RegenerateController@regenerate');
  });
});

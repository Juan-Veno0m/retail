<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes...
Auth::routes(['verify' => true]);
Route::post('/AjaxLogin','Auth\LoginController@AjaxLogin'); // login customers
Route::get('/Acceso-303','Auth\LoginController@AdminLogin'); // Admin Login
Route::get('/registro', function () {return view('ui.tienda.registro');}); // Solicitud de registro
// # Admin Views
Route::middleware(['auth','role.admin'])->group(function () {
  Route::get('/dashboard', 'HomeController@index')->name('home');
  //* Productos */
  Route::prefix('productos')->group(function () {
    Route::get('/', 'Admin\ProductController@index');
    Route::post('create','Admin\ProductController@create');
    Route::post('read','Admin\ProductController@read');
    Route::post('update','Admin\ProductController@update');
    Route::post('delete','Admin\ProductController@delete');
    Route::post('stock','Admin\ProductController@stock');
    Route::post('localidades','Admin\ProductController@localidades');
    Route::post('localidadesTx','Admin\ProductController@localidadesTx');
    Route::post('descontinuado','Admin\ProductController@descontinuado');
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
      Route::post('/historialpagos','Admin\PedidosController@historialpagos');
      Route::post('/actionpagos','Admin\PedidosController@actionpagos');
      Route::get('/ticket/{NOrden}','Admin\PedidosController@ticketPDF');
      Route::post('/status','Admin\PedidosController@status');
    });
    //
  });
  // Regenerar Miniaturas
  Route::prefix('thumbnails')->group(function () {
    Route::get('/', 'Admin\RegenerateController@index');
    Route::get('/read', 'Admin\RegenerateController@read');
    Route::get('/regenerate', 'Admin\RegenerateController@regenerate');
  });
  // Localidades
  Route::prefix('localidades')->group(function(){
    Route::get('/', 'Admin\LocalidadesController@index');
  });
  // Asociados
  Route::prefix('asociados')->group(function () {
    Route::get('/', 'Admin\AsociadosController@index');
    Route::post('/acceso', 'Admin\AsociadosController@acceso');
    Route::post('/acceso_tx', 'Admin\AsociadosController@acceso_tx');
    Route::post('/action','Admin\AsociadosController@action');
    Route::post('/detalles','Admin\AsociadosController@detalles');
    Route::post('/redtx','Admin\AsociadosController@redtx');
  });
  // Inventarios
  Route::prefix('inventarios')->group(function () {
    Route::get('/', 'Admin\InventariosController@index');
    Route::prefix('compras')->group(function () {
      Route::post('/historialpagos','Admin\InventariosController@historialpagos');
      Route::post('/actionpagos','Admin\InventariosController@actionpagos');
      Route::post('/details','Admin\InventariosController@details');
      Route::post('/comentarios','Admin\InventariosController@comentarios');
      Route::post('/actionenvios','Admin\InventariosController@actionenvios');
      Route::get('/orden/{NOrden}','Admin\InventariosController@orden');
    });
    // generar compra
    Route::get('/generar', 'Admin\InventariosController@generar');
    Route::post('/productos', 'Admin\InventariosController@productos');
    Route::post('/create','Admin\InventariosController@create');
  });
});
/* Sitemap Routes*/
Route::get('/sitemap.xml', 'Ui\SitemapController@index')->name('sitemap.xml');
Route::get('/sitemap.xml/productos', 'Ui\SitemapController@productos');
Route::get('/sitemap.xml/categorias', 'Ui\SitemapController@categorias');
Route::get('/sitemap.xml/paginas', 'Ui\SitemapController@paginas');
//Route::get('/sitemap.xml/subcategory', 'Ui\SitemapController@subcategories');
/* Cart Routes */
Route::prefix('carrito')->group(function () {
  Route::get('/','Ui\CartController@index');
  Route::post('create','Ui\CartController@create');
  //Route::get('read','Ui\CartController@read');
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
// UI Store
Route::get('/', 'Ui\StoreController@index');
/* info */
Route::get('/contacto', function () {return view('ui.tienda.contact');});
Route::get('/acerca', function () {return view('ui.tienda.Acerca');});
Route::get('/politica-de-privacidad', function () {return view('ui.tienda.Privacidad');});
Route::get('/politicas-de-compra', function () {return view('ui.tienda.Politicas');});
Route::get('/cambios-y-devoluciones', function () {return view('ui.tienda.Cambios');});
Route::get('/contrato', function () {return view('ui.tienda.Contrato');});
/// /// // ---
Route::get('/producto/{ProductosNombre}/{ProductosID}', 'Ui\StoreController@Producto');
Route::get('/{CategoriaNombre}/{CategoriaID}', 'Ui\StoreController@Categorias');
Route::get('/tienda','Ui\StoreController@Tienda');
Route::post('/email/contacto','Ui\StoreController@Contacto');
Route::post('/Suggestions','Ui\StoreController@Suggestions');
Route::get('/buscar','Ui\StoreController@buscar');

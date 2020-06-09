<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Public Routes */
Route::get('/', function () {
    return view('ui.tienda.index');
});
Route::get('/contacto', function () {
    return view('ui.tienda.contact');
});
// Auth Routes --
Auth::routes(['verify' => true]);

// # Admin Views
Route::middleware(['auth','role.admin'])->group(function () {
  Route::get('/dashboard', 'HomeController@index')->name('home');
  //* Productos */
  Route::prefix('productos')->group(function () {
    Route::get('index', 'Admin\ProductController@index');
    Route::post('create','Admin\ProductController@create');
    Route::post('read','Admin\ProductController@read');
    Route::post('update','Admin\ProductController@update');
  });
});

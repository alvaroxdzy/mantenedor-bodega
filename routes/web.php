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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bodegas', 'BodegaController@consulta')->name('bodegas');
Route::get('/busqueda-bodegas','BodegaController@search')->name('bodega.search');
Route::get('/crear-bodega','BodegaController@create')->name('bodega.create');
Route::get('/almacenar-bodega','BodegaController@store')->name('bodega.store');
Route::get('/modificar-bodega/{id}','BodegaController@edit')->name('bodega.edit');
Route::get('/actualizar-bodega','BodegaController@update')->name('bodega.update');

Route::get('/productos', 'ProductoController@consultaProductos')->name('productos');
Route::get('crear-producto','ProductoController@create')->name('producto.create') ;
Route::get('/almacenar-producto','ProductoController@store')->name('producto.store');

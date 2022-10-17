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

//RUTAS PARA BODEGAS
Route::get('/bodegas', 'BodegaController@consulta')->name('bodegas');
Route::get('/busqueda-bodegas','BodegaController@search')->name('bodega.search');
Route::get('/crear-bodega','BodegaController@create')->name('bodega.create');
Route::get('/almacenar-bodega','BodegaController@store')->name('bodega.store');
Route::get('/modificar-bodega/{id}','BodegaController@edit')->name('bodega.edit');
Route::get('/actualizar-bodega','BodegaController@update')->name('bodega.update');

//RUTAS PARA PRODUCTOS
Route::get('/productos', 'ProductoController@consultaProductos')->name('productos');
Route::get('crear-producto','ProductoController@create')->name('producto.create') ;
Route::get('/almacenar-producto','ProductoController@store')->name('producto.store');
Route::get('/busqueda-productos','ProductoController@search')->name('producto.search');
Route::get('/modificar-producto/{id}','ProductoController@edit')->name('producto.edit');
Route::get('/actualizar-producto','ProductoController@update')->name('producto.update');
Route::get('/eliminar-producto/{id}','ProductoController@destroy')->name('producto.destroy');
Route::get('/stock-productos','ProductoController@inventario')->name('producto.inventario');
Route::get('/filtrar-productos','ProductoController@filtrarInventario')->name('producto.filtrarInventario');
Route::get('/historial-producto/{cod_producto}','ProductoController@productoHistorial')->name('producto.historial');

//RUTAS PARA PROVEEDORES
Route::get('/proveedores', 'ProveedorController@consultaProveedor')->name('proveedores');
Route::get('crear-proveedor','ProveedorController@create')->name('proveedor.create') ;
Route::get('/almacenar-proveedor','ProveedorController@store')->name('proveedor.store');
Route::get('/busqueda-proveedores','ProveedorController@search')->name('proveedor.search');
Route::get('/modificar-proveedor/{id}','ProveedorController@edit')->name('proveedor.edit');
Route::get('/actualizar-proveedor','ProveedorController@update')->name('proveedor.update');
Route::get('/eliminar-proveedor/{id}','ProveedorController@destroy')->name('proveedor.destroy');

//Route::get('/modal', 'ProveedorController@modal')->name('proveedores');

//RUTAS PARA MOVIMIENTOS
Route::get('crear-movimiento','MovimientoController@create')->name('movimiento.create') ;
Route::get('productos-movimiento/{id}','MovimientoController@traerProducto')->name('movimiento.traer_producto') ;
Route::get('stock-movimiento/{cod_producto}','MovimientoController@traerStock')->name('movimiento.traer_stock') ;
Route::get('/almacenar-movimiento','MovimientoController@store')->name('movimiento.store');
Route::get('salida-movimiento','MovimientoController@salida')->name('movimiento.salida') ;
Route::get('producto-bodega/{cod_bodega}','MovimientoController@productosBodega')->name('producto.bodega');
Route::get('/busqueda-movimiento','MovimientoController@buscarMovimiento')->name('movimiento.buscarMovimiento');
Route::get('/detalle-movimiento/{num_documento}','MovimientoController@cargarDetalleMovimiento')->name('movimiento.cargarDetalleMovimiento');


//RUTAS PARA EMPLEADOS
Route::get('/busqueda-empleado','EmpleadoController@search')->name('empleado.search');
Route::get('/crear-empleado','EmpleadoController@create')->name('empleado.create');
Route::get('/almacenar-empleado','EmpleadoController@store')->name('empleado.store');
Route::get('/modificar-empleado/{id}','EmpleadoController@edit')->name('empleado.edit');
Route::get('/actualizar-empleado','EmpleadoController@update')->name('empleado.update');
Route::get('/inventario-empleados','EmpleadoController@inventarioEmpleados')->name('empleado.inventarioEmpleados');
Route::get('/filtrar-empleados','EmpleadoController@filtrarInventario')->name('empleado.filtrarInventario');
Route::get('/historial-empleado/{rut}','EmpleadoController@productoHistorial')->name('producto.historial');

//RUTAS PARA REPORTES
Route::get('historial-producto-pdf/{cod_producto}','ProductoController@productoMovimientoPDF')->name('producto.pdf');
Route::get('stock-producto-pdf/{cod_bodega}','ProductoController@InventarioBodegaPDF')->name('producto.pdf');
Route::get('inventario-empleado-pdf/{cod_bodega}','EmpleadoController@InventarioBodegaPDF')->name('empleado.pdf');
Route::get('historial-empleado-pdf/{rut}','EmpleadoController@empleadoMovimientoPDF')->name('producto.pdf');


//RUTAS PARA ORDENES DE TRABAJO
Route::get('/crear-orden','OrdenTrabajoController@create')->name('orden.create');
Route::get('/traer-vehiculo/{patente}','OrdenTrabajoController@traerVehiculo')->name('orden.traerVehiculo');
Route::get('/traer-empleados','OrdenTrabajoController@traerEmpleados')->name('orden.traerEmpleados');
Route::get('traer-empleado/{nombres}','OrdenTrabajoController@traerDetalleEmpleado')->name('orden.traerDetallEmpleado') ;
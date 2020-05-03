<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*CLIENTES*/
Route::get('/cliente-nuevo', 'ClientesController@new')->name('client.new');
Route::post('/cliente-create', 'ClientesController@create')->name('client.create');
Route::get('/ver-cliente/{id}', 'ClientesController@view')->name('client.view');
Route::get('/editar-cliente/{id}', 'ClientesController@edit')->name('client.edit');
Route::post('/update-cliente', 'ClientesController@update')->name('client.apdate');

/*FACTURAS*/
Route::get('/compras/{id}', 'FacturasController@index')->name('compra.index');
Route::post('/compras/registrar', 'FacturasController@register')->name('compra.register');
Route::post('/compras/prenda', 'FacturasController@prenda')->name('compra.prenda');
Route::get('/compras/boleta/{id}', 'FacturasController@boleta')->name('compra.boleta');
Route::post('/compras/edit-prenda', 'FacturasController@editarPrenda')->name('compra.editPrenda');
Route::post('/compras/eliminar-prenda', 'FacturasController@deletePrenda')->name('compra.eliminarPrenda');

/*PAGOS*/
Route::get('/pagos/{id}', 'PagosController@index')->name('pago.index');
Route::post('/pagos/registrar', 'PagosController@register')->name('pago.register');
Route::post('/pagos/edit-pago', 'PagosController@editarPago')->name('compra.editPago');
Route::post('/pagos/eliminar-pago', 'PagosController@deletePago')->name('pago.delete');


/*REPORTES*/
Route::get('/imprimir', 'ReportesController@imprimir')->name('print');
Route::get('/imprimir-boleta/{id}', 'ReportesController@boleta')->name('pdf.boleta');
Route::get('/imprimir-pago/{id}', 'ReportesController@pago')->name('pdf.pago');



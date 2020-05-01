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

/*FACTURAS*/
Route::get('/compras/{id}', 'FacturasController@index')->name('compra.index');
Route::post('/compras/registrar', 'FacturasController@register')->name('compra.register');
Route::post('/compras/prenda', 'FacturasController@prenda')->name('compra.prenda');
Route::get('/compras/boleta/{id}', 'FacturasController@boleta')->name('compra.boleta');
Route::post('/compras/edit-prenda', 'FacturasController@editarPrenda')->name('compra.editPrenda');
Route::post('/compras/eliminar-prenda', 'FacturasController@deletePrenda')->name('compra.eliminarPrenda');


/*REPORTES*/
Route::get('/imprimir', 'ReportesController@imprimir')->name('print');
Route::get('/imprimir-boleta/{id}', 'ReportesController@boleta')->name('pdf.boleta');



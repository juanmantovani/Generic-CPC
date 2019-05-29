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

/*
Route::get('/administracion', function () {
    return view('welcome');
})->name('home');*/


//Rutas con middleware de autentificacion
Route::group(['middleware' => 'auth'], function () {
	Route::resource('/administracion/productos', 'ProductoController');
	Route::resource('/administracion/categorias', 'CategoriaController');

	//Home del reporte
	Route::get('/administracion/reportes','ReporteController@index');
	Route::post('/administracion/reportes/get_vencidos','ReporteController@get_vencidos')->name('get_vencidos');
	Route::get('stock/chart/vencimientos','ReporteController@chart')->name('vencimientos_chart');
	Route::post('/administracion/productos/bajas','ProductoController@bajas')->name('bajas');

});

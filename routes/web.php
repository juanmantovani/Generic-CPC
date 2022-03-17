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

    return view('vendor.adminlte.home');
})->middleware('auth');

/*
Route::get('/administracion', function () {
    return view('welcome');
})->name('home');*/


//		   Route::auth();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Rutas con middleware de autentificacion
Route::group(['middleware' => 'auth'], function () {


    Route::get('/administracion', 'HomeController@index')->name('home');


	//No se usa todo el controller de User, solo perfil...
	Route::get('/administracion/user/profile/{id}', 'UserController@perfil');
    Route::put('/administracion/user/profile/{id}', 'UserController@update2');

    //ABM de productos y categorias
	Route::resource('/administracion/productos', 'ProductoController');
	Route::resource('/administracion/categorias', 'CategoriaController');
	Route::post('/administracion/categorias/store_modal', 'CategoriaController@store_ajax_modal')->name('store_ajax_modal');

	//Home del reporte
	Route::get('/administracion/reportes','ReporteController@index');
	Route::post('/administracion/reportes/get_vencidos','ReporteController@get_vencidos')->name('get_vencidos');
	//grafico "chart"
	Route::get('/stock/chart_vencimientos','ReporteController@chart')->name('vencimientos_chart');
	//Baja de los productos desde el reporte generado (panel reporte)
	Route::post('/administracion/productos/bajas','ProductoController@bajas')->name('bajas');
	//Consulta de stock por vencimiento (desde panel reporte)
	Route::get('/stock/detalle_vencimientos','ReporteController@detalle_proximos_vto')->name('detalle_proximos_vto');
	//Datatables listado producto (index)
	Route::post('/administracion/productos/listado', 'ProductoController@todos_los_productos')->name('todos_los_productos');
	//Datatables listado categorias (index)
	Route::post('/administracion/categorias/listado', 'CategoriaController@todas_las_categorias')->name('todas_las_categorias');

	//AMB de clientes
	Route::resource('/administracion/clientes', 'ClienteController');

	//Datatables listado clientes (index)
	Route::post('/administracion/clientes/listado', 'ClienteController@todos_los_clientes')->name('todos_los_clientes');

	//Agregar ciudad
	Route::post('/administracion/ciudades/store_modal', 'CiudadesController@store_ajax_modal_ciudad')->name('store_ajax_modal_ciudad');

});

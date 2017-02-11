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
/*
Route::get('/', function () {
    return view('login');
});
*/
//Route::get('dashboard', 'EstadoController@dashboard');

//-- Autenticacao --//
Auth::routes();
Route::get('/', 'HomeController@index');

//-- Estados --//
Route::get('estado', 'EstadoController@index');
Route::post('estado', 'EstadoController@store');
Route::get('estado/view', 'EstadoController@view');
Route::post('estado/update', 'EstadoController@update');
Route::post('estado/delete', 'EstadoController@destroy');

//-- Usuarios --//
Route::get('usuario', 'UsuarioController@index');
Route::post('usuario/register', 'UsuarioController@store');
Route::post('usuario/delete', 'UsuarioController@destroy');
Route::get('usuario/view', 'UsuarioController@view');
Route::post('usuario/update', 'UsuarioController@update');

//-- ERROS --//
Route::get('404',  function (){return view('errors/404');});
Route::get('503',  function (){return view('errors/503');});

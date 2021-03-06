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
/*
Route::get('/', function () {
    return view('layout');
});
*/
Route::get('/', 'HomepageController@index')->name('homepage');
//Teste Route::get('/teste', 'HomepageController@index')->name('teste')->middleware('auth');

//users
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}', 'UserController@update')->name('users.update');
Route::get('/perfil/edit','UserController@perfil')->name('perfil')->middleware('auth');
Route::put('/perfil/{user}','UserController@update_perfil')->name('perfil.update');
Route::delete('perfil/{user}/foto', 'UserController@destroy_foto')->name('perfil.foto.destroy');

//alterar password
Route::get('/password', 'UserController@alterarPassword')->name('perfil.password');
Route::put('/password','UserController@updatePassword')->name('password.alterar');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//Movimentos
//Route::get('/movimentos', 'MovimentoController@index')->name('movimentos')->middleware('auth');
Route::get('/contas/{conta}/movimentos/create', 'MovimentoController@create')->name('movimentos.create');
Route::get('/contas/movimentos/{movimento}/edit', 'MovimentoController@edit')->name('movimentos.edit');
Route::put('/contas/movimentos/{movimento}', 'MovimentoController@update')->name('movimentos.update');
Route::post('/contas/{conta}/movimentos', 'MovimentoController@store')->name('movimentos.store');
Route::get('/movimentos/{movimento}/doc', 'MovimentoController@displayDoc')->name('movimentos.doc');
Route::delete('contas/movimentos/{movimento}', 'MovimentoController@destroy')->name('movimentos.destroy');
Route::delete('contas/movimentos/{movimento}/foto', 'MovimentoController@destroy_doc')->name('movimentos.doc.destroy');


//Contas
Route::get('/contas','ContaController@index')->name('contas')->middleware('auth');
Route::get('/contas/create', 'ContaController@create')->name('contas.create');
Route::post('/contas', 'ContaController@store')->name('contas.store');
Route::get('/contas/{conta}/edit', 'ContaController@edit')->name('contas.edit');
Route::put('contas/{conta}', 'ContaController@update')->name('contas.update');
Route::delete('contas/{conta}', 'ContaController@destroy')->name('contas.destroy');
Route::get('/contas/{conta}/info', 'ContaController@info')->name('contas.info');




//Estatisticas
Route::get('/estatistica', 'EstatisticaController@index')->name('estatistica')->middleware('auth');


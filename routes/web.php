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
Route::get('/perfil','UserController@perfil')->name('perfil')->middleware('auth');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/movimentos', 'MovimentoController@index')->name('movimentos')->middleware('auth');


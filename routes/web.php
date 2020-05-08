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
Route::get('/', 'HomepageController@index')->name('home');
//Teste Route::get('/teste', 'HomepageController@index')->name('teste')->middleware('auth');
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('child');
});

Auth::routes();

Route::get('/home', 'TaskController@index')->name('home');
Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login/custom', 'LoginController@checkLogin')->name('login.custom');
Route::post('saveTask', 'TaskController@saveTask')->name('saveTask');
Route::post('editTask', 'TaskController@editTask')->name('editTask');
Route::get('deleteTask', 'TaskController@deleteTask')->name('deleteTask');

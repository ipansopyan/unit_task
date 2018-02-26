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

Route::get('tasks','TaskController@index')->name('tasks');
Route::post('tasks','TaskController@store')->name('tasks');
Route::post('tasks/{id}','TaskController@update');
Route::delete('tasks/{task}','TaskController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

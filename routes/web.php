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

Route::get('/', 'HomeController@index')->name('login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create');
Route::post('/store', 'HomeController@store')->name('store');
Route::get('/edit/{id?}', 'HomeController@edit')->name('edit');
Route::get('/update', 'HomeController@update')->name('update');
Route::post('/update', 'HomeController@update')->name('update');
Route::post('/destroy', 'HomeController@destroy')->name('destroy');
Route::post('/complete', 'HomeController@complete')->name('complete');
Route::get('/test', 'HomeController@test')->name('test');

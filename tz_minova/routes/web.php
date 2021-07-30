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

Route::get('/','\App\Http\Controllers\ProductController@index')->name('index');
Route::get('/{id}','\App\Http\Controllers\ProductController@show')->name('show')->where('id', '[0-9]+');
Route::get('/edit','\App\Http\Controllers\ProductController@create')->name('create');
Route::post('/{product}','\App\Http\Controllers\ProductController@store')->name('store');
Route::get('/edit/{product}','\App\Http\Controllers\ProductController@edit')->name('edit');
Route::post('/edit/{product}','\App\Http\Controllers\ProductController@update')->name('update');
Route::delete('/delete/{product}','\App\Http\Controllers\ProductController@destroy')->name('delete');

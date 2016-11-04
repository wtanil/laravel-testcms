<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Category;
use Illuminate\Http\Request;


Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');


/**
 * Category Route
 */

Route::get('/category', 'CategoryController@index');
Route::get('/category/create', 'CategoryController@create');
Route::post('/category', 'CategoryController@store');
Route::get('/category/{slug}', 'CategoryController@show');
Route::get('/category/{slug}/edit', 'CategoryController@edit');
Route::put('/category/{slug}', 'CategoryController@update');
Route::delete('/category/{slug}', 'CategoryController@destroy');

/**
 * Product Route
 */

Route::get('/product', 'ProductController@index');
Route::get('/product/create', 'ProductController@create');
Route::post('/product', 'ProductController@store');
Route::get('/product/{id}', 'ProductController@show');
Route::get('/product/{id}/edit', 'ProductController@edit');
Route::put('/product/{id}', 'ProductController@update');
Route::delete('/product/{id}', 'ProductController@destroy');


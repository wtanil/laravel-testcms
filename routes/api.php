<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/v1/products', 'ProductApiController@index');
// curl -d 'product_name=productapitest11&product_description=description&product_category=1&user_id=1' localhost:8888/api/v1/products
Route::post('/v1/products', 'ProductApiController@store');
Route::get('/v1/products/{id}', 'ProductApiController@show');
// curl -X PUT -d 'product_name=productapitest11asd&product_description=newdescription&product_category=3&user_id=1' localhost:8888/api/v1/products/11
Route::put('/v1/products/{id}', 'ProductApiController@update');
Route::delete('/v1/products/{id}', 'ProductApiController@destroy');

Route::get('/v1/categories', 'CategoryApiController@index');
Route::post('/v1/categories', 'CategoryApiController@store');
Route::get('/v1/categories/{id}', 'CategoryApiController@show');
Route::put('/v1/categories/{id}', 'CategoryApiController@update');
Route::delete('/v1/categories/{id}', 'CategoryApiController@destroy');

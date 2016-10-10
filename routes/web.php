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

// Route::resource('categories', 'CategoryController');

// Route::get('/category', 'CategoryController@index');

// Route::get('/category', function () {
//     return view('category');
// });

/**
 * Add A New Category
 */

// Route::get('/category/create', 'CategoryController@create');
// Route::post('/category/create', 'CategoryController@store');

// Route::post('/category/add', function (Request $request) {

//     $validator = Validator::make($request->all(), [
//         'category_name' => 'required|max:255',
//         'category_description' => 'max:1000'
//     ]);

//     if ($validator->fails()) {
//         return redirect('/category')
//             ->withInput()
//             ->withErrors($validator);
//     }

//     $category = new Category;
//     $category->category_name = $request->category_name;
//     $category->category_description = $request->category_description;

//     $category->save();

//     return redirect('/category');
// });









































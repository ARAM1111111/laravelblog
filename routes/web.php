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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','IndexController@execute');
Auth::routes();

Route::get('/home','HomeController@index')->name('home');
Route::get('/show/{id}','HomeController@show')->name('show');
Route::post('/addcateg','CategoryController@add')->name('addcateg');
Route::resource('category','CategoryController');
Route::resource('posts','PostController');

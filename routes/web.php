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

Auth::routes();
Route::get('/', 'HomeController@execute');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show/{id}', 'HomeController@show')->name('show');
Route::resource('category', 'CategoryController');
Route::resource('posts', 'PostController');
Route::get('login/facebook', 'FacebookController@redirectToProvider')->name('facebook.login');
Route::get('login/facebook/callback', 'FacebookController@handleProviderCallback');


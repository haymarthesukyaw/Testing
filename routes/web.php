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
    return view('auth.login');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts','Post\PostController@index');

Route::get('/post/create','Post\PostController@createForm');
Route::post('/post/create','Post\PostController@create');
// Route::post('/post/create','Post\PostController@store');
Route::get('/post/edit','Post\PostController@editForm');
Route::post('/post/edit','Post\PostController@edit');

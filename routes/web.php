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
// Route::resource('/posts','Post\PostController');

// Route::get('/posts','Post\PostController@index')->name('posts.index');
// Route::get('/post/create','Post\PostController@createForm');
// Route::post('/post/create','Post\PostController@create');
// // Route::post('/post/create','Post\PostController@store');
// Route::get('/post/edit','Post\PostController@editForm');
// Route::post('/post/edit','Post\PostController@edit');
Route::get('/posts','Post\PostController@index')->name('posts.index');

Route::get('/post/create','Post\PostController@createForm');
Route::put('/post/create','Post\PostController@create')->name('posts.create');
Route::post('/post/create','Post\PostController@store');

// Route::resource('/post','Post\PostController@edit');
Route::get('/post/{id}','Post\PostController@edit');
Route::put('/post/{id}', 'Post\PostController@editConfirm')->name('posts.edit');
Route::post('/post/{id}','Post\PostController@update');


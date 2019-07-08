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

//Post List
Route::get('/posts','Post\PostController@index')->name('posts.index');
//Post Create
Route::get('/post/create','Post\PostController@createForm');
Route::put('/post/create','Post\PostController@create')->name('posts.create');
Route::post('/post/create','Post\PostController@store');
//Post Update
Route::get('/post/{id}','Post\PostController@edit');
Route::put('/post/{id}', 'Post\PostController@editConfirm')->name('posts.edit');
Route::post('/post/{id}','Post\PostController@update');

//User
Route::get('/users','User\UserController@index')->name('users.index');
//User Create
Route::get('/user/create','User\UserController@createForm');
Route::put('/user/create','User\UserController@create');
Route::post('/user/create','User\UserController@store');
//User Update
Route::get('/user/{id}','User\UserController@edit');
Route::put('/user/{id}','User\UserController@editConfirm');
Route::post('/user/{id}','User\UserController@update');

Route::get('/changePwd/{id}','User\UserController@changePwdForm')->name('users.pwd');
Route::post('/changePwd/{id}','User\UserController@changePwd');

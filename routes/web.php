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
// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/login', 'User\UserController@login')->name('login');
Route::get('/user/logout','User\UserController@logout');

//Post List
Route::get('/posts','Post\PostController@index')->name('posts.index');
//Post Create
Route::get('/post/create','Post\PostController@createForm');
Route::put('/post/create','Post\PostController@create')->name('posts.create');
Route::post('/post/create','Post\PostController@store');
//Post Update
Route::get('/post/{id}','Post\PostController@edit');
Route::put('/post/{id}', 'Post\PostController@editConfirm')->name('posts.edit');
Route::post('/post/{id}','Post\PostController@update')->name('posts.update');

//Post Search
Route::get('/posts/search', 'Post\PostController@search');

//Post Delete
Route::delete('/post/{id}', 'Post\PostController@destroy');

//Export Excel
Route::get('/download','Post\PostController@export');

//Import Excel
Route::get('/csv/upload', 'Post\PostController@showUploadForm');
Route::post('/csv/upload', 'Post\PostController@import');

//Show Post Detail Modal
Route::post('/showPost', 'Post\PostController@show');

//User
Route::get('/users','User\UserController@index')->name('index');
//User Create
Route::get('/user/create','User\UserController@createForm');
Route::put('/user/create','User\UserController@create');
Route::post('/user/create','User\UserController@store');
//User Update
Route::get('/user/{id}','User\UserController@edit')->name('edit');
Route::put('/user/{id}','User\UserController@editConfirm');
Route::post('/user/{id}','User\UserController@update');

//Change Password
Route::get('/changePwd/{id}','User\UserController@changePwdForm')->name('password');
Route::post('/changePwd/{id}','User\UserController@changePassword');

//Show User Profile
Route::get('/profile/{id}', 'User\UserController@showProfile')->name('profile');

//User Delete
Route::delete('/user/{id}', 'User\UserController@destroy');

//User Search
Route::post('/search','User\UserController@search')->name('search');

//User Detail Modal
Route::post('/showUser','User\UserController@show');

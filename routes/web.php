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

Route::get('/', 'HomeController@index');

Route::resource('posts', 'PostsController');

Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::get('/comments/{comment}/edit', 'CommentsController@edit');
Route::patch('/comments/{comment}/like', 'CommentsController@like');
Route::patch('/comments/{comment}/unlike', 'CommentsController@unlike');
Route::patch('/comments/{comment}', 'CommentsController@update');
Route::delete('/comments/{comment}', 'CommentsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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


// Practice routes start
Route::get('/hello', function () {
    return 'Hello nigga';
});
Route::get('/user/{userid}', function ($id) {
	return 'Your id is '.$id;
});
Route::get('/user/{userid}/{username}', function ($id,$usrname) {
	return 'Your id is '.$id.' Your username is '.$usrname;
});
// Practice routes end

// App routes start
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
// Shortcut route for all the resource methods
Route::resource('posts','PostsController');
// App routes end
Route::resource('users','UsersController');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

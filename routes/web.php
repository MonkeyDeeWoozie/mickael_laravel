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
Route::auth();

Auth::routes();

Route::resource('user', 'UserController');

Route::resource('project', 'ProjectController');

Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'home']);

Route::get('/home', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index');

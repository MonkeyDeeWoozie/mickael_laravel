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

Route::resource('user', 'UserController');

Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'home']);

Route::get('{n}', function($n) { 
    return response('Je suis la page ' . $n . ' !', 200);
})->where('n', '[1-7]');

Route::get('article/{n}', 'ArticleController@show')->where('n', '[0-9]+');

// Route::get('article/{n}', function($n) { 
    // return view('article')->with('numero', $n);
    // return view('article')->withNumero($n); 
// })->where('n', '[0-9]+');

Route::get('facture/{n}', function($n) { 
    return view('facture')->withNumero($n);
})->where('n', '[0-9]+');

Route::get('contact', 'ContactController@getForm');

Route::post('contact', 'ContactController@postForm');

Route::get('photo', 'PhotoController@getForm');

Route::post('photo', 'PhotoController@postForm');

Route::get('email', 'EmailController@getForm');

Route::post('email', ['uses' => 'EmailController@postForm', 'as' => 'storeEmail']);
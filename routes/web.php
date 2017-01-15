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

Route::get('/', function () {
    return view('home');
});

Route::get('/oma-tili', 'PagesController@wip')->middleware('auth');

//Confirm email routes
Route::get('/vahvista/sahkoposti', 'UserController@sendEmailConfirmation')->name('confirmEmail')->middleware('auth');
Route::post('/vahvista/sahkoposti', 'UserController@confirmEmail')->middleware('auth');

// Authentication Routes...
Route::get('kirjaudu', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('kirjaudu', 'Auth\LoginController@login');
Route::post('ulos', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('luo-tili', 'Auth\RegisterController@showRegistrationForm');
Route::post('luo-tili', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('salasana/nollaa', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('salasana/sahkoposti', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('salasana/nollaa/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('salasana/nollaa', 'Auth\ResetPasswordController@reset');
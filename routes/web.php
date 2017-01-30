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

Route::get('/', 'PagesController@index');

// bbs routes
Route::get('/palsta', 'ThreadController@index');
Route::post('/palsta', 'ThreadController@store')->middleware('auth');
Route::post('/palsta/tykkaa', 'PostController@like')->middleware('auth');
Route::get('/palsta/uusi', 'ThreadController@create');
Route::get('/palsta/{slug}', 'ThreadController@show');
Route::post('/palsta/{slug}', 'PostController@store')->middleware('auth');

// user routes
Route::get('/oma-tili', 'UserController@index')->middleware('auth');
Route::get('/oma-tili/ilmoitukset', 'UserController@notifications')->middleware('auth');

//Confirm email routes
Route::get('/vahvista/sahkoposti', 'UserController@sendEmailConfirmation')->name('confirmEmail')->middleware('auth');
Route::post('/vahvista/sahkoposti', 'UserController@confirmEmail')->middleware('auth');
// Authentication Routes...
Route::get('kirjaudu', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('kirjaudu', 'Auth\LoginController@login');
Route::post('ulos', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('luo-tili', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('luo-tili', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::get('salasana/nollaa', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('salasana/sahkoposti', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('salasana/nollaa/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('salasana/nollaa', 'Auth\ResetPasswordController@reset');
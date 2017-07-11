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

// meeting routes
Route::get('/', 'PagesController@index');
Route::post('/', 'MeetingController@store');
Route::get('/a/{adminslug}', 'MeetingController@admin');
Route::get('/s/{slug}', 'MeetingController@show');
Route::post('/s/{slug}', 'CommentController@store');

// bbs routes
/* work in progress
Route::get('/palsta', 'ThreadController@index');
Route::post('/palsta', 'ThreadController@store')->middleware('auth');
Route::post('/palsta/tykkaa', 'PostController@like')->middleware('auth');
Route::get('/palsta/uusi', 'ThreadController@create');
Route::get('/palsta/{slug}', 'ThreadController@show');
Route::post('/palsta/{slug}', 'PostController@store')->middleware('auth');
*/

// user routes
Route::get('/oma-tili', 'UserController@index')->middleware('auth');
Route::get('/oma-tili/ilmoitukset', 'UserController@notifications')->middleware('auth');
Route::get('/oma-tili/muokkaa', 'UserController@edit')->middleware('auth');
Route::patch('/oma-tili/muokkaa', 'UserController@update')->middleware('auth');
Route::put('/oma-tili/muokkaa', 'UserController@updatePassword')->middleware('auth');

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

//legacy routes
Route::get('/nayta/{id}', function($id){
    return redirect('https://vanha.tapaaminen.net/nayta/'.$id);
});
Route::get('/hallinta/{id}', function($id){
    return redirect('https://vanha.tapaaminen.net/hallinta/'.$id);
});
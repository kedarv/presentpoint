<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'PageController@showWelcome');
Route::get('contact', 'PageController@contact');
Route::post('contactprocess', 'PageController@contactProcess');

Route::get('create',  array('before' => 'auth', 'uses' => 'PageController@createRoom'));
Route::post('createprocess', array('before' => 'auth', 'uses' => 'PageController@createRoomProcess'));

Route::get('viewallrooms',  array('before' => 'auth', 'uses' => 'PageController@viewAllRooms'));
Route::get('getroom/{id}',  array('before' => 'auth', 'uses' => 'PageController@getRoom'));

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

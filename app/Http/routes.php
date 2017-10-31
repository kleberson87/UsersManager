<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * UserController routes
 */
Route::get('/', 'UserController@index');
Route::get('user', 'UserController@index');
Route::get('user/index', 'UserController@index');

Route::get('user/create', 'UserController@create');
Route::post('user', 'UserController@store');

Route::get('user/{id}', 'UserController@show');
Route::get('user/{id}/edit', 'UserController@edit');
Route::post('user/{id}', 'UserController@update');

Route::get('user/{id}/delete', 'UserController@destroy');

/**
 * AddressController routes
 */
Route::get('address/index/{id_user}', 'AddressController@index');

Route::get('address/create/{id_user}', 'AddressController@create');
Route::post('address', 'AddressController@store');

Route::get('address/{id}', 'AddressController@edit');
Route::get('address/{id}/edit', 'AddressController@edit');
Route::post('address/{id}', 'AddressController@update');

Route::get('address/{id}/delete', 'AddressController@destroy');

/**
 * Default generated routes
 */
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

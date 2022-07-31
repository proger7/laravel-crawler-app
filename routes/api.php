<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'API\RegisterController@register');

Route::middleware('auth:api')->group( function () {
	Route::resource('configurations', 'API\ConfigurationController');
	Route::resource('logs', 'API\LogController');
});

/* JWT Authentication */
Route::post('register-jwt', 'JWT\UserController@register');
Route::post('login-jwt', 'JWT\UserController@authenticate');
Route::get('open', 'JWT\DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'JWT\UserController@getAuthenticatedUser');
    Route::get('closed', 'JWT\DataController@closed');
});

/* JWT Rest API */
Route::post('register-jwt-rest', 'JWT\ApiController@register');
Route::post('login-jwt-rest', 'JWT\ApiController@login');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'JWT\ApiController@logout');
    Route::get('user', 'JWT\ApiController@getAuthUser');
    Route::get('configurations', 'API\ConfigurationJWTController@index');
    Route::get('configurations/{id}', 'API\ConfigurationJWTController@show');
    Route::post('configurations', 'API\ConfigurationJWTController@store');
    Route::put('configurations/{id}', 'API\ConfigurationJWTController@update');
    Route::delete('configurations/{id}', 'API\ConfigurationJWTController@destroy');
});

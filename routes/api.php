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

Route::group(['as' => 'auth.', 'namespace' => 'Auth'], function () {
    Route::post('login', 'ApiController@login');
    Route::post('register', 'ApiController@register');

    Route::middleware(['auth.jwt'])->group(function () {
        Route::get('logout', 'ApiController@logout');
    });
});

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show');
        Route::post('/', 'UserController@store');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@destroy');
    });
});

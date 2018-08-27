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

Route::group(['prefix' => 'auth', 'middleware'=>['api']], function($router){
    Route::post('login', 'Auth\\AuthJWTController@login');
    Route::post('logout', 'Auth\\AuthJWTController@logout');
    Route::post('refresh', 'Auth\\AuthJWTController@refresh');
    Route::post('me', 'Auth\\AuthJWTController@me');    
    Route::post('register', 'Auth\\AuthJWTController@register');
});
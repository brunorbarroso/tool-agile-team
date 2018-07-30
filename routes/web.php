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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
    return view('admin.dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/parameters', 'Admin\\ParametersController');
    Route::resource('admin/tasks', 'Admin\\TasksController');
    Route::resource('admin/classifications', 'Admin\\ClassificationController');
});
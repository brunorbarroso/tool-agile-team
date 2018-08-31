<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

use App\Http\Controllers\Api\ClassificationController;
use App\Http\Controllers\Api\ParametersController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Auth\AuthJWTController;

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

$api = app(Router::class);

if(!$api instanceof Router)
    throw new RuntimeException("Api routing not configured");

$api->version('v1', ['after'=>'cors'], function(Router $api) {

    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('login', AuthJWTController::class.'@login');
        $api->post('register', AuthJWTController::class.'@register');
        $api->post('logout', AuthJWTController::class.'@logout', ['middleware'=>'jwt.auth']);
        $api->post('refresh', AuthJWTController::class.'@refresh', ['middleware'=>'jwt.auth']);
        $api->post('me', AuthJWTController::class.'@me', ['middleware'=>'jwt.auth']);
    });

    $api->group(['middleware'=>'jwt.auth'], function(Router $api) {
        $api->resource('tasks', TasksController::class, ['middleware'=>'can:create-task,view-task,update-task,delete-task']);
    });
    
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'v1'

], function ($router) {

    route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    route::get('profile', [App\Http\Controllers\AuthController::class, 'profile']);
    route::group(['prefix' => 'users'], function () {
        route::get('', [App\Http\Controllers\API\UserController::class, 'get']);
        route::post('', [App\Http\Controllers\API\UserController::class, 'create']);
        route::get('{id}', [App\Http\Controllers\API\UserController::class, 'detail']);
        route::put('{id}', [App\Http\Controllers\API\UserController::class, 'update']);
        route::delete('{id}', [App\Http\Controllers\API\UserController::class, 'delete']);
    });
    route::group(['prefix' => 'leave-requests'], function () {
        route::get('', [App\Http\Controllers\API\LeaveRequestController::class, 'get']);
        route::post('', [App\Http\Controllers\API\LeaveRequestController::class, 'create']);
        route::get('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'detail']);
        route::put('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'update']);
        route::delete('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'delete']);
    });

});

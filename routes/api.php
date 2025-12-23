<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('profile', [App\Http\Controllers\AuthController::class, 'profile']);
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [App\Http\Controllers\API\UserController::class, 'get']);
        Route::post('', [App\Http\Controllers\API\UserController::class, 'create']);
        Route::get('{id}', [App\Http\Controllers\API\UserController::class, 'detail']);
        Route::put('{id}', [App\Http\Controllers\API\UserController::class, 'update']);
        Route::delete('{id}', [App\Http\Controllers\API\UserController::class, 'delete']);
    });
    Route::group(['prefix' => 'leave-requests'], function () {
        Route::get('', [App\Http\Controllers\API\LeaveRequestController::class, 'get']);
        Route::post('', [App\Http\Controllers\API\LeaveRequestController::class, 'create']);
        Route::get('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'detail']);
        Route::put('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'update']);
        Route::delete('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'delete']);
    });

});

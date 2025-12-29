<?php

use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('profile', [App\Http\Controllers\AuthController::class, 'profile']);
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [App\Http\Controllers\API\UserController::class, 'get']  );
        Route::get('list', [App\Http\Controllers\API\UserController::class, 'list']);
        Route::post('', [App\Http\Controllers\API\UserController::class, 'create']);
        Route::get('{id}', [App\Http\Controllers\API\UserController::class, 'detail']);
        Route::put('{id}', [App\Http\Controllers\API\UserController::class, 'update']);
        Route::delete('{id}', [App\Http\Controllers\API\UserController::class, 'delete']);
    });
    Route::group(['prefix' => 'leave-applications'], function () {
        Route::get('', [App\Http\Controllers\API\LeaveRequestController::class, 'get']);
        Route::post('', [App\Http\Controllers\API\LeaveRequestController::class, 'create']);
        Route::get('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'detail']);
        Route::put('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'update']);
        route::post('{id}/approve', [App\Http\Controllers\API\LeaveRequestController::class, 'approve']);
        route::post('{id}/reject', [App\Http\Controllers\API\LeaveRequestController::class, 'reject']);
        route::post('{id}/cancel', [App\Http\Controllers\API\LeaveRequestController::class, 'cancel']);
        Route::delete('{id}', [App\Http\Controllers\API\LeaveRequestController::class, 'delete']);
    });

});

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
    Route::get('me', [App\Http\Controllers\AuthController::class, 'profile']);
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [App\Http\Controllers\API\UserController::class, 'get']);
        Route::get('list', [App\Http\Controllers\API\UserController::class, 'list']);
        Route::get('{id}', [App\Http\Controllers\API\UserController::class, 'detail'])->middleware('can:view,user');
        Route::post('', [App\Http\Controllers\API\UserController::class, 'create'])->middleware('can:create,App\Models\User');
        Route::put('{id}', [App\Http\Controllers\API\UserController::class, 'update'])->middleware('can:update,user');
        Route::delete('{id}', [App\Http\Controllers\API\UserController::class, 'delete'])->middleware('can:delete,user');
    });
    Route::group(['prefix' => 'leave-applications'], function () {
        Route::get('', [App\Http\Controllers\API\LeaveApplicationController::class, 'get'])->middleware('can:viewAny,App\Models\LeaveApplication');
        Route::post('', [App\Http\Controllers\API\LeaveApplicationController::class, 'create'])->middleware('can:create,App\Models\LeaveApplication');
        route::get('list', [App\Http\Controllers\API\LeaveApplicationController::class, 'list'])->middleware('can:viewAny,App\Models\LeaveApplication');
        Route::get('{id}', [App\Http\Controllers\API\LeaveApplicationController::class, 'detail'])->middleware('can:view,leaveApplication');
        Route::put('{id}', [App\Http\Controllers\API\LeaveApplicationController::class, 'update'])->middleware('can:update,leaveApplication');
        route::post('{id}/approve', [App\Http\Controllers\API\LeaveApplicationController::class, 'approve'])->middleware('can:approve,leaveApplication');
        route::post('{id}/reject', [App\Http\Controllers\API\LeaveApplicationController::class, 'reject'])->middleware('can:reject,leaveApplication');
        route::post('{id}/cancel', [App\Http\Controllers\API\LeaveApplicationController::class, 'cancel'])->middleware('can:cancel,leaveApplication');
        Route::delete('{id}', [App\Http\Controllers\API\LeaveApplicationController::class, 'delete'])->middleware('can:delete,leaveApplication');
    });

});

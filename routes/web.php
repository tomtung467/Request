<?php

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    $User = User::findOrFail(1);
    return new UserResource($User);
});

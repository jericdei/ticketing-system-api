<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\AuthController;

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

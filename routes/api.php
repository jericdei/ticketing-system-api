<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\AuthController;

// Public Routes
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', \App\Http\Controllers\Users\UserController::class);
    // Route::apiResource('tickets', \App\Http\Controllers\Tickets\TicketController::class);
});

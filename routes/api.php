<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\AuthController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('auth/user', [AuthController::class, 'user']);
    Route::apiResource('tickets', \App\Http\Controllers\Tickets\TicketController::class);
});

Route::middleware(['auth:sanctum', 'role:Admin|Department Admin'])->group(function() {
    Route::apiResource('users', \App\Http\Controllers\Users\UserController::class);
});

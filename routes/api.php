<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/user', [AuthController::class, 'user']);
    Route::apiResource('users', \App\Http\Controllers\Users\UserController::class);
    Route::apiResource('tickets', \App\Http\Controllers\Tickets\TicketController::class);
});

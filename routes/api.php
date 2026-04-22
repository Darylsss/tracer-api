<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RevenuController;
use App\Http\Controllers\API\DepenseController;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    Route::apiResource('revenus',  RevenuController::class)
         ->only(['index', 'store', 'destroy']);
    Route::apiResource('depenses', DepenseController::class)
         ->only(['index', 'store', 'destroy']);
});
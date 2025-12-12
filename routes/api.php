<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\OrderApiController;

Route::prefix('api')->group(function () {
    // Menu endpoints
    Route::get('/menu/items', [MenuApiController::class, 'getItems']);
    Route::get('/menu/items/{id}', [MenuApiController::class, 'getItem']);
    
    // Order endpoints
    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::get('/orders', [OrderApiController::class, 'index']);
    Route::get('/orders/{id}', [OrderApiController::class, 'show']);
    Route::put('/orders/{id}', [OrderApiController::class, 'update']);
    Route::delete('/orders/{id}', [OrderApiController::class, 'destroy']);
});
<?php

use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::prefix('todo')->group(function () {
        Route::post('/', [TodoController::class, 'store']);
        Route::get('/export', [TodoController::class, 'export']);
    });
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;

// Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
// });

// Route::middleware('auth:sanctum')->apiResource('products', ProductController::class);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

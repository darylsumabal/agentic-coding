<?php

use App\Http\Controllers\JsonPlaceHolderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::apiResource('users', UserController::class);
Route::apiResource('todos', JsonPlaceHolderController::class);
Route::post('product', [ProductController::class, 'store']);

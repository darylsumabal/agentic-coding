<?php

use App\Http\Controllers\JsonPlaceHolderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::apiResource('users', UserController::class);
Route::apiResource('todos', JsonPlaceHolderController::class);
Route::post('product', [ProductController::class, 'store'])->middleware(['api', 'auth:sanctum']);
Route::get('product', [ProductController::class, 'index']);
Route::post('/login-test', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Generate the plain text token
    $token = $user->createToken('test-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

<?php


use Illuminate\Support\Facades\Route;
use Laravel\Mcp\Request;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});




require __DIR__ . '/settings.php';
require __DIR__ . '/users.php';

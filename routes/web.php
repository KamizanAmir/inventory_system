<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoanController;

// Redirect standard Laravel welcome to our login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Protect our Inventory system so only logged-in users can use it
Route::middleware(['auth'])->group(function () {

    // We will use your dashboard as the main landing page
    Route::get('/dashboard', [AssetController::class, 'index'])->name('dashboard');

    Route::get('/checkout', [LoanController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [LoanController::class, 'store'])->name('checkout.store');
    // Asset Management
    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    // Category Management
    Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
});

// (Leave the standard Breeze Profile/Auth routes at the bottom of the file)
require __DIR__ . '/auth.php';

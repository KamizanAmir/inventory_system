<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// The main dashboard showing all inventory
Route::get('/', [AssetController::class, 'index'])->name('inventory.index');

// The checkout/barcode scanning pages (we will build these next!)
Route::get('/checkout', [LoanController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [LoanController::class, 'store'])->name('checkout.store');

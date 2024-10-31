<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class);
    
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('sellers', SellerController::class);
    Route::resource('sales', SaleController::class);
});
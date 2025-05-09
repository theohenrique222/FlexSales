<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->middleware('auth');
    Route::get('/sales/{sale}/pdf', [SaleController::class, 'exportPdf'])->name('sales.pdf');
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('sellers', SellerController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('sales', App\Http\Controllers\SaleController::class);
    Route::resource('payments', PaymentController::class);
});
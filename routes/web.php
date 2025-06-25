<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\StockEntriesController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('dashboard');

Route::get('/cashier/dashboard', [CashierController::class, 'cashierIndex'])
    ->middleware('auth')
    ->name('cashier.dashboard');

Route::middleware('auth')->group(function () {

    // Route Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        // Route Admin medicine
        Route::get('/medicine', [MedicinesController::class, 'index'])->name('medicine.index');
        Route::get('/medicine/create', [MedicinesController::class, 'create'])->name('medicine.create');
        Route::post('/medicine', [MedicinesController::class, 'store'])->name('medicine.store');
        Route::get('/medicine/{medicine}/edit', [MedicinesController::class, 'edit'])->name('medicine.edit');
        Route::put('/medicine/{medicine}', [MedicinesController::class, 'update'])->name('medicine.update');
        Route::delete('/medicine/{medicine}', [MedicinesController::class, 'destroy'])->name('medicine.destroy');
        Route::get('/medicine/{medicine}', [MedicinesController::class, 'show'])->name('medicine.show');

        // Route Admin cashier
        Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
        Route::get('/cashier/create', [CashierController::class, 'create'])->name('cashier.create');
        Route::post('/cashier', [CashierController::class, 'store'])->name('cashier.store');
        Route::get('/cashier/{id}/edit', [CashierController::class, 'edit'])->name('cashier.edit');
        Route::put('/cashier/{id}', [CashierController::class, 'update'])->name('cashier.update');
        Route::delete('/cashier/{id}', [CashierController::class, 'destroy'])->name('cashier.destroy');
        Route::get('/cashier/{id}', [CashierController::class, 'show'])->name('cashier.show');

        // Route Admin packaging
        Route::get('/packaging', [PackagingController::class, 'index'])->name('packaging.index');
        Route::get('/packaging/create', [PackagingController::class, 'create'])->name('packaging.create');
        Route::post('/packaging', [PackagingController::class, 'store'])->name('packaging.store');
        Route::get('/packaging/{packaging}/edit', [PackagingController::class, 'edit'])->name('packaging.edit');
        Route::put('/packaging/{packaging}', [PackagingController::class, 'update'])->name('packaging.update');
        Route::delete('/packaging/{packaging}', [PackagingController::class, 'destroy'])->name('packaging.destroy');
        Route::get('/packaging/{packaging}', [PackagingController::class, 'show'])->name('packaging.show');

        // Route Admin Category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');

        // Route Admin report & history
        Route::get('/sales', [SaleController::class, 'index'])->name('sale.index');
        Route::get('/show/{sale}', [SaleController::class, 'show'])->name('sale.show');
        Route::get('/stock', [StockEntriesController::class, 'index'])->name('stock.index');
        
        Route::get('/stock/{id}', [StockEntriesController::class, 'show'])->name('stock.show');
        Route::get('/stock/{id}/edit', [StockEntriesController::class, 'edit'])->name('stock.edit');
        Route::put('/stock/{id}/update', [StockEntriesController::class, 'update'])->name('stock.update');
        Route::delete('/stock/{id}', [StockEntriesController::class, 'destroy'])->name('stock.destroy');

        Route::get('/purchase/{id}/edit', [StockEntriesController::class, 'editPurchase'])->name('purchase.edit');
        Route::put('/purchase/{id}/update', [StockEntriesController::class, 'updatePurchase'])->name('purchase.update');
        Route::delete('/purchase/{id}', [StockEntriesController::class, 'destroyPurchase'])->name('purchase.destroy');
    });

    // Route Cashier
    Route::prefix('cashier')->name('cashier.')->group(function () {
        Route::get('/medicine', [MedicinesController::class, 'index'])->name('medicine.index');
        Route::get('/medicine/{id}', [MedicinesController::class, 'show'])->name('medicine.show');
    });

    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route Api
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/medicine/data', [MedicinesController::class, 'fecthMedicines'])->name('medicine.fetch');
        Route::get('/load-products', [CashierController::class, 'loadProducts']);
        Route::post('/payment', [SaleController::class, 'store']);
        Route::post('/stock-entries', [StockEntriesController::class, 'store']);
    });
});

require __DIR__ . '/auth.php';

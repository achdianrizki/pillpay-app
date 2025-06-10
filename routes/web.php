<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/cashier/dashboard', [CashierController::class, 'index'])
    ->middleware('auth')
    ->name('cashier.dashboard');



Route::middleware('auth')->group(function () {

    // Route Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        // Route Admin medicine
        Route::get('/medicine', [MedicinesController::class, 'index'])->name('medicine.index');
        Route::get('/medicine/create', [MedicinesController::class, 'create'])->name('medicine.create');
        Route::post('/medicine', [MedicinesController::class, 'store'])->name('medicine.store');
        Route::get('/medicine/{id}/edit', [MedicinesController::class, 'edit'])->name('medicine.edit');
        Route::put('/medicine/{id}', [MedicinesController::class, 'update'])->name('medicine.update');
        Route::delete('/medicine/{id}', [MedicinesController::class, 'destroy'])->name('medicine.destroy');
        Route::get('/medicine/{id}', [MedicinesController::class, 'show'])->name('medicine.show');

        // Route Admin cashier
        Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
        Route::get('/cashier/create', [CashierController::class, 'create'])->name('cashier.create');
        Route::post('/cashier', [CashierController::class, 'store'])->name('cashier.store');
        Route::get('/cashier/{id}/edit', [CashierController::class, 'edit'])->name('cashier.edit');
        Route::put('/cashier/{id}', [CashierController::class, 'update'])->name('cashier.update');
        Route::delete('/cashier/{id}', [CashierController::class, 'destroy'])->name('cashier.destroy');
        Route::get('/cashier/{id}', [CashierController::class, 'show'])->name('cashier.show');

        
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
    });
});

require __DIR__ . '/auth.php';

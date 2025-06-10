<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PillController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cashier/dashboard', [CashierController::class, 'index'])
    ->middleware('auth')
    ->name('cashier.dashboard');



Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Route Admin Pill
        Route::get('/pill', [MedicinesController::class, 'index'])->name('pill.index');
        Route::get('/pill/create', [MedicinesController::class, 'create'])->name('pill.create');
        Route::post('/pill', [MedicinesController::class, 'store'])->name('pill.store');
        Route::get('/pill/{id}/edit', [MedicinesController::class, 'edit'])->name('pill.edit');
        Route::put('/pill/{id}', [MedicinesController::class, 'update'])->name('pill.update');
        Route::delete('/pill/{id}', [MedicinesController::class, 'destroy'])->name('pill.destroy');
        Route::get('/pill/{id}', [MedicinesController::class, 'show'])->name('pill.show');

        // Route Admin cashier
        Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
        Route::get('cashier/create', [CashierController::class, 'create'])->name('cashier.create');
        Route::post('cashier', [CashierController::class, 'store'])->name('cashier.store');
        Route::get('cashier/{id}/edit', [CashierController::class, 'edit'])->name('cashier.edit');
        Route::put('cashier/{id}', [CashierController::class, 'update'])->name('cashier.update');
        Route::delete('cashier/{id}', [CashierController::class, 'destroy'])->name('cashier.destroy');
        Route::get('cashier/{id}', [CashierController::class, 'show'])->name('cashier.show');
    });

    Route::prefix('cashier')->name('cashier.')->group(function () {
        Route::get('/pill', [PillController::class, 'index'])->name('pill.index');
        Route::get('/pill/{id}', [PillController::class, 'show'])->name('pill.show');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

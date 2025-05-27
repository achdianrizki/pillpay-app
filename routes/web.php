<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     $data = "hallo anggow";
//     return view('layout', compact('data'));
// });

Route::get('/', [AdminController::class, 'index'])->name('dashboard');
Route::get('/cashiers', [AdminController::class, 'cashiers'])->name('cashiers');
Route::get('/pill', [AdminController::class, 'pill'])->name('pill');
Route::get('/history', [AdminController::class, 'history'])->name('history');
Route::get('/login', [AuthController::class, 'login'])->name('login');
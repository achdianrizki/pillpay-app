<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     $data = "hallo anggow";
//     return view('layout', compact('data'));
// });

Route::get('/', [AdminController::class, 'index'])->name('dashboard');
Route::get('/cashiers', [AdminController::class, 'cashiers'])->name('cashiers');

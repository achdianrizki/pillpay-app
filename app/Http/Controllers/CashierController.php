<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $medicines = Medicines::all();
        return view('cashier.index', compact('medicines'));
    }
}

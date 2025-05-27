<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function cashiers()
    {
        return view('admin.cashier.index');
    }
    public function pill()
    {
        return view('admin.pill.index');
    }
    public function history()
    {
        return view('admin.history.index');
    }
}


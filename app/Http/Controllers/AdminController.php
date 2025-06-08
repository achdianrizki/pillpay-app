<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $cashier = User::role('cashier')->with('roles')->count();

        return view('admin.index', compact('cashier'));
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


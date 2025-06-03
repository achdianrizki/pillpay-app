<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    public function index()
    {
        $pills = Medicines::all();
        return view('admin.pill.index', compact('pills'));
    }
}

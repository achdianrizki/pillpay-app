<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Illuminate\Http\Request;

class Pillcontroller extends Controller
{
    public function create(){
        return view('admin.pill.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function index()
    {
        $cashiers = User::all();
        return view('admin.cashier.index', compact('cashiers'));
    } 

    public function create()
    {
    return view('admin.cashier.create'); 
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => bcrypt($request->password)
    ]);

    return redirect()->route('admin.cashier.index')->with('success', 'Kasir berhasil dibuat.');
    }

    public function edit($id)
    {
        $cashier = User::findOrFail($id);
        return view('admin.cashier.edit', compact('cashier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'password' => 'nullable|string|min:6',
    ]);

    $cashier = User::findOrFail($id);
    $cashier->name = $request->name;
    $cashier->username = $request->username;

    if ($request->password) {
        $cashier->password = bcrypt($request->password);
    }

    $cashier->save();

    return redirect()->route('admin.cashier.index')->with('success', 'Kasir berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $cashier = User::findOrFail($id);
        $cashier->delete();
        return redirect()->route('admin.cashier.index')->with('success', 'Kasir berhasil dihapus.');
    }


}

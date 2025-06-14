<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medicines;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role;

class CashierController extends Controller
{

    public function index()
    {
        $cashiers = User::role('cashier')->get();
        return view('admin.cashier.index', compact('cashiers'));
    }

    // Data API 
    public function loadProducts(Request $request)
    {
        $products = Medicines::query()
            ->when($request->keyword, fn($q) => $q->where('name', 'like', '%' . $request->keyword . '%'))
            ->when($request->kategori, fn($q) => $q->where('category', $request->kategori))
            ->orderBy('name', 'asc')
            ->paginate(6);

        return $products->map(function ($product) {
            return view('components.product-card', compact('product'))->render();
        })->implode('');;
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'uang_diberikan' => 'required|numeric',
        ]);

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil!']);
    }
    // End Data API

    public function cashierIndex()
    {
        $medicines = Medicines::all();
        return view('cashier.index', compact('medicines'));
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
        'shift' => 'required|in:siang,malam',
    ]);

    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'shift' => $request->shift,
    ]);

    $user->assignRole('cashier');

        $role = Role::find(2);
        $cashier->assignRole($role);
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
        'shift' => 'required|in:siang,malam',
    ]);

    $cashier = User::findOrFail($id);
    $cashier->name = $request->name;
    $cashier->username = $request->username;
    $cashier->shift = $request->shift;

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

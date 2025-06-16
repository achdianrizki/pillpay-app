<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Medicines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

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
        $products = DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->join('packagings', 'medicines.packaging_id', '=', 'packagings.id')
            ->select('medicines.*', 'categories.name as category_name', 'packagings.name as packaging_name')
            ->when($request->keyword, fn($q) => $q->where('medicines.name', 'like', '%' . $request->keyword . '%'))
            ->when($request->kategori, fn($q) => $q->where('medicines.category_id', $request->kategori))
            ->orderByDesc('medicines.stock')
            ->orderBy('medicines.name')
            ->paginate(6);

        return $products->map(function ($product) {
            return view('components.product-card', compact('product'))->render();
        })->implode('');
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
        $categories = Category::all();
        return view('cashier.index', compact('categories'));
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi opsional
        ]);

        $filename = 'default.png';

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = $image->hashName();
            $image->storeAs('user', $filename, 'public');
        }

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'password'  => bcrypt($request->password),
            'shift'     => $request->shift,
            'images'    => $filename,
        ]);

        $user->assignRole('cashier');

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
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $cashier = User::findOrFail($id);

        $filename = $cashier->images ?? 'default.png';

        if ($request->hasFile('images')) {
            if ($cashier->images && $cashier->images !== 'default.png') {
                Storage::disk('public')->delete('user/' . $cashier->images);
            }

            $image = $request->file('images');
            $filename = $image->hashName();
            $image->storeAs('user', $filename, 'public');
        }

        $cashier->name = $request->name;
        $cashier->username = $request->username;
        $cashier->shift = $request->shift;
        $cashier->images = $filename;

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

<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Medicines;
use App\Models\StockEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockEntriesController extends Controller
{
    public function index()
    {
        $purchase = Purchase::with('user')->get();
        return view('admin.stock.index', compact('purchase'));
    }

    public function show($id)
    {
        $stock = StockEntry::where('purchase_id', $id)->with('medicine')->get();
        return view('admin.stock.show', compact('stock'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier' => 'required|string|max:255',
            'entries' => 'required|array|min:1',
            'entries.*.medicine_id' => 'required|exists:medicines,id',
            'entries.*.quantity' => 'required|integer|min:1',
            'entries.*.expiration_date' => 'required|date|after:today',
            'entries.*.purchase_price' => 'required|numeric|min:0',
            'entries.*.packaging' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $totalAmount = collect($validated['entries'])->sum(function ($entry) {
            return $entry['quantity'] * $entry['purchase_price'];
        });

        // Jalankan dalam transaction agar rollback otomatis jika gagal
        DB::transaction(function () use ($validated, $totalAmount) {
            $purchase = Purchase::create([
                'user_id' => Auth::user()->id,
                'supplier' => $validated['supplier'],
                'purchase_date' => now(),
                'total_amount' => $totalAmount,
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($validated['entries'] as $entry) {
                StockEntry::create([
                    'purchase_id'     => $purchase->id,
                    'medicine_id'     => $entry['medicine_id'],
                    'expiration_date' => $entry['expiration_date'],
                    'supplier'        => $validated['supplier'],
                    'entry_date'      => now(),
                    'quantity'        => $entry['quantity'],
                    'purchase_price'  => $entry['purchase_price'],
                    'packaging'       => $entry['packaging'],
                ]);

                Medicines::where('id', $entry['medicine_id'])->increment('stock', $entry['quantity']);
            }
        });

        return response()->json(['success' => 'Data pembelian dan stok berhasil disimpan']);
    }
}

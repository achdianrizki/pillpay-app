<?php

namespace App\Http\Controllers;

use App\Models\StockEntry;
use App\Models\Medicines;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockEntriesController extends Controller
{
    public function index()
    {
        $stock = StockEntry::with('medicine')->get();
        return view('admin.stock.index', compact('stock'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier' => 'required|string|max:255',
            'entries' => 'required|array|min:1',
            'entries.*.medicine_id' => 'required|exists:medicines,id',
            'entries.*.quantity' => 'required|integer|min:1',
            'entries.*.expiration_date' => 'required|date|after:today',
        ]);

        foreach ($validated['entries'] as $entry) {
            StockEntry::create([
                'medicine_id'     => $entry['medicine_id'],
                'expiration_date' => $entry['expiration_date'],
                'supplier'        => $validated['supplier'],
                'entry_date'      => now(),
                'quantity'        => $entry['quantity'],
            ]);

            Medicines::where('id', $entry['medicine_id'])->increment('stock', $entry['quantity']);
        }

        return response()->json(['success' => 'Data stok berhasil disimpan']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Medicines;
use App\Models\Packaging;
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

    public function edit($id)
    {
        $stocks = StockEntry::with('medicine')->findOrFail($id);
        $packagings = Packaging::all();
        return view('admin.stock.edit', compact('stocks', 'packagings'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'expiration_date' => 'required|date|after:today',
            'purchase_price' => 'required|numeric|min:0',
            'packaging' => 'nullable|string|max:255',
        ]);

        $stockEntry = StockEntry::findOrFail($id);

        $oldQuantity = $stockEntry->quantity;
        $oldPurchasePrice = $stockEntry->purchase_price;

        $stockEntry->update($validated);

        Medicines::where('id', $validated['medicine_id'])
            ->increment('stock', $validated['quantity'] - $oldQuantity);

        if ($stockEntry->purchase) {
            $oldTotal = $oldQuantity * $oldPurchasePrice;
            $newTotal = $validated['quantity'] * $validated['purchase_price'];
            $difference = $newTotal - $oldTotal;

            $stockEntry->purchase->update([
                'total_amount' => $stockEntry->purchase->total_amount + $difference,
            ]);
        }

        return redirect()->route('admin.stock.show', $stockEntry->purchase_id)
            ->with('success', 'Stok berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $stockEntry = StockEntry::findOrFail($id);
        $stockEntry->delete();

        Medicines::where('id', $stockEntry->medicine_id)->decrement('stock', $stockEntry->quantity);
        if ($stockEntry->purchase) {
            $stockEntry->purchase->update(['total_amount' => $stockEntry->purchase->total_amount - ($stockEntry->quantity * $stockEntry->purchase_price)]);
        }
        return redirect()->route('admin.stock.show', $stockEntry->purchase_id)->with('success', 'Stok berhasil dihapus.');
    }

    public function editPurchase($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('admin.stock.editPurchase', compact('purchase'));
    }

    public function updatePurchase(Request $request, $id)
    {
        $validated = $request->validate([
            'supplier' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update($validated);

        return redirect()->route('admin.stock.index')->with('success', 'Pembelian berhasil diperbarui.');
    }

    public function destroyPurchase(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);

        $stockEntries = StockEntry::where('purchase_id', $id)->get();

        foreach ($stockEntries as $stockEntry) {
            Medicines::where('id', $stockEntry->medicine_id)->decrement('stock', $stockEntry->quantity);
            $stockEntry->delete();
        }

        $purchase->delete();

        return redirect()->route('admin.stock.index')->with('success', 'Pembelian dan stok terkait berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->paginate(10);
        return view('admin.sale.index', compact('sales'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'items.*.nama' => 'required|string|exists:medicines,name',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga' => 'required|numeric|min:0',
            'metode' => 'required|in:cash,qris',
            'total' => 'required|numeric|min:0',
            'uang_diberikan' => 'required|numeric|min:0',
            'kembalian' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'total_price' => $validated['total'],
                'payment_method' => $validated['metode'],
                'change' => $validated['kembalian'],
            ]);

            foreach ($validated['items'] as $item) {
                $medicine = Medicines::where('name', $item['nama'])->firstOrFail();
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $medicine->id,
                    'quantity' => $item['jumlah'],
                    'unit_price' => $item['harga'],
                    'sub_total' => $item['jumlah'] * $item['harga'],
                    'change' => $sale->change,
                ]);

                $medicine->decrement('stock', $item['jumlah']);
            }

            DB::commit();

            return response()->json(['success' => 'Pembayaran berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    public function show(Sale $sale)
    {
        $sale_detail = SaleDetail::with('medicine')->where('sale_id', $sale->id)->get();
        return view('admin.sale.show', compact('sale_detail'));
    }
}

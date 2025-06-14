<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicinesController extends Controller
{
    public function index()
    {
        $medicine = Medicines::all();
        return view('admin.medicine.index', compact('medicine'));
    }

    public function create()
    {
        return view('admin.medicine.create');
    }

    public function fecthMedicines(Request $request)
    {
        $medicine = Medicines::orderBy('created_at', 'desc')->get();
        return response()->json($medicine);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'category'          => 'string|max:100',
            'selling_price'     => 'required|numeric',
            'purchase_price'    => 'required|numeric',
            'packaging'         => 'required|string|max:100',
            'expiration_date'   => 'required|date',
            'drug_class'        => 'required|string|max:100',
            'standard_name'     => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'usage_instruction' => 'required|string',
            'images.*'          => 'nullable',
        ]);

        $filename = 'default.png';
        if ($request->hasFile('images') && count($request->file('images')) > 0) {
            $image = $request->file('images')[0];
            $filename = $image->hashName();
            $image->storeAs('product', $filename, 'public');
        }

        $lastMedicine = Medicines::orderBy('id', 'desc')->first();
        if ($lastMedicine && preg_match('/^OBT(\d{4})$/', $lastMedicine->code, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }
        $code =  'OBT' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


        Medicines::create([
            'name'              => $request->name,
            'code'              => $code,
            'category'          => $request->category,
            'selling_price'     => $request->selling_price,
            'purchase_price'    => $request->purchase_price,
            'stock'             => 0,
            'packaging'         => $request->packaging,
            'expiration_date'   => $request->expiration_date,
            'drug_class'        => $request->drug_class,
            'standard_name'     => $request->standard_name,
            'description'       => $request->description,
            'usage_instruction' => $request->usage_instruction,
            'images'            => $filename ?? 'default.png',
        ]);

        // dd($request);

        return redirect()->route('admin.medicine.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function show(Medicines $medicine)
    {
        return view('Mediciness.show', compact('Medicines'));
    }

    public function edit(Medicines $medicine)
    {
        // dd($medicine);
        return view('admin.medicine.edit', compact('medicine'));
    }

    public function update(Request $request, Medicines $medicine)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'category'          => 'string|max:100',
            'selling_price'     => 'required|numeric',
            'purchase_price'    => 'required|numeric',
            'packaging'         => 'required|string|max:100',
            'expiration_date'   => 'required|date',
            'drug_class'        => 'required|string|max:100',
            'standard_name'     => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'usage_instruction' => 'required|string',
            'images.*'          => 'nullable',
        ]);

        $filename = 'default.png';
        if ($request->hasFile('images')) {
            if ($medicine->images && $medicine->images !== 'default.png') {
                Storage::disk('public')->delete('product/' . $medicine->images);
            }

            $image = $request->file('images');
            $filename = $image->hashName();
            $image->storeAs('product', $filename, 'public');
        }

        $medicine->update([
            'name'              => $request->name,
            'category'          => $request->category,
            'selling_price'     => $request->selling_price,
            'purchase_price'    => $request->purchase_price,
            'packaging'         => $request->packaging,
            'expiration_date'   => $request->expiration_date,
            'drug_class'        => $request->drug_class,
            'standard_name'     => $request->standard_name,
            'description'       => $request->description,
            'usage_instruction' => $request->usage_instruction,
            'images'            => $filename,
        ]);

        return redirect()->route('admin.medicine.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Medicines $medicine)
    {
        if ($medicine->images) {
            foreach (json_decode($medicine->images) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $medicine->delete();

        return redirect()->route('Mediciness.index')->with('success', 'Obat berhasil dihapus.');
    }
}

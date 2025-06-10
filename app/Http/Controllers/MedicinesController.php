<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    public function index()
    {
        $medicines = Medicines::all();
        return view('admin.medicine.index', compact('medicines'));
    }

    public function create(){
        return view('admin.medicine.create');
    }

    public function fecthMedicines(Request $request)
    {
        $medicines = Medicines::all();
        return response()->json($medicines);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'code'              => 'required|string|max:50|unique:drugs,code',
            'category'          => 'nullable|string|max:100',
            'selling_price'     => 'required|numeric',
            'purchase_price'    => 'required|numeric',
            'stock'             => 'required|integer',
            'packaging'         => 'nullable|string|max:100',
            'expiration_date'   => 'nullable|date',
            'drug_class'        => 'nullable|string|max:100',
            'standard_name'     => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'usage_instruction' => 'nullable|string',
            'images.*'          => 'nullable|image|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('product', 'public');
            }
        }

        Drug::create([
            'name'              => $request->name,
            'code'              => $request->code,
            'category'          => $request->category,
            'selling_price'     => $request->selling_price,
            'purchase_price'    => $request->purchase_price,
            'stock'             => $request->stock,
            'packaging'         => $request->packaging,
            'expiration_date'   => $request->expiration_date,
            'drug_class'        => $request->drug_class,
            'standard_name'     => $request->standard_name,
            'description'       => $request->description,
            'usage_instruction' => $request->usage_instruction,
            'images'            => json_encode($imagePaths),
        ]);

        return redirect()->route('drugs.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function show(Drug $drug)
    {
        return view('drugs.show', compact('drug'));
    }

    public function edit(Drug $drug)
    {
        return view('drugs.edit', compact('drug'));
    }

    public function update(Request $request, Drug $drug)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'code'              => 'required|string|max:50|unique:drugs,code,' . $drug->id,
            'category'          => 'nullable|string|max:100',
            'selling_price'     => 'required|numeric',
            'purchase_price'    => 'required|numeric',
            'stock'             => 'required|integer',
            'packaging'         => 'nullable|string|max:100',
            'expiration_date'   => 'nullable|date',
            'drug_class'        => 'nullable|string|max:100',
            'standard_name'     => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'usage_instruction' => 'nullable|string',
            'images.*'          => 'nullable|image|max:2048',
        ]);

        $imagePaths = json_decode($drug->images ?? '[]', true);

        if ($request->hasFile('images')) {
            foreach ($imagePaths as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('product', 'public');
            }
        }

        $drug->update([
            'name'              => $request->name,
            'code'              => $request->code,
            'category'          => $request->category,
            'selling_price'     => $request->selling_price,
            'purchase_price'    => $request->purchase_price,
            'stock'             => $request->stock,
            'packaging'         => $request->packaging,
            'expiration_date'   => $request->expiration_date,
            'drug_class'        => $request->drug_class,
            'standard_name'     => $request->standard_name,
            'description'       => $request->description,
            'usage_instruction' => $request->usage_instruction,
            'images'            => json_encode($imagePaths),
        ]);

        return redirect()->route('drugs.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Drug $drug)
    {
        if ($drug->images) {
            foreach (json_decode($drug->images) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $drug->delete();

        return redirect()->route('drugs.index')->with('success', 'Obat berhasil dihapus.');
    }
}

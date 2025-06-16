<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Packaging;

class PackagingController extends Controller
{
    public function index()
    {
        $packagings = Packaging::all();
        return view('admin.packaging.index', compact('packagings'));
    }

    public function create()
    {
        return view('admin.packaging.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $packaging = Packaging::create([
            'name' => $request->name,
        ]);

        return response()->json($packaging, 201);
    }

    public function show($id)
    {
        $packaging = Packaging::findOrFail($id);
        return response()->json($packaging);
    }

    public function edit($id)
    {
        $packaging = Packaging::findOrFail($id);
        return view('admin.packaging.edit', compact('packaging'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $packaging = Packaging::findOrFail($id);
        $packaging->name = $request->name;
        $packaging->save();

        return response()->json($packaging);
    }

    public function destroy($id)
    {
        $packaging = Packaging::findOrFail($id);
        $packaging->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudangList = Gudang::all();
        return view('gudang.index', compact('gudangList'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required|unique:gudang,nama_gudang'
        ]);

        Gudang::create([
            'nama_gudang' => $request->nama_gudang
        ]);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus.');
    }
    public function edit($id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gudang' => 'required|string|max:255',
        ]);

        $gudang = Gudang::findOrFail($id);
        $gudang->update([
            'nama_gudang' => $request->nama_gudang,
        ]);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diperbarui.');
    }
}


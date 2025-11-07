<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index(Request $request)
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'kategori_barang' => 'required',
        ]);

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'kategori_barang' => $request->kategori_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Menampilkan detail barang
    public function show($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
        return view('barang.show', compact('barang'));
    }

    // Menampilkan form edit barang
    public function edit($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
        return view('barang.edit', compact('barang'));
    }

    // Update data barang
    public function update(Request $request, $kode_barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required',
            'kategori_barang' => 'required',
        ]);

        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
        $barang->update($request->only(['nama_barang', 'satuan', 'kategori_barang']));

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    // Hapus barang
    public function destroy($kode_barang)
{
    $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
}

public function export()
{
    return Excel::download(new BarangExport, 'daftar-barang.xlsx');
}
public function import(Request $request)
{
    $request->validate([
        'file_excel' => 'required|file|mimes:xls,xlsx'
    ]);

    Excel::import(new BarangImport, $request->file('file_excel'));

    return redirect()->route('barang.index')->with('success', 'Data barang berhasil diimport!');
}
}

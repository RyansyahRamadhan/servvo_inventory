<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rak;
use App\Models\Gudang;
use App\Models\Lorong;
use App\Exports\RakExport;
use App\Imports\RakImport;
use Maatwebsite\Excel\Facades\Excel;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $rakList = Rak::with(['lorong', 'subRak'])->orderBy('nama_lorong')->orderBy('nama_rak')->get();
    return view('rak.index', compact('rakList'));
}
public function create()
{
    $gudangList = Lorong::select('nama_gudang')->distinct()->pluck('nama_gudang');
    return view('rak.create', compact('gudangList'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nama_rak' => 'required|string|unique:rak,nama_rak',
        'nama_lorong' => 'required|string',
        'kapasitas_total' => 'required|integer|min:1',
        'kapasitas_tersedia' => 'required|integer|min:0|max:' . $request->kapasitas_total,
    ]);

    Rak::create([
        'nama_rak' => $request->nama_rak,
        'nama_lorong' => $request->nama_lorong,
        'kapasitas_total' => $request->kapasitas_total,
        'kapasitas_tersedia' => $request->kapasitas_tersedia,
    ]);

    return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan.');
}

public function getLorongByGudang(Request $request)
{
    $nama_gudang = $request->query('nama_gudang');
    $lorong = Lorong::where('nama_gudang', $nama_gudang)->pluck('nama_lorong');
    return response()->json($lorong);
}

public function edit($id)
{
    $rak = Rak::findOrFail($id);
    $lorongList = Lorong::all(); // Untuk dropdown
    return view('rak.edit', compact('rak', 'lorongList'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_lorong' => 'required|string',
        'nama_rak' => 'required|string',
        'kapasitas_total' => 'required|numeric',
        'kapasitas_tersedia' => 'required|numeric',
    ]);

    $rak = Rak::findOrFail($id);
    $rak->update([
        'nama_lorong' => $request->nama_lorong,
        'nama_rak' => $request->nama_rak,
        'kapasitas_total' => $request->kapasitas_total,
        'kapasitas_tersedia' => $request->kapasitas_tersedia,
    ]);

    return redirect()->route('rak.index')->with('success', 'Data Rak berhasil diperbarui!');
}
public function destroy($id)
{
    $rak = Rak::findOrFail($id);
    $rak->delete();

    return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus');
}

public function export()
{
    return Excel::download(new RakExport, 'data_rak.xlsx');
}

public function import(Request $request)
{
   $request->validate([
        'file_excel' => 'required|file|mimes:xls,xlsx'
    ]);

    Excel::import(new RakImport, $request->file('file_excel'));

    return redirect()->route('rak.index')->with('success', 'Data barang berhasil diimport!');
}
public function show($id)
{
    // Bisa redirect saja kalau tidak digunakan
    return redirect()->route('rak.index');
}

}

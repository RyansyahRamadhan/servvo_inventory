<?php

namespace App\Http\Controllers;

use App\Models\Lorong;
use App\Models\Gudang; 
use Illuminate\Http\Request;
use App\Exports\LorongExport;
use App\Imports\LorongImport;
use Maatwebsite\Excel\Facades\Excel;

class LorongController extends Controller
{   
    public function index()
    {
        $lorongList = Lorong::all();
        return view('lorong.index', compact('lorongList'));
    }
    public function create()
{
    $gudangList = Gudang::all(); // Ambil semua gudang
    return view('lorong.create', compact('gudangList'));
}


    public function destroy($id)
{
    $lorong = Lorong::findOrFail($id);
    $lorong->delete();

    return redirect()->route('lorong.index')->with('success', 'Data Lorong berhasil dihapus!');
}
    public function store(Request $request)
{
    $request->validate([
        'nama_lorong' => 'required|string|max:255',
        'nama_gudang' => 'required|string'
    ]);

    Lorong::create([
        'nama_lorong' => $request->nama_lorong,
        'nama_gudang' => $request->nama_gudang
    ]);

    return redirect()->route('lorong.index')->with('success', 'Data Lorong berhasil disimpan!');
}
public function edit($id)
{
    $lorong = Lorong::findOrFail($id);
    $gudangList = Gudang::all(); // untuk dropdown
    return view('lorong.edit', compact('lorong', 'gudangList'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_lorong' => 'required|string|max:255',
        'nama_gudang' => 'required|string'
    ]);

    $lorong = Lorong::findOrFail($id);
    $lorong->update([
        'nama_lorong' => $request->nama_lorong,
        'nama_gudang' => $request->nama_gudang
    ]);

    return redirect()->route('lorong.index')->with('success', 'Data Lorong berhasil diperbarui!');
}

public function export()
{
    return Excel::download(new LorongExport, 'data_lorong.xlsx');
}
public function import(Request $request)
{
    $request->validate([
        'file_excel' => 'required|file|mimes:xlsx,xls,csv'
    ]); 

    Excel::import(new LorongImport, $request->file('file_excel'));

    return redirect()->route('lorong.index')->with('success', 'Data Lorong berhasil diimport.');
}
}


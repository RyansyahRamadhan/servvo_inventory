<?php

namespace App\Http\Controllers\Master;


use App\Http\Controllers\Controller;
use App\Models\Master\StandartPallet;
use App\Models\Lorong;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Exports\StandartPalletExport;
use App\Imports\StandartPalletImport;
use Maatwebsite\Excel\Facades\Excel;



class StandartPalletController extends Controller
{
    public function index()
    {
        $data = StandartPallet::all();
        return view('master.standartpallet.index', compact('data'));
    }

    public function destroy($id)
    {
        StandartPallet::where('kode_barang', $id)->delete();
        return redirect()->route('standartpallet.index')->with('success', 'Data berhasil dihapus');
    }
    public function create()
{
    $lorong = Lorong::select('nama_lorong')->distinct()->orderBy('nama_lorong')->get();
    return view('master.standartpallet.create', compact('lorong'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'kode_barang' => 'required|string|max:50|unique:standar_rak_pallet,kode_barang',
        'nama_barang' => 'required|string',
        'kategori_barang' => 'required|string',
        'uom' => 'required|string',
        'kapasitas' => 'required|numeric',
        'isi_per_pallet' => 'required|numeric',
        'isi_dus_per_pallet' => 'required|numeric',
        'berat_dus' => 'required|numeric',
        'berat_per_pallet' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'tanggal_berlaku' => 'required|date',
        'nama_lorong' => 'required|string',
        'status' => 'required|in:aktif,non-aktif',
    ]);

    StandartPallet::create($validated);

    return redirect()->route('standartpallet.index')->with('success', 'Data berhasil disimpan.');
}
public function edit($kode_barang)
{
    // Ambil data standar pallet berdasarkan kode_barang
    $standartPallet = StandartPallet::where('kode_barang', $kode_barang)->firstOrFail();

    // Ambil daftar lorong untuk dropdown
    $lorong = Lorong::select('nama_lorong')->distinct()->get();

    // Kirim data ke view edit
    return view('master.standartpallet.edit', compact('standartPallet', 'lorong'));
}
public function update(Request $request, $kode_barang)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_barang' => 'required|string|max:255',
        'uom' => 'required|string|max:100',
        'kapasitas' => 'required|numeric',
        'isi_per_pallet' => 'required|numeric',
        'isi_dus_per_pallet' => 'required|numeric',
        'berat_dus' => 'required|numeric',
        'berat_per_pallet' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'tanggal_berlaku' => 'required|date',
        'nama_lorong' => 'required|string',
        'status' => 'required|in:aktif,non-aktif',
    ]);

    $standartPallet = StandartPallet::where('kode_barang', $kode_barang)->firstOrFail();

    $standartPallet->update([
        'nama_barang' => $request->nama_barang,
        'kategori_barang' => $request->kategori_barang,
        'uom' => $request->uom,
        'kapasitas' => $request->kapasitas,
        'isi_per_pallet' => $request->isi_per_pallet,
        'isi_dus_per_pallet' => $request->isi_dus_per_pallet,
        'berat_dus' => $request->berat_dus,
        'berat_per_pallet' => $request->berat_per_pallet,
        'deskripsi' => $request->deskripsi,
        'tanggal_berlaku' => $request->tanggal_berlaku,
        'nama_lorong' => $request->nama_lorong,
        'status' => $request->status,
    ]);

    return redirect()->route('standartpallet.index')->with('success', 'Data berhasil diperbarui');
}
    public function export()
{
    return Excel::download(new StandartPalletExport, 'standart_pallet.xlsx');
}
public function import(Request $request)
{
    $request->validate([
        'file_excel' => 'required|mimes:xls,xlsx',
    ]);

    Excel::import(new StandartPalletImport, $request->file('file_excel'));

    return redirect()->route('standartpallet.index')->with('success', 'Data berhasil diimport');
}
}
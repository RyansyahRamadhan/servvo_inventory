<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\SubRak;
use Illuminate\Http\Request;

class SubRakController extends Controller
{
    public function create()
    {
        $rakList = Rak::where('nama_lorong', 'Lorong 2')->orderBy('nama_rak')->get();
        return view('subrak.create', compact('rakList'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'nama_lorong' => 'required|string',
        'nama_rak' => 'required|string',
        'jumlah_subrak' => 'required|integer|min:1',
        'kapasitas' => 'required|integer|min:1',
    ]);

    for ($i = 1; $i <= $validated['jumlah_subrak']; $i++) {
        $kode = str_pad($i, 2, '0', STR_PAD_LEFT);
        $kodeSubRak = $kode;
        $labelFull = $validated['nama_rak'] . '-' . $kode;

        SubRak::create([
            'nama_rak' => $validated['nama_rak'],
            'kode_sub_rak' => $kodeSubRak,
            'label_full' => $labelFull,
            'kapasitas' => $validated['kapasitas'],
            'kapasitas_tersedia' => $validated['kapasitas'],
        ]);
    }

    return redirect()->route('rak.index')->with('success', 'Sub-Rak berhasil ditambahkan.');
}

}

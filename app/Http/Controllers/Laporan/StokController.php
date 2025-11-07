<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');     // kode/nama barang
        $rak    = $request->get('rak');   // nama_rak

        $query = DB::table('stock_on_hand as soh')
            ->join('rak as r', 'r.id_rak', '=', 'soh.rak_id')
            ->join('barang as b', 'b.kode_barang', '=', 'soh.kode_barang')
            ->select(
                'b.kode_barang',
                'b.nama_barang',
                'r.nama_rak',
                'r.nama_lorong',
                'soh.qty',
                'soh.updated_at'
            )
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('b.kode_barang', 'like', "%{$search}%")
                       ->orWhere('b.nama_barang', 'like', "%{$search}%");
                });
            })
            ->when($rak, fn($q) => $q->where('r.nama_rak', $rak))
            ->orderBy('b.nama_barang');

        $data = $query->paginate(50)->withQueryString();

        $listRak = DB::table('rak')->orderBy('nama_rak')->pluck('nama_rak');

        return view('Laporan.stok', compact('data', 'listRak', 'search', 'rak'));
    }
}

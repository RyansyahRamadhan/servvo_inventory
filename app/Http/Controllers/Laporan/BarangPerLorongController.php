<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rak;
use App\Models\StockOnHand; // anggap model ini ada

class BarangPerLorongController extends Controller
{
    public function index()
    {
        $lorongList = Rak::distinct()->pluck('nama_lorong');
        return view('Laporan.barang_per_lorong.index', compact('lorongList'));
    }

    public function show($lorong)
    {
        // Total stok per barang dalam lorong tsb
        $data = StockOnHand::select(
                    'kode_barang',
                    DB::raw('SUM(qty) as total_qty')
                )
                ->where('lorong', $lorong)
                ->groupBy('kode_barang')
                ->get();

        return view('Laporan.barang_per_lorong.show', compact('lorong', 'data'));
    }

    public function detail($lorong, $kode_barang)
    {
        $detail = StockOnHand::where('lorong', $lorong)
                             ->where('kode_barang', $kode_barang)
                             ->get();

        return view('Laporan.barang_per_lorong.detail', compact('lorong', 'kode_barang', 'detail'));
    }
}

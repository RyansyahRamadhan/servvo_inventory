<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOnHandController extends Controller
{
    /**
     * Laporan stok per barang per rak.
     * Filters: lorong, kode_barang, id_rak (opsional)
     */
public function perRak(Request $request)
{
    $lorong = $request->get('lorong');
    $kode   = $request->get('kode_barang');
    $idRak  = $request->get('id_rak');

    $query = DB::table('vw_stock_on_hand as v')
        ->join('rak as r', 'r.id_rak', '=', 'v.id_rak')
        ->leftJoin('barang as b', 'b.kode_barang', '=', 'v.kode_barang') // fallback nama barang
        ->select(
            'v.kode_barang',
            'r.id_rak',
            'r.nama_rak',
            'r.nama_lorong',
            DB::raw('MAX(COALESCE(v.nama_barang, b.nama_barang)) AS nama_barang'),
            DB::raw('SUM(v.qty) AS qty')
        )
        ->when($lorong, fn($q) => $q->where('r.nama_lorong', $lorong))
        ->when($kode,   fn($q) => $q->where('v.kode_barang', $kode))
        ->when($idRak,  fn($q) => $q->where('r.id_rak', $idRak))
        ->groupBy('v.kode_barang', 'r.id_rak', 'r.nama_rak', 'r.nama_lorong')
        ->orderBy('r.nama_lorong')
        ->orderBy('r.nama_rak')
        ->orderBy('v.kode_barang');

    $data = $query->paginate(50)->withQueryString();

    // dropdown
    $lorongList = DB::table('rak')->distinct()->orderBy('nama_lorong')->pluck('nama_lorong');
    $rakList    = DB::table('rak')
                    ->when($lorong, fn($q) => $q->where('nama_lorong', $lorong))
                    ->orderBy('nama_rak')
                    ->get(['id_rak','nama_rak']);
    $kodeList   = DB::table('vw_stock_on_hand')
                    ->distinct()->orderBy('kode_barang')->pluck('kode_barang');

    return view('Laporan.stok_per_rak', compact('data','lorongList','rakList','kodeList','lorong','kode','idRak'));
}
    /**
     * Laporan stok per barang per lorong (agregat beberapa rak).
     * Filters: lorong, kode_barang (opsional)
     */
    public function perLorong(Request $request)
    {
        $lorong = $request->get('lorong');
        $kode   = $request->get('kode_barang');

       $query = DB::table('vw_stock_on_hand as v')
    ->join('rak as r', 'r.id_rak', '=', 'v.id_rak')
    ->select('r.nama_lorong', 'v.kode_barang', DB::raw('SUM(v.qty) as qty'))
    ->groupBy('r.nama_lorong', 'v.kode_barang')
    ->orderBy('r.nama_lorong')
    ->orderBy('v.kode_barang');

        if ($lorong) $query->where('r.nama_lorong', $lorong);
if ($kode)   $query->where('v.kode_barang', $kode);

$data = $query->paginate(50)->withQueryString();

        $lorongList = DB::table('rak')->distinct()->orderBy('nama_lorong')->pluck('nama_lorong');
        $kodeList   = DB::table('vw_stock_on_hand')->distinct()->orderBy('kode_barang')->pluck('kode_barang');

        return view('Laporan.stok_per_lorong', compact('data','lorongList','kodeList','lorong','kode'));
    }
}

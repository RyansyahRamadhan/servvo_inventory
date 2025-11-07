<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryBarangController extends Controller
{
    public function index(Request $request)
    {
        $q       = $request->get('q');      // kode/nama barang
        $dari    = $request->get('dari');
        $sampai  = $request->get('sampai');

        $hist = DB::table('mutasi_rak as m')
            ->join('barang as b', 'b.kode_barang', '=', 'm.kode_barang')
            ->leftJoin('rak as ra', 'ra.id_rak', '=', 'm.rak_asal_id')
            ->leftJoin('rak as rt', 'rt.id_rak', '=', 'm.rak_tujuan_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->selectRaw("
                m.tanggal,
                b.kode_barang, b.nama_barang,
                ra.nama_rak AS rak_asal, rt.nama_rak AS rak_tujuan,
                m.qty,
                CASE
                    WHEN ra.id_rak IS NULL THEN 'IN'
                    WHEN rt.id_rak IS NULL THEN 'OUT'
                    ELSE 'MOVE'
                END AS tipe,
                m.deskripsi,
                u.name AS user
            ")
            ->when($q, function ($qry) use ($q) {
                $qry->where(function ($w) use ($q) {
                    $w->where('b.kode_barang', 'like', "%{$q}%")
                      ->orWhere('b.nama_barang', 'like', "%{$q}%");
                });
            })
            ->when($dari, fn($qry) => $qry->whereDate('m.tanggal', '>=', $dari))
            ->when($sampai, fn($qry) => $qry->whereDate('m.tanggal', '<=', $sampai))
            ->orderBy('m.tanggal', 'desc');

        $data = $hist->paginate(50)->withQueryString();

        return view('Laporan.history_barang', compact('data', 'q', 'dari', 'sampai'));
    }
}

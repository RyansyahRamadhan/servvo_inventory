<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiPerRakController extends Controller
{
    public function index(Request $request)
    {
        $rak     = $request->get('rak');      // nama_rak
        $dari    = $request->get('dari');     // Y-m-d
        $sampai  = $request->get('sampai');   // Y-m-d

        $mov = DB::table('mutasi_rak as m')
            ->leftJoin('rak as ra', 'ra.id_rak', '=', 'm.rak_asal_id')
            ->leftJoin('rak as rt', 'rt.id_rak', '=', 'm.rak_tujuan_id')
            ->join('barang as b', 'b.kode_barang', '=', 'm.kode_barang')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->selectRaw("
                m.tanggal,
                b.kode_barang, b.nama_barang,
                ra.nama_rak AS rak_asal, rt.nama_rak AS rak_tujuan,
                ra.nama_lorong AS lorong_asal, rt.nama_lorong AS lorong_tujuan,
                m.qty,
                -- tipe transaksi untuk tampilan
                CASE
                    WHEN ra.id_rak IS NULL THEN 'IN'
                    WHEN rt.id_rak IS NULL THEN 'OUT'
                    ELSE 'MOVE'
                END AS tipe,
                m.deskripsi,
                u.name AS user
            ")
            ->when($rak, function ($q) use ($rak) {
                $q->where(function ($qq) use ($rak) {
                    $qq->where('ra.nama_rak', $rak)
                       ->orWhere('rt.nama_rak', $rak);
                });
            })
            ->when($dari, fn($q) => $q->whereDate('m.tanggal', '>=', $dari))
            ->when($sampai, fn($q) => $q->whereDate('m.tanggal', '<=', $sampai))
            ->orderBy('m.tanggal', 'desc');

        $data = $mov->paginate(50)->withQueryString();

        $listRak = DB::table('rak')->orderBy('nama_rak')->pluck('nama_rak');

        return view('Laporan.transaksi_per_rak', compact('data', 'listRak', 'rak', 'dari', 'sampai'));
    }
}

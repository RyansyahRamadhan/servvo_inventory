<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;



class StokController extends Controller
{
    public function index()
    {
        $stokList = DB::table('barang_masuk')
            ->select(
                'kode_barang',
                'nama_barang',
                'kategori_barang',
                DB::raw('SUM(jumlah) as total_stok')
            )
            ->groupBy('kode_barang', 'nama_barang', 'kategori_barang')
            ->get();

        return view('daftar.stok.index', compact('stokList'));
    }
    public function detail(Request $request, $kode_barang)
{
    $tanggal_awal = $request->tanggal_awal;
    $tanggal_akhir = $request->tanggal_akhir;

    // Ambil semua data
    $masuk = DB::table('barang_masuk')->where('kode_barang', $kode_barang);
    $fpb   = DB::table('fpb')->where('kode_barang', $kode_barang);
    $mutasi = DB::table('move_rak')->where('kode_barang', $kode_barang);

    // Filter berdasarkan tanggal jika diisi
    if ($tanggal_awal && $tanggal_akhir) {
        $masuk->whereBetween('tanggal_masuk', [$tanggal_awal, $tanggal_akhir]);
        $fpb->whereBetween('tanggal_fpb', [$tanggal_awal, $tanggal_akhir]);
        $mutasi->whereBetween('tanggal_pindah', [$tanggal_awal, $tanggal_akhir]);
    }

    $masuk = $masuk->get();
     $fpb = $fpb->get();
   // $mutasi = $mutasi->get();

    $nama_barang = optional($masuk->first())->nama_barang ?? 'Tidak Diketahui';

    $riwayat = [];

    foreach ($masuk as $row) {
        $riwayat[] = [
            'tanggal' => $row->tanggal_masuk,
            'dokumen' => $row->no_dokumen_masuk,
            'keterangan' => 'Penerimaan Barang',
            'masuk' => $row->jumlah,
            'keluar' => 0,
        ];
    }

   foreach ($fpb as $row) {
        $riwayat[] = [
            'tanggal' => $row->tanggal_fpb,
            'dokumen' => $row->no_fpb,
            'keterangan' => $row->keperluan ?? 'Pengeluaran (FPB)',
            'masuk' => 0,
            'keluar' => $row->jumlah,
        ];
    }

    // Urutkan berdasarkan tanggal
    usort($riwayat, fn($a, $b) => strtotime($a['tanggal']) <=> strtotime($b['tanggal']));

    // Hitung saldo
    $saldo = 0;
    foreach ($riwayat as &$row) {
        $saldo += $row['masuk'] - $row['keluar'];
        $row['saldo'] = $saldo;
    }

    return view('daftar.stok.detail', compact('riwayat', 'nama_barang', 'tanggal_awal', 'tanggal_akhir'));
}
public function rak($kode_barang)
{
    // Data dari barang masuk
    $masuk = DB::table('barang_masuk')
        ->select('nama_lorong', 'nama_rak', DB::raw('SUM(jumlah) as total'))
        ->where('kode_barang', $kode_barang)
        ->groupBy('nama_lorong', 'nama_rak');

    // Data dari mutasi rak (move_rak)
    /*$mutasi = DB::table('move_rak')
        ->select('nama_lorong_tujuan as nama_lorong', 'rak_tujuan as nama_rak', DB::raw('SUM(jumlah) as total'))
        ->where('kode_barang', $kode_barang)
        ->groupBy('nama_lorong_tujuan', 'rak_tujuan');
        */
    // Gabungkan dua sumber data
    //$rakGabungan = $masuk->unionAll($mutasi);
    
    // Hitung total jumlah per rak setelah digabung
    /*$rakFinal = DB::table(DB::raw("({$rakGabungan->toSql()}) as rak_data"))
        ->mergeBindings($rakGabungan) // penting!
        ->select('nama_lorong', 'nama_rak', DB::raw('SUM(total) as total_barang'))
        ->groupBy('nama_lorong', 'nama_rak')
        ->get();
        */
    // Ambil nama barang (untuk tampilan)
    $nama_barang = DB::table('barang_masuk')
        ->where('kode_barang', $kode_barang)
        ->value('nama_barang');

    return view('stok.detail_rak', compact('rakFinal', 'kode_barang', 'nama_barang'));
}


public function showDetailRingkasan($kode_barang)
{
    $masuk = DB::table('barang_masuk')
        ->where('kode_barang', $kode_barang)
        ->select('tanggal_masuk as tanggal', 'no_dokumen_masuk as dokumen', DB::raw('jumlah as qty_masuk'))
        ->get();

    $fpb = DB::table('fpb')
        ->where('kode_barang', $kode_barang)
        ->select('tanggal_fpb as tanggal', 'no_fpb as dokumen', DB::raw('jumlah as qty_keluar'))
        ->get();

    $mutasi = DB::table('move_rak')
        ->where('kode_barang', $kode_barang)
        ->select('tanggal_pindah as tanggal', DB::raw('CONCAT(rak_asal,"→",rak_tujuan) as dokumen'), DB::raw('jumlah as qty_mutasi'))
        ->get();
    

    $mutasi = $mutasi->map(function ($row) {
        $row->qty_masuk = 0;
        $row->qty_keluar = 0;
        return $row;
    });

    // Gabungkan semua data
    $data = collect();

    foreach ($masuk as $row) {
        $data->push((object)[
            'tanggal' => $row->tanggal,
            'dokumen' => $row->dokumen,
            'qty_masuk' => $row->qty_masuk,
            'qty_keluar' => 0
        ]);
    }

    foreach ($fpb as $row) {
        $data->push((object)[
            'tanggal' => $row->tanggal,
            'dokumen' => $row->dokumen,
            'qty_masuk' => 0,
            'qty_keluar' => $row->qty_keluar
        ]);
    }

    // Jika ingin mutasi dimasukkan juga (anggap netral, tidak menambah/mengurangi stok)
    foreach ($mutasi as $row) {
        $data->push((object)[
            'tanggal' => $row->tanggal,
            'dokumen' => $row->dokumen,
            'qty_masuk' => 0,
            'qty_keluar' => 0
        ]);
    }

    // Urutkan dan hitung saldo
    $data = $data->sortBy('tanggal')->values();

    $saldo = 0;
    foreach ($data as $item) {
        $saldo += $item->qty_masuk;
        $saldo -= $item->qty_keluar;
        $item->saldo = $saldo;
    }

    // Ambil nama barang
    $nama_barang = optional($masuk->first())->nama_barang ?? optional($fpb->first())->nama_barang ?? 'Unknown';

    return view('stok.ringkasan', compact('data', 'kode_barang', 'nama_barang'));
}

}


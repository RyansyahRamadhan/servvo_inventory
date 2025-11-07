<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/barang', function (\Illuminate\Http\Request $r) {
    $kode = trim((string) $r->query('kode', ''));

    if ($kode === '') {
        return response()->json(['error' => 'kode kosong'], 400);
    }

    // Normalisasi: hilangkan spasi sebelum dibandingkan
    $row = DB::table('barang')
        ->whereRaw('REPLACE(kode_barang," ","") = REPLACE(?, " ", "")', [$kode])
        ->first();

    return $row
        ? response()->json(['kode_barang'=>$row->kode_barang, 'nama_barang'=>$row->nama_barang])
        : response()->json(['error' => 'not found'], 404);
});

Route::get('/barang', function (\Illuminate\Http\Request $r) {
    $kode = trim((string)$r->query('kode',''));
    if ($kode==='') return response()->json(['error'=>'kode kosong'],400);

    $row = DB::table('barang')
        ->whereRaw('REPLACE(kode_barang," ","") = REPLACE(?, " ", "")', [$kode])
        ->first(['kode_barang','nama_barang']);
    return $row ? response()->json($row) : response()->json(['error'=>'not found'],404);
});

Route::get('/standar-rak', function (\Illuminate\Http\Request $r) {
    $kode = trim((string)$r->query('kode',''));
    if ($kode==='') return response()->json(['error'=>'kode kosong'],400);

    // asumsi tabel: standar_rak_pallet(kode_barang, kategori, nama_lorong)
    $row = DB::table('standar_rak_pallet')
        ->whereRaw('REPLACE(kode_barang," ","") = REPLACE(?, " ", "")', [$kode])
        ->first(['kategori','nama_lorong as lorong_standar']);
    return $row ? response()->json($row) : response()->json(['error'=>'not found'],404);
});
// routes/api.php
Route::get('/rak/terisi', function (\Illuminate\Http\Request $r) {
    $lorong = (string) $r->query('lorong', '');
    $kode   = trim((string) $r->query('kode', '')); // opsional filter barang
    if ($lorong === '') return response()->json([]);

    // Ambil dari VIEW (selalu up-to-date karena baca live)
    $q = DB::table('vw_stock_on_hand as v')
        ->join('rak as r', 'r.id_rak', '=', 'v.id_rak')
        ->where('r.nama_lorong', $lorong)
        ->groupBy('r.id_rak','r.nama_rak')
        ->select('r.id_rak','r.nama_rak', DB::raw('SUM(v.qty) as qty'));

    if ($kode !== '') {
        $q->where('v.kode_barang', $kode);
    }

    $rows = $q->havingRaw('SUM(v.qty) > 0')
              ->orderBy('r.nama_rak')
              ->get();

    return response()->json($rows); // [{id_rak, nama_rak, qty}]
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

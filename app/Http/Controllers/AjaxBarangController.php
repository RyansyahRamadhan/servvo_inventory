<?php

    namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Formula;

class AjaxBarangController extends Controller
{
    public function getNamaFormula(Request $request)
{
      $kode = trim($request->kode_formula);
    $barang = Barang::where('kode_barang', $kode)->first();

    return response()->json([
        'nama_formula' => $barang?->nama_barang ?? null,
    ]);
}

public function getNamaBarang(Request $request)
{
    $barang = Barang::where('kode_barang', $request->kode_barang)->first();
    return response()->json([
        'nama_barang' => $barang->nama_barang ?? null,
    ]);
}
    }


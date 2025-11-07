<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getNamaBarangKategori(Request $request)
    {
        $kode = $request->query('kode_barang');

        if (!$kode) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = DB::table('standar_rak_pallet')
            ->select('nama_barang', 'kategori_barang')
            ->where('kode_barang', $kode)
            ->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json([
                'nama_barang' => 'Tidak ditemukan',
                'kategori_barang' => 'Tidak ditemukan'
            ]);
        }
    }
}

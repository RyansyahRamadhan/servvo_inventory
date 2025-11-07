<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokPerLorongController extends Controller
{

public function index(Request $request)
{
    $kode   = trim((string) $request->get('kode_barang', '')); // optional (boleh partial)
    $lorong = trim((string) $request->get('lorong', ''));      // optional

    // ===== Dropdown: aman tanpa ONLY_FULL_GROUP_BY (ambil dari tabel rak) =====
    $lorongList = DB::table('rak')
        ->selectRaw('TRIM(nama_lorong) AS nama_lorong')
        ->whereNotNull('nama_lorong')
        ->groupBy(DB::raw('TRIM(nama_lorong)'))
        ->orderBy('nama_lorong')
        ->pluck('nama_lorong');

    // ===== Normalizer untuk lorong & kode (buang NBSP, TAB, CR/LF, zero-width) =====
    $normLor = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(v.nama_lorong, CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''))";
    $normKod = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(v.kode_barang, CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''), 0xE2808B, ''))";

    // ===== Base subquery: sudah punya kolom norm_lorong & norm_kode =====
    $base = DB::table('vw_stock_on_hand as v')
        ->selectRaw("
            $normLor AS norm_lorong,
            $normKod AS norm_kode,
            v.nama_barang        AS nama_barang,
            v.qty                AS qty
        ");

    // ===== Agregasi final: 1 baris per (Lorong, Kode Barang) =====
    $data = DB::query()
        ->fromSub($base, 'x')
        ->selectRaw("
            x.norm_lorong        AS nama_lorong,
            x.norm_kode          AS kode_barang,
            MAX(x.nama_barang)   AS nama_barang,
            SUM(x.qty)           AS total_qty
        ")
        ->when($kode !== '',   fn($q) => $q->where('x.norm_kode', 'like', '%'.$kode.'%'))
        ->when($lorong !== '', fn($q) => $q->where('x.norm_lorong', $lorong))
        ->groupBy('x.norm_lorong', 'x.norm_kode')
        ->orderBy('x.norm_lorong')
        ->orderBy('x.norm_kode')
        ->get();

    return view('Laporan.stok_per_lorong.index', compact('data','kode','lorong','lorongList'));
}





    // 2) DETAIL — JSON untuk history (dipakai versi modal/JS)
   public function detail(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|string',
        'lorong'      => 'nullable|string',
    ]);

    $kode   = $request->kode_barang;
    $lorong = $request->lorong;

    try {
        // 1) MASUK (barang_masuk)
        $bm = DB::table('barang_masuk as bm')
            ->leftJoin('rak as r', function($j){
                $j->on(DB::raw("TRIM(r.nama_rak) COLLATE utf8mb4_unicode_ci"),
                       '=',
                       DB::raw("TRIM(bm.nama_rak) COLLATE utf8mb4_unicode_ci"));
            })
            ->selectRaw("
                bm.tanggal_masuk  as tanggal,
                'MASUK'           as jenis,
                COALESCE(bm.no_dokumen_masuk, '-') as no_dokumen,
                r.nama_lorong     as lorong,
                COALESCE(r.nama_rak, bm.nama_rak)  as rak,
                bm.jumlah         as qty,
                bm.kode_barang    as kode_barang
            ")
            ->where('bm.kode_barang', $kode)
            ->when($lorong, fn($q) => $q->whereRaw("TRIM(r.nama_lorong) = TRIM(?)", [$lorong]))
            ->get()->toArray();

        // 2) KELUAR (FPB)
        $fpb = DB::table('fpb_detail as fd')
            ->leftJoin('rak as r', function($j){
                // fd.rak contoh: "B-A-01-02 (ambi: ...)" → ambil sebelum spasi
                $j->on(DB::raw("TRIM(r.nama_rak) COLLATE utf8mb4_unicode_ci"),
                       '=',
                       DB::raw("TRIM(SUBSTRING_INDEX(fd.rak,' ',1)) COLLATE utf8mb4_unicode_ci"));
            })
            ->join('fpb as f', 'f.no_fpb', '=', 'fd.no_fpb')
            ->selectRaw("
                f.tanggal_fpb     as tanggal,
                'KELUAR (FPB)'    as jenis,
                f.no_fpb          as no_dokumen,
                r.nama_lorong     as lorong,
                COALESCE(r.nama_rak, TRIM(SUBSTRING_INDEX(fd.rak,' ',1))) as rak,
                -fd.qty           as qty,
                fd.kode_barang    as kode_barang
            ")
            ->where('fd.kode_barang', $kode)
            ->when($lorong, fn($q) => $q->whereRaw("TRIM(r.nama_lorong) = TRIM(?)", [$lorong]))
            ->get()->toArray();

        // 3) MUTASI OUT
        $mutasiOut = DB::table('mutasi_rak as mr')
            ->join('rak as r1', 'r1.id_rak', '=', 'mr.rak_asal_id')
            ->selectRaw("
                mr.tanggal        as tanggal,
                'MUTASI OUT'      as jenis,
                CONCAT('MUT-', mr.id) as no_dokumen,
                r1.nama_lorong    as lorong,
                r1.nama_rak       as rak,
                -mr.qty           as qty,
                mr.kode_barang    as kode_barang
            ")
            ->where('mr.kode_barang', $kode)
            ->when($lorong, fn($q) => $q->whereRaw("TRIM(r1.nama_lorong) = TRIM(?)", [$lorong]))
            ->get()->toArray();

        // 4) MUTASI IN
        $mutasiIn = DB::table('mutasi_rak as mr')
            ->join('rak as r2', 'r2.id_rak', '=', 'mr.rak_tujuan_id')
            ->selectRaw("
                mr.tanggal        as tanggal,
                'MUTASI IN'       as jenis,
                CONCAT('MUT-', mr.id) as no_dokumen,
                r2.nama_lorong    as lorong,
                r2.nama_rak       as rak,
                mr.qty            as qty,
                mr.kode_barang    as kode_barang
            ")
            ->where('mr.kode_barang', $kode)
            ->when($lorong, fn($q) => $q->whereRaw("TRIM(r2.nama_lorong) = TRIM(?)", [$lorong]))
            ->get()->toArray();

        // 5) LPBHP = MASUK (pakai lpbhp_detail untuk lokasi RAK) — ROBUST FILTER
        $lpbhp = DB::table('lpbhp as l')
            ->join('lpbhp_detail as ld', 'ld.no_lpbhp', '=', 'l.no_lpbhp')
            ->leftJoin('rak as r', function($j){
                $j->on(DB::raw("TRIM(r.nama_rak) COLLATE utf8mb4_unicode_ci"),
                       '=',
                       DB::raw("TRIM(ld.nama_rak) COLLATE utf8mb4_unicode_ci"));
            })
            ->selectRaw("
                l.tanggal_lpbhp   as tanggal,
                'MASUK (LPBHP)'   as jenis,
                l.no_lpbhp        as no_dokumen,
                r.nama_lorong     as lorong,
                COALESCE(r.nama_rak, ld.nama_rak) as rak,
                l.qty             as qty,
                l.kode_barang     as kode_barang
            ")
            ->where('l.kode_barang', $kode)
            // KUNCI: gunakan EXISTS agar tetap lolos walau left join 'r' NULL
            ->when($lorong, function($q) use ($lorong) {
                $q->whereExists(function($sub) use ($lorong){
                    $sub->from('rak')
                        ->whereRaw("TRIM(rak.nama_rak) COLLATE utf8mb4_unicode_ci = TRIM(ld.nama_rak) COLLATE utf8mb4_unicode_ci")
                        ->whereRaw("TRIM(rak.nama_lorong) = TRIM(?)", [$lorong]);
                });
            })
            ->get()->toArray();

        // Gabung semuanya
        $rows = array_merge($bm, $fpb, $mutasiOut, $mutasiIn, $lpbhp);

        // Sort DESC by tanggal
        usort($rows, function($a, $b){
            $ta = strtotime($a->tanggal ?? '1970-01-01 00:00:00');
            $tb = strtotime($b->tanggal ?? '1970-01-01 00:00:00');
            return $tb <=> $ta;
        });

        return response()->json(['ok' => true, 'data' => $rows]);
    } catch (\Throwable $e) {
        return response()->json(['ok'=>false, 'error'=>$e->getMessage()], 500);
    }
}

    // 3) SHOW DETAIL — halaman Blade terpisah
    public function showDetail($kode_barang, $lorong = null)
    {
        // Reuse method detail() agar logika satu sumber
        $request = new \Illuminate\Http\Request([
            'kode_barang' => $kode_barang,
            'lorong'      => $lorong
        ]);

        $response = $this->detail($request);
        $json     = $response->getData(true);
        $rows     = $json['data'] ?? [];

        // Ganti path view sesuai file kamu:
        return view('Laporan.detail', [
            'kode_barang' => $kode_barang,
            'lorong'      => $lorong,
            'rows'        => $rows
        ]);
    }
    public function rakDetail(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|string',
        'lorong'      => 'nullable|string',
    ]);

    $kode   = trim((string)$request->get('kode_barang'));
    $lorong = trim((string)$request->get('lorong', ''));

    // Normalizer (hapus NBSP/TAB/CR/LF/zero-width + TRIM)
    $normLor = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(v.nama_lorong, CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''))";
    $normKod = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(v.kode_barang,  CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''), 0xE2808B, ''))";
    $normRak = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(v.nama_rak,     CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''))";

    // Base dari view stok (v) → bawa kolom ter-normalisasi
    $base = DB::table('vw_stock_on_hand as v')
        ->selectRaw("
            $normLor AS norm_lorong,
            $normKod AS norm_kode,
            $normRak AS norm_rak,
            v.qty    AS qty
        ");

    // Agregasi per RAK untuk (lorong,kode) yang diminta
    $rows = DB::query()
        ->fromSub($base, 'x')
        ->when($lorong !== '', fn($q) => $q->where('x.norm_lorong', $lorong))
        ->where('x.norm_kode', $kode)
        ->selectRaw("
            x.norm_rak     AS nama_rak,
            SUM(x.qty)     AS qty_rak
        ")
        ->groupBy('x.norm_rak')
        ->orderBy('x.norm_rak')
        ->get();

    return response()->json(['ok' => true, 'data' => $rows]);
}
public function rakExport(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|string',
        'lorong'      => 'nullable|string',
        'nama'        => 'nullable|string', // opsional, untuk nama barang di filename
    ]);

    $kode   = trim((string)$request->get('kode_barang'));
    $lorong = trim((string)$request->get('lorong', ''));
    $nama   = trim((string)$request->get('nama', ''));

    $normLor = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(v.nama_lorong, CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''))";
    $normKod = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(v.kode_barang,  CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''), 0xE2808B, ''))";
    $normRak = "TRIM(REPLACE(REPLACE(REPLACE(REPLACE(v.nama_rak,     CHAR(160), ''), CHAR(9), ''), CHAR(10), ''), CHAR(13), ''))";

    $base = DB::table('vw_stock_on_hand as v')
        ->selectRaw("$normLor AS norm_lorong, $normKod AS norm_kode, $normRak AS norm_rak, v.qty AS qty");

    $rows = DB::query()
        ->fromSub($base, 'x')
        ->when($lorong !== '', fn($q) => $q->where('x.norm_lorong', $lorong))
        ->where('x.norm_kode', $kode)
        ->selectRaw("x.norm_rak AS nama_rak, SUM(x.qty) AS qty_rak")
        ->groupBy('x.norm_rak')
        ->orderBy('x.norm_rak')
        ->get();

    // filename rapi
    $safeLor = $lorong !== '' ? str_replace(['/', '\\', ' '], ['-','-','_'], $lorong) : 'SEMUA';
    $safeKode = str_replace(['/', '\\', ' '], ['-','-',''], $kode);
    $safeNama = $nama !== '' ? preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $nama) : 'ITEM';
    $filename = "DetailRak_{$safeLor}_{$safeKode}_{$safeNama}_" . date('Ymd_His') . ".csv";

    // stream CSV (Excel-friendly UTF-8 BOM)
    return response()->streamDownload(function () use ($rows, $lorong, $kode, $nama) {
        $out = fopen('php://output', 'w');
        // UTF-8 BOM
        fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
        // header info
        fputcsv($out, ['Lorong', $lorong === '' ? '-' : $lorong]);
        fputcsv($out, ['Kode Barang', $kode]);
        if ($nama !== '') fputcsv($out, ['Nama Barang', $nama]);
        fputcsv($out, []); // blank
        // table header
        fputcsv($out, ['Nama Rak', 'Qty']);
        $total = 0;
        foreach ($rows as $r) {
            $q = (int)($r->qty_rak ?? 0);
            $total += $q;
            fputcsv($out, [$r->nama_rak, $q]);
        }
        fputcsv($out, []);
        fputcsv($out, ['TOTAL', $total]);
        fclose($out);
    }, $filename, [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Cache-Control' => 'no-store, no-cache',
    ]);
}

}

<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BarangKeluarController extends Controller
{
    /** List header dokumen keluar */
    public function index()
    {
        $rows = DB::table('barang_keluars as h')
            ->leftJoin('barang_keluar_details as d', 'd.barang_keluar_id', '=', 'h.id')
            ->select(
                'h.id', 'h.no_dokumen', 'h.tanggal', 'h.keterangan', 'h.created_at',
                DB::raw('COUNT(d.id) AS jml_item'),
                DB::raw('COALESCE(SUM(d.qty),0) AS total_qty')
            )
            ->groupBy('h.id','h.no_dokumen','h.tanggal','h.keterangan','h.created_at')
            ->orderByDesc('h.tanggal')->orderByDesc('h.id')
            ->paginate(25);

        return view('Input.barangkeluar.index', compact('rows'));
    }

    /** Form input */
    public function create()
    {
        return view('Input.barangkeluar.create');
    }

    /** Sumber SOH: prioritaskan view utama; compat hanya fallback */
    private function sohSource(): string
    {
        return Schema::hasTable('vw_stock_on_hand')
            ? 'vw_stock_on_hand'
            : 'vw_stock_on_hand_compat';
    }

    /** API: rekomendasi FIFO + daftar rak dengan sisa qty (sinkron dgn laporan) */
 /** API: rekomendasi FIFO + daftar rak (saldo per rak, bukan baris ledger) */
public function fifoBarang(Request $req)
{
    try {
        $kode = trim($req->query('kode', ''));
        if ($kode === '') {
            return response()->json(['success' => false, 'message' => 'Kode barang kosong.'], 400);
        }
        $kodeNorm = preg_replace('/\s+/', '', $kode);

        // Sumber sama dgn laporan (prioritas vw_stock_on_hand)
        $source = $this->sohSource(); // idealnya 'vw_stock_on_hand'
        $cols   = collect(\Illuminate\Support\Facades\Schema::getColumnListing($source))->map(fn($c)=>strtolower($c));

        // Nama kolom yang ada di view
        $hasTanggal = $cols->contains('tanggal');
        $hasQty     = $cols->contains('qty') || $cols->contains('sisa_qty');
        if (!$hasQty) {
            return response()->json(['success'=>false,'message'=>"View {$source} tidak punya kolom qty/sisa_qty."], 500);
        }

        // qty field generic (ledger biasanya 'qty', view saldo bisa 'sisa_qty')
        $qtyExpr = $cols->contains('qty') ? 'qty' : 'sisa_qty';

        // nama lorong di view bisa bervariasi
        $lorCol = $cols->first(fn($c)=>preg_match('/lorong/i',$c)) ?: 'nama_lorong';

        // ====== KUNCI: agregasi saldo per RAK ======
        $sql = "
            SELECT
                s.id_rak,
                s.nama_rak,
                s.{$lorCol} AS nama_lorong,
                MAX(s.nama_barang) AS nama_barang,
                SUM(s.{$qtyExpr}) AS sisa_qty,
                " . ($hasTanggal ? "MIN(CASE WHEN s.{$qtyExpr} > 0 THEN s.tanggal END)" : "NULL") . " AS first_in
            FROM {$source} s
            WHERE REPLACE(TRIM(s.kode_barang), ' ', '') = ?
            GROUP BY s.id_rak, s.nama_rak, s.{$lorCol}
            HAVING SUM(s.{$qtyExpr}) > 0
            ORDER BY " . ($hasTanggal ? "first_in ASC, " : "") . " s.{$lorCol}, s.nama_rak
        ";

        $rows = DB::select($sql, [$kodeNorm]);

        if (empty($rows)) {
            return response()->json([
                'success' => false,
                'message' => 'Barang/stok tidak ditemukan.',
                'debug'   => ['source'=>$source, 'kode_norm'=>$kodeNorm, 'qtyExpr'=>$qtyExpr, 'lorCol'=>$lorCol]
            ]);
        }

        // Nama dari master (fallback dari view)
        $barang = DB::table('barang')
            ->whereRaw("REPLACE(TRIM(kode_barang), ' ', '') = ?", [$kodeNorm])
            ->first();
        $namaBarang = $barang->nama_barang ?? ($rows[0]->nama_barang ?? '');

        $raks = array_map(fn($r)=>[
            'id'       => $r->id_rak,
            'nama_rak' => $r->nama_rak,
            'qty'      => (int)$r->sisa_qty,
            'lorong'   => $r->nama_lorong,
            'first_in' => $r->first_in,
        ], $rows);

        $lorongs = array_values(array_unique(array_map(fn($r)=>$r['lorong'], $raks)));

        return response()->json([
            'success'     => true,
            'nama_barang' => $namaBarang,
            'lorongs'     => $lorongs,
            'raks'        => $raks,
            'meta'        => ['source'=>$source, 'qtyExpr'=>$qtyExpr]
        ]);
    } catch (\Throwable $e) {
        \Log::error('fifoBarang error: '.$e->getMessage());
        return response()->json(['success'=>false,'message'=>'Server error: '.$e->getMessage()],500);
    }
}

    /**
     * Simpan header + detail (alokasi FIFO, SOH dihitung dari transaksi).
     * Expect hidden input `items_json`:
     *   item: { kode_barang, nama_barang, qty, lorong, rak_ids[] }
     */
    public function store(Request $req)
    {
        $req->validate([
            'no_dokumen' => 'required|string|max:50',
            'tanggal'    => 'required|date',
            'items_json' => 'required|string',
        ], [], [
            'no_dokumen' => 'No Dokumen',
            'tanggal'    => 'Tanggal',
            'items_json' => 'Detail Barang',
        ]);

        $items = json_decode($req->items_json, true);
        if (!is_array($items) || empty($items)) {
            return back()->withErrors('Detail barang belum diisi.')->withInput();
        }

        DB::beginTransaction();
        try {
            $headerId = DB::table('barang_keluars')->insertGetId([
                'no_dokumen' => $req->no_dokumen,
                'tanggal'    => $req->tanggal,
                'keterangan' => $req->keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $source = $this->sohSource();
            $cols   = collect(Schema::getColumnListing($source))->map(fn($c)=>strtolower($c));
            $qtyCol = $cols->contains('sisa_qty') ? 'sisa_qty' : ($cols->contains('qty') ? 'qty' : null);
            $lorCol = $cols->first(fn($c)=>preg_match('/lorong/i',$c)) ?: 'nama_lorong';
            $hasFI  = $cols->contains('tanggal_first_in');

            foreach ($items as $i => $it) {
                $kode    = trim($it['kode_barang'] ?? '');
                $nama    = trim($it['nama_barang'] ?? '');
                $qtyReq  = (int)($it['qty'] ?? 0);
                $lorong  = trim($it['lorong'] ?? '');
                $rakIds  = $it['rak_ids'] ?? [];

                if (!$kode || $qtyReq <= 0) {
                    throw new \Exception("Baris #".($i+1)." tidak valid (kode/qty).");
                }

                $sql = "SELECT 
                            id_rak, nama_rak, {$lorCol} AS nama_lorong,
                            (COALESCE(NULLIF({$qtyCol}, ''), '0') + 0) AS qty_num"
                        . ($hasFI ? ", tanggal_first_in" : "") .
                       " FROM {$source}
                         WHERE REPLACE(TRIM(kode_barang), ' ', '') = ?
                           AND (COALESCE(NULLIF({$qtyCol}, ''), '0') + 0) > 0"
                         . ($lorong ? " AND {$lorCol} = ?" : "")
                         . (!empty($rakIds) ? " AND id_rak IN (".implode(',', array_map('intval',$rakIds)).")" : "")
                         . " ORDER BY ".($hasFI ? "tanggal_first_in ASC, " : "")." {$lorCol}, nama_rak";

                $params = [ preg_replace('/\s+/', '', $kode) ];
                if ($lorong) $params[] = $lorong;
                $stokRows = DB::select($sql, $params);

                if (empty($stokRows)) {
                    throw new \Exception("Baris #".($i+1).": stok tidak tersedia (filter lorong/rak terlalu ketat?).");
                }

                $remain = $qtyReq;
                foreach ($stokRows as $r) {
                    if ($remain <= 0) break;
                    $take = min((int)$r->qty_num, $remain);
                    if ($take <= 0) continue;

                    DB::table('barang_keluar_details')->insert([
                        'barang_keluar_id' => $headerId,
                        'kode_barang'      => $kode,
                        'nama_barang'      => $nama ?: ($it['nama_barang'] ?? ''),
                        'id_rak'           => $r->id_rak,
                        'nama_rak'         => $r->nama_rak,
                        'nama_lorong'      => $r->nama_lorong,
                        'qty'              => $take,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);

                    $remain -= $take;
                }

                if ($remain > 0) {
                    throw new \Exception("Baris #".($i+1).": stok kurang {$remain} unit. Pilih rak tambahan.");
                }
            }

            DB::commit();
            return redirect()->route('input.barangkeluar.index')->with('ok', 'Barang Keluar tersimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /** Detail (read-only) */
    public function show($id)
    {
        $h = DB::table('barang_keluars')->where('id',$id)->first();
        abort_if(!$h, 404);
        $d = DB::table('barang_keluar_details')->where('barang_keluar_id',$id)->orderBy('id')->get();
        return view('Input.barangkeluar.show', compact('h','d'));
    }

    /** Edit form (prefill + UI sama seperti create) */
    public function edit($id)
    {
        $h = DB::table('barang_keluars')->where('id',$id)->first();
        abort_if(!$h, 404);
        $d = DB::table('barang_keluar_details')->where('barang_keluar_id',$id)->orderBy('id')->get();

        $items = $d->map(fn($r)=>[
            'kode_barang' => $r->kode_barang,
            'nama_barang' => $r->nama_barang,
            'qty'         => (int)$r->qty,
            'lorong'      => $r->nama_lorong,
            'rak_ids'     => [$r->id_rak],
            'display_rak' => $r->nama_rak,
        ]);
        $itemsJson = $items->toJson();

        return view('Input.barangkeluar.edit', compact('h','itemsJson'));
    }

    /** Update = hapus detail lama, insert detail baru dari tabel preview (logika sama store) */
    public function update(Request $req, $id)
    {
        $req->validate([
            'no_dokumen' => 'required|string|max:50',
            'tanggal'    => 'required|date',
            'items_json' => 'required|string',
        ]);

        $items = json_decode($req->items_json,true);
        if (!is_array($items) || empty($items)) {
            return back()->withErrors('Detail barang belum diisi.')->withInput();
        }

        DB::beginTransaction();
        try {
            $exists = DB::table('barang_keluars')->where('id',$id)->first();
            abort_if(!$exists, 404);

            DB::table('barang_keluars')->where('id',$id)->update([
                'no_dokumen' => $req->no_dokumen,
                'tanggal'    => $req->tanggal,
                'keterangan' => $req->keterangan,
                'updated_at' => now(),
            ]);

            DB::table('barang_keluar_details')->where('barang_keluar_id',$id)->delete();

            $source = $this->sohSource();
            $cols   = collect(Schema::getColumnListing($source))->map(fn($c)=>strtolower($c));
            $qtyCol = $cols->contains('sisa_qty') ? 'sisa_qty' : ($cols->contains('qty') ? 'qty' : null);
            $lorCol = $cols->first(fn($c)=>preg_match('/lorong/i',$c)) ?: 'nama_lorong';
            $hasFI  = $cols->contains('tanggal_first_in');

            foreach ($items as $i => $it) {
                $kode    = trim($it['kode_barang'] ?? '');
                $nama    = trim($it['nama_barang'] ?? '');
                $qtyReq  = (int)($it['qty'] ?? 0);
                $lorong  = trim($it['lorong'] ?? '');
                $rakIds  = $it['rak_ids'] ?? [];

                if (!$kode || $qtyReq <= 0) {
                    throw new \Exception("Baris #".($i+1)." tidak valid (kode/qty).");
                }

                $sql = "SELECT 
                            id_rak, nama_rak, {$lorCol} AS nama_lorong,
                            (COALESCE(NULLIF({$qtyCol}, ''), '0') + 0) AS qty_num"
                        . ($hasFI ? ", tanggal_first_in" : "") .
                       " FROM {$source}
                         WHERE REPLACE(TRIM(kode_barang), ' ', '') = ?
                           AND (COALESCE(NULLIF({$qtyCol}, ''), '0') + 0) > 0"
                         . ($lorong ? " AND {$lorCol} = ?" : "")
                         . (!empty($rakIds) ? " AND id_rak IN (".implode(',', array_map('intval',$rakIds)).")" : "")
                         . " ORDER BY ".($hasFI ? "tanggal_first_in ASC, " : "")." {$lorCol}, nama_rak";

                $params = [ preg_replace('/\s+/', '', $kode) ];
                if ($lorong) $params[] = $lorong;
                $stokRows = DB::select($sql, $params);

                if (empty($stokRows)) {
                    throw new \Exception("Baris #".($i+1).": stok tidak tersedia (filter lorong/rak terlalu ketat?).");
                }

                $remain = $qtyReq;
                foreach ($stokRows as $r) {
                    if ($remain <= 0) break;
                    $take = min((int)$r->qty_num, $remain);
                    if ($take <= 0) continue;

                    DB::table('barang_keluar_details')->insert([
                        'barang_keluar_id' => $id,
                        'kode_barang'      => $kode,
                        'nama_barang'      => $nama,
                        'id_rak'           => $r->id_rak,
                        'nama_rak'         => $r->nama_rak,
                        'nama_lorong'      => $r->nama_lorong,
                        'qty'              => $take,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);

                    $remain -= $take;
                }

                if ($remain > 0) {
                    throw new \Exception("Baris #".($i+1).": stok kurang {$remain} unit. Pilih rak tambahan.");
                }
            }

            DB::commit();
            return redirect()->route('input.barangkeluar.index')->with('ok','Berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /** Hapus header + detail (cascade logic manual) */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $h = DB::table('barang_keluars')->where('id',$id)->first();
            abort_if(!$h, 404);

            DB::table('barang_keluar_details')->where('barang_keluar_id',$id)->delete();
            DB::table('barang_keluars')->where('id',$id)->delete();

            DB::commit();
            return redirect()->route('input.barangkeluar.index')->with('ok','Berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }
}

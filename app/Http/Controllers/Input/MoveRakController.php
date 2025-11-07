<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class MoveRakController extends Controller
{
    /* ---------- Utilities ---------- */
    private function normKode(string $kode): string
    {
        return preg_replace('/\s+/', '', trim($kode));
    }

    private function getNamaBarang(string $kodeNorm): ?string
    {
        $r = DB::table('barang')
            ->whereRaw("REPLACE(TRIM(kode_barang),' ','') = ?", [$kodeNorm])
            ->first(['nama_barang']);
        return $r->nama_barang ?? null;
    }

    private function getStandarRak(string $kodeNorm): array
    {
        $r = DB::table('standar_rak_pallet')
            ->whereRaw("REPLACE(TRIM(kode_barang),' ','') = ?", [$kodeNorm])
            ->first(['kategori','nama_lorong']);
        return [
            'kategori' => $r->kategori ?? null,
            'lorong'   => $r->nama_lorong ?? null,
        ];
    }

    /* ---------- Pages ---------- */
    public function index(Request $r)
    {
        $rows = DB::table('move_rak')
            ->when($r->no_dokumen, fn($q)=>$q->where('no_dokumen','like','%'.$r->no_dokumen.'%'))
            ->when($r->tanggal, fn($q)=>$q->whereDate('tanggal',$r->tanggal))
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->paginate(15)->withQueryString();

        return view('input.Move_Rak.index', compact('rows'));
    }

    public function create()
    {
        $lorongList = DB::table('lorong')->orderBy('nama_lorong')->pluck('nama_lorong')->toArray();
        return view('input.Move_Rak.create', compact('lorongList'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'no_dokumen'  => ['required','string','max:100', Rule::unique('move_rak','no_dokumen')],
            'tanggal'     => ['required','date'],

            'src_lorong'  => ['required','string', Rule::exists('lorong','nama_lorong')],
            'src_rak'     => ['required','string', Rule::exists('rak','nama_rak')],

            'kode_barang' => ['required','string'],
            'qty'         => ['required','numeric','gt:0'],

            'to_lorong'   => ['required','string', Rule::exists('lorong','nama_lorong')],
            'to_rak'      => ['required','string', Rule::exists('rak','nama_rak')],

            'keterangan'  => ['nullable','string','max:255'],
        ], [
            'no_dokumen.unique' => 'No dokumen sudah digunakan.',
            'qty.gt'            => 'Qty harus lebih dari 0.',
        ]);

        $kodeNorm   = $this->normKode($data['kode_barang']);
        $namaBarang = $this->getNamaBarang($kodeNorm);
        if (!$namaBarang) {
            return back()->withErrors(['kode_barang'=>'Kode barang tidak ditemukan di master.'])->withInput();
        }

        $std        = $this->getStandarRak($kodeNorm);
        $kategori   = strtoupper((string)($std['kategori'] ?? ''));
        $lorongStd  = $std['lorong'] ?? null;
        $bebasLor   = in_array($kategori, ['CYLINDER','TROLLEY'], true);

        $srcRak = DB::table('rak')->where('nama_rak',$data['src_rak'])->first(['id_rak','nama_lorong']);
        $toRak  = DB::table('rak')->where('nama_rak',$data['to_rak'])->first(['id_rak','nama_lorong']);

        if (!$srcRak || $srcRak->nama_lorong !== $data['src_lorong']) {
            return back()->withErrors(['src_rak'=>'Rak sumber tidak sesuai dengan lorong sumber.'])->withInput();
        }
        if (!$toRak || $toRak->nama_lorong !== $data['to_lorong']) {
            return back()->withErrors(['to_rak'=>'Rak tujuan tidak sesuai dengan lorong tujuan.'])->withInput();
        }
        if (!$bebasLor && $lorongStd && $data['to_lorong'] !== $lorongStd) {
            return back()->withErrors(['to_lorong'=>"Lorong tujuan wajib: {$lorongStd} (sesuai standar rak)."])->withInput();
        }

        // saldo sumber untuk barang tsb
        $saldoSrc = (float) (DB::table('stock_rak')
            ->where('id_rak', $srcRak->id_rak)
            ->whereRaw("REPLACE(TRIM(kode_barang),' ','') = ?", [$kodeNorm])
            ->value('qty') ?? 0);

        if ($saldoSrc <= 0) {
            return back()->withErrors(['src_rak'=>'Rak sumber tidak memiliki stok barang tersebut.'])->withInput();
        }
        if ($saldoSrc < $data['qty']) {
            return back()->withErrors(['qty'=>"Qty melebihi stok rak sumber (stok: {$saldoSrc})."])->withInput();
        }

        // rak tujuan harus kosong (sum semua barang = 0)
        $sumTujuan = (float) (DB::table('stock_rak')->where('id_rak',$toRak->id_rak)->sum('qty') ?? 0);
        if ($sumTujuan > 0) {
            return back()->withErrors(['to_rak'=>'Rak tujuan tidak kosong.'])->withInput();
        }

        DB::beginTransaction();
        try {
            $headerId = DB::table('move_rak')->insertGetId([
                'no_dokumen' => $data['no_dokumen'],
                'tanggal'    => $data['tanggal'],
                'keterangan' => $data['keterangan'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('move_rak_details')->insert([
                'move_rak_id'   => $headerId,
                'kode_barang'   => $kodeNorm,
                'id_rak_asal'   => $srcRak->id_rak,
                'id_rak_tujuan' => $toRak->id_rak,
                'qty'           => $data['qty'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // pastikan baris tujuan ada
            DB::table('stock_rak')->updateOrInsert(
                ['id_rak'=>$toRak->id_rak,'kode_barang'=>$kodeNorm],
                ['qty'=>DB::raw('COALESCE(qty,0)')]
            );

            // update saldo
            DB::table('stock_rak')
                ->where('id_rak',$srcRak->id_rak)
                ->where('kode_barang',$kodeNorm)
                ->update(['qty'=>DB::raw('qty - '.(0+$data['qty']))]);

            DB::table('stock_rak')
                ->where('id_rak',$toRak->id_rak)
                ->where('kode_barang',$kodeNorm)
                ->update(['qty'=>DB::raw('qty + '.(0+$data['qty']))]);

            DB::commit();
            return redirect()->route('moverak.index')->with('success','Move Rak berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('MoveRak.store error: '.$e->getMessage());
            return back()->withErrors('Gagal menyimpan: '.$e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $header = DB::table('move_rak')->where('id',$id)->first();
        abort_if(!$header, 404);

        $details = DB::table('move_rak_details as d')
            ->join('rak as ra','ra.id_rak','=','d.id_rak_asal')
            ->join('rak as rt','rt.id_rak','=','d.id_rak_tujuan')
            ->leftJoin('barang as b','b.kode_barang','=','d.kode_barang')
            ->select('d.*','ra.nama_rak as rak_asal','rt.nama_rak as rak_tujuan','b.nama_barang')
            ->where('d.move_rak_id',$id)
            ->get();

        return view('input.Move_Rak.show', compact('header','details'));
    }

    /* ---------- API untuk Blade ---------- */

   public function apiRakByLorong(Request $r)
{
    $lorong = trim($r->query('lorong',''));
    $filter = strtolower(trim($r->query('filter','all'))); // occupied|empty|all
    if ($lorong === '') {
        return response()->json(['error' => 'Param lorong wajib diisi'], 400);
    }

    // PAKAI RAW SQL yang sama persis dengan yang lulus di phpMyAdmin
    $sql = "
        SELECT 
            ra.id_rak,
            ra.nama_rak,
            ra.nama_lorong,
            COALESCE(SUM(s.qty),0) AS qty_total
        FROM rak AS ra
        LEFT JOIN vw_stock_on_hand AS s
               ON s.id_rak = ra.id_rak
        WHERE ra.nama_lorong = ?
        GROUP BY ra.id_rak, ra.nama_rak, ra.nama_lorong
        ORDER BY ra.nama_rak
    ";
    try {
        $rows = DB::select($sql, [$lorong]);
    } catch (\Throwable $e) {
        // fallback kalau nama view berbeda
        $sqlCompat = str_replace('vw_stock_on_hand', 'vw_stock_on_hand_compat', $sql);
        $rows = DB::select($sqlCompat, [$lorong]);
    }

    // Terapkan filter akhir
    $rows = collect($rows)->filter(function($r) use ($filter){
        $q = (float)$r->qty_total;
        if ($filter === 'occupied') return $q > 0;
        if ($filter === 'empty')    return $q == 0.0;
        return true;
    })->values()->map(fn($r)=>[
        'id_rak'   => (int)$r->id_rak,
        'nama_rak' => $r->nama_rak,
        'qty'      => (float)$r->qty_total,
        'lorong'   => $r->nama_lorong,
    ]);

    return response()->json($rows);
}

    /** GET /move-rak/api/barang?kode=07.00.00.06 */
    public function apiBarang(Request $r)
    {
        $kode = $this->normKode($r->query('kode',''));
        if ($kode === '') return response()->json(['nama_barang'=>null]);

        $row = DB::table('barang')
            ->whereRaw("REPLACE(TRIM(kode_barang),' ','') = ?", [$kode])
            ->first(['kode_barang','nama_barang']);

        return response()->json([
            'kode_barang' => $row->kode_barang ?? $kode,
            'nama_barang' => $row->nama_barang ?? null,
        ]);
    }

    /** GET /move-rak/api/standar-rak?kode=07.00.00.06 */
    public function apiStandarRak(Request $r)
    {
        $kode = $this->normKode($r->query('kode',''));
        if ($kode === '') return response()->json(['kategori'=>null,'lorong_standar'=>null]);

        $row = DB::table('standar_rak_pallet')
            ->whereRaw("REPLACE(TRIM(kode_barang),' ','') = ?", [$kode])
            ->first(['kategori','nama_lorong']);

        return response()->json([
            'kategori'       => $row->kategori ?? null,
            'lorong_standar' => $row->nama_lorong ?? null,
        ]);
    }
}

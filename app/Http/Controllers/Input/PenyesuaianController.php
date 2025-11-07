<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penyesuaian;
use App\Models\Rak;

class PenyesuaianController extends Controller
{
    public function index(Request $request)
    {
        $q = Penyesuaian::query()
            ->when($request->filled('kode_barang'), fn($qr) => $qr->where('kode_barang', $request->kode_barang))
            ->when($request->filled('id_lorong'), function ($qr) use ($request) {
                $qr->whereIn('id_rak', Rak::where('nama_lorong', $request->id_lorong)->pluck('id'));
            })
            ->latest('tanggal')
            ->latest('id');

        $penyesuaian = $q->paginate(20)->withQueryString();

        $lorongList = Rak::distinct()->orderBy('nama_lorong')->pluck('nama_lorong');
        $rakList    = Rak::orderBy('nama_lorong')->orderBy('nama_rak')->get();

        return view('Input.penyesuaian.index', compact('penyesuaian','lorongList','rakList'));
    }

    public function create()
    {
        $lorongList = Rak::distinct()
            ->whereNotNull('nama_lorong')
            ->orderBy('nama_lorong')
            ->pluck('nama_lorong');

        return view('Input.penyesuaian.create', compact('lorongList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'     => ['required','date'],
            'kode_barang' => ['required','string','max:50'],
            'id_rak'      => ['required','integer','exists:rak,id'], // pastikan nama tabel "rak"
            'qty'         => ['required','numeric','not_in:0'],
            'keterangan'  => ['nullable','string','max:255'],
        ],[
            'qty.not_in'  => 'Qty tidak boleh 0. Gunakan + untuk tambah stok, - untuk kurang stok.'
        ]);

        DB::beginTransaction();
        try {
            Penyesuaian::create([
                'tanggal'     => $validated['tanggal'],
                'kode_barang' => $validated['kode_barang'],
                'id_rak'      => $validated['id_rak'],
                'qty'         => $validated['qty'],
                'keterangan'  => $validated['keterangan'] ?? null,
                'user_id'     => auth()->id(),
            ]);

            DB::commit();
            return redirect()->route('input.penyesuaian.index')->with('success','Penyesuaian berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->withErrors(['err'=>$th->getMessage()]);
        }
    }

    public function edit(Penyesuaian $penyesuaian)
    {
        $rakList = Rak::orderBy('nama_lorong')->orderBy('nama_rak')->get();
        return view('Input.penyesuaian.edit', compact('penyesuaian','rakList'));
    }

    public function update(Request $request, Penyesuaian $penyesuaian)
    {
        $validated = $request->validate([
            'tanggal'     => ['required','date'],
            'kode_barang' => ['required','string','max:50'],
            'id_rak'      => ['required','integer','exists:rak,id'],
            'qty'         => ['required','numeric','not_in:0'],
            'keterangan'  => ['nullable','string','max:255'],
        ]);

        DB::beginTransaction();
        try {
            $penyesuaian->update([
                'tanggal'     => $validated['tanggal'],
                'kode_barang' => $validated['kode_barang'],
                'id_rak'      => $validated['id_rak'],
                'qty'         => $validated['qty'],
                'keterangan'  => $validated['keterangan'] ?? null,
                'user_id'     => auth()->id(),
            ]);

            DB::commit();
            return redirect()->route('input.penyesuaian.index')->with('success','Penyesuaian berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->withErrors(['err'=>$th->getMessage()]);
        }
    }

    public function destroy(Penyesuaian $penyesuaian)
    {
        try {
            $penyesuaian->delete();
            return redirect()->route('input.penyesuaian.index')->with('success', 'Penyesuaian dihapus.');
        } catch (\Throwable $th) {
            return back()->withErrors(['err'=>$th->getMessage()]);
        }
    }

    /**
     * AJAX: rekomendasi rak di lorong
     * mode:
     *  - empty       => rak benar2 kosong (default)
     *  - item_empty  => rak yang tidak menyimpan kode_barang ini
     *  - any         => semua rak di lorong
     */
 public function rakByLorong(Request $request)
{
    $request->validate([
        'lorong'      => 'required|string',
        'mode'        => 'nullable|in:empty,item_empty,any',
        'kode_barang' => 'nullable|string',
    ]);

    $lorong = $request->lorong;
    $mode   = $request->get('mode', 'empty');
    $kode   = $request->get('kode_barang');

    // Dapatkan nama tabel Eloquent secara aman (rak/raks)
    $tblRak = (new Rak)->getTable(); // contoh: "rak" atau "raks"

    try {
        // ---- Agregat saldo per rak dari VIEW yang sudah ada ----
        // Total semua barang
        $saldoTotal = DB::table('vw_stock_movement')
            ->select('id_rak', DB::raw('SUM(qty_move) AS saldo'))
            ->groupBy('id_rak');

        // Khusus satu kode_barang (untuk mode=item_empty)
        $saldoItem = null;
        if ($mode === 'item_empty' && $kode) {
            $saldoItem = DB::table('vw_stock_movement')
                ->where('kode_barang', $kode)
                ->select('id_rak', DB::raw('SUM(qty_move) AS saldo_item'))
                ->groupBy('id_rak');
        }

        $q = Rak::from($tblRak.' as r')
            ->leftJoinSub($saldoTotal, 'st', fn($j) => $j->on('st.id_rak', '=', 'r.id'))
            ->when($saldoItem, fn($qq) => $qq->leftJoinSub($saldoItem, 'si', fn($j) => $j->on('si.id_rak', '=', 'r.id')))
            ->where('r.nama_lorong', $lorong);

        if ($mode === 'empty') {
            // Rak benar-benar kosong (tidak ada saldo barang apapun)
            $q->where(function($w){
                $w->whereNull('st.saldo')->orWhere('st.saldo', '<=', 0);
            });
        } elseif ($mode === 'item_empty') {
            // Rak yang tidak menyimpan kode_barang ini
            $q->where(function($w){
                $w->whereNull('si.saldo_item')->orWhere('si.saldo_item', '<=', 0);
            });
        } // mode=any -> tanpa filter

        $rows = $q->orderBy('r.nama_rak')
                  ->get(['r.id','r.nama_rak','r.nama_lorong']);

        return response()->json($rows, 200);
    } catch (\Throwable $e) {
        // Log error supaya bisa dilihat di laravel.log, tapi tetap balikin 200
        \Log::error('rakByLorong error: '.$e->getMessage());

        // Fallback: tampilkan semua rak di lorong biar UI tidak "Gagal memuat rak"
        $rows = Rak::from($tblRak.' as r')
            ->where('r.nama_lorong', $lorong)
            ->orderBy('r.nama_rak')
            ->get(['r.id','r.nama_rak','r.nama_lorong']);

        return response()->json($rows, 200);
    }
}

}

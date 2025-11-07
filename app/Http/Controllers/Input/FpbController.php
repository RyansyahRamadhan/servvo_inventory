<?php
namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formula;
use App\Models\FormulaDetail;
use App\Models\FPB;
use App\Models\FPBDetail;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\DB;

class FPBController extends Controller
{
    public function index()
    {
        $fpbList = FPB::latest()->get();
        return view('Input.fpb.index', compact('fpbList'));
    }

    public function create()
    {
        return view('Input.fpb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'no_fpb' => 'required',
    'tanggal_fpb' => 'required|date',
    'kode_formula' => 'required|string',
    'nama_formula' => 'required|string',
    'qty_formula' => 'required|numeric',
    'detail_barang' => 'required|json'
]);

        DB::beginTransaction();
        try {
            $fpb = FPB::create([
    'no_fpb' => $request->no_fpb,
    'tanggal_fpb' => $request->tanggal_fpb,
    'kode_formula' => $request->kode_formula,
    'nama_formula' => $request->nama_formula,
    'qty_formula' => $request->qty_formula,
]);

            $details = json_decode($request->detail_barang, true);

            foreach ($details as $detail) {
                FPBDetail::create([
                    'no_fpb' => $fpb->no_fpb,
                    'kode_barang' => $detail['kode_barang'],
                    'nama_barang' => $detail['nama_barang'],
                    'qty' => $detail['qty'],
                    'rak' => $detail['rak'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('fpb.index')->with('success', 'FPB berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function fetchBarang($kode)
    {
        $formula = Formula::where('kode_formula', $kode)->first();
        return response()->json([
            'nama_barang' => $formula ? $formula->nama_formula : null
        ]);
    }

    public function fetchDetail($kode, $qty)
    {
        $details = FormulaDetail::where('kode_formula', $kode)->get();
        $result = [];

        foreach ($details as $detail) {
            $result[] = [
                'kode_barang' => $detail->kode_barang,
                'nama_barang' => $detail->nama_barang,
                'qty' => $detail->jumlah * $qty
            ];
        }

        return response()->json($result);
    }

    public function rekomendasiRak($nama_barang, $qty)
    {
        $stok = BarangMasuk::where('nama_barang', $nama_barang)
            ->where('jumlah', '>', 0)
            ->orderBy('tanggal_masuk')
            ->get();

        $qtyNeeded = (int) $qty;
        $rakResult = [];

                foreach ($stok as $item) {
            if ($qtyNeeded <= 0) break;

            $ambil = min($item->jumlah, $qtyNeeded);
            $rakResult[] = "{$item->nama_rak} (ambil: {$ambil} / stok: {$item->jumlah})";
            $qtyNeeded -= $ambil;
        }


        return response()->json(['rak' => implode(', ', $rakResult)]);
    }
public function show($no_fpb)
{
    $fpb = FPB::with('details')->where('no_fpb', $no_fpb)->firstOrFail();
    return view('Input.fpb.show', compact('fpb'));
}
public function edit($no_fpb)
{
    $fpb = FPB::with('details')->where('no_fpb', $no_fpb)->firstOrFail();
    return view('input.fpb.edit', compact('fpb'));
}
public function rollbackKapasitas(Request $request)
{
    $nama_barang = $request->nama_barang;
    $qty = $request->qty;

  DB::table('barang_masuk')
        ->where('nama_barang', $nama_barang)
        ->orderBy('tanggal_masuk', 'desc') // FIFO reverse
        ->limit(1)
        ->increment('kapasitas', $qty);

    return response()->json(['status' => 'success']);
}
public function update(Request $request, $no_fpb)
{
    $request->validate([
        'no_fpb' => 'required',
        'tanggal_fpb' => 'required|date',
        'kode_formula' => 'required',
        'nama_formula' => 'required',
        'qty_formula' => 'required|numeric|min:1',
        'detail_barang' => 'required|array|min:1',
    ]);

    DB::beginTransaction();
    try {
        // Temukan data FPB lama
        $fpb = FPB::where('no_fpb', $no_fpb)->firstOrFail();

        // Jika no_fpb diubah, update juga PK-nya
        $fpb->update([
            'no_fpb' => $request->no_fpb,
            'tanggal_fpb' => $request->tanggal_fpb,
            'kode_formula' => $request->kode_formula,
            'nama_formula' => $request->nama_formula,
            'qty_formula' => $request->qty_formula,
        ]);

        // Hapus detail lama
        FPBDetail::where('no_fpb', $no_fpb)->delete();

        // Simpan detail baru
        foreach ($request->detail_barang as $detail) {
            FPBDetail::create([
                'no_fpb' => $request->no_fpb,
                'kode_barang' => $detail['kode_barang'],
                'nama_barang' => $detail['nama_barang'],
                'qty' => $detail['qty'],
                'rak' => $detail['rak'] ?? null,
            ]);
        }

        DB::commit();
        return redirect()->route('fpb.index')->with('success', 'FPB berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal memperbarui FPB: ' . $e->getMessage());
    }
}
public function destroy($no_fpb)
{
    DB::beginTransaction();

    try {
        $fpb = FPB::where('no_fpb', $no_fpb)->firstOrFail();

        // Ambil detail barang untuk rollback kapasitas
        $details = FPBDetail::where('no_fpb', $no_fpb)->get();

        foreach ($details as $detail) {
            // Kembalikan kapasitas rak
            DB::table('rak')
                ->where('nama_rak', $detail->rak)
                ->increment('kapasitas_tersedia', $detail->qty);
        }

        // Hapus detail
        FPBDetail::where('no_fpb', $no_fpb)->delete();

        // Hapus FPB utama
        $fpb->delete();

        DB::commit();
        return redirect()->route('fpb.index')->with('success', 'FPB berhasil dihapus dan kapasitas dikembalikan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menghapus FPB: ' . $e->getMessage());
    }
}


}
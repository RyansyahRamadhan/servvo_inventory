<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use App\Models\StockAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockAdjustmentController extends Controller
{
    public function index(Request $req)
    {
        $rows = StockAdjustment::query()
            ->when($req->no_dokumen, fn($q) => $q->where('no_dokumen', 'like', '%'.$req->no_dokumen.'%'))
            ->when($req->tanggal, fn($q) => $q->whereDate('tanggal', $req->tanggal))
            ->when($req->kode_barang, fn($q) => $q->where('kode_barang', 'like', '%'.$req->kode_barang.'%'))
            ->latest('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('input.Penyesuaian.index', compact('rows'));
    }

    public function create()
    {
        // Master untuk dropdown
        $lorongs = DB::table('lorong')->select('nama_lorong')->orderBy('nama_lorong')->get();
        $raks    = DB::table('rak')->select('nama_rak','nama_lorong')->orderBy('nama_rak')->get();

        return view('input.Penyesuaian.create', compact('lorongs','raks'));
    }

    public function store(Request $r)
    {
        // Validasi dasar
        $data = $r->validate([
            'no_dokumen'   => 'required|string|max:100|unique:penyesuaian,no_dokumen',
            'tanggal'      => 'required|date',
            'kode_barang'  => 'required|string|max:50|exists:barang,kode_barang',
            'nama_barang'  => 'required|string|max:191',
            'nama_lorong'  => 'required|string|max:100|exists:lorong,nama_lorong',
            'nama_rak'     => 'required|string|max:100|exists:rak,nama_rak',
            'qty'          => 'required|integer|not_in:0',
            'keterangan'   => 'nullable|string|max:300',
        ], [
            'kode_barang.exists' => 'Kode barang tidak ditemukan di master barang.',
            'nama_lorong.exists' => 'Nama lorong tidak ditemukan.',
            'nama_rak.exists'    => 'Nama rak tidak ditemukan.',
        ]);

        // Validasi tambahan: pastikan rak berada di lorong yang sama
        $rakRow = DB::table('rak')
            ->where('nama_rak', $data['nama_rak'])
            ->first();

        if (!$rakRow || $rakRow->nama_lorong !== $data['nama_lorong']) {
            return back()
                ->withErrors(['nama_rak' => 'Rak tidak sesuai dengan lorong yang dipilih.'])
                ->withInput();
        }

        // Simpan
        StockAdjustment::create($data);

        return redirect()
            ->route('penyesuaian.index')
            ->with('success', 'Penyesuaian berhasil disimpan!');
    }
    public function show($id)
{
    $row = StockAdjustment::findOrFail($id);
    return view('input.Penyesuaian.show', compact('row'));
}

public function edit($id)
{
    $row    = StockAdjustment::findOrFail($id);
    $lorongs= DB::table('lorong')->select('nama_lorong')->orderBy('nama_lorong')->get();
    $raks   = DB::table('rak')->select('nama_rak','nama_lorong')->orderBy('nama_rak')->get();
    return view('input.Penyesuaian.edit', compact('row','lorongs','raks'));
}

public function update(Request $r, $id)
{
    $row = StockAdjustment::findOrFail($id);

    $data = $r->validate([
        'no_dokumen'   => 'required|string|max:100|unique:penyesuaian,no_dokumen,'.$row->id,
        'tanggal'      => 'required|date',
        'kode_barang'  => 'required|string|max:50|exists:barang,kode_barang',
        'nama_barang'  => 'required|string|max:191',
        'nama_lorong'  => 'required|string|max:100|exists:lorong,nama_lorong',
        'nama_rak'     => 'required|string|max:100|exists:rak,nama_rak',
        'qty'          => 'required|integer|not_in:0',
        'keterangan'   => 'nullable|string|max:300',
    ]);

    // pastikan rak sesuai lorong
    $rakRow = DB::table('rak')->where('nama_rak',$data['nama_rak'])->first();
    if (!$rakRow || $rakRow->nama_lorong !== $data['nama_lorong']) {
        return back()->withErrors(['nama_rak' => 'Rak tidak sesuai dengan lorong yang dipilih.'])->withInput();
    }

    $row->update($data);
    return redirect()->route('penyesuaian.index')->with('success','Data diperbarui.');
}

public function destroy($id)
{
    $row = StockAdjustment::findOrFail($id);
    $row->delete();
    return redirect()->route('penyesuaian.index')->with('success','Data dihapus.');
}

}

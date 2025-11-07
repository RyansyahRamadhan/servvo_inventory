<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\FormulaDetail;
use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FormulaImport;
use App\Exports\FormulaExport;
use Illuminate\Support\Facades\DB;

class FormulaController extends Controller
{
    public function index()
    {
        $formula = Formula::all();
        return view('formula.index', compact('formula'));
    }

    public function create()
    {
        return view('formula.create');
    }

    public function store(Request $request)
    {
        // Simpan formula utama
        $formula = Formula::create([
            'kode_formula' => $request->kode_formula,
            'nama_formula' => $request->nama_formula,
        ]);

        // Simpan detail formula
        foreach ($request->kode_barang as $index => $kode_barang) {
            $formula->details()->create([
                'kode_barang' => $kode_barang,
                'nama_barang' => $request->nama_barang[$index],
                'jumlah' => $request->jumlah[$index],
            ]);
        }

        return redirect()->route('formula.index')->with('success', 'Formula berhasil disimpan!');
    }

    public function edit($id)
    {
        $formula = Formula::with('details')->findOrFail($id);
        return view('formula.edit', compact('formula'));
    }

    public function update(Request $request, $id)
    {
        $formula = Formula::findOrFail($id);

        // Simpan perubahan formula
        $formula->update([
            'kode_formula' => $request->kode_formula,
            'nama_formula' => $request->nama_formula,
        ]);

        // Hapus semua detail lama
        FormulaDetail::where('kode_formula', $formula->kode_formula)->delete();

        // Tambahkan detail baru
        foreach ($request->kode_barang as $i => $kode) {
            FormulaDetail::create([
                'kode_formula' => $formula->kode_formula,
                'kode_barang' => $kode,
                'nama_barang' => $request->nama_barang[$i],
                'jumlah' => $request->jumlah[$i],
            ]);
        }

        return redirect()->route('formula.index')->with('success', 'Formula berhasil diupdate!');
    }

    public function destroy($kode_formula)
{
            FormulaDetail::where('kode_formula', $kode_formula)->delete();
            Formula::where('kode_formula', $kode_formula)->delete();

            return redirect()->route('formula.index')->with('success', 'Formula berhasil dihapus.');
        }
        // Tampilkan detail formula
    public function show($kode_formula)
    {
        $formula = Formula::with('details')->where('kode_formula', $kode_formula)->firstOrFail();
        return view('formula.show', compact('formula'));
     }   

    public function export()
    {
        return Excel::download(new FormulaExport, 'data_formula.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new FormulaImport, $request->file('file_excel'));
        return back()->with('success', 'Import berhasil.');
    }

    public function getNamaFormula(Request $request)
    {
        $barang = Barang::where('kode_barang', $request->kode_formula)->first();
        return response()->json(['nama_barang' => $barang->nama_barang ?? null]);
    }

    public function getNamaBarang(Request $request)
    {
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        return response()->json(['nama_barang' => $barang->nama_barang ?? null]);
    }

    public function getBarangByFormula(Request $request)
    {
        $kodeFormula = $request->query('kode_formula');

        if (!$kodeFormula) {
            return response()->json(['nama_barang' => '']);
        }

        $barang = DB::table('barang')->where('kode_barang', $kodeFormula)->select('nama_barang')->first();

        return response()->json([
            'nama_barang' => $barang->nama_barang ?? ''
        ]);
    }
}

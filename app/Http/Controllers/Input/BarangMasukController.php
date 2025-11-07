<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\StandartPallet;
use App\Models\Rak;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index()
    {
        $data = BarangMasuk::all();
        return view('Input.barangmasuk.index', compact('data'));
    }

    public function create()
    {
        $lorongList = Rak::distinct()->pluck('nama_lorong');
        return view('Input.barangmasuk.create', compact('lorongList'));
    }

    public function fetchData($kode_barang)
    {
        $data = StandartPallet::where('kode_barang', $kode_barang)->first();

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'nama_barang'     => $data->nama_barang,
            'kategori_barang' => $data->kategori_barang,
            'kapasitas'       => $data->kapasitas,
            'nama_lorong'     => $data->nama_lorong,
        ]);
    }

    /**
     * Rekomendasi rak:
     * - Default: rak yang sudah terpakai tidak direkomendasikan.
     * - Khusus LORONG 2 DAN nama_rak dengan subslot (>=4 tanda '-'):
     *   boleh multi-SKU -> tetap direkomendasikan jika kapasitas_tersedia > 0.
     */
    public function getRakKosong($nama_lorong)
    {
        // Semua rak aktif di lorong tsb dengan kapasitas tersisa
        $semuaRak = Rak::where('nama_lorong', $nama_lorong)
            ->where('kapasitas_tersedia', '>', 0)
            ->pluck('nama_rak')
            ->toArray();

        // Rak yang pernah dipakai (unik)
        $rakTerpakai = BarangMasuk::pluck('nama_rak')
            ->flatMap(fn ($rak) => array_map('trim', explode(',', $rak)))
            ->unique()
            ->toArray();

        $rakKosong = collect($semuaRak)->filter(function ($namaRak) use ($nama_lorong, $rakTerpakai) {
            $dipakai  = in_array($namaRak, $rakTerpakai, true);
            $multiSku = $this->isMultiSkuRack($nama_lorong, $namaRak);

            if ($multiSku) {
                // diizinkan walau sudah terpakai, selama kapasitas_tersedia > 0 (sudah difilter di query)
                return true;
            }
            // selain itu tetap single-SKU
            return !$dipakai;
        })->values()->map(fn ($nr) => ['nama_rak' => $nr])->all();

        return response()->json($rakKosong);
    }

    /**
     * Helper: deteksi rak multi-SKU.
     * Aturan: khusus LORONG 2 dan nama_rak punya subslot (>=4 tanda '-')
     * Contoh: B-C-01-01-05, B-C-02-03-02, dst.
     */
    private function isMultiSkuRack(string $nama_lorong, string $nama_rak): bool
    {
        return strtoupper($nama_lorong) === 'LORONG 2' && substr_count($nama_rak, '-') >= 4;
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_dokumen_masuk' => 'required|string|max:255',
            'tanggal_masuk'    => 'required|date',
            'final_data'       => 'required|string',
        ]);

        // Cek duplikat dokumen
        $cek = DB::table('barang_masuk')
            ->where('no_dokumen_masuk', $request->no_dokumen_masuk)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Nomor dokumen sudah pernah digunakan!');
        }

        $finalData = json_decode($request->final_data, true);
        if (!$finalData || !is_array($finalData)) {
            return back()->with('error', 'Data barang masuk tidak valid!');
        }

        DB::transaction(function () use ($finalData) {
            foreach ($finalData as $item) {
                $namaRakArray = is_array($item['nama_rak']) ? $item['nama_rak'] : explode(',', $item['nama_rak']);
                $totalRak     = count($namaRakArray);
                $jumlahPerRak = ($totalRak > 0) ? floor($item['jumlah'] / $totalRak) : $item['jumlah'];

                foreach ($namaRakArray as $rak) {
                    $rak = trim($rak);

                    BarangMasuk::create([
                        'no_dokumen_masuk' => $item['no_dokumen_masuk'],
                        'tanggal_masuk'    => $item['tanggal_masuk'],
                        'kode_barang'      => $item['kode_barang'],
                        'nama_barang'      => $item['nama_barang'],
                        'kategori_barang'  => $item['kategori_barang'],
                        'jumlah'           => $jumlahPerRak,
                        'kapasitas'        => $item['kapasitas'],
                        'nama_lorong'      => $item['nama_lorong'],
                        'nama_rak'         => $rak,
                    ]);

                    // sinkron kapasitas rak (simetris dengan destroy())
                    DB::table('rak')
                        ->where('nama_rak', $rak)
                        ->decrement('kapasitas_tersedia', $item['kapasitas']);
                }
            }
        });

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil disimpan!');
    }

    public function edit($no_dokumen)
    {
        $rakList = DB::table('rak')->pluck('nama_rak')->toArray();
        $data = DB::table('barang_masuk')
            ->where('no_dokumen_masuk', $no_dokumen)
            ->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ambil list semua lorong untuk dropdown
        $lorongList = DB::table('lorong')->pluck('nama_lorong')->toArray();

        // Kelompokkan per kode_barang
        $grouped = $data->groupBy('kode_barang')->map(function ($group) {
            return [
                'kode_barang'     => $group[0]->kode_barang,
                'nama_barang'     => $group[0]->nama_barang,
                'kategori_barang' => $group[0]->kategori_barang,
                'kapasitas'       => $group[0]->kapasitas,
                'nama_lorong'     => $group[0]->nama_lorong,
                'jumlah'          => $group->sum('jumlah'),
                'rak_terpilih'    => $group->pluck('nama_rak')->toArray(),
            ];
        });

        return view('Input.barangmasuk.edit', [
            'no_dokumen'     => $no_dokumen,
            'tanggal_masuk'  => $data->first()->tanggal_masuk,
            'barangList'     => $grouped->values(),
            'lorongList'     => $lorongList,
            'rakList'        => $rakList,
        ]);
    }

    public function update(Request $request, $no_dokumen)
    {
        $request->validate([
            'no_dokumen_masuk' => 'required|string|max:255',
            'tanggal_masuk'    => 'required|date',
            'final_data'       => 'required|string',
        ]);

        $finalData = json_decode($request->final_data, true);
        if (!$finalData || !is_array($finalData)) {
            return back()->with('error', 'Data barang masuk tidak valid!');
        }

        DB::transaction(function () use ($no_dokumen, $request, $finalData) {
            // 1) Rollback kapasitas lama
            $oldItems = DB::table('barang_masuk')
                ->where('no_dokumen_masuk', $no_dokumen)
                ->get();

            foreach ($oldItems as $old) {
                DB::table('rak')
                    ->where('nama_rak', $old->nama_rak)
                    ->increment('kapasitas_tersedia', $old->kapasitas);
            }

            // 2) Hapus baris lama
            DB::table('barang_masuk')
                ->where('no_dokumen_masuk', $no_dokumen)
                ->delete();

            // 3) Insert baru + decrement kapasitas
            foreach ($finalData as $item) {
                $namaRakArray = is_array($item['nama_rak']) ? $item['nama_rak'] : explode(',', $item['nama_rak']);
                $totalRak     = count($namaRakArray);
                $jumlahPerRak = ($totalRak > 0) ? floor($item['jumlah'] / $totalRak) : $item['jumlah'];

                foreach ($namaRakArray as $rak) {
                    $rak = trim($rak);

                    BarangMasuk::create([
                        'no_dokumen_masuk' => $request->no_dokumen_masuk,
                        'tanggal_masuk'    => $request->tanggal_masuk,
                        'kode_barang'      => $item['kode_barang'],
                        'nama_barang'      => $item['nama_barang'],
                        'kategori_barang'  => $item['kategori_barang'],
                        'jumlah'           => $jumlahPerRak,
                        'kapasitas'        => $item['kapasitas'],
                        'nama_lorong'      => $item['nama_lorong'],
                        'nama_rak'         => $rak,
                    ]);

                    DB::table('rak')
                        ->where('nama_rak', $rak)
                        ->decrement('kapasitas_tersedia', $item['kapasitas']);
                }
            }
        });

        return redirect()->route('barangmasuk.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($no_dokumen)
    {
        $items = DB::table('barang_masuk')
            ->where('no_dokumen_masuk', $no_dokumen)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('barangmasuk.index')->with('error', 'Data tidak ditemukan.');
        }

        DB::transaction(function () use ($items, $no_dokumen) {
            // Rollback kapasitas rak
            foreach ($items as $item) {
                DB::table('rak')
                    ->where('nama_rak', $item->nama_rak)
                    ->increment('kapasitas_tersedia', $item->kapasitas);
            }

            // Hapus baris barang_masuk
            DB::table('barang_masuk')
                ->where('no_dokumen_masuk', $no_dokumen)
                ->delete();
        });

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Input;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LPBHP;
use App\Models\LPBHPDetail;
use App\Models\FPB;

class LPBHPController extends Controller
{
    /* =========================
     * LIST & FORM
     * ========================= */
    public function index()
    {
        $lpbhpList = LPBHP::all();
        return view('Input.lpbhp.index', compact('lpbhpList'));
    }

    public function create()
    {
        // Hitung sisa FPB
        $lpbSub = DB::table('lpbhp')
            ->select('no_fpb', DB::raw('SUM(qty) AS total_lpb'))
            ->groupBy('no_fpb');

        $fpbList = FPB::from('fpb as f')
            ->leftJoinSub($lpbSub, 'l', function ($join) {
                $join->on(DB::raw("l.no_fpb COLLATE utf8mb4_unicode_ci"),
                          '=', DB::raw("f.no_fpb COLLATE utf8mb4_unicode_ci"));
            })
            ->select(
                'f.no_fpb',
                'f.kode_formula',
                'f.nama_formula',
                'f.qty_formula',
                DB::raw('COALESCE(f.qty_formula - COALESCE(l.total_lpb,0),0) AS sisa_qty')
            )
            ->whereRaw('COALESCE(f.qty_formula - COALESCE(l.total_lpb,0),0) > 0')
            ->orderBy('f.no_fpb')
            ->get();

        return view('Input.lpbhp.create', compact('fpbList'));
    }

    /* =========================
     * HELPERS
     * ========================= */

    /** Multi-SKU jika: LORONG 2 dan nama_rak punya subslot (>=4 tanda '-') */
    private function isMultiSkuRackName(string $nama_lorong, string $nama_rak): bool
    {
        return strtoupper($nama_lorong) === 'LORONG 2' && substr_count($nama_rak, '-') >= 4;
    }

    /** Distribusi qty ke daftar rak berdasarkan kapasitas per rak */
    private function distribute(int $qty, array $listRak, int $kapPerRak): array
    {
        $out = []; $sisa = $qty;
        foreach ($listRak as $nr) {
            if ($sisa <= 0) break;
            $isi = min($kapPerRak, $sisa);
            $out[] = ['nama_rak' => $nr, 'isi' => $isi];
            $sisa -= $isi;
        }
        return $out;
    }

    /* =========================
     * STORE
     * ========================= */
    public function store(Request $request)
    {
        $tanggal = $request->input('tanggal_lpbhp') ?? $request->input('tanggal');

        $validated = $request->validate([
            'no_lpbhp'    => 'required|string|max:50',
            'no_fpb'      => 'required|string|max:50',
            'kode_barang' => 'required|string|max:100',
            'nama_barang' => 'required|string|max:150',
            'qty'         => 'required|integer|min:1',
            'nama_rak'    => 'required|array|min:1',
            'nama_rak.*'  => 'string|max:100',
        ], [], [
            'no_lpbhp'    => 'No LPBHP',
            'no_fpb'      => 'No FPB',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'qty'         => 'Qty',
            'nama_rak'    => 'Rak',
        ]);

        if (empty($tanggal)) {
            return back()->withErrors(['tanggal_lpbhp' => 'Tanggal LPBHP wajib diisi.'])->withInput();
        }

        // Anti over-allocate FPB
        $fpbRow = DB::table('fpb')->where('no_fpb', $validated['no_fpb'])->first();
        if (!$fpbRow) return back()->withErrors(['no_fpb' => 'FPB tidak ditemukan.'])->withInput();

        $terpakai = DB::table('lpbhp')->where('no_fpb', $validated['no_fpb'])->sum('qty');
        $sisaFpb  = max(0, (int)$fpbRow->qty_formula - (int)$terpakai);
        if ($validated['qty'] > $sisaFpb) {
            return back()->withErrors(['qty' => "Qty melebihi sisa FPB. Sisa saat ini: {$sisaFpb}."])->withInput();
        }

        // Standar barang
        $std = DB::table('standar_rak_pallet')
            ->select('nama_lorong','kapasitas','kategori_barang')
            ->where('kode_barang', $validated['kode_barang'])
            ->first();
        if (!$std) {
            return back()->withErrors(['kode_barang' => 'Standar rak/pallet untuk kode barang ini tidak ditemukan.'])->withInput();
        }

        $kapPerRak  = max(1, (int)$std->kapasitas);
        $butuhRak   = (int) ceil(((int)$validated['qty']) / $kapPerRak);
        $kategori   = strtolower(trim($std->kategori_barang ?? ''));
        $freeLorong = in_array($kategori, ['cylinder','trolley'], true);

        // Batas jumlah rak
        if (count($validated['nama_rak']) > $butuhRak) {
            return back()->withErrors(['nama_rak' => "Maksimal rak yang boleh dipilih adalah {$butuhRak}."])->withInput();
        }

        // Info rak terpilih
        $rakInfo = DB::table('rak')
            ->select('nama_rak','nama_lorong','kapasitas_total','kapasitas_tersedia')
            ->whereIn('nama_rak', $validated['nama_rak'])
            ->get();
        if ($rakInfo->count() !== count($validated['nama_rak'])) {
            return back()->withErrors(['nama_rak' => 'Terdapat rak yang tidak valid.'])->withInput();
        }

        // Validasi lorong (tidak disimpan, hanya validasi)
        $chosenLorong = $request->input('nama_lorong'); // dari dropdown jika kategori bebas
        if ($freeLorong) {
            if (!$chosenLorong) {
                return back()->withErrors(['nama_lorong' => 'Silakan pilih nama lorong.'])->withInput();
            }
            $invalid = $rakInfo->firstWhere('nama_lorong', '!=', $chosenLorong);
            if ($invalid) {
                return back()->withErrors(['nama_rak' => "Semua rak harus berada di lorong {$chosenLorong}."])->withInput();
            }
        } else {
            $invalid = $rakInfo->firstWhere('nama_lorong', '!=', $std->nama_lorong);
            if ($invalid) {
                return back()->withErrors(['nama_rak' => "Semua rak harus berada di lorong {$std->nama_lorong}."])->withInput();
            }
        }

        // Validasi keadaan rak (multi boleh parsial, non-multi wajib kosong total)
        $nonOk = $rakInfo->first(function ($r) {
            $allowMulti = $this->isMultiSkuRackName($r->nama_lorong, $r->nama_rak);
            if ($allowMulti) {
                return (int)$r->kapasitas_tersedia <= 0;
            }
            return (int)$r->kapasitas_tersedia !== (int)$r->kapasitas_total;
        });
        if ($nonOk) {
            return back()->withErrors(['nama_rak' => "Rak {$nonOk->nama_rak} tidak memenuhi syarat (tidak kosong atau tidak ada sisa)."])->withInput();
        }

        DB::beginTransaction();
        try {
            // Upsert header
            $exists = DB::table('lpbhp')->where('no_lpbhp', $validated['no_lpbhp'])->exists();

            if ($exists) {
                DB::table('lpbhp')
                  ->where('no_lpbhp', $validated['no_lpbhp'])
                  ->update([
                      'tanggal_lpbhp' => $tanggal,
                      'no_fpb'        => $validated['no_fpb'],
                      'kode_barang'   => $validated['kode_barang'],
                      'nama_barang'   => $validated['nama_barang'],
                      'qty'           => $validated['qty'],
                      'updated_at'    => now(),
                  ]);
                DB::table('lpbhp_detail')->where('no_lpbhp', $validated['no_lpbhp'])->delete();
            } else {
                DB::table('lpbhp')->insert([
                    'no_lpbhp'      => $validated['no_lpbhp'],
                    'tanggal_lpbhp' => $tanggal,
                    'no_fpb'        => $validated['no_fpb'],
                    'kode_barang'   => $validated['kode_barang'],
                    'nama_barang'   => $validated['nama_barang'],
                    'qty'           => $validated['qty'],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }

            // Detail rak
            $detailRows = [];
            foreach ($validated['nama_rak'] as $nr) {
                $detailRows[] = [
                    'no_lpbhp'   => $validated['no_lpbhp'],
                    'nama_rak'   => $nr,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            if ($detailRows) DB::table('lpbhp_detail')->insert($detailRows);

            // Booking kapasitas (kurangi kapasitas_tersedia)
            foreach ($this->distribute((int)$validated['qty'], $validated['nama_rak'], $kapPerRak) as $row) {
                DB::table('rak')
                    ->where('nama_rak', $row['nama_rak'])
                    ->update([
                        'kapasitas_tersedia' => DB::raw("GREATEST(kapasitas_tersedia - {$row['isi']}, 0)")
                    ]);
            }

            DB::commit();
            return redirect()->route('lpbhp.index')->with('success', 'LPBHP tersimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors(['general' => 'Gagal menyimpan LPBHP: '.$e->getMessage()])->withInput();
        }
    }

    /* =========================
     * SHOW / EDIT / UPDATE / DESTROY
     * ========================= */
    public function show($no_lpbhp)
    {
        $lpbhp = LPBHP::with('details')->where('no_lpbhp', $no_lpbhp)->firstOrFail();
        return view('Input.lpbhp.show', compact('lpbhp'));
    }

    public function edit($no_lpbhp)
    {
        $lpbhp = LPBHP::with('details')->where('no_lpbhp', $no_lpbhp)->firstOrFail();
        $fpbList = FPB::select('no_fpb','kode_formula','nama_formula','qty_formula')->get();

        // Standar barang untuk hitung kapasitas & lorong standar
        $std = DB::table('standar_rak_pallet')
            ->select('nama_lorong','kapasitas','kategori_barang')
            ->where('kode_barang', $lpbhp->kode_barang)
            ->first();

        $kapasitas = $std ? (int)$std->kapasitas : 0;
        $jumlahRak = $kapasitas > 0 ? (int) ceil(((int)$lpbhp->qty) / $kapasitas) : 0;
        $lorongStd = $std ? $std->nama_lorong : null;

        $selectedRak = $lpbhp->details->pluck('nama_rak')->toArray();
        $kategori    = strtolower($std->kategori_barang ?? '');
        $freeLorong  = in_array($kategori, ['cylinder','trolley'], true);

        // Ambil info rak (kandidat + yang sudah dipilih) dengan aturan multi/non-multi
        $q = DB::table('rak')
            ->select('nama_rak','kapasitas_tersedia','kapasitas_total','nama_lorong')
            ->orderBy('nama_lorong')->orderBy('nama_rak');

        if (!$freeLorong && $lorongStd) {
            $q->where('nama_lorong', $lorongStd);
        }
        // Untuk kategori bebas, tampilkan semua lorong (user bisa ganti via UI / AJAX)

        $allInfo = $q->get();

        $filtered = $allInfo->filter(function ($r) use ($selectedRak) {
            if (in_array($r->nama_rak, $selectedRak, true)) {
                // Rak yang sudah dipakai di dokumen ini tetap ditampilkan
                return true;
            }
            $allowMulti = $this->isMultiSkuRackName($r->nama_lorong, $r->nama_rak);
            if ($allowMulti) {
                // multi: boleh selama masih ada sisa
                return (int)$r->kapasitas_tersedia > 0;
            }
            // non-multi: harus kosong total
            return (int)$r->kapasitas_tersedia === (int)$r->kapasitas_total;
        })->unique('nama_rak')->values();

        $allRak  = $filtered->pluck('nama_rak')->toArray();
        $rakMeta = $filtered->mapWithKeys(function($r){
            return [$r->nama_rak => [
                'tersedia' => (int)$r->kapasitas_tersedia,
                'total'    => (int)$r->kapasitas_total,
                'lorong'   => $r->nama_lorong,
            ]];
        })->toArray();

        return view('Input.lpbhp.edit', compact(
            'lpbhp','fpbList','allRak','selectedRak','kapasitas','jumlahRak','rakMeta','lorongStd'
        ));
    }

    public function update(Request $request, $no_lpbhp)
    {
        $old = LPBHP::with('details')->where('no_lpbhp', $no_lpbhp)->firstOrFail();
        $tanggal = $request->input('tanggal_lpbhp') ?? $request->input('tanggal');

        $validated = $request->validate([
            'no_lpbhp'    => 'required|string|max:50',
            'no_fpb'      => 'required|string|max:50',
            'kode_barang' => 'required|string|max:100',
            'nama_barang' => 'required|string|max:150',
            'qty'         => 'required|integer|min:1',
            'nama_rak'    => 'required|array|min:1',
            'nama_rak.*'  => 'string|max:100',
        ]);

        if (empty($tanggal)) {
            return back()->withErrors(['tanggal_lpbhp' => 'Tanggal LPBHP wajib diisi.'])->withInput();
        }

        // Anti over-allocate (exclude dok ini)
        $fpbRow = DB::table('fpb')->where('no_fpb', $validated['no_fpb'])->first();
        if (!$fpbRow) return back()->withErrors(['no_fpb' => 'FPB tidak ditemukan.'])->withInput();

        $terpakaiLain = DB::table('lpbhp')
            ->where('no_fpb', $validated['no_fpb'])
            ->where('no_lpbhp', '!=', $old->no_lpbhp)
            ->sum('qty');
        $sisaFpb = max(0, (int)$fpbRow->qty_formula - (int)$terpakaiLain);
        if ($validated['qty'] > $sisaFpb) {
            return back()->withErrors(['qty' => "Qty melebihi sisa FPB. Sisa saat ini: {$sisaFpb}."])->withInput();
        }

        // Standar barang
        $std = DB::table('standar_rak_pallet')
            ->select('nama_lorong','kapasitas','kategori_barang')
            ->where('kode_barang', $validated['kode_barang'])
            ->first();
        if (!$std) {
            return back()->withErrors(['kode_barang' => 'Standar rak/pallet untuk kode barang ini tidak ditemukan.'])->withInput();
        }

        $kapPerRak  = max(1, (int)$std->kapasitas);
        $butuhRak   = (int) ceil(((int)$validated['qty']) / $kapPerRak);
        $kategori   = strtolower(trim($std->kategori_barang ?? ''));
        $freeLorong = in_array($kategori, ['cylinder','trolley'], true);

        if (count($validated['nama_rak']) > $butuhRak) {
            return back()->withErrors(['nama_rak' => "Maksimal rak yang boleh dipilih adalah {$butuhRak}."])->withInput();
        }

        $rakInfoBaru = DB::table('rak')
            ->select('nama_rak','nama_lorong','kapasitas_total','kapasitas_tersedia')
            ->whereIn('nama_rak', $validated['nama_rak'])
            ->get();
        if ($rakInfoBaru->count() !== count($validated['nama_rak'])) {
            return back()->withErrors(['nama_rak' => 'Terdapat rak yang tidak valid.'])->withInput();
        }

        // Validasi lorong
        $chosenLorong = $request->input('nama_lorong');
        if ($freeLorong) {
            if (!$chosenLorong) {
                return back()->withErrors(['nama_lorong' => 'Silakan pilih nama lorong.'])->withInput();
            }
            $invalid = $rakInfoBaru->firstWhere('nama_lorong', '!=', $chosenLorong);
            if ($invalid) {
                return back()->withErrors(['nama_rak' => "Semua rak harus berada di lorong {$chosenLorong}."])->withInput();
            }
        } else {
            $invalid = $rakInfoBaru->firstWhere('nama_lorong', '!=', $std->nama_lorong);
            if ($invalid) {
                return back()->withErrors(['nama_rak' => "Semua rak harus berada di lorong {$std->nama_lorong}."])->withInput();
            }
        }

        // Rak baru (yang tidak dipakai sebelumnya): non-multi harus kosong total; multi boleh parsial asal ada sisa
        $rakLama = $old->details->pluck('nama_rak')->toArray();
        $nonOkBaru = $rakInfoBaru->first(function($r) use ($rakLama) {
            $isOld = in_array($r->nama_rak, $rakLama, true);
            if ($isOld) return false;

            $allowMulti = $this->isMultiSkuRackName($r->nama_lorong, $r->nama_rak);
            if ($allowMulti) {
                return (int)$r->kapasitas_tersedia <= 0;
            }
            return (int)$r->kapasitas_tersedia !== (int)$r->kapasitas_total;
        });
        if ($nonOkBaru) {
            return back()->withErrors(['nama_rak' => "Rak {$nonOkBaru->nama_rak} tidak memenuhi syarat (tidak kosong atau tidak ada sisa)."])->withInput();
        }

        DB::beginTransaction();
        try {
            // Revert booking lama
            foreach ($this->distribute((int)$old->qty, $rakLama, $kapPerRak) as $row) {
                DB::table('rak')
                  ->where('nama_rak', $row['nama_rak'])
                  ->update([
                      'kapasitas_tersedia' => DB::raw("LEAST(kapasitas_total, kapasitas_tersedia + {$row['isi']})")
                  ]);
            }

            // Update header (no_lpbhp boleh ganti, pastikan unik)
            $noBaru = $validated['no_lpbhp'];
            if ($noBaru !== $old->no_lpbhp) {
                $exists = DB::table('lpbhp')->where('no_lpbhp', $noBaru)->exists();
                if ($exists) throw new \RuntimeException("No LPBHP '{$noBaru}' sudah dipakai dokumen lain.");
            }

            DB::table('lpbhp')
              ->where('no_lpbhp', $old->no_lpbhp)
              ->update([
                  'no_lpbhp'      => $noBaru,
                  'tanggal_lpbhp' => $tanggal,
                  'no_fpb'        => $validated['no_fpb'],
                  'kode_barang'   => $validated['kode_barang'],
                  'nama_barang'   => $validated['nama_barang'],
                  'qty'           => $validated['qty'],
                  'updated_at'    => now(),
              ]);

            // Ganti details
            DB::table('lpbhp_detail')->where('no_lpbhp', $old->no_lpbhp)->delete();
            $detailRows = [];
            foreach ($validated['nama_rak'] as $nr) {
                $detailRows[] = [
                    'no_lpbhp'   => $noBaru,
                    'nama_rak'   => $nr,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            if ($detailRows) DB::table('lpbhp_detail')->insert($detailRows);

            // Booking baru
            foreach ($this->distribute((int)$validated['qty'], $validated['nama_rak'], $kapPerRak) as $row) {
                DB::table('rak')
                  ->where('nama_rak', $row['nama_rak'])
                  ->update([
                      'kapasitas_tersedia' => DB::raw("GREATEST(kapasitas_tersedia - {$row['isi']}, 0)")
                  ]);
            }

            DB::commit();
            return redirect()->route('lpbhp.index')->with('success', 'LPBHP berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors(['general' => 'Gagal update: '.$e->getMessage()])->withInput();
        }
    }

    public function destroy($no_lpbhp)
    {
        $doc = LPBHP::with('details')->where('no_lpbhp', $no_lpbhp)->firstOrFail();

        $std = DB::table('standar_rak_pallet')
            ->select('kapasitas')
            ->where('kode_barang', $doc->kode_barang)
            ->first();
        $kapPerRak = max(1, (int)($std->kapasitas ?? 1));

        $rakLama = $doc->details->pluck('nama_rak')->toArray();

        DB::beginTransaction();
        try {
            // Kembalikan booking lama
            foreach ($this->distribute((int)$doc->qty, $rakLama, $kapPerRak) as $row) {
                DB::table('rak')
                    ->where('nama_rak', $row['nama_rak'])
                    ->update([
                        'kapasitas_tersedia' => DB::raw("LEAST(kapasitas_total, kapasitas_tersedia + {$row['isi']})")
                    ]);
            }

            DB::table('lpbhp_detail')->where('no_lpbhp', $no_lpbhp)->delete();
            DB::table('lpbhp')->where('no_lpbhp', $no_lpbhp)->delete();

            DB::commit();
            return redirect()->route('lpbhp.index')->with('success', 'LPBHP berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors(['general' => 'Gagal menghapus: '.$e->getMessage()]);
        }
    }

    /* =========================
     * AJAX ENDPOINTS
     * ========================= */
    public function getFpb($no_fpb)
    {
        $fpb = DB::table('fpb')->where('no_fpb', $no_fpb)->first();
        if (!$fpb) return response()->json(null, 404);

        $terpakai = DB::table('lpbhp')->where('no_fpb', $no_fpb)->sum('qty');
        $sisa = max(0, (int)$fpb->qty_formula - (int)$terpakai);

        return response()->json([
            'kode_barang' => $fpb->kode_formula,
            'nama_barang' => $fpb->nama_formula,
            'qty'         => $sisa,
            'qty_formula' => (int)$fpb->qty_formula,
            'terpakai'    => (int)$terpakai,
            'sisa_qty'    => (int)$sisa,
        ]);
    }

    public function getKapasitas($kode_barang)
    {
        $row = DB::table('standar_rak_pallet')
            ->select('kapasitas', 'nama_lorong', 'kategori_barang')
            ->where('kode_barang', $kode_barang)
            ->first();

        return response()->json([
            'kapasitas'   => (int)($row->kapasitas ?? 0),
            'nama_lorong' => $row->nama_lorong ?? '',
            'kategori'    => strtolower($row->kategori_barang ?? ''),
        ]);
    }

    public function getLorongList()
    {
        $lorongs = DB::table('rak')
            ->select('nama_lorong')
            ->distinct()
            ->orderBy('nama_lorong')
            ->pluck('nama_lorong');

        return response()->json($lorongs);
    }

    // Rekomendasi rak: multi (LORONG 2 subslot) boleh parsial; non-multi wajib kosong total
    // Mendukung query ?lorong=
    public function getRakRekomendasi(Request $request, $kode_barang, $qty)
    {
        $std = DB::table('standar_rak_pallet')
            ->select('nama_lorong','kapasitas','kategori_barang')
            ->where('kode_barang', $kode_barang)
            ->first();

        if (!$std) return response()->json([]);

        $kategori   = strtolower(trim($std->kategori_barang ?? ''));
        $freeLorong = in_array($kategori, ['cylinder','trolley'], true);

        $targetLorong = $freeLorong
            ? ($request->query('lorong') ?: null)
            : ($std->nama_lorong ?? null);

        $q = DB::table('rak')
            ->select('nama_rak','kapasitas_tersedia','kapasitas_total','nama_lorong')
            ->where('kapasitas_tersedia', '>', 0) // ada sisa
            ->orderBy('nama_lorong')
            ->orderBy('nama_rak');

        if ($targetLorong) {
            $q->where('nama_lorong', $targetLorong);
        } elseif (!$freeLorong) {
            // barang normal wajib ikut lorong standar
            return response()->json([]);
        }

        $rows = $q->get();

        // Filter: non-multi harus kosong total; multi boleh parsial
        $filtered = $rows->filter(function ($r) {
            $allowMulti = $this->isMultiSkuRackName($r->nama_lorong, $r->nama_rak);
            if ($allowMulti) {
                return (int)$r->kapasitas_tersedia > 0;
            }
            return (int)$r->kapasitas_tersedia === (int)$r->kapasitas_total;
        })->values();

        return response()->json($filtered->map(fn($r)=>[
            'nama_rak'           => $r->nama_rak,
            'kapasitas_tersedia' => (int)$r->kapasitas_tersedia,
            'kapasitas_total'    => (int)$r->kapasitas_total,
            'nama_lorong'        => $r->nama_lorong,
        ]));
    }
}

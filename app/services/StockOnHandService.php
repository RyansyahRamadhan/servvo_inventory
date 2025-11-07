<?php
// app/Services/StockOnHandService.php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class StockOnHandService
{
    /** Core: tambah delta ke (kode_barang, rak_id) dengan upsert */
    private function delta(string $kodeBarang, int $rakId, float $qtyDelta): void
    {
        if ($qtyDelta == 0) return;

        DB::table('stock_on_hand')->upsert(
            [
                'kode_barang' => $kodeBarang,
                'rak_id'      => $rakId,
                'qty'         => $qtyDelta,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            ['kode_barang','rak_id'],
            [
                'qty'         => DB::raw('qty + '.((float)$qtyDelta)),
                'updated_at'  => now(),
            ]
        );

        // rapikan: hapus baris qty=0
        DB::table('stock_on_hand')
          ->where(['kode_barang'=>$kodeBarang,'rak_id'=>$rakId])
          ->where('qty', 0)
          ->delete();
    }

    public function add(string $kodeBarang, int $rakId, float $qty): void  { $this->delta($kodeBarang, $rakId, +$qty); }
    public function sub(string $kodeBarang, int $rakId, float $qty): void  { $this->delta($kodeBarang, $rakId, -$qty); }

    /** Pindah antar rak (keluar dari asal, masuk ke tujuan) */
    public function move(string $kodeBarang, int $rakAsalId, int $rakTujuanId, float $qty): void
    {
        DB::transaction(function () use ($kodeBarang,$rakAsalId,$rakTujuanId,$qty) {
            $this->sub($kodeBarang, $rakAsalId, $qty);
            $this->add($kodeBarang, $rakTujuanId, $qty);
        });
    }

    /** Helper kalau kita cuma pegang nama_rak */
    private function rakIdByNama(string $namaRak): int
    {
        $id = DB::table('rak')->where('nama_rak',$namaRak)->value('id_rak');
        if (!$id) throw new \RuntimeException("Rak '{$namaRak}' tidak ditemukan (id_rak kosong).");
        return (int)$id;
    }
    public function addByNama(string $kodeBarang, string $namaRak, float $qty): void { $this->add($kodeBarang, $this->rakIdByNama($namaRak), $qty); }
    public function subByNama(string $kodeBarang, string $namaRak, float $qty): void { $this->sub($kodeBarang, $this->rakIdByNama($namaRak), $qty); }
    public function moveByNama(string $kodeBarang, string $rakAsalNama, string $rakTujuanNama, float $qty): void
    {
        $this->move($kodeBarang, $this->rakIdByNama($rakAsalNama), $this->rakIdByNama($rakTujuanNama), $qty);
    }

    /** Util untuk update dokumen (rollback lama, apply baru) */
    public function adjustDelta(string $kodeOld, int $rakOld, float $qtyOld, string $kodeNew, int $rakNew, float $qtyNew): void
    {
        DB::transaction(function () use ($kodeOld,$rakOld,$qtyOld,$kodeNew,$rakNew,$qtyNew) {
            if ($qtyOld != 0) $this->delta($kodeOld, $rakOld, -$qtyOld);
            if ($qtyNew != 0) $this->delta($kodeNew, $rakNew, +$qtyNew);
        });
    }
}

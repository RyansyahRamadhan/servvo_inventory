<?php

namespace App\Exports;

use App\Models\Master\StandartPallet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StandartPalletExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return StandartPallet::select([
            'kode_barang', 'nama_barang', 'kategori_barang', 'uom', 'kapasitas',
            'isi_per_pallet', 'isi_dus_per_pallet', 'berat_dus', 'berat_per_pallet',
            'deskripsi', 'nama_lorong', 'tanggal_berlaku', 'status'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Barang', 'Nama Barang', 'Kategori Barang', 'UOM', 'Kapasitas',
            'Isi per Pallet', 'Isi Dus per Pallet', 'Berat Dus', 'Berat per Pallet',
            'Deskripsi', 'Nama Lorong', 'Tanggal Berlaku', 'Status'
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Barang::select('kode_barang', 'nama_barang', 'satuan', 'kategori_barang')->get();
    }

    public function headings(): array
    {
        return ['Kode Barang', 'Nama Barang', 'Satuan', 'Kategori Barang'];
    }
}

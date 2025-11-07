<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Barang([
            'kode_barang'      => $row['kode_barang'],
            'nama_barang'      => $row['nama_barang'],
            'satuan'           => $row['satuan'],
            'kategori_barang'  => $row['kategori_barang'],
        ]);
    }
}

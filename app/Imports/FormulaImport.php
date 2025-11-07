<?php

namespace App\Imports;

use App\Models\Formula;
use App\Models\FormulaDetail;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FormulaImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $data = $row->toArray();

        // Cari formula lama, kalau ada update
        $formula = Formula::updateOrCreate(
            ['kode_formula' => $data['kode_formula']],
            ['nama_formula' => $data['nama_formula']]
        );

        // Tambahkan detailnya (opsional: bisa dihapus dulu kalau mau bersih)
        FormulaDetail::create([
            'kode_formula' => $data['kode_formula'],
            'kode_barang'  => $data['kode_barang'],
            'nama_barang'  => $data['nama_barang'],
            'jumlah'       => $data['jumlah'],
        ]);
    }
}
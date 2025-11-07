<?php

namespace App\Imports;

use App\Models\Rak;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RakImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Rak([
            'nama_rak'           => $row['nama_rak'],
            'nama_lorong'        => $row['nama_lorong'],
            'kapasitas_total'    => $row['kapasitas_total'],
            'kapasitas_tersedia' => $row['kapasitas_tersedia'],
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Lorong;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LorongImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Lorong([
            'nama_lorong' => $row['nama_lorong'],
            'nama_gudang' => $row['nama_gudang'],
        ]);
    }
}

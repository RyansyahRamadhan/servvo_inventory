<?php

namespace App\Exports;

use App\Models\Rak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RakExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Rak::select('nama_rak', 'nama_lorong', 'kapasitas_total', 'kapasitas_tersedia')->get();
    }

    public function headings(): array
    {
        return ['Nama Rak', 'Nama Lorong', 'Kapasitas Total', 'Kapasitas Tersedia'];
    }
}

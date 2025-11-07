<?php

namespace App\Exports;

use App\Models\Lorong;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;    

class LorongExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Lorong::select('nama_lorong', 'nama_gudang')->get();
    }
     public function headings(): array
    {
        return [
            'NAMA LORONG',
            'NAMA GUDANG'
        ];
    }
}

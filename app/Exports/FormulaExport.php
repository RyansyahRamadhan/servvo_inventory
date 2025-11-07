<?php

namespace App\Exports;

use App\Models\Formula;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormulaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil semua formula beserta detailnya
        return Formula::with('details')->get()->flatMap(function ($formula) {
            return $formula->details->map(function ($detail) use ($formula) {
                return [
                    'kode_formula' => $formula->kode_formula,
                    'nama_formula' => $formula->nama_formula,
                    'kode_barang'  => $detail->kode_barang,
                    'nama_barang'  => $detail->nama_barang,
                    'jumlah'       => $detail->jumlah,
                ];
            });
        });
    }

    public function headings(): array
    {
        return [
            'Kode Formula',
            'Nama Formula',
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
        ];
    }
}

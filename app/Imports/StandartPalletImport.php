<?php

namespace App\Imports;

use App\Models\Master\StandartPallet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StandartPalletImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    return new StandartPallet([
        'kode_barang'        => $row['kode_barang'],
        'nama_barang'        => $row['nama_barang'],
        'kategori_barang'    => $row['kategori_barang'],
        'uom'                => $row['uom'],
        'kapasitas'          => $row['kapasitas'],
        'isi_per_pallet'     => $row['isi_per_pallet'],
        'isi_dus_per_pallet' => $row['isi_dus_per_pallet'],
        'berat_dus'          => $row['berat_dus'],
        'berat_per_pallet'   => $row['berat_per_pallet'],
        'deskripsi'          => $row['deskripsi'],
        'nama_lorong'        => $row['nama_lorong'],
        'tanggal_berlaku'    => $row['tanggal_berlaku'],
        'status'             => $row['status'],
    ]);
}
}

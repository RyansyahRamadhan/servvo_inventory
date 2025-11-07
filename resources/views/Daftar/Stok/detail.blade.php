@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">Riwayat Gabungan</div>
    <div class="card-body">
    <div class="mb-3">
    <form method="GET" class="form-inline d-flex gap-2 align-items-end">
        <div>
            <label for="tanggal_awal">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control form-control-sm"
                value="{{ request('tanggal_awal') }}">
        </div>
        <div>
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control form-control-sm"
                value="{{ request('tanggal_akhir') }}">
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            <a href="{{ route('stok.detail', ['kode_barang' => request()->route('kode_barang')]) }}"
                class="btn btn-sm btn-secondary">Reset</a>
        </div>
    </form>
</div>

        <table class="table table-bordered small text-center">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>No Dokumen</th>
                    <th>Keterangan</th>
                    <th>Qty Masuk</th>
                    <th>Qty Keluar</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $row)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row['tanggal'])->format('d M Y') }}</td>
                    <td>{{ $row['dokumen'] }}</td>
                    <td>{{ $row['keterangan'] }}</td>
                    <td>{{ $row['masuk'] }}</td>
                    <td>{{ $row['keluar'] }}</td>
                    <td>{{ $row['saldo'] }}</td>
                </tr>
                @empty
                <tr><td colspan="6">Tidak ada riwayat</td></tr>
                @endforelse
            </tbody>
        </table>
         <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('stok.index') }}" class="btn btn-secondary btn-sm w-auto">Kembali</a>
                        </div>

    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Detail Stok Barang</h3>

    <div class="mb-3">
        <strong>Kode Barang:</strong> {{ $kode_barang }} <br>
        @if($lorong)
        <strong>Lorong:</strong> {{ $lorong }}
        @endif
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-sm table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Rak</th>
                        <th>Lorong</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($rows as $row)
                    <tr>
                        <td>{{ $row->id_rak }}</td>
                        <td>{{ $row->nama_lorong }}</td>
                        <td>{{ number_format($row->qty) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data detail</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('laporan.stok-per-lorong') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-3 mb-4">Detail Rak - {{ $nama_barang }} ({{ $kode_barang }})</h3>

    <div class="card">
        <div class="card-header bg-info text-white">Distribusi Rak</div>
        <div class="card-body">
            <table class="table table-bordered text-center small">
                <thead>
                    <tr>
                        <th>Nama Lorong</th>
                        <th>Nama Rak</th>
                        <th>Total Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rakFinal as $row)
                    <tr>
                        <td>{{ $row->nama_lorong }}</td>
                        <td>{{ $row->nama_rak }}</td>
                        <td>{{ $row->total_barang }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3">Tidak ada data rak</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('stok.index') }}" class="btn btn-secondary btn-sm mt-3">Kembali</a>
</div>
@endsection

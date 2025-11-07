@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="mb-3">Daftar Stok Barang</h4>
    <div class="card">
        <div class="card-body">
            <table id="barangTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Total Stok</th>
            <th>Aksi</th> {{-- kolom tambahan --}}
        </tr>
    </thead>
    <tbody>
        @foreach($stokList as $stok)
        <tr>
            <td>{{ $stok->kode_barang }}</td>
            <td>{{ $stok->nama_barang }}</td>
            <td>{{ $stok->kategori_barang }}</td>
            <td>{{ $stok->total_stok }}</td>
            <td>
                <a href="{{ route('stok.detail', $stok->kode_barang) }}" class="btn btn-sm btn-primary">Detail</a>
                <a href="{{ route('stok.rak', $stok->kode_barang) }}" class="btn btn-sm btn-secondary">Detail Rak</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- DataTables CDN --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#stokTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 50],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                zeroRecords: "Tidak ada stok ditemukan",
                paginate: {
                    previous: "‹",
                    next: "›"
                }
            }
        });
    });
</script>
@endpush

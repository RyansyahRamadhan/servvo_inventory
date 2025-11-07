@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <span><i class="fas fa-table me-2"></i> DAFTAR Standart Pallet</span>
        </div>
        <div class="card-body">
            @if(auth()->user()->role === 'administrator')
               <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <a href="{{ route('standartpallet.create') }}" class="btn btn-primary btn-sm w-auto"><i class="fas fa-plus"></i>Tambah Standar Pallet</a>
                
             <div class="d-flex gap-2">
        <a href="{{ route('standartpallet.export') }}" class="btn btn-success btn-sm w-auto">
            <i class="fas fa-file-excel"></i> Export ke Excel
        </a>
        <button class="btn btn-warning btn-sm w-auto" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fas fa-file-upload"></i> Import Excel
        </button>
            </div>
            </div>
            @endif

            {{-- Modal Import --}}
            <div class="modal fade" id="importModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('standartpallet.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Import Data Standar Pallet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="file_excel" class="form-control" accept=".xls,.xlsx" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
             <div class="table-responsive">
           <table id="barangTable" class="table table-bordered align-middle text-center small w-100">    <thead>
                    <tr>
                        <th>Kode Barang</th><th>Nama Barang</th><th>Kategori</th><th>UOM</th>
                        <th>Kapasitas</th><th>Isi Per Pallet</th><th>Isi Dus/Box</th>
                        <th>Berat Dus</th><th>Berat Pallet</th><th>Deskripsi</th>
                        <th>Lorong</th><th>Tanggal Berlaku</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $row->kode_barang }}</td>
                            <td>{{ $row->nama_barang }}</td>
                            <td>{{ $row->kategori_barang }}</td>
                            <td>{{ $row->uom }}</td>
                            <td>{{ $row->kapasitas }}</td>
                            <td>{{ $row->isi_per_pallet }}</td>
                            <td>{{ $row->isi_dus_per_pallet }}</td>
                            <td>{{ $row->berat_dus }}</td>
                            <td>{{ $row->berat_per_pallet }}</td>
                            <td>{{ $row->deskripsi }}</td>
                            <td>{{ $row->nama_lorong }}</td>
                            <td>{{ $row->tanggal_berlaku }}</td>
                            <td>{{ $row->status }}</td>
                            <td class="text-center">
                                @if(auth()->user()->role === 'administrator')
                                    <a href="{{ route('standartpallet.edit', $row->kode_barang) }}" class="btn btn-sm btn-outline-primary">EDIT</a>
                                    <form action="{{ route('standartpallet.destroy', $row->kode_barang) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">HAPUS</button>
                                    </form>
                                @else
                                    <span class="text-muted">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="14" class="text-center">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
</div>
        </div>
    </div>
</div>
</main>
</div>
@endsection
@push('scripts')
{{-- CSS & JS DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-wfQNjpX8CBjKHNpv5rZC5T/O63ktbFfIk4E29s+b0gLz5GZ9cA6fvKj29GzF7J7N98pZq9r1+J4jBLn96Qj+2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#barangTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    previous: "‹",
                    next: "›"
                }
            }
        });
    });
</script>
@endpush


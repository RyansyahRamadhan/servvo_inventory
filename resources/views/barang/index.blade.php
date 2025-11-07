@extends('layouts.app')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                 <div class="card-header">
                    <span><i class="fas fa-table me-2"></i> DAFTAR BARANG</span>
                </div>
                
               <div class="card-body">
                    <!-- Tampilkan tombol tambah barang hanya untuk administrator -->
                   @if(auth()->check() && auth()->user()->role === 'administrator')
                   <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm w-auto">
        <i class="fas fa-plus"></i> Tambah Barang
    </a>
    
    <div class="d-flex gap-2">
        <a href="{{ route('barang.export') }}" class="btn btn-success btn-sm w-auto">
            <i class="fas fa-file-excel"></i> Export ke Excel
        </a>
        <button class="btn btn-warning btn-sm w-auto" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fas fa-file-upload"></i> Import Excel
        </button>
    </div>
</div>

                    @endif


                    {{-- Modal Import Excel --}}
                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModalLabel">Import Data Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="file_excel" class="form-label">Pilih File Excel</label>
                                        <input type="file" name="file_excel" id="file_excel" class="form-control" accept=".xls,.xlsx" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Barang --}}
                    <div class="table-responsive">
                        <table id="barangTable" class="table table-bordered align-middle text-center small w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Kategori Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barang as $b)
                                <tr>
                                    <td>{{ $b->kode_barang }}</td>
                                    <td>{{ $b->nama_barang }}</td>
                                    <td>{{ $b->satuan }}</td>
                                    <td>{{ $b->kategori_barang }}</td>
                                    <td>
                                        @if(auth()->user()->role === 'administrator')
                                            <a href="{{ route('barang.edit', $b->kode_barang) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('barang.destroy', $b->kode_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">No Action</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
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

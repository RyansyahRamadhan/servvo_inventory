@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> DAFTAR RAK
        </div>
        <div class="card-body">
        <div class="d-flex flex-wrap gap-2 justify-content-start mb-3">
        <a href="{{ route('rak.create') }}" class="btn btn-primary btn sm w-auto">+ Tambah Rak</a>
        <div class="d-flex gap-2">
            <a href="{{ route('rak.export') }}" class="btn btn-success btn-sm w-auto">
            <i class="fas fa-file-excel"></i> Export ke Excel
        </a>
        <button class="btn btn-warning btn-sm w-auto" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fas fa-file-upload"></i> Import Excel
        </button>
            </div>
        </div>

            <!-- Modal Form Import -->
            <div class="modal fade" id="importModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('rak.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Import Data Rak</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file_excel" class="form-label">Pilih File Excel</label>
                                    <input type="file" name="file_excel" id="file_excel" class="form-control" accept=".xls, .xlsx" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="barangTable" class="table table-bordered align-middle text-center small w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Rak</th>
                            <th>Lorong</th>
                            <th>Gudang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rakList as $index => $rak)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rak->nama_rak }}</td>
                            <td>{{ $rak->nama_lorong }}</td>
                            <td>{{ $rak->lorong->nama_gudang ?? '-' }}</td>
                            <td>
                                <a href="{{ route('rak.edit', $rak->id_rak) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('rak.destroy', $rak->id_rak) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus rak ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>

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


@push('styles')
    {{-- DataTables + Font Awesome --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          integrity="sha512-wfQNjpX8CBjKHNpv5rZC5T/O63ktbFfIk4E29s+b0gLz5GZ9cA6fvKj29GzF7J7N98pZq9r1+J4jBLn96Qj+2w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    {{-- jQuery + DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(function () {
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
                },
                columnDefs: [
                    { targets: [4], className: 'text-end' } // kolom jumlah rata kanan
                ]
            });
        });
    </script>
@endpush
        
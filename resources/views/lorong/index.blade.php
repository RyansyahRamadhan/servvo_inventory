@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
    <div class="card mb-4">
       <div class="card-header">
                    <span><i class="fas fa-table me-2"></i> DAFTAR LORONG</span>
                </div>
                
        <div class="card-body">
            <a href="{{ route('lorong.create') }}" class="btn btn-primary mb-3 btn-sm w-auto">+ Tambah Lorong</a>
            <a href="{{ url('lorong.export') }}" class="btn btn-success mb-3 btn-sm w-auto">Export ke Excel</a>
            <button class="btn btn-warning mb-3 btn-sm w-auto" data-bs-toggle="modal" data-bs-target="#importModal">Import Excel</button>

            <!-- Modal Import Excel -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('lorong.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Data Lorong</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file_excel" class="form-label">Pilih File Excel</label>
                                    <input type="file" name="file_excel" id="file_excel" class="form-control" accept=".xls,.xlsx" required>
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
                        <th>Nama Lorong</th>
                        <th>Nama Gudang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lorongList as $lorong)
                    <tr>
                        <td>{{ $lorong->nama_lorong }}</td>
                        <td>{{ $lorong->nama_gudang }}</td>
                        <td>
                            <a href="{{ route('lorong.edit', $lorong->id_lorong) }}" class="btn btn-sm btn-outline-primary btn-sm w-auto">Edit</a>
                            <form action="{{ route('lorong.destroy', $lorong->id_lorong) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-auto" onclick="return confirm('Apa Kamu yakin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center">Tidak ada data ditemukan</td></tr>
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


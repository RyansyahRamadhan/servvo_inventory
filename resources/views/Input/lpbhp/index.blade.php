@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DAFTAR LPBHP
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('lpbhp.create') }}" class="btn btn-primary btn-sm mb-3 w-auto">
                        + Tambah LPBHP
                    </a>

                    <div class="table-responsive">
                        <table id="lpbhpTable" class="table table-bordered table-striped align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>No LPBHP</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lpbhpList as $index => $lpbhp)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $lpbhp->no_lpbhp }}</td>
                                        <td>{{ $lpbhp->kode_barang }}</td>
                                        <td class="text-start">{{ $lpbhp->nama_barang }}</td>
                                        <td class="text-end">{{ $lpbhp->qty }}</td>
                                        <td class="text-nowrap">
                                            {{-- Detail --}}
                                            <a href="{{ route('lpbhp.show', $lpbhp->no_lpbhp) }}"
                                               class="btn btn-info btn-sm w-auto">Detail</a>
                                            {{-- Edit --}}
                                            <a href="{{ route('lpbhp.edit', $lpbhp->no_lpbhp) }}"
                                               class="btn btn-warning btn-sm w-auto">Edit</a>
                                            {{-- Hapus --}}
                                            <form action="{{ route('lpbhp.destroy', $lpbhp->no_lpbhp) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin mau hapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-auto">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Belum ada data LPBHP.</td>
                                    </tr>
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
            $('#lpbhpTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 20, 50, 100],
                order: [[0, 'asc']],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: { previous: "‹", next: "›" }
                },
                columnDefs: [
                    { targets: 4, className: 'text-end' }, // Qty rata kanan
                    { targets: 5, orderable: false }       // Aksi tidak bisa sort
                ]
            });
        });
    </script>
@endpush

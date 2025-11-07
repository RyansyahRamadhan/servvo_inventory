@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DAFTAR Barang Masuk
                </div>

                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 justify-content-start mb-3">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-primary btn-sm w-auto">
                            + Tambah Barang Masuk
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="barangTable" class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>No Dokumen</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th class="text-end">Jumlah</th>
                                    <th style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $barang)
                                    <tr>
                                        <td>{{ $barang->no_dokumen_masuk }}</td>
                                        <td>{{ $barang->tanggal_masuk }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->kategori_barang }}</td>
                                        <td class="text-end">{{ $barang->jumlah }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('barangmasuk.edit', $barang->no_dokumen_masuk) }}"
                                                   class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('barangmasuk.destroy', $barang->no_dokumen_masuk) }}"
                                                      method="POST" onsubmit="return confirm('Hapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
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
        
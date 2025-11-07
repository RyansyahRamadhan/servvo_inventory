@extends('layouts.app')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    <i class="fas fa-table me-1"></i> Form Barang Masuk
                </div>
                <div class="card-body">

                 <form id="submitFinalForm" method="POST" action="{{ route('barangmasuk.store') }}">
    @csrf
<div class="mb-3">
    <label>No Dokumen Masuk</label>
    <input type="text" name="no_dokumen_masuk" id="no_dokumen_masuk" class="form-control" required>
</div>

<div class="mb-3">
    <label>Tanggal Masuk</label>
    <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
</div>
<table class="table table-bordered" id="barangTable">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Jumlah Rak</th>
            <th>Kapasitas</th>
            <th>Lorong</th>
            <th>Rak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="text" class="form-control kode_barang"></td>
            <td><input type="text" class="form-control nama_barang" readonly></td>
            <td><input type="text" class="form-control kategori_barang" readonly></td>
            <td><input type="number" class="form-control jumlah_masuk"></td>
            <td><input type="number" class="form-control jumlah_rak" readonly></td>
            <td><input type="number" class="form-control kapasitas" readonly></td>
            
            <td>
                <select class="form-select nama_lorong">
                    <option value="">Pilih</option>
                    @foreach($lorongList as $lorong)
                        <option value="{{ $lorong }}">{{ $lorong }}</option>
                    @endforeach
                </select>
            </td>
            <td><div class="nama_rak"></div></td>
            <td><button type="button" class="btn btn-danger btn-sm hapusRow">Hapus</button></td>
        </tr>
    </tbody>
</table>

    <button type="button" id="tambahData" class="btn btn-secondary mb-4">Tambah</button>

<h5>Preview Data Barang Masuk</h5>
<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Kapasitas</th>
            <th>Lorong</th>
            <th>Rak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="dataTableBody"></tbody>
</table>
    <input type="hidden" name="final_data" id="finalDataInput">

    <div class="d-flex justify-content-start gap-2">
        <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary w-auto">Kembali</a>
        <button type="submit" class="btn btn-success w-auto">Simpan Semua Data</button>
    </div>
</form>

                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/Input/barangmasuk.js') }}"></script>
@endpush
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

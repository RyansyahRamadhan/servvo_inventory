    @extends('layouts.app')

    @section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid py-3">
                <div class="card shadow-sm" style="max-width: 700px; margin: auto;">
                    <div class="card-header fw-bold bg-light">
                        Tambah Data Barang
                    </div>
                    <div class="card-body">
                        {{-- Tampilkan Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Kode Barang</label>
            <div class="col-sm-9">
                <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang') }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Barang</label>
            <div class="col-sm-9">
                <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Satuan</label>
            <div class="col-sm-9">
                <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Kategori Barang</label>
            <div class="col-sm-9">
                <select name="kategori_barang" id="kategori_barang" class="form-select" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Bahan Baku">Bahan Baku</option>
                    <option value="Consumable">Consumable</option>
                    <option value="Barang Jadi">Barang Jadi</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm me-2">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm ">Simpan</button>
        </div>
    </form>

                    </div>
                </div>
            </div>
        </main>
    </div>
    @endsection

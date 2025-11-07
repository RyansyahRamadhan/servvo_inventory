@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container py-4">
            <div class="card shadow-sm" style="max-width: 700px; margin: auto;">
                <div class="card-header fw-bold">Edit Data Barang</div>
                <div class="card-body">
                    <form action="{{ route('barang.update', $barang->kode_barang) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ $barang->kode_barang }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" name="satuan" class="form-control" value="{{ $barang->satuan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_barang" class="form-label">Kategori Barang</label>
                            <select name="kategori_barang" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Bahan Baku" {{ $barang->kategori_barang == 'Bahan Baku' ? 'selected' : '' }}>Bahan Baku</option>
                                <option value="Consumable" {{ $barang->kategori_barang == 'Consumable' ? 'selected' : '' }}>Consumable</option>
                                <option value="Barang Jadi" {{ $barang->kategori_barang == 'Barang Jadi' ? 'selected' : '' }}>Barang Jadi</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

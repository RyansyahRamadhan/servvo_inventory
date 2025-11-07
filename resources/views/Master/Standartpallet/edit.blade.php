@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-boxes me-1"></i>
                    Edit Standar Pallet
                </div>
                <div class="card-body">
                    <form action="{{ route('standartpallet.update', $standartPallet->kode_barang) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ $standartPallet->kode_barang }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $standartPallet->nama_barang }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_barang" class="form-label">Kategori Barang</label>
                            <input type="text" name="kategori_barang" class="form-control" value="{{ $standartPallet->kategori_barang }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="uom" class="form-label">Unit of Measurement (UOM)</label>
                            <input type="text" name="uom" class="form-control" value="{{ $standartPallet->uom }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas Per Pallet (pcs/kg)</label>
                            <input type="number" name="kapasitas" class="form-control" step="0.01" value="{{ $standartPallet->kapasitas }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="isi_per_pallet" class="form-label">Isi Per Pallet (dus/pollybox)</label>
                            <input type="number" name="isi_per_pallet" class="form-control" step="0.01" value="{{ $standartPallet->isi_per_pallet }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="isi_dus_per_pallet" class="form-label">Isi Dus/Pollybox Per Pallet</label>
                            <input type="number" name="isi_dus_per_pallet" class="form-control" step="0.01" value="{{ $standartPallet->isi_dus_per_pallet }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="berat_dus" class="form-label">Berat Dus (kg)</label>
                            <input type="number" name="berat_dus" class="form-control" step="0.01" value="{{ $standartPallet->berat_dus }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="berat_per_pallet" class="form-label">Berat Per Pallet (kg)</label>
                            <input type="number" name="berat_per_pallet" class="form-control" step="0.01" value="{{ $standartPallet->berat_per_pallet }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ $standartPallet->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_berlaku" class="form-label">Tanggal Berlaku</label>
                            <input type="date" name="tanggal_berlaku" class="form-control" value="{{ $standartPallet->tanggal_berlaku }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lorong" class="form-label">Lorong</label>
                            <select name="nama_lorong" class="form-control" required>
                                <option value="">Pilih Lorong</option>
                                @foreach($lorong as $item)
                                    <option value="{{ $item->nama_lorong }}" {{ $item->nama_lorong == $standartPallet->nama_lorong ? 'selected' : '' }}>
                                        {{ $item->nama_lorong }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="aktif" {{ $standartPallet->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ $standartPallet->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-auto">Update</button>
                        <a href="{{ route('standartpallet.index') }}" class="btn btn-secondary btn-sm w-auto">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

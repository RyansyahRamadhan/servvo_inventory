@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Edit Mutasi Rak #{{ $m->id }}</h3>

  @if($errors->any())
    <div class="alert alert-danger">{{ implode(' | ', $errors->all()) }}</div>
  @endif

  <form method="POST" action="{{ route('moverak.update', $m->id) }}">
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-body row g-3">

        <div class="col-md-4">
          <label>Tanggal</label>
          <input type="date" name="tanggal" class="form-control"
                 value="{{ old('tanggal', \Carbon\Carbon::parse($m->tanggal)->format('Y-m-d')) }}" required>
        </div>

        <div class="col-md-4">
          <label>Kode Barang</label>
          <input type="text" name="kode_barang" class="form-control"
                 value="{{ old('kode_barang', $m->kode_barang) }}" readonly>
        </div>

        <div class="col-md-4">
          <label>Nama Barang</label>
          <input type="text" class="form-control"
                 value="{{ $m->nama_barang ?? '-' }}" readonly>
        </div>

        <div class="col-md-4">
          <label>Qty Baru</label>
          <input type="number" step="0.0001" name="qty" class="form-control"
                 value="{{ old('qty', $m->qty) }}" required>
        </div>

        <div class="col-md-4">
          <label>Rak Asal</label>
          <input type="text" class="form-control"
                 value="{{ $m->rak_asal_nama }}" readonly>
          <input type="hidden" name="rak_asal_id" value="{{ $m->rak_asal_id }}">
        </div>

        <div class="col-md-4">
          <label>Rak Tujuan</label>
          <input type="text" class="form-control"
                 value="{{ $m->rak_tujuan_nama }}" readonly>
          <input type="hidden" name="rak_tujuan_id" value="{{ $m->rak_tujuan_id }}">
        </div>

        <div class="col-md-6">
          <label>Deskripsi</label>
          <input type="text" name="deskripsi" class="form-control"
                 value="{{ old('deskripsi', $m->deskripsi) }}">
        </div>

      </div>
      <div class="card-footer d-flex gap-2">
        <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        <a href="{{ route('moverak.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </div>
  </form>
</div>
@endsection

{{-- resources/views/input/Penyesuaian/show.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Detail Penyesuaian</h3>

  <div class="card">
    <div class="card-body">
      <dl class="row mb-0">
        <dt class="col-sm-3">No Dokumen</dt><dd class="col-sm-9">{{ $row->no_dokumen }}</dd>
        <dt class="col-sm-3">Tanggal</dt><dd class="col-sm-9">{{ $row->tanggal->format('d M Y') }}</dd>
        <dt class="col-sm-3">Kode Barang</dt><dd class="col-sm-9">{{ $row->kode_barang }}</dd>
        <dt class="col-sm-3">Nama Barang</dt><dd class="col-sm-9">{{ $row->nama_barang }}</dd>
        <dt class="col-sm-3">Lorong / Rak</dt><dd class="col-sm-9">{{ $row->nama_lorong }} / {{ $row->nama_rak }}</dd>
        <dt class="col-sm-3">Qty</dt><dd class="col-sm-9">{{ number_format($row->qty) }}</dd>
        <dt class="col-sm-3">Keterangan</dt><dd class="col-sm-9">{{ $row->keterangan }}</dd>
      </dl>
    </div>
    <div class="card-footer d-flex gap-2">
      <a href="{{ route('penyesuaian.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
      <a href="{{ route('penyesuaian.edit', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Edit</a>
      <form class="ms-auto" method="POST" action="{{ route('penyesuaian.destroy',$row->id) }}"
            onsubmit="return confirm('Hapus penyesuaian {{ $row->no_dokumen }}?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger"><i class="fas fa-trash me-1"></i>Hapus</button>
      </form>
    </div>
  </div>
</div>
@endsection

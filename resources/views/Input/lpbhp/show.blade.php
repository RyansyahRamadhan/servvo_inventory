@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-3">Detail LPBHP</h3>

  <div class="mb-3">
    <a href="{{ route('lpbhp.index') }}" class="btn btn-secondary btn-sm w-auto">← Kembali</a>
  </div>

  <div class="card mb-3">
    <div class="card-body row g-3">
      <div class="col-md-4"><strong>No LPBHP:</strong> {{ $lpbhp->no_lpbhp }}</div>
      <div class="col-md-4"><strong>Tanggal:</strong> {{ $lpbhp->tanggal_lpbhp }}</div>
      <div class="col-md-4"><strong>No FPB:</strong> {{ $lpbhp->no_fpb }}</div>
      <div class="col-md-4"><strong>Kode Barang:</strong> {{ $lpbhp->kode_barang }}</div>
      <div class="col-md-4"><strong>Nama Barang:</strong> {{ $lpbhp->nama_barang }}</div>
      <div class="col-md-4"><strong>Qty:</strong> {{ $lpbhp->qty }}</div>
    </div>
  </div>

  <h5>Rak Terpakai</h5>
  <table class="table table-bordered text-center">
    <thead class="table-light">
      <tr><th>No</th><th>Nama Rak</th></tr>
    </thead>
    <tbody>
      @forelse($lpbhp->details as $i => $d)
        <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $d->nama_rak }}</td>
        </tr>
      @empty
        <tr><td colspan="2">Tidak ada detail rak.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

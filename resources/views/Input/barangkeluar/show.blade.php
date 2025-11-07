@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <h4 class="mb-3">Detail Barang Keluar</h4>

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3"><strong>No Dokumen</strong><div>{{ $h->no_dokumen }}</div></div>
        <div class="col-md-3"><strong>Tanggal</strong><div>{{ \Carbon\Carbon::parse($h->tanggal)->format('d/m/Y') }}</div></div>
        <div class="col-md-6"><strong>Keterangan</strong><div>{{ $h->keterangan }}</div></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Kode</th><th>Nama</th><th>Qty</th><th>Lorong</th><th>Rak</th>
          </tr>
        </thead>
        <tbody>
          @foreach($d as $r)
            <tr>
              <td>{{ $r->kode_barang }}</td>
              <td class="text-start">{{ $r->nama_barang }}</td>
              <td>{{ $r->qty }}</td>
              <td>{{ $r->nama_lorong }}</td>
              <td>{{ $r->nama_rak }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <a href="{{ route('input.barangkeluar.index') }}" class="btn btn-secondary">Kembali</a>
      <a href="{{ route('input.barangkeluar.edit',$h->id) }}" class="btn btn-warning">Edit</a>
    </div>
  </div>
</div>
@endsection

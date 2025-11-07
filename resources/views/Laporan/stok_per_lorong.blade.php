@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Laporan Stok — Per Lorong</h3>

  <form class="row g-2 mb-3" method="get" action="{{ route('laporan.stok-per-lorong') }}">
    <div class="col-md-4">
      <label class="form-label">Lorong</label>
      <select name="lorong" class="form-select">
        <option value="">— Semua —</option>
        @foreach($lorongList as $l)
          <option value="{{ $l }}" {{ $lorong==$l ? 'selected':'' }}>{{ $l }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Kode Barang</label>
      <select name="kode_barang" class="form-select">
        <option value="">— Semua —</option>
        @foreach($kodeList as $k)
          <option value="{{ $k }}" {{ $kode==$k ? 'selected':'' }}>{{ $k }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4 d-flex align-items-end gap-2">
      <button class="btn btn-primary" type="submit">Filter</button>
      <a href="{{ route('laporan.stok-per-lorong') }}" class="btn btn-outline-secondary">Reset</a>
      <a href="{{ route('laporan.stok-per-rak', request()->query()) }}" class="btn btn-outline-dark">Mode: Per Rak</a>
    </div>
  </form>

  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-sm table-striped align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Lorong</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th class="text-end">Qty</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
        @forelse($data as $i => $row)
          <tr>
            <td>{{ $data->firstItem() + $i }}</td>
            <td>{{ $row->nama_lorong }}</td>
            <td><code>{{ $row->kode_barang }}</code></td>
            <td>{{ $row->nama_barang }}</td>
            <td class="text-end fw-semibold">{{ number_format($row->qty) }}</td>
            <td>
              <a href="{{ route('laporan.stok-per-lorong.show', [$row->kode_barang, $row->nama_lorong]) }}"
                 class="btn btn-outline-primary btn-sm">
                Detail
              </a>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted">Tidak ada data</td></tr>
        @endforelse
        </tbody>
      </table>
      {{ $data->links() }}
    </div>
  </div>
</div>
@endsection

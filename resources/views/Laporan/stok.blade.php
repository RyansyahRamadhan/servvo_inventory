@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Laporan Stok</h3>

  <form class="row g-2 mb-3" method="get">
    <div class="col-auto">
      <input type="text" name="q" value="{{ $search }}" class="form-control form-control-sm" placeholder="Cari kode/nama barang">
    </div>
    <div class="col-auto">
      <select name="rak" class="form-select form-select-sm">
        <option value="">-- Semua Rak --</option>
        @foreach($listRak as $rk)
          <option value="{{ $rk }}" {{ $rak==$rk ? 'selected' : '' }}>{{ $rk }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-auto">
      <button class="btn btn-sm btn-primary">Terapkan</button>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-sm table-striped align-middle">
      <thead>
        <tr><th>Kode</th><th>Nama Barang</th><th>Rak</th><th class="text-end">Qty</th><th>Update Terakhir</th></tr>
      </thead>
      <tbody>
        @forelse($data as $row)
          <tr>
            <td>{{ $row->kode_barang }}</td>
            <td>{{ $row->nama_barang }}</td>
            <td>{{ $row->nama_rak }}</td>
            <td class="text-end">{{ number_format($row->qty) }}</td>
            <td>{{ \Carbon\Carbon::parse($row->updated_at)->format('d-m-Y H:i') }}</td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $data->links() }}
</div>
@endsection

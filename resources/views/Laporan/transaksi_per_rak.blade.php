@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Report Keluar/Masuk per Rak</h3>

  <form class="row g-2 mb-3" method="get">
    <div class="col-auto">
      <select name="rak" class="form-select form-select-sm">
        <option value="">-- Semua Rak --</option>
        @foreach($listRak as $rk)
          <option value="{{ $rk }}" {{ $rak==$rk ? 'selected' : '' }}>{{ $rk }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-auto">
      <input type="date" name="dari" value="{{ $dari }}" class="form-control form-control-sm">
    </div>
    <div class="col-auto">
      <input type="date" name="sampai" value="{{ $sampai }}" class="form-control form-control-sm">
    </div>
    <div class="col-auto">
      <button class="btn btn-sm btn-primary">Terapkan</button>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-sm table-striped align-middle">
      <thead>
        <tr>
          <th>Tanggal</th><th>Kode</th><th>Nama Barang</th>
          <th>Rak Asal</th><th>Rak Tujuan</th>
          <th class="text-end">Qty</th><th>Tipe</th><th>Dokumen</th><th>User</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $row)
          <tr>
            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y H:i') }}</td>
            <td>{{ $row->kode_barang }}</td>
            <td>{{ $row->nama_barang }}</td>
            <td>{{ $row->rak_asal }}</td>
            <td>{{ $row->rak_tujuan }}</td>
            <td class="text-end">{{ number_format($row->qty) }}</td>
            <td class="text-uppercase">{{ $row->tipe }}</td>
            <td>
              @if(!empty($row->dokumen_path))
                <a href="{{ Storage::url($row->dokumen_path) }}" target="_blank">Lihat</a>
              @endif
            </td>
            <td>{{ $row->user }}</td>
          </tr>
        @empty
          <tr><td colspan="9" class="text-center">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $data->links() }}
</div>
@endsection

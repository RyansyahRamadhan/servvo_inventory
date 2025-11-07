@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
  <h3 class="mt-4">Laporan Stok — Per Rak</h3>

  <form class="row g-2 mb-3" method="get" action="{{ route('laporan.stok-per-rak') }}">
    <div class="col-md-3">
      <label class="form-label">Lorong</label>
      <select name="lorong" class="form-select" onchange="this.form.submit()">
        <option value="">— Semua —</option>
        @foreach(($lorongList ?? []) as $val)
          <option value="{{ $val }}" {{ (string)($lorong ?? '') === (string)$val ? 'selected' : '' }}>
            {{ $val }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">Rak</label>
      <select name="id_rak" class="form-select">
        <option value="">— Semua —</option>
        @foreach(($rakList ?? []) as $r)
          <option value="{{ $r->id_rak }}" {{ (string)($idRak ?? '') === (string)$r->id_rak ? 'selected' : '' }}>
            {{ $r->nama_rak }} (ID: {{ $r->id_rak }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">Kode Barang</label>
      <select name="kode_barang" class="form-select">
        <option value="">— Semua —</option>
        @foreach(($kodeList ?? []) as $k)
          <option value="{{ $k }}" {{ (string)($kode ?? '') === (string)$k ? 'selected' : '' }}>
            {{ $k }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3 d-flex align-items-end gap-2">
      <button class="btn btn-primary" type="submit">Filter</button>
      <a href="{{ route('laporan.stok-per-rak') }}" class="btn btn-outline-secondary">Reset</a>
      <a href="{{ route('laporan.stok-per-lorong', request()->query()) }}" class="btn btn-outline-dark">Mode: Per Lorong</a>
    </div>
  </form>

  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-sm table-striped align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Lorong</th>
            <th>Nama Rak</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th> {{-- ← ditambahkan --}}
            <th class="text-end">Qty</th>
          </tr>
        </thead>
        <tbody>
        @forelse($data as $i => $row)
          <tr>
            <td>{{ $data->firstItem() + $i }}</td>
            <td>{{ $row->nama_lorong }}</td>
            <td>{{ $row->nama_rak }}</td>
            <td><code>{{ $row->kode_barang }}</code></td>
            <td>{{ $row->nama_barang ?? '-' }}</td> {{-- ← ditambahkan --}}
            <td class="text-end fw-semibold">{{ number_format($row->qty) }}</td>
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
</main>
</div>
@endsection

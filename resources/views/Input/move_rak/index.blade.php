@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
  <h3 class="mt-4">Daftar Move Rak</h3>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">{{ implode(' | ', $errors->all()) }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>
    <a href="{{ route('moverak.create') }}" class="btn btn-primary btn-sm w-auto">Tambah Move Rak</a>
  </div>

  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
          <tr>
            <th style="width:110px">Tanggal</th>
            <th>No Dokumen</th>
            <th>Kode</th>
            <th class="text-start">Nama Barang</th>
            <th style="width:90px">Qty</th>
            <th class="text-start">Dari</th>
            <th class="text-start">Ke</th>
            <th style="width:130px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($rows as $r)
          <tr>
            <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
            <td class="text-start">
              <div><strong>{{ $r->base_no }}</strong></div>
              <small class="text-muted">OUT: {{ $r->no_out }}</small><br>
              <small class="text-muted">IN&nbsp;&nbsp;: {{ $r->no_in }}</small>
            </td>
            <td>{{ $r->kode_barang }}</td>
            <td class="text-start">{{ $r->nama_barang }}</td>
            <td>{{ (int)$r->qty }}</td>
            <td class="text-start">
              <div>{{ $r->rak_from }}</div>
              <small class="text-muted">{{ $r->lorong_from }}</small>
            </td>
            <td class="text-start">
              <div>{{ $r->rak_to ?: '—' }}</div>
              <small class="text-muted">{{ $r->lorong_to ?: '' }}</small>
            </td>
            <td>
       
              <a class="btn btn-sm btn-info"
                 href="{{ route('input.barangkeluar.show', $r->id) ?? '#' }}"
                 title="Detail OUT">Detail OUT</a>
             
            </td>
          </tr>
        @empty
          <tr><td colspan="8" class="text-muted">Belum ada perpindahan rak.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      {{ $rows->links() }}
    </div>
  </div>
</div>
              </main>
              </div>
@endsection

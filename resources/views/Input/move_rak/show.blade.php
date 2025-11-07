@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
<main>
  <div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
      <h4 class="m-0">Detail Mutasi Rak #{{ $m->id }}</h4>
      <div>
        <a href="{{ route('moverak.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        <a href="{{ route('moverak.edit', $m->id) }}" class="btn btn-warning btn-sm">
          <i class="fa fa-edit"></i> Edit
        </a>
        <form action="{{ route('moverak.destroy', $m->id) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Hapus mutasi ini?')">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> Hapus
          </button>
        </form>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <table class="table table-sm mb-0">
              <tr>
                <th style="width:180px">Tanggal</th>
                <td>{{ \Carbon\Carbon::parse($m->tanggal)->format('d/m/Y H:i') }}</td>
              </tr>
              <tr>
                <th>Kode Barang</th>
                <td>{{ $m->kode_barang }}</td>
              </tr>
              <tr>
                <th>Qty</th>
                <td>{{ number_format($m->qty, 0, ',', '.') }}</td>
              </tr>
              <tr>
                <th>User</th>
                <td>{{ $m->user_name ?? '-' }}</td>
              </tr>
              <tr>
                <th>No/Deskripsi Dokumen</th>
                <td>{{ $m->deskripsi ?? '-' }}</td>
              </tr>
            </table>
          </div>

          <div class="col-md-6">
            <table class="table table-sm mb-0">
              <tr class="table-light">
                <th colspan="2">Asal</th>
              </tr>
              <tr>
                <th style="width:180px">ID Rak Asal</th>
                <td>{{ $m->rak_asal_id }}</td>
              </tr>
              <tr>
                <th>Nama Rak Asal</th>
                <td>{{ $m->rak_asal_nama }}</td>
              </tr>

              <tr class="table-light">
                <th colspan="2">Tujuan</th>
              </tr>
              <tr>
                <th>ID Rak Tujuan</th>
                <td>{{ $m->rak_tujuan_id }}</td>
              </tr>
              <tr>
                <th>Nama Rak Tujuan</th>
                <td>{{ $m->rak_tujuan_nama }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
</div>
@endsection

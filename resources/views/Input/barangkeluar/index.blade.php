@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">Daftar Barang Keluar</h4>
    <a href="{{ route('input.barangkeluar.create') }}" class="btn btn-primary w-auto">
      <i class="fas fa-plus me-1"></i> Tambah Barang Keluar
    </a>
  </div>

  @if (session('ok'))
    <div class="alert alert-success">{{ session('ok') }}</div>
  @endif

  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
      <thead class="table-light">
  <tr>
    <th>Tanggal</th>
    <th>No Dokumen</th>
    <th>Item</th>
    <th>Total Qty</th>
    <th>Keterangan</th>
    <th style="width:180px">Aksi</th> {{-- NEW --}}
  </tr>
</thead>
<tbody>
@forelse ($rows as $r)
  <tr>
    <td>{{ \Illuminate\Support\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
    <td class="text-start">{{ $r->no_dokumen }}</td>
    <td>{{ $r->jml_item }}</td>
    <td>{{ $r->total_qty }}</td>
    <td class="text-start">{{ $r->keterangan }}</td>
    <td>
      <a class="btn btn-sm btn-info"  href="{{ route('input.barangkeluar.show',$r->id) }}">Detail</a>
      <a class="btn btn-sm btn-warning" href="{{ route('input.barangkeluar.edit',$r->id) }}">Edit</a>
      <form action="{{ route('input.barangkeluar.destroy',$r->id) }}" method="post" class="d-inline"
            onsubmit="return confirm('Hapus dokumen ini? Item akan ikut terhapus.');">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger">Hapus</button>
      </form>
    </td>
  </tr>
@empty
  <tr><td colspan="6" class="text-muted">Belum ada data</td></tr>
@endforelse
</tbody>

      </table>
      <div class="mt-2">
        {{ $rows->withQueryString()->links() }}
      </div>
    </div>
  </div>
</div>
</main>
</div>
@endsection

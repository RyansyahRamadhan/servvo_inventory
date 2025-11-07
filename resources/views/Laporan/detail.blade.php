@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">
    History Transaksi — {{ $kode_barang }} 
    @if($lorong) ({{ $lorong }}) @endif
  </h3>

  <a href="{{ route('laporan.stok-per-lorong') }}" class="btn btn-secondary btn-sm mb-3">&laquo; Kembali</a>

  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-sm table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>No. Dokumen</th>
            <th>Lorong</th>
            <th>Rak</th>
            <th class="text-end">Qty</th>
          </tr>
        </thead>
        <tbody>
          @php $saldo = 0; @endphp
          @forelse($rows as $r)
            @php $saldo += (int)($r['qty'] ?? 0); @endphp
            <tr>
              <td>{{ \Carbon\Carbon::parse($r['tanggal'] ?? null)->format('d-m-Y H:i') }}</td>
              <td>{{ $r['jenis'] ?? '-' }}</td>
              <td><strong>{{ $r['no_dokumen'] ?? '-' }}</strong></td>
              <td>{{ $r['lorong'] ?? '-' }}</td>
              <td>{{ $r['rak'] ?? '-' }}</td>
              <td class="text-end {{ ($r['qty'] ?? 0) < 0 ? 'text-danger' : 'text-success' }}">
                {{ number_format($r['qty'] ?? 0) }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">Tidak ada data.</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th colspan="5" class="text-end">Saldo:</th>
            <th class="text-end">{{ number_format($saldo) }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection

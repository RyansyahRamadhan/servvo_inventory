@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
  <h2 class="mt-4">Laporan Barang per Lorong</h2>

  {{-- Filter --}}
  <form method="GET" action="{{ route('laporan.barang-per-lorong') }}" class="mb-3 d-flex gap-2 flex-wrap">
    <select name="lorong" class="form-select w-auto">
      <option value="">-- Semua Lorong --</option>
      @foreach($lorongList as $l)
        <option value="{{ $l }}" {{ ($lorong ?? '')===$l ? 'selected':'' }}>{{ $l }}</option>
      @endforeach
    </select>

    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control w-auto" placeholder="Cari kode/nama barang">

    <button class="btn btn-primary">Terapkan</button>
    @if(request()->hasAny(['lorong','q']))
      <a href="{{ route('laporan.barang-per-lorong') }}" class="btn btn-outline-secondary">Reset</a>
    @endif
  </form>

  {{-- Tabel agregat --}}
  <div class="table-responsive">
    <table class="table table-sm table-striped align-middle">
      <thead>
        <tr>
          <th style="width: 140px;">Lorong</th>
          <th style="width: 150px;">Kode</th>
          <th>Nama Barang</th>
          <th class="text-end" style="width: 140px;">Qty (Total)</th>
          <th class="text-end" style="width: 110px;"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $row)
          <tr>
            <td>{{ $row->nama_lorong }}</td>
            <td>{{ $row->kode_barang }}</td>
            <td>{{ $row->nama_barang }}</td>
            <td class="text-end">{{ number_format($row->total_qty) }}</td>
            <td class="text-end">
              <button
                class="btn btn-outline-secondary btn-sm btn-detail"
                data-kode="{{ $row->kode_barang }}"
                data-lorong="{{ $lorong ?? '' }}"
              >
                Detail
              </button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted">Tidak ada data</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Stok per Rak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="detailHeader" class="mb-2 small text-muted"></div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Rak</th>
                <th class="text-end">Qty</th>
              </tr>
            </thead>
            <tbody id="detailBody"></tbody>
            <tfoot>
              <tr>
                <th class="text-end">Total</th>
                <th class="text-end" id="detailTotal">0</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('click', async function(e){
  const btn = e.target.closest('.btn-detail');
  if(!btn) return;

  const kode   = btn.dataset.kode;
  const lorong = btn.dataset.lorong || '';

  // Build URL route('laporan.barang-per-lorong.detail', ['kode' => '__K__'])
  let url = `{{ route('laporan.barang-per-lorong.detail', ['kode' => '__K__']) }}`.replace('__K__', encodeURIComponent(kode));
  if (lorong) url += `?lorong=${encodeURIComponent(lorong)}`;

  try {
    const res  = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    const data = await res.json();

    // Header
    const hdr = document.getElementById('detailHeader');
    hdr.textContent = `${data.kode} — ${data.nama_barang || ''}${data.lorong ? ' | ' + data.lorong : ''}`;

    // Body
    const body = document.getElementById('detailBody');
    body.innerHTML = '';
    (data.items || []).forEach(it => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${it.rak}</td>
        <td class="text-end">${Intl.NumberFormat().format(it.qty)}</td>
      `;
      body.appendChild(tr);
    });

    // Total
    document.getElementById('detailTotal').textContent = Intl.NumberFormat().format(data.total || 0);

    // Show modal
    const modalEl = document.getElementById('detailModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
  } catch (err) {
    alert('Gagal memuat detail: ' + err.message);
  }
});
</script>
@endpush

@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
    <h3 class="mt-4">Laporan Stok per Lorong</h3>

    {{-- ===================== Filter ===================== --}}
    <form method="GET" action="{{ route('laporan.stok-per-lorong') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label mb-1">Lorong</label>
            <select name="lorong" class="form-select">
                <option value="">Semua Lorong</option>
                @foreach($lorongList as $lr)
                    <option value="{{ $lr }}" {{ $lorong == $lr ? 'selected' : '' }}>{{ $lr }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label mb-1">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" placeholder="Cari kode…" value="{{ $kode }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('laporan.stok-per-lorong') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </form>

    {{-- ===================== Tabel ===================== --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Lorong</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th class="text-end">Total Qty</th>
                        <th class="text-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td>{{ $row->nama_lorong }}</td>
                        <td>{{ $row->kode_barang }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td class="text-end">{{ number_format($row->total_qty) }}</td>
                        <td class="text-nowrap">
                            {{-- Detail histori (halaman terpisah) --}}
                            <a class="btn btn-sm btn-info w-auto"
                               href="{{ route('laporan.stok-per-lorong.show', [$row->kode_barang, $row->nama_lorong]) }}">
                                Detail
                            </a>

                            {{-- Detail Rak (modal) + bawa nama & URL export --}}
                            <button type="button"
                                    class="btn btn-sm btn-secondary btn-rak w-auto"
                                    data-kode="{{ $row->kode_barang }}"
                                    data-lorong="{{ $row->nama_lorong }}"
                                    data-nama="{{ $row->nama_barang }}"
                                    data-url="{{ route('laporan.stok-per-lorong.rak') }}"
                                    data-export-url="{{ route('laporan.stok-per-lorong.rak.export') }}">
                                Detail Rak
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ===================== Modal Detail Rak ===================== --}}
<div class="modal fade" id="rakModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center justify-content-between">
        <div>
          <h5 class="modal-title mb-0">
            Detail Rak • <span id="rakTitleLorong"></span> • <code id="rakTitleKode"></code>
          </h5>
          <small class="text-muted" id="rakTitleName"></small>
        </div>
        <div class="d-flex gap-2">
          <a id="rakExportBtn" href="#" class="btn btn-sm btn-success" target="_blank" rel="noopener">
            Export Excel
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <div class="modal-body">
        <div id="rakLoading" class="text-center my-3" style="display:none;">Loading…</div>
        <div class="table-responsive">
          <table class="table table-sm table-bordered align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Nama Rak</th>
                <th style="width: 140px;">Tanggal</th>
                <th class="text-end" style="width: 120px;">Qty</th>
              </tr>
            </thead>
            <tbody id="rakTbody">
              <tr><td colspan="3" class="text-center text-muted">Belum ada data</td></tr>
            </tbody>
            <tfoot class="table-light">
              <tr>
                <th class="text-end" colspan="2">TOTAL</th>
                <th class="text-end" id="rakTotal">0</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
</main>
</div>
{{-- ===================== Script Detail Rak ===================== --}}
<script>
(function(){
  const fmt = new Intl.NumberFormat('id-ID');

  function showModal(){
    const el = document.getElementById('rakModal');
    (window._rakModal = window._rakModal || new bootstrap.Modal(el)).show();
  }
  function setLoading(on){
    document.getElementById('rakLoading').style.display = on ? '' : 'none';
  }
  function safeDateStr(v){
    // Terima r.tanggal_terakhir atau r.tanggal (string)
    if(!v) return '-';
    try {
      // Jika format ISO/SQL, kita bisa format lokal; kalau gagal, tampilkan apa adanya
      const d = new Date(v);
      if(!isNaN(d.getTime())) return d.toLocaleDateString('id-ID');
      return String(v);
    } catch { return String(v); }
  }
  function setRows(rows){
    const tb = document.getElementById('rakTbody');
    tb.innerHTML = '';
    let total = 0;
    if(!rows || !rows.length){
      tb.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>';
      document.getElementById('rakTotal').textContent = '0';
      return;
    }
    rows.forEach(r=>{
      const q = Number(r.qty_rak||0);
      total += q;
      const tgl = r.tanggal_terakhir || r.tanggal || '';
      tb.insertAdjacentHTML('beforeend',
        `<tr>
           <td>${r.nama_rak || '-'}</td>
           <td>${safeDateStr(tgl)}</td>
           <td class="text-end">${fmt.format(q)}</td>
         </tr>`);
    });
    document.getElementById('rakTotal').textContent = fmt.format(total);
  }

  // handler tombol Detail Rak
  document.querySelectorAll('.btn-rak').forEach(btn=>{
    btn.addEventListener('click', async ()=>{
      const kode   = btn.dataset.kode || '';
      const lorong = btn.dataset.lorong || '';
      const nama   = btn.dataset.nama || '';
      const url    = btn.dataset.url;
      const exportUrlBase = btn.dataset.exportUrl;

      // header modal
      document.getElementById('rakTitleLorong').textContent = lorong || 'Semua Lorong';
      document.getElementById('rakTitleKode').textContent   = kode;
      document.getElementById('rakTitleName').textContent   = nama;

      // set link Export Excel (CSV)
      const params = new URLSearchParams({ kode_barang: kode, lorong: lorong, nama: nama });
      document.getElementById('rakExportBtn').setAttribute('href', `${exportUrlBase}?${params.toString()}`);

      // load data ke modal
      setRows([]); setLoading(true); showModal();
      try{
        const qs  = new URLSearchParams({ kode_barang: kode, lorong: lorong }).toString();
        const res = await fetch(url + '?' + qs, { headers: { 'X-Requested-With':'XMLHttpRequest' } });
        const j   = await res.json();
        setRows(j?.data || []);
      }catch(e){
        console.error(e);
        setRows([]);
        alert('Gagal memuat detail rak.');
      }finally{
        setLoading(false);
      }
    });
  });
})();
</script>
@endsection

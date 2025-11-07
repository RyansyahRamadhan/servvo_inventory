@extends('layouts.app')
@section('content')
<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
  <h3 class="mt-4">Tambah LPBHP</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('lpbhp.store') }}">
    @csrf
    <div class="card mb-3">
      <div class="card-body row g-3">

        <div class="col-md-4">
          <label class="form-label">No LPBHP</label>
          <input type="text" name="no_lpbhp" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label class="form-label">Tanggal</label>
          <input type="date" name="tanggal_lpbhp" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label class="form-label">No FPB</label>
          <select name="no_fpb" id="no_fpb" class="form-control" required>
            <option value="">-- Pilih FPB --</option>
            @foreach ($fpbList as $fpb)
              <option value="{{ $fpb->no_fpb }}">
                {{ $fpb->no_fpb }} — {{ $fpb->nama_formula }} (sisa: {{ $fpb->sisa_qty }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Kode Barang</label>
          <input type="text" name="kode_barang" id="kode_barang" class="form-control" readonly>
        </div>

        <div class="col-md-4">
          <label class="form-label">Nama Barang</label>
          <input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly>
        </div>

        <div class="col-md-4">
          <label class="form-label">Qty</label>
          <input type="number" name="qty" id="qty" class="form-control" min="1">
        </div>

        <div class="col-md-4">
          <label class="form-label">Kapasitas / Rak</label>
          <input type="number" id="kapasitas" class="form-control" readonly>
        </div>

        <div class="col-md-4">
          <label class="form-label">Jumlah Rak</label>
          <input type="number" id="jumlah_rak" class="form-control" readonly>
        </div>

        {{-- Lorong: readonly (normal) atau dropdown (cylinder/trolley). Tidak disimpan ke DB --}}
        <div class="col-md-4">
          <label class="form-label">Nama Lorong</label>
          <input type="text" id="nama_lorong_text" class="form-control d-none" readonly>
          <select id="nama_lorong_select" class="form-control d-none"></select>
          <input type="hidden" id="nama_lorong" name="nama_lorong">
        </div>

        <div class="col-md-8">
          <label class="form-label">Rak (Rekomendasi)</label>
          <div id="rak-container" class="border rounded p-2" style="min-height: 50px;"></div>
        </div>

      </div>
    </div>

    <div>
      <button type="submit" class="btn btn-success btn-sm w-auto">Simpan</button>
      <a href="{{ route('lpbhp.index') }}" class="btn btn-secondary btn-sm w-auto">Batal</a>
    </div>
  </form>
</div>
</main>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let maxRak = 0;

  const el = (id) => document.getElementById(id);
  const noFpb       = el('no_fpb');
  const kodeBarang  = el('kode_barang');
  const namaBarang  = el('nama_barang');
  const qtyEl       = el('qty');
  const kapasitasEl = el('kapasitas');
  const jumlahRakEl = el('jumlah_rak');
  const lorongHid   = el('nama_lorong');
  const lorongText  = el('nama_lorong_text');
  const lorongSel   = el('nama_lorong_select');
  const rakContainer= el('rak-container');

  function setMaxRak(jumlah){ maxRak = jumlah; }

  function updateJumlahRak(){
    const qty = Number(qtyEl.value || 0);
    const kap = Number(kapasitasEl.value || 0);
    if (!kap) return;
    const jr = Math.ceil(qty / kap);
    jumlahRakEl.value = jr;
    setMaxRak(jr);

    const checks = Array.from(document.querySelectorAll('.rak-check:checked'));
    if (checks.length > maxRak) {
      checks.slice(maxRak).forEach(c => c.checked = false);
      alert(`Maksimal hanya ${maxRak} rak yang boleh dipilih.`);
    }
  }

  function renderRak(list){
    rakContainer.innerHTML = '';
    list.forEach(rak => {
      const div = document.createElement('div');
      div.className = 'form-check';
      const id = `rak-${CSS.escape(rak.nama_rak)}`;
      div.innerHTML = `
        <input class="form-check-input rak-check" type="checkbox" name="nama_rak[]" value="${rak.nama_rak}" id="${id}">
        <label class="form-check-label" for="${id}">
          ${rak.nama_rak} — ${rak.nama_lorong || ''} (tersedia: ${rak.kapasitas_tersedia})
        </label>`;
      rakContainer.appendChild(div);
    });
    if (!rakContainer.children.length) {
      rakContainer.innerHTML = '<small class="text-muted">Tidak ada rak yang memenuhi syarat pada lorong ini.</small>';
    }
  }

  function setLorongReadonly(value){
    lorongHid.value = value || '';
    lorongText.value = value || '';
    lorongText.classList.remove('d-none');
    lorongSel.classList.add('d-none');
  }

  function setLorongDropdown(options, selected){
    lorongSel.innerHTML = '<option value="">-- Pilih Lorong --</option>' +
      options.map(l => `<option value="${l}" ${l===selected?'selected':''}>${l}</option>`).join('');
    lorongHid.value = lorongSel.value || '';
    lorongText.classList.add('d-none');
    lorongSel.classList.remove('d-none');
  }

  qtyEl.addEventListener('input', updateJumlahRak);

  noFpb.addEventListener('change', function(){
    const no_fpb = this.value;
    if (!no_fpb) return;

    fetch(`/lpbhp/get-fpb/${no_fpb}`)
      .then(r => r.json())
      .then(data => {
        const { kode_barang, nama_barang, qty } = data;
        kodeBarang.value = kode_barang;
        namaBarang.value = nama_barang;
        qtyEl.value = qty;

        return fetch(`/lpbhp/get-kapasitas/${kode_barang}`);
      })
      .then(r => r.json())
      .then(kap => {
        kapasitasEl.value = kap.kapasitas;
        updateJumlahRak();

        const kode = kodeBarang.value;
        const qtyNow = qtyEl.value;
        const kat = (kap.kategori || '').toLowerCase();

        if (kat === 'cylinder' || kat === 'trolley') {
          // kategori bebas → ambil semua lorong
          fetch(`/lpbhp/get-lorong-list`)
            .then(r => r.json())
            .then(list => {
              setLorongDropdown(list, '');
              rakContainer.innerHTML = '<small class="text-muted">Pilih lorong untuk melihat rak yang memenuhi syarat.</small>';
            });
        } else {
          // normal → lorong standar readonly + langsung load rak
          setLorongReadonly(kap.nama_lorong || '');
          fetch(`/lpbhp/get-rak-rekomendasi/${kode}/${qtyNow}?lorong=${encodeURIComponent(lorongHid.value)}`)
            .then(r=>r.json())
            .then(renderRak);
        }
      })
      .catch(err => {
        alert('Gagal mengambil data FPB/Kapasitas.');
        console.error(err);
      });
  });

  // saat user pilih lorong (kategori bebas)
  lorongSel.addEventListener('change', function(){
    lorongHid.value = this.value || '';
    const kode = kodeBarang.value;
    const qtyNow = qtyEl.value;
    if (!kode || !this.value) { rakContainer.innerHTML = ''; return; }
    fetch(`/lpbhp/get-rak-rekomendasi/${kode}/${qtyNow}?lorong=${encodeURIComponent(this.value)}`)
      .then(r=>r.json())
      .then(renderRak);
  });

  // limit jumlah rak dicentang
  document.addEventListener('change', function(e){
    if (e.target.classList.contains('rak-check')) {
      const checkedCount = document.querySelectorAll('.rak-check:checked').length;
      if (checkedCount > maxRak) {
        e.target.checked = false;
        alert(`Maksimal hanya ${maxRak} rak yang boleh dipilih.`);
      }
    }
  });
});
</script>
@endpush

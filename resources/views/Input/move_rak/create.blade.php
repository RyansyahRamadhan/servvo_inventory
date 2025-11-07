@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Move Rak</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">{{ implode(' | ',$errors->all()) }}</div>
  @endif

  <form method="POST" action="{{ route('moverak.store') }}" id="formMoveRak">
    @csrf
    <div class="card">
      <div class="card-body row g-3">

        {{-- Header --}}
        <div class="col-md-3">
          <label class="form-label">No Dokumen</label>
          <input type="text" name="no_dokumen" class="form-control" value="{{ old('no_dokumen') }}" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Tanggal</label>
          <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" class="form-control" required>
        </div>

        {{-- SUMBER --}}
        <div class="col-12"><hr class="my-2"><strong>Sumber</strong></div>

        <div class="col-md-3">
          <label class="form-label">Lorong Sumber</label>
          <select name="src_lorong" id="src_lorong" class="form-select" required>
            <option value="">-- pilih lorong sumber --</option>
            @foreach($lorongList as $lorong)
              <option value="{{ $lorong }}">{{ $lorong }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Rak Sumber (Terisi)</label>
          <select name="src_rak" id="src_rak" class="form-select" required>
            <option value="">-- pilih rak sumber --</option>
          </select>
          <small class="text-muted">hanya menampilkan rak dengan stok &gt; 0</small>
        </div>

        <div class="col-md-3">
          <label class="form-label">Kode Barang</label>
          <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="contoh: 07.00.00.20" autocomplete="off" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Nama Barang</label>
          <input type="text" id="nama_barang" class="form-control" readonly>
        </div>

        <div class="col-md-3">
          <label class="form-label">Kategori</label>
          <input type="text" id="kategori" class="form-control" readonly>
        </div>
        <div class="col-md-3">
          <label class="form-label">Qty</label>
          <input type="number" step="0.0001" name="qty" class="form-control" value="{{ old('qty') }}" required>
        </div>

        {{-- TUJUAN --}}
        <div class="col-12"><hr class="my-2"><strong>Tujuan</strong></div>

        <div class="col-md-3">
          <label class="form-label">Lorong Tujuan</label>
          <select name="to_lorong" id="to_lorong" class="form-select" required>
            <option value="">-- pilih lorong tujuan --</option>
            @foreach($lorongList as $lorong)
              <option value="{{ $lorong }}">{{ $lorong }}</option>
            @endforeach
          </select>
          <small id="lockInfo" class="text-muted"></small>
        </div>

        <div class="col-md-3">
          <label class="form-label">Rak Tujuan (hanya yang kosong)</label>
          <select name="to_rak" id="to_rak" class="form-select" required>
            <option value="">-- pilih rak tujuan --</option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Keterangan (opsional)</label>
          <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}">
        </div>

      </div>
      <div class="card-footer d-flex gap-2">
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const srcLorong = document.getElementById('src_lorong');
  const srcRak    = document.getElementById('src_rak');
  const toLorong  = document.getElementById('to_lorong');
  const toRak     = document.getElementById('to_rak');
  const kode      = document.getElementById('kode_barang');
  const nama      = document.getElementById('nama_barang');
  const kategori  = document.getElementById('kategori');
  const lockInfo  = document.getElementById('lockInfo');

  function setOptions(select, list, placeholder='-- pilih --'){
    select.innerHTML = '';
    const opt0 = document.createElement('option');
    opt0.value = ''; opt0.textContent = placeholder;
    select.appendChild(opt0);
    list.forEach(it => {
      const o = document.createElement('option');
      o.value = it.nama_rak || it;
      o.textContent = it.nama_rak ? `${it.nama_rak}${it.qty!==undefined? ' (qty:'+it.qty+')':''}` : it;
      select.appendChild(o);
    });
  }

  async function fetchJson(url){
    const res = await fetch(url, {headers:{'X-Requested-With':'XMLHttpRequest'}});
    if(!res.ok) throw new Error(await res.text());
    return res.json();
  }

  // Sumber: rak dengan stok > 0
  async function loadRakSumber(){
    const lor = srcLorong.value;
    setOptions(srcRak, [], '-- pilih rak sumber --');
    if(!lor) return;
    try {
      const data = await fetchJson(`/move-rak/api/rak/by-lorong?lorong=${encodeURIComponent(lor)}&filter=occupied`);
      setOptions(srcRak, data, '-- pilih rak sumber --');
    } catch(e){ console.error(e); alert('Gagal memuat rak sumber'); }
  }
  srcLorong.addEventListener('change', loadRakSumber);

  // Tujuan: rak kosong
  async function loadRakTujuan(){
    const lor = toLorong.value;
    setOptions(toRak, [], '-- pilih rak tujuan --');
    if(!lor) return;
    try {
      const data = await fetchJson(`/move-rak/api/rak/by-lorong?lorong=${encodeURIComponent(lor)}&filter=empty`);
      setOptions(toRak, data, '-- pilih rak tujuan --');
    } catch(e){ console.error(e); alert('Gagal memuat rak tujuan'); }
  }
  toLorong.addEventListener('change', loadRakTujuan);

  // Lookup barang + standar lorong
  async function lookupBarang(){
    const v = kode.value.trim();
    if(!v){ nama.value=''; kategori.value=''; unlockLorong(); return; }
    nama.value='Mencari...'; kategori.value='...';
    try {
      const b = await fetchJson(`/move-rak/api/barang?kode=${encodeURIComponent(v)}`);
      nama.value = b?.nama_barang || '';
      const s = await fetchJson(`/move-rak/api/standar-rak?kode=${encodeURIComponent(v)}`);
      kategori.value = s?.kategori || '';
      if (['CYLINDER','TROLLEY'].includes(String(s?.kategori||'').toUpperCase())) {
        unlockLorong();
      } else if (s?.lorong_standar) {
        lockLorong(s.lorong_standar);
      } else {
        unlockLorong();
      }
    } catch(e){ console.error(e); nama.value=''; kategori.value=''; unlockLorong(); }
  }
  kode.addEventListener('blur', lookupBarang);
  kode.addEventListener('keydown', e => { if(e.key==='Enter'){ e.preventDefault(); lookupBarang(); } });

  function lockLorong(val){
    toLorong.value = val;
    toLorong.setAttribute('disabled','disabled');
    lockInfo.textContent = `Lorong tujuan dikunci: ${val}`;
    loadRakTujuan();
  }
  function unlockLorong(){
    toLorong.removeAttribute('disabled');
    lockInfo.textContent = '';
  }
});
</script>
@endpush

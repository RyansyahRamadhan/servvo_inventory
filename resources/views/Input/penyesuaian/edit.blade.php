{{-- resources/views/input/Penyesuaian/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Ubah Penyesuaian</h3>

  @if($errors->any())
    <div class="alert alert-danger small mb-3">{{ implode(' | ', $errors->all()) }}</div>
  @endif

  <form method="POST" action="{{ route('penyesuaian.update', $row->id) }}" id="formPenyesuaian">
    @csrf @method('PUT')
    <div class="card">
      <div class="card-body row g-3">

        <div class="col-md-3">
          <label class="form-label fw-semibold">No Dokumen</label>
          <input type="text" name="no_dokumen" value="{{ old('no_dokumen', $row->no_dokumen) }}" class="form-control" required>
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Tanggal</label>
          <input type="date" name="tanggal" value="{{ old('tanggal', $row->tanggal->toDateString()) }}" class="form-control" required>
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Kode Barang</label>
          <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', $row->kode_barang) }}" class="form-control" required autocomplete="off">
          <small class="text-muted">ketik manual kode barang</small>
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Nama Barang</label>
          <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $row->nama_barang) }}" class="form-control" readonly required>
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Nama Lorong</label>
          <select name="nama_lorong" id="nama_lorong" class="form-select" required>
            <option value="">- Pilih Lorong -</option>
            @foreach($lorongs as $l)
              <option value="{{ $l->nama_lorong }}" @selected(old('nama_lorong',$row->nama_lorong)==$l->nama_lorong)>{{ $l->nama_lorong }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label fw-semibold">Nama Rak</label>
          <select name="nama_rak" id="nama_rak" class="form-select" required>
            <option value="">- Pilih Rak -</option>
            @foreach($raks as $r)
              <option value="{{ $r->nama_rak }}" data-lorong="{{ $r->nama_lorong }}"
                @selected(old('nama_rak',$row->nama_rak)==$r->nama_rak)>{{ $r->nama_rak }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label fw-semibold">Qty (+/-)</label>
          <input type="number" name="qty" value="{{ old('qty', $row->qty) }}" class="form-control text-end" required>
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Keterangan</label>
          <input type="text" name="keterangan" value="{{ old('keterangan', $row->keterangan) }}" class="form-control">
        </div>

      </div>
      <div class="card-footer d-flex gap-2">
        <a href="{{ route('penyesuaian.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
        <button class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
      </div>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const kode = document.querySelector('#kode_barang');
  const nama = document.querySelector('#nama_barang');
  const lorong = document.querySelector('#nama_lorong');
  const rak = document.querySelector('#nama_rak');
  const allRak = Array.from(rak.querySelectorAll('option'));

  // filter rak by lorong
  function filterRak(){
    const val = lorong.value;
    rak.innerHTML = '<option value="">- Pilih Rak -</option>';
    allRak.forEach(opt => {
      if (!opt.value) return;
      if (!val || opt.dataset.lorong === val) rak.appendChild(opt.cloneNode(true));
    });
    // keep selected if still valid
    const current = "{{ old('nama_rak', $row->nama_rak) }}";
    if (current) rak.value = current;
  }
  lorong.addEventListener('change', filterRak);
  filterRak();

  // lookup nama barang
  function lookup() {
    const v = kode.value.trim();
    if (!v) { nama.value=''; return; }
    nama.value='Mencari...';
    fetch(`/api/barang?kode=${encodeURIComponent(v)}`)
      .then(r=>r.json().then(b=>({ok:r.ok,body:b})))
      .then(({ok,body})=>{
        nama.value = ok && body?.nama_barang ? body.nama_barang : '';
        if(!ok) alert('Kode barang tidak ditemukan!');
      })
      .catch(()=>{ nama.value=''; alert('Gagal mengambil data barang'); });
  }
  kode.addEventListener('blur', lookup);
  kode.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); lookup(); }});
});
</script>
@endpush

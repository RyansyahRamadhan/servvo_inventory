@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Penyesuaian Stok - Tambah</h3>

    {{-- Alert sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success small mb-3">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger small mb-3">
            {{ implode(' | ', $errors->all()) }}
        </div>
    @endif

    <form method="POST" action="{{ route('penyesuaian.store') }}" id="formPenyesuaian">
        @csrf
        <div class="card">
            <div class="card-body row g-3">

                {{-- ================= Header Dokumen ================= --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">No Dokumen</label>
                    <input type="text" name="no_dokumen" value="{{ old('no_dokumen') }}" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" class="form-control" required>
                </div>

                {{-- ================= Barang ================= --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang') }}" class="form-control" placeholder="contoh: 01.00.11.12.3" required autocomplete="off">
                    <small class="text-muted">ketik manual kode barang</small>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" class="form-control" placeholder="otomatis muncul jika kode valid" readonly required>
                </div>

                {{-- ================= Lokasi ================= --}}
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Nama Lorong</label>
                    <select name="nama_lorong" id="nama_lorong" class="form-select" required>
                        <option value="">- Pilih Lorong -</option>
                        @foreach($lorongs as $l)
                            <option value="{{ $l->nama_lorong }}" @selected(old('nama_lorong')==$l->nama_lorong)>
                                {{ $l->nama_lorong }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Nama Rak</label>
                    <select name="nama_rak" id="nama_rak" class="form-select" required>
                        <option value="">- Pilih Rak -</option>
                        @foreach($raks as $r)
                            <option value="{{ $r->nama_rak }}" data-lorong="{{ $r->nama_lorong }}" @selected(old('nama_rak')==$r->nama_rak)>
                                {{ $r->nama_rak }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ================= Qty dan Keterangan ================= --}}
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Qty (+ / -)</label>
                    <input type="number" name="qty" value="{{ old('qty', 0) }}" class="form-control text-end" required>
                    <small class="text-muted fst-italic">gunakan tanda minus untuk pengurangan</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control" placeholder="opsional, contoh: koreksi stok fisik">
                </div>

            </div>

            {{-- ================= Footer Button ================= --}}
            <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="{{ route('penyesuaian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Penyesuaian
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const kode   = document.querySelector('#kode_barang');
  const nama   = document.querySelector('#nama_barang');
  const lorong = document.querySelector('#nama_lorong');
  const rak    = document.querySelector('#nama_rak');
  const allRak = Array.from(rak.querySelectorAll('option'));

  // filter rak by lorong
  lorong.addEventListener('change', () => {
    const val = lorong.value;
    rak.innerHTML = '<option value="">- Pilih Rak -</option>';
    allRak.forEach(opt => {
      if (!opt.value) return;
      if (!val || opt.dataset.lorong === val) rak.appendChild(opt.cloneNode(true));
    });
  });

  // lookup nama barang (ENTER atau blur)
  function lookupNamaBarang() {
    const val = kode.value.trim();
    if (!val) { nama.value = ''; return; }
    nama.value = 'Mencari...';
    fetch(`/api/barang?kode=${encodeURIComponent(val)}`)
      .then(res => res.json().then(j => ({ok: res.ok, body: j})))
      .then(({ok, body}) => {
        if (ok && body?.nama_barang) {
          nama.value = body.nama_barang;
        } else {
          nama.value = '';
          alert('Kode barang tidak ditemukan di database!');
        }
      })
      .catch(() => {
        nama.value = '';
        alert('Gagal mengambil data barang.');
      });
  }

  kode.addEventListener('blur', lookupNamaBarang);
  kode.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') { e.preventDefault(); lookupNamaBarang(); }
  });
});
</script>

@endpush

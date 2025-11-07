@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <h4 class="mb-3">Edit Barang Keluar</h4>

  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif

  <form method="post" action="{{ route('input.barangkeluar.update',$h->id) }}" id="form-keluar">
    @csrf @method('PUT')

    <div class="card mb-4">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">No Dokumen</label>
            <input type="text" name="no_dokumen" class="form-control" value="{{ old('no_dokumen',$h->no_dokumen) }}">
          </div>
          <div class="col-md-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal',$h->tanggal) }}">
          </div>
          <div class="col-md-5">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan',$h->keterangan) }}">
          </div>
        </div>

        <hr class="my-4">

        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center">
            <thead class="table-secondary">
              <tr>
                <th style="width:160px">Kode Barang</th>
                <th>Nama Barang</th>
                <th style="width:110px">Qty</th>
                <th style="width:160px">Lorong</th>
                <th>Rak (FIFO)</th>
                <th style="width:110px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" id="kode_barang" class="form-control" placeholder="Ketik kode..."></td>
                <td><input type="text" id="nama_barang" class="form-control" readonly></td>
                <td><input type="number" id="qty" class="form-control" min="1" placeholder="0"></td>
                <td>
                  <select id="lorong" class="form-select"><option value="">— otomatis —</option></select>
                </td>
                <td id="rak-container" class="text-start">
                  <small class="text-muted">Isi kode barang untuk memuat rekomendasi FIFO…</small>
                </td>
                <td><button type="button" id="btn-tambah" class="btn btn-primary">Tambah</button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="warning" class="alert alert-warning mt-3 d-none"></div>
      </div>
    </div>

    <div class="card">
      <div class="card-header bg-light"><strong>Preview Data Barang Keluar</strong></div>
      <div class="card-body table-responsive">
        <table class="table table-bordered text-center" id="preview-table">
          <thead class="table-secondary">
            <tr>
              <th>Kode</th><th>Nama</th><th>Qty</th><th>Lorong</th><th>Rak</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <input type="hidden" name="items_json" id="items_json">
      </div>
      <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('input.barangkeluar.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
      </div>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
(function(){
  const preloadItems = {!! $itemsJson !!}; // dari controller
  const kodeEl = document.querySelector('#kode_barang');
  const namaEl = document.querySelector('#nama_barang');
  const qtyEl  = document.querySelector('#qty');
  const lorongEl = document.querySelector('#lorong');
  const rakWrap  = document.querySelector('#rak-container');
  const warnEl   = document.querySelector('#warning');
  const prevBody = document.querySelector('#preview-table tbody');
  const itemsJsonEl = document.querySelector('#items_json');
  let rakData = [];

  const esc = s => String(s||'').replace(/[&<>]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;'}[c]));

  async function loadFIFO(kode){
    rakWrap.innerHTML = '<span class="text-muted">Memuat…</span>';
    try{
      const url = `{{ route('api.fifo-barang') }}?kode=${encodeURIComponent(kode)}`;
      const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
      const data = await res.json();
      if(!data.success){
        namaEl.value = '';
        lorongEl.innerHTML = '<option value="">— otomatis —</option>';
        rakWrap.innerHTML = `<span class="text-danger">${(data.message||'Barang/stok tidak ditemukan.')}</span>`;
        return;
      }
      namaEl.value = data.nama_barang || '';
      lorongEl.innerHTML = '<option value="">— otomatis —</option>';
      (data.lorongs||[]).forEach(l=>{
        const opt=document.createElement('option'); opt.value=l; opt.textContent=l; lorongEl.appendChild(opt);
      });
      rakData = data.raks||[];
      rakWrap.innerHTML = rakData.map((r,i)=>`
        <div class="form-check">
          <input class="form-check-input rak-check" type="checkbox" id="rak${i}" value="${r.id}" data-sisa="${r.qty}" data-lorong="${esc(r.lorong)}">
          <label class="form-check-label" for="rak${i}">${esc(r.nama_rak)} <span class="text-muted">(${esc(r.lorong)})</span> • Sisa ${r.qty}</label>
        </div>`).join('');
    }catch(e){ rakWrap.innerHTML = '<span class="text-danger">Gagal memuat data.</span>'; }
  }
  kodeEl.addEventListener('change', e=>{ const k=e.target.value.trim(); if(k) loadFIFO(k); });

  // tombol Tambah (sama dengan create)
  document.querySelector('#btn-tambah').addEventListener('click', ()=>{
    const kode=kodeEl.value.trim(), nama=namaEl.value.trim(), qty=parseInt(qtyEl.value||'0',10), lorong=lorongEl.value;
    const rakChecks=[...document.querySelectorAll('.rak-check:checked')];
    if(!kode||!nama||!qty){ alert('Lengkapi Kode, Nama, Qty.'); return; }
    if(!rakChecks.length){ alert('Pilih minimal satu Rak.'); return; }
    const totalSisa=rakChecks.reduce((a,c)=>a+parseInt(c.dataset.sisa||'0',10),0);
    if(totalSisa<qty){ warnEl.textContent=`Stok tidak cukup. Total di rak terpilih hanya ${totalSisa}.`; warnEl.classList.remove('d-none'); return; }
    warnEl.classList.add('d-none');
    const rakLabels=rakChecks.map(c=>{ const f=rakData.find(r=>String(r.id)===String(c.value)); return f?f.nama_rak:c.value; });
    const tr=document.createElement('tr');
    tr.innerHTML=`
      <td>${esc(kode)}</td><td class="text-start">${esc(nama)}</td><td>${qty}</td>
      <td>${esc(lorong||'auto')}</td><td class="text-start">${rakLabels.map(esc).join(', ')}</td>
      <td><button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button></td>`;
    tr.dataset.payload=JSON.stringify({kode_barang:kode,nama_barang:nama,qty:qty,lorong:lorong,rak_ids:rakChecks.map(c=>c.value)});
    prevBody.appendChild(tr);
    // reset input atas
    kodeEl.value=''; namaEl.value=''; qtyEl.value=''; lorongEl.innerHTML='<option value="">— otomatis —</option>';
    rakWrap.innerHTML='<small class="text-muted">Isi kode barang untuk memuat rekomendasi FIFO…</small>'; rakData=[];
  });

  prevBody.addEventListener('click',(e)=>{ if(e.target.closest('.btn-hapus')) e.target.closest('tr')?.remove(); });

  // preload dari server (detail lama)
  (function preload(){
    try{
      const items=preloadItems || [];
      items.forEach(it=>{
        const tr=document.createElement('tr');
        tr.innerHTML=`
          <td>${esc(it.kode_barang)}</td>
          <td class="text-start">${esc(it.nama_barang)}</td>
          <td>${esc(it.qty)}</td>
          <td>${esc(it.lorong||'auto')}</td>
          <td class="text-start">${esc((it.display_rak||'').toString())}</td>
          <td><button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button></td>`;
        tr.dataset.payload=JSON.stringify({kode_barang:it.kode_barang,nama_barang:it.nama_barang,qty:it.qty,lorong:it.lorong,rak_ids:it.rak_ids||[]});
        prevBody.appendChild(tr);
      });
    }catch(_){}
  })();

  // submit
  document.querySelector('#form-keluar').addEventListener('submit',(e)=>{
    const rows=[...prevBody.querySelectorAll('tr')];
    if(!rows.length){ e.preventDefault(); alert('Tidak ada item di preview.'); return; }
    const items=rows.map(tr=>JSON.parse(tr.dataset.payload||'{}'));
    itemsJsonEl.value=JSON.stringify(items);
  });
})();
</script>
@endpush

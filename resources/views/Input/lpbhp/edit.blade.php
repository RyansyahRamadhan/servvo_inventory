@extends('layouts.app')
@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
  <h3 class="mt-4">Edit LPBHP</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('lpbhp.update', $lpbhp->no_lpbhp) }}">
    @csrf
    @method('PUT')

    <div class="card mb-3">
      <div class="card-body row g-3">
       <div class="col-md-4">
        <label>No LPBHP</label>
        <input type="text" name="no_lpbhp" class="form-control"
                value="{{ old('no_lpbhp', $lpbhp->no_lpbhp) }}" required>
        </div>

        <div class="col-md-4">
          <label>Tanggal</label>
          <input type="date" name="tanggal_lpbhp" class="form-control"
                 value="{{ old('tanggal_lpbhp', $lpbhp->tanggal_lpbhp) }}" required>
        </div>

        <div class="col-md-4">
          <label>No FPB</label>
          <select name="no_fpb" class="form-control" required>
            @foreach ($fpbList as $fpb)
              <option value="{{ $fpb->no_fpb }}" {{ $fpb->no_fpb == old('no_fpb', $lpbhp->no_fpb) ? 'selected' : '' }}>
                {{ $fpb->no_fpb }} — {{ $fpb->nama_formula }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label>Kode Barang</label>
          <input type="text" name="kode_barang" class="form-control"
                 value="{{ old('kode_barang', $lpbhp->kode_barang) }}" required>
        </div>

        <div class="col-md-4">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control"
                 value="{{ old('nama_barang', $lpbhp->nama_barang) }}" required>
        </div>

        <div class="col-md-4">
          <label>Qty</label>
          <input type="number" name="qty" class="form-control"
                 value="{{ old('qty', $lpbhp->qty) }}" min="1" required>
        </div>

       <div class="col-md-4">
            <label>Kapasitas / Rak</label>
            <input type="number" class="form-control" value="{{ $kapasitas }}" readonly>
          </div>

        <div class="col-md-4">
        <label>Jumlah Rak</label>
        <input type="number" class="form-control" value="{{ $jumlahRak }}" readonly>
      </div>

      <div class="col-md-12">
        <label>Rak (centang ulang)</label>
        <div class="border rounded p-2" style="min-height:50px;">
          @forelse(($allRak ?? []) as $rak)
            @php
              $meta = $rakMeta[$rak] ?? null;
              $labelTambahan = $meta ? " (".$meta['tersedia']."/".$meta['total'].")" : '';
            @endphp
            <div class="form-check form-check-inline mb-1">
              <input class="form-check-input" type="checkbox"
                    name="nama_rak[]" id="rak-{{ $rak }}" value="{{ $rak }}"
                    {{ in_array($rak, old('nama_rak', $selectedRak ?? [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="rak-{{ $rak }}">
                {{ $rak }}{{ $labelTambahan }}
                @if(isset($meta['lorong']))
                  <small class="text-muted"> • {{ $meta['lorong'] }}</small>
                @endif
              </label>
            </div>
          @empty
            <span class="text-muted">Data rak belum tersedia.</span>
          @endforelse
        </div>
      </div>


     
    <button class="btn btn-success btn-sm w-auto me-2">Simpan Perubahan</button>
<a href="{{ route('lpbhp.index') }}" class="btn btn-secondary btn-sm w-auto">Batal</a>
 </div>
    </div>
  </form>
</div>

</main>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('change', function(e){
  if (e.target.name === 'nama_rak[]') {
    const maxRak = parseInt(document.querySelector('input[readonly][value="{{ $jumlahRak }}"]')?.value || '{{ $jumlahRak }}', 10);
    const checked = document.querySelectorAll('input[name="nama_rak[]"]:checked').length;
    if (checked > maxRak) {
      e.target.checked = false;
      alert(`Maksimal hanya ${maxRak} rak yang boleh dipilih.`);
    }
  }
});
</script>
@endpush

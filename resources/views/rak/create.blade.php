@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid py-3">
            <div class="card shadow-sm" style="max-width: 900px; margin: auto;">
                <div class="card-header fw-bold bg-light">
                    Tambah Data Rak
                </div>
                <div class="card-body">
                    <form action="{{ route('rak.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="nama_gudang" class="col-sm-3 col-form-label">Nama Gudang</label>
                            <div class="col-sm-9">
                                <select name="nama_gudang" id="nama_gudang" class="form-select" required>
                                    <option value="">Pilih Gudang</option>
                                    @foreach($gudangList as $gudang)
                                        <option value="{{ $gudang }}">{{ $gudang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_lorong" class="col-sm-3 col-form-label">Pilih Lorong</label>
                            <div class="col-sm-9">
                                <select name="nama_lorong" id="nama_lorong" class="form-select" required>
                                    <option value="">Pilih Lorong</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_rak" class="col-sm-3 col-form-label">Nama Rak</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_rak" id="nama_rak" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kapasitas_total" class="col-sm-3 col-form-label">Kapasitas Total</label>
                            <div class="col-sm-9">
                                <input type="number" name="kapasitas_total" id="kapasitas_total" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="kapasitas_tersedia" class="col-sm-3 col-form-label">Kapasitas Tersedia</label>
                            <div class="col-sm-9">
                                <input type="number" name="kapasitas_tersedia" id="kapasitas_tersedia" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('rak.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('nama_gudang').addEventListener('change', function () {
        let nama_gudang = this.value;
        fetch(`/get-lorong-by-gudang?nama_gudang=${encodeURIComponent(nama_gudang)}`)
            .then(response => response.json())
            .then(data => {
                let lorongSelect = document.getElementById('nama_lorong');
                lorongSelect.innerHTML = '<option value="">Pilih Lorong</option>';
                data.forEach(lorong => {
                    let option = document.createElement('option');
                    option.value = lorong;
                    option.textContent = lorong;
                    lorongSelect.appendChild(option);
                });
            });
    });
</script>
@endpush

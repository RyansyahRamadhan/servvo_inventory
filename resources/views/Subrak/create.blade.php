@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid py-3">
            <div class="card shadow-sm" style="max-width: 900px; margin: auto;">
                <div class="card-header fw-bold bg-light">
                    Tambah Sub-Rak
                </div>
                <div class="card-body">
                    <form action="{{ route('subrak.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Lorong</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="Lorong 2" disabled>
                                <input type="hidden" name="nama_lorong" value="Lorong 2">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Pilih Rak (di Lorong 2)</label>
                            <div class="col-sm-9">
                                <select name="nama_rak" class="form-select" required>
                                    <option value="">-- Pilih Rak --</option>
                                    @foreach($rakList as $rak)
                                        <option value="{{ $rak->nama_rak }}">{{ $rak->nama_rak }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Jumlah Sub-Rak</label>
                            <div class="col-sm-9">
                                <input type="number" name="jumlah_subrak" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Kapasitas per Sub-Rak</label>
                            <div class="col-sm-9">
                                <input type="number" name="kapasitas" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('rak.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm px-4">Tambah Sub-Rak</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

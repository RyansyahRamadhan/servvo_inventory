@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
       <div class="container-fluid py-3">
            <div class="card shadow-sm" style="max-width: 900px; margin: auto;">
                <div class="card-header fw-bold bg-light">
                    Tambah Data Lorong
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lorong.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="nama_lorong" class="col-sm-3 col-form-label">Nama Lorong</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_lorong" id="nama_lorong" class="form-control"
                                    placeholder="Masukkan Nama Lorong" required value="{{ old('nama_lorong') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="nama_gudang" class="col-sm-3 col-form-label">Gudang</label>
                            <div class="col-sm-9">
                                <select name="nama_gudang" id="nama_gudang" class="form-select" required>
                                    <option value="" disabled selected>Pilih Gudang</option>
                                    @foreach($gudangList as $g)
                                        <option value="{{ $g->nama_gudang }}" {{ old('nama_gudang') == $g->nama_gudang ? 'selected' : '' }}>
                                            {{ $g->nama_gudang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('lorong.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

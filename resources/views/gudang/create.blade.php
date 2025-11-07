@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid py-3">
            <div class="card shadow-sm" style="max-width: 900px; margin: auto;">
                <div class="card-header fw-bold bg-light">
                    Tambah Data Gudang
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

                    <form action="{{ route('gudang.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <label for="nama_gudang" class="col-sm-3 col-form-label">Nama Gudang</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_gudang" id="nama_gudang" class="form-control"
                                    placeholder="Masukkan nama gudang" required value="{{ old('nama_gudang') }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('gudang.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

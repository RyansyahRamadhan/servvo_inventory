@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid py-3">
            <div class="card shadow-sm" style="max-width: 700px; margin: auto;">
                <div class="card-header fw-bold bg-light">
                    Edit Gudang
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('gudang.update', $gudang->id_gudang) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Gudang</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_gudang" class="form-control" value="{{ old('nama_gudang', $gudang->nama_gudang) }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('gudang.index') }}" class="btn btn-secondary btn-sm w-auto">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm w-auto">Simpan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </main>
</div>
@endsection

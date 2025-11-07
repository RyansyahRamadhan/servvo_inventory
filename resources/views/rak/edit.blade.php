@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i> Edit Rak
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

                    <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_lorong">Nama Lorong</label>
                            <select name="nama_lorong" class="form-select" required>
                                <option disabled>Pilih Lorong</option>
                                @foreach($lorongList as $lorong)
                                    <option value="{{ $lorong->nama_lorong }}"
                                        {{ $rak->nama_lorong == $lorong->nama_lorong ? 'selected' : '' }}>
                                        {{ $lorong->nama_lorong }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_rak">Nama Rak</label>
                            <input type="text" name="nama_rak" class="form-control" value="{{ $rak->nama_rak }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kapasitas_total">Kapasitas Total</label>
                            <input type="number" name="kapasitas_total" class="form-control" value="{{ $rak->kapasitas_total }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kapasitas_tersedia">Kapasitas Tersedia</label>
                            <input type="number" name="kapasitas_tersedia" class="form-control" value="{{ $rak->kapasitas_tersedia }}" required>
                        </div>
                             <div class="d-flex justify-content-start gap-2">
                        <a href="{{ route('rak.index') }}" class="btn btn-secondary btn-sm w-auto">Batal</a>
                        <button type="submit" class="btn btn-primary btn-sm w-auto">Update</button>
</div>                   
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

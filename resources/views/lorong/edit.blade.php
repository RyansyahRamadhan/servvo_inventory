@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i> Edit Lorong
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

                    <form action="{{ route('lorong.update', $lorong->id_lorong) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_lorong">NAMA LORONG</label>
                            <input type="text" name="nama_lorong" class="form-control" value="{{ old('nama_lorong', $lorong->nama_lorong) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_gudang">GUDANG</label>
                            <select name="nama_gudang" class="form-select" required>
                                <option disabled value="">Pilih Gudang</option>
                                @foreach($gudangList as $g)
                                    <option value="{{ $g->nama_gudang }}" {{ $lorong->nama_gudang == $g->nama_gudang ? 'selected' : '' }}>
                                        {{ $g->nama_gudang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                            <div class="d-flex justify-content-start gap-2">
                        <a href="{{ route('lorong.index') }}" class="btn btn-secondary btn sm w-auto">Batal</a>
                        <button type="submit" class="btn btn-success btn sm w-auto">Update</button>
                    </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> DAFTAR GUDANG
        </div>
        <div class="card-body">
            <a href="{{ route('gudang.create') }}" class="btn btn-primary mb-3 btn-sm w-auto">+ Tambah Gudang</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Gudang</th>
            <th style="width: 120px;">Aksi</th> {{-- <== lebar dikunci --}}
        </tr>
    </thead>
    <tbody>
        @forelse($gudangList as $gudang)
        <tr>
            <td>{{ $gudang->nama_gudang }}</td>
            <td class="text-center" style="white-space: nowrap;">
                <a href="{{ route('gudang.edit', $gudang->id_gudang) }}" class="btn btn-sm btn-primary w-auto">Edit</a>
                <form action="{{ route('gudang.destroy', $gudang->id_gudang) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-auto" onclick="return confirm('Apa Kamu yakin menghapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="2" class="text-center">Tidak ada data ditemukan</td></tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
    </div>
</main>
</div>
@endsection

{{-- resources/views/input/Penyesuaian/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Penyesuaian Stok</h3>

    @if(session('success'))
        <div class="alert alert-success small">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="no_dokumen" value="{{ request('no_dokumen') }}" class="form-control" placeholder="Cari No Dokumen">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="text" name="kode_barang" value="{{ request('kode_barang') }}" class="form-control" placeholder="Kode Barang">
                </div>
                <div class="col-md-3 d-grid d-md-flex gap-2">
                    <button class="btn btn-outline-primary"><i class="fas fa-search me-1"></i>Filter</button>
                    <a href="{{ route('penyesuaian.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Tambah</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>No Dokumen</th>
                        <th>Kode / Nama Barang</th>
                        <th>Lorong</th>
                        <th>Rak</th>
                        <th class="text-end">Qty</th>
                        <th>Keterangan</th>
                        <th style="width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $r)
                    <tr>
                        <td>{{ $r->tanggal->format('d M Y') }}</td>
                        <td>{{ $r->no_dokumen }}</td>
                        <td><span class="text-monospace">{{ $r->kode_barang }}</span><br><small class="text-muted">{{ $r->nama_barang }}</small></td>
                        <td>{{ $r->nama_lorong }}</td>
                        <td>{{ $r->nama_rak }}</td>
                        <td class="text-end fw-semibold">{{ number_format($r->qty) }}</td>
                        <td>{{ $r->keterangan }}</td>
                        <td class="text-nowrap">
                            <a class="btn btn-light btn-sm" href="{{ route('penyesuaian.show', $r->id) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm" href="{{ route('penyesuaian.edit', $r->id) }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('penyesuaian.destroy', $r->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus penyesuaian {{ $r->no_dokumen }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($rows->hasPages())
            <div class="card-footer">
                {{ $rows->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
      <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> DAFTAR FPB
        </div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

   <div class="d-flex flex-wrap gap-2 justify-content-start mb-3">
        <a href="{{ route('fpb.create') }}" class="btn btn-primary btn-sm w-auto">
            + Buat FPB Baru
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center small">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No FPB</th>
                        <th>Tanggal</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fpbList as $index => $fpb)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $fpb->no_fpb }}</td>
                            <td>{{ \Carbon\Carbon::parse($fpb->tanggal_fpb)->format('d M Y') }}</td>
                            <td>
                                {{ DB::table('fpb_detail')->where('no_fpb', $fpb->no_fpb)->count() }}
                            </td>
                            <td>
                                <form action="{{ route('fpb.destroy', $fpb->no_fpb) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus FPB ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-auto">Hapus</button>
                                </form>

                                <a href="{{ route('fpb.show', $fpb->no_fpb) }}" class="btn btn-sm btn-info w-auto">Detail</a>
                                 <a href="{{ route('fpb.edit', $fpb->no_fpb) }}" class="btn btn-sm btn-warning w-auto">Edit</a>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada data FPB.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
</main>
</div>
@endsection

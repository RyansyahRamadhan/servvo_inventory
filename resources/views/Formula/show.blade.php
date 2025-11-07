@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header fw-bold">DETAIL FORMULA</div>
        <div class="card-body">
            <p><strong>Kode Formula:</strong> {{ $formula->kode_formula }}</p>
            <p><strong>Nama Formula:</strong> {{ $formula->nama_formula }}</p>

            <h5>Detail Barang</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formula->details as $detail)
                    <tr>
                        <td>{{ $detail->kode_barang }}</td>
                        <td>{{ $detail->nama_barang }}</td>
                        <td>{{ $detail->jumlah }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('formula.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</main>
</div>
@endsection

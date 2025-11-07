@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h3>Detail FPB: {{ $fpb->no_fpb }}</h3>
    <p>Tanggal: {{ $fpb->tanggal_fpb }}</p>
    <p>Formula: {{ $fpb->kode_formula }} - {{ $fpb->nama_formula }} (Qty: {{ $fpb->qty_formula }})</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Rak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fpb->details as $item)
                <tr>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->rak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Barang di {{ $lorong }}</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Kode Barang</th>
        <th>Total Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $item)
      <tr>
        <td>{{ $item->kode_barang }}</td>
        <td>{{ $item->total_qty }}</td>
        <td>
          <a href="{{ route('laporan.barang-per-lorong.detail', [$lorong, $item->kode_barang]) }}" class="btn btn-info btn-sm">
            Detail
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

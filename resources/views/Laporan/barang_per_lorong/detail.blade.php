@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Detail Barang {{ $kode_barang }} di {{ $lorong }}</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Rak</th>
        <th>Qty</th>
        <th>Update Terakhir</th>
      </tr>
    </thead>
    <tbody>
      @foreach($detail as $d)
      <tr>
        <td>{{ $d->rak }}</td>
        <td>{{ $d->qty }}</td>
        <td>{{ $d->updated_at }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

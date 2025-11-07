@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Laporan Barang per Lorong</h3>
  <form method="GET" action="{{ route('laporan.barang-per-lorong.show', '') }}">
    <div class="row">
      <div class="col-md-4">
        <select name="lorong" class="form-control" onchange="if(this.value) window.location.href=this.form.action+'/'+this.value;">
          <option value="">-- Pilih Lorong --</option>
          @foreach($lorongList as $lorong)
            <option value="{{ $lorong }}">{{ $lorong }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </form>
</div>
@endsection

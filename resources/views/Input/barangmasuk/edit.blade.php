@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    <i class="fas fa-edit me-1"></i> Edit Barang Masuk
                </div>

                <form id="submitFinalForm" action="{{ route('barangmasuk.update', $no_dokumen) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Alert sukses / error --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="no_dokumen_masuk" class="form-label">No Dokumen Masuk</label>
                                <input type="text" id="no_dokumen_masuk" name="no_dokumen_masuk"
                                       class="form-control" value="{{ $no_dokumen }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" id="tanggal_masuk" name="tanggal_masuk"
                                       class="form-control"
                                       value="{{ $tanggal_masuk ?? now()->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="table-responsive mb-3">
                            <table class="table table-bordered align-middle" id="barangTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 140px;">Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th style="width: 110px;">Jumlah</th>
                                        <th style="width: 120px;">Jumlah Rak</th>
                                        <th style="width: 110px;">Kapasitas</th>
                                        <th style="width: 160px;">Lorong</th>
                                        <th>Rak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangList as $i => $barang)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control kode_barang"
                                                       value="{{ $barang['kode_barang'] }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control nama_barang"
                                                       value="{{ $barang['nama_barang'] }}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kategori_barang"
                                                       value="{{ $barang['kategori_barang'] }}" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control jumlah_masuk"
                                                       value="{{ $barang['jumlah'] }}" min="0">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control jumlah_rak"
                                                       value="{{ ceil(($barang['jumlah'] ?? 0) / (($barang['kapasitas'] ?? 1) ?: 1)) }}"
                                                       readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control kapasitas"
                                                       value="{{ $barang['kapasitas'] }}" readonly>
                                            </td>
                                            <td>
                                                <select class="form-control nama_lorong">
                                                    <option value="">Pilih</option>
                                                    @foreach ($lorongList as $l)
                                                        <option value="{{ $l }}" {{ ($barang['nama_lorong'] ?? '') == $l ? 'selected' : '' }}>
                                                            {{ $l }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="nama_rak">
                                                @php
                                                    $dipilih = $barang['rak_terpilih'] ?? [];
                                                @endphp
                                                <div class="d-flex flex-wrap gap-3">
                                                    @foreach ($rakList as $rak)
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input me-1" value="{{ $rak }}"
                                                                {{ in_array($rak, $dipilih, true) ? 'checked' : '' }}>
                                                            {{ $rak }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <button type="button" id="tambahData" class="btn btn-secondary">
                                Tambah ke Preview
                            </button>
                            <small class="text-muted">Pastikan data di bawah sesuai sebelum disimpan.</small>
                        </div>

                        <h5 class="fw-semibold">Preview Data</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="dataTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th class="text-end">Jumlah</th>
                                        <th class="text-end">Kapasitas</th>
                                        <th>Lorong</th>
                                        <th>Rak</th>
                                        <th style="width: 90px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTableBody">
                                    {{-- Diisi oleh JS --}}
                                </tbody>
                            </table>
                        </div>

                        <input type="hidden" name="final_data" id="finalDataInput">

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Semua</button>
                        </div>

                    </div> {{-- card-body --}}
                </form>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    {{-- Script khusus edit --}}
    <script src="{{ asset('js/Input/editbarangmasuk.js') }}"></script>
@endpush

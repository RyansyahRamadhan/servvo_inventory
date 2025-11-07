@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    <i class="fas fa-table me-1"></i> TAMBAH FORMULA
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('formula.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Kode Formula</label>
                            <input type="text" name="kode_formula" id="kode_formula" placeholder="Masukkan Kode Formula" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Formula</label>
                            <input type="text" name="nama_formula" id="nama_formula" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Detail Formula</label>
                            <table class="table table-bordered" id="formulaTable">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="kode_barang[]" class="form-control kode-barang" placeholder="Masukkan Kode Barang" required></td>
                                        <td><input type="text" name="nama_barang[]" class="form-control nama-barang" placeholder="Nama Barang" readonly required></td>
                                        <td><input type="text" name="jumlah[]" class="form-control" placeholder="Masukkan Qty" required></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success btn-sm w-auto" onclick="addRow()">Tambah Baris</button>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm w-auto">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm w-auto">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('kode_formula').addEventListener('input', function() {
        const kodeFormula = this.value;
        if (kodeFormula) {
            fetch(`{{ route('get.nama_formula') }}?kode_formula=${kodeFormula}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('nama_formula').value = data.nama_formula || 'Data tidak ditemukan';
                })
                .catch(() => {
                    document.getElementById('nama_formula').value = 'Gagal ambil data';
                });
        } else {
            document.getElementById('nama_formula').value = '';
        }
    });

    // Autofill nama_barang dari kode_barang
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('kode-barang')) {
            const kodeInput = event.target;
            const namaInput = kodeInput.closest('tr').querySelector('.nama-barang');
            const kode = kodeInput.value;
            if (kode) {
                fetch(`{{ route('get.nama_barang') }}?kode_barang=${kode}`)
                    .then(res => res.json())
                    .then(data => {
                        namaInput.value = data.nama_barang || 'Data tidak ditemukan';
                    })
                    .catch(() => {
                        namaInput.value = 'Gagal ambil data';
                    });
            } else {
                namaInput.value = '';
            }
        }
    });

    function addRow() {
        const table = document.getElementById('formulaTable').querySelector('tbody');
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <td><input type="text" name="kode_barang[]" class="form-control kode-barang" required></td>
            <td><input type="text" name="nama_barang[]" class="form-control nama-barang" readonly required></td>
            <td><input type="text" name="jumlah[]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
        `;
    }

    function removeRow(button) {
        button.closest('tr').remove();
    }
</script>
@endpush

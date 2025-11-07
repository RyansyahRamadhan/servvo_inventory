@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header fw-bold">EDIT FORMULA</div>
        <div class="card-body">
            <form action="{{ route('formula.update', $formula->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Kode Formula</label>
                   <input type="text" name="kode_formula" class="form-control" value="{{ $formula->kode_formula }}" required>
                </div>
                <div class="mb-3">
                    <label>Nama Formula</label>
                   <input type="text" name="nama_formula" class="form-control" value="{{ $formula->nama_formula }}" readonly required>
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
                            @foreach ($formula->details as $detail)
                            <tr>
                                <td><input type="text" name="kode_barang[]" class="form-control kode-barang" value="{{ $detail->kode_barang }}" required></td>
                                <td><input type="text" name="nama_barang[]" class="form-control nama-barang" value="{{ $detail->nama_barang }}" readonly required></td>
                                <td><input type="text" name="jumlah[]" class="form-control" value="{{ $detail->jumlah }}" required></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" onclick="addRow()">Tambah Baris</button>
                </div>

                <button type="submit" class="btn btn-primary">UPDATE</button>
                <a href="{{ route('formula.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</main>
</div>
@endsection

@push('scripts')
<script>
function addRow() {
    const table = document.getElementById('formulaTable').querySelector('tbody');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td><input type="text" name="kode_barang[]" class="form-control kode-barang" required></td>
        <td><input type="text" name="nama_barang[]" class="form-control nama-barang" readonly required></td>
        <td><input type="text" name="jumlah[]" class="form-control" required></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
    `;
    table.appendChild(row);
}

function removeRow(btn) {
    btn.closest('tr').remove();
}
document.querySelector('input[name="kode_formula"]').addEventListener('input', function () {
    const kodeFormula = this.value;
    const namaFormulaInput = document.querySelector('input[name="nama_formula"]');

    if (kodeFormula) {
        fetch(`/ajax/get-nama-formula?kode_formula=${kodeFormula}`)
            .then(response => response.json())
            .then(data => {
                namaFormulaInput.value = data.nama_formula || '';
            })
            .catch(() => namaFormulaInput.value = '');
    } else {
        namaFormulaInput.value = '';
    }
});

document.addEventListener('input', function (event) {
    if (event.target.classList.contains('kode-barang')) {
        const kodeInput = event.target;
        const namaInput = kodeInput.closest('tr').querySelector('.nama-barang');
        const kode = kodeInput.value;
        if (kode) {
            fetch(`/ajax/get-nama-barang?kode_barang=${kode}`)
                .then(response => response.json())
                .then(data => {
                    namaInput.value = data.nama_barang || 'Data tidak ditemukan';
                })
                .catch(() => namaInput.value = 'Error');
        } else {
            namaInput.value = '';
        }
    }
});
</script>
@endpush

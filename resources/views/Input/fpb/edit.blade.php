@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h3>Edit FPB: {{ $fpb->no_fpb }}</h3>
    <form method="POST" action="{{ route('fpb.update', $fpb->no_fpb) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header">Informasi FPB</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>No FPB</label>
                    <input type="text" name="no_fpb" value="{{ $fpb->no_fpb }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Tanggal FPB</label>
                    <input type="date" name="tanggal_fpb" value="{{ $fpb->tanggal_fpb }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Kode Formula</label>
                    <input type="text" name="kode_formula" id="kode_formula" value="{{ $fpb->kode_formula }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Nama Formula</label>
                    <input type="text" name="nama_formula" id="nama_formula" value="{{ $fpb->nama_formula }}" class="form-control" required readonly>
                </div>
                <div class="col-md-4">
                    <label>Qty Formula</label>
                    <input type="number" name="qty_formula" id="qty_formula" value="{{ $fpb->qty_formula }}" class="form-control" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-primary" id="tambahBarang">+ Tambah</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Permintaan Barang</span>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered small text-center">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Rak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="daftarBarang">
                        @foreach ($fpb->details as $index => $item)
                            <tr>
                                <td><input type="text" name="detail_barang[{{ $index }}][kode_barang]" class="form-control" value="{{ $item->kode_barang }}" required></td>
                                <td><input type="text" name="detail_barang[{{ $index }}][nama_barang]" class="form-control" value="{{ $item->nama_barang }}" required></td>
                                <td><input type="number" name="detail_barang[{{ $index }}][qty]" class="form-control" value="{{ $item->qty }}" required></td>
                                <td><input type="text" name="detail_barang[{{ $index }}][rak]" class="form-control" value="{{ $item->rak }}"></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="hapusBaris(this)">Hapus</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <button type="button" class="btn btn-sm btn-secondary" onclick="tambahBaris()">+ Tambah Baris</button>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('fpb.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function hapusBaris(button) {
    const row = button.closest('tr');
    const nama_barang = row.querySelector('input[name*="[nama_barang]"]').value;
    const qty = row.querySelector('input[name*="[qty]"]').value;

    // rollback kapasitas
    fetch('/fpb/rollback-kapasitas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ nama_barang, qty })
    });

    row.remove();
}

function tambahBaris() {
    const index = document.querySelectorAll('#daftarBarang tr').length;
    const newRow = `
        <tr>
            <td><input type="text" name="detail_barang[${index}][kode_barang]" class="form-control" required></td>
            <td><input type="text" name="detail_barang[${index}][nama_barang]" class="form-control" required></td>
            <td><input type="number" name="detail_barang[${index}][qty]" class="form-control" required></td>
            <td><input type="text" name="detail_barang[${index}][rak]" class="form-control"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="hapusBaris(this)">Hapus</button></td>
        </tr>
    `;
    document.getElementById('daftarBarang').insertAdjacentHTML('beforeend', newRow);
}

// Auto-fill nama_formula saat edit kode_formula
$('#kode_formula').on('input', function () {
    let kode = $(this).val();
    if (kode.length > 2) {
        $.get(`/fpb/fetch-barang/${kode}`, function (data) {
            $('#nama_formula').val(data.nama_barang ?? '');
        });
    }
});

$('#tambahBarang').click(function () {
    const kode = $('#kode_formula').val();
    const nama = $('#nama_formula').val();
    const qty = parseInt($('#qty_formula').val());

    if (!kode || !nama || !qty || qty <= 0) {
        alert('Lengkapi data formula terlebih dahulu!');
        return;
    }

    const jumlahBaris = $('#daftarBarang tr').length;
    if (jumlahBaris > 0) {
        alert('Hapus semua item di tabel sebelum tambah data baru!');
        return;
    }

    $.get(`/fpb/fetch-detail/${kode}/${qty}`, function (items) {
        let promises = items.map(item => {
            return $.get(`/fpb/fetch-rak/${encodeURIComponent(item.nama_barang)}/${item.qty}`)
                .then(response => ({ ...item, rak: response.rak }));
        });

        Promise.all(promises).then(finalItems => {
            $('#daftarBarang').empty();
            finalItems.forEach((item, i) => {
                const row = `
                    <tr>
                        <td><input type="text" name="detail_barang[${i}][kode_barang]" class="form-control" value="${item.kode_barang}" required></td>
                        <td><input type="text" name="detail_barang[${i}][nama_barang]" class="form-control" value="${item.nama_barang}" required></td>
                        <td><input type="number" name="detail_barang[${i}][qty]" class="form-control" value="${item.qty}" required></td>
                        <td><input type="text" name="detail_barang[${i}][rak]" class="form-control" value="${item.rak}" readonly></td>
                        <td><button type="button" class="btn btn-sm btn-danger" onclick="hapusBaris(this)">Hapus</button></td>
                    </tr>`;
                $('#daftarBarang').append(row);
            });
        });
    });
});
</script>
@endpush

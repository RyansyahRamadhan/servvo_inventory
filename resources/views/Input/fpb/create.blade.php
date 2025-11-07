@extends('layouts.app')
@section('content')
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid py-3">
         <div class="card shadow-sm" style="max-width: 900px; margin: auto;">
    <div class="card-header fw-bold bg-light">
        Form Permintaan Barang (FPB)
           </div>
    <form id="fpbForm" method="POST" action="{{ route('fpb.store') }}">
        @csrf
        <input type="hidden" name="kode_formula" id="hidden_kode_formula">
        <input type="hidden" name="nama_formula" id="hidden_nama_formula">
        <input type="hidden" name="qty_formula" id="hidden_qty_formula">

        <div class="card mb-3">
            <div class="card-header">FPB</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label>No FPB</label>
                    <input type="text" name="no_fpb" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Tanggal FPB</label>
                    <input type="date" name="tanggal_fpb" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Kode Barang (Formula)</label>
                    <input type="text" id="kode_barang" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Nama Barang</label>
                    <input type="text" id="nama_barang" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label>Qty</label>
                    <input type="number" id="qty" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-primary" id="tambahBarang">+ Tambah</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Daftar Permintaan Barang</div>
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
                    <tbody id="daftarBarang"></tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="detail_barang" id="detail_barang">
        <div class="mt-3">
            <button type="submit" class="btn btn-success btn-sm w-auto">Kirim FPB</button>
            <a href="{{ route('fpb.index') }}" class="btn btn-secondary btn-sm w-auto">Batal</a>
        </div>
    </form>
</div>
</div>
</main>
</div>
@endsection

@push('scripts')
<script>
let daftarBarang = [];

$('#kode_barang').on('input', function () {
    const kode = $(this).val();
    if (kode.length > 2) {
        $.get(`/fpb/fetch-barang/${kode}`, function (data) {
            $('#nama_barang').val(data.nama_barang ?? '');
        });
    }
});

$('#tambahBarang').click(function () {
    const kode = $('#kode_barang').val();
    const nama = $('#nama_barang').val();
    const qty = parseInt($('#qty').val());

    if (!kode || !nama || !qty || qty <= 0) {
        alert('Lengkapi semua isian dengan benar!');
        return;
    }

    // Set hidden inputs
    $('#hidden_kode_formula').val(kode);
    $('#hidden_nama_formula').val(nama);
    $('#hidden_qty_formula').val(qty);

    $.get(`/fpb/fetch-detail/${kode}/${qty}`, function (items) {
        let promises = items.map(item => {
            return $.get(`/fpb/fetch-rak/${encodeURIComponent(item.nama_barang)}/${item.qty}`)
                .then(response => {
                    return { ...item, rak: response.rak };
                });
        });

        Promise.all(promises).then(finalItems => {
            finalItems.forEach(item => daftarBarang.push(item));
            renderTabel();
        });
    });
});

function hapusItem(index) {
    daftarBarang.splice(index, 1);
    renderTabel();
}

function renderTabel() {
    const tbody = $('#daftarBarang');
    tbody.html('');

    daftarBarang.forEach((item, index) => {
        const row = $(`
            <tr id="row-${index}">
                <td>${item.kode_barang}</td>
                <td>${item.nama_barang}</td>
                <td>${item.qty}</td>
                <td class="rak-cell">${item.rak}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusItem(${index})">Hapus</button>
                </td>
            </tr>
        `);
        tbody.append(row);
    });

    $('#detail_barang').val(JSON.stringify(daftarBarang));
}
</script>
@endpush

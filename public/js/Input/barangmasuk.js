$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Autofill data barang dari kode_barang (termasuk kapasitas)
    $(document).on('input', '.kode_barang', function () {
        const row = $(this).closest('tr');
        const kode = $(this).val();

        if (kode.length > 2) {
            $.get(`/barangmasuk/fetch-data/${kode}`, function (data) {
                if (data.nama_barang) {
                    row.find('.nama_barang').val(data.nama_barang);
                    row.find('.kategori_barang').val(data.kategori_barang);
                    row.find('.kapasitas').val(data.kapasitas || 1); // dari standar_rak_pallet
                    row.find('.jumlah_rak').val('');

                    // Cek kategori khusus
                    if (data.kategori_barang === 'CYLINDER' || data.kategori_barang === 'TROLLEY') {
                        row.find('.nama_lorong').val('').prop('disabled', false);
                    } else {
                        row.find('.nama_lorong').val(data.nama_lorong).prop('disabled', true);
                        setTimeout(() => {
                            row.find('.nama_lorong').trigger('change');
                        }, 200);
                    }
                } else {
                    row.find('input').val('');
                    row.find('.nama_lorong').val('').prop('disabled', false);
                    row.find('.nama_rak').html('');
                }
            });
        }
    });

    // Hitung jumlah_rak = jumlah ÷ kapasitas
    $(document).on('input', '.jumlah_masuk', function () {
        const row = $(this).closest('tr');
        const jumlah = parseFloat($(this).val());
        const kapasitas = parseFloat(row.find('.kapasitas').val());

        if (jumlah > 0 && kapasitas > 0) {
            const totalRak = Math.ceil(jumlah / kapasitas);
            row.find('.jumlah_rak').val(totalRak);
        }
    });

    // Load rak kosong dari nama_lorong
    $(document).on('change', '.nama_lorong', function () {
        const row = $(this).closest('tr');
        const lorong = $(this).val();

        if (lorong) {
            $.get(`/barangmasuk/get-rak/${lorong}`, function (data) {
                let rakHTML = '';
                data.forEach(rak => {
                    rakHTML += `<div><label><input type="checkbox" value="${rak.nama_rak}"> ${rak.nama_rak}</label></div>`;
                });
                row.find('.nama_rak').html(rakHTML);
            });
        } else {
            row.find('.nama_rak').html('');
        }
    });

    // Validasi jumlah rak yang dicentang
    $(document).on('change', '.nama_rak input[type="checkbox"]', function () {
        const row = $(this).closest('tr');
        const maxRak = parseInt(row.find('.jumlah_rak').val()) || 0;
        const checkedCount = row.find('.nama_rak input[type="checkbox"]:checked').length;

        if (checkedCount > maxRak) {
            alert('Jumlah rak yang dipilih melebihi jumlah rak yang dibutuhkan!');
            $(this).prop('checked', false);
        }
    });

    // Tombol Tambah Data → Masukkan ke Preview
    $('#tambahData').click(function () {
        const row = $('#barangTable tbody tr:last');
        const kode = row.find('.kode_barang').val();
        const nama = row.find('.nama_barang').val();
        const kategori = row.find('.kategori_barang').val();
        const jumlah = row.find('.jumlah_masuk').val();
        const kapasitas = row.find('.kapasitas').val();
        const lorong = row.find('.nama_lorong').val();
        const rakTerpilih = [];

        row.find('.nama_rak input[type="checkbox"]:checked').each(function () {
            rakTerpilih.push($(this).val());
        });

        if (!kode || !nama || !kategori || !jumlah || !kapasitas || !lorong || rakTerpilih.length === 0) {
            alert('Lengkapi semua data sebelum menambahkan!');
            return;
        }

        const previewRow = `
            <tr>
                <td>${kode}</td>
                <td>${nama}</td>
                <td>${kategori}</td>
                <td>${jumlah}</td>
                <td>${kapasitas}</td>
                <td>${lorong}</td>
                <td>${rakTerpilih.join(', ')}</td>
                <td><button type="button" class="btn btn-sm btn-danger hapusPreview">Hapus</button></td>
            </tr>
        `;
        $('#dataTableBody').append(previewRow);

        // Reset form input setelah tambah
        row.find('input, select').val('');
        row.find('.nama_rak').html('');
        row.find('.nama_lorong').prop('disabled', false);
    });

    // Hapus dari preview table
    $(document).on('click', '.hapusPreview', function () {
        $(this).closest('tr').remove();
    });

    // Hapus baris input
    $(document).on('click', '.hapusRow', function () {
        if ($('#barangTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });

    // Submit semua data ke input hidden `finalDataInput`
    $('#submitFinalForm').on('submit', function () {
        const dataPreview = [];

        $('#dataTableBody tr').each(function () {
            const row = $(this).children('td');
            dataPreview.push({
                no_dokumen_masuk: $('#no_dokumen_masuk').val(),
                tanggal_masuk: $('#tanggal_masuk').val(),
                kode_barang: row.eq(0).text(),
                nama_barang: row.eq(1).text(),
                kategori_barang: row.eq(2).text(),
                jumlah: row.eq(3).text(),
                kapasitas: row.eq(4).text(),
                nama_lorong: row.eq(5).text(),
                nama_rak: row.eq(6).text().split(',').map(r => r.trim())
            });
        });

        $('#finalDataInput').val(JSON.stringify(dataPreview));
    });
});

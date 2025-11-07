$(document).ready(function () {
    // Setup CSRF untuk AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Hitung jumlah rak untuk setiap baris saat load
    const hitungJumlahRak = (row) => {
        const jumlah = parseFloat(row.find('.jumlah_masuk').val()) || 0;
        const kapasitas = parseFloat(row.find('.kapasitas').val()) || 1;

        if (jumlah > 0 && kapasitas > 0) {
            const totalRak = Math.ceil(jumlah / kapasitas);
            row.find('.jumlah_rak').val(totalRak);
        }
    };

    const hitungJumlahRakSaatLoad = () => {
        $('#barangTable tbody tr').each(function () {
            hitungJumlahRak($(this));
        });
    };

    hitungJumlahRakSaatLoad();

    // Autofill data barang berdasarkan kode
    $(document).on('input', '.kode_barang', function () {
        const row = $(this).closest('tr');
        const kode = $(this).val();

        if (kode.length >= 3) {
            $.get(`/barangmasuk/fetch-data/${kode}`, function (data) {
                if (data.nama_barang) {
                    row.find('.nama_barang').val(data.nama_barang);
                    row.find('.kategori_barang').val(data.kategori_barang);
                    row.find('.kapasitas').val(data.kapasitas || 1);
                    row.find('.jumlah_rak').val('');

                    if (['CYLINDER', 'TROLLEY'].includes(data.kategori_barang)) {
                        row.find('.nama_lorong').val('').prop('disabled', false);
                    } else {
                        row.find('.nama_lorong').val(data.nama_lorong).prop('disabled', true);
                        row.find('.nama_lorong').trigger('change');
                    }
                } else {
                    row.find('.nama_barang, .kategori_barang, .kapasitas, .jumlah_rak').val('');
                    row.find('.nama_lorong').val('').prop('disabled', false);
                    row.find('.nama_rak').html('');
                }
            });
        }
    });

    // Hitung ulang jumlah rak saat input jumlah diubah
    $(document).on('input', '.jumlah_masuk', function () {
        const row = $(this).closest('tr');
        hitungJumlahRak(row);
    });

    // Load rak berdasarkan lorong
    $(document).on('change', '.nama_lorong', function () {
        const row = $(this).closest('tr');
        const lorong = $(this).val();

        if (lorong) {
            $.get(`/barangmasuk/get-rak/${lorong}`, function (data) {
                let rakHTML = '';
                data.forEach(rak => {
                    rakHTML += `
                        <div>
                            <label>
                                <input type="checkbox" value="${rak.nama_rak}"> ${rak.nama_rak}
                            </label>
                        </div>`;
                });
                row.find('.nama_rak').html(rakHTML);
            });
        } else {
            row.find('.nama_rak').html('');
        }
    });

    // Validasi jumlah rak tercentang
    $(document).on('change', '.nama_rak input[type="checkbox"]', function () {
        const row = $(this).closest('tr');
        const maxRak = parseInt(row.find('.jumlah_rak').val()) || 0;
        const checkedCount = row.find('.nama_rak input[type="checkbox"]:checked').length;

        if (checkedCount > maxRak) {
            alert('Jumlah rak melebihi kebutuhan!');
            $(this).prop('checked', false);
        }
    });

    // Tombol Tambah ke Preview
    $('#tambahData').click(function () {
        $('#barangTable tbody tr').each(function () {
            const row = $(this);

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
                return; // Lewati baris tidak lengkap
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
                </tr>`;
            $('#dataTableBody').append(previewRow);
        });
    });

    // Tombol Hapus dari Preview
    $(document).on('click', '.hapusPreview', function () {
        $(this).closest('tr').remove();
    });

    // Submit form, simpan semua data preview ke input hidden
    $('#submitFinalForm').on('submit', function () {
        const dataPreview = [];
        const noDok = $('#no_dokumen_masuk').val();
        const tanggal = $('#tanggal_masuk').val();

        $('#dataTableBody tr').each(function () {
            const row = $(this).children('td');
            dataPreview.push({
                no_dokumen_masuk: noDok,
                tanggal_masuk: tanggal,
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

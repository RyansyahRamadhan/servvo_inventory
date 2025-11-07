$(document).ready(function () {
    $('#kode_formula').on('change', function () {
        const kode = $(this).val();
        if (kode === '') return;

        $.ajax({
            url: `/get-formula/${kode}`,
            method: 'GET',
            success: function (res) {
                if (res.formula) {
                    $('#nama_formula').val(res.formula.nama_formula);
                }

                if (res.details.length > 0) {
                    let rows = '';
                    res.details.forEach((item, index) => {
                        rows += `
                            <tr data-qty-asli="${item.qty}">
                                <td><input type="text" name="detail[${index}][kode_barang]" class="form-control" value="${item.kode_barang}" readonly></td>
                                <td><input type="text" name="detail[${index}][nama_barang]" class="form-control" value="${item.nama_barang}" readonly></td>
                                <td><input type="number" name="detail[${index}][qty]" class="form-control qty-detail" value="${item.qty}" readonly></td>
                            </tr>`;
                    });
                    $('#detailTableBody').html(rows);
                }
            }
        });
    });

    $('#qty_formula').on('input', function () {
        const qtyFormula = parseInt($(this).val()) || 0;

        $('#detailTableBody tr').each(function () {
            const qtyAsli = parseFloat($(this).data('qty-asli'));
            const total = qtyFormula * qtyAsli;
            $(this).find('input.qty-detail').val(total);
        });
    });

    
    function renderTabel() {
    const tbody = $('#daftarBarang');
    tbody.html('');

    daftarBarang.forEach((item, index) => {
        const row = $(`
            <tr id="row-${index}">
                <td>${item.kode_barang}</td>
                <td>${item.nama_barang}</td>
                <td>${item.qty}</td>
                <td class="rak-cell" data-index="${index}">Loading...</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusItem(${index})">Hapus</button>
                </td>
            </tr>
        `);

        tbody.append(row);

        // Ambil rekomendasi rak berdasarkan kode_barang & qty
        $.get(`/fpb/rekomendasi-rak/${item.kode_barang}/${item.qty}`, function(res) {
            $(`#row-${index} .rak-cell`).text(res.rak);
            // Tambahkan ke data
            daftarBarang[index].rak = res.rak;
            $('#detail_barang').val(JSON.stringify(daftarBarang));
        });
    });

    $('#detail_barang').val(JSON.stringify(daftarBarang));
}

});

<?php include_once(__DIR__ . "/../config/config.php"); 

if (isset($_GET['formula_id'])) {
    $formula_id = $_GET['formula_id'];

    // Query to fetch formula data
    $query = "SELECT * FROM formula WHERE kode_formula = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $formula_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $formula = $result->fetch_assoc();
        $kode_formula = $formula['kode_formula'];
        $nama_formula = $formula['nama_formula'];

        // Get the formula details with FIFO Nama Rak logic (only the first rack based on tanggal_masuk)
        $detail_query = "
            SELECT fd.kode_barang, fd.nama_barang, fd.jumlah, 
                   (SELECT sm.nama_rak 
                    FROM barang_masuk sm 
                    WHERE sm.kode_barang = fd.kode_barang 
                    ORDER BY sm.tanggal_masuk ASC LIMIT 1) AS nama_rak
            FROM formula_detail fd
            WHERE fd.kode_formula = ?";

        $stmt_detail = $conn->prepare($detail_query);
        $stmt_detail->bind_param("s", $kode_formula);
        $stmt_detail->execute();
        $detail_result = $stmt_detail->get_result();

        $details_html = '';
        while ($detail = $detail_result->fetch_assoc()) {
            $details_html .= "<tr data-base-jumlah='{$detail['jumlah']}'>
                <td>" . htmlspecialchars($detail['kode_barang']) . "</td>
                <td>" . htmlspecialchars($detail['nama_barang']) . "</td>
                <td class='jumlah-cell'>" . htmlspecialchars($detail['jumlah']) . "</td>
                <td class='rak-cell'>" . htmlspecialchars($detail['nama_rak']) . "</td>
            </tr>";
        }

        echo json_encode([
            'nama_formula' => $nama_formula,
            'details' => $details_html
        ]);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>

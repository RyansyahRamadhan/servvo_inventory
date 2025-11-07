<?php 
include_once(__DIR__ . "/../config/config.php"); 

$nama_lorong = $_GET['nama_lorong'] ?? '';

if ($nama_lorong) {
    $query = "  
        SELECT r.nama_rak, r.kapasitas_total, r.kapasitas_tersedia
        FROM rak r
        WHERE r.nama_lorong = ? AND r.kapasitas_tersedia > 0
        ORDER BY r.nama_rak ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama_lorong);
    $stmt->execute();
    $result = $stmt->get_result();

    $rak_data = [];

    while ($row = $result->fetch_assoc()) {
        $nama_rak = $row['nama_rak'];

        // Cek apakah rak sudah digunakan oleh dokumen manapun
        $cek = $conn->prepare("SELECT COUNT(*) as total FROM barang_masuk WHERE FIND_IN_SET(?, nama_rak) > 0");
        $cek->bind_param("s", $nama_rak);
        $cek->execute();
        $res = $cek->get_result();
        $row_cek = $res->fetch_assoc();

        $sudah_dipakai = $row_cek['total'] > 0;
        $is_subrak = count(explode('-', $nama_rak)) === 5;

        // Tampilkan hanya jika belum dipakai atau jika rak adalah sub-rak
        if (!$sudah_dipakai || $is_subrak) {
            $rak_data[] = [
                'nama_rak' => $nama_rak,
                'kapasitas_total' => $row['kapasitas_total'],
                'kapasitas_tersedia' => $row['kapasitas_tersedia']
            ];
        }
    }

    echo json_encode($rak_data);
} else {
    echo json_encode([]);
}
?>

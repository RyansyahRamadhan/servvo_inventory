<?php
include_once(__DIR__ . "/../config/config.php");

$no_dokumen = $_GET['no_dokumen'] ?? '';
$kode_barang = $_GET['kode_barang'] ?? '';
$nama_lorong = $_GET['nama_lorong'] ?? '';

if (!$no_dokumen || !$kode_barang || !$nama_lorong) {
    echo json_encode([]);
    exit;
}

// Ambil semua rak dari lorong yang tersedia
$query = "
    SELECT r.nama_rak, r.kapasitas_total, r.kapasitas_tersedia
    FROM rak r
    WHERE r.kapasitas_tersedia > 0 AND r.nama_lorong = ?
    ORDER BY r.nama_rak ASC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nama_lorong);
$stmt->execute();
$result = $stmt->get_result();

$data_rak = [];

while ($row = $result->fetch_assoc()) {
    $nama_rak = $row['nama_rak'];

    // Cek apakah rak ini digunakan oleh dokumen dan barang tertentu
    $cek = $conn->prepare("SELECT COUNT(*) as total FROM barang_masuk 
        WHERE no_dokumen_masuk = ? 
        AND kode_barang = ? 
        AND FIND_IN_SET(?, nama_rak)");
    $cek->bind_param("sss", $no_dokumen, $kode_barang, $nama_rak);
    $cek->execute();
    $res = $cek->get_result();
    $row_cek = $res->fetch_assoc();

    $terpilih = $row_cek['total'] > 0;

    $data_rak[] = [
        'nama_rak' => $nama_rak,
        'kapasitas_total' => $row['kapasitas_total'],
        'kapasitas_tersedia' => $row['kapasitas_tersedia'],
        'terpilih' => $terpilih
    ];
}

echo json_encode($data_rak);
?>

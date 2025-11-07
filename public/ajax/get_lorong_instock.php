<?php
include_once(__DIR__ . "/../../config/config.php");
header('Content-Type: application/json');

// Validasi parameter
if (!isset($_GET['kode_barang']) || empty($_GET['kode_barang'])) {
    echo json_encode([]);
    exit;
}

$kode_barang = $_GET['kode_barang'];

// Ambil lorong dari tabel standar_rak_pallet berdasarkan kode barang
$stmt = $conn->prepare("SELECT DISTINCT nama_lorong FROM standar_rak_pallet WHERE kode_barang = ? ORDER BY nama_lorong ASC");
$stmt->bind_param("s", $kode_barang);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'nama_lorong' => $row['nama_lorong']
    ];
}

echo json_encode($data);
?>

<?php include_once(__DIR__ . "/../config/config.php"); 
header('Content-Type: application/json');

if (isset($_GET['kode_barang']) && isset($_GET['jumlah'])) {
    $kode_barang = $_GET['kode_barang'];
    $jumlah = intval($_GET['jumlah']);

    $query = "SELECT nama_lorong, nama_rak FROM lokasi_rak WHERE kode_barang = ? AND kapasitas_tersedia >= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $kode_barang, $jumlah);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (!empty($data)) {
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Rak yang sesuai tidak ditemukan"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Parameter tidak lengkap"]);
}

$conn->close();

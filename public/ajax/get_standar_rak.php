<?php include_once(__DIR__ . "/../config/config.php"); 

header('Content-Type: application/json');

if (isset($_GET['kode_barang']) && isset($_GET['size'])) {
    $kode_barang = $_GET['kode_barang'];
    $size = $_GET['size'];

    $query = "SELECT isi_per_dus, isi_per_pallet FROM standar_rak_pallet WHERE kode_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kode_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Data standar rak tidak ditemukan"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Parameter tidak lengkap"]);
}

$conn->close();

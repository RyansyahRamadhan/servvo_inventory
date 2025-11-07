<?php 

header('Content-Type: application/json');

if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];

    // Query untuk mendapatkan nama dan kategori barang
    $query = "SELECT nama_barang, kategori_barang FROM standar_rak_pallet WHERE kode_barang = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $kode_barang);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            echo json_encode(["nama_barang" => "Tidak ditemukan", "kategori_barang" => "Tidak ditemukan"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Query preparation failed"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>

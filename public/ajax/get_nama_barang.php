<?php include_once(__DIR__ . "/../config/config.php"); 

if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];

    // Query untuk mendapatkan nama barang berdasarkan kode_barang
    $query = "SELECT nama_barang FROM barang WHERE kode_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kode_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['nama_barang' => $row['nama_barang']]);
    } else {
        echo json_encode(['nama_barang' => '']);
    }
} else {
    echo json_encode(['nama_barang' => '']);
}
?>

<?php include_once(__DIR__ . "/../config/config.php"); 

// Pastikan kode_formula dikirim melalui request
if (isset($_GET['kode_formula'])) {
    $kode_formula = $_GET['kode_formula'];

    // Query untuk mendapatkan nama barang berdasarkan kode_formula
    $query = "SELECT nama_barang FROM barang WHERE kode_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kode_formula);
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

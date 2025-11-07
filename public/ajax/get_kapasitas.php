<?php include_once(__DIR__ . "/../config/config.php"); 

if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];

    // Fetch kapasitas for the given kode_barang
    $query = "SELECT kapasitas FROM standar_rak_pallet WHERE kode_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kode_barang);
    $stmt->execute();
    $stmt->bind_result($kapasitas);
    $stmt->fetch();
    $stmt->close();

    // Check if kapasitas is found
    if ($kapasitas !== null) {
        // Return the kapasitas as a JSON response
        echo json_encode(["kapasitas" => $kapasitas]);
    } else {
        // Return error if kapasitas is not found
        echo json_encode(["error" => "Kapasitas not found for the given kode_barang"]);
    }
} else {
    // Return error if kode_barang is not provided
    echo json_encode(["error" => "Kode Barang is missing"]);
}
?>

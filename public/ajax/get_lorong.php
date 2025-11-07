<?php include_once(__DIR__ . "/../config/config.php"); 

if (isset($_GET['nama_gudang'])) {
    $nama_gudang = $_GET['nama_gudang'];

    // Query untuk mengambil lorong berdasarkan nama_gudang
    $query = "SELECT nama_lorong FROM lorong WHERE nama_gudang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama_gudang);
    $stmt->execute();
    $result = $stmt->get_result();

    $lorong_data = [];
    while ($row = $result->fetch_assoc()) {
        $lorong_data[] = $row;
    }

    // Kembalikan data dalam format JSON
    echo json_encode($lorong_data);
}
?>


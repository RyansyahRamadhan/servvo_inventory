<?php include_once(__DIR__ . "/../config/config.php"); 

// Periksa apakah parameter nama_lorong tersedia
if (!isset($_GET['nama_lorong']) || empty($_GET['nama_lorong'])) {
    echo json_encode([]);
    exit;
}

$nama_lorong = $_GET['nama_lorong'];

// Query untuk mendapatkan rak berdasarkan lorong
$query = "SELECT DISTINCT nama_rak FROM rak WHERE nama_lorong = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nama_lorong);
$stmt->execute();
$result = $stmt->get_result();

$rak = [];
while ($row = $result->fetch_assoc()) {
    $rak[] = $row;
}

// Kembalikan data dalam format JSON
echo json_encode($rak);
?>

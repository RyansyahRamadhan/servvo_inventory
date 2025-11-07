<?php
include_once("../config/config.php");

// Set header untuk JSON
header('Content-Type: application/json');

// Ambil parameter 'lorong'
$lorong = $_GET['lorong'] ?? '';

if (empty($lorong)) {
    echo json_encode([]);
    exit;
}

// Ambil daftar rak dari tabel master rak (misalnya: 'rak')
$query = "SELECT nama_rak FROM rak WHERE nama_lorong = ? ORDER BY nama_rak ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $lorong);
$stmt->execute();
$result = $stmt->get_result();

$rakList = [];
while ($row = $result->fetch_assoc()) {
    $rakList[] = [
        'nama_rak' => $row['nama_rak']
    ];
}

// Kembalikan JSON
echo json_encode($rakList);

<?php
include_once("../config/config.php");

$query = "SELECT DISTINCT nama_lorong FROM standar_rak_pallet ORDER BY nama_lorong ASC";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = ['nama_lorong' => $row['nama_lorong']];
}

header('Content-Type: application/json');
echo json_encode($data);
?>

<?php
require_once(__DIR__ . "/../config/config.php");

$no_dokumen_masuk = $_GET['no_dokumen_masuk'] ?? '';

if (!$no_dokumen_masuk) {
  echo json_encode([]);
  exit;
}

// Ambil DISTINCT nama rak dari barang_masuk berdasarkan no_dokumen_masuk
$stmt = $conn->prepare("
  SELECT DISTINCT nama_rak
  FROM barang_masuk
  WHERE no_dokumen_masuk = ?
  AND nama_rak != ''
  ORDER BY nama_rak ASC
");
$stmt->bind_param("s", $no_dokumen_masuk);
$stmt->execute();
$result = $stmt->get_result();

$rakList = [];
while ($row = $result->fetch_assoc()) {
  $rakList[] = $row['nama_rak'];
}

header("Content-Type: application/json");
echo json_encode($rakList, JSON_UNESCAPED_UNICODE);

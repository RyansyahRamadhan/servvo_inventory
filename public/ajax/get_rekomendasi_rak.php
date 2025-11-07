<?php
include_once(__DIR__ . "/../../config/config.php");

// Ambil parameter dari GET
$nama_lorong = $_GET['nama_lorong'] ?? '';
$jumlah_rak = isset($_GET['jumlah_rak']) ? (int) $_GET['jumlah_rak'] : 1;
$kode_barang = $_GET['kode_barang'] ?? '';

if (!$nama_lorong) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter nama_lorong diperlukan']);
    exit;
}

// Ambil kategori barang dari kode_barang
$kategori = '';
if ($kode_barang) {
    $stmtKategori = $conn->prepare("SELECT kategori FROM barang WHERE kode_barang = ?");
    $stmtKategori->bind_param("s", $kode_barang);
    $stmtKategori->execute();
    $resultKategori = $stmtKategori->get_result();
    if ($rowKategori = $resultKategori->fetch_assoc()) {
        $kategori = $rowKategori['kategori'];
    }
    $stmtKategori->close();
}

// Fungsi cek apakah rak adalah sub-rak
function isSubrak($nama_rak) {
    return count(explode('-', $nama_rak)) === 5;
}

// Ambil semua rak sesuai lorong dan kapasitas
$stmt = $conn->prepare("SELECT * FROM rak WHERE nama_lorong = ? AND kapasitas_tersedia > 0 ORDER BY nama_rak ASC");
$stmt->bind_param("s", $nama_lorong);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $nama_rak = $row['nama_rak'];

    // Jika kategori Cylinder → boleh semuanya
    if (strtolower($kategori) === 'cylinder') {
        $data[] = $row;
        continue;
    }

    // Jika sub-rak (5 segmen) → boleh dipakai lebih dari satu kali
    if (isSubrak($nama_rak)) {
        $data[] = $row;
        continue;
    }

    // Rak biasa (4 segmen) → hanya jika belum pernah dipakai
    $check = $conn->prepare("SELECT 1 FROM barang_masuk WHERE nama_rak = ? LIMIT 1");
    $check->bind_param("s", $nama_rak);
    $check->execute();
    $used = $check->get_result()->num_rows > 0;
    $check->close();

    if (!$used) {
        $data[] = $row;
    }
}

// Ambil sesuai jumlah rak yang dibutuhkan
$data = array_slice($data, 0, $jumlah_rak);

// Keluarkan dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

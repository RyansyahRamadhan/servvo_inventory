<?php include_once(__DIR__ . "/../config/config.php"); 

header('Content-Type: application/json');

if (isset($_GET['kode_barang']) && isset($_GET['size']) && isset($_GET['jumlah'])) {
    $kode_barang = $_GET['kode_barang'];
    $size = $_GET['size'];
    $jumlah = intval($_GET['jumlah']);

    // Tentukan kapasitas maksimum berdasarkan ukuran
    $kapasitas_maks = ($size === 'Dus') ? 26 : (($size === 'Pallet') ? 30 : 0);

    // Query untuk mendapatkan lorong dan rak yang memenuhi kapasitas
    $query = "
        SELECT nama_lorong, nama_rak 
        FROM standar_rak_pallet 
        WHERE kode_barang = ? AND size = ? AND status_terisi = 0 AND kapasitas_rak >= ?
        ORDER BY kapasitas_rak ASC";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssi", $kode_barang, $size, $jumlah);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Query preparation failed"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>

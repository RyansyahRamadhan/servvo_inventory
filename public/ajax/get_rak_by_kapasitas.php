<?php include_once(__DIR__ . "/../config/config.php"); 

if (isset($_GET['kode_barang']) && isset($_GET['jumlah_masuk'])) {
    $kode_barang = $_GET['kode_barang'];
    $jumlah_masuk = $_GET['jumlah_masuk'];

    // Query untuk mengambil kapasitas rak berdasarkan kode barang
    $query = "SELECT * FROM standar_rak_pallet WHERE kode_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kode_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $kapasitas = $row['kapasitas'];  // Kapasitas maksimal untuk rak berdasarkan standar pallet

        // Tentukan rak yang sesuai berdasarkan jumlah masuk
        $rak_terpilih = [];
        if ($jumlah_masuk <= $kapasitas) {
            // Misalnya, jika jumlah barang <= kapasitas, pilih rak pertama
            $rak_terpilih = ['rak_1'];
        }

        // Kirim data rak yang sesuai ke frontend
        echo json_encode($rak_terpilih);
    } else {
        echo json_encode([]);
    }
}
?>

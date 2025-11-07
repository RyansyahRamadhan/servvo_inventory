<?php include_once(__DIR__ . "/../config/config.php"); 

if (isset($_GET['formula_id'])) {
    $formula_id = $_GET['formula_id'];

    // Query untuk mendapatkan detail formula
    $query = "
        SELECT 
            df.kode_barang, 
            b.nama_barang, 
            df.jumlah
        FROM formula_detail df
        JOIN barang b ON df.kode_barang = b.kode_barang
        WHERE df.kode_formula = ?
    ";
    $stmt = $conn->prepare($query);

    // Debug jika prepare() gagal
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param('s', $formula_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['kode_barang']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
        echo "</tr>";
    }
}
?>

<?php
require_once 'config/database.php';

echo "<h2>Test Koneksi Database</h2>";

// Cek koneksi
if($conn) {
    echo "<p style='color:green;'>✅ Koneksi database BERHASIL</p>";
} else {
    echo "<p style='color:red;'>❌ Koneksi database GAGAL</p>";
}

// Cek tabel barang
$query = "SELECT COUNT(*) as total FROM barang";
$result = mysqli_query($conn, $query);

if($result) {
    $row = mysqli_fetch_assoc($result);
    echo "<p>✅ Tabel barang ditemukan, jumlah data: " . $row['total'] . " barang</p>";
} else {
    echo "<p>❌ Error: " . mysqli_error($conn) . "</p>";
}

// Tampilkan semua barang
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    echo "<h3>Daftar Barang:</h3>";
    echo "<ul>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row['nama_barang'] . " - Rp " . number_format($row['harga_sewa'],0,',','.') . "/hari</li>";
    }
    echo "</ul>";
} else {
    echo "<p>❌ Tidak ada data barang</p>";
}
?>

<?php
// file: fix_admin.php
require_once 'config/database.php';

// Hash yang benar untuk password 'admin'
$hash_baru = password_hash('admin', PASSWORD_DEFAULT);

// Hapus user admin yang lama (jika ada) dan buat yang baru
mysqli_query($conn, "DELETE FROM users WHERE username = 'admin'");

$query = "INSERT INTO users (username, password, nama_lengkap, email, no_hp, alamat, level) 
          VALUES ('admin', '$hash_baru', 'Administrator', 'admin@sewasound.com', '081234567890', '', 'admin')";

if(mysqli_query($conn, $query)) {
    echo "<h2 style='color: green;'>✅ Sukses! Akun ADMIN telah dibuat ulang.</h2>";
    echo "<p>Username: <strong>admin</strong><br>Password: <strong>admin</strong></p>";
    echo "<a href='login.php'>Klik di sini untuk mencoba login</a>";
} else {
    echo "<h2 style='color: red;'>❌ Gagal: " . mysqli_error($conn) . "</h2>";
}
?>


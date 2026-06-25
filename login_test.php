<?php
require_once 'database.php';

echo "<h2>Test Login</h2>";

$username = 'admin';
$password = 'admin';

$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if($row = mysqli_fetch_assoc($result)) {
    echo "User ditemukan: " . $row['username'] . "<br>";
    echo "Level: " . $row['level'] . "<br>";
    echo "Password hash di DB: " . $row['password'] . "<br><br>";
    
    if(password_verify($password, $row['password'])) {
        echo "<span style='color:green;font-size:20px;'>✅ LOGIN AKAN BERHASIL! Password cocok.</span>";
    } else {
        echo "<span style='color:red;font-size:20px;'>❌ Password TIDAK cocok!</span>";
        echo "<br>Hash baru untuk password 'admin': " . password_hash('admin', PASSWORD_DEFAULT);
    }
} else {
    echo "<span style='color:red;'>❌ User 'admin' TIDAK ditemukan!</span>";
}
?>
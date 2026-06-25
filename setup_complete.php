<?php
require_once 'config/database.php';

echo "<h1>Setup Ulang Aplikasi Sewa Sound System</h1>";

// 1. Reset tabel users
echo "<h3>1. Reset Tabel Users...</h3>";
mysqli_query($conn, "TRUNCATE TABLE users");

// 2. Buat ulang tabel users dengan struktur yang benar
mysqli_query($conn, "ALTER TABLE users MODIFY level ENUM('admin','customer') DEFAULT 'customer'");

// 3. Hash password yang benar
$hash_admin = password_hash('admin', PASSWORD_DEFAULT);
$hash_customer = password_hash('customer', PASSWORD_DEFAULT);

echo "Hash untuk admin: " . $hash_admin . "<br>";
echo "Hash untuk customer: " . $hash_customer . "<br>";

// 4. Insert user admin
$insert_admin = mysqli_query($conn, "INSERT INTO users (username, password, nama_lengkap, email, no_hp, alamat, level) 
                                     VALUES ('admin', '$hash_admin', 'Administrator', 'admin@sewasound.com', '081234567890', 'Jl. Admin No. 1', 'admin')");

// 5. Insert user customer
$insert_customer = mysqli_query($conn, "INSERT INTO users (username, password, nama_lengkap, email, no_hp, alamat, level) 
                                        VALUES ('customer', '$hash_customer', 'Customer User', 'customer@email.com', '087654321098', 'Jl. Customer No. 1', 'customer')");

if($insert_admin && $insert_customer) {
    echo "<p style='color:green;'>✅ User berhasil ditambahkan!</p>";
} else {
    echo "<p style='color:red;'>❌ Gagal: " . mysqli_error($conn) . "</p>";
}

// 6. Cek data users
$result = mysqli_query($conn, "SELECT id_user, username, level FROM users");
echo "<h3>2. Data Users Saat Ini:</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Username</th><th>Level</th></tr>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id_user'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['level'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// 7. Test verifikasi password
echo "<h3>3. Test Verifikasi Password:</h3>";

$test_admin = mysqli_query($conn, "SELECT * FROM users WHERE username='admin'");
if($row = mysqli_fetch_assoc($test_admin)) {
    if(password_verify('admin', $row['password'])) {
        echo "<p style='color:green;'>✅ Password 'admin' untuk user 'admin' VALID!</p>";
    } else {
        echo "<p style='color:red;'>❌ Password 'admin' untuk user 'admin' TIDAK VALID!</p>";
    }
}

$test_customer = mysqli_query($conn, "SELECT * FROM users WHERE username='customer'");
if($row = mysqli_fetch_assoc($test_customer)) {
    if(password_verify('customer', $row['password'])) {
        echo "<p style='color:green;'>✅ Password 'customer' untuk user 'customer' VALID!</p>";
    } else {
        echo "<p style='color:red;'>❌ Password 'customer' untuk user 'customer' TIDAK VALID!</p>";
    }
}

echo "<hr>";
echo "<h3>4. Silakan coba login:</h3>";
echo "<ul>";
echo "<li><strong>Admin:</strong> <a href='login.php'>Login</a> dengan username: <code>admin</code> dan password: <code>admin</code></li>";
echo "<li><strong>Customer:</strong> <a href='login.php'>Login</a> dengan username: <code>customer</code> dan password: <code>customer</code></li>";
echo "</ul>";
echo "<p><a href='login.php' class='btn' style='background:#1DB954;color:#000;padding:10px 20px;text-decoration:none;border-radius:5px;'>→ Lanjut ke Halaman Login</a></p>";
?>


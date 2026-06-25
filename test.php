<?php
echo "<h1>TEST APLIKASI SEWA SOUND</h1>";

// 1. TEST KONEKSI DATABASE
echo "<h3>1. Test Koneksi Database</h3>";
$conn = mysqli_connect('localhost', 'root', '', 'sewasound_db');

if (!$conn) {
    echo "❌ Koneksi GAGAL: " . mysqli_connect_error() . "<br>";
    echo "Solusi: Buat database 'sewasound_db' di phpMyAdmin<br>";
} else {
    echo "✅ Koneksi BERHASIL<br>";
    
    // 2. TEST TABEL USERS
    echo "<h3>2. Test Tabel Users</h3>";
    $result = mysqli_query($conn, "SELECT * FROM users");
    
    if (!$result) {
        echo "❌ Tabel users TIDAK ADA<br>";
        echo "Solusi: Jalankan SQL CREATE TABLE users<br>";
    } else {
        $jumlah = mysqli_num_rows($result);
        echo "✅ Tabel users ADA, jumlah data: $jumlah<br>";
        
        if($jumlah == 0) {
            echo "❌ Tabel users KOSONG!<br>";
            echo "Solusi: Masukkan data admin dengan SQL INSERT<br>";
        } else {
            // 3. TEST DATA ADMIN
            echo "<h3>3. Test Data Admin</h3>";
            $admin = mysqli_query($conn, "SELECT * FROM users WHERE username='admin'");
            if(mysqli_num_rows($admin) == 0) {
                echo "❌ User 'admin' TIDAK ADA di database<br>";
                echo "Solusi: INSERT INTO users VALUES ('admin', 'admin', 'Administrator', 'admin')<br>";
            } else {
                $row = mysqli_fetch_assoc($admin);
                echo "✅ User 'admin' DITEMUKAN<br>";
                echo "- Username: " . $row['username'] . "<br>";
                echo "- Password di DB: " . $row['password'] . "<br>";
                echo "- Level: " . $row['level'] . "<br>";
                
                if($row['password'] != 'admin') {
                    echo "❌ Password TIDAK COCOK! Harus 'admin'<br>";
                    echo "Solusi: UPDATE users SET password='admin' WHERE username='admin'<br>";
                } else {
                    echo "✅ Password COCOK! Login akan berhasil.<br>";
                }
            }
        }
    }
    
    // 4. TEST FILE LOGIN
    echo "<h3>4. Test File Login</h3>";
    $login_file = __DIR__ . '/login.php';
    if(file_exists($login_file)) {
        echo "✅ File login.php ADA<br>";
        echo "<a href='login.php'>Klik disini untuk login</a><br>";
    } else {
        echo "❌ File login.php TIDAK ADA<br>";
    }
}

// 5. TAMPILKAN SEMUA USER
echo "<h3>5. Semua User di Database</h3>";
$all = mysqli_query($conn, "SELECT id_user, username, password, level FROM users");
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Level</th></tr>";
while($row = mysqli_fetch_assoc($all)) {
    echo "<tr>";
    echo "<td>" . $row['id_user'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['level'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
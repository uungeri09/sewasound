<?php
$conn = mysqli_connect('localhost', 'root', '', 'sewasound_db');

if (!$conn) {
    echo "❌ Koneksi GAGAL: " . mysqli_connect_error();
} else {
    echo "✅ Koneksi BERHASIL<br><br>";
    
    $result = mysqli_query($conn, "SELECT id_user, username, password, level FROM users");
    
    if(mysqli_num_rows($result) > 0) {
        echo "<h3>Data Users:</h3>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Level</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_user'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['level'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "❌ Tabel users KOSONG!";
    }
}
?>
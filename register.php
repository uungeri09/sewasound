<?php
require_once 'database.php';

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    
    $check = mysqli_query($conn, "SELECT id_user FROM users WHERE username='$username'");
    if(mysqli_num_rows($check) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $query = "INSERT INTO users (username, password, nama_lengkap, email, no_hp, alamat, level, status) 
                  VALUES ('$username', '$password', '$nama', '$email', '$hp', '$alamat', 'customer', 'pending')";
        if(mysqli_query($conn, $query)) {
            $success = "Registrasi berhasil! Akun akan diverifikasi admin.";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar - Sewa Sound</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#0a0a0a;display:flex;justify-content:center;align-items:center;height:100vh;font-family:Arial;}
        .register-card{background:#111;border:2px solid #1DB954;border-radius:15px;padding:30px;width:450px;}
        h2{color:#1DB954;text-align:center;}
        input,textarea{width:100%;padding:10px;margin:10px 0;background:#222;border:none;color:#fff;border-radius:5px;}
        button{width:100%;padding:10px;background:#1DB954;color:#000;font-weight:bold;border:none;border-radius:25px;cursor:pointer;}
        .error{color:#ff6b6b;text-align:center;}
        .success{color:#28a745;text-align:center;}
        a{color:#1DB954;text-decoration:none;}
    </style>
</head>
<body>
<div class="register-card">
    <h2>Daftar Akun Baru</h2>
    <p class="text-center text-white-50 small">Setelah daftar, akun akan diverifikasi admin</p>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <?php if($success) echo "<div class='success'>$success <a href='login.php'>Login</a></div>"; ?>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="hp" placeholder="No Handphone" required>
        <textarea name="alamat" placeholder="Alamat" rows="2"></textarea>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>
    <p class="text-center mt-3"><a href="login.php">Sudah punya akun? Login</a></p>
</div>
</body>
</html>
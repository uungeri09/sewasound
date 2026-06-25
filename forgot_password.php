<?php
session_start();
require_once 'database.php';

$error = '';
$success = '';

// Proses reset password langsung
if(isset($_POST['reset_password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Cek username
    $check = mysqli_query($conn, "SELECT id_user FROM users WHERE username='$username'");
    if(mysqli_num_rows($check) == 0) {
        $error = "Username tidak ditemukan!";
    } elseif($new_password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } elseif(strlen($new_password) < 4) {
        $error = "Password minimal 4 karakter!";
    } else {
        // Update password
        mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE username='$username'");
        $success = "Password berhasil direset! Silakan <a href='login.php'>login</a>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password - Sewa Sound</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:#000;display:flex;justify-content:center;align-items:center;height:100vh;font-family:Arial;margin:0;}
        .card{background:#111;border:2px solid #1DB954;border-radius:15px;padding:40px;width:420px;max-width:95%;}
        h2{color:#1DB954;text-align:center;margin-bottom:20px;}
        input{width:100%;padding:12px;margin:10px 0;background:#222;border:none;color:#fff;border-radius:8px;box-sizing:border-box;}
        input:focus{outline:1px solid #1DB954;}
        button{width:100%;padding:12px;background:#1DB954;color:#000;font-weight:bold;border:none;border-radius:30px;cursor:pointer;}
        button:hover{background:#1ED760;}
        .error{color:#ff6b6b;text-align:center;padding:10px;background:rgba(255,107,107,0.1);border-radius:8px;}
        .success{color:#28a745;text-align:center;padding:10px;background:rgba(40,167,69,0.1);border-radius:8px;}
        a{color:#1DB954;text-decoration:none;}
        .subtitle{text-align:center;color:#aaa;margin-bottom:20px;font-size:14px;}
        .info-box{background:#1a1a1a;border-radius:8px;padding:12px;margin-bottom:15px;border-left:3px solid #1DB954;}
        .info-box small{color:#888;font-size:12px;}
    </style>
</head>
<body>
<div class="card">
    <h2><i class="fas fa-key"></i> Reset Password</h2>
    <p class="subtitle">Masukkan username dan password baru</p>
    
    <?php if($error) echo "<div class='error'><i class='fas fa-exclamation-circle'></i> $error</div>"; ?>
    <?php if($success) echo "<div class='success'><i class='fas fa-check-circle'></i> $success</div>"; ?>
    
    <form method="POST">
        <input type="text" name="username" placeholder="Username Anda" required>
        <input type="password" name="new_password" placeholder="Password Baru" required>
        <input type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
    
    <div class="info-box">
        <small><i class="fas fa-info-circle"></i> Gunakan username yang terdaftar. Admin: <strong>admin</strong> | Customer: <strong>customer</strong></small>
    </div>
    
    <p class="text-center mt-3"><a href="login.php">← Kembali ke Login</a></p>
</div>
</body>
</html>
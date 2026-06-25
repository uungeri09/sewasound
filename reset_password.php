<?php
session_start();
require_once 'database.php';

if(isset($_SESSION['id_user'])) {
    header('Location: ' . ($_SESSION['level'] == 'admin' ? 'admin/dashboard.php' : 'customer/dashboard.php'));
    exit();
}

$error = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if($row = mysqli_fetch_assoc($result)) {
        if($row['status'] == 'pending') {
            $error = "Akun masih menunggu persetujuan admin!";
        } elseif($row['status'] == 'rejected') {
            $error = "Akun ditolak! Hubungi admin.";
        } else {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama'] = $row['nama_lengkap'];
            $_SESSION['level'] = $row['level'];
            
            if($row['level'] == 'admin') {
                header('Location: admin/dashboard.php');
            } else {
                header('Location: customer/dashboard.php');
            }
            exit();
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sewa Sound</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#000;display:flex;justify-content:center;align-items:center;height:100vh;font-family:Arial;margin:0;}
        .login-card{background:#111;border:2px solid #1DB954;border-radius:15px;padding:40px;width:380px;}
        h2{color:#1DB954;text-align:center;margin-bottom:20px;}
        input{width:100%;padding:12px;margin:10px 0;background:#222;border:none;color:#fff;border-radius:8px;box-sizing:border-box;}
        input:focus{outline:1px solid #1DB954;}
        button{width:100%;padding:12px;background:#1DB954;color:#000;font-weight:bold;border:none;border-radius:30px;cursor:pointer;}
        button:hover{background:#1ED760;}
        .error{color:#ff6b6b;text-align:center;margin-bottom:15px;}
        a{color:#1DB954;text-decoration:none;}
        .text-white-50{color:#aaa;}
        .small{font-size:12px;}
    </style>
</head>
<body>
<div class="login-card">
    <h2><i class="fas fa-music"></i> Sewa Sound Aura Audio</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
    <p class="text-center mt-2"><a href="register.php">Belum punya akun? Daftar</a></p>
    <p class="text-center"><a href="forgot_password.php" class="text-white-50 small">🔑 Lupa Password?</a></p>
</div>
</body>
</html>
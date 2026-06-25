<?php
session_start();
require_once 'database.php';

if(isset($_SESSION['id_user'])) {
    header('Location: ' . ($_SESSION['level'] == 'admin' ? 'admin/dashboard.php' : 'customer/dashboard.php'));
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query langsung tanpa hash
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    
    if($row = mysqli_fetch_assoc($result)) {
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
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sewa Sound</title>
    <style>
        body{background:#000;display:flex;justify-content:center;align-items:center;height:100vh;font-family:Arial;}
        .login-card{background:#111;border:2px solid #1DB954;border-radius:15px;padding:40px;width:380px;}
        h2{color:#1DB954;text-align:center;margin-bottom:20px;}
        input{width:100%;padding:12px;margin:10px 0;background:#222;border:none;color:#fff;border-radius:8px;}
        input:focus{outline:1px solid #1DB954;}
        button{width:100%;padding:12px;background:#1DB954;color:#000;font-weight:bold;border:none;border-radius:30px;cursor:pointer;}
        button:hover{background:#1ED760;}
        .error{color:#ff6b6b;text-align:center;}
        a{color:#1DB954;}
    </style>
</head>
<body>
<div class="login-card">
    <h2><i class="fas fa-music"></i> Sewa Sound Aura Audio</h2>
    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
    <p class="text-center mt-3"><a href="register.php">Belum punya akun? Daftar</a></p>
</div>
</body>
</html>
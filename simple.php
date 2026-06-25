<?php
session_start();

// Proses login
if(isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    if($user == 'admin' && $pass == 'admin') {
        $_SESSION['login'] = true;
        $_SESSION['user'] = 'admin';
    } else {
        $error = "Username atau password salah!";
    }
}

// Proses logout
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: simple.php');
    exit();
}

// Cek sudah login
if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // TAMPILAN DASHBOARD
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Dashboard</title>
        <style>
            body{background:#000;color:#fff;font-family:Arial;padding:20px;text-align:center;}
            h1{color:#1DB954;}
            .logout{background:#1DB954;color:#000;padding:10px 20px;text-decoration:none;border-radius:5px;display:inline-block;}
        </style>
    </head>
    <body>
        <h1>Sewa Sound Aura Audio</h1>
        <h2>Admin Dashboard</h2>
        <p>Selamat datang, <strong>Administrator</strong>!</p>
        <p>Login BERHASIL!</p>
        <a href="?logout=1" class="logout">Logout</a>
    </body>
    </html>';
    exit();
}

// TAMPILAN LOGIN
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sewa Sound</title>
    <style>
        body{background:#000;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;}
        .box{background:#111;border:2px solid #1DB954;border-radius:10px;padding:30px;width:300px;text-align:center;}
        h2{color:#1DB954;}
        input{width:100%;padding:10px;margin:10px 0;background:#222;border:none;color:#fff;box-sizing:border-box;}
        button{width:100%;padding:10px;background:#1DB954;color:#000;font-weight:bold;border:none;cursor:pointer;}
        .error{color:red;margin-bottom:10px;}
    </style>
</head>
<body>
<div class="box">
    <h2>Sewa Sound Aura Audio</h2>
    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">LOGIN</button>
    </form>
    <p style="margin-top:15px; color:#666;">Gunakan: admin / admin</p>
</div>
</body>
</html>
<?php
session_start();

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validasi hardcoded
    if($username == 'admin' && $password == 'admin') {
        $_SESSION['id_user'] = 1;
        $_SESSION['nama'] = 'Administrator';
        $_SESSION['level'] = 'admin';
        header('Location: admin/dashboard.php');
        exit();
    } elseif($username == 'user' && $password == 'user') {
        $_SESSION['id_user'] = 2;
        $_SESSION['nama'] = 'Customer';
        $_SESSION['level'] = 'customer';
        header('Location: customer/dashboard.php');
        exit();
    } else {
        $error = "Username atau password salah! Gunakan admin/admin atau user/user";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sewa Sound</title>
    <style>
        body{background:#000;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;}
        .box{background:#111;border:2px solid #1DB954;border-radius:10px;padding:30px;width:300px;}
        h2{color:#1DB954;text-align:center;}
        input{width:100%;padding:10px;margin:10px 0;background:#222;border:none;color:#fff;}
        button{width:100%;padding:10px;background:#1DB954;color:#000;font-weight:bold;border:none;cursor:pointer;}
        .error{color:red;text-align:center;}
    </style>
</head>
<body>
<div class="box">
    <h2>Login (Test Mode)</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
</div>
</body>
</html>
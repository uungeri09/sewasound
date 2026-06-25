<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'sewasound_db');
if (!$conn) die("Koneksi gagal");

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if($row = mysqli_fetch_assoc($result)) {
        $_SESSION['id_user'] = $row['id_user'];
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
    <title>Test Login</title>
    <style>
        body{background:#000;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;}
        .box{background:#111;border:1px solid #1DB954;border-radius:10px;padding:30px;width:300px;}
        h2{color:#1DB954;text-align:center;}
        input{width:100%;padding:10px;margin:10px 0;background:#222;border:none;color:#fff;}
        button{width:100%;padding:10px;background:#1DB954;color:#000;font-weight:bold;border:none;cursor:pointer;}
        .error{color:red;text-align:center;}
    </style>
</head>
<body>
<div class="box">
    <h2>Test Login</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
    <p style="text-align:center;margin-top:15px;">Coba: admin / admin</p>
</div>
</body>
</html>
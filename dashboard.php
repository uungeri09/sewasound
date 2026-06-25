<?php
session_start();
if(!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body{background:#000;color:#fff;font-family:Arial;text-align:center;padding:50px;}
        .btn{background:#1DB954;color:#000;padding:10px 20px;text-decoration:none;display:inline-block;margin:10px;border-radius:5px;}
        h2{color:#1DB954;}
    </style>
</head>
<body>
    <h2>Selamat datang, <?= $_SESSION['nama'] ?>!</h2>
    <p>Anda berhasil login sebagai <strong><?= $_SESSION['level'] ?></strong>.</p>
    <a href="logout.php" class="btn">Logout</a>
</body>
</html>
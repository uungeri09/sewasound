<?php
session_start();
require_once 'database.php';
$id = $_GET['id'];
$barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id_barang=$id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:#0a0a0a;color:#fff;font-family:Arial;}
        .navbar{background:#000;border-bottom:2px solid #1DB954;padding:15px 30px;}
        .navbar-brand{color:#1DB954;font-size:24px;font-weight:bold;}
        .btn-spotify{background:#1DB954;color:#000;font-weight:bold;border:none;padding:10px 25px;border-radius:25px;text-decoration:none;}
        .card-dark{background:#111;border:1px solid #1DB954;border-radius:10px;padding:25px;}
        .text-spotify{color:#1DB954;}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-music"></i> Sewa Sound Aura Audio</a>
        <div class="ms-auto">
            <?php if(isset($_SESSION['id_user'])): ?>
                <a href="<?= $_SESSION['level']=='admin'?'admin/dashboard.php':'customer/dashboard.php' ?>" class="btn-spotify btn-sm me-2">Dashboard</a>
                <a href="logout.php" class="btn-spotify btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-spotify btn-sm me-2">Login</a>
                <a href="register.php" class="btn-spotify btn-sm">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-5">
            <div class="card-dark text-center">
                <i class="fas fa-speaker" style="font-size:120px;color:#1DB954;"></i>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-dark">
                <h2 class="text-spotify"><?= $barang['nama_barang'] ?></h2>
                <p class="text-white-50">Kode: <?= $barang['kode_barang'] ?></p>
                <h3 class="text-spotify">Rp <?= number_format($barang['harga_sewa'],0,',','.') ?> <span class="text-white-50" style="font-size:18px;">/ hari</span></h3>
                <p class="text-white">Stok: <strong><?= $barang['stok'] ?></strong> unit</p>
                <p class="text-white"><?= nl2br($barang['deskripsi']) ?></p>
                <?php if(isset($_SESSION['id_user']) && $_SESSION['level'] == 'customer' && $barang['stok'] > 0): ?>
                    <a href="customer/pemesanan.php?id=<?= $barang['id_barang'] ?>" class="btn-spotify mt-3">Sewa Sekarang</a>
                <?php elseif(!isset($_SESSION['id_user'])): ?>
                    <a href="login.php" class="btn-spotify mt-3">Login untuk Sewa</a>
                <?php else: ?>
                    <button class="btn btn-secondary mt-3" disabled>Stok Habis</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
session_start();
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Sound Aura Audio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{background:#0a0a0a;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;color:#fff;}
        
        /* Navbar */
        .navbar{background:#000;border-bottom:2px solid #1DB954;padding:15px 0;}
        .navbar-brand{color:#1DB954!important;font-weight:bold;font-size:24px;}
        .navbar-brand:hover{color:#1ED760!important;}
        .nav-link{color:#fff!important;transition:0.3s;}
        .nav-link:hover{color:#1DB954!important;}
        
        /* Buttons */
        .btn-spotify{background:#1DB954;color:#000;font-weight:bold;border:none;padding:8px 20px;border-radius:25px;transition:0.3s;}
        .btn-spotify:hover{background:#1ED760;transform:scale(1.02);}
        .btn-outline-spotify{background:transparent;color:#1DB954;border:1px solid #1DB954;padding:8px 20px;border-radius:25px;transition:0.3s;}
        .btn-outline-spotify:hover{background:#1DB954;color:#000;}
        
        /* Cards */
        .card-dark{background:#111;border:1px solid #1DB954;border-radius:10px;transition:0.3s;}
        .card-dark:hover{transform:translateY(-5px);box-shadow:0 5px 20px rgba(29,185,84,0.2);}
        
        .text-spotify{color:#1DB954;}
        footer{display:none;}
        
        /* Hero */
        .hero{background:linear-gradient(135deg,#0a0a0a,#111);border:1px solid #1DB954;border-radius:20px;padding:60px 20px;text-align:center;margin-bottom:40px;}
        .hero h1{font-size:48px;color:#1DB954;font-weight:700;}
        .hero h1 span{color:#fff;}
        
        /* Info Card */
        .info-card{background:#111;border:1px solid #1DB954;border-radius:10px;padding:20px;margin:20px 0;}
        .info-card i{color:#1DB954;}
        
        /* Product Card */
        .product-price{color:#1DB954;font-size:20px;font-weight:700;}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-music"></i> Sewa Sound Aura Audio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="background:#1DB954;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="barang.php">Barang</a></li>
                <?php if(isset($_SESSION['id_user'])): ?>
                    <?php if($_SESSION['level'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Admin Panel</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="customer/dashboard.php">Dashboard</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="btn-spotify ms-2" href="register.php">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <!-- Hero Section -->
    <div class="hero">
        <h1>Sewa Sound <span>Aura Audio</span><br>Gelar Acara Maksimal</h1>
        <p class="text-white-50">Speaker • Amplifier • Mixer • Microphone</p>
        <a href="barang.php" class="btn-spotify mt-3 px-4 py-2">Lihat Semua Barang →</a>
    </div>

    <!-- Barang Populer -->
    <h3 class="text-spotify mb-4"><i class="fas fa-fire"></i> Barang Populer</h3>
    <div class="row">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM barang LIMIT 4");
        while($row = mysqli_fetch_assoc($result)):
        ?>
        <div class="col-md-3 mb-4">
            <div class="card-dark p-3 text-center">
                <i class="fas fa-speaker" style="font-size:50px;color:#1DB954;"></i>
                <h5 class="text-white mt-2"><?= $row['nama_barang'] ?></h5>
                <p class="product-price">Rp <?= number_format($row['harga_sewa'],0,',','.') ?> <small class="text-white-50">/hari</small></p>
                <a href="detail.php?id=<?= $row['id_barang'] ?>" class="btn-outline-spotify btn-sm w-100">Detail</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <!-- Info Alamat & Kontak -->
    <div class="info-card">
        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-map-marker-alt fa-2x"></i>
                <h6 class="mt-2">Alamat Kami</h6>
                <p class="small text-white-50">Jl. Raya Sengare, Sumilir, Sengare<br>Kec. Talun, Kabupaten Pekalongan<br>Jawa Tengah 51192</p>
                <a href="https://maps.app.goo.gl/iK23ELnGHhi7bgV79" target="_blank" class="btn-outline-spotify btn-sm">🗺️ Google Maps</a>
            </div>
            <div class="col-md-4">
                <i class="fab fa-whatsapp fa-2x"></i>
                <h6 class="mt-2">WhatsApp</h6>
                <p class="text-white-50">0878 1289 0246</p>
                <a href="https://wa.me/6287812890246" target="_blank" class="btn-outline-spotify btn-sm">Chat WhatsApp</a>
            </div>
            <div class="col-md-4">
                <i class="fas fa-money-bill-wave fa-2x"></i>
                <h6 class="mt-2">Pembayaran</h6>
                <p class="text-white-50"><i class="fab fa-amazon-pay"></i> DANA: 0813 2785 8710<br><i class="fas fa-hand-holding-usd"></i> Cash di Toko</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
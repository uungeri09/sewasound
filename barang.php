<?php
session_start();
require_once 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{background:#0a0a0a;font-family:'Poppins',sans-serif;color:#fff;}
        .sidebar{position:fixed;left:0;top:0;width:260px;height:100%;background:#111;border-right:2px solid #1DB954;padding-top:20px;overflow-y:auto;}
        .sidebar-brand{text-align:center;padding:20px 0;border-bottom:1px solid #1DB954;}
        .sidebar-brand h3{color:#1DB954;font-weight:700;}
        .sidebar-menu{list-style:none;padding:0;}
        .sidebar-menu li a{display:flex;align-items:center;padding:12px 20px;color:#ccc;text-decoration:none;transition:0.3s;border-left:3px solid transparent;}
        .sidebar-menu li a:hover,.sidebar-menu li a.active{background:#1a1a1a;color:#1DB954;border-left-color:#1DB954;}
        .sidebar-menu li a i{width:25px;margin-right:10px;color:#1DB954;}
        .main-content{margin-left:260px;padding:20px 30px;}
        .navbar{background:#000;border-bottom:2px solid #1DB954;padding:12px 20px;display:flex;justify-content:space-between;align-items:center;}
        .navbar-brand{color:#1DB954;font-size:22px;font-weight:700;}
        .btn-spotify{background:#1DB954;color:#000;font-weight:600;border:none;padding:8px 20px;border-radius:25px;transition:0.3s;}
        .btn-spotify:hover{background:#1ED760;transform:scale(1.02);}
        .btn-outline-spotify{background:transparent;color:#1DB954;border:1px solid #1DB954;padding:8px 20px;border-radius:25px;transition:0.3s;}
        .btn-outline-spotify:hover{background:#1DB954;color:#000;}
        .product-card{background:#111;border:1px solid #222;border-radius:15px;padding:20px;text-align:center;transition:0.3s;height:100%;}
        .product-card:hover{transform:translateY(-5px);border-color:#1DB954;box-shadow:0 10px 30px rgba(29,185,84,0.15);}
        .product-icon{font-size:45px;color:#1DB954;margin-bottom:10px;}
        .product-price{color:#1DB954;font-size:20px;font-weight:700;}
        .product-stock{color:#888;font-size:12px;}
        .page-title{color:#1DB954;font-size:28px;font-weight:700;}
        .filter-link{color:#ccc;text-decoration:none;display:block;padding:8px 12px;border-radius:8px;transition:0.3s;}
        .filter-link:hover,.filter-link.active{background:#1DB954;color:#000;}
        @media(max-width:768px){.sidebar{width:60px;}.sidebar-brand h3{display:none;}.sidebar-menu li a span{display:none;}.sidebar-menu li a i{margin-right:0;}.main-content{margin-left:60px;padding:15px;}}
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand"><h3><i class="fas fa-music"></i> Aura Audio</h3></div>
    <ul class="sidebar-menu">
        <li><a href="index.php"><i class="fas fa-home"></i> <span>Home</span></a></li>
        <li><a href="barang.php" class="active"><i class="fas fa-box"></i> <span>Barang</span></a></li>
        <?php if(isset($_SESSION['id_user'])): ?>
            <?php if($_SESSION['level'] == 'admin'): ?>
                <li><a href="admin/dashboard.php"><i class="fas fa-chart-line"></i> <span>Admin Panel</span></a></li>
            <?php else: ?>
                <li><a href="customer/dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <?php endif; ?>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        <?php else: ?>
            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> <span>Login</span></a></li>
            <li><a href="register.php"><i class="fas fa-user-plus"></i> <span>Daftar</span></a></li>
        <?php endif; ?>
    </ul>
</div>

<div class="main-content">
    <nav class="navbar">
        <a class="navbar-brand" href="index.php"><i class="fas fa-music"></i> Sewa Sound Aura Audio</a>
        <div>
            <?php if(isset($_SESSION['id_user'])): ?>
                <span class="text-white me-2"><?= $_SESSION['nama'] ?></span>
                <a href="logout.php" class="btn btn-spotify btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="text-white me-2">Login</a>
                <a href="register.php" class="btn btn-spotify btn-sm">Daftar</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-title mb-3"><i class="fas fa-speaker"></i> Daftar Barang Sound System</div>
    <p class="text-white-50 mb-4">Pilih sound system yang ingin Anda sewa</p>

    <div class="row">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id_barang DESC");
        if(mysqli_num_rows($result) > 0):
            while($row = mysqli_fetch_assoc($result)):
        ?>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="product-card">
                <div class="product-icon"><i class="fas fa-speaker"></i></div>
                <h5 class="text-white"><?= $row['nama_barang'] ?></h5>
                <div class="product-price">Rp <?= number_format($row['harga_sewa'],0,',','.') ?> <span style="font-size:12px;color:#888;">/hari</span></div>
                <div class="product-stock"><i class="fas fa-box"></i> Stok: <?= $row['stok'] ?></div>
                <a href="detail.php?id=<?= $row['id_barang'] ?>" class="btn btn-outline-spotify btn-sm w-100 mt-2">Detail & Sewa</a>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info text-center">Belum ada barang. Silakan admin menambahkan barang.</div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
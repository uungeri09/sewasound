<?php
session_start();
require_once 'config/database.php';
?>
<?php include 'inc/header.php'; ?>

<h2 class="text-spotify mb-4"><i class="fas fa-list"></i> Daftar Barang Sound System</h2>

<div class="row">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM barang");
    if(mysqli_num_rows($result) > 0):
        while($row = mysqli_fetch_assoc($result)):
    ?>
    <div class="col-md-3 mb-4">
        <div class="card-dark p-3 text-center">
            <i class="fas fa-speaker" style="font-size: 50px; color:#1DB954;"></i>
            <h5 class="text-white mt-2"><?= htmlspecialchars($row['nama_barang']) ?></h5>
            <p class="text-spotify fw-bold">Rp <?= number_format($row['harga_sewa'],0,',','.') ?>/hari</p>
            <p class="text-white-50 small">Stok: <?= $row['stok'] ?></p>
            <a href="detail.php?id=<?= $row['id_barang'] ?>" class="btn btn-outline-spotify btn-sm w-100">Detail & Sewa</a>
        </div>
    </div>
    <?php endwhile; else: ?>
        <div class="col-12"><div class="alert alert-info">Belum ada barang.</div></div>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>
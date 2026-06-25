CREATE DATABASE IF NOT EXISTS sewasound_db;
USE sewasound_db;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT,
    level ENUM('admin','customer') DEFAULT 'customer'
);

CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL
);

CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) UNIQUE NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    id_kategori INT NOT NULL,
    harga_sewa INT NOT NULL,
    stok INT NOT NULL,
    deskripsi TEXT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

CREATE TABLE pemesanan (
    id_pemesanan INT AUTO_INCREMENT PRIMARY KEY,
    no_invoice VARCHAR(30) UNIQUE NOT NULL,
    id_user INT NOT NULL,
    id_barang INT NOT NULL,
    qty INT NOT NULL,
    tgl_mulai DATE NOT NULL,
    tgl_selesai DATE NOT NULL,
    lama_sewa INT NOT NULL,
    total_harga INT NOT NULL,
    status ENUM('pending','diproses','berlangsung','selesai') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
);

INSERT INTO kategori (nama_kategori) VALUES ('Speaker'), ('Amplifier'), ('Mixer'), ('Microphone'), ('Aksesoris');

INSERT INTO barang (kode_barang, nama_barang, id_kategori, harga_sewa, stok, deskripsi) VALUES
('SPK001', 'Speaker Active 15 inch', 1, 350000, 10, 'Speaker aktif 1000W untuk outdoor'),
('AMP001', 'Power Amplifier 2000W', 2, 400000, 5, 'Amplifier daya besar untuk event'),
('MIX001', 'Mixer Digital 16 Channel', 3, 500000, 3, 'Mixer digital dengan efek built-in'),
('MIC001', 'Wireless Mic Dual', 4, 150000, 8, 'Mic wireless 2 set UHF'),
('AKS001', 'Stand Speaker Heavy Duty', 5, 50000, 12, 'Stand speaker kokoh');

INSERT INTO users (username, password, nama_lengkap, email, no_hp, level) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@sewa.com', '081234567890', 'admin'),
('customer', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Customer Biasa', 'customer@sewa.com', '081111111111', 'customer');


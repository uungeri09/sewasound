-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 02:29 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_barang`
--

CREATE TABLE `mst_barang` (
  `id_barang` int(11) NOT NULL,
  `kategori_kode` text NOT NULL,
  `tgl_input` date NOT NULL,
  `nama_barang` text NOT NULL,
  `brand` text NOT NULL,
  `stock` int(11) NOT NULL,
  `status_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_barang`
--

INSERT INTO `mst_barang` (`id_barang`, `kategori_kode`, `tgl_input`, `nama_barang`, `brand`, `stock`, `status_barang`) VALUES
(5, 'KG-001', '2020-05-12', 'Kamera Saku', 'Canon', 1, 1),
(7, 'KG-002', '2020-05-12', 'Yi Cam', 'Xiaomi', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` text NOT NULL,
  `kategori` text NOT NULL,
  `kategori_aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id_kategori`, `kode_kategori`, `kategori`, `kategori_aktif`) VALUES
(1, 'KG-001', 'Kamera Digital', 1),
(2, 'KG-002', 'Video Camera ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id_user` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `hp` text NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id_user`, `nama`, `email`, `hp`, `password`, `level`, `image`, `date_created`, `is_active`) VALUES
(36, 'Donny Kurniawan', 'admin@gmail.com', '08995625604', '$2y$10$BvwR9yx/Qz8akN2kDos6.OM.JKNZMTyArEY0BqwNgEzEUVYTlfiui', 'Admin', 'default.jpg', '2020-02-18', 1),
(42, 'Donny K', 'operator@gmail.com', '08995625604', '$2y$10$/XIQOL.KQLb51hoiU0N/UuntyGjZzqIzRnWRPPRZpiBV53teBmdLW', 'Operator', 'default.jpg', '2020-05-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewa`
--

CREATE TABLE `tb_sewa` (
  `id_sewa` int(11) NOT NULL,
  `no_register` text NOT NULL,
  `tgl_sewa` date NOT NULL,
  `barang_id` int(11) NOT NULL,
  `nama_pelanggan` text NOT NULL,
  `hp_pelanggan` text NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `harga_sewa` text NOT NULL,
  `denda` text NOT NULL,
  `operator_id` int(11) NOT NULL,
  `status_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sewa`
--

INSERT INTO `tb_sewa` (`id_sewa`, `no_register`, `tgl_sewa`, `barang_id`, `nama_pelanggan`, `hp_pelanggan`, `alamat_pelanggan`, `lama_sewa`, `tgl_kembali`, `harga_sewa`, `denda`, `operator_id`, `status_sewa`) VALUES
(1, '202005140700001', '2020-05-14', 5, 'Harjo', '08995625604', 'Jl. Dewi Sartika RT/RW : 03/01', 2, '2020-05-04', '100000', '0', 42, 1),
(2, '202005150658002', '2020-05-10', 7, 'Donny Kurniawan', '08995625604', 'Jl. Sosrokartono no 45', 2, '2020-05-18', '25000', '0', 42, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_barang`
--
ALTER TABLE `mst_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_barang`
--
ALTER TABLE `mst_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

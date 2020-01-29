-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2020 at 03:18 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-kasir-laravel-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_barang`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sunlight', NULL, '2020-01-17 01:34:02', '2020-01-17 01:34:02'),
(4, 2, 'tempe kripek', 'tempe', '2020-01-17 10:02:49', '2020-01-17 03:02:49'),
(5, 1, 'Keju Cheedar', 'PT Craft Indonesia', '2020-01-28 07:09:26', '2020-01-28 07:09:26'),
(6, 1, 'Cheetos', 'PT. Sinarmas', '2020-01-28 07:10:01', '2020-01-28 07:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_stok`, `jumlah`, `harga`, `subtotal`, `updated_at`, `created_at`) VALUES
(1, 2, 2, 2, 30000, 60000, '2020-01-27 06:28:02', '2020-01-27 06:28:02'),
(2, 2, 3, 1, 200, 200, '2020-01-27 06:28:02', '2020-01-27 06:28:02'),
(3, 2, 4, 1, 4000, 4000, '2020-01-27 06:28:02', '2020-01-27 06:28:02'),
(4, 3, 2, 1, 30000, 30000, '2020-01-27 06:32:35', '2020-01-27 06:32:35'),
(5, 3, 3, 1, 200, 200, '2020-01-27 06:32:35', '2020-01-27 06:32:35'),
(6, 4, 2, 2, 30000, 60000, '2020-01-27 06:35:14', '2020-01-27 06:35:14'),
(7, 4, 3, 1, 200, 200, '2020-01-27 06:35:14', '2020-01-27 06:35:14'),
(8, 5, 2, 9, 30000, 270000, '2020-01-27 07:12:00', '2020-01-27 07:12:00'),
(9, 5, 3, 2, 200, 400, '2020-01-27 07:12:00', '2020-01-27 07:12:00'),
(10, 6, 2, 3, 30000, 90000, '2020-01-27 08:35:21', '2020-01-27 08:35:21'),
(11, 6, 3, 1, 200, 200, '2020-01-27 08:35:21', '2020-01-27 08:35:21'),
(12, 7, 2, 1, 30000, 30000, '2020-01-27 08:35:32', '2020-01-27 08:35:32'),
(13, 7, 3, 1, 200, 200, '2020-01-27 08:35:32', '2020-01-27 08:35:32'),
(14, 8, 2, 1, 30000, 30000, '2020-01-27 08:35:53', '2020-01-27 08:35:53'),
(15, 8, 3, 1, 200, 200, '2020-01-27 08:35:53', '2020-01-27 08:35:53'),
(16, 9, 2, 1, 30000, 30000, '2020-01-28 07:36:22', '2020-01-28 07:36:22'),
(17, 10, 2, 1, 30000, 30000, '2020-01-28 07:36:52', '2020-01-28 07:36:52'),
(18, 10, 3, 1, 200, 200, '2020-01-28 07:36:52', '2020-01-28 07:36:52'),
(19, 11, 3, 1, 200, 200, '2020-01-28 07:37:48', '2020-01-28 07:37:48'),
(20, 12, 3, 1, 200, 200, '2020-01-28 07:39:07', '2020-01-28 07:39:07'),
(21, 13, 3, 1, 200, 200, '2020-01-28 07:39:44', '2020-01-28 07:39:44'),
(22, 14, 3, 1, 200, 200, '2020-01-28 07:54:25', '2020-01-28 07:54:25'),
(23, 14, 2, 1, 30000, 30000, '2020-01-28 07:54:25', '2020-01-28 07:54:25'),
(24, 15, 3, 1, 200, 200, '2020-01-28 08:00:33', '2020-01-28 08:00:33'),
(25, 16, 5, 1, 18000, 18000, '2020-01-28 08:00:49', '2020-01-28 08:00:49'),
(26, 16, 4, 1, 12000, 12000, '2020-01-28 08:00:49', '2020-01-28 08:00:49'),
(27, 16, 2, 1, 30000, 30000, '2020-01-28 08:00:49', '2020-01-28 08:00:49'),
(28, 17, 5, 2, 18000, 36000, '2020-01-28 08:01:29', '2020-01-28 08:01:29'),
(29, 17, 3, 1, 200, 200, '2020-01-28 08:01:29', '2020-01-28 08:01:29'),
(30, 17, 2, 1, 30000, 30000, '2020-01-28 08:01:29', '2020-01-28 08:01:29'),
(31, 18, 5, 1, 18000, 18000, '2020-01-28 08:04:18', '2020-01-28 08:04:18'),
(32, 18, 2, 1, 30000, 30000, '2020-01-28 08:04:18', '2020-01-28 08:04:18'),
(33, 19, 2, 1, 30000, 30000, '2020-01-28 08:04:30', '2020-01-28 08:04:30'),
(34, 20, 5, 1, 18000, 18000, '2020-01-28 08:12:00', '2020-01-28 08:12:00'),
(35, 20, 4, 1, 12000, 12000, '2020-01-28 08:12:00', '2020-01-28 08:12:00'),
(36, 21, 2, 2, 30000, 60000, '2020-01-28 08:22:31', '2020-01-28 08:22:31'),
(37, 22, 2, 3, 30000, 90000, '2020-01-28 08:23:19', '2020-01-28 08:23:19'),
(38, 23, 2, 2, 30000, 60000, '2020-01-28 08:23:58', '2020-01-28 08:23:58'),
(39, 24, 3, 3, 200, 600, '2020-01-28 08:33:44', '2020-01-28 08:33:44'),
(40, 24, 5, 1, 18000, 18000, '2020-01-28 08:33:44', '2020-01-28 08:33:44'),
(41, 25, 2, 1, 30000, 30000, '2020-01-28 09:05:00', '2020-01-28 09:05:00'),
(42, 25, 3, 1, 200, 200, '2020-01-28 09:05:00', '2020-01-28 09:05:00'),
(43, 26, 2, 1, 30000, 30000, '2020-01-28 09:05:13', '2020-01-28 09:05:13'),
(44, 26, 4, 1, 12000, 12000, '2020-01-28 09:05:13', '2020-01-28 09:05:13'),
(45, 27, 3, 1, 200, 200, '2020-01-28 09:05:37', '2020-01-28 09:05:37'),
(46, 28, 2, 1, 30000, 30000, '2020-01-28 12:31:35', '2020-01-28 12:31:35'),
(47, 28, 4, 1, 12000, 12000, '2020-01-28 12:31:35', '2020-01-28 12:31:35'),
(48, 29, 4, 1, 12000, 12000, '2020-01-28 12:31:46', '2020-01-28 12:31:46'),
(49, 29, 5, 1, 18000, 18000, '2020-01-28 12:31:46', '2020-01-28 12:31:46'),
(50, 29, 2, 1, 30000, 30000, '2020-01-28 12:31:46', '2020-01-28 12:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `updated_at`, `created_at`) VALUES
(1, 'Makanan Ringan', '2020-01-15 11:16:18', '0000-00-00 00:00:00'),
(2, 'Makanan Berat', '2020-01-15 11:16:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_stok_masuk` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `sisa_stok` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `jumlah_stok_masuk`, `tanggal_masuk`, `tanggal_kadaluarsa`, `sisa_stok`, `harga_beli`, `harga_jual`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 20, '2020-01-18', '2020-01-25', 2, 20000, 30000, 'aktif', '2020-01-29 11:49:37', '2020-01-29 11:45:19'),
(3, 4, 90, '2020-01-24', '2020-01-30', 78, 100, 200, 'aktif', '2020-01-29 09:23:36', '2020-01-28 09:05:37'),
(4, 5, 12, '2020-01-08', '2020-01-21', 7, 1000, 12000, 'expired', '2020-01-29 11:45:27', '2020-01-29 11:45:27'),
(5, 6, 32, '2020-01-08', '2020-01-10', 25, 12500, 18000, 'expired', '2020-01-29 11:47:16', '2020-01-29 11:47:16'),
(6, 6, 12, '2020-01-29', '2020-02-01', 12, 1000, 2300, 'aktif', '2020-01-29 14:00:09', '2020-01-29 14:00:09'),
(7, 5, 100, '2020-01-29', '2020-02-01', 100, 10000, 12000, 'aktif', '2020-01-29 14:00:35', '2020-01-29 14:00:35'),
(8, 4, 3, '2020-01-29', '2020-02-01', 3, 8000, 9000, 'aktif', '2020-01-29 14:01:09', '2020-01-29 14:01:09'),
(9, 1, 32, '2020-01-29', '2020-02-02', 32, 1000, 12000, 'aktif', '2020-01-29 14:01:31', '2020-01-29 14:01:31'),
(10, 5, 12, '2020-01-30', '2020-02-08', 12, 1000, 12000, 'aktif', '2020-01-29 14:01:53', '2020-01-29 14:01:53'),
(11, 5, 12, '2020-01-29', '2020-02-01', 12, 2000, 3000, 'aktif', '2020-01-29 14:02:12', '2020-01-29 14:02:12'),
(12, 4, 32, '2020-01-16', '2020-01-23', 32, 9000, 99000, 'aktif', '2020-01-29 14:02:37', '2020-01-29 14:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `total`, `updated_at`, `created_at`) VALUES
(1, NULL, '2020-01-24 02:59:26', '2020-01-24 02:59:26'),
(2, 64200, '2020-01-26 23:28:02', '2020-01-26 23:28:02'),
(3, 30200, '2020-01-26 23:32:35', '2020-01-26 23:32:35'),
(4, 60200, '2020-01-27 06:35:14', '2020-01-27 06:35:14'),
(5, 270400, '2020-01-27 07:12:00', '2020-01-27 07:12:00'),
(6, 90200, '2020-01-27 08:35:21', '2020-01-27 08:35:21'),
(7, 30200, '2020-01-27 08:35:31', '2020-01-27 08:35:31'),
(8, 30200, '2020-01-27 08:35:53', '2020-01-27 08:35:53'),
(9, 30000, '2020-01-28 07:36:22', '2020-01-28 07:36:22'),
(10, 30200, '2020-01-28 07:36:52', '2020-01-28 07:36:52'),
(11, 200, '2020-01-28 07:37:47', '2020-01-28 07:37:47'),
(12, 200, '2020-01-28 07:39:06', '2020-01-28 07:39:06'),
(13, 200, '2020-01-28 07:39:44', '2020-01-28 07:39:44'),
(14, 30200, '2020-01-28 07:54:25', '2020-01-28 07:54:25'),
(15, 200, '2020-01-28 08:00:33', '2020-01-28 08:00:33'),
(16, 60000, '2020-01-28 08:00:49', '2020-01-28 08:00:49'),
(17, 66200, '2020-01-28 08:01:29', '2020-01-28 08:01:29'),
(18, 48000, '2020-01-28 08:04:18', '2020-01-28 08:04:18'),
(19, 30000, '2020-01-28 08:04:30', '2020-01-28 08:04:30'),
(20, 30000, '2020-01-28 08:12:00', '2020-01-28 08:12:00'),
(21, 60000, '2020-01-28 08:22:31', '2020-01-28 08:22:31'),
(22, 90000, '2020-01-28 08:23:19', '2020-01-28 08:23:19'),
(23, 60000, '2020-01-28 08:23:58', '2020-01-28 08:23:58'),
(24, 18600, '2020-01-28 08:33:44', '2020-01-28 08:33:44'),
(25, 30200, '2020-01-28 09:04:59', '2020-01-28 09:04:59'),
(26, 42000, '2020-01-28 09:05:13', '2020-01-28 09:05:13'),
(27, 200, '2020-01-28 09:05:37', '2020-01-28 09:05:37'),
(28, 42000, '2020-01-28 12:31:35', '2020-01-28 12:31:35'),
(29, 60000, '2020-01-28 12:31:46', '2020-01-28 12:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Pradana Poet', 'pemilik', 'pemilik', NULL, '$2y$10$10aVNpyEFsAn1BhrHFXys.XopUlIY8HDr1SKNoSz/u9ey2aNIyyAG', '9d60Vsxpfguxrjgc3vs9mG9RwBhIhpjMLKEB8qUPJaNN5nPgkioxw0QqTXJK', '2020-01-08 21:42:20', '2020-01-08 21:42:20'),
(3, 'Alfin Khoiri', 'kasir', 'kasir', NULL, '$2y$10$N3iEYTQZW3eHd4Cmrfa93.GpEEQgJTPI0L1v9vGm.W2k/wtpuw9TG', 'w2c3QLxTIMc1zzm4kx7vNJaa1hdr13PPdcC3c36trrTr0P5DSWdbxpnCbGtM', '2020-01-09 03:45:41', '2020-01-09 03:45:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`,`id_transaksi`,`id_stok`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2026 at 07:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invex_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `kondisi` enum('baik','rusak ringan','rusak berat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `status` enum('tersedia','tidak tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `minimal_peminjaman` int NOT NULL DEFAULT '1',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `category_id`, `foto`, `nama_barang`, `stok`, `kondisi`, `status`, `minimal_peminjaman`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 1, 'barang/WUah8HLLz0IQWKo7tX24f8W5sdRGfPR7jGqcBXrQ.jpg', 'Proyektor', 3, 'baik', 'tersedia', 2, 'Proyektor HDMI', '2026-03-10 08:22:49', '2026-03-11 23:18:08'),
(5, 3, 'barang/pDjZ6GRNAL9APLS5Q8QFoq7PcGsM952aJf7jSQGf.jpg', 'Mic', 2, 'baik', 'tersedia', 2, 'Mic', '2026-03-10 08:24:12', '2026-04-05 18:23:49'),
(6, 3, 'barang/dIFWgv8QeHiQTgKV3L8ZjxVBR3SWtbnzRTvbPhN1.jpg', 'Stop Kontak', 18, 'baik', 'tersedia', 2, 'Stop Kontak 4 Port', '2026-03-10 08:25:22', '2026-04-05 18:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-dfirlaapriliani@gmail.com|127.0.0.1', 'i:1;', 1776515683),
('laravel-cache-dfirlaapriliani@gmail.com|127.0.0.1:timer', 'i:1776515683;', 1776515683);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', '2026-03-08 10:48:33', '2026-03-08 10:48:33'),
(3, 'Non Elektornik', '2026-03-10 08:16:32', '2026-03-10 08:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_05_004546_create_roles_table', 1),
(5, '2026_02_05_004644_add_role_id_to_users_table', 1),
(6, '2026_02_09_020423_add_kode_role_to_roles_table', 1),
(7, '2026_02_09_064411_add_nama_role_to_roles_table', 1),
(8, '2026_02_10_041703_create_categories_table', 1),
(9, '2026_02_11_041947_create_barangs_table', 1),
(10, '2026_03_09_125536_create_peminjamans_table', 2),
(11, '2026_03_09_145729_create_notifications_table', 3),
(12, '2026_03_10_142145_add_category_id_to_barangs', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `user_id`, `judul`, `pesan`, `icon`, `url`, `dibaca`, `created_at`, `updated_at`) VALUES
(1, 7, '🎉 Pengembalian Dikonfirmasi', 'Pengembalian barang untuk peminjaman PJM-20260309-003 telah dikonfirmasi. Terima kasih!', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/3', 1, '2026-03-09 08:05:24', '2026-03-09 08:20:42'),
(2, 7, '✅ Peminjaman Disetujui!', 'Permohonan PJM-20260310-001 telah disetujui. Silakan ambil barang ke petugas.', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/4', 1, '2026-03-10 10:15:25', '2026-03-11 23:21:13'),
(3, 7, '📦 Barang Sudah Diambil', 'Barang untuk peminjaman PJM-20260310-001 telah dikonfirmasi diambil. Jangan lupa kembalikan tepat waktu!', 'info', 'http://127.0.0.1:8000/peminjam/peminjaman/4', 1, '2026-03-10 10:16:14', '2026-03-11 19:50:10'),
(4, 7, '🎉 Pengembalian Dikonfirmasi', 'Pengembalian barang untuk peminjaman PJM-20260310-001 telah dikonfirmasi. Terima kasih!', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/4', 1, '2026-03-11 19:53:11', '2026-03-11 23:21:13'),
(5, 5, '🏁 Barang Dikembalikan', 'neta mengembalikan barang untuk PJM-20260310-001.', 'success', 'http://127.0.0.1:8000/petugas/peminjaman/4', 0, '2026-03-11 19:53:12', '2026-03-11 19:53:12'),
(6, 5, '📋 Peminjaman Baru!', 'neta mengajukan peminjaman PJM-20260312-001. Segera proses.', 'info', 'http://127.0.0.1:8000/petugas/peminjaman/5', 0, '2026-03-11 19:55:03', '2026-03-11 19:55:03'),
(7, 7, '✅ Peminjaman Disetujui!', 'Permohonan PJM-20260312-001 telah disetujui. Silakan ambil barang ke petugas.', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/5', 1, '2026-03-11 23:05:17', '2026-03-11 23:21:13'),
(8, 7, '📦 Barang Sudah Diambil', 'Barang untuk peminjaman PJM-20260312-001 telah dikonfirmasi diambil. Jangan lupa kembalikan tepat waktu!', 'info', 'http://127.0.0.1:8000/peminjam/peminjaman/5', 1, '2026-03-11 23:05:26', '2026-03-11 23:21:13'),
(9, 7, '🎉 Pengembalian Dikonfirmasi', 'Pengembalian barang untuk peminjaman PJM-20260312-001 telah dikonfirmasi. Terima kasih!', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/5', 1, '2026-03-11 23:05:34', '2026-03-11 23:21:13'),
(10, 5, '🏁 Barang Dikembalikan', 'neta mengembalikan barang untuk PJM-20260312-001.', 'success', 'http://127.0.0.1:8000/petugas/peminjaman/5', 0, '2026-03-11 23:05:34', '2026-03-11 23:05:34'),
(11, 5, '📋 Peminjaman Baru!', 'neta mengajukan peminjaman PJM-20260312-002. Segera proses.', 'info', 'http://127.0.0.1:8000/petugas/peminjaman/6', 0, '2026-03-11 23:17:24', '2026-03-11 23:17:24'),
(12, 7, '✅ Peminjaman Disetujui!', 'Permohonan PJM-20260312-002 telah disetujui. Silakan ambil barang ke petugas.', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/6', 1, '2026-03-11 23:18:08', '2026-03-11 23:21:13'),
(13, 7, '📦 Barang Sudah Diambil', 'Barang untuk peminjaman PJM-20260312-002 telah dikonfirmasi diambil. Jangan lupa kembalikan tepat waktu!', 'info', 'http://127.0.0.1:8000/peminjam/peminjaman/6', 1, '2026-03-11 23:18:16', '2026-03-11 23:21:13'),
(14, 5, '📋 Peminjaman Baru!', 'neta mengajukan peminjaman PJM-20260406-001. Segera proses.', 'info', 'http://127.0.0.1:8000/petugas/peminjaman/7', 0, '2026-04-05 18:21:04', '2026-04-05 18:21:04'),
(15, 7, '✅ Peminjaman Disetujui!', 'Permohonan PJM-20260406-001 telah disetujui. Silakan ambil barang ke petugas.', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/7', 1, '2026-04-05 18:21:54', '2026-04-05 18:24:27'),
(16, 7, '📦 Barang Sudah Diambil', 'Barang untuk peminjaman PJM-20260406-001 telah dikonfirmasi diambil. Jangan lupa kembalikan tepat waktu!', 'info', 'http://127.0.0.1:8000/peminjam/peminjaman/7', 1, '2026-04-05 18:22:35', '2026-04-05 18:24:27'),
(17, 7, '🎉 Pengembalian Dikonfirmasi', 'Pengembalian barang untuk peminjaman PJM-20260406-001 telah dikonfirmasi. Terima kasih!', 'success', 'http://127.0.0.1:8000/peminjam/peminjaman/7', 1, '2026-04-05 18:23:49', '2026-04-05 18:24:27'),
(18, 5, '🏁 Barang Dikembalikan', 'neta mengembalikan barang untuk PJM-20260406-001.', 'success', 'http://127.0.0.1:8000/petugas/peminjaman/7', 0, '2026-04-05 18:23:49', '2026-04-05 18:23:49'),
(19, 5, '📋 Peminjaman Baru!', 'neta mengajukan peminjaman PJM-20260406-002. Segera proses.', 'info', 'http://127.0.0.1:8000/petugas/peminjaman/8', 0, '2026-04-05 18:25:14', '2026-04-05 18:25:14'),
(20, 7, '❌ Peminjaman Ditolak', 'Permohonan PJM-20260406-002 ditolak. Alasan: bvcvc', 'danger', 'http://127.0.0.1:8000/peminjam/peminjaman/8', 0, '2026-04-05 18:38:53', '2026-04-05 18:38:53'),
(21, 5, '📋 Peminjaman Baru!', 'larasya mengajukan peminjaman PJM-20260420-001. Segera proses.', 'info', 'http://127.0.0.1:8000/petugas/peminjaman/9', 0, '2026-04-19 19:59:52', '2026-04-19 19:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `kode_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci,
  `catatan_peminjam` text COLLATE utf8mb4_unicode_ci,
  `catatan_petugas` text COLLATE utf8mb4_unicode_ci,
  `status` enum('menunggu','disetujui','dipinjam','dikembalikan','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `user_id`, `petugas_id`, `kode_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_dikembalikan`, `keperluan`, `catatan_peminjam`, `catatan_petugas`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 5, 'PJM-20260309-001', '2026-03-09', '2026-03-10', '2026-03-09', 'jhujh', 'kjnk', 'DIJAGA YE LO BOTAK', 'dikembalikan', '2026-03-09 06:50:46', '2026-03-09 06:52:41'),
(2, 7, 5, 'PJM-20260309-002', '2026-03-09', '2026-03-12', NULL, 'DSDSDS', NULL, 'gabisa minjem lebih dari hari yang ditentukan ya sayang', 'ditolak', '2026-03-09 07:12:12', '2026-03-09 07:19:29'),
(3, 7, 5, 'PJM-20260309-003', '2026-03-09', '2026-03-11', '2026-03-09', 'gdgdgd', NULL, 'dijaga!', 'dikembalikan', '2026-03-09 07:21:00', '2026-03-09 08:05:24'),
(4, 7, 5, 'PJM-20260310-001', '2026-03-10', '2026-03-11', '2026-03-12', 'gvcvc', NULL, 'dikembalikan tepat waktu ya', 'dikembalikan', '2026-03-10 08:40:49', '2026-03-11 19:53:11'),
(5, 7, 5, 'PJM-20260312-001', '2026-03-12', '2026-03-14', '2026-03-12', 'butuh', NULL, NULL, 'dikembalikan', '2026-03-11 19:55:03', '2026-03-11 23:05:34'),
(6, 7, 5, 'PJM-20260312-002', '2026-03-12', '2026-03-14', NULL, 'BUTUH', NULL, NULL, 'dipinjam', '2026-03-11 23:17:24', '2026-03-11 23:18:16'),
(7, 7, 5, 'PJM-20260406-001', '2026-04-06', '2026-04-08', '2026-04-06', 'fdfdf', 'dfdfd', 'sudah pak', 'dikembalikan', '2026-04-05 18:21:03', '2026-04-05 18:23:49'),
(8, 7, 5, 'PJM-20260406-002', '2026-04-06', '2026-04-08', NULL, 'bvb', 'vbv', 'bvcvc', 'ditolak', '2026-04-05 18:25:14', '2026-04-05 18:38:53'),
(9, 8, NULL, 'PJM-20260420-001', '2026-04-21', '2026-04-23', NULL, 'untuk event kemajuan ekstrakulikuler', NULL, NULL, 'menunggu', '2026-04-19 19:59:51', '2026-04-19 19:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_items`
--

CREATE TABLE `peminjaman_items` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `kondisi_kembali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman_items`
--

INSERT INTO `peminjaman_items` (`id`, `peminjaman_id`, `barang_id`, `jumlah`, `kondisi_kembali`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Baik', '2026-03-09 06:50:46', '2026-03-09 06:52:41'),
(2, 2, 2, 4, NULL, '2026-03-09 07:12:12', '2026-03-09 07:12:12'),
(3, 3, 3, 6, 'Baik', '2026-03-09 07:21:00', '2026-03-09 08:05:24'),
(4, 4, 5, 2, 'Baik', '2026-03-10 08:40:49', '2026-03-11 19:53:11'),
(5, 4, 4, 1, 'Baik', '2026-03-10 08:40:49', '2026-03-11 19:53:11'),
(6, 4, 6, 3, 'Baik', '2026-03-10 08:40:49', '2026-03-11 19:53:11'),
(7, 5, 6, 2, 'Baik', '2026-03-11 19:55:03', '2026-03-11 23:05:34'),
(8, 6, 5, 5, NULL, '2026-03-11 23:17:24', '2026-03-11 23:17:24'),
(9, 6, 4, 3, NULL, '2026-03-11 23:17:24', '2026-03-11 23:17:24'),
(10, 7, 5, 2, 'Baik', '2026-04-05 18:21:03', '2026-04-05 18:23:49'),
(11, 7, 6, 1, 'Baik', '2026-04-05 18:21:03', '2026-04-05 18:23:49'),
(12, 8, 4, 1, NULL, '2026-04-05 18:25:14', '2026-04-05 18:25:14'),
(13, 9, 5, 1, NULL, '2026-04-19 19:59:51', '2026-04-19 19:59:51'),
(14, 9, 6, 1, NULL, '2026-04-19 19:59:51', '2026-04-19 19:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` bigint UNSIGNED NOT NULL,
  `kode_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `kode_role`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'ADM-001', 'Admin', NULL, NULL),
(2, 'PTG-001', 'Petugas', NULL, NULL),
(3, 'PMJ-001', 'Peminjam', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CvRATPkDTvlUdMoN6EZPsKwCnad6POlvnFE14lyu', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY09EM21GclhPbENRWGlEb0FvZXQ5bnI0Q2JZWjRQSXdjMm41VHE1UCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BldHVnYXMvbGFwb3JhbiI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGV0dWdhcy9iYXJhbmciO3M6NToicm91dGUiO3M6MjA6InBldHVnYXMuYmFyYW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1776669869),
('dK0JDdWyLJizV3y2lGXSRA9rCRPL0dUhQv4yB31h', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS3ZHQUVIdzBzY2Nkck1KZVlnTTExU0pnTlQ3ZExCb2V6dlRveVpmUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BldHVnYXMvYmFyYW5nIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL2JhcmFuZyI7czo1OiJyb3V0ZSI7czoyMDoicGV0dWdhcy5iYXJhbmcuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776668230),
('zchE4RijhqPD23PWpS9hJmOMvsycmzbWiaQGiTMW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibWJ3QzJYRVBpODhwZkFGMDhWeWo5TjdsSG1zU2NWa3NFVTl2OVJQdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1776668232);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 1, 'blue', 'blue@gmail.com', NULL, '$2y$12$eBsnZUJQ1Kpf8RQ3ydH60.4wvlHX9oK62vTIvy7tg6XhFgd6ecXHO', NULL, '2026-02-11 03:35:03', '2026-02-11 03:51:01'),
(5, 2, 'aditya', 'aditya@gmail.com', NULL, '$2y$12$QmA8ho5NhFYhDbDqQdbgwOMReOodfAzU.8GZgJakTqySG5SbTFW6.', NULL, '2026-02-18 00:06:34', '2026-02-18 00:19:42'),
(7, 3, 'neta', 'aneta@gmail.com', NULL, '$2y$12$AyH26uD/XOaVL3OPDJy46e9aVV0UQ9BYw4x1WWY8XaR/13HLaJEE6', NULL, '2026-03-08 10:52:59', '2026-03-08 10:52:59'),
(8, 3, 'larasya', 'larasya@gmail.com', NULL, '$2y$12$n6gjgHtkb0TMH6bRs78hU.3pfMBsm3x8m4d8lMHIbjL9gb5SvnMB6', NULL, '2026-04-19 19:52:26', '2026-04-19 19:52:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_category_id_foreign` (`category_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasis_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjamans_kode_peminjaman_unique` (`kode_peminjaman`),
  ADD KEY `peminjamans_user_id_foreign` (`user_id`),
  ADD KEY `peminjamans_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `peminjaman_items`
--
ALTER TABLE `peminjaman_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `roles_kode_role_unique` (`kode_role`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjaman_items`
--
ALTER TABLE `peminjaman_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjamans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

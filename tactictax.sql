-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Mar 2025 pada 07.41
-- Versi server: 8.0.30
-- Versi PHP: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tactictax`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Kelas Brevet', 'kelas-brevet', '<p>Program pelatihan perpajakan yang dirancang untuk memberikan pemahaman mendalam mengenai peraturan dan praktik perpajakan di Indonesia.</p>', '2025-03-05 17:25:03', '2025-03-06 20:23:13'),
(2, 'Kelas Eksekutif', 'kelas-eksekutif', '<p>Program pendidikan atau pelatihan yang dirancang khusus guna meningkatkan keterampilan, pengetahuan, dan wawasan mereka dalam bidang tertentu.</p>', '2025-03-05 17:32:32', '2025-03-06 20:29:27'),
(3, 'Sertifikasi Asosiasi Teknisi Perpajakan Indonesia', 'sertifikasi-asosiasi-teknisi-perpajakan-indonesia', '<p>Asosiasi ini bekerja sama dengan Tac Tic Tax dalam menawarkan program sertifikasi untuk mengakui kompetensi profesional di bidang perpajakan.</p>', '2025-03-05 17:32:58', '2025-03-06 20:29:35'),
(4, 'Seminar', 'seminar', '<p>Program ini diadakan untuk membahas suatu topik tertentu (baik dalam bentuk presentasi, workshop, diskusi) yang melibatkan para ahli dan peserta yang tertarik dalam tema tersebut.</p>', '2025-03-05 17:33:29', '2025-03-06 20:29:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` bigint UNSIGNED NOT NULL,
  `pic` varchar(255) NOT NULL,
  `address` text,
  `whatsapp` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `pic`, `address`, `whatsapp`, `phone`, `email`, `facebook`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'Ratih Gantini', 'Jln. Wastukencana No. 31, Babakan Ciamis, Sumur Bandung, Kota Bandung, Jawa Barat, 40117', '+62 822-6202-4367', '+62 22 4221953', NULL, NULL, NULL, NULL, '2025-03-11 15:00:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `nama`, `slug`, `deskripsi`, `gambar`, `kategori_id`, `created_at`, `updated_at`) VALUES
(1, 'Brevet A-B Terpadu', 'brevet-a-b-terpadu', '<p>PROMO RAMADHAN &amp; LEBARAN</p><p>BIAYA 2.000.000 (BIAYA NORMAL 2.500.000)</p><p>PERIODE PENDAFTARAN 1 MARET - 22 MARET 2025 / 20 PENDAFTAR PERTAMA</p><p><strong>KELAS TATAP MUKA :</strong></p><ul><li>REGULER (SENIN S/D KAMIS 18.30 - 20.45) MULAI 14 APRIL 2025</li><li>WEEKEND PAGI (SABTU S/D MINGGU 09.00 - 13.00) MULAI 26 APRIL 2025</li><li>WEEKEND SIANG (SABTU S/D MINGGU 14.00 - 17.30) MULAI 26 APRIL 2025</li></ul><p>&nbsp;</p><p><strong>KELAS ONLINE :</strong></p><ul><li>REGULER (SENIN S/D KAMIS 18.30 - 20.45) MULAI 14 APRIL 2025</li><li>WEEKEND PAGI (SABTU S/D MINGGU 09.00 - 13.00) MULAI 26 APRIL 2025</li></ul>', 'uploads/QO8sy4R6FHjLYRdC0FEN0qqaYptzkZartmJxG7zJ.jpg', 1, '2025-03-05 18:12:51', '2025-03-11 12:53:11'),
(2, 'Brevet C Terpadu', 'brevet-c-terpadu', '<p>PROMO RAMADHAN &amp; LEBARAN</p><p>PERIODE PENDAFTARAN 1 - 22 MARET 2025</p><p><strong>BIAYA :&nbsp;</strong></p><ul><li>UMUM RP.3.000.000 (NORMAL RP.3.500.000)</li><li>ALUMNI RP.2.500.000 (NORMAL RP.3.000.000)</li></ul><p>&nbsp;</p><p><strong>KELAS TATAP MUKA :&nbsp;</strong></p><p>WEEKEND SABTU 14.00 - 17.30 &amp; MINGGU 09.00 - 13.00 (MULAI KELAS 19 APRIL 2025)</p>', 'uploads/iHJPiphhVn9LGO5l3Yg6CpUZMcSCpnvaavMZDdCE.jpg', 1, '2025-03-05 18:14:14', '2025-03-11 10:43:23'),
(3, 'Praktik Eksklusif CORETAX 2025', 'praktik-eksklusif-coretax-2025', '<p>MEMAHAMI IMPLEMENTASI CORETAX, PANDUAN PRAKTIS PELAPORAN SPT TAHUNAN PPH PADAN DAN REKONSILIASI FISKAL, SERTA UPDATE PERATURAN PERPAJAKAN</p><p><strong>Materi :</strong></p><ol><li>PANDUAN PRAKTIS PENGGUNAAN APLIKASI CORETAX : REGISTRASI, E-FAKTUR, E-BUPOT, SURAT PEMBERITAHUAN (SPT) DAN PEMBAYARAN</li><li>TEKNIK DAN PERSIAPAN PENGISIAN SPT TAHUNAN PPH BADAN</li><li>KONSEP DAN STUDY KASUS REKONSILIASI FISKAL</li><li>PMK 81 TAHUN 2024 TENTANG KETENTUAN PAJAK TERKAIT CORETAX</li></ol><p><strong>Pelaksanaan :</strong></p><ul><li>Minggu, 9 Maret 2025</li><li>10.00 WIB - selesai</li><li>Jln. Asia Afrika 112 HOTEL SAVOY HOMANN BANDUNG</li></ul><p>&nbsp;</p><p><strong>Investasi :</strong></p><ul><li>UMUM Rp.1.250.000</li><li>ALUMNI Rp.1.000.000</li></ul><p>&nbsp;</p><p><strong>Benefit :</strong></p><ul><li>Buka Puasa Bersama</li><li>Modul</li><li>Sertifikat</li></ul><p>&nbsp;</p><p>Note : <strong>Terbatas untuk 20 peserta</strong></p><p><strong>Sisa Kuota (5 peserta)</strong></p>', 'uploads/jCb9llVYeRrNRcf85JPCoicDpgmlvxuIQxNM9tL5.jpg', 4, '2025-03-06 23:02:19', '2025-03-14 02:16:41'),
(4, 'Pelatihan Akuntansi Terapan & Akun Pajak (Gelombang 4)', 'pelatihan-akuntansi-terapan-akun-pajak-gelombang-4', '<p><i>Pembelajaran Inovatif, RAHASIA menguasai ilmu akuntansi dengan mudah, tanpa beban, dan tanpa menghafal, menjadikan Peserta Percaya diri dengan tugas akuntansi.</i></p><p><strong>Pembahasan tersebut meliputi :</strong></p><ul><li>Konsep Akuntansi</li><li>Logika Pencatatan</li><li>Fundamental Chart of Account (CoA)</li><li>Penyusunan Laporan Keuangan</li><li>Akuntansi Perpajakan</li><li>Rekonsiliasi Fiskal dan SPT</li></ul><p>&nbsp;</p><p><strong>Instruktur : </strong>Eko Sardjono, S.E., M.Si., CTT, CPTT, CTA (Praktisi Pajak dan Akuntansi - Instruktur bersertifikasi KKNI)</p><p>Biaya : Rp750.000</p><p>6x pertemuan (Sabtu &amp; Minggu 09.00 s/d 12.30)</p><p>Tanggal 3 Mei 2025 s/d 18 Mei 2025&nbsp;</p>', 'uploads/X9S6lhkYMQohrdkknhq2lQfFXBYZArQG5koeZczl.jpg', 2, '2025-03-07 14:29:26', '2025-03-12 07:48:07'),
(5, 'Sertifikasi CTT', 'sertifikasi-ctt', '<p>TACTICTAX BEKERJASAMA DENGAN ASOSIASI TEKNISI PERPAJAKAN INDONESIA (ATPI)</p><p>Menyelenggarakan kompetensi dan register untuk gelar CTT (Certified Tax Technician)</p><p><strong>Syarat:</strong></p><ol><li>Min Pendidikan D3/SMA/SMK (Untuk SMA / SMK min. 5 tahun bekerja dibidang Akunting - Pajak)</li><li>CTT memiliki Sertifikat Brevet A-B</li></ol><p>Sistem Pelaksanaan : <strong>1 hari Ujian</strong> + Pembahasan</p><p>Pelaksanaan : <strong>15 Februari 2025</strong></p><p>Di kampus TAC TIC TAX</p>', 'uploads/mJz7O5q6wdK8wFHNX5KwpV3NJDAkxxPKyTbX3wIY.jpg', 3, '2025-03-07 17:10:50', '2025-03-11 12:35:05'),
(6, 'Sertifikasi CPTT', 'sertifikasi-cptt', '<p>TACTICTAX BEKERJASAMA DENGAN ASOSIASI TEKNISI PERPAJAKAN INDONESIA (ATPI)</p><p>Menyelenggarakan kompetensi dan register untuk gelar CPTT (Certified Professional Tax Technician)</p><p><strong>Syarat:</strong></p><ol><li>Min Pendidikan D3/SMA/SMK (Untuk SMA / SMK min. 5 tahun bekerja dibidang Akunting - Pajak)</li><li>CPTT memiliki Sertifikat Brevet C</li></ol><p>Sistem Pelaksanaan : <strong>1 hari Ujian</strong> + Pembahasan</p><p>Pelaksanaan : <strong>15 Februari 2025</strong></p><p>Di kampus TAC TIC TAX</p>', 'uploads/owfHyi6ZWytJtHwm47aC1sOuNZIlHXahPLPubPxl.jpg', 3, '2025-03-07 17:11:55', '2025-03-12 07:09:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_01_094747_create_siswas_table', 1),
(5, '2025_03_05_170229_create_kategori_table', 1),
(6, '2025_03_05_172055_create_layanan_table', 1),
(7, '2025_03_06_184508_create_kontak_table', 1),
(8, '2025_03_09_195919_create_email_verifications_table', 2),
(9, '2025_03_11_171314_add_gambar_to_layanans_table', 2),
(10, '2025_03_13_105435_create_testimoni_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('doFUCBw7Ldr2mMTf1tDxQacjVfHRrE2EV9WGFqy5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM2NhODB1TFUzQllaN0dCVERBZlFPMHIxaTZqMGRmUFFqQjBtSDNMOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly90YWN0aWN0YXgudGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjE6e2k6MDtzOjc6InN1Y2Nlc3MiO31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo3OiJzdWNjZXNzIjtzOjIwOiJBbmRhIGJlcmhhc2lsIGxvZ2luISI7fQ==', 1742451409),
('qM6JSlknFaYmljP1kxA8Z3HOxVXjV6VAixEBiT3m', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT3RkYXJEemxTYzJwQ05CWDZLUVNrelZ4TXNYM0pKWklsM3FJaDNXMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly90YWN0aWN0YXgudGVzdC91c2VyYWNjb3VudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1742452339);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `pesan`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'Agung', 'Untuk tampilan websitenya sangat menarik, serta penggunaannya mudah dipahami dan tanpa ada kendala', 5, '2025-03-13 04:38:38', '2025-03-13 04:39:44'),
(2, 'Boedi Andoek', 'Untuk layanan terbarunya perlu ditambahkan ya', 4, '2025-03-13 05:29:26', '2025-03-14 01:23:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$ITO2GCW5qBYd79y78qMimOxgtReKbh9WM3mVt5EuvKkfwOP1qcWDy', 'admin', '2025-03-09 14:21:58', '2025-03-11 14:22:24'),
(2, 'user', '$2y$12$5PyugRKHq/t6NByjNSQ14uvuRLf6hQh/4QFiLiu6eB2NBxUa2Mv9S', 'user', '2025-03-09 14:21:58', '2025-03-11 15:04:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_nama_unique` (`nama`),
  ADD UNIQUE KEY `kategori_slug_unique` (`slug`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `layanan_slug_unique` (`slug`),
  ADD KEY `layanan_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD CONSTRAINT `layanan_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

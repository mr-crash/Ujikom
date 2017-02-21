-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10 Feb 2017 pada 10.18
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crash_penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongans`
--

CREATE TABLE `golongans` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_golongan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_golongan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tunjangan_uang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `golongans`
--

INSERT INTO `golongans` (`id`, `kode_golongan`, `nama_golongan`, `tunjangan_uang`, `created_at`, `updated_at`) VALUES
(1, 'G_001', 'Kaya', 1000000, '2017-02-06 02:57:23', '2017-02-06 02:57:23'),
(2, 'G_002', 'Sederhana', 2000000, '2017-02-06 02:57:23', '2017-02-06 02:57:23'),
(3, 'G_003', 'Miskin', 3000000, '2017-02-06 02:57:23', '2017-02-06 02:57:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatans`
--

CREATE TABLE `jabatans` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tunjangan_uang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jabatans`
--

INSERT INTO `jabatans` (`id`, `kode_jabatan`, `nama_jabatan`, `tunjangan_uang`, `created_at`, `updated_at`) VALUES
(1, 'J_001', 'Manager', 5000000, '2017-02-06 02:57:22', '2017-02-06 02:57:22'),
(2, 'J_002', 'Staff', 250000, '2017-02-06 02:57:22', '2017-02-06 02:57:22'),
(3, 'J_003', 'Officer', 1500000, '2017-02-06 02:57:22', '2017-02-06 02:57:22'),
(4, 'J_004', 'Employee', 1000000, '2017-02-06 02:57:23', '2017-02-06 02:57:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_lemburs`
--

CREATE TABLE `kategori_lemburs` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_lembur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_id` int(10) UNSIGNED NOT NULL,
  `golongan_id` int(10) UNSIGNED NOT NULL,
  `besaran_uang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kategori_lemburs`
--

INSERT INTO `kategori_lemburs` (`id`, `kode_lembur`, `jabatan_id`, `golongan_id`, `besaran_uang`, `created_at`, `updated_at`) VALUES
(1, 'KL_001', 1, 1, 500000, '2017-02-06 02:57:23', '2017-02-06 02:57:23'),
(2, 'KL_002', 2, 2, 1000000, '2017-02-06 02:57:23', '2017-02-06 02:57:23'),
(3, 'KL_003', 4, 3, 10000000, '2017-02-06 02:57:23', '2017-02-06 02:57:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur_pegawais`
--

CREATE TABLE `lembur_pegawais` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_lembur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kategori_lembur_id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `jumlah_jam` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `lembur_pegawais`
--

INSERT INTO `lembur_pegawais` (`id`, `kode_lembur`, `kategori_lembur_id`, `pegawai_id`, `jumlah_jam`, `created_at`, `updated_at`) VALUES
(1, 'L_001', 1, 1, 15, '2017-02-09 18:33:00', '2017-02-09 18:33:00'),
(2, 'L_002', 1, 1, 14, '2017-02-09 18:34:27', '2017-02-09 21:37:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(146, '2014_10_12_000000_create_users_table', 1),
(147, '2014_10_12_100000_create_password_resets_table', 1),
(148, '2017_01_30_151708_create_jabatans_table', 1),
(149, '2017_01_30_152311_create_golongans_table', 1),
(150, '2017_01_30_152500_create_kategori_lemburs_table', 1),
(151, '2017_01_30_152655_create_tunjangans_table', 1),
(152, '2017_01_30_153422_create_pegawais_table', 1),
(153, '2017_01_30_154547_create_lembur_pegawais_table', 1),
(154, '2017_01_30_160016_create_tunjangan_pegawais_table', 1),
(155, '2017_01_30_160748_create_penggajians_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jabatan_id` int(10) UNSIGNED NOT NULL,
  `golongan_id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `nip`, `user_id`, `jabatan_id`, `golongan_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'P_001', 1, 1, 1, 'manager.jpg', '2017-02-06 02:57:23', '2017-02-06 02:57:23'),
(2, 'P_002', 2, 3, 2, '2_Mr.0ff1c3r_anonymous_by_zaysancho-d3aqimh-600x711.png', '2017-02-06 02:57:23', '2017-02-06 21:40:11'),
(3, 'P_003', 3, 4, 3, 'employee.jpg', '2017-02-06 02:57:23', '2017-02-06 02:57:23'),
(7, 'P_004', 19, 1, 1, '19_Anonymouse_b23b1fdc305d19dedc8e25ba214dd678.jpeg.jpg', '2017-02-06 11:18:03', '2017-02-06 21:53:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajians`
--

CREATE TABLE `penggajians` (
  `id` int(10) UNSIGNED NOT NULL,
  `tunjangan_pegawai_id` int(10) UNSIGNED NOT NULL,
  `jumlah_jam_lembur` int(11) NOT NULL,
  `jumlah_uang_lembur` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `total_gaji` int(11) NOT NULL,
  `tanggal_pengambilan` date NOT NULL,
  `status_pengambilan` int(11) NOT NULL,
  `petugas_penerima` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangans`
--

CREATE TABLE `tunjangans` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_tunjangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jabatan_id` int(10) UNSIGNED NOT NULL,
  `golongan_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `besaran_uang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tunjangans`
--

INSERT INTO `tunjangans` (`id`, `kode_tunjangan`, `jabatan_id`, `golongan_id`, `status`, `jumlah_anak`, `besaran_uang`, `created_at`, `updated_at`) VALUES
(1, 'T_001', 1, 2, 'belum nikah', 0, 500000, NULL, NULL),
(2, 'T_002', 1, 1, 'sudah nikah', 1, 500000, NULL, NULL),
(3, 'T_003', 3, 3, 'sudah nikah', 4, 1000000, NULL, NULL),
(4, 'T_004', 2, 2, 'nikah', 3, 4000000, '2017-02-10 01:03:04', '2017-02-10 01:03:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangan_pegawais`
--

CREATE TABLE `tunjangan_pegawais` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_tunjangan_id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `type_user`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr.4dm1n', 'admin', 'mr@admin.crash', '$2y$10$SN9VFnhyf5n0glW6TJZAd.6Zl8XJIlzWjUJsFBrpfsq.yRLukiFRu', 'Nd8Vpd2pZjNyfDJBZNHtgJ1wFcXS8wlh6yXuAdQOC4xzbQuVvoGBC4OKfae3', '2017-02-06 02:57:22', '2017-02-07 00:04:03'),
(2, 'Mr.0ff1c3r', 'officer', 'mr@officer.crash', '$2y$10$xB37GhbVIGNKhLDl8JQ0g.e2lHL93Cmm2RFyKoHCUt8PuHZJCPpXO', NULL, '2017-02-06 02:57:22', '2017-02-06 02:57:22'),
(3, 'Mr.3mpl0ye3', 'employee', 'mr@employee.crash', '$2y$10$yAbWMPwxiOoBSspvnop4beSdX9FVXDu6pTsk7DA2e7NWLXule1CWu', NULL, '2017-02-06 02:57:22', '2017-02-06 02:57:22'),
(19, 'Anonymouse', 'admin', 'anonymouse@account.com', '$2y$10$Hu9pZ9dr8ycsv9vwacSMIOn49v3MZ2dNk7GUN3xW5zzZLj0/TQtz6', '1irSRw78xmPLKeBS7wyoD30OxySEKRRT12mZwsVdH01bCufFTR56iMKZMfeK', '2017-02-06 11:18:03', '2017-02-06 23:26:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `golongans`
--
ALTER TABLE `golongans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `golongans_kode_golongan_unique` (`kode_golongan`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatans_kode_jabatan_unique` (`kode_jabatan`);

--
-- Indexes for table `kategori_lemburs`
--
ALTER TABLE `kategori_lemburs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_lemburs_kode_lembur_unique` (`kode_lembur`),
  ADD KEY `kategori_lemburs_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `kategori_lemburs_golongan_id_foreign` (`golongan_id`);

--
-- Indexes for table `lembur_pegawais`
--
ALTER TABLE `lembur_pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lembur_pegawais_kode_lembur_unique` (`kode_lembur`),
  ADD KEY `lembur_pegawais_kategori_lembur_id_foreign` (`kategori_lembur_id`),
  ADD KEY `lembur_pegawais_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_nip_unique` (`nip`),
  ADD KEY `pegawais_user_id_foreign` (`user_id`),
  ADD KEY `pegawais_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `pegawais_golongan_id_foreign` (`golongan_id`);

--
-- Indexes for table `penggajians`
--
ALTER TABLE `penggajians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penggajians_tunjangan_pegawai_id_foreign` (`tunjangan_pegawai_id`);

--
-- Indexes for table `tunjangans`
--
ALTER TABLE `tunjangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tunjangans_kode_tunjangan_unique` (`kode_tunjangan`),
  ADD KEY `tunjangans_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `tunjangans_golongan_id_foreign` (`golongan_id`);

--
-- Indexes for table `tunjangan_pegawais`
--
ALTER TABLE `tunjangan_pegawais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tunjangan_pegawais_kode_tunjangan_id_foreign` (`kode_tunjangan_id`),
  ADD KEY `tunjangan_pegawais_pegawai_id_foreign` (`pegawai_id`);

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
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kategori_lemburs`
--
ALTER TABLE `kategori_lemburs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lembur_pegawais`
--
ALTER TABLE `lembur_pegawais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `penggajians`
--
ALTER TABLE `penggajians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tunjangans`
--
ALTER TABLE `tunjangans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tunjangan_pegawais`
--
ALTER TABLE `tunjangan_pegawais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kategori_lemburs`
--
ALTER TABLE `kategori_lemburs`
  ADD CONSTRAINT `kategori_lemburs_golongan_id_foreign` FOREIGN KEY (`golongan_id`) REFERENCES `golongans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_lemburs_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lembur_pegawais`
--
ALTER TABLE `lembur_pegawais`
  ADD CONSTRAINT `lembur_pegawais_kategori_lembur_id_foreign` FOREIGN KEY (`kategori_lembur_id`) REFERENCES `kategori_lemburs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lembur_pegawais_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_golongan_id_foreign` FOREIGN KEY (`golongan_id`) REFERENCES `golongans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawais_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawais_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggajians`
--
ALTER TABLE `penggajians`
  ADD CONSTRAINT `penggajians_tunjangan_pegawai_id_foreign` FOREIGN KEY (`tunjangan_pegawai_id`) REFERENCES `tunjangan_pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tunjangans`
--
ALTER TABLE `tunjangans`
  ADD CONSTRAINT `tunjangans_golongan_id_foreign` FOREIGN KEY (`golongan_id`) REFERENCES `golongans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tunjangans_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tunjangan_pegawais`
--
ALTER TABLE `tunjangan_pegawais`
  ADD CONSTRAINT `tunjangan_pegawais_kode_tunjangan_id_foreign` FOREIGN KEY (`kode_tunjangan_id`) REFERENCES `tunjangans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tunjangan_pegawais_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

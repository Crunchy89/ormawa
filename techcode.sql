-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2021 at 11:05 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 1),
(9, 3, 1),
(11, 1, 6),
(12, 1, 7),
(14, 2, 8),
(15, 3, 8),
(16, 1, 8),
(17, 2, 9),
(18, 3, 9),
(19, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `udpated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `uuid`, `menu`, `created_at`, `udpated_at`) VALUES
(1, '484f2f7b-309e-11ec-8876-34e6d722c12d', 'dashboard', '2021-10-19 05:34:51', '2021-10-19 05:35:02'),
(3, '54d0d13b-309e-11ec-8876-34e6d722c12d', 'role', '2021-10-19 05:35:12', '2021-10-19 05:35:12'),
(4, '5728229b-309e-11ec-8876-34e6d722c12d', 'user', '2021-10-19 05:35:16', '2021-10-19 05:35:16'),
(5, '59d92b0f-309e-11ec-8876-34e6d722c12d', 'pengaturan', '2021-10-19 05:35:21', '2021-10-19 05:35:26'),
(6, 'dc1cf65a-332f-11ec-949b-34e6d722c12d', 'ukm', '2021-10-22 12:01:59', '2021-10-22 12:01:59'),
(7, 'baa77296-34b8-11ec-a67b-34e6d722c12d', 'pembimbing', '2021-10-24 10:54:12', '2021-10-24 10:54:12'),
(8, 'ae9fe706-34c4-11ec-a67b-34e6d722c12d', 'menu_ukm', '2021-10-24 12:19:45', '2021-10-24 12:19:45'),
(9, 'f03ea8dc-3631-11ec-9e2b-34e6d722c12d', 'berita', '2021-10-26 07:54:25', '2021-10-26 07:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `poin_get`
--

CREATE TABLE `poin_get` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poin` int(11) UNSIGNED NOT NULL COMMENT 'nilai poin',
  `keterangan` text NOT NULL COMMENT 'keterangan kegiatan yg diikuti sehinga mendapatkan poin',
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'id user yang mendapatkan poin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poin_use`
--

CREATE TABLE `poin_use` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poin` int(11) NOT NULL COMMENT 'poin yang dipakai',
  `keterangan` text NOT NULL COMMENT 'keterangan penggunaan poin',
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'id user pengguna poin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `role` varchar(20) NOT NULL COMMENT 'Level User',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'apakah role bisa menghapus data',
  `can_edit` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'apakah role bisa mengedit data',
  `can_insert` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'apakah role bisa mengedit data',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'soft delete',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `uuid`, `role`, `can_delete`, `can_edit`, `can_insert`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'ba6e3a04-302d-11ec-bbc5-34e6d722c12d', 'SuperAdmin', 1, 1, 1, 0, '2021-10-18 06:11:50', '2021-10-18 16:09:11'),
(2, '68265b1a-305f-11ec-bbc5-34e6d722c12d', 'Dosen', 1, 1, 1, 0, '2021-10-18 22:04:41', '2021-10-23 02:43:24'),
(3, 'cb2363a7-3091-11ec-bbc5-34e6d722c12d', 'Mahasiswa', 0, 1, 1, 0, '2021-10-19 04:05:22', '2021-10-23 02:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `ukm`
--

CREATE TABLE `ukm` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL COMMENT 'uuid',
  `slug` varchar(255) NOT NULL COMMENT 'slug',
  `nama_ukm` varchar(255) NOT NULL COMMENT 'nama ukm',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'ukm aktif atau tidak',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukm`
--

INSERT INTO `ukm` (`id`, `uuid`, `slug`, `nama_ukm`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '3cdd9b69-33ab-11ec-a6ad-34e6d722c12d', 'UKM-Pemrograman', 'UKM Pemrograman', 1, '2021-10-23 02:45:09', '2021-10-24 10:48:50'),
(2, 'a8c272c5-33ae-11ec-a6ad-34e6d722c12d', 'UKM-Gumpala', 'UKM Gumpala', 1, '2021-10-23 03:09:39', '2021-10-23 03:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `ukm_aggota`
--

CREATE TABLE `ukm_aggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_anggota` varchar(50) NOT NULL COMMENT 'nomor anggota masing masing ukm',
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'id user pengguna',
  `ukm_id` int(11) UNSIGNED NOT NULL COMMENT 'id ukm anggota',
  `tanggal` date NOT NULL COMMENT 'tanggal masuk sekaligus sebagai tahun angkatan masuk',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user masih aktif sebagai anggota atau tidak',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ukm_jabatan`
--

CREATE TABLE `ukm_jabatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukm_jabatan`
--

INSERT INTO `ukm_jabatan` (`id`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Ketua', '2021-10-24 10:00:11', '2021-10-24 10:00:11'),
(2, 'Wakil Ketua', '2021-10-24 10:00:11', '2021-10-24 10:00:11'),
(3, 'Sekretaris', '2021-10-24 10:00:26', '2021-10-24 10:00:26'),
(4, 'Bendahara', '2021-10-24 10:00:26', '2021-10-24 10:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `ukm_pembimbing`
--

CREATE TABLE `ukm_pembimbing` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'user id penguna',
  `ukm_id` int(11) UNSIGNED NOT NULL COMMENT 'ukm id yang akan dibimbing',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'masih aktif sebagai pembimbing atau tidak',
  `tanggal` date NOT NULL COMMENT 'tangal diangkat sebagai pembimbing\r\n',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukm_pembimbing`
--

INSERT INTO `ukm_pembimbing` (`id`, `user_id`, `ukm_id`, `is_active`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2021-10-24', '2021-10-24 11:57:29', '2021-10-24 12:07:03'),
(5, 3, 2, 1, '2021-10-17', '2021-10-24 12:08:34', '2021-10-24 12:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `ukm_pengurus`
--

CREATE TABLE `ukm_pengurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL COMMENT 'user id anggota',
  `ukm_id` int(11) UNSIGNED NOT NULL COMMENT 'ukm_id anggota',
  `jabatan_id` int(11) UNSIGNED NOT NULL COMMENT 'jabatan dalam ukm',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'masih aktif atau tidak',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'id role untuk level akses',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'cek akun aktif',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'soft delete',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uuid`, `username`, `password`, `email`, `nama`, `role_id`, `is_active`, `is_deleted`, `created_at`, `updated`) VALUES
(1, '59b129ee-306e-11ec-bbc5-34e6d722c12d', 'superadministrator', '$2y$10$hbuWbzLa0J6XZHl6NqttQOYL4LhFMQ.b5bn8B0q/0BFbCe5Kk9JGu', 'admin@gmail.com', 'Administrator', 1, 1, 0, '2021-10-18 23:51:40', '2021-10-26 07:53:09'),
(2, '1c428aa6-34bd-11ec-a67b-34e6d722c12d', 'haerul', '$2y$10$tUkHiiE8PCMLp89EKJfhTe3tuI.j9HzOk49cJG0FH2xwq/13kG.GS', 'haerul@gmail.com', 'Haerul Fahmi, S.Kom, M.Kom', 2, 1, 0, '2021-10-24 11:25:33', '2021-10-24 11:25:33'),
(3, '063109ab-34c3-11ec-a67b-34e6d722c12d', 'saleh', '$2y$10$W9xOdKJSLFr33EbaM1S28.A9T5ngwZxWZow0ITinlgry8qzzQsrau', 'saleh@gmail.com', 'Maemun Saleh, S.Kom', 2, 1, 0, '2021-10-24 12:07:53', '2021-10-24 12:07:53'),
(5, 'd8c19ec3-3631-11ec-9e2b-34e6d722c12d', 'TI14170013', '$2y$10$79jb9U6lm6UJI8C571rQpu6mIoVpJmUGzTPSrnqoJr7RTBEBAFY5q', 'rocker.hunt@gmail.com', 'Ferdy Barliansyah R.', 3, 1, 0, '2021-10-26 07:53:45', '2021-10-26 07:53:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_fk_menu` (`menu_id`),
  ADD KEY `akses_fk_role` (`role_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poin_get`
--
ALTER TABLE `poin_get`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poin_get_fk_user` (`user_id`);

--
-- Indexes for table `poin_use`
--
ALTER TABLE `poin_use`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poin_use_fk_user` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `ukm`
--
ALTER TABLE `ukm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `ukm_aggota`
--
ALTER TABLE `ukm_aggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_anggota` (`no_anggota`),
  ADD KEY `anggota_fk_user` (`user_id`),
  ADD KEY `anggota_fk_ukm` (`ukm_id`);

--
-- Indexes for table `ukm_jabatan`
--
ALTER TABLE `ukm_jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan` (`jabatan`);

--
-- Indexes for table `ukm_pembimbing`
--
ALTER TABLE `ukm_pembimbing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembimbing_fk_user` (`user_id`),
  ADD KEY `pembimbing_fk_ukm` (`ukm_id`);

--
-- Indexes for table `ukm_pengurus`
--
ALTER TABLE `ukm_pengurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengurus_fk_ukm` (`ukm_id`),
  ADD KEY `pengurus_fk_user` (`user_id`),
  ADD KEY `pengurus_fk_jabatan` (`jabatan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_fk_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `poin_get`
--
ALTER TABLE `poin_get`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poin_use`
--
ALTER TABLE `poin_use`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ukm`
--
ALTER TABLE `ukm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ukm_aggota`
--
ALTER TABLE `ukm_aggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ukm_jabatan`
--
ALTER TABLE `ukm_jabatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ukm_pembimbing`
--
ALTER TABLE `ukm_pembimbing`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ukm_pengurus`
--
ALTER TABLE `ukm_pengurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_fk_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_fk_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poin_get`
--
ALTER TABLE `poin_get`
  ADD CONSTRAINT `poin_get_fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poin_use`
--
ALTER TABLE `poin_use`
  ADD CONSTRAINT `poin_use_fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ukm_aggota`
--
ALTER TABLE `ukm_aggota`
  ADD CONSTRAINT `anggota_fk_ukm` FOREIGN KEY (`ukm_id`) REFERENCES `ukm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anggota_fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ukm_pembimbing`
--
ALTER TABLE `ukm_pembimbing`
  ADD CONSTRAINT `pembimbing_fk_ukm` FOREIGN KEY (`ukm_id`) REFERENCES `ukm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembimbing_fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ukm_pengurus`
--
ALTER TABLE `ukm_pengurus`
  ADD CONSTRAINT `pengurus_fk_jabatan` FOREIGN KEY (`jabatan_id`) REFERENCES `ukm_jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengurus_fk_ukm` FOREIGN KEY (`ukm_id`) REFERENCES `ukm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengurus_fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_fk_role` FOREIGN KEY (`role_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

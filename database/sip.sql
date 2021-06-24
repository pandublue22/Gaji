-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 05:14 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `idgaji` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `golongan_id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `tunjangan` int(11) DEFAULT NULL,
  `jam_lembur` int(11) NOT NULL,
  `uang_lembur` int(11) NOT NULL,
  `gaji_bersih` int(11) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`idgaji`, `pegawai_id`, `golongan_id`, `tanggal`, `potongan`, `tunjangan`, `jam_lembur`, `uang_lembur`, `gaji_bersih`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(4, 1, 1, '2019-12-01', 100000, 250000, 0, 0, 5050000, 1575969848, 1, NULL, NULL),
(5, 6, 2, '2019-12-02', 100000, 250000, 0, 0, 4050000, 1576357174, 1, NULL, NULL),
(6, 7, 3, '2019-12-03', 100000, 250000, 0, 0, 3050000, 1576357612, 1, NULL, NULL),
(15, 7, 2, '2021-05-04', 15, 5000, 2, 25000, 4054985, 1620615999, 1, NULL, NULL),
(16, 1, 11, '2021-05-04', 50000, 5000, 1, 25000, 79000, 1621058269, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `idgolongan` int(11) NOT NULL,
  `golongan` varchar(45) DEFAULT NULL,
  `gaji_pokok` int(11) DEFAULT NULL,
  `korpri` int(11) DEFAULT NULL,
  `kristiani` int(11) DEFAULT NULL,
  `muslim` int(11) DEFAULT NULL,
  `dh_wanita` int(11) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`idgolongan`, `golongan`, `gaji_pokok`, `korpri`, `kristiani`, `muslim`, `dh_wanita`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'A', 5000000, 6, 0, 0, 0, 1575920993, 1, 1620304673, 1),
(2, 'B', 4000000, 6, 0, 0, 0, 1575921366, 1, 1620304696, 1),
(3, 'C', 3000000, 0, 0, 0, 0, 1575921382, 1, NULL, NULL),
(8, 'D', 10000, 1, 0, 0, 0, 1620301167, 1, 1620349283, 1),
(11, 'j', 1000, 10, 5, 2, 1, 1620305429, 1, 1620438913, 1),
(12, 'r', 50000000, 2000, 9000, 8000, 20, 1621058334, 1, 1621060636, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(11) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `agama` enum('Islam','Kristen Protestan','Kristen Katolik','Hindu','Budha','Konghucu') DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `nip`, `nama`, `jk`, `agama`, `telp`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, '19860926 201505 1 001', 'Eka Saputra A', 'Laki-Laki', 'Islam', '082248577297', 1575916921, 1, 1618283844, 1),
(6, '11111111 111111 1 111', 'Eka Saputra C', 'Laki-Laki', 'Kristen Protestan', '082248577297', 1575920127, 1, 1575924541, 1),
(7, '11111111 111111 1 002', 'Eka Saputra B', 'Laki-Laki', 'Kristen Katolik', '082248577297', 1575920143, 1, 1575924508, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(100) NOT NULL,
  `variable` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `default` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `group`, `variable`, `value`, `default`, `description`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'company_profile', 'company_name', 'Sistem Informasi Penggajian', 'Nokencode', 'Nama Instansi', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(2, 'company_profile', 'headmaster', 'Administrator', 'Nokencode', 'Kepala Instansi', '2018-04-02 01:51:58', '0000-00-00 00:00:00', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(3, 'company_profile', 'rt', NULL, '12', 'RT', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(4, 'company_profile', 'rw', NULL, '06', 'RW', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(5, 'company_profile', 'village', NULL, 'Waraitama', 'Kelurahan / Desa', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(6, 'company_profile', 'sub_district', NULL, 'Manimeri', 'Kecamatan', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(7, 'company_profile', 'district', NULL, 'Teluk Bintuni', 'Kabupaten', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(8, 'company_profile', 'postal_code', NULL, '98364', 'Kode Pos', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(9, 'company_profile', 'street_address', NULL, 'Jalur 5 SP 1 Kampung Waraitama', 'Alamat Jalan', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(10, 'company_profile', 'phone', NULL, '+62 822 4857 7297', 'Telepon', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(11, 'company_profile', 'fax', NULL, '0232123456', 'Fax', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(12, 'company_profile', 'email', NULL, 'nokencode@gmail.com', 'Email', '2018-04-02 01:51:58', '2019-10-28 01:52:31', NULL, NULL, NULL, 1, NULL, NULL, 'false'),
(13, 'company_profile', 'website', NULL, 'https://nokencode.com', 'Website', '2018-04-02 01:51:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  `user_fullname` varchar(128) DEFAULT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `user_type` enum('super_user','administrator','user') DEFAULT NULL,
  `user_profile_id` int(11) DEFAULT NULL,
  `user_forgot_password_key` varchar(128) DEFAULT NULL,
  `user_forgot_password_date` int(11) DEFAULT NULL,
  `last_loggin` int(11) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `is_block` int(1) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `delete_at` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `user_name`, `user_password`, `user_fullname`, `user_email`, `user_group_id`, `user_type`, `user_profile_id`, `user_forgot_password_key`, `user_forgot_password_date`, `last_loggin`, `ip_address`, `is_active`, `is_block`, `create_at`, `update_at`, `delete_at`, `create_by`, `update_by`, `delete_by`) VALUES
(1, 'admin', '$2y$10$VQiOGUbjA2c3mXCYBmp2NeOFvHP/Yl6plHdas/WHNaUVlhuz2hnsO', 'Noken Code', 'nokencode@gmail.com', NULL, 'super_user', NULL, NULL, NULL, 1621133168, '127.0.0.1', 1, 0, 1556509343, NULL, NULL, 1, NULL, NULL),
(6, '198609262015051001', '$2y$10$TBvoCU3.mQZU7jQC58g4PuAy8ppxUrH./gunqthHaGdDxlominkSu', 'Eka Saputra', 'admin@gmail.com', NULL, 'administrator', NULL, NULL, NULL, 1575965120, '::1', 1, 0, 1575964357, 1575965108, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_sessions`
--

CREATE TABLE `_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_sessions`
--

INSERT INTO `_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('9hd016kivl8m6n5v2v1ejqp79u75nns3', '127.0.0.1', 1621060638, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632313036303437323b656d61696c7c733a31393a226e6f6b656e636f646540676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b),
('aeeqcfcvvjekk04clt4ac9uh9t7f3q7t', '127.0.0.1', 1621045013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632313033393937373b656d61696c7c733a31393a226e6f6b656e636f646540676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b),
('faeck31bmer3u8rmvn2ls6k6g2atg1ac', '127.0.0.1', 1621133239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632313133333033323b656d61696c7c733a31393a226e6f6b656e636f646540676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b),
('hcb48c6ngc9t26lggvr0c9q1qbtj6bc4', '127.0.0.1', 1620625797, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303632353737383b656d61696c7c733a31393a226e6f6b656e636f646540676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b6163636573737c733a31303a2273757065725f75736572223b);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`idgaji`),
  ADD KEY `fk_gaji_pegawai_idx` (`pegawai_id`),
  ADD KEY `fk_gaji_golongan1_idx` (`golongan_id`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`idgolongan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_field` (`group`,`variable`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- Indexes for table `_sessions`
--
ALTER TABLE `_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_TIMESTAMP` (`timestamp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `idgaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `idgolongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `fk_gaji_golongan1` FOREIGN KEY (`golongan_id`) REFERENCES `golongan` (`idgolongan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gaji_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`idpegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 04:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppl_studyfyif`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`nama`, `fakultas`, `username`) VALUES
('testdpt', 'Sains & Matematika', 'testdpt');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kode_kab` varchar(255) DEFAULT NULL,
  `kode_prov` varchar(255) DEFAULT NULL,
  `handphone` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `email`, `alamat`, `kode_kab`, `kode_prov`, `handphone`, `status`, `foto`, `username`) VALUES
(123, 'testdsn', 'testdsn@gmail.com', 'test', '1234', '123', '12345678', 'Aktif 2023', 'gambar.jpg', 'testdsn');

-- --------------------------------------------------------

--
-- Table structure for table `entry_progress`
--

CREATE TABLE `entry_progress` (
  `nim` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `semester_aktif` varchar(255) NOT NULL,
  `is_irs` tinyint(1) NOT NULL DEFAULT 0,
  `is_khs` tinyint(1) NOT NULL DEFAULT 0,
  `is_pkl` tinyint(1) NOT NULL DEFAULT 0,
  `is_skripsi` tinyint(1) NOT NULL DEFAULT 0,
  `is_verifikasi` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irs`
--

CREATE TABLE `irs` (
  `nim` int(11) NOT NULL,
  `semester_aktif` int(11) NOT NULL,
  `sks` int(11) NOT NULL,
  `upload_irs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kab`
--

CREATE TABLE `kab` (
  `kode_kab` varchar(255) NOT NULL,
  `kode_prov` varchar(255) NOT NULL,
  `nama_kab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kab`
--

INSERT INTO `kab` (`kode_kab`, `kode_prov`, `nama_kab`) VALUES
('1234', '123', 'Semarang'),
('12345', '1234', 'Jambi'),
('123456', '12345', 'Sabang'),
('1234567', '123456', 'Blitar'),
('12345678', '123', 'Jepara');

-- --------------------------------------------------------

--
-- Table structure for table `khs`
--

CREATE TABLE `khs` (
  `nim` int(11) NOT NULL,
  `semester_aktif` int(11) NOT NULL,
  `sks` int(11) NOT NULL,
  `sks_kumulatif` int(11) NOT NULL,
  `ip` double(8,2) NOT NULL,
  `ip_kumulatif` double(8,2) NOT NULL,
  `upload_khs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kode_kab` varchar(255) DEFAULT NULL,
  `kode_prov` varchar(255) DEFAULT NULL,
  `angkatan` int(11) NOT NULL,
  `jalur_masuk` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `handphone` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `kode_wali` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `kode_kab`, `kode_prov`, `angkatan`, `jalur_masuk`, `email`, `handphone`, `username`, `kode_wali`, `status`, `foto`) VALUES
(123, 'testmhs', 'test', '1234', '123', 2021, 'SNMPTN', 'testmhs@gmail.com', '12345678', 'testmhs', NULL, 'Aktif 2023', 'gambar.jpg'),
(1234, 'testmhs2', 'test', '12345678', '123', 2021, 'SNMPTN', 'testmhs2@gmail.com', '12345678', 'testmhs2', NULL, 'Aktif 2023', 'gambar.jpg'),
(12345, 'testmhs3', 'test', '12345', '1234', 2021, 'SBMPTN', 'testmhs3@gmail.com', '12345678', 'testmhs3', NULL, 'Aktif 2023', 'gambar.jpg'),
(123456, 'testmhs4', 'test', '123456', '12345', 2021, 'SBMPTN', 'testmhs4@gmail.com', '12345678', 'testmhs4', NULL, 'Aktif 2023', 'gambar.jpg'),
(1234567, 'testmhs5', 'test', '1234567', '123456', 2021, 'Mandiri', 'testmhs5@gmail.com', '12345678', 'testmhs5', NULL, 'Aktif 2023', 'gambar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`nama`, `nip`, `email`, `foto`, `username`) VALUES
('testopt', 123, 'testopt@gmail.com', 'gambar.jpg', 'testopt'),
('testopt2', 1234, 'testopt2@gmail.com', 'gambar.jpg', 'testopt2');

-- --------------------------------------------------------

--
-- Table structure for table `pkl`
--

CREATE TABLE `pkl` (
  `nim` int(11) NOT NULL,
  `semester_aktif` int(11) NOT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `upload_pkl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prov`
--

CREATE TABLE `prov` (
  `kode_prov` varchar(255) NOT NULL,
  `nama_prov` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prov`
--

INSERT INTO `prov` (`kode_prov`, `nama_prov`) VALUES
('123', 'Jawa Tengah'),
('1234', 'Jambi'),
('12345', 'Aceh'),
('123456', 'Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `nim` int(11) NOT NULL,
  `semester_aktif` int(11) NOT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `tanggal_sidang` date DEFAULT NULL,
  `lama_studi` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `upload_skripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_file`
--

CREATE TABLE `temp_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `nim` int(11) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nim`, `nip`, `email`, `password`, `role`) VALUES
('testdpt', NULL, NULL, 'testdpt@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'departemen'),
('testdsn', NULL, 123, 'testdsn@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'dosen'),
('testmhs', 123, NULL, 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa'),
('testmhs2', 1234, NULL, 'testmhs2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa'),
('testmhs3', 12345, NULL, 'testmhs3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa'),
('testmhs4', 123456, NULL, 'testmhs4@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa'),
('testmhs5', 1234567, NULL, 'testmhs5@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa'),
('testopt', NULL, NULL, 'testopt@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'operator'),
('testopt2', NULL, NULL, 'testopt2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `dosen_email_unique` (`email`),
  ADD KEY `dosen_kode_kab_foreign` (`kode_kab`),
  ADD KEY `dosen_kode_prov_foreign` (`kode_prov`),
  ADD KEY `dosen_username_foreign` (`username`);

--
-- Indexes for table `entry_progress`
--
ALTER TABLE `entry_progress`
  ADD UNIQUE KEY `entry_progress_nim_semester_aktif_unique` (`nim`,`semester_aktif`),
  ADD KEY `entry_progress_nip_foreign` (`nip`);

--
-- Indexes for table `irs`
--
ALTER TABLE `irs`
  ADD UNIQUE KEY `irs_nim_semester_aktif_unique` (`nim`,`semester_aktif`);

--
-- Indexes for table `kab`
--
ALTER TABLE `kab`
  ADD PRIMARY KEY (`kode_kab`),
  ADD KEY `kab_kode_prov_foreign` (`kode_prov`);

--
-- Indexes for table `khs`
--
ALTER TABLE `khs`
  ADD UNIQUE KEY `khs_nim_semester_aktif_unique` (`nim`,`semester_aktif`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `mahasiswa_email_unique` (`email`),
  ADD KEY `mahasiswa_kode_kab_foreign` (`kode_kab`),
  ADD KEY `mahasiswa_kode_prov_foreign` (`kode_prov`),
  ADD KEY `mahasiswa_kode_wali_foreign` (`kode_wali`),
  ADD KEY `mahasiswa_username_foreign` (`username`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pkl`
--
ALTER TABLE `pkl`
  ADD UNIQUE KEY `pkl_nim_semester_aktif_unique` (`nim`,`semester_aktif`);

--
-- Indexes for table `prov`
--
ALTER TABLE `prov`
  ADD PRIMARY KEY (`kode_prov`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD UNIQUE KEY `skripsi_nim_semester_aktif_unique` (`nim`,`semester_aktif`);

--
-- Indexes for table `temp_file`
--
ALTER TABLE `temp_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `nip` (`nip`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temp_file`
--
ALTER TABLE `temp_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departemen`
--
ALTER TABLE `departemen`
  ADD CONSTRAINT `departemen_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_kode_kab_foreign` FOREIGN KEY (`kode_kab`) REFERENCES `kab` (`kode_kab`),
  ADD CONSTRAINT `dosen_kode_prov_foreign` FOREIGN KEY (`kode_prov`) REFERENCES `prov` (`kode_prov`),
  ADD CONSTRAINT `dosen_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `users` (`nip`) ON DELETE CASCADE,
  ADD CONSTRAINT `dosen_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `entry_progress`
--
ALTER TABLE `entry_progress`
  ADD CONSTRAINT `entry_progress_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `entry_progress_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`);

--
-- Constraints for table `irs`
--
ALTER TABLE `irs`
  ADD CONSTRAINT `irs_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `entry_progress` (`nim`);

--
-- Constraints for table `kab`
--
ALTER TABLE `kab`
  ADD CONSTRAINT `kab_kode_prov_foreign` FOREIGN KEY (`kode_prov`) REFERENCES `prov` (`kode_prov`);

--
-- Constraints for table `khs`
--
ALTER TABLE `khs`
  ADD CONSTRAINT `khs_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `entry_progress` (`nim`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_kode_kab_foreign` FOREIGN KEY (`kode_kab`) REFERENCES `kab` (`kode_kab`),
  ADD CONSTRAINT `mahasiswa_kode_prov_foreign` FOREIGN KEY (`kode_prov`) REFERENCES `prov` (`kode_prov`),
  ADD CONSTRAINT `mahasiswa_kode_wali_foreign` FOREIGN KEY (`kode_wali`) REFERENCES `dosen` (`nip`),
  ADD CONSTRAINT `mahasiswa_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `users` (`nim`),
  ADD CONSTRAINT `mahasiswa_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `operator_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `pkl`
--
ALTER TABLE `pkl`
  ADD CONSTRAINT `pkl_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `entry_progress` (`nim`);

--
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `skripsi_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `entry_progress` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

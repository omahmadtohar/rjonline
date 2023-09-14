-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 05:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_krimsus`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_laporan_kasus`
--

CREATE TABLE `dokumen_laporan_kasus` (
  `id` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `nomor_lp` varchar(50) NOT NULL,
  `nomor_kk` varchar(50) NOT NULL,
  `file1` varchar(100) NOT NULL,
  `file2` varchar(100) NOT NULL,
  `file3` varchar(100) NOT NULL,
  `file4` varchar(100) NOT NULL,
  `file5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kasus`
--

CREATE TABLE `laporan_kasus` (
  `id` int(11) NOT NULL,
  `nomor_lp` varchar(50) NOT NULL,
  `nomor_kk` varchar(20) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `deskripsi_kasus` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_kasus`
--

INSERT INTO `laporan_kasus` (`id`, `nomor_lp`, `nomor_kk`, `nama_pelapor`, `tanggal_laporan`, `deskripsi_kasus`, `status`) VALUES
(26, 'LP/01/2023/210', '1406142009930001', 'Ahmad Tohar, S.Kom', '2023-09-02', 'bacot kamu       baik                		                            		                            ', 'Selesai'),
(28, 'LP/01/2023/211', '1406142009930001', 'Ahmad Tohar, S.Kom', '2023-09-01', 'cvcvc', 'Selesai'),
(30, 'LP/01/2023/212', '1406142009930001', 'Ahmad Tohar, S.Kom', '2023-08-01', 'KASUS NARKOBOY', 'Selesai'),
(31, 'LP/01/2023/214', '1406142009930001', 'Ahmad Tohar, S.Kom', '2023-01-01', 'NARKOBOY', 'Selesai'),
(32, 'LP/01/2023/215', '1406142009930001', 'Ahmad Tohar, S.Kom', '2022-02-01', 'NARKOBOY', 'Selesai'),
(33, 'LP/01/2023/216', '1406142009930001', 'Ahmad Tohar, S.Kom', '2023-09-01', 'KASUS NARKOBOY', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_laporan_kasus`
--
ALTER TABLE `dokumen_laporan_kasus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`);

--
-- Indexes for table `laporan_kasus`
--
ALTER TABLE `laporan_kasus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_laporan_kasus`
--
ALTER TABLE `dokumen_laporan_kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `laporan_kasus`
--
ALTER TABLE `laporan_kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_laporan_kasus`
--
ALTER TABLE `dokumen_laporan_kasus`
  ADD CONSTRAINT `dokumen_laporan_kasus_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan_kasus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

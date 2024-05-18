-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2024 at 07:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040043`
--

-- --------------------------------------------------------

--
-- Table structure for table `tempat_wisata`
--

CREATE TABLE `tempat_wisata` (
  `id_tempat` int NOT NULL,
  `id_user` int NOT NULL,
  `nama_tempat` varchar(255) NOT NULL,
  `deskripsi_tempat` text NOT NULL,
  `lokasi_tempat` varchar(255) NOT NULL,
  `foto_tempat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tempat_wisata`
--

INSERT INTO `tempat_wisata` (`id_tempat`, `id_user`, `nama_tempat`, `deskripsi_tempat`, `lokasi_tempat`, `foto_tempat`) VALUES
(73, 1, 'fuji 1', 'qwerty', 'tokyo, japan', '9142miguel-bruna-G31zRdTdZEA-unsplash.jpg'),
(74, 1, 'tokyo tower jpn', 'qwert', 'qwert', '2692daniel-frank-b_AS1ax3eTY-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar_user` varchar(255) NOT NULL,
  `role` enum('admin','costomer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `gambar_user`, `role`) VALUES
(1, 'radenindra', '1', 'raden@gmail.com', '', 'admin'),
(2, 'test', '1', 'test@gmail.com', '', 'costomer'),
(3, 'test1', '$2y$10$xK4vQo4X43vlf8dqcJcrRuAo5jQyAOw9fChqmFgRxlSFLHT7axUoC', 'test1@gmail.com', '6063foto1.jpg', 'costomer'),
(4, 'Raden Indra Prawirajaya', '$2y$10$dlLQ7v.J4ms5HHW3iF1xauJEhqdgS.qvHvNTj982wKttrsFXjNJMS', 'radenprawirajaya@gmail.com', '2534foto1.jpg', 'costomer'),
(5, 'test2', '$2y$10$tTEQS05gwEK7NcCojWdAeOC2wvaisL/WBOGcfVG.uaB58MufoDsPK', 'test2@gmail.com', '1913foto1.jpg', 'costomer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD PRIMARY KEY (`id_tempat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  MODIFY `id_tempat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD CONSTRAINT `tempat_wisata_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

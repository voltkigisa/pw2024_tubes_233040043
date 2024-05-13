-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2024 at 10:09 AM
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
  `nama_tempat` varchar(255) NOT NULL,
  `deskripsi_tempat` text NOT NULL,
  `lokasi_tempat` varchar(255) NOT NULL,
  `foto_tempat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tempat_wisata`
--

INSERT INTO `tempat_wisata` (`id_tempat`, `nama_tempat`, `deskripsi_tempat`, `lokasi_tempat`, `foto_tempat`) VALUES
(59, 'fuji 1', 'qwerty', 'tokyo, japan', '8078miguel-bruna-G31zRdTdZEA-unsplash.jpg'),
(61, 'fuji 1', 'qwertyu', 'tokyo, japan', '2859miguel-bruna-G31zRdTdZEA-unsplash.jpg'),
(62, 'water fall', 'qwerty', 'curuk omas', '9172miguel-bruna-G31zRdTdZEA-unsplash.jpg'),
(63, 'tokyo tower', 'qwertyu', 'japan', '8002daniel-frank-b_AS1ax3eTY-unsplash.jpg'),
(64, 'jg', 'hj', 'hg', '9353daniel-frank-b_AS1ax3eTY-unsplash.jpg'),
(65, 'tokyo tower', 'qwerty', 'japan', '8352daniel-frank-b_AS1ax3eTY-unsplash.jpg'),
(67, 'water fall', 'qwerty', 'curuk omas', '681miguel-bruna-G31zRdTdZEA-unsplash.jpg'),
(68, 'tokyo tower', 'qwertyu', 'curuk omas', '3077daniel-frank-b_AS1ax3eTY-unsplash.jpg'),
(69, 'qwerty', 'qwerty', 'qwerty', '8163daniel-frank-b_AS1ax3eTY-unsplash.jpg'),
(70, 'fuji', 'qwerty', 'qwerty', '5855miguel-bruna-G31zRdTdZEA-unsplash.jpg'),
(71, 'water fall', 'qwertyui', 'tokyo, japan', '3578miguel-bruna-G31zRdTdZEA-unsplash.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD PRIMARY KEY (`id_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  MODIFY `id_tempat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

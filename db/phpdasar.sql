-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 02:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` char(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `email`, `jurusan`, `gambar`) VALUES
(15, 'kaka', '123456789', 'kaka@gmail.com', 'Teknik Mesin', '61f3c01986998.png'),
(17, 'bagus', '09876', 'bagus@mhs.ac.id', 'Teknik Nuklir', '61f3c771dfc31.jpg'),
(19, 'Deny Maulana', '17416255', 'denymaulana@mhs.ac.id', 'Teknik Informatika', '5d79f876f293a.jpg'),
(21, 'Roy Samsul', '1741625520', 'roysamsul@gmail.com', 'Teknik Industri', '61f276bde7519.jpg'),
(22, 'maman', '54321', 'maman@gmail.com', 'Teknik Pertanian', '61f3c46790876.png'),
(23, 'ronaldo', '12345', 'ronaldo@gmail.com', 'Teknik Informatika', '61f3c73262a42.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'khan', '$2y$10$OzVgt3ARIgbZIMk7yL19Me3lnXoEiGeWehHsBmA/K1OgAn61MttIG'),
(3, 'admin', '$2y$10$u3.qhNNwrBYnt/hHfdtRc.FH3Ko9oO5vW.9GMD3bWAWWkzp1YNbt.'),
(4, 'admin2', '$2y$10$r73r3Mz0A94JMYAAih3g..GKvJyjDUct8YIKE8Fdf3wb/KzPvmYUq'),
(5, 'a', '$2y$10$5ObUtF66SCf8tSATdKZ3ruLVje1hTl/.Jg4Hy3TzfuWCCirMvHtkW'),
(6, 'admin3', '$2y$10$A2eJaC2ZIHZo2edc4o3B2uYTqbs3V/16/ZcoSOh1NXpQ9RieNHZWq'),
(7, 'deny', '$2y$10$euDKrBOdONtfRpUWLvBofuYzaPIEVqYObNptfxV/ALhxStHDKsVd2'),
(8, 'maulana', '$2y$10$UH9bidhL7TxAcG8RMu/t/e17velzRlcQltWgq2tdQ0umaf/NYdkNG'),
(9, 'mimin', '$2y$10$ORXhDJsC6Fl8dxFofnJQmO5FL5VxXxlnVfb27H5sIeBOjpcobGe22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

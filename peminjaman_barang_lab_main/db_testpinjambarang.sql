-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2024 at 12:08 AM
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
-- Database: `db_testpinjambarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_pinjam` int NOT NULL,
  `ruang_id` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nama_barang`, `jumlah_pinjam`, `ruang_id`, `description`) VALUES
(1, 'Buku PHP', 40, 2, 'Buku ini adalah buku baru dan bagus'),
(2, 'Mouse', 16, 1, 'Mousenya memiliki merk havic'),
(4, 'Web Cam', 15, 1, 'Barang Mulus semua'),
(6, 'Monitor', 10, 2, 'Barang Masih Bagus'),
(9, 'Obeng Set Lengkap', 5, 1, 'Obengnya memiliki set lengkap'),
(10, 'Monitor LG', 6, 3, 'Barang Masih Bagus');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int NOT NULL,
  `nama_ruang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `nama_ruang`) VALUES
(1, 'C1'),
(2, 'C2'),
(3, 'C3'),
(5, 'C7'),
(7, 'C4');

-- --------------------------------------------------------

--
-- Table structure for table `pinjams`
--

CREATE TABLE `pinjams` (
  `id` int NOT NULL,
  `users_id` int NOT NULL,
  `items_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pinjams`
--

INSERT INTO `pinjams` (`id`, `users_id`, `items_id`, `jumlah`, `tgl_peminjaman`, `tgl_pengembalian`, `status`) VALUES
(1, 12, 1, 10, '2024-09-23', '2024-09-23', 'dikembalikan'),
(2, 11, 10, 3, '2024-09-23', '2024-09-23', 'dikembalikan'),
(3, 11, 9, 3, '2024-09-23', '2024-09-23', 'dikembalikan'),
(4, 11, 2, 1, '2024-09-23', '2024-09-23', 'dikembalikan'),
(5, 11, 1, 5, '2024-09-23', '2024-09-23', 'dikembalikan'),
(6, 11, 4, 2, '2024-09-23', '2024-09-23', 'dikembalikan'),
(7, 11, 10, 2, '2024-09-23', '2024-09-23', 'dikembalikan'),
(8, 11, 10, 1, '2024-09-23', '2024-09-23', 'dikembalikan'),
(9, 11, 10, 8, '2024-09-23', '2024-09-23', 'dikembalikan'),
(10, 13, 6, 1, '2024-09-23', '2024-09-23', 'dikembalikan'),
(11, 13, 1, 1, '2024-09-23', '2024-09-23', 'dikembalikan'),
(12, 13, 1, 5, '2024-09-23', NULL, 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_items`
--

CREATE TABLE `pinjam_items` (
  `id` int NOT NULL,
  `pinjam_id` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'adi wijaya', 'adiwwwe', 'adi123@', 'admin'),
(2, 'bobo juni', 'boborarw', 'bobo123', 'user'),
(3, 'admin123', 'admin123', 'admin123', 'admin'),
(4, 'bobo juni', 'boborarw', 'bobo123', 'user'),
(5, 'hewan carnivora', 'rajauna', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'siswa'),
(6, 'ww@gmail.com', 'ww', 'fea36c59a87f647c1895ec6cf488dcf077681cc149635f8e5cec5100fc99bd05', 'siswa'),
(7, 'halo', 'halo1', 'halo1', 'admin'),
(8, 'bili@gmail.com', 'bilicahyo', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'siswa'),
(9, 'wayan@gmail.com', 'dkawyn', '8f657f71191cf4bb2e0303ba916c8dddf916c3b1358dfffc0531e2a1493c701d', 'siswa'),
(10, '11', '11', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'siswa'),
(11, 'Admin2', 'admin2', 'c1c224b03cd9bc7b6a86d77f5dace40191766c485cd55dc48caf9ac873335d6f', 'admin'),
(12, 'krisoprascandra@gmail.com', 'ico_1313', 'fea36c59a87f647c1895ec6cf488dcf077681cc149635f8e5cec5100fc99bd05', 'siswa'),
(13, 'qq@gmail.com', 'ico_1515', 'fea36c59a87f647c1895ec6cf488dcf077681cc149635f8e5cec5100fc99bd05', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_id` (`ruang_id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjams`
--
ALTER TABLE `pinjams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id` (`items_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `pinjam_items`
--
ALTER TABLE `pinjam_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjam_id` (`pinjam_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pinjams`
--
ALTER TABLE `pinjams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pinjam_items`
--
ALTER TABLE `pinjam_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`ruang_id`) REFERENCES `labs` (`id`);

--
-- Constraints for table `pinjams`
--
ALTER TABLE `pinjams`
  ADD CONSTRAINT `pinjams_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pinjams_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pinjam_items`
--
ALTER TABLE `pinjam_items`
  ADD CONSTRAINT `pinjam_items_ibfk_1` FOREIGN KEY (`pinjam_id`) REFERENCES `pinjam` (`id`),
  ADD CONSTRAINT `pinjam_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

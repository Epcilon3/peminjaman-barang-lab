-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 08:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjambarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `ruang_id` int(11) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nama_barang`, `jumlah_pinjam`, `ruang_id`, `description`) VALUES
(1, 'Mouse Havic', 50, 3, 'Barang Bisa Digunakan Dengan Baik'),
(2, 'Komputer LG', 69, 2, 'Masih bagus sekali'),
(3, 'Kipas Angin', 103, 3, 'Beberapa ada yang rusak cuy'),
(8, 'Buku hacku', 50, 1, 'Lumayan\r\n'),
(9, 'Kabel Lan', 12, 5, '1 Kabel 5 meter punya wifii\r\n'),
(10, 'Mousepad', 15, 1, 'Merk Aceuusr'),
(14, 'Printer', 10, 3, 'Merk Epson Kondisinya Bagus');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int(11) NOT NULL,
  `nama_ruang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `nama_ruang`) VALUES
(1, 'C1'),
(2, 'C2'),
(3, 'C3'),
(4, 'C4'),
(5, 'C7');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `labs_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_pinjam` datetime DEFAULT current_timestamp(),
  `tgl_pengembalian` datetime DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjams`
--

CREATE TABLE `pinjams` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjams`
--

INSERT INTO `pinjams` (`id`, `users_id`, `items_id`, `jumlah`, `tgl_peminjaman`, `tgl_pengembalian`, `status`) VALUES
(1, 2, 2, 10, '2024-09-24', '2024-09-24', 'dikembalikan'),
(2, 2, 1, 5, '2024-09-24', '2024-09-24', 'dikembalikan'),
(3, 2, 1, 5, '2024-09-24', '2024-09-24', 'dikembalikan'),
(4, 2, 1, 2, '2024-09-24', '2024-09-24', 'dikembalikan'),
(5, 2, 2, 11, '2024-09-24', '2024-09-24', 'dikembalikan'),
(6, 1, 1, 1, '2024-09-24', '2024-09-24', 'dikembalikan'),
(7, 3, 2, 1, '2024-09-26', '2024-09-26', 'dikembalikan'),
(8, 3, 2, 19, '2024-09-26', '2024-09-26', 'dikembalikan'),
(9, 2, 1, 1, '2024-10-01', '2024-10-01', 'dikembalikan'),
(10, 4, 3, 12, '2024-10-01', '2024-10-01', 'dikembalikan'),
(11, 4, 2, 2, '2024-10-01', '2024-10-01', 'dikembalikan'),
(12, 4, 2, 2, '2024-10-01', '2024-10-01', 'dikembalikan'),
(13, 4, 3, 50, '2024-10-01', '2024-10-01', 'dikembalikan'),
(14, 4, 3, 10, '2024-10-01', '2024-10-01', 'dikembalikan'),
(16, 1, 2, 1, '2024-10-03', '2024-10-03', 'dikembalikan'),
(17, 1, 1, 2, '2024-10-03', '2024-10-03', 'dikembalikan'),
(18, 1, 3, 3, '2024-10-03', '2024-10-03', 'dikembalikan'),
(19, 3, 1, 20, '2024-10-03', '2024-10-03', 'dikembalikan'),
(21, 3, 8, 100, '2024-10-03', '2024-10-03', 'dikembalikan'),
(22, 3, 1, 2, '2024-10-03', '2024-10-03', 'dikembalikan'),
(23, 3, 8, 50, '2024-10-03', NULL, 'dipinjam'),
(24, 3, 8, 10, '2024-10-03', '2024-10-04', 'dikembalikan'),
(25, 4, 1, 20, '2024-10-03', '2024-10-03', 'dikembalikan'),
(26, 3, 2, 10, '2024-10-04', '2024-10-04', 'dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_items`
--

CREATE TABLE `pinjam_items` (
  `id` int(11) NOT NULL,
  `pinjam_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'kriso@gmail.com', 'ico_1515', 'fea36c59a87f647c1895ec6cf488dcf077681cc149635f8e5cec5100fc99bd05', 'siswa'),
(2, 'Admin', 'Admin', 'c1c224b03cd9bc7b6a86d77f5dace40191766c485cd55dc48caf9ac873335d6f', 'admin'),
(3, 'joinature@gmail.com', 'joi3', 'fea36c59a87f647c1895ec6cf488dcf077681cc149635f8e5cec5100fc99bd05', 'siswa'),
(4, 'dancoi', 'dancoi123', 'd12b1e0e3f049170e9d76f03e021db5d1c762cb03153b7e07402b813814eadb5', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_ibfk_1` (`ruang_id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjams`
--
ALTER TABLE `pinjams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indexes for table `pinjam_items`
--
ALTER TABLE `pinjam_items`
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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjams`
--
ALTER TABLE `pinjams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pinjam_items`
--
ALTER TABLE `pinjam_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`ruang_id`) REFERENCES `labs` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pinjams`
--
ALTER TABLE `pinjams`
  ADD CONSTRAINT `pinjams_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pinjams_ibfk_2` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

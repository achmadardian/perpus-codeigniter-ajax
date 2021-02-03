-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 03:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ardian2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `image`) VALUES
(1, 'admin', '$2y$10$bmEeka9IkInjqvZ.X76eIOP7D7j.dCyMxzXut5YmSs0b9jsv9hxkO', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `nis` int(4) NOT NULL,
  `nama_siswa` varchar(35) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`nis`, `nama_siswa`, `jenis_kelamin`, `email`) VALUES
(4001, 'Achmad Ardian ', 'Laki-Laki', 'achmad@gmail.com'),
(4002, 'Rudolf Rocker', 'Laki-Laki', 'rudolf@gmail.com'),
(4003, 'Fauzi Angga', 'Laki-Laki', 'angga@gmail.com'),
(4004, 'Fauzi Riambodho', 'Laki-Laki', 'fauzi@gmail.com'),
(4005, 'Achmad Subagyo', 'Laki-Laki', 'subagyo@gmail.com'),
(4006, 'Arya Wiyogo', 'Laki-Laki', 'arya@gmail.com'),
(4007, 'Rhino Kurdi', 'Laki-Laki', 'rhino@gmail.com'),
(4008, 'Hayati', 'Perempuan', 'hayati@gmail.com'),
(4009, 'Zainuddin ', 'Laki-Laki', 'zainuddin@gmail.com'),
(4010, 'Ehsan Ijar', 'Perempuan', 'upin@gmail.com'),
(4011, 'Haris Emir', 'Laki-Laki', 'haris@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` varchar(3) NOT NULL,
  `nama_buku` varchar(128) NOT NULL,
  `pengarang` varchar(32) NOT NULL,
  `penerbit` varchar(32) NOT NULL,
  `tahun_terbit` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `nama_buku`, `pengarang`, `penerbit`, `tahun_terbit`) VALUES
('A01', 'Vue JS', 'Andy Maranggi', 'Erlangga', 2015),
('A02', 'Rumah Kertas', 'Carlos Maria Dominguez', 'Marjin Kiri', 2016),
('A03', 'Budaya Tulis', 'Zaid Urban', 'Erlangga', 2008),
('A04', 'Belajar PHP', 'Andriana', 'Gramedia', 2015),
('A05', 'C++ Pemula', 'Sutiyoso', 'Gramedia', 2005),
('A06', 'Laravel', 'Hilman ', 'Balai Pustaka', 2016),
('A07', 'Codeigniter 3', 'Ahma Subari', 'Pro U Media', 2014),
('A08', 'Data Mining', 'Budi Rahardjo', 'Gramedia', 2013),
('A09', 'Belajar Python', 'Budi Rahardjo', 'Gramedia', 2012),
('A10', 'Bahasa Indonesia', 'Achmad Ardian', 'Marjin Kiri', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_transaksi` int(2) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `nis` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_transaksi`, `tanggal_pinjam`, `tanggal_kembali`, `nis`, `id`, `status`) VALUES
(7, '2020-05-24', '2020-05-25', 4001, 'A04', 2),
(8, '2020-05-24', '2020-05-25', 4001, 'A05', 2),
(10, '2020-05-24', '2020-05-25', 4002, 'A04', 2),
(11, '2020-05-24', '2020-05-25', 4003, 'A04', 2),
(12, '2020-05-24', '2020-05-25', 4004, 'A05', 2),
(13, '2020-05-24', '2020-05-25', 4005, 'A06', 2),
(15, '2020-05-24', '2020-05-25', 4006, 'A02', 2),
(16, '2020-05-24', '2020-05-25', 4007, 'A03', 2),
(17, '2020-05-24', '2020-05-25', 4008, 'A04', 2),
(18, '2020-05-24', '2020-05-25', 4009, 'A05', 2),
(19, '2020-05-24', '2020-05-25', 4010, 'A06', 2),
(32, '2020-05-25', '2020-05-25', 4001, 'A04', 2),
(34, '2020-05-25', '2020-05-25', 4003, 'A03', 2),
(35, '2020-05-25', '2020-05-25', 4004, 'A05', 2),
(37, '2020-05-25', '0000-00-00', 4009, 'A04', 1),
(38, '2020-05-25', '0000-00-00', 4002, 'A04', 1),
(39, '2020-05-25', '0000-00-00', 4003, 'A01', 1),
(40, '2020-05-25', '0000-00-00', 4004, 'A03', 1),
(41, '2020-05-25', '0000-00-00', 4005, 'A05', 1),
(42, '2020-05-25', '0000-00-00', 4007, 'A08', 1),
(43, '2020-05-25', '0000-00-00', 4010, 'A09', 1),
(44, '2020-05-25', '0000-00-00', 4005, 'A04', 1),
(45, '2020-05-25', '0000-00-00', 4007, 'A07', 1),
(46, '2020-05-25', '0000-00-00', 4001, 'A07', 1),
(47, '2020-05-25', '0000-00-00', 4002, 'A07', 1),
(48, '2020-05-25', '0000-00-00', 4010, 'A04', 1),
(49, '2020-05-25', '0000-00-00', 4011, 'A04', 1),
(50, '2020-05-25', '0000-00-00', 4006, 'A01', 1),
(51, '2020-05-25', '0000-00-00', 4008, 'A06', 1),
(52, '2020-05-25', '0000-00-00', 4008, 'A06', 1),
(53, '2020-05-25', '0000-00-00', 4008, 'A06', 1),
(59, '2020-05-26', '2020-05-26', 4011, 'A10', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_transaksi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `nis` FOREIGN KEY (`nis`) REFERENCES `anggota` (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

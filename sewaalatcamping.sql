-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 04:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewaalatcamping`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `idbarang` int(5) NOT NULL,
  `namabarang` varchar(20) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah_barang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`idbarang`, `namabarang`, `harga`, `jumlah_barang`) VALUES
(0, 'Consina Extraterestr', 240000, 10),
(1, 'Great Outdoor Monodo', 150000, 5),
(2, 'Great Outdoor Sharp ', 100000, 10),
(3, 'Rock Dinamcs X-Frame', 120000, 5),
(4, 'Eiger Transformer 2', 250000, 10),
(5, 'Merapi Mountain Milk', 170000, 15),
(6, 'Tenda Canopi', 155000, 6),
(7, 'Great Outdoor Explor', 130000, 4),
(8, 'Lafuma Campo 2', 230000, 7),
(9, 'Tenda Dome Seinu', 127000, 5),
(10, 'Rei 018', 130000, 10),
(11, 'Consina Magnum 4', 150000, 10),
(12, 'Great Outdoor Fly ai', 180000, 5),
(13, 'Tenda Dome Pawon', 184000, 10),
(14, 'Great Outdoor Camp 4', 182000, 15),
(15, 'BNIX BN-0 12', 210000, 10),
(16, 'Bnix Bn-005', 270000, 2),
(17, 'Tenda Dome Od Tend', 350000, 3),
(18, 'Nature Hike Professi', 310000, 10),
(19, 'Great Outdoor Java 3', 190000, 5),
(20, 'Lafuma Summertime 3/', 240000, 2),
(21, 'Daypack Consina Lukl', 270000, 4),
(22, 'Daypack Drone 25 L', 350000, 10),
(23, 'Deuter Futura 22 L', 310000, 5),
(24, 'Daypack Consina MC K', 310000, 2),
(25, 'Daypack Consina Leba', 190000, 5),
(26, 'Jayagiri BP 40 L', 240000, 26),
(27, 'Jayagiri Amazon 24 4', 240000, 10),
(28, 'Jayagiri Amazon 23 4', 240000, 5),
(29, 'Eiger Gekkota 45 L', 240000, 3),
(30, 'Deuter Futura Pro 42', 240000, 4),
(31, 'Consina Centurion 50', 240000, 2),
(32, 'Kawanda 50 L', 240000, 1),
(33, 'Gardaba 45+5 L', 240000, 5),
(34, 'Zebrawall Rhinoceros', 240000, 6),
(35, 'Jayagiri Adventure 0', 240000, 7),
(36, 'Ransel Rangka 60 L', 240000, 8),
(37, 'Ransel Standart 60 L', 270000, 6),
(38, 'Ransel Rangka 60 L', 350000, 9),
(39, 'Drone Rangger 60 L', 310000, 10),
(40, 'Gravell Catmount 60 ', 310000, 12),
(41, 'Gravell Sangkareang ', 190000, 13),
(42, 'Luxor', 1000000, 14),
(43, 'Giant 60 L', 240000, 16),
(44, 'Drone Excalibur 60 L', 240000, 17),
(45, 'Consina Alpinnist 75', 240000, 5),
(46, 'Zebra Wall Mammoth 7', 240000, 3),
(47, 'Consina Expedition 7', 240000, 5),
(48, 'Deuter Act Lite 65+1', 240000, 2),
(49, 'Drone Poseidon 85 L', 240000, 4),
(50, 'Jayagiri Adventure 1', 240000, 2),
(52, 'Jaket Eiger Popcloud', 50000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailsewa`
--

CREATE TABLE `tb_detailsewa` (
  `iddetailsewa` int(11) NOT NULL,
  `idsewa` int(11) NOT NULL,
  `idbarang` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `subharga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`idpelanggan`, `nama_pelanggan`, `alamat`, `tgl_lahir`, `jk`) VALUES
(2, 'Muhammad Fauzi Ramdani', 'Jl. Terusan soreang RT03/RW06 Kabupaten Bandung', '1998-03-12', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyewaan`
--

CREATE TABLE `tb_penyewaan` (
  `idsewa` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `tanggalsewa` date NOT NULL,
  `tanggalkembali` date NOT NULL,
  `denda` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`iduser`, `username`, `password`, `nama`, `foto`) VALUES
(60, 'admin', '$2y$10$dMEDV6kt8cIWZ', 'Afrizal Mufriz Fouji', '62bae745eb877.jpg'),
(61, 'aafrzl_', '$2y$10$jrFJc9WMoFoDFiw.wTvLoe38Xj26BVuP2hIyEtMEZEG37PwPrzs3.', 'Afrizal Mufriz Fouji', '62baea2022307.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `tb_detailsewa`
--
ALTER TABLE `tb_detailsewa`
  ADD PRIMARY KEY (`iddetailsewa`),
  ADD KEY `tb_detailsewa_ibfk_1` (`idbarang`),
  ADD KEY `tb_detailsewa_ibfk_2` (`idsewa`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `tb_penyewaan`
--
ALTER TABLE `tb_penyewaan`
  ADD PRIMARY KEY (`idsewa`),
  ADD UNIQUE KEY `idpegawai` (`iduser`),
  ADD KEY `idpelanggan` (`idpelanggan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `idbarang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_detailsewa`
--
ALTER TABLE `tb_detailsewa`
  MODIFY `iddetailsewa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_penyewaan`
--
ALTER TABLE `tb_penyewaan`
  MODIFY `idsewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detailsewa`
--
ALTER TABLE `tb_detailsewa`
  ADD CONSTRAINT `tb_detailsewa_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `tb_barang` (`idbarang`),
  ADD CONSTRAINT `tb_detailsewa_ibfk_2` FOREIGN KEY (`idsewa`) REFERENCES `tb_penyewaan` (`idsewa`);

--
-- Constraints for table `tb_penyewaan`
--
ALTER TABLE `tb_penyewaan`
  ADD CONSTRAINT `tb_penyewaan_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `tb_pelanggan` (`idpelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penyewaan_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `tb_user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

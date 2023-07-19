-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 03:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `kd_file` int(10) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `kunci` varchar(20) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`kd_file`, `nama_file`, `kunci`, `tgl`, `nip`) VALUES
(9, 'Enkrip_dana.xlsx', '1234567890', '2017-06-15 12:16:10', 1411503293),
(10, 'Enkrip_Proposal.docx', 'coba coba', '2017-06-15 12:16:38', 1411503293),
(11, 'Dekrip_dana.xlsx', '1234567890', '2017-06-15 12:16:57', 1411503293),
(12, 'Dekrip_Proposal.docx', 'coba coba', '2017-06-15 12:17:15', 1411503293),
(13, 'Enkrip_penjadwalan_guru.xls', '12345678', '2022-12-30 14:02:14', 1411501289);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nip` int(10) NOT NULL,
  `nama` text NOT NULL,
  `jenkel` text NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `nama`, `jenkel`, `password`) VALUES
(200121002, 'Mohammad Aizad', 'Pria', '200121002'),
(1411501289, 'Ardhi Fajriansyah', 'Pria', '1411501289'),
(1411503293, 'Arief Setiadi', 'Pria', '1411503293'),
(1411503533, 'Freddy Saleh', 'Pria', '1411503533');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`kd_file`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `password_2` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `kd_file` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

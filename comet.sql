-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 04:15 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comet`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(10) NOT NULL,
  `file` varchar(100) NOT NULL,
  `type` varchar(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `file`, `type`, `size`) VALUES
(8, '59199-CCNA 200-301 Official Cert Guide - Volume 2 by Odom, Wendell (z-lib.org).pdf', 'applicatio', 10497266),
(26, '90644-CCNA 200-301 Official Cert Guide - Volume 2 by Odom, Wendell (z-lib.org).pdf', 'application', 10497266);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`) VALUES
(0, 'nizam.yuseri@gmail.com', '8c5ac728487cd7ea33644faa31675a243e340a0595cded04b56999e9dbfd6f53906a41ca8e3d02ec4681f83e61f24973e95d'),
(0, 'nizam.yuseri@gmail.com', 'fd8be7e32c304d6e1f8a796ce6bc91a2700d159f9e26167c9db35db5be43a3e044ae850599530a03f88224cf08d6138c47eb');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `registeredby` text NOT NULL,
  `nama_projek` text NOT NULL,
  `tarikh_mula` date NOT NULL,
  `tarikh_tamat` date NOT NULL,
  `negeri` text NOT NULL,
  `lokasi` text NOT NULL,
  `penglibatan` text NOT NULL,
  `sumbangan` text NOT NULL,
  `so` text NOT NULL,
  `pemindahan` text NOT NULL,
  `pendahuluan` text NOT NULL,
  `latarbelakang` text NOT NULL,
  `objektif` text NOT NULL,
  `pelaksanaan` text NOT NULL,
  `pra_penilaian` text NOT NULL,
  `staff` text NOT NULL,
  `nama` text NOT NULL,
  `organisasi` text NOT NULL,
  `status` text NOT NULL,
  `penarafan` text NOT NULL,
  `cabaran` text NOT NULL,
  `cadangan` text NOT NULL,
  `sixmnth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `registeredby`, `nama_projek`, `tarikh_mula`, `tarikh_tamat`, `negeri`, `lokasi`, `penglibatan`, `sumbangan`, `so`, `pemindahan`, `pendahuluan`, `latarbelakang`, `objektif`, `pelaksanaan`, `pra_penilaian`, `staff`, `nama`, `organisasi`, `status`, `penarafan`, `cabaran`, `cadangan`, `sixmnth`) VALUES
(26, 'nizam.yuseri@gmail.com', 'Comet', '2020-03-07', '2020-09-08', 'Perak', '', '', '', '', '<br />\r\n<b>Notice</b>:  Undefined index: pemindahan_ilmu in <b>C:\\xampp\\htdocs\\comet\\project_background.php</b> on line <b>240</b><br />\r\n', '', '', '', '', 'test', 'staff:  ', '', '', 'Pending', '', 'dsf', 'testing 321', 1599173997),
(27, 'nizam.yuseri@gmail.com', 'WEB', '2020-09-07', '2020-09-11', 'Perak', 'UUM', 'cisco', 'RM 2000', 'so kod', 'tidak', 'test', 'test', 'test', 'test', 'etst', 'staff: 263978 ', 'nizam', 'ROG', 'Pending', '', '', '', 1615067997);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(6, '', 'nizam.yuseri@gmail.com', 'c28a54855f5d74d44e0f4c85c2daaeff', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

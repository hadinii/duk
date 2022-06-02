-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 02, 2022 at 02:55 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_duk`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `masa_kerja` varchar(100) DEFAULT NULL,
  `condition` enum('>','<','=','Range') DEFAULT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `jabatan_id`, `masa_kerja`, `condition`, `gaji_pokok`) VALUES
(1, 1, '3', '>', 1700000),
(2, 1, '5', '>', 2000000),
(3, 1, '10', '>', 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text,
  `gaji_default` int(11) NOT NULL,
  `is_increment` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama`, `keterangan`, `gaji_default`, `is_increment`) VALUES
(1, 'Operator Komputer', 'Operator Komputer', 1200000, 1),
(2, 'Petugas Jaga Harian', 'Petugas Jaga Harian', 800000, 0),
(3, 'Petugas Kebersihan Harian', 'Petugas Kebersihan Harian', 800000, 0),
(4, 'Petugas Kebersihan Harian (SANITIZER)', 'Petugas Kebersihan Harian (SANITIZER)', 800000, 1),
(5, 'Petugas Lapangan Teknis Peternakan', 'Petugas Lapangan Teknis Peternakan', 2600000, 0),
(6, 'Petugas Mekanik', 'Petugas Mekanik', 800000, 0),
(7, 'Petugas Pemelihara Ternak', 'Petugas Pemelihara Ternak', 700000, 0),
(8, 'Petugas Penyedia Pakan Ternak', 'Petugas Penyedia Pakan Ternak', 700000, 0),
(9, 'Petugas Perawat Hewan', 'Petugas Perawat Hewan', 700000, 0),
(10, 'Tenaga Akuntansi', 'Tenaga Akuntansi', 4000000, 0),
(11, 'Tenaga Informasi dan Teknologi', 'Tenaga Informasi dan Teknologi', 1700000, 0),
(12, 'Tenaga Medis Peternakan', 'Tenaga Medis Peternakan', 2700000, 0),
(13, 'Tenaga Paramedis Peternakan', 'Tenaga Paramedis Peternakan', 2200000, 0),
(14, 'Tenaga Supir', 'Tenaga Supir', 2000000, 0),
(15, 'Tenaga Teknis Laboran', 'Tenaga Teknis Laboran', 2300000, 0),
(16, 'Tenaga Teknisi Kegiatan', 'Tenaga Teknisi Kegiatan', 800000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `gaji_id` int(11) DEFAULT NULL,
  `mulai_kerja` date NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `user_id`, `nama`, `jabatan_id`, `gaji_id`, `mulai_kerja`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `no_telp`, `email`, `alamat`) VALUES
(1, 2, 'John Doe', 1, 1, '2019-03-14', 'Laki-laki', 'Jakarta', '2000-03-14', 'Islam', '082369770021', 'reza@gmail.com', 'Pekanbaru'),
(2, 3, 'Jane Doe', 11, NULL, '2022-03-14', 'Perempuan', 'Jakarta', '2000-03-14', 'Islam', '082369770021', 'jonedoe@gmail.com', 'Pekanbaru');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(30) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `gaji_id` int(11) NOT NULL,
  `spjtm` varchar(100) DEFAULT NULL,
  `spmk` varchar(100) DEFAULT NULL,
  `spk` varchar(100) DEFAULT NULL,
  `sppjl` varchar(100) DEFAULT NULL,
  `bahpl` varchar(100) DEFAULT NULL,
  `baktnb` varchar(100) DEFAULT NULL,
  `lampiran_ba` varchar(100) DEFAULT NULL,
  `baedp` varchar(100) DEFAULT NULL,
  `sdp` varchar(100) DEFAULT NULL,
  `undangan` varchar(100) DEFAULT NULL,
  `ijazah` varchar(100) DEFAULT NULL,
  `cv` varchar(100) DEFAULT NULL,
  `transkrip` varchar(100) DEFAULT NULL,
  `sertifikat_keahlian` varchar(100) DEFAULT NULL,
  `is_accepted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `password`, `is_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, '1471081607990041', '92a7f40823080149ad5886da73f44e9b', 0),
(3, '1471081607990042', 'cd05e8abcdcbdef620aa250643f37d88', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

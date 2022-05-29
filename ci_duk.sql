-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 29, 2022 at 10:35 AM
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
(1, 19, '1', '<', 1000000),
(2, 19, '3', '>', 4000000),
(3, 1, '3', '>', 4000000);

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
(1, 'Operator Komputer', NULL, 1200000, 1),
(2, 'Petugas Jaga Harian', NULL, 1600000, 0),
(3, 'Petugas Kebersihan Harian', NULL, 1600000, 0),
(4, 'Petugas Kebersihan Harian (SANITIZER)', NULL, 1600000, 0),
(5, 'Petugas Lapangan Teknis Peternakan', NULL, 2600000, 0),
(6, 'Petugas Mekanik', NULL, 1200000, 0),
(7, 'Petugas Pemelihara', NULL, 1200000, 0),
(8, 'Petugas Penyedia Pakan Ternak', NULL, 1200000, 0),
(9, 'Petugas Perawat Hewan', NULL, 1200000, 0),
(10, 'Tenaga Akuntansi', NULL, 4000000, 0),
(11, 'Tenaga Informasi dan Teknologi', NULL, 4000000, 0),
(12, 'Tenaga Medis Peternakan', NULL, 2700000, 0),
(13, 'Tenaga Paramedis Peternakan', NULL, 2200000, 0),
(14, 'Tenaga Supir', NULL, 2000000, 0),
(15, 'Tenaga Teknis Laboran', NULL, 2300000, 0),
(16, 'Tenaga Teknisi Kegiatan', NULL, 2000000, 0),
(19, 'Apakek', 'Test', 1000000, 1),
(20, 'Mira', 'Test', 2000000, 0);

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
(2, 2, 'Tomas', 1, 3, '2022-05-27', 'Laki-laki', 'jogja', '2020-12-17', 'Islam', '0812331', 'irvansyaefullah07@gmail.com', 'aceh'),
(3, 3, 'Hamam Ismail', 2, NULL, '2022-05-27', 'Laki-laki', 'Magelang', '1979-12-10', 'Islam', '08127657170', 'hamam.ismail@riau.go.id', 'jalan pemudi no 16'),
(110, 4, 'Irvan ', 3, NULL, '2022-05-27', 'Laki-laki', 'Batam', '2000-05-07', 'Islam', '085374607574', 'irvansyaefullah07@gmail.com', 'Harapan Raya'),
(111, 5, 'John Doe', 1, NULL, '2022-05-27', 'Laki-laki', 'Jakarta', '2000-05-27', 'Islam', '081371239875', 'umarsyarif1607@gmail.com', 'Pekanbaru');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(30) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_pengajuan` varchar(75) NOT NULL,
  `sk_cpns` varchar(100) DEFAULT NULL,
  `sk_pns` varchar(100) DEFAULT NULL,
  `sk_terakhir` varchar(100) DEFAULT NULL,
  `skp` varchar(100) DEFAULT NULL,
  `skp2` varchar(100) DEFAULT NULL,
  `ijazah_terakhir` varchar(100) DEFAULT NULL,
  `sk_jterakhir` varchar(100) DEFAULT NULL,
  `sk_p` varchar(100) DEFAULT NULL,
  `sk_js` varchar(100) DEFAULT NULL,
  `sk_jf` varchar(100) DEFAULT NULL,
  `pak` varchar(100) DEFAULT NULL,
  `sk_kgb` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `nip`, `nama`, `tanggal`, `jenis_pengajuan`, `sk_cpns`, `sk_pns`, `sk_terakhir`, `skp`, `skp2`, `ijazah_terakhir`, `sk_jterakhir`, `sk_p`, `sk_js`, `sk_jf`, `pak`, `sk_kgb`) VALUES
(61, '12345', 'Irvan ', '2022-01-24', 'Kenaikan Gaji', NULL, NULL, 'applsci-09-04062-v4.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'x-bert-extreme-multi-label-text-classification-using-bidirectional-encoder-representations-from-tran');

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
(2, '196805191991121001', 'd2c133c5537ab6d97460c707b91e6b66', 0),
(3, '197912102011021001', '3c4e1a2b20b1f22cb15b3f365140548c', 0),
(4, '197912102011021002', '3ea6923fc0ec122c51ba000fe6d58aad', 0),
(5, '197912102011021003', '2f8013f5462cbe1d4d0728b0ff0ee44e', 0);

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
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2020 at 02:28 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` text,
  `class` varchar(30) NOT NULL DEFAULT 'event-success',
  `start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bahasa_asing`
--

CREATE TABLE `bahasa_asing` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `bahasa` varchar(100) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') DEFAULT NULL,
  `pasif` enum('Ya','Tidak') DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bahasa_asing`
--

INSERT INTO `bahasa_asing` (`id`, `fid_user`, `bahasa`, `aktif`, `pasif`, `created_date`, `updated_date`) VALUES
(1, 1, 'Mandarin', 'Ya', 'Ya', '2019-04-05 10:23:14', NULL),
(2, 10, 'INGGRIS', 'Ya', 'Ya', '2020-09-08 20:20:28', '2020-09-08 20:21:11'),
(3, 10, 'JEPANG', 'Tidak', 'Tidak', '2020-09-08 20:20:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disiplin`
--

CREATE TABLE `disiplin` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tahun` year(4) NOT NULL DEFAULT '0000',
  `tingkat` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disiplin`
--

INSERT INTO `disiplin` (`id`, `fid_user`, `tahun`, `tingkat`, `jenis`, `created_date`, `updated_date`) VALUES
(1, 1, 2018, 'Ringan', 'Potong Gaji', '2019-04-05 10:09:48', NULL),
(2, 10, 2013, 'A', 'BERSIHIN KELAS', '2020-09-08 20:17:28', NULL),
(3, 10, 2015, 'b', 'tidak ada', '2020-09-08 20:17:48', '2020-09-08 20:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `dp3`
--

CREATE TABLE `dp3` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `fid_pegawai` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `pejabat` int(11) DEFAULT NULL,
  `atasan_pejabat` int(11) DEFAULT NULL,
  `nilai_orientasi` decimal(4,2) NOT NULL DEFAULT '0.00',
  `nilai_integritas` decimal(4,2) NOT NULL DEFAULT '0.00',
  `nilai_komitmen` decimal(4,2) NOT NULL DEFAULT '0.00',
  `nilai_disiplin` decimal(4,2) NOT NULL DEFAULT '0.00',
  `nilai_kerjasama` decimal(4,2) NOT NULL DEFAULT '0.00',
  `nilai_kepemimpinan` decimal(4,2) NOT NULL DEFAULT '0.00',
  `nilai_avg` decimal(4,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `duk`
--

CREATE TABLE `duk` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `fid_pegawai` int(11) DEFAULT NULL,
  `fid_pangkat_akhir` int(11) DEFAULT NULL,
  `fid_jabatan_akhir` int(11) DEFAULT NULL,
  `tahun_duk` int(4) DEFAULT NULL,
  `urutan_duk` bigint(20) DEFAULT NULL,
  `thn_masakerja` int(11) NOT NULL DEFAULT '0',
  `bln_masakerja` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duk`
--

INSERT INTO `duk` (`id`, `fid_pegawai`, `fid_pangkat_akhir`, `fid_jabatan_akhir`, `tahun_duk`, `urutan_duk`, `thn_masakerja`, `bln_masakerja`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 2, 2, 2, 2019, 1, 1, 2, 2, '2019-04-05 10:45:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ekin_keg_bulanan`
--

CREATE TABLE `ekin_keg_bulanan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `fid_keg_tahunan` int(11) DEFAULT NULL,
  `bulan` int(2) DEFAULT NULL,
  `kegiatan` text,
  `kuantitas` decimal(4,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(30) DEFAULT NULL,
  `biaya` int(11) NOT NULL DEFAULT '0',
  `angka_kredit` decimal(12,3) NOT NULL DEFAULT '0.000',
  `waktu` int(2) NOT NULL DEFAULT '0',
  `periode_waktu` enum('Hari','Minggu','Bulan') DEFAULT NULL,
  `status` enum('Draft','Penilaian','Verifikasi','Diterima','Ditolak') NOT NULL DEFAULT 'Draft',
  `created_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekin_keg_bulanan`
--

INSERT INTO `ekin_keg_bulanan` (`id`, `fid_user`, `fid_keg_tahunan`, `bulan`, `kegiatan`, `kuantitas`, `satuan`, `biaya`, `angka_kredit`, `waktu`, `periode_waktu`, `status`, `created_date`) VALUES
(19, 1, 14, 1, NULL, '10.00', 'Pcs', 500000, '120000.000', 1, 'Minggu', 'Draft', '2020-09-03 23:08:00'),
(20, 10, 15, 9, NULL, '10.00', 'pcs', 3000000, '1000000.000', 1, 'Bulan', 'Draft', '2020-09-04 22:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `ekin_keg_bulanan_realisasi`
--

CREATE TABLE `ekin_keg_bulanan_realisasi` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `fid_keg_bulanan` int(11) DEFAULT NULL,
  `kuantitas` decimal(4,2) NOT NULL DEFAULT '0.00',
  `kualitas` int(3) NOT NULL DEFAULT '0',
  `biaya` int(11) NOT NULL DEFAULT '0',
  `angka_kredit` decimal(12,3) NOT NULL DEFAULT '0.000',
  `waktu` int(2) NOT NULL DEFAULT '0',
  `perhitungan` decimal(6,2) NOT NULL DEFAULT '0.00',
  `nilai` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ekin_keg_tahunan`
--

CREATE TABLE `ekin_keg_tahunan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tahun` char(4) DEFAULT '2019',
  `kegiatan` text,
  `jenis` enum('Tupoksi','Non-Tupoksi') DEFAULT NULL,
  `target_kuantitas` decimal(5,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(30) DEFAULT NULL,
  `biaya` int(11) NOT NULL DEFAULT '0',
  `angka_kredit` decimal(12,3) NOT NULL DEFAULT '0.000',
  `target_penyelesaian` int(2) NOT NULL DEFAULT '12' COMMENT 'jmlBulan',
  `status` enum('Draft','Penilaian','Verifikasi','Diterima','Ditolak') NOT NULL DEFAULT 'Draft',
  `fid_jabatan` smallint(3) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekin_keg_tahunan`
--

INSERT INTO `ekin_keg_tahunan` (`id`, `fid_user`, `tahun`, `kegiatan`, `jenis`, `target_kuantitas`, `satuan`, `biaya`, `angka_kredit`, `target_penyelesaian`, `status`, `fid_jabatan`, `created_date`, `updated_date`) VALUES
(14, 1, '2020', 'BERSIHIN RUMPUT', 'Tupoksi', '999.00', 'Pcs', 2000000, '1000000.000', 1, 'Penilaian', 3, '2020-09-03 23:05:21', NULL),
(15, 10, '2020', 'CODING SYSTEM', 'Tupoksi', '100.00', 'Pcs', 3000000, '1000000.000', 1, 'Penilaian', 6, '2020-09-04 22:18:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ekin_log`
--

CREATE TABLE `ekin_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_kegiatan` int(11) DEFAULT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `jenis` enum('keg_tahunan','keg_bulanan','tamker') DEFAULT NULL,
  `aksi` enum('Tambah','Pengajuan','Penilaian','Verifikasi','Ditolak') DEFAULT NULL,
  `hasil` enum('Draft','Penilaian','Verifikasi','Diterima','Ditolak') DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekin_log`
--

INSERT INTO `ekin_log` (`id`, `fid_kegiatan`, `fid_user`, `jenis`, `aksi`, `hasil`, `created_date`) VALUES
(85, 14, 1, 'keg_tahunan', 'Tambah', 'Draft', '2020-09-03 23:05:21'),
(86, 19, 1, 'keg_bulanan', 'Tambah', 'Draft', '2020-09-03 23:08:00'),
(87, 14, 1, 'keg_tahunan', 'Pengajuan', 'Penilaian', '2020-09-03 23:08:03'),
(88, 15, 10, 'keg_tahunan', 'Tambah', 'Draft', '2020-09-04 22:18:58'),
(89, 20, 10, 'keg_bulanan', 'Tambah', 'Draft', '2020-09-04 22:19:16'),
(90, 15, 10, 'keg_tahunan', 'Pengajuan', 'Penilaian', '2020-09-04 22:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `ekin_log_prilaku`
--

CREATE TABLE `ekin_log_prilaku` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_prilaku` int(11) DEFAULT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `aksi` enum('Penilaian','Verifikasi') DEFAULT NULL,
  `hasil` enum('Verifikasi','Diterima','Ditolak') DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ekin_prilaku`
--

CREATE TABLE `ekin_prilaku` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_pegawai` int(11) DEFAULT NULL,
  `fid_penilai` int(11) DEFAULT NULL,
  `bulan` int(2) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `orientasi` decimal(5,2) DEFAULT NULL,
  `integritas` decimal(5,2) DEFAULT NULL,
  `komitmen` decimal(5,2) DEFAULT NULL,
  `disiplin` decimal(5,2) DEFAULT NULL,
  `kerja_sama` decimal(5,2) DEFAULT NULL,
  `kepemimpinan` decimal(5,2) DEFAULT NULL,
  `status` enum('Penilaian','Verifikasi','Diterima','Ditolak') NOT NULL DEFAULT 'Penilaian',
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ekin_tambahan_kreatifitas`
--

CREATE TABLE `ekin_tambahan_kreatifitas` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tahun` char(4) DEFAULT '2019',
  `bulan` int(2) NOT NULL DEFAULT '0',
  `kegiatan` text,
  `jenis` enum('Tugas Tambahan','Kreatifitas') DEFAULT NULL,
  `file` text,
  `note` text,
  `nilai` int(2) NOT NULL DEFAULT '0',
  `status` enum('Draft','Penilaian','Verifikasi','Diterima','Ditolak') NOT NULL DEFAULT 'Draft',
  `fid_jabatan` smallint(3) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekin_tambahan_kreatifitas`
--

INSERT INTO `ekin_tambahan_kreatifitas` (`id`, `fid_user`, `tahun`, `bulan`, `kegiatan`, `jenis`, `file`, `note`, `nilai`, `status`, `fid_jabatan`, `created_date`, `updated_date`) VALUES
(1, 1, '2019', 1, 'Membuat Manual Book', 'Tugas Tambahan', '76b40b3e938e806023dfef8748dec5ac.pdf', 'Test', 0, 'Diterima', 4, '2019-03-22 08:10:49', '2019-03-22 08:36:34'),
(3, 1, '2019', 1, 'Melakukan survey ke wilayah terdekat', 'Kreatifitas', 'c33fb142eb27e627df8af6f79f06037b.pdf', 'survey lancar', 6, 'Diterima', 4, '2019-03-27 11:03:46', '2019-03-27 11:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `id_skpd` int(11) NOT NULL DEFAULT '1',
  `parent` smallint(3) NOT NULL DEFAULT '0',
  `nama` varchar(200) DEFAULT NULL,
  `type` enum('Staf','Pejabat') NOT NULL DEFAULT 'Staf',
  `nilai` smallint(4) NOT NULL DEFAULT '100',
  `kelas` smallint(2) NOT NULL DEFAULT '1',
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `id_skpd`, `parent`, `nama`, `type`, `nilai`, `kelas`, `aktif`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 0, 'Kepala Dinas Kominfo', 'Pejabat', 190, 1, 'Ya', 1, '2019-02-16 09:55:15', 1, '2019-03-07 15:36:16'),
(2, 11, 1, 'Kepala Bidang Kominfo', 'Pejabat', 190, 1, 'Ya', 1, '2019-02-16 10:34:45', 1, '2020-09-04 22:06:42'),
(3, 1, 2, 'Kasi Kominfo', 'Pejabat', 190, 1, 'Ya', 1, '2019-03-04 04:18:01', 1, '2020-06-02 04:15:48'),
(4, 1, 3, 'Staf Kominfo', 'Staf', 2760, 1, 'Ya', 1, '2019-03-07 15:39:28', 1, '2019-04-02 10:30:54'),
(5, 1, 0, 'Kepala Dinas BKD', 'Pejabat', 190, 1, 'Ya', 1, '2019-03-22 10:01:08', 1, '2020-09-04 22:12:51'),
(6, 5, 7, 'Staf Kominfo (Dinas Lingkungan Hidup)', 'Staf', 190, 1, 'Ya', 1, '2020-09-04 22:12:40', 1, '2020-09-04 22:25:52'),
(7, 5, 0, 'Kepala Dinas Kominfo (Dinas Lingkungan Hidup)', 'Pejabat', 190, 1, 'Ya', 1, '2020-09-04 22:16:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT '0000-00-00',
  `akte_lahir` varchar(50) DEFAULT NULL,
  `status` enum('Istri','Suami','Anak') DEFAULT NULL,
  `surat_nikah` varchar(50) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id`, `fid_user`, `nip`, `nama`, `tgl_lahir`, `akte_lahir`, `status`, `surat_nikah`, `created_date`, `updated_date`) VALUES
(1, 1, NULL, 'MELATI LESTARI', '1989-06-15', 'XXX', 'Istri', 'VVVV', '2019-04-05 10:31:29', NULL),
(2, 10, NULL, 'GILANG', '2020-09-09', '213123', 'Anak', '123123123', '2020-09-08 20:22:23', '2020-09-08 20:22:30'),
(3, 10, NULL, 'GIGI', '2020-08-31', '23123', 'Istri', '23123', '2020-09-08 20:22:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kenaikan_pangkat`
--

CREATE TABLE `kenaikan_pangkat` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `fid_pegawai` int(11) DEFAULT NULL,
  `fid_pangkat_lama` int(11) DEFAULT NULL,
  `fid_pangkat_baru` int(11) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `no_sk` varchar(100) DEFAULT NULL,
  `tgl_pertek` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kenaikan_pangkat`
--

INSERT INTO `kenaikan_pangkat` (`id`, `fid_pegawai`, `fid_pangkat_lama`, `fid_pangkat_baru`, `tgl_sk`, `no_sk`, `tgl_pertek`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 2, 2, 10, '2019-04-05', 'yyyy', '2019-04-05', 2, '2019-04-05 10:52:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kgb`
--

CREATE TABLE `kgb` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `fid_pegawai` int(11) DEFAULT NULL,
  `gaji_lama` int(11) DEFAULT NULL,
  `gaji_baru` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kgb`
--

INSERT INTO `kgb` (`id`, `fid_pegawai`, `gaji_lama`, `gaji_baru`, `tanggal`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 2, 3200000, 3600000, '2019-01-01', 2, '2019-02-16 12:15:01', 2, '2019-02-16 12:18:24'),
(2, 2, 3600000, 0, '2021-01-01', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `url` varchar(50) DEFAULT NULL COMMENT 'id=17 default url =master/pejabat',
  `nama` varchar(50) DEFAULT NULL,
  `icon` varchar(30) NOT NULL DEFAULT 'fa fa-desktop',
  `order` int(3) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent`, `url`, `nama`, `icon`, `order`, `active`) VALUES
(1, 0, 'dashboard', 'DASHBOARD', 'fa fa-desktop', 0, 1),
(2, 0, '#', 'PROFIL', 'fa fa-user', 1, 1),
(3, 0, 'pegawai', 'DATA PEGAWAI', 'fa fa-group', 2, 1),
(4, 0, 'pegawai/duk', 'DATA DUK', 'fa fa-reorder', 3, 1),
(5, 0, '#', 'E-KINERJA', 'fa fa-check-square-o', 4, 1),
(6, 0, 'pegawai/naik_pangkat', 'KENAIKAN PANGKAT', 'fa fa-star', 6, 1),
(7, 0, 'grafik', 'GRAFIK', 'fa fa-signal', 7, 1),
(8, 0, '#', 'DATA MASTER', 'fa fa-ellipsis-v', 8, 1),
(9, 2, 'profil/personal', 'Personal', 'fa fa-desktop', 0, 1),
(10, 2, 'profil/riwayat_kepangkatan', 'Riwayat Kepangkatan', 'fa fa-desktop', 1, 1),
(11, 2, 'profil/riwayat_jabatan', 'Riwayat Jabatan', 'fa fa-desktop', 2, 1),
(12, 2, 'profil/riwayat_pendidikan', 'Riwayat Pendidikan', 'fa fa-desktop', 3, 1),
(13, 2, 'profil/disiplin', 'Disiplin', 'fa fa-desktop', 6, 1),
(14, 2, 'profil/penghargaan', 'Penghargaan', 'fa fa-desktop', 7, 1),
(15, 2, 'profil/riwayat_kesehatan', 'Riwayat Kesehatan', 'fa fa-desktop', 8, 1),
(16, 2, 'profil/bahasa_asing', 'Bahasa Asing', 'fa fa-desktop', 9, 1),
(17, 2, 'profil/prestasi', 'Prestasi', 'fa fa-desktop', 10, 1),
(18, 2, 'profil/keluarga', 'Susunan Keluarga', 'fa fa-desktop', 11, 1),
(19, 5, 'ekinerja', 'Dashboard', 'fa fa-desktop', 0, 1),
(20, 5, 'ekinerja/keg_tahunan', 'Target Kinerja Tahunan', 'fa fa-desktop', 1, 1),
(21, 5, 'ekinerja/keg_bulanan', 'Realisasi Kinerja Bulanan', 'fa fa-desktop', 2, 1),
(22, 5, 'ekinerja/tgs_tambkrea', 'Tugas Tambahan & Kreatifitas', 'fa fa-desktop', 3, 1),
(23, 5, 'ekinerja/hasil_penilaian', 'Hasil Penilaian', 'fa fa-desktop', 4, 1),
(24, 5, '#', 'Penilaian Bawahan', '', 6, 1),
(25, 5, '#', 'Verifikasi', '', 7, 1),
(26, 24, 'ekinerja/target_tahunan_pgw', 'Target Kinerja Tahunan', 'fa fa-desktop', 0, 1),
(27, 24, 'ekinerja/realisasi_bulanan_pgw', 'Realisasi Kinerja Bulanan', 'fa fa-desktop', 1, 1),
(28, 24, 'ekinerja/tugas_pgw', 'T. Tambahan & Kreatifitas', 'fa fa-desktop', 2, 1),
(29, 24, 'ekinerja/prilaku_bawahan', 'Prilaku', 'fa fa-desktop', 3, 1),
(30, 25, 'ekinerja/target_tahunan_verifikasi', 'Target Kinerja Tahunan', 'fa fa-desktop', 0, 1),
(31, 25, 'ekinerja/target_bulanan_verifikasi', 'Realisasi Kinerja Bulanan', 'fa fa-desktop', 1, 1),
(32, 25, 'ekinerja/tugas_verifikasi', 'T. Tambahan & Kreatifitas', 'fa fa-desktop', 2, 1),
(33, 25, 'ekinerja/prilaku_verifikasi', 'Prilaku', 'fa fa-desktop', 3, 1),
(34, 8, 'master/unit_kerja', 'Unit Kerja', 'fa fa-desktop', 0, 1),
(35, 8, 'master/jabatan', 'Jabatan', 'fa fa-desktop', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_backup`
--

CREATE TABLE `menu_backup` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `url` varchar(50) DEFAULT NULL COMMENT 'id=17 default url =master/pejabat',
  `nama` varchar(50) DEFAULT NULL,
  `icon` varchar(30) NOT NULL DEFAULT 'fa fa-desktop',
  `order` int(3) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_backup`
--

INSERT INTO `menu_backup` (`id`, `parent`, `url`, `nama`, `icon`, `order`, `active`) VALUES
(1, 0, '#', 'PROFIL', 'fa fa-user', 1, 1),
(2, 1, 'profil/personal', 'Personal', 'fa fa-desktop', 0, 1),
(3, 1, 'profil/riwayat_kepangkatan', 'Riwayat Kepangkatan', 'fa fa-desktop', 1, 1),
(4, 1, 'profil/riwayat_jabatan', 'Riwayat Jabatan', 'fa fa-desktop', 2, 1),
(5, 1, 'profil/riwayat_pendidikan', 'Riwayat Pendidikan', 'fa fa-desktop', 3, 1),
(6, 0, 'pegawai/duk', 'DATA DUK', 'fa fa-reorder', 3, 1),
(7, 0, '#', 'E-KINERJA', 'fa fa-check-square-o', 4, 1),
(8, 1, 'profil/disiplin', 'Disiplin', 'fa fa-desktop', 6, 1),
(9, 1, 'profil/penghargaan', 'Penghargaan', 'fa fa-desktop', 7, 1),
(10, 1, 'profil/riwayat_kesehatan', 'Riwayat Kesehatan', 'fa fa-desktop', 8, 1),
(11, 1, 'profil/bahasa_asing', 'Bahasa Asing', 'fa fa-desktop', 9, 1),
(12, 1, 'profil/prestasi', 'Prestasi', 'fa fa-desktop', 10, 1),
(13, 1, 'profil/keluarga', 'Susunan Keluarga', 'fa fa-desktop', 11, 1),
(14, 0, 'pegawai', 'DATA PEGAWAI', 'fa fa-group', 2, 1),
(15, 0, 'dashboard', 'DASHBOARD', 'fa fa-desktop', 0, 1),
(16, 0, '#', 'DATA MASTER', 'fa fa-ellipsis-v', 8, 1),
(17, 16, 'master/unit_kerja', 'Unit Kerja', 'fa fa-desktop', 0, 1),
(18, 16, 'master/jabatan', 'Jabatan', 'fa fa-desktop', 1, 1),
(19, 0, 'pegawai/kgb', 'DATA KGB', 'fa fa-money', 5, 0),
(20, 0, 'pegawai/naik_pangkat', 'KENAIKAN PANGKAT', 'fa fa-star', 6, 1),
(21, 7, '#', 'Penilaian Bawahan', '', 6, 1),
(22, 21, 'ekinerja/prilaku_bawahan', 'Prilaku', 'fa fa-desktop', 3, 1),
(23, 0, 'grafik', 'GRAFIK', 'fa fa-signal', 7, 1),
(24, 7, 'ekinerja/keg_tahunan', 'Target Kinerja Tahunan', 'fa fa-desktop', 1, 1),
(25, 7, 'ekinerja/keg_bulanan', 'Realisasi Kinerja Bulanan', 'fa fa-desktop', 2, 1),
(26, 7, 'ekinerja', 'Dashboard', 'fa fa-desktop', 0, 1),
(27, 7, 'ekinerja/tgs_tambkrea', 'Tugas Tambahan & Kreatifitas', 'fa fa-desktop', 3, 1),
(28, 7, 'ekinerja/hasil_penilaian', 'Hasil Penilaian', 'fa fa-desktop', 4, 1),
(29, 21, 'ekinerja/target_tahunan_pgw', 'Target Kinerja Tahunan', 'fa fa-desktop', 0, 1),
(30, 21, 'ekinerja/realisasi_bulanan_pgw', 'Realisasi Kinerja Bulanan', 'fa fa-desktop', 1, 1),
(31, 21, 'ekinerja/tugas_pgw', 'T. Tambahan & Kreatifitas', 'fa fa-desktop', 2, 1),
(32, 7, '#', 'Verifikasi', '', 7, 1),
(33, 32, 'ekinerja/target_tahunan_verifikasi', 'Target Kinerja Tahunan', 'fa fa-desktop', 0, 1),
(34, 32, 'ekinerja/target_bulanan_verifikasi', 'Realisasi Kinerja Bulanan', 'fa fa-desktop', 1, 1),
(35, 32, 'ekinerja/tugas_verifikasi', 'T. Tambahan & Kreatifitas', 'fa fa-desktop', 2, 1),
(36, 32, 'ekinerja/prilaku_verifikasi', 'Prilaku', 'fa fa-desktop', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `nama_panggilan` varchar(25) DEFAULT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `fid_jabatan` smallint(3) DEFAULT NULL,
  `tmp_lahir` text,
  `tgl_lahir` date DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `agama` varchar(15) NOT NULL DEFAULT 'Islam',
  `alamat` text,
  `no_hp` char(13) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `jenis_pegawai` tinyint(1) NOT NULL DEFAULT '2',
  `pangkat_golongan` smallint(2) NOT NULL DEFAULT '0',
  `instansi_kerja` text,
  `unit_kerja` int(3) DEFAULT NULL,
  `tunjangan` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `fid_user`, `nip`, `nama_panggilan`, `nama`, `fid_jabatan`, `tmp_lahir`, `tgl_lahir`, `gender`, `agama`, `alamat`, `no_hp`, `npwp`, `jenis_pegawai`, `pangkat_golongan`, `instansi_kerja`, `unit_kerja`, `tunjangan`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, '11113243 411233 2 331', 'dhivar', 'Ahmad Adivar', 7, 'Majene', '1989-04-15', 'L', 'Islam', 'Maros', '081342312559', '88.777.844.8-788.111', 1, 13, 'Kabupaten / Kota', 5, 'Suami/Istri,Anak', NULL, NULL, 1, '2020-09-04 22:17:12'),
(9, 9, '12344567 543333 3 333', 'Doni', 'Doni Syahroni', 4, NULL, NULL, NULL, 'Islam', NULL, NULL, NULL, 2, 0, NULL, 2, NULL, 1, '2020-09-03 22:29:08', 1, '2020-09-04 22:20:53'),
(10, 10, '12344567 543333 3 335', 'Anton', 'Anton Lingkungan', 6, NULL, NULL, NULL, 'Islam', NULL, NULL, NULL, 2, 0, NULL, 5, NULL, 1, '2020-09-04 20:50:24', 1, '2020-09-04 22:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `pejabat`
--

CREATE TABLE `pejabat` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `posisi` varchar(200) DEFAULT NULL,
  `organisasi` varchar(200) DEFAULT NULL,
  `pangkat_golongan` smallint(2) NOT NULL DEFAULT '0',
  `nama` varchar(200) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pejabat`
--

INSERT INTO `pejabat` (`id`, `posisi`, `organisasi`, `pangkat_golongan`, `nama`, `nip`, `aktif`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'KASUBAG UMUM DAN KEPEGAWAIAN', 'SUB BAGIAN UMUM DAN KEPEGAWAIAN', 13, 'A. ST. DJUMHARIJAH, SE', '197001091994032004', 'Ya', 1, '2018-01-16 16:00:30', 1, '2018-01-24 07:10:26'),
(2, 'SEKRETARIS BAPPEDA', 'SEKRETARIS BAPPEDA', 0, 'Drs. NUR KAMARUL ZAMAN, M.Si', '196705091994021003', 'Ya', 1, '2018-01-16 16:02:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tahun` year(4) NOT NULL DEFAULT '0000',
  `tingkat` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`id`, `fid_user`, `tahun`, `tingkat`, `nama`, `created_date`, `updated_date`) VALUES
(1, 1, 2018, 'Nasional', 'Pembuatan Aplikasi', '2019-04-05 10:13:45', NULL),
(2, 10, 2013, 'A', 'BALAP KARUNG', '2020-09-08 20:18:21', '2020-09-08 20:18:59'),
(3, 10, 2019, 'B', 'MAKAN JAGUNG', '2020-09-08 20:19:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tahun` year(4) NOT NULL DEFAULT '0000',
  `tingkat` varchar(50) DEFAULT NULL,
  `bidang` varchar(50) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id`, `fid_user`, `tahun`, `tingkat`, `bidang`, `created_date`, `updated_date`) VALUES
(1, 1, 2018, 'Bulu Tangkis', 'Nasional', '2019-04-05 10:27:07', NULL),
(2, 10, 2013, 'A', 'KOMPUTER', '2020-09-08 20:21:26', '2020-09-08 20:21:45'),
(3, 10, 2015, 'A', 'JARINGAN', '2020-09-08 20:21:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` smallint(1) UNSIGNED NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `kepala_sekolah` varchar(50) DEFAULT NULL,
  `alamat` text,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ptk`
--

CREATE TABLE `ptk` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nuptk` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL DEFAULT 'L',
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date NOT NULL DEFAULT '0000-00-00',
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha') NOT NULL DEFAULT 'Islam',
  `telepon` varchar(12) DEFAULT NULL,
  `alamat` text,
  `pendidikan` tinyint(2) NOT NULL DEFAULT '0',
  `jurusan` varchar(100) DEFAULT NULL,
  `status_kepegawaian` tinyint(2) NOT NULL DEFAULT '11',
  `jenis_ptk` tinyint(2) NOT NULL DEFAULT '11',
  `status` enum('YES','NO') DEFAULT 'YES',
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_jabatan`
--

CREATE TABLE `riwayat_jabatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `jabatan` text,
  `unit_kerja` text,
  `eselon` text,
  `tmt` varchar(20) DEFAULT NULL,
  `no_sk` varchar(50) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `pejabat_sah` text,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat_jabatan`
--

INSERT INTO `riwayat_jabatan` (`id`, `fid_user`, `jabatan`, `unit_kerja`, `eselon`, `tmt`, `no_sk`, `tgl_sk`, `pejabat_sah`, `created_date`, `updated_date`) VALUES
(1, 1, 'Tes Jabatan', 'Kominfo', '1', '2019-04-05', 'Cdd', '2019-04-05', '3', '2019-04-05 09:55:52', NULL),
(2, 2, 'Staf', 'Kominfo', 'II', '2019-04-05', 'bbb', '2019-04-05', '5', '2019-04-05 10:45:03', NULL),
(3, 10, 'Staff', 'Dinas Doni', 'Staff Umum', '2020-09-08', '32143241', '2020-09-09', '1', '2020-09-08 19:56:24', '2020-09-08 20:07:44'),
(4, 10, 'Staff', 'Dinas Doni', 'Staff Umum', '2020-09-08', '32143241', '2020-09-09', '1', '2020-09-08 19:56:43', '2020-09-08 20:12:58'),
(5, 10, 'Kaprodi', 'DInas Kampus', 'Kampus', '2020-09-01', '234234', '2020-09-09', '1', '2020-09-08 20:13:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kesehatan`
--

CREATE TABLE `riwayat_kesehatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tahun` year(4) NOT NULL DEFAULT '0000',
  `penyakit` varchar(100) DEFAULT NULL,
  `dokter` varchar(100) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat_kesehatan`
--

INSERT INTO `riwayat_kesehatan` (`id`, `fid_user`, `tahun`, `penyakit`, `dokter`, `created_date`, `updated_date`) VALUES
(1, 1, 2017, 'Demam Berdarah', 'Dr. Talik', '2019-04-05 10:18:22', NULL),
(2, 10, 2013, 'MAGH', 'DR INDRA', '2020-09-08 20:19:46', '2020-09-08 20:19:53'),
(3, 10, 2019, 'KORENGAN', 'DR SAIFUL', '2020-09-08 20:20:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pangkat`
--

CREATE TABLE `riwayat_pangkat` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `tmt` varchar(20) DEFAULT NULL,
  `no_sk` varchar(50) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `pangkat_golongan` smallint(2) NOT NULL DEFAULT '0',
  `pejabat_sah` text,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat_pangkat`
--

INSERT INTO `riwayat_pangkat` (`id`, `fid_user`, `tmt`, `no_sk`, `tgl_sk`, `pangkat_golongan`, `pejabat_sah`, `created_date`, `updated_date`) VALUES
(1, 1, '2015-04-05', 'Xxxxx', '2015-04-05', 9, '4', '2019-04-05 09:48:22', '2020-06-19 04:27:50'),
(2, 2, '2019-04-05', 'GGGG', '2019-04-05', 9, '5', '2019-04-05 10:44:17', NULL),
(3, 1, '123', '123', '0000-00-00', 10, '2', '2020-06-19 04:25:07', NULL),
(4, 6, '2020-08-04', 'abcd/12ab/12/2020', '2020-08-04', 1, '2', '2020-08-26 02:27:49', NULL),
(5, 10, '2020-09-08', '234234', '2020-09-07', 2, '1', '2020-09-08 08:04:40', '2020-09-08 20:25:32'),
(6, 10, '2020-09-09', '234234123123', '2020-09-16', 1, '1', '2020-09-08 08:07:34', '2020-09-08 20:25:24'),
(7, 10, '2020-09-01', '213', '2020-09-14', 15, '1', '2020-09-08 08:09:26', '2020-09-08 20:25:41'),
(8, 1, '2020-09-08', '32143241', '2020-09-15', 1, '1', '2020-09-08 18:44:39', NULL),
(9, 1, '2020-09-07', '34123', '2020-09-02', 13, '1', '2020-09-08 18:44:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pelatihan`
--

CREATE TABLE `riwayat_pelatihan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `kategori_diklat` smallint(2) DEFAULT NULL,
  `nama_diklat` text,
  `penyelenggara` text,
  `tahun` varchar(100) DEFAULT NULL,
  `lama` varchar(100) DEFAULT NULL,
  `no_sttp` varchar(100) DEFAULT NULL,
  `tgl_sttp` date DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat_pelatihan`
--

INSERT INTO `riwayat_pelatihan` (`id`, `fid_user`, `kategori_diklat`, `nama_diklat`, `penyelenggara`, `tahun`, `lama`, `no_sttp`, `tgl_sttp`, `created_date`, `updated_date`) VALUES
(1, 1, 2, 'Tes diklat', 'Bappenas', '2018', '3 Hari', 'Cffdf', '2019-04-05', '2019-04-05 10:03:15', NULL),
(2, 10, 2, 'Kampus', 'Pak RT', '2015', '3 TAHUN', '123421354', '2020-09-09', '2020-09-08 20:14:49', '2020-09-08 20:15:54'),
(3, 10, 3, 'Teknik', 'Pak RW', '2015', '3 TAHUN', '123421354', '2020-09-09', '2020-09-08 20:15:37', '2020-09-08 20:16:10'),
(4, 10, 1, 'Pemimpin', 'Pak Presiden', '2011', '3 TAHUN', '123421354', '2020-09-09', '2020-09-08 20:15:38', '2020-09-08 20:16:32'),
(5, 10, 3, 'Teknik Komputer', 'Guru', '2013', '1 Tahun', '31453345', '2020-09-09', '2020-09-08 20:17:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendidikan`
--

CREATE TABLE `riwayat_pendidikan` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user` int(11) DEFAULT NULL,
  `pendidikan` smallint(2) DEFAULT NULL,
  `nama_instansi` text,
  `pimpinan_instansi` text,
  `no_ijazah` varchar(100) DEFAULT NULL,
  `tgl_ijazah` date DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat_pendidikan`
--

INSERT INTO `riwayat_pendidikan` (`id`, `fid_user`, `pendidikan`, `nama_instansi`, `pimpinan_instansi`, `no_ijazah`, `tgl_ijazah`, `created_date`, `updated_date`) VALUES
(1, 1, 1, 'SDN 60 Maros', 'Abdul Rahman', 'xxxx', '2019-04-05', '2019-04-05 10:02:26', NULL),
(2, 10, 3, 'Yuppentek 1', 'Rektor', '029282', '2020-09-09', '2020-09-08 20:14:06', '2020-09-08 20:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun_aktif` varchar(12) DEFAULT '',
  `pengguna` varchar(30) DEFAULT NULL,
  `ekin_idr` int(11) NOT NULL DEFAULT '3000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `tahun_aktif`, `pengguna`, `ekin_idr`) VALUES
(1, '2019-2023', 'Minahasa Selatan', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `skp`
--

CREATE TABLE `skp` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `fid_pegawai` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `pejabat` int(11) DEFAULT NULL,
  `atasan_pejabat` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skp_detil`
--

CREATE TABLE `skp_detil` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_skp` int(11) DEFAULT NULL,
  `jenis_tugas` smallint(1) DEFAULT NULL,
  `tugas` text,
  `ak1` varchar(20) DEFAULT NULL,
  `tar_kuant` varchar(30) DEFAULT NULL,
  `tar_kual` int(11) DEFAULT NULL,
  `tar_bln` int(2) DEFAULT NULL,
  `tar_biaya` int(11) DEFAULT NULL,
  `ak2` varchar(20) DEFAULT NULL,
  `rea_kuant` varchar(30) DEFAULT NULL,
  `rea_kual` int(11) DEFAULT NULL,
  `rea_bln` int(2) DEFAULT NULL,
  `rea_biaya` int(11) DEFAULT NULL,
  `perhitungan` decimal(4,2) DEFAULT NULL,
  `nilai` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id`, `nama`) VALUES
(1, 'Dinas Kesehatan'),
(2, 'Dinas Perumahan dan Kawasan Pemukiman'),
(3, 'Dinas Sosial'),
(4, 'Dinas Pangan'),
(5, 'Dinas Lingkungan Hidup'),
(6, 'Dinas Administrasi Kependudukan dan Pencatatan Sipil'),
(7, 'Dinas Pemberdayaan Masyarakat dan Desa'),
(8, 'Dinas Perhubungan'),
(9, 'Dinas Koperasi, Usaha Kecil dan Menengah'),
(10, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'),
(11, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Daerah');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id_upload` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_form` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file_lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id_upload`, `id_user`, `id_form`, `type`, `file_name`, `file_lokasi`) VALUES
(1, 1, 8, '1', '97qwmU1tPNbb-bg.jpg', 'public/file/97qwmU1tPNbb-bg.jpg'),
(2, 1, 8, '1', 'kle6LZ5k7FBF-pemandangan.jpeg', 'public/file/kle6LZ5k7FBF-pemandangan.jpeg'),
(3, 1, 8, '1', 'XcHD2HKAwC3m-walpaper.jpg', 'public/file/XcHD2HKAwC3m-walpaper.jpg'),
(4, 1, 9, '1', 'BLXVqzkwC0hA-walpaper.jpg', 'public/file/BLXVqzkwC0hA-walpaper.jpg'),
(5, 10, 3, '2', 'C4KZJucY2iWE-walpaper.jpg', 'public/file/C4KZJucY2iWE-walpaper.jpg'),
(6, 10, 4, '2', 'nTLkpz2JqSq4-bg.jpg', 'public/file/nTLkpz2JqSq4-bg.jpg'),
(7, 10, 5, '2', 'vheD1uQc2tKs-pemandangan.jpeg', 'public/file/vheD1uQc2tKs-pemandangan.jpeg'),
(8, 10, 2, '3', 'Pas44TroSNly-walpaper.jpg', 'public/file/Pas44TroSNly-walpaper.jpg'),
(9, 10, 2, '3', 'CM1Ymxo2Te4j-pemandangan.jpeg', 'public/file/CM1Ymxo2Te4j-pemandangan.jpeg'),
(10, 10, 2, '4', 'ECSEz22xcQ4j-pemandangan.jpeg', 'public/file/ECSEz22xcQ4j-pemandangan.jpeg'),
(11, 10, 2, '4', 'ZQ1idHfZHogh-walpaper.jpg', 'public/file/ZQ1idHfZHogh-walpaper.jpg'),
(12, 10, 3, '4', 'QTM72KUIncFK-bg.jpg', 'public/file/QTM72KUIncFK-bg.jpg'),
(13, 10, 4, '4', 'ARIoNLUvP8So-pemandangan.jpeg', 'public/file/ARIoNLUvP8So-pemandangan.jpeg'),
(14, 10, 5, '4', 'zYj4RhXN9UEX-walpaper.jpg', 'public/file/zYj4RhXN9UEX-walpaper.jpg'),
(15, 10, 2, '6', '7f2AUXQj2759-bg.jpg', 'public/file/7f2AUXQj2759-bg.jpg'),
(16, 10, 2, '6', '9BcI8m3V2NxE-pemandangan.jpeg', 'public/file/9BcI8m3V2NxE-pemandangan.jpeg'),
(17, 10, 3, '6', 'KVaU0aTmR7E6-walpaper.jpg', 'public/file/KVaU0aTmR7E6-walpaper.jpg'),
(18, 10, 3, '6', 'U4ZoYzEspZ3z-pemandangan.jpeg', 'public/file/U4ZoYzEspZ3z-pemandangan.jpeg'),
(19, 10, 3, '6', 'qJWDCkMbIWep-bg.jpg', 'public/file/qJWDCkMbIWep-bg.jpg'),
(20, 10, 2, '7', 'H6JGBHUfTFrr-bg.jpg', 'public/file/H6JGBHUfTFrr-bg.jpg'),
(21, 10, 2, '7', 'mbnEC9t075zB-pemandangan.jpeg', 'public/file/mbnEC9t075zB-pemandangan.jpeg'),
(22, 10, 3, '7', '7J6ADyVx84p5-walpaper.jpg', 'public/file/7J6ADyVx84p5-walpaper.jpg'),
(23, 10, 2, '8', 'Kbj5feo5bNqk-bg.jpg', 'public/file/Kbj5feo5bNqk-bg.jpg'),
(24, 10, 2, '8', 'fMa1PQaBTy1B-walpaper.jpg', 'public/file/fMa1PQaBTy1B-walpaper.jpg'),
(25, 10, 2, '8', 'ih7cBFnns9NK-pemandangan.jpeg', 'public/file/ih7cBFnns9NK-pemandangan.jpeg'),
(26, 10, 3, '8', '3cuOB6p1hmlW-walpaper.jpg', 'public/file/3cuOB6p1hmlW-walpaper.jpg'),
(27, 10, 2, '9', 'KKtguL9ufpvu-pemandangan.jpeg', 'public/file/KKtguL9ufpvu-pemandangan.jpeg'),
(30, 10, 3, '9', 'ocC3XZQTtOvO-walpaper.jpg', 'public/file/ocC3XZQTtOvO-walpaper.jpg'),
(31, 10, 2, '9', 'HV9tKLrHV1wE-bg.jpg', 'public/file/HV9tKLrHV1wE-bg.jpg'),
(32, 10, 2, '10', 'oDAk6hRY3iyk-pemandangan.jpeg', 'public/file/oDAk6hRY3iyk-pemandangan.jpeg'),
(33, 10, 2, '10', '3VvAI2TNqpzn-walpaper.jpg', 'public/file/3VvAI2TNqpzn-walpaper.jpg'),
(35, 10, 3, '10', 'OF5DynhhZBHm-bg.jpg', 'public/file/OF5DynhhZBHm-bg.jpg'),
(36, 10, 2, '11', '6eL8XH5urd1B-pemandangan.jpeg', 'public/file/6eL8XH5urd1B-pemandangan.jpeg'),
(37, 10, 2, '11', 'FPGnaOd2oawY-walpaper.jpg', 'public/file/FPGnaOd2oawY-walpaper.jpg'),
(39, 10, 3, '11', '00GGU4mhHGTz-bg.jpg', 'public/file/00GGU4mhHGTz-bg.jpg'),
(40, 10, 6, '1', 'SxV2DNCK75NR-bg.jpg', 'public/file/SxV2DNCK75NR-bg.jpg'),
(41, 10, 6, '1', 'ZjX0B4do6QgJ-pemandangan.jpeg', 'public/file/ZjX0B4do6QgJ-pemandangan.jpeg'),
(42, 10, 5, '1', 'bZ7JWW8aow1n-bg.jpg', 'public/file/bZ7JWW8aow1n-bg.jpg'),
(43, 10, 5, '1', 'zPC6t3BNiiyt-pemandangan.jpeg', 'public/file/zPC6t3BNiiyt-pemandangan.jpeg'),
(44, 10, 5, '1', 'qcwBrTYPtxU6-walpaper.jpg', 'public/file/qcwBrTYPtxU6-walpaper.jpg'),
(45, 10, 7, '1', 'AvAHPTKe9GfF-pemandangan.jpeg', 'public/file/AvAHPTKe9GfF-pemandangan.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_user_level` int(11) DEFAULT NULL,
  `username` varchar(35) DEFAULT NULL,
  `password` text,
  `email` varchar(100) DEFAULT NULL,
  `foto` text,
  `last_logged_in` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `active` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fid_user_level`, `username`, `password`, `email`, `foto`, `last_logged_in`, `ip_address`, `active`) VALUES
(1, 1, 'dhivar', 'beb83320d5f40511a058fb0548004a94', 'dhivar1818@gmail.com', '39f026bee8f6e9adbbd207c357fa6037.png', '2020-09-08 19:26:56', '127.0.0.1', 'YES'),
(9, 2, 'donihmrs', 'ab6ee1d8ee29090a46f27190f4a53d65', 'donihamster88@gmail.com', NULL, NULL, NULL, 'YES'),
(10, 3, 'anton', '9489cade30f2a404b056cbba1c6c49ae', 'anton@gmail.com', NULL, '2020-09-08 18:09:19', '127.0.0.1', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `nama`, `active`) VALUES
(1, 'Administrator', 1),
(2, 'PNS', 1),
(3, 'Executive', 1),
(4, 'Non-PNS', 1),
(5, 'Admin Dinas', 1),
(6, 'Verifikator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_menu` int(11) DEFAULT NULL,
  `fid_user_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `fid_menu`, `fid_user_level`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 1),
(31, 31, 1),
(32, 32, 1),
(33, 33, 1),
(34, 34, 1),
(35, 35, 1),
(36, 1, 2),
(37, 2, 2),
(38, 3, 2),
(39, 4, 2),
(40, 5, 2),
(41, 6, 2),
(42, 7, 2),
(43, 9, 2),
(44, 10, 2),
(45, 11, 2),
(46, 12, 2),
(47, 13, 2),
(48, 14, 2),
(49, 15, 2),
(50, 16, 2),
(51, 17, 2),
(52, 18, 2),
(53, 19, 2),
(54, 20, 2),
(55, 21, 2),
(56, 22, 2),
(57, 23, 2),
(58, 24, 2),
(59, 26, 2),
(60, 27, 2),
(61, 28, 2),
(62, 29, 2),
(63, 1, 3),
(64, 2, 3),
(65, 3, 3),
(66, 4, 3),
(67, 5, 3),
(68, 6, 3),
(69, 7, 3),
(70, 9, 3),
(71, 10, 3),
(72, 11, 3),
(73, 12, 3),
(74, 13, 3),
(75, 14, 3),
(76, 15, 3),
(77, 16, 3),
(78, 17, 3),
(79, 18, 3),
(80, 19, 3),
(81, 20, 3),
(82, 21, 3),
(83, 22, 3),
(84, 23, 3),
(85, 24, 3),
(86, 26, 3),
(87, 27, 3),
(88, 28, 3),
(89, 29, 3),
(90, 1, 4),
(91, 2, 4),
(92, 3, 4),
(93, 4, 4),
(94, 5, 4),
(95, 6, 4),
(96, 7, 4),
(97, 8, 4),
(98, 9, 4),
(99, 10, 4),
(100, 11, 4),
(101, 12, 4),
(102, 13, 4),
(103, 14, 4),
(104, 15, 4),
(105, 16, 4),
(106, 17, 4),
(107, 18, 4),
(108, 19, 4),
(109, 20, 4),
(110, 21, 4),
(111, 22, 4),
(112, 23, 4),
(113, 1, 5),
(114, 2, 5),
(115, 3, 5),
(116, 4, 5),
(117, 5, 5),
(118, 6, 5),
(119, 7, 5),
(120, 9, 5),
(121, 10, 5),
(122, 11, 5),
(123, 12, 5),
(124, 13, 5),
(125, 14, 5),
(126, 15, 5),
(127, 16, 5),
(128, 17, 5),
(129, 18, 5),
(130, 19, 5),
(131, 20, 5),
(132, 21, 5),
(133, 22, 5),
(134, 23, 5),
(135, 24, 5),
(136, 26, 5),
(137, 27, 5),
(138, 28, 5),
(139, 29, 5),
(140, 1, 6),
(141, 2, 6),
(142, 3, 6),
(143, 4, 6),
(144, 5, 6),
(145, 6, 6),
(146, 7, 6),
(147, 9, 6),
(148, 10, 6),
(149, 11, 6),
(150, 12, 6),
(151, 13, 6),
(152, 14, 6),
(153, 15, 6),
(154, 16, 6),
(155, 17, 6),
(156, 18, 6),
(157, 19, 6),
(158, 20, 6),
(159, 21, 6),
(160, 22, 6),
(161, 23, 6),
(162, 24, 6),
(163, 25, 6),
(164, 26, 6),
(165, 27, 6),
(166, 28, 6),
(167, 29, 6),
(168, 30, 6),
(169, 31, 6),
(170, 32, 6),
(171, 33, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_backup`
--

CREATE TABLE `user_role_backup` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid_menu` int(11) DEFAULT NULL,
  `fid_user_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role_backup`
--

INSERT INTO `user_role_backup` (`id`, `fid_menu`, `fid_user_level`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 1, 2),
(17, 15, 2),
(18, 2, 2),
(19, 3, 2),
(20, 4, 2),
(21, 5, 2),
(22, 8, 2),
(23, 9, 2),
(24, 10, 2),
(25, 11, 2),
(26, 12, 2),
(27, 13, 2),
(28, 16, 1),
(29, 17, 1),
(30, 18, 1),
(31, 14, 2),
(32, 19, 1),
(33, 20, 1),
(34, 19, 2),
(35, 20, 2),
(36, 1, 3),
(37, 2, 3),
(38, 3, 3),
(39, 4, 3),
(40, 5, 3),
(41, 8, 3),
(42, 9, 3),
(43, 10, 3),
(44, 11, 3),
(45, 12, 3),
(46, 13, 3),
(47, 15, 3),
(48, 6, 3),
(49, 7, 3),
(50, 14, 3),
(51, 19, 3),
(52, 20, 3),
(53, 21, 1),
(54, 22, 1),
(55, 21, 3),
(56, 22, 3),
(57, 23, 1),
(58, 23, 2),
(59, 23, 3),
(60, 15, 4),
(61, 1, 4),
(62, 2, 4),
(63, 3, 4),
(64, 4, 4),
(65, 5, 4),
(66, 8, 4),
(67, 9, 4),
(68, 10, 4),
(69, 11, 4),
(70, 12, 4),
(71, 13, 4),
(72, 14, 4),
(73, 19, 4),
(74, 20, 4),
(75, 23, 4),
(76, 1, 5),
(77, 15, 5),
(78, 2, 5),
(79, 3, 5),
(80, 4, 5),
(81, 5, 5),
(82, 6, 5),
(83, 7, 5),
(84, 8, 5),
(85, 9, 5),
(86, 10, 5),
(87, 11, 5),
(88, 12, 5),
(89, 13, 5),
(90, 14, 5),
(92, 21, 5),
(93, 22, 5),
(94, 19, 5),
(95, 20, 5),
(96, 23, 5),
(97, 24, 1),
(98, 25, 1),
(99, 26, 1),
(100, 27, 1),
(101, 28, 1),
(102, 29, 1),
(103, 30, 1),
(104, 31, 1),
(105, 7, 2),
(106, 26, 2),
(107, 24, 2),
(108, 25, 2),
(109, 27, 2),
(110, 28, 2),
(111, 21, 2),
(112, 29, 2),
(113, 30, 2),
(114, 31, 2),
(115, 22, 2),
(116, 7, 6),
(117, 32, 6),
(118, 33, 6),
(119, 34, 6),
(120, 35, 6),
(121, 36, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahasa_asing`
--
ALTER TABLE `bahasa_asing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disiplin`
--
ALTER TABLE `disiplin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp3`
--
ALTER TABLE `dp3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duk`
--
ALTER TABLE `duk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_keg_bulanan`
--
ALTER TABLE `ekin_keg_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_keg_bulanan_realisasi`
--
ALTER TABLE `ekin_keg_bulanan_realisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_keg_tahunan`
--
ALTER TABLE `ekin_keg_tahunan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_log`
--
ALTER TABLE `ekin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_log_prilaku`
--
ALTER TABLE `ekin_log_prilaku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_prilaku`
--
ALTER TABLE `ekin_prilaku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekin_tambahan_kreatifitas`
--
ALTER TABLE `ekin_tambahan_kreatifitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kenaikan_pangkat`
--
ALTER TABLE `kenaikan_pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kgb`
--
ALTER TABLE `kgb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_backup`
--
ALTER TABLE `menu_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pejabat`
--
ALTER TABLE `pejabat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ptk`
--
ALTER TABLE `ptk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pangkat`
--
ALTER TABLE `riwayat_pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pelatihan`
--
ALTER TABLE `riwayat_pelatihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skp`
--
ALTER TABLE `skp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skp_detil`
--
ALTER TABLE `skp_detil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id_upload`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role_backup`
--
ALTER TABLE `user_role_backup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bahasa_asing`
--
ALTER TABLE `bahasa_asing`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `disiplin`
--
ALTER TABLE `disiplin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dp3`
--
ALTER TABLE `dp3`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `duk`
--
ALTER TABLE `duk`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ekin_keg_bulanan`
--
ALTER TABLE `ekin_keg_bulanan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ekin_keg_bulanan_realisasi`
--
ALTER TABLE `ekin_keg_bulanan_realisasi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ekin_keg_tahunan`
--
ALTER TABLE `ekin_keg_tahunan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ekin_log`
--
ALTER TABLE `ekin_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `ekin_log_prilaku`
--
ALTER TABLE `ekin_log_prilaku`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ekin_prilaku`
--
ALTER TABLE `ekin_prilaku`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ekin_tambahan_kreatifitas`
--
ALTER TABLE `ekin_tambahan_kreatifitas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kenaikan_pangkat`
--
ALTER TABLE `kenaikan_pangkat`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kgb`
--
ALTER TABLE `kgb`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `menu_backup`
--
ALTER TABLE `menu_backup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pejabat`
--
ALTER TABLE `pejabat`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` smallint(1) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ptk`
--
ALTER TABLE `ptk`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `riwayat_pangkat`
--
ALTER TABLE `riwayat_pangkat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `riwayat_pelatihan`
--
ALTER TABLE `riwayat_pelatihan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `skp`
--
ALTER TABLE `skp`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `skp_detil`
--
ALTER TABLE `skp_detil`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id_upload` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `user_role_backup`
--
ALTER TABLE `user_role_backup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

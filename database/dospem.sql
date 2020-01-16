-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2019 at 10:53 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dospem`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_dosen`
--

CREATE TABLE `detail_dosen` (
  `id_dosen` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `id_parameter` int(5) NOT NULL,
  `value` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_dosen`
--

INSERT INTO `detail_dosen` (`id_dosen`, `id_kriteria`, `id_parameter`, `value`) VALUES
(1, 1, 1, 1),
(1, 2, 3, 1),
(1, 3, 9, 2),
(1, 4, 12, 3),
(2, 1, 1, 1),
(2, 2, 3, 1),
(2, 3, 9, 3),
(2, 4, 12, 3),
(3, 1, 1, 1),
(3, 2, 3, 1),
(3, 3, 9, 2),
(3, 4, 12, 3),
(4, 1, 1, 1),
(4, 2, 3, 1),
(4, 3, 9, 3),
(4, 4, 13, 4),
(5, 1, 1, 1),
(5, 2, 4, 2),
(5, 3, 9, 2),
(5, 4, 12, 3),
(6, 1, 1, 1),
(6, 2, 3, 1),
(6, 3, 9, 3),
(6, 4, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(5) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `nidn` varchar(15) NOT NULL,
  `tempat` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nip`, `nama_dosen`, `alamat`, `email`, `no_telp`, `jumlah`, `jenis_kelamin`, `nidn`, `tempat`, `tgl_lahir`, `foto`) VALUES
(1, '12341', 'Ryan Ari Setiawan S.Kom, M.Eng', 'jl. Banjar sari No 5', 'aa@gmail.com', '085675847524', 1, 'Laki-Laki', '128987656', 'Solo', '2019-07-25', ''),
(2, '12342', 'Jeffry Andhika Putra, S.T, M.M M.Eng', 'Jl. Solo Jogja KM 5', 'bb@gmail.com', '085675847523', 1, '', '', '', '0000-00-00', ''),
(3, '12343', 'Jemmy Edwin Bororing S.Kom M.Eng', 'Jl. Solo Jogja KM 5', 'cc@gmail.com', '085675847526', 1, '', '', '', '0000-00-00', ''),
(4, '112100481', 'Yurmalin MZ S.Kom M.Pd M.Kom', 'gamping', 'yurmalin@janabadra.ac.id', '08157986629', 1, 'Perempuan', '0504077303', 'curup', '1973-04-07', '28b.JPG'),
(5, '12345', 'Fatsyahrina Fitriastuti S.Si M.T', 'Jl. Solo Jogja KM 6', 'fatsya@gmail.com', '085675847544', 1, '', '', '', '0000-00-00', ''),
(6, '12346', 'Sofyan Lukmanfiandy S.Kom M.Kom', 'Jl. Solo Jogja KM 6', 'sofyan@gmail.com', '08567584711', 1, 'Perempuan', '12344', 'Sragen', '2019-07-18', '');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_tugasakhir` int(5) NOT NULL,
  `id_dosen` int(5) NOT NULL,
  `skor` double NOT NULL,
  `dospem` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_tugasakhir`, `id_dosen`, `skor`, `dospem`) VALUES
(2, 1, 8.75, 1),
(2, 2, 7.4166666666667, NULL),
(2, 3, 7.4166666666667, NULL),
(2, 4, 7.6666666666667, NULL),
(2, 5, 9.75, 1),
(2, 6, 7.4166666666667, NULL),
(4, 1, 8.75, 1),
(4, 2, 7.4166666666667, NULL),
(4, 3, 7.4166666666667, NULL),
(4, 4, 7.6666666666667, NULL),
(4, 5, 9.75, 1),
(4, 6, 7.4166666666667, NULL),
(5, 1, 7.4166666666667, NULL),
(5, 2, 7.4166666666667, NULL),
(5, 3, 8.75, 1),
(5, 4, 9, 1),
(5, 5, 8.4166666666667, NULL),
(5, 6, 7.4166666666667, NULL),
(3, 1, 7.4166666666667, NULL),
(3, 2, 7.4166666666667, NULL),
(3, 3, 8.75, 1),
(3, 4, 9, 1),
(3, 5, 8.4166666666667, NULL),
(3, 6, 7.4166666666667, NULL),
(1, 1, 7.4166666666667, NULL),
(1, 2, 7.4166666666667, NULL),
(1, 3, 8.75, 1),
(1, 4, 9, 1),
(1, 5, 8.4166666666667, NULL),
(1, 6, 7.4166666666667, NULL),
(6, 1, 8.75, 1),
(6, 2, 7.4166666666667, NULL),
(6, 3, 7.4166666666667, NULL),
(6, 4, 7.6666666666667, NULL),
(6, 5, 9.75, 1),
(6, 6, 7.4166666666667, NULL),
(7, 1, 7.4166666666667, NULL),
(7, 2, 8.75, 1),
(7, 3, 7.4166666666667, NULL),
(7, 4, 7.6666666666667, NULL),
(7, 5, 8.4166666666667, NULL),
(7, 6, 8.75, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id_kompetensi` int(5) NOT NULL,
  `id_dosen` int(5) NOT NULL,
  `id_parameter` int(5) NOT NULL,
  `nilaii` decimal(2,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id_kompetensi`, `id_dosen`, `id_parameter`, `nilaii`) VALUES
(3, 1, 9, '2'),
(4, 1, 8, '3'),
(5, 1, 7, '2'),
(6, 2, 9, '3'),
(7, 2, 8, '2'),
(8, 2, 7, '2'),
(9, 3, 9, '2'),
(10, 3, 8, '2'),
(11, 3, 7, '3'),
(12, 4, 9, '2'),
(13, 4, 8, '2'),
(14, 4, 7, '3'),
(15, 6, 7, '2'),
(16, 6, 8, '2'),
(17, 6, 9, '3'),
(18, 5, 7, '2'),
(19, 5, 8, '3'),
(20, 5, 9, '2');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `jenis` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `jenis`) VALUES
(1, 'Pendidikan', 3, 'Benefit'),
(2, 'Jabatan Fungsional ', 2, 'Benefit'),
(3, 'Kompetensi', 4, 'Benefit'),
(4, 'Jumlah Artikel', 1, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(5) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama_matkul`) VALUES
(1, 'Statistika dan Probabilitas'),
(2, 'Kecerdasan Buatan'),
(3, 'Sistem Pakar'),
(4, 'Sistem Pengambilan Keputusan '),
(6, 'Sistem Pakar');

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id_parameter` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `nama_parameter` varchar(50) NOT NULL,
  `nilai` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id_parameter`, `id_kriteria`, `nama_parameter`, `nilai`) VALUES
(1, 1, 'S2', 1),
(2, 1, 'S3', 3),
(3, 2, 'Asisten Ahli', 1),
(4, 2, 'Lektor', 2),
(5, 2, 'Lektor Kepala', 3),
(6, 2, 'Guru Besar', 4),
(7, 3, 'Soft Computing', 1),
(8, 3, 'Mobile', 2),
(9, 3, 'Enterprise', 3),
(10, 4, '>3', 1),
(11, 4, '>5', 2),
(12, 4, '>7', 3),
(13, 4, '>10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id_penelitian` int(5) NOT NULL,
  `id_dosen` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `id_dosen`, `judul`, `tahun`, `keterangan`) VALUES
(5, 4, 'TEMU KEMBALI CITRA BATIK PESISIR ', '2017', 'JURNAL INFORMASI INTERAKTIF'),
(6, 4, 'EVALUASI DATABASE SISTEM INFORMASI ALUMNI YUDISIUM MENGUNAKAN  METODE TAM', '2017', 'JURNAL INFORMASI INTERNATIF'),
(7, 1, 'Pengembangan Aplikasi Untuk Mendeteksi Pergerakan Sendi Pada Pasien Pasca Stroke Menggunakan Sensor ', '2018', 'Informasi Interaktif informatika dan Teknologi Informasi '),
(8, 4, ' PROTOTYPE SISTEM  PENDUKUNG KEPUTUSAN PEMILIHAN KAMERA DIGITAL', '2018', 'INFORMASI INTERAKTIF JURNAL INFORMATIKA DAN TEKNOLOGI INTERAKTIF'),
(9, 1, 'Pengembangan Aplikasi Untuk Mendeteksi Pergerakan Sendi Pada Pasien Pasca Stroke Menggunakan Sensor ', '2018', 'INFORMASI INTERAKTIF JURNAL INFORMATIKA DAN TEKNOLOGI INFORMASI'),
(10, 5, 'IMPLEMENTASI SISTEM CAPTIVE PORTAL PADA BROWSER DENGAN INTEGRASI SISTEM LIMITER DAN PEMBAGIAN AKSES', '2016', '-'),
(11, 4, 'MULTIMEDIA PEMBELAJARAN BAHASA INGGRIS MENGGUNAKAN METODE GOAL DIRECTED DESIGN (STUDI KASUS TK ISLAM', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(12, 3, 'PENERAPAN QUICK RESPONSE CODE UNTUK PRESENSI RESPONSIF BERBASIS ANDROID', '2016', '-'),
(13, 2, 'VISUALISASI TOURISM GUIDE DAERAH ISTIMEWA YOGYAKARTA BERBASIS FLASH', '2016', '-'),
(14, 4, 'APLIKASI TEMBANG MACAPAT BERBASIS MULTIMEDIA', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(15, 4, 'EVALUASI PENGGUNAAN WEBSITE UNIVERSITAS JANABADRA DENGAN MENGGUNAKAN METODE USABILITY TESTING', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(16, 6, 'PEMBUATAN ROBOT PENGIKUT GARIS DENGAN PERINTAH SUARA', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(17, 3, 'RANCANG BANGUN E-LEARNING UNIVERSITAS JANABADRA MENGGUNAKAN EFRONT', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(18, 5, ' RANCANG BANGUN E-LEARNING UNIVERSITAS JANABADRA MENGGUNAKAN EFRONT', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(19, 5, 'RANCANG BANGUN SISTEM INFORMASI SEKOLAH BERBASIS WEB MENGGUNAKAN CMS FORMULASI', '2016', 'JURNAL INFORMASI INTERAKTIF'),
(20, 5, 'PENERAPAN TEKNIK ONTOLOGY UNTUK PENCARIAN DATA AKADEMIK', '2017', 'JURNAL INFORMASI INTERAKTIF'),
(21, 5, 'PENGEMBANGAN MOBILE LEARNING UNTUK MATA KULIAH JARINGAN KOMPUTER BERBASIS ANDROID', '2017', 'JURNAL INFORMASI INTERAKTIF'),
(22, 4, 'PENGEMBANGAN MOBILE LEARNING UNTUK MATA KULIAH JARINGAN KOMPUTER BERBASIS ANDROID', '2017', 'JURNAL INFORMASI INTERAKTIF'),
(23, 3, 'PENERAPAN TEKNIK ONTOLOGY UNTUK PENCARIAN DATA AKADEMIK', '2017', 'JURNAL INFORMASI INTERAKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

CREATE TABLE `pengabdian` (
  `id_pengabdian` int(5) NOT NULL,
  `id_dosen` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`id_pengabdian`, `id_dosen`, `judul`, `tahun`, `keterangan`) VALUES
(3, 1, 'Pengabdian 1', '2017', 'Penelitian pengabdian 1');

-- --------------------------------------------------------

--
-- Table structure for table `pengampu`
--

CREATE TABLE `pengampu` (
  `id_dosen` int(5) NOT NULL,
  `id_matkul` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengampu`
--

INSERT INTO `pengampu` (`id_dosen`, `id_matkul`) VALUES
(1, 1),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tugasakhir`
--

CREATE TABLE `tugasakhir` (
  `id_tugasakhir` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `tgl_input` date NOT NULL,
  `id_parameter` int(5) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugasakhir`
--

INSERT INTO `tugasakhir` (`id_tugasakhir`, `judul`, `nim`, `nama_mahasiswa`, `tgl_input`, `id_parameter`, `status`) VALUES
(1, 'Sistem Rekomendasi Penentuan Dosen Pembimbing Mengunakan Metode SAW Berbasis Web', '13330012', 'M Fahril Tukuboya', '2019-06-28', 7, 'Aktif'),
(6, 'Implementasi Aplikasi Augmented Reality Rumah Adat Timor Leste Menggunakan Metode Markerless Berbasi', '13330012', 'Valentino de costa', '2019-07-30', 8, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(13) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'member',
  `foto` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nip`, `nama`, `no_telp`, `level`, `foto`) VALUES
(2, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1234567', 'Administrator 1', '0878675643', 'admin', '64user2-160x160.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id_penelitian`);

--
-- Indexes for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD PRIMARY KEY (`id_pengabdian`);

--
-- Indexes for table `tugasakhir`
--
ALTER TABLE `tugasakhir`
  ADD PRIMARY KEY (`id_tugasakhir`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id_kompetensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id_parameter` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id_penelitian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pengabdian`
--
ALTER TABLE `pengabdian`
  MODIFY `id_pengabdian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tugasakhir`
--
ALTER TABLE `tugasakhir`
  MODIFY `id_tugasakhir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

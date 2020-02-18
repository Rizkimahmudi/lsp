-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2020 pada 05.43
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(100) NOT NULL,
  `nm_admin` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_detail` varchar(25) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nm_admin`, `password`, `id_detail`, `status`) VALUES
('1211101', 'Messi', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211101', 'peserta'),
('1211102', 'Neymar', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211102', 'peserta'),
('1211103', 'Luis Suarwz', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211103', 'peserta'),
('1211104', 'Iniesta', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211104', 'peserta'),
('1211105', 'Rakitic', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211105', 'peserta'),
('1211106', 'Bosquest', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211106', 'peserta'),
('1211107', 'Sergio', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211107', 'peserta'),
('1211108', 'Pique', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211108', 'peserta'),
('1211109', 'Mascherano', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211109', 'peserta'),
('1211110', 'Jordi Alba', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211110', 'peserta'),
('1211111', 'Terstegen', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-1211111', 'peserta'),
('131110616', 'DAVID HERLIANTO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110616', 'peserta'),
('131110617', 'NICKY PRATAMA SUGIANTO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110617', 'peserta'),
('131110618', 'RIKI AZHARI', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110618', 'peserta'),
('131110619', 'BURHANNUDIN', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110619', 'peserta'),
('131110620', 'JOSHUA LORENZO ANDRE', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110620', 'peserta'),
('131110621', 'SRI PRAPTI INDAR DERITA', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110621', 'peserta'),
('131110622', 'ROMARYO ALVAREZ NDEO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110622', 'peserta'),
('131110623', 'ENDAH LAKSMITA PUTRI', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110623', 'peserta'),
('131110624', 'NIKO YOHAN', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110624', 'peserta'),
('131110625', 'LAILY FEBRIANTY', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110625', 'peserta'),
('131110626', 'ADI BAYU PERMADI', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110626', 'peserta'),
('131110627', 'PRATAMA SANJAYA SOETIKNO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110627', 'peserta'),
('131110628', 'MUHAMMAD FAHMI AYILILAHI', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110628', 'peserta'),
('131110629', 'FIRLIAN WIDIANTO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110629', 'peserta'),
('131110630', 'REVALDY PUTRA MALEPPE', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110630', 'peserta'),
('131110631', 'JANUARITA LYSA EKA PUTRA', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110631', 'peserta'),
('131110632', 'RANDY HARYONO DIANTO ALOFANI', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110632', 'peserta'),
('131110633', 'ANGGI WAHYU TRIPRASETYO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110633', 'peserta'),
('131110634', 'ADHYATMA AJI SASONGKO', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110634', 'peserta'),
('131110635', 'NOVIA GUNARTI', 'bc0808de9100ebfad67de7e093b14a69', 'mhs-131110635', 'peserta'),
('admin', 'Admin', 'bc0808de9100ebfad67de7e093b14a69', '', 'admin'),
('direktur', 'Bu Laila', 'bc0808de9100ebfad67de7e093b14a69', '', 'manager'),
('M0001', 'Anang', 'bc0808de9100ebfad67de7e093b14a69', 'mitra-1', 'peserta'),
('M0002', 'Candra', 'bc0808de9100ebfad67de7e093b14a69', 'mitra-2', 'peserta'),
('M0003', 'DIan', 'bc0808de9100ebfad67de7e093b14a69', 'mitra-3', 'peserta'),
('M0004', 'Zulfa', 'bc0808de9100ebfad67de7e093b14a69', 'mitra-4', 'peserta'),
('M0005', 'Sumid', 'bc0808de9100ebfad67de7e093b14a69', 'mitra-5', 'peserta'),
('manager', 'Manager', 'bc0808de9100ebfad67de7e093b14a69', '', 'manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asesor`
--

CREATE TABLE `asesor` (
  `NIP` varchar(25) NOT NULL,
  `nm_asesor` varchar(35) DEFAULT NULL,
  `gelar_depan` varchar(15) DEFAULT NULL,
  `gelar_belakang` varchar(15) DEFAULT NULL,
  `alamat_asesor` varchar(160) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `tempat_lhr` varchar(15) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `jk_asesor` char(10) DEFAULT NULL,
  `pend_terakhir` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `no_met` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `asesor`
--

INSERT INTO `asesor` (`NIP`, `nm_asesor`, `gelar_depan`, `gelar_belakang`, `alamat_asesor`, `telp`, `email`, `tempat_lhr`, `tgl_lahir`, `agama`, `jk_asesor`, `pend_terakhir`, `status`, `no_met`) VALUES
('010004', 'Indra Soegiharto', 'Dipl. Ing', 'S H., MBA.', 'Ngagel Jaya Tengah IV/16 RT. 06 RW. 03 Pucung Sewu, Gubeng, Surabaya', '0818383615', 'indra.soegiharto@stiki.ac.id', 'Lasem', '1952-09-04', NULL, 'laki-laki', 'S2', 1, 'MET.000.002915 2016'),
('010034', 'Anita', NULL, 'S.Kom, M.T', 'Jl. Taman Sulfat III no.11 Malang', '08125259973', 'ant@stiki.ac.id', 'Banyuwangi', '1975-07-07', NULL, 'perempuan', 'S2', 1, 'MET.000.005241 2015'),
('010040', 'Sugeng Widodo', NULL, 'M.Kom', 'Jl. Titan Asri 11 / DD 5 RT. 3/12 Pandanwangi Blimbing Malang', '0817389721', 'sugengw@stiki.ac.id', 'Tembagapura', '1973-12-29', NULL, 'laki-laki', 'S2', 1, 'MET.000.002881 2016'),
('010041', 'Jozua F. Palandi', NULL, 'M.Kom', 'Jl. Barek No.18 RT. 01 RW. 05, Bunulrejo, Blimbing Malang', '085755789898', 'jozuafp@stiki.ac.id', 'Malang', '1972-05-12', NULL, 'laki-laki', 'S2', 1, 'MET.000.000696 2016'),
('010045', 'Laila Isyriyah', NULL, 'M.Kom', 'Jl. Arjuno 11 RT. 06 RW. 05, Sisir, Batu-Malang', '081334163338', 'laila@stiki.ac.id', 'Malang', '1972-02-24', NULL, 'perempuan', 'S2', 1, 'MET.000.000699 2016'),
('010052', 'Daniel Rudiaman Sijabat', NULL, 'ST., M.Kom', 'Jl. Jayagiri 10 RT. 06 RW. 01 Karangbesuki, Sukun', '081334289205', 'daniel223@stiki.ac.id', 'Kabanjahe', '1971-03-22', NULL, 'laki-laki', 'S2', 1, 'MET.000.002882 2016'),
('010063', 'Diah Arifah Prastiningtiyas', NULL, 'S.Kom, M.T', 'Bukit Cemara Tidar Blok I-2/ 12 RT. 06 RW. 09, Karangbesuki, Sukun, Malang', '081330722409', 'diah@stiki.ac.id', 'Probolinggo', '1978-02-20', NULL, 'perempuan', 'S2', 1, 'MET.000.005240 2015'),
('010067', 'Setiabudi Sakaria', NULL, 'M.Kom', 'Jl. Puncak Malino 25 RT. 05 RW. 10 Pisangcandi, Sukun', '0818381699', 'setiabudi@stiki.ac.id', 'Blitar', '1969-01-01', NULL, 'laki-laki', 'S2', 1, 'MET.000.005239 2015'),
('010077', 'Subari', NULL, 'M.Kom', 'Tirtasari Residence, Jl. Cluster Raya Tigris No.11 RT. 07/04 Sitirejo Wagir Malang', '08123383553', 'subari@stiki.ac.id', 'Pasuruan', '1972-02-02', NULL, 'laki-laki', 'S2', 1, 'MET.000.002880 2016'),
('010080', 'Johan Ericka Wahyu Prakasa.', NULL, 'M.Kom', 'Jl. Danau Maninjau Tengah V B3-D1 RT. 08 RW. 09 Sawojajar, Kedungkandang Malang', '081234302099', 'johan@stiki.ac.id', 'Malang', '1983-12-13', NULL, 'laki-laki', 'S2', 1, 'MET.000.001074 2016'),
('010081', 'Saiful Yahya', NULL, 'S.Sn, M.T', 'Perum Banjararum View Blok AT No. 01 RT. 01 RW. 14 Watugede, Singosari', '085649933502', 'yahya@stiki.ac.id', 'Malang', '1980-10-31', NULL, 'laki-laki', 'S2', 1, 'MET.000.001166 2015'),
('010096', 'Meivi Kartikasari', NULL, 'S.Kom., M.T', 'Bukit Cemara Tidar C2 / 8 RT. 01 RW. 09 Karangbesuki, Sukun', '085646311802', 'meivi.k@stiki.ac.id', 'Sidoarjo', '1977-05-25', NULL, 'perempuan', 'S2', 1, 'MET.000.008475 2015'),
('010106', 'Koko Wahyu Prasetyo', NULL, 'S.Kom, M.TI', 'Jl. Terusan Surabaya No. 89 RT. 02 RW. 05 Sumbersari Lowokwaru', '081334868640', 'koko@stiki.ac.id', 'Malang', '1985-07-27', NULL, 'laki-laki', 'S2', 1, 'MET.000.008468 2015'),
('020107', 'Dedy Ari Purnomo', NULL, 'S.Kom', 'Dsn. Morosemo Ds. Sumberagung RT. 01/16 Plumpang-Tuban', '08563344998', 'dedyari@stiki.ac.id', '', '1989-07-11', NULL, 'laki-laki', 'S1', 1, 'MET.000.000710 2016'),
('040063', 'Mahendra Wibawa', NULL, 'S.Sn, M.Pd', 'Jl. Puncak Jaya 29 Malang', '08113601762', 'mahendra@stiki.ac.id', 'Malang', '1980-03-12', NULL, 'laki-laki', 'S2', 1, 'MET.000.001072 2016');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_jadwal`
--

CREATE TABLE `dtl_jadwal` (
  `id_dtl_jadwal` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_pendaftaran` varchar(30) NOT NULL,
  `status_kehadiran` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dtl_jadwal`
--

INSERT INTO `dtl_jadwal` (`id_dtl_jadwal`, `id_jadwal`, `id_pendaftaran`, `status_kehadiran`) VALUES
(1, 6, '295 00059 2016', '1'),
(2, 6, '295 00067 2016', '1'),
(3, 6, '295 00050 2016', '1'),
(4, 6, '295 00051 2016', '1'),
(5, 6, '295 00068 2016', '1'),
(6, 6, '295 00061 2016', '1'),
(7, 6, '295 00057 2016', '1'),
(8, 6, '295 00077 2016', '1'),
(9, 7, '295 00052 2016', '1'),
(10, 7, '295 00058 2016', '1'),
(11, 7, '295 00060 2016', '1'),
(12, 7, '295 00072 2016', '1'),
(13, 7, '295 00066 2016', '1'),
(14, 7, '295 00064 2016', '1'),
(15, 7, '295 00065 2016', '1'),
(16, 7, '295 00075 2016', '1'),
(17, 7, '295 00053 2016', '1'),
(18, 8, '295 00073 2016', '1'),
(19, 8, '295 00054 2016', '1'),
(20, 8, '295 00063 2016', '1'),
(21, 8, '295 00062 2016', '1'),
(22, 8, '295 00056 2016', '1'),
(23, 8, '295 00055 2016', '1'),
(33, 2, '295 00014 2016', '1'),
(34, 2, '295 00042 2016', '1'),
(35, 2, '295 00015 2016', '1'),
(36, 2, '295 00074 2016', '1'),
(37, 2, '295 00016 2016', '1'),
(38, 2, '295 00017 2016', '1'),
(39, 2, '295 00018 2016', '1'),
(40, 2, '295 00047 2016', '1'),
(41, 2, '295 00019 2016', '1'),
(42, 2, '295 00020 2016', '1'),
(43, 3, '295 00021 2016', '1'),
(44, 3, '295 00022 2016', '1'),
(45, 3, '295 00023 2016', '1'),
(46, 3, '295 00024 2016', '1'),
(47, 3, '295 00025 2016', '1'),
(48, 3, '295 00026 2016', '1'),
(49, 3, '295 00048 2016', '1'),
(50, 3, '295 00027 2016', '1'),
(51, 3, '295 00028 2016', '1'),
(52, 3, '295 00029 2016', '1'),
(53, 4, '295 00030 2016', '1'),
(54, 4, '295 00045 2016', '1'),
(55, 4, '295 00031 2016', '1'),
(56, 4, '295 00049 2016', '1'),
(57, 4, '295 00032 2016', '1'),
(58, 4, '295 00033 2016', '1'),
(59, 4, '295 00034 2016', '1'),
(60, 4, '295 00041 2016', '1'),
(61, 5, '295 00035 2016', '1'),
(62, 5, '295 00036 2016', '1'),
(63, 5, '295 00037 2016', '1'),
(64, 5, '295 00038 2016', '1'),
(65, 5, '295 00039 2016', '1'),
(66, 5, '295 00040 2016', '1'),
(67, 5, '295 00044 2016', '1'),
(68, 5, '295 00046 2016', '1'),
(69, 9, '295 00001 2016', '1'),
(70, 9, '295 00002 2016', '1'),
(71, 9, '295 00003 2016', '1'),
(72, 9, '295 00004 2016', '1'),
(73, 9, '295 00005 2016', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_kompetensi`
--

CREATE TABLE `dtl_kompetensi` (
  `id_dtl_kompetensi` int(11) NOT NULL,
  `id_kompetensi` int(11) NOT NULL,
  `asesmen_mandiri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_skema`
--

CREATE TABLE `dtl_skema` (
  `id_dt_skema` int(11) NOT NULL,
  `kd_unit` varchar(15) DEFAULT NULL,
  `jdl_kompetensi` text,
  `id_skema` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dtl_skema`
--

INSERT INTO `dtl_skema` (`id_dt_skema`, `kd_unit`, `jdl_kompetensi`, `id_skema`, `order`, `status`) VALUES
(1, 'J.620100.001.01', 'Menganalisis Tools', 1, 1, 1),
(2, 'J.591120.030.01', 'Membuat gambar penceritaan (storyboard drawing)', 2, 0, 1),
(3, 'J.620100.002.01', 'Menganalisis skalabilitas perangkat lunak', 1, 2, 1),
(4, 'J.620100.003.01', 'Melakukan IdentifikasiLibrary, komponen atau\r\nframework yang diperlukan', 1, 3, 1),
(5, 'J.620100.006.01', 'Merancang user experience', 1, 4, 1),
(6, 'J.620100.017.02', 'Mengimplementasikan pemrograman terstruktur', 1, 5, 1),
(7, 'J.620100.018.02', 'Mengimplementasikan pemrograman\r\nberorientasi objek', 1, 6, 1),
(8, 'J.620100.020.02', 'Menggunakan SQL', 1, 7, 1),
(9, 'J.620100.021.02', 'Menerapkan akses basis data', 1, 8, 1),
(10, 'J.620100.022.02', 'Mengimplementasikan algoritma pemrograman', 1, 9, 1),
(11, 'J.620100.024.02', 'Melakukan migrasi ke teknologi baru', 1, 10, 1),
(12, 'J.591120.031.01', 'Membuat sudut pandang kamera digital', 2, 0, 1),
(13, 'J.591120.032.01', 'Membuat skrip penceritaan (script writing)', 2, 0, 1),
(14, 'J.591120.033.01', 'Membuat skenario', 2, 0, 1),
(15, 'J.591120.034.01', 'Membuat standart produksi desain properti (property design)', 2, 0, 1),
(16, 'J.591120.035.01', 'Membuat standart produksi desain suasana (environment design)', 2, 0, 1),
(17, 'J.591120.036.01', 'Membuat standart produksi desain karakter (character design)', 2, 0, 1),
(18, 'J.591120.037.01', 'Melakukan pengawasan organisasi dan menyelia kegiatan produksi secara menyeluruh (executing/producing)', 2, 0, 1),
(19, 'BSBSUS301A', 'Melaksanakan dan memantau praktik kerja yang ramah lingkungan', 3, 0, 1),
(20, 'ICAICT401A', 'Menentukandan mengkonfirmasi kebutuhan bisnis klien', 3, 0, 1),
(21, 'ICAICT403A', 'Menerapkan metodologi pengembangan perangkat lunak', 3, 0, 1),
(22, 'ICAICT405A', 'Mengembangkan desain teknis secara rinci', 3, 0, 1),
(23, 'ICAICT418A', 'Berkontribusi hak cipta, etika dan privasidi lingkungan IT', 3, 0, 1),
(24, 'ICAPRG405A', 'Proses otomatisasi', 3, 0, 1),
(25, 'ICASAD401A', 'Mengembangkan dan laporan kelayakan ini', 3, 0, 1),
(26, 'ICAICT402A', 'Menentukan spesifikasi proyek dan pembuatan perjanjian dengan client', 3, 0, 1),
(27, 'ICAICT408A', 'Menyusun dokumen teknik', 3, 0, 1),
(28, 'ICAPMG401A', 'Dukungan pada proyek IT skala kecil', 3, 0, 1),
(29, 'J.620100.004.01', 'Menggunakan Struktur Data', 4, 1, 1),
(30, 'J.620100.025.02', 'Melakukan debugging', 1, 11, 1),
(31, 'J.620100.030.02', 'Menerapkan pemrograman multimedia', 1, 12, 1),
(32, 'J.620100.032.01', 'Menerapkan code review', 1, 13, 1),
(33, 'J.620100.036.02', 'Melaksanakan pengujian kode program secara\r\nstatis', 1, 14, 1),
(34, 'J.620100.044.01', 'Menerapkan alert notification jika aplikasi\r\nbermasalah', 1, 15, 1),
(35, 'J.620100.045.01', 'Melakukan pemantauan resource yang digunakan\r\naplikasi', 1, 16, 1),
(36, 'J.620100.047.01', 'Melakukan pembaharuan perangkat lunak', 1, 17, 1),
(37, 'J.620100.005.02', 'Mengimplementasikan User Interface', 4, 2, 1),
(38, 'J.620100.011.01', 'Melakukan Instalasi Software Tools Pemrograman', 4, 3, 1),
(39, 'J.620100.016.01', 'Menulis Kode Dengan Prinsip sesuai guidelines\r\ndan best praktis', 4, 4, 1),
(40, 'J.620100.017.02', 'Mengimplementasikan pemrograman terstruktur', 4, 5, 1),
(41, 'J.620100.019.02', 'Menggunakan Library atau komponen Pre-\r\nExisting', 4, 6, 1),
(42, 'J.620100.023.02', 'Membuat Dokumen Kode Program', 4, 7, 1),
(43, 'J.620100.025.02', 'Melakukan debugging', 4, 8, 1),
(44, 'J.612000.011', 'Merancang mobile security measurement', 5, 1, 1),
(45, 'J.612000.012', 'Mengembangkan smart client security', 5, 2, 1),
(46, 'J.612000.013', 'Melakukan Instalasi Software Tools Pemrograman', 5, 3, 1),
(47, 'J.612000.014', 'Melaksanakan mobile forensic', 5, 4, 1),
(48, 'J.612000.015', 'Membuat mobile unified communication', 5, 5, 1),
(49, 'J.612000.016', 'Mengembangkan mobile financial', 5, 6, 1),
(50, 'J.612000.019', 'Merancang mobile cloud computing', 5, 7, 1),
(51, 'J.612000.021', 'Mengembangkan Mobile Sensor pada Mobile\r\nComputing Environment', 5, 8, 1),
(52, 'J.612000.026', 'Merancang spesifikasi teknis smart phone/ tablet\r\nsesuai kebutuhan pengguna', 5, 9, 1),
(53, 'J.612000.035', 'Menunjukkan Internet of Things (IoT) dan smart\r\ncity technology', 5, 10, 1),
(54, 'J.620100.001.01', 'Menganalisis Tools', 6, 1, 1),
(55, 'J.620100.003.01', 'Melakukan IdentifikasiLibrary, komponen atau\r\nframework yang diperlukan', 6, 2, 1),
(56, 'J.620100.004.01', 'Menggunakan struktur data', 6, 3, 1),
(57, 'J.620100.007.02', 'Mengimplementasikan rancangan entitias dan\r\nketerkaitan antar entitas', 6, 4, 1),
(58, 'J.620100.020.02', 'Menggunakan SQL', 6, 5, 1),
(59, 'J.620100.021.02', 'Menerapkan akses basis data', 6, 6, 1),
(60, 'J.620100.022.02', 'Mengimplementasikan Algoritma Pemrograman', 6, 7, 1),
(61, 'J.620100.025.02', 'Melakukan debugging', 6, 8, 1),
(62, 'J.620100.032.01', 'Menerapkan code review', 6, 9, 1),
(63, 'J.620100.042.01', 'Melaksanakan konfigurasi perangkat lunak sesuai\r\nenvironment', 6, 10, 1),
(64, 'J.620100.043.01', 'Menganalisis dampak perubahan terhadap\r\naplikasi', 6, 11, 1),
(65, 'J.620100.045.01', 'Melakukan pemantauan resource yang digunakan\r\naplikasi', 6, 12, 1),
(66, 'J.620100.047.01', 'Melakukan pembaharuan perangkat lunak', 6, 13, 1),
(67, 'J.62090.011.01', 'Menerapkan standar-standar keamanan informasi\r\nyang berlaku', 6, 14, 1),
(68, 'J.591120.030.01', 'Membuat gambar penceritaan\r\n(storyboard drawing)', 7, 1, 1),
(69, 'J.591120.031.01', 'Membuat sudut pandang kamera digital', 7, 2, 1),
(70, 'J.591120.032.01', 'Membuat skrip penceritaan (script\r\nwriting)', 7, 3, 1),
(71, 'J.591120.033.01', 'Membuat skenario', 7, 4, 1),
(72, 'J.591120.034.01', 'Membuat standar produksi desain\r\nproperty (property design)', 7, 5, 1),
(73, 'J.591120.035.01', 'Membuat standar produksi desain\r\nsuasana (environment design)', 7, 6, 1),
(74, 'J.591120.037.01', 'Melakukan pengawasan organisasi dan menyelia\r\nkegiatan produksi secara meny', 7, 8, 1),
(75, 'M.74100.001.02', 'Mengaplikasikan Prinsip Dasar Desain', 8, 1, 1),
(76, 'M.74100.002.02', 'Menerapkan Prinsip Dasar Komunikasi', 8, 2, 1),
(77, 'M.74100.003.02', 'Menerapkan Pengetahuan Produksi Desain', 8, 3, 1),
(78, 'M.74100.005.02', 'Menerapkan Design Brief', 8, 4, 1),
(79, 'M.74100.008.02', 'Menetapkan Konsep Desain', 8, 5, 1),
(80, 'M.74100.009.02', 'Mengoperasikan Perangkat Lunak Desain', 8, 6, 1),
(81, 'M.74100.010.01', 'Menciptakan Karya Desain', 8, 7, 1),
(82, 'M.74100.013.02', 'Membuat Materi Siap Produksi', 8, 8, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(15) NOT NULL,
  `nm_harga` varchar(30) DEFAULT NULL,
  `jns_harga` varchar(20) DEFAULT NULL,
  `jml_harga` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `kd_tuk` varchar(15) NOT NULL,
  `id_skema` int(11) NOT NULL,
  `id_asesor` varchar(11) NOT NULL,
  `tgl_sertifikasi` date NOT NULL,
  `jam_sertifikasi` time NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kd_tuk`, `id_skema`, `id_asesor`, `tgl_sertifikasi`, `jam_sertifikasi`, `status`) VALUES
(2, 'TUK-02', 1, '010106', '2016-07-14', '08:00:00', '1'),
(3, 'TUK-03', 1, '010106', '2016-07-14', '08:00:00', '1'),
(4, 'TUK-03', 1, '010077', '2016-07-14', '08:00:00', '1'),
(5, 'TUK-04', 1, '010040', '2016-07-14', '08:00:00', '1'),
(6, 'TUK-01', 3, '010034', '2016-07-14', '08:00:00', '1'),
(7, 'TUK-01', 3, '010063', '2016-07-14', '08:00:00', '1'),
(8, 'TUK-01', 3, '010067', '2016-07-14', '08:00:00', '1'),
(9, 'TUK-01', 1, '010040', '2016-06-22', '08:00:00', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jns_daftar`
--

CREATE TABLE `jns_daftar` (
  `id_jns_daftar` int(10) NOT NULL,
  `nm_jns_daftar` varchar(30) DEFAULT NULL,
  `ket` varchar(35) DEFAULT NULL,
  `jmlh_bayar` text NOT NULL,
  `is_ujian` int(11) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jns_daftar`
--

INSERT INTO `jns_daftar` (`id_jns_daftar`, `nm_jns_daftar`, `ket`, `jmlh_bayar`, `is_ujian`, `status`) VALUES
(1, 'Pendaftaran Baru', 'Pendaftaran Sertifikasi baru', '{\"mahasiswa\":\"350000\",\"mitra\":\"500000\"}', 1, 1),
(2, 'Pendaftaran Ulang', 'Pendaftaran Sertifikasi Ulang', '{\"mahasiswa\":\"150000\",\"mitra\":\"200000\"}', 1, 1),
(3, 'Perpanjangan', 'Perpanjangan sertifikasi', '{\"mahasiswa\":\"250000\",\"mitra\":\"300000\"}', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id_kompetensi` int(10) NOT NULL,
  `nm_kompetensi` varchar(20) DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `id_dtl_skema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NRP` varchar(12) NOT NULL DEFAULT '0',
  `nm_mahasiswa` varchar(40) DEFAULT NULL,
  `alamat_mhs` varchar(160) DEFAULT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk_mhs` char(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `telp_hp` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `kodepos` int(10) DEFAULT NULL,
  `telp_rumah` varchar(15) DEFAULT NULL,
  `kantor` varchar(35) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NRP`, `nm_mahasiswa`, `alamat_mhs`, `tempat_lahir`, `tgl_lahir`, `jk_mhs`, `agama`, `telp_hp`, `email`, `kodepos`, `telp_rumah`, `kantor`, `status`) VALUES
('081110059', 'SAMUEL ABDI BAKTI MOGUNCU', 'Desa Beteleme', 'POSO', '1990-04-07', 'laki-laki', 'Kristen', '081615715828', '081110059@mhs.stiki.ac.id', 61155, '081340840616', NULL, 1),
('091110125', 'ULUNG SETYAPUTRO', 'Jalan raya tamanan RT.10 RW.2', 'BONDOWOSO', '1991-12-17', 'laki-laki', 'Islam', '085600600543', '091110125@mhs.stiki.ac.id', 61155, '0', NULL, 1),
('091110135', 'DAVID MARTINO', 'HALMAHERA 59', 'PASURUAN', '1991-03-11', 'laki-laki', 'Kristen', '08561155333', '091110135@mhs.stiki.ac.id', NULL, '03437747727', NULL, 1),
('091110172', 'BINANTARA PARMADI', 'JL. KALIMOSODO 8/19', 'MALANG', '1990-12-12', 'laki-laki', 'Katholik', '085755504235', '091110172@mhs.stiki.ac.id', NULL, '0341 328495', NULL, 1),
('101110222', 'SAMUEL PUSIRUMANG MAKAHANAP', 'Pulosirih Tengah 19 no 323,Perumahan Taman Galaxy Indah', 'JAKARTA', '1989-07-25', 'laki-laki', 'Kristen', '082244332555', '101110222@mhs.stiki.ac.id', NULL, '0218206270', NULL, 1),
('101110257', 'NOR ARI SETIAWAN', 'JORONG RT. 01 RW. 01', 'AMBAWANG', '1992-04-13', 'laki-laki', 'Islam', '085790960643', '101110257@mhs.stiki.ac.id', NULL, '085790960643', NULL, 1),
('101110289', 'GERRY PERMANA PUTRA', 'JL. Erlangga Gg 14', 'PASURUAN', '1991-10-13', 'laki-laki', 'Islam', '088805846573', '101110289@mhs.stiki.ac.id', NULL, '(0343) 414268', NULL, 1),
('101110316', 'AZHAR FATHONI', 'RT 15 RW 02 KEDOK TUREN', 'MALANG', '1992-09-23', 'laki-laki', 'Islam', '081333143300', '101110316@mhs.stiki.ac.id', NULL, '081333667798', NULL, 1),
('101110345', 'ANJANG WIJAYA', 'RT 11 RW 03 SUMBERMULYO SUMBERAGUNG NGANTANG', 'MALANG', '1991-05-12', 'laki-laki', 'Islam', '085755998533', '101110345@mhs.stiki.ac.id', NULL, '081333243600', NULL, 1),
('101110352', 'NOFFAN ISTIQLAL ROBBIYANSYAH', 'JL. KALPATARU GANG VB NO. 5 RT. 02 RW. 0', 'MALANG', '1991-11-21', 'laki-laki', 'Islam', '083834959322', '101110352@mhs.stiki.ac.id', NULL, '0341754650', NULL, 1),
('101110358', 'M. KHOZINUL MAHFUDZ', 'Jl. Pesantren DS. UREK UREK RT 15 RW 01 GONDANGLEGI', 'MALANG', '1992-01-26', 'laki-laki', 'Islam', '085655723334', '101110358@mhs.stiki.ac.id', NULL, '03417755540', NULL, 1),
('111110372', 'ASTUTIK PUJI AFIANTI', 'NIFUBOKO KELURAHAN KARANG SIRI RT.4 RW.3', 'BRINEMBENDO', '1993-09-15', 'perempuan', 'Islam', '085231142930', '111110372@mhs.stiki.ac.id', NULL, '00000', NULL, 1),
('111110387', 'HENY ENDRA SETYIANINGRUM', 'Jl.Tidar Tengah No.12', 'BLITAR', '1991-04-20', 'perempuan', 'Islam', '082331823443', '111110387@mhs.stiki.ac.id', NULL, '-', NULL, 1),
('111110404', 'LIDYA AGNESTASARI LOBO', 'Dsn.Darungan Rt 02/Rw 03 Ds.Selorejo', 'BLITAR', '1993-08-07', 'perempuan', 'Kristen', '085708527333', '111110404@mhs.stiki.ac.id', NULL, '082142372090', NULL, 1),
('111110413', 'ARISTO PALAGUNA', 'JAONG', 'JAONG', '1994-11-29', 'laki-laki', 'Katholik', '085364591591', '111110413@mhs.stiki.ac.id', NULL, '-', NULL, 1),
('111110420', 'INDRA ROSIDIN', 'Pengadang, Kec. Praya Tengah, Lombok Tengah, NTB', 'Pengadang', '1993-04-13', 'laki-laki', 'Islam', '087861085182', '111110420@mhs.stiki.ac.id', NULL, '081907034046', NULL, 1),
('111110440', 'GUSTI DANI ARIANTO', 'Jl. KH Hasyim Ashari Gg 4  No : 13', 'MALANG', '1992-09-01', 'laki-laki', 'Islam', '082316225024', '111110440@mhs.stiki.ac.id', NULL, '0341-344658', NULL, 1),
('111110457', 'MAGDALENA TRIADHINI', 'JL PRATU SUBARI NO. 76 RT. 2 RW. 1', 'MALANG', '1993-05-13', 'perempuan', 'Kristen', '083834689328', '111110457@mhs.stiki.ac.id', NULL, '0341 824558', NULL, 1),
('111110466', 'NOVRIAN PANGUMBALERANG', 'Manembo-nembo atas', 'TERNATE', '1993-11-23', 'laki-laki', 'Kristen', '082234537986', '111110466@mhs.stiki.ac.id', NULL, '085256870114', NULL, 1),
('111110471', 'PENTA GALIH REGISTARA', 'PERUM BUKIT CEMARA TUJUH BLOk HH No 4', 'UJUNG PANDANG', '1988-01-14', 'laki-laki', 'Kristen', '085785611365', '111110471@mhs.stiki.ac.id', NULL, '(0341)467467', NULL, 1),
('111110477', 'NUR AVNI ROZALINA', 'JL.Danau Limboto Barat Dalam A4-G4 ', 'MALANG', '1993-01-02', 'perempuan', 'Islam', '085604418880', '111110477@mhs.stiki.ac.id', NULL, '0341718422', NULL, 1),
('111110479', 'MUHAMMAD FAISAL', 'Jln Teratai Perumnas Hamalau Permai No 54 RT 2 RK I', 'BAYUR', '1993-09-25', 'laki-laki', 'Islam', '082335585544', '111110479@mhs.stiki.ac.id', NULL, '051723712', NULL, 1),
('111110492', 'YOGI KRISTANTO', 'Sumber Kembar RT.09 RW.09 no.7 Dampit', 'MALANG', '1993-01-09', 'laki-laki', 'Islam', '085785190540', '111110492@mhs.stiki.ac.id', NULL, '082333124924', NULL, 1),
('121110494', 'MUHAMMAD YUGO UTOMO', 'JL.KARTINI 1 NO.14 SEI HARAPAN SEKUPANG, BATAM', 'TANJUNGPINANG', '1993-10-02', 'laki-laki', 'Islam', '081217198283', '121110494@mhs.stiki.ac.id', NULL, '0618443988', NULL, 1),
('121110495', 'GESAFITO TANDIANUS', 'JL.RAYA THAMRIN NO.12 LAWANG, MALANG', 'MALANG', '1994-04-17', 'laki-laki', 'Kristen', '081335125750', '121110495@mhs.stiki.ac.id', NULL, '087861954939', NULL, 1),
('121110496', 'CHRISTOPHER YUDIONO', 'JL.A.YANI GG MERPATI 1 NO.7 LAWANG - MALANG, MALANG', 'MALANG', '1995-04-06', 'laki-laki', 'Kristen', '081335092971', '121110496@mhs.stiki.ac.id', NULL, '(0341)9432568', NULL, 1),
('121110498', 'RYAN SANTOSO', 'Dsn Prodo RT 04 RW 07 Desa Klampok Kec. Singosari, Malang ', 'MALANG', '1994-09-03', 'laki-laki', 'Kristen', '085733000394', '121110498@mhs.stiki.ac.id', NULL, '082338600064', NULL, 1),
('121110499', 'MAHARTIN HENDRA SUKMAWAN', 'JL. JAKSA AGUNG SUPRAPTO GANG 1G NO.78, MALANG', 'LUMAJANG', '1994-06-02', 'laki-laki', 'Islam', '085706530200', '121110499@mhs.stiki.ac.id', NULL, '081333339947', NULL, 1),
('121110500', 'ALBERT FERENTO', 'PERUM VILLA SENGKALING RE-09 , MALANG', 'MALANG', '1994-03-04', 'laki-laki', 'Katholik', '087859610728', '121110500@mhs.stiki.ac.id', NULL, '08815531023', NULL, 1),
('121110505', 'AJI FITRIONO', 'JL. SUMINO RT.20 RW.03 KEDAWUNG DAMPIT, MALANG', 'MALANG', '1993-03-26', 'laki-laki', 'Islam', '081232252388', '121110505@mhs.stiki.ac.id', NULL, '085100617043', NULL, 1),
('121110506', 'FERRY SANJAYA', 'JL .LA sucipto 204', 'REMBANG', '1994-07-04', 'laki-laki', 'Kristen', '08990405738', '121110506@mhs.stiki.ac.id', NULL, '085103045140', NULL, 1),
('121110512', 'NELSON RENE COFITALAN HORNAI', 'Oe-cusse, Timor Leste', 'PADIAE', '1984-05-03', 'laki-laki', 'Katholik', '081339177547', '121110512@mhs.stiki.ac.id', NULL, '  6707285818', NULL, 1),
('121110518', 'RIDHO VALENTIN', 'Perum Griya Mapan Blok D6, Kacongan, Sumenep', 'SUMENEP', '1994-08-02', 'laki-laki', 'Islam', '081945189514', '121110518@mhs.stiki.ac.id', NULL, '087752073888', NULL, 1),
('121110519', 'IAN MUHLISIN', 'JL. RAYA TASIK MADU NO.60 TASIKMADU, KECAMATAN LOWOKWARU, KOTA MALANG', 'MALANG', '1994-08-27', 'laki-laki', 'Islam', '08988419441', '121110519@mhs.stiki.ac.id', NULL, '089663056836', NULL, 1),
('121110526', 'ITA KUMALA WARDANI', 'BANJAREJO RT 12 RW 2 NGANTANG, MALANG', 'MALANG', '1994-07-23', 'perempuan', 'Islam', '081252557115', '121110526@mhs.stiki.ac.id', NULL, '082139224238', NULL, 1),
('121110534', 'SENDI KURNIAWATY', 'SARANGAN ATAS 17A, MALANG', 'PASURUAN', '1994-10-17', 'perempuan', 'Islam', '083833009917', '121110534@mhs.stiki.ac.id', NULL, '085655535317', NULL, 1),
('121110538', 'LALU HARYADI GUNI', 'PERUMAHAN OMA VIEW BLOK GI NO. 18', 'LOMBOK TIMUR', '1994-05-08', 'laki-laki', 'Islam', '08883390057', '121110538@mhs.stiki.ac.id', NULL, '0341727985', NULL, 1),
('121110539', 'EKA DEWI SUSANTI', 'DS. NGRENDENG RT.04 RW.01 KEC. SELOREJO ,KAB. BLITAR', 'KUTAI', '1994-06-18', 'perempuan', 'Islam', '085933133680', '121110539@mhs.stiki.ac.id', NULL, '085330242321', NULL, 1),
('121110542', 'DIMAS GANISA NURWIBOWO', 'JL. POTRE KONENG II/GB-49, KOLOR-KOTA SUMENEP', 'SUMENEP', '1994-08-09', 'laki-laki', 'Islam', '085258831994', '121110542@mhs.stiki.ac.id', NULL, '082231399599', NULL, 1),
('121110545', 'RIZKA SEPTIANDOYO NUGROHO', 'PERUM BLKI NO47 SINGOSARI, MALANG', 'MALANG', '1993-09-11', 'laki-laki', 'Islam', '081334339479', '121110545@mhs.stiki.ac.id', NULL, '082140550880', NULL, 1),
('121110546', 'ARIA TABITA FATMA MAWARNI', 'DS SUMBEROTO RT26 RW 06 DONOMULYO, MALANG', 'BLITAR', '1994-11-06', 'perempuan', 'Kristen', '082257232023', '121110546@mhs.stiki.ac.id', NULL, '085259182029', NULL, 1),
('121110547', 'JULIO MENAHEMI PSALMOI', 'JL PROTOKOL DS TP RENTENG RT02 RW01 , TUREN - MALANG', 'MALANG', '1994-07-04', 'laki-laki', 'Kristen', '087759891242', '121110547@mhs.stiki.ac.id', NULL, '081333320252', NULL, 1),
('121110551', 'FIDA WIJI LESTARI', 'JL. RAYA CANDI KIDAL RT 16 RW 01 TUMPANG, MALANG', 'MALANG', '1994-07-22', 'perempuan', 'Islam', '083833145123', '121110551@mhs.stiki.ac.id', NULL, '085102842624', NULL, 1),
('121110552', 'AKHMAD ISNADI', 'DOKOSARI RT 029 RW 009 SUMBEREJO, GEDANGAN', 'MALANG', '1994-11-07', 'laki-laki', 'Islam', '085855946711', '121110552@mhs.stiki.ac.id', NULL, '081233280662', NULL, 1),
('121110554', 'YOSIA PRABOWO', 'PERUM GRIYA KARANGJATI PERMAI 08/10, PANDAAN', 'KARAWANG', '1994-01-22', 'laki-laki', 'Kristen', '081556600770', '121110554@mhs.stiki.ac.id', NULL, '(0343) 636603', NULL, 1),
('121110556', 'ROHMATAN ROMADONI', 'JL. SUNAN GUNUNG JATI NO.27 RT.06 RW.02 PUTUKREJO GONDANGLEGI, MALANG', 'MALANG', '1994-02-25', 'laki-laki', 'Islam', '085230566725', '121110556@mhs.stiki.ac.id', NULL, '0341878733', NULL, 1),
('121110559', 'TRI MAHARDI KURNIAWAN', 'JL. WATU DAMAR NO.04 KARANGPLOSO, MALANG', 'MALANG', '1993-05-02', 'laki-laki', 'Islam', '089666960897', '121110559@mhs.stiki.ac.id', NULL, '089523153767', NULL, 1),
('121110562', 'BENNY EKA ATMOJO', 'jl.mh thamrin 93 kauman bojonegoro', 'BOJONEGORO', '1992-10-31', 'laki-laki', 'Islam', '08563498050', '121110562@mhs.stiki.ac.id', NULL, '(0353)882990', NULL, 1),
('121110563', 'HARMAN TUNGGORONO', 'PERUM WATU BANTENG GG3 JOGONALAN PANDAAN , PASURUAN', 'PASURUAN', '1994-06-16', 'laki-laki', 'Katholik', '081230884889', '121110563@mhs.stiki.ac.id', NULL, '085203078414', NULL, 1),
('121110566', 'MAGDALENA DIAN ANGGRAINI', 'JL. RAYA SARANGAN NO.12 PLAOSAN, MAGETAN', 'MAGETAN', '1993-09-30', 'perempuan', 'Kristen', '082231600232', '121110566@mhs.stiki.ac.id', NULL, '082231600232', NULL, 1),
('121110567', 'DAWANG MAHENDRA SUDIRMAN PUTRA', 'PERUM DAMPIT PERMAI C5 NO.4-5 DAMPIT, MALANG', 'MALANG', '1993-11-30', 'laki-laki', 'Islam', '085895038350', '121110567@mhs.stiki.ac.id', NULL, '085790902773', NULL, 1),
('121110571', 'SEPHIRA ELIANDINI WIDODO', 'JL. LETJEN S. PARMAN GANG MAYOR NO.168, BONDOWOSO', 'SUMBAWA BESAR', '1993-09-27', 'perempuan', 'Kristen', '081230457884', '121110571@mhs.stiki.ac.id', NULL, '-', NULL, 1),
('121110572', 'RACHMANIA INDAH PERMATA SARI', 'JL. KH. HASYIM ASHARI VI/ 1397, MALANG', 'MALANG', '1993-10-29', 'perempuan', 'Islam', '082230306665', '121110572@mhs.stiki.ac.id', NULL, '081233456543', NULL, 1),
('121110573', 'RINDANG RAHARJO ROZAK', 'PERUM SAWOJAJAR JALAN KAPISATA BALI BLOK 16F NO 1', 'BANYUWANGI', '1994-06-16', 'laki-laki', 'Islam', '085755668499', '121110573@mhs.stiki.ac.id', NULL, '081234944399', NULL, 1),
('121110580', 'MUHAMMAD HANIFUDIN', 'JL. MT. HARYONO 8C 984, MALANG', 'MALANG', '1994-03-16', 'laki-laki', 'Islam', '089666252057', '121110580@mhs.stiki.ac.id', NULL, '085755278595', NULL, 1),
('121110594', 'FUAD HASAN PERDANA PUTRA', 'Desa Pasarlegi Kecamatan Sambeng Kab. Lamongan RT 001 RW 002', 'LAMONGAN', '1993-07-09', 'laki-laki', 'Islam', '081249661001', '121110594@mhs.stiki.ac.id', NULL, '082335025433', NULL, 1),
('121110595', 'MUHAMMAD ZAIDI EFENDI', 'JL. BAITUL MAL UJUNG TIMUR RT.02 RW.07 DESA RANDUBOTO, KECAMATAN SIDAYU, KABUPATEN GRESIK', 'GRESIK', '1993-07-31', 'laki-laki', 'Islam', '08563696659', '121110595@mhs.stiki.ac.id', NULL, '081335826309', NULL, 1),
('121110599', 'ANDRIANSYAH DWI WARDANA', 'JL. BANTEN RT.01 RW.06, LUMAJANG', 'LUMAJANG', '1993-06-02', 'laki-laki', 'Islam', '085233755399', '121110599@mhs.stiki.ac.id', NULL, '081233008121', NULL, 1),
('121110601', 'NISRINA ZEIN', 'JL HANGTUAH GG.KUANTAN NO.81 , PEKANBARU', 'PAMEKASAN', '1994-07-10', 'perempuan', 'Islam', '083834303198', '121110601@mhs.stiki.ac.id', NULL, '0761-859778', NULL, 1),
('121110602', 'FARIK ARIYANTO', 'Dsn. Perjito Rt. 14 Rw. 03 Ds. Candiharjo Kec. Ngoro', 'MOJOKERTO', '1993-11-07', 'laki-laki', 'Islam', '085230627845', '121110602@mhs.stiki.ac.id', NULL, '085230627845', NULL, 1),
('121110603', 'VINCENT PUTRA GUNAWAN', 'JL. GLATHIK TIMUR NO.15 DSN.GLAGAHSARI - SUKOREJO, PASURUAN', 'PASURUAN', '1994-01-20', 'laki-laki', 'Kristen', '085755789222', '121110603@mhs.stiki.ac.id', NULL, '0343-7760879', NULL, 1),
('121110604', 'ISA SUARTI', 'JL. KELAPA SAWIT NO.6, MALANG', 'LUMAJANG', '1993-09-02', 'perempuan', 'Islam', '08988435359', '121110604@mhs.stiki.ac.id', NULL, '085330691888', NULL, 1),
('121110605', 'DEVI TRI WAHYUNINGTYAS', 'JL. BLIMBING NO.21 TANGKIL - WLINGI, BLITAR', 'BLITAR', '1993-12-30', 'perempuan', 'Islam', '083834569479', '121110605@mhs.stiki.ac.id', NULL, '085856228987', NULL, 1),
('12170022', 'FARID ABIDIN', 'PERUM SAXOFONE LAND KAV.22 RT.2 RW.6 JATIMULYO LOWOKWARU, MALANG', 'MALANG', '1978-12-27', 'laki-laki', 'Islam', '087808881227', 'hellofaried@gmail.com', NULL, '0341', NULL, 1),
('12170023', 'MIFTAKHUL HUDA', 'JL. PANGLIMA SUDIRMAN II NO.37 NGAGLIK BATU, MALANG', 'BATU', '1994-04-13', 'laki-laki', 'Islam', '082230421112', '12170023@mhs.stiki.ac.id', NULL, '', NULL, 1),
('12170025', 'TYAS ARI DITA', 'JL. A.YANI RT.05 RW.01 KESAMBEN, BLITAR', 'BLITAR', '1993-02-13', 'perempuan', 'Islam', '083834458241', '12170025@mhs.stiki.ac.id', NULL, '', NULL, 1),
('12170027', 'HERY KUSWANDI', 'DUSUN SENGON REJO RT.001 RW.001 DESA PETUNGSEWU, KEC.WAGIR, MALANG', 'MALANG', '1993-07-14', 'laki-laki', 'Islam', '085755598020', '12170027@mhs.stiki.ac.id', NULL, '', NULL, 1),
('122210088', 'JONATHAN', 'JL PEGANGSAAN BARAT NO 34, JAKARTA', 'JAKARTA', '1992-09-13', 'laki-laki', 'Kristen', '082333099958', '122210088@mhs.stiki.ac.id', NULL, '0213162834', NULL, 1),
('131110646', 'LEO ARMANDA AL FADHILLAH', 'JL. IR. RAIS 9/272, MALANG', 'MALANG', '1995-08-07', 'laki-laki', 'Islam', '0895338075036', '131110646@mhs.stiki.ac.id', NULL, '081937939140', NULL, 1),
('131110706', 'ERWIN TRIWIDA KUSUMA', 'JL GADANG GANG IV NO 168 RT05 RW07, MALANG', 'MALANG', '1995-08-04', 'laki-laki', 'Kristen', '087859387987', '131110706@mhs.stiki.ac.id', NULL, '-', NULL, 1),
('13190077', 'ENGGAR FRISA NURASTUTI', 'JL. GARUDA NO.28 RT.08 RW.02 KARANG PANDAN, PAKISAJI, MALANG', 'MALANG', '1992-01-10', 'perempuan', 'Islam', '081249685550', '13190077@mhs.stiki.ac.id', NULL, '08125238564', NULL, 1),
('141112001', 'MUHAMMAD YUSUF HABIBIE', 'JL BLITAR 35 GRESIK KOTA BARU', 'GRESIK', '1988-09-20', 'laki-laki', 'Islam', '081332093898', '141112001@mhs.stiki.ac.id', NULL, '', NULL, 1),
('141112003', 'RAUDATUL JANNAH', 'Jl Aluh Idut Gang Syahdan No11 Rt 17 LK VIII Kel Kandangan Kab Hulu Sungai Selatan Kalimantan Selatan', 'KANDANGAN', '1992-12-12', 'perempuan', 'Islam', '081285727711', '141112003@mhs.stiki.ac.id', NULL, '08125047206', NULL, 1),
('141221001', 'MICHAEL JORDAN KEANE', 'GAJAH MADA NO 1', 'PASURUAN', '1996-06-22', 'laki-laki', 'Kristen', '087856721225', '141221001@mhs.stiki.ac.id', NULL, '08176769080', NULL, 1),
('141221007', 'ANDREAS HADI PUTRA', 'PERUM SEJAHTERA BLOK 1 NO 5 HAJIMENA', 'BOGOR', '1995-09-06', 'laki-laki', 'Kristen', '082331494044', '141221007@mhs.stiki.ac.id', NULL, '085377743870', NULL, 1),
('141221017', 'MUHAMMAD IKHSAN ', 'JL. RAYA BAKALAN NO. 18. RT. 02 / RW. 03 BULULAWANG', 'MALANG', '1996-07-03', 'laki-laki', 'Islam', '081331984931', '141221017@mhs.stiki.ac.id', NULL, '089694296275', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(15) NOT NULL,
  `nm_mitra` varchar(50) DEFAULT NULL,
  `alamat_mitra` varchar(160) DEFAULT NULL,
  `telp_mitra` varchar(20) DEFAULT NULL,
  `tmpt_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk_mitra` varchar(10) NOT NULL,
  `kebangsaan` varchar(50) NOT NULL,
  `kd_pos` varchar(5) NOT NULL,
  `telp_hp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pendidikan_terakhir` varchar(100) NOT NULL,
  `work_nm_lembaga` varchar(255) NOT NULL,
  `work_jabatan` varchar(255) NOT NULL,
  `work_alamat` varchar(255) NOT NULL,
  `work_kd_pos` varchar(5) NOT NULL,
  `work_telp` varchar(20) NOT NULL,
  `work_fax` varchar(15) NOT NULL,
  `work_email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nm_mitra`, `alamat_mitra`, `telp_mitra`, `tmpt_lahir`, `tgl_lahir`, `jk_mitra`, `kebangsaan`, `kd_pos`, `telp_hp`, `email`, `pendidikan_terakhir`, `work_nm_lembaga`, `work_jabatan`, `work_alamat`, `work_kd_pos`, `work_telp`, `work_fax`, `work_email`, `status`) VALUES
(1, 'Catur Elfinawati', NULL, '083831333983', 'Surabaya', '1992-04-17', '', '', '', '083831333983', 'catur.elfina@gmail.com', '', '', '', '', '', '', '', '', 1),
(2, 'Liana Setiawan', NULL, '08121428321', 'Surabaya', '1994-02-15', '', '', '', '08121428321', 'cieyra.ff9@gmail.com', '', '', '', '', '', '', '', '', 1),
(3, 'Elvin Farianti Sutjipto', NULL, '08157355488', 'Surabaya', '1993-05-23', '', '', '', '08157355488', 'elvinf593@gmail.com', '', '', '', '', '', '', '', '', 1),
(4, 'Indra Lesmana', NULL, '081235106234', 'Bondowoso', '1989-06-04', '', '', '', '081235106234', 'indraliem12@gmail.com', '', '', '', '', '', '', '', '', 1),
(5, 'Mikhael Setiawan', NULL, '082132331542', 'Surabaya', '1992-10-27', '', '', '', '082132331542', 'mikhaelsetiawan92@gmail.com ', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(15) NOT NULL,
  `id_pendaftaran` varchar(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `id_jenis_bayar` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pendaftaran`, `tgl_bayar`, `id_jenis_bayar`, `jumlah`) VALUES
(1, 'kd-82', '2020-02-03 00:00:00', 1, 350000),
(2, 'kd-83', '2020-02-04 00:00:00', 1, 350000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` varchar(30) NOT NULL,
  `id_detail_pendaftar` varchar(15) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `id_skema` int(10) DEFAULT NULL,
  `id_jns_daftar` varchar(25) DEFAULT NULL,
  `tipe` enum('mahasiswa','mitra') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 daftar awal, 2 pembayaran, 3 ujian, 4 lulus, 5 tidak lulus, 9 delete',
  `rekap_asesmen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_detail_pendaftar`, `tgl_daftar`, `id_skema`, `id_jns_daftar`, `tipe`, `status`, `rekap_asesmen`) VALUES
('295 00001 2016', '4', '2016-06-22', 1, '1', 'mitra', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00002 2016', '5', '2016-06-22', 1, '1', 'mitra', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00003 2016', '1', '2016-06-22', 1, '1', 'mitra', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00004 2016', '3', '2016-06-22', 1, '1', 'mitra', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00005 2016', '2', '2016-06-22', 1, '1', 'mitra', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00006 2016', '121110505', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00007 2016', '121110552', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00008 2016', '121110500', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00009 2016', '121110599', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00010 2016', '101110345', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00011 2016', '111110413', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00012 2016', '111110372', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00013 2016', '121110496', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00014 2016', '121110567', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00015 2016', '121110542', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00016 2016', '13190077', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00017 2016', '131110706', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00018 2016', '12170022', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00019 2016', '121110506', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00020 2016', '121110594', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00021 2016', '101110289', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00022 2016', '111110440', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00023 2016', '121110563', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00024 2016', '111110387', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00025 2016', '12170027', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00026 2016', '121110519', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00027 2016', '121110547', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00028 2016', '121110538', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00029 2016', '131110646', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00030 2016', '111110404', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00031 2016', '111110457', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00032 2016', '111110479', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00033 2016', '121110580', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00034 2016', '141112001', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00035 2016', '111110477', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00036 2016', '141112003', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00037 2016', '121110518', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00038 2016', '121110545', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00039 2016', '121110498', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00040 2016', '121110559', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00041 2016', '121110601', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00042 2016', '121110605', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00043 2016', '121110546', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00044 2016', '12170025', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00045 2016', '101110358', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00046 2016', '121110603', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00047 2016', '121110602', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00048 2016', '111110420', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00049 2016', '12170023', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00050 2016', '121110551', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00051 2016', '121110495', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00052 2016', '121110499', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00053 2016', '111110471', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00054 2016', '121110573', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00055 2016', '111110492', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00056 2016', '121110571', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00057 2016', '122210088', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00058 2016', '141221001', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00059 2016', '141221007', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00060 2016', '141221017', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00061 2016', '121110526', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00062 2016', '121110534', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00063 2016', '121110556', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00064 2016', '101110352', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00065 2016', '101110257', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00066 2016', '121110512', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00067 2016', '121110562', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00068 2016', '121110604', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00069 2016', '121110554', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00070 2016', '121110494', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00071 2016', '081110059', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00072 2016', '121110595', '2017-03-16', 1, '1', 'mahasiswa', 4, '{\"1\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1,\"11\":1}'),
('295 00073 2016', '121110572', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00074 2016', '121110539', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00075 2016', '111110466', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00076 2016', '101110222', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00077 2016', '121110566', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00078 2016', '091110125', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00079 2016', '091110172', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00080 2016', '091110135', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('295 00081 2016', '101110316', '2017-03-16', 3, '1', 'mahasiswa', 4, '{\"19\":1,\"20\":1,\"21\":1,\"22\":1,\"23\":1,\"24\":1,\"25\":1,\"26\":1,\"27\":1,\"28\":1}'),
('kd-82', '081110059', '2020-02-03', 3, '1', 'mahasiswa', 2, ''),
('kd-83', '091110125', '2020-02-04', 1, '1', 'mahasiswa', 2, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `kd_prodi` varchar(15) NOT NULL,
  `jenjang` varchar(15) DEFAULT NULL,
  `nm_prodi` varchar(30) DEFAULT NULL,
  `tgl_berdiri` date DEFAULT NULL,
  `email_prodi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`kd_prodi`, `jenjang`, `nm_prodi`, `tgl_berdiri`, `email_prodi`) VALUES
('DG-D1', 'D1', 'Desain Grafis', '2014-05-01', 'ti@stikil.ac.id'),
('DK-S1', 'S1', 'Desain Komunikasi Visual', '2014-08-14', 'dkv@stiki.ac.id'),
('IK-S2', 'S2', 'Ilmu Komputer', '2015-11-01', NULL),
('MI-D3', 'D3', 'Manajemen Informatika', '2014-05-01', 'ti@stikil.ac.id'),
('SI-S1', 'S1', 'Sistem Informasi', '2014-06-10', NULL),
('TI-S1', 'S1', 'Teknik Informatika', '2014-05-01', 'ti@stikil.ac.id'),
('TI-S2', 'S2', 'Teknologi Informasi', '2015-11-01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `id_pendaftaran` varchar(30) DEFAULT NULL,
  `nm_serifikat` varchar(30) DEFAULT NULL,
  `tgl_mulai_sertifikat` date DEFAULT NULL,
  `tgl_selesai_sertifikat` date DEFAULT NULL,
  `status_sertifikat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `id_pendaftaran`, `nm_serifikat`, `tgl_mulai_sertifikat`, `tgl_selesai_sertifikat`, `status_sertifikat`) VALUES
(1, '295 00018 2016', '85321 2132 0000018 2016', NULL, NULL, 1),
(2, '295 00049 2016', '85321 2132 0000049 2016', NULL, NULL, 1),
(3, '295 00044 2016', '85321 2132 0000044 2016', NULL, NULL, 1),
(4, '295 00025 2016', '85321 2132 0000025 2016', NULL, NULL, 1),
(5, '295 00016 2016', '85321 2132 0000016 2016', NULL, NULL, 1),
(6, '295 00076 2016', '85321 2519 0000076 2016', NULL, NULL, 1),
(7, '295 00065 2016', '85321 2519 0000065 2016', NULL, NULL, 1),
(8, '295 00021 2016', '85321 2132 0000021 2016', NULL, NULL, 1),
(9, '295 00081 2016', '85321 2519 0000081 2016', NULL, NULL, 1),
(10, '295 00010 2016', '85321 2132 0000010 2016', NULL, NULL, 1),
(11, '295 00064 2016', '85321 2519 0000064 2016', NULL, NULL, 1),
(12, '295 00045 2016', '85321 2132 0000045 2016', NULL, NULL, 1),
(13, '295 00012 2016', '85321 2132 0000012 2016', NULL, NULL, 1),
(14, '295 00024 2016', '85321 2132 0000024 2016', NULL, NULL, 1),
(15, '295 00030 2016', '85321 2132 0000030 2016', NULL, NULL, 1),
(16, '295 00011 2016', '85321 2132 0000011 2016', NULL, NULL, 1),
(17, '295 00048 2016', '85321 2132 0000048 2016', NULL, NULL, 1),
(18, '295 00022 2016', '85321 2132 0000022 2016', NULL, NULL, 1),
(19, '295 00031 2016', '85321 2132 0000031 2016', NULL, NULL, 1),
(20, '295 00075 2016', '85321 2519 0000075 2016', NULL, NULL, 1),
(21, '295 00053 2016', '85321 2519 0000053 2016', NULL, NULL, 1),
(22, '295 00035 2016', '85321 2132 0000035 2016', NULL, NULL, 1),
(23, '295 00032 2016', '85321 2132 0000032 2016', NULL, NULL, 1),
(24, '295 00055 2016', '85321 2519 0000055 2016', NULL, NULL, 1),
(25, '295 00070 2016', '85321 2132 0000070 2016', NULL, NULL, 1),
(26, '295 00051 2016', '85321 2519 0000051 2016', NULL, NULL, 1),
(27, '295 00013 2016', '85321 2132 0000013 2016', NULL, NULL, 1),
(28, '295 00039 2016', '85321 2132 0000039 2016', NULL, NULL, 1),
(29, '295 00052 2016', '85321 2519 0000052 2016', NULL, NULL, 1),
(30, '295 00008 2016', '85321 2132 0000008 2016', NULL, NULL, 1),
(31, '295 00006 2016', '85321 2132 0000006 2016', NULL, NULL, 1),
(32, '295 00019 2016', '85321 2132 0000019 2016', NULL, NULL, 1),
(33, '295 00066 2016', '85321 2519 0000066 2016', NULL, NULL, 1),
(34, '295 00037 2016', '85321 2132 0000037 2016', NULL, NULL, 1),
(35, '295 00026 2016', '85321 2132 0000026 2016', NULL, NULL, 1),
(36, '295 00061 2016', '85321 2519 0000061 2016', NULL, NULL, 1),
(37, '295 00062 2016', '85321 2519 0000062 2016', NULL, NULL, 1),
(38, '295 00028 2016', '85321 2132 0000028 2016', NULL, NULL, 1),
(39, '295 00074 2016', '85321 2519 0000074 2016', NULL, NULL, 1),
(40, '295 00015 2016', '85321 2132 0000015 2016', NULL, NULL, 1),
(41, '295 00038 2016', '85321 2132 0000038 2016', NULL, NULL, 1),
(42, '295 00043 2016', '85321 2132 0000043 2016', NULL, NULL, 1),
(43, '295 00027 2016', '85321 2132 0000027 2016', NULL, NULL, 1),
(44, '295 00050 2016', '85321 2519 0000050 2016', NULL, NULL, 1),
(45, '295 00007 2016', '85321 2132 0000007 2016', NULL, NULL, 1),
(46, '295 00069 2016', '85321 2132 0000069 2016', NULL, NULL, 1),
(47, '295 00063 2016', '85321 2519 0000063 2016', NULL, NULL, 1),
(48, '295 00040 2016', '85321 2132 0000040 2016', NULL, NULL, 1),
(49, '295 00067 2016', '85321 2519 0000067 2016', NULL, NULL, 1),
(50, '295 00023 2016', '85321 2132 0000023 2016', NULL, NULL, 1),
(51, '295 00077 2016', '85321 2519 0000077 2016', NULL, NULL, 1),
(52, '295 00014 2016', '85321 2132 0000014 2016', NULL, NULL, 1),
(53, '295 00056 2016', '85321 2519 0000056 2016', NULL, NULL, 1),
(54, '295 00073 2016', '85321 2519 0000073 2016', NULL, NULL, 1),
(55, '295 00054 2016', '85321 2519 0000054 2016', NULL, NULL, 1),
(56, '295 00033 2016', '85321 2132 0000033 2016', NULL, NULL, 1),
(57, '295 00020 2016', '85321 2132 0000020 2016', NULL, NULL, 1),
(58, '295 00072 2016', '85321 2132 0000072 2016', NULL, NULL, 1),
(59, '295 00009 2016', '85321 2132 0000009 2016', NULL, NULL, 1),
(60, '295 00041 2016', '85321 2132 0000041 2016', NULL, NULL, 1),
(61, '295 00047 2016', '85321 2132 0000047 2016', NULL, NULL, 1),
(62, '295 00046 2016', '85321 2132 0000046 2016', NULL, NULL, 1),
(63, '295 00068 2016', '85321 2519 0000068 2016', NULL, NULL, 1),
(64, '295 00042 2016', '85321 2132 0000042 2016', NULL, NULL, 1),
(65, '295 00057 2016', '85321 2519 0000057 2016', NULL, NULL, 1),
(66, '295 00029 2016', '85321 2132 0000029 2016', NULL, NULL, 1),
(67, '295 00017 2016', '85321 2132 0000017 2016', NULL, NULL, 1),
(68, '295 00034 2016', '85321 2132 0000034 2016', NULL, NULL, 1),
(69, '295 00036 2016', '85321 2132 0000036 2016', NULL, NULL, 1),
(70, '295 00058 2016', '85321 2519 0000058 2016', NULL, NULL, 1),
(71, '295 00059 2016', '85321 2519 0000059 2016', NULL, NULL, 1),
(72, '295 00060 2016', '85321 2519 0000060 2016', NULL, NULL, 1),
(73, '295 00071 2016', '85321 2132 0000071 2016', NULL, NULL, 1),
(74, '295 00078 2016', '85321 2519 0000078 2016', NULL, NULL, 1),
(75, '295 00080 2016', '85321 2519 0000080 2016', NULL, NULL, 1),
(76, '295 00079 2016', '85321 2519 0000079 2016', NULL, NULL, 1),
(77, '295 00003 2016', '85321 2132 0000003 2016', NULL, NULL, 1),
(78, '295 00005 2016', '85321 2132 0000005 2016', NULL, NULL, 1),
(79, '295 00004 2016', '85321 2132 0000004 2016', NULL, NULL, 1),
(80, '295 00001 2016', '85321 2132 0000001 2016', NULL, NULL, 1),
(81, '295 00002 2016', '85321 2132 0000002 2016', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skema`
--

CREATE TABLE `skema` (
  `id_skema` int(11) NOT NULL,
  `nm_skema` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `skema`
--

INSERT INTO `skema` (`id_skema`, `nm_skema`, `status`) VALUES
(1, 'Web Developer', 1),
(4, 'Junior Web Programming', 1),
(5, 'Mobile Computing Utama', 1),
(6, 'Pemogram Basis Data', 1),
(7, 'Pembuatan Animasi', 1),
(8, 'Desainer Grafis Junior', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuk`
--

CREATE TABLE `tuk` (
  `kd_tuk` varchar(15) NOT NULL,
  `nm_tuk` varchar(20) DEFAULT NULL,
  `jns_tuk` varchar(15) DEFAULT NULL,
  `kapasitas_tuk` int(10) DEFAULT NULL,
  `ket_tuk` varchar(40) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tuk`
--

INSERT INTO `tuk` (`kd_tuk`, `nm_tuk`, `jns_tuk`, `kapasitas_tuk`, `ket_tuk`, `status`) VALUES
('TUK-01', 'Lab A', 'Laboraturium', 20, NULL, 1),
('TUK-02', 'Lab B', 'Laboraturium', 20, NULL, 1),
('TUK-03', 'Lab C', 'Laboraturium', 20, NULL, 1),
('TUK-04', 'Lab D', 'Laboraturium', 20, NULL, 1),
('TUK-05', 'Lab E', 'Laboraturium', 20, NULL, 1),
('TUK-06', 'Lab F', 'Laboraturium', 20, NULL, 1),
('TUK-07', 'Lab G', 'Laboraturium', 20, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`NIP`);

--
-- Indeks untuk tabel `dtl_jadwal`
--
ALTER TABLE `dtl_jadwal`
  ADD PRIMARY KEY (`id_dtl_jadwal`);

--
-- Indeks untuk tabel `dtl_kompetensi`
--
ALTER TABLE `dtl_kompetensi`
  ADD PRIMARY KEY (`id_dtl_kompetensi`);

--
-- Indeks untuk tabel `dtl_skema`
--
ALTER TABLE `dtl_skema`
  ADD PRIMARY KEY (`id_dt_skema`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `jns_daftar`
--
ALTER TABLE `jns_daftar`
  ADD PRIMARY KEY (`id_jns_daftar`);

--
-- Indeks untuk tabel `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NRP`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kd_prodi`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`);

--
-- Indeks untuk tabel `skema`
--
ALTER TABLE `skema`
  ADD PRIMARY KEY (`id_skema`);

--
-- Indeks untuk tabel `tuk`
--
ALTER TABLE `tuk`
  ADD PRIMARY KEY (`kd_tuk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dtl_jadwal`
--
ALTER TABLE `dtl_jadwal`
  MODIFY `id_dtl_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `dtl_kompetensi`
--
ALTER TABLE `dtl_kompetensi`
  MODIFY `id_dtl_kompetensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dtl_skema`
--
ALTER TABLE `dtl_skema`
  MODIFY `id_dt_skema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jns_daftar`
--
ALTER TABLE `jns_daftar`
  MODIFY `id_jns_daftar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id_kompetensi` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `skema`
--
ALTER TABLE `skema`
  MODIFY `id_skema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

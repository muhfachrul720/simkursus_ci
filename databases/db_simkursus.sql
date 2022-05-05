-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jan 2022 pada 01.49
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simkursus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id_hak_akses` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id_hak_akses`, `id_user_level`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(13, 4, 17),
(15, 4, 18),
(16, 5, 19),
(17, 6, 20),
(18, 5, 21),
(19, 5, 22),
(20, 6, 23),
(22, 5, 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil_ujian`
--

CREATE TABLE `tbl_hasil_ujian` (
  `id` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_soal` varchar(255) NOT NULL,
  `total_skor` int(11) NOT NULL,
  `jumlah_salah` int(11) NOT NULL,
  `jumlah_benar` int(11) NOT NULL,
  `jumlah_tidak_dijawab` int(11) NOT NULL,
  `jawaban_siswa` varchar(255) NOT NULL,
  `sisa_durasi` varchar(255) NOT NULL,
  `tanggal_pengerjaan` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_hasil_ujian`
--

INSERT INTO `tbl_hasil_ujian` (`id`, `id_ujian`, `id_student`, `id_soal`, `total_skor`, `jumlah_salah`, `jumlah_benar`, `jumlah_tidak_dijawab`, `jawaban_siswa`, `sisa_durasi`, `tanggal_pengerjaan`, `status`) VALUES
(11, 14, 2, '16,15,14,13,11,8,', 0, 6, 0, 14, 'B,C,B,D,A,C,', '0', '2021-12-21 08:44:54', 1),
(15, 16, 5, '17,12,10,', 25, 0, 3, 17, 'A,A,C,', '9:51', '2021-12-21 09:13:17', 1),
(16, 16, 2, '17,12,10,', 43, 0, 3, 17, 'A,B,A,', '9:52', '2021-12-21 09:14:01', 1),
(17, 17, 2, '22,21,20,19,5,', 2, 3, 2, 15, 'D,B,C,B,A,', '', '2021-12-23 11:27:04', 1),
(18, 15, 2, '23,22,21,20,19,5,', 2, 4, 2, 14, 'C,C,D,B,A,B,', '', '2021-12-29 08:24:02', 1),
(19, 15, 2, '23,22,21,20,19,5,', 2, 4, 2, 14, 'C,C,D,B,A,B,', '', '2021-12-29 08:24:14', 1),
(20, 15, 2, '23,22,21,20,19,5,', 2, 4, 2, 14, 'C,C,D,B,A,B,', '', '2021-12-29 08:24:27', 1),
(21, 15, 2, '23,22,21,20,19,5,', 2, 4, 2, 14, 'C,C,D,B,A,B,', '', '2021-12-29 08:24:34', 1),
(22, 15, 2, '23,22,21,20,19,5,', 2, 4, 2, 14, 'C,C,D,B,A,B,', '', '2021-12-29 08:24:43', 1),
(23, 15, 2, '23,22,21,20,19,5,', 2, 4, 2, 14, 'C,C,D,B,A,B,', '', '2021-12-29 08:24:46', 1),
(24, 19, 2, '16,15,14,13,11,', 0, 5, 0, 0, 'A,C,B,D,C,', '9:41', '2022-01-01 05:34:04', 1),
(25, 21, 2, '27,26,25,24,', 1, 3, 1, 0, 'A,B,A,B,', '', '2022-01-02 05:09:02', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jawaban_images`
--

CREATE TABLE `tbl_jawaban_images` (
  `id` int(11) NOT NULL,
  `opsi_karakter` tinyint(4) NOT NULL COMMENT '0 = A, 1 = B, 2 = C, 3 = D, 4 = E, 5 = F ....',
  `nama_gambar` tinytext NOT NULL,
  `bobot_jawaban` int(11) DEFAULT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jawaban_images`
--

INSERT INTO `tbl_jawaban_images` (`id`, `opsi_karakter`, `nama_gambar`, `bobot_jawaban`, `id_soal`) VALUES
(29, 0, '36f5e152eb12e133e2a7d64b925d3215.jpg', 12, 14),
(30, 1, 'f6123b515dd2cb65a852f28816263ba0.jpg', 32, 14),
(31, 2, 'cb9032b15786788ac25191b6b323cbd2.png', 22, 14),
(32, 3, 'e4218826ea47b3125e41eee39f74dc09.jpg', 12, 14),
(33, 0, '702a701d1cad60b2222c19f75d777618.jpg', 10, 17),
(34, 1, '1b12958ef4c1e62edefb86319222ecae.jpg', 20, 17),
(35, 2, '0a12fde410250011d83fda67176d45d3.jpg', 30, 17),
(36, 3, 'dd33516031a6362bf5e8e1af74d363fa.jpg', 40, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jawaban_text`
--

CREATE TABLE `tbl_jawaban_text` (
  `id` int(11) NOT NULL,
  `opsi_karakter` tinyint(4) NOT NULL COMMENT '0 = A, 1 = B, 2 = C, 3 = D, 4 = E, 5 = F ....',
  `isi_jawaban` tinytext NOT NULL,
  `bobot_jawaban` int(11) DEFAULT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jawaban_text`
--

INSERT INTO `tbl_jawaban_text` (`id`, `opsi_karakter`, `isi_jawaban`, `bobot_jawaban`, `id_soal`) VALUES
(3, 0, '12', NULL, 6),
(4, 1, '41', NULL, 6),
(5, 2, '22', NULL, 6),
(6, 3, '12', NULL, 6),
(19, 0, 'Ini A', NULL, 13),
(20, 1, 'Ini B', NULL, 13),
(21, 2, 'Ini C', NULL, 13),
(22, 3, 'Ini D', NULL, 13),
(23, 0, 'Ini jawaban A', NULL, 15),
(24, 1, 'Ini jawaban B', NULL, 15),
(25, 2, 'Ini jawaban C', NULL, 15),
(26, 3, 'Ini jawaban D', NULL, 15),
(27, 0, '1', NULL, 16),
(28, 1, '2', NULL, 16),
(29, 2, '3', NULL, 16),
(30, 3, '4', NULL, 16),
(31, 4, '5', NULL, 16),
(32, 0, 'Aqua', 2, 18),
(33, 1, 'Ades', 1, 18),
(34, 2, 'Chleo', 3, 18),
(35, 3, 'Le Minerale', 4, 18),
(56, 0, '22', NULL, 24),
(57, 1, '23', NULL, 24),
(58, 0, '2', 0, 25),
(59, 1, '2', 0, 25),
(60, 0, '14', NULL, 26),
(61, 1, '3', NULL, 26),
(62, 0, '1', 0, 27),
(63, 1, '7', 0, 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` char(1) NOT NULL COMMENT 'y=yes, n=no',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`, `date_created`) VALUES
(1, 'Kelola Pengguna', 'superadmin/user', 'fas fa-user-tie', 0, 'y', '2021-10-31 10:01:15'),
(2, 'Kelola Level Pengguna', 'superadmin/user/user_level', 'fas fa-users-cog', 0, 'y', '2021-10-31 10:01:15'),
(3, 'Kelola Menu', 'superadmin/menu', 'fas fa-ellipsis-v', 0, 'y', '2021-10-31 10:01:15'),
(4, 'Kelola Hak Akses', 'superadmin/access', 'fab fa-accessible-icon', 0, 'y', '2021-10-31 10:01:15'),
(19, 'Bank Soal', 'user/admin/soal/list_soal', 'fas fa-book', 0, 'y', '2021-12-11 01:48:28'),
(20, 'Ujian', 'user/ujian/list_student_ujian', 'fas fa-pencil-alt', 0, 'y', '2021-12-11 01:49:33'),
(21, 'Jadwalkan Ujian', 'user/ujian/list_ujian', 'fas fa-calendar', 0, 'y', '2021-12-11 01:58:35'),
(22, 'Dashboard', 'user/admin/dashboard', 'fas fa-tachometer-alt', 0, 'y', '2021-12-11 02:03:45'),
(23, 'Dashboard', 'user/student/dashboard', 'fas fa-tachometer-alt', 0, 'y', '2021-12-11 02:04:21'),
(24, 'Peserta', 'user/admin/student', 'fas fa-user-tie', 0, 'y', '2021-12-19 01:14:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id` int(11) NOT NULL,
  `kode_soal` varchar(255) NOT NULL,
  `jenis_soal` char(3) NOT NULL,
  `bobot_soal` int(11) DEFAULT NULL,
  `jml_jawaban` int(11) NOT NULL,
  `kunci_jawaban` char(1) DEFAULT NULL,
  `type_jawaban` char(15) NOT NULL,
  `isi_soal` longtext NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `kode_soal`, `jenis_soal`, `bobot_soal`, `jml_jawaban`, `kunci_jawaban`, `type_jawaban`, `isi_soal`, `tanggal_input`) VALUES
(13, 'Tkd_2CF9U_122021', 'tkd', 2, 4, 'B', 'txt', 'Pertanyaan Testing Untuk TKD-A', '2021-12-17 00:00:00'),
(14, 'Tkd_BXFfb_122021', 'tkd', 2, 4, 'D', 'img', 'Pilih Gambar Untuk Pertanyaan ini ', '2021-12-17 00:00:00'),
(15, 'Tkd_ugZCU_122021', 'tkd', 1, 4, 'D', 'txt', 'Pilih Jawaban', '2021-12-17 00:00:00'),
(16, 'Tkd_8mopA_122021', 'tkd', 1, 5, 'C', 'txt', 'Ini pertanyaan', '2021-12-17 00:00:00'),
(17, 'Kpb_3nfWu_122021', 'kpb', 0, 4, NULL, 'img', 'Kepribadian', '2021-12-17 00:00:00'),
(18, 'Kpb_24h9D_122021', 'kpb', 0, 4, NULL, 'txt', 'Test Soal dengan Txt Bobot', '2021-12-23 00:00:00'),
(24, 'Kcm_wz2kN_012022', 'kcm', 0, 2, '1', 'txt', '22,23,', '2022-01-02 00:00:00'),
(25, 'Kcm_hzGjJ_012022', 'kcm', 0, 2, NULL, 'txt', '3,4,', '2022-01-02 00:00:00'),
(26, 'Kcm_13T4n_012022', 'kcm', 2, 2, '1', 'txt', '15,3,', '2022-01-02 00:00:00'),
(27, 'Kcm_vXoA0_012022', 'kcm', 2, 2, 'A', 'txt', '17,7,', '2022-01-02 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `nomor_induk` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `visible_pass` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `nomor_induk`, `nama_lengkap`, `jenis_kelamin`, `no_hp`, `visible_pass`, `id_user`) VALUES
(2, 'PSRT01SIMKURSUS', 'Jacob Nikolas Flamel', 'L', '081140442442', 'admin123', 14),
(3, 'PSRT03SIMKURSUS', 'Yuki Kajiura ', 'L', '08131412411234', 'PSRT03SIMKURSUS', 15),
(4, 'PSRT04SIMKURSUS', 'Ilham Irfandi Jamal', 'L', '1231241241', 'muridhapus', 16),
(5, 'PSRT05SIMKURSUS', 'Ilham Irfandi Jamal', 'L', '1231e1241124', 'muridhapus', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ujian`
--

CREATE TABLE `tbl_ujian` (
  `id` int(11) NOT NULL,
  `title_ujian` varchar(255) NOT NULL,
  `type_ujian` char(10) NOT NULL,
  `code_ujian` varchar(50) NOT NULL,
  `total_question` int(11) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `time_duration` int(11) NOT NULL,
  `token` char(5) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_ujian`
--

INSERT INTO `tbl_ujian` (`id`, `title_ujian`, `type_ujian`, `code_ujian`, `total_question`, `time_start`, `time_end`, `time_duration`, `token`, `date_created`) VALUES
(14, 'Ujian Kompetensi yang sangat lama', 'tkd', 'TKDUjian202112', 20, '2021-12-20 15:15:00', '2021-12-29 15:16:00', 10, 'RN6F', '2021-12-21 00:00:00'),
(15, 'Ujian Kompetensi KCM', 'kcm', 'KCMUjian202112', 20, '2021-12-22 15:16:00', '2021-12-29 15:17:00', 10, 'WGUJ', '2021-12-21 00:00:00'),
(16, 'Ujian Kompetensi KPB', 'kpb', 'KPBUjian202112', 20, '2021-12-18 15:17:00', '2021-12-30 15:17:00', 10, 'UX1Z', '2021-12-21 00:00:00'),
(17, 'Tes KCM', 'kcm', 'KCMTes K202112', 20, '2021-12-22 09:03:00', '2021-12-23 09:03:00', 1, 'CVXY', '2021-12-23 00:00:00'),
(18, 'Tes Ujian dengan jumlah pertanyaan 15', 'tkd', 'TKDTes U202112', 15, '2021-12-24 08:10:00', '2021-12-31 08:10:00', 10, '2WQB', '2021-12-29 00:00:00'),
(19, 'Ujian Baru', 'tkd', 'TKDUjian202201', 5, '2021-12-31 17:32:00', '2022-01-03 17:32:00', 10, 'EZRZ', '2022-01-01 00:00:00'),
(20, 'Ujian Kecermatan Baru', 'kcm', 'KCMUjian202201', 2, '2022-01-01 16:55:00', '2022-01-10 16:55:00', 3, 'B2P4', '2022-01-02 00:00:00'),
(21, 'Ujian KCM', 'kcm', 'KCMUjian202201', 4, '2022-01-01 16:58:00', '2022-01-10 16:58:00', 3, 'ZGN5', '2022-01-02 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL DEFAULT 'namapengguna',
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `date_registration` timestamp NOT NULL DEFAULT current_timestamp(),
  `picture_profile` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `nama_pengguna`, `password`, `user_level`, `date_registration`, `picture_profile`) VALUES
(1, 'superadmin', 'MFYS_Nanakusa', '$2y$10$1OySa7SKFdOeAA2IaxQjpucNPdMYRSQppU6ux2dP0zW19vl8FjNOu', 1, '2021-10-31 06:14:31', '51ad861a8b06d0cab6a0ca19cf97661d.jpg'),
(11, 'adminsoal', 'Admin Soal', '$2y$10$0k7AeXV9CHq0OxDT3Pb1eetp2PI97CSA/dpodTWsltdjE3DDfUcLa', 5, '2021-12-11 01:52:36', '44c942f263b8f31df590afe356258467.jpg'),
(12, 'muridsatu', 'Alamsyah Imanuddin', '$2y$10$20C6K5sC1ZA5AJLprkiua.QSJIn97.EsHa1qQsXQtbubMdimZ2bfK', 6, '2021-12-11 01:55:51', '4b62fe44f4b58384ded21b6befd86c1a.jpg'),
(14, 'Murid_tiga', 'Jacob Nikolas Flamel', '$2y$10$lOuATNHN10mUGjIeYAkkaul14KzZjg8CKOetqOlVaDDGpB0x.H69u', 6, '2021-12-19 02:42:53', 'default.png'),
(17, 'muridHapus', 'Ilham Irfandi Jamal', '$2y$10$FTeZBICDqMs0orfTLitrbupOmommKEIGiSlCj9E4WnxgmoATebtc.', 6, '2021-12-19 03:55:52', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modificate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id`, `nama`, `date_created`, `date_modificate`) VALUES
(1, 'Super Admin', '2021-10-31 05:38:30', '2021-10-31 05:38:30'),
(5, 'admin ujian dan soal', '2021-12-11 01:50:19', '2021-12-11 01:50:19'),
(6, 'murid kursus', '2021-12-11 01:53:01', '2021-12-11 01:53:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indeks untuk tabel `tbl_hasil_ujian`
--
ALTER TABLE `tbl_hasil_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jawaban_images`
--
ALTER TABLE `tbl_jawaban_images`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jawaban_text`
--
ALTER TABLE `tbl_jawaban_text`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasil_ujian`
--
ALTER TABLE `tbl_hasil_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_jawaban_images`
--
ALTER TABLE `tbl_jawaban_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tbl_jawaban_text`
--
ALTER TABLE `tbl_jawaban_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

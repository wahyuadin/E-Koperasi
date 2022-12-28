-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2022 pada 16.27
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final-project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`id`, `kode_user`, `nama_user`, `nama_barang`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(1, '1712', 'Rafly', 'Honda beat', '2022-12-28', '2022-12-30', 'Pengajuan Di Tolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nim` int(255) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `prodi` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nim`, `nama_anggota`, `tempat_lahir`, `tgl_lahir`, `jk`, `prodi`) VALUES
(1, 1091, 'Admin', 'Rembang', '2000-06-23', 'L', 'Karawang'),
(3, 25415454, 'Rafly', 'karawang', '2022-02-22', 'L', 'Karawang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `pengarang_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(150) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `jumlah_buku` int(3) NOT NULL,
  `lokasi` enum('Rak 1','Rak 2','Rak 3') NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `pengarang_buku`, `penerbit_buku`, `tahun_terbit`, `isbn`, `jumlah_buku`, `lokasi`, `tgl_input`) VALUES
(10, 'Kendaraan', 'Motor', '22', '2019', '232', 2, 'Rak 3', '2022-12-22'),
(11, 'Kendaraan', 'Mobil', '2022', '2022', '232', 7, 'Rak 3', '2022-12-27'),
(12, 'tes', 'Motor', '22', '2022', '232', 21, 'Rak 1', '2022-12-27'),
(13, 'waa', 'waa', 'waa', '2022', '15454548', 4, 'Rak 1', '2022-12-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Wait'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id`, `kategori`, `nama`, `tahun`, `harga`, `unit`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(1, 'Kendaraan', 'Honda beat', '2022', '19000000', '3', '2323', '324343', 'acc'),
(3, 'Elektronik', 'Laptop', '2021', '21000000', '1', '', '', ''),
(7, 'Elektronik', 'Hp', '2021', '2000000', '3', '27122022', '27122022', 'acc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `nim_transaksi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_buku`, `nim_transaksi`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(1, 6, 1, 1, '23-12-2022', '30-12-2022', 'pinjam'),
(2, 4, 2, 2, '23-12-2022', '30-12-2022', 'pinjam'),
(3, 10, 1, 1, '', '', 'kembali'),
(4, 10, 1, 1, '', '', 'kembali'),
(5, 10, 1, 1, '', '', 'kembali'),
(6, 10, 1, 1, '', '', 'kembali'),
(7, 12, 1, 1, '', '', 'pinjam'),
(8, 12, 0, 0, '26-12-2022', '02-01-2023', 'pinjam'),
(9, 13, 0, 0, '26-12-2022', '02-01-2023', 'pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `email` varchar(255) NOT NULL,
  `verif` varchar(10) NOT NULL DEFAULT 'tidak',
  `user` varchar(10) NOT NULL DEFAULT '1',
  `code` varchar(255) NOT NULL,
  `param` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `foto`, `email`, `verif`, `user`, `code`, `param`, `status`) VALUES
(1, 'tes', '$2y$10$NebV5EBI0czzKOab/T1uWe4xH9TBS46JYFx5BaNye1YP7CgZlg.eq', 'Rafly', 'default.jpg', 'supereah@bukan.es', 'ya', '1', '1124149', '', '1'),
(2, 'wahyu', '$2y$10$QtSwHmiFJzjfxaSyCfm9yeoPhc25rjn7pTbbXFVlx4ZM7C8LMgd2G', 'Rafly', 'default.jpg', 'abilitam@eewmaop.com', 'ya', '1', '', '', '1'),
(3, 'rafly', '$2y$10$UIo.qOlk1.I7CYfzx1izje0SP2lqdXDWQSsGYMGWEMWlr5k/WfNVa', 'Rafly', 'default.jpg', 'ssakyr@puan.tech', 'ya', '1', '', '', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

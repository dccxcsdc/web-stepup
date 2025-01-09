-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2025 pada 14.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `step_up`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'stepup.com', 'stepup', 'I Putu Darmawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Tanggerang', 15000),
(2, 'Denpasar', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`, `nama_pelanggan`) VALUES
(1, 'darmawan67@gmail.com', 'darma', '081250293678', 'Kompleks Anggrek Residence, Jl. Melati II No. 12, Kel. Kebon Baru, Kec. Setiawan, Kota Surabaya, Jawa Timur, 60233', 'darmawan'),
(2, 'alice244@gmail.com', 'alice1234', '', 'jalan nakula no 114', 'alice');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `jumlah`, `tanggal`, `bukti`, `bank`) VALUES
(10, 48, 'alice', 969000, '2025-01-03', '20250103104615_Gambar WhatsApp 2024-12-31 pukul 17.02.32_54ff5f29.jpg', 'BRI'),
(11, 48, 'alice', 969000, '2025-01-03', '20250103104640_Gambar WhatsApp 2024-12-31 pukul 17.02.32_54ff5f29.jpg', 'BRI'),
(12, 49, 'darma', 1328000, '2025-01-04', '20250104114420Gambar WhatsApp 2024-12-31 pukul 17.02.32_54ff5f29.jpg', 'BCA'),
(13, 51, 'darma', 774000, '2025-01-05', '20250105105842Gambar WhatsApp 2024-12-31 pukul 17.02.32_54ff5f29.jpg', 'BCA'),
(14, 52, 'darma', 769000, '2025-01-05', '20250105110726Gambar WhatsApp 2024-12-31 pukul 17.02.32_54ff5f29.jpg', 'BRI'),
(15, 53, 'darma', 215000, '2025-01-05', '20250105113148Gambar WhatsApp 2024-12-31 pukul 17.02.32_54ff5f29.jpg', 'BCA'),
(16, 48, 'jhonson', 969000, '2025-01-05', '20250105114852DFD Konteks (2).png', 'DANA'),
(17, 54, 'darma', 774, '2025-01-05', '20250105121033DFD LEVEL 0.drawio (1).png', 'BNI'),
(18, 55, 'alice', 210000, '2025-01-05', '20250105121342Green & Orange Modern Organization Structure Graph.png', 'BRI'),
(19, 56, 'alice', 1528000, '2025-01-05', '20250105123231Green & Orange Modern Organization Structure Graph.png', 'mandiri'),
(20, 57, 'alex', 210000, '2025-01-05', '20250105124710activity_diagram_uml.png', 'BCA'),
(21, 58, 'alice', 215000, '2025-01-05', '20250105130410DFD Konteks (1).png', 'BCA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` decimal(10,0) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `resi_pengiriman` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `jumlah`, `tanggal_pembelian`, `total_pembelian`, `status_pembelian`, `id_pelanggan`, `id_ongkir`, `resi_pengiriman`, `nama_pelanggan`, `nama_kota`, `tarif`, `alamat_pengiriman`) VALUES
(48, 0, '2025-01-02', 969000, 'Lunas', 2, 2, '', '', 'Denpasar', 10000, 'jalan antasura no 113'),
(49, 0, '2025-01-03', 1328000, 'barang dikirim', 1, 2, '123465', '', 'Denpasar', 10000, 'jalan seribu jiwa no117'),
(50, 0, '2025-01-03', 774000, 'pending', 3, 1, '', '', 'Tanggerang', 15000, 'sembiran no 111'),
(51, 774000, '2025-01-04', 774000, 'barang dikirim', 1, 1, '123469', '', 'Tanggerang', 15000, 'warung kita'),
(52, 769000, '2025-01-05', 769000, 'lunas', 1, 2, '123460', '', 'Denpasar', 10000, 'jalan bantas asri'),
(53, 0, '2025-01-05', 215000, 'Lunas', 1, 1, '', '', 'Tanggerang', 15000, 'jalan tanakh lot'),
(54, 0, '2025-01-05', 774000, 'Lunas', 2, 1, '', '', 'Tanggerang', 15000, 'darma'),
(55, 0, '2025-01-05', 210000, 'sudah mengirimkan bukti pembayaran', 2, 2, '', '', 'Denpasar', 10000, 'jalan semer'),
(56, 0, '2025-01-05', 1528000, 'barang dikirim', 2, 2, '1234680', '', 'Denpasar', 10000, 'banjar kangin'),
(57, 0, '2025-01-05', 210000, 'sudah mengirimkan bukti pembayaran', 2, 2, '', '', 'Denpasar', 10000, 'jalan kuta'),
(58, 0, '2025-01-05', 215000, 'sudah mengirimkan bukti pembayaran', 2, 1, '', '', 'Tanggerang', 15000, 'denpasar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 0, 12, 1, '', 0, 0, 0, 0),
(2, 0, 13, 1, '', 0, 0, 0, 0),
(3, 0, 12, 1, '', 0, 0, 0, 0),
(4, 0, 13, 1, '', 0, 0, 0, 0),
(27, 0, 12, 1, '', 0, 0, 0, 0),
(28, 0, 12, 1, '', 0, 0, 0, 0),
(29, 0, 12, 1, '', 0, 0, 0, 0),
(30, 30, 12, 1, '', 0, 0, 0, 0),
(31, 30, 13, 1, '', 0, 0, 0, 0),
(32, 31, 12, 1, '', 0, 0, 0, 0),
(33, 31, 13, 1, '', 0, 0, 0, 0),
(34, 32, 12, 1, '', 0, 0, 0, 0),
(35, 32, 13, 1, '', 0, 0, 0, 0),
(36, 33, 12, 1, '', 0, 0, 0, 0),
(37, 33, 13, 1, '', 0, 0, 0, 0),
(38, 38, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 529900, 300, 300, 529900),
(39, 38, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(40, 39, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(41, 39, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(42, 40, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(43, 41, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(44, 42, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(45, 43, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(46, 44, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(47, 44, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(48, 45, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(49, 46, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(50, 46, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(51, 47, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(52, 48, 12, 2, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 600, 400000),
(53, 48, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(54, 49, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(55, 49, 13, 2, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 600, 1118000),
(56, 50, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(57, 50, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(58, 51, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(59, 51, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(60, 52, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(61, 52, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(62, 53, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(63, 54, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(64, 54, 13, 1, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 300, 559000),
(65, 55, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(66, 56, 12, 2, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 600, 400000),
(67, 56, 13, 2, 'Sepatu Ornada Pixel Suede Panda ', 559000, 300, 600, 1118000),
(68, 57, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000),
(69, 58, 12, 1, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 200000, 300, 300, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `informasi_produk` text NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `berat_produk`, `informasi_produk`, `foto_produk`, `harga_produk`, `stok_produk`) VALUES
(12, 'Sepatu Ornada Classic Light Cream Soccer Blue ', 300, 'BAHAN\r\nKulit Full Grain berasal dari lapisan terluar kulit, karena mengandung serat yang padat. Serat inilah yang membuat kulit memiliki serat yang lebih halus. Dikenal karena daya tahannya yang tinggi, kulit ini cenderung memiliki cacat alami karena hanya bulu pada kulit yang tercabut sehingga meninggalkan bekas pada bahan.\r\nKaret Termoplastik (TPR) adalah bahan yang memiliki karakteristik karet dan plastik. Dengan elastisitas dan bahan seperti karet, TPR secara efektif mengurangi kekuatan benturan dan mempertahankan daya tahan, sementara itu sangat nyaman dipakai.						', '1735309220_sepatu ornada.jpg', 200000, 91),
(13, 'Sepatu Ornada Pixel Suede Panda Tampil Modis Stylish', 300, '						MATERIAL\r\nFull Grain Leather berasal dari lapisan kulit terluar, karena mengandung serat yang padat. Serat inilah yang membuat kulit memiliki serat yang lebih halus. Dikenal karena daya tahannya yang tinggi, kulit ini cenderung memiliki cacat alami karena hanya bulu-bulu pada kulit yang tercabut, sehingga meninggalkan bekas pada materialnya.\r\nThermoplastic Rubber (TPR) merupakan material yang memiliki karakteristik seperti karet dan plastik. Dengan elastisitas dan sifat seperti karet, TPR secara efektif meredam kekuatan benturan dan mempertahankan daya tahannya, sekaligus sangat nyaman dipakai.				', '1735310378_Sepatu Ornada Pixel Suede Panda.jpg', 559000, 95);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

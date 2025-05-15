-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2025 pada 07.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hellodb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat_berat`
--

CREATE TABLE `alat_berat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `stok_default` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alat_berat`
--

INSERT INTO `alat_berat` (`id`, `nama`, `stok_default`, `harga`, `gambar`, `created_at`) VALUES
(3, 'ayam', 1, 100000, '1745794119_5e46cce88e480b5c3b95.jpg', '2025-04-26 06:46:19'),
(6, 'tangga', 3, 1500000, NULL, '2025-04-27 20:25:43'),
(7, 'kambing', 2, 200000, '1745760601_6c92dcd7e78211bc662a.png', '2025-04-27 20:30:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hello`
--

CREATE TABLE `hello` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hello`
--

INSERT INTO `hello` (`id`, `message`) VALUES
(1, 'Hello World from Database!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `alat_berat_id` int(11) DEFAULT NULL,
  `alat_nama` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hari` int(11) DEFAULT NULL,
  `jam` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_per_jam` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(50) DEFAULT NULL,
  `status_sewa` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `alat_berat_id`, `alat_nama`, `tanggal`, `hari`, `jam`, `jumlah`, `harga_per_jam`, `total_harga`, `nama`, `telepon`, `user_id`, `status_pembayaran`, `status_sewa`, `created_at`) VALUES
(33, 3, 'ayam', '2025-04-27', 1, 3, 1, 100000, 300000, 'ridho', '123', 4, 'sudah dibayar', 'berjalan', '2025-04-27 12:44:56'),
(35, 3, 'ayam', '2025-04-30', 2, 1, 1, 100000, 100000, 'ayam', '1321', 4, 'menunggu pembayaran', 'berjalan', '2025-04-27 23:43:07'),
(36, 3, 'ayam', '2025-04-30', 1, 1, 1, 100000, 100000, 'aku', '213', 4, 'menunggu pembayaran', 'berjalan', '2025-04-28 00:18:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_harian`
--

CREATE TABLE `stok_harian` (
  `id` int(11) NOT NULL,
  `alat_berat_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_harian`
--

INSERT INTO `stok_harian` (`id`, `alat_berat_id`, `tanggal`, `stok`) VALUES
(2, 3, '2025-04-27', 4),
(3, 3, '2025-04-30', 3),
(4, 3, '2025-05-01', 2),
(5, 3, '2025-05-02', 2),
(6, 3, '2025-05-03', 2),
(7, 3, '2025-05-04', 2),
(8, 3, '2025-05-05', 2),
(9, 3, '2025-05-06', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(2, 'Admin', 'admin@gmail.com', '$2y$10$/sIb9AmM2kNAYcFUMPmXMe6awKbIp4AMHcPJzI1wMytT3oRYp4T5a', 'admin'),
(4, 'ridho', 'Ridho_Akbar@student.itera.ac.id', '$2y$10$cE9PiPOh8Ug0jrbugN8MM.waq7U9.YjOhwnLxOYdmDK6DTWxKWpNi', 'user'),
(5, 'aku', 'ridhoakbarsyah10@gmail.com', '$2y$10$otE3s1lZa7eCCyyBY9S0VOCuiyMgCHj3i/2OaYU3OqdkWJ3SmsoV2', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hello`
--
ALTER TABLE `hello`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alat_berat_id` (`alat_berat_id`);

--
-- Indeks untuk tabel `stok_harian`
--
ALTER TABLE `stok_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alat_berat_id` (`alat_berat_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat_berat`
--
ALTER TABLE `alat_berat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `hello`
--
ALTER TABLE `hello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `stok_harian`
--
ALTER TABLE `stok_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`alat_berat_id`) REFERENCES `alat_berat` (`id`);

--
-- Ketidakleluasaan untuk tabel `stok_harian`
--
ALTER TABLE `stok_harian`
  ADD CONSTRAINT `stok_harian_ibfk_1` FOREIGN KEY (`alat_berat_id`) REFERENCES `alat_berat` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

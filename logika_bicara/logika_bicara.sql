-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2026 pada 12.53
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
-- Database: `logika_bicara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `isi`, `tanggal`, `created_at`, `gambar`) VALUES
(2, 'Test Upload Artikel', 'cuma test Artikel doang bos jangan baper!', '2026-05-28', '2026-05-27 19:53:23', NULL),
(3, 'test upload gambar artikel', 'test gambar artikel boss jangan marah marah sabar ya', '2026-05-28', '2026-05-27 19:55:19', NULL),
(4, 'test lagi', 'test lagi ya jangan bosen bosen bos!', '2026-05-28', '2026-05-27 19:59:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konten_website`
--

CREATE TABLE `konten_website` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `tentang` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konten_website`
--

INSERT INTO `konten_website` (`id`, `nama_perusahaan`, `tagline`, `tentang`, `email`, `telepon`, `alamat`) VALUES
(1, 'PT Logika Bicara', 'Solusi Komunikasi Digital untuk Bisnis Modern', 'PT Logika Bicara adalah perusahaan yang bergerak di bidang komunikasi, teknologi informasi, dan solusi digital.', 'info@logikabicara.com', '021-000000', 'Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(1, 'Network Solution', 'Instalasi jaringan perusahaan', NULL),
(2, 'IT Consultation', 'Konsultasi teknologi', NULL),
(3, 'Maintenance', 'Pemeliharaan sistem', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_target` enum('admin','staff','client') DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `role_target`, `judul`, `pesan`, `link`, `is_read`, `created_at`) VALUES
(1, NULL, 'admin', 'Ticket Baru', 'Client membuat ticket baru: test notif', '../admin/ticket_chat.php?id=2', 1, '2026-05-28 07:33:50'),
(2, NULL, 'staff', 'Ticket Baru', 'Client membuat ticket baru: test notif', '../staff/ticket_chat.php?id=2', 1, '2026-05-28 07:33:50'),
(3, NULL, 'admin', 'Ticket Baru', 'Client membuat ticket baru: testttttt woi', '../admin/ticket_chat.php?id=3', 1, '2026-05-28 07:35:26'),
(4, NULL, 'staff', 'Ticket Baru', 'Client membuat ticket baru: testttttt woi', '../staff/ticket_chat.php?id=3', 1, '2026-05-28 07:35:26'),
(5, 1, 'client', 'Balasan Ticket', 'Staff telah membalas ticket Anda.', 'ticket_chat.php?id=2', 1, '2026-06-03 09:24:10'),
(6, 1, 'client', 'Balasan Ticket', 'Staff telah membalas ticket Anda.', 'ticket_chat.php?id=3', 1, '2026-06-03 10:08:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_kontak`
--

CREATE TABLE `pesan_kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesan_kontak`
--

INSERT INTO `pesan_kontak` (`id`, `nama`, `email`, `pesan`, `created_at`) VALUES
(1, 'Udin', 'Udintest@gmail.com', 'Halo saya lagi Test pesan!', '2026-05-27 19:12:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `nama_project` varchar(100) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` enum('pending','progress','done') DEFAULT 'pending',
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval_status` enum('waiting','approved') DEFAULT 'waiting',
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `nama_project`, `client_id`, `status`, `deskripsi`, `created_at`, `approval_status`, `approved_at`) VALUES
(1, 'Aethra.id', 1, 'done', 'Progress launching dibulan Mei 2026', '2026-05-27 18:02:20', 'approved', '2026-05-28 15:01:39'),
(2, 'Test Project', 1, 'done', 'ini test kontol', '2026-05-28 06:22:12', 'approved', '2026-05-28 15:01:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project_progress`
--

CREATE TABLE `project_progress` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `judul_progress` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `project_progress`
--

INSERT INTO `project_progress` (`id`, `project_id`, `judul_progress`, `deskripsi`, `persentase`, `created_at`) VALUES
(1, 2, 'Analisis kebutuhan selesai', 'Tim sudah menyelesaikan analisis awal kebutuhan client.', 30, '2026-05-28 06:26:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `balasan` text DEFAULT NULL,
  `status` enum('open','process','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ticket`
--

INSERT INTO `ticket` (`id`, `client_id`, `judul`, `pesan`, `balasan`, `status`, `created_at`, `attachment`) VALUES
(1, 1, 'Test Upload File', 'Ini testing attachment', NULL, 'open', '2026-05-27 18:37:49', '1779907069_ALAUDIN SAFA_PERBAIKAN NILAI RPL.pdf'),
(2, 1, 'test notif', 'test notif doang ini santai', NULL, 'process', '2026-05-28 07:33:50', NULL),
(3, 1, 'testttttt woi', 'testttt', NULL, 'process', '2026-05-28 07:35:26', '1779953726_Screenshot 2024-10-19 145913.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket_chat`
--

CREATE TABLE `ticket_chat` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `sender_role` enum('client','staff','admin') DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ticket_chat`
--

INSERT INTO `ticket_chat` (`id`, `ticket_id`, `sender_role`, `message`, `created_at`) VALUES
(1, 2, 'staff', 'rdtrdg', '2026-06-03 09:24:10'),
(2, 2, 'client', 'resrfsg', '2026-06-03 09:24:47'),
(3, 3, 'staff', 'edwdasfasas', '2026-06-03 10:08:54'),
(4, 3, 'client', 'dahfasfhasfhah', '2026-06-03 10:09:09'),
(5, 2, 'client', 'sdsdsdhs', '2026-06-03 10:16:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','client') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Alaudin Safa', 'alsafatest@gmail.com', '$2y$10$C5.FXIeTsqf6WtCTDsrr2es.jUKt39ysYskO7bNsI9Iv2rzrGfTSa', 'client'),
(2, 'Alsafa', 'alsafatest1@gmail.com', '$2y$10$qruoT/SdSWqWpTlCtwnKjOGAOpujwF19HOMroaKj4050ie4R33iOW', 'staff'),
(3, 'Admin', 'admin@logika.com', '$2y$10$gyqDjQ.bgNSRLJGY4MocRequlRzZNXTR2FyQOUxMPVa.pF/l.EjpS', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konten_website`
--
ALTER TABLE `konten_website`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project_progress`
--
ALTER TABLE `project_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ticket_chat`
--
ALTER TABLE `ticket_chat`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `konten_website`
--
ALTER TABLE `konten_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `project_progress`
--
ALTER TABLE `project_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ticket_chat`
--
ALTER TABLE `ticket_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

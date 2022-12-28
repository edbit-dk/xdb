-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Vært: localhost
-- Genereringstid: 28. 12 2022 kl. 08:57:38
-- Serverversion: 8.0.31
-- PHP-version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xdb`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `xdb_records`
--

CREATE TABLE `xdb_records` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `team_id` int NOT NULL,
  `course_grade` double DEFAULT NULL,
  `winter_grade` double DEFAULT NULL,
  `summer_grade` double DEFAULT NULL,
  `final_grade` double DEFAULT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `xdb_subjects`
--

CREATE TABLE `xdb_subjects` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `xdb_teams`
--

CREATE TABLE `xdb_teams` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `xdb_users`
--

CREATE TABLE `xdb_users` (
  `id` int NOT NULL,
  `team_id` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `xdb_records`
--
ALTER TABLE `xdb_records`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `xdb_subjects`
--
ALTER TABLE `xdb_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `xdb_teams`
--
ALTER TABLE `xdb_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `xdb_users`
--
ALTER TABLE `xdb_users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `xdb_records`
--
ALTER TABLE `xdb_records`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `xdb_subjects`
--
ALTER TABLE `xdb_subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `xdb_teams`
--
ALTER TABLE `xdb_teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `xdb_users`
--
ALTER TABLE `xdb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

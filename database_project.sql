-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2025 at 03:54 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Attraction', '2025-05-04 08:30:45', '2025-05-04 08:30:45'),
(4, 'Entertaiment', '2025-05-04 08:48:32', '2025-05-04 08:48:32'),
(5, 'Education', '2025-05-04 08:58:13', '2025-05-04 08:58:13'),
(6, 'Concert', '2025-05-05 00:19:10', '2025-05-05 00:19:10'),
(7, 'Seminar', '2025-05-05 05:55:24', '2025-05-05 05:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `venue_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `venue_id`, `title`, `description`, `startDateTime`, `endDateTime`, `image`, `category_id`) VALUES
(5, 4, 4, '2025 Jakarta E-Prix', 'Indonesia proudly joined the ranks of host nations when Jakarta held its first Jakarta E-Prix during Season 8.The inaugural race, held at the Jakarta International E-Prix Circuit (JIEC) on June 4, 2022', '2025-06-21 07:00:00', '2025-06-21 23:00:00', '1746372843.jpg', 3),
(6, 4, 5, 'ECCITAZIONE 2025', 'Pentas seni on SMA Yadika 1', '2025-05-10 22:00:00', '2025-05-10 17:00:00', '1746373825.jpeg', 4),
(7, 4, 6, 'LABSPROJECT 2025: SPECTHERA', 'LABSPROJECT is an annual art festival hosted by SMA Labschool Jakarta, designed to celebrate and showcase students talents in the arts.', '2025-07-12 00:00:00', '2025-07-12 11:00:00', '1746374120.png', 4),
(8, 4, 7, 'Manager Fest 2025', 'Manager Fest is more than a learning experience, it\'s a celebration of professionals coming together to connect, collaborate, and grow.', '2025-05-10 07:00:00', '2025-05-10 17:00:00', '1746374496.png', 5),
(9, 4, 8, 'Mamma Mia The Musical Re-run 2025', 'Get ready to dance, jive, and have the time of your life to this heartwarming mother-daughter tale in Kalokairi, Greece accompanied by the infamous numbers from ABBAs hits like Mamma Mia!, Dancing Queen and Super Trouper.', '2025-05-21 19:30:00', '2025-06-01 22:31:00', '1746375138.jpg', 4),
(10, 4, 9, 'Toe - Now We See The Light Live in Jakarta', 'Get ready for an unforgettable musical experience with TOE, the renowned instrumental post-rock band from Japan, known for their intricate arrangements and emotionally captivating melodies.', '2025-09-27 19:00:00', '2025-09-27 22:00:00', '1746375272.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2025_05_03_130037_create_users_table', 1),
(5, '2025_05_03_131530_create_sessions_table', 2),
(6, '2025_05_03_140246_create_events_table', 3),
(7, '2025_05_03_140303_create_venues_table', 3),
(8, '2025_05_03_140310_create_orders_table', 3),
(9, '2025_05_03_140321_create_tickettypesr_table', 3),
(10, '2025_05_04_112926_create_categories_table', 4),
(11, '2025_05_04_115535_add_category_id_to_events_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `ticket_types_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unitPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `event_id`, `ticket_types_id`, `user_id`, `quantity`, `unitPrice`) VALUES
(12, 5, 9, 1, 2, 600000),
(13, 5, 8, 1, 1, 850000),
(14, 10, 23, 1, 5, 3000000),
(15, 8, 18, 1, 1, 200000),
(16, 7, 16, 1, 5, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('k6cwOhWEfBKQWuIJNBZM8GK5l4QpmfznQKFksYcm', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWVFCM1kycFpQNGlHUzVIZEl1ZkNoT2dubVQ4SDFlaDd5WTFxU1BFYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjtzOjc6InVzZXJfaWQiO2k6Njt9', 1748318040);

-- --------------------------------------------------------

--
-- Table structure for table `tickettypes`
--

CREATE TABLE `tickettypes` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quota` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickettypes`
--

INSERT INTO `tickettypes` (`id`, `event_id`, `name`, `price`, `quota`) VALUES
(1, 1, 'VIP', 1000000, 50),
(2, 1, 'Reguler', 2000000, 1000),
(4, 4, 'vip', 52535, 10),
(5, 4, 'festiv', 1341344444, 21141),
(6, 5, 'VVIP', 8500000, 20),
(7, 5, 'VIP', 2550000, 100),
(8, 5, 'Grandstand (seating)', 850000, 500),
(9, 5, 'Festival', 300000, 400),
(10, 6, 'Bundling Couple', 140, 500),
(11, 6, 'Reguler', 75000, 500),
(12, 7, 'Hysteria', 260000, 100),
(13, 7, 'Dystopia', 245000, 100),
(14, 7, 'Nocturne', 625000, 150),
(15, 7, 'Lantern', 525000, 125),
(16, 7, 'Festival', 300000, 500),
(17, 8, 'Workout Session with Active Barn', 150000, 100),
(18, 8, 'Workshop Session with Generation Girl', 200000, 100),
(19, 8, 'Workshop Session with MOGO', 120000, 100),
(20, 9, 'Bronze', 250000, 500),
(21, 9, 'Silver', 500000, 200),
(22, 9, 'Gold', 700000, 200),
(23, 10, 'Reguler', 600000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phoneNumber`, `role`) VALUES
(1, 'aris', 'm.waarits2304@gmail.com', '$2y$12$ELGYBkMXEiO5CmVV7/eRUeo6txiz8E/amJNHouEqN1/4XFvUZ3Ke2', '081374474451', 'organizer'),
(5, 'sasha', 'sasha@gmail.com', '$2y$12$IBawLZNsbVncjwy0rNdB..P.JcqQprE472OpL95hsp6BwEk7Q/94G', '0812328332', 'user'),
(6, 'jane', 'jane@gmail.com', '$2y$12$VMCGidoSiGtNiJBwsauCB.Ph68MV0RpfDdjMT7P2YFdFelZjugH5a', '08571383197', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `address`, `capacity`) VALUES
(4, 'Jakarta International E-Prix Circuit', 'Jl. Kw. Wisata Ancol Ancol Kec. Pademangan Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14430, Indo, Pademangan, Jakarta, Indonesia', 1000),
(5, 'SMA Yadika 1 Duri Kepa', 'Jalan Taman Ratu Indah Blok EE 5 No.5, RT.9/RW.1, Duri Kepa, Kebonjeruk, Jakarta City West, Jakarta, Indonesia View on Map', 500),
(6, 'Tennis Indoor Senayan', 'Jl. Pintu Gelora 1 No.B Tanah Abang Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270, Jakarta Pusat, Jakarta, Indonesia', 5000),
(7, 'FX Sudirman', 'Jl. Jenderal Sudirman, Jakarta Pusat, Jakarta, Indonesia', 3000),
(8, 'Graha Bhakti Budaya', 'Taman Ismail Marzuki, Jl. Cikini Raya No. 73, Menteng, Cikini, Jakarta Pusat, Jakarta, Indonesia', 5000),
(9, 'Bali United Studio', 'Jl. Duri Utama Raya No.43, RT.11/RW.7, Duri Kepa, Kecamatan Kebon Jeruk, Jakarta Barat Kota, Jakarta, Indonesia', 1500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tickettypes`
--
ALTER TABLE `tickettypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tickettypes`
--
ALTER TABLE `tickettypes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2026 at 12:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booster`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `service_link` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `service_type` varchar(255) DEFAULT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code_id` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `username`, `email`, `password`, `service_link`, `quantity`, `service_type`, `tag_id`, `referral_code_id`, `country`, `created_at`, `updated_at`) VALUES
(1, 'hoeger.laurel', 'brook25@example.net', 'password', NULL, 0, NULL, 3, 'REF366', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(2, 'okon.gene', 'tmurphy@example.net', 'password', NULL, 0, NULL, 3, 'REF338', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(3, 'lynch.justice', 'gardner97@example.org', 'password', NULL, 0, NULL, 1, 'REF995', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(4, 'colten.carroll', 'ubernhard@example.org', 'password', NULL, 0, NULL, 2, 'REF769', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(5, 'qschroeder', 'tyra.bailey@example.net', 'password', NULL, 0, NULL, 2, 'REF525', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(6, 'torey97', 'kihn.lucile@example.org', 'password', NULL, 0, NULL, 3, 'REF321', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(7, 'fritsch.kaelyn', 'arden.torphy@example.net', 'password', NULL, 0, NULL, 3, 'REF393', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(8, 'hamill.nolan', 'bogisich.manuel@example.com', 'password', NULL, 0, NULL, 3, 'REF257', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(9, 'smith.isaias', 'waelchi.art@example.net', 'password', NULL, 0, NULL, 2, 'REF606', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(10, 'thiel.hazle', 'naomie.ruecker@example.net', 'password', NULL, 0, NULL, 1, 'REF718', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(11, 'okuneva.roderick', 'rice.michel@example.org', 'password', NULL, 0, NULL, 3, 'REF310', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(12, 'friesen.laverne', 'thomas67@example.net', 'password', NULL, 0, NULL, 3, 'REF040', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(13, 'fritsch.gino', 'nikita29@example.org', 'password', NULL, 0, NULL, 3, 'REF610', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(14, 'dibbert.norris', 'koss.jayde@example.com', 'password', NULL, 0, NULL, 3, 'REF410', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(15, 'hill.josephine', 'ebert.jamison@example.net', 'password', NULL, 0, NULL, 3, 'REF607', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(16, 'humberto.boyle', 'taufderhar@example.org', 'password', NULL, 0, NULL, 1, 'REF168', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(17, 'destiny95', 'fklocko@example.org', 'password', NULL, 0, NULL, 1, 'REF006', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(18, 'ikohler', 'malvina.schoen@example.org', 'password', NULL, 0, NULL, 1, 'REF790', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(19, 'darrel.hessel', 'satterfield.nolan@example.org', 'password', NULL, 0, NULL, 3, 'REF325', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(20, 'etreutel', 'gabrielle95@example.org', 'password', NULL, 0, NULL, 1, 'REF068', NULL, '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(21, 'admin', 'emibank@gmail.com', '23423423', NULL, 300, NULL, 2, '\"00000\"', NULL, '2026-02-16 01:42:32', '2026-02-16 01:42:32'),
(22, 'admin', 'emibank@gmail.com', '32423423', NULL, 3423, NULL, 1, '\"00000\"', NULL, '2026-02-16 01:55:00', '2026-02-16 01:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_08_102415_create_tags_table', 1),
(5, '2026_02_08_103325_create_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8bGA3llNA0DGzaGLYWVGYoyaQJqsBPT4OH1V083P', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibm1JOHlGbEtvWDk0aFUxMGIzYUhRMXBvSjFKVUhsQ2dUNmZQelZQTCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1771210450),
('QLvygSFot45yzxFKPKwy9xe0rIzYzv6zIELOzyr3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN21TWE5aa0JnZTJ3eXBIMWE3Szl1cXFxZ3JpQW9OWWxJZGc5eW1RMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob21lP3JlZl9pZD0lMjIwMDAwMCUyMiI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771210553);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://www.pngkit.com/png/full/326-32651_facebook-twitter-instagram-icons-png-social-media-icons.png', '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(2, 'instagram', 'https://www.pngkit.com/png/full/326-32651_facebook-twitter-instagram-icons-png-social-media-icons.png', '2026-02-16 01:41:53', '2026-02-16 01:41:53'),
(3, 'twitter', 'https://www.pngkit.com/png/full/326-32651_facebook-twitter-instagram-icons-png-social-media-icons.png', '2026-02-16 01:41:53', '2026-02-16 01:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `referral_id` varchar(255) DEFAULT NULL,
  `referral_user_id` varchar(255) DEFAULT NULL,
  `sub_start` date DEFAULT NULL,
  `is_disabled` tinyint(1) DEFAULT NULL,
  `role` enum('customer','user','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `referral_code`, `referral_id`, `referral_user_id`, `sub_start`, `is_disabled`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '2026-02-16 01:41:52', '$2y$12$UalYAY3G3srJQ/RzrO6lHuhYZzW6rzt5RtTnnpB5nPrwFsVpEVmze', '0000', '0000', '0000', NULL, NULL, 'admin', 'r6eG5fDN4u', '2026-02-16 01:41:53', '2026-02-16 01:41:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

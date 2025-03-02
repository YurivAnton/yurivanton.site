-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Час створення: Бер 02 2025 р., 12:06
-- Версія сервера: 8.0.41-0ubuntu0.24.04.1
-- Версія PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `laravel`
--

-- --------------------------------------------------------

--
-- Структура таблиці `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `population` int NOT NULL,
  `country_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `cities`
--

INSERT INTO `cities` (`id`, `name`, `population`, `country_id`) VALUES
(12, 'Dolyna', 20000, 1),
(13, 'Kyiv', 1000000, 1),
(14, 'Lviv', 100000, 1),
(15, 'Bratislava', 50000, 2),
(16, 'Trnava', 10000, 2),
(17, 'Kosice', 15000, 2),
(18, 'Praha', 100000, 3),
(19, 'Brno', 80000, 3),
(20, 'Ostrava', 100000, 3);

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Ukraine'),
(2, 'Slovakia'),
(3, 'Cech republik');

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_11_03_154539_create_post_table', 1),
(2, '2024_11_03_160648_create_users_table', 1),
(3, '2024_11_03_154539_create_posts_table', 2),
(4, '2024_11_03_160649_create_users_table', 3),
(5, '2024_11_03_154540_create_posts_table', 4),
(6, '2024_11_03_160650_create_users_table', 4),
(7, '2025_01_07_121921_create_cache_table', 5),
(8, '2025_01_07_122528_create_sessions_table', 6),
(9, '2025_01_13_185458_create_new_users_table', 7),
(10, '2025_01_13_185718_creat_profiles_table', 7),
(11, '2025_01_13_185718_creat_profils_table', 8),
(12, '2025_01_15_103356_add_country_id_to_cities', 8),
(13, '2025_01_15_103920_create_countries_table', 8),
(14, '2025_01_15_190409_add_population_cities', 9),
(15, '2025_01_22_185530_create_comments_table', 10),
(16, '2025_01_23_161541_create_positions_table', 11),
(17, '2025_01_23_161752_add_city_id_position_id_to_users', 11),
(18, '2025_01_23_181510_create_roles_table', 12),
(19, '2025_01_23_182555_create_user_role_table', 13);

-- --------------------------------------------------------

--
-- Структура таблиці `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'program'),
(2, 'ing');

-- --------------------------------------------------------

--
-- Структура таблиці `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `likes` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `likes`, `created_at`, `updated_at`) VALUES
(1, 'aMMR8Jq5bf', 'AWfxu', 2, NULL, NULL),
(2, 'FMGpAV8DyW', 'jmbDO', 2, NULL, NULL),
(3, 'dcJC3diSu1', 'W4Slq', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `profils`
--

CREATE TABLE `profils` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `profils`
--

INSERT INTO `profils` (`id`, `name`, `surname`, `email`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Anton', 'Yuriv', 'anton@mail.com', 1, NULL, NULL, NULL),
(2, 'Anna', 'Yuriv', 'anna@mail.com', 2, NULL, NULL, NULL),
(3, 'User', 'Userovych', 'user@mail.com', 3, NULL, NULL, NULL),
(4, 'Bob', 'Bobovych', 'bob@mail.com', 4, NULL, NULL, NULL),
(5, 'Samanta', 'Samantivna', 'samanta@mail.com', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'role_1'),
(2, 'role_2');

-- --------------------------------------------------------

--
-- Структура таблиці `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(3, 1, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблиці `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Pc8NMhpmzAaXYzXZe8thuhODtpznBv747Lj7WNiQ', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHFxMVc2MzhkT05YWkFyZlJLRzB0N0tUVGpSRG5oSDY5RVdkekhJTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb29raWUvZ2V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739008825);

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `position_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `created_at`, `updated_at`, `deleted_at`, `city_id`, `position_id`) VALUES
(1, NULL, 'Anton', '$2y$12$VETci87d8vqPl9/Qiz/A6uCbQ3wAR9ywMxFDoAOpVhJ3STE/K1KjG', NULL, NULL, NULL, 12, 1),
(2, NULL, 'Anna', '$2y$12$riJrJliOvHCuMU5MQ0M7pu.rDa418jMeBDN6YbHUPe2XlFl.SWFW6', NULL, NULL, NULL, 13, 2),
(3, NULL, 'User', '$2y$12$h5uCfFqo0UsptVOdjHbf5.7/FjID3l/ly1Zh8C611lD6/rl4xC36O', NULL, NULL, NULL, 14, 1),
(4, NULL, 'Bob', '$2y$12$GSutnN.8.Zw5xfon/JD51OTDrsEVRY2E4bVtqNFaN2y2Jn9r5trQa', NULL, NULL, NULL, 15, 2),
(5, NULL, 'Samanta', '$2y$12$OQSyD1L.AhXyJ98KDA..8uQfxtbKeGokdjyus4WLcwjDQ7GdhMISS', NULL, NULL, NULL, 16, 1),
(11, 'Sofiia', 'sofi', NULL, '2025-02-08 07:59:32', '2025-02-08 07:59:32', NULL, NULL, NULL),
(12, 'Sofiia', 'sofi', NULL, '2025-02-08 08:00:45', '2025-02-08 08:00:45', NULL, NULL, NULL),
(13, 'asd', 'aaaaaaa', NULL, '2025-02-08 08:00:59', '2025-02-08 08:00:59', NULL, NULL, NULL),
(14, 'qwe', 'bbbbbbbbbbbbb', NULL, '2025-02-08 08:02:51', '2025-02-08 08:02:51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `users_old`
--

CREATE TABLE `users_old` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `salary` int NOT NULL,
  `city_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `users_old`
--

INSERT INTO `users_old` (`id`, `name`, `email`, `age`, `salary`, `city_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'Bob', 'bob@mail.com', 30, 100, NULL, NULL, '2025-01-13 18:23:51', '2025-01-13 18:23:51'),
(18, 'Anton', 'anton@mail.com', 38, 3000, NULL, NULL, '2025-01-13 18:23:51', '2025-01-13 18:23:51'),
(20, 'User', 'user@mail.com', 30, 1000, NULL, NULL, '2025-01-13 18:23:51', '2025-01-13 18:23:51'),
(22, 'Samanta', 'samanta@mail.com', 31, 500, NULL, NULL, '2025-01-13 18:23:51', '2025-01-13 18:23:51');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Індекси таблиці `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Індекси таблиці `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users_old`
--
ALTER TABLE `users_old`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблиці `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `profils`
--
ALTER TABLE `profils`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `users_old`
--
ALTER TABLE `users_old`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2020 at 09:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `webservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `created_at`, `updated_at`) VALUES
(1, 'Feel my love', 'Bob', '2016-07-11 13:00:00', NULL),
(2, 'Chittu kuruvi', 'Marley', '2016-07-11 13:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latest_article_published` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `email`, `github`, `twitter`, `location`, `latest_article_published`, `created_at`, `updated_at`) VALUES
(1, 'bala', 'balakarthikeya@gmail.com', 'http://www.github.com/balakarthikeya', 'http://www.twitter.com/balakarthikeya', 'Coimbatore', 'None', '2020-08-12 15:49:20', '2020-08-12 15:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Arts', '2020-08-26 02:12:59', '2020-08-26 02:12:59'),
(2, 'Science', '2020-08-26 02:13:00', '2020-08-26 02:13:00'),
(3, 'History', '2020-08-26 02:13:00', '2020-08-26 02:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `thumbnail_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `body`, `thumbnail_path`, `created_at`, `updated_at`) VALUES
(1, 6, 3, 'Distinctio nisi sint beatae.', 'Blanditiis nihil neque sed aut eaque quasi assumenda. Eos quibusdam omnis non iure sed non. Debitis aut qui in quia sequi.', NULL, '2020-08-26 02:19:38', '2020-08-26 02:19:38'),
(2, 5, 3, 'Dolores velit molestiae ut occaecati.', 'Autem a quod voluptatem harum. Dolores non corporis aut non. Ullam delectus accusantium est aspernatur aut. Laborum omnis quam ex corporis. Aut ut eius sequi molestiae sed.', NULL, '2020-08-26 02:19:38', '2020-08-26 02:19:38'),
(3, 3, 3, 'Quasi beatae doloremque temporibus et quos architecto.', 'Distinctio et occaecati sit odio eum. Omnis eos dolorum et et quo. Sint exercitationem vitae non vel. Aut dolorem quasi quo qui.', NULL, '2020-08-26 02:19:38', '2020-08-26 02:19:38'),
(4, 4, 2, 'Soluta facilis iste aliquid sed.', 'Illum et non assumenda quam veritatis numquam perferendis. Excepturi quo sed culpa eos ut aut amet ea.', NULL, '2020-08-26 02:19:38', '2020-08-26 02:19:38'),
(5, 4, 1, 'Unde fugit dolorum nulla itaque autem nam.', 'Quo quibusdam molestias hic aut eveniet reiciendis excepturi. Illo omnis ducimus dolor voluptas nulla. Voluptas amet animi facere assumenda.', NULL, '2020-08-26 02:19:39', '2020-08-26 02:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'Red', 'Roses are Red', '2020-08-26 01:57:33', '2020-08-26 01:57:33'),
(2, 'Blue', 'Skies are Blue', '2020-08-26 01:57:53', '2020-08-26 01:57:53'),
(3, 'Orange', 'Sunset over mountain range', '2020-08-26 01:58:32', '2020-08-26 01:58:32'),
(4, 'Green', 'Grasses are green', '2020-08-26 01:58:51', '2020-08-26 01:58:51'),
(5, 'Yellow', 'Gold are Yellow', '2020-08-26 01:59:16', '2020-08-26 01:59:16'),
(6, 'White', 'Purity is White', '2020-08-26 01:59:36', '2020-08-26 01:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `created_at`, `updated_at`, `description`, `author`, `background`) VALUES
(1, '2016-07-05 02:48:51', '2016-07-05 02:48:51', 'Success is going from failure to failure without losing your enthusiasm', 'Winston Churchill', '1.jpg'),
(2, '2016-07-05 02:48:51', '2016-07-05 02:48:51', 'Dream big and dare to fail', 'Norman Vaughan', '2.jpg'),
(3, '2016-07-05 02:48:51', '2016-07-05 02:48:51', 'It does not matter how slowly you go as long as you do not stop', 'Confucius', '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Painting', '2020-08-26 02:13:11', '2020-08-26 02:13:11'),
(2, 1, 'Crafts', '2020-08-26 02:13:11', '2020-08-26 02:13:11'),
(3, 2, 'Botany', '2020-08-26 02:13:11', '2020-08-26 02:13:11'),
(4, 2, 'Zoology', '2020-08-26 02:13:11', '2020-08-26 02:13:11'),
(5, 3, 'Indian', '2020-08-26 02:13:12', '2020-08-26 02:13:12'),
(6, 3, 'American', '2020-08-26 02:13:12', '2020-08-26 02:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `provider`, `provider_id`, `access_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'user@example.com', '2020-08-26 02:00:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'jCF1bVryg9', '2020-08-26 02:00:09', '2020-08-26 02:00:09'),
(2, 'Test Admin', 'admin@example.com', '2020-08-26 02:00:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'Y13fwoeKlW', '2020-08-26 02:00:10', '2020-08-26 02:00:10'),
(3, 'Test Manager', 'manager@example.com', '2020-08-26 02:00:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'l94CDOq6Vv', '2020-08-26 02:00:10', '2020-08-26 02:00:10'),
(4, 'Editor', 'editor@example.com', '2020-08-26 02:00:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'BMulR9Pea7', '2020-08-26 02:00:10', '2020-08-26 02:00:10'),
(5, 'Publisher', 'publisher@example.com', '2020-08-26 02:00:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '0IWk3XDyMk', '2020-08-26 02:00:10', '2020-08-26 02:00:10'),
(6, 'Balakarthikeyan', 'balakarthikeya@gmail.com', '2020-08-26 02:00:09', '$2y$10$EfbOXNM69KxkkmzZUOyImODRzZDMExFSJzSKYOy.Ty7TeyyJPsF4K', NULL, NULL, NULL, NULL, NULL, '2020-08-26 02:01:16', '2020-08-26 02:01:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

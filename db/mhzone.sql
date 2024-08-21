-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2024 at 12:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/image/default-user.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2022-07-25 05:09:47', '$2y$10$YdA.qC1H69hQeItWhL378OT6ysr8zG7MLZKx5JRKOVeLWVKdZetz.', 'uploads/user/1684330737_6464d8f16ebd7.png', 'PmQ12ZynralQxOIQW1kfETSPbVe9lIXmuuYj6EijOgX1Uetps1zhM0LGtQZH', '2022-07-25 05:09:47', '2023-05-17 18:38:57'),
(2, 'Superadmin', 'arobil@gmail.com', '2022-07-25 05:09:47', '$2y$10$YdA.qC1H69hQeItWhL378OT6ysr8zG7MLZKx5JRKOVeLWVKdZetz.', 'uploads/user/1684332274_6464def251c74.jpg', 'Au1WOUohoL2xwdvUuRR9lUrHVBxmLJFKeyzHBAvAITIypUh4xrT0zVspwE3k', '2022-07-25 05:09:47', '2023-05-17 19:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `admin_searches`
--

CREATE TABLE `admin_searches` (
  `id` bigint UNSIGNED NOT NULL,
  `page_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint DEFAULT NULL COMMENT 'For Gender(Men/Women)',
  `category_id` bigint UNSIGNED NOT NULL,
  `subcategory_id` bigint UNSIGNED DEFAULT NULL,
  `condition` enum('new','used') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `discount` int DEFAULT NULL COMMENT 'Percent(%)',
  `price_after_discount` float(10,2) DEFAULT NULL,
  `qty` bigint DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','sold','pending','declined') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_banner` int NOT NULL DEFAULT '0',
  `is_deal_of_day` int NOT NULL DEFAULT '0',
  `total_reports` int NOT NULL DEFAULT '0',
  `total_views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `slug`, `user_id`, `department_id`, `category_id`, `subcategory_id`, `condition`, `brand_id`, `price`, `discount`, `price_after_discount`, `qty`, `description`, `thumbnail`, `status`, `is_banner`, `is_deal_of_day`, `total_reports`, `total_views`, `created_at`, `updated_at`, `validity`) VALUES
(1, 'Elegant Style Genuine Leather Oxford Shoes SB-S470', 'lorem-ipsum-is-simply-dummy-text', 2, 2, 14, NULL, 'new', NULL, 544.00, 9, 495.04, 10, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'active', 0, 0, 0, 0, '2023-05-17 19:35:48', '2024-08-19 18:08:40', NULL),
(2, 'Limited Edition Casual Leather Shoes SB-S78', 'what-is-lorem-ipsum', 2, 2, 14, NULL, 'new', NULL, 100.00, 5, 95.00, 9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'active', 0, 0, 0, 0, '2023-05-17 19:39:52', '2024-08-19 18:08:14', '2023-06-24 14:46:22'),
(3, 'Limited Edition Casual Leather Shoes SB-S78', 'limited-edition-casual-leather-shoes-sb-s78', 3, 2, 12, NULL, 'new', NULL, 250.00, 10, 225.00, 11, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'active', 0, 1, 0, 0, '2023-05-17 19:43:23', '2024-08-19 18:16:38', NULL),
(6, 'AAJ Premium Leather Half Shoes SB-S469', 'aaj-premium-leather-half-shoes-sb-s469', 2, 2, 14, NULL, 'new', NULL, 1212.00, NULL, NULL, 10, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'uploads/addss_image/1724112444_66c3de3c5876e.png', 'active', 0, 0, 0, 0, '2023-05-17 19:51:37', '2024-08-19 18:07:24', '2023-06-24 15:29:33'),
(7, 'Elegance Medicated Leather Half Shoes SB-S472', 'elegance-medicated-leather-half-shoes-sb-s472', 2, 3, 15, 29, 'new', NULL, 2351.00, NULL, NULL, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'uploads/addss_image/1724112380_66c3ddfca1b6c.png', 'active', 0, 0, 0, 0, '2023-05-17 19:52:13', '2024-08-19 18:06:20', '2023-06-24 15:29:27'),
(8, 'Elegance Medicated Leather Half Shoes SB-S473', 'elegance-medicated-leather-half-shoes-sb-s473', 2, 2, 14, NULL, 'new', NULL, 543.00, 10, 488.70, 10, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'uploads/addss_image/1724112228_66c3dd64a8412.png', 'active', 0, 0, 0, 0, '2023-05-17 19:52:45', '2024-08-19 18:03:48', '2023-06-24 15:29:00'),
(9, 'SSB Leather Men\'s Leather Sandal SB-S459', 'ssb-leather-mens-leather-sandal-sb-s459', 2, 2, 17, 31, 'new', NULL, 547.00, 22, 426.66, 12, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'uploads/addss_image/1724112083_66c3dcd388a6c.png', 'active', 0, 0, 0, 0, '2023-05-17 19:53:43', '2024-08-19 18:01:23', '2023-06-24 15:28:55'),
(10, 'SSB Leather Men\'s Leather Sandal SB-S455', 'ssb-leather-mens-leather-sandal-sb-s455', 2, 2, 17, 31, 'new', NULL, 543.00, 15, 461.55, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'uploads/addss_image/1724112026_66c3dc9aa2ad4.png', 'active', 0, 0, 0, 0, '2023-05-17 19:54:12', '2024-08-19 18:00:26', '2023-06-24 15:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `ads_attrs`
--

CREATE TABLE `ads_attrs` (
  `id` int NOT NULL,
  `ad_id` int DEFAULT NULL,
  `attr_details` text COMMENT 'json data like "name":"Extra price"',
  `attr_id` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ads_attrs`
--

INSERT INTO `ads_attrs` (`id`, `ad_id`, `attr_details`, `attr_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 3, '{\"M\":\"5\",\"XL\":\"10\"}', 1, 1, '2023-05-17 19:43:23', '2023-05-17 19:43:23'),
(6, 3, '{\"Black\":\"5\",\"Blue\":null}', 2, 1, '2023-05-17 19:43:23', '2023-05-17 19:43:23'),
(11, 5, '{\"sm\":\"100\"}', 1, 1, '2023-05-17 19:48:15', '2023-05-17 19:48:15'),
(12, 5, '{\"black\":\"50\"}', 2, 1, '2023-05-17 19:48:15', '2023-05-17 19:48:15'),
(25, 10, '{\"XL\":\"10\",\"L\":\"0\"}', 1, 1, '2024-08-19 18:00:31', '2024-08-19 18:00:31'),
(26, 10, '{\"Red\":\"0\",\"Black\":\"0\"}', 2, 1, '2024-08-19 18:00:31', '2024-08-19 18:00:31'),
(27, 8, '{\"XL\":\"5\",\"S\":\"0\",\"L\":\"0\"}', 1, 1, '2024-08-19 18:03:53', '2024-08-19 18:03:53'),
(28, 8, '{\"Yellow\":0,\"Aash\":\"3\"}', 2, 1, '2024-08-19 18:03:53', '2024-08-19 18:03:53'),
(29, 7, '{\"L\":0,\"XL\":0}', 1, 1, '2024-08-19 18:06:20', '2024-08-19 18:06:20'),
(30, 7, '{\"Blue\":0}', 2, 1, '2024-08-19 18:06:20', '2024-08-19 18:06:20'),
(31, 6, '{\"L\":0,\"M\":0,\"S\":0}', 1, 1, '2024-08-19 18:07:24', '2024-08-19 18:07:24'),
(32, 6, '{\"Red\":0}', 2, 1, '2024-08-19 18:07:24', '2024-08-19 18:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `ads_tags`
--

CREATE TABLE `ads_tags` (
  `id` int NOT NULL,
  `ad_id` int DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ad_galleries`
--

CREATE TABLE `ad_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `ad_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_galleries`
--

INSERT INTO `ad_galleries` (`id`, `ad_id`, `image`, `created_at`, `updated_at`) VALUES
(8, 5, 'uploads/adds_multiple/1684334895_6464e92fa86c8.jpg', '2023-05-17 19:48:15', '2023-05-17 19:48:15'),
(9, 5, 'uploads/adds_multiple/1684334895_6464e92fb7bfe.jpg', '2023-05-17 19:48:15', '2023-05-17 19:48:15'),
(10, 5, 'uploads/adds_multiple/1684334895_6464e92fc6dc0.jpg', '2023-05-17 19:48:15', '2023-05-17 19:48:15'),
(11, 4, 'uploads/adds_multiple/1684334953_6464e9693ffd7.jpg', '2023-05-17 19:49:13', '2023-05-17 19:49:13'),
(12, 4, 'uploads/adds_multiple/1684334953_6464e9694e86b.jpg', '2023-05-17 19:49:13', '2023-05-17 19:49:13'),
(13, 4, 'uploads/adds_multiple/1684334953_6464e9695d106.jpg', '2023-05-17 19:49:13', '2023-05-17 19:49:13'),
(14, 4, 'uploads/adds_multiple/1684334953_6464e96976af1.jpg', '2023-05-17 19:49:13', '2023-05-17 19:49:13'),
(39, 10, 'uploads/adds_multiple/1724112031_66c3dc9f329e9.png', '2024-08-19 18:00:31', '2024-08-19 18:00:31'),
(40, 8, 'uploads/adds_multiple/1724112232_66c3dd68e5ee2.png', '2024-08-19 18:03:52', '2024-08-19 18:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Size', 'size', 1, '2023-05-11 10:39:09', '2023-05-11 10:39:09'),
(2, 'Color', 'color', 1, '2023-05-11 10:39:24', '2023-05-11 10:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Puma', 'puma', '2022-10-19 06:07:35', '2022-10-19 06:07:35'),
(2, 'Bata', 'bata', '2022-10-19 06:07:39', '2022-10-19 06:07:39'),
(3, 'Apex', 'apex', '2022-10-19 06:07:55', '2022-10-19 06:07:55'),
(4, 'Adidas', 'adidas', '2022-10-19 06:07:59', '2022-10-19 06:07:59'),
(5, 'Nike', 'nike', '2022-10-19 06:08:05', '2022-10-19 06:08:05'),
(6, 'La Coste', 'la-coste', '2022-10-19 06:08:11', '2022-10-19 06:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `department_id`, `name`, `image`, `slug`, `icon`, `order`, `status`, `created_at`, `updated_at`) VALUES
(11, 3, 'Athletic', 'uploads/category/gL195aulw6RgVBUY8ZKZgCh3Y3NTIavzkdfu3VYx.jpg', 'athletic', 'fab fa-bitcoin', 0, 1, '2023-05-08 05:58:15', '2023-05-17 19:03:03'),
(12, 2, 'Athletic', 'uploads/category/GyshhZ8nIfAXGkkjuE7roURK5V89dTd8z0NkVpnX.jpg', 'athletic', 'fas fa-battery-half', 0, 1, '2023-05-08 05:58:36', '2023-05-17 19:03:15'),
(13, 3, 'Casual', 'uploads/category/ngafmaqcOhK2m8G6hWpxDSOIJY6wLAfxobkfEAic.jpg', 'casual', 'fas fa-battery-half', 0, 1, '2023-05-08 05:58:59', '2023-05-17 19:03:23'),
(14, 2, 'Casual', 'uploads/category/58k9oqhktrbcRGlr0ZT8IkP3NW1wyHaZMxPzxsRk.jpg', 'casual', 'fas fa-battery-three-quarters', 0, 1, '2023-05-08 05:59:10', '2023-05-17 19:03:32'),
(15, 3, 'Athletic', 'uploads/category/WM65KsLCvkiqocm061GnHNUhnjPxe7Bs58GGWod9.jpg', 'athletic_15', 'fas fa-battery-half', 0, 1, '2023-05-16 00:36:12', '2023-05-17 19:03:43'),
(17, 2, 'Baby', 'uploads/category/WzXLMuTKCSnKyIjJEkXEPWqNLTKG37tSuHi7t4mZ.jpg', 'baby', 'fas fa-battery-empty', 0, 1, '2023-05-16 00:47:52', '2023-05-17 19:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `category_custom_field`
--

CREATE TABLE `category_custom_field` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `custom_field_id` bigint UNSIGNED NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_categories`
--

INSERT INTO `child_categories` (`id`, `sub_category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'LONG SLEEVE TSHIRTS', 'long-sleeve-tshirts', 1, '2022-10-19 06:57:29', '2023-03-21 11:59:49'),
(3, 2, 'SHIRTS (BUTTON UPS)', 'shirts-button-ups', 1, '2022-10-19 06:58:11', '2022-10-19 06:58:11'),
(4, 3, 'CASUAL PANTS', 'casual-pants', 1, '2022-10-19 08:00:41', '2022-10-19 08:00:41'),
(5, 3, 'CROPPED PANTS', 'cropped-pants', 1, '2022-10-19 08:00:53', '2022-10-19 08:00:53'),
(6, 3, 'DENIM', 'denim', 1, '2022-10-19 08:01:06', '2022-10-19 08:01:06'),
(8, 4, 'BOMBERS', 'bombers', 1, '2022-10-19 08:01:27', '2022-10-19 08:01:27'),
(9, 4, 'CLOAK CAPES', 'cloak-capes', 1, '2022-10-19 08:01:42', '2022-10-19 08:01:42'),
(10, 4, 'DENIM JACKETS', 'denim-jackets', 1, '2022-10-19 08:01:57', '2022-10-19 08:01:57'),
(11, 4, 'HEAVY COATS', 'heavy-coats', 1, '2022-10-19 08:02:05', '2022-10-19 08:02:05'),
(12, 5, 'BOOTS', 'boots', 1, '2022-10-19 08:02:18', '2022-10-19 08:02:18'),
(13, 5, 'CASUAL LEATHERS', 'casual-leathers', 1, '2022-10-19 08:02:26', '2022-10-19 08:02:26'),
(14, 5, 'FORMAL SHOES', 'formal-shoes', 1, '2022-10-19 08:02:38', '2022-10-19 08:02:38'),
(15, 12, 'HI-TOP SNEAKERS', 'hi-top-sneakers', 1, '2022-10-19 08:02:50', '2023-03-06 14:09:08'),
(16, 5, 'LOW-TOP SNEAKERS', 'low-top-sneakers', 1, '2022-10-19 08:03:17', '2023-01-28 14:21:18'),
(17, 5, 'SANDALS', 'sandals', 1, '2022-10-19 08:03:24', '2022-10-19 08:03:24'),
(18, 6, 'BLAZERS', 'blazers', 1, '2022-10-19 08:03:38', '2022-10-19 08:03:38'),
(19, 6, 'FORMAL SHIRTING', 'formal-shirting', 1, '2022-10-19 08:03:56', '2022-10-19 08:03:56'),
(20, 6, 'FORMAL TROUSERS', 'formal-trousers', 1, '2022-10-19 08:04:04', '2022-10-19 08:04:04'),
(21, 6, 'SUITS', 'suits', 1, '2022-10-19 08:04:20', '2022-10-19 08:04:20'),
(22, 6, 'TUXEDOS', 'tuxedos', 1, '2022-10-19 08:04:27', '2022-10-19 08:04:27'),
(23, 6, 'VESTS', 'vests', 1, '2022-10-19 08:04:32', '2022-10-19 08:04:32'),
(24, 7, 'BAGS & LUGGAGE', 'bags-luggage', 1, '2022-10-19 08:05:10', '2022-10-19 08:05:10'),
(25, 7, 'GLASSES', 'glasses', 1, '2022-10-19 08:05:35', '2022-10-19 08:05:35'),
(26, 7, 'HATS', 'hats', 1, '2022-10-19 08:05:56', '2022-10-19 08:05:56'),
(27, 7, 'WALLETS', 'wallets', 1, '2022-10-19 08:06:01', '2022-10-19 08:06:01'),
(28, 7, 'SUNGLASSES', 'sunglasses', 1, '2022-10-19 08:06:19', '2022-10-19 08:06:19'),
(29, 8, 'BLOUSES', 'blouses', 1, '2022-10-19 08:06:54', '2022-10-19 08:06:54'),
(30, 8, 'BODY SUITS', 'body-suits', 1, '2022-10-19 08:07:05', '2022-10-19 08:07:05'),
(31, 8, 'BUTTON UPS', 'button-ups', 1, '2022-10-19 08:07:33', '2022-10-19 08:07:33'),
(32, 8, 'CROP TOPS', 'crop-tops', 1, '2022-10-19 08:07:39', '2022-10-19 08:07:39'),
(33, 11, 'MINI DRESSES', 'mini-dresses', 1, '2022-10-19 08:42:13', '2022-10-19 08:42:13'),
(34, 11, 'MAXI DRESSES', 'maxi-dresses', 1, '2022-10-19 08:42:27', '2022-10-19 08:42:27'),
(35, 11, 'MIDI DRESSES', 'midi-dresses', 1, '2022-10-19 08:42:42', '2022-10-19 08:42:42'),
(36, 11, 'GOWNS', 'gowns', 1, '2022-10-19 08:42:52', '2022-10-19 08:42:52'),
(37, 5, 'HEELS', 'heels', 1, '2022-10-19 08:48:49', '2022-10-19 08:48:49'),
(38, 9, 'JEANS', 'jeans', 1, '2022-10-19 11:24:04', '2022-10-19 11:24:04'),
(39, 9, 'JOGGERS', 'joggers', 1, '2022-10-19 11:24:12', '2022-10-19 11:24:12'),
(40, 9, 'JUMPSUITS', 'jumpsuits', 1, '2022-10-19 11:24:31', '2022-10-19 11:24:31'),
(42, 13, 'BELT BAGS', 'belt-bags', 1, '2022-10-19 11:34:43', '2022-10-19 11:34:43'),
(43, 13, 'MINI BAGS', 'mini-bags', 1, '2022-10-19 11:35:06', '2022-10-19 11:35:06'),
(44, 13, 'BUCKET BAGS', 'bucket-bags', 1, '2022-10-19 11:35:15', '2022-10-19 11:35:15'),
(45, 13, 'HOBO BAGS', 'hobo-bags', 1, '2022-10-19 11:35:29', '2022-10-19 11:35:29'),
(46, 12, 'HEELS', 'heels', 1, '2022-10-20 04:25:36', '2022-10-20 04:25:36'),
(52, 18, 'BAGS & LUGGAGE', 'bags-luggage', 1, '2023-01-28 10:08:32', '2023-01-28 10:08:32'),
(53, 18, 'GLASSES', 'glasses', 1, '2023-01-28 10:08:55', '2023-01-28 10:08:55'),
(54, 18, 'HATS', 'hats', 1, '2023-01-28 10:09:15', '2023-01-28 10:09:15'),
(55, 18, 'WALLETS', 'wallets', 1, '2023-01-28 10:10:06', '2023-01-28 10:10:06'),
(56, 18, 'SUNGLASSES', 'sunglasses', 1, '2023-01-28 10:10:22', '2023-01-28 10:10:22'),
(57, 2, 'SHORT SLEEVE T-SHIRTS', 'short-sleeve-t-shirts', 1, '2023-01-28 14:02:01', '2023-01-28 14:02:01'),
(58, 2, 'SWEATERS & KNITWEAR', 'sweaters-knitwear', 1, '2023-01-28 14:02:43', '2023-01-28 14:02:43'),
(59, 2, 'SWEATSHIRTS & HOODIES', 'sweatshirts-hoodies', 1, '2023-01-28 14:03:06', '2023-01-28 14:03:06'),
(60, 2, 'TANK TOPS & SLEEVELESS', 'tank-tops-sleeveless', 1, '2023-01-28 14:03:36', '2023-01-28 14:03:36'),
(61, 2, 'JERSEYS', 'jerseys', 1, '2023-01-28 14:03:51', '2023-01-28 14:03:51'),
(62, 3, 'LEGGINGS', 'leggings', 1, '2023-01-28 14:16:18', '2023-01-28 14:16:18'),
(63, 3, 'OVERALLS & JUMPSUITS', 'overalls-jumpsuits', 1, '2023-01-28 14:16:43', '2023-01-28 14:16:43'),
(64, 3, 'SHORTS', 'shorts', 1, '2023-01-28 14:16:52', '2023-01-28 14:16:52'),
(65, 3, 'SWEATPANTS & JOGGERS', 'sweatpants-joggers', 1, '2023-01-28 14:17:15', '2023-01-28 14:17:15'),
(66, 3, 'SWIMWEAR', 'swimwear', 1, '2023-01-28 14:17:27', '2023-01-28 14:17:27'),
(67, 4, 'LEATHER JACKETS', 'leather-jackets', 1, '2023-01-28 14:19:48', '2023-01-28 14:19:48'),
(68, 4, 'LIGHT JACKETS', 'light-jackets', 1, '2023-01-28 14:19:59', '2023-01-28 14:19:59'),
(69, 4, 'PARKAS', 'parkas', 1, '2023-01-28 14:20:09', '2023-01-28 14:20:09'),
(70, 4, 'RAINCOATS', 'raincoats', 1, '2023-01-28 14:20:22', '2023-01-28 14:20:22'),
(71, 4, 'VESTS', 'vests', 1, '2023-01-28 14:20:34', '2023-01-28 14:20:34'),
(72, 5, 'HI-TOP SNEAKERS', 'hi-top-sneakers', 1, '2023-01-28 14:22:57', '2023-01-28 14:22:57'),
(73, 5, 'SLIP ONS', 'slip-ons', 1, '2023-01-28 14:24:10', '2023-01-28 14:24:10'),
(74, 7, 'BELTS', 'belts', 1, '2023-01-28 14:25:30', '2023-01-28 14:25:30'),
(75, 7, 'GLOVES & SCARVES', 'gloves-scarves', 1, '2023-01-28 14:28:14', '2023-01-28 14:28:14'),
(76, 7, 'JEWELRY & WATCHES', 'jewelry-watches', 1, '2023-01-28 14:28:54', '2023-01-28 14:28:54'),
(77, 19, 'SHOES', 'shoes', 1, '2023-01-29 10:05:39', '2023-01-29 10:05:39'),
(78, 19, 'SWEATERS & HOODIES', 'sweaters-hoodies', 1, '2023-01-29 10:06:12', '2023-01-29 10:06:12'),
(79, 19, 'DRESSES', 'dresses', 1, '2023-01-29 10:06:21', '2023-01-29 10:06:21'),
(80, 19, 'PANTS & SHORTS', 'pants-shorts', 1, '2023-01-29 10:06:34', '2023-01-29 10:06:34'),
(81, 19, 'ACCESSORIES', 'accessories', 1, '2023-01-29 10:07:22', '2023-01-29 10:07:22'),
(82, 19, 'UNDERWEAR & SOCKS', 'underwear-socks', 1, '2023-01-29 10:07:37', '2023-01-29 10:07:37'),
(83, 19, 'SPORTSWEAR', 'sportswear', 1, '2023-01-29 10:07:47', '2023-01-29 10:07:47'),
(84, 19, 'BABY CLOTHING', 'baby-clothing', 1, '2023-01-29 10:08:02', '2023-01-29 10:08:02'),
(85, 19, 'OUTERWEAR', 'outerwear', 1, '2023-01-29 10:08:13', '2023-01-29 10:08:13'),
(86, 19, 'TOPS & T-SHIRTS', 'tops-t-shirts', 1, '2023-01-29 10:08:32', '2023-01-29 10:08:32'),
(87, 19, 'SKIRTS', 'skirts', 1, '2023-01-29 10:08:41', '2023-01-29 10:08:41'),
(88, 19, 'SWIMWEAR', 'swimwear', 1, '2023-01-29 10:09:26', '2023-01-29 10:09:26'),
(89, 19, 'SLEEPWEAR', 'sleepwear', 1, '2023-01-29 10:09:41', '2023-01-29 10:09:41'),
(90, 20, 'SHOES', 'shoes', 1, '2023-01-29 10:10:08', '2023-01-29 10:10:08'),
(91, 20, 'SWEATERS & HOODIES', 'sweaters-hoodies', 1, '2023-01-29 10:10:18', '2023-01-29 10:10:18'),
(92, 20, 'PANTS & SHORTS', 'pants-shorts', 1, '2023-01-29 10:11:20', '2023-01-29 10:11:20'),
(93, 20, 'ACCESSORIES', 'accessories', 1, '2023-01-29 10:11:34', '2023-01-29 10:11:34'),
(94, 20, 'UNDERWEAR & SOCKS', 'underwear-socks', 1, '2023-01-29 10:11:43', '2023-01-29 10:11:43'),
(95, 20, 'SPORTSWEAR', 'sportswear', 1, '2023-01-29 10:11:51', '2023-01-29 10:11:51'),
(96, 20, 'BABY CLOTHING', 'baby-clothing', 1, '2023-01-29 10:12:26', '2023-01-29 10:12:26'),
(97, 20, 'OUTERWEAR', 'outerwear', 1, '2023-01-29 10:12:36', '2023-01-29 10:12:36'),
(98, 20, 'TOPS & T-SHIRTS', 'tops-t-shirts', 1, '2023-01-29 10:12:56', '2023-01-29 10:12:56'),
(99, 20, 'BAGS & LUGGAGE', 'bags-luggage', 1, '2023-01-29 10:13:16', '2023-01-29 10:13:16'),
(100, 20, 'SWIMWEAR', 'swimwear', 1, '2023-01-29 10:14:09', '2023-01-29 10:14:09'),
(101, 20, 'SLEEPWEAR', 'sleepwear', 1, '2023-01-29 10:14:19', '2023-01-29 10:14:19'),
(102, 21, 'DOLLS', 'dolls', 1, '2023-01-29 10:15:46', '2023-01-29 10:15:46'),
(103, 21, 'EDUCATIONAL TOYS', 'educational-toys', 1, '2023-01-29 10:16:00', '2023-01-29 10:16:00'),
(104, 21, 'MUSICAL TOYS', 'musical-toys', 1, '2023-01-29 10:16:10', '2023-01-29 10:16:10'),
(105, 21, 'WOODEN TOYS', 'wooden-toys', 1, '2023-01-29 10:16:18', '2023-01-29 10:16:18'),
(106, 21, 'KITCHEN TOYS', 'kitchen-toys', 1, '2023-01-29 10:16:27', '2023-01-29 10:16:27'),
(107, 21, 'ACTION FIGURES', 'action-figures', 1, '2023-01-29 10:16:37', '2023-01-29 10:16:37'),
(108, 21, 'ELECTRONIC GAMES', 'electronic-games', 1, '2023-01-29 10:16:50', '2023-01-29 10:16:50'),
(109, 21, 'SOFT TOYS', 'soft-toys', 1, '2023-01-29 10:17:01', '2023-01-29 10:17:01'),
(110, 21, 'CONSTRUCTION TOYS', 'construction-toys', 1, '2023-01-29 10:17:14', '2023-01-29 10:17:14'),
(111, 21, 'OUTDOOR TOYS', 'outdoor-toys', 1, '2023-01-29 10:17:27', '2023-01-29 10:17:27'),
(112, 21, 'SLEEPING TOYS', 'sleeping-toys', 1, '2023-01-29 10:17:38', '2023-01-29 10:17:38'),
(113, 22, 'NURSING & FEEDING', 'nursing-feeding', 1, '2023-01-29 10:18:41', '2023-01-29 10:18:41'),
(114, 22, 'CHILDCARE ACCESSORIES', 'childcare-accessories', 1, '2023-01-29 10:19:05', '2023-01-29 10:19:05'),
(115, 22, 'POTTIES', 'potties', 1, '2023-01-29 10:19:16', '2023-01-29 10:19:16'),
(116, 22, 'SLEEP ACCESSORIES', 'sleep-accessories', 1, '2023-01-29 10:19:31', '2023-01-29 10:19:31'),
(117, 22, 'DIAPERS & SKINCARE', 'diapers-skincare', 1, '2023-01-29 10:19:51', '2023-01-29 10:19:51'),
(118, 22, 'SAFETY', 'safety', 1, '2023-01-29 10:20:43', '2023-01-29 10:20:43'),
(119, 23, 'SPORT STROLLERS', 'sport-strollers', 1, '2023-01-29 10:25:17', '2023-01-29 10:25:17'),
(120, 23, 'STROLLERS FOR TWINS', 'strollers-for-twins', 1, '2023-01-29 10:25:30', '2023-01-29 10:25:30'),
(121, 23, 'UMBRELLA STROLLERS', 'umbrella-strollers', 1, '2023-01-29 10:25:51', '2023-01-29 10:25:51'),
(122, 23, 'UNIVERSAL STROLLERS', 'universal-strollers', 1, '2023-01-29 10:26:05', '2023-01-29 10:26:05'),
(124, 23, 'STROLLER ACCESSORIES', 'stroller-accessories', 1, '2023-01-29 10:28:21', '2023-01-29 10:28:21'),
(125, 23, 'STROLLER PARTS', 'stroller-parts', 1, '2023-01-29 10:29:54', '2023-01-29 10:29:54'),
(126, 24, 'PUSH & PULL TOYS', 'push-pull-toys', 1, '2023-01-29 10:30:47', '2023-01-29 10:30:47'),
(127, 24, 'SCOOTERS', 'scooters', 1, '2023-01-29 10:30:56', '2023-01-29 10:30:56'),
(128, 24, 'BICYCLES', 'bicycles', 1, '2023-01-29 10:31:12', '2023-01-29 10:31:12'),
(129, 24, 'SLEDS, SKIS & SNOWBOARDS', 'sleds-skis-snowboards', 1, '2023-01-29 10:31:33', '2023-01-29 10:31:33'),
(130, 24, 'BABY WALKERS', 'baby-walkers', 1, '2023-01-29 10:31:43', '2023-01-29 10:31:43'),
(131, 24, 'BIKE SEATS & TRAILERS', 'bike-seats-trailers', 1, '2023-01-29 10:32:39', '2023-01-29 10:32:39'),
(132, 24, 'OUTDOOR VEHICLES', 'outdoor-vehicles', 1, '2023-01-29 10:32:53', '2023-01-29 10:32:53'),
(133, 24, 'ROLLER SKATES', 'roller-skates', 1, '2023-01-29 10:33:10', '2023-01-29 10:33:10'),
(134, 27, 'CLOCKS', 'clocks', 1, '2023-01-29 10:35:48', '2023-01-29 10:35:48'),
(135, 27, 'MIRRORS', 'mirrors', 1, '2023-01-29 10:35:54', '2023-01-29 10:35:54'),
(136, 27, 'STORAGE', 'storage', 1, '2023-01-29 10:36:03', '2023-01-29 10:36:03'),
(137, 27, 'CANDLE & CANDLE HOLDERS', 'candle-candle-holders', 1, '2023-01-29 10:36:20', '2023-01-29 10:36:20'),
(138, 27, 'DISPLAY SHELVES', 'display-shelves', 1, '2023-01-29 10:36:31', '2023-01-29 10:36:31'),
(139, 27, 'PICTURE & PHOTO FRAMES', 'picture-photo-frames', 1, '2023-01-29 10:36:42', '2023-01-29 10:36:42'),
(140, 27, 'VASES', 'vases', 1, '2023-01-29 10:36:47', '2023-01-29 10:36:47'),
(141, 28, 'BLANKETS', 'blankets', 1, '2023-01-29 10:36:55', '2023-01-29 10:36:55'),
(142, 28, 'THROW PILLOWS', 'throw-pillows', 1, '2023-01-29 10:37:06', '2023-01-29 10:37:06'),
(143, 28, 'TABLE LINEN', 'table-linen', 1, '2023-01-29 10:37:17', '2023-01-29 10:37:17'),
(144, 28, 'TOWELS', 'towels', 1, '2023-01-29 10:37:24', '2023-01-29 10:37:24'),
(145, 28, 'BEDDING', 'bedding', 1, '2023-01-29 10:37:36', '2023-01-29 10:37:36'),
(146, 28, 'CURTAINS & DRAPES', 'curtains-drapes', 1, '2023-01-29 10:37:49', '2023-01-29 10:37:49'),
(147, 28, 'RUGS & MATS', 'rugs-mats', 1, '2023-01-29 10:37:58', '2023-01-29 10:37:58'),
(148, 28, 'TAPESTRIES & WALL HANGINGS', 'tapestries-wall-hangings', 1, '2023-01-29 10:38:17', '2023-01-29 10:38:17'),
(149, 27, 'DINNERWARE', 'dinnerware', 1, '2023-01-29 10:38:49', '2023-01-29 10:38:49'),
(150, 27, 'DRINKWARE', 'drinkware', 1, '2023-01-29 10:38:58', '2023-01-29 10:38:58'),
(151, 27, 'CUTLERY', 'cutlery', 1, '2023-01-29 10:39:09', '2023-01-29 10:39:09'),
(152, 8, 'HOODIES', 'hoodies', 1, '2023-01-29 10:41:22', '2023-01-29 10:41:22'),
(154, 8, 'POLOS', 'polos', 1, '2023-01-29 10:41:58', '2023-01-29 10:41:58'),
(155, 8, 'SHORT SLEEVE T-SHIRTS', 'short-sleeve-t-shirts', 1, '2023-01-29 10:42:20', '2023-01-29 10:42:20'),
(156, 8, 'SWEATERS', 'sweaters', 1, '2023-01-29 10:42:48', '2023-01-29 10:42:48'),
(157, 8, 'SWEATSHIRTS', 'sweatshirts', 1, '2023-01-29 10:43:07', '2023-01-29 10:43:07'),
(158, 8, 'TANK TOPS', 'tank-tops', 1, '2023-01-29 10:43:30', '2023-01-29 10:43:30'),
(159, 9, 'LEGGINGS', 'leggings', 1, '2023-01-29 10:44:07', '2023-01-29 10:44:07'),
(160, 9, 'MAXI SKIRTS', 'maxi-skirts', 1, '2023-01-29 10:44:22', '2023-01-29 10:44:22'),
(161, 9, 'MIDI SKIRTS', 'midi-skirts', 1, '2023-01-29 10:44:32', '2023-01-29 10:44:32'),
(162, 9, 'MINI SKIRTS', 'mini-skirts', 1, '2023-01-29 10:44:50', '2023-01-29 10:44:50'),
(163, 9, 'PANTS', 'pants', 1, '2023-01-29 10:45:09', '2023-01-29 10:45:09'),
(164, 9, 'SHORTS', 'shorts', 1, '2023-01-29 10:45:33', '2023-01-29 10:45:33'),
(165, 9, 'SWEATPANTS', 'sweatpants', 1, '2023-01-29 10:46:23', '2023-01-29 10:46:23'),
(166, 10, 'BLAZERS', 'blazers', 1, '2023-01-29 14:15:49', '2023-01-29 14:15:49'),
(167, 10, 'BOMBERS', 'bombers', 1, '2023-01-29 14:15:59', '2023-01-29 14:15:59'),
(168, 10, 'COATS', 'coats', 1, '2023-01-29 14:16:09', '2023-01-29 14:16:09'),
(169, 10, 'DENIM JACKETS', 'denim-jackets', 1, '2023-01-29 14:16:44', '2023-01-29 14:16:44'),
(170, 10, 'DOWN JACKETS', 'down-jackets', 1, '2023-01-29 14:16:55', '2023-01-29 14:16:55'),
(171, 10, 'JACKETS', 'jackets', 1, '2023-01-29 14:17:54', '2023-01-29 14:17:54'),
(172, 10, 'FUR & FAUX FUR', 'fur-faux-fur', 1, '2023-01-29 14:18:39', '2023-01-29 14:18:39'),
(173, 10, 'LEATHER JACKETS', 'leather-jackets', 1, '2023-01-29 14:19:07', '2023-01-29 14:19:07'),
(174, 10, 'RAIN JACKETS', 'rain-jackets', 1, '2023-01-29 14:19:22', '2023-01-29 14:19:22'),
(175, 10, 'VESTS', 'vests', 1, '2023-01-29 14:19:34', '2023-01-29 14:19:34'),
(176, 11, 'CREATIVE DRESSES', 'creative-dresses', 1, '2023-01-29 14:20:40', '2023-01-29 14:20:40'),
(177, 12, 'BOOTS', 'boots', 1, '2023-01-29 14:21:04', '2023-01-29 14:21:04'),
(178, 12, 'PLATFORMS', 'platforms', 1, '2023-01-29 14:21:31', '2023-01-29 14:21:31'),
(179, 12, 'MULES', 'mules', 1, '2023-01-29 14:22:14', '2023-01-29 14:22:14'),
(180, 12, 'FLATS', 'flats', 1, '2023-01-29 14:22:24', '2023-01-29 14:22:24'),
(182, 12, 'LOW-TOP SNEAKERS', 'low-top-sneakers', 1, '2023-01-29 14:22:49', '2023-01-29 14:22:49'),
(183, 12, 'SANDALS', 'sandals', 1, '2023-01-29 14:23:05', '2023-01-29 14:23:05'),
(184, 12, 'SLIP ONS', 'slip-ons', 1, '2023-01-29 14:23:20', '2023-01-29 14:23:20'),
(185, 13, 'BACKPACKS', 'backpacks', 1, '2023-01-29 14:24:29', '2023-01-29 14:24:29'),
(187, 13, 'CLUTCHES', 'clutches', 1, '2023-01-29 14:24:57', '2023-01-29 14:24:57'),
(188, 13, 'SHOULDER BAGS', 'shoulder-bags', 1, '2023-01-29 14:25:29', '2023-01-29 14:25:29'),
(190, 13, 'OTHER', 'other', 1, '2023-01-29 14:26:18', '2023-01-29 14:26:18'),
(191, 14, 'BODY JEWELRY', 'body-jewelry', 1, '2023-01-29 14:27:26', '2023-01-29 14:27:26'),
(192, 14, 'BRACELETS', 'bracelets', 1, '2023-01-29 14:27:40', '2023-01-29 14:27:40'),
(193, 14, 'BROOCHES', 'brooches', 1, '2023-01-29 14:27:59', '2023-01-29 14:27:59'),
(194, 14, 'CHARMS', 'charms', 1, '2023-01-29 14:28:59', '2023-01-29 14:28:59'),
(195, 14, 'CUFFLINKS', 'cufflinks', 1, '2023-01-29 14:29:11', '2023-01-29 14:29:11'),
(196, 14, 'EARRINGS', 'earrings', 1, '2023-01-29 14:29:26', '2023-01-29 14:29:26'),
(197, 14, 'NECKLACES', 'necklaces', 1, '2023-01-29 14:29:41', '2023-01-29 14:29:41'),
(198, 14, 'RINGS', 'rings', 1, '2023-01-29 14:29:52', '2023-01-29 14:29:52'),
(199, 18, 'BELTS', 'belts', 1, '2023-01-29 14:30:17', '2023-01-29 14:30:17'),
(200, 18, 'HAIR ACCESSORIES', 'hair-accessories', 1, '2023-01-29 14:31:00', '2023-01-29 14:31:00'),
(204, 18, 'MISCELLANEOUS', 'miscellaneous', 1, '2023-01-29 14:34:04', '2023-01-29 14:34:04'),
(205, 18, 'SCARVES', 'scarves', 1, '2023-01-29 14:34:18', '2023-01-29 14:34:18'),
(206, 18, 'SOCKS & INTIMATES', 'socks-intimates', 1, '2023-01-29 14:34:37', '2023-01-29 14:34:37'),
(207, 18, 'WATCHES', 'watches', 1, '2023-01-29 14:35:33', '2023-01-29 14:35:33'),
(208, 27, 'WHEEL & CAR CHAIRS', 'wheel-car-chairs', 1, '2023-04-18 09:35:45', '2023-04-18 09:35:45'),
(209, 2, 'BOMBER JACKETS', 'bomber-jackets', 1, '2023-04-18 09:39:24', '2023-04-18 09:39:24'),
(210, 7, 'DENIM JACKETS', 'denim-jackets', 1, '2023-04-18 09:40:56', '2023-04-18 09:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint UNSIGNED NOT NULL,
  `home_main_banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_counter_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_mobile_app_banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsletter_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_ads` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_earning` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `terms_body_lt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_video_thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_body_lt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `privacy_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `privacy_body_lt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `get_membership_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `get_membership_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pricing_plan_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manage_ads_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chat_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_user_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_deletion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data_deletion_lt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dashboard_overview_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_post_ads_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_my_ads_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_plan_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_account_setting_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_favorite_ads_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_messenger_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posting_rules_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posting_rules_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rules_body_lt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blog_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ads_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coming_soon_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coming_soon_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e404_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e404_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e404_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e500_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e500_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e500_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e503_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e503_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e503_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `home_main_banner`, `home_counter_background`, `home_mobile_app_banner`, `home_title`, `home_description`, `download_app`, `newsletter_content`, `membership_content`, `create_account`, `post_ads`, `start_earning`, `terms_background`, `terms_body`, `terms_body_lt`, `about_background`, `about_video_thumb`, `about_body`, `about_body_lt`, `privacy_background`, `privacy_body`, `privacy_body_lt`, `contact_background`, `contact_number`, `contact_email`, `contact_address`, `get_membership_background`, `get_membership_image`, `pricing_plan_background`, `faq_background`, `faq_content`, `manage_ads_content`, `chat_content`, `verified_user_content`, `data_deletion`, `data_deletion_lt`, `dashboard_overview_background`, `dashboard_post_ads_background`, `dashboard_my_ads_background`, `dashboard_plan_background`, `dashboard_account_setting_background`, `dashboard_favorite_ads_background`, `dashboard_messenger_background`, `posting_rules_background`, `posting_rules_body`, `rules_body_lt`, `blog_background`, `ads_background`, `coming_soon_title`, `coming_soon_subtitle`, `maintenance_title`, `maintenance_subtitle`, `e404_title`, `e404_subtitle`, `e404_image`, `e500_title`, `e500_subtitle`, `e500_image`, `e503_title`, `e503_subtitle`, `e503_image`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'Buy, Sell And Find Just About Anythink.', 'Buy And Sell Everything From Used Cars To Mobile Phones And Computers, Or Search For Property And More All Over The World!', 'Sed Luctus Nibh At Consectetur Tempor. Proin Et Ipsum Tincidunt, Maximus Turpis Id, Mollis Lacus. Maecenas Nec Risus A Urna Sollicitudin Aliquet. Maecenas Pretium Tristique Sapien', 'Vestibulum Consectetur Placerat Tellus. Sed Faucibus Fermentum Purus, At Facilisis.', 'Vestibulum Consectetur Placerat Tellus. Sed Faucibus Fermentum Purus, At Facilisis Neque Auctor.', 'Vestibulum Ante Ipsum Primis In Faucibus Orci Luctus Et Ultrices Posuere Cubilia Curae. Donec Non Lorem Erat. Sed Vitae Vene.', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Mauris Eu Aliquet Odio. Nulla Pretium Congue Eros, Nec Rhoncus Mi.', 'Vestibulum Quis Consectetur Est. Fusce Hendrerit Neque At Facilisis Facilisis. Praesent A Pretium Elit. Nulla Aliquam Puru.', NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', 'uploads/banners/YyaUjgEMTtQhwfVf1571GHZVwYoEoqUsAxavMmW7.png', 'https://youtu.be/s7wmiS2mSXY', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, '+88 01765454411', 'info@mhzone.com', 'USA', NULL, NULL, NULL, NULL, 'Praesent Finibus Dictum Nisl Sit Amet Vulputate. Fusce A Metus Eu Velit Posuere Semper A Bibendum Ante. Donec Eu Tellus Dapibus, Semper Orci Eget, Commodo Lacu Praesent Ullamcorper.', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Etiam Commodo Vel Ligula.', 'Class Aptent Taciti Sociosqu Ad Litora Torquent Per Conubia Nostra, Per Inceptos Himenaeos.', 'Class Aptent Taciti Sociosqu Ad Litora Torquent Per Conubia Nostra, Per Inceptos Himenaeos.', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Opps! Page Not Found!', 'We didn\'t find the page you are looking. Please back to home page.', 'frontend/images/bg/error.png', 'Opps! Page Not Found!', 'We didn\'t find the page you are looking. Please back to home page.', 'frontend/default_images/error-banner.png', 'Opps! Page Not Found!', 'We didn\'t find the page you are looking. Please back to home page.', 'frontend/default_images/error-banner.png', '2022-07-25 05:09:47', '2023-05-17 19:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Red', 1, '2023-02-09 13:28:17', '2023-02-09 13:28:17'),
(7, 'Orange', 1, '2023-02-09 13:28:23', '2023-02-09 13:28:23'),
(8, 'Yellow', 1, '2023-02-09 13:28:30', '2023-02-09 13:28:30'),
(9, 'Green', 1, '2023-02-09 13:28:35', '2023-02-09 13:28:35'),
(10, 'Blue', 1, '2023-02-09 13:28:41', '2023-02-09 13:28:41'),
(11, 'Purple', 1, '2023-02-09 13:28:47', '2023-02-09 13:28:47'),
(12, 'Pink', 1, '2023-02-09 13:28:53', '2023-02-09 13:28:53'),
(13, 'Brown', 1, '2023-02-09 13:28:59', '2023-02-09 13:28:59'),
(14, 'Black', 1, '2023-02-09 13:29:06', '2023-02-09 13:29:06'),
(15, 'White', 1, '2023-02-09 13:29:12', '2023-02-09 13:29:12'),
(16, 'Gray', 1, '2023-02-09 13:29:19', '2023-02-09 13:29:19'),
(17, 'Maroon', 1, '2023-02-09 13:29:25', '2023-02-09 13:29:25'),
(18, 'Olive', 1, '2023-02-09 13:29:42', '2023-02-09 13:29:42'),
(19, 'Lime', 1, '2023-02-09 13:29:48', '2023-02-09 13:29:48'),
(20, 'Aqua', 1, '2023-02-09 13:29:54', '2023-02-09 13:29:54'),
(21, 'Teal', 1, '2023-02-09 13:30:00', '2023-02-09 13:30:00'),
(22, 'Navy', 1, '2023-02-09 13:30:06', '2023-02-09 13:30:06'),
(23, 'Indigo', 1, '2023-02-09 13:30:14', '2023-02-09 13:30:14'),
(24, 'Lavender', 1, '2023-02-09 13:30:20', '2023-02-09 13:30:20'),
(25, 'Violet', 1, '2023-02-09 13:30:26', '2023-02-09 13:30:26'),
(26, 'Bronze', 1, '2023-02-09 13:30:31', '2023-04-28 12:38:07'),
(27, 'Gold', 1, '2023-02-09 13:30:37', '2023-02-09 13:30:37'),
(28, 'Silver', 1, '2023-02-09 13:30:42', '2023-02-09 13:30:42'),
(29, 'Rust', 1, '2023-02-09 13:30:49', '2023-02-09 13:30:49'),
(30, 'Burgundy', 1, '2023-02-09 13:31:05', '2023-02-09 13:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_id` int NOT NULL,
  `listing_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `reason_id`, `listing_url`, `screenshot`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Carl E', 'pat@aneesho.com', '4', 0, '--------', '', 'Do you need help with graphic design - brochures, banners, flyers, advertisements, social media posts, logos etc? \r\n\r\nWe charge a low fixed monthly fee. Let me know if you\'re interested and would like to see our portfolio.', '2023-02-21 06:15:15', '2023-02-21 06:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `contact_helps`
--

CREATE TABLE `contact_helps` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_helps`
--

INSERT INTO `contact_helps` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Something I sold', '2022-11-12 07:14:33', '2022-11-12 07:14:33'),
(2, 'Something I purchased', '2022-11-12 07:14:33', '2022-11-12 07:14:33'),
(3, 'My account', '2022-11-12 07:14:33', '2022-11-12 07:14:33'),
(4, 'Something else', '2022-11-12 07:14:33', '2022-11-12 07:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint UNSIGNED NOT NULL,
  `allow_cookies` tinyint(1) NOT NULL DEFAULT '1',
  `cookie_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gdpr_cookie',
  `cookie_expiration` tinyint NOT NULL DEFAULT '30',
  `force_consent` tinyint(1) NOT NULL DEFAULT '0',
  `darkmode` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve_button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `decline_button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `allow_cookies`, `cookie_name`, `cookie_expiration`, `force_consent`, `darkmode`, `language`, `title`, `description`, `approve_button_text`, `decline_button_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'gdpr_cookie', 30, 0, 0, 'en', 'We use cookies!', 'Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. <button type=\"button\" data-cc=\"c-settings\" class=\"cc-link\">Let me choose</button>', 'Allow all Cookies', 'Reject all Cookies', '2022-07-25 05:09:47', '2022-07-25 05:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `coupon_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = percent; 1= amount',
  `discount` int DEFAULT NULL,
  `valid_till` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=>inactive,1=>active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_currencies` int DEFAULT '0' COMMENT '1=Default currencies; 0=Absence currencies, ',
  `symbol_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'left',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `default_currencies`, `symbol_position`, `created_at`, `updated_at`) VALUES
(1, 'European Union Currency', 'EUR', '€', 1, 'left', '2022-07-25 05:09:47', '2023-03-23 13:42:21'),
(2, 'Dollar', 'USD', '$', 0, 'left', '2023-02-01 05:02:40', '2023-03-23 13:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint UNSIGNED NOT NULL,
  `custom_field_group_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','textarea','select','radio','file','url','number','date','checkbox','checkbox_multiple') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `filterable` tinyint(1) NOT NULL DEFAULT '0',
  `listable` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-cube',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_groups`
--

CREATE TABLE `custom_field_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE `custom_field_values` (
  `id` bigint UNSIGNED NOT NULL,
  `custom_field_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `database_backups`
--

CREATE TABLE `database_backups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Men', 'men', 1, '2023-05-08 05:36:12', '2023-05-08 05:36:12'),
(3, 'Women', 'women', 1, '2023-05-08 05:36:26', '2023-05-08 05:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'ronymia.tech@gmail.com', '2022-12-27 10:16:03', '2022-12-27 10:16:03'),
(2, 'user@gmail.com', '2022-12-27 10:16:11', '2022-12-27 10:16:11'),
(3, 'rony@gmail.com', '2022-12-27 11:49:52', '2022-12-27 11:49:52'),
(4, 'admin@gmail.com', '2022-12-28 06:29:07', '2022-12-28 06:29:07'),
(7, 'testbot123@gmail.com', '2023-03-10 08:32:38', '2023-03-10 08:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `faq_category_id` bigint UNSIGNED NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_category_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'How much does it cost to place an ad?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:23:53', '2022-10-19 09:29:00'),
(2, 3, 'How to protect my account?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:24:41', '2022-10-19 09:29:58'),
(3, 2, 'How owner will get his payment?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:25:28', '2022-10-19 09:29:44'),
(4, 1, 'How to buy some product?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:30:55', '2022-10-19 09:30:55'),
(5, 1, 'How to get my product?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:31:20', '2022-10-19 09:31:20'),
(6, 1, 'What if I don\'t receive a product?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:31:57', '2022-10-19 09:31:57'),
(7, 2, 'What if my product is stock-out?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:32:31', '2022-10-19 09:32:31'),
(8, 2, 'How to increase my product price?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:32:53', '2022-10-19 09:32:53'),
(9, 2, 'How to list my ad as a featured one?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:33:16', '2022-10-19 09:33:16'),
(11, 3, 'Where to complain against frauds?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:34:03', '2022-10-19 09:34:03'),
(12, 3, 'How will you handle frauds?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:34:16', '2022-10-19 09:34:16'),
(13, 4, 'Is there any membership procedure?', 'It\'s completely free.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2022-10-19 09:34:35', '2022-10-19 09:34:35'),
(14, 4, 'Zero-Tolerance Fraud Policy', 'We take fraud very seriously. In order to keep the community safe for all 2LIFE users, the 2LIFE team constantly monitors the marketplace for fraudulent items and dishonest buyers/sellers. Our Zero-Tolerance Policy means that anyone posting counterfeit goods, posting items they do not own, or engaging in any other duplicitous behavior will be immediately banned from 2LIFE platform.', '2023-04-14 09:17:56', '2023-04-14 09:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `slug`, `icon`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Buying', 'buying', 'fab fa-autoprefixer', 0, '2022-10-19 09:22:45', '2022-10-19 09:22:45'),
(2, 'Selling', 'selling', 'fas fa-award', 0, '2022-10-19 09:22:55', '2022-10-19 09:22:55'),
(3, '2LIFE Protection', '2life-protection', 'fas fa-bug', 0, '2022-10-19 09:23:16', '2023-02-07 10:36:20'),
(4, '2LIFE 101', '2life-101', 'fab fa-autoprefixer', 0, '2022-10-19 09:23:28', '2023-02-07 10:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `help_reasons`
--

CREATE TABLE `help_reasons` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `contact_helps_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `help_reasons`
--

INSERT INTO `help_reasons` (`id`, `title`, `contact_helps_id`, `created_at`, `updated_at`) VALUES
(1, 'I’d like to receive my funds', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(2, 'My shipment is still in transit', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(3, 'My shipment is still in transit', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(4, 'I’d like to refund the buyer', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(5, 'The buyer has opened a claim', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(6, 'I refunded the buyer but haven’t received a fee refund', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(7, 'I need help getting/using my Grailed Label', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(8, 'Problem with tracking or delivery', 1, '2022-10-15 05:11:32', '2022-10-15 05:11:32'),
(9, 'My shipment is still in transit', 1, '2022-10-15 11:11:32', '2022-10-15 11:11:32'),
(10, 'I’d like to refund the buyer', 1, '2022-10-15 11:11:32', '2022-10-15 11:11:32'),
(11, 'The buyer has opened a claim', 1, '2022-10-15 11:11:32', '2022-10-15 11:11:32'),
(12, 'I refunded the buyer but haven’t received a fee refund', 1, '2022-10-15 11:11:32', '2022-10-15 11:11:32'),
(13, 'I need help getting/using my Grailed Label', 1, '2022-10-15 11:11:32', '2022-10-15 11:11:32'),
(14, 'Problem with tracking or delivery', 1, '2022-10-15 11:11:32', '2022-10-15 11:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `item_purchases`
--

CREATE TABLE `item_purchases` (
  `id` int NOT NULL,
  `ad_id` int NOT NULL,
  `user_id` int NOT NULL,
  `unit_price` float(14,2) NOT NULL DEFAULT '0.00',
  `units` int DEFAULT '0',
  `total_price` float(14,2) NOT NULL,
  `total_dicount` float(14,2) DEFAULT '0.00',
  `grand_total` float(14,2) NOT NULL DEFAULT '0.00',
  `status` int NOT NULL DEFAULT '0' COMMENT '0=ordered but due, \r\n1= ordered and paid \r\n2= seller delivered \r\n3= buyer got the item \r\n4= buyer got the item and not accepted \r\n5 = buyer got the item and accepted ',
  `shiping_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `admin_commission_percent` float(14,2) NOT NULL DEFAULT '0.00',
  `admin_commission` float(14,2) NOT NULL DEFAULT '0.00',
  `seller_amount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `item_purchases`
--
DELIMITER $$
CREATE TRIGGER `after_item_purchases_insert` AFTER INSERT ON `item_purchases` FOR EACH ROW begin

	declare var_total_seller_amount float default 0;
 	select sum(seller_amount) into var_total_seller_amount from item_purchases where user_id = new.user_id;

 	update users set total_seller_amount = var_total_seller_amount where id = new.user_id;



end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_item_purchases_insert` BEFORE INSERT ON `item_purchases` FOR EACH ROW begin
 set new.seller_amount = new.grand_total-new.admin_commission;


end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'flag-icon-gb', 'ltr', '2022-07-25 05:09:47', '2022-07-25 05:09:47'),
(2, 'Latvian', 'lv', 'flag-icon-lv', 'ltr', '2023-01-01 06:20:34', '2023-01-01 06:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `messengers`
--

CREATE TABLE `messengers` (
  `id` bigint UNSIGNED NOT NULL,
  `from_id` bigint UNSIGNED NOT NULL,
  `to_id` bigint UNSIGNED NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_07_14_154223_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_12_184107_create_permission_tables', 1),
(5, '2020_12_20_161857_create_brands_table', 1),
(6, '2020_12_23_122556_create_contacts_table', 1),
(7, '2021_02_17_110211_create_testimonials_table', 1),
(8, '2021_02_18_112239_create_admins_table', 1),
(9, '2021_08_22_051131_create_categories_table', 1),
(10, '2021_08_22_051134_create_sub_categories_table', 1),
(11, '2021_08_22_051135_create_ads_table', 1),
(12, '2021_08_22_051198_create_post_categories_table', 1),
(13, '2021_08_22_051199_create_posts_table', 1),
(14, '2021_08_23_115402_create_settings_table', 1),
(15, '2021_08_25_061331_create_languages_table', 1),
(16, '2021_09_04_105120_create_blog_comments_table', 1),
(17, '2021_09_05_120235_create_ad_features_table', 1),
(18, '2021_09_05_120248_create_ad_galleries_table', 1),
(19, '2021_09_19_141812_create_plans_table', 1),
(20, '2021_11_13_114825_create_messengers_table', 1),
(21, '2021_11_15_112417_create_user_plans_table', 1),
(22, '2021_11_15_112949_create_transactions_table', 1),
(23, '2021_12_14_142236_create_emails_table', 1),
(24, '2021_12_15_161624_create_module_settings_table', 1),
(25, '2021_12_19_101413_create_cms_table', 1),
(26, '2021_12_19_152529_create_faq_categories_table', 1),
(27, '2021_12_21_105713_create_faqs_table', 1),
(28, '2022_01_25_131111_add_fields_to_settings_table', 1),
(29, '2022_01_26_091457_add_social_login_fields_to_users_table', 1),
(30, '2022_02_16_152704_add_loader_fields_to_settings_table', 1),
(31, '2022_03_05_125615_create_currencies_table', 1),
(32, '2022_03_08_110749_add_website_configuration_to_settings_table', 1),
(33, '2022_03_27_175435_create_orders_table', 1),
(34, '2022_03_28_093629_add_socialite_column_to_users_table', 1),
(35, '2022_03_29_100616_create_timezones_table', 1),
(36, '2022_03_29_121851_create_admin_searches_table', 1),
(37, '2022_03_30_082959_create_cookies_table', 1),
(38, '2022_03_30_114924_create_seos_table', 1),
(39, '2022_03_30_121200_create_database_backups_table', 1),
(40, '2022_04_25_132657_create_setup_guides_table', 1),
(41, '2022_04_28_134721_create_mobile_app_configs_table', 1),
(42, '2022_04_28_142433_create_mobile_app_sliders_table', 1),
(43, '2022_06_06_041744_add_field_to_users_table', 1),
(44, '2022_06_06_052533_create_notifications_table', 1),
(45, '2022_06_06_092421_create_themes_table', 1),
(46, '2022_06_08_053638_create_custom_field_groups_table', 1),
(47, '2022_06_08_060821_create_custom_fields_table', 1),
(48, '2022_06_08_061216_create_custom_field_values_table', 1),
(49, '2022_06_08_061928_create_category_custom_field_table', 1),
(50, '2022_06_08_091126_create_product_custom_fields_table', 1),
(51, '2022_06_14_051918_add_fields_to_user_plans_table', 1),
(52, '2022_06_14_095728_add_fields_to_plans_table', 1),
(53, '2022_06_18_031525_add_full_address_to_ads_table', 1),
(54, '2022_06_27_050337_add_map_to_settings_table', 1),
(55, '2022_07_03_030110_add_whatsapp_field_to_ads_table', 1),
(56, '2022_07_04_042533_create_jobs_table', 1),
(57, '2022_07_05_081552_create_reports_table', 1),
(58, '2022_07_05_112407_create_social_media_table', 1),
(59, '2022_07_14_151623_create_wishlists_table', 1),
(60, '2022_07_14_155901_create_reviews_table', 1),
(61, '2022_07_24_110337_create_user_device_token_tbale', 1),
(62, '2022_07_25_024244_add_push_notification_settings_table', 1),
(63, '2022_09_17_120551_childcategory', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_app_configs`
--

CREATE TABLE `mobile_app_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `android_download_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_download_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_and_condition_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_app_configs`
--

INSERT INTO `mobile_app_configs` (`id`, `android_download_url`, `ios_download_url`, `privacy_url`, `support_url`, `terms_and_condition_url`, `created_at`, `updated_at`) VALUES
(1, 'https://play.google.com/store/apps/details?id=com.app.appname', 'https://apps.apple.com/us/app/app-name/id1440990079', 'https://www.appname.com/privacy-policy', 'https://www.appname.com/support', 'https://www.appname.com/terms-and-conditions', '2022-07-25 05:09:47', '2022-07-25 05:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_app_sliders`
--

CREATE TABLE `mobile_app_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `background` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `module_settings`
--

CREATE TABLE `module_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `blog` tinyint(1) NOT NULL DEFAULT '1',
  `newsletter` tinyint(1) NOT NULL DEFAULT '1',
  `language` tinyint(1) NOT NULL DEFAULT '1',
  `contact` tinyint(1) NOT NULL DEFAULT '1',
  `faq` tinyint(1) NOT NULL DEFAULT '1',
  `testimonial` tinyint(1) NOT NULL DEFAULT '1',
  `price_plan` tinyint(1) NOT NULL DEFAULT '1',
  `appearance` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_settings`
--

INSERT INTO `module_settings` (`id`, `blog`, `newsletter`, `language`, `contact`, `faq`, `testimonial`, `price_plan`, `appearance`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('08db08b1-3485-4afe-9d3b-80314bea9e8b', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 2, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/elegance-medicated-leather-half-shoes-sb-s472\"}', NULL, '2023-05-17 20:29:29', '2023-05-17 20:29:29'),
('1d7c4c1d-d6d3-44d3-b52f-1c48be96a72b', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 2, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/ssb-leather-mens-leather-sandal-sb-s459\"}', NULL, '2023-05-17 20:28:56', '2023-05-17 20:28:56'),
('23d9c890-f92a-43ac-bc71-cf37cb93434f', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/ssb-leather-mens-leather-sandal-sb-s459\"}', NULL, '2023-05-17 20:28:56', '2023-05-17 20:28:56'),
('4e9f57d5-0d37-45af-bd99-b68fbb34ce7a', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2024-07-24 00:59:59', '2024-07-24 00:59:59'),
('6f9a7c26-912c-436f-b9b8-b80f01df5873', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/elegance-medicated-leather-half-shoes-sb-s472\"}', NULL, '2023-05-17 20:29:29', '2023-05-17 20:29:29'),
('7514da8b-ede6-48e7-90e8-5f782ea965ca', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 2, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/ssb-leather-mens-leather-sandal-sb-s455\"}', NULL, '2023-05-17 20:28:49', '2023-05-17 20:28:49'),
('814b0482-e9ff-4d1a-804c-25b54bdb20cc', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/ssb-leather-mens-leather-sandal-sb-s455\"}', NULL, '2023-05-17 20:28:49', '2023-05-17 20:28:49'),
('8c084dee-7321-4f99-831e-4ad2b61facbd', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2024-08-09 10:33:39', '2024-08-09 10:33:39'),
('8ce41a81-9636-4635-8507-e0401b4d45bb', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/elegance-medicated-leather-half-shoes-sb-s473\"}', NULL, '2023-05-17 20:29:01', '2023-05-17 20:29:01'),
('913f1113-f002-4bef-8b34-d1366f16502f', 'App\\Notifications\\AdCreateNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re just created a ad\",\"type\":\"adcreate\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/aaj-premium-leather-half-shoes-sb-s469\"}', NULL, '2023-05-17 20:29:34', '2023-05-17 20:29:34'),
('9ce7973a-412d-4159-b4ad-828808ace235', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2024-07-24 01:07:37', '2024-07-24 01:07:37'),
('ab6ca136-6d44-4a7b-aaa3-bc581618a11f', 'App\\Notifications\\LogoutNotification', 'App\\Models\\User', 1, '{\"msg\":\"You\'re loggedout successfully\",\"type\":\"loggedout\"}', NULL, '2023-05-17 19:36:52', '2023-05-17 19:36:52'),
('c02386cb-ccb5-4b01-b898-8a855ca0b12a', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 10, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2024-07-22 22:14:48', '2024-07-22 22:14:48'),
('e8e0afcd-a43a-4843-96fc-2df90457da80', 'App\\Notifications\\LoginNotification', 'App\\Models\\User', 2, '{\"msg\":\"You\'re loggedin successfully\",\"type\":\"loggedin\"}', NULL, '2024-08-19 17:52:35', '2024-08-19 17:52:35'),
('fc35c80b-bc3a-43ff-8288-35b015f365f7', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 2, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/elegance-medicated-leather-half-shoes-sb-s473\"}', NULL, '2023-05-17 20:29:00', '2023-05-17 20:29:00'),
('fe24f416-66c8-4fa5-90d4-3838e5c1d856', 'App\\Notifications\\AdApprovedNotification', 'App\\Models\\User', 2, '{\"msg\":\"Ad Approved\",\"type\":\"adapproved\",\"url\":\"https:\\/\\/mhzone.com\\/ad\\/details\\/aaj-premium-leather-half-shoes-sb-s469\"}', NULL, '2023-05-17 20:29:34', '2023-05-17 20:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` int DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address_type` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_discount` decimal(10,2) DEFAULT NULL,
  `total_seller` int DEFAULT NULL,
  `shipping_charge` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL COMMENT 'after coupon discount plus shipping cost',
  `payment_method` varchar(50) NOT NULL,
  `payment_status` int NOT NULL DEFAULT '0' COMMENT '0 = Unpaid, 1 = paid',
  `status` enum('pending','processing','shipped','delivered','cancled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_commission_percent` decimal(13,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `subtotal`, `tax`, `apartment`, `address`, `city`, `state`, `postcode`, `phone`, `address_type`, `coupon_code`, `coupon_discount`, `total_seller`, `shipping_charge`, `total_price`, `payment_method`, `payment_status`, `status`, `created_at`, `updated_at`, `admin_commission_percent`) VALUES
(1, 9, '900000001', '460.00', NULL, 'House #32', 'Road #32', 'Dhaka', 'Dhaka', 1234, '01767671122', 'home', NULL, '0.00', 1, '10.00', '470.00', 'paypal', 0, 'pending', '2023-05-17 15:08:06', '2023-05-17 15:08:06', '0.00'),
(2, 8, '800000002', '2514.00', NULL, 'Dhaka', 'sdsd', 'sdsd', '1212', 1212, '01681999444', NULL, NULL, '0.00', 1, '10.00', '2524.00', 'paypal', 0, 'pending', '2023-05-17 15:22:18', '2023-05-17 15:22:18', '0.00'),
(3, 2, '200000003', '470.00', NULL, 'Ut eum modi ut exerc', 'Deleniti sint accus', 'Velit debitis laboru', 'Quibusdam nulla hic', 47, '+1 (417) 962-3146', 'home', NULL, '0.00', 1, '10.00', '480.00', 'stripe', 0, 'pending', '2024-08-20 00:15:50', '2024-08-20 00:15:50', '5.50'),
(4, 2, '200000004', '470.00', NULL, 'Ut eum modi ut exerc', 'Deleniti sint accus', 'Velit debitis laboru', 'Quibusdam nulla hic', 47, '+1 (417) 962-3146', 'home', NULL, '0.00', 1, '10.00', '480.00', 'stripe', 0, 'pending', '2024-08-20 00:16:38', '2024-08-20 00:16:38', '5.50');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `ad_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL COMMENT 'unit price adding attribute price ',
  `quantity` int UNSIGNED NOT NULL,
  `seller_id` bigint DEFAULT NULL,
  `buyer_id` bigint DEFAULT NULL,
  `attributes` text,
  `attrbite_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL COMMENT 'unit price adding attribute price * qty	',
  `status` enum('pending','confirmed','processing','shipped','delivered') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `ad_id`, `price`, `quantity`, `seller_id`, `buyer_id`, `attributes`, `attrbite_price`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '235.00', 2, 3, 9, '{\"Size\":[{\"name\":\"M\",\"price\":\"5\"}],\"Color\":[{\"name\":\"Black\",\"price\":\"5\"}]}', '10.00', '460.00', 'delivered', '2023-05-17 20:08:06', '2023-05-17 20:09:19'),
(2, 2, 4, '2514.00', 1, 2, 8, NULL, '0.00', '2514.00', 'pending', '2023-05-17 20:22:18', '2023-05-17 20:22:18'),
(3, 3, 3, '235.00', 2, 3, 2, '{\"Size\":[{\"name\":\"M\",\"price\":\"5\"}],\"Color\":[{\"name\":\"Black\",\"price\":\"5\"}]}', '10.00', '470.00', 'confirmed', '2024-08-19 18:15:50', '2024-08-19 18:15:50'),
(4, 4, 3, '235.00', 2, 3, 2, '{\"Size\":[{\"name\":\"M\",\"price\":\"5\"}],\"Color\":[{\"name\":\"Black\",\"price\":\"5\"}]}', '10.00', '470.00', 'confirmed', '2024-08-19 18:16:38', '2024-08-19 18:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$1/Kj364m2mfIcTV/O1XRzupKNDB9NWEPjYJxKdzFaFou6nLQjqav2', '2022-10-25 12:37:17'),
('masudrana@gmail.com', '$2y$10$DcZmYNwvoXCzaC5vP9EVMOZ/NLwhWR6l/J2lRG1uwPw8XPFQsdT7K', '2023-03-20 05:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(2, 'admin.create', 'admin', 'admin', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(3, 'admin.view', 'admin', 'admin', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(4, 'admin.edit', 'admin', 'admin', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(5, 'admin.delete', 'admin', 'admin', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(6, 'role.create', 'admin', 'role', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(7, 'role.view', 'admin', 'role', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(8, 'role.edit', 'admin', 'role', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(9, 'role.delete', 'admin', 'role', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(10, 'map.create', 'admin', 'map', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(11, 'map.view', 'admin', 'map', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(12, 'map.edit', 'admin', 'map', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(13, 'map.delete', 'admin', 'map', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(14, 'profile.view', 'admin', 'profile', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(15, 'profile.edit', 'admin', 'profile', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(16, 'setting.view', 'admin', 'settings', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(17, 'setting.update', 'admin', 'settings', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(18, 'ad.create', 'admin', 'ad', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(19, 'ad.view', 'admin', 'ad', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(20, 'ad.update', 'admin', 'ad', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(21, 'ad.delete', 'admin', 'ad', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(22, 'category.create', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(23, 'category.view', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(24, 'category.update', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(25, 'category.delete', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(26, 'subcategory.create', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(27, 'subcategory.view', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(28, 'subcategory.update', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(29, 'subcategory.delete', 'admin', 'category', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(30, 'custom-field.create', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(31, 'custom-field.view', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(32, 'custom-field.update', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(33, 'custom-field.delete', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(34, 'custom-field-group.create', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(35, 'custom-field-group.view', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(36, 'custom-field-group.update', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(37, 'custom-field-group.delete', 'admin', 'custom-field', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(38, 'newsletter.view', 'admin', 'newsletter', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(39, 'newsletter.mailsend', 'admin', 'newsletter', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(40, 'newsletter.delete', 'admin', 'newsletter', '2022-07-25 05:09:44', '2022-07-25 05:09:44'),
(41, 'brand.create', 'admin', 'brand', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(42, 'brand.view', 'admin', 'brand', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(43, 'brand.update', 'admin', 'brand', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(44, 'brand.delete', 'admin', 'brand', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(45, 'plan.create', 'admin', 'plan', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(46, 'plan.view', 'admin', 'plan', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(47, 'plan.update', 'admin', 'plan', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(48, 'plan.delete', 'admin', 'plan', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(49, 'postcategory.create', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(50, 'postcategory.view', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(51, 'postcategory.update', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(52, 'postcategory.delete', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(53, 'post.create', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(54, 'post.view', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(55, 'post.update', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(56, 'post.delete', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(57, 'tag.create', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(58, 'tag.view', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(59, 'tag.update', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(60, 'tag.delete', 'admin', 'Blog', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(61, 'testimonial.create', 'admin', 'testimonial', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(62, 'testimonial.view', 'admin', 'testimonial', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(63, 'testimonial.update', 'admin', 'testimonial', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(64, 'testimonial.delete', 'admin', 'testimonial', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(65, 'faqcategory.create', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(66, 'faqcategory.view', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(67, 'faqcategory.update', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(68, 'faqcategory.delete', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(69, 'faq.create', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(70, 'faq.view', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(71, 'faq.update', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(72, 'faq.delete', 'admin', 'faq', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(73, 'customer.view', 'admin', 'others', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(74, 'contact.view', 'admin', 'others', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(75, 'color.destroy', 'admin', 'color', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(76, 'color.update', 'admin', 'color', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(77, 'color.create', 'admin', 'color', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(78, 'size.create', 'admin', 'size', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(79, 'size.destroy', 'admin', 'size', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(80, 'size.update', 'admin', 'size', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(81, 'report.index', 'admin', 'report', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(82, 'report.view', 'admin', 'report', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(83, 'color.index', 'admin', 'color', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(84, 'module.coupon.index', 'admin', 'coupon', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(85, 'module.coupon.create', 'admin', 'coupon', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(86, 'module.coupon.edit', 'admin', 'coupon', '2022-07-25 05:09:45', '2022-07-25 05:09:45'),
(87, 'module.coupon.destroy', 'admin', 'coupon', '2022-07-25 05:09:45', '2022-07-25 05:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_custom_fields`
--

CREATE TABLE `product_custom_fields` (
  `id` bigint UNSIGNED NOT NULL,
  `ad_id` bigint UNSIGNED NOT NULL,
  `custom_field_id` bigint UNSIGNED NOT NULL,
  `custom_field_group_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recent_view_ads`
--

CREATE TABLE `recent_view_ads` (
  `id` int NOT NULL,
  `session_id` varchar(155) NOT NULL COMMENT 'session or user_id',
  `ad_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint UNSIGNED NOT NULL,
  `report_from_id` bigint UNSIGNED NOT NULL,
  `report_to_id` bigint UNSIGNED NOT NULL,
  `commends` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requested_products`
--

CREATE TABLE `requested_products` (
  `id` int NOT NULL,
  `ads_id` int NOT NULL,
  `request_to` int NOT NULL,
  `request_form` int NOT NULL,
  `offer_price` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stars` int NOT NULL,
  `ad_id` bigint NOT NULL,
  `order_id` int DEFAULT NULL,
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2022-07-25 05:09:44', '2022-07-25 05:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint UNSIGNED NOT NULL,
  `page_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `page_slug`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'home', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'uploads/images/seo/1673698058_63c29b0a335b4.jpg', '2022-07-25 05:09:47', '2023-03-23 12:16:12'),
(2, 'about', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'uploads/images/seo/1673696645_63c29585a5b50.jpg', '2022-07-25 05:09:47', '2023-03-23 12:16:26'),
(3, 'contact', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'uploads/images/seo/1679309593_64183b1986d09.png', '2022-07-25 05:09:47', '2023-03-23 12:16:38'),
(4, 'ads', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'https://2life.webdevs4u.com/uploads/app/logo/ZyNGfAIe8Xkz6uD6cJ010aesk02pkvW4nRzj9OnI.svg', '2022-07-25 05:09:47', '2023-03-23 12:16:57'),
(5, 'blog', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'https://2life.webdevs4u.com/uploads/app/logo/ZyNGfAIe8Xkz6uD6cJ010aesk02pkvW4nRzj9OnI.svg', '2022-07-25 05:09:47', '2023-03-23 12:17:31'),
(6, 'pricing', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'https://2life.webdevs4u.com/uploads/app/logo/ZyNGfAIe8Xkz6uD6cJ010aesk02pkvW4nRzj9OnI.svg', '2022-07-25 05:09:47', '2023-03-23 12:17:50'),
(7, 'login', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'https://2life.webdevs4u.com/uploads/app/logo/ZyNGfAIe8Xkz6uD6cJ010aesk02pkvW4nRzj9OnI.svg', '2022-07-25 05:09:47', '2023-03-23 12:18:09'),
(8, 'register', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'https://2life.webdevs4u.com/uploads/app/logo/ZyNGfAIe8Xkz6uD6cJ010aesk02pkvW4nRzj9OnI.svg', '2022-07-25 05:09:47', '2023-03-23 12:18:25'),
(9, 'faq', 'mhzone | popular shoes market place', 'mhzone | the best shoes market place ', 'https://2life.webdevs4u.com/uploads/app/logo/ZyNGfAIe8Xkz6uD6cJ010aesk02pkvW4nRzj9OnI.svg', '2022-07-25 05:09:47', '2023-03-23 12:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `logo_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `white_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_css` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_script` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_script` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_featured_ad_limit` int NOT NULL DEFAULT '3',
  `regular_ads_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `featured_ads_homepage` tinyint(1) NOT NULL DEFAULT '1',
  `customer_email_verification` tinyint(1) NOT NULL DEFAULT '0',
  `maximum_ad_image_limit` int UNSIGNED NOT NULL DEFAULT '5',
  `subscription_type` enum('one_time','recurring') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'one_time',
  `ads_admin_approval` tinyint(1) NOT NULL DEFAULT '0',
  `free_ad_limit` int NOT NULL DEFAULT '5',
  `sidebar_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nav_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_txt_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nav_txt_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accent_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_primary_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_secondary_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `facebook_pixel` tinyint(1) NOT NULL DEFAULT '0',
  `google_analytics` tinyint(1) NOT NULL DEFAULT '0',
  `search_engine_indexing` tinyint(1) NOT NULL DEFAULT '1',
  `default_layout` tinyint(1) NOT NULL DEFAULT '1',
  `website_loader` tinyint(1) NOT NULL DEFAULT '1',
  `loader_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_changing` tinyint(1) NOT NULL DEFAULT '1',
  `email_verification` tinyint(1) NOT NULL DEFAULT '0',
  `watermark_status` tinyint(1) NOT NULL DEFAULT '0',
  `watermark_type` enum('text','image') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `watermark_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ZakirSoft',
  `watermark_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'frontend/images/logo.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default_map` enum('google-map','map-box') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'google-map',
  `google_map_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_box_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_long` double NOT NULL DEFAULT '-100',
  `default_lat` double NOT NULL DEFAULT '40',
  `push_notification_status` tinyint(1) NOT NULL DEFAULT '1',
  `server_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_domain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_bucket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messaging_sender_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measurement_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deals_under_price` float NOT NULL DEFAULT '0',
  `admin_commission` float(14,2) NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_valid_day` int NOT NULL DEFAULT '0',
  `google_analytical_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fa_pixel_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo_image`, `white_logo`, `favicon_image`, `header_css`, `header_script`, `body_script`, `free_featured_ad_limit`, `regular_ads_homepage`, `featured_ads_homepage`, `customer_email_verification`, `maximum_ad_image_limit`, `subscription_type`, `ads_admin_approval`, `free_ad_limit`, `sidebar_color`, `nav_color`, `sidebar_txt_color`, `nav_txt_color`, `main_color`, `accent_color`, `frontend_primary_color`, `frontend_secondary_color`, `dark_mode`, `facebook_pixel`, `google_analytics`, `search_engine_indexing`, `default_layout`, `website_loader`, `loader_image`, `language_changing`, `email_verification`, `watermark_status`, `watermark_type`, `watermark_text`, `watermark_image`, `created_at`, `updated_at`, `default_map`, `google_map_key`, `map_box_key`, `default_long`, `default_lat`, `push_notification_status`, `server_key`, `api_key`, `auth_domain`, `project_id`, `storage_bucket`, `messaging_sender_id`, `app_id`, `measurement_id`, `deals_under_price`, `admin_commission`, `facebook`, `gmail`, `instagram`, `tiktok`, `ad_valid_day`, `google_analytical_id`, `fb_app_id`, `fa_pixel_id`, `shipping_charge`) VALUES
(1, 'uploads/app/logo\\BOHyhcasrnXJ7UAwtT2NaVAzxcnBJEmkh8V5EFXA.png', 'uploads/app/logo\\rMMK0Z2gAIQrj8nISvJSX4K0EuZiqmRPGnme8ES1.png', 'uploads/app/logo\\9nuwiE5zPkb7Y4VPrkDygfc1GGSTvnm2vqfljYCQ.png', NULL, NULL, NULL, 0, 0, 0, 0, 0, '', 1, 0, '#022446', '#0a243e', '#e0e9f2', '#e0e9f2', '#05c279', '#ffc107', '#05c279', '#ffc107', 0, 0, 0, 1, 1, 0, NULL, 0, 0, 1, 'text', '2life.lv', 'public/frontend/images/logo.png', '2022-07-25 05:09:45', '2024-05-02 19:38:41', 'google-map', 'AIzaSyA72zy8Wy4kFpom_brg28OqBOa8S0eXXGY', 'AIzaSyA72zy8Wy4kFpom_brg28OqBOa8S0eXXGY', 90.411270491741, 23.757853442383, 0, 'your-server-key', 'your-api-key', 'your-auth-domain', 'your-project-id', 'your-storage-bucket', 'your-messaging-sender-id', 'your-app-id', 'your-measurement-id', 0, 5.50, 'https://facebook.com', 'rony@gmail.com', 'https://instagram.com', 'https://tiktok.com', 38, 'G-VE7ZL7T23F', '5840805692668340', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `setup_guides`
--

CREATE TABLE `setup_guides` (
  `id` bigint UNSIGNED NOT NULL,
  `task_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setup_guides`
--

INSERT INTO `setup_guides` (`id`, `task_name`, `title`, `description`, `action_route`, `action_label`, `status`, `created_at`, `updated_at`) VALUES
(1, 'app_setting', 'App Information ', 'Add your app logo, name, description, owner and other information.', 'settings.general', 'Add App Information', 1, '2022-07-25 05:09:47', '2024-05-02 19:38:41'),
(2, 'smtp_setting', 'SMTP Configuration', 'Add your app logo, name, description, owner and other information.', 'settings.email', 'Add Mail Configuration', 1, '2022-07-25 05:09:47', '2023-03-20 10:48:50'),
(3, 'payment_setting', 'Enable Payment Method', 'Enable to payment methods to receive payments from your customer.', 'settings.payment', 'Add Payment', 1, '2022-07-25 05:09:47', '2023-05-17 19:31:18'),
(4, 'theme_setting', 'Customize Theme', 'Customize your theme to make your app look more attractive.', 'settings.theme', 'Customize Your App Now', 1, '2022-07-25 05:09:47', '2022-09-17 03:14:21'),
(5, 'map_setting', 'Map Configuration', 'Configure your map setting api to create ad in any location.', 'settings.system', 'Add Map API', 1, '2022-07-25 05:09:47', '2022-09-17 03:32:16'),
(6, 'pusher_setting', 'Pusher Configuration', 'Configure your pusher setting api for the chat application', 'settings.system', 'Add Pusher API', 0, '2022-07-25 05:09:47', '2022-07-25 05:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `shiping_locations`
--

CREATE TABLE `shiping_locations` (
  `id` int NOT NULL,
  `iso` varchar(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `iso3` varchar(3) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shiping_locations`
--

INSERT INTO `shiping_locations` (`id`, `iso`, `name`, `locations`, `iso3`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(44, 'CN', 'CHINA', 'China', 'CHN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(49, 'CG', 'CONGO', 'Congo', 'COG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(73, 'FR', 'FRANCE', 'France', 'FRA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(99, 'IN', 'INDIA', 'India', 'IND', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(131, 'ML', 'MALI', 'Mali', 'MLI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(137, 'YT', 'MAYOTTE', 'Mayotte', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(155, 'NE', 'NIGER', 'Niger', 'NER', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(168, 'PE', 'PERU', 'Peru', 'PER', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(171, 'PL', 'POLAND', 'Poland', 'POL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', '', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55'),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 1, '2022-12-03 07:08:55', '2022-12-03 07:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country` int DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_type` varchar(255) DEFAULT NULL COMMENT '1 = home, 2 = office, 3 = other',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `name`, `user_id`, `phone`, `apartment`, `state`, `city`, `postcode`, `country`, `address`, `address_type`, `created_at`, `updated_at`) VALUES
(1, '', 3, '01767671133', '#32', 'Dhaka', 'Dhaka', '1234', NULL, 'Banani', 'office', '2023-05-17 19:35:01', '2023-05-17 19:35:24'),
(2, '', 3, '01545451122', '#36', 'Dhaka', 'Dhaka', '1234', NULL, 'Banani', 'other', '2023-05-17 19:35:44', '2023-05-17 19:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL,
  `size` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(37, 'XXS/40', 1, 1, '2023-01-30 20:36:32', '2023-01-30 20:36:32'),
(38, 'XS/42', 1, 1, '2023-01-30 20:36:43', '2023-01-30 20:36:43'),
(39, 'S/44-46', 1, 1, '2023-01-30 20:36:55', '2023-01-30 20:36:55'),
(40, 'M/48-50', 1, 1, '2023-01-30 20:37:13', '2023-01-30 20:37:13'),
(41, 'L/52-54', 1, 1, '2023-01-30 20:37:36', '2023-01-30 20:37:36'),
(42, 'XL/56', 1, 1, '2023-01-30 20:37:48', '2023-01-30 20:37:48'),
(43, 'XXL/58', 1, 1, '2023-01-30 20:38:09', '2023-01-30 20:38:09'),
(44, '3XL/58', 1, 1, '2023-01-30 20:38:47', '2023-01-30 20:38:47'),
(45, '4XL/60', 1, 1, '2023-01-30 20:38:59', '2023-01-30 20:38:59'),
(46, '26', 1, 1, '2023-01-30 20:48:28', '2023-01-30 20:48:28'),
(47, '27', 1, 1, '2023-01-30 20:48:36', '2023-01-30 20:48:36'),
(48, '28', 1, 1, '2023-01-30 20:48:44', '2023-01-30 20:48:44'),
(49, '29', 1, 1, '2023-01-30 20:48:53', '2023-01-30 20:48:53'),
(50, '30', 1, 1, '2023-01-30 20:58:36', '2023-01-30 20:58:36'),
(51, '31', 1, 1, '2023-01-30 20:58:43', '2023-01-30 20:58:43'),
(52, '32', 1, 1, '2023-01-30 20:58:53', '2023-01-30 20:58:53'),
(53, '33', 1, 1, '2023-01-30 20:59:01', '2023-01-30 20:59:01'),
(54, '34', 1, 1, '2023-01-30 20:59:07', '2023-01-30 20:59:07'),
(55, '35', 1, 1, '2023-01-30 20:59:20', '2023-01-30 20:59:20'),
(56, '36', 1, 1, '2023-01-30 20:59:38', '2023-01-30 20:59:38'),
(57, '37', 1, 1, '2023-01-30 20:59:45', '2023-01-30 20:59:45'),
(58, '38', 1, 1, '2023-01-30 20:59:56', '2023-01-30 20:59:56'),
(59, '39', 1, 1, '2023-01-30 21:00:04', '2023-01-30 21:00:04'),
(60, '40', 1, 1, '2023-01-30 21:00:11', '2023-01-30 21:00:11'),
(61, '41', 1, 1, '2023-01-30 21:00:43', '2023-01-30 21:00:43'),
(62, '42', 1, 1, '2023-01-30 21:00:50', '2023-01-30 21:00:50'),
(63, '43', 1, 1, '2023-01-30 21:00:58', '2023-03-20 11:14:02'),
(64, '44', 1, 1, '2023-01-30 21:01:21', '2023-01-30 21:01:21'),
(65, '45', 1, 1, '2023-01-30 21:01:30', '2023-01-30 21:01:30'),
(66, '46', 1, 1, '2023-01-30 21:01:37', '2023-01-30 21:01:37'),
(67, '47', 1, 1, '2023-01-30 21:01:45', '2023-01-30 21:01:45'),
(68, 'XXS/40', 1, 1, '2023-01-30 21:09:13', '2023-01-30 21:09:13'),
(69, 'XS/42', 1, 1, '2023-01-30 21:09:22', '2023-01-30 21:09:22'),
(70, 'S/44-46', 1, 1, '2023-01-30 21:09:31', '2023-01-30 21:09:31'),
(71, 'M/48-50', 1, 1, '2023-01-30 21:09:49', '2023-01-30 21:09:49'),
(72, 'L/52-54', 1, 1, '2023-01-30 21:10:00', '2023-01-30 21:10:00'),
(73, 'XL/56', 1, 1, '2023-01-30 21:10:32', '2023-01-30 21:10:32'),
(74, 'XXL/58', 1, 1, '2023-01-30 21:10:42', '2023-01-30 21:10:42'),
(75, '3XL/58', 1, 1, '2023-01-30 21:10:52', '2023-01-30 21:10:52'),
(76, '4XL/60', 1, 1, '2023-01-30 21:11:05', '2023-01-30 21:11:05'),
(77, '5/40', 1, 1, '2023-01-30 21:34:56', '2023-01-30 21:34:56'),
(78, '5.5/41', 1, 1, '2023-01-30 21:35:22', '2023-01-30 21:35:22'),
(79, '6/42', 1, 1, '2023-01-30 21:35:37', '2023-01-30 21:35:37'),
(81, '36', 1, 1, '2023-02-09 13:32:20', '2023-02-09 13:32:20'),
(82, '36', 1, 1, '2023-02-09 13:33:09', '2023-02-09 13:33:09'),
(83, '36', 1, 1, '2023-02-14 11:24:01', '2023-02-14 11:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `path` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `seller_id` int NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_body` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `path`, `status`, `seller_id`, `content_title`, `content_body`, `updated_at`, `created_at`) VALUES
(8, 'uploads/slider/1684332892_6464e15c7dd14.jpg', 1, 0, 'FROM PEOPLE FOR PEOPLE', 'Buy, sell, discover authenticated pieces', '2023-05-17 19:14:52', '2023-02-02 12:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `social_media` enum('facebook','twitter','instagram','youtube','linkedin','pinterest','reddit','github','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_show_home` int NOT NULL DEFAULT '1',
  `thumb` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mesurement_point` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `is_show_home`, `thumb`, `mesurement_point`) VALUES
(29, 15, 'sports', 'sports', 1, '2023-05-08 06:18:09', '2023-05-08 06:18:09', 0, 'uploads/subcategory/1683548289_6458e881ab2df.jpg', NULL),
(31, 17, 'Mkds', 'mkds', 1, '2023-05-08 06:19:24', '2023-05-08 06:19:24', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint UNSIGNED NOT NULL,
  `home_page` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `value`) VALUES
(1, 'Africa/Abidjan'),
(2, 'Africa/Accra'),
(3, 'Africa/Addis_Ababa'),
(4, 'Africa/Algiers'),
(5, 'Africa/Asmara'),
(6, 'Africa/Bamako'),
(7, 'Africa/Bangui'),
(8, 'Africa/Banjul'),
(9, 'Africa/Bissau'),
(10, 'Africa/Blantyre'),
(11, 'Africa/Brazzaville'),
(12, 'Africa/Bujumbura'),
(13, 'Africa/Cairo'),
(14, 'Africa/Casablanca'),
(15, 'Africa/Ceuta'),
(16, 'Africa/Conakry'),
(17, 'Africa/Dakar'),
(18, 'Africa/Dar_es_Salaam'),
(19, 'Africa/Djibouti'),
(20, 'Africa/Douala'),
(21, 'Africa/El_Aaiun'),
(22, 'Africa/Freetown'),
(23, 'Africa/Gaborone'),
(24, 'Africa/Harare'),
(25, 'Africa/Johannesburg'),
(26, 'Africa/Juba'),
(27, 'Africa/Kampala'),
(28, 'Africa/Khartoum'),
(29, 'Africa/Kigali'),
(30, 'Africa/Kinshasa'),
(31, 'Africa/Lagos'),
(32, 'Africa/Libreville'),
(33, 'Africa/Lome'),
(34, 'Africa/Luanda'),
(35, 'Africa/Lubumbashi'),
(36, 'Africa/Lusaka'),
(37, 'Africa/Malabo'),
(38, 'Africa/Maputo'),
(39, 'Africa/Maseru'),
(40, 'Africa/Mbabane'),
(41, 'Africa/Mogadishu'),
(42, 'Africa/Monrovia'),
(43, 'Africa/Nairobi'),
(44, 'Africa/Ndjamena'),
(45, 'Africa/Niamey'),
(46, 'Africa/Nouakchott'),
(47, 'Africa/Ouagadougou'),
(48, 'Africa/Porto-Novo'),
(49, 'Africa/Sao_Tome'),
(50, 'Africa/Tripoli'),
(51, 'Africa/Tunis'),
(52, 'Africa/Windhoek'),
(53, 'America/Adak'),
(54, 'America/Anchorage'),
(55, 'America/Anguilla'),
(56, 'America/Antigua'),
(57, 'America/Araguaina'),
(58, 'America/Argentina/Buenos_Aires'),
(59, 'America/Argentina/Catamarca'),
(60, 'America/Argentina/Cordoba'),
(61, 'America/Argentina/Jujuy'),
(62, 'America/Argentina/La_Rioja'),
(63, 'America/Argentina/Mendoza'),
(64, 'America/Argentina/Rio_Gallegos'),
(65, 'America/Argentina/Salta'),
(66, 'America/Argentina/San_Juan'),
(67, 'America/Argentina/San_Luis'),
(68, 'America/Argentina/Tucuman'),
(69, 'America/Argentina/Ushuaia'),
(70, 'America/Aruba'),
(71, 'America/Asuncion'),
(72, 'America/Atikokan'),
(73, 'America/Bahia'),
(74, 'America/Bahia_Banderas'),
(75, 'America/Barbados'),
(76, 'America/Belem'),
(77, 'America/Belize'),
(78, 'America/Blanc-Sablon'),
(79, 'America/Boa_Vista'),
(80, 'America/Bogota'),
(81, 'America/Boise'),
(82, 'America/Cambridge_Bay'),
(83, 'America/Campo_Grande'),
(84, 'America/Cancun'),
(85, 'America/Caracas'),
(86, 'America/Cayenne'),
(87, 'America/Cayman'),
(88, 'America/Chicago'),
(89, 'America/Chihuahua'),
(90, 'America/Costa_Rica'),
(91, 'America/Creston'),
(92, 'America/Cuiaba'),
(93, 'America/Curacao'),
(94, 'America/Danmarkshavn'),
(95, 'America/Dawson'),
(96, 'America/Dawson_Creek'),
(97, 'America/Denver'),
(98, 'America/Detroit'),
(99, 'America/Dominica'),
(100, 'America/Edmonton'),
(101, 'America/Eirunepe'),
(102, 'America/El_Salvador'),
(103, 'America/Fort_Nelson'),
(104, 'America/Fortaleza'),
(105, 'America/Glace_Bay'),
(106, 'America/Goose_Bay'),
(107, 'America/Grand_Turk'),
(108, 'America/Grenada'),
(109, 'America/Guadeloupe'),
(110, 'America/Guatemala'),
(111, 'America/Guayaquil'),
(112, 'America/Guyana'),
(113, 'America/Halifax'),
(114, 'America/Havana'),
(115, 'America/Hermosillo'),
(116, 'America/Indiana/Indianapolis'),
(117, 'America/Indiana/Knox'),
(118, 'America/Indiana/Marengo'),
(119, 'America/Indiana/Petersburg'),
(120, 'America/Indiana/Tell_City'),
(121, 'America/Indiana/Vevay'),
(122, 'America/Indiana/Vincennes'),
(123, 'America/Indiana/Winamac'),
(124, 'America/Inuvik'),
(125, 'America/Iqaluit'),
(126, 'America/Jamaica'),
(127, 'America/Juneau'),
(128, 'America/Kentucky/Louisville'),
(129, 'America/Kentucky/Monticello'),
(130, 'America/Kralendijk'),
(131, 'America/La_Paz'),
(132, 'America/Lima'),
(133, 'America/Los_Angeles'),
(134, 'America/Lower_Princes'),
(135, 'America/Maceio'),
(136, 'America/Managua'),
(137, 'America/Manaus'),
(138, 'America/Marigot'),
(139, 'America/Martinique'),
(140, 'America/Matamoros'),
(141, 'America/Mazatlan'),
(142, 'America/Menominee'),
(143, 'America/Merida'),
(144, 'America/Metlakatla'),
(145, 'America/Mexico_City'),
(146, 'America/Miquelon'),
(147, 'America/Moncton'),
(148, 'America/Monterrey'),
(149, 'America/Montevideo'),
(150, 'America/Montserrat'),
(151, 'America/Nassau'),
(152, 'America/New_York'),
(153, 'America/Nipigon'),
(154, 'America/Nome'),
(155, 'America/Noronha'),
(156, 'America/North_Dakota/Beulah'),
(157, 'America/North_Dakota/Center'),
(158, 'America/North_Dakota/New_Salem'),
(159, 'America/Nuuk'),
(160, 'America/Ojinaga'),
(161, 'America/Panama'),
(162, 'America/Pangnirtung'),
(163, 'America/Paramaribo'),
(164, 'America/Phoenix'),
(165, 'America/Port-au-Prince'),
(166, 'America/Port_of_Spain'),
(167, 'America/Porto_Velho'),
(168, 'America/Puerto_Rico'),
(169, 'America/Punta_Arenas'),
(170, 'America/Rainy_River'),
(171, 'America/Rankin_Inlet'),
(172, 'America/Recife'),
(173, 'America/Regina'),
(174, 'America/Resolute'),
(175, 'America/Rio_Branco'),
(176, 'America/Santarem'),
(177, 'America/Santiago'),
(178, 'America/Santo_Domingo'),
(179, 'America/Sao_Paulo'),
(180, 'America/Scoresbysund'),
(181, 'America/Sitka'),
(182, 'America/St_Barthelemy'),
(183, 'America/St_Johns'),
(184, 'America/St_Kitts'),
(185, 'America/St_Lucia'),
(186, 'America/St_Thomas'),
(187, 'America/St_Vincent'),
(188, 'America/Swift_Current'),
(189, 'America/Tegucigalpa'),
(190, 'America/Thule'),
(191, 'America/Thunder_Bay'),
(192, 'America/Tijuana'),
(193, 'America/Toronto'),
(194, 'America/Tortola'),
(195, 'America/Vancouver'),
(196, 'America/Whitehorse'),
(197, 'America/Winnipeg'),
(198, 'America/Yakutat'),
(199, 'America/Yellowknife'),
(200, 'Antarctica/Casey'),
(201, 'Antarctica/Davis'),
(202, 'Antarctica/DumontDUrville'),
(203, 'Antarctica/Macquarie'),
(204, 'Antarctica/Mawson'),
(205, 'Antarctica/McMurdo'),
(206, 'Antarctica/Palmer'),
(207, 'Antarctica/Rothera'),
(208, 'Antarctica/Syowa'),
(209, 'Antarctica/Troll'),
(210, 'Antarctica/Vostok'),
(211, 'Arctic/Longyearbyen'),
(212, 'Asia/Aden'),
(213, 'Asia/Almaty'),
(214, 'Asia/Amman'),
(215, 'Asia/Anadyr'),
(216, 'Asia/Aqtau'),
(217, 'Asia/Aqtobe'),
(218, 'Asia/Ashgabat'),
(219, 'Asia/Atyrau'),
(220, 'Asia/Baghdad'),
(221, 'Asia/Bahrain'),
(222, 'Asia/Baku'),
(223, 'Asia/Bangkok'),
(224, 'Asia/Barnaul'),
(225, 'Asia/Beirut'),
(226, 'Asia/Bishkek'),
(227, 'Asia/Brunei'),
(228, 'Asia/Chita'),
(229, 'Asia/Choibalsan'),
(230, 'Asia/Colombo'),
(231, 'Asia/Damascus'),
(232, 'Asia/Dhaka'),
(233, 'Asia/Dili'),
(234, 'Asia/Dubai'),
(235, 'Asia/Dushanbe'),
(236, 'Asia/Famagusta'),
(237, 'Asia/Gaza'),
(238, 'Asia/Hebron'),
(239, 'Asia/Ho_Chi_Minh'),
(240, 'Asia/Hong_Kong'),
(241, 'Asia/Hovd'),
(242, 'Asia/Irkutsk'),
(243, 'Asia/Jakarta'),
(244, 'Asia/Jayapura'),
(245, 'Asia/Jerusalem'),
(246, 'Asia/Kabul'),
(247, 'Asia/Kamchatka'),
(248, 'Asia/Karachi'),
(249, 'Asia/Kathmandu'),
(250, 'Asia/Khandyga'),
(251, 'Asia/Kolkata'),
(252, 'Asia/Krasnoyarsk'),
(253, 'Asia/Kuala_Lumpur'),
(254, 'Asia/Kuching'),
(255, 'Asia/Kuwait'),
(256, 'Asia/Macau'),
(257, 'Asia/Magadan'),
(258, 'Asia/Makassar'),
(259, 'Asia/Manila'),
(260, 'Asia/Muscat'),
(261, 'Asia/Nicosia'),
(262, 'Asia/Novokuznetsk'),
(263, 'Asia/Novosibirsk'),
(264, 'Asia/Omsk'),
(265, 'Asia/Oral'),
(266, 'Asia/Phnom_Penh'),
(267, 'Asia/Pontianak'),
(268, 'Asia/Pyongyang'),
(269, 'Asia/Qatar'),
(270, 'Asia/Qostanay'),
(271, 'Asia/Qyzylorda'),
(272, 'Asia/Riyadh'),
(273, 'Asia/Sakhalin'),
(274, 'Asia/Samarkand'),
(275, 'Asia/Seoul'),
(276, 'Asia/Shanghai'),
(277, 'Asia/Singapore'),
(278, 'Asia/Srednekolymsk'),
(279, 'Asia/Taipei'),
(280, 'Asia/Tashkent'),
(281, 'Asia/Tbilisi'),
(282, 'Asia/Tehran'),
(283, 'Asia/Thimphu'),
(284, 'Asia/Tokyo'),
(285, 'Asia/Tomsk'),
(286, 'Asia/Ulaanbaatar'),
(287, 'Asia/Urumqi'),
(288, 'Asia/Ust-Nera'),
(289, 'Asia/Vientiane'),
(290, 'Asia/Vladivostok'),
(291, 'Asia/Yakutsk'),
(292, 'Asia/Yangon'),
(293, 'Asia/Yekaterinburg'),
(294, 'Asia/Yerevan'),
(295, 'Atlantic/Azores'),
(296, 'Atlantic/Bermuda'),
(297, 'Atlantic/Canary'),
(298, 'Atlantic/Cape_Verde'),
(299, 'Atlantic/Faroe'),
(300, 'Atlantic/Madeira'),
(301, 'Atlantic/Reykjavik'),
(302, 'Atlantic/South_Georgia'),
(303, 'Atlantic/St_Helena'),
(304, 'Atlantic/Stanley'),
(305, 'Australia/Adelaide'),
(306, 'Australia/Brisbane'),
(307, 'Australia/Broken_Hill'),
(308, 'Australia/Darwin'),
(309, 'Australia/Eucla'),
(310, 'Australia/Hobart'),
(311, 'Australia/Lindeman'),
(312, 'Australia/Lord_Howe'),
(313, 'Australia/Melbourne'),
(314, 'Australia/Perth'),
(315, 'Australia/Sydney'),
(316, 'Europe/Amsterdam'),
(317, 'Europe/Andorra'),
(318, 'Europe/Astrakhan'),
(319, 'Europe/Athens'),
(320, 'Europe/Belgrade'),
(321, 'Europe/Berlin'),
(322, 'Europe/Bratislava'),
(323, 'Europe/Brussels'),
(324, 'Europe/Bucharest'),
(325, 'Europe/Budapest'),
(326, 'Europe/Busingen'),
(327, 'Europe/Chisinau'),
(328, 'Europe/Copenhagen'),
(329, 'Europe/Dublin'),
(330, 'Europe/Gibraltar'),
(331, 'Europe/Guernsey'),
(332, 'Europe/Helsinki'),
(333, 'Europe/Isle_of_Man'),
(334, 'Europe/Istanbul'),
(335, 'Europe/Jersey'),
(336, 'Europe/Kaliningrad'),
(337, 'Europe/Kiev'),
(338, 'Europe/Kirov'),
(339, 'Europe/Lisbon'),
(340, 'Europe/Ljubljana'),
(341, 'Europe/London'),
(342, 'Europe/Luxembourg'),
(343, 'Europe/Madrid'),
(344, 'Europe/Malta'),
(345, 'Europe/Mariehamn'),
(346, 'Europe/Minsk'),
(347, 'Europe/Monaco'),
(348, 'Europe/Moscow'),
(349, 'Europe/Oslo'),
(350, 'Europe/Paris'),
(351, 'Europe/Podgorica'),
(352, 'Europe/Prague'),
(353, 'Europe/Riga'),
(354, 'Europe/Rome'),
(355, 'Europe/Samara'),
(356, 'Europe/San_Marino'),
(357, 'Europe/Sarajevo'),
(358, 'Europe/Saratov'),
(359, 'Europe/Simferopol'),
(360, 'Europe/Skopje'),
(361, 'Europe/Sofia'),
(362, 'Europe/Stockholm'),
(363, 'Europe/Tallinn'),
(364, 'Europe/Tirane'),
(365, 'Europe/Ulyanovsk'),
(366, 'Europe/Uzhgorod'),
(367, 'Europe/Vaduz'),
(368, 'Europe/Vatican'),
(369, 'Europe/Vienna'),
(370, 'Europe/Vilnius'),
(371, 'Europe/Volgograd'),
(372, 'Europe/Warsaw'),
(373, 'Europe/Zagreb'),
(374, 'Europe/Zaporozhye'),
(375, 'Europe/Zurich'),
(376, 'Indian/Antananarivo'),
(377, 'Indian/Chagos'),
(378, 'Indian/Christmas'),
(379, 'Indian/Cocos'),
(380, 'Indian/Comoro'),
(381, 'Indian/Kerguelen'),
(382, 'Indian/Mahe'),
(383, 'Indian/Maldives'),
(384, 'Indian/Mauritius'),
(385, 'Indian/Mayotte'),
(386, 'Indian/Reunion'),
(387, 'Pacific/Apia'),
(388, 'Pacific/Auckland'),
(389, 'Pacific/Bougainville'),
(390, 'Pacific/Chatham'),
(391, 'Pacific/Chuuk'),
(392, 'Pacific/Easter'),
(393, 'Pacific/Efate'),
(394, 'Pacific/Fakaofo'),
(395, 'Pacific/Fiji'),
(396, 'Pacific/Funafuti'),
(397, 'Pacific/Galapagos'),
(398, 'Pacific/Gambier'),
(399, 'Pacific/Guadalcanal'),
(400, 'Pacific/Guam'),
(401, 'Pacific/Honolulu'),
(402, 'Pacific/Kanton'),
(403, 'Pacific/Kiritimati'),
(404, 'Pacific/Kosrae'),
(405, 'Pacific/Kwajalein'),
(406, 'Pacific/Majuro'),
(407, 'Pacific/Marquesas'),
(408, 'Pacific/Midway'),
(409, 'Pacific/Nauru'),
(410, 'Pacific/Niue'),
(411, 'Pacific/Norfolk'),
(412, 'Pacific/Noumea'),
(413, 'Pacific/Pago_Pago'),
(414, 'Pacific/Palau'),
(415, 'Pacific/Pitcairn'),
(416, 'Pacific/Pohnpei'),
(417, 'Pacific/Port_Moresby'),
(418, 'Pacific/Rarotonga'),
(419, 'Pacific/Saipan'),
(420, 'Pacific/Tahiti'),
(421, 'Pacific/Tarawa'),
(422, 'Pacific/Tongatapu'),
(423, 'Pacific/Wake'),
(424, 'Pacific/Wallis'),
(425, 'UTC'),
(426, 'Africa/Abidjan'),
(427, 'Africa/Accra'),
(428, 'Africa/Addis_Ababa'),
(429, 'Africa/Algiers'),
(430, 'Africa/Asmara'),
(431, 'Africa/Bamako'),
(432, 'Africa/Bangui'),
(433, 'Africa/Banjul'),
(434, 'Africa/Bissau'),
(435, 'Africa/Blantyre'),
(436, 'Africa/Brazzaville'),
(437, 'Africa/Bujumbura'),
(438, 'Africa/Cairo'),
(439, 'Africa/Casablanca'),
(440, 'Africa/Ceuta'),
(441, 'Africa/Conakry'),
(442, 'Africa/Dakar'),
(443, 'Africa/Dar_es_Salaam'),
(444, 'Africa/Djibouti'),
(445, 'Africa/Douala'),
(446, 'Africa/El_Aaiun'),
(447, 'Africa/Freetown'),
(448, 'Africa/Gaborone'),
(449, 'Africa/Harare'),
(450, 'Africa/Johannesburg'),
(451, 'Africa/Juba'),
(452, 'Africa/Kampala'),
(453, 'Africa/Khartoum'),
(454, 'Africa/Kigali'),
(455, 'Africa/Kinshasa'),
(456, 'Africa/Lagos'),
(457, 'Africa/Libreville'),
(458, 'Africa/Lome'),
(459, 'Africa/Luanda'),
(460, 'Africa/Lubumbashi'),
(461, 'Africa/Lusaka'),
(462, 'Africa/Malabo'),
(463, 'Africa/Maputo'),
(464, 'Africa/Maseru'),
(465, 'Africa/Mbabane'),
(466, 'Africa/Mogadishu'),
(467, 'Africa/Monrovia'),
(468, 'Africa/Nairobi'),
(469, 'Africa/Ndjamena'),
(470, 'Africa/Niamey'),
(471, 'Africa/Nouakchott'),
(472, 'Africa/Ouagadougou'),
(473, 'Africa/Porto-Novo'),
(474, 'Africa/Sao_Tome'),
(475, 'Africa/Tripoli'),
(476, 'Africa/Tunis'),
(477, 'Africa/Windhoek'),
(478, 'America/Adak'),
(479, 'America/Anchorage'),
(480, 'America/Anguilla'),
(481, 'America/Antigua'),
(482, 'America/Araguaina'),
(483, 'America/Argentina/Buenos_Aires'),
(484, 'America/Argentina/Catamarca'),
(485, 'America/Argentina/Cordoba'),
(486, 'America/Argentina/Jujuy'),
(487, 'America/Argentina/La_Rioja'),
(488, 'America/Argentina/Mendoza'),
(489, 'America/Argentina/Rio_Gallegos'),
(490, 'America/Argentina/Salta'),
(491, 'America/Argentina/San_Juan'),
(492, 'America/Argentina/San_Luis'),
(493, 'America/Argentina/Tucuman'),
(494, 'America/Argentina/Ushuaia'),
(495, 'America/Aruba'),
(496, 'America/Asuncion'),
(497, 'America/Atikokan'),
(498, 'America/Bahia'),
(499, 'America/Bahia_Banderas'),
(500, 'America/Barbados'),
(501, 'America/Belem'),
(502, 'America/Belize'),
(503, 'America/Blanc-Sablon'),
(504, 'America/Boa_Vista'),
(505, 'America/Bogota'),
(506, 'America/Boise'),
(507, 'America/Cambridge_Bay'),
(508, 'America/Campo_Grande'),
(509, 'America/Cancun'),
(510, 'America/Caracas'),
(511, 'America/Cayenne'),
(512, 'America/Cayman'),
(513, 'America/Chicago'),
(514, 'America/Chihuahua'),
(515, 'America/Costa_Rica'),
(516, 'America/Creston'),
(517, 'America/Cuiaba'),
(518, 'America/Curacao'),
(519, 'America/Danmarkshavn'),
(520, 'America/Dawson'),
(521, 'America/Dawson_Creek'),
(522, 'America/Denver'),
(523, 'America/Detroit'),
(524, 'America/Dominica'),
(525, 'America/Edmonton'),
(526, 'America/Eirunepe'),
(527, 'America/El_Salvador'),
(528, 'America/Fort_Nelson'),
(529, 'America/Fortaleza'),
(530, 'America/Glace_Bay'),
(531, 'America/Goose_Bay'),
(532, 'America/Grand_Turk'),
(533, 'America/Grenada'),
(534, 'America/Guadeloupe'),
(535, 'America/Guatemala'),
(536, 'America/Guayaquil'),
(537, 'America/Guyana'),
(538, 'America/Halifax'),
(539, 'America/Havana'),
(540, 'America/Hermosillo'),
(541, 'America/Indiana/Indianapolis'),
(542, 'America/Indiana/Knox'),
(543, 'America/Indiana/Marengo'),
(544, 'America/Indiana/Petersburg'),
(545, 'America/Indiana/Tell_City'),
(546, 'America/Indiana/Vevay'),
(547, 'America/Indiana/Vincennes'),
(548, 'America/Indiana/Winamac'),
(549, 'America/Inuvik'),
(550, 'America/Iqaluit'),
(551, 'America/Jamaica'),
(552, 'America/Juneau'),
(553, 'America/Kentucky/Louisville'),
(554, 'America/Kentucky/Monticello'),
(555, 'America/Kralendijk'),
(556, 'America/La_Paz'),
(557, 'America/Lima'),
(558, 'America/Los_Angeles'),
(559, 'America/Lower_Princes'),
(560, 'America/Maceio'),
(561, 'America/Managua'),
(562, 'America/Manaus'),
(563, 'America/Marigot'),
(564, 'America/Martinique'),
(565, 'America/Matamoros'),
(566, 'America/Mazatlan'),
(567, 'America/Menominee'),
(568, 'America/Merida'),
(569, 'America/Metlakatla'),
(570, 'America/Mexico_City'),
(571, 'America/Miquelon'),
(572, 'America/Moncton'),
(573, 'America/Monterrey'),
(574, 'America/Montevideo'),
(575, 'America/Montserrat'),
(576, 'America/Nassau'),
(577, 'America/New_York'),
(578, 'America/Nipigon'),
(579, 'America/Nome'),
(580, 'America/Noronha'),
(581, 'America/North_Dakota/Beulah'),
(582, 'America/North_Dakota/Center'),
(583, 'America/North_Dakota/New_Salem'),
(584, 'America/Nuuk'),
(585, 'America/Ojinaga'),
(586, 'America/Panama'),
(587, 'America/Pangnirtung'),
(588, 'America/Paramaribo'),
(589, 'America/Phoenix'),
(590, 'America/Port-au-Prince'),
(591, 'America/Port_of_Spain'),
(592, 'America/Porto_Velho'),
(593, 'America/Puerto_Rico'),
(594, 'America/Punta_Arenas'),
(595, 'America/Rainy_River'),
(596, 'America/Rankin_Inlet'),
(597, 'America/Recife'),
(598, 'America/Regina'),
(599, 'America/Resolute'),
(600, 'America/Rio_Branco'),
(601, 'America/Santarem'),
(602, 'America/Santiago'),
(603, 'America/Santo_Domingo'),
(604, 'America/Sao_Paulo'),
(605, 'America/Scoresbysund'),
(606, 'America/Sitka'),
(607, 'America/St_Barthelemy'),
(608, 'America/St_Johns'),
(609, 'America/St_Kitts'),
(610, 'America/St_Lucia'),
(611, 'America/St_Thomas'),
(612, 'America/St_Vincent'),
(613, 'America/Swift_Current'),
(614, 'America/Tegucigalpa'),
(615, 'America/Thule'),
(616, 'America/Thunder_Bay'),
(617, 'America/Tijuana'),
(618, 'America/Toronto'),
(619, 'America/Tortola'),
(620, 'America/Vancouver'),
(621, 'America/Whitehorse'),
(622, 'America/Winnipeg'),
(623, 'America/Yakutat'),
(624, 'America/Yellowknife'),
(625, 'Antarctica/Casey'),
(626, 'Antarctica/Davis'),
(627, 'Antarctica/DumontDUrville'),
(628, 'Antarctica/Macquarie'),
(629, 'Antarctica/Mawson'),
(630, 'Antarctica/McMurdo'),
(631, 'Antarctica/Palmer'),
(632, 'Antarctica/Rothera'),
(633, 'Antarctica/Syowa'),
(634, 'Antarctica/Troll'),
(635, 'Antarctica/Vostok'),
(636, 'Arctic/Longyearbyen'),
(637, 'Asia/Aden'),
(638, 'Asia/Almaty'),
(639, 'Asia/Amman'),
(640, 'Asia/Anadyr'),
(641, 'Asia/Aqtau'),
(642, 'Asia/Aqtobe'),
(643, 'Asia/Ashgabat'),
(644, 'Asia/Atyrau'),
(645, 'Asia/Baghdad'),
(646, 'Asia/Bahrain'),
(647, 'Asia/Baku'),
(648, 'Asia/Bangkok'),
(649, 'Asia/Barnaul'),
(650, 'Asia/Beirut'),
(651, 'Asia/Bishkek'),
(652, 'Asia/Brunei'),
(653, 'Asia/Chita'),
(654, 'Asia/Choibalsan'),
(655, 'Asia/Colombo'),
(656, 'Asia/Damascus'),
(657, 'Asia/Dhaka'),
(658, 'Asia/Dili'),
(659, 'Asia/Dubai'),
(660, 'Asia/Dushanbe'),
(661, 'Asia/Famagusta'),
(662, 'Asia/Gaza'),
(663, 'Asia/Hebron'),
(664, 'Asia/Ho_Chi_Minh'),
(665, 'Asia/Hong_Kong'),
(666, 'Asia/Hovd'),
(667, 'Asia/Irkutsk'),
(668, 'Asia/Jakarta'),
(669, 'Asia/Jayapura'),
(670, 'Asia/Jerusalem'),
(671, 'Asia/Kabul'),
(672, 'Asia/Kamchatka'),
(673, 'Asia/Karachi'),
(674, 'Asia/Kathmandu'),
(675, 'Asia/Khandyga'),
(676, 'Asia/Kolkata'),
(677, 'Asia/Krasnoyarsk'),
(678, 'Asia/Kuala_Lumpur'),
(679, 'Asia/Kuching'),
(680, 'Asia/Kuwait'),
(681, 'Asia/Macau'),
(682, 'Asia/Magadan'),
(683, 'Asia/Makassar'),
(684, 'Asia/Manila'),
(685, 'Asia/Muscat'),
(686, 'Asia/Nicosia'),
(687, 'Asia/Novokuznetsk'),
(688, 'Asia/Novosibirsk'),
(689, 'Asia/Omsk'),
(690, 'Asia/Oral'),
(691, 'Asia/Phnom_Penh'),
(692, 'Asia/Pontianak'),
(693, 'Asia/Pyongyang'),
(694, 'Asia/Qatar'),
(695, 'Asia/Qostanay'),
(696, 'Asia/Qyzylorda'),
(697, 'Asia/Riyadh'),
(698, 'Asia/Sakhalin'),
(699, 'Asia/Samarkand'),
(700, 'Asia/Seoul'),
(701, 'Asia/Shanghai'),
(702, 'Asia/Singapore'),
(703, 'Asia/Srednekolymsk'),
(704, 'Asia/Taipei'),
(705, 'Asia/Tashkent'),
(706, 'Asia/Tbilisi'),
(707, 'Asia/Tehran'),
(708, 'Asia/Thimphu'),
(709, 'Asia/Tokyo'),
(710, 'Asia/Tomsk'),
(711, 'Asia/Ulaanbaatar'),
(712, 'Asia/Urumqi'),
(713, 'Asia/Ust-Nera'),
(714, 'Asia/Vientiane'),
(715, 'Asia/Vladivostok'),
(716, 'Asia/Yakutsk'),
(717, 'Asia/Yangon'),
(718, 'Asia/Yekaterinburg'),
(719, 'Asia/Yerevan'),
(720, 'Atlantic/Azores'),
(721, 'Atlantic/Bermuda'),
(722, 'Atlantic/Canary'),
(723, 'Atlantic/Cape_Verde'),
(724, 'Atlantic/Faroe'),
(725, 'Atlantic/Madeira'),
(726, 'Atlantic/Reykjavik'),
(727, 'Atlantic/South_Georgia'),
(728, 'Atlantic/St_Helena'),
(729, 'Atlantic/Stanley'),
(730, 'Australia/Adelaide'),
(731, 'Australia/Brisbane'),
(732, 'Australia/Broken_Hill'),
(733, 'Australia/Darwin'),
(734, 'Australia/Eucla'),
(735, 'Australia/Hobart'),
(736, 'Australia/Lindeman'),
(737, 'Australia/Lord_Howe'),
(738, 'Australia/Melbourne'),
(739, 'Australia/Perth'),
(740, 'Australia/Sydney'),
(741, 'Europe/Amsterdam'),
(742, 'Europe/Andorra'),
(743, 'Europe/Astrakhan'),
(744, 'Europe/Athens'),
(745, 'Europe/Belgrade'),
(746, 'Europe/Berlin'),
(747, 'Europe/Bratislava'),
(748, 'Europe/Brussels'),
(749, 'Europe/Bucharest'),
(750, 'Europe/Budapest'),
(751, 'Europe/Busingen'),
(752, 'Europe/Chisinau'),
(753, 'Europe/Copenhagen'),
(754, 'Europe/Dublin'),
(755, 'Europe/Gibraltar'),
(756, 'Europe/Guernsey'),
(757, 'Europe/Helsinki'),
(758, 'Europe/Isle_of_Man'),
(759, 'Europe/Istanbul'),
(760, 'Europe/Jersey'),
(761, 'Europe/Kaliningrad'),
(762, 'Europe/Kiev'),
(763, 'Europe/Kirov'),
(764, 'Europe/Lisbon'),
(765, 'Europe/Ljubljana'),
(766, 'Europe/London'),
(767, 'Europe/Luxembourg'),
(768, 'Europe/Madrid'),
(769, 'Europe/Malta'),
(770, 'Europe/Mariehamn'),
(771, 'Europe/Minsk'),
(772, 'Europe/Monaco'),
(773, 'Europe/Moscow'),
(774, 'Europe/Oslo'),
(775, 'Europe/Paris'),
(776, 'Europe/Podgorica'),
(777, 'Europe/Prague'),
(778, 'Europe/Riga'),
(779, 'Europe/Rome'),
(780, 'Europe/Samara'),
(781, 'Europe/San_Marino'),
(782, 'Europe/Sarajevo'),
(783, 'Europe/Saratov'),
(784, 'Europe/Simferopol'),
(785, 'Europe/Skopje'),
(786, 'Europe/Sofia'),
(787, 'Europe/Stockholm'),
(788, 'Europe/Tallinn'),
(789, 'Europe/Tirane'),
(790, 'Europe/Ulyanovsk'),
(791, 'Europe/Uzhgorod'),
(792, 'Europe/Vaduz'),
(793, 'Europe/Vatican'),
(794, 'Europe/Vienna'),
(795, 'Europe/Vilnius'),
(796, 'Europe/Volgograd'),
(797, 'Europe/Warsaw'),
(798, 'Europe/Zagreb'),
(799, 'Europe/Zaporozhye'),
(800, 'Europe/Zurich'),
(801, 'Indian/Antananarivo'),
(802, 'Indian/Chagos'),
(803, 'Indian/Christmas'),
(804, 'Indian/Cocos'),
(805, 'Indian/Comoro'),
(806, 'Indian/Kerguelen'),
(807, 'Indian/Mahe'),
(808, 'Indian/Maldives'),
(809, 'Indian/Mauritius'),
(810, 'Indian/Mayotte'),
(811, 'Indian/Reunion'),
(812, 'Pacific/Apia'),
(813, 'Pacific/Auckland'),
(814, 'Pacific/Bougainville'),
(815, 'Pacific/Chatham'),
(816, 'Pacific/Chuuk'),
(817, 'Pacific/Easter'),
(818, 'Pacific/Efate'),
(819, 'Pacific/Fakaofo'),
(820, 'Pacific/Fiji'),
(821, 'Pacific/Funafuti'),
(822, 'Pacific/Galapagos'),
(823, 'Pacific/Gambier'),
(824, 'Pacific/Guadalcanal'),
(825, 'Pacific/Guam'),
(826, 'Pacific/Honolulu'),
(827, 'Pacific/Kanton'),
(828, 'Pacific/Kiritimati'),
(829, 'Pacific/Kosrae'),
(830, 'Pacific/Kwajalein'),
(831, 'Pacific/Majuro'),
(832, 'Pacific/Marquesas'),
(833, 'Pacific/Midway'),
(834, 'Pacific/Nauru'),
(835, 'Pacific/Niue'),
(836, 'Pacific/Norfolk'),
(837, 'Pacific/Noumea'),
(838, 'Pacific/Pago_Pago'),
(839, 'Pacific/Palau'),
(840, 'Pacific/Pitcairn'),
(841, 'Pacific/Pohnpei'),
(842, 'Pacific/Port_Moresby'),
(843, 'Pacific/Rarotonga'),
(844, 'Pacific/Saipan'),
(845, 'Pacific/Tahiti'),
(846, 'Pacific/Tarawa'),
(847, 'Pacific/Tongatapu'),
(848, 'Pacific/Wake'),
(849, 'Pacific/Wallis'),
(850, 'UTC');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_provider` enum('paypal','stripe') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` float(13,2) NOT NULL DEFAULT '0.00',
  `payment_status` int DEFAULT NULL COMMENT '1=paid,0=unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `transaction_number`, `payment_provider`, `user_id`, `amount`, `payment_status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '1', '61J86552R62091255', 'paypal', 9, 470.00, 1, '2023-05-17 20:08:06', '2023-05-17 20:08:06', 9, 9),
(2, '2', '3XJ49122GW6036226', 'paypal', 8, 2524.00, 1, '2023-05-17 20:22:18', '2023-05-17 20:22:18', 8, 8),
(3, '3', 'ch_3PpfjlK602rFquMz1o3eBLoK', 'stripe', 2, 480.00, 1, '2024-08-19 18:15:50', '2024-08-19 18:15:50', 2, 2),
(4, '4', 'ch_3PpfkYK602rFquMz0G18U46G', 'stripe', 2, 480.00, 1, '2024-08-19 18:16:38', '2024-08-19 18:16:38', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int NOT NULL,
  `transaction_id` int DEFAULT NULL,
  `seller_id` int NOT NULL,
  `order_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `shipping_charge` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `admin_commission` decimal(13,2) DEFAULT '0.00',
  `seller_total` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `seller_id`, `order_id`, `amount`, `shipping_charge`, `created_at`, `updated_at`, `created_by`, `updated_by`, `admin_commission`, `seller_total`) VALUES
(1, 1, 3, 1, '460.00', 10, '2023-05-17 20:08:06', '2023-05-17 20:08:06', 9, 9, '0.00', NULL),
(2, 2, 2, 2, '2514.00', 10, '2023-05-17 20:22:18', '2023-05-17 20:22:18', 8, 8, '0.00', NULL),
(3, 4, 3, 4, '470.00', 10, '2024-08-19 18:16:38', '2024-08-19 18:16:38', 2, 2, '25.85', '454.15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` timestamp NULL DEFAULT NULL,
  `location` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/image/default-user.png',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_seen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `user_mode` int NOT NULL DEFAULT '0' COMMENT '0 = Buyer, 1 = Seller',
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_request_amount` float NOT NULL DEFAULT '0',
  `total_seller_amount` float NOT NULL DEFAULT '0',
  `trusted_seller` tinyint NOT NULL DEFAULT '0',
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quick_responder` tinyint NOT NULL DEFAULT '0',
  `show_phone` int NOT NULL DEFAULT '0',
  `coupons` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `gender`, `dob`, `location`, `email_verified_at`, `password`, `web`, `image`, `token`, `last_seen`, `remember_token`, `created_at`, `updated_at`, `auth_type`, `user_mode`, `provider`, `provider_id`, `fcm_token`, `withdraw_request_amount`, `total_seller_amount`, `trusted_seller`, `bio`, `quick_responder`, `show_phone`, `coupons`) VALUES
(1, 'Maidul', 'maidul.tech', 'maidul.tech1@gmail.com', '01688896341', 'Male', '1990-05-01 05:00:00', NULL, NULL, '$2y$10$xybsAJk6gxakwhEFY3o.DuCfx0qnCgUFZMw2AuKZ9c9GfiClPTUwK', NULL, 'backend/image/default-user.png', NULL, '2023-05-17 14:36:52', NULL, '2023-05-17 19:26:08', '2023-05-17 19:36:52', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(2, 'rabin21', 'rabin21', 'rabin21@gmail.com', '01990572321', 'Male', '2023-05-01 05:00:00', NULL, NULL, '$2y$10$BYREbpxX5eg39clwTTYSSezuzYuZMpyYKdVme45MCet8wXk97aHI2', NULL, 'backend/image/default-user.png', NULL, '2024-08-20 00:19:23', NULL, '2023-05-17 19:27:17', '2024-08-19 18:19:23', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(3, 'Rony', 'ronymia.tech', 'ronymia.tech@gmail.com', '01757574466', 'Male', '1999-02-05 06:00:00', NULL, NULL, '$2y$10$ChL0m3lIxfqrilcMXvyWF.CdSaH7PtrFh5rTV0TNK.XMfUFqzlz.6', NULL, 'uploads/customer/1684333748_6464e4b486265.png', NULL, '2023-05-17 15:29:43', NULL, '2023-05-17 19:28:12', '2023-05-17 20:29:43', 'email', 1, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(4, 'Wendy Morse', 'test', 'test@gmail.com', '+1 (577) 993-4313', 'Female', '1993-12-31 06:00:00', NULL, NULL, '$2y$10$KpCBvVorIGFmoB3viXRE6O6EdSMVXeCM/K7wDOtZC18wMUlGb1xQa', NULL, 'backend/image/default-user.png', NULL, '2023-05-17 14:42:29', NULL, '2023-05-17 19:37:21', '2023-05-17 19:42:29', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(5, 'Zephr Short', 'maidul.tech', 'maidul.tech2@gmail.com', '+1 (754) 225-2211', 'Male', '1973-02-02 06:00:00', NULL, NULL, '$2y$10$5DP2lSPSB2LRgrYVRo.hveDyqo2tsMoCAgWKb8QVd.n194ecqolKS', NULL, 'backend/image/default-user.png', NULL, NULL, NULL, '2023-05-17 19:42:29', '2023-05-17 19:42:29', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(6, 'Harper Ellison', 'maidul.tech', 'maidul.tech3@gmail.com', '016811199944', 'Male', '2015-07-02 05:00:00', NULL, NULL, '$2y$10$IS3omeCCl0nC.Nl6XZy52.RCjSzd1R3IPN0KGobx1/An2sAUmrYcG', NULL, 'backend/image/default-user.png', NULL, '2023-05-17 14:48:11', NULL, '2023-05-17 19:46:03', '2023-05-17 19:48:11', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(7, 'maidul', 'maidul.tech', 'maidul.tech4@gmail.com', '0166664445', NULL, '2023-05-17 05:00:00', NULL, NULL, '$2y$10$oCOFdUEnEiUy8Q7wM7BEpeTojFug5bTUFr9HUoTG5Tu5NFhv8NxXa', NULL, 'backend/image/default-user.png', NULL, '2023-05-17 14:50:59', NULL, '2023-05-17 19:48:11', '2023-05-17 19:50:59', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(8, 'maidul', 'maidul.tech', 'maidul.tech@gmail.com', '0165555', NULL, '2023-05-17 05:00:00', NULL, NULL, '$2y$10$wP7AGUhna1jrV9ExWpGKDOwQsfwgQc2dghPqZ8C79d1umgK7Ed7Ki', NULL, 'assets/images/default-user.png', NULL, '2023-05-17 15:33:23', NULL, '2023-05-17 19:51:20', '2023-05-17 20:33:23', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(9, 'Razu', 'razu', 'razu@gmail.com', '01545451122', 'Male', '2022-07-07 05:00:00', NULL, '2023-05-17 20:05:41', '$2y$10$2QRCVjw548Kh7p0J4a09gOyu6hFoQan8eI4Ed0MDRw346PROMAfBe', NULL, 'assets/images/default-user.png', NULL, '2023-05-17 15:11:09', NULL, '2023-05-17 20:05:39', '2023-05-17 20:11:09', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL),
(10, 'Mokaddes', 'mokaddes', 'mokaddes@gmail.com', '0175099654654', NULL, NULL, NULL, NULL, '$2y$10$KjdPKzp.cxGCKpaVN1ONNuZbb7OjgwjUswvKjEHcoZKTuptLA6h.i', NULL, 'assets/images/default-user.png', NULL, '2024-07-24 07:07:40', NULL, '2024-07-22 22:12:27', '2024-07-24 01:07:40', 'email', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_cards`
--

CREATE TABLE `user_cards` (
  `id` int NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `user_id` bigint NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `cvc` varchar(25) NOT NULL,
  `exp_month` int NOT NULL,
  `exp_year` int NOT NULL,
  `zip_code` int DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_cards`
--

INSERT INTO `user_cards` (`id`, `card_name`, `user_id`, `card_type`, `card_number`, `cvc`, `exp_month`, `exp_year`, `zip_code`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rony Mia', 3, 'Visa', '4242424242424242', '123', 4, 2025, NULL, NULL, 0, '2023-05-17 19:31:23', '2023-05-17 19:31:23'),
(2, 'Mim', 8, 'Visa', '4242424242424242', '123', 12, 2024, NULL, NULL, 0, '2023-05-17 20:24:27', '2023-05-17 20:24:27'),
(3, 'MOkaddes hosain', 2, 'Visa', '4242424242424242', '200', 12, 2027, NULL, NULL, 0, '2024-08-19 18:14:29', '2024-08-19 18:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_device_tokens`
--

CREATE TABLE `user_device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `device_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_shops`
--

CREATE TABLE `user_shops` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `return_policy` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_shops`
--

INSERT INTO `user_shops` (`id`, `user_id`, `name`, `slug`, `logo`, `banner`, `location`, `status`, `return_policy`, `created_at`, `updated_at`) VALUES
(1, 2, 'ABC Shop', 'abc-shop', 'uploads/logo/1724111847_66c3dbe7504cc.png', 'uploads/banner/1724111847_66c3dbe750d83.jpeg', 'Dhaka', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-05-17 19:34:45', '2024-08-19 17:57:27'),
(2, 3, 'Best Shoes', 'best-shoes', 'uploads/logo/1684334356_6464e714ac842.png', NULL, 'House #21, Road #17, Block-C, Banani-1213, Dhaka', 1, NULL, '2023-05-17 19:39:16', '2023-05-17 19:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `ad_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `ad_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 3, '2023-05-17 19:51:21', '2023-05-17 19:51:21'),
(2, 3, 9, '2023-05-17 20:05:44', '2023-05-17 20:05:44'),
(3, 10, 2, '2024-08-19 18:18:29', '2024-08-19 18:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` int NOT NULL,
  `seller_id` int NOT NULL,
  `amount` float(14,2) NOT NULL DEFAULT '0.00',
  `withdraw_request_date` datetime NOT NULL,
  `approved_date` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL COMMENT '0=request,1=approved',
  `screenshoot` varchar(255) NOT NULL,
  `payment_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `withdraw_requests`
--
DELIMITER $$
CREATE TRIGGER `after_withdraw_requests_insert` AFTER INSERT ON `withdraw_requests` FOR EACH ROW begin

	declare var_amount float default 0;
 	select sum(amount) into var_amount from withdraw_requests where seller_id = new.seller_id;

 	update users set withdraw_request_amount = var_amount where id = new.seller_id;


end
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_searches`
--
ALTER TABLE `admin_searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ads_user_id_foreign` (`user_id`),
  ADD KEY `ads_category_id_foreign` (`category_id`);

--
-- Indexes for table `ads_attrs`
--
ALTER TABLE `ads_attrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads_tags`
--
ALTER TABLE `ads_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_galleries`
--
ALTER TABLE `ad_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_custom_field`
--
ALTER TABLE `category_custom_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_custom_field_category_id_foreign` (`category_id`),
  ADD KEY `category_custom_field_custom_field_id_foreign` (`custom_field_id`);

--
-- Indexes for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_categories_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_helps`
--
ALTER TABLE `contact_helps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_fields_custom_field_group_id_foreign` (`custom_field_group_id`);

--
-- Indexes for table `custom_field_groups`
--
ALTER TABLE `custom_field_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_field_values_custom_field_id_foreign` (`custom_field_id`);

--
-- Indexes for table `database_backups`
--
ALTER TABLE `database_backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_faq_category_id_foreign` (`faq_category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_categories_name_unique` (`name`),
  ADD UNIQUE KEY `faq_categories_slug_unique` (`slug`);

--
-- Indexes for table `help_reasons`
--
ALTER TABLE `help_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_purchases`
--
ALTER TABLE `item_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD UNIQUE KEY `languages_icon_unique` (`icon`);

--
-- Indexes for table `messengers`
--
ALTER TABLE `messengers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_app_configs`
--
ALTER TABLE `mobile_app_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_app_sliders`
--
ALTER TABLE `mobile_app_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `module_settings`
--
ALTER TABLE `module_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_author_id_foreign` (`author_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_custom_fields`
--
ALTER TABLE `product_custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_custom_fields_ad_id_foreign` (`ad_id`),
  ADD KEY `product_custom_fields_custom_field_id_foreign` (`custom_field_id`),
  ADD KEY `product_custom_fields_custom_field_group_id_foreign` (`custom_field_group_id`);

--
-- Indexes for table `recent_view_ads`
--
ALTER TABLE `recent_view_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_report_from_id_foreign` (`report_from_id`),
  ADD KEY `reports_report_to_id_foreign` (`report_to_id`);

--
-- Indexes for table `requested_products`
--
ALTER TABLE `requested_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_guides`
--
ALTER TABLE `setup_guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shiping_locations`
--
ALTER TABLE `shiping_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_media_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_web_unique` (`web`);

--
-- Indexes for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_user_id` (`user_id`);

--
-- Indexes for table `user_device_tokens`
--
ALTER TABLE `user_device_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_device_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_shops`
--
ALTER TABLE `user_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_ad_id_foreign` (`ad_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_searches`
--
ALTER TABLE `admin_searches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ads_attrs`
--
ALTER TABLE `ads_attrs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ads_tags`
--
ALTER TABLE `ads_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_galleries`
--
ALTER TABLE `ad_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_custom_field`
--
ALTER TABLE `category_custom_field`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `child_categories`
--
ALTER TABLE `child_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_helps`
--
ALTER TABLE `contact_helps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_field_groups`
--
ALTER TABLE `custom_field_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `database_backups`
--
ALTER TABLE `database_backups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `help_reasons`
--
ALTER TABLE `help_reasons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_purchases`
--
ALTER TABLE `item_purchases`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messengers`
--
ALTER TABLE `messengers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `mobile_app_configs`
--
ALTER TABLE `mobile_app_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobile_app_sliders`
--
ALTER TABLE `mobile_app_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_settings`
--
ALTER TABLE `module_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_custom_fields`
--
ALTER TABLE `product_custom_fields`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recent_view_ads`
--
ALTER TABLE `recent_view_ads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requested_products`
--
ALTER TABLE `requested_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setup_guides`
--
ALTER TABLE `setup_guides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shiping_locations`
--
ALTER TABLE `shiping_locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=851;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_cards`
--
ALTER TABLE `user_cards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_device_tokens`
--
ALTER TABLE `user_device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_shops`
--
ALTER TABLE `user_shops`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

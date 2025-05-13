-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 05:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartphone`
--

-- --------------------------------------------------------

--
-- Table structure for table `add`
--

CREATE TABLE `add` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `add` varchar(255) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `gender` int(20) NOT NULL,
  `total_price` int(240) NOT NULL,
  `quantity_total_price` int(255) NOT NULL,
  `gst_item_total` int(255) NOT NULL,
  `final_item_total` int(255) NOT NULL,
  `orderno` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add`
--

INSERT INTO `add` (`id`, `add`, `mobileno`, `gender`, `total_price`, `quantity_total_price`, `gst_item_total`, `final_item_total`, `orderno`, `created_at`, `updated_at`) VALUES
(3, '7', '1234567890', 2, 50000, 100000, 10000, 105000, 'po/1', '2025-05-11 08:26:07', '2025-05-11 08:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `addsells`
--

CREATE TABLE `addsells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `add` varchar(255) NOT NULL,
  `total_price` int(255) NOT NULL,
  `quantity_total_price` int(255) NOT NULL,
  `gst_item_total` int(200) NOT NULL,
  `final_item_total` int(240) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'iPhones', NULL, NULL),
(2, 'Android Phones', NULL, NULL),
(3, 'Laptop', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Company_Name` varchar(255) NOT NULL,
  `Company_Email` varchar(255) NOT NULL,
  `Company_Address` varchar(255) NOT NULL,
  `Company_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `Company_Name`, `Company_Email`, `Company_Address`, `Company_number`, `created_at`, `updated_at`) VALUES
(1, 'raji', 'raji@email', 'ramnagar,rajkot', 565558954, '2024-09-18 06:16:26', '2024-09-18 06:16:26'),
(2, 'ritik', 'ritik@gmail.com', 'red park,krij', 632632542, '2025-03-13 00:23:17', '2025-03-13 00:23:17'),
(3, 'bit', 'b@gmail.com', 'red park,krij', 562562341, '2025-03-25 02:49:08', '2025-03-25 02:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `address`, `country`, `state`, `city`, `postal_code`, `created_at`, `updated_at`) VALUES
(1, 'green park,rajkot', 'india', 'gujrat', 'rajkot', 360002, NULL, NULL),
(2, 'red park,krij', 'india', 'gujarat', 'rajkot', 360002, '2024-09-19 04:51:49', '2024-09-19 04:51:49'),
(3, 'fir', 'india', 'gujarat', 'rajkot', 360002, '2024-09-19 05:15:21', '2024-09-19 05:21:37'),
(4, 'red park,krij', 'india', 'gujarat', 'rajkot', 360002, '2025-03-25 02:48:10', '2025-03-25 02:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageid` int(11) NOT NULL,
  `imagename` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `imageid`, `imagename`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'sunflower', '1726659986_p3.jpg', '2024-09-18 06:16:26', '2024-09-18 06:16:26'),
(2, 2, 'cat', '1741845197_p4.jpg', '2025-03-13 00:23:17', '2025-03-13 00:23:17'),
(3, 3, 'sunflower', '1742890748_p3.jpg', '2025-03-25 02:49:08', '2025-03-25 02:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `inventorys`
--

CREATE TABLE `inventorys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `used` int(20) NOT NULL,
  `actul_stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventorys`
--

INSERT INTO `inventorys` (`id`, `product_id`, `stock`, `used`, `actul_stock`, `created_at`, `updated_at`) VALUES
(2, 1, 10, 3, 7, '2025-05-11 08:11:50', '2025-05-11 08:13:23'),
(3, 6, 2, 0, 2, '2025-05-11 08:26:07', '2025-05-11 08:26:07');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2024_08_17_091027_create_products_table', 2),
(4, '2024_08_21_092850_create_categories_table', 3),
(5, '2024_08_21_112444_create_customers_table', 4),
(6, '2024_09_10_121922_create_images_table', 5),
(7, '2024_09_18_111646_contactmigration', 5),
(8, '2024_09_18_113157_create_products1_table', 6),
(9, '2024_06_10_065753_add', 7),
(10, '2024_09_18_103138_create_orders_table_v2', 7),
(11, '2024_09_19_112632_inventory', 8),
(12, '2024_09_23_092753_create_sells_table', 9),
(13, '2024_09_23_093834_create_addsells_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addid` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `itempricetotal` int(20) NOT NULL,
  `gst` int(20) NOT NULL,
  `gst_total` int(20) NOT NULL,
  `discount` int(20) NOT NULL,
  `discount_amount` int(20) NOT NULL,
  `final_total` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `addid`, `item_name`, `price`, `quantity`, `itempricetotal`, `gst`, `gst_total`, `discount`, `discount_amount`, `final_total`, `created_at`, `updated_at`) VALUES
(5, 3, '6', 50000, 2, 100000, 10, 10000, 5, 5000, 105000, '2025-05-11 08:26:07', '2025-05-11 08:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'samsung', 'Full hd display', 1500, '1742878613.png', 2, '2025-03-13 05:09:14', '2025-05-11 06:33:52'),
(2, 'oppo', '64 mp camera,Hd Display', 10000, '1742878251.png', 2, '2025-03-13 05:23:29', '2025-03-24 23:20:51'),
(6, 'iphone 13', 'test', 50000, NULL, 1, '2025-05-11 08:24:30', '2025-05-11 08:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sellid` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `itempricetotal` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `gst` int(255) NOT NULL,
  `gst_total` int(255) NOT NULL,
  `discount` int(255) NOT NULL,
  `discount_amount` int(255) NOT NULL,
  `final_total` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `status` int(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `show_password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobileno`, `status`, `email_verified_at`, `gender`, `image`, `password`, `show_password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'company', 'company@gmail.com', '7867896596', 0, NULL, NULL, NULL, '$2y$10$dPKFF9JIOe5YIrOJTNlRC.gEtrHkYJ0dYpQivZoPJ71Af3kp4sPtu', NULL, NULL, NULL, NULL),
(2, 'max', 's@gmail.com', '5625632132', 0, NULL, '1', '1727354755.jpg', '$2y$10$tGLqGLx/TmAZ.vso8uBf1eqxqnqtiSnOej1wN8Lg0noWkQQNQ42EC', NULL, NULL, '2024-09-26 07:15:55', '2024-09-26 07:15:55'),
(3, 'fix', 'f@gmail.com', '5625256251', 1, NULL, '1', '1727861230.jpg', '$2y$10$iyLn.Mc6VVUlrIrYdvl/v.px9o49BstCHR302IWrXw6.jqcmCpDEq', NULL, NULL, '2024-10-02 03:57:10', '2024-10-07 06:32:52'),
(4, 'parth', 'p@gmail.com', '9629636263', 1, NULL, '1', '1727951860.jpg', '$2y$10$dbMtbBe7xM5v2QNdg5Kl4ecQ2DXuJklUyAvKkw0ysqU6CWJ4k9vGm', NULL, NULL, '2024-10-03 05:07:40', '2024-10-07 05:53:53'),
(5, 'ram', 'r@gmail.com', '9639363692', 1, NULL, '1', '1742880698.jpg', '$2y$10$aqhg55kJguJoL5XliLpk0uLvpHVRzlgUNFUPvXjNkg3utIQkuOE4K', NULL, NULL, '2025-03-25 00:01:38', '2025-03-25 00:07:05'),
(6, 'lux', 'l@gmail.com', '2652652652', 1, NULL, '1', '1742890589.jpg', '$2y$10$cuXN2bO/O/JZK4Je/YqZyOu2lBY2vRTrr6lseQg5j.az2dIp6/HU.', NULL, NULL, '2025-03-25 02:46:29', '2025-05-11 07:45:07'),
(7, 'nir', 'nir@gmail.com', '1234567890', NULL, NULL, '2', NULL, '$2y$10$lU6/t8fmRaxL9kvkDorBe.b2lIlr0w/xC1phWdrKv4pbFRZtZHqFC', NULL, NULL, '2025-05-11 08:21:37', '2025-05-11 08:21:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add`
--
ALTER TABLE `add`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addsells`
--
ALTER TABLE `addsells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorys`
--
ALTER TABLE `inventorys`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
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
-- AUTO_INCREMENT for table `add`
--
ALTER TABLE `add`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addsells`
--
ALTER TABLE `addsells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventorys`
--
ALTER TABLE `inventorys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

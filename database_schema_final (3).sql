-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 04:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_schema_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `slug`, `description`, `image_url`, `parent_category_id`, `is_popular`, `created_at`) VALUES
(1, 'Electronics', 'electronics', NULL, NULL, NULL, 0, '2025-04-30 15:04:28'),
(2, 'Fashion', 'fashion', NULL, NULL, NULL, 0, '2025-04-30 15:04:28'),
(3, 'Home & kitchen', 'home-kitchen', NULL, NULL, NULL, 0, '2025-04-30 15:04:28'),
(4, 'Vehicles', 'vehicles', NULL, NULL, NULL, 0, '2025-04-30 15:04:28'),
(5, 'Mobiles', 'mobiles', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(6, 'Tvs', 'tvs', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(7, 'Computers', 'computers', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(8, 'Accessories', 'accessories', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(9, 'Tablets', 'tablets', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(10, 'Cameras', 'cameras', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(11, 'Headphones', 'headphones', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(12, 'Smart Watches', 'smart-watches', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(13, 'Gaming', 'gaming', NULL, NULL, 1, 0, '2025-04-30 15:04:56'),
(14, 'Men\'s Wear', 'mens-wear', NULL, NULL, 2, 0, '2025-04-30 15:04:56'),
(15, 'Women\'s Wear', 'womens-wear', NULL, NULL, 2, 0, '2025-04-30 15:04:56'),
(16, 'Kids', 'kids', NULL, NULL, 2, 0, '2025-04-30 15:04:56'),
(17, 'Electric-ovens', 'electric-ovens', NULL, NULL, 3, 0, '2025-04-30 15:04:56'),
(18, 'Microwaves', 'microwaves', NULL, NULL, 3, 0, '2025-04-30 15:04:56'),
(19, 'Refrigerators', 'refrigerators', NULL, NULL, 3, 0, '2025-04-30 15:04:56'),
(20, 'Air-conditioners', 'air-conditioners', NULL, NULL, 3, 0, '2025-04-30 15:04:56'),
(21, 'Water-heaters', 'water-heaters', NULL, NULL, 3, 0, '2025-04-30 15:04:56'),
(22, 'Fans', 'fans', NULL, NULL, 3, 0, '2025-04-30 15:04:56'),
(23, 'cars', 'cars', NULL, NULL, 4, 0, '2025-04-30 15:04:56'),
(24, 'motors', 'motors', NULL, NULL, 4, 0, '2025-04-30 15:04:56'),
(25, 'bicycles', 'bicycles', NULL, NULL, 4, 0, '2025-04-30 15:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `deal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `discount_tag` varchar(50) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `target_type` enum('category','product','all','custom') DEFAULT 'custom',
  `target_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `title`, `subtitle`, `description`, `discount_tag`, `starting_price`, `image_url`, `link_url`, `start_date`, `end_date`, `is_active`, `target_type`, `target_id`, `created_at`) VALUES
(1, 'Buy One Get One Free', 'Special offer on fashion items', 'Buy one item and get another for free!', 'BOGO', 39.99, 'bogo-deal.jpg', '/category/fashion', '2025-05-01 00:00:00', '2025-05-31 23:59:59', 1, 'category', 10, '2025-04-30 07:30:00'),
(2, '50% Off on Electronics', 'Massive discount on all electronics', 'Get 50% off on all electronics this month!', '50% OFF', 299.99, 'electronics-sale.jpg', '/category/electronics', '2025-05-01 00:00:00', '2025-05-31 23:59:59', 1, 'category', 1, '2025-04-30 07:35:00'),
(3, 'Buy 2 Get 1 Free', 'Special offer on shoes and accessories', 'Buy two items and get a third one for free!', 'BOGO', 49.99, 'buy-2-get-1.jpg', '/category/shoes-accessories', '2025-05-01 00:00:00', '2025-05-31 23:59:59', 1, 'category', 15, '2025-04-30 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `rating` decimal(3,2) DEFAULT 0.00,
  `image_url_default` varchar(255) DEFAULT NULL,
  `image_url_hover` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_popular` tinyint(1) DEFAULT 0,
  `is_new` tinyint(1) DEFAULT 0,
  `badge_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_arrival` tinyint(1) DEFAULT 0,
  `is_hot` tinyint(1) DEFAULT 0,
  `is_trendy` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category_id`, `price`, `old_price`, `sku`, `stock_quantity`, `rating`, `image_url_default`, `image_url_hover`, `is_featured`, `is_popular`, `is_new`, `badge_id`, `created_at`, `updated_at`, `is_arrival`, `is_hot`, `is_trendy`) VALUES
(1, 'X1 Laptop', 'High performance gaming laptop', 2, 1499.99, 1699.99, 'LP-X1-2024', 50, 4.80, 'laptop-x1-default.jpg', 'laptop-x1-hover.jpg', 1, 1, 0, 1, '2025-04-30 06:37:57', '2025-04-30 16:22:27', 0, 1, 0),
(2, 'Wireless Headphones', 'Noise-cancelling wireless headphones', 1, 199.99, NULL, 'WH-2024', 100, 4.50, 'headphones-default.jpg', 'headphones-hover.jpg', 0, 1, 1, 3, '2025-04-30 06:37:57', '2025-04-30 16:22:27', 1, 0, 1),
(3, 'Men\'s Shirt', 'Cotton casual shirt', 4, 39.99, 49.99, 'SHIRT-M-01', 200, 4.20, 'shirt-default.jpg', 'shirt-hover.jpg', 1, 0, 0, 2, '2025-04-30 06:37:57', '2025-04-30 16:22:27', 0, 1, 0),
(4, 'Smartphone X2', 'A flagship smartphone with an excellent camera', 1, 699.99, 799.99, 'SP-X2-2024', 120, 4.75, 'smartphone-x2-default.jpg', 'smartphone-x2-hover.jpg', 1, 1, 0, 2, '2025-04-30 07:00:00', '2025-04-30 16:22:27', 0, 0, 1),
(5, 'Wireless Mouse', 'Ergonomic wireless mouse for productivity', 13, 29.99, NULL, 'WM-2024', 150, 4.20, 'wireless-mouse-default.jpg', 'wireless-mouse-hover.jpg', 0, 1, 1, 3, '2025-04-30 07:05:00', '2025-05-01 17:44:31', 0, 1, 0),
(6, 'Electric Oven Deluxe', 'A high-quality electric oven for modern kitchens', 1, 249.99, 299.99, 'EO-DLX-2024', 80, 4.65, 'electric-oven-deluxe-default.jpg', 'electric-oven-deluxe-hover.jpg', 1, 0, 1, 2, '2025-04-30 07:10:00', '2025-05-01 13:48:46', 0, 0, 1),
(7, 'Bicycle Pro X', 'Sports bicycle for mountain and city riding', 4, 399.99, 459.99, 'BMX-PROX-2024', 60, 4.90, 'bicycle-prox-default.jpg', 'bicycle-prox-hover.jpg', 1, 1, 0, 3, '2025-04-30 07:15:00', '2025-05-01 13:56:31', 0, 0, 0),
(8, 'Winter Jacket', 'Warm and stylish winter jacket for men', 5, 79.99, 99.99, 'JKT-WN-2024', 180, 4.50, 'winter-jacket-default.jpg', 'winter-jacket-hover.jpg', 0, 1, 0, 3, '2025-04-30 07:20:00', '2025-04-30 07:20:00', 0, 0, 0),
(9, 'Fitness Tracker', 'Track your workouts and daily activity with ease', 6, 59.99, NULL, 'FT-2024', 200, 4.60, 'fitness-tracker-default.jpg', 'fitness-tracker-hover.jpg', 1, 1, 1, 1, '2025-04-30 07:25:00', '2025-04-30 07:25:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_badges`
--

CREATE TABLE `product_badges` (
  `badge_id` int(11) NOT NULL,
  `badge_text` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_badges`
--

INSERT INTO `product_badges` (`badge_id`, `badge_text`, `created_at`) VALUES
(1, 'HOT', '2025-04-30 07:40:00'),
(2, 'SALE', '2025-04-30 07:40:00'),
(3, 'NEW', '2025-04-30 07:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_type` enum('percentage','fixed_amount') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `usage_limit_per_user` int(11) DEFAULT 1,
  `min_purchase_amount` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `code`, `description`, `discount_type`, `discount_value`, `start_date`, `end_date`, `usage_limit`, `usage_limit_per_user`, `min_purchase_amount`, `is_active`, `created_at`) VALUES
(1, 'WELCOME10', 'خصم 10% للمستخدمين الجدد', 'percentage', 10.00, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 1000, 1, 50.00, 1, '2025-04-30 09:37:57'),
(2, 'FREESHIP', 'شحن مجاني للطلبات فوق 100$', 'fixed_amount', 15.00, '2024-01-01 00:00:00', '2024-12-31 23:59:59', NULL, NULL, 100.00, 1, '2025-04-30 09:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `first_name`, `last_name`, `created_at`, `last_login`) VALUES
(1, 'john_doe', 'john@example.com', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', 'John', 'Doe', '2025-04-30 09:37:57', '2024-01-15 08:00:00'),
(2, 'sara_smith', 'sara@example.com', 'fbb4a8a163ffa958b4f02bf9cabb30cfefb40de803f2c4c346a9d39b3be1b544', 'Sara', 'Smith', '2025-04-30 09:37:57', '2024-01-16 09:30:00'),
(3, 'mike_jones', 'mike@example.com', 'd6ab7a4ba46690f83961f28f7d537f4f8db309d75febd5656355561917b84cf8', 'Mike', 'Jones', '2025-04-30 09:37:57', '2024-01-17 07:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`wishlist_id`, `user_id`, `created_at`) VALUES
(1, 1, '2025-04-30 09:37:57'),
(2, 2, '2025-04-30 09:37:57'),
(3, 3, '2025-04-30 09:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
  `wishlist_item_id` int(11) NOT NULL,
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist_items`
--

INSERT INTO `wishlist_items` (`wishlist_item_id`, `wishlist_id`, `product_id`, `added_at`) VALUES
(1, 1, 2, '2025-04-30 09:37:57'),
(2, 2, 1, '2025-04-30 09:37:57'),
(3, 3, 3, '2025-04-30 09:37:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `unique_cart_product` (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_category_id` (`parent_category_id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`deal_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- Indexes for table `product_badges`
--
ALTER TABLE `product_badges`
  ADD PRIMARY KEY (`badge_id`),
  ADD UNIQUE KEY `badge_text` (`badge_text`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD PRIMARY KEY (`wishlist_item_id`),
  ADD UNIQUE KEY `unique_wishlist_product` (`wishlist_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_badges`
--
ALTER TABLE `product_badges`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `wishlist_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `product_badges` (`badge_id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_items_ibfk_1` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`wishlist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

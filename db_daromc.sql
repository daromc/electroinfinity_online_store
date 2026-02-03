-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2026 at 02:03 AM
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
-- Database: `db_daromc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`category_id`, `category_name`, `description`) VALUES
(1, 'Computers', 'High-performance workstations, servers, and advanced computing nodes for heavy workloads.'),
(2, 'Cameras', 'Professional imaging systems, high-definition surveillance, and optical sensors.'),
(3, 'Accessories', 'Essential peripherals, cables, and components for network and system integration.'),
(4, 'Headphones', 'Precision audio monitoring equipment and advanced noise-canceling communication gear.'),
(5, 'gaming', 'gaming');

-- --------------------------------------------------------

--
-- Table structure for table `categoryProduct`
--

CREATE TABLE `categoryProduct` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoryProduct`
--

INSERT INTO `categoryProduct` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `customer_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customer_id`, `user_name`, `password`, `full_name`, `email`, `address`, `admin`) VALUES
(1, 'admin', 'admin1234', 'Dario Admin', 'admin@daromc-server.com', 'Calle Principal 123', 1),
(2, 'juan_usuario', 'user1234', 'Juan Perez', 'juan@correo.com', 'Av. Central 456', 0),
(3, 'user1', 'user1234', 'user1', 'user1@gmail.com', '123 siempre viva', 0),
(4, 'user2', 'user1234', 'usuario dos', 'udos@gmail.com', 'av siempre viva ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `OrderDetails`
--

CREATE TABLE `OrderDetails` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `OrderDetails`
--

INSERT INTO `OrderDetails` (`detail_id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`) VALUES
(1, 1, 10, 1, 15.00),
(2, 2, 10, 1, 15.00),
(3, 3, 1, 1, 1200.00),
(4, 5, 5, 2, 3500.00),
(5, 6, 1, 1, 1200.00),
(6, 7, 2, 2, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`order_id`, `customer_id`, `order_date`, `total_amount`, `shipping_address`, `phone_number`) VALUES
(1, 3, '2026-02-02 18:01:44', 18.75, '123 siempre viva', '12341234'),
(2, 3, '2026-02-02 18:02:42', 18.75, '123 siempre viva', '12341234'),
(3, 3, '2026-02-02 18:09:40', 1500.00, '123 siempre viva', '12341234'),
(4, 3, '2026-02-02 18:11:47', 0.00, '123 siempre viva', '12341234'),
(5, 3, '2026-02-02 18:18:01', 8750.00, '123 siempre viva', '12341234'),
(6, 3, '2026-02-02 18:23:29', 1500.00, '123 siempre viva', '12341234'),
(7, 4, '2026-02-02 18:30:14', 1500.00, 'av siempre viva ', '12341234');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`product_id`, `product_name`, `product_description`, `product_image`, `product_price`, `product_quantity`) VALUES
(1, 'Apple MacBook Pro', 'High-performance laptop for professionals.', '../images/apple1.jpg', 1200.00, 10),
(2, 'Apple iPad Air', 'Powerful and thin tablet for creativity.', '../images/apple2.jpg', 600.00, 15),
(3, 'HP Workstation', 'Reliable desktop for engineering tasks.', '../images/Hp1.jpg', 850.00, 5),
(4, 'Microsoft Surface', 'Versatile 2-in-1 laptop for business.', '../images/microsoft1.jpg', 950.00, 8),
(5, 'Canon EOS R5', 'Professional mirrorless camera for 8K video.', '../images/canon1.jpg', 3500.00, 4),
(6, 'Canon Lens 50mm', 'Prime lens for portrait photography.', '../images/canon2.jpg', 200.00, 20),
(7, 'Nikon Z7 II', 'High-resolution full-frame mirrorless camera.', '../images/nikon1.jpg', 3000.00, 3),
(8, 'Sony Alpha a7', 'Advanced mirrorless camera for hybrid shooters.', '../images/sony1.jpg', 2500.00, 6),
(9, 'Sony WH-1000XM4', 'Industry-leading noise canceling headphones.', '../images/sonyheadphones1.jpg', 350.00, 25),
(10, 'Ethernet Cable Cat6', 'High-speed network cable for stable connections.', '../images/cable1.jpg', 15.00, 100),
(11, 'Fiber Optic Cable', 'Ultra-fast fiber for backbone infrastructure.', '../images/cable2.jpg', 45.00, 50),
(12, 'Samsung Galaxy S21', 'Flagship smartphone with pro-grade camera.', '../images/samsung1.jpg', 800.00, 12),
(13, 'iPhone 13 Pro', 'Super retina display and advanced A15 chip.', '../images/iphone1.jpg', 1100.00, 9),
(14, 'iPhone 12', 'Reliable performance with 5G capability.', '../images/iphone2.jpg', 700.00, 14),
(15, 'Motorola Edge', 'Sleek design with 108MP camera system.', '../images/moto1.jpg', 500.00, 20),
(16, 'Fast Charger 20W', 'USB-C power adapter for quick charging.', '../images/charger1.jpg', 25.00, 40),
(18, 'Insta360', 'insta360', '../images/insta360.jpeg', 450.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `ShoppingCart`
--

CREATE TABLE `ShoppingCart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ShoppingCart`
--

INSERT INTO `ShoppingCart` (`cart_id`, `customer_id`, `product_id`, `quantity`, `added_at`) VALUES
(15, 1, 1, 1, '2026-02-02 20:05:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `categoryProduct`
--
ALTER TABLE `categoryProduct`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `user_product` (`customer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoryProduct`
--
ALTER TABLE `categoryProduct`
  ADD CONSTRAINT `categoryProduct_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categoryProduct_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD CONSTRAINT `OrderDetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`),
  ADD CONSTRAINT `OrderDetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Product` (`product_id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`);

--
-- Constraints for table `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD CONSTRAINT `ShoppingCart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ShoppingCart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Product` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

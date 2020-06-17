-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 07:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `create_order_id`
--

CREATE TABLE `create_order_id` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `create_order_id`
--

INSERT INTO `create_order_id` (`id`, `order_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38),
(39, 39),
(40, 40),
(41, 41),
(42, 42),
(43, 43),
(44, 44),
(45, 45),
(46, 46),
(47, 47),
(48, 48),
(49, 49),
(50, 50),
(51, 51),
(52, 52);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_city` varchar(255) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_pincode` int(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`id`, `branch_name`, `branch_city`, `branch_address`, `branch_pincode`, `state_id`, `status`, `created_at`) VALUES
(1, 'Quickpick Silphukuri', 'Guwahati', 'Zonal Office, UN Bezbaruah Road, Near UCO Bank, Krishna Nagar, Silphukuri, Guwahati, Assam 781003', 781003, 15, 1, '2019-10-17 07:22:47'),
(2, 'Red Contemporary Dining', 'Guwahati', 'Ground Goldenwood Apartment, RG Baruah Rd, Manik Nagar, Guwahati, Assam 781006', 781006, 3, 1, '2019-10-17 07:27:35'),
(3, 'Quickpick Kharghar', 'Kharghar', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Kharghar', 400616, 3, 1, '2019-10-17 07:32:31'),
(4, 'RED Contemporary Dining', 'Guwahati', 'Ground Goldenwood Apartment, RG Baruah Rd, Manik Nagar, Guwahati, Assam 781006', 400617, 4, 1, '2019-10-17 07:36:03'),
(5, 'Quickpick Panvel', 'Panvel', 'Zonal Office, UN Bezbaruah Road, Near UCO Bank, Krishna Nagar, Silphukuri, Guwahati, Assam 781003', 400618, 16, 1, '2019-10-17 07:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category_name`, `status`, `created_at`) VALUES
(1, 'FoodItems', 1, '2019-09-25 05:15:45'),
(43, 'HardDrinks', 1, '2019-12-19 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chef`
--

CREATE TABLE `tbl_chef` (
  `id` int(11) NOT NULL,
  `manager_code` varchar(255) NOT NULL,
  `chef_code` varchar(255) NOT NULL,
  `chef_name` varchar(255) NOT NULL,
  `chef_address` text NOT NULL,
  `chef_city` varchar(255) NOT NULL,
  `chef_pincode` varchar(6) NOT NULL,
  `chef_mobile` varchar(12) NOT NULL,
  `chef_email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT 'chef',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chef`
--

INSERT INTO `tbl_chef` (`id`, `manager_code`, `chef_code`, `chef_name`, `chef_address`, `chef_city`, `chef_pincode`, `chef_mobile`, `chef_email`, `username`, `password`, `roles`, `status`, `created_at`) VALUES
(1, '00001', '00001', 'Pchef1', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Panvel', 'Panvel', '400618', '9800000005', 'pchef1@mobisofttech.co.in', 'pchef1', 'pchef1', 'chef', 1, '2019-10-22 12:35:55'),
(2, '00002', '00002', 'Schef1', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Seawoods', 'Seawoods', '400706', '9800000020', 'schef1@mobisofttech.co.in', 'schef1', 'schef1', 'chef', 1, '2019-10-22 12:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupan`
--

CREATE TABLE `tbl_coupan` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_mobile` varchar(12) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `manager_code` varchar(255) NOT NULL,
  `coupan_code` varchar(6) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coupan`
--

INSERT INTO `tbl_coupan` (`id`, `customer_id`, `customer_mobile`, `message`, `manager_code`, `coupan_code`, `from_date`, `to_date`, `discount_type`, `amount`, `percentage`, `state_id`, `status`, `created_at`) VALUES
(12, NULL, NULL, NULL, '00002', 'HS1II5', '2020-01-14', '2020-02-08', 'Amount', 20, 0, NULL, 1, '2020-01-31 06:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(12) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `customer_name`, `customer_mobile`, `customer_email`, `status`, `created_at`) VALUES
(1, '', '8876072223', '', 1, '2020-01-31 05:54:29'),
(2, '', '9706719527', '', 1, '2020-01-31 05:55:29'),
(3, '', '6002018366', '', 1, '2020-01-31 05:57:12'),
(4, '', '8876072223', '', 1, '2020-01-31 10:03:07'),
(5, '', '8876072223', '', 1, '2020-01-31 10:07:10'),
(6, '', '8876072223', '', 1, '2020-01-31 10:10:51'),
(7, '', '8876072223', '', 1, '2020-01-31 10:15:38'),
(8, '', '8876072223', '', 1, '2020-01-31 10:21:06'),
(9, '', '8876072223', '', 1, '2020-01-31 10:24:13'),
(10, '', '6002018366', '', 1, '2020-01-31 10:24:29'),
(11, '', '8876072223', '', 1, '2020-01-31 10:33:59'),
(12, '', '8876072223', '', 1, '2020-01-31 10:34:18'),
(13, '', '8876072223', '', 1, '2020-01-31 10:36:09'),
(14, '', '8876072223', '', 1, '2020-01-31 10:36:24'),
(15, '', '6002018366', '', 1, '2020-01-31 10:36:43'),
(16, '', '8876072223', '', 1, '2020-01-31 10:48:52'),
(17, '', '8876072223', '', 1, '2020-01-31 10:49:15'),
(18, '', '8876072223', '', 1, '2020-01-31 10:58:57'),
(19, '', '8876072223', '', 1, '2020-01-31 11:02:26'),
(20, '', '8876072223', '', 1, '2020-01-31 11:13:02'),
(21, '', '8876072223', '', 1, '2020-01-31 11:40:31'),
(22, '', '8876072223', '', 1, '2020-02-03 05:22:16'),
(23, '', '8876072223', '', 1, '2020-02-03 10:50:58'),
(24, '', '8876072223', '', 1, '2020-02-03 10:53:32'),
(25, '', '8876072223', '', 1, '2020-02-03 10:56:06'),
(26, '', '8876072223', '', 1, '2020-02-03 10:59:47'),
(27, '', '8876072223', '', 1, '2020-02-03 11:01:21'),
(28, '', '8876072223', '', 1, '2020-02-04 09:09:05'),
(29, '', '8876072223', '', 1, '2020-02-12 04:53:09'),
(30, '', '8876072223', '', 1, '2020-03-06 04:56:50'),
(31, '', '8876072223', '', 1, '2020-03-06 05:02:28'),
(32, '', '8876072223', '', 1, '2020-03-06 05:10:35'),
(33, '', '8876072223', '', 1, '2020-03-06 05:20:31'),
(34, '', '8876072223', '', 1, '2020-03-06 05:35:36'),
(35, '', '8876072223', '', 1, '2020-03-06 06:44:42'),
(36, '', '8876072223', '', 1, '2020-03-06 06:54:50'),
(37, '', '8876072223', '', 1, '2020-03-06 06:57:22'),
(38, '', '8876072223', '', 1, '2020-03-06 07:06:26'),
(39, '', '8876072223', '', 1, '2020-03-06 07:10:09'),
(40, '', '9706719527', '', 1, '2020-03-06 07:19:19'),
(41, '', '8876072223', '', 1, '2020-06-02 05:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manager`
--

CREATE TABLE `tbl_manager` (
  `id` int(11) NOT NULL,
  `manager_code` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `manager_name` varchar(255) NOT NULL,
  `manager_address` text NOT NULL,
  `manager_city` varchar(255) NOT NULL,
  `manager_pincode` varchar(6) NOT NULL,
  `manager_mobile` varchar(10) NOT NULL,
  `manager_email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT 'manager',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manager`
--

INSERT INTO `tbl_manager` (`id`, `manager_code`, `branch_id`, `manager_name`, `manager_address`, `manager_city`, `manager_pincode`, `manager_mobile`, `manager_email`, `username`, `password`, `roles`, `status`, `created_at`) VALUES
(1, '00001', 5, 'Quickpick Silphukuri', 'Zonal Office, UN Bezbaruah Road, Near UCO Bank, Krishna Nagar, Silphukuri, Guwahati, Assam 781003', 'Guwahati', '400614', '9324942407', 'nitu.w@mobisofttech.co.in', 'manager1', 'manager1', 'manager', 1, '2019-10-17 09:56:58'),
(2, '00002', 4, 'Red Contemporary', 'Ground Goldenwood Apartment, RG Baruah Rd, Manik Nagar, Guwahati, Assam 781006', 'Seawoods', '400617', '8108004545', 'ajeet.m@mobisofttech.co.in', 'manager2', 'manager2', 'manager', 1, '2019-10-17 10:08:21'),
(3, '00003', 3, 'Kapil Sharma', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Kharghar', 'Kharghar', '400616', '8080809900', 'kapil.s@mobisofttech.co.in', 'kapil', 'kapil', 'manager', 1, '2019-10-17 10:17:19'),
(4, '00004', 2, 'Amruta Palaw', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Belapur', 'Belapur', '400615', '9324942405', 'amruta.p@mobisofttech.co.in', 'amruta', 'amruta', 'manager', 1, '2019-10-17 10:20:55'),
(5, '00005', 1, 'Pinki Prajapati', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Nerul', 'Nerul', '400614', '9324942408', 'pinki.p@mobisofttech.co.in', 'pinki', 'pinki', 'manager', 1, '2019-10-17 11:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `catergory_id` int(11) NOT NULL,
  `manager_code` varchar(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `menu_time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `menu_aval` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `catergory_id`, `manager_code`, `menu_name`, `menu_price`, `menu_time`, `status`, `menu_aval`, `created_at`) VALUES
(1, 1, '00001', 'Mix Vegetable', 95, 10, 1, 1, '2019-10-23 04:35:40'),
(2, 1, '00001', 'Paneer Butter Masala', 190, 10, 1, 1, '2019-10-23 04:36:05'),
(3, 1, '00001', 'Paneer Labadar', 190, 10, 1, 1, '2019-10-23 04:37:03'),
(4, 1, '00001', 'Mutter Paneer', 130, 10, 1, 1, '2019-10-23 04:37:38'),
(5, 1, '00001', 'Aloo Dum', 100, 10, 1, 1, '2019-10-23 04:38:02'),
(12, 1, '00001', 'Peas Pulao', 119, 10, 1, 1, '2019-10-23 04:41:24'),
(13, 1, '00001', 'Veg Pulao', 119, 10, 1, 1, '2019-10-23 04:41:48'),
(14, 1, '00001', 'Veg Biriyani', 170, 10, 1, 1, '2019-10-23 04:42:10'),
(15, 1, '00001', 'Ch. Biriyani', 200, 10, 1, 1, '2019-10-23 04:43:24'),
(16, 1, '00001', 'Steam Rice', 70, 10, 1, 1, '2019-10-23 04:44:04'),
(20, 1, '00001', 'Aloo Paratha', 200, 10, 1, 1, '2019-10-23 04:46:36'),
(43, 1, '00001', 'Tawa Roti', 25, 10, 1, 1, '2019-10-23 05:25:53'),
(44, 1, '00001', 'Tandoori Roti', 165, 10, 1, 1, '2019-10-23 05:26:19'),
(45, 1, '00001', 'Naan', 40, 10, 1, 1, '2019-10-23 05:26:42'),
(46, 1, '00001', 'Butter Naan', 50, 10, 1, 1, '2019-10-23 05:27:20'),
(47, 1, '00001', 'Masala Kulcha', 50, 10, 1, 1, '2019-10-23 05:27:57'),
(52, 1, '00001', 'Indian Non Veg Thali', 250, 10, 1, 1, '2019-10-23 05:32:36'),
(53, 1, '00001', 'Special Non Veg Thali', 250, 10, 1, 1, '2019-10-23 05:33:13'),
(54, 1, '00001', 'Indian Veg Thali', 250, 10, 1, 1, '2019-10-23 05:33:33'),
(77, 1, '00001', 'Green Salad', 45, 10, 1, 1, '2019-10-23 07:07:53'),
(78, 1, '00001', 'Onion Salad', 40, 10, 1, 1, '2019-10-23 07:08:17'),
(86, 1, '00001', 'Plain', 45, 10, 1, 1, '2019-10-23 07:12:26'),
(87, 1, '00001', 'Masala', 55, 10, 1, 1, '2019-10-23 07:12:48'),
(95, 1, '00001', 'Paneer Tikka', 51, 0, 1, 1, '2019-10-23 07:17:16'),
(96, 1, '00001', 'Paneer Malai Tikka', 100, 10, 1, 1, '2019-10-23 07:17:40'),
(97, 1, '00001', 'Punjabi Paneer Tikka', 60, 0, 1, 1, '2019-10-23 07:18:03'),
(98, 1, '00001', 'Hussani Paneer Tikka', 100, 10, 1, 1, '2019-10-23 07:18:26'),
(109, 1, '00001', 'Mumbai Rashmi Kabab', 120, 10, 1, 1, '2019-10-25 23:13:18'),
(110, 1, '00001', 'Kasturi Kabab', 120, 10, 1, 1, '2019-10-25 23:13:41'),
(111, 1, '00001', 'Nawabi Murgh Tikka', 120, 10, 1, 1, '2019-10-25 23:14:23'),
(112, 1, '00001', 'Chicken Tikka', 120, 10, 1, 1, '2019-10-25 23:14:49'),
(113, 1, '00001', 'Tandoori Chicken', 240, 10, 1, 1, '2019-10-25 23:15:12'),
(115, 1, '00001', 'Mahi Tikka', 250, 10, 1, 1, '2019-10-25 23:16:30'),
(116, 1, '00001', 'Afghani Fish Tikka', 250, 10, 1, 1, '2019-10-25 23:27:49'),
(122, 1, '00001', 'Fish Curry', 220, 10, 1, 1, '2019-10-25 23:30:17'),
(123, 1, '00001', 'Chicken Curry', 200, 10, 1, 1, '2019-10-25 23:30:35'),
(124, 1, '00001', 'Egg Curry', 120, 10, 1, 1, '2019-10-25 23:30:57'),
(125, 1, '00001', 'Chicken Bharta', 200, 10, 1, 1, '2019-10-25 23:31:17'),
(126, 1, '00001', 'Ch. Tikka Butter Masala', 230, 10, 1, 1, '2019-10-25 23:31:43'),
(127, 1, '00001', 'Chicken Butter Masala', 250, 10, 1, 1, '2019-10-25 23:32:05'),
(128, 1, '00001', 'Dhania Chicken', 230, 10, 1, 1, '2019-10-25 23:32:34'),
(129, 1, '00001', 'Mutton Kosha', 285, 10, 1, 1, '2019-10-25 23:32:51'),
(130, 1, '00001', 'Mutton Curry', 285, 10, 1, 1, '2019-10-25 23:33:12'),
(131, 1, '00001', 'Mutton Roganjosh', 285, 10, 1, 1, '2019-10-25 23:33:33'),
(132, 1, '00001', 'Kadhai Chicken', 230, 10, 1, 1, '2019-10-25 23:33:52'),
(135, 1, '00001', 'Dal Makhani', 148, 10, 1, 1, '2019-11-22 05:19:40'),
(136, 1, '00001', 'Yellow Dal', 90, 10, 1, 1, '2019-11-22 05:19:40'),
(137, 1, '00001', 'Dal Panchamela', 100, 10, 1, 1, '2019-11-22 05:20:33'),
(138, 1, '00001', 'Sweet Corn Soup', 102, 10, 1, 1, '2019-11-22 05:21:16'),
(139, 1, '00001', 'Lemon Coriander', 100, 10, 1, 1, '2019-11-22 05:23:17'),
(140, 1, '00001', 'Manchow Soup', 102, 10, 1, 1, '2019-11-22 05:23:17'),
(141, 1, '00001', 'Hot & Sour', 102, 10, 1, 1, '2019-11-22 05:25:12'),
(142, 1, '00001', 'Quick Pick Special', 10, 10, 1, 1, '2019-11-22 05:25:12'),
(143, 1, '00001', 'Drums of Heaven Hot & Spicy', 120, 10, 1, 1, '2019-11-22 05:27:56'),
(144, 1, '00001', 'Dragon Chicken Dry', 130, 10, 1, 1, '2019-11-22 05:28:50'),
(145, 1, '00001', 'Dry Chilly Chicken', 130, 10, 1, 1, '2019-11-22 05:28:50'),
(146, 1, '00001', 'Chicken Onion Momo', 100, 10, 1, 1, '2019-11-22 05:30:01'),
(147, 1, '00001', 'Chicken Hot & Spicy Momo', 100, 10, 1, 1, '2019-11-22 05:30:01'),
(148, 1, '00001', 'Chicken Coriander Momo', 100, 10, 1, 1, '2019-11-22 05:31:06'),
(149, 1, '00001', 'Veg Momo', 80, 10, 1, 1, '2019-11-22 05:31:06'),
(150, 1, '00001', 'Spicy Veg Soya Bean Momo', 80, 10, 1, 1, '2019-11-22 05:32:14'),
(151, 1, '00001', 'Veg Manchurian', 130, 10, 1, 1, '2019-11-22 05:33:48'),
(152, 1, '00001', 'Chilly Paneer', 160, 10, 1, 1, '2019-11-22 05:33:48'),
(153, 1, '00001', 'Szechuan Paneer', 160, 10, 1, 1, '2019-11-22 05:34:38'),
(154, 1, '00001', 'Hot Garlic Paneer', 160, 10, 1, 1, '2019-11-22 05:34:38'),
(155, 1, '00001', 'Garlic Chicken', 150, 10, 1, 1, '2019-11-22 05:45:01'),
(156, 1, '00001', 'Hunnan Chicken', 150, 10, 1, 1, '2019-11-22 05:45:01'),
(157, 1, '00001', 'Hot Garlic Chicken', 150, 10, 1, 1, '2019-11-22 05:45:50'),
(158, 1, '00001', 'Chilly Chicken', 150, 10, 1, 1, '2019-11-22 05:45:50'),
(159, 1, '00001', 'Ch. Manchurian', 150, 10, 1, 1, '2019-11-22 05:46:45'),
(160, 1, '00001', 'Chilly Fish', 220, 10, 1, 1, '2019-11-22 05:46:45'),
(161, 1, '00001', 'Fried Rice', 119, 10, 1, 1, '2019-11-22 05:48:38'),
(162, 1, '00001', 'Szechuan Rice', 119, 10, 1, 1, '2019-11-22 05:48:38'),
(163, 1, '00001', 'Quick Pick Special', 138, 10, 1, 1, '2019-11-22 05:49:00'),
(164, 1, '00001', 'Hakka', 119, 10, 1, 1, '2019-11-27 11:33:49'),
(165, 1, '00001', 'Chilly Garlic', 119, 10, 1, 1, '2019-11-27 11:33:53'),
(166, 1, '00001', 'Pan Fried(Gravy)', 119, 10, 1, 1, '2019-11-27 11:35:16'),
(167, 1, '00001', 'Cantonese(Gravy)', 119, 10, 1, 1, '2019-11-27 11:35:16'),
(168, 1, '00001', 'Quick Pick Special', 135, 10, 1, 1, '2019-11-27 11:36:27'),
(169, 1, '00001', 'American Chopsuey', 135, 10, 1, 1, '2019-11-27 11:36:27'),
(170, 1, '00001', 'Chinese Chopsuey', 135, 10, 1, 1, '2019-11-27 11:37:38'),
(171, 1, '00001', 'Cottages Pick Chinese Veg Combo', 240, 10, 1, 1, '2019-11-27 11:39:07'),
(172, 1, '00001', 'Chilly Baby Corn Combo Meal', 230, 10, 1, 1, '2019-11-27 11:39:07'),
(173, 1, '00001', 'Veg Manchurian Combo Meal', 230, 10, 1, 1, '2019-11-27 11:39:30'),
(174, 1, '00001', 'Chilly Chicken Combo Meal', 250, 10, 1, 1, '2019-11-27 11:41:05'),
(175, 1, '00001', 'Quick Pick Special Combo Chicken', 250, 10, 1, 1, '2019-11-27 11:41:05'),
(176, 1, '00001', 'Chef Special Chicken Combo Meal', 250, 10, 1, 1, '2019-11-27 11:42:18'),
(177, 1, '00001', 'Chicken Szechuan Combo Meal', 250, 10, 1, 1, '2019-11-27 11:42:18'),
(178, 1, '00001', 'Dragon Chicken Combo Meal', 250, 10, 1, 1, '2019-11-27 11:42:52'),
(179, 1, '00002', 'Cold Chicken Salad', 250, 10, 1, 1, '2019-11-28 07:17:33'),
(180, 1, '00002', 'Russian Salad', 210, 10, 1, 1, '2019-11-28 07:18:28'),
(181, 1, '00002', 'Green Salad', 80, 10, 1, 1, '2019-11-28 07:20:01'),
(182, 1, '00002', 'Tomato Soup', 150, 10, 1, 1, '2019-11-28 07:21:50'),
(183, 1, '00002', 'Cream Soup', 150, 10, 1, 1, '2019-11-28 07:22:08'),
(184, 1, '00002', 'Lemon Coriander Soup', 150, 10, 1, 1, '2019-11-28 07:22:41'),
(185, 1, '00002', 'Clear Soup', 130, 10, 1, 1, '2019-11-28 07:23:05'),
(186, 1, '00002', 'Sweet Corn Soup', 150, 10, 1, 1, '2019-11-28 07:23:27'),
(187, 1, '00002', 'Manchow Soup', 150, 10, 1, 1, '2019-11-28 07:23:50'),
(188, 1, '00002', 'Tomato Soup', 150, 10, 1, 1, '2019-11-28 07:24:52'),
(189, 1, '00002', 'Cream Soup', 160, 10, 1, 1, '2019-11-28 07:25:06'),
(190, 1, '00002', 'Lemon Coriander Soup', 160, 10, 1, 1, '2019-11-28 07:25:29'),
(191, 1, '00002', 'Clear Soup', 140, 10, 1, 1, '2019-11-28 07:25:47'),
(192, 1, '00002', 'Sweet Corn Soup', 160, 10, 1, 1, '2019-11-28 07:26:05'),
(193, 1, '00002', 'Manchow Soup', 160, 10, 1, 1, '2019-11-28 07:26:31'),
(194, 1, '00002', 'Dal Makhani', 220, 10, 1, 1, '2019-11-28 07:28:24'),
(195, 1, '00002', 'Yellow Dal Tadka', 180, 10, 1, 1, '2019-11-28 07:28:49'),
(196, 1, '00002', 'Basmati-e chawal steamed rice', 120, 10, 1, 1, '2019-11-28 07:30:20'),
(197, 1, '00002', 'Veg / Peas Pulao', 170, 10, 1, 1, '2019-11-28 07:31:03'),
(198, 1, '00002', 'Jeera Rice', 160, 10, 1, 1, '2019-11-28 07:31:18'),
(199, 1, '00002', 'Butter Naan', 50, 10, 1, 1, '2019-11-28 07:32:15'),
(200, 1, '00002', 'Tandoori roti', 30, 10, 1, 1, '2019-11-28 07:36:21'),
(201, 1, '00002', 'Lacha Paratha', 50, 10, 1, 1, '2019-11-28 07:36:43'),
(202, 1, '00002', 'Masala Kulcha', 60, 10, 1, 1, '2019-11-28 07:37:43'),
(203, 1, '00002', 'Roomali Roti', 50, 10, 1, 1, '2019-11-28 07:37:58'),
(204, 1, '00002', 'Dum Aloo', 240, 10, 1, 1, '2019-11-28 07:38:58'),
(205, 1, '00002', 'Palak Paneer', 300, 10, 1, 1, '2019-11-28 07:39:17'),
(206, 1, '00002', 'Kadhai Paneer', 275, 10, 1, 1, '2019-11-28 07:53:48'),
(207, 1, '00002', 'Paneer Tikka Masala', 275, 10, 1, 1, '2019-11-28 07:54:14'),
(208, 1, '00002', 'Corn Palak', 300, 10, 1, 1, '2019-11-28 07:54:31'),
(209, 1, '00002', 'Paneer Malai Mutter', 275, 10, 1, 1, '2019-11-28 07:55:15'),
(210, 1, '00002', 'Subz  Jhalfrazie', 260, 10, 1, 1, '2019-11-28 07:56:04'),
(211, 1, '00002', 'Navaratin Korma', 275, 10, 1, 1, '2019-11-28 07:56:32'),
(212, 1, '00002', 'tawa Subz', 260, 10, 1, 1, '2019-11-28 07:57:00'),
(213, 1, '00002', 'Paneer Butter Masala', 275, 10, 1, 1, '2019-11-28 07:57:25'),
(214, 1, '00002', 'Shahi Malai Kofta', 275, 10, 1, 1, '2019-11-28 07:57:52'),
(215, 1, '00002', 'Kosha Chicken', 350, 10, 1, 1, '2019-11-28 07:59:31'),
(216, 1, '00002', 'Chicken Butter Masala', 420, 10, 1, 1, '2019-11-28 07:59:58'),
(217, 1, '00002', 'Chicken Curry', 325, 10, 1, 1, '2019-11-28 08:00:17'),
(218, 1, '00002', 'Chicken Curry', 325, 10, 1, 1, '2019-11-28 08:00:48'),
(219, 1, '00002', 'Chicken Tikka Masala', 390, 10, 1, 1, '2019-11-28 08:01:08'),
(220, 1, '00002', 'Lazeez Tikka Masala', 390, 10, 1, 1, '2019-11-28 08:01:37'),
(221, 1, '00002', 'Mutton Raganjosh', 400, 10, 1, 1, '2019-11-28 08:02:12'),
(222, 1, '00002', 'Bhuna Mutton', 450, 450, 1, 1, '2019-11-28 08:02:35'),
(223, 1, '00002', 'Kosha Mutton', 400, 10, 1, 1, '2019-11-28 08:02:53'),
(224, 1, '00002', 'Bati Shingri', 630, 20, 1, 1, '2019-11-28 08:03:23'),
(225, 1, '00002', 'Prawn Masala', 490, 10, 1, 1, '2019-11-28 08:03:49'),
(226, 1, '00002', 'The Fish Curry', 490, 10, 1, 1, '2019-11-28 08:04:09'),
(227, 1, '00002', 'Joshina Masala Machhali', 450, 10, 1, 1, '2019-11-28 08:04:46'),
(228, 1, '00002', 'Crispy Fried Cottage Cheese Finger', 285, 20, 1, 1, '2019-11-28 08:07:04'),
(229, 1, '00002', 'French Fries', 195, 10, 1, 1, '2019-11-28 08:07:24'),
(230, 1, '00002', 'Crispy Chilly Baby Corn', 340, 20, 1, 1, '2019-11-28 08:07:49'),
(231, 1, '00002', 'American Corn Salt & Papper', 310, 10, 1, 1, '2019-11-28 08:08:23'),
(232, 1, '00002', 'Crispy Fried Fish Finger', 375, 10, 1, 1, '2019-11-28 08:09:13'),
(233, 1, '00002', 'Tao Pai Chicken', 325, 10, 1, 1, '2019-11-28 08:09:45'),
(234, 1, '00002', 'Chicken Stick Finger', 350, 10, 1, 1, '2019-11-28 08:10:09'),
(235, 1, '00002', 'Drums of Haven', 285, 10, 1, 1, '2019-11-28 08:10:36'),
(236, 1, '00002', 'Bar B Que Chicken', 325, 10, 1, 1, '2019-11-28 08:11:03'),
(237, 1, '00002', 'Pan Fried Rice', 410, 10, 1, 1, '2019-11-28 08:11:26'),
(238, 1, '00002', 'Crispy Fried Prawn', 490, 10, 1, 1, '2019-11-28 08:11:52'),
(239, 1, '00002', 'Golden Fried Prawn', 490, 10, 1, 1, '2019-11-28 08:12:19'),
(240, 1, '00002', 'Bar B Que Prawn', 490, 10, 1, 1, '2019-11-28 08:12:42'),
(241, 1, '00001', 'Jeera Rice', 100, 10, 1, 1, '2019-11-28 08:17:35'),
(242, 1, '00001', 'Tandoori Roti', 35, 5, 1, 1, '2019-11-28 08:17:35'),
(243, 1, '00001', 'Paneer Tikka', 100, 20, 1, 1, '2019-11-28 08:22:49'),
(244, 1, '00001', 'Punjabi Paneer Tikka', 100, 10, 1, 1, '2019-11-28 08:22:49'),
(245, 1, '00001', 'Chicken Wings Chilly Garlic', 120, 10, 1, 1, '2019-11-28 08:48:50'),
(246, 1, '00001', 'Cuban lime mojito', 100, 10, 1, 1, '2019-11-28 08:50:36'),
(247, 1, '00001', 'Sea Breeze Cranverry Mojito', 100, 10, 1, 1, '2019-11-28 08:52:01'),
(248, 1, '00001', 'Mango Mojito', 100, 10, 1, 1, '2019-11-28 08:52:44'),
(249, 1, '00001', 'vanilla/strawberry/chocolate coffee', 130, 10, 1, 1, '2019-11-28 08:54:37'),
(250, 1, '00001', 'With Ice Cream', 150, 10, 1, 1, '2019-11-28 08:55:26'),
(251, 1, '00001', 'Mango Sahakes', 130, 10, 1, 1, '2019-11-28 08:56:02'),
(252, 1, '00001', 'Vanilla/Strawberry', 40, 10, 1, 1, '2019-11-28 08:56:50'),
(253, 1, '00001', 'Chocolate', 55, 10, 1, 1, '2019-11-28 08:57:35'),
(254, 1, '00001', 'Lime Soda', 70, 10, 1, 1, '2019-11-28 08:58:53'),
(255, 1, '00001', 'Cola Float', 80, 10, 1, 1, '2019-11-28 08:59:37'),
(256, 1, '00001', 'Cola Masala', 80, 10, 1, 1, '2019-11-28 09:00:11'),
(257, 1, '00001', 'Soft Drinks', 50, 10, 1, 1, '2019-11-28 09:00:46'),
(258, 1, '00001', 'Coffee', 50, 10, 1, 1, '2019-11-28 09:01:13'),
(259, 1, '00001', 'Hakka', 102, 10, 1, 1, '2019-11-28 09:01:55'),
(274, 1, '00001', 'Szechuan Fish', 220, 10, 1, 1, '2019-11-28 09:21:27'),
(275, 1, '00002', 'Veg Manchurian', 270, 10, 1, 1, '2019-11-28 09:25:46'),
(276, 1, '00002', 'Three Treasure Veg', 280, 10, 1, 1, '2019-11-28 09:26:29'),
(277, 1, '00002', 'Szechuan Paneer', 285, 10, 1, 1, '2019-11-28 09:27:10'),
(278, 1, '00002', 'Hot Garlic Paneer', 285, 10, 1, 1, '2019-11-28 09:27:46'),
(279, 1, '00002', 'Chicken in Choice of Sauce', 300, 10, 1, 1, '2019-11-28 09:28:47'),
(280, 1, '00002', 'Chilly Chicken', 300, 10, 1, 1, '2019-11-28 09:35:25'),
(281, 1, '00002', 'Garlic Pepper Chicken', 300, 10, 1, 1, '2019-11-28 09:36:07'),
(282, 1, '00002', 'Oyster Chicken', 300, 10, 1, 1, '2019-11-28 09:36:47'),
(283, 1, '00002', 'Fish in Choice of Sauce', 340, 10, 1, 1, '2019-11-28 09:37:51'),
(284, 1, '00002', 'Fish Chilly Mustard', 340, 10, 1, 1, '2019-11-28 09:38:34'),
(285, 1, '00002', 'Fish Chilly Wine', 340, 10, 1, 1, '2019-11-28 09:39:05'),
(286, 1, '00002', 'Prawn Szechuan', 480, 10, 1, 1, '2019-11-28 09:39:41'),
(287, 1, '00002', 'Hunan Prawn', 480, 10, 1, 1, '2019-11-28 09:40:15'),
(288, 1, '00002', 'Fried Rice', 180, 10, 1, 1, '2019-11-28 09:41:19'),
(289, 1, '00002', 'Lemon Fried Rice', 180, 10, 1, 1, '2019-11-28 09:42:15'),
(290, 1, '00002', 'Szechuan Rice', 180, 10, 1, 1, '2019-11-28 09:42:58'),
(291, 1, '00002', 'Spicy Onion Coriander Rice', 180, 10, 1, 1, '2019-11-28 09:43:44'),
(292, 1, '00002', 'Ginger Capsicum Rice', 180, 10, 1, 1, '2019-11-28 09:44:24'),
(293, 1, '00002', 'Chilly Garlic Rice', 180, 10, 1, 1, '2019-11-28 09:44:58'),
(294, 1, '00002', 'Hakka Noodles', 180, 10, 1, 1, '2019-11-28 09:45:33'),
(295, 1, '00002', 'Szechuan Noddles', 180, 10, 1, 1, '2019-11-28 09:46:05'),
(296, 1, '00002', 'Chilly Garlic Noodles', 180, 10, 1, 1, '2019-11-28 09:46:31'),
(297, 1, '00002', 'Pan Fried Noodles', 180, 10, 1, 1, '2019-11-28 09:47:03'),
(298, 1, '00002', 'Fried Rice', 210, 10, 1, 1, '2019-11-28 09:47:41'),
(299, 1, '00002', 'Lemon Fried Rice', 210, 10, 1, 1, '2019-11-28 09:48:02'),
(300, 1, '00002', 'Szechuan Rice', 210, 10, 1, 1, '2019-11-28 09:48:26'),
(301, 1, '00002', 'Spicy Onion Coriander Rice', 210, 10, 1, 1, '2019-11-28 09:49:04'),
(302, 1, '00002', 'Ginger Capsicum Rice', 210, 10, 1, 1, '2019-11-28 09:49:33'),
(303, 1, '00002', 'Chilly Garlic Rice', 210, 10, 1, 1, '2019-11-28 09:51:02'),
(304, 1, '00002', 'Hakka Noodles', 210, 10, 1, 1, '2019-11-28 09:51:30'),
(305, 1, '00002', 'Szechuan Noddles', 210, 10, 1, 1, '2019-11-28 09:52:22'),
(306, 1, '00002', 'Chilly Garlic Noodles', 210, 10, 1, 1, '2019-11-28 09:53:07'),
(307, 1, '00002', 'Pan Fried Noodles', 210, 10, 1, 1, '2019-11-28 09:53:32'),
(308, 1, '00002', 'Exotic Vegetable Gratin', 270, 10, 1, 1, '2019-11-28 09:58:24'),
(309, 1, '00002', 'Mushroom Corn Florentine', 280, 10, 1, 1, '2019-11-28 09:59:17'),
(310, 1, '00002', 'Fish n Chips', 375, 10, 1, 1, '2019-11-28 09:59:56'),
(311, 1, '00002', 'Herb Crusted Fillet Fish', 375, 10, 1, 1, '2019-11-28 10:00:49'),
(312, 1, '00002', 'Chicken Steak Sizler', 320, 10, 1, 1, '2019-11-28 10:02:02'),
(313, 1, '00002', 'Chicken Stroganoff', 350, 10, 0, 1, '2019-11-28 10:06:46'),
(314, 1, '00002', 'Roasted Chicken', 350, 10, 1, 1, '2019-11-28 10:07:29'),
(315, 1, '00002', 'Grilled Prawn(Sizzling / Normal)', 480, 10, 1, 1, '2019-11-28 10:08:25'),
(316, 1, '00002', 'Lamb Shank Osso Bucco', 450, 10, 1, 1, '2019-11-28 10:09:24'),
(317, 1, '00002', 'Arabiata with Red Yellow & Bell Pepper', 290, 10, 1, 1, '2019-11-28 10:10:36'),
(318, 1, '00002', 'REGULAR BUFFET', 500, 11, 1, 1, '2019-11-28 10:11:27'),
(319, 1, '00002', 'Bolognese', 380, 10, 1, 1, '2019-11-28 10:11:55'),
(320, 1, '00002', 'Alfredo Di Pollo', 320, 10, 1, 1, '2019-11-28 10:12:31'),
(321, 1, '00002', 'Marinara', 340, 10, 1, 1, '2019-11-28 10:13:10'),
(322, 1, '00002', 'Achari Paneer Tikka', 250, 10, 1, 1, '2019-11-28 10:14:27'),
(323, 1, '00002', 'Hara Tawa Kebab', 230, 10, 1, 1, '2019-11-28 10:14:58'),
(324, 1, '00002', 'Aloo Badami', 250, 10, 1, 1, '2019-11-28 10:15:15'),
(325, 1, '00002', 'Chicken Tikka', 320, 10, 1, 1, '2019-11-28 10:15:34'),
(326, 1, '00002', 'Chicken Reshmi Kebab', 320, 10, 1, 1, '2019-11-28 10:16:10'),
(327, 1, '00002', 'Tandoori Chicken (Full)', 420, 10, 1, 1, '2019-11-28 10:16:48'),
(328, 1, '00002', 'Tandoori Chicken (Half)', 250, 10, 1, 1, '2019-11-28 10:17:35'),
(329, 1, '00002', 'Fish Awadi', 420, 10, 1, 1, '2019-11-28 10:18:00'),
(330, 1, '00002', 'Red Special Fish Tikka', 420, 10, 1, 1, '2019-11-28 10:18:42'),
(331, 1, '00002', 'Seekh Kebab', 350, 10, 1, 1, '2019-11-28 10:19:30'),
(332, 1, '00002', 'Lasooni Jhinga', 490, 12, 1, 1, '2019-11-28 10:20:04'),
(333, 1, '00002', 'Subz Biryani', 250, 12, 1, 1, '2019-11-28 10:20:59'),
(334, 1, '00002', 'Chicken Masaledar Biryani', 350, 12, 1, 1, '2019-11-28 10:21:37'),
(335, 1, '00002', 'Mutton Masaledar Biryani', 400, 12, 1, 1, '2019-11-28 10:22:13'),
(336, 1, '00002', 'Dessart Gulab Jamun', 90, 10, 1, 1, '2019-11-28 10:22:51'),
(337, 1, '00002', 'Tom Yum Soup', 170, 10, 1, 1, '2019-11-28 10:30:39'),
(338, 1, '00002', 'Tom Kha Soup', 170, 10, 1, 1, '2019-11-28 10:31:32'),
(339, 1, '00002', 'Tom Yum Prawn Soup', 170, 10, 1, 1, '2019-11-28 10:32:12'),
(340, 1, '00002', 'Tom Kha Prawn Soup', 170, 10, 1, 1, '2019-11-28 10:32:45'),
(341, 1, '00002', 'Tom Yum Soup', 185, 10, 1, 1, '2019-11-28 10:33:25'),
(342, 1, '00002', 'Tom Kha Soup', 185, 10, 1, 1, '2019-11-28 10:33:48'),
(343, 1, '00002', 'Tom Yum Prawn Soup', 230, 10, 1, 1, '2019-11-28 10:34:27'),
(344, 1, '00002', 'Tom Kha Prawn Soup', 230, 10, 1, 1, '2019-11-28 10:35:01'),
(345, 1, '00002', 'Smoked Chicken', 350, 10, 1, 1, '2019-11-28 10:35:55'),
(346, 1, '00002', 'Smoked Fish', 385, 10, 1, 1, '2019-11-28 10:36:33'),
(347, 1, '00002', 'Smoked Prawn', 450, 10, 1, 1, '2019-11-28 10:37:25'),
(348, 1, '00002', 'Fish Chilly Plum Sauce (Dry)', 385, 10, 1, 1, '2019-11-28 10:38:28'),
(349, 1, '00002', 'Prawn Chilly Plum Sauce (Dry)', 450, 10, 1, 1, '2019-11-28 10:39:35'),
(350, 1, '00002', 'Paad Thai Noodles', 300, 10, 1, 1, '2019-11-28 10:40:47'),
(351, 1, '00002', 'Special Thai Noodles', 250, 10, 1, 1, '2019-11-28 10:42:11'),
(352, 1, '00002', 'Paad Thai Noodles', 350, 10, 1, 1, '2019-11-28 10:42:48'),
(353, 1, '00002', 'Special Thai Noodles', 320, 10, 1, 1, '2019-11-28 10:43:55'),
(354, 1, '00002', 'Paad Thai Noodles', 420, 10, 1, 1, '2019-11-28 10:44:39'),
(355, 1, '00002', 'Special Thai Noodles', 420, 10, 1, 1, '2019-11-28 10:45:26'),
(357, 1, '00002', 'Oystar Thai Rice', 250, 10, 1, 1, '2019-11-28 10:48:18'),
(358, 1, '00002', 'Thai Fried Rice', 250, 10, 1, 1, '2019-11-28 10:48:45'),
(359, 1, '00002', 'Thai in Hot Besil Rice', 250, 10, 1, 1, '2019-11-28 10:49:34'),
(360, 1, '00002', 'Oyster Thai Rice', 320, 10, 1, 1, '2019-11-28 10:50:11'),
(361, 1, '00002', 'Thai Fried Rice', 320, 10, 1, 1, '2019-11-28 10:51:24'),
(362, 1, '00002', 'Thai in Hot Besil Rice', 320, 10, 1, 1, '2019-11-28 10:52:02'),
(363, 1, '00002', 'Oyster Thai Rice', 420, 10, 1, 1, '2019-11-28 10:52:25'),
(364, 1, '00002', 'Thai Fried Rice', 420, 10, 1, 1, '2019-11-28 10:52:48'),
(365, 1, '00002', 'Thai in Hot Besil Rice', 420, 10, 1, 1, '2019-11-28 10:53:17'),
(366, 1, '00001', 'REGULAR BUFFET', 500, 1, 1, 1, '2019-12-06 07:51:05'),
(367, 1, '00001', 'REGULAR BUFFET', 500, 2, 1, 1, '2019-12-06 09:04:47'),
(368, 1, '00002', 'REGULAR BUFFET', 500, 11, 1, 1, '2019-12-07 05:25:56'),
(369, 1, '00002', 'REGULAR BUFFET', 500, 11, 1, 1, '2019-12-07 05:27:50'),
(370, 1, '00002', 'TOM KHA SOUP', 170, 7, 1, 1, '2019-12-18 14:17:31'),
(371, 1, '00002', 'TOM YUM SOUP', 170, 7, 1, 1, '2019-12-18 14:19:36'),
(372, 1, '00002', 'PHO SOUP', 170, 20, 1, 1, '2019-12-18 14:20:35'),
(373, 1, '00002', 'HAWKER SOUP VEG', 170, 20, 1, 1, '2019-12-18 14:21:22'),
(374, 1, '00002', 'PATTAYA KAENG SOUP VEG', 170, 20, 1, 1, '2019-12-18 14:21:58'),
(375, 1, '00002', 'TOM KHA SOUP N.VEG', 185, 20, 1, 1, '2019-12-18 14:22:27'),
(376, 1, '00002', 'TOM YUM SOUP N.VEG', 185, 20, 1, 1, '2019-12-18 14:23:00'),
(377, 1, '00002', 'PHO SOUP N.VEG', 185, 20, 1, 1, '2019-12-18 14:23:33'),
(378, 1, '00002', ' HAWKER SOUP N.VEG', 185, 20, 1, 1, '2019-12-18 14:24:11'),
(379, 43, '00002', '100pip 30ml', 225, 18, 1, 1, '2019-12-19 12:51:47'),
(381, 43, '00002', 'CORONA BEER 355ML', 399, 18, 1, 1, '2019-12-19 12:52:30'),
(382, 1, '00002', 'BUFFET LUNCH /DINNER', 475, 18, 1, 1, '2019-12-19 12:53:44'),
(383, 1, '00002', 'BUFFET LUNCH', 475, 18, 1, 1, '2019-12-19 12:56:13'),
(384, 1, '00002', 'PACKAGE DRINKING WATER', 20, 18, 1, 1, '2019-12-19 13:01:26'),
(386, 43, '00002', 'J/W BLACK LABEL 30ML', 375, 10, 1, 1, '2019-12-19 13:52:09'),
(388, 43, '00002', 'TEACHERS 50 30ML', 275, 18, 1, 1, '2019-12-19 13:53:12'),
(390, 43, '00002', 'GLEINLIVET 30ML', 480, 18, 1, 1, '2019-12-19 13:54:22'),
(392, 43, '00002', 'BACARDI 30ML', 150, 18, 1, 1, '2019-12-19 13:55:31'),
(394, 43, '00002', 'OLD MONK 30ML', 100, 18, 1, 1, '2019-12-19 13:56:21'),
(396, 43, '00002', 'ABSOLUTE 30ML', 230, 18, 1, 1, '2019-12-19 13:57:02'),
(398, 43, '00002', 'JACK DENILES 30ML', 375, 18, 1, 1, '2019-12-19 14:07:42'),
(400, 43, '00002', 'BACARDI BREEZER', 180, 18, 1, 1, '2019-12-19 14:08:39'),
(401, 1, '00002', 'FRESH LIME WATER', 40, 18, 1, 1, '2019-12-19 14:09:21'),
(402, 1, '00002', 'FRESH LIME SODA', 60, 18, 1, 1, '2019-12-19 14:09:40'),
(403, 1, '00002', 'SOFT DRINKS', 35, 18, 1, 1, '2019-12-19 14:10:14'),
(406, 1, '00002', 'DRAGON BALL(MUSHROOM)', 340, 13, 1, 1, '2019-12-20 08:11:12'),
(407, 1, '00002', 'CRISPY GARLIC PEPPAR CORN', 310, 13, 1, 1, '2019-12-20 08:11:51'),
(408, 1, '00002', 'CRISPY CHILLY BABY CORN', 320, 13, 1, 1, '2019-12-20 08:12:32'),
(409, 1, '00002', 'STIR FRIED COTTAGE CHEESE', 300, 13, 1, 1, '2019-12-20 08:13:10'),
(410, 1, '00002', 'CHARCOAL GRILLED TAFU', 285, 13, 1, 1, '2019-12-20 08:13:46'),
(411, 1, '00002', 'GRILLED CHICKEN SALAD', 210, 13, 1, 1, '2019-12-20 08:14:37'),
(412, 1, '00002', 'CHICKEN ORIENTAL SALAD', 210, 13, 1, 1, '2019-12-20 08:15:06'),
(413, 1, '00002', 'SOM TAM SALAD', 185, 13, 1, 1, '2019-12-20 08:15:48'),
(414, 1, '00002', 'SEAFOOD SALAD', 400, 13, 1, 1, '2019-12-20 08:16:34'),
(415, 1, '00002', 'EXOTIC VEG TAFU SIZLER', 320, 13, 1, 1, '2019-12-20 08:18:12'),
(416, 1, '00002', 'PRAWN SIZLER', 550, 13, 1, 1, '2019-12-20 08:18:57'),
(417, 1, '00002', 'LOBSTAR CHILLY RUM SIZLER', 1200, 13, 1, 1, '2019-12-20 08:20:17'),
(418, 1, '00002', 'SEAFOOD SIZLER', 800, 13, 1, 1, '2019-12-20 08:21:40'),
(419, 1, '00002', 'CHICKEN SIZLER', 450, 14, 1, 1, '2019-12-20 08:22:22'),
(420, 1, '00002', 'CRISPY WINGS IN RED WINE SAUCE', 325, 14, 1, 1, '2019-12-20 08:24:46'),
(421, 1, '00002', 'AYAM MADU', 325, 14, 1, 1, '2019-12-20 08:25:32'),
(422, 1, '00002', 'DANCING CHICKEN ', 325, 325, 1, 1, '2019-12-20 08:26:16'),
(423, 1, '00002', 'CHICKEN SATAY WIYH PEANUT SAUCE', 350, 14, 1, 1, '2019-12-20 08:48:08'),
(424, 1, '00002', 'SMOKED CHICKEN', 350, 14, 1, 1, '2019-12-20 08:49:13'),
(425, 1, '00002', 'STIR FRIED CHICKEN WITH BROCCOLI AND MUSHROOM', 360, 14, 1, 1, '2019-12-20 08:51:24'),
(426, 1, '00002', 'STIR FRIED CHICKEN WITH PAK CHOY AND BELL PEPPER', 360, 14, 1, 1, '2019-12-20 08:52:59'),
(427, 1, '00002', 'BALI PRAWN', 500, 14, 1, 1, '2019-12-20 08:55:18'),
(428, 1, '00002', 'CUCUR UDANG (PRAWN FRITTERS)', 500, 14, 1, 1, '2019-12-20 08:58:24'),
(429, 1, '00002', 'TEMPURA PRAWN', 500, 14, 1, 1, '2019-12-20 08:59:58'),
(430, 1, '00002', 'PRAWN RED PEPPER DRY', 500, 14, 1, 1, '2019-12-20 09:01:24'),
(431, 1, '00002', 'PANKO FISH', 450, 14, 1, 1, '2019-12-20 09:02:37'),
(432, 1, '00002', 'CRISPY POMFRET IN THAI STYLE', 600, 14, 1, 1, '2019-12-20 09:03:58'),
(433, 1, '00002', 'SMOKED POMFRET CHILLY THAI STYLE', 600, 14, 1, 1, '2019-12-20 09:05:47'),
(434, 1, '00002', 'NANKING LAMB', 500, 14, 1, 1, '2019-12-20 09:08:52'),
(435, 1, '00002', 'ROAST LAMB HOT BASIL DRY', 500, 14, 1, 1, '2019-12-20 09:10:28'),
(436, 1, '00002', 'KOREAN LAMB CHOP', 500, 14, 1, 1, '2019-12-20 09:11:34'),
(437, 1, '00002', 'CHILLY LAMB THAI STYLE', 500, 14, 1, 1, '2019-12-20 09:12:52'),
(438, 1, '00002', 'SZECHUAN SAUCE', 270, 14, 1, 1, '2019-12-20 09:17:40'),
(439, 1, '00002', 'MANCHURIAN SAUCE', 270, 15, 1, 1, '2019-12-20 09:19:14'),
(440, 1, '00002', 'CHILLY PLUM SAUCE', 270, 15, 1, 1, '2019-12-20 09:20:15'),
(441, 1, '00002', 'HOT BASIL SAUCE', 270, 15, 1, 1, '2019-12-20 09:21:19'),
(442, 1, '00002', 'KUNG PAO SAUCE', 270, 15, 1, 1, '2019-12-20 09:21:50'),
(443, 1, '00002', 'CHINESE PARSLEY', 270, 15, 1, 1, '2019-12-20 09:23:26'),
(444, 1, '00002', 'CHINESE PARSLEY', 270, 15, 1, 1, '2019-12-20 09:23:26'),
(445, 1, '00002', 'BLACK BEANS SAUCE', 270, 15, 1, 1, '2019-12-20 09:24:28'),
(446, 1, '00002', 'THAI CHILLY SAUCE', 270, 15, 1, 1, '2019-12-20 09:25:53'),
(447, 1, '00002', 'CHICKEN SZECHUAN SAUCE ', 300, 15, 1, 1, '2019-12-20 09:28:13'),
(448, 1, '00002', 'CHICKEN MANCHURIAN SAUCE', 300, 15, 1, 1, '2019-12-20 09:29:17'),
(449, 1, '00002', 'CHICKEN CHILLY PLUM SAUCE', 300, 15, 1, 1, '2019-12-20 09:30:28'),
(450, 1, '00002', 'CHICKEN HOT BASIL SAUCE', 300, 15, 1, 1, '2019-12-20 09:31:39'),
(451, 1, '00002', 'CHICKEN  KUNG PAO SAUCE', 300, 15, 1, 1, '2019-12-20 09:33:57'),
(452, 1, '00002', 'CHICKEN CHINESE PARSLEY', 300, 15, 1, 1, '2019-12-20 09:35:01'),
(453, 1, '00002', 'CHICKEN BLACK BEANS SAUCE', 300, 15, 1, 1, '2019-12-20 09:36:35'),
(454, 1, '00002', 'CHICKEN THAI CHILLY SAUCE', 300, 15, 1, 1, '2019-12-20 09:37:33'),
(455, 1, '00002', 'PRAWN SZECHUAN SAUCE', 550, 15, 1, 1, '2019-12-20 09:38:45'),
(456, 1, '00002', 'PRAWN MANCHURIAN SAUCE', 550, 15, 1, 1, '2019-12-20 09:39:26'),
(457, 1, '00002', 'PRAWN CHILLY PLUM SAUCE', 550, 15, 1, 1, '2019-12-20 09:40:30'),
(458, 1, '00002', 'PRAWN HOT BASIL SAUCE', 550, 15, 1, 1, '2019-12-20 09:42:05'),
(459, 1, '00002', 'PRAWN KUNG PAO SAUCE', 550, 15, 1, 1, '2019-12-20 09:44:04'),
(460, 1, '00002', 'PRAWN CHINESE PARSLEY', 550, 15, 1, 1, '2019-12-20 09:45:35'),
(461, 1, '00002', 'PRAWN CHINESE PARSLEY', 550, 15, 1, 1, '2019-12-20 09:45:37'),
(462, 1, '00002', 'PRAWN CHINESE PARSLEY', 550, 15, 1, 1, '2019-12-20 09:45:37'),
(463, 1, '00002', 'PRAWN BLACK BEANS SAUCE', 550, 15, 1, 1, '2019-12-20 09:46:43'),
(464, 1, '00002', 'PRAWN THAI CHILLY SAUCE', 550, 15, 1, 1, '2019-12-20 09:49:15'),
(465, 1, '00002', 'PRAWN THAI CHILLY SAUCE', 550, 15, 1, 1, '2019-12-20 09:49:16'),
(466, 1, '00002', 'PRAWN THAI CHILLY SAUCE', 550, 15, 1, 1, '2019-12-20 09:49:16'),
(467, 1, '00002', 'FISH SZECHUAN SAUCE', 385, 15, 1, 1, '2019-12-20 09:55:22'),
(468, 1, '00002', 'FISH MANCHURIAN SAUCE', 385, 15, 1, 1, '2019-12-20 09:56:05'),
(469, 1, '00002', 'FISH CHILLY PLUM SAUCE', 385, 15, 1, 1, '2019-12-20 09:57:06'),
(470, 1, '00002', 'FISH HOT BASIL SAUCE', 385, 15, 1, 1, '2019-12-20 09:58:00'),
(471, 1, '00002', 'FISH KUNG PAO SAUCE', 385, 15, 1, 1, '2019-12-20 09:59:43'),
(472, 1, '00002', 'FISH CHINESE PARSLEY SAUCE', 385, 15, 1, 1, '2019-12-20 10:01:00'),
(473, 1, '00002', 'FISH BLACK BEANS SAUCE', 385, 15, 1, 1, '2019-12-20 10:02:01'),
(474, 1, '00002', 'FISH THAI CHILLY SAUCE', 385, 15, 1, 1, '2019-12-20 10:02:54'),
(475, 1, '00002', 'PARTY BUFFET', 476, 15, 1, 1, '2019-12-22 10:09:51'),
(476, 1, '00002', 'PACKET LUNCH', 381, 17, 1, 1, '2019-12-22 11:33:39'),
(479, 1, '00002', 'ice cream', 130, 16, 1, 1, '2019-12-31 10:21:46'),
(486, 43, '00002', 'Beer', 150, 5, 1, 1, '2020-01-07 06:59:46'),
(487, 43, '00002', 'Vodka', 120, 0, 1, 1, '2020-01-07 07:10:22'),
(488, 43, '00002', 'AC Black', 130, 10, 1, 1, '2020-01-07 12:31:16'),
(489, 43, '00002', 'RS barrel', 150, 8, 1, 1, '2020-01-07 12:33:26'),
(490, 43, '00002', 'Signature', 151, 8, 1, 1, '2020-01-07 12:33:55'),
(491, 43, '00002', 'Officers Choice', 180, 12, 1, 1, '2020-01-07 12:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `manager_code` varchar(255) NOT NULL,
  `table_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `suggestion` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `waiter_id` int(11) NOT NULL,
  `chef_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `bill_request` int(11) NOT NULL DEFAULT 0,
  `menu_type` int(11) NOT NULL,
  `starttime` time NOT NULL DEFAULT '00:00:00',
  `endtime` time NOT NULL DEFAULT '00:00:00',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `customer_id`, `orderid`, `manager_code`, `table_id`, `category_id`, `menu_id`, `qty`, `suggestion`, `order_status`, `waiter_id`, `chef_id`, `status`, `bill_request`, `menu_type`, `starttime`, `endtime`, `created_at`) VALUES
(27, 39, '50', '00001', 1, 1, 1, 20, '', 1, 1, 0, 1, 2, 1, '00:00:00', '00:00:00', '2020-03-06 07:10:09'),
(28, 39, '50', '00001', 1, 1, 2, 6, '', 1, 1, 0, 1, 2, 1, '00:00:00', '00:00:00', '2020-03-06 07:10:09'),
(29, 39, '50', '00001', 1, 1, 3, 1, '', 1, 1, 0, 1, 2, 1, '00:00:00', '00:00:00', '2020-03-06 07:10:09'),
(30, 40, '51', '00001', 2, 1, 1, 5, '', 1, 1, 0, 1, 1, 1, '00:00:00', '00:00:00', '2020-03-06 07:19:20'),
(31, 40, '51', '00001', 2, 1, 2, 2, '', 1, 1, 0, 1, 1, 1, '00:00:00', '00:00:00', '2020-03-06 07:19:20'),
(32, 40, '51', '00001', 2, 1, 3, 3, '', 1, 1, 0, 1, 1, 1, '00:00:00', '00:00:00', '2020-03-06 07:19:20'),
(33, 41, '52', '00001', 4, 1, 1, 20, '', 1, 1, 0, 1, 0, 1, '00:00:00', '00:00:00', '2020-06-02 05:55:56'),
(34, 41, '52', '00001', 4, 1, 2, 22, '', 1, 1, 0, 1, 0, 1, '00:00:00', '00:00:00', '2020-06-02 05:55:56'),
(35, 41, '52', '00001', 4, 1, 4, 30, '', 1, 1, 0, 1, 0, 1, '00:00:00', '00:00:00', '2020-06-02 05:55:56'),
(36, 41, '52', '00001', 4, 1, 14, 2, '', 1, 1, 0, 1, 0, 1, '00:00:00', '00:00:00', '2020-06-02 05:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `cgst` double(8,2) NOT NULL,
  `sgst` double(8,2) NOT NULL,
  `vat` double(8,2) NOT NULL,
  `coupan_code` varchar(50) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `packaging_amount` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `order_id`, `customer_id`, `payment_mode`, `cgst`, `sgst`, `vat`, `coupan_code`, `discount`, `total`, `packaging_amount`, `payment_amount`, `created_at`) VALUES
(1, 3, 3, 'card', 9.50, 9.50, 0.00, 'HS1II5', 20, 399, 10, 389, '2020-01-31 09:11:31'),
(2, 2, 2, 'card', 11.50, 11.50, 0.00, 'HS1II5', 20, 483, 0, 463, '2020-01-31 09:29:36'),
(3, 1, 1, 'card', 41.75, 41.75, 0.00, '', 0, 1754, 10, 1764, '2020-01-31 09:59:03'),
(4, 4, 4, 'card', 10.75, 10.75, 0.00, 'HS1II5', 20, 452, 0, 432, '2020-01-31 10:03:41'),
(5, 4, 4, 'card', 10.75, 10.75, 0.00, 'HS1II5', 20, 452, 0, 432, '2020-01-31 10:04:34'),
(6, 5, 5, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:07:37'),
(7, 6, 6, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:11:10'),
(8, 7, 7, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:15:54'),
(9, 8, 8, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:21:32'),
(10, 9, 9, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:24:47'),
(11, 10, 10, 'card', 5.75, 5.75, 0.00, '', 0, 242, 10, 252, '2020-01-31 10:32:40'),
(12, 12, 12, 'card', 7.50, 7.50, 0.00, '', 0, 315, 10, 325, '2020-01-31 10:34:34'),
(13, 11, 11, 'cash', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:35:42'),
(14, 15, 15, 'card', 10.75, 10.75, 0.00, '', 0, 452, 10, 462, '2020-01-31 10:38:00'),
(15, 14, 14, 'card', 5.75, 5.75, 0.00, '', 0, 242, 10, 252, '2020-01-31 10:45:44'),
(16, 14, 14, 'card', 5.75, 5.75, 0.00, '', 0, 242, 10, 252, '2020-01-31 10:45:53'),
(17, 17, 17, 'card', 7.50, 7.50, 0.00, 'HS1II5', 20, 315, 10, 305, '2020-01-31 10:49:53'),
(18, 16, 16, 'card', 8.25, 8.25, 0.00, 'HS1II5', 20, 347, 0, 327, '2020-01-31 10:50:57'),
(19, 16, 16, 'card', 8.25, 8.25, 0.00, 'HS1II5', 20, 347, 0, 327, '2020-01-31 10:51:08'),
(20, 13, 13, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:51:46'),
(21, 13, 13, 'card', 11.50, 11.50, 0.00, '', 0, 483, 10, 493, '2020-01-31 10:51:56'),
(22, 18, 18, 'card', 11.50, 11.50, 0.00, 'HS1II5', 20, 483, 10, 473, '2020-01-31 11:00:06'),
(23, 19, 19, 'card', 11.50, 11.50, 0.00, '8R6E9Z', 10, 483, 10, 445, '2020-01-31 11:03:32'),
(24, 19, 19, 'card', 11.50, 11.50, 0.00, '8R6E9Z', 10, 483, 10, 445, '2020-01-31 11:03:40'),
(25, 1, 20, 'card', 28.00, 28.00, 0.00, '', 0, 1176, 0, 1176, '2020-01-31 11:39:24'),
(26, 4, 23, 'card', 7.13, 7.13, 0.00, '', 0, 299, 10, 309, '2020-02-03 10:51:37'),
(27, 5, 24, 'card', 7.13, 7.13, 0.00, '', 0, 299, 10, 309, '2020-02-03 10:53:58'),
(28, 6, 25, 'card', 7.13, 7.13, 0.00, '', 0, 299, 10, 309, '2020-02-03 10:56:47'),
(29, 7, 26, 'card', 7.13, 7.13, 0.00, '', 0, 299, 10, 309, '2020-02-03 11:00:16'),
(30, 8, 27, 'card', 7.13, 7.13, 0.00, '', 0, 299, 10, 309, '2020-02-03 11:03:00'),
(31, 8, 27, 'card', 7.13, 7.13, 0.00, '', 0, 299, 10, 309, '2020-02-03 11:03:05'),
(32, 50, 39, 'card', 80.75, 80.75, 0.00, '', 0, 3392, 0, 3392, '2020-03-06 07:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`id`, `state_name`, `status`) VALUES
(1, 'Andhra Pradesh', 1),
(2, 'Arunachal Pradesh', 1),
(3, 'Assam', 1),
(4, 'Bihar', 1),
(5, 'Chhattisgarh', 1),
(6, 'Goa', 1),
(7, 'Gujarat', 1),
(8, 'Haryana', 1),
(9, 'Himachal Pradesh', 1),
(10, 'Jammu and Kashmir', 1),
(11, 'Jharkhand', 1),
(12, 'Karnataka', 1),
(13, 'Kerala', 1),
(14, 'Madhya Pradesh', 1),
(15, 'Maharashtra', 1),
(16, 'Manipur', 1),
(17, 'Meghalaya', 1),
(18, 'Mizoram', 1),
(19, 'Nagaland', 1),
(20, 'Odisha', 1),
(21, 'Punjab', 1),
(22, 'Rajasthan', 1),
(23, 'Sikkim', 1),
(24, 'Tamil Nadu', 1),
(25, 'Telangana', 1),
(26, 'Tripura', 1),
(27, 'Uttar Pradesh', 1),
(28, 'Uttarakhand', 1),
(29, 'West Bengal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_super_admin`
--

CREATE TABLE `tbl_super_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_super_admin`
--

INSERT INTO `tbl_super_admin` (`id`, `username`, `password`, `roles`, `status`) VALUES
(1, 'admin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_table`
--

CREATE TABLE `tbl_table` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `manager_code` varchar(255) NOT NULL,
  `table_number` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_table`
--

INSERT INTO `tbl_table` (`id`, `branch_id`, `manager_code`, `table_number`, `status`, `created_at`) VALUES
(1, 5, '00001', '101', 0, '2019-10-22 12:14:55'),
(2, 5, '00001', '102', 0, '2019-10-22 12:15:24'),
(3, 5, '00001', '103', 0, '2019-10-22 12:20:16'),
(4, 5, '00001', '104', 0, '2019-10-22 12:20:22'),
(5, 5, '00001', '105', 0, '2019-10-22 12:20:27'),
(6, 5, '00001', '106', 0, '2019-10-22 12:20:32'),
(7, 5, '00001', '107', 1, '2019-10-22 12:20:37'),
(8, 5, '00001', '108', 1, '2019-10-22 12:20:42'),
(9, 5, '00001', '109', 1, '2019-10-22 12:20:48'),
(10, 5, '00001', '110', 1, '2019-10-22 12:20:55'),
(11, 4, '00002', '10', 0, '2019-10-22 12:22:31'),
(12, 4, '00002', '09', 1, '2019-10-22 12:22:37'),
(13, 4, '00002', '08', 1, '2019-10-22 12:22:42'),
(14, 4, '00002', '07', 1, '2019-10-22 12:22:47'),
(15, 4, '00002', '06', 1, '2019-10-22 12:22:52'),
(16, 4, '00002', '05', 1, '2019-10-22 12:22:56'),
(17, 4, '00002', '04', 1, '2019-10-22 12:23:01'),
(18, 4, '00002', '03', 1, '2019-10-22 12:23:05'),
(19, 4, '00002', '02', 1, '2019-10-22 12:23:09'),
(20, 4, '00002', '01', 1, '2019-10-22 12:23:14'),
(21, 3, '00003', '301', 1, '2019-10-22 12:24:09'),
(22, 3, '00003', '302', 1, '2019-10-22 12:24:15'),
(23, 3, '00003', '303', 1, '2019-10-22 12:24:22'),
(24, 3, '00003', '304', 1, '2019-10-22 12:24:27'),
(25, 3, '00003', '305', 1, '2019-10-22 12:24:33'),
(26, 3, '00003', '306', 1, '2019-10-22 12:24:39'),
(27, 3, '00003', '307', 1, '2019-10-22 12:24:46'),
(28, 3, '00003', '308', 1, '2019-10-22 12:24:53'),
(29, 3, '00003', '309', 1, '2019-10-22 12:24:57'),
(30, 3, '00003', '310', 1, '2019-10-22 12:25:03'),
(31, 2, '00004', '401', 1, '2019-10-22 12:26:16'),
(32, 2, '00004', '402', 1, '2019-10-22 12:26:21'),
(33, 2, '00004', '403', 1, '2019-10-22 12:26:25'),
(34, 2, '00004', '404', 1, '2019-10-22 12:26:28'),
(35, 2, '00004', '405', 1, '2019-10-22 12:26:32'),
(36, 2, '00004', '406', 1, '2019-10-22 12:26:36'),
(37, 2, '00004', '407', 1, '2019-10-22 12:26:40'),
(38, 2, '00004', '408', 1, '2019-10-22 12:26:43'),
(39, 2, '00004', '409', 1, '2019-10-22 12:26:47'),
(40, 2, '00004', '410', 1, '2019-10-22 12:26:52'),
(41, 1, '00005', '501', 1, '2019-10-22 12:27:22'),
(42, 1, '00005', '502', 1, '2019-10-22 12:27:26'),
(43, 1, '00005', '503', 1, '2019-10-22 12:27:30'),
(44, 1, '00005', '504', 1, '2019-10-22 12:27:34'),
(45, 1, '00005', '505', 1, '2019-10-22 12:27:38'),
(46, 1, '00005', '506', 1, '2019-10-22 12:27:43'),
(47, 1, '00005', '507', 1, '2019-10-22 12:28:20'),
(48, 1, '00005', '508', 1, '2019-10-22 12:28:24'),
(49, 1, '00005', '509', 1, '2019-10-22 12:28:28'),
(50, 1, '00005', '510', 1, '2019-10-22 12:28:32'),
(51, 5, '00001', '111', 1, '2019-12-02 12:19:36'),
(52, 5, '00001', '04', 1, '2019-12-06 07:47:17'),
(53, 4, '00002', '11', 1, '2019-12-07 05:21:04'),
(54, 4, '00002', '12', 1, '2019-12-07 05:21:17'),
(55, 4, '00002', '14', 1, '2019-12-07 05:21:24'),
(56, 4, '00002', '15', 1, '2019-12-07 05:21:30'),
(57, 4, '00002', '16', 1, '2019-12-07 05:21:36'),
(58, 4, '00002', '17', 1, '2019-12-07 05:21:42'),
(59, 4, '00002', '100', 1, '2019-12-18 14:27:29'),
(60, 4, '00002', '18', 1, '2019-12-31 11:56:46'),
(61, 4, '00002', '19', 1, '2019-12-31 11:56:51'),
(62, 4, '00002', '20', 1, '2019-12-31 11:56:57'),
(63, 4, '00002', '21', 1, '2019-12-31 11:57:02'),
(64, 4, '00002', '1', 1, '2019-12-31 12:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `id` int(11) NOT NULL,
  `menu_type` varchar(10) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_percentage` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`id`, `menu_type`, `tax_name`, `tax_percentage`, `status`, `created_at`) VALUES
(5, '1', 'CGST', 2.50, 1, '2019-10-31 11:43:04'),
(6, '1', 'SGST', 2.50, 1, '2019-10-31 11:43:45'),
(7, '2', 'VAT', 6.00, 1, '2019-10-31 11:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_order`
--

CREATE TABLE `tbl_temp_order` (
  `id` int(11) NOT NULL,
  `ordid` int(11) NOT NULL,
  `waiter_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `suggestion` varchar(255) DEFAULT NULL,
  `menu_type` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_temp_order`
--

INSERT INTO `tbl_temp_order` (`id`, `ordid`, `waiter_id`, `category_id`, `menu_id`, `qty`, `suggestion`, `menu_type`, `status`) VALUES
(79, 50, 1, 1, 1, 20, NULL, 1, 0),
(80, 50, 1, 1, 2, 6, NULL, 1, 0),
(81, 50, 1, 1, 3, 1, NULL, 1, 0),
(82, 51, 1, 1, 1, 5, NULL, 1, 0),
(83, 51, 1, 1, 2, 2, NULL, 1, 0),
(84, 51, 1, 1, 3, 3, NULL, 1, 0),
(85, 52, 1, 1, 1, 20, NULL, 1, 0),
(86, 52, 1, 1, 2, 22, NULL, 1, 0),
(87, 52, 1, 1, 4, 30, NULL, 1, 0),
(88, 52, 1, 1, 14, 2, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_waiter`
--

CREATE TABLE `tbl_waiter` (
  `id` int(11) NOT NULL,
  `manager_code` varchar(255) NOT NULL,
  `waiter_code` varchar(255) NOT NULL,
  `waiter_name` varchar(255) NOT NULL,
  `waiter_address` text NOT NULL,
  `waiter_city` varchar(255) NOT NULL,
  `waiter_pincode` varchar(6) NOT NULL,
  `waiter_mobile` varchar(12) NOT NULL,
  `waiter_email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT 'waiter',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_waiter`
--

INSERT INTO `tbl_waiter` (`id`, `manager_code`, `waiter_code`, `waiter_name`, `waiter_address`, `waiter_city`, `waiter_pincode`, `waiter_mobile`, `waiter_email`, `username`, `password`, `roles`, `status`, `created_at`) VALUES
(1, '00001', '00001', 'Pwaiter1', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Panvel', 'Panvel', '400618', '9800000001', 'pwaiter1@mobisofttech.co.in', 'pwaiter1', 'pwaiter1', 'waiter', 1, '2019-10-17 11:15:11'),
(2, '00001', '00002', 'Pwaiter2', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Panvel', 'Panvel', '400618', '9800000002', 'pwaiter2@mobisofttech.co.in', 'pwaiter2', 'pwaiter2', 'waiter', 1, '2019-10-17 12:24:59'),
(3, '00001', '00003', 'Pwaiter3', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Panvel', 'Panvel', '400618', '9800000003', 'pwaiter3@mobisofttech.co.in', 'pwaiter3', 'pwaiter3', 'waiter', 1, '2019-10-17 12:30:20'),
(4, '00001', '00004', 'Pwaiter4', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Panvel', 'Panvel', '400618', '9800000004', 'pwaiter4@mobisofttech.co.in', 'pwaiter4', 'pwaiter4', 'waiter', 0, '2019-10-17 12:39:07'),
(5, '00002', '00005', 'Swaiter1', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Seawoods', 'Seawoods', '400706', '9800000014', 'swaiter1@mobisofttech.co.in', 'swaiter1', 'swaiter1', 'waiter', 1, '2019-10-22 12:39:31'),
(6, '00002', '00006', 'Swaiter2', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Seawoods', 'Seawoods', '400706', '9800000015', 'swaiter2@mobisofttech.co.in', 'swaiter2', 'swaiter2', 'waiter', 1, '2019-10-22 12:40:42'),
(7, '00002', '00007', 'Swaiter3', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Seawoods', 'Seawoods', '400706', '9800000016', 'swaiter3@mobisofttech.co.in', 'Swaiter3', 'Swaiter3', 'waiter', 1, '2019-10-22 12:46:16'),
(8, '00002', '00008', 'Swaiter4', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Seawoods', 'Seawoods', '400706', '9800000017', 'swaiter4@mobisofttech.co.in', 'Swaiter4', 'Swaiter4', 'waiter', 1, '2019-10-22 12:47:19'),
(9, '00002', '00009', 'Swaiter5', 'Office # 314, Sai Chamber, Sec.11 Above HDFC Bank, Seawoods', 'Seawoods', '400706', '9800000018', 'swaiter5@mobisofttech.co.in', 'Swaiter5', 'Swaiter5', 'waiter', 0, '2019-10-22 12:48:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `create_order_id`
--
ALTER TABLE `create_order_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_chef`
--
ALTER TABLE `tbl_chef`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_coupan`
--
ALTER TABLE `tbl_coupan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_table`
--
ALTER TABLE `tbl_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_temp_order`
--
ALTER TABLE `tbl_temp_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_waiter`
--
ALTER TABLE `tbl_waiter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `create_order_id`
--
ALTER TABLE `create_order_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_chef`
--
ALTER TABLE `tbl_chef`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_coupan`
--
ALTER TABLE `tbl_coupan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_manager`
--
ALTER TABLE `tbl_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_super_admin`
--
ALTER TABLE `tbl_super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_table`
--
ALTER TABLE `tbl_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_temp_order`
--
ALTER TABLE `tbl_temp_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tbl_waiter`
--
ALTER TABLE `tbl_waiter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 09:30 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_id`, `user_id`, `operations`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '38', 'Added Raw Material To The Category List', '2019-05-18 07:14:22', '2019-05-18 07:14:22', NULL),
(2, '38', 'Added Consumables To The Category List', '2019-05-18 07:14:34', '2019-05-18 07:14:34', NULL),
(3, '38', 'You Have AddedCap seal (Small and Big)with Size NullTo raw material', '2019-05-18 07:15:07', '2019-05-18 07:15:07', NULL),
(4, '38', 'You Have UpdatedCap Seal (small And Big)with Size 20 LitresTo raw material', '2019-05-18 07:15:45', '2019-05-18 07:15:45', NULL),
(5, '38', 'You Have UpdatedCap Seal (small And Big)with Size NullTo raw material', '2019-05-18 07:19:24', '2019-05-18 07:19:24', NULL),
(6, '38', 'Restored   Cap Seal (small And Big)  To The Production Material List', '2019-05-18 07:20:27', '2019-05-18 07:20:27', NULL),
(7, '38', 'Added Test supplier To The Supplier List', '2019-05-18 07:28:50', '2019-05-18 07:28:50', NULL),
(8, '38', 'Added Test supplier To The Supplier List', '2019-05-18 07:33:41', '2019-05-18 07:33:41', NULL),
(9, '38', 'Changed The Supplier E-Mail From  test@gmail.com  Totest@gmail.com', '2019-05-18 07:35:09', '2019-05-18 07:35:09', NULL),
(10, '38', 'Added Test Two To The Supplier List', '2019-05-18 07:48:50', '2019-05-18 07:48:50', NULL),
(11, '35', 'Login Successfully', '2019-05-18 12:17:37', '2019-05-18 12:17:37', NULL),
(12, '37', 'Login Successfully', '2019-05-18 12:19:36', '2019-05-18 12:19:36', NULL),
(13, '37', 'Changed User Email From From administrator@gmail.com To administrator@gmail.com', '2019-05-18 12:21:35', '2019-05-18 12:21:35', NULL),
(14, '38', 'Login Successfully', '2019-05-18 12:22:15', '2019-05-18 12:22:15', NULL),
(15, '38', 'Added Test Supp To The Supplier List', '2019-05-18 12:23:51', '2019-05-18 12:23:51', NULL),
(16, '38', 'Changed The Supplier E-Mail From  test@gmail.com  Totest@gmail.com', '2019-05-18 12:25:09', '2019-05-18 12:25:09', NULL),
(17, '38', 'Restored   test@gmail.com  To The Supplier\'s List', '2019-05-18 12:27:53', '2019-05-18 12:27:53', NULL),
(18, '38', 'Added testing@gmail.com To The Distributor List', '2019-05-18 12:29:49', '2019-05-18 12:29:49', NULL),
(19, '38', 'Changed The Distributor E-Mail From  testing@gmail.com  Totest@gmail.com', '2019-05-18 12:30:34', '2019-05-18 12:30:34', NULL),
(20, '38', 'Restored   test@gmail.com  To The Distributor\'s List', '2019-05-18 12:33:11', '2019-05-18 12:33:11', NULL),
(21, '38', 'Restored   test@gmail.com  To The Distributor\'s List', '2019-05-18 12:35:22', '2019-05-18 12:35:22', NULL),
(22, '38', 'Added Feed Well Makola Outlet For Distributor Test Distributor', '2019-05-18 12:36:54', '2019-05-18 12:36:54', NULL),
(23, '38', 'Updated The Outlet Details ', '2019-05-18 12:37:52', '2019-05-18 12:37:52', NULL),
(24, '38', 'Restored   Feed Well Bodija  To The Outlet List', '2019-05-18 12:38:31', '2019-05-18 12:38:31', NULL),
(25, '38', 'Added Test Ware House To The Ware House List', '2019-05-18 12:47:59', '2019-05-18 12:47:59', NULL),
(26, '38', 'Updated  Testing Ware House  Ware House Details', '2019-05-18 12:48:51', '2019-05-18 12:48:51', NULL),
(27, '38', 'Restored   Testing Ware House  To The Ware House List List', '2019-05-18 12:49:49', '2019-05-18 12:49:49', NULL),
(28, '38', 'Added emp@gmail.com To The Employee List', '2019-05-18 12:52:24', '2019-05-18 12:52:24', NULL),
(29, '38', 'Changed The Employee E-Mail From  emp@gmail.com  Toemp@gmail.com', '2019-05-18 12:53:02', '2019-05-18 12:53:02', NULL),
(30, '38', 'Deleted  Testing Employee  From The Employee List', '2019-05-18 12:54:51', '2019-05-18 12:54:51', NULL),
(31, '38', 'Restored   emp@gmail.com  To The employee List', '2019-05-18 12:55:53', '2019-05-18 12:55:53', NULL),
(32, '38', 'Deleted  Testing Employee  From The Employee List', '2019-05-18 12:56:36', '2019-05-18 12:56:36', NULL),
(33, '38', 'Restored   emp@gmail.com  To The employee List', '2019-05-18 12:57:38', '2019-05-18 12:57:38', NULL),
(34, '38', 'Deleted  Testing Employee  From The Employee List', '2019-05-18 12:57:56', '2019-05-18 12:57:56', NULL),
(35, '38', 'Restored   emp@gmail.com  To The employee List', '2019-05-18 12:59:41', '2019-05-18 12:59:41', NULL),
(36, '34', 'Login Successfully', '2019-05-18 13:14:12', '2019-05-18 13:14:12', NULL),
(37, '34', 'Computed Salary For Testing Employee for the month of  May-2019', '2019-05-18 13:15:39', '2019-05-18 13:15:39', NULL),
(38, '34', 'Updated Salary For Testing Employee for the month of  May-2019', '2019-05-18 13:17:18', '2019-05-18 13:17:18', NULL),
(39, '34', 'Updated Salary For Testing Employee for the month of  May-2019', '2019-05-18 13:20:37', '2019-05-18 13:20:37', NULL),
(40, '34', 'Updated Salary For Testing Employee for the month of  May-2019', '2019-05-18 13:22:14', '2019-05-18 13:22:14', NULL),
(41, '35', 'Login Successfully', '2019-05-18 13:45:21', '2019-05-18 13:45:21', NULL),
(42, '38', 'Login Successfully', '2019-05-18 13:47:03', '2019-05-18 13:47:03', NULL),
(43, '38', 'Added  To The Supplier List', '2019-05-18 14:02:13', '2019-05-18 14:02:13', NULL),
(44, '38', 'You Have AddedGYwith Size 20 LitresTo raw material', '2019-05-18 14:08:00', '2019-05-18 14:08:00', NULL),
(45, '35', 'Login Successfully', '2019-05-18 14:14:13', '2019-05-18 14:14:13', NULL),
(46, '37', 'Login Successfully', '2019-05-18 14:15:09', '2019-05-18 14:15:09', NULL),
(47, '38', 'Login Successfully', '2019-05-18 14:17:07', '2019-05-18 14:17:07', NULL),
(48, '38', 'Updated  Testing Ware House  Ware House Details', '2019-05-18 14:17:55', '2019-05-18 14:17:55', NULL),
(49, '35', 'Login Successfully', '2019-05-18 14:18:16', '2019-05-18 14:18:16', NULL),
(50, '35', 'Added Order ACC400E347B4  For Distributor Test Distributor', '2019-05-18 14:21:45', '2019-05-18 14:21:45', NULL),
(51, '38', 'Login Successfully', '2019-05-18 14:25:28', '2019-05-18 14:25:28', NULL),
(52, '35', 'Login Successfully', '2019-05-18 14:29:47', '2019-05-18 14:29:47', NULL),
(53, '35', 'Added Order 9DA998B89AED  For Distributor Test Distributor', '2019-05-18 14:31:01', '2019-05-18 14:31:01', NULL),
(54, '35', 'Added Order FF7C156678EC  For Distributor Test Distributor', '2019-05-18 14:31:54', '2019-05-18 14:31:54', NULL),
(55, '35', 'Added Order B6503DE0FFCA  For Distributor Test Distributor', '2019-05-18 14:34:47', '2019-05-18 14:34:47', NULL),
(56, '35', 'Added Order 48046AFEF5F1  For Distributor Test Distributor', '2019-05-18 14:39:40', '2019-05-18 14:39:40', NULL),
(57, '38', 'Login Successfully', '2019-05-18 14:47:03', '2019-05-18 14:47:03', NULL),
(58, '38', 'Added  To The Supplier List', '2019-05-18 14:48:07', '2019-05-18 14:48:07', NULL),
(59, '38', 'Added  To The Supplier List', '2019-05-18 14:48:55', '2019-05-18 14:48:55', NULL),
(60, '35', 'Login Successfully', '2019-05-18 14:49:24', '2019-05-18 14:49:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assign_outlets`
--

CREATE TABLE `assign_outlets` (
  `assign_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_outlets`
--

INSERT INTO `assign_outlets` (`assign_id`, `outlet_id`, `distributor_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, '2019-04-13 20:47:18', '2019-04-13 20:47:18', NULL),
(2, 2, 6, '2019-04-13 20:47:49', '2019-04-13 20:47:49', NULL),
(3, 2, 5, '2019-04-13 20:54:27', '2019-04-13 20:54:27', NULL),
(4, 4, 3, '2019-04-13 21:00:31', '2019-04-13 21:00:31', NULL),
(5, 4, 3, '2019-04-15 12:00:02', '2019-04-15 12:00:02', NULL),
(6, 4, 5, '2019-04-24 22:48:20', '2019-04-24 22:48:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'raw material', '2019-05-18 07:14:22', '2019-05-18 07:14:22', NULL),
(2, 'consumables', '2019-05-18 07:14:34', '2019-05-18 07:14:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_managements`
--

CREATE TABLE `credit_managements` (
  `credit_id` int(255) NOT NULL,
  `payment_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `paid_status` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_payments`
--

CREATE TABLE `credit_payments` (
  `pay_id` bigint(20) UNSIGNED NOT NULL,
  `credit_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` int(255) NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `distributor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_one` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_two` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_limit` int(11) NOT NULL,
  `credit_reduction_per_month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`distributor_id`, `name`, `phone_one`, `phone_two`, `email`, `address`, `credit_limit`, `credit_reduction_per_month`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'test distributor', '09093383777', 'Null', 'test@gmail.com', 'New Estate', 10000, '1000', '2019-05-18 12:35:22', '2019-05-18 12:29:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `full_name`, `address`, `phone_number`, `contract_type`, `email`, `ware_house_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Testing Employee', 'Lagos Ibadan', '09087768666', 'Temporary Staff', 'emp@gmail.com', 1, '2019-05-18 12:59:41', '2019-05-18 12:52:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stocks`
--

CREATE TABLE `inventory_stocks` (
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(255) NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `variant_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_stocks`
--

INSERT INTO `inventory_stocks` (`stock_id`, `product_name`, `supplier_id`, `ware_house_id`, `variant_id`, `category_id`, `quantity`, `deleted_at`, `updated_at`, `created_at`) VALUES
(1, '1lt honey', 1, 1, 1, 1, 90, NULL, '2019-05-18 14:02:13', '2019-05-18 14:02:13'),
(2, 'casio calculator', 1, 1, 1, 1, 10, NULL, '2019-05-18 14:48:07', '2019-05-18 14:48:07'),
(3, '2 litres', 1, 1, 2, 1, 80, NULL, '2019-05-18 14:48:55', '2019-05-18 14:48:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_08_143418_create_outlets_table', 1),
(4, '2019_04_08_144117_create_suppliers_table', 1),
(5, '2019_04_08_144314_create_distributors_table', 1),
(6, '2019_04_08_144513_create_products_table', 1),
(7, '2019_04_08_145017_create_orders_table', 1),
(8, '2019_04_08_145234_create_customers_table', 1),
(9, '2019_04_08_145741_create_employees_table', 1),
(10, '2019_04_08_150220_create_ware_house_managements_table', 1),
(11, '2019_04_08_151419_create_product_variants_table', 1),
(12, '2019_04_08_151907_create_account_managements_table', 1),
(13, '2019_04_08_152058_create_inventory_stocks_table', 1),
(14, '2019_04_08_152304_create_sales_table', 1),
(15, '2019_04_08_152432_create_user_roles_table', 1),
(16, '2019_04_09_034032_create_categories_table', 1),
(17, '2019_04_09_042654_create_activity_logs_table', 2),
(18, '2019_04_09_044501_add_category_id_to_products', 3),
(19, '2019_04_10_161600_create_permission_tables', 4),
(20, '2019_04_13_121032_add_status_to_users', 5),
(21, '2019_04_13_163904_create_assign_outlets_table', 6),
(22, '2019_04_17_172658_add_deleted_at_to_suppliers', 7),
(23, '2019_04_22_093307_add_email_verified_at_to_users', 8),
(24, '2019_04_27_064737_create_payments_table', 9),
(25, '2019_04_27_065322_create_credit_managements_table', 9),
(26, '2019_04_27_151937_create_order_details_table', 10),
(27, '2019_05_01_161158_create_credit_payments_table', 11),
(28, '2019_05_11_080808_create_salaries_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(5, 'App\\User', '0'),
(5, 'App\\User', '1'),
(5, 'App\\User', '35'),
(5, 'App\\User', '36'),
(5, 'App\\User', '37'),
(5, 'App\\User', '38'),
(6, 'App\\User', '0'),
(6, 'App\\User', '1'),
(6, 'App\\User', '35'),
(6, 'App\\User', '36'),
(6, 'App\\User', '37'),
(6, 'App\\User', '38'),
(7, 'App\\User', '0'),
(7, 'App\\User', '1'),
(7, 'App\\User', '35'),
(7, 'App\\User', '36'),
(7, 'App\\User', '37'),
(7, 'App\\User', '38'),
(8, 'App\\User', '0'),
(8, 'App\\User', '1'),
(8, 'App\\User', '37'),
(8, 'App\\User', '38'),
(9, 'App\\User', '1'),
(9, 'App\\User', '35'),
(9, 'App\\User', '36'),
(9, 'App\\User', '37'),
(9, 'App\\User', '38'),
(10, 'App\\User', '0'),
(10, 'App\\User', '1'),
(10, 'App\\User', '35'),
(10, 'App\\User', '36'),
(10, 'App\\User', '37'),
(10, 'App\\User', '38'),
(11, 'App\\User', '0'),
(11, 'App\\User', '1'),
(11, 'App\\User', '35'),
(11, 'App\\User', '36'),
(11, 'App\\User', '37'),
(11, 'App\\User', '38'),
(12, 'App\\User', '0'),
(12, 'App\\User', '1'),
(12, 'App\\User', '35'),
(12, 'App\\User', '36'),
(12, 'App\\User', '37'),
(12, 'App\\User', '38'),
(13, 'App\\User', '0'),
(13, 'App\\User', '1'),
(13, 'App\\User', '35'),
(13, 'App\\User', '36'),
(13, 'App\\User', '37'),
(13, 'App\\User', '38'),
(14, 'App\\User', '1'),
(14, 'App\\User', '35'),
(14, 'App\\User', '36'),
(14, 'App\\User', '37'),
(14, 'App\\User', '38'),
(15, 'App\\User', '0'),
(15, 'App\\User', '1'),
(15, 'App\\User', '35'),
(15, 'App\\User', '36'),
(15, 'App\\User', '37'),
(15, 'App\\User', '38'),
(16, 'App\\User', '0'),
(16, 'App\\User', '1'),
(16, 'App\\User', '35'),
(16, 'App\\User', '36'),
(16, 'App\\User', '37'),
(16, 'App\\User', '38'),
(17, 'App\\User', '0'),
(17, 'App\\User', '1'),
(17, 'App\\User', '35'),
(17, 'App\\User', '36'),
(17, 'App\\User', '37'),
(17, 'App\\User', '38'),
(18, 'App\\User', '0'),
(18, 'App\\User', '1'),
(18, 'App\\User', '35'),
(18, 'App\\User', '36'),
(18, 'App\\User', '37'),
(18, 'App\\User', '38'),
(19, 'App\\User', '0'),
(19, 'App\\User', '1'),
(19, 'App\\User', '37'),
(19, 'App\\User', '38'),
(20, 'App\\User', '0'),
(20, 'App\\User', '1'),
(20, 'App\\User', '35'),
(20, 'App\\User', '36'),
(20, 'App\\User', '37'),
(20, 'App\\User', '38'),
(21, 'App\\User', '0'),
(21, 'App\\User', '1'),
(21, 'App\\User', '35'),
(21, 'App\\User', '36'),
(21, 'App\\User', '37'),
(21, 'App\\User', '38'),
(22, 'App\\User', '0'),
(22, 'App\\User', '1'),
(22, 'App\\User', '35'),
(22, 'App\\User', '36'),
(22, 'App\\User', '37'),
(22, 'App\\User', '38'),
(23, 'App\\User', '0'),
(23, 'App\\User', '1'),
(23, 'App\\User', '37'),
(23, 'App\\User', '38'),
(24, 'App\\User', '0'),
(24, 'App\\User', '1'),
(24, 'App\\User', '35'),
(24, 'App\\User', '36'),
(24, 'App\\User', '37'),
(24, 'App\\User', '38'),
(25, 'App\\User', '0'),
(25, 'App\\User', '1'),
(25, 'App\\User', '37'),
(25, 'App\\User', '38'),
(26, 'App\\User', '0'),
(26, 'App\\User', '1'),
(26, 'App\\User', '37'),
(26, 'App\\User', '38'),
(27, 'App\\User', '0'),
(27, 'App\\User', '1'),
(27, 'App\\User', '37'),
(27, 'App\\User', '38'),
(28, 'App\\User', '0'),
(28, 'App\\User', '1'),
(28, 'App\\User', '37'),
(28, 'App\\User', '38'),
(29, 'App\\User', '1'),
(29, 'App\\User', '34'),
(29, 'App\\User', '35'),
(29, 'App\\User', '36'),
(29, 'App\\User', '37'),
(29, 'App\\User', '38'),
(29, 'App\\User', '48'),
(30, 'App\\User', '1'),
(30, 'App\\User', '34'),
(30, 'App\\User', '35'),
(30, 'App\\User', '36'),
(30, 'App\\User', '37'),
(30, 'App\\User', '38'),
(30, 'App\\User', '48'),
(31, 'App\\User', '1'),
(31, 'App\\User', '37'),
(31, 'App\\User', '38'),
(32, 'App\\User', '1'),
(32, 'App\\User', '34'),
(32, 'App\\User', '35'),
(32, 'App\\User', '36'),
(32, 'App\\User', '37'),
(32, 'App\\User', '38'),
(32, 'App\\User', '48'),
(34, 'App\\User', '0'),
(34, 'App\\User', '1'),
(34, 'App\\User', '38'),
(35, 'App\\User', '0'),
(35, 'App\\User', '1'),
(35, 'App\\User', '38'),
(36, 'App\\User', '0'),
(36, 'App\\User', '1'),
(36, 'App\\User', '38'),
(37, 'App\\User', '0'),
(37, 'App\\User', '1'),
(37, 'App\\User', '38'),
(38, 'App\\User', '0'),
(38, 'App\\User', '1'),
(38, 'App\\User', '37'),
(38, 'App\\User', '38'),
(39, 'App\\User', '0'),
(39, 'App\\User', '1'),
(39, 'App\\User', '37'),
(39, 'App\\User', '38'),
(40, 'App\\User', '0'),
(40, 'App\\User', '1'),
(40, 'App\\User', '37'),
(40, 'App\\User', '38'),
(41, 'App\\User', '0'),
(41, 'App\\User', '1'),
(41, 'App\\User', '37'),
(41, 'App\\User', '38'),
(42, 'App\\User', '0'),
(42, 'App\\User', '1'),
(42, 'App\\User', '37'),
(42, 'App\\User', '38'),
(43, 'App\\User', '0'),
(43, 'App\\User', '1'),
(43, 'App\\User', '37'),
(43, 'App\\User', '38'),
(44, 'App\\User', '0'),
(44, 'App\\User', '1'),
(44, 'App\\User', '37'),
(44, 'App\\User', '38'),
(45, 'App\\User', '0'),
(45, 'App\\User', '1'),
(45, 'App\\User', '37'),
(45, 'App\\User', '38'),
(46, 'App\\User', '0'),
(46, 'App\\User', '1'),
(46, 'App\\User', '34'),
(46, 'App\\User', '37'),
(46, 'App\\User', '38'),
(46, 'App\\User', '48'),
(47, 'App\\User', '0'),
(47, 'App\\User', '1'),
(47, 'App\\User', '37'),
(47, 'App\\User', '38'),
(48, 'App\\User', '0'),
(48, 'App\\User', '1'),
(48, 'App\\User', '34'),
(48, 'App\\User', '37'),
(48, 'App\\User', '38'),
(48, 'App\\User', '48'),
(49, 'App\\User', '0'),
(49, 'App\\User', '1'),
(49, 'App\\User', '34'),
(49, 'App\\User', '37'),
(49, 'App\\User', '38'),
(49, 'App\\User', '48'),
(51, 'App\\User', '0'),
(51, 'App\\User', '1'),
(51, 'App\\User', '37'),
(51, 'App\\User', '38'),
(52, 'App\\User', '0'),
(52, 'App\\User', '1'),
(52, 'App\\User', '34'),
(52, 'App\\User', '37'),
(52, 'App\\User', '38'),
(52, 'App\\User', '48'),
(53, 'App\\User', '0'),
(53, 'App\\User', '1'),
(53, 'App\\User', '34'),
(53, 'App\\User', '37'),
(53, 'App\\User', '38'),
(53, 'App\\User', '48'),
(54, 'App\\User', '0'),
(54, 'App\\User', '1'),
(54, 'App\\User', '34'),
(54, 'App\\User', '37'),
(54, 'App\\User', '38'),
(54, 'App\\User', '48'),
(59, 'App\\User', '1'),
(59, 'App\\User', '37'),
(59, 'App\\User', '38'),
(60, 'App\\User', '1'),
(60, 'App\\User', '37'),
(60, 'App\\User', '38'),
(61, 'App\\User', '1'),
(61, 'App\\User', '37'),
(61, 'App\\User', '38'),
(62, 'App\\User', '1'),
(62, 'App\\User', '37'),
(62, 'App\\User', '38'),
(63, 'App\\User', '1'),
(63, 'App\\User', '37'),
(63, 'App\\User', '38'),
(64, 'App\\User', '1'),
(64, 'App\\User', '37'),
(64, 'App\\User', '38'),
(65, 'App\\User', '1'),
(65, 'App\\User', '38'),
(66, 'App\\User', '1'),
(66, 'App\\User', '37'),
(66, 'App\\User', '38'),
(67, 'App\\User', '1'),
(67, 'App\\User', '37'),
(67, 'App\\User', '38'),
(68, 'App\\User', '1'),
(68, 'App\\User', '37'),
(68, 'App\\User', '38'),
(69, 'App\\User', '1'),
(69, 'App\\User', '37'),
(69, 'App\\User', '38'),
(70, 'App\\User', '1'),
(70, 'App\\User', '34'),
(70, 'App\\User', '35'),
(70, 'App\\User', '36'),
(70, 'App\\User', '37'),
(70, 'App\\User', '38'),
(70, 'App\\User', '48'),
(71, 'App\\User', '1'),
(71, 'App\\User', '34'),
(71, 'App\\User', '35'),
(71, 'App\\User', '36'),
(71, 'App\\User', '37'),
(71, 'App\\User', '38'),
(71, 'App\\User', '48'),
(72, 'App\\User', '1'),
(72, 'App\\User', '34'),
(72, 'App\\User', '36'),
(72, 'App\\User', '37'),
(72, 'App\\User', '38'),
(72, 'App\\User', '48'),
(73, 'App\\User', '1'),
(73, 'App\\User', '34'),
(73, 'App\\User', '36'),
(73, 'App\\User', '37'),
(73, 'App\\User', '38'),
(73, 'App\\User', '48'),
(74, 'App\\User', '1'),
(74, 'App\\User', '34'),
(74, 'App\\User', '36'),
(74, 'App\\User', '37'),
(74, 'App\\User', '38'),
(74, 'App\\User', '48'),
(76, 'App\\User', '1'),
(76, 'App\\User', '37'),
(76, 'App\\User', '38'),
(77, 'App\\User', '1'),
(77, 'App\\User', '37'),
(77, 'App\\User', '38'),
(78, 'App\\User', '1'),
(78, 'App\\User', '37'),
(78, 'App\\User', '38'),
(79, 'App\\User', '1'),
(79, 'App\\User', '37'),
(79, 'App\\User', '38'),
(80, 'App\\User', '1'),
(80, 'App\\User', '37'),
(80, 'App\\User', '38'),
(81, 'App\\User', '1'),
(81, 'App\\User', '37'),
(81, 'App\\User', '38'),
(82, 'App\\User', '1'),
(82, 'App\\User', '34'),
(82, 'App\\User', '36'),
(82, 'App\\User', '37'),
(82, 'App\\User', '38'),
(82, 'App\\User', '48'),
(83, 'App\\User', '1'),
(83, 'App\\User', '34'),
(83, 'App\\User', '36'),
(83, 'App\\User', '37'),
(83, 'App\\User', '38'),
(83, 'App\\User', '48'),
(84, 'App\\User', '1'),
(84, 'App\\User', '34'),
(84, 'App\\User', '36'),
(84, 'App\\User', '37'),
(84, 'App\\User', '38'),
(84, 'App\\User', '48'),
(85, 'App\\User', '1'),
(85, 'App\\User', '34'),
(85, 'App\\User', '37'),
(85, 'App\\User', '38'),
(85, 'App\\User', '48');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 0),
(1, 'App\\User', 1),
(1, 'App\\User', 33),
(1, 'App\\User', 38),
(1, 'App\\User', 39),
(2, 'App\\User', 24),
(2, 'App\\User', 28),
(2, 'App\\User', 35),
(2, 'App\\User', 43),
(3, 'App\\User', 29),
(3, 'App\\User', 36),
(3, 'App\\User', 47),
(3, 'App\\User', 49),
(4, 'App\\User', 7),
(4, 'App\\User', 8),
(4, 'App\\User', 12),
(4, 'App\\User', 13),
(4, 'App\\User', 19),
(4, 'App\\User', 20),
(4, 'App\\User', 25),
(4, 'App\\User', 40),
(5, 'App\\User', 9),
(5, 'App\\User', 18),
(5, 'App\\User', 21),
(6, 'App\\User', 28),
(6, 'App\\User', 33),
(6, 'App\\User', 34),
(6, 'App\\User', 48),
(7, 'App\\User', 23),
(7, 'App\\User', 28),
(7, 'App\\User', 37),
(8, 'App\\User', 42),
(8, 'App\\User', 45),
(8, 'App\\User', 46);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` int(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `transaction_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_amount` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` int(191) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `stock_id`, `quantity`, `transaction_number`, `unit_amount`, `total_amount`, `distributor_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 1, 2, 'ACC400E347B4', '20000', '40000', 1, '2019-05-18 14:21:45', '2019-05-18 14:21:45', NULL),
(2, 1, 5, 'B6503DE0FFCA', '20000', '100000', 1, '2019-05-18 14:34:47', '2019-05-18 14:34:47', NULL),
(3, 1, 5, '48046AFEF5F1', '20000', '100000', 1, '2019-05-18 14:39:40', '2019-05-18 14:39:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `details_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `order_status` int(1) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`details_id`, `transaction_number`, `distributor_id`, `invoice_number`, `ware_house_id`, `order_status`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'ACC400E347B4', '1', '39A624', 1, 0, '2019-05-18 14:21:45', '2019-05-18 14:21:45', NULL),
(2, 'B6503DE0FFCA', '1', 'A372CB', 1, 0, '2019-05-18 14:34:47', '2019-05-18 14:34:47', NULL),
(4, '48046AFEF5F1', '1', '4AEB61', 1, 0, '2019-05-18 14:39:40', '2019-05-18 14:39:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`outlet_id`, `outlet_name`, `distributor_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Feed Well Bodija', 1, '2019-05-18 12:38:31', '2019-05-18 12:36:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tolajide75@gmail.com', '$2y$10$f.yQ5694Clbk6Khl/5SwfuNF.G/cDCbpPJG8tBYSuoehVcoQ.dWLG', '2019-05-01 09:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `details_id` int(255) NOT NULL,
  `distributor_id` int(255) NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `paid_status` int(1) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2019-04-10 15:37:35', '2019-04-10 15:37:35'),
(2, 'role-create', 'web', '2019-04-10 15:37:36', '2019-04-10 15:37:36'),
(3, 'role-edit', 'web', '2019-04-10 15:37:36', '2019-04-10 15:37:36'),
(4, 'role-delete', 'web', '2019-04-10 15:37:36', '2019-04-10 15:37:36'),
(5, 'product-update', 'web', '2019-04-10 15:37:37', '2019-04-10 15:37:37'),
(6, 'product-create', 'web', '2019-04-10 15:37:39', '2019-04-10 15:37:39'),
(7, 'product-edit', 'web', '2019-04-10 15:37:40', '2019-04-10 15:37:40'),
(8, 'product-delete', 'web', '2019-04-10 15:37:41', '2019-04-10 15:37:41'),
(9, 'category-create', 'web', '2019-04-10 15:37:43', '2019-04-10 15:37:43'),
(10, 'category-edit', 'web', '2019-04-10 15:37:45', '2019-04-10 15:37:45'),
(11, 'category-delete', 'web', '2019-04-10 15:37:47', '2019-04-10 15:37:47'),
(12, 'category-update', 'web', '2019-04-10 15:37:48', '2019-04-10 15:37:48'),
(13, 'variant-create', 'web', '2019-04-10 15:37:49', '2019-04-10 15:37:49'),
(14, 'variant-edit', 'web', '2019-04-10 15:37:50', '2019-04-10 15:37:50'),
(15, 'variant-delete', 'web', '2019-04-10 15:37:50', '2019-04-10 15:37:50'),
(16, 'variant-update', 'web', '2019-04-10 15:37:50', '2019-04-10 15:37:50'),
(17, 'distributor-create', 'web', '2019-04-10 15:37:51', '2019-04-10 15:37:51'),
(18, 'distributor-edit', 'web', '2019-04-10 15:37:51', '2019-04-10 15:37:51'),
(19, 'distributor-delete', 'web', '2019-04-10 15:37:51', '2019-04-10 15:37:51'),
(20, 'distributor-update', 'web', '2019-04-10 15:37:52', '2019-04-10 15:37:52'),
(21, 'supplier-create', 'web', '2019-04-10 15:37:53', '2019-04-10 15:37:53'),
(22, 'supplier-edit', 'web', '2019-04-10 15:37:53', '2019-04-10 15:37:53'),
(23, 'supplier-delete', 'web', '2019-04-10 15:37:53', '2019-04-10 15:37:53'),
(24, 'supplier-update', 'web', '2019-04-10 15:37:53', '2019-04-10 15:37:53'),
(25, 'outlet-create', 'web', '2019-04-10 15:37:54', '2019-04-10 15:37:54'),
(26, 'outlet-edit', 'web', '2019-04-10 15:37:54', '2019-04-10 15:37:54'),
(27, 'outlet-delete', 'web', '2019-04-10 15:37:54', '2019-04-10 15:37:54'),
(28, 'outlet-update', 'web', '2019-04-10 15:37:54', '2019-04-10 15:37:54'),
(29, 'order-create', 'web', '2019-04-10 15:37:55', '2019-04-10 15:37:55'),
(30, 'order-edit', 'web', '2019-04-10 15:37:56', '2019-04-10 15:37:56'),
(31, 'order-delete', 'web', '2019-04-10 15:37:56', '2019-04-10 15:37:56'),
(32, 'order-update', 'web', '2019-04-10 15:37:56', '2019-04-10 15:37:56'),
(34, 'warehouse-create', 'web', '2019-04-15 14:50:01', '2019-04-15 14:50:01'),
(35, 'warehouse-edit', 'web', '2019-04-15 14:50:58', '2019-04-15 14:50:58'),
(36, 'warehouse-update', 'web', '2019-04-15 14:52:52', '2019-04-15 14:52:52'),
(37, 'warehouse-delete', 'web', '2019-04-15 14:53:16', '2019-04-15 14:53:16'),
(38, 'employee-create', 'web', '2019-04-19 10:16:54', '2019-04-19 10:16:54'),
(39, 'employee-delete', 'web', '2019-04-19 10:17:15', '2019-04-19 10:17:15'),
(40, 'employee-edit', 'web', '2019-04-19 20:15:35', '2019-04-19 20:15:35'),
(41, 'employee-update', 'web', '2019-04-19 20:16:43', '2019-04-19 20:16:43'),
(42, 'user-create', 'web', '2019-04-20 11:44:46', '2019-04-20 11:44:46'),
(43, 'user-delete', 'web', '2019-04-20 11:45:10', '2019-04-20 11:45:10'),
(44, 'user-update', 'web', '2019-04-20 11:45:46', '2019-04-20 11:45:46'),
(45, 'user-edit', 'web', '2019-04-20 11:46:04', '2019-04-20 11:46:04'),
(46, 'salary-create', 'web', '2019-04-20 11:48:05', '2019-04-20 11:48:05'),
(47, 'salary-delete', 'web', '2019-04-20 11:48:27', '2019-04-20 11:48:27'),
(48, 'salary-update', 'web', '2019-04-20 11:48:49', '2019-04-20 11:48:49'),
(49, 'salary-edit', 'web', '2019-04-20 11:49:11', '2019-04-20 11:49:11'),
(50, 'product-update', 'web', '2019-04-24 07:13:45', '2019-04-24 07:13:45'),
(51, 'account-delete', 'web', '2019-04-24 08:05:29', '2019-04-24 08:05:29'),
(52, 'account-create', 'web', '2019-04-24 08:12:32', '2019-04-24 08:12:32'),
(53, 'account-update', 'web', '2019-04-24 08:14:39', '2019-04-24 08:14:39'),
(54, 'account-edit', 'web', '2019-04-24 08:15:08', '2019-04-24 08:15:08'),
(55, 'sales-create', 'web', '2019-04-24 08:23:45', '2019-04-24 08:23:45'),
(56, 'sales-edit', 'web', '2019-04-24 08:24:15', '2019-04-24 08:24:15'),
(57, 'sales-update', 'web', '2019-04-24 08:24:40', '2019-04-24 08:24:40'),
(58, 'sales-delete', 'web', '2019-04-24 08:32:32', '2019-04-24 08:32:32'),
(59, 'category-restore', 'web', '2019-04-25 21:30:49', '2019-04-25 21:30:49'),
(60, 'product-restore', 'web', '2019-04-27 06:59:42', '2019-04-27 06:59:42'),
(61, 'variant-restore', 'web', '2019-04-27 07:00:04', '2019-04-27 07:00:04'),
(62, 'distributor-restore', 'web', '2019-04-27 07:00:25', '2019-04-27 07:00:25'),
(63, 'supplier-restore', 'web', '2019-04-27 07:00:47', '2019-04-27 07:00:47'),
(64, 'outlet-restore', 'web', '2019-04-27 07:01:11', '2019-04-27 07:01:11'),
(65, 'warehouse-restore', 'web', '2019-04-27 07:01:42', '2019-04-27 07:01:42'),
(66, 'employee-restore', 'web', '2019-04-27 07:02:04', '2019-04-27 07:02:04'),
(67, 'user-restore', 'web', '2019-04-27 07:02:42', '2019-04-27 07:02:42'),
(68, 'salary-restore', 'web', '2019-04-27 07:03:13', '2019-04-27 07:03:13'),
(69, 'account-restore', 'web', '2019-04-27 07:03:29', '2019-04-27 07:03:29'),
(70, 'order-invoice', 'web', '2019-04-27 13:16:28', '2019-04-27 13:16:28'),
(71, 'print-invoice', 'web', '2019-04-27 15:03:40', '2019-04-27 15:03:40'),
(72, 'payment-create', 'web', '2019-04-30 05:00:58', '2019-04-30 05:00:58'),
(73, 'payment-edit', 'web', '2019-04-30 05:01:22', '2019-04-30 05:01:22'),
(74, 'payment-update', 'web', '2019-04-30 05:01:44', '2019-04-30 05:01:44'),
(75, 'payment-delete', 'web', '2019-04-30 05:02:04', '2019-04-30 05:02:04'),
(76, 'payment-restore', 'web', '2019-04-30 05:02:15', '2019-04-30 05:02:15'),
(77, 'assign-restore', 'web', '2019-04-30 15:31:18', '2019-04-30 15:31:18'),
(78, 'assign-create', 'web', '2019-04-30 15:31:34', '2019-04-30 15:31:34'),
(79, 'assign-edit', 'web', '2019-04-30 15:31:46', '2019-04-30 15:31:46'),
(80, 'assign-update', 'web', '2019-04-30 15:32:00', '2019-04-30 15:32:00'),
(81, 'assign-delete', 'web', '2019-04-30 15:32:18', '2019-04-30 15:32:18'),
(82, 'credit-payment', 'web', '2019-05-01 15:45:42', '2019-05-01 15:45:42'),
(83, 'credit-payment-edit', 'web', '2019-05-01 15:46:35', '2019-05-01 15:46:35'),
(84, 'credit-payment-update', 'web', '2019-05-01 15:47:03', '2019-05-01 15:47:03'),
(85, 'credit-payment-delete', 'web', '2019-05-01 15:47:31', '2019-05-01 15:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_slug`, `supplier_id`, `variant_id`, `amount`, `quantity`, `ware_house_id`, `category_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, '1lt honey', '1lt-honey-442', 1, 1, 20000, 2, 1, 1, '2019-05-18 14:02:14', '2019-05-18 14:02:14', NULL),
(2, 'casio calculator', 'casio-calculator-1981', 1, 1, 4000, 10, 1, 1, '2019-05-18 14:48:07', '2019-05-18 14:48:07', NULL),
(3, '2 litres', '2-litres-1178', 1, 2, 9000, 80, 1, 1, '2019-05-18 14:48:55', '2019-05-18 14:48:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `variant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(255) NOT NULL,
  `variant_size` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `variant_name`, `category_id`, `variant_size`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'cap seal (small and big)', 1, 'null', '2019-05-18 07:20:26', '2019-05-18 07:15:07', NULL),
(2, 'gy', 1, '20 litres', '2019-05-18 14:08:00', '2019-05-18 14:08:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'web', '2019-04-11 07:00:20', '2019-04-11 04:17:18'),
(2, 'Editor', 'web', '2019-04-11 14:06:57', '2019-04-11 14:06:57'),
(3, 'Receptionist', 'web', '2019-04-11 14:08:08', '2019-04-11 14:08:08'),
(4, 'Supplier', 'web', '2019-04-11 14:09:10', '2019-04-11 14:09:10'),
(5, 'Distributor', 'web', '2019-04-11 14:09:51', '2019-04-11 14:09:51'),
(6, 'Accountant', 'web', '2019-04-11 14:10:23', '2019-04-11 14:10:23'),
(7, 'Admin', 'web', '2019-04-11 14:15:43', '2019-04-11 14:15:43'),
(8, 'Staff', 'web', '2019-05-05 23:00:00', '2019-05-18 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 1),
(5, 3),
(5, 7),
(6, 1),
(6, 3),
(6, 7),
(7, 1),
(7, 3),
(7, 7),
(8, 1),
(8, 7),
(9, 1),
(9, 3),
(9, 7),
(10, 1),
(10, 3),
(10, 7),
(11, 1),
(11, 3),
(11, 7),
(12, 1),
(12, 3),
(12, 7),
(13, 1),
(13, 3),
(13, 7),
(14, 1),
(14, 3),
(14, 7),
(15, 1),
(15, 3),
(15, 7),
(16, 1),
(16, 3),
(16, 7),
(17, 1),
(17, 3),
(17, 7),
(18, 1),
(18, 3),
(18, 7),
(19, 1),
(19, 7),
(20, 1),
(20, 3),
(20, 7),
(21, 1),
(21, 3),
(21, 7),
(22, 1),
(22, 3),
(22, 7),
(23, 1),
(23, 7),
(24, 1),
(24, 3),
(24, 7),
(25, 1),
(25, 7),
(26, 1),
(26, 7),
(27, 1),
(27, 7),
(28, 1),
(28, 7),
(29, 1),
(29, 3),
(29, 6),
(29, 7),
(30, 1),
(30, 3),
(30, 6),
(30, 7),
(31, 1),
(31, 3),
(31, 6),
(31, 7),
(32, 1),
(32, 3),
(32, 6),
(32, 7),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(38, 7),
(39, 1),
(39, 7),
(40, 1),
(40, 7),
(41, 1),
(41, 7),
(42, 1),
(42, 7),
(43, 1),
(43, 7),
(44, 1),
(44, 7),
(45, 1),
(45, 7),
(46, 1),
(46, 6),
(46, 7),
(47, 1),
(47, 6),
(47, 7),
(48, 1),
(48, 6),
(48, 7),
(49, 1),
(49, 6),
(49, 7),
(51, 6),
(51, 7),
(52, 6),
(52, 7),
(53, 6),
(53, 7),
(54, 6),
(54, 7),
(55, 3),
(55, 6),
(55, 7),
(56, 3),
(56, 6),
(56, 7),
(57, 3),
(57, 6),
(57, 7),
(58, 3),
(58, 6),
(58, 7),
(59, 7),
(60, 7),
(61, 7),
(62, 7),
(63, 7),
(64, 7),
(65, 7),
(66, 7),
(67, 7),
(68, 7),
(69, 7),
(70, 6),
(70, 7),
(71, 7),
(72, 6),
(72, 7),
(73, 6),
(73, 7),
(74, 6),
(74, 7),
(75, 6),
(75, 7),
(76, 7),
(77, 7),
(78, 7),
(79, 7),
(80, 7),
(81, 7),
(82, 6),
(82, 7),
(83, 6),
(83, 7),
(84, 6),
(84, 7),
(85, 6),
(85, 7);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `salary_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `over_time` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weekly` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly` int(255) NOT NULL,
  `ware_house_id` int(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `employee_id`, `basic_salary`, `over_time`, `rate`, `hours`, `total`, `month`, `weekly`, `monthly`, `ware_house_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 1, 500, 0, 10, 10, 85000, 'May-2019', '4', 4, 1, '2019-05-18 13:17:18', '2019-05-18 13:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_one` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_two` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `phone_one`, `phone_two`, `email`, `address`, `city`, `state`, `country`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'test supplier one', '09087654343', 'Null', 'test@gmail.com', 'Ikere Ekiti, Ekiti', 'Ado Ekiti', 'Edo', 'Nigeria', '2019-05-18 12:27:53', '2019-05-18 07:33:41', NULL),
(2, 'test supp', '09094842322', '', 'hope@gmail.cm', 'ThegalijnfgihsijDFHZIJLHF', 'Mushin', 'Bayelsa', 'Nigeria', '2019-05-18 12:28:24', '2019-05-18 12:23:51', '2019-05-18 13:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `role`, `password`, `status`, `updated_at`, `created_at`, `deleted_at`, `email_verified_at`) VALUES
(1, 'Adesina Taiwo Olajide', 'tolajide74@gmail.com', '\"Administrator\"', '$2y$10$/HzGhIa5ALfVv4LkM5jiVuEHTa3Hq8LnRDyFWxavUVCsXMAej2kDq', 1, '2019-04-10 16:29:39', '2019-04-10 16:29:39', NULL, '2019-04-10 16:29:39'),
(34, 'New Accountants', 'accountant@gmail.com', 'Accountant', '$2y$10$/G1SWEaKZ0rOb7Le06CTKeKWQfWGUdw/ew6eoYeRAnRRHdykkkEnu', 1, '2019-05-13 12:03:11', '2019-04-29 06:18:28', NULL, '2019-04-01 23:00:00'),
(35, 'Editor', 'editor@gmail.com', '\"Editor\"', '$2y$10$MfG93yAgiBzoBh.VNI4ubeK6U98yy1jLlaaDiTs4cislHjix0oswy', 1, '2019-04-29 08:37:13', '2019-04-29 08:37:13', NULL, '2019-04-06 23:00:00'),
(36, 'Receptionist', 'receptionist@gmail.com', '\"Receptionist\"', '$2y$10$6n3ymtijFM1mNoVfrJhGneV3LLxGbtkPlRDI9DFopfE3tSC60Itve', 1, '2019-04-29 08:37:54', '2019-04-29 08:37:54', NULL, '2019-04-04 23:00:00'),
(37, 'Admin User', 'admin@gmail.com', 'Admin', '$2y$10$0U2R9dp42Hk5KEpPPEimCONTOD3YoWT5Pr2cyRhp1qZB3Icrb3zT6', 1, '2019-05-13 10:30:08', '2019-04-29 08:38:33', NULL, '2019-04-01 23:00:00'),
(38, 'Super Administrator', 'administrator@gmail.com', 'Administrator', '$2y$10$WcTxYYwS4yDMBk5olyOW..jfQFtMO8vJQICbev2XswW7wOPWV84e2', 1, '2019-05-18 12:21:35', '2019-04-29 08:39:12', NULL, '2019-04-06 23:00:00'),
(39, 'Adesina Taiwo Olajide', 'tolajide75@gmail.com', '\"Administrator\"', '$2y$10$hQtFh7iNW7GoSrCvDkKVnOTLRwvaoLFOi8ynYAyPynqqai4UkIfX2', 1, '2019-04-30 16:39:57', '2019-04-30 16:30:17', NULL, '2019-04-30 16:39:57'),
(40, 'Test supplier', 'sup@gmail.com', '\"Supplier\"', '$2y$10$cwT4U.6InN.5ZMDCTIiRDeiLpxaCaTNi5YvudCsF68wuUzRG4x8be', 1, '2019-05-09 06:08:20', '2019-05-07 11:00:43', '2019-05-09 07:08:20', NULL),
(45, 'Adeyemi Adeola', 'adeola@gmail.com', 'Staff', '$2y$10$igBHTf6m0O2aKotAjXtpbO.LlHL02Y533yBL68TQfNSYaqjVLgQgm', 1, '2019-05-11 10:33:09', '2019-05-11 10:33:09', NULL, NULL),
(46, 'Akinola Dayosola', 'dayosola@gmail.com', 'Staff', '$2y$10$a0277ZXBEPFoYmntts4SfOgFRZobOfKeREym2yKm0PYXoXPSeg5om', 1, '2019-05-11 10:36:36', '2019-05-11 10:36:36', NULL, NULL),
(47, 'Goke Emmanuel', 'ema@gmail.com', 'Receptionist', '$2y$10$2nQRtG2TWHnAB3Wbrxe0C.qByksaHNQi3TEhA3nrOTogBa3LVIqH.', 1, '2019-05-11 10:37:36', '2019-05-11 10:37:36', NULL, NULL),
(48, 'Kolade Jole', 'kola@gmail.com', 'Accountant', '$2y$10$07NWlfpkLlMOG6jDDMEho.DjViXH7jd7O4xH0KJfViwNdtW/OOqyS', 1, '2019-05-11 11:08:02', '2019-05-11 10:56:34', NULL, '2019-05-11 11:08:02'),
(49, 'Testing Employee', 'emp@gmail.com', 'Receptionist', '$2y$10$Hq6kVWDQ5LBdB5BO0pDwHuES/hONfb7D2r5F4v5VhxmGIig.mcLge', 1, '2019-05-18 12:59:41', '2019-05-18 12:52:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ware_house_managements`
--

CREATE TABLE `ware_house_managements` (
  `ware_house_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(191) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ware_house_managements`
--

INSERT INTO `ware_house_managements` (`ware_house_id`, `name`, `address`, `city`, `state`, `country`, `start_date`, `user_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'testing ware house', 'Kuto Abeokuta', 'Abekuta, Ogun', 'Ogun', 'Nigeria', '2019-09-14', 35, '2019-05-18 14:17:55', '2019-05-18 12:47:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `assign_outlets`
--
ALTER TABLE `assign_outlets`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `credit_managements`
--
ALTER TABLE `credit_managements`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `credit_payments`
--
ALTER TABLE `credit_payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`distributor_id`),
  ADD UNIQUE KEY `distributors_phone_one_unique` (`phone_one`),
  ADD UNIQUE KEY `distributors_phone_two_unique` (`phone_two`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employees_phone_number_unique` (`phone_number`);

--
-- Indexes for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `products_product_slug_unique` (`product_slug`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`);

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
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `suppliers_phone_one_unique` (`phone_one`),
  ADD UNIQUE KEY `suppliers_phone_two_unique` (`phone_two`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `user_roles_role_name_unique` (`role_name`);

--
-- Indexes for table `ware_house_managements`
--
ALTER TABLE `ware_house_managements`
  ADD PRIMARY KEY (`ware_house_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `assign_outlets`
--
ALTER TABLE `assign_outlets`
  MODIFY `assign_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_managements`
--
ALTER TABLE `credit_managements`
  MODIFY `credit_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_payments`
--
ALTER TABLE `credit_payments`
  MODIFY `pay_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `distributor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  MODIFY `stock_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `details_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `outlet_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `variant_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `salary_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ware_house_managements`
--
ALTER TABLE `ware_house_managements`
  MODIFY `ware_house_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

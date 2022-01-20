-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2022 at 08:43 AM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pragatis_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = product, 2 = service',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `type`, `date_created`, `date_updated`) VALUES
(1, 'Product Category 101', '&lt;p&gt;Sample Only&lt;/p&gt;', 1, '2021-07-09 10:18:57', NULL),
(2, 'Product Category 102', '&lt;p&gt;Test 102&lt;/p&gt;', 1, '2021-07-09 10:32:40', '2021-07-09 10:33:01'),
(4, 'Service 101', '&lt;p&gt;Service 101 Sample Description&lt;/p&gt;', 2, '2021-07-09 10:36:05', NULL),
(5, 'Income Tax', '', 2, '2021-11-11 08:26:24', NULL),
(6, 'dcdwc', '&lt;p&gt;wcde&lt;/p&gt;', 1, '2021-11-22 15:44:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_items`
--

CREATE TABLE `invoices_items` (
  `id` int(30) NOT NULL,
  `invoice_id` int(30) NOT NULL,
  `form_id` int(30) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices_items`
--

INSERT INTO `invoices_items` (`id`, `invoice_id`, `form_id`, `unit`, `quantity`, `price`, `total`) VALUES
(2, 1, 2, 'boxes', 7, 799.99, 5599.93),
(3, 2, 1, 'session', 2, 2500, 5000),
(4, 1, 1, 'boxes', 3, 350.5, 1051.5),
(5, 8, 3, '01', 1, 1500, 1500),
(6, 9, 1, '1', 3, 350.5, 1051.5);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_list`
--

CREATE TABLE `invoice_list` (
  `id` int(30) NOT NULL,
  `invoice_code` varchar(100) NOT NULL,
  `customer_name` text NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `sub_total` float NOT NULL,
  `tax_rate` float NOT NULL,
  `total_amount` float NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_list`
--

INSERT INTO `invoice_list` (`id`, `invoice_code`, `customer_name`, `type`, `sub_total`, `tax_rate`, `total_amount`, `remarks`, `date_created`, `date_updated`) VALUES
(1, 'Product-2476709', 'John Smith', 1, 42354, 12, 42354, 'Sample Remarks', '2021-07-09 15:36:41', '2021-07-09 16:44:09'),
(2, 'Service-7629350', 'Claire Blake', 2, 10000, 12, 10000, 'Sample Only', '2021-07-09 16:14:55', NULL),
(8, 'Service-01', 'Pulak Pathak', 2, 1500, 18, 1770, 'Income Tax For AY 2021-2022', '2021-11-11 08:28:42', NULL),
(9, 'Product-2683120', '', 1, 1051.5, 18, 1240.77, '', '2021-11-23 14:00:23', '2021-11-23 14:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `product` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `product`, `description`, `price`, `date_created`, `date_updated`) VALUES
(1, 1, 'Product 101', '&lt;p&gt;Sample Product only&lt;/p&gt;', 350.5, '2021-07-09 10:58:00', NULL),
(2, 2, 'Product 102', '&lt;p&gt;Sample Category 102&lt;/p&gt;', 799.99, '2021-07-09 11:13:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `service` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `category_id`, `service`, `description`, `price`, `date_created`, `date_updated`) VALUES
(1, 4, 'Service 101', '&lt;p&gt;Sample Service only&lt;/p&gt;', 2500, '2021-07-09 11:20:28', '2021-07-09 11:21:40'),
(3, 5, 'income Tax Filling', '&lt;p&gt;ITR Filling and Computation Preparation&lt;/p&gt;', 1500, '2021-11-11 08:25:24', '2021-11-11 08:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Invoice System'),
(6, 'short_name', 'Invoice'),
(11, 'logo', 'uploads/1636709520_14bca197281743e97302d08a6f69f34a.jpeg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1624240440_banner1.jpg'),
(15, 'tax_rate', '18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `company_name` int(11) NOT NULL,
  `name_in_account` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `company_name`, `name_in_account`, `account_number`, `ifsc_code`, `bank_name`, `branch_name`, `status`, `created_at`) VALUES
(2, 1, 'Sharda Associates', '919020035585087', 'UTIB0003428', 'Axis Bank', 'Ratan Khand', '1', '2021-12-13 05:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category_name`, `description`, `type`, `created_at`) VALUES
(1, 'Products', 'Hello Shadow', 'Product', '2021-11-22 12:46:33'),
(2, 'Product001', 'asdasdsa', 'Product', '2021-11-22 12:41:10'),
(3, 'Services', 'hello', 'Service', '2021-11-23 05:24:38'),
(4, 'Service', 'xasxsa', 'Service', '2021-11-23 05:24:58'),
(5, 'Shirt', 'Shirt Flexible', 'Product', '2021-12-02 05:17:21'),
(6, 'gst filing', 'abc', 'Service', '2021-12-13 14:40:08'),
(7, 'gst services', 'filling and registration', 'Service', '2021-12-15 09:03:33'),
(8, 'eeeee', 'sdadasd', 'Service', '2021-12-16 13:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `gstin_number` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `image`, `invoice_number`, `company_name`, `gstin_number`, `address`, `created_at`) VALUES
(1, '7a57a6c754d076c47ff28d11f2a11bb3.png', '17', 'SHARDA ASSOCIATES', 'SHARDA1111', 'Head Office: Ground Floor S-III/159/B, Sector-B,<br>\r\nKanpur Road, Lucknow-12 (U.P.)<br>\r\nPh: 0522-4333806, 9335776347<br>\r\nE-mail: advpulakpathak@gmail.com', '2021-12-21 11:12:41'),
(6, '0dc5c8dadd495c1a7b204c1b961706ea.jpg', '', 'hello', 'sadasdas', 'adasdasd', '2021-12-16 13:49:16'),
(7, '', '21', 'SSAK', '1234', 'abc', '2021-12-16 13:58:26'),
(8, '', '18', 'Care Accounts', '', 'Lucknow', '2021-12-21 07:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `customer_display_name` varchar(100) NOT NULL,
  `customer_email` varchar(111) NOT NULL,
  `gst_number` varchar(100) NOT NULL,
  `country_region` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `same_as` varchar(100) NOT NULL,
  `shipping_country_region` varchar(100) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_state` varchar(100) NOT NULL,
  `shipping_zip_code` varchar(100) NOT NULL,
  `shipping_number` varchar(100) NOT NULL,
  `salutation` varchar(100) NOT NULL,
  `contact_first_name` varchar(100) NOT NULL,
  `contact_last_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_address` text NOT NULL,
  `work_phone` varchar(100) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `customer_type`, `firstname`, `lastname`, `company_name`, `customer_display_name`, `customer_email`, `gst_number`, `country_region`, `address`, `city`, `state`, `zip_code`, `phone`, `same_as`, `shipping_country_region`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_zip_code`, `shipping_number`, `salutation`, `contact_first_name`, `contact_last_name`, `contact_email`, `contact_address`, `work_phone`, `mobile_number`, `created_at`) VALUES
(7, 'individual', 'ankur', 'mishra', 'Sharda Associates 1', 'ankur mishra', 'gstama0765@gamil.com', '11111111111', 'india', '', '', '34', '', '', '', '', '0', 'lucknow', '34', '', '7607230326', '', '', '', '', '', '', '', '2021-12-14 14:40:54'),
(8, 'individual', 'ravi mishra', '', 'Sharda Associates 1', 'ravi', 'gstama0765@gmail.com', '', 'india', '', '', '34', '', '', '', '', '', 'lucknow', '34', '', '', '', '', '', '', '', '', '', '2021-12-15 08:09:27'),
(9, 'individual', 'pulak', 'pathak', 'pulak& company', 'pulak pathak', 'advpulakpathak@gmail.com', '564564456554', 'india', '', 'lucknow', '33', '', '', '', '', '', 'lucknow', '34', '', '7651978580', '54564', 'pulak', 'pathak', 'advpulakpathak@gmail.com', '', '7651978580', '7651978580', '2021-12-15 09:07:10'),
(10, 'individual', 'VISHAL', 'MISHRA', 'VISHAL ADVERTISEMENT', 'VISHAL ADVERTISEMENT', 'gstama0765@gamil.com', '564564456554', 'india', '', 'lucknow', '34', '', '', '', '', '', 'lucknow', '34', '', '7651978580', 'Mr.', 'VISHAL', 'MISHRA', 'gstama0765@gmail.com', '', '', '', '2021-12-15 12:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_notes`
--

CREATE TABLE `tbl_customer_notes` (
  `id` int(11) NOT NULL,
  `customer_notes` text NOT NULL,
  `status` enum('1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer_notes`
--

INSERT INTO `tbl_customer_notes` (`id`, `customer_notes`, `status`, `created_at`) VALUES
(1, 'hello', '1', '2021-12-11 06:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_due_invoice`
--

CREATE TABLE `tbl_due_invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `ammount_paid` decimal(12,2) NOT NULL,
  `grant_total` decimal(12,2) NOT NULL,
  `due` decimal(12,2) NOT NULL,
  `paid_date` date NOT NULL,
  `due_dates` varchar(100) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_due_invoice`
--

INSERT INTO `tbl_due_invoice` (`id`, `user_id`, `ammount_paid`, `grant_total`, `due`, `paid_date`, `due_dates`, `status`) VALUES
(1, 30, 1234.00, 23257.80, 22023.80, '0000-00-00', '2021-12-20', '1'),
(3, 31, 12000.00, 23257.80, 11257.80, '2021-12-04', '2021-12-20', '1'),
(6, 29, 13000.00, 13098.00, 98.00, '2021-12-06', '2021-12-20', '1'),
(7, 37, 3000.00, 7080.00, 4080.00, '2021-12-13', '2021-12-25', '1'),
(8, 45, 2000.00, 2124.00, 124.00, '2021-12-15', '2021-12-30', '1'),
(9, 45, 100.00, 124.00, 24.00, '2021-12-15', '2021-12-26', '1'),
(12, 45, 10.00, 24.00, 14.00, '2021-12-15', '2021-12-17', '1'),
(13, 57, 120000.00, 1322901.54, 1202901.54, '2021-12-21', '2022-01-08', '1'),
(14, 57, 1000000.00, 1202901.54, 202901.54, '2021-12-21', '2022-01-09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `gstin` varchar(100) NOT NULL,
  `place_of_supply` varchar(100) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `invoice_date` varchar(100) NOT NULL,
  `due_date` varchar(111) NOT NULL,
  `due_type` int(11) NOT NULL,
  `customer_notes` text NOT NULL,
  `terms_condition` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `tax_rate` varchar(100) NOT NULL,
  `items` longtext NOT NULL,
  `account` varchar(100) NOT NULL,
  `grant_total` decimal(12,2) NOT NULL,
  `remarks` text NOT NULL,
  `status` enum('1','2','3','4') NOT NULL COMMENT '1=>None,2=>paid,3=>partial,4=>void',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `customer_name`, `gstin`, `place_of_supply`, `invoice_number`, `order_number`, `invoice_date`, `due_date`, `due_type`, `customer_notes`, `terms_condition`, `email`, `sub_total`, `tax_rate`, `items`, `account`, `grant_total`, `remarks`, `status`, `created_at`) VALUES
(49, 'ankur', '18%', '', '', '#451758502', '2021-12-21', '2021-12-31', 0, 'hello', 'hello', 'heeramishra22@gmail.com', 2500.00, '18', '{\"qty\":[\"1\"],\"unit\":[\"null\"],\"item_category\":[\"Service\"],\"item_name\":[\"income tax Filling\"],\"item_description\":[\"undefined\"],\"price\":[\"2500\"],\"total\":[\"2500\"]}', '', 2950.00, 'vasuli', '1', '2021-12-21 07:17:22'),
(50, 'ravi mishra', '18%', '34', 'SA/2021-2022/', '#151049020', '2021-12-22', '2021-12-30', 1, 'hello', 'hello', 'kannaujiya29aniket@gmail.com', 200.00, '18', '{\"qty\":[\"1\"],\"unit\":[\"null\"],\"item_category\":[\"Service\"],\"item_name\":[\"Aniket\"],\"item_description\":[\"undefined\"],\"price\":[\"200\"],\"total\":[\"200\"]}', '2', 236.00, '', '1', '2021-12-22 12:46:06'),
(51, '', '', '', '', '#1338562750', '', '', 0, 'hello', 'hello', '', 0.00, '18', '{\"qty\":null,\"unit\":null,\"item_category\":null,\"item_name\":null,\"item_description\":null,\"price\":null,\"total\":null}', '', 0.00, '', '1', '2021-12-15 08:12:18'),
(52, 'pulak pathak', '18%', '34', 'SA/2021-2022/', '#1492244263', '2021-12-15', '2021-12-31', 0, 'hello', 'hello', 'avdpulakpathak@gmail.com', 2500.00, '18', '{\"qty\":[\"1\"],\"unit\":[\"null\"],\"item_category\":[\"Service\"],\"item_name\":[\"income tax Filling\"],\"item_description\":[\"undefined\"],\"price\":[\"2500\"],\"total\":[\"2500\"]}', '2', 2950.00, '', '1', '2021-12-15 09:12:55'),
(53, 'VISHAL', '18%', '34', 'SA/2021-2022/', '#653752786', '2021-12-15', '2021-12-31', 0, 'hello', 'hello', 'gstama0765@gamil.com', 2500.00, '18', '{\"qty\":[\"1\"],\"unit\":[\"null\"],\"item_category\":[\"Service\"],\"item_name\":[\"income tax Filling\"],\"item_description\":[\"undefined\"],\"price\":[\"2500\"],\"total\":[\"2500\"]}', '2', 2950.00, '', '1', '2021-12-15 12:28:19'),
(55, 'ravi mishra', '18%', '34', 'SA/2021-2022/', '#1743140725', '2021-12-21', '2021-12-21', 1, 'hello', 'hello', 'kannaujiya29aniket@gmail.com', 0.00, '18', '{\"qty\":null,\"unit\":null,\"item_category\":null,\"item_name\":null,\"item_description\":null,\"price\":null,\"total\":null}', '2', 0.00, '', '1', '2021-12-22 12:30:02'),
(56, 'ankur', '18%', '3', 'SA/2021-2022/002', '#1738522649', '2021-12-22', '2021-12-25', 0, 'hello', 'hello', 'gstama0765@gamil.com', 3737010.00, '18', '{\"qty\":[\"30\"],\"unit\":[\"123\"],\"item_category\":[\"Services\"],\"item_name\":[\"qqqq\"],\"item_description\":[\"sacsac\"],\"price\":[\"124567\"],\"total\":[\"3737010\"]}', '2', 4409671.80, 'wxefrgvth', '1', '2021-12-21 12:13:41'),
(57, 'aniket', '18%', '2', 'SA/2021-2022/002', '#1133150535', '2021-11-23', '2022-01-09', 1, 'hello', 'hello', 'kannaujiya29aniket@gmail.com', 1121103.00, '18', '{\"qty\":[\"9\"],\"unit\":[\"123\"],\"item_category\":[\"Services\"],\"item_name\":[\"qqqq\"],\"item_description\":[\"sacsac\"],\"price\":[\"124567\"],\"total\":[\"1121103\"]}', '2', 202901.54, 'swedrftgy', '3', '2021-12-22 12:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_items`
--

CREATE TABLE `tbl_invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_code` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `product_service` varchar(100) NOT NULL,
  `units` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `sub_totals` varchar(111) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_items`
--

INSERT INTO `tbl_invoice_items` (`id`, `invoice_code`, `category_name`, `product_service`, `units`, `qty`, `sub_totals`, `total_amount`, `created_at`) VALUES
(1, 'INV002', 'Service', 'Aniket', '12', '9', '0', '2124', '2021-11-26 05:54:24'),
(2, 'INV002', 'Service', 'service', '12', '9', '0', '6977.34', '2021-11-26 05:54:48'),
(3, 'INV002', 'Service', 'Aniket', '12', '22', '0', '5192', '2021-11-26 06:10:40'),
(4, 'INV002', 'Service', 'Aniket', '12', '12', '0', '2832', '2021-11-26 06:18:54'),
(5, 'INV002', 'Service', 'Aniket', '12', '12', '0', '2832', '2021-11-26 06:19:02'),
(6, 'INV002', 'Service', 'Aniket', '12', '12', '0', '2832', '2021-11-26 06:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `sku` varchar(110) DEFAULT NULL,
  `unit` varchar(110) NOT NULL,
  `price` varchar(110) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `hsn_code` varchar(100) DEFAULT NULL,
  `sac_code` varchar(100) DEFAULT NULL,
  `tax_preference` varchar(110) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `name`, `sku`, `unit`, `price`, `category_name`, `hsn_code`, `sac_code`, `tax_preference`, `description`, `created_at`) VALUES
(13, 'qqqq', '', '123', '124567', 'Services', NULL, NULL, '12', 'sacsac', '2021-12-14 11:10:22'),
(15, 'gst services', NULL, '1', '3500', 'Services', NULL, 'SAC001', '', '', '2021-12-15 09:11:41'),
(17, 'GST Filling Fees', NULL, '1', '1000', 'Services', NULL, 'SAC001', '', '', '2021-12-21 07:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_hsn`
--

CREATE TABLE `tbl_master_hsn` (
  `id` int(11) NOT NULL,
  `hsn_code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_master_hsn`
--

INSERT INTO `tbl_master_hsn` (`id`, `hsn_code`, `created_at`) VALUES
(2, 'HSN001', '2021-11-22 10:19:59'),
(3, 'HSN002', '2021-11-22 10:20:06'),
(4, 'HSN003', '2021-11-22 10:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_invoice`
--

CREATE TABLE `tbl_master_invoice` (
  `id` int(11) NOT NULL,
  `prefix_name` varchar(100) NOT NULL,
  `next_number` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_master_invoice`
--

INSERT INTO `tbl_master_invoice` (`id`, `prefix_name`, `next_number`, `created_at`) VALUES
(17, 'SA/2021-2022/', '001', '2021-12-21 11:27:57'),
(18, 'CA/02021/', '001', '2021-12-14 05:28:31'),
(19, 'INC', NULL, '2021-12-14 05:30:37'),
(20, 'INV', '001', '2021-12-16 13:51:15'),
(21, 'SSAK', '201', '2021-12-16 13:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sac`
--

CREATE TABLE `tbl_sac` (
  `id` int(11) NOT NULL,
  `sac_code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sac`
--

INSERT INTO `tbl_sac` (`id`, `sac_code`, `created_at`) VALUES
(2, 'SAC001', '2021-11-22 12:11:54'),
(3, 'SAC002', '2021-12-16 13:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `sess_id`, `firstname`, `lastname`, `image`, `created_at`) VALUES
(3, 1, 'Admin', 'Admin', '0bc1ac97111e249b0399f227d0e58069.jpeg', '2021-12-16 13:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`id`, `state`) VALUES
(1, 'ANDAMAN AND NICOBAR ISLANDS'),
(2, 'ANDHRA PRADESH'),
(3, 'ARUNACHAL PRADESH'),
(4, 'ASSAM'),
(5, 'BIHAR'),
(6, 'CHATTISGARH'),
(7, 'CHANDIGARH'),
(8, 'DAMAN AND DIU'),
(9, 'DELHI'),
(10, 'DADRA AND NAGAR HAVELI'),
(11, 'GOA'),
(12, 'GUJARAT'),
(13, 'HIMACHAL PRADESH'),
(14, 'HARYANA'),
(15, 'JAMMU AND KASHMIR'),
(16, 'JHARKHAND'),
(17, 'KERALA'),
(18, 'KARNATAKA'),
(19, 'LAKSHADWEEP'),
(20, 'MEGHALAYA'),
(21, 'MAHARASHTRA'),
(22, 'MANIPUR'),
(23, 'MADHYA PRADESH'),
(24, 'MIZORAM'),
(25, 'NAGALAND'),
(26, 'ORISSA'),
(27, 'PUNJAB'),
(28, 'PONDICHERRY'),
(29, 'RAJASTHAN'),
(30, 'SIKKIM'),
(31, 'TAMIL NADU'),
(32, 'TRIPURA'),
(33, 'UTTARAKHAND'),
(34, 'UTTAR PRADESH'),
(35, 'WEST BENGAL'),
(36, 'TELANGANA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `id` int(11) NOT NULL,
  `tax_name` varchar(100) NOT NULL,
  `tax_value` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`id`, `tax_name`, `tax_value`, `created_at`) VALUES
(2, 'Product', '18%', '2021-11-22 11:04:12'),
(4, 'services', '18%', '2021-12-15 09:10:49'),
(5, 'dsadasdas', '12%', '2021-12-16 13:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term_condition`
--

CREATE TABLE `tbl_term_condition` (
  `id` int(11) NOT NULL,
  `term` text NOT NULL,
  `status` enum('1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_term_condition`
--

INSERT INTO `tbl_term_condition` (`id`, `term`, `status`, `created_at`) VALUES
(1, 'hello', '1', '2021-12-11 06:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'SSAK ', 'Solution', 'admin', 'admin', 'uploads/1636613340_COMP-LOGO.png', NULL, 1, '2021-01-20 14:02:37', '2021-12-01 14:02:15'),
(5, 'Claire', 'Blake', 'cblake', 'b0baee9d279d34fa1dfd71aadb908c3f', NULL, NULL, 1, '2021-06-19 10:01:51', '2021-11-29 14:28:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_items`
--
ALTER TABLE `invoices_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_list`
--
ALTER TABLE `invoice_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_notes`
--
ALTER TABLE `tbl_customer_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_due_invoice`
--
ALTER TABLE `tbl_due_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_master_hsn`
--
ALTER TABLE `tbl_master_hsn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_master_invoice`
--
ALTER TABLE `tbl_master_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sac`
--
ALTER TABLE `tbl_sac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_term_condition`
--
ALTER TABLE `tbl_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoices_items`
--
ALTER TABLE `invoices_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_list`
--
ALTER TABLE `invoice_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_customer_notes`
--
ALTER TABLE `tbl_customer_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_due_invoice`
--
ALTER TABLE `tbl_due_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_master_hsn`
--
ALTER TABLE `tbl_master_hsn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_master_invoice`
--
ALTER TABLE `tbl_master_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_sac`
--
ALTER TABLE `tbl_sac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_term_condition`
--
ALTER TABLE `tbl_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

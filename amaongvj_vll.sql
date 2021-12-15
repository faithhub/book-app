-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2021 at 08:05 PM
-- Server version: 10.3.32-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amaongvj_vll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `book_cat` bigint(20) UNSIGNED NOT NULL,
  `book_material_type` bigint(20) UNSIGNED NOT NULL,
  `book_country` bigint(20) UNSIGNED NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_paid_free` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_cover_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_material_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_material_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Not Active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Vendor','Admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `name`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Business & Commercial Law ', 'Active', 'Vendor', NULL, NULL),
(2, 'Investments & Security', 'Active', 'Vendor', NULL, NULL),
(3, 'Civil procedure', 'Active', 'Vendor', NULL, NULL),
(4, 'Criminal procedure', 'Active', 'Vendor', NULL, NULL),
(5, 'Legal Method & Legal Systems', 'Active', 'Vendor', NULL, NULL),
(6, 'Constitutional & Administrative law', 'Active', 'Vendor', NULL, NULL),
(7, 'Torts & Trust & Equity', 'Active', 'Vendor', NULL, NULL),
(8, 'Jurisprudence & Conflicts of Law', 'Active', 'Admin', NULL, NULL),
(9, 'Family law', 'Active', 'Admin', NULL, NULL),
(10, 'Others', 'Active', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_materials`
--

CREATE TABLE `book_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Not Active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Vendor','Admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_materials`
--

INSERT INTO `book_materials` (`id`, `name`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Textbooks', 'Active', 'Vendor', NULL, NULL),
(2, 'Law Reports', 'Active', 'Vendor', NULL, NULL),
(3, 'Journals', 'Active', 'Vendor', NULL, NULL),
(4, 'Articles', 'Active', 'Vendor', NULL, NULL),
(5, 'Videos', 'Active', 'Vendor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bought_books`
--

CREATE TABLE `bought_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_label`, `created_by`, `is_deleted`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Nigeria', 1, 0, NULL, NULL, NULL),
(2, 'Afghanistan', 1, 0, NULL, NULL, NULL),
(3, 'Aland Islands', 1, 0, NULL, NULL, NULL),
(4, 'Albania', 1, 0, NULL, NULL, NULL),
(5, 'Algeria', 1, 0, NULL, NULL, NULL),
(6, 'American Samoa', 1, 0, NULL, NULL, NULL),
(7, 'Andorra', 1, 0, NULL, NULL, NULL),
(8, 'Angola', 1, 0, NULL, NULL, NULL),
(9, 'Anguilla', 1, 0, NULL, NULL, NULL),
(10, 'Antarctica', 1, 0, NULL, NULL, NULL),
(11, 'Antigua and Barbuda', 1, 0, NULL, NULL, NULL),
(12, 'Argentina', 1, 0, NULL, NULL, NULL),
(13, 'Armenia', 1, 0, NULL, NULL, NULL),
(14, 'Aruba', 1, 0, NULL, NULL, NULL),
(15, 'Australia', 1, 0, NULL, NULL, NULL),
(16, 'Austria', 1, 0, NULL, NULL, NULL),
(17, 'Azerbaijan', 1, 0, NULL, NULL, NULL),
(18, 'Bahamas', 1, 0, NULL, NULL, NULL),
(19, 'Bahrain', 1, 0, NULL, NULL, NULL),
(20, 'Bangladesh', 1, 0, NULL, NULL, NULL),
(21, 'Barbados', 1, 0, NULL, NULL, NULL),
(22, 'Belarus', 1, 0, NULL, NULL, NULL),
(23, 'Belgium', 1, 0, NULL, NULL, NULL),
(24, 'Belize', 1, 0, NULL, NULL, NULL),
(25, 'Benin', 1, 0, NULL, NULL, NULL),
(26, 'Bermuda', 1, 0, NULL, NULL, NULL),
(27, 'Bhutan', 1, 0, NULL, NULL, NULL),
(28, 'Bolivia, Plurinational State of bolivia', 1, 0, NULL, NULL, NULL),
(29, 'Bosnia and Herzegovina', 1, 0, NULL, NULL, NULL),
(30, 'Botswana', 1, 0, NULL, NULL, NULL),
(31, 'Brazil', 1, 0, NULL, NULL, NULL),
(32, 'British Indian Ocean Territory', 1, 0, NULL, NULL, NULL),
(33, 'Brunei Darussalam', 1, 0, NULL, NULL, NULL),
(34, 'Bulgaria', 1, 0, NULL, NULL, NULL),
(35, 'Burkina Faso', 1, 0, NULL, NULL, NULL),
(36, 'Burundi', 1, 0, NULL, NULL, NULL),
(37, 'Cambodia', 1, 0, NULL, NULL, NULL),
(38, 'Cameroon', 1, 0, NULL, NULL, NULL),
(39, 'Canada', 1, 0, NULL, NULL, NULL),
(40, 'Cape Verde', 1, 0, NULL, NULL, NULL),
(41, 'Cayman Islands', 1, 0, NULL, NULL, NULL),
(42, 'Central African Republic', 1, 0, NULL, NULL, NULL),
(43, 'Chad', 1, 0, NULL, NULL, NULL),
(44, 'Chile', 1, 0, NULL, NULL, NULL),
(45, 'China', 1, 0, NULL, NULL, NULL),
(46, 'Christmas Island', 1, 0, NULL, NULL, NULL),
(47, 'Cocos (Keeling) Islands', 1, 0, NULL, NULL, NULL),
(48, 'Colombia', 1, 0, NULL, NULL, NULL),
(49, 'Comoros', 1, 0, NULL, NULL, NULL),
(50, 'Congo', 1, 0, NULL, NULL, NULL),
(51, 'Congo, The Democratic Republic of the Congo', 1, 0, NULL, NULL, NULL),
(52, 'Cook Islands', 1, 0, NULL, NULL, NULL),
(53, 'Costa Rica', 1, 0, NULL, NULL, NULL),
(54, 'Cote d\'Ivoire', 1, 0, NULL, NULL, NULL),
(55, 'Croatia', 1, 0, NULL, NULL, NULL),
(56, 'Cuba', 1, 0, NULL, NULL, NULL),
(57, 'Cyprus', 1, 0, NULL, NULL, NULL),
(58, 'Czech Republic', 1, 0, NULL, NULL, NULL),
(59, 'Denmark', 1, 0, NULL, NULL, NULL),
(60, 'Djibouti', 1, 0, NULL, NULL, NULL),
(61, 'Dominica', 1, 0, NULL, NULL, NULL),
(62, 'Dominican Republic', 1, 0, NULL, NULL, NULL),
(63, 'Ecuador', 1, 0, NULL, NULL, NULL),
(64, 'Egypt', 1, 0, NULL, NULL, NULL),
(65, 'El Salvador', 1, 0, NULL, NULL, NULL),
(66, 'Equatorial Guinea', 1, 0, NULL, NULL, NULL),
(67, 'Eritrea', 1, 0, NULL, NULL, NULL),
(68, 'Estonia', 1, 0, NULL, NULL, NULL),
(69, 'Ethiopia', 1, 0, NULL, NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 1, 0, NULL, NULL, NULL),
(71, 'Faroe Islands', 1, 0, NULL, NULL, NULL),
(72, 'Fiji', 1, 0, NULL, NULL, NULL),
(73, 'Finland', 1, 0, NULL, NULL, NULL),
(74, 'France', 1, 0, NULL, NULL, NULL),
(75, 'French Guiana', 1, 0, NULL, NULL, NULL),
(76, 'French Polynesia', 1, 0, NULL, NULL, NULL),
(77, 'Gabon', 1, 0, NULL, NULL, NULL),
(78, 'Gambia', 1, 0, NULL, NULL, NULL),
(79, 'Georgia', 1, 0, NULL, NULL, NULL),
(80, 'Germany', 1, 0, NULL, NULL, NULL),
(81, 'Ghana', 1, 0, NULL, NULL, NULL),
(82, 'Gibraltar', 1, 0, NULL, NULL, NULL),
(83, 'Greece', 1, 0, NULL, NULL, NULL),
(84, 'Greenland', 1, 0, NULL, NULL, NULL),
(85, 'Grenada', 1, 0, NULL, NULL, NULL),
(86, 'Guadeloupe', 1, 0, NULL, NULL, NULL),
(87, 'Guam', 1, 0, NULL, NULL, NULL),
(88, 'Guatemala', 1, 0, NULL, NULL, NULL),
(89, 'Guernsey', 1, 0, NULL, NULL, NULL),
(90, 'Guinea', 1, 0, NULL, NULL, NULL),
(91, 'Guinea-Bissau', 1, 0, NULL, NULL, NULL),
(92, 'Guyana', 1, 0, NULL, NULL, NULL),
(93, 'Haiti', 1, 0, NULL, NULL, NULL),
(94, 'Holy See (Vatican City State)', 1, 0, NULL, NULL, NULL),
(95, 'Honduras', 1, 0, NULL, NULL, NULL),
(96, 'Hong Kong', 1, 0, NULL, NULL, NULL),
(97, 'Hungary', 1, 0, NULL, NULL, NULL),
(98, 'Iceland', 1, 0, NULL, NULL, NULL),
(99, 'India', 1, 0, NULL, NULL, NULL),
(100, 'Indonesia', 1, 0, NULL, NULL, NULL),
(101, 'Iran, Islamic Republic of Persian Gulf', 1, 0, NULL, NULL, NULL),
(102, 'Iraq', 1, 0, NULL, NULL, NULL),
(103, 'Ireland', 1, 0, NULL, NULL, NULL),
(104, 'Isle of Man', 1, 0, NULL, NULL, NULL),
(105, 'Israel', 1, 0, NULL, NULL, NULL),
(106, 'Italy', 1, 0, NULL, NULL, NULL),
(107, 'Jamaica', 1, 0, NULL, NULL, NULL),
(108, 'Japan', 1, 0, NULL, NULL, NULL),
(109, 'Jersey', 1, 0, NULL, NULL, NULL),
(110, 'Jordan', 1, 0, NULL, NULL, NULL),
(111, 'Kazakhstan', 1, 0, NULL, NULL, NULL),
(112, 'Kenya', 1, 0, NULL, NULL, NULL),
(113, 'Kiribati', 1, 0, NULL, NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of Korea', 1, 0, NULL, NULL, NULL),
(115, 'Korea, Republic of South Korea', 1, 0, NULL, NULL, NULL),
(116, 'Kuwait', 1, 0, NULL, NULL, NULL),
(117, 'Kyrgyzstan', 1, 0, NULL, NULL, NULL),
(118, 'Laos', 1, 0, NULL, NULL, NULL),
(119, 'Latvia', 1, 0, NULL, NULL, NULL),
(120, 'Lebanon', 1, 0, NULL, NULL, NULL),
(121, 'Lesotho', 1, 0, NULL, NULL, NULL),
(122, 'Liberia', 1, 0, NULL, NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 1, 0, NULL, NULL, NULL),
(124, 'Liechtenstein', 1, 0, NULL, NULL, NULL),
(125, 'Lithuania', 1, 0, NULL, NULL, NULL),
(126, 'Luxembourg', 1, 0, NULL, NULL, NULL),
(127, 'Macao', 1, 0, NULL, NULL, NULL),
(128, 'Macedonia', 1, 0, NULL, NULL, NULL),
(129, 'Madagascar', 1, 0, NULL, NULL, NULL),
(130, 'Malawi', 1, 0, NULL, NULL, NULL),
(131, 'Malaysia', 1, 0, NULL, NULL, NULL),
(132, 'Maldives', 1, 0, NULL, NULL, NULL),
(133, 'Mali', 1, 0, NULL, NULL, NULL),
(134, 'Malta', 1, 0, NULL, NULL, NULL),
(135, 'Marshall Islands', 1, 0, NULL, NULL, NULL),
(136, 'Martinique', 1, 0, NULL, NULL, NULL),
(137, 'Mauritania', 1, 0, NULL, NULL, NULL),
(138, 'Mauritius', 1, 0, NULL, NULL, NULL),
(139, 'Mayotte', 1, 0, NULL, NULL, NULL),
(140, 'Mexico', 1, 0, NULL, NULL, NULL),
(141, 'Micronesia, Federated States of Micronesia', 1, 0, NULL, NULL, NULL),
(142, 'Moldova', 1, 0, NULL, NULL, NULL),
(143, 'Monaco', 1, 0, NULL, NULL, NULL),
(144, 'Mongolia', 1, 0, NULL, NULL, NULL),
(145, 'Montenegro', 1, 0, NULL, NULL, NULL),
(146, 'Montserrat', 1, 0, NULL, NULL, NULL),
(147, 'Morocco', 1, 0, NULL, NULL, NULL),
(148, 'Mozambique', 1, 0, NULL, NULL, NULL),
(149, 'Myanmar', 1, 0, NULL, NULL, NULL),
(150, 'Namibia', 1, 0, NULL, NULL, NULL),
(151, 'Nauru', 1, 0, NULL, NULL, NULL),
(152, 'Nepal', 1, 0, NULL, NULL, NULL),
(153, 'Netherlands', 1, 0, NULL, NULL, NULL),
(154, 'Netherlands Antilles', 1, 0, NULL, NULL, NULL),
(155, 'New Caledonia', 1, 0, NULL, NULL, NULL),
(156, 'New Zealand', 1, 0, NULL, NULL, NULL),
(157, 'Nicaragua', 1, 0, NULL, NULL, NULL),
(158, 'Niger', 1, 0, NULL, NULL, NULL),
(159, 'Niue', 1, 0, NULL, NULL, NULL),
(160, 'Norfolk Island', 1, 0, NULL, NULL, NULL),
(161, 'Northern Mariana Islands', 1, 0, NULL, NULL, NULL),
(162, 'Norway', 1, 0, NULL, NULL, NULL),
(163, 'Oman', 1, 0, NULL, NULL, NULL),
(164, 'Pakistan', 1, 0, NULL, NULL, NULL),
(165, 'Palau', 1, 0, NULL, NULL, NULL),
(166, 'Palestinian Territory, Occupied', 1, 0, NULL, NULL, NULL),
(167, 'Panama', 1, 0, NULL, NULL, NULL),
(168, 'Papua New Guinea', 1, 0, NULL, NULL, NULL),
(169, 'Paraguay', 1, 0, NULL, NULL, NULL),
(170, 'Peru', 1, 0, NULL, NULL, NULL),
(171, 'Philippines', 1, 0, NULL, NULL, NULL),
(172, 'Pitcairn', 1, 0, NULL, NULL, NULL),
(173, 'Poland', 1, 0, NULL, NULL, NULL),
(174, 'Portugal', 1, 0, NULL, NULL, NULL),
(175, 'Puerto Rico', 1, 0, NULL, NULL, NULL),
(176, 'Qatar', 1, 0, NULL, NULL, NULL),
(177, 'Romania', 1, 0, NULL, NULL, NULL),
(178, 'Russia', 1, 0, NULL, NULL, NULL),
(179, 'Rwanda', 1, 0, NULL, NULL, NULL),
(180, 'Reunion', 1, 0, NULL, NULL, NULL),
(181, 'Saint Barthelemy', 1, 0, NULL, NULL, NULL),
(182, 'Saint Helena, Ascension and Tristan Da Cunha', 1, 0, NULL, NULL, NULL),
(183, 'Saint Kitts and Nevis', 1, 0, NULL, NULL, NULL),
(184, 'Saint Lucia', 1, 0, NULL, NULL, NULL),
(185, 'Saint Martin', 1, 0, NULL, NULL, NULL),
(186, 'Saint Pierre and Miquelon', 1, 0, NULL, NULL, NULL),
(187, 'Saint Vincent and the Grenadines', 1, 0, NULL, NULL, NULL),
(188, 'Samoa', 1, 0, NULL, NULL, NULL),
(189, 'San Marino', 1, 0, NULL, NULL, NULL),
(190, 'Sao Tome and Principe', 1, 0, NULL, NULL, NULL),
(191, 'Saudi Arabia', 1, 0, NULL, NULL, NULL),
(192, 'Senegal', 1, 0, NULL, NULL, NULL),
(193, 'Serbia', 1, 0, NULL, NULL, NULL),
(194, 'Seychelles', 1, 0, NULL, NULL, NULL),
(195, 'Sierra Leone', 1, 0, NULL, NULL, NULL),
(196, 'Singapore', 1, 0, NULL, NULL, NULL),
(197, 'Slovakia', 1, 0, NULL, NULL, NULL),
(198, 'Slovenia', 1, 0, NULL, NULL, NULL),
(199, 'Solomon Islands', 1, 0, NULL, NULL, NULL),
(200, 'Somalia', 1, 0, NULL, NULL, NULL),
(201, 'South Africa', 1, 0, NULL, NULL, NULL),
(202, 'South Sudan', 1, 0, NULL, NULL, NULL),
(203, 'South Georgia and the South Sandwich Islands', 1, 0, NULL, NULL, NULL),
(204, 'Spain', 1, 0, NULL, NULL, NULL),
(205, 'Sri Lanka', 1, 0, NULL, NULL, NULL),
(206, 'Sudan', 1, 0, NULL, NULL, NULL),
(207, 'Suricountry_label', 1, 0, NULL, NULL, NULL),
(208, 'Svalbard and Jan Mayen', 1, 0, NULL, NULL, NULL),
(209, 'Swaziland', 1, 0, NULL, NULL, NULL),
(210, 'Sweden', 1, 0, NULL, NULL, NULL),
(211, 'Switzerland', 1, 0, NULL, NULL, NULL),
(212, 'Syrian Arab Republic', 1, 0, NULL, NULL, NULL),
(213, 'Taiwan', 1, 0, NULL, NULL, NULL),
(214, 'Tajikistan', 1, 0, NULL, NULL, NULL),
(215, 'Tanzania, United Republic of Tanzania', 1, 0, NULL, NULL, NULL),
(216, 'Thailand', 1, 0, NULL, NULL, NULL),
(217, 'Timor-Leste', 1, 0, NULL, NULL, NULL),
(218, 'Togo', 1, 0, NULL, NULL, NULL),
(219, 'Tokelau', 1, 0, NULL, NULL, NULL),
(220, 'Tonga', 1, 0, NULL, NULL, NULL),
(221, 'Trinidad and Tobago', 1, 0, NULL, NULL, NULL),
(222, 'Tunisia', 1, 0, NULL, NULL, NULL),
(223, 'Turkey', 1, 0, NULL, NULL, NULL),
(224, 'Turkmenistan', 1, 0, NULL, NULL, NULL),
(225, 'Turks and Caicos Islands', 1, 0, NULL, NULL, NULL),
(226, 'Tuvalu', 1, 0, NULL, NULL, NULL),
(227, 'Uganda', 1, 0, NULL, NULL, NULL),
(228, 'Ukraine', 1, 0, NULL, NULL, NULL),
(229, 'United Arab Emirates', 1, 0, NULL, NULL, NULL),
(230, 'United Kingdom', 1, 0, NULL, NULL, NULL),
(231, 'United States', 1, 0, NULL, NULL, NULL),
(232, 'Uruguay', 1, 0, NULL, NULL, NULL),
(233, 'Uzbekistan', 1, 0, NULL, NULL, NULL),
(234, 'Vanuatu', 1, 0, NULL, NULL, NULL),
(235, 'Venezuela, Bolivarian Republic of Venezuela', 1, 0, NULL, NULL, NULL),
(236, 'Vietnam', 1, 0, NULL, NULL, NULL),
(237, 'Virgin Islands, British', 1, 0, NULL, NULL, NULL),
(238, 'Virgin Islands, U.S.', 1, 0, NULL, NULL, NULL),
(239, 'Wallis and Futuna', 1, 0, NULL, NULL, NULL),
(240, 'Yemen', 1, 0, NULL, NULL, NULL),
(241, 'Zambia', 1, 0, NULL, NULL, NULL),
(242, 'Zimbabwe', 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rented_books`
--

CREATE TABLE `rented_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `time_borroewd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_vendor_id_foreign` (`vendor_id`),
  ADD KEY `books_book_cat_foreign` (`book_cat`),
  ADD KEY `books_book_material_type_foreign` (`book_material_type`),
  ADD KEY `books_book_country_foreign` (`book_country`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_materials`
--
ALTER TABLE `book_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bought_books`
--
ALTER TABLE `bought_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bought_books_user_id_foreign` (`user_id`),
  ADD KEY `bought_books_book_id_foreign` (`book_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_book_id_foreign` (`book_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rented_books`
--
ALTER TABLE `rented_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rented_books_user_id_foreign` (`user_id`),
  ADD KEY `rented_books_book_id_foreign` (`book_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD UNIQUE KEY `vendors_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_materials`
--
ALTER TABLE `book_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bought_books`
--
ALTER TABLE `bought_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rented_books`
--
ALTER TABLE `rented_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_book_cat_foreign` FOREIGN KEY (`book_cat`) REFERENCES `book_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_book_country_foreign` FOREIGN KEY (`book_country`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_book_material_type_foreign` FOREIGN KEY (`book_material_type`) REFERENCES `book_materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bought_books`
--
ALTER TABLE `bought_books`
  ADD CONSTRAINT `bought_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bought_books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rented_books`
--
ALTER TABLE `rented_books`
  ADD CONSTRAINT `rented_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rented_books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

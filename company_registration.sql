-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 09:49 PM
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
-- Database: `company_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_national_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `phone_code` varchar(5) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `info` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_national_id`, `name`, `email`, `email_verified_at`, `phone`, `phone_code`, `photo`, `info`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, '9991001111', 'Apple', 'muh.yamani.1111@gmail.com', NULL, '+962790963251', '0', NULL, NULL, 'empty', '$2y$12$Slg561ElMBR.ig/NpM2SHueL7cRo7L3aZ3f51zsN6MpbYoVAJLmsm', NULL, '2024-11-02 14:55:21', '2024-11-02 14:55:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_national_info`
--

CREATE TABLE `company_national_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_national_id` varchar(50) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_30_171515_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Company', 1, 'auth_token', 'd02b4000b5ea076e883bccff040f9fa2d7c747fac51245361ff4992f37cec2a3', '[\"*\"]', NULL, NULL, '2024-11-01 12:18:05', '2024-11-01 12:18:05'),
(2, 'App\\Models\\Company', 1, 'auth_token', '9b3d7fe8e1b122fb1f8fc352d22a13260e58d95f1d590540210b5de4fb5ee04c', '[\"*\"]', NULL, NULL, '2024-11-01 12:23:02', '2024-11-01 12:23:02'),
(3, 'App\\Models\\Company', 1, 'auth_token', 'cd1ddee06f380c046b4622255801d02f59ce9e17e29c4c6ac61ec0f5ddb656c4', '[\"*\"]', NULL, NULL, '2024-11-01 12:25:16', '2024-11-01 12:25:16'),
(4, 'App\\Models\\Company', 1, 'auth_token', '68619bd658ad156cf6fd107caedf372bd62dfacde96a55aae2a6db5c8735e876', '[\"*\"]', NULL, NULL, '2024-11-01 12:29:02', '2024-11-01 12:29:02'),
(5, 'App\\Models\\Company', 1, 'auth_token', '5fdc40ecc630166f80e8f2f2a24353c2e5f5fda903b85953b8428a89b983b206', '[\"*\"]', NULL, NULL, '2024-11-01 12:40:23', '2024-11-01 12:40:23'),
(6, 'App\\Models\\Company', 1, 'auth_token', '55c138eac0c1a26797f5882971031b534fe5ab633e99210e080ee7ec9bec7f54', '[\"*\"]', NULL, NULL, '2024-11-01 12:47:00', '2024-11-01 12:47:00'),
(7, 'App\\Models\\Company', 1, 'auth_token', '442e5cf905d67b22fdba77b417f43ec3226a3be656a504bf253db31589c19788', '[\"*\"]', NULL, NULL, '2024-11-01 13:00:35', '2024-11-01 13:00:35'),
(8, 'App\\Models\\Company', 1, 'auth_token', '8a341e85e18094783927ea8f217ac10720aa4f16ba287ef6fc9b7491519857b8', '[\"*\"]', NULL, NULL, '2024-11-01 13:05:32', '2024-11-01 13:05:32'),
(9, 'App\\Models\\Company', 1, 'auth_token', '746b0c183e8e5d1d0bd1fcb5e57f6498f1c6236cfce89762036bf2e5e2b087fe', '[\"*\"]', NULL, NULL, '2024-11-01 13:06:30', '2024-11-01 13:06:30'),
(10, 'App\\Models\\Company', 1, 'auth_token', 'b1f96de0cedfc87503e33e988f1927f1e97fbf874f975fb07a53fc21d34bf4a1', '[\"*\"]', NULL, NULL, '2024-11-01 13:14:05', '2024-11-01 13:14:05'),
(11, 'App\\Models\\Company', 1, 'auth_token', 'bc9f1bc93d4de5fabc60ab1a522c04613a8ef2659a9445bf29a3e6eccb5f6f9c', '[\"*\"]', NULL, NULL, '2024-11-01 13:47:51', '2024-11-01 13:47:51'),
(12, 'App\\Models\\Company', 1, 'auth_token', '9a57a240bfe21e94d73c26b48332666b6fc963ea56ba64af7754b15318bada51', '[\"*\"]', NULL, NULL, '2024-11-01 13:53:19', '2024-11-01 13:53:19'),
(13, 'App\\Models\\Company', 1, 'auth_token', '8dc741e34d3c1ac3f2df85d0bc765abdead579147b91351179b64914c5b98915', '[\"*\"]', NULL, NULL, '2024-11-01 13:55:45', '2024-11-01 13:55:45'),
(14, 'App\\Models\\Company', 1, 'auth_token', '0cdf85279f322c233e03ba6ba56040827ff40aebd1ad274a02b4c7d33da119b4', '[\"*\"]', NULL, NULL, '2024-11-01 13:57:13', '2024-11-01 13:57:13'),
(15, 'App\\Models\\Company', 1, 'auth_token', 'eb7bd77d6574d38d333dfcbf1025564dccc7508d97251cfedefbfde38437ddf2', '[\"*\"]', NULL, NULL, '2024-11-01 13:59:00', '2024-11-01 13:59:00'),
(16, 'App\\Models\\Company', 1, 'auth_token', 'e2ee2884718d4db94d154b6a30454f83c4c7c482478c383456b7c9793e90c942', '[\"*\"]', NULL, NULL, '2024-11-01 14:00:02', '2024-11-01 14:00:02'),
(17, 'App\\Models\\Company', 1, 'auth_token', '92613ae7a2735b70481d654e6d9e97788c5c5202083e461ca444c1004f07ce56', '[\"*\"]', NULL, NULL, '2024-11-01 14:02:46', '2024-11-01 14:02:46'),
(18, 'App\\Models\\Company', 1, 'auth_token', '379281d04c2d7fa7cbdc321c1de27d6b850524d652eb22cd2870439d4c6e2c12', '[\"*\"]', NULL, NULL, '2024-11-01 14:06:13', '2024-11-01 14:06:13'),
(19, 'App\\Models\\Company', 1, 'auth_token', 'ea51b635850878cda0a9e45acd2cfc070601822648675aec1ad5abe216f29969', '[\"*\"]', NULL, NULL, '2024-11-01 14:06:29', '2024-11-01 14:06:29'),
(20, 'App\\Models\\Company', 1, 'auth_token', 'e3b3fa615a5751a0ae081e7e84c03b2a21c4349a6edd3b0225a03c6f447bdb3e', '[\"*\"]', NULL, NULL, '2024-11-01 14:17:11', '2024-11-01 14:17:11'),
(21, 'App\\Models\\Company', 1, 'auth_token', 'a8e462bd582b8b2d1d7dc2f7f00f9ee5c309465250613b951bf7517fad550038', '[\"*\"]', NULL, NULL, '2024-11-01 14:17:42', '2024-11-01 14:17:42'),
(22, 'App\\Models\\Company', 1, 'auth_token', 'eca3dcdecbc50ebc31370cd8b1399e9623c6bfda0a88a66d05e91314c04fdb0c', '[\"*\"]', NULL, NULL, '2024-11-01 14:18:31', '2024-11-01 14:18:31'),
(23, 'App\\Models\\Company', 1, 'auth_token', '3c8a23eef1a6a91cc6c732bd24ea45a983439200113c7da6e07e7de6292d1a69', '[\"*\"]', NULL, NULL, '2024-11-01 14:21:37', '2024-11-01 14:21:37'),
(24, 'App\\Models\\Company', 1, 'auth_token', 'd0f1fc6f7837e2cac1e14ac990ced46963a707b44ef4aa3d64cd6500a01710ac', '[\"*\"]', NULL, NULL, '2024-11-01 14:24:53', '2024-11-01 14:24:53'),
(25, 'App\\Models\\Company', 1, 'auth_token', 'ead2b3f3ae9046bd065f3647fc2f086205cee78b44ece1cea52e99a0d3ad9b55', '[\"*\"]', NULL, NULL, '2024-11-01 14:26:11', '2024-11-01 14:26:11'),
(26, 'App\\Models\\Company', 1, 'auth_token', 'bc149d89917266730c7ef874adc13fdeb9ef230fb038de7a3fbf57c2781dca91', '[\"*\"]', NULL, NULL, '2024-11-01 14:33:48', '2024-11-01 14:33:48'),
(27, 'App\\Models\\Company', 1, 'auth_token', '71b66eb3b76cd1a644411b70ed37a2586e9639fe06bfef783ae8942b802f352a', '[\"*\"]', NULL, NULL, '2024-11-01 14:38:44', '2024-11-01 14:38:44'),
(28, 'App\\Models\\Company', 1, 'auth_token', '032436834da508a2268a86b97fe3c1cbb4c9307078adb6e50908fa04bb3d2025', '[\"*\"]', NULL, NULL, '2024-11-01 14:39:20', '2024-11-01 14:39:20'),
(29, 'App\\Models\\Company', 1, 'auth_token', '83fb189aa18edc459fd91019263ca1515187e385ce8c48e30927be22d746323e', '[\"*\"]', NULL, NULL, '2024-11-01 14:39:35', '2024-11-01 14:39:35'),
(30, 'App\\Models\\Company', 1, 'auth_token', '53b1b87e90d77069541429bdb2c05370c4052b5f4d4d688b0fcc3aa01613e511', '[\"*\"]', '2024-11-01 14:43:33', NULL, '2024-11-01 14:43:31', '2024-11-01 14:43:33'),
(31, 'App\\Models\\Company', 1, 'auth_token', 'ba84da6764bf036dead05f332a81df4554be3259b55269f2bc0b373652e68cef', '[\"*\"]', NULL, NULL, '2024-11-01 14:44:32', '2024-11-01 14:44:32'),
(32, 'App\\Models\\Company', 1, 'auth_token', '686c04aded6ac3647d608dbf9f3a626c406b6df32498c795e482e32a3b121d5c', '[\"*\"]', NULL, NULL, '2024-11-01 14:45:04', '2024-11-01 14:45:04'),
(33, 'App\\Models\\Company', 1, 'auth_token', '63be5b95b27099cd260d78f1dd9a5ccdec4ab74be712e61fae929743b97fde96', '[\"*\"]', NULL, NULL, '2024-11-01 14:45:32', '2024-11-01 14:45:32'),
(34, 'App\\Models\\Company', 1, 'auth_token', '6e2d26ee11cba90177a00ac147ccffaf41dfa74363d531870ebd11974aa02c78', '[\"*\"]', NULL, NULL, '2024-11-01 14:49:03', '2024-11-01 14:49:03'),
(35, 'App\\Models\\Company', 1, 'auth_token', 'd40c0e92e13460920a3bbaccc5495b1fee621cf0f913ba864ef27e79d86ebb73', '[\"*\"]', '2024-11-01 14:49:52', NULL, '2024-11-01 14:49:51', '2024-11-01 14:49:52'),
(36, 'App\\Models\\Company', 1, 'auth_token', 'f599208ac448ecb8b3b9743df5eb754b5e25974fda802fbd41709d6589a6f27e', '[\"*\"]', '2024-11-01 14:50:24', NULL, '2024-11-01 14:50:23', '2024-11-01 14:50:24'),
(37, 'App\\Models\\Company', 1, 'auth_token', 'fa0190a5c35a3edfea635f923a0d997a130c4e30f2ec03c1623ef1628ba6de2f', '[\"*\"]', '2024-11-01 14:58:17', NULL, '2024-11-01 14:58:15', '2024-11-01 14:58:17'),
(38, 'App\\Models\\Company', 1, 'auth_token', '911e1915df96e8cad0b645838dcf944341f45c82f0ee2b9093fc69526c1539da', '[\"*\"]', '2024-11-01 15:01:50', NULL, '2024-11-01 15:01:49', '2024-11-01 15:01:50'),
(39, 'App\\Models\\Company', 1, 'auth_token', '71e744a8f447c80970218cc7174159b4a5cede743bd1cc8b73e9ead7619c51ba', '[\"*\"]', NULL, NULL, '2024-11-01 15:02:08', '2024-11-01 15:02:08'),
(40, 'App\\Models\\Company', 1, 'auth_token', 'c7458f2b7bd06b1e99c1c65ea7cb838786a75896d52aa193ab1edeefce5bf89e', '[\"*\"]', NULL, NULL, '2024-11-01 15:04:18', '2024-11-01 15:04:18'),
(41, 'App\\Models\\Company', 1, 'auth_token', 'c3bab093ccabe72ec7b94da84f96f58840a40c5de18b62a7ea3ae8bc00b197ff', '[\"*\"]', NULL, NULL, '2024-11-01 15:08:27', '2024-11-01 15:08:27'),
(42, 'App\\Models\\Company', 1, 'auth_token', '0b1e127f9bedd6d0f981e244544fa09cacc7493aceeba9f110862f9641d24ab2', '[\"*\"]', NULL, NULL, '2024-11-01 15:08:45', '2024-11-01 15:08:45'),
(43, 'App\\Models\\Company', 1, 'auth_token', 'e50ec7f45e9fd467c2df0624f3672ed38c3d71949b50dde3d702da62cdb82606', '[\"*\"]', NULL, NULL, '2024-11-01 15:11:10', '2024-11-01 15:11:10'),
(44, 'App\\Models\\Company', 1, 'auth_token', '00bb0568c0a15b1ee5c599b852f52feabe8a16a029e9e900b09eb9d47ee7409f', '[\"*\"]', NULL, NULL, '2024-11-01 15:23:56', '2024-11-01 15:23:56'),
(45, 'App\\Models\\Company', 1, 'auth_token', '73af05e6ef48fcce25ba7191d8dfa5f470849ea8b5d30c47bbf2225a50797b4c', '[\"*\"]', NULL, NULL, '2024-11-01 15:25:32', '2024-11-01 15:25:32'),
(46, 'App\\Models\\Company', 1, 'auth_token', '556c67017c61f340056e1987201cd3f872b62509983391368608da7a6987eb9a', '[\"*\"]', NULL, NULL, '2024-11-01 15:26:41', '2024-11-01 15:26:41'),
(47, 'App\\Models\\Company', 1, 'auth_token', '5ee5192f38e969abcfc776d41fd363b8c5dff87ef8c93f7f71c43e27b5f15ae6', '[\"*\"]', NULL, NULL, '2024-11-01 15:27:36', '2024-11-01 15:27:36'),
(48, 'App\\Models\\Company', 1, 'auth_token', 'eeb995eb542be269e18897a878f7e225d929c3fe6bda71def109460111b6c154', '[\"*\"]', NULL, NULL, '2024-11-01 15:31:53', '2024-11-01 15:31:53'),
(49, 'App\\Models\\Company', 1, 'auth_token', 'ac581ff7b893c61494e521a21b1b09a672884539f5fccdf33e510397d6dbf452', '[\"*\"]', NULL, NULL, '2024-11-01 15:37:37', '2024-11-01 15:37:37'),
(50, 'App\\Models\\Company', 1, 'auth_token', '87f2af1f0884c9c0c5fcbf3293af07474bcc4a7740ebdceff9589a3173d3b348', '[\"*\"]', NULL, NULL, '2024-11-01 15:43:52', '2024-11-01 15:43:52'),
(51, 'App\\Models\\Company', 1, 'auth_token', '6cc408ab2b1fd57d89850c11cacd653c51a2da2b71800570d6e3a55c40e51cd2', '[\"*\"]', NULL, NULL, '2024-11-01 15:50:37', '2024-11-01 15:50:37'),
(52, 'App\\Models\\Company', 1, 'auth_token', 'cdf656447f13917cd84bcce82ff7e26a5df1d737ad2cccf4afb4d6574003462a', '[\"*\"]', NULL, NULL, '2024-11-01 15:54:26', '2024-11-01 15:54:26'),
(53, 'App\\Models\\Company', 1, 'auth_token', '0e0e5e2bc901ad095f7ce6930cc3d60ee2018af9afb201b47a659c5114f484d3', '[\"*\"]', NULL, NULL, '2024-11-01 15:57:39', '2024-11-01 15:57:39'),
(54, 'App\\Models\\Company', 1, 'auth_token', 'c63f7de1a08b89a00745b580de709ccaf16b52eec597dfa050839a5b51676580', '[\"*\"]', NULL, NULL, '2024-11-01 16:00:37', '2024-11-01 16:00:37'),
(55, 'App\\Models\\Company', 1, 'auth_token', 'cbfe29b44bfe58a7f39de183310d5e8d53c00831e7830aeb2aa115d7f4e3cd8b', '[\"*\"]', NULL, NULL, '2024-11-01 16:02:18', '2024-11-01 16:02:18'),
(56, 'App\\Models\\Company', 1, 'auth_token', 'e5529c0c9026a5bc290cf14a485c0d5974098c382680b4e1254039837becbfc0', '[\"*\"]', NULL, NULL, '2024-11-01 16:04:10', '2024-11-01 16:04:10'),
(57, 'App\\Models\\Company', 1, 'auth_token', '0262d64ec3e3582764d6277fa986139bb2a74dd6b9b0306983a9180d24e3b2a0', '[\"*\"]', NULL, NULL, '2024-11-01 16:06:25', '2024-11-01 16:06:25'),
(58, 'App\\Models\\Company', 1, 'auth_token', '800680b151ab50135a695fb17a545b82c25695bd4eeb8ed5325db72a9818e24a', '[\"*\"]', NULL, NULL, '2024-11-01 16:28:20', '2024-11-01 16:28:20'),
(59, 'App\\Models\\Company', 1, 'auth_token', '97ada074803cc5cbd87b07dff577255b3e6f98257cc21fd26963f6b8e6e1ffd3', '[\"*\"]', NULL, NULL, '2024-11-01 16:31:04', '2024-11-01 16:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CkYfeMsj3CAD9cXBjUQJgI2zk4EqlQQdGG45lQWT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHFVYkFReEh2UVJCVlVmZE9IZzlEV0p0eG9DbW5FbUdtOXRWVmY0SSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1730559031),
('LGl4ur74prALyw9ucA9gYfj23PWfVGC30AOo3OVW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjliN0JsS05jNEFwWUhscFVOUmpBbGNrdWk1c1F2aVlremZQbEd0MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1730554034),
('uVs4diHWKFt1GNo24VNFYIUtbnpgrhopxSsEmctk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemxDRjBwdTU4cVIyQlJRc1VDandYdjRlMHpSNENPeVhSbUZjUUJrQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO319', 1730559015);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_national_id` (`company_national_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `company_national_info`
--
ALTER TABLE `company_national_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_national_id` (`company_national_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company_national_info`
--
ALTER TABLE `company_national_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_national_info`
--
ALTER TABLE `company_national_info`
  ADD CONSTRAINT `company_national_info_ibfk_1` FOREIGN KEY (`company_national_id`) REFERENCES `companies` (`company_national_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

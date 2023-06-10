-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 10:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ott`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES
(1, 'ra', 'f', 'rakibmiah120199@gmail.com', NULL, '$2y$10$8pFTwD9LVGjINV9CvoQSFOXJAMT20DpVVr4Bne90j5lPg2KPlCSkS');

-- --------------------------------------------------------

--
-- Table structure for table `current_subcription`
--

CREATE TABLE `current_subcription` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_history_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `feature_movies`
--

CREATE TABLE `feature_movies` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feature_movies`
--

INSERT INTO `feature_movies` (`id`, `movie_name`, `category`, `sub_category`, `ordering`, `created_at`) VALUES
(6, 'rehana-mariom', 'home', NULL, 0, '2023-04-25 10:24:19'),
(7, 'unish-bish', 'home', NULL, 0, '2023-04-25 10:24:19'),
(8, 'tramp-card', 'home', NULL, 0, '2023-04-25 10:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `film_industries`
--

CREATE TABLE `film_industries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film_industries`
--

INSERT INTO `film_industries` (`id`, `name`, `display_name`) VALUES
(1, 'bollywood', 'Bollywood'),
(3, 'tollywood', 'Tollywood'),
(4, 'telegu', 'Telegu'),
(11, 'tamil', 'Tamil');

-- --------------------------------------------------------

--
-- Table structure for table `home_categories`
--

CREATE TABLE `home_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `ordering` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_categories`
--

INSERT INTO `home_categories` (`id`, `name`, `display_name`, `ordering`, `created_at`) VALUES
(1, 'movies-you-must-watch', 'Movies You Must Watch', 1, '2023-04-02 17:11:12'),
(2, 'indian-super-hit', 'Indian Super Hit', 2, '2023-04-02 17:11:12'),
(3, 'bengali-super-hit', 'Bengali Super Hit', 3, '2023-04-02 17:11:12'),
(4, 'based-on-your-watched', 'Based On Your Watched', 4, '2023-04-02 17:11:12'),
(6, 'bong-tv-original', 'Bong TV Original', 0, '2023-04-30 17:14:10'),
(7, 'afran-nisho', 'Afran Nisho', 0, '2023-04-30 17:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `home_categories_visibility`
--

CREATE TABLE `home_categories_visibility` (
  `id` int(11) NOT NULL,
  `home_category_name` varchar(255) NOT NULL,
  `movie_name` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_categories_visibility`
--

INSERT INTO `home_categories_visibility` (`id`, `home_category_name`, `movie_name`, `ordering`) VALUES
(13, 'bong-tv-original', 'dui-diner-duia', 0),
(14, 'bong-tv-original', 'tan', 0),
(15, 'bong-tv-original', 'jahan', 0),
(16, 'bong-tv-original', 'cafe-desire', 0),
(17, 'bong-tv-original', 'network-er-baire', 0),
(18, 'afran-nisho', 'syndicate', 0),
(19, 'afran-nisho', 'red-rum', 0),
(20, 'afran-nisho', 'sulko-pokkho', 0),
(21, 'afran-nisho', 'morichika', 0),
(22, 'movies-you-must-watch', 'travel-mates', 0),
(23, 'movies-you-must-watch', 'the-red-sleeve', 0),
(24, 'movies-you-must-watch', 'weightlifting-fairy', 0),
(25, 'movies-you-must-watch', 'luka', 0),
(26, 'movies-you-must-watch', 'i-am-not-a-robot', 0),
(27, 'movies-you-must-watch', 'topoli', 0),
(28, 'movies-you-must-watch', 'theren', 0);

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`id`, `name`, `display_name`, `ordering`, `created_at`) VALUES
(1, 'movies', 'Movies', 0, '2023-04-01 15:19:41'),
(2, 'series', 'Series', 1, '2023-04-01 15:19:41'),
(3, 'shows', 'Shows', 2, '2023-04-01 15:19:41'),
(4, 'kids', 'Kids', 3, '2023-04-01 15:19:41'),
(6, 'home', 'Home', 4, '2023-04-24 01:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `length` double(10,2) DEFAULT 0.00,
  `tumbnail` varchar(1000) DEFAULT NULL,
  `image_1` varchar(1000) DEFAULT NULL,
  `image_2` varchar(1000) DEFAULT NULL,
  `image_3` varchar(1000) DEFAULT NULL,
  `image_4` varchar(1000) DEFAULT NULL,
  `trailler` varchar(1000) DEFAULT NULL,
  `video` varchar(1000) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `imdb` double(10,2) DEFAULT -1.00,
  `visibility` tinyint(1) DEFAULT 1,
  `play_mode` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `film_industries_name` varchar(255) DEFAULT NULL,
  `video_type_name` varchar(255) DEFAULT NULL,
  `home_category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `display_name`, `length`, `tumbnail`, `image_1`, `image_2`, `image_3`, `image_4`, `trailler`, `video`, `description`, `imdb`, `visibility`, `play_mode`, `category_name`, `sub_category_name`, `film_industries_name`, `video_type_name`, `home_category_name`) VALUES
(21, 'tiger-4', 'Tiger-4', 157.00, 'movies/2023/Tiger-4/thm1681227545.jpg', '', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 10.00, 1, 'free', 'series', 'romantic', 'bollywood', 'single', NULL),
(23, 'kgf', 'KGF', 120.00, 'movies/2023/KGF/thm1681497928.jpg', 'movies/2023/KGF/img11681497927.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', NULL, 1, 'free', 'movies', 'romantic', 'bollywood', 'single', 'movies-you-must-watch'),
(24, 'rehana-mariom', 'Rehana Mariom', 110.00, 'movies/2023/Rehana Mariom/thm1682418175.png', 'movies/2023/Rehana Mariom/img11682418175.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.80, 1, 'free', 'movies', 'women-centric', 'bollywood', 'single', 'indian-super-hit'),
(25, 'unish-bish', 'Unish Bish', 110.00, 'movies/2023/Unish Bish/thm1682876050.jpg', 'movies/2023/Unish Bish/img11682418210.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.80, 1, 'free', 'movies', 'romantic', 'bollywood', 'single', 'bong-tv-original'),
(26, 'tramp-card', 'Tramp Card', 110.00, 'movies/2023/Tramp Card/thm1682418229.png', 'movies/2023/Tramp Card/img11682418229.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.80, 1, 'free', 'movies', 'action', 'bollywood', 'single', 'indian-super-hit'),
(27, 'syndicate', 'Syndicate', NULL, 'movies/2023/Syndicate/thm1682875569.jpg', 'movies/2023/Syndicate/img11682875569.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'series', 'action', 'tollywood', 'multiple', 'afran-nisho'),
(28, 'red-rum', 'Red Rum', NULL, 'movies/2023/Red Rum/thm1682875781.jpg', 'movies/2023/Red Rum/img11682875781.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'movies', 'thriller', 'tollywood', 'single', 'afran-nisho'),
(29, 'sulko-pokkho', 'Sulko Pokkho', NULL, 'movies/2023/Sulko Pokkho/thm1682875911.jpg', 'movies/2023/Sulko Pokkho/img11682875911.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'movies', 'thriller', 'tollywood', 'single', 'afran-nisho'),
(30, 'morichika', 'Morichika', NULL, 'movies/2023/Morichika/thm1682875945.jpg', 'movies/2023/Morichika/img11682875945.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'series', 'action', 'tollywood', 'multiple', 'afran-nisho'),
(31, 'dui-diner-duia', 'Dui Diner Duia', NULL, 'movies/2023/Dui Diner Duia/thm1682876363.jpg', 'movies/2023/Dui Diner Duia/img11682876112.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'movies', 'action', 'tollywood', 'multiple', 'bong-tv-original'),
(32, 'tan', 'Tan', 111.00, 'movies/2023/Tan/thm1682876348.jpg', 'movies/2023/Tan/img11682876154.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'movies', 'action', 'tollywood', 'multiple', 'bong-tv-original'),
(33, 'jahan', 'Jahan', 111.00, 'movies/2023/Jahan/thm1682876334.jpg', 'movies/2023/Jahan/img11682876190.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'movies', 'action', 'tollywood', 'multiple', 'bong-tv-original'),
(34, 'cafe-desire', 'Cafe Desire', 111.00, 'movies/2023/Cafe Desire/thm1682876239.jpg', 'movies/2023/Cafe Desire/img11682876239.jpg', '', '', '', '', '', '<p><strong>Director</strong>: Shiab Sahin</p><p><strong>Actors</strong>: Afran Nisho, Tasnia Farin, Nafija Tushi, Sotabdi Oyadud, Rashed Mamun Apu, Nasir Uddin Khan</p><p><strong>Description</strong>: In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 9.10, 1, 'paid', 'movies', 'action', 'tollywood', 'multiple', 'bong-tv-original'),
(35, 'network-er-baire', 'Network Er Baire', 111.00, 'movies/2023/Network Er Baire/thm1682876446.jpg', 'movies/2023/Network Er Baire/img11682876446.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'bong-tv-original'),
(36, 'travel-mates', 'Travel Mates', 111.00, 'movies/2023/Travel Mates/thm1682876522.jpg', 'movies/2023/Travel Mates/img11682876522.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(37, 'the-red-sleeve', 'The Red Sleeve', 111.00, 'movies/2023/The Red Sleeve/thm1682876570.jpg', 'movies/2023/The Red Sleeve/img11682876570.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(38, 'weightlifting-fairy', 'WeightLifting Fairy', 111.00, 'movies/2023/WeightLifting Fairy/thm1682876613.jpg', 'movies/2023/WeightLifting Fairy/img11682876613.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(39, 'luka', 'Luka', 111.00, 'movies/2023/Luka/thm1682876648.jpg', 'movies/2023/Luka/img11682876648.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(40, 'i-am-not-a-robot', 'I Am Not A Robot', 111.00, 'movies/2023/I Am Not A Robot/thm1682876698.jpg', 'movies/2023/I Am Not A Robot/img11682876698.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(41, 'topoli', 'Topoli', 111.00, 'movies/2023/Topoli/thm1682876739.jpg', 'movies/2023/Topoli/img11682876738.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(42, 'theren', 'Theren', 111.00, 'movies/2023/Theren/thm1682876770.jpg', 'movies/2023/Theren/img11682876770.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'movies-you-must-watch'),
(43, 'pather-pachali', 'Pather Pachali', 111.00, 'movies/2023/Pather Pachali/thm1682876834.jpg', 'movies/2023/Pather Pachali/img11682876834.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'bengali-super-hit'),
(44, 'irak-rajar-desh', 'Irak Rajar Desh', 111.00, 'movies/2023/Irak Rajar Desh/thm1682876868.jpg', 'movies/2023/Irak Rajar Desh/img11682876868.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'bengali-super-hit'),
(45, 'oparajito', 'Oparajito', 111.00, 'movies/2023/Oparajito/thm1682876904.jpg', 'movies/2023/Oparajito/img11682876904.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'bengali-super-hit'),
(46, 'jalsha-ghar', 'Jalsha Ghar', 111.00, 'movies/2023/Jalsha Ghar/thm1682876935.jpg', 'movies/2023/Jalsha Ghar/img11682876935.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'bengali-super-hit'),
(47, 'ovijan', 'Ovijan', 111.00, 'movies/2023/Ovijan/thm1682876987.jpg', 'movies/2023/Ovijan/img11682876987.jpg', '', '', '', '', '', '<p>Hello World!</p><p>This is Quill <strong>default</strong> editor</p>', 9.10, 1, 'paid', 'movies', 'romantic', 'tollywood', 'multiple', 'bengali-super-hit');

-- --------------------------------------------------------

--
-- Stand-in structure for view `movies_for_search`
-- (See below for the actual view)
--
CREATE TABLE `movies_for_search` (
`movies_name` varchar(255)
,`name` varchar(255)
,`display_name` varchar(255)
,`tumbnail` varchar(1000)
,`play_mode` varchar(255)
,`length` double(10,2)
,`video_type_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `movies_part`
--

CREATE TABLE `movies_part` (
  `id` int(11) NOT NULL,
  `movies_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `length` double(10,2) DEFAULT 0.00,
  `tumbnail` varchar(1000) DEFAULT NULL,
  `image_1` varchar(1000) DEFAULT NULL,
  `image_2` varchar(1000) DEFAULT NULL,
  `image_3` varchar(1000) DEFAULT NULL,
  `image_4` varchar(1000) DEFAULT NULL,
  `video` varchar(1000) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `imdb` double(10,2) DEFAULT -1.00,
  `visibility` tinyint(1) DEFAULT 1,
  `play_mode` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies_part`
--

INSERT INTO `movies_part` (`id`, `movies_name`, `name`, `display_name`, `length`, `tumbnail`, `image_1`, `image_2`, `image_3`, `image_4`, `video`, `description`, `imdb`, `visibility`, `play_mode`, `ordering`) VALUES
(14, 'morichika', 'morichika-1', 'Morichika 1', 100.00, 'https://upload.wikimedia.org/wikipedia/en/7/7e/Morichika_poster.jpg', NULL, NULL, NULL, NULL, NULL, 'dddd', -1.00, 1, 'free', 1),
(15, 'morichika', 'morichika-2', 'Morichika 2', 100.00, 'https://upload.wikimedia.org/wikipedia/en/7/7e/Morichika_poster.jpg', NULL, NULL, NULL, NULL, NULL, 'dddd', -1.00, 1, 'free', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `request_for` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `phone`, `email`, `code`, `request_for`, `created_at`) VALUES
(1, '01732691729', NULL, '1234', 'login', '2023-04-26 17:51:50'),
(2, '01732691729', 'rakibmiah12019@gmail.com', '1235', 'login', '2023-04-26 17:51:50'),
(3, NULL, 'rabbil@gmail.com', '1234', 'login', '2023-04-30 20:03:07'),
(4, NULL, 'rabbil@mail.com', '1234', 'login', '2023-04-30 20:09:36'),
(5, NULL, 'rakib@mail.com', '1234', 'login', '2023-04-30 21:32:40'),
(6, NULL, 'null', '1234', 'login', '2023-05-01 17:01:12'),
(7, NULL, 'rakibmiah120199@gmail.com', '1234', 'login', '2023-05-01 17:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'myApp', 'd0170d4debb447a68605a4e05ec3953420775e840d7d5a7eb55bff9b4d356b6a', '[\"*\"]', NULL, NULL, '2023-04-25 14:50:43', '2023-04-25 14:50:43'),
(2, 'App\\Models\\User', 1, 'myApp', 'f597307701ea9faa8771c5717b8d76e67a89d677272b3ca48da9f84f2e95c820', '[\"*\"]', NULL, NULL, '2023-04-25 14:50:45', '2023-04-25 14:50:45'),
(3, 'App\\Models\\User', 1, 'myApp', '8fb763710550d75e30012b992580eb24c803f7bc1d9e6fa1bb6adb2b5a87c5a9', '[\"*\"]', '2023-04-25 16:43:21', NULL, '2023-04-25 14:57:33', '2023-04-25 16:43:21'),
(4, 'App\\Models\\User', 1, 'myApp', '451f7a6c738a89941c5e943411281e0d70e58feffbf1d6fceb4fef1e4c6fd6fc', '[\"*\"]', '2023-05-01 11:24:42', NULL, '2023-04-25 16:43:04', '2023-05-01 11:24:42'),
(5, 'App\\Models\\User', 1, 'myApp', '741093fbcbd512186a14b0e5933f19cf8d38944cbf25ac5e206e167327445e14', '[\"*\"]', '2023-04-29 13:06:17', NULL, '2023-04-26 07:09:19', '2023-04-29 13:06:17'),
(6, 'App\\Models\\User', 1, 'Rakib', '71cd38a853d1c8afa9e4fbd59052601cafb1c7713f18e12a91f80a9e7bb6667b', '[\"*\"]', NULL, NULL, '2023-04-26 11:59:44', '2023-04-26 11:59:44'),
(7, 'App\\Models\\User', 1, 'Rakib', '32743efc00f66b3b506c00a57358adb52059c91b0f8d8d0d79a9655558dddecf', '[\"*\"]', NULL, NULL, '2023-04-26 12:00:25', '2023-04-26 12:00:25'),
(8, 'App\\Models\\User', 1, 'Rakib', '8f7bc88b69cf6eb4640c048a8ba03e23bafd4d968f64097260a9b1613cb5b25a', '[\"*\"]', NULL, NULL, '2023-04-26 12:02:58', '2023-04-26 12:02:58'),
(9, 'App\\Models\\User', 1, 'Rakib', '5900d6491e0aa8cb310c9f3b64b7a87bf3c55cbd8c9b962412a8aa78d2c6de20', '[\"*\"]', NULL, NULL, '2023-04-27 12:38:23', '2023-04-27 12:38:23'),
(10, 'App\\Models\\User', 1, 'Rakib', '57e90dcaf6934e2fef625345109381e2f3b535c7d4ef693cb06031ef1bdd0876', '[\"*\"]', NULL, NULL, '2023-04-27 12:38:36', '2023-04-27 12:38:36'),
(11, 'App\\Models\\User', 1, 'Rakib', '981513ee821adafc297092a9074dc744097e49dfa5353049c41c1ad38ae0f83c', '[\"*\"]', NULL, NULL, '2023-04-27 12:47:14', '2023-04-27 12:47:14'),
(12, 'App\\Models\\User', 1, 'Rakib', '77977a17e32f7c7d2ed0333174d716e19f500579bd4532a93ee58464f59695ec', '[\"*\"]', '2023-04-27 12:48:39', NULL, '2023-04-27 12:47:38', '2023-04-27 12:48:39'),
(13, 'App\\Models\\User', 1, 'Rakib', '773c220255a42807d2a8012e669b61e7af7f5e447b6a1ac674582103cf776d44', '[\"*\"]', NULL, NULL, '2023-04-29 10:58:25', '2023-04-29 10:58:25'),
(14, 'App\\Models\\User', 1, 'Rakib', '06b11de60332e63bde037309222fa833d1ea454c979abce209512f1bdd45d943', '[\"*\"]', NULL, NULL, '2023-04-29 10:58:36', '2023-04-29 10:58:36'),
(15, 'App\\Models\\User', 1, 'Rakib', '11585cfe12cdd742f5e8565ddcacaf8ee06149f2a74a800604eceaa37ec20fb0', '[\"*\"]', NULL, NULL, '2023-04-29 10:59:10', '2023-04-29 10:59:10'),
(16, 'App\\Models\\User', 1, 'Rakib', '6eef6b4c982ebac85bc724bdec4a164ed1363417ec7410cf82916da2dd3265ec', '[\"*\"]', '2023-04-29 11:09:20', NULL, '2023-04-29 11:00:15', '2023-04-29 11:09:20'),
(17, 'App\\Models\\User', 1, 'Rakib', 'd310b9871f363562d5ac834cef17bcad7e0d217cda426d7b8c46a3820dfd9e85', '[\"*\"]', '2023-04-29 11:10:48', NULL, '2023-04-29 11:10:47', '2023-04-29 11:10:48'),
(18, 'App\\Models\\User', 1, 'Rakib', 'cdcd08695294e6e88af2e5ca7defba3cc92990a6f2ca8fbff56cee85b522bd16', '[\"*\"]', '2023-04-29 11:11:40', NULL, '2023-04-29 11:11:38', '2023-04-29 11:11:40'),
(19, 'App\\Models\\User', 1, 'Rakib', '673873d21b5c76a8f1f30c5f042fe01818a219a4a98a7df68deddfef8aaa656d', '[\"*\"]', '2023-04-29 11:13:05', NULL, '2023-04-29 11:13:04', '2023-04-29 11:13:05'),
(20, 'App\\Models\\User', 1, 'Rakib', 'bf38769a44d7a0063bbe65b4730c11279c7714ed81c7129ffcd09d0c6e2c53d3', '[\"*\"]', '2023-04-29 11:19:17', NULL, '2023-04-29 11:19:16', '2023-04-29 11:19:17'),
(21, 'App\\Models\\User', 1, 'Rakib', '06fa51406c9ccf948424360d2dfaf498a69520169b2ba7ecb6874ac4d035ca56', '[\"*\"]', '2023-04-29 11:27:19', NULL, '2023-04-29 11:27:17', '2023-04-29 11:27:19'),
(22, 'App\\Models\\User', 1, 'Rakib', '595233dfd88542fcbdffb5e37fd3a0e6aa34007c549fa8a09b091163227855b4', '[\"*\"]', '2023-04-29 11:36:42', NULL, '2023-04-29 11:27:48', '2023-04-29 11:36:42'),
(23, 'App\\Models\\User', 1, 'Rakib', '446fb2543c09c0a42ed2ca70780c71f632b70fd60d04dd561aeec58f70c22d32', '[\"*\"]', '2023-04-29 11:43:24', NULL, '2023-04-29 11:43:23', '2023-04-29 11:43:24'),
(24, 'App\\Models\\User', 1, 'Rakib', 'a1f6e23730fb570fe2d13c9ca79db74b5519067634bf404e5b79ccf8a3d92964', '[\"*\"]', '2023-04-29 11:44:52', NULL, '2023-04-29 11:44:51', '2023-04-29 11:44:52'),
(25, 'App\\Models\\User', 1, 'Rakib', 'cad264fef8cae616f75f2497ade995a9241640b2531617091aac5abf6afb5dbe', '[\"*\"]', '2023-04-30 13:53:31', NULL, '2023-04-29 13:03:15', '2023-04-30 13:53:31'),
(26, 'App\\Models\\User', 1, 'Rakib', 'bc7235f83a6b1c38f1fa95b29a790d7fefce0eb4f6c2ddb6892d33e9248c20d4', '[\"*\"]', NULL, NULL, '2023-04-30 13:37:57', '2023-04-30 13:37:57'),
(27, 'App\\Models\\User', 1, 'Rakib', '7c7380bbc64cce350410381583a263bbfe4b008eb8301e6bca4dfa9f37d57f10', '[\"*\"]', NULL, NULL, '2023-04-30 13:38:03', '2023-04-30 13:38:03'),
(28, 'App\\Models\\User', 1, 'Rakib', '6e4903685aa1dd67504322e7b998559d605074e55921461b2135dbe5a3e3c70c', '[\"*\"]', NULL, NULL, '2023-04-30 13:38:12', '2023-04-30 13:38:12'),
(29, 'App\\Models\\User', 1, 'Rakib', '71711689e5e493dd3005d7d332fb54228fc70c5b36a6d61e8e6d67375889dd05', '[\"*\"]', NULL, NULL, '2023-04-30 13:38:18', '2023-04-30 13:38:18'),
(30, 'App\\Models\\User', 1, 'Rakib', 'edf57e2efbee1a678d1be0de7b860aa731ee1b600dec8bb3a091d61ae27d3bb6', '[\"*\"]', NULL, NULL, '2023-04-30 13:43:14', '2023-04-30 13:43:14'),
(31, 'App\\Models\\User', 1, 'Rakib', 'cdbdb8b0dc7441beea7cc446557fff105006d4549783810a56efa1daf693c328', '[\"*\"]', NULL, NULL, '2023-04-30 13:45:15', '2023-04-30 13:45:15'),
(32, 'App\\Models\\User', 1, 'Rakib', 'fb14d61412b5d3c9ad9ca5e6327acc02f291cf589661f5bcc4c7078721d7c8ca', '[\"*\"]', NULL, NULL, '2023-04-30 13:45:18', '2023-04-30 13:45:18'),
(33, 'App\\Models\\User', 1, 'Rakib', '787a1272249783e736f4cd5915a230ac561031efef846032e9e2bd2935ff1bc7', '[\"*\"]', '2023-04-30 13:46:03', NULL, '2023-04-30 13:45:59', '2023-04-30 13:46:03'),
(34, 'App\\Models\\User', 1, 'Rakib', '13fe9d81e39b8261de1d1df376f6d8b82f6b1f008a1bb6e948ca04ff28b37896', '[\"*\"]', NULL, NULL, '2023-04-30 13:48:13', '2023-04-30 13:48:13'),
(35, 'App\\Models\\User', 1, 'Rakib', '1e0fbf02ea922e4d6e6a5285236c0d51d5ffa1ad430b2b812cc95d533b316c96', '[\"*\"]', NULL, NULL, '2023-04-30 13:48:22', '2023-04-30 13:48:22'),
(36, 'App\\Models\\User', 1, 'Rakib', '1afdbdd46d3f5805e2076520b93be000b974cd5e72b32d4796db4a8d63266bd2', '[\"*\"]', NULL, NULL, '2023-04-30 13:48:44', '2023-04-30 13:48:44'),
(37, 'App\\Models\\User', 3, 'rabbil@gmail.com', 'c09be60471949aae9da7592ff08bcaef99f644d8f5e3f808822247b7fa14b8b7', '[\"*\"]', '2023-04-30 14:06:41', NULL, '2023-04-30 14:06:38', '2023-04-30 14:06:41'),
(38, 'App\\Models\\User', 6, 'rabbil@mail.com', 'b468185946e9e7151b5caf0c6e43e3153c23a233a6c1420b60d0b41a2676e7cc', '[\"*\"]', '2023-04-30 15:20:31', NULL, '2023-04-30 14:09:42', '2023-04-30 15:20:31'),
(39, 'App\\Models\\User', 7, 'rakib@mail.com', '804323810223c3ddee252f4e3af18a9bddbc28f6080cd5fe8a76f398938918c1', '[\"*\"]', '2023-04-30 15:42:23', NULL, '2023-04-30 15:42:16', '2023-04-30 15:42:23'),
(40, 'App\\Models\\User', 9, 'rakibmiah120199@gmail.com', 'f70aa8291d65f61a2998798d82db81fb905d4c0009098b92eb7aafe23962ee5a', '[\"*\"]', '2023-05-01 12:33:07', NULL, '2023-05-01 11:02:10', '2023-05-01 12:33:07'),
(41, 'App\\Models\\User', 6, 'rabbil@mail.com', '96d9edc218eab998df556226a48b193af4757b294dff5796072026f8bce3ff5b', '[\"*\"]', '2023-05-01 12:34:13', NULL, '2023-05-01 12:34:10', '2023-05-01 12:34:13'),
(42, 'App\\Models\\User', 6, 'rabbil@mail.com', 'e1428e589f0eb223a151f6a32e9f99a37d6766462efcb725d4d7e927de7ae987', '[\"*\"]', '2023-05-01 12:57:55', NULL, '2023-05-01 12:41:00', '2023-05-01 12:57:55'),
(43, 'App\\Models\\User', 6, 'rabbil@mail.com', 'b5afc19a502fb39991d70678a479e1b7882535610171471ccd5b6e51c7fe3ee6', '[\"*\"]', '2023-05-02 09:51:45', NULL, '2023-05-01 12:58:39', '2023-05-02 09:51:45'),
(44, 'App\\Models\\User', 6, 'rabbil@mail.com', '5d9e7cdffeba4d26a0d2fd8a110ff926d66b94e6d9c2e153b0be71cb899d0c80', '[\"*\"]', '2023-05-02 14:08:59', NULL, '2023-05-02 10:16:06', '2023-05-02 14:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `play_mode`
--

CREATE TABLE `play_mode` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `play_mode`
--

INSERT INTO `play_mode` (`id`, `name`) VALUES
(1, 'free'),
(2, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_buy_history`
--

CREATE TABLE `subscription_buy_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subcription_id` varchar(255) DEFAULT NULL,
  `price` double(10,2) DEFAULT 0.00,
  `buy_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expire_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_coupon`
--

CREATE TABLE `subscription_coupon` (
  `id` int(11) NOT NULL,
  `subcription_id` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_type` varchar(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription_coupon`
--

INSERT INTO `subscription_coupon` (`id`, `subcription_id`, `coupon_code`, `discount_type`, `amount`, `created_at`) VALUES
(4, 'sbs_1234', 'XYEX', 'flat', 50.00, '2023-04-14 11:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plain`
--

CREATE TABLE `subscription_plain` (
  `id` int(11) NOT NULL,
  `subcription_id` varchar(255) NOT NULL,
  `duration_day` int(11) DEFAULT 0,
  `duration_month` int(11) DEFAULT 0,
  `duration_year` int(11) DEFAULT 0,
  `price` double(10,2) DEFAULT 0.00,
  `discount` double(10,2) DEFAULT 0.00,
  `discount_type` varchar(20) NOT NULL,
  `visibility` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription_plain`
--

INSERT INTO `subscription_plain` (`id`, `subcription_id`, `duration_day`, `duration_month`, `duration_year`, `price`, `discount`, `discount_type`, `visibility`, `created_at`) VALUES
(1, 'sbs_1234', 11, 0, 0, 100.00, 10.00, 'flat', 1, '2023-04-13 20:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `main_category_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `main_category_name`, `name`, `display_name`, `created_at`) VALUES
(1, 'movies', 'romantic', 'Romantic', '2023-04-01 15:28:18'),
(2, 'movies', 'action', 'Action', '2023-04-01 15:28:18'),
(3, 'movies', 'thriller', 'Thriller', '2023-04-01 15:28:18'),
(4, 'movies', 'women-centric', 'Women Centric', '2023-04-01 15:28:18'),
(5, 'movies', 'comedy', 'Comedy', '2023-04-01 15:28:18'),
(6, 'series', 'romantic', 'Romantic', '2023-04-01 15:29:27'),
(7, 'series', 'dramatic', 'Dramatic', '2023-04-01 15:29:27'),
(8, 'series', 'action', 'Action', '2023-04-01 15:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subscripe_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `first_name`, `last_name`, `email`, `phone`, `subscripe_id`, `password`) VALUES
(1, 'rakib11', 'Rakib', 'Miah', 'rakibmiah12019@gmail.com', '01732691729', NULL, '123456'),
(3, '', NULL, NULL, 'rabbil@gmail.com', NULL, NULL, ''),
(6, '', NULL, NULL, 'rabbil@mail.com', NULL, NULL, ''),
(7, '', NULL, NULL, 'rakib@mail.com', NULL, NULL, ''),
(8, '', NULL, NULL, 'null', NULL, NULL, ''),
(9, '', NULL, NULL, 'rakibmiah120199@gmail.com', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_favourites`
--

CREATE TABLE `user_favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_favourites`
--

INSERT INTO `user_favourites` (`id`, `user_id`, `movie_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'jahan', '2023-04-30 18:29:54', '2023-04-30 18:29:54'),
(2, 1, 'morichika', '2023-04-30 18:29:54', '2023-04-30 18:29:54'),
(40, 7, 'dui-diner-duia', '2023-04-30 21:42:21', '2023-04-30 21:42:21'),
(41, 7, 'tan', '2023-04-30 21:42:23', '2023-04-30 21:42:23'),
(44, 6, 'network-er-baire', '2023-05-01 19:22:46', '2023-05-01 19:22:46'),
(46, 6, 'sulko-pokkho', '2023-05-01 19:22:49', '2023-05-01 19:22:49'),
(47, 6, 'the-red-sleeve', '2023-05-01 19:22:52', '2023-05-01 19:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `video_type`
--

CREATE TABLE `video_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_type`
--

INSERT INTO `video_type` (`id`, `name`) VALUES
(1, 'single'),
(2, 'multiple');

-- --------------------------------------------------------

--
-- Structure for view `movies_for_search`
--
DROP TABLE IF EXISTS `movies_for_search`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `movies_for_search`  AS SELECT `movies`.`name` AS `movies_name`, `movies`.`name` AS `name`, `movies`.`display_name` AS `display_name`, `movies`.`tumbnail` AS `tumbnail`, `movies`.`play_mode` AS `play_mode`, `movies`.`length` AS `length`, `movies`.`video_type_name` AS `video_type_name` FROM `movies` union select `movies_part`.`movies_name` AS `movies_name`,`movies_part`.`name` AS `name`,`movies_part`.`display_name` AS `display_name`,`movies_part`.`tumbnail` AS `tumbnail`,`movies_part`.`play_mode` AS `play_mode`,`movies_part`.`length` AS `length`,'reference' AS `video_type_name` from `movies_part`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `current_subcription`
--
ALTER TABLE `current_subcription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `subscription_history_id` (`subscription_history_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feature_movies`
--
ALTER TABLE `feature_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_name` (`movie_name`),
  ADD KEY `category` (`category`),
  ADD KEY `sub_category` (`sub_category`);

--
-- Indexes for table `film_industries`
--
ALTER TABLE `film_industries`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `home_categories`
--
ALTER TABLE `home_categories`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `home_categories_visibility`
--
ALTER TABLE `home_categories_visibility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_category_name` (`home_category_name`),
  ADD KEY `movie_name` (`movie_name`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_name` (`category_name`),
  ADD KEY `sub_category_name` (`sub_category_name`),
  ADD KEY `film_industries_name` (`film_industries_name`),
  ADD KEY `video_type_name` (`video_type_name`),
  ADD KEY `home_category_name` (`home_category_name`);

--
-- Indexes for table `movies_part`
--
ALTER TABLE `movies_part`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `movies_name` (`movies_name`,`name`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `email` (`email`);

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
-- Indexes for table `play_mode`
--
ALTER TABLE `play_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_buy_history`
--
ALTER TABLE `subscription_buy_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscription_coupon`
--
ALTER TABLE `subscription_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plain`
--
ALTER TABLE `subscription_plain`
  ADD PRIMARY KEY (`id`,`subcription_id`),
  ADD UNIQUE KEY `subcription_id` (`subcription_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`,`main_category_name`),
  ADD KEY `main_category_name` (`main_category_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_favourites`
--
ALTER TABLE `user_favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_name` (`movie_name`);

--
-- Indexes for table `video_type`
--
ALTER TABLE `video_type`
  ADD PRIMARY KEY (`id`,`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `current_subcription`
--
ALTER TABLE `current_subcription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_movies`
--
ALTER TABLE `feature_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `film_industries`
--
ALTER TABLE `film_industries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `home_categories`
--
ALTER TABLE `home_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home_categories_visibility`
--
ALTER TABLE `home_categories_visibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `main_category`
--
ALTER TABLE `main_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `movies_part`
--
ALTER TABLE `movies_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `play_mode`
--
ALTER TABLE `play_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription_buy_history`
--
ALTER TABLE `subscription_buy_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_coupon`
--
ALTER TABLE `subscription_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription_plain`
--
ALTER TABLE `subscription_plain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_favourites`
--
ALTER TABLE `user_favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `video_type`
--
ALTER TABLE `video_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `current_subcription`
--
ALTER TABLE `current_subcription`
  ADD CONSTRAINT `current_subcription_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `current_subcription_ibfk_2` FOREIGN KEY (`subscription_history_id`) REFERENCES `subscription_buy_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feature_movies`
--
ALTER TABLE `feature_movies`
  ADD CONSTRAINT `feature_movies_ibfk_1` FOREIGN KEY (`movie_name`) REFERENCES `movies` (`name`),
  ADD CONSTRAINT `feature_movies_ibfk_2` FOREIGN KEY (`category`) REFERENCES `main_category` (`name`),
  ADD CONSTRAINT `feature_movies_ibfk_3` FOREIGN KEY (`sub_category`) REFERENCES `sub_category` (`name`);

--
-- Constraints for table `home_categories_visibility`
--
ALTER TABLE `home_categories_visibility`
  ADD CONSTRAINT `home_categories_visibility_ibfk_1` FOREIGN KEY (`home_category_name`) REFERENCES `home_categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `home_categories_visibility_ibfk_2` FOREIGN KEY (`movie_name`) REFERENCES `movies` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`category_name`) REFERENCES `main_category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`sub_category_name`) REFERENCES `sub_category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_3` FOREIGN KEY (`film_industries_name`) REFERENCES `film_industries` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_4` FOREIGN KEY (`video_type_name`) REFERENCES `video_type` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_5` FOREIGN KEY (`home_category_name`) REFERENCES `home_categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movies_part`
--
ALTER TABLE `movies_part`
  ADD CONSTRAINT `movies_part_ibfk_1` FOREIGN KEY (`movies_name`) REFERENCES `movies` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `otp_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `otp_ibfk_2` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription_buy_history`
--
ALTER TABLE `subscription_buy_history`
  ADD CONSTRAINT `subscription_buy_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`main_category_name`) REFERENCES `main_category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_favourites`
--
ALTER TABLE `user_favourites`
  ADD CONSTRAINT `user_favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_favourites_ibfk_2` FOREIGN KEY (`movie_name`) REFERENCES `movies` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

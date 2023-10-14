-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2023 at 11:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `album_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `album_body` varchar(255) NOT NULL,
  `album_keywords` varchar(255) NOT NULL,
  `album_thumb` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `album_name`, `category`, `album_body`, `album_keywords`, `album_thumb`, `views`, `added_on`) VALUES
(2, 'Lush Forests', '1', '&lt;p&gt;Explore the enchanting world of lush forests through our captivating collection of images. Immerse yourself in the vibrant greenery and discover the beauty of nature\'s finest.&lt;/p&gt;', 'forest, greenery, trees, foliage, nature, woods, lush, serene', '4bO3Kyi8sohuPnrg7aZ5kRwI.jpg', 9, '2023-10-07 09:05:47'),
(3, 'Breathtaking Waterfalls', '1', '&lt;p&gt;Be mesmerized by the sheer beauty and power of breathtaking waterfalls captured in stunning photographs. Experience the awe-inspiring force of nature\'s cascading wonders.&lt;/p&gt;', 'waterfalls, cascades, nature, beauty, landscape, scenic, flowing water', 'KPcWOMTahsmx8Ntr7y9nvDlY.jpg', 1, '2023-10-07 09:09:26'),
(4, 'Vibrant Sunsets', '1', '&lt;p&gt;Witness the magic of vibrant sunsets that paint the sky in a kaleidoscope of colors. Explore our collection of breathtaking sunset scenes from around the world.&lt;/p&gt;', 'sunset, twilight, colorful sky, horizon, dusk, evening, scenic views', 'yF8mgNJ6ilfEL0djw2zPQ9sb.jpg', 0, '2023-10-07 09:13:42'),
(5, 'Adventure Abroad', '2', '&lt;p&gt;Embark on a visual journey of adventure and discovery as you explore diverse cultures, landscapes, and experiences from around the globe.&lt;/p&gt;', 'ravel, adventure, exploration, culture, diversity, global, wanderlust\r\nAlbum: &quot;Cityscapes', 'vwCnPGzpxj5B9FbOVQLJrgi7.jpg', 0, '2023-10-07 09:15:06'),
(6, 'Cityscapes', '2', '&lt;p&gt;Discover the dynamic energy and architectural marvels of bustling cities. Our cityscape album showcases the urban beauty of iconic metropolises.&lt;/p&gt;', 'city, urban, skyline, skyscrapers, architecture, city lights, metropolis', 'FtZDXnwgb2UqP5IyoTjHpViu.jpg', 1, '2023-10-07 09:17:19'),
(7, 'Urban Wonders', '13', '&lt;p&gt;Urban architecture at its finest, showcasing the skyscrapers and cityscapes that define modern living.&lt;br&gt;&lt;/p&gt;', 'urban, architecture, skyscrapers, cityscapes, modern living, design', 'PthKmgF72IwuLjR5xqQWkSba.jpg', 0, '2023-10-14 14:32:11'),
(8, 'Historical Landmarks', '13', '&lt;p&gt;A journey through time, featuring iconic historical buildings and structures from around the world.&lt;br&gt;&lt;/p&gt;', 'historical landmarks, architecture, heritage, buildings, history, preservation', 'X4DuagC1NwIFsBnHRb2mr5d3.jpg', 0, '2023-10-14 14:33:22'),
(9, 'Adventures in Asia', '2', '&lt;p&gt;Embark on a visual journey through the diverse cultures, landscapes, and experiences of Asia.&lt;br&gt;&lt;/p&gt;', 'ravel, Asia, culture, landscapes, exploration, diversity', 'VQySwFDEacXeRTdZOIG93P17.jpg', 0, '2023-10-14 14:35:12'),
(10, 'Sculptures in Stone', '14', '&lt;p&gt;Marvel at the craftsmanship of stone sculptures, each telling a unique story.&lt;br&gt;&lt;/p&gt;', 'sculptures, stone, craftsmanship, art, stories, creativity', 'k6Y1XTguVNIsDZrxSh9lew57.jpg', 0, '2023-10-14 14:37:15'),
(11, 'Majestic Mountains', '1', '&lt;p&gt;Explore the breathtaking beauty of towering peaks, from snow-capped summits to lush valleys.&lt;br&gt;&lt;/p&gt;', 'mountains, landscapes, peaks, nature, scenery, wilderness', 'FKO6GUfNSEWpyosrcH1Pd0vx.jpg', 0, '2023-10-14 14:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `album_likes`
--

CREATE TABLE `album_likes` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `http_user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album_likes`
--

INSERT INTO `album_likes` (`id`, `album_id`, `http_user_agent`) VALUES
(1, 1, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `ctg_name` varchar(100) NOT NULL,
  `position_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `ctg_name`, `position_order`) VALUES
(1, 'Nature', 1),
(2, 'Travel', 1),
(3, 'Architecture', 1),
(4, 'Food and Drink', 1),
(5, 'Wildlife', 1),
(6, 'Portraits', 1),
(7, 'Abstract', 1),
(8, 'Events', 1),
(9, 'Landscapes', 1),
(10, 'Vintage', 1),
(11, 'Sports', 1),
(13, 'Architecture', 1),
(14, 'Art', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_title` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `sort_desc` varchar(50) NOT NULL,
  `image_source` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_title`, `category_id`, `album_id`, `sort_desc`, `image_source`, `added_on`) VALUES
(5, 'waterfall', 1, 2, '', 'e2QPVljITKUJXNmyoOkq6B7t.jpg', '2023-10-14 14:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `option_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES
(1, 'site-logo', 'logo.png'),
(2, 'twitter-url', '#'),
(3, 'facebook-url', '#'),
(4, 'linkedin-url', '#');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `page_body` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_body`) VALUES
(1, 'contact', 'hi'),
(2, 'about-us', ''),
(3, 'privacy-policy', ''),
(4, 'tarms', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_likes`
--
ALTER TABLE `album_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `album_likes`
--
ALTER TABLE `album_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2020 at 07:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `user_id`, `title`, `category`, `content`, `status`, `created_date`, `posted_date`, `modified_date`) VALUES
(8, 4, 'Google\'s Project Guideline allows blind joggers to run without assistance', 'Technology', 'A team of researchers at Google Research has unveiled a new project they have been working on that uses AI technology to allow a blind person to follow a path without assistance. In their announcement of the project, called Project Guideline, they introduce Thomas Panek, President & CEO of an organization called Guiding Eyes for the Blind. The Goggle Research team credits Panek with coming up with the idea for the new technology and for providing guidance and inspiration for the project.\r\n\r\nThe technology the team developed consists of a smartphone connected to the web and bone-conducting headphones. The smartphone (which is affixed to the waist) is used to look ahead on the ground for a yellow line that has been painted there to serve as a guideline. The information from the phone is sent to an AI app on a Google server where it is continually processed. It sends back signals to the phone that are converted to audio tones that are played in the ears of the runner. If the runner veers too far to the left, the tone grows louder in the left ear, and to the right ear if the runner veers right. Artificial intelligence was needed because real-world conditions vary. The software needed to be able to track the painted line even if the runner was bouncing up and down and it needed to be able to adjust to changing light conditions, or unexpected events, such as leaves partially covering a line.\r\n\r\n', 1, '2020-11-29', '2020-11-29', NULL),
(9, 4, 'Seriously Chic Over-40 Women I Love to Follow on Instagram', 'Life Style', 'There is a certain confidence that lies in these over-40s women’s wardrobes. These are women who have seen generations of trends come and go, they have the wisdom to know what clothing does and doesn’t work for them, they don’t feel the need to embrace all the trends, and they aren’t afraid to pull off powerful statement pieces. Moreover, their wardrobes are anchored by quality, statement pieces that last them a lifetime. So when I’m looking to get inspired, it’s no wonder I turn my attention to these fashion muses for their wealth of fashion knowledge and strong sense of personal style. \r\n\r\nWhile there’s no denying that millennials are currently dominating our feeds, that doesn’t make them any more relevant or valuable than their more mature counterparts. So today, I’m sharing some of my favorite stylish women over 40 who I love to follow on Instagram. Scroll below to see and shop their coolest looks.\r\n\r\n', NULL, '2020-11-29', NULL, NULL),
(10, 5, 'Using artificial intelligence to help drones find people lost in the woods', 'Technology', 'A trio of researchers at Johannes Kepler University has used artificial intelligence to improve thermal imaging camera searches of people lost in the woods. In their paper published in the journal Nature Machine Intelligence, David Schedl, Indrajit Kurmi and Oliver Bimber, describe how they applied a deep learning network to the problem of people lost in the woods and how well it worked.\r\n\r\n', 1, '2020-11-29', '2020-11-29', NULL),
(11, 5, 'Sushant Singh Rajput (1986–2020)', 'Entertainment', 'Sushant Singh Rajput was an Indian television and film actor. He became household name after playing the role of Manav in the TV series, Pavitra Rishta on Zee Tv. He made his Bollywood debut with a movie, Kai Po Che, directed by Abhishek Kapoor, which was adapted from Chetan Bhagat\'s novel, The 3 Mistake of My Life, and then launched himself to soaring heights in the film industry.\r\n', 1, '2020-11-29', '2020-11-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_discription` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `blog_id`, `comment_title`, `comment_discription`, `created_date`) VALUES
(6, 5, 8, 'Good Idea', 'It is too much creative idea that Google is working on it. Good Job !!!!!!! Gooooooooooooooooooooogle :)', '2020-11-29'),
(7, 6, 11, 'RIP to Sushant singh', 'We miss u Sushant', '2020-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200615154405', '2020-06-17 17:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `address`, `password`) VALUES
(4, 'Test', 'Test@gmail.com', 1234567890, 'hjhkjhkjnkn', '$2y$13$IGl.ZWnZ3k9mjHUO1uR1auH6952JZ8DCGjVjUcjjjLCM2lGQccXcK'),
(5, 'Test1', 'Test1@gmail.com', 1234567890, 'yghgihiuyiu', '$2y$13$nyCFuWDa4o3.Vf9Nxl37WeHzqfIF/QolTte.bDnTdkYgkNC0555AK'),
(6, 'Test2', 'Test2@gmail.com', 1234567890, 'ghhjg bhjkkhjb', '$2y$13$Uxtnj/Y5pCk0iT99ZSL0uepS0NRQzoZEU70FQqvin9ct/TTv0ujBG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

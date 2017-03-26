-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2016 at 01:32 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nitraipur`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipaddress_likes_map`
--

CREATE TABLE IF NOT EXISTS `ipaddress_likes_map` (
  `id` int(8) NOT NULL,
  `tutorial_id` int(8) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_date` date NOT NULL,
  `post_author` varchar(32) NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_content` text NOT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `categories` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_title`, `post_date`, `post_author`, `post_image`, `post_content`, `tags`, `categories`) VALUES
(1, 1, 'fdgdf', '2016-12-09', 'dfgdf', 'IMG_4408.JPG', 'ghdsfghdsgh \r\n\r\ndgfdsfgdsf\r\nsdfdsf\r\n\r\n\r\ndsfdsfdsf\r\n\r\n\r\ndsfdfdsf', '#dfgfdg,#fdsf,#fsdf', 'politics'),
(2, 1, 'jhfhjfd', '2016-12-10', '6363', '', 'kjdskjdskj ', '#dhdeh,#njkdcjhd', 'politics'),
(3, 2, 'thsm', '2016-12-10', '67y7hje', '', 'kdkjsddkj ', '#jdzhjd,#jhdehjds', 'business'),
(4, 1, 'how to', '2016-12-10', '', 'prerana booklet.pdf', ' ahgnhbgfdn vgfz', '', 'makeinindia');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daliy_visitors`
--

CREATE TABLE IF NOT EXISTS `tbl_daliy_visitors` (
  `visitors_id` bigint(20) NOT NULL,
  `tbl_ipaddress` varchar(400) DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daliy_visitors`
--

INSERT INTO `tbl_daliy_visitors` (`visitors_id`, `tbl_ipaddress`, `created_date`) VALUES
(1, '::1', '2016-12-10'),
(2, '::1', '2016-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `tbl_id` bigint(20) NOT NULL,
  `recentpost_date` date DEFAULT NULL,
  `recentupvote_date` date DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`tbl_id`, `recentpost_date`, `recentupvote_date`, `user_id`) VALUES
(1, '2016-12-09', '2016-12-09', 1),
(2, '2016-12-09', '2016-12-09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_postupdown_votes`
--

CREATE TABLE IF NOT EXISTS `tbl_postupdown_votes` (
  `tbl_updown_id` bigint(20) NOT NULL,
  `type` varchar(5) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `vote_status` int(2) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_postupdown_votes`
--

INSERT INTO `tbl_postupdown_votes` (`tbl_updown_id`, `type`, `user_id`, `post_id`, `vote_status`, `date_created`) VALUES
(1, 'vup', 2, 1, 0, '2016-12-09'),
(2, 'vdw', 1, 1, 0, '2016-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rate_autobiography`
--

CREATE TABLE IF NOT EXISTS `tbl_rate_autobiography` (
  `tbl_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ratingnum` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rate_autobiography`
--

INSERT INTO `tbl_rate_autobiography` (`tbl_id`, `user_id`, `ratingnum`, `create_date`) VALUES
(1, 1, 5, '2016-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userpost_like`
--

CREATE TABLE IF NOT EXISTS `tbl_userpost_like` (
  `tbl_like_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `user_id_liked` bigint(20) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `date_liked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE IF NOT EXISTS `tutorial` (
  `id` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `likes` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(100) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(23) NOT NULL,
  `birthdate` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `next_five` varchar(50) NOT NULL,
  `political_views` varchar(100) NOT NULL,
  `politician` varchar(100) NOT NULL,
  `movies` varchar(100) NOT NULL,
  `intrests` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `story` varchar(10000) NOT NULL,
  `Bio` varchar(1000) DEFAULT NULL,
  `contactemail` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `join_date`, `first_name`, `last_name`, `gender`, `birthdate`, `city`, `state`, `country`, `next_five`, `political_views`, `politician`, `movies`, `intrests`, `status`, `picture`, `story`, `Bio`, `contactemail`) VALUES
(1, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2016-12-09', '54464', 'dsfgdgfdg', 'M', '0000-00-00', '56464', '64645456', '45456454', '545456', '464', '5454564', '65465465', '4654fdgfdg', '654654dfgdfg', 'rps logo.jpg', ' dskjdsdskjdskjdsw', 'fdgfd', 'dfgdf'),
(2, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2016-12-09', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `ipaddress_likes_map`
--
ALTER TABLE `ipaddress_likes_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tbl_daliy_visitors`
--
ALTER TABLE `tbl_daliy_visitors`
  ADD PRIMARY KEY (`visitors_id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `tbl_postupdown_votes`
--
ALTER TABLE `tbl_postupdown_votes`
  ADD PRIMARY KEY (`tbl_updown_id`);

--
-- Indexes for table `tbl_rate_autobiography`
--
ALTER TABLE `tbl_rate_autobiography`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `tbl_userpost_like`
--
ALTER TABLE `tbl_userpost_like`
  ADD PRIMARY KEY (`tbl_like_id`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ipaddress_likes_map`
--
ALTER TABLE `ipaddress_likes_map`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_daliy_visitors`
--
ALTER TABLE `tbl_daliy_visitors`
  MODIFY `visitors_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `tbl_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_postupdown_votes`
--
ALTER TABLE `tbl_postupdown_votes`
  MODIFY `tbl_updown_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_rate_autobiography`
--
ALTER TABLE `tbl_rate_autobiography`
  MODIFY `tbl_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_userpost_like`
--
ALTER TABLE `tbl_userpost_like`
  MODIFY `tbl_like_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tutorial`
--
ALTER TABLE `tutorial`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

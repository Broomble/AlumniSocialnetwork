-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2014 at 09:50 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'imnavneet', 'df24526b08b8da6e6e5b27f6315424e4');

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE IF NOT EXISTS `blocked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `read`, `time`) VALUES
(2, 1, 2, 'hmm', 1, '2014-04-04 06:58:46'),
(3, 1, 2, 'test', 1, '2014-04-04 06:58:51'),
(4, 1, 2, 'fine', 1, '2014-04-04 06:58:55'),
(5, 2, 1, 'hi', 1, '2014-04-21 07:41:28'),
(6, 2, 1, 'hello', 1, '2014-04-21 07:41:39'),
(7, 2, 1, 'asfd', 1, '2014-04-21 07:41:48'),
(8, 2, 1, 'asdf', 1, '2014-04-21 07:41:49'),
(9, 2, 1, 'asdf', 1, '2014-04-21 07:41:49'),
(10, 2, 1, 'sadf', 1, '2014-04-21 07:41:49'),
(11, 2, 1, 'sad', 1, '2014-04-21 07:41:49'),
(12, 2, 1, 'f', 1, '2014-04-21 07:41:50'),
(13, 2, 1, 'asd', 1, '2014-04-21 07:41:50'),
(14, 2, 1, 'f', 1, '2014-04-21 07:41:50'),
(15, 2, 1, 'sdaf', 1, '2014-04-21 07:41:50'),
(16, 2, 1, 'sad', 1, '2014-04-21 07:41:50'),
(17, 2, 1, 'f', 1, '2014-04-21 07:41:50'),
(18, 2, 1, 'sda', 1, '2014-04-21 07:41:50'),
(19, 2, 1, 'fsad', 1, '2014-04-21 07:41:51'),
(20, 2, 1, 'f', 1, '2014-04-21 07:41:51'),
(21, 2, 1, 'sad', 1, '2014-04-21 07:41:51'),
(22, 2, 1, 'fsad', 1, '2014-04-21 07:41:51'),
(23, 2, 1, 'f', 1, '2014-04-21 07:41:51'),
(24, 2, 1, 'sda', 1, '2014-04-21 07:41:51'),
(25, 2, 1, 'fsad', 1, '2014-04-21 07:41:51'),
(26, 2, 1, 'f', 1, '2014-04-21 07:41:52'),
(27, 2, 1, 'dsaf', 1, '2014-04-21 07:41:52'),
(28, 2, 1, 'asd', 1, '2014-04-21 07:41:52'),
(29, 2, 1, 'f', 1, '2014-04-21 07:41:52'),
(30, 2, 1, 'sdaf', 1, '2014-04-21 07:41:52'),
(31, 2, 1, 'dsa', 1, '2014-04-21 07:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `uid`, `mid`, `message`, `time`) VALUES
(1, 1, 1, 'hmm ', '2014-04-04 05:26:28'),
(2, 1, 5, 'hmm ', '2014-04-04 06:50:10'),
(3, 1, 6, 'test''', '2014-04-04 06:50:55'),
(4, 2, 3, 'cool', '2014-04-04 07:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `enrollno` varchar(20) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `perma_addr` varchar(100) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  KEY `enroll_no` (`enrollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`enrollno`, `phone`, `email`, `perma_addr`, `city`, `state`, `country`) VALUES
('16615602710', '919911396550', 'pricelesssumit@gmail.com', 'sdfgdsfgsdf', '', '10', 'IN'),
('16615602708', '919911396557', 'gauravsars11@gmail.com', 'asdasdsa', '', '10', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE IF NOT EXISTS `employment` (
  `enrollno` varchar(20) NOT NULL,
  `company` varchar(40) NOT NULL,
  `joining` varchar(10) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `office_landline` varchar(50) DEFAULT NULL,
  `office_email` varchar(50) DEFAULT NULL,
  `office_addr` varchar(100) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  KEY `enroll_no` (`enrollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employment`
--

INSERT INTO `employment` (`enrollno`, `company`, `joining`, `industry`, `department`, `designation`, `office_landline`, `office_email`, `office_addr`, `state`, `country`) VALUES
('16615602710', 'TCS', '2008-7-5', '25', 'IT- Software', 'Software Engineer', '011-26886668', 'npandey@gmail.com', 'Banglore', '10', 'IN'),
('16615602708', 'TCS', '2010-9-8', '33', 'Animation', 'Asst. Manager', '6546544656546', 'npandey@gmail.com', 'GI -1075', '10', 'IN'),
('16615602708', 'TCS', '2006-7-9', '26', 'Fresher/Trainee', 'Junior Assistant', '6546544656546', 'npandey@gmail.com', 'asdsadsa', '10', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post`, `by`, `time`) VALUES
(1, 1, 1, '2014-04-04 05:26:22'),
(2, 5, 1, '2014-04-04 06:50:05'),
(3, 6, 1, '2014-04-04 06:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `uid` int(32) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(16) CHARACTER SET latin1 NOT NULL,
  `value` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `public` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `uid`, `message`, `tag`, `type`, `value`, `time`, `public`, `likes`) VALUES
(1, 1, 'Nothing', '', '', '', '2014-04-04 05:26:47', 1, 1),
(2, 1, '', '', 'visited', 'New Delhi', '2014-04-04 06:15:37', 1, 0),
(3, 1, '', '', 'map', 'New Delhi', '2014-04-04 06:15:45', 1, 0),
(4, 1, 'NOthong', '', '', '', '2014-04-04 06:49:39', 1, 0),
(5, 1, 'nothing', '', '', '', '2014-04-04 06:50:03', 1, 1),
(6, 1, 'hmm', '', '', '', '2014-04-04 06:50:42', 1, 1),
(7, 1, '', '', 'food', 'Sarojini nagar', '2014-04-04 06:53:32', 1, 0),
(8, 1, 'Castle', '', 'picture', '918697366_1085783454_101341456.jpg', '2014-04-04 06:54:02', 1, 0),
(9, 2, 'Multipart', '', 'picture', '428407300_1171678488_340171316.jpg,820153197_1539391085_915926566.jpg,96746734_2109662057_650247497.jpg,77676483_606664113_1618295412.jpg,2016378417_1506980098_953728393.jpg', '2014-04-04 07:03:36', 1, 0),
(10, 1, 'hi', '', '', '', '2014-04-04 09:26:36', 1, 0),
(11, 1, 'I am at', '', 'map', 'London', '2014-04-04 12:02:48', 1, 0),
(12, 1, '', '', 'music', 'Rihanana', '2014-04-04 12:14:18', 1, 0),
(13, 1, 'Hello', '', '', '', '2014-04-06 06:10:24', 1, 0),
(14, 1, '', '', 'music', 'sc:/m-riazul-islam/sona-pakhi-belal-khan', '2014-04-06 07:15:24', 1, 0),
(15, 2, 'hey @Navneet', '', '', '', '2014-04-21 07:40:20', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from`, `to`, `parent`, `child`, `type`, `read`, `time`) VALUES
(1, 1, 1, 1, 0, 2, 1, '2014-04-04 05:26:22'),
(2, 1, 1, 1, 1, 1, 1, '2014-04-04 05:26:28'),
(3, 1, 1, 5, 0, 2, 1, '2014-04-04 06:50:05'),
(4, 1, 1, 5, 2, 1, 1, '2014-04-04 06:50:10'),
(5, 1, 1, 6, 0, 2, 1, '2014-04-04 06:50:50'),
(6, 1, 1, 6, 3, 1, 1, '2014-04-04 06:50:55'),
(7, 2, 1, 0, 0, 4, 1, '2014-04-04 06:57:13'),
(8, 1, 2, 0, 0, 4, 0, '2014-04-04 06:58:38'),
(9, 2, 1, 3, 4, 1, 1, '2014-04-04 07:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leader` int(11) NOT NULL,
  `subscriber` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `leader`, `subscriber`, `time`) VALUES
(1, 1, 2, '2014-04-04 06:57:13'),
(2, 2, 1, '2014-04-04 06:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `post` varchar(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `post`, `parent`, `type`, `by`, `state`) VALUES
(1, '2', 0, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `perpage` int(11) NOT NULL,
  `censor` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `captcha` int(11) NOT NULL,
  `intervalm` int(11) NOT NULL,
  `intervaln` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `format` varchar(256) NOT NULL,
  `mail` int(11) NOT NULL,
  `sizemsg` int(11) NOT NULL,
  `formatmsg` varchar(256) NOT NULL,
  `cperpage` int(11) NOT NULL,
  `mprivacy` int(11) NOT NULL,
  `ilimit` int(11) NOT NULL,
  `climit` int(11) NOT NULL,
  `qperpage` tinyint(4) NOT NULL,
  `rperpage` int(11) NOT NULL,
  `uperpage` int(11) NOT NULL,
  `sperpage` int(11) NOT NULL,
  `nperpage` tinyint(4) NOT NULL,
  `nperwidget` tinyint(4) NOT NULL,
  `lperpost` int(11) NOT NULL,
  `conline` int(4) NOT NULL,
  `ronline` tinyint(4) NOT NULL,
  `mperpage` tinyint(4) NOT NULL,
  `verified` int(11) NOT NULL,
  `notificationl` tinyint(4) NOT NULL,
  `notificationc` tinyint(4) NOT NULL,
  `notifications` tinyint(4) NOT NULL,
  `notificationd` tinyint(4) NOT NULL,
  `notificationf` tinyint(4) NOT NULL,
  `chatr` int(11) NOT NULL,
  `email_comment` tinyint(4) NOT NULL,
  `email_like` tinyint(4) NOT NULL,
  `email_new_friend` tinyint(4) NOT NULL,
  `sound_new_notification` tinyint(4) NOT NULL,
  `sound_new_chat` tinyint(4) NOT NULL,
  `smiles` tinyint(4) NOT NULL,
  `ad1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ad7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`title`, `theme`, `perpage`, `censor`, `captcha`, `intervalm`, `intervaln`, `time`, `message`, `size`, `format`, `mail`, `sizemsg`, `formatmsg`, `cperpage`, `mprivacy`, `ilimit`, `climit`, `qperpage`, `rperpage`, `uperpage`, `sperpage`, `nperpage`, `nperwidget`, `lperpost`, `conline`, `ronline`, `mperpage`, `verified`, `notificationl`, `notificationc`, `notifications`, `notificationd`, `notificationf`, `chatr`, `email_comment`, `email_like`, `email_new_friend`, `sound_new_notification`, `sound_new_chat`, `smiles`, `ad1`, `ad2`, `ad3`, `ad4`, `ad5`, `ad6`, `ad7`) VALUES
('NIEC Alumni', 'skins', 10, '', 0, 10000, 10000, 0, 500, 2097152, 'png,jpg,gif', 1, 2097152, 'png,jpg,gif', 3, 1, 9, 500, 10, 20, 20, 10, 100, 3, 5, 600, 10, 10, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `join` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000-0000',
  `enrollno` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `born` date NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `course`, `branch`, `join`, `enrollno`, `gender`, `born`, `fname`) VALUES
(1, 'Navneet', '1', '2', '2010-2014', '16615602710', 1, '1992-09-16', 'Rakesh Pandey'),
(2, 'Sumit R Pandey', '1', '2', '2008-2012', '16615602708', 1, '1995-05-02', 'Rakesh Pandey');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idu` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `first_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `join` varchar(10) NOT NULL DEFAULT '0000-0000',
  `enrollno` varchar(11) NOT NULL,
  `location` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(128) NOT NULL,
  `bio` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `facebook` varchar(256) NOT NULL,
  `twitter` varchar(128) NOT NULL,
  `gplus` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `private` int(11) NOT NULL,
  `salted` varchar(256) NOT NULL,
  `background` varchar(256) NOT NULL,
  `cover` varchar(128) NOT NULL,
  `verified` int(11) NOT NULL,
  `privacy` int(11) NOT NULL DEFAULT '1',
  `gender` tinyint(4) NOT NULL,
  `online` int(11) NOT NULL,
  `offline` tinyint(4) NOT NULL,
  `notificationl` tinyint(4) NOT NULL,
  `notificationc` tinyint(4) NOT NULL,
  `notifications` tinyint(4) NOT NULL,
  `notificationd` tinyint(4) NOT NULL,
  `notificationf` tinyint(4) NOT NULL,
  `email_comment` tinyint(4) NOT NULL,
  `email_like` tinyint(4) NOT NULL,
  `email_new_friend` tinyint(4) NOT NULL,
  `sound_new_notification` tinyint(4) NOT NULL,
  `sound_new_chat` tinyint(4) NOT NULL,
  `born` date NOT NULL,
  `status` tinyint(5) NOT NULL,
  UNIQUE KEY `id` (`idu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idu`, `username`, `password`, `email`, `first_name`, `last_name`, `course`, `branch`, `join`, `enrollno`, `location`, `website`, `bio`, `date`, `facebook`, `twitter`, `gplus`, `image`, `private`, `salted`, `background`, `cover`, `verified`, `privacy`, `gender`, `online`, `offline`, `notificationl`, `notificationc`, `notifications`, `notificationd`, `notificationf`, `email_comment`, `email_like`, `email_new_friend`, `sound_new_notification`, `sound_new_chat`, `born`, `status`) VALUES
(1, 'imnavneet', 'df24526b08b8da6e6e5b27f6315424e4', 'npandey057@gmail.com', 'Navneet', 'Pandey', '1', '2', '2010-2014', '16615602710', 'India', 'htp://navneetpandey.com', '', '2014-04-04', 'imnavneet', 'iTechingg', '+NavneetPandey', '898295299_831060223_1024257080.jpg', 0, '', '', '1839017986_130522597_1329657326.jpg', 0, 1, 1, 1398151511, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '1992-09-16', 1),
(2, 'kingnavneet', 'df24526b08b8da6e6e5b27f6315424e4', 'n@n.com', '', '', '', '', '0000-0000', '0', '', '', '', '2014-04-04', '', '', '', '52478770_1905198199_1521533666.JPG', 0, '', '', '138610334_1384058665_1012171594.jpg', 0, 1, 0, 1398090471, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '0000-00-00', 0),
(5, 'sumit', 'df24526b08b8da6e6e5b27f6315424e4', 'pricelesssumit@gmail.com', 'Sumit', 'Pandey', '1', '2', '2008-2012', '16615602708', '', '', '', '2014-04-22', '', '', '', 'default.png', 0, '', '', 'default.png', 0, 1, 1, 1398152510, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '1995-05-02', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2014 at 09:05 AM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `read`, `time`) VALUES
(2, 1, 2, 'hmm', 1, '2014-04-04 06:58:46'),
(3, 1, 2, 'test', 1, '2014-04-04 06:58:51'),
(4, 1, 2, 'fine', 1, '2014-04-04 06:58:55');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

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
(14, 1, '', '', 'music', 'sc:/m-riazul-islam/sona-pakhi-belal-khan', '2014-04-06 07:15:24', 1, 0);

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
('NIECAlumni', 'skins', 10, '', 1, 10000, 10000, 0, 500, 2097152, 'png,jpg,gif', 1, 2097152, 'png,jpg,gif', 3, 1, 9, 500, 10, 20, 20, 10, 100, 3, 5, 600, 10, 10, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, '', '', '', '', '', '', '');

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
  UNIQUE KEY `id` (`idu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idu`, `username`, `password`, `email`, `first_name`, `last_name`, `course`, `branch`, `join`, `enrollno`, `location`, `website`, `bio`, `date`, `facebook`, `twitter`, `gplus`, `image`, `private`, `salted`, `background`, `cover`, `verified`, `privacy`, `gender`, `online`, `offline`, `notificationl`, `notificationc`, `notifications`, `notificationd`, `notificationf`, `email_comment`, `email_like`, `email_new_friend`, `sound_new_notification`, `sound_new_chat`, `born`) VALUES
(1, 'imnavneet', 'df24526b08b8da6e6e5b27f6315424e4', 'npandey057@gmail.com', 'Navneet', 'Pandey', '1', '2', '2010-2014', '16615602710', 'India', 'htp://navneetpandey.com', '', '2014-04-04', 'imnavneet', 'iTechingg', '+NavneetPandey', '898295299_831060223_1024257080.jpg', 0, '', '', '1839017986_130522597_1329657326.jpg', 0, 1, 1, 1396850403, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '1992-09-16'),
(2, 'kingnavneet', 'df24526b08b8da6e6e5b27f6315424e4', 'n@n.com', '', '', '', '', '0000-0000', '0', '', '', '', '2014-04-04', '', '', '', '557668401_1002824475_1935951441.JPG', 0, '', '', '138610334_1384058665_1012171594.jpg', 0, 1, 0, 1396596603, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

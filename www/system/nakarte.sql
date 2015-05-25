-- phpMyAdmin SQL Dump
-- version 2.11.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2010 at 12:52 AM
-- Server version: 5.1.35
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nakarte`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `name` varchar(100) NOT NULL,
  `kzname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `lat`, `lon`, `name`, `kzname`) VALUES
(1, 0, 0, 'Абай', 'Абай'),
(2, 0, 0, 'Акколь', 'Ақкөл'),
(3, 0, 0, 'Аксай', 'Ақсай'),
(4, 0, 0, 'Аксу', 'Ақсу'),
(5, 0, 0, 'Актау', 'Ақтау'),
(6, 0, 0, 'Актобе', 'Ақтөбе'),
(7, 0, 0, 'Алга', 'Алға'),
(8, 0, 0, 'Алма-Ата', 'Алматы'),
(9, 0, 0, 'Аральск', 'Арал'),
(10, 0, 0, 'Арыс', 'Арыс'),
(11, 0, 0, 'Аркалык', 'Арқалық'),
(12, 0, 0, 'Астана', 'Астана'),
(13, 0, 0, 'Атбасар', 'Атбасар'),
(14, 0, 0, 'Атырау', 'Атырау'),
(15, 0, 0, 'Аягуз', 'Аякөз'),
(16, 0, 0, 'Байконур', 'Байқоңыр'),
(17, 0, 0, 'Балхаш', 'Балқаш'),
(18, 0, 0, 'Булаево', 'Булаево'),
(19, 0, 0, 'Державинск', 'Державинск'),
(20, 0, 0, 'Жезказган', 'Жезқазған'),
(21, 0, 0, 'Жетикара', 'Жетіқара'),
(22, 0, 0, 'Джетысай', 'Жетісай'),
(23, 0, 0, 'Ерейментау', 'Ерейментау'),
(24, 0, 0, 'Есик', 'Есік'),
(25, 0, 0, 'Есиль', 'Есіл'),
(26, 0, 0, 'Жанатас', 'Жаңатас'),
(27, 0, 0, 'Жаркент', 'Жаркент'),
(28, 0, 0, 'Жем', 'Жем'),
(29, 0, 0, 'Зайсан', 'Зайсаң'),
(30, 0, 0, 'Зыряновск', 'Зыряновск'),
(31, 0, 0, 'Казалинск', 'Қазалы'),
(32, 0, 0, 'Кандыагаш', 'Қандыағаш'),
(33, 0, 0, 'Капчагай', 'Қапшағай'),
(34, 0, 0, 'Караганда', 'Қарағанды'),
(35, 0, 0, 'Каражал', 'Қаражал'),
(36, 0, 0, 'Каратау', 'Қаратау'),
(37, 0, 0, 'Каркаралинск', 'Қарқаралы'),
(38, 0, 0, 'Каскелен', 'Қаскелең'),
(39, 0, 0, 'Кентау', 'Кентау'),
(40, 0, 0, 'Кызылорда', 'Қызылорда'),
(41, 0, 0, 'Кокшетау', 'Көкшетау'),
(42, 0, 0, 'Кульсары', 'Құлсары'),
(43, 0, 0, 'Курчатов', 'Курчатов'),
(44, 0, 0, 'Костанай', 'Қостанай'),
(45, 0, 0, 'Ленгер', 'Ленгер'),
(46, 0, 0, 'Лисаковск', 'Лисаковск'),
(47, 0, 0, 'Макинск', 'Макинск'),
(48, 0, 0, 'Мамлютка', 'Мамлют'),
(49, 0, 0, 'Жанаозен', 'Жаңаөзен'),
(50, 0, 0, 'Павлодар', 'Павлодар'),
(51, 0, 0, 'Петропавловск', 'Петропавл'),
(52, 0, 0, 'Приозёрск', 'Приозёрск'),
(53, 0, 0, 'Риддер', 'Риддер'),
(54, 0, 0, 'Рудный', 'Рудный'),
(55, 0, 0, 'Сарань', 'Сараң'),
(56, 0, 0, 'Сарканд', 'Сарқан'),
(57, 0, 0, 'Сары-Агаш', 'Сарыағаш'),
(58, 0, 0, 'Сатпаев', 'Сәтбаев'),
(59, 0, 0, 'Семипалатинск', 'Семей'),
(60, 0, 0, 'Сергеевка', 'Сергеевка'),
(61, 0, 0, 'Серебрянск', 'Серебрянск'),
(62, 0, 0, 'Степногорск', 'Степногорск'),
(63, 0, 0, 'Степняк', 'Степняк'),
(64, 0, 0, 'Тайынша', 'Тайынша'),
(65, 0, 0, 'Талгар', 'Талғар'),
(66, 0, 0, 'Талдыкорган', 'Талдықорған'),
(67, 0, 0, 'Тараз', 'Тараз'),
(68, 0, 0, 'Текели', 'Текелі'),
(69, 0, 0, 'Темир', 'Темір'),
(70, 0, 0, 'Темиртау', 'Теміртау'),
(71, 0, 0, 'Туркестан', 'Түркістан'),
(72, 0, 0, 'Уральск', 'Орал'),
(73, 0, 0, 'Усть-Каменогорск', 'Өскемен'),
(74, 0, 0, 'Учарал', 'Үшарал'),
(75, 0, 0, 'Уштобе', 'Үштөбе'),
(76, 0, 0, 'Форт-Шевченко', 'Форт-Шевченко'),
(77, 0, 0, 'Хромтау', 'Хромтау'),
(78, 0, 0, 'Чардара', 'Шардара'),
(79, 0, 0, 'Чарск', 'Шар'),
(80, 0, 0, 'Челкар', 'Шалқар'),
(81, 0, 0, 'Шымкент', 'Шымкент'),
(82, 0, 0, 'Шахтинск', 'Шахтинск'),
(83, 0, 0, 'Шемонаиха', 'Шемонаиха'),
(84, 0, 0, 'Шу', 'Шұ'),
(85, 0, 0, 'Щучинск', 'Щучинск'),
(86, 0, 0, 'Экибастуз', 'Екібастуз'),
(87, 0, 0, 'Эмба', 'Ембі');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `poi_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `comment_ratings`
--

CREATE TABLE IF NOT EXISTS `comment_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `ctime` datetime NOT NULL,
  `mtime` datetime NOT NULL,
  `mark` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`ctime`,`mtime`),
  KEY `comment` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comment_ratings`
--


-- --------------------------------------------------------

--
-- Table structure for table `image_ratings`
--

CREATE TABLE IF NOT EXISTS `image_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `ctime` datetime NOT NULL,
  `mtime` datetime NOT NULL,
  `mark` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`ctime`,`mtime`),
  KEY `poi_id` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `image_ratings`
--


-- --------------------------------------------------------

--
-- Table structure for table `pois`
--

CREATE TABLE IF NOT EXISTS `pois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctime` datetime NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `descr` text NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pois`
--


-- --------------------------------------------------------

--
-- Table structure for table `poi_images`
--

CREATE TABLE IF NOT EXISTS `poi_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `poi_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `poi_rating`
--

CREATE TABLE IF NOT EXISTS `poi_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ctime` datetime NOT NULL,
  `mtime` datetime NOT NULL,
  `mark` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`ctime`,`mtime`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `poi_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(4, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rubrics`
--

CREATE TABLE IF NOT EXISTS `rubrics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rubrics` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `rubrics`
--

INSERT INTO `rubrics` (`id`, `parent_id`, `name`) VALUES
(8, NULL, 'Бары'),
(9, NULL, 'Рестораны'),
(10, NULL, 'Клубы');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `ctime` datetime NOT NULL,
  `mtime` datetime NOT NULL,
  `atime` datetime NOT NULL,
  `status` enum('unconfirmed','confirmed','banned','admin') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`, `firstname`, `lastname`, `city_id`, `ctime`, `mtime`, `atime`, `status`) VALUES
(4, '', '0', 'baecb7a22508b1f361122e90ce1832eaf30f2c2b52a0f13849', 0, NULL, 'Самвел', 'Аванесов', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'unconfirmed'),
(10, 'test@test.ru', 'test@test.ru', '78fea798e89b6f7796ab1a5a6cb807423e60125a946d5da2ca', 3, 1267129535, 'test', 'testsurname', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'unconfirmed'),
(11, 'test@test2.ru', 'test@test2.ru', 'cd89d7af19797b6fb426f19f4894250fd52a885f319f10afe8', 0, NULL, 'Sam', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'unconfirmed');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_tokens`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comment_ratings`
--
ALTER TABLE `comment_ratings`
  ADD CONSTRAINT `comment_ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `image_ratings`
--
ALTER TABLE `image_ratings`
  ADD CONSTRAINT `image_ratings_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `image_ratings_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `poi_images` (`id`);

--
-- Constraints for table `pois`
--
ALTER TABLE `pois`
  ADD CONSTRAINT `pois_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `poi_rating`
--
ALTER TABLE `poi_rating`
  ADD CONSTRAINT `poi_rating_ibfk_2` FOREIGN KEY (`poi_id`) REFERENCES `pois` (`id`);

--
-- Constraints for table `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rubrics`
--
ALTER TABLE `rubrics`
  ADD CONSTRAINT `rubrics_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `rubrics` (`id`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

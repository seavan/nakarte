-- phpMyAdmin SQL Dump
-- version 2.11.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2010 at 11:44 AM
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
-- Table structure for table `comment_ratings`
--

DROP TABLE IF EXISTS `comment_ratings`;
CREATE TABLE IF NOT EXISTS `comment_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `ctime` datetime DEFAULT NULL,
  `mtime` datetime DEFAULT NULL,
  `mark` float NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `poi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`ctime`,`mtime`),
  KEY `comment` (`comment_id`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comment_ratings`
--

INSERT INTO `comment_ratings` (`id`, `user_id`, `ctime`, `mtime`, `mark`, `comment_id`, `poi_id`) VALUES
(1, 12, NULL, NULL, 3, 5, 175);

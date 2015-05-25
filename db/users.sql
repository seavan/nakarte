-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Апр 14 2010 г., 19:26
-- Версия сервера: 5.1.45
-- Версия PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `nakarte_dev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `ctime` datetime NOT NULL,
  `mtime` datetime NOT NULL,
  `atime` datetime NOT NULL,
  `status` enum('unconfirmed','confirmed','banned','admin') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`, `firstname`, `lastname`, `city_id`, `ctime`, `mtime`, `atime`, `status`) VALUES
(1, 'test@test.ru', 'test@test.ru', '0e419ac9ddc4b8544a1020911a815fd58e4f35a452c871cdb5', 1, 1271253259, 'test', NULL, NULL, '2010-04-14 17:54:18', '2010-04-14 17:54:18', '2010-04-14 17:54:18', 'confirmed'),
(2, 'test456@test.ru', 'test456@test.ru', '60bd9d9746c5775dd940a7a0e1f55819c6e30073f86606ca8f', 1, 1271253659, 'Tester', NULL, NULL, '2010-04-14 18:00:59', '2010-04-14 18:00:59', '2010-04-14 18:00:59', 'confirmed'),
(3, 'teset15@test.ru', 'teset15@test.ru', '6832abcfa907c5910cfda49217f27ba20d57a66c8ce95a2853', 1, 1271254139, 'test', NULL, NULL, '2010-04-14 18:08:59', '2010-04-14 18:08:59', '2010-04-14 18:08:59', 'confirmed'),
(4, 'terst@t.ru', 'terst@t.ru', 'da6eca813f3d5659c5ffc1b83d98959358a676a059f72adc7a', 0, NULL, 'aaa', NULL, NULL, '2010-04-14 19:24:33', '2010-04-14 19:24:33', '2010-04-14 19:24:33', 'confirmed'),
(5, 'aaa@aaa.ru', 'aaa@aaa.ru', '21f0fb8a53694cd0cb7bbb0d6912f4a05856e723abf1562bf6', 1, 1271258701, 'aaa', NULL, NULL, '2010-04-14 19:25:01', '2010-04-14 19:25:01', '2010-04-14 19:25:01', 'confirmed'),
(6, 'seavan@gmail.com', 'seavan@gmail.com', '48b674e9005f3cd740b951b6c42963e26f3eda7e1608219cc5', 2, 1271258740, 'Sam', NULL, NULL, '2010-04-14 19:25:27', '2010-04-14 19:25:27', '2010-04-14 19:25:27', 'confirmed');

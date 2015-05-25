-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 14 2010 г., 10:58
-- Версия сервера: 5.0.51
-- Версия PHP: 5.2.10

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
-- Структура таблицы `attribute_types_rubrics`
--

CREATE TABLE IF NOT EXISTS `attribute_types_rubrics` (
  `attribute_type_id` int(11) NOT NULL,
  `rubric_id` int(11) NOT NULL,
  KEY `attribute_id` (`attribute_type_id`,`rubric_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `attribute_types_rubrics`
--

REPLACE INTO `attribute_types_rubrics` (`attribute_type_id`, `rubric_id`) VALUES
(12, 327),
(12, 328),
(13, 327),
(13, 328),
(14, 327),
(14, 328),
(15, 327),
(15, 328),
(16, 327),
(16, 328),
(17, 327),
(17, 328),
(18, 327),
(18, 328),
(19, 327),
(19, 328),
(20, 327),
(20, 328),
(21, 327),
(21, 328),
(22, 327),
(22, 328),
(23, 327),
(23, 328),
(24, 327),
(24, 328),
(25, 327),
(25, 328),
(26, 327),
(26, 328),
(27, 327),
(27, 328),
(28, 290);

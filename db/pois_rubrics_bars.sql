-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Апр 16 2010 г., 14:28
-- Версия сервера: 5.1.45
-- Версия PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `nakarte_restore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pois_rubrics`
--

CREATE TABLE IF NOT EXISTS `pois_rubrics` (
  `poi_id` int(11) DEFAULT NULL,
  `rubric_id` int(11) DEFAULT NULL,
  KEY `poi_id` (`poi_id`,`rubric_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `pois_rubrics`
--

INSERT INTO `pois_rubrics` (`poi_id`, `rubric_id`) VALUES
(244, 432),
(245, 432),
(246, 432),
(247, 432),
(248, 432),
(249, 432),
(250, 432),
(251, 432),
(252, 432),
(253, 432),
(254, 432),
(255, 432),
(256, 432),
(257, 432),
(258, 432),
(259, 432),
(260, 432),
(261, 432),
(262, 432),
(263, 432),
(264, 432),
(265, 432),
(266, 432),
(267, 432),
(268, 432),
(269, 432),
(270, 432),
(271, 432),
(272, 432),
(273, 432),
(274, 432),
(275, 432),
(276, 432),
(277, 432),
(278, 432),
(279, 432),
(568, 432),
(816, 432),
(961, 432),
(962, 432),
(963, 432),
(964, 432),
(965, 432),
(966, 432),
(967, 432),
(968, 432),
(969, 432),
(970, 432),
(971, 432),
(972, 432),
(973, 432);

-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 16 2010 г., 17:43
-- Версия сервера: 5.1.44
-- Версия PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `nakarte`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  `attribute_type_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poi_id` (`poi_id`,`attribute_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `attributes`
--


-- --------------------------------------------------------

--
-- Структура таблицы `attributes_pois`
--

DROP TABLE IF EXISTS `attributes_pois`;
CREATE TABLE IF NOT EXISTS `attributes_pois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `attributes_pois`
--


-- --------------------------------------------------------

--
-- Структура таблицы `attributes_rubrics`
--

DROP TABLE IF EXISTS `attributes_rubrics`;
CREATE TABLE IF NOT EXISTS `attributes_rubrics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `rubric_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`,`rubric_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `attributes_rubrics`
--


-- --------------------------------------------------------

--
-- Структура таблицы `attribute_types`
--

DROP TABLE IF EXISTS `attribute_types`;
CREATE TABLE IF NOT EXISTS `attribute_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_index` int(11) NOT NULL,
  `default_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `attribute_types`
--


-- --------------------------------------------------------

--
-- Структура таблицы `attribute_values`
--

DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` int(11) NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `attribute_values`
--


-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kzname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=88 ;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `lat`, `lon`, `name`, `kzname`) VALUES
(1, 49.6393, 72.8595, 'Абай', 'Абай'),
(2, 51.9985, 70.9134, 'Акколь', 'Ақкөл'),
(3, 51.1962, 71.4427, 'Аксай', 'Ақсай'),
(4, 51.1969, 71.3415, 'Аксу', 'Ақсу'),
(5, 51.1806, 71.3365, 'Актау', 'Ақтау'),
(6, 51.1974, 71.3314, 'Актобе', 'Ақтөбе'),
(7, 49.8941, 57.3287, 'Алга', 'Алға'),
(8, 43.2808, 76.9123, 'Алма-Ата', 'Алматы'),
(9, 46.8042, 61.6689, 'Аральск', 'Арал'),
(10, 42.4406, 68.8095, 'Арыс', 'Арыс'),
(11, 50.2436, 66.9104, 'Аркалык', 'Арқалық'),
(12, 51.1518, 71.4801, 'Астана', 'Астана'),
(13, 51.8114, 68.3578, 'Атбасар', 'Атбасар'),
(14, 47.1103, 51.9259, 'Атырау', 'Атырау'),
(15, 48.5569, 66.9053, 'Аягуз', 'Аякөз'),
(16, 45.6098, 63.2835, 'Байконур', 'Байқоңыр'),
(17, 46.8475, 74.9773, 'Балхаш', 'Балқаш'),
(18, 54.8995, 70.4415, 'Булаево', 'Булаево'),
(19, 51.1032, 66.323, 'Державинск', 'Державинск'),
(20, 47.7905, 67.7186, 'Жезказган', 'Жезқазған'),
(21, 52.189, 61.2321, 'Жетикара', 'Жетіқара'),
(22, 48.5569, 66.9053, 'Джетысай', 'Жетісай'),
(23, 51.6232, 73.1348, 'Ерейментау', 'Ерейментау'),
(24, 43.3551, 77.4538, 'Есик', 'Есік'),
(25, 51.9549, 66.4088, 'Есиль', 'Есіл'),
(26, 43.5614, 69.7426, 'Жанатас', 'Жаңатас'),
(27, 44.1712, 80.0094, 'Жаркент', 'Жаркент'),
(28, 48.5569, 66.9053, 'Жем', 'Жем'),
(29, 47.4697, 84.879, 'Зайсан', 'Зайсаң'),
(30, 49.7294, 84.2777, 'Зыряновск', 'Зыряновск'),
(31, 48.5569, 66.9053, 'Казалинск', 'Қазалы'),
(32, 49.4646, 57.4106, 'Кандыагаш', 'Қандыағаш'),
(33, 48.5569, 66.9053, 'Капчагай', 'Қапшағай'),
(34, 51.1257, 71.6248, 'Караганда', 'Қарағанды'),
(35, 51.13, 71.5962, 'Каражал', 'Қаражал'),
(36, 51.1488, 71.5187, 'Каратау', 'Қаратау'),
(37, 48.5569, 66.9053, 'Каркаралинск', 'Қарқаралы'),
(38, 43.1991, 76.6287, 'Каскелен', 'Қаскелең'),
(39, 43.5175, 68.5082, 'Кентау', 'Кентау'),
(40, 44.8503, 65.4973, 'Кызылорда', 'Қызылорда'),
(41, 53.2843, 69.3928, 'Кокшетау', 'Көкшетау'),
(42, 48.5569, 66.9053, 'Кульсары', 'Құлсары'),
(43, 50.7602, 78.5289, 'Курчатов', 'Курчатов'),
(44, 53.2207, 63.6355, 'Костанай', 'Қостанай'),
(45, 42.184, 69.8931, 'Ленгер', 'Ленгер'),
(46, 48.5569, 66.9053, 'Лисаковск', 'Лисаковск'),
(47, 52.6244, 70.429, 'Макинск', 'Макинск'),
(48, 54.9381, 68.5415, 'Мамлютка', 'Мамлют'),
(49, 43.3429, 52.8564, 'Жанаозен', 'Жаңаөзен'),
(50, 52.3133, 76.9696, 'Павлодар', 'Павлодар'),
(51, 54.88, 69.1516, 'Петропавловск', 'Петропавл'),
(52, 48.5569, 66.9053, 'Приозёрск', 'Приозёрск'),
(53, 50.3521, 83.5109, 'Риддер', 'Риддер'),
(54, 52.9653, 63.1416, 'Рудный', 'Рудный'),
(55, 49.8015, 72.8533, 'Сарань', 'Сараң'),
(56, 45.4058, 79.9119, 'Сарканд', 'Сарқан'),
(57, 48.5569, 66.9053, 'Сары-Агаш', 'Сарыағаш'),
(58, 47.9024, 67.5421, 'Сатпаев', 'Сәтбаев'),
(59, 50.4095, 80.2758, 'Семипалатинск', 'Семей'),
(60, 53.8786, 67.4228, 'Сергеевка', 'Сергеевка'),
(61, 49.6858, 83.2948, 'Серебрянск', 'Серебрянск'),
(62, 52.3522, 71.8835, 'Степногорск', 'Степногорск'),
(63, 52.8287, 70.7614, 'Степняк', 'Степняк'),
(64, 53.8461, 69.759, 'Тайынша', 'Тайынша'),
(65, 43.2994, 77.2312, 'Талгар', 'Талғар'),
(66, 45.021, 78.3761, 'Талдыкорган', 'Талдықорған'),
(67, 42.8905, 71.3963, 'Тараз', 'Тараз'),
(68, 44.8341, 78.8299, 'Текели', 'Текелі'),
(69, 49.1367, 57.1233, 'Темир', 'Темір'),
(70, 50.0649, 72.9779, 'Темиртау', 'Теміртау'),
(71, 43.2757, 76.8517, 'Туркестан', 'Түркістан'),
(72, 51.2243, 51.4048, 'Уральск', 'Орал'),
(73, 49.9667, 82.6188, 'Усть-Каменогорск', 'Өскемен'),
(74, 48.5569, 66.9053, 'Учарал', 'Үшарал'),
(75, 45.2555, 77.992, 'Уштобе', 'Үштөбе'),
(76, 44.5027, 50.2584, 'Форт-Шевченко', 'Форт-Шевченко'),
(77, 50.2616, 58.4322, 'Хромтау', 'Хромтау'),
(78, 48.5569, 66.9053, 'Чардара', 'Шардара'),
(79, 48.5569, 66.9053, 'Чарск', 'Шар'),
(80, 48.5569, 66.9053, 'Челкар', 'Шалқар'),
(81, 42.309, 69.6062, 'Шымкент', 'Шымкент'),
(82, 49.7082, 72.5878, 'Шахтинск', 'Шахтинск'),
(83, 50.6348, 81.8925, 'Шемонаиха', 'Шемонаиха'),
(84, 43.6029, 73.773, 'Шу', 'Шұ'),
(85, 52.9386, 70.166, 'Щучинск', 'Щучинск'),
(86, 48.5569, 66.9053, 'Экибастуз', 'Екібастуз'),
(87, 48.826, 58.1418, 'Эмба', 'Ембі');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `poi_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `comments`
--


-- --------------------------------------------------------

--
-- Структура таблицы `comment_ratings`
--

DROP TABLE IF EXISTS `comment_ratings`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `comment_ratings`
--


-- --------------------------------------------------------

--
-- Структура таблицы `image_ratings`
--

DROP TABLE IF EXISTS `image_ratings`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `image_ratings`
--


-- --------------------------------------------------------

--
-- Структура таблицы `pois`
--

DROP TABLE IF EXISTS `pois`;
CREATE TABLE IF NOT EXISTS `pois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctime` datetime NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `descr` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `city_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `pois`
--

INSERT INTO `pois` (`id`, `ctime`, `mtime`, `name`, `lat`, `lon`, `user_id`, `descr`, `rating`, `city_id`) VALUES
(7, '2010-03-16 13:40:53', '2010-03-16 16:40:53', 'Первый батальон', 43.2808, 76.9123, NULL, 'Самый первый', 0, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `pois_rubrics`
--

DROP TABLE IF EXISTS `pois_rubrics`;
CREATE TABLE IF NOT EXISTS `pois_rubrics` (
  `poi_id` int(11) NOT NULL,
  `rubric_id` int(11) NOT NULL,
  KEY `poi_id` (`poi_id`,`rubric_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `pois_rubrics`
--

INSERT INTO `pois_rubrics` (`poi_id`, `rubric_id`) VALUES
(7, 284);

-- --------------------------------------------------------

--
-- Структура таблицы `poi_images`
--

DROP TABLE IF EXISTS `poi_images`;
CREATE TABLE IF NOT EXISTS `poi_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `poi_images`
--


-- --------------------------------------------------------

--
-- Структура таблицы `poi_rating`
--

DROP TABLE IF EXISTS `poi_rating`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `poi_rating`
--


-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(4, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `rubrics`
--

DROP TABLE IF EXISTS `rubrics`;
CREATE TABLE IF NOT EXISTS `rubrics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubric_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rubrics` (`rubric_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=369 ;

--
-- Дамп данных таблицы `rubrics`
--

INSERT INTO `rubrics` (`id`, `rubric_id`, `name`) VALUES
(283, NULL, 'Автомобили'),
(284, 283, 'ГАИ'),
(285, 283, 'Тех. центры, автосервисы, шиномонтаж'),
(286, 283, 'Магазины автозапчастей, автосалоны'),
(287, 283, 'Заправки и автомойки'),
(288, 283, 'Автошколы'),
(289, 283, 'Автостоянки, гаражи'),
(290, 283, 'Автовокзалы, таксопарки'),
(291, 283, 'Грузовые перевозки'),
(292, 283, 'Другое'),
(293, NULL, 'Общественный транспорт'),
(294, 293, 'Авиперевозки'),
(295, 293, 'Автобусы, троллейбусы, трамваи'),
(296, 293, 'Железнодорожные вокзалы, кассы, перевозки'),
(297, 293, 'Другое'),
(298, NULL, 'Учебные заведения'),
(299, 298, 'ВУЗы'),
(300, 298, 'Колледжи'),
(301, 298, 'Школы'),
(302, 298, 'Курсы'),
(303, 298, 'Другое'),
(304, NULL, 'Гос. учреждения'),
(305, 304, 'Министерства, управления, гос. службы'),
(306, 304, 'Почта'),
(307, 304, 'НИИ'),
(308, 304, 'Заводы, фабрики'),
(309, 304, 'Библиотеки, архивы'),
(310, 304, 'Другое'),
(311, NULL, 'Для детей'),
(312, 311, 'Дет.сады, ясли'),
(313, 311, 'Парки отдыха, зоопарки'),
(314, 311, 'Цирк, театры'),
(315, 311, 'Детские центры, кружки'),
(316, 311, 'Детские лагеря'),
(317, 311, 'Другое'),
(318, NULL, 'Здоровье'),
(319, 318, 'Аптеки'),
(320, 318, 'Городские поликлиники'),
(321, 318, 'Клинические больницы'),
(322, 318, 'Родильные дома, женские консультации'),
(323, 318, 'Пансионаты, санатории, реабилитационные центры'),
(324, 318, 'Частные клиники'),
(325, 318, 'Другое'),
(326, NULL, 'Кафе, рестораны'),
(327, 326, 'Рестораны'),
(328, 326, 'Кафе, кофейни'),
(329, 326, 'Фаст-фуд, столовые'),
(330, 326, 'Пиццерии'),
(331, 326, 'Суши-бары'),
(332, 326, 'Другое'),
(333, NULL, 'Магазины, рынки'),
(334, 333, 'Торговые центры'),
(335, 333, 'Продуктовые магазины, супермаркеты'),
(336, 333, 'Магазины одежды, обуви, аксессуаров'),
(337, 333, 'Вещевые рынки'),
(338, 333, 'Продуктовые рынки'),
(339, 333, 'Магазины техники'),
(340, 333, 'Другое'),
(341, NULL, 'Отдых и развлечения'),
(342, 341, 'Клубы, бары'),
(343, 341, 'Кинотеатры'),
(344, 341, 'Театры, концертные залы'),
(345, 341, 'Музеи, выставочные залы, галереи'),
(346, 341, 'Боулинг и бильярд'),
(347, 341, 'Парки отдыха и развлечений'),
(348, 341, 'Развлекательные центры'),
(349, 341, 'Другое'),
(350, NULL, 'Спорт, фитнесс, красота'),
(351, 350, 'Фитнесс центры'),
(352, 350, 'Спортивные центры, школы'),
(353, 350, 'Катки, роллердромы'),
(354, 350, 'Салоны красоты'),
(355, 350, 'Парикмахерские'),
(356, 350, 'Солярии, сауны'),
(357, 350, 'Другое'),
(358, NULL, 'Услуги'),
(359, 358, 'Коммунальные службы, КСК'),
(360, 358, 'Рекрутинговые агентства, службы занятости'),
(361, 358, 'Обмен валют'),
(362, 358, 'Банки, страховые компании'),
(363, 358, 'Другое'),
(364, NULL, 'Другое'),
(365, 364, 'Архитектура'),
(366, 364, 'Гостиницы');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `types`
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
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `ctime` datetime NOT NULL,
  `mtime` datetime NOT NULL,
  `atime` datetime NOT NULL,
  `status` enum('unconfirmed','confirmed','banned','admin') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `users`
--


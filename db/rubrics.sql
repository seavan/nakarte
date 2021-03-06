-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 16 2010 г., 11:12
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
-- Структура таблицы `rubrics`
--

DROP TABLE IF EXISTS `rubrics`;
CREATE TABLE IF NOT EXISTS `rubrics` (
  `id` int(11) NOT NULL auto_increment,
  `rubric_id` int(11) default NULL,
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `order` int(11) default '0',
  `class` varchar(30) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_rubrics` (`rubric_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=467 ;

--
-- Дамп данных таблицы `rubrics`
--

INSERT INTO `rubrics` (`id`, `rubric_id`, `name`, `order`, `class`) VALUES
(283, NULL, 'Автомобили', 0, 'rCars'),
(293, NULL, 'Транспорт', 0, 'rTransport'),
(298, NULL, 'Учебные заведения', 0, 'rSchools'),
(304, NULL, 'Гос. учреждения', 0, 'rPublic'),
(311, NULL, 'Для детей', 0, 'rChildren'),
(318, NULL, 'Здоровье', 0, 'rHealth'),
(326, NULL, 'Кафе, рестораны', 0, 'rCafe'),
(327, 326, 'Рестораны', 0, ''),
(328, 326, 'Кафе, кофейни', 0, ''),
(329, 326, 'Фаст-фуд, столовые', 0, ''),
(330, 326, 'Пиццерии', 0, ''),
(331, 326, 'Суши-бары', 0, ''),
(332, 326, 'Другое', 10000, ''),
(333, NULL, 'Магазины, рынки', 0, 'rShops'),
(341, NULL, 'Отдых и развлечения', 0, 'rRest'),
(350, NULL, 'Спорт, фитнесс, красота', 0, 'rSport'),
(358, NULL, 'Услуги', 0, 'rServices'),
(367, NULL, 'Туризм', 0, 'rTourism'),
(368, NULL, 'Религия и общество', 0, 'rReligion'),
(369, 283, 'Автосалоны', 0, ''),
(370, 283, 'Автосервисы', 0, 'rCars_Autoservice'),
(371, 283, 'Магазины автозапчастей', 0, 'rCarsi_Autoparts'),
(372, 283, 'Автозаправки', 0, 'rCars_Carinsurance'),
(373, 283, 'Автомойки', 0, NULL),
(374, 283, 'Автошколы', 0, 'rCars_Driving'),
(375, 283, 'Такси', 0, NULL),
(376, 283, 'Автостоянки, гаражи', 0, 'rCars_Garage'),
(377, 283, 'Другое', 10000, 'rCars_Other'),
(378, 298, 'ВУЗы', 0, NULL),
(379, 298, 'Колледжи, профшколы ', 0, NULL),
(380, 298, 'Школы, гимназии, лицеи ', 0, NULL),
(381, 298, 'Музыкальные, художественные, танцевальные школы ', 0, NULL),
(383, 298, 'Курсы', 0, NULL),
(384, 298, 'Детские сады, ясли', 0, NULL),
(385, 298, 'Другое', 10000, NULL),
(386, 304, 'Президент, министерства, акиматы, маслихаты', 0, NULL),
(387, 304, 'Министерства и ведомства', 0, NULL),
(388, 283, 'ГАИ', 0, 'rCars_GBDD'),
(389, 304, 'Полиция, суды', 0, NULL),
(390, 304, 'Налоговые инспекции', 0, NULL),
(391, 304, 'Акиматы, ЦОН (Центры обслуживания населения)', 0, NULL),
(392, 304, 'Почта', 0, NULL),
(393, 304, 'ЗАГСы', 0, NULL),
(394, 304, 'НИИ', 0, NULL),
(395, 304, 'Библиотеки, архивы', 0, NULL),
(396, 304, 'Службы занятости', 0, NULL),
(397, 304, 'Другое', 10000, NULL),
(398, 311, 'Детские сады, ясли', 0, NULL),
(399, 311, 'Дошкольная подготовка', 0, NULL),
(400, 311, 'Парки отдыха, зоопарки', 0, NULL),
(401, 311, 'Цирк, театры', 0, NULL),
(402, 311, 'Детские центры, кружки', 0, NULL),
(403, 311, 'Другое', 10000, NULL),
(404, 318, 'Аптеки', 0, NULL),
(405, 318, 'Оптика', 0, NULL),
(406, 318, 'Поликлиники', 0, NULL),
(407, 318, 'Больницы, госпитали, НИИ', 0, NULL),
(408, 318, 'Частные клиники, медцентры', 0, NULL),
(409, 318, 'Родильные дома, женские консультации', 0, NULL),
(410, 318, 'Стоматология ', 0, NULL),
(411, 318, 'Пансионаты, санатории, реабилитационные центры', 0, NULL),
(412, 318, 'Медицинские страховые организации, лаборатории ', 0, NULL),
(413, 318, 'Ветеринарные клиники, аптеки', 0, NULL),
(414, 318, 'Другое', 10000, NULL),
(415, 333, 'Торговые центры', 0, NULL),
(416, 333, 'Продуктовые магазины, супермаркеты', 0, NULL),
(417, 333, 'Мебель', 0, NULL),
(418, 333, 'Магазины одежды, обуви, аксессуаров', 0, NULL),
(419, 333, 'Вещевые рынки, сток-центры', 0, NULL),
(420, 333, 'Продуктовые рынки', 0, NULL),
(421, 333, 'Магазины техники', 0, NULL),
(422, 333, 'Компьютеры и комплектующие ', 0, NULL),
(423, 333, 'Книги, музыка, видео', 0, NULL),
(424, 333, 'Животные и растения', 0, NULL),
(425, 333, 'Другое', 10000, NULL),
(426, 368, 'Мечети, мусульманские организации', 0, NULL),
(427, 368, 'Церкви, христианские органиции', 0, NULL),
(428, 368, 'Представительства других религий', 0, NULL),
(429, 368, 'Общественные, благотворительные фонды', 0, NULL),
(430, 368, 'Детские дома, интернаты', 0, NULL),
(431, 368, 'Другое', 10000, NULL),
(432, 341, 'Клубы, бары', 0, NULL),
(433, 341, 'Кинотеатры', 0, NULL),
(434, 341, 'Театры, концертные залы, цирки ', 0, NULL),
(435, 341, 'Музеи, выставочные залы, галереи', 0, NULL),
(436, 341, 'Боулинг и бильярд', 0, NULL),
(437, 341, 'Парки отдыха, зоопарк', 0, NULL),
(438, 341, 'Развлекательные центры', 0, NULL),
(439, 341, 'Другое', 10000, NULL),
(440, 350, 'Фитнес-центры', 0, NULL),
(441, 350, 'Спортивные центры, школы ', 0, NULL),
(442, 350, 'Салоны красоты ', 0, NULL),
(443, 350, 'Парикмахерские', 0, NULL),
(444, 350, 'Солярии', 0, NULL),
(445, 350, 'Бани, сауны', 0, NULL),
(446, 350, 'Другое', 10000, NULL),
(447, 293, 'Авиабилеты', 0, NULL),
(448, 293, 'Автовокзалы', 0, NULL),
(449, 293, 'Троллейбусные, трамвайные и автопарки', 0, NULL),
(450, 293, 'Железнодорожные вокзалы', 0, NULL),
(451, 293, 'Железнодорожные кассы', 0, NULL),
(452, 358, 'Банки', 0, NULL),
(453, 358, 'Обмен валют', 0, NULL),
(454, 358, 'Коммунальные службы, КСК', 0, NULL),
(455, 358, 'Рекрутинговые агентства', 0, NULL),
(456, 358, 'Страховые компании', 0, NULL),
(457, 358, 'Нотариусы', 0, NULL),
(458, 358, 'Химчистки, ателье, ремонтные мастерские', 0, NULL),
(459, 358, 'Фотоуслуги', 0, NULL),
(460, 358, 'Другое', 10000, NULL),
(461, 367, 'Архитектура, достопримечательности', 0, NULL),
(462, 367, 'Парки отдыха, зоопарки', 0, NULL),
(463, 367, 'Гостиницы, дома отдыха', 0, NULL),
(464, 367, 'Туроператоры, турагенства', 0, NULL),
(465, 367, 'Посольства, консульства', 0, NULL),
(466, 367, 'Другое', 10000, NULL);

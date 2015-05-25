-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 16 2010 г., 15:48
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

UPDATE `rubrics` SET `id` = 283,`rubric_id` = NULL,`name` = 'Автомобили',`order` = 0,`class` = 'rCars' WHERE `rubrics`.`id` = 283;
UPDATE `rubrics` SET `id` = 293,`rubric_id` = NULL,`name` = 'Транспорт',`order` = 0,`class` = 'rTransport' WHERE `rubrics`.`id` = 293;
UPDATE `rubrics` SET `id` = 298,`rubric_id` = NULL,`name` = 'Учебные заведения',`order` = 0,`class` = 'rSchools' WHERE `rubrics`.`id` = 298;
UPDATE `rubrics` SET `id` = 304,`rubric_id` = NULL,`name` = 'Гос. учреждения',`order` = 0,`class` = 'rPublic' WHERE `rubrics`.`id` = 304;
UPDATE `rubrics` SET `id` = 311,`rubric_id` = NULL,`name` = 'Для детей',`order` = 0,`class` = 'rChildren' WHERE `rubrics`.`id` = 311;
UPDATE `rubrics` SET `id` = 318,`rubric_id` = NULL,`name` = 'Здоровье',`order` = 0,`class` = 'rHealth' WHERE `rubrics`.`id` = 318;
UPDATE `rubrics` SET `id` = 326,`rubric_id` = NULL,`name` = 'Кафе, рестораны',`order` = 0,`class` = 'rCafe' WHERE `rubrics`.`id` = 326;
UPDATE `rubrics` SET `id` = 327,`rubric_id` = 326,`name` = 'Рестораны',`order` = 0,`class` = 'rCafe_Restaurant' WHERE `rubrics`.`id` = 327;
UPDATE `rubrics` SET `id` = 328,`rubric_id` = 326,`name` = 'Кафе, кофейни',`order` = 0,`class` = 'rCafe_Cafe' WHERE `rubrics`.`id` = 328;
UPDATE `rubrics` SET `id` = 329,`rubric_id` = 326,`name` = 'Фаст-фуд, столовые',`order` = 0,`class` = 'rCafe_Fastfood' WHERE `rubrics`.`id` = 329;
UPDATE `rubrics` SET `id` = 330,`rubric_id` = 326,`name` = 'Пиццерии',`order` = 0,`class` = 'rCafe_Pizza' WHERE `rubrics`.`id` = 330;
UPDATE `rubrics` SET `id` = 331,`rubric_id` = 326,`name` = 'Суши-бары',`order` = 0,`class` = '' WHERE `rubrics`.`id` = 331;
UPDATE `rubrics` SET `id` = 332,`rubric_id` = 326,`name` = 'Другое',`order` = 10000,`class` = 'rCafe_Other' WHERE `rubrics`.`id` = 332;
UPDATE `rubrics` SET `id` = 333,`rubric_id` = NULL,`name` = 'Магазины, рынки',`order` = 0,`class` = 'rShops' WHERE `rubrics`.`id` = 333;
UPDATE `rubrics` SET `id` = 341,`rubric_id` = NULL,`name` = 'Отдых и развлечения',`order` = 0,`class` = 'rRest' WHERE `rubrics`.`id` = 341;
UPDATE `rubrics` SET `id` = 350,`rubric_id` = NULL,`name` = 'Спорт, фитнесс, красота',`order` = 0,`class` = 'rSport' WHERE `rubrics`.`id` = 350;
UPDATE `rubrics` SET `id` = 358,`rubric_id` = NULL,`name` = 'Услуги',`order` = 0,`class` = 'rServices' WHERE `rubrics`.`id` = 358;
UPDATE `rubrics` SET `id` = 367,`rubric_id` = NULL,`name` = 'Туризм',`order` = 0,`class` = 'rTourism' WHERE `rubrics`.`id` = 367;
UPDATE `rubrics` SET `id` = 368,`rubric_id` = NULL,`name` = 'Религия и общество',`order` = 0,`class` = 'rReligion' WHERE `rubrics`.`id` = 368;
UPDATE `rubrics` SET `id` = 369,`rubric_id` = 283,`name` = 'Автосалоны',`order` = 0,`class` = '' WHERE `rubrics`.`id` = 369;
UPDATE `rubrics` SET `id` = 370,`rubric_id` = 283,`name` = 'Автосервисы',`order` = 0,`class` = 'rCars_Autoservice' WHERE `rubrics`.`id` = 370;
UPDATE `rubrics` SET `id` = 371,`rubric_id` = 283,`name` = 'Магазины автозапчастей',`order` = 0,`class` = 'rCarsi_Autoparts' WHERE `rubrics`.`id` = 371;
UPDATE `rubrics` SET `id` = 372,`rubric_id` = 283,`name` = 'Автозаправки',`order` = 0,`class` = 'rCars_Carinsurance' WHERE `rubrics`.`id` = 372;
UPDATE `rubrics` SET `id` = 373,`rubric_id` = 283,`name` = 'Автомойки',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 373;
UPDATE `rubrics` SET `id` = 374,`rubric_id` = 283,`name` = 'Автошколы',`order` = 0,`class` = 'rCars_Driving' WHERE `rubrics`.`id` = 374;
UPDATE `rubrics` SET `id` = 375,`rubric_id` = 283,`name` = 'Такси',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 375;
UPDATE `rubrics` SET `id` = 376,`rubric_id` = 283,`name` = 'Автостоянки, гаражи',`order` = 0,`class` = 'rCars_Garage' WHERE `rubrics`.`id` = 376;
UPDATE `rubrics` SET `id` = 377,`rubric_id` = 283,`name` = 'Другое',`order` = 10000,`class` = 'rCars_Other' WHERE `rubrics`.`id` = 377;
UPDATE `rubrics` SET `id` = 378,`rubric_id` = 298,`name` = 'ВУЗы',`order` = 0,`class` = 'rSchools_VUZ' WHERE `rubrics`.`id` = 378;
UPDATE `rubrics` SET `id` = 379,`rubric_id` = 298,`name` = 'Колледжи, профшколы ',`order` = 0,`class` = 'rSchools_College' WHERE `rubrics`.`id` = 379;
UPDATE `rubrics` SET `id` = 380,`rubric_id` = 298,`name` = 'Школы, гимназии, лицеи ',`order` = 0,`class` = 'rSchools_Schools' WHERE `rubrics`.`id` = 380;
UPDATE `rubrics` SET `id` = 381,`rubric_id` = 298,`name` = 'Музыкальные, художественные, танцевальные школы ',`order` = 0,`class` = 'rSchools_Music' WHERE `rubrics`.`id` = 381;
UPDATE `rubrics` SET `id` = 383,`rubric_id` = 298,`name` = 'Курсы',`order` = 0,`class` = 'rSchools_Courses' WHERE `rubrics`.`id` = 383;
UPDATE `rubrics` SET `id` = 384,`rubric_id` = 298,`name` = 'Детские сады, ясли',`order` = 0,`class` = '' WHERE `rubrics`.`id` = 384;
UPDATE `rubrics` SET `id` = 385,`rubric_id` = 298,`name` = 'Другое',`order` = 10000,`class` = 'rSchools_Other' WHERE `rubrics`.`id` = 385;
UPDATE `rubrics` SET `id` = 386,`rubric_id` = 304,`name` = 'Президент, министерства, акиматы, маслихаты',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 386;
UPDATE `rubrics` SET `id` = 387,`rubric_id` = 304,`name` = 'Министерства и ведомства',`order` = 0,`class` = 'rPublic_Ministry' WHERE `rubrics`.`id` = 387;
UPDATE `rubrics` SET `id` = 388,`rubric_id` = 283,`name` = 'ГАИ',`order` = 0,`class` = 'rCars_GBDD' WHERE `rubrics`.`id` = 388;
UPDATE `rubrics` SET `id` = 389,`rubric_id` = 304,`name` = 'Полиция, суды',`order` = 0,`class` = 'rPublic_Police' WHERE `rubrics`.`id` = 389;
UPDATE `rubrics` SET `id` = 390,`rubric_id` = 304,`name` = 'Налоговые инспекции',`order` = 0,`class` = 'rPublic_Tax' WHERE `rubrics`.`id` = 390;
UPDATE `rubrics` SET `id` = 391,`rubric_id` = 304,`name` = 'Акиматы, ЦОН (Центры обслуживания населения)',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 391;
UPDATE `rubrics` SET `id` = 392,`rubric_id` = 304,`name` = 'Почта',`order` = 0,`class` = 'rPublic_Mail' WHERE `rubrics`.`id` = 392;
UPDATE `rubrics` SET `id` = 393,`rubric_id` = 304,`name` = 'ЗАГСы',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 393;
UPDATE `rubrics` SET `id` = 394,`rubric_id` = 304,`name` = 'НИИ',`order` = 0,`class` = 'rPublic_NII' WHERE `rubrics`.`id` = 394;
UPDATE `rubrics` SET `id` = 395,`rubric_id` = 304,`name` = 'Библиотеки, архивы',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 395;
UPDATE `rubrics` SET `id` = 396,`rubric_id` = 304,`name` = 'Службы занятости',`order` = 0,`class` = 'rPublic_Employment' WHERE `rubrics`.`id` = 396;
UPDATE `rubrics` SET `id` = 397,`rubric_id` = 304,`name` = 'Другое',`order` = 10000,`class` = 'rPublic_Other' WHERE `rubrics`.`id` = 397;
UPDATE `rubrics` SET `id` = 398,`rubric_id` = 311,`name` = 'Детские сады, ясли',`order` = 0,`class` = 'rChildren_Kindergarten' WHERE `rubrics`.`id` = 398;
UPDATE `rubrics` SET `id` = 399,`rubric_id` = 311,`name` = 'Дошкольная подготовка',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 399;
UPDATE `rubrics` SET `id` = 400,`rubric_id` = 311,`name` = 'Парки отдыха, зоопарки',`order` = 0,`class` = 'rChildren_Park' WHERE `rubrics`.`id` = 400;
UPDATE `rubrics` SET `id` = 401,`rubric_id` = 311,`name` = 'Цирк, театры',`order` = 0,`class` = 'rChildren_Circus' WHERE `rubrics`.`id` = 401;
UPDATE `rubrics` SET `id` = 402,`rubric_id` = 311,`name` = 'Детские центры, кружки',`order` = 0,`class` = 'rChildren_Centers' WHERE `rubrics`.`id` = 402;
UPDATE `rubrics` SET `id` = 403,`rubric_id` = 311,`name` = 'Другое',`order` = 10000,`class` = 'rChildren_Other' WHERE `rubrics`.`id` = 403;
UPDATE `rubrics` SET `id` = 404,`rubric_id` = 318,`name` = 'Аптеки',`order` = 0,`class` = 'rHealth_Pharmacies' WHERE `rubrics`.`id` = 404;
UPDATE `rubrics` SET `id` = 405,`rubric_id` = 318,`name` = 'Оптика',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 405;
UPDATE `rubrics` SET `id` = 406,`rubric_id` = 318,`name` = 'Поликлиники',`order` = 0,`class` = 'rHealth_Policlinic' WHERE `rubrics`.`id` = 406;
UPDATE `rubrics` SET `id` = 407,`rubric_id` = 318,`name` = 'Больницы, госпитали, НИИ',`order` = 0,`class` = 'rHealth_Hospital' WHERE `rubrics`.`id` = 407;
UPDATE `rubrics` SET `id` = 408,`rubric_id` = 318,`name` = 'Частные клиники, медцентры',`order` = 0,`class` = 'rHealth_Centers' WHERE `rubrics`.`id` = 408;
UPDATE `rubrics` SET `id` = 409,`rubric_id` = 318,`name` = 'Родильные дома, женские консультации',`order` = 0,`class` = 'rHealth_Maternity' WHERE `rubrics`.`id` = 409;
UPDATE `rubrics` SET `id` = 410,`rubric_id` = 318,`name` = 'Стоматология ',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 410;
UPDATE `rubrics` SET `id` = 411,`rubric_id` = 318,`name` = 'Пансионаты, санатории, реабилитационные центры',`order` = 0,`class` = 'rHealth_Sanatorium' WHERE `rubrics`.`id` = 411;
UPDATE `rubrics` SET `id` = 412,`rubric_id` = 318,`name` = 'Медицинские страховые организации, лаборатории ',`order` = 0,`class` = 'rHealth_Laboratory' WHERE `rubrics`.`id` = 412;
UPDATE `rubrics` SET `id` = 413,`rubric_id` = 318,`name` = 'Ветеринарные клиники, аптеки',`order` = 0,`class` = 'rHealth_Veterinary' WHERE `rubrics`.`id` = 413;
UPDATE `rubrics` SET `id` = 414,`rubric_id` = 318,`name` = 'Другое',`order` = 10000,`class` = 'rHealth_Other' WHERE `rubrics`.`id` = 414;
UPDATE `rubrics` SET `id` = 415,`rubric_id` = 333,`name` = 'Торговые центры',`order` = 0,`class` = 'rShops_Retail' WHERE `rubrics`.`id` = 415;
UPDATE `rubrics` SET `id` = 416,`rubric_id` = 333,`name` = 'Продуктовые магазины, супермаркеты',`order` = 0,`class` = 'rShops_Supermarket' WHERE `rubrics`.`id` = 416;
UPDATE `rubrics` SET `id` = 417,`rubric_id` = 333,`name` = 'Мебель',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 417;
UPDATE `rubrics` SET `id` = 418,`rubric_id` = 333,`name` = 'Магазины одежды, обуви, аксессуаров',`order` = 0,`class` = 'rShops_Clothingmarket2' WHERE `rubrics`.`id` = 418;
UPDATE `rubrics` SET `id` = 419,`rubric_id` = 333,`name` = 'Вещевые рынки, сток-центры',`order` = 0,`class` = 'rShops_Clothingmarket' WHERE `rubrics`.`id` = 419;
UPDATE `rubrics` SET `id` = 420,`rubric_id` = 333,`name` = 'Продуктовые рынки',`order` = 0,`class` = 'rShops_Produktmarket' WHERE `rubrics`.`id` = 420;
UPDATE `rubrics` SET `id` = 421,`rubric_id` = 333,`name` = 'Магазины техники',`order` = 0,`class` = 'rShops_Technique' WHERE `rubrics`.`id` = 421;
UPDATE `rubrics` SET `id` = 422,`rubric_id` = 333,`name` = 'Компьютеры и комплектующие ',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 422;
UPDATE `rubrics` SET `id` = 423,`rubric_id` = 333,`name` = 'Книги, музыка, видео',`order` = 0,`class` = 'rShops_BooksVideoMusic' WHERE `rubrics`.`id` = 423;
UPDATE `rubrics` SET `id` = 424,`rubric_id` = 333,`name` = 'Животные и растения',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 424;
UPDATE `rubrics` SET `id` = 425,`rubric_id` = 333,`name` = 'Другое',`order` = 10000,`class` = 'rShops_Other' WHERE `rubrics`.`id` = 425;
UPDATE `rubrics` SET `id` = 426,`rubric_id` = 368,`name` = 'Мечети, мусульманские организации',`order` = 0,`class` = 'rReligion_Mosque' WHERE `rubrics`.`id` = 426;
UPDATE `rubrics` SET `id` = 427,`rubric_id` = 368,`name` = 'Церкви, христианские органиции',`order` = 0,`class` = 'rReligion_Church' WHERE `rubrics`.`id` = 427;
UPDATE `rubrics` SET `id` = 428,`rubric_id` = 368,`name` = 'Представительства других религий',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 428;
UPDATE `rubrics` SET `id` = 429,`rubric_id` = 368,`name` = 'Общественные, благотворительные фонды',`order` = 0,`class` = 'rReligion_Benefactors' WHERE `rubrics`.`id` = 429;
UPDATE `rubrics` SET `id` = 430,`rubric_id` = 368,`name` = 'Детские дома, интернаты',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 430;
UPDATE `rubrics` SET `id` = 431,`rubric_id` = 368,`name` = 'Другое',`order` = 10000,`class` = 'rReligion_Other' WHERE `rubrics`.`id` = 431;
UPDATE `rubrics` SET `id` = 432,`rubric_id` = 341,`name` = 'Клубы, бары',`order` = 0,`class` = 'rRest_Club' WHERE `rubrics`.`id` = 432;
UPDATE `rubrics` SET `id` = 433,`rubric_id` = 341,`name` = 'Кинотеатры',`order` = 0,`class` = 'rRest_Cinema' WHERE `rubrics`.`id` = 433;
UPDATE `rubrics` SET `id` = 434,`rubric_id` = 341,`name` = 'Театры, концертные залы, цирки ',`order` = 0,`class` = 'rRest_Theater' WHERE `rubrics`.`id` = 434;
UPDATE `rubrics` SET `id` = 435,`rubric_id` = 341,`name` = 'Музеи, выставочные залы, галереи',`order` = 0,`class` = 'rRest_Museum' WHERE `rubrics`.`id` = 435;
UPDATE `rubrics` SET `id` = 436,`rubric_id` = 341,`name` = 'Боулинг и бильярд',`order` = 0,`class` = 'rRest_Bowling' WHERE `rubrics`.`id` = 436;
UPDATE `rubrics` SET `id` = 437,`rubric_id` = 341,`name` = 'Парки отдыха, зоопарк',`order` = 0,`class` = 'rRest_Park' WHERE `rubrics`.`id` = 437;
UPDATE `rubrics` SET `id` = 438,`rubric_id` = 341,`name` = 'Развлекательные центры',`order` = 0,`class` = 'rRest_Centers' WHERE `rubrics`.`id` = 438;
UPDATE `rubrics` SET `id` = 439,`rubric_id` = 341,`name` = 'Другое',`order` = 10000,`class` = 'rRest_Other' WHERE `rubrics`.`id` = 439;
UPDATE `rubrics` SET `id` = 440,`rubric_id` = 350,`name` = 'Фитнес-центры',`order` = 0,`class` = 'rSport_Fitness' WHERE `rubrics`.`id` = 440;
UPDATE `rubrics` SET `id` = 441,`rubric_id` = 350,`name` = 'Спортивные центры, школы ',`order` = 0,`class` = 'rSport_SportSchool' WHERE `rubrics`.`id` = 441;
UPDATE `rubrics` SET `id` = 442,`rubric_id` = 350,`name` = 'Салоны красоты ',`order` = 0,`class` = 'rSport_Beauty' WHERE `rubrics`.`id` = 442;
UPDATE `rubrics` SET `id` = 443,`rubric_id` = 350,`name` = 'Парикмахерские',`order` = 0,`class` = 'rSport_Hairdressers' WHERE `rubrics`.`id` = 443;
UPDATE `rubrics` SET `id` = 444,`rubric_id` = 350,`name` = 'Солярии',`order` = 0,`class` = 'rSport_Solariums' WHERE `rubrics`.`id` = 444;
UPDATE `rubrics` SET `id` = 445,`rubric_id` = 350,`name` = 'Бани, сауны',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 445;
UPDATE `rubrics` SET `id` = 446,`rubric_id` = 350,`name` = 'Другое',`order` = 10000,`class` = 'rSport_Other' WHERE `rubrics`.`id` = 446;
UPDATE `rubrics` SET `id` = 447,`rubric_id` = 293,`name` = 'Авиабилеты',`order` = 0,`class` = 'rTransport_Flights' WHERE `rubrics`.`id` = 447;
UPDATE `rubrics` SET `id` = 448,`rubric_id` = 293,`name` = 'Автовокзалы',`order` = 0,`class` = 'rTransport_Bus' WHERE `rubrics`.`id` = 448;
UPDATE `rubrics` SET `id` = 449,`rubric_id` = 293,`name` = 'Троллейбусные, трамвайные и автопарки',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 449;
UPDATE `rubrics` SET `id` = 450,`rubric_id` = 293,`name` = 'Железнодорожные вокзалы',`order` = 0,`class` = 'rTransport_Railway' WHERE `rubrics`.`id` = 450;
UPDATE `rubrics` SET `id` = 451,`rubric_id` = 293,`name` = 'Железнодорожные кассы',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 451;
UPDATE `rubrics` SET `id` = 452,`rubric_id` = 358,`name` = 'Банки',`order` = 0,`class` = 'rServices_Bank' WHERE `rubrics`.`id` = 452;
UPDATE `rubrics` SET `id` = 453,`rubric_id` = 358,`name` = 'Обмен валют',`order` = 0,`class` = 'rServices_Exchange' WHERE `rubrics`.`id` = 453;
UPDATE `rubrics` SET `id` = 454,`rubric_id` = 358,`name` = 'Коммунальные службы, КСК',`order` = 0,`class` = 'rServices_Utilities' WHERE `rubrics`.`id` = 454;
UPDATE `rubrics` SET `id` = 455,`rubric_id` = 358,`name` = 'Рекрутинговые агентства',`order` = 0,`class` = 'rServices_Employment' WHERE `rubrics`.`id` = 455;
UPDATE `rubrics` SET `id` = 456,`rubric_id` = 358,`name` = 'Страховые компании',`order` = 0,`class` = 'rServices_Insurance' WHERE `rubrics`.`id` = 456;
UPDATE `rubrics` SET `id` = 457,`rubric_id` = 358,`name` = 'Нотариусы',`order` = 0,`class` = 'rServices_Notary' WHERE `rubrics`.`id` = 457;
UPDATE `rubrics` SET `id` = 458,`rubric_id` = 358,`name` = 'Химчистки, ателье, ремонтные мастерские',`order` = 0,`class` = 'rServices_Drycleaning' WHERE `rubrics`.`id` = 458;
UPDATE `rubrics` SET `id` = 459,`rubric_id` = 358,`name` = 'Фотоуслуги',`order` = 0,`class` = NULL WHERE `rubrics`.`id` = 459;
UPDATE `rubrics` SET `id` = 460,`rubric_id` = 358,`name` = 'Другое',`order` = 10000,`class` = 'rServices_Other' WHERE `rubrics`.`id` = 460;
UPDATE `rubrics` SET `id` = 461,`rubric_id` = 367,`name` = 'Архитектура, достопримечательности',`order` = 0,`class` = 'rTourism_Architecture' WHERE `rubrics`.`id` = 461;
UPDATE `rubrics` SET `id` = 462,`rubric_id` = 367,`name` = 'Парки отдыха, зоопарки',`order` = 0,`class` = 'rTourism_Park' WHERE `rubrics`.`id` = 462;
UPDATE `rubrics` SET `id` = 463,`rubric_id` = 367,`name` = 'Гостиницы, дома отдыха',`order` = 0,`class` = 'rTourism_Hotel' WHERE `rubrics`.`id` = 463;
UPDATE `rubrics` SET `id` = 464,`rubric_id` = 367,`name` = 'Туроператоры, турагенства',`order` = 0,`class` = 'rTourism_Travel' WHERE `rubrics`.`id` = 464;
UPDATE `rubrics` SET `id` = 465,`rubric_id` = 367,`name` = 'Посольства, консульства',`order` = 0,`class` = 'rTourism_Embassy' WHERE `rubrics`.`id` = 465;
UPDATE `rubrics` SET `id` = 466,`rubric_id` = 367,`name` = 'Другое',`order` = 10000,`class` = 'rTourism_Other' WHERE `rubrics`.`id` = 466;

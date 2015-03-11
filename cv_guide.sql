-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 11 2015 г., 17:16
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cv_guide`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `city` varchar(30) NOT NULL,
  `street` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `street`) VALUES
(1, 'Chernivtsi', 'Holovna'),
(3, 'Chernivtsi', 'Ruska'),
(6, 'Chernivtsi', 'Heroiv Maidany'),
(7, 'Chernivtsi', 'Prospekt Nezalezhnosti'),
(17, 'Chernivtsi', 'Soborna');

-- --------------------------------------------------------

--
-- Структура таблицы `establishments`
--

CREATE TABLE IF NOT EXISTS `establishments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `address_id` int(3) NOT NULL,
  `gps` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `id_work_time` int(3) NOT NULL,
  `description` varchar(500) NOT NULL,
  `id_establishment_type` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`),
  KEY `address_id_2` (`address_id`),
  KEY `address_id_3` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `establishments`
--

INSERT INTO `establishments` (`id`, `title`, `address_id`, `gps`, `telephone`, `id_work_time`, `description`, `id_establishment_type`) VALUES
(1, 'Ekator', 1, '1233 4566', '555 111', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(2, 'Appeti', 3, '5448 7896', '5544 221', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(4, 'Freshline', 1, '5645 2333', '123 321', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(5, 'Paradizo', 3, '1245 2365', '1222 4455', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(7, 'Sushiya', 7, '2314 5648', '1122 124', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(8, 'Tourist', 6, '48.285836, 25.932317', '4869 654', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(9, 'Kyiv', 3, '3225325 23532', '333333', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(10, 'Pizza park', 3, '2141212', '5111111', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(11, 'Depo''t', 1, '5665 65488', '5444 555', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(12, 'Taxi', 6, '651561', '646512', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(13, 'Bulochna', 3, '76568', '65846', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0),
(16, 'Central square', 3, '212', '215', 0, 'It is a description of a place, where you can go/eat/sleep/etc', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `establishmenttype`
--

CREATE TABLE IF NOT EXISTS `establishmenttype` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `establishment` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `establishmenttype`
--

INSERT INTO `establishmenttype` (`id`, `type`, `establishment`) VALUES
(1, 'Accommodation', 'Hotel'),
(2, 'Accommodation', 'Motel'),
(3, 'Accommodation', 'Apartment'),
(4, 'Accommodation', 'Hostel'),
(5, 'Culture', 'Monument'),
(6, 'Culture', 'Museum'),
(7, 'Culture', 'Theatre'),
(8, 'Culture', 'Philharmonic'),
(9, 'Culture', 'Fair'),
(10, 'Culture', 'Exhibition'),
(11, 'Culture', 'Cultural place'),
(12, 'Culture', 'Library'),
(13, 'Free time', 'Club'),
(14, 'Free time', 'Entertainment center'),
(15, 'Free time', 'Cinema'),
(16, 'Free time', 'Sport'),
(17, 'Free time', 'Shopping'),
(18, 'Nutrition', 'Restaurant'),
(19, 'Nutrition', 'Bar'),
(20, 'Nutrition', 'Pub'),
(21, 'Nutrition', 'Pizzeria'),
(22, 'Nutrition', 'Cafe'),
(23, 'Nutrition', 'Canteen'),
(24, 'Nutrition', 'Fast food'),
(25, 'Transport', 'Railway station'),
(26, 'Transport', 'Bus station'),
(27, 'Transport', 'Airport'),
(30, 'Transport', 'Public transportation'),
(31, 'Transport', 'Rent a car');

-- --------------------------------------------------------

--
-- Структура таблицы `worktime`
--

CREATE TABLE IF NOT EXISTS `worktime` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `establishment_id` int(3) NOT NULL,
  `opening` varchar(5) NOT NULL,
  `break_from` varchar(5) NOT NULL,
  `break_to` varchar(5) NOT NULL,
  `closing` varchar(5) NOT NULL,
  `weekend` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `worktime_ibfk_1` (`establishment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `worktime`
--

INSERT INTO `worktime` (`id`, `establishment_id`, `opening`, `break_from`, `break_to`, `closing`, `weekend`) VALUES
(1, 1, '24h', '', '', '18:00', 'Saturday-Sunday'),
(2, 4, '8:00', '11:00', '15:00', '00:00', 'Sunday');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `establishments`
--
ALTER TABLE `establishments`
  ADD CONSTRAINT `establishments_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Ограничения внешнего ключа таблицы `worktime`
--
ALTER TABLE `worktime`
  ADD CONSTRAINT `worktime_ibfk_1` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

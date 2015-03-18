-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 18 2015 г., 12:11
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `street`) VALUES
(1, 'Chernivtsi', 'Holovna'),
(3, 'Chernivtsi', 'Ruska'),
(6, 'Chernivtsi', 'Heroiv Maidany'),
(7, 'Chernivtsi', 'Prospekt Nezalezhnosti'),
(17, 'Chernivtsi', 'Soborna'),
(18, 'Chernivtsi', 'Bozhenka'),
(19, 'Chernivtsi', 'Pivdenno kiltseva'),
(20, 'Chernivtsi', 'Fastivska'),
(21, 'Chernivtsi', 'Khotynska'),
(22, 'Chernivtsi', 'Ivana Franka'),
(23, 'Chernivtsi', 'Universytetska'),
(24, 'Chernivtsi', 'Haharina');

-- --------------------------------------------------------

--
-- Структура таблицы `establishments`
--

CREATE TABLE IF NOT EXISTS `establishments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `build` text,
  `address_id` int(3) NOT NULL,
  `gps` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `establishmenttype_id` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_id` (`address_id`),
  KEY `address_id_2` (`address_id`),
  KEY `address_id_3` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Дамп данных таблицы `establishments`
--

INSERT INTO `establishments` (`id`, `title`, `build`, `address_id`, `gps`, `telephone`, `description`, `establishmenttype_id`) VALUES
(2, 'Appeti', '2', 3, '5448 7896', '5544 221', 'It is a description of a place, where you can go/eat/sleep/etc', 15),
(4, 'Freshline', '1', 1, '5645 2333', '123 321', 'It is a description of a place, where you can go/eat/sleep/etc', 6),
(5, 'Paradizo', '2', 3, '1245 2365', '1222 4455', 'It is a description of a place, where you can go/eat/sleep/etc', 6),
(7, 'Sushiya', '1', 7, '2314 5648', '1122 124', 'It is a description of a place, where you can go/eat/sleep/etc', 4),
(8, 'Tourist', '1', 6, '48.285836, 25.932317', '4869 654', 'It is a description of a place, where you can go/eat/sleep/etc', 4),
(9, 'Kyiv', '1', 3, '3225325 23532', '333333', 'It is a description of a place, where you can go/eat/sleep/etc', 17),
(10, 'Pizza park', '2', 3, '2141212', '5111111', 'It is a description of a place, where you can go/eat/sleep/etc', 16),
(11, 'Depo''t', '1', 1, '5665 65488', '5444 555', 'It is a description of a place, where you can go/eat/sleep/etc', 17),
(12, 'Taxi', '1', 6, '651561', '646512', 'It is a description of a place, where you can go/eat/sleep/etc', 15),
(13, 'Bulochna', '2', 3, '76568', '65846', 'It is a description of a place, where you can go/eat/sleep/etc', 17),
(16, 'Central square', '2', 3, '212', '215', 'It is a description of a place, where you can go/eat/sleep/etc', 16),
(37, 'wasd', '0', 3, '5421', '48512', '.,mnbvcgfdghjnm', 3),
(54, 'asdfgh', '0', 17, '1222', '11', 'asdasddd', 9),
(55, 'qwqwqw', '0', 1, '2121', '2121', 'dffds', 4),
(56, 'aaaaaaaaaaaaaa', '0', 19, '111111', '22222222', 'aaaaaaaaaaaaaaa', 10),
(58, 'gggggggg', '0', 1, '4545', '4555', 'ssssss', 1),
(59, 'qwww', '0', 1, '11', '22', 'ss', 3),
(60, 'vvvvvvv', '0', 17, '323', '3223', 'sassasasa', 23),
(61, 'lllllllll', '0', 7, '56231', '4512', 'saf', 3),
(62, 'zxcvbnm', '0', 23, '212121', '212121', 'ssdsdf', 5),
(63, 'fghj', '0', 1, '3456', '00000097', '6523csac', 3),
(64, 'Mazhor', '15', 18, '1233 3211', '3 12 30', 'it''s good place for mens', 11);

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
  KEY `establishment_id` (`establishment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Дамп данных таблицы `worktime`
--

INSERT INTO `worktime` (`id`, `establishment_id`, `opening`, `break_from`, `break_to`, `closing`, `weekend`) VALUES
(12, 1, '9:00', '11:00', '', '', ''),
(14, 37, '8:00', '11:00', '12:00', '18:00', 'Sunday'),
(24, 0, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(25, 4, '6:00', '11:00', '12:00', '18:00', 'Sunday-Monday'),
(26, 0, '9:00', '', '', '23:00', 'Friday'),
(27, 5, '9:00', '11:00', '12:00', '18:00', 'Sunday'),
(28, 0, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(29, 0, '7:00', '11:00', '12:00', '18:00', 'Sunday'),
(32, 0, '6:00', '11:00', '12:00', '18:00', 'Saturday'),
(33, 0, '6:00', '12:00', '13:00', '19:00', 'Saturday-Sunday'),
(34, 55, '6:00', '11:00', '12:00', '23:00', 'Sunday'),
(35, 0, '24h', '13:00', '13:00', '18:00', 'Friday'),
(36, 0, '12:00', '13:00', '', '', 'Sunday-Monday'),
(38, 0, '7:00', '11:00', '12:00', '18:00', 'Saturday'),
(39, 63, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(40, 1, '1', '7:00', '', '', ''),
(41, 12, '12', '24h', '', '', '05:00'),
(43, 64, '9:00', '', '', '22:00', 'Friday');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `establishments`
--
ALTER TABLE `establishments`
  ADD CONSTRAINT `establishments_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

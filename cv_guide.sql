-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 29 2015 г., 23:03
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `street`) VALUES
(1, 'Chernivtsi', 'Holovna'),
(2, 'Chernivtsi', 'Ruska'),
(3, 'Chernivtsi', 'Chervonoarmiiska'),
(4, 'Chernivtsi', 'Prospekt Nezalezhnosti'),
(5, 'Chernivtsi', 'Soborna'),
(6, 'Chernivtsi', 'Bozhenka'),
(7, 'Chernivtsi', 'Pivdenno kiltseva'),
(8, 'Chernivtsi', 'Fastivska'),
(9, 'Chernivtsi', 'Khotynska'),
(10, 'Chernivtsi', 'Ivana Franka'),
(11, 'Chernivtsi', 'Universytetska'),
(12, 'Chernivtsi', 'Haharina'),
(13, 'Chernivtsi', 'Komarova'),
(14, 'Chernivtsi', 'Libavska');

-- --------------------------------------------------------

--
-- Структура таблицы `establishments`
--

CREATE TABLE IF NOT EXISTS `establishments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `build` text,
  `address_id` int(3) NOT NULL,
  `gps` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `establishmenttype_id` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `establishments_ibfk_1` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `establishments`
--

INSERT INTO `establishments` (`id`, `title`, `image`, `build`, `address_id`, `gps`, `telephone`, `description`, `establishmenttype_id`) VALUES
(1, 'Cheremosh', '', '13A', 13, '48.25980926264088,25.941967098', '(03722) 48400', 'Welcome to the Tourist Complex "Cheremosh" - one of the biggest tourist companies of western Ukraine.\r\nThe Tourist Complex "Cheremosh" has stable contacts with many famous foreign travel companies. Each year over 20 000 gueasts from Ukraine, Germany, Austria, Israel, USA, Canada, Poland, Great Britain and other countries stay at our hotel.', 1),
(2, 'Kyiv', '', '46', 1, '', '(0372) 52-08-56', 'Located in the old town near the Сentral square.', 1),
(3, 'Bukovyna', '46752317.jpg', '141', 1, '', '(0372)  585-625', 'Hotel "Bukovina" is located in the center of the park zone of Chernivtsi on the edge of the old and new city.', 1),
(4, 'Tourist', 'turist-111.jpeg', '184', 3, '48.2681549019243,25.9260947071', '(0372)  558-820', 'Located in the new district of the city.', 1),
(5, 'Andinna', '94_big.jpg', '22-A', 14, '48.28256382264154,25.921737467', '(0372) 52 56 28', 'The hotel is located near old part of town.', 1),
(6, 'Koral', 'koral.jpg', '23', 8, '', '65243 265', 'This is a tiny hotel, near camping.This is a tiny hotel, near camping.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `establishmenttype`
--

CREATE TABLE IF NOT EXISTS `establishmenttype` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `establishment` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

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
(28, 'Transport', 'Public transportation'),
(29, 'Transport', 'Rent a car');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'user', '123', 'user');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `worktime`
--

INSERT INTO `worktime` (`id`, `establishment_id`, `opening`, `break_from`, `break_to`, `closing`, `weekend`) VALUES
(1, 1, '6:00', '', '', '01:00', ''),
(2, 2, '', '', '', '', ''),
(3, 3, '', '', '', '', ''),
(4, 4, '', '', '', '', ''),
(5, 5, '', '', '', '', ''),
(6, 6, '', '', '', '', '');

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

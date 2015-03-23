-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 23 2015 г., 18:34
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `street`) VALUES
(1, 'Chernivtsi', 'Holovna'),
(2, 'Chernivtsi', 'Ruska'),
(3, 'Chernivtsi', 'Heroiv Maidany'),
(4, 'Chernivtsi', 'Prospekt Nezalezhnosti'),
(5, 'Chernivtsi', 'Soborna'),
(6, 'Chernivtsi', 'Bozhenka'),
(7, 'Chernivtsi', 'Pivdenno kiltseva'),
(8, 'Chernivtsi', 'Fastivska'),
(9, 'Chernivtsi', 'Khotynska'),
(10, 'Chernivtsi', 'Ivana Franka'),
(11, 'Chernivtsi', 'Universytetska'),
(12, 'Chernivtsi', 'Haharina'),
(13, 'Chernivtsi', 'Komarova');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


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
(1, 'admin', 'admin', 'admin'),
(2, 'guest', '', 'guest');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Ограничения внешнего ключа таблицы `establishments`
--
ALTER TABLE `establishments`
  ADD CONSTRAINT `establishments_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

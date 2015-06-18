-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2015 г., 20:45
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `street`) VALUES
(1, 'Chernivtsi', 'Holovna st.'),
(2, 'Chernivtsi', 'Ruska st.'),
(3, 'Chernivtsi', 'Chervonoarmiiska st.'),
(4, 'Chernivtsi', 'Prospekt Nezalezhnosti st.'),
(5, 'Chernivtsi', 'Soborna st.'),
(6, 'Chernivtsi', 'Bozhenka st.'),
(7, 'Chernivtsi', 'Pivdenno kiltseva st.'),
(8, 'Chernivtsi', 'Fastivska st.'),
(9, 'Chernivtsi', 'Khotynska st.'),
(10, 'Chernivtsi', 'Ivana Franka st.'),
(11, 'Chernivtsi', 'Universytetska st.'),
(12, 'Chernivtsi', 'Haharina st.'),
(13, 'Chernivtsi', 'Komarova st.'),
(14, 'Chernivtsi', 'Libavska st.'),
(15, 'Chernivtsi', 'Khudyakov st.'),
(16, 'Chernivtsi', 'E.Raysa st.');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establishment_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `establishments`
--

INSERT INTO `establishments` (`id`, `title`, `image`, `build`, `address_id`, `gps`, `telephone`, `description`, `establishmenttype_id`) VALUES
(1, 'Cheremosh', 'item605_1.jpg', '13A', 13, '48.25980926264088,25.941967098', '(03722) 48400', 'Welcome to the Tourist Complex "Cheremosh" - one of the biggest tourist companies of western Ukraine.\r\nThe Tourist Complex "Cheremosh" has stable contacts with many famous foreign travel companies. Each year over 20 000 gueasts from Ukraine, Germany, Austria, Israel, USA, Canada, Poland, Great Britain and other countries stay at our hotel.', 1),
(2, 'Kyiv', '32_big.jpg', '46', 1, '', '(0372) 52-08-56', 'Located in the old town near the Сentral square.', 1),
(3, 'Bukovyna', '46752317.jpg,14.JPG,mglinec-12.jpg,fsd.jpg', '141', 1, '', '(0372)  585-625', 'Hotel "Bukovina" is located in the center of the park zone of Chernivtsi on the edge of the old and new city.', 1),
(4, 'Tourist', 'turist-111.jpeg', '184', 3, '48.2681549019243,25.9260947071', '(0372)  558-820', 'Located in the new district of the city.', 1),
(5, 'Andinna', '94_big.jpg', '22-A', 14, '48.28256382264154,25.921737467', '(0372) 52 56 28', 'The hotel is located near old part of town.', 1),
(6, 'Koral', 'koral.jpg', '23', 8, '', '65243 265', 'This is a tiny hotel, near camping.This is a tiny hotel, near camping.', 1),
(7, 'Knaus', '530332a9d4.jpg', '4/3', 15, '', '(0372)  510-255', 'The apartments are situated in the old part of town, next to the central square.', 3),
(8, 'Like', '29118725.jpg', '12', 16, '', '066 00 40 233', 'Located in the old part of town near O. Kobylianska str.', 4),
(9, 'Hilton', 'mriy.jpg', '5', 6, '48.296213677875194,25.93684500', '3 12 03', 'This is a test description :)', 3),
(10, 'Central Square', 'd71c15fe1ecd452d437d4a29b8e2481f_600x1000.jpg,39765759271efc1300ea9e768e99a98b_600x1000.jpg,6.jpg,0_2bcbd_d036d70b_XL.jpg', '', 1, '48.29242699985568,25.935545992', '', 'The central building of the architectural ensemble of the area is City Hall, which is considered "Heart of the City". It was built 1843-1847 biennium. Designed by Andrew Mikulich in the style of late classicism. In terms of compositional structure is made traditionally for city hall. The house is close to a square with an inner courtyard. Above all building rises two-tiered tower with a balcony, decorated clock and copper spire of the flagpole. By the 20''s. Twentieth-century tower crowned eagle ', 11),
(11, 'wef', '1.jpg', '4', 2, '', '54', 'db', 2),
(12, 'ujh', '1.jpg', '4', 2, '', '45', '542', 2),
(13, 'qwerty', '1.jpg', '652', 2, '', '5421', ';lkj', 12),
(14, 'zxzx', '1.jpg', '54', 2, '', '5412', 'sdv', 1),
(15, 'asfasfa', '1.jpg', '52', 2, '', '52', 'efsw', 2),
(16, 'azazaz', '5.jpg', '5', 5, '', '45', 'cddsvdsv', 4),
(17, 'zxvzxv', '1.jpg', '4', 3, '', '2310', 'sdfvz', 2),
(18, 'dsdsc', '1.jpg', '5', 2, '', '52', 'ds', 2),
(19, 'aaaaaa', '94_big.jpg82.jpg22082edfaad691c2fbc5c917b3b70bc9.jpg', '5', 2, '', '541', 'sd', 2),
(20, 'Mryja', 'mriy.jpg,UlitsaGagarina-OtelKaiser1.jpg,p3.jpg', '65', 2, '', '214210', 'Nice hotel near quartz', 1),
(21, 'Like', '22082edfaad691c2fbc5c917b3b70bc9.jpg,94_big.jpg,82.jpg', '41', 2, '', '5', 'Cheap apartments..', 3),
(22, 'Central Square', 'd71c15fe1ecd452d437d4a29b8e2481f_600x1000.jpg,6.jpg,39765759271efc1300ea9e768e99a98b_600x1000.jpg,0_2bcbd_d036d70b_XL.jpg', '12', 2, '', '5421', 'The Central Square from where Chernivtsi main streets radiate is old town''s heart and one of its most recognizable symbols. Square''s architectural ensemble consists of elegant, as if emerged from a fairy-tale, buildings, is recognized as one of the most beautiful in Chernivtsi and embodies the unique look of Bukovina capital.', 11),
(23, 'Andina', '82.jpg,94_big.jpg,22082edfaad691c2fbc5c917b3b70bc9.jpg,94_big.jpg', '5', 2, '48.27215880144366,25.945535562', '52', 'This is tiny resaurant..', 1),
(24, 'Bykovyna', '46752317.jpg,14.JPG,mglinec-12.jpg,fsd.jpg', '141', 1, '48.27739291547406,25.943679473', '(0372) 585-625', 'Hotel "Bukovyna" is located in the center of the park zone of Chernivtsi on the edge of the old and new city.\r\nIt  is  really  one  of  the  best  hotels  in  Ukraine. Hotel “Bukovyna”  offers  you  commodious  rooms, tasty  cuisine, conference  halls  and  also  such  enjoyable  and  healthy  services  as  SPA, gym, WI-FI  internet, beauty  parlour, parking.', 1),
(25, 'Pan zhapan', 's9tflsh1208.jpg,40676168.jpg,35992512.jpg,GetShowCompanyImage.jpg', '84b', 4, '48.267778776415625,25.93607170', '562332', 'The network of "PanJaPan" offers a wide range of modern Japanese cuisine. The main slogan of our institution: "Sushi for the whole family." In Japanese cuisine, you will be able to meet with other world cuisines: Mexican, Scandinavian, Thai, Caucasian, etc. - Several dishes from around the world.', 19);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `worktime`
--

INSERT INTO `worktime` (`id`, `establishment_id`, `opening`, `break_from`, `break_to`, `closing`, `weekend`) VALUES
(1, 1, '6:00', '', '', '01:00', ''),
(2, 2, '', '', '', '', ''),
(3, 3, '', '', '', '', ''),
(4, 4, '', '', '', '', ''),
(5, 5, '', '', '', '', ''),
(6, 6, '', '', '', '', ''),
(7, 7, '', '', '', '', ''),
(8, 8, '', '', '', '', ''),
(9, 9, '6:00', '11:00', '12:00', '18:00', 'Friday'),
(10, 10, '', '', '', '', ''),
(11, 11, '', '', '', '', ''),
(12, 12, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(13, 13, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(14, 14, '6:00', '11:00', '12:00', '', 'Sunday'),
(15, 15, '6:00', '', '', '', 'Sunday'),
(16, 12, '6:00', '11:00', '12:00', '18:00', ''),
(17, 17, '6:00', '11:00', '12:00', '', 'Sunday'),
(18, 15, '6:00', '11:00', '', '18:00', 'Sunday'),
(19, 19, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(20, 20, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(21, 21, '6:00', '11:00', '12:00', '', 'Sunday'),
(22, 13, '6:00', '11:00', '12:00', '18:00', 'Sunday'),
(23, 15, '6:00', '11:00', '', '18:00', 'Sunday'),
(24, 24, '24h', '', '', '', ''),
(25, 1, '8:00', '', '', '22:00', '');

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

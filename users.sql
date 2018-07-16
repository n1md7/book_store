-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2018 at 04:20 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `birth_date` datetime NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `balance` float NOT NULL,
  `email` varchar(30) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `birth_date`, `registration_date`, `is_admin`, `balance`, `email`, `active`) VALUES
(2, 'nimda', 'c2f7652a724940b1e49b7fc79f03c822636dfb83', 'nimda', 'nimda', '1968-11-16 00:00:00', '2018-03-08 20:06:53', 1, 289.06, 'nimda@nimda.com', 1),
(3, 'monster', 'ABOqgdCV', 'Cleveland', 'Rehm', '2017-11-22 23:34:12', '2018-03-12 23:11:23', 0, 60, 'crehm2@macromedia.com', 0),
(4, 'mpiatti3', 'U1qoNixjG', 'Maxy', 'Piatti', '2017-09-12 21:04:42', '2018-03-12 23:11:23', 0, 15, 'mpiatti3@ifeng.com', 0),
(5, 'sfreear4', 'FtzC21nnd', 'Stephie', 'Freear', '2017-08-25 11:31:44', '2018-03-12 23:11:23', 0, 22, 'sfreear4@ameblo.jp', 0),
(6, 'gritmeier5', 'AxjCSP8', 'Gusta', 'Ritmeier', '2017-11-13 21:11:45', '2018-03-12 23:11:23', 0, 86, 'gritmeier5@tumblr.com', 0),
(7, 'tbrownsea6', 'u36FuoFT', 'Trescha', 'Brownsea', '2017-03-23 04:09:27', '2018-03-12 23:11:23', 0, 41, 'tbrownsea6@theguardian.com', 0),
(8, 'paickin7', 'PJ76994l7BEH', 'Phyllida', 'Aickin', '2017-12-02 11:46:48', '2018-03-12 23:11:23', 0, 92, 'paickin7@nhs.uk', 0),
(9, 'blody8', 'BejbMdK4g5SV', 'Britteny', 'Lody', '2017-07-12 07:43:20', '2018-03-12 23:11:23', 0, 86, 'blody8@jimdo.com', 1),
(10, 'msandiland9', 'KOisWxPhHC0', 'Mordecai', 'Sandiland', '2017-06-25 18:16:08', '2018-03-12 23:11:23', 0, 57, 'msandiland9@economist.com', 0),
(11, 'mkitea', '21dROdGSikcy', 'Melisandra', 'Kite', '2017-09-29 05:23:47', '2018-03-12 23:11:24', 0, 68, 'mkitea@yale.edu', 1),
(12, 'rtaskerb', 'zlTlkRd', 'Riley', 'Tasker', '2017-10-03 10:33:57', '2018-03-12 23:11:24', 0, 80, 'rtaskerb@sogou.com', 1),
(13, 'nranyardc', '2GBYjqF', 'Netti', 'Ranyard', '2017-08-12 07:19:37', '2018-03-12 23:11:24', 0, 32, 'nranyardc@odnoklassniki.ru', 1),
(14, 'rsteptowed', 'FSeayuX', 'Rosalinda', 'Steptowe', '2018-01-14 20:28:48', '2018-03-12 23:11:24', 0, 45, 'rsteptowed@google.fr', 1),
(15, 'vwabersiche', 'JavksOon', 'Veradis', 'Wabersich', '2017-06-18 14:44:13', '2018-03-12 23:11:24', 0, 97, 'vwabersiche@mlb.com', 1),
(16, 'ewildsf', 'mlMbX2UAuI', 'Ealasaid', 'Wilds', '2017-09-24 08:27:17', '2018-03-12 23:11:24', 0, 24, 'ewildsf@technorati.com', 1),
(17, 'myegoshing', 'G8lTZR4xGy', 'Morissa', 'Yegoshin', '2017-05-31 13:27:11', '2018-03-12 23:11:24', 0, 73, 'myegoshing@tinyurl.com', 1),
(18, 'rlodfordh', 'tMWJ95TWXB', 'Raff', 'Lodford', '2017-08-12 22:45:07', '2018-03-12 23:11:24', 0, 2, 'rlodfordh@naver.com', 1),
(19, 'ghalstedi', 'SbPZkiD', 'Georges', 'Halsted', '2018-03-02 20:21:01', '2018-03-12 23:11:24', 0, 9, 'ghalstedi@fc2.com', 1),
(20, 'ddelahayj', 'ST5S7Cel', 'Deloria', 'De La Hay', '2017-10-01 04:53:03', '2018-03-12 23:11:24', 0, 92, 'ddelahayj@engadget.com', 1),
(21, 'aossultonk', 'JhMdEiC2', 'Ame', 'Ossulton', '2017-11-27 17:09:35', '2018-03-12 23:11:24', 0, 28, 'aossultonk@discuz.net', 1),
(22, 'iimlinl', 'dv7vqUsi51ri', 'Inna', 'Imlin', '2017-08-17 03:18:19', '2018-03-12 23:11:24', 0, 58, 'iimlinl@ft.com', 1),
(23, 'jringsellm', 'jyhR9mQ', 'Jerrold', 'Ringsell', '2018-02-19 22:00:06', '2018-03-12 23:11:24', 0, 99, 'jringsellm@wix.com', 1),
(24, 'csweedyn', '4K5gqHBu2m', 'Carree', 'Sweedy', '2018-02-27 10:24:00', '2018-03-12 23:11:24', 0, 10, 'csweedyn@canalblog.com', 1),
(25, 'ftrimeo', 'JikY0tlHpr', 'Fergus', 'Trime', '2017-07-24 12:58:45', '2018-03-12 23:11:24', 0, 15, 'ftrimeo@usatoday.com', 1),
(26, 'dchallengerp', '3u1KMYbaVzd', 'Danella', 'Challenger', '2017-05-19 18:29:50', '2018-03-12 23:11:24', 0, 48, 'dchallengerp@mayoclinic.com', 1),
(27, 'dundrellq', '388df8M', 'Doralynne', 'Undrell', '2018-02-14 07:38:32', '2018-03-12 23:11:24', 0, 7, 'dundrellq@psu.edu', 1),
(28, 'scowwellr', '3RWfwpl', 'Simone', 'Cowwell', '2018-01-01 10:29:38', '2018-03-12 23:11:24', 0, 24, 'scowwellr@devhub.com', 1),
(29, 'rwhitnells', 'TKrNUIugZaV7', 'Russ', 'Whitnell', '2018-02-10 11:02:18', '2018-03-12 23:11:24', 0, 88, 'rwhitnells@spotify.com', 1),
(30, 'cclausnert', 'ds4iAZfHV', 'Chet', 'Clausner', '2017-09-30 10:21:23', '2018-03-12 23:11:24', 0, 17, 'cclausnert@salon.com', 1),
(31, 'candrysu', 'ubiJLlzvZjkd', 'Claudius', 'Andrys', '2017-09-14 04:09:58', '2018-03-12 23:11:24', 0, 27, 'candrysu@businessinsider.com', 1),
(32, 'ggrahlv', 'bMqN26tQQxiN', 'Gustaf', 'Grahl', '2017-07-02 14:19:39', '2018-03-12 23:11:24', 0, 49, 'ggrahlv@mysql.com', 1),
(33, 'gbarnabyw', 'EoTqTvQx', 'Gregory', 'Barnaby', '2018-01-28 00:14:57', '2018-03-12 23:11:25', 0, 74, 'gbarnabyw@discovery.com', 1),
(34, 'ccoomesx', 'Jq4bSggvm', 'Carmella', 'Coomes', '2017-04-18 19:49:49', '2018-03-12 23:11:25', 0, 51, 'ccoomesx@bbc.co.uk', 1),
(35, 'lmisky', 'sUncI6M', 'Lanie', 'Misk', '2017-03-12 04:24:10', '2018-03-12 23:11:25', 0, 27, 'lmisky@oracle.com', 1),
(36, 'crignoldz', 'oN9LTV6', 'Christa', 'Rignold', '2017-10-19 06:32:58', '2018-03-12 23:11:25', 0, 15, 'crignoldz@feedburner.com', 1),
(37, 'rjerram10', 'K6GTSwQN', 'Redford', 'Jerram', '2017-08-13 17:27:58', '2018-03-12 23:11:25', 0, 100, 'rjerram10@usatoday.com', 1),
(38, 'pbrowell11', 'ezpGfs88L4', 'Pansie', 'Browell', '2017-07-26 00:23:19', '2018-03-12 23:11:25', 0, 20, 'pbrowell11@privacy.gov.au', 1),
(39, 'wtonkes12', 'OsKzknP', 'Wilfred', 'Tonkes', '2017-11-14 00:27:44', '2018-03-12 23:11:25', 0, 49, 'wtonkes12@umn.edu', 1),
(40, 'abrammer13', 'NgKyqc', 'Abey', 'Brammer', '2018-03-04 03:25:46', '2018-03-12 23:11:25', 0, 48, 'abrammer13@dyndns.org', 0),
(41, 'igilardoni14', '81gehU3', 'Isidoro', 'Gilardoni', '2017-12-23 13:47:09', '2018-03-12 23:11:25', 0, 33, 'igilardoni14@mayoclinic.com', 1),
(42, 'mhaskins15', 'htFqaB', 'Morlee', 'Haskins', '2018-02-20 18:41:09', '2018-03-12 23:11:25', 0, 28, 'mhaskins15@360.cn', 1),
(43, 'rdicte16', 'iaobXLnn', 'Rachael', 'Dicte', '2017-07-28 07:58:20', '2018-03-12 23:11:25', 0, 85, 'rdicte16@angelfire.com', 1),
(44, 'sgiamitti17', 'Vqgnx1jTcd30', 'Sherm', 'Giamitti', '2017-08-08 04:04:38', '2018-03-12 23:11:25', 0, 81, 'sgiamitti17@indiatimes.com', 1),
(45, 'pdella18', '8drRizk9QgNT', 'Phyllis', 'Della', '2017-04-23 11:12:24', '2018-03-12 23:11:25', 0, 81, 'pdella18@hugedomains.com', 1),
(46, 'rquaif19', 'ebR4SR', 'Rosanne', 'Quaif', '2017-05-02 06:33:08', '2018-03-12 23:11:25', 0, 12, 'rquaif19@netlog.com', 1),
(47, 'eboshard1a', '5jcDiPO5quo', 'Erik', 'Boshard', '2017-07-15 01:59:18', '2018-03-12 23:11:25', 0, 46, 'eboshard1a@sciencedaily.com', 1),
(48, 'dspondley1b', 'eg0QQxG8f', 'Deanna', 'Spondley', '2017-03-14 05:16:27', '2018-03-12 23:11:25', 0, 91, 'dspondley1b@bloglines.com', 1),
(49, 'vtumulty1c', '6hJ4ldd', 'Veronica', 'Tumulty', '2017-12-15 17:42:58', '2018-03-12 23:11:25', 0, 36, 'vtumulty1c@jigsy.com', 1),
(50, 'gkestle1d', 'c50k0oCh1LJ', 'Gian', 'Kestle', '2018-03-01 04:10:08', '2018-03-12 23:11:25', 0, 67, 'gkestle1d@weibo.com', 1),
(51, 'bwesthofer1e', 'P8TlBxYBfI9', 'Binnie', 'Westhofer', '2017-03-23 13:28:48', '2018-03-12 23:11:25', 0, 79, 'bwesthofer1e@go.com', 1),
(52, 'kspratt1f', 'rbWK7RhGpczf', 'Korrie', 'Spratt', '2017-12-17 08:39:44', '2018-03-12 23:11:25', 0, 38, 'kspratt1f@cbc.ca', 1),
(53, 'eohagirtie1g', '5eUphJglt', 'Earl', 'O\'Hagirtie', '2017-12-13 01:06:21', '2018-03-12 23:11:25', 0, 25, 'eohagirtie1g@noaa.gov', 1),
(54, 'fbrantzen1h', 'c1WgHK', 'Finlay', 'Brantzen', '2017-07-05 22:49:37', '2018-03-12 23:11:25', 0, 72, 'fbrantzen1h@ustream.tv', 1),
(55, 'smathey1i', 'PNObI7daxgd', 'Shelbi', 'Mathey', '2017-10-02 19:58:10', '2018-03-12 23:11:26', 0, 100, 'smathey1i@nyu.edu', 1),
(56, 'efarmiloe1j', 'msQcfExV4tqn', 'Ellwood', 'Farmiloe', '2018-02-23 14:02:11', '2018-03-12 23:11:26', 0, 54, 'efarmiloe1j@arstechnica.com', 1),
(57, 'ldavy1k', 'cY2pyx', 'Larissa', 'Davy', '2018-02-18 16:16:52', '2018-03-12 23:11:26', 0, 95, 'ldavy1k@bizjournals.com', 1),
(58, 'mhammant1l', 'IkpXCMm26XYE', 'Milt', 'Hammant', '2017-12-22 06:32:16', '2018-03-12 23:11:26', 0, 51, 'mhammant1l@photobucket.com', 1),
(59, 'elyle1m', 'qeRjPB2V', 'Erin', 'Lyle', '2017-07-25 18:06:56', '2018-03-12 23:11:26', 0, 81, 'elyle1m@istockphoto.com', 1),
(60, 'mdugget1n', '163rqys5sLGH', 'Munmro', 'Dugget', '2017-04-27 10:49:46', '2018-03-12 23:11:26', 0, 35, 'mdugget1n@kickstarter.com', 1),
(61, 'aoxford1o', 'O4bOazL', 'Amelia', 'Oxford', '2017-05-07 22:20:12', '2018-03-12 23:11:26', 0, 87, 'aoxford1o@fastcompany.com', 1),
(62, 'jwinterbourne1p', 'ItpUHQ', 'Jerry', 'Winterbourne', '2017-04-22 07:32:47', '2018-03-12 23:11:26', 0, 84, 'jwinterbourne1p@shareasale.com', 1),
(63, 'mandriulis1q', 'BhkTipw', 'Myrta', 'Andriulis', '2017-07-08 01:38:25', '2018-03-12 23:11:26', 0, 59, 'mandriulis1q@t-online.de', 1),
(64, 'dburnhill1r', 'cs2kxw9d', 'Deanna', 'Burnhill', '2017-04-12 20:43:53', '2018-03-12 23:11:26', 0, 53, 'dburnhill1r@marketwatch.com', 1),
(65, 'mwolver1s', 'mL5fDaNjNWk', 'Melba', 'Wolver', '2017-12-30 01:40:22', '2018-03-12 23:11:26', 0, 70, 'mwolver1s@archive.org', 1),
(66, 'dstanlake1t', 'A6scvcr', 'Deonne', 'Stanlake', '2017-06-19 08:18:53', '2018-03-12 23:11:26', 0, 44, 'dstanlake1t@livejournal.com', 1),
(67, 'dbrandt1u', 'nSMNdfE', 'Darbie', 'Brandt', '2017-09-09 20:17:44', '2018-03-12 23:11:26', 0, 5, 'dbrandt1u@mtv.com', 1),
(68, 'cholburn1v', 'bEnW5SeOv4mF', 'Carmelita', 'Holburn', '2018-03-01 08:11:47', '2018-03-12 23:11:26', 0, 45, 'cholburn1v@yelp.com', 1),
(69, 'santrack1w', '2XdhLEgOH7r', 'Sanson', 'Antrack', '2017-12-14 10:40:01', '2018-03-12 23:11:26', 0, 11, 'santrack1w@istockphoto.com', 1),
(70, 'jladbrooke1x', 'zCgk5Y94', 'Junette', 'Ladbrooke', '2017-06-27 21:38:59', '2018-03-12 23:11:27', 0, 61, 'jladbrooke1x@sohu.com', 1),
(71, 'dfleming1y', 'nNEoQDH4IF', 'Dierdre', 'Fleming', '2017-03-15 11:45:07', '2018-03-12 23:11:27', 0, 99, 'dfleming1y@miitbeian.gov.cn', 1),
(72, 'tmcgarvie1z', 'YZljBO4', 'Tessie', 'McGarvie', '2017-03-26 00:45:43', '2018-03-12 23:11:27', 0, 45, 'tmcgarvie1z@cnn.com', 1),
(73, 'csach20', 'PSK5k9ac1', 'Conchita', 'Sach', '2017-04-30 22:15:05', '2018-03-12 23:11:27', 0, 97, 'csach20@reddit.com', 1),
(74, 'fscupham21', 'aiRVqC', 'Fred', 'Scupham', '2018-02-25 19:48:34', '2018-03-12 23:11:27', 0, 78, 'fscupham21@theatlantic.com', 1),
(75, 'natkin22', 'TAXWpotnpujg', 'Nola', 'Atkin', '2018-01-16 18:13:35', '2018-03-12 23:11:27', 0, 45, 'natkin22@foxnews.com', 1),
(76, 'hbeetham23', '1XLHZON', 'Hanny', 'Beetham', '2018-02-12 00:12:13', '2018-03-12 23:11:27', 0, 44, 'hbeetham23@dedecms.com', 1),
(77, 'mroobottom24', 'wZQmHYiEZUv1', 'Minette', 'Roobottom', '2017-07-08 12:54:10', '2018-03-12 23:11:27', 0, 35, 'mroobottom24@goo.gl', 1),
(78, 'eespine25', 'FxN8Er4MJ', 'Evyn', 'Espine', '2017-07-01 20:29:22', '2018-03-12 23:11:27', 0, 27, 'eespine25@home.pl', 1),
(79, 'rkeyho26', '0d4diNLT', 'Rockey', 'Keyho', '2017-10-10 21:50:44', '2018-03-12 23:11:27', 0, 96, 'rkeyho26@yolasite.com', 1),
(80, 'rscherme27', 'pZCVT4uv7X', 'Rubin', 'Scherme', '2017-07-23 09:40:13', '2018-03-12 23:11:27', 0, 72, 'rscherme27@mac.com', 1),
(81, 'tstorch28', 'GEvGT4', 'Tait', 'Storch', '2017-06-21 02:15:46', '2018-03-12 23:11:27', 0, 89, 'tstorch28@alibaba.com', 1),
(82, 'vpacker29', '1n16Iny', 'Viviene', 'Packer', '2017-08-10 21:02:10', '2018-03-12 23:11:27', 0, 58, 'vpacker29@sogou.com', 1),
(83, 'awardale2a', 'CZihQbLOK', 'Alicia', 'Wardale', '2017-04-04 15:10:55', '2018-03-12 23:11:27', 0, 78, 'awardale2a@feedburner.com', 1),
(84, 'alouthe2b', '45xD1NYenLd', 'Alwin', 'Louthe', '2017-10-09 05:51:48', '2018-03-12 23:11:27', 0, 10, 'alouthe2b@1und1.de', 1),
(85, 'jjagger2c', 'KRi5Dd', 'Jenna', 'Jagger', '2017-08-07 14:38:25', '2018-03-12 23:11:27', 0, 14, 'jjagger2c@sbwire.com', 1),
(86, 'wbury2d', 'rnzIs8l', 'Walker', 'Bury', '2018-01-22 03:45:28', '2018-03-12 23:11:27', 0, 74, 'wbury2d@studiopress.com', 1),
(87, 'ehonnan2e', 'YomqF13h', 'Eli', 'Honnan', '2017-06-14 00:56:13', '2018-03-12 23:11:27', 0, 89, 'ehonnan2e@oracle.com', 1),
(88, 'bcumber2f', 'Aan2QWdoTM', 'Bennie', 'Cumber', '2017-06-17 04:55:09', '2018-03-12 23:11:27', 0, 95, 'bcumber2f@squidoo.com', 1),
(89, 'cmcane2g', 'VbHtIb9sjzDd', 'Chrotoem', 'McAne', '2017-04-02 23:43:52', '2018-03-12 23:11:27', 0, 97, 'cmcane2g@naver.com', 1),
(90, 'aradeliffe2h', 'SamNaVfYGJoY', 'Alameda', 'Radeliffe', '2018-01-20 11:24:07', '2018-03-12 23:11:28', 0, 68, 'aradeliffe2h@123-reg.co.uk', 1),
(91, 'ecapper2i', 'IQRZleq1e', 'Elli', 'Capper', '2017-12-29 06:22:02', '2018-03-12 23:11:28', 0, 15, 'ecapper2i@example.com', 1),
(92, 'dcalvey2j', 'XKQE3cH0YNgP', 'Dael', 'Calvey', '2017-07-16 21:40:29', '2018-03-12 23:11:28', 0, 16, 'dcalvey2j@prnewswire.com', 1),
(93, 'tharte2k', 'v2aXPyQx', 'Tomasina', 'Harte', '2017-11-09 17:42:10', '2018-03-12 23:11:28', 0, 75, 'tharte2k@flickr.com', 1),
(94, 'cpurtell2l', 'MOtW2QQbXqLg', 'Cullie', 'Purtell', '2017-11-28 12:15:59', '2018-03-12 23:11:28', 0, 19, 'cpurtell2l@house.gov', 0),
(95, 'mpaule2m', 'KjNIx2oHm', 'Merle', 'Paule', '2017-06-20 03:14:54', '2018-03-12 23:11:28', 0, 16, 'mpaule2m@smh.com.au', 1),
(96, 'ggaskill2n', 'P2H8xkw2Y6j', 'Goldarina', 'Gaskill', '2018-02-11 04:55:57', '2018-03-12 23:11:28', 0, 90, 'ggaskill2n@disqus.com', 1),
(97, 'rmcewen2o', 'uG3X2U', 'Reinold', 'McEwen', '2017-03-15 14:39:21', '2018-03-12 23:11:28', 0, 3, 'rmcewen2o@hatena.ne.jp', 1),
(98, 'cagronski2p', 'fSd1tnm', 'Chance', 'Agronski', '2018-01-26 21:10:07', '2018-03-12 23:11:28', 0, 73, 'cagronski2p@psu.edu', 1),
(99, 'toluwatoyin2q', 'pui559F0UfRe', 'Teddy', 'Oluwatoyin', '2017-10-16 07:35:37', '2018-03-12 23:11:28', 0, 48, 'toluwatoyin2q@phpbb.com', 1),
(100, 'cwigzell2r', 'P2YdNJyTR', 'Concordia', 'Wigzell', '2017-07-23 16:45:18', '2018-03-12 23:11:28', 0, 16, 'cwigzell2r@ihg.com', 1),
(101, 'klkj', '5bd23325efbcce22a88babe2762789b560a48f70', 'asd', 'asd', '2018-12-31 00:00:00', '2018-03-15 16:26:13', 0, 0, 'lkjlkj@asd', 1),
(102, 'Denisalde', '516b6c4913f53bfaaccc5aef5b9e64d5d28b5a86', 'Denis', 'Ritche', '1951-07-28 00:00:00', '2018-03-15 16:31:07', 1, 0, 'denis@gail.com', 1),
(103, 'hello', '5bd23325efbcce22a88babe2762789b560a48f70', 'asd', 'asd', '2018-12-31 00:00:00', '2018-03-30 10:53:10', 0, 0, 'nimda@ads.asd', 1),
(104, 'rame', '7348c0388d9d025b3b4973eafb88c19eb22a8cf6', 'rame', 'rame', '2018-12-31 00:00:00', '2018-04-05 16:08:43', 0, 0.0300002, 'rame@rame.ge', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

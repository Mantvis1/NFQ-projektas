-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2019 at 07:29 PM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8746781_nfqprojectdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `haircutter`
--

CREATE TABLE `haircutter` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `haircutter`
--

INSERT INTO `haircutter` (`id`, `name`) VALUES
(10, 'Petras Karciauskas'),
(11, 'Ruta Gariene'),
(12, 'Giedrius Baneliauskas'),
(13, 'Lina Mikeliene'),
(14, 'Edita Kauciune');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `clientNameAndSurname` varchar(100) NOT NULL,
  `startDay` varchar(20) NOT NULL,
  `startTime` varchar(20) NOT NULL,
  `haircutterId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `clientNameAndSurname`, `startDay`, `startTime`, `haircutterId`) VALUES
(47, 'Judita  Sileviciene', '2019-02-19', '10:15', 11),
(48, 'Antanas  Gaurys', '2019-02-22', '12:45', 10),
(49, 'Hayden Newman', '2019-02-24', '17:15', 13),
(50, 'Timotis Aslevicius', '2019-02-25', '14:45', 14),
(51, 'Ben Kennedy', '2019-02-20', '12:30', 14),
(52, 'Scott Ross', '2019-02-21', '12:15', 10),
(53, 'Spencer Patel', '2019-02-24', '18:15', 12),
(54, 'Zaire Sykes', '2019-02-23', '11:15', 10),
(55, 'Ausrine Guduliene', '2019-02-23', '11:45', 13),
(56, 'Elijah Norman', '2019-02-21', '12:45', 10),
(57, 'Dax Mckay', '2019-02-24', '17:00', 13),
(58, 'Jonathon Wagner', '2019-02-25', '19:15', 13),
(59, 'Linas Pausys', '2019-02-21', '13:15', 10),
(60, 'Adonis Harding', '2019-02-20', '17:00', 10),
(61, 'Julia Day', '2019-02-23', '11:30', 10),
(62, 'Alisa Paukstine', '2019-02-20', '12:45', 13),
(63, 'Taliyah Carroll', '2019-02-23', '12:00', 14),
(64, 'Tomas Rainauskas', '2019-02-23', '14:00', 11),
(65, 'Aydan Stephens', '2019-02-21', '11:15', 12),
(66, 'Charles Pittman', '2019-02-19', '14:45', 12),
(67, 'Lukrecija Salmoneviciute', '2019-02-19', '11:45', 10),
(68, 'Millie Morris', '2019-02-19', '10:00', 10),
(69, 'Povilas Petraitis', '2019-02-24', '12:15', 14),
(70, 'Demi Price', '2019-02-19', '17:00', 10),
(71, 'Eva Summers', '2019-02-22', '11:45', 12),
(72, 'Kriste Sauleviciute', '2019-02-25', '10:15', 13),
(73, 'Cameron Murphy', '2019-02-23', '11:30', 14),
(74, 'Lynn Wilson', '2019-02-22', '12:00', 12),
(75, 'Aloizas Junkinys', '2019-02-22', '15:15', 12),
(76, 'Jaycob Duran', '2019-02-20', '11:45', 13),
(77, 'Hayden Black', '2019-02-19', '10:30', 11),
(78, 'Kassandra Rodriquez', '2019-02-19', '10:45', 10),
(79, 'Akvile Petraviciute', '2019-02-22', '14:30', 12),
(80, 'Leah Bennett', '2019-02-23', '11:00', 11),
(81, 'Lola Kaur', '2019-02-21', '19:30', 10),
(82, 'Kamile Kavaliauskaite', '2019-02-24', '10:00', 12),
(83, 'Andrew Henderson', '2019-02-22', '11:15', 13),
(84, 'Benas Kamsauskas', '2019-02-23', '10:00', 10),
(85, 'Makai Schultz', '2019-02-22', '16:00', 13),
(86, 'Emilia Gallagher', '2019-02-22', '10:00', 13),
(87, 'Erik Patterson', '2019-02-22', '11:15', 12),
(88, 'Domante Aleksandreviciute', '2019-02-21', '11:45', 12),
(89, 'Christopher Morris', '2019-02-19', '11:45', 11),
(90, 'Elijas Veturijus', '2019-02-22', '12:00', 11),
(91, 'Glen Shaw', '2019-02-22', '11:30', 11),
(92, 'Kristina Bulzite', '2019-02-21', '15:30', 10),
(93, 'Gabriele Kaskautaite', '2019-02-19', '12:00', 14),
(94, 'Ona Tapanaviciute', '2019-02-22', '12:15', 13),
(95, 'Justina Klevaite', '2019-02-19', '10:00', 12),
(96, 'Zita Zelbiene', '2019-02-20', '11:30', 14),
(97, 'Steff Rose', '2019-02-21', '11:00', 13),
(98, 'Stefanas Raitaliauskas', '2019-02-22', '10:00', 14);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `clientNameAndSurname` varchar(100) NOT NULL,
  `visitsCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `clientNameAndSurname`, `visitsCount`) VALUES
(19, 'Judita  Sileviciene', 6),
(20, 'Antanas  Gaurys', 2),
(21, 'Hayden Newman', 4),
(22, 'Timotis Aslevicius', 1),
(23, 'Ben Kennedy', 3),
(24, 'Scott Ross', 1),
(25, 'Spencer Patel', 14),
(26, 'Zaire Sykes', 1),
(27, 'Ausrine Guduliene', 12),
(28, 'Elijah Norman', 12),
(29, 'Dax Mckay', 1),
(30, 'Jonathon Wagner', 1),
(31, 'Linas Pausys', 1),
(32, 'Adonis Harding', 4),
(33, 'Julia Day', 5),
(34, 'Alisa Paukstine', 3),
(35, 'Taliyah Carroll', 1),
(36, 'Tomas Rainauskas', 1),
(37, 'Aydan Stephens', 1),
(38, 'Charles Pittman', 1),
(39, 'Lukrecija Salmoneviciute', 3),
(40, 'Millie Morris', 12),
(41, 'Povilas Petraitis', 1),
(42, 'Demi Price', 1),
(43, 'Eva Summers', 1),
(44, 'Kriste Sauleviciute', 1),
(45, 'Cameron Murphy', 6),
(46, 'Lynn Wilson', 1),
(47, 'Aloizas Junkinys', 6),
(48, 'Jaycob Duran', 1),
(49, 'Hayden Black', 1),
(50, 'Kassandra Rodriquez', 3),
(51, 'Akvile Petraviciute', 6),
(52, 'Leah Bennett', 1),
(53, 'Lola Kaur', 1),
(54, 'Kamile Kavaliauskaite', 5),
(55, 'Andrew Henderson', 1),
(56, 'Benas Kamsauskas', 22),
(57, 'Makai Schultz', 1),
(58, 'Emilia Gallagher', 1),
(59, 'Erik Patterson', 1),
(60, 'Domante Aleksandreviciute', 100),
(61, 'Christopher Morris', 1),
(62, 'Elijas Veturijus', 1),
(63, 'Glen Shaw', 6),
(64, 'Kristina Bulzite', 4),
(65, 'Gabriele Kaskautaite', 2),
(66, 'Ona Tapanaviciute', 1),
(67, 'Justina Klevaite', 1),
(68, 'Zita Zelbiene', 1),
(69, 'Steff Rose', 1),
(70, 'Stefanas Raitaliauskas', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `haircutter`
--
ALTER TABLE `haircutter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `haircutter`
--
ALTER TABLE `haircutter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

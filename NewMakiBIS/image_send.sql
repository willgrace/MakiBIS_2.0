-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2013 at 03:22 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `makibis`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `species_taxon_id` int(11) NOT NULL,
  `profile_image` binary(1) NOT NULL DEFAULT '0',
  `image_location` varchar(45) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `species_taxon_id`, `profile_image`, `image_location`) VALUES
(27, 1, '0', 'images/species/Alcedo_cyanopectus1.jpeg'),
(29, 1, '0', 'images/species/me1.jpg'),
(30, 1, '1', 'images/species/screenshot1.gif'),
(31, 1, '0', 'images/species/13142.jpg'),
(32, 1, '0', 'images/species/3rakdj5.jpg'),
(33, 25, '0', 'images/species/3rakdj8.jpg'),
(34, 25, '0', 'images/species/screenshot2.gif'),
(35, 25, '0', 'images/species/09.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

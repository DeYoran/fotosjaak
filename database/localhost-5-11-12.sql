-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 05 nov 2012 om 10:49
-- Serverversie: 5.5.24-log
-- PHP-versie: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `fotosjaak`
--
CREATE DATABASE `fotosjaak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fotosjaak`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logingegevens`
--

CREATE TABLE IF NOT EXISTS `logingegevens` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(12) NOT NULL,
  `userrole` enum('root','sjaak') NOT NULL,
  `activated` enum('yes','no') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `logingegevens`
--

INSERT INTO `logingegevens` (`ID`, `username`, `password`, `userrole`, `activated`) VALUES
(1, 'sjaak@yorie.nl', 'sjakie', 'sjaak', 'yes');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `first name` varchar(100) NOT NULL,
  `insertion` varchar(10) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address number` varchar(10) NOT NULL,
  `city` varchar(200) NOT NULL,
  `zip code` varchar(12) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `cellnumber` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

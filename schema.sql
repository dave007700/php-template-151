-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(120) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MovieID` int(11) NOT NULL,
  `FK_UserID` int(11) NOT NULL,
  `Titel` varchar(128) NOT NULL,
  `Content` varchar(512) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comments` (`ID`, `MovieID`, `FK_UserID`, `Titel`, `Content`, `Date`) VALUES
(1,	1,	2,	'Cool',	'Mega Cooool',	'2017-06-23 17:50:09'),
(2,	1,	2,	'Nice',	'I really really like this shit',	'2017-06-23 18:30:30');

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) NOT NULL,
  `Content` varchar(4096) DEFAULT NULL,
  `ReleaseDate` date NOT NULL,
  `TrailerURL` varchar(255) NOT NULL,
  `ImageURL` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `Tags` varchar(255) NOT NULL,
  `PG` int(11) NOT NULL DEFAULT '0',
  `FK_Category` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` int(11) NOT NULL,
  `RightLevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `stars`;
CREATE TABLE `stars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_Movie` int(11) NOT NULL,
  `FK_User` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(120) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `EMail` varchar(120) NOT NULL,
  `IsActivated` tinyint(4) NOT NULL DEFAULT '0',
  `Securitykey` varchar(120) NOT NULL,
  `Resetkey` varchar(120) NOT NULL,
  `FK_Rights` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-06-23 19:01:54

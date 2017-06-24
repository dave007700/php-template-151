-- Adminer 4.2.5 MySQL dump

USE filmreviewdb;

-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MovieID` int(11) NOT NULL,
  `FK_UserID` int(11) NOT NULL,
  `Titel` varchar(128) NOT NULL,
  `Content` varchar(512) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsDisplayed` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `FK_UserID` (`FK_UserID`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`FK_UserID`) REFERENCES `user` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comments` (`ID`, `MovieID`, `FK_UserID`, `Titel`, `Content`, `Date`, `IsDisplayed`) VALUES
(13,	1,	8,	'dsaf',	'sadf',	'2017-06-23 20:31:04',	0),
(14,	1,	8,	'dave',	'test',	'2017-06-23 21:09:34',	1),
(15,	3,	8,	'The Sound',	'Das isch music',	'2017-06-24 06:38:11',	1),
(16,	3,	8,	'adsf',	'asdf',	'2017-06-24 06:38:34',	1),
(17,	3,	8,	'<a href=',	'aasdf',	'2017-06-24 06:40:02',	0),
(18,	1,	9,	'Bewertung',	'Die Dame in diesem Film hat ein schönes Becken :D',	'2017-06-24 11:36:41',	0),
(19,	13,	8,	'funny',	'LOL',	'2017-06-24 17:38:38',	0);

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) NOT NULL,
  `Content` varchar(4096) DEFAULT NULL,
  `ReleaseDate` date NOT NULL,
  `TrailerURL` varchar(255) NOT NULL,
  `HasImage` tinyint(4) NOT NULL DEFAULT '0',
  `Tags` varchar(255) NOT NULL,
  `PG` int(11) NOT NULL DEFAULT '0',
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


-- 2017-06-24 18:22:03

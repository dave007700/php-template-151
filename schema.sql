-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `app`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `anzeigename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `email`, `password`, `anzeigename`) VALUES
(1,	'patrick.nibbia@gmail.com',	'1234',	NULL),
(13,	'red@d.ch',	'$2y$10$CJ9oMp7wkAVtxJbBs.nwle8nw6lkYWYUq5CM6UYrokFGnTkD870Su',	'red'),
(31,	'root@root.com',	'$2y$10$1INS6GtaBU4dAeaf9SbuU.fL.NGGWFXmZrO4hUQAUL8D7iOkcWAYi',	'root');

-- 2017-06-08 08:34:11

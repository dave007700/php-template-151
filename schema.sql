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
  `FK_User` int(11) NOT NULL,
  `Content` varchar(512) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) NOT NULL,
  `Content` varchar(4096) DEFAULT NULL,
  `ReleaseDate` date NOT NULL,
  `TrailerURL` varchar(255) NOT NULL,
  `BackGroundImgURL` varchar(255) NOT NULL,
  `Tags` varchar(255) NOT NULL,
  `PG` int(11) NOT NULL DEFAULT '0',
  `FK_Category` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `movie` (`ID`, `Name`, `Content`, `ReleaseDate`, `TrailerURL`, `BackGroundImgURL`, `Tags`, `PG`, `FK_Category`) VALUES
(1,	'X-Men',	'Seit Anbeginn der Menschheit wurde er als Gott verehrt: Apocalypse, der erste und mächtigste Mutant des Marvel X-Men Universums, vereint die Kräfte vieler verschiedener Mutanten und ist dadurch unsterblich und unbesiegbar. Nachdem Apocalypse nach tausenden von Jahren erwacht, ist er desillusioniert von der Entwicklung der Welt und rekrutiert ein Team von mächtigen Mutanten - unter ihnen der entmutigte Magneto - um die Menschheit zu reinigen, eine neue Weltordnung zu erschaffen und über alles zu herrschen. Als das Schicksal der Erde in der Schwebe ist, muss Raven mit Hilfe von Prof. X ein Team junger Mutanten anführen, um ihren größten Erzfeind aufzuhalten und die Auslöschung der Menschheit zu verhindern.',	'2017-06-20',	'Jer8XjMrUB4',	'xmen_apocalypse_ver18_xxlg.jpg',	'Filmtitel 2016; US-amerikanischer FilmScience-Fiction-Film; Actionfilm; Comicverfilmung; 3D-Film;',	0,	4),
(2,	'Warcraft',	'In Azeroth, dem Reich der Menschen, herrscht seit vielen Jahren Frieden. Doch urplötzlich sieht sich seine Zivilisation von einer furchteinflößenden Rasse bedroht: Ork-Krieger haben ihre, dem Untergang geweihte, Heimat Draenor verlassen, um sich andernorts eine neue aufzubauen. Als sich ein Portal öffnet, um die beiden Welten miteinander zu verbinden, bricht ein unbarmherziger und erbitterter Krieg um die Vorherrschaft in Azeroth los, der auf beiden Seiten große Opfer fordert. Die vermeintlichen Gegner ahnen jedoch nicht, dass bald schon eine weitere Bedrohung auftaucht, die beide Völker vernichten könnte. Statt sich zu bekämpfen, müssen sie nun zusammenhalten. Ein Bündnis wird geschlossen und zwei Helden, ein Mensch und ein Ork, machen sich gemeinsam auf den Weg, dem Bösen im Kampf entgegenzutreten - für ihre Familien, ihre Völker und ihre Heimat.',	'2017-06-20',	'RhFMIRuHAL4',	'warcraft.jpg',	'',	0,	0),
(3,	'The Dark Knight',	'Batman und der Polizist Jim Gordon beginnen mit zunehmendem Erfolg, das Verbrechen in Gotham City zu bekämpfen, und bringen unter anderem den aus Batman Begins bekannten Schurken Scarecrow hinter Gitter, als plötzlich ein geheimnisvoller Krimineller erscheint, nur bekannt als Joker. Der geschminkte Psychopath, dessen Mundwinkel durch Narben an den Seiten seines Mundes zu einer Art bizarrem „Dauergrinsen“ verzogen sind, hatte zuvor schon durch einen brutalen Banküberfall auf sich aufmerksam gemacht. Batman und Lieutenant Gordon beschließen, den beliebten neuen Bezirksstaatsanwalt Harvey Dent, den Hoffnungsträger der Bevölkerung von Gotham, in ihren Kampf gegen das organisierte Verbrechen einzubinden. Dent ist mittlerweile mit Bruce Waynes Jugendliebe Rachel Dawes liiert.  Die Mafiabosse von Gotham unter der Führung von Salvatore Maroni geraten derweil immer mehr in Bedrängnis. Sie treffen ein Abkommen mit dem chinesischen Gangsterboss Yinglain Lau, der ihr Geld in Sicherheit bringen soll. Während einer geheimen Sitzung informiert Lau sie, dass er das gesamte Vermögen der Bosse konfisziert hat und nun bereits auf dem Rückweg nach Hongkong ist. Zur Überraschung aller Anwesenden stürmt der geheimnisvolle Joker in die Sitzung und prophezeit ihnen, dass Batman Lau, der mit seinen Klienten ein falsches Spiel treibt, überallhin folgen und zum Reden bringen wird. Dann macht er ihnen das Angebot, Batman gegen 50 Prozent ihres gesamten Vermögens zu töten. ',	'2017-06-20',	'_64S_ixM5Ng',	'the_dark_knight_movie_poster.jpg',	'',	0,	0);

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
  `FK_Rights` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`ID`, `Username`, `Password`, `EMail`, `FK_Rights`) VALUES
(2,	'dave',	'd',	'd@d.d',	2);

DROP TABLE IF EXISTS `votecomments`;
CREATE TABLE `votecomments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_User` int(11) NOT NULL,
  `FK_Comment` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-06-20 21:17:55

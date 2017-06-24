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
  `IsDisplayed` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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

INSERT INTO `movie` (`ID`, `Name`, `Content`, `ReleaseDate`, `TrailerURL`, `ImageURL`, `Tags`, `PG`, `FK_Category`) VALUES
(1,	'X-Men',	'Seit Anbeginn der Menschheit wurde er als Gott verehrt: Apocalypse, der erste und mächtigste Mutant des Marvel X-Men Universums, vereint die Kräfte vieler verschiedener Mutanten und ist dadurch unsterblich und unbesiegbar. Nachdem Apocalypse nach tausenden von Jahren erwacht, ist er desillusioniert von der Entwicklung der Welt und rekrutiert ein Team von mächtigen Mutanten - unter ihnen der entmutigte Magneto - um die Menschheit zu reinigen, eine neue Weltordnung zu erschaffen und über alles zu herrschen. Als das Schicksal der Erde in der Schwebe ist, muss Raven mit Hilfe von Prof. X ein Team junger Mutanten anführen, um ihren größten Erzfeind aufzuhalten und die Auslöschung der Menschheit zu verhindern.',	'2016-05-09',	'Jer8XjMrUB4',	'1.jpg',	'Filmtitel 2016; US-amerikanischer FilmScience-Fiction-Film; Actionfilm; Comicverfilmung; 3D-Film;',	0,	4),
(2,	'Warcraft',	'In Azeroth, dem Reich der Menschen, herrscht seit vielen Jahren Frieden. Doch urplötzlich sieht sich seine Zivilisation von einer furchteinflößenden Rasse bedroht: Ork-Krieger haben ihre, dem Untergang geweihte, Heimat Draenor verlassen, um sich andernorts eine neue aufzubauen. Als sich ein Portal öffnet, um die beiden Welten miteinander zu verbinden, bricht ein unbarmherziger und erbitterter Krieg um die Vorherrschaft in Azeroth los, der auf beiden Seiten große Opfer fordert. Die vermeintlichen Gegner ahnen jedoch nicht, dass bald schon eine weitere Bedrohung auftaucht, die beide Völker vernichten könnte. Statt sich zu bekämpfen, müssen sie nun zusammenhalten. Ein Bündnis wird geschlossen und zwei Helden, ein Mensch und ein Ork, machen sich gemeinsam auf den Weg, dem Bösen im Kampf entgegenzutreten - für ihre Familien, ihre Völker und ihre Heimat.',	'2016-05-24',	'RhFMIRuHAL4',	'2.jpg',	'',	0,	0),
(3,	'The Dark Knight',	'Batman und der Polizist Jim Gordon beginnen mit zunehmendem Erfolg, das Verbrechen in Gotham City zu bekämpfen, und bringen unter anderem den aus Batman Begins bekannten Schurken Scarecrow hinter Gitter, als plötzlich ein geheimnisvoller Krimineller erscheint, nur bekannt als Joker. Der geschminkte Psychopath, dessen Mundwinkel durch Narben an den Seiten seines Mundes zu einer Art bizarrem „Dauergrinsen“ verzogen sind, hatte zuvor schon durch einen brutalen Banküberfall auf sich aufmerksam gemacht. Batman und Lieutenant Gordon beschließen, den beliebten neuen Bezirksstaatsanwalt Harvey Dent, den Hoffnungsträger der Bevölkerung von Gotham, in ihren Kampf gegen das organisierte Verbrechen einzubinden. Dent ist mittlerweile mit Bruce Waynes Jugendliebe Rachel Dawes liiert.  Die Mafiabosse von Gotham unter der Führung von Salvatore Maroni geraten derweil immer mehr in Bedrängnis. Sie treffen ein Abkommen mit dem chinesischen Gangsterboss Yinglain Lau, der ihr Geld in Sicherheit bringen soll. Während einer geheimen Sitzung informiert Lau sie, dass er das gesamte Vermögen der Bosse konfisziert hat und nun bereits auf dem Rückweg nach Hongkong ist. Zur Überraschung aller Anwesenden stürmt der geheimnisvolle Joker in die Sitzung und prophezeit ihnen, dass Batman Lau, der mit seinen Klienten ein falsches Spiel treibt, überallhin folgen und zum Reden bringen wird. Dann macht er ihnen das Angebot, Batman gegen 50 Prozent ihres gesamten Vermögens zu töten. ',	'2008-06-18',	'_64S_ixM5Ng',	'3.jpg',	'',	0,	0),
(11,	'Advangers',	'In einer geheimen Forschungsanlage mit dem Namen Projekt Pegasus arbeitet die Organisation S.H.I.E.L.D. daran, den Tesserakt (siehe Captain America: The First Avenger) als eine unerschöpfliche Energiequelle einzusetzen. Allerdings ist der aus Asgard stammende Würfel auch ein interdimensionaler Portalöffner, und eine außerirdische Macht, die Chitauri, will damit die Erde erobern. Zu diesem Zweck haben sie ein Bündnis mit dem Asen Loki geschlossen, der die Geheimnisse des Würfels kennt (siehe Thor). Mit seinem Zepter öffnet Loki durch den Tesserakt ein Portal im Inneren von Projekt Pegasus, dringt in die Anlage ein und bringt nach kurzem Kampf einige Mitarbeiter des Projekts um Dr. Selvig und den S.H.I.E.L.D.-Spezialagenten Clint Barton (Hawkeye) durch Gedankenkontrolle in seine Gewalt. Mit deren Hilfe nimmt er den Tesserakt an sich und flüchtet aus der Anlage, die daraufhin durch das instabil gewordene Portal komplett zerstört wird. Mithilfe seiner Agenten Phil Coulson und Black Widow rekrutiert Nick Fury, Leiter von S.H.I.E.L.D., einige Superhelden, die ihm bei der Wiederbeschaffung des Tesserakts helfen sollen: den brillanten Erfinder Tony Stark und den Experten für Gammastrahlung Dr. Bruce Banner. Zusammen mit Captain America versuchen sie in der Zentrale von S.H.I.E.L.D., einem flugfähigen Flugzeugträger namens Helicarrier, eine Spur des Tesserakts zu finden, der eine schwache Gammastrahlensignatur aussendet. Kurze Zeit später taucht Loki zusammen mit Hawkeye in Stuttgart auf, um eine Probe Iridium zu stehlen. Die Superhelden stellen Loki, der sich überraschend schnell ergibt, und machen sich auf zum Helicarrier. Unterwegs fängt Thor sie ab, der auf die Erde gekommen ist, um Loki und den Tesserakt nach Asgard zurückzuholen. Nach einem kurzen Schlagabtausch mit Iron Man bezüglich der Verantwortung über Loki schließt Thor sich den Superhelden an. Auf dem Helicarrier angekommen, wird Loki in eine Spezialgefängniszelle eingesperrt, doch er weigert sich, Informationen preiszugeben. Stark und Banner erkennen jedoch, dass Loki den Tesserakt zum Schaffen eines Portals benutzen will. Das gestohlene Iridium soll als Stabilisator dienen, damit das Portal nicht so instabil wird wie bei Projekt Pegasus.',	'2017-06-24',	'',	'11.jpg',	'',	0,	0);

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


-- 2017-06-24 06:27:19

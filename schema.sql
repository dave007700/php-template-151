-- Adminer 4.2.5 MySQL dump

USE filmreviewdb;

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comments` (`ID`, `MovieID`, `FK_UserID`, `Titel`, `Content`, `Date`, `IsDisplayed`) VALUES
(13,	1,	8,	'dsaf',	'sadf',	'2017-06-23 20:31:04',	0),
(14,	1,	8,	'dave',	'test',	'2017-06-23 21:09:34',	1),
(15,	3,	8,	'<a href=\"http://www.youporn.com\" />',	'Das isch music',	'2017-06-24 06:38:11',	0),
(16,	3,	8,	'adsf',	'asdf',	'2017-06-24 06:38:34',	1),
(17,	3,	8,	'<a href=',	'aasdf',	'2017-06-24 06:40:02',	0),
(18,	1,	9,	'Bewertung',	'Die Dame in diesem Film hat ein schönes Becken :D',	'2017-06-24 11:36:41',	0);

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

INSERT INTO `movie` (`ID`, `Name`, `Content`, `ReleaseDate`, `TrailerURL`, `HasImage`, `Tags`, `PG`) VALUES
(1,	'X-Men',	'Seit Anbeginn der Menschheit wurde er als Gott verehrt: Apocalypse, der erste und mächtigste Mutant des Marvel X-Men Universums, vereint die Kräfte vieler verschiedener Mutanten und ist dadurch unsterblich und unbesiegbar. Nachdem Apocalypse nach tausenden von Jahren erwacht, ist er desillusioniert von der Entwicklung der Welt und rekrutiert ein Team von mächtigen Mutanten - unter ihnen der entmutigte Magneto - um die Menschheit zu reinigen, eine neue Weltordnung zu erschaffen und über alles zu herrschen. Als das Schicksal der Erde in der Schwebe ist, muss Raven mit Hilfe von Prof. X ein Team junger Mutanten anführen, um ihren größten Erzfeind aufzuhalten und die Auslöschung der Menschheit zu verhindern.',	'2016-05-09',	'Jer8XjMrUB4',	1,	'Filmtitel 2016; US-amerikanischer FilmScience-Fiction-Film; Actionfilm; Comicverfilmung; 3D-Film;',	0),
(2,	'Warcraft',	'In Azeroth, dem Reich der Menschen, herrscht seit vielen Jahren Frieden. Doch urplötzlich sieht sich seine Zivilisation von einer furchteinflößenden Rasse bedroht: Ork-Krieger haben ihre, dem Untergang geweihte, Heimat Draenor verlassen, um sich andernorts eine neue aufzubauen. Als sich ein Portal öffnet, um die beiden Welten miteinander zu verbinden, bricht ein unbarmherziger und erbitterter Krieg um die Vorherrschaft in Azeroth los, der auf beiden Seiten große Opfer fordert. Die vermeintlichen Gegner ahnen jedoch nicht, dass bald schon eine weitere Bedrohung auftaucht, die beide Völker vernichten könnte. Statt sich zu bekämpfen, müssen sie nun zusammenhalten. Ein Bündnis wird geschlossen und zwei Helden, ein Mensch und ein Ork, machen sich gemeinsam auf den Weg, dem Bösen im Kampf entgegenzutreten - für ihre Familien, ihre Völker und ihre Heimat.',	'2016-05-24',	'RhFMIRuHAL4',	1,	'',	0),
(3,	'The Dark Knight',	'Batman und der Polizist Jim Gordon beginnen mit zunehmendem Erfolg, das Verbrechen in Gotham City zu bekämpfen, und bringen unter anderem den aus Batman Begins bekannten Schurken Scarecrow hinter Gitter, als plötzlich ein geheimnisvoller Krimineller erscheint, nur bekannt als Joker. Der geschminkte Psychopath, dessen Mundwinkel durch Narben an den Seiten seines Mundes zu einer Art bizarrem „Dauergrinsen“ verzogen sind, hatte zuvor schon durch einen brutalen Banküberfall auf sich aufmerksam gemacht. Batman und Lieutenant Gordon beschließen, den beliebten neuen Bezirksstaatsanwalt Harvey Dent, den Hoffnungsträger der Bevölkerung von Gotham, in ihren Kampf gegen das organisierte Verbrechen einzubinden. Dent ist mittlerweile mit Bruce Waynes Jugendliebe Rachel Dawes liiert.  Die Mafiabosse von Gotham unter der Führung von Salvatore Maroni geraten derweil immer mehr in Bedrängnis. Sie treffen ein Abkommen mit dem chinesischen Gangsterboss Yinglain Lau, der ihr Geld in Sicherheit bringen soll. Während einer geheimen Sitzung informiert Lau sie, dass er das gesamte Vermögen der Bosse konfisziert hat und nun bereits auf dem Rückweg nach Hongkong ist. Zur Überraschung aller Anwesenden stürmt der geheimnisvolle Joker in die Sitzung und prophezeit ihnen, dass Batman Lau, der mit seinen Klienten ein falsches Spiel treibt, überallhin folgen und zum Reden bringen wird. Dann macht er ihnen das Angebot, Batman gegen 50 Prozent ihres gesamten Vermögens zu töten. ',	'2008-06-18',	'_64S_ixM5Ng',	1,	'',	0),
(11,	'Advangers',	'In einer geheimen Forschungsanlage mit dem Namen Projekt Pegasus arbeitet die Organisation S.H.I.E.L.D. daran, den Tesserakt (siehe Captain America: The First Avenger) als eine unerschöpfliche Energiequelle einzusetzen. Allerdings ist der aus Asgard stammende Würfel auch ein interdimensionaler Portalöffner, und eine außerirdische Macht, die Chitauri, will damit die Erde erobern. Zu diesem Zweck haben sie ein Bündnis mit dem Asen Loki geschlossen, der die Geheimnisse des Würfels kennt (siehe Thor). Mit seinem Zepter öffnet Loki durch den Tesserakt ein Portal im Inneren von Projekt Pegasus, dringt in die Anlage ein und bringt nach kurzem Kampf einige Mitarbeiter des Projekts um Dr. Selvig und den S.H.I.E.L.D.-Spezialagenten Clint Barton (Hawkeye) durch Gedankenkontrolle in seine Gewalt. Mit deren Hilfe nimmt er den Tesserakt an sich und flüchtet aus der Anlage, die daraufhin durch das instabil gewordene Portal komplett zerstört wird. Mithilfe seiner Agenten Phil Coulson und Black Widow rekrutiert Nick Fury, Leiter von S.H.I.E.L.D., einige Superhelden, die ihm bei der Wiederbeschaffung des Tesserakts helfen sollen: den brillanten Erfinder Tony Stark und den Experten für Gammastrahlung Dr. Bruce Banner. Zusammen mit Captain America versuchen sie in der Zentrale von S.H.I.E.L.D., einem flugfähigen Flugzeugträger namens Helicarrier, eine Spur des Tesserakts zu finden, der eine schwache Gammastrahlensignatur aussendet. Kurze Zeit später taucht Loki zusammen mit Hawkeye in Stuttgart auf, um eine Probe Iridium zu stehlen. Die Superhelden stellen Loki, der sich überraschend schnell ergibt, und machen sich auf zum Helicarrier. Unterwegs fängt Thor sie ab, der auf die Erde gekommen ist, um Loki und den Tesserakt nach Asgard zurückzuholen. Nach einem kurzen Schlagabtausch mit Iron Man bezüglich der Verantwortung über Loki schließt Thor sich den Superhelden an. Auf dem Helicarrier angekommen, wird Loki in eine Spezialgefängniszelle eingesperrt, doch er weigert sich, Informationen preiszugeben. Stark und Banner erkennen jedoch, dass Loki den Tesserakt zum Schaffen eines Portals benutzen will. Das gestohlene Iridium soll als Stabilisator dienen, damit das Portal nicht so instabil wird wie bei Projekt Pegasus.',	'2017-06-24',	'eOrNdBpGMv8',	1,	'',	3),
(13,	'The Magnificent Seven',	'In dieser Neuauflage des Westernklassiker \"Die Glorreichen Sieben\" wird eine Kleinstadt von einem brutalen Minenbesitzer und seiner Bande tyrannisiert. Als dabei auch Menschen getötet werden, heuert eine junge Witwe einen Kopfgeldjäger an, der mit Hilfe von sechs weiteren Revolverhelden die bösen Jungs vertreiben soll.',	'2017-06-24',	'deSRpSn8Pyk',	1,	'',	0);

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

INSERT INTO `user` (`ID`, `Username`, `Password`, `EMail`, `IsActivated`, `Securitykey`, `Resetkey`, `FK_Rights`) VALUES
(8,	'dave',	'$2y$10$.0ibXZ4H8JSkwccSkL46L..msL3.5EmIOlZPzFXv4Kh17AJQv3k0O',	'dave007700@gmail.com',	2,	'1c716e97d899348bb2782c06ba188b7f2b9d8d90',	'291c319a914d58767ac1d652dff0135862d407a73d5ffa123484f1360613',	2),
(9,	'SirMorsel',	'$2y$10$OriusVDP8hYrGtc73ockruktprZUw6bAU2eXTt0rJRajm.VTwN.h6',	'patrick.nibbia@gmail.com',	2,	'07bcce99ead21d9daa71021ffa53aa22b2a61fbbbeef2f91413a0e92b441',	'',	1);

-- 2017-06-24 14:01:24

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank Struktur für kampfsportschule
CREATE DATABASE IF NOT EXISTS `kampfsportschule` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `kampfsportschule`;

-- Exportiere Struktur von Tabelle kampfsportschule.erfahrung
CREATE TABLE IF NOT EXISTS `erfahrung` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Erhaltungsdatum` date NOT NULL,
  `Personen_ID` int(11) NOT NULL,
  `Stil_ID` int(11) NOT NULL,
  `Guertel_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_erfahrung_person` (`Personen_ID`),
  KEY `FK_erfahrung_stil` (`Stil_ID`),
  KEY `FK_erfahrung_guertel` (`Guertel_ID`),
  CONSTRAINT `FK_erfahrung_guertel` FOREIGN KEY (`Guertel_ID`) REFERENCES `guertel` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_erfahrung_person` FOREIGN KEY (`Personen_ID`) REFERENCES `person` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_erfahrung_stil` FOREIGN KEY (`Stil_ID`) REFERENCES `stil` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.erfahrung: ~3 rows (ungefähr)
/*!40000 ALTER TABLE `erfahrung` DISABLE KEYS */;
INSERT INTO `erfahrung` (`ID`, `Erhaltungsdatum`, `Personen_ID`, `Stil_ID`, `Guertel_ID`) VALUES
	(3, '2011-05-06', 1, 1, 2),
	(4, '2022-01-27', 3, 4, 3),
	(6, '2022-01-02', 2, 3, 2),
	(7, '2021-03-03', 1, 3, 5);
/*!40000 ALTER TABLE `erfahrung` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.examen
CREATE TABLE IF NOT EXISTS `examen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `exambezeichnung_ID` int(11) NOT NULL,
  `Zeitpunkt` datetime NOT NULL,
  `Länge` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_examen_examen_bezeichnung` (`exambezeichnung_ID`),
  CONSTRAINT `FK_examen_examen_bezeichnung` FOREIGN KEY (`exambezeichnung_ID`) REFERENCES `examen_bezeichnung` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.examen: ~7 rows (ungefähr)
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
INSERT INTO `examen` (`ID`, `exambezeichnung_ID`, `Zeitpunkt`, `Länge`) VALUES
	(14, 22, '2022-02-02 09:00:00', 3),
	(16, 24, '2022-02-02 09:00:00', 3),
	(62, 24, '2022-02-02 09:15:00', 3),
	(63, 22, '2022-02-02 09:15:00', 3),
	(64, 22, '2022-02-03 09:15:00', 3),
	(65, 37, '2022-02-03 09:15:00', 3),
	(66, 38, '2022-03-15 11:15:00', 4);
/*!40000 ALTER TABLE `examen` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.examen_bezeichnung
CREATE TABLE IF NOT EXISTS `examen_bezeichnung` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Examenbezeichnung` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.examen_bezeichnung: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `examen_bezeichnung` DISABLE KEYS */;
INSERT INTO `examen_bezeichnung` (`ID`, `Examenbezeichnung`) VALUES
	(22, 'Erstehilfekurs'),
	(24, 'Karate'),
	(37, 'Judo'),
	(38, 'Kickboxen');
/*!40000 ALTER TABLE `examen_bezeichnung` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.guertel
CREATE TABLE IF NOT EXISTS `guertel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Farbe` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.guertel: ~6 rows (ungefähr)
/*!40000 ALTER TABLE `guertel` DISABLE KEYS */;
INSERT INTO `guertel` (`ID`, `Farbe`) VALUES
	(1, 'Weiß'),
	(2, 'Gelb'),
	(3, 'Blau'),
	(4, 'Gruen'),
	(5, 'Braun'),
	(6, 'Schwarz');
/*!40000 ALTER TABLE `guertel` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.person
CREATE TABLE IF NOT EXISTS `person` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vorname` varchar(50) NOT NULL,
  `Nachname` varchar(50) NOT NULL,
  `Geburtstag` date NOT NULL,
  `EMail` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.person: ~7 rows (ungefähr)
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` (`ID`, `Vorname`, `Nachname`, `Geburtstag`, `EMail`) VALUES
	(1, 'Bente', 'Kalvelage', '1999-11-06', 'test@email.com'),
	(2, 'Thomas', 'Lechner', '2010-01-27', 'testmail@mustermann.de'),
	(3, 'Christian', 'Gausmann', '2012-12-01', 'mustermann@testmail.net'),
	(19, 'Max', 'Mustermann', '1990-05-16', 'mustermann@email.com'),
	(20, 'Ute', 'Mustermann', '1990-05-16', 'musterute@email.com'),
	(21, 'Max', 'Mustermann', '1990-05-16', 'mustermax@email.com'),
	(22, 'Max', 'Mustermann', '1990-05-16', 'musterralf@email.com');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.personen_examen
CREATE TABLE IF NOT EXISTS `personen_examen` (
  `personen_ID` int(11) NOT NULL,
  `examen_ID` int(11) NOT NULL,
  KEY `FK_personen_examen_person` (`personen_ID`),
  KEY `FK_personen_examen_examen` (`examen_ID`),
  CONSTRAINT `FK_personen_examen_examen` FOREIGN KEY (`examen_ID`) REFERENCES `examen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_personen_examen_person` FOREIGN KEY (`personen_ID`) REFERENCES `person` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.personen_examen: ~7 rows (ungefähr)
/*!40000 ALTER TABLE `personen_examen` DISABLE KEYS */;
INSERT INTO `personen_examen` (`personen_ID`, `examen_ID`) VALUES
	(1, 14),
	(1, 16),
	(1, 62),
	(1, 63),
	(3, 64),
	(3, 65),
	(1, 66);
/*!40000 ALTER TABLE `personen_examen` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.stil
CREATE TABLE IF NOT EXISTS `stil` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stilbezeichnung` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.stil: ~5 rows (ungefähr)
/*!40000 ALTER TABLE `stil` DISABLE KEYS */;
INSERT INTO `stil` (`ID`, `Stilbezeichnung`) VALUES
	(1, 'Karate'),
	(2, 'Judo'),
	(3, 'Krav Maga'),
	(4, 'Kickboxen'),
	(5, 'Boxen');
/*!40000 ALTER TABLE `stil` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle kampfsportschule.training
CREATE TABLE IF NOT EXISTS `training` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Personen_ID` int(11) NOT NULL,
  `Zeit` datetime NOT NULL,
  `Start/Stop` char(50) NOT NULL COMMENT 'Ja/Nein',
  `Stil_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_training_person` (`Personen_ID`),
  KEY `FK_training_stil` (`Stil_ID`),
  CONSTRAINT `FK_training_person` FOREIGN KEY (`Personen_ID`) REFERENCES `person` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_training_stil` FOREIGN KEY (`Stil_ID`) REFERENCES `stil` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle kampfsportschule.training: ~15 rows (ungefähr)
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
INSERT INTO `training` (`ID`, `Personen_ID`, `Zeit`, `Start/Stop`, `Stil_ID`) VALUES
	(2, 1, '2022-02-03 12:26:01', 'Start', 1),
	(3, 2, '1660-02-03 12:26:01', 'Start', 1),
	(4, 2, '1665-02-03 12:26:01', 'Start', 1),
	(5, 1, '0000-00-00 00:00:00', 'Start', 3),
	(6, 1, '0000-00-00 00:00:00', 'Stop', 3),
	(7, 1, '0000-00-00 00:00:00', 'Stop', 3),
	(8, 1, '2022-02-04 08:18:53', 'Stop', 3),
	(9, 3, '2022-02-04 08:53:59', 'Start', 2),
	(10, 3, '2022-02-04 08:54:26', 'Stop', 2),
	(12, 1, '2022-02-06 03:47:35', 'Start', 2),
	(13, 1, '2022-02-06 03:53:07', 'Stop', 2),
	(15, 2, '2022-02-07 12:45:56', 'Stop', 1),
	(16, 1, '2022-02-08 01:16:36', 'Start', 2),
	(17, 2, '2022-02-08 01:16:48', 'Start', 2),
	(18, 1, '2022-02-08 01:17:08', 'Stop', 2),
	(19, 2, '2022-02-08 01:17:11', 'Stop', 2),
	(20, 1, '2022-02-08 02:10:19', 'Start', 2),
	(21, 1, '2022-02-08 02:10:33', 'Stop', 2),
	(22, 1, '2022-02-08 02:11:12', 'Start', 2),
	(23, 1, '2022-02-08 02:12:39', 'Stop', 2),
	(24, 1, '2022-02-08 02:12:51', 'Start', 2),
	(25, 1, '2022-02-08 02:13:07', 'Stop', 2),
	(26, 1, '2022-02-08 02:17:40', 'Start', 2),
	(27, 1, '2022-02-08 02:18:06', 'Stop', 2),
	(28, 1, '2022-02-08 02:18:21', 'Start', 2),
	(29, 2, '2022-02-08 02:18:27', 'Start', 2),
	(30, 2, '2022-02-08 02:18:34', 'Stop', 2),
	(31, 1, '2022-02-08 02:18:48', 'Stop', 2);
/*!40000 ALTER TABLE `training` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

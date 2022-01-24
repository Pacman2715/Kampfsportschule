-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.19-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank Struktur für Kampfsportschule
CREATE DATABASE IF NOT EXISTS `kampfsportschule` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `Kampfsportschule`;

-- Exportiere Struktur von Tabelle Kampfsportschule.erfahrung
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle Kampfsportschule.erfahrung: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `erfahrung` DISABLE KEYS */;
/*!40000 ALTER TABLE `erfahrung` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle Kampfsportschule.guertel
CREATE TABLE IF NOT EXISTS `guertel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Farbe` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle Kampfsportschule.guertel: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `guertel` DISABLE KEYS */;
/*!40000 ALTER TABLE `guertel` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle Kampfsportschule.person
CREATE TABLE IF NOT EXISTS `person` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vorname` varchar(50) NOT NULL,
  `Nachname` varchar(50) NOT NULL,
  `Geburtstag` date NOT NULL,
  `E-Mail` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle Kampfsportschule.person: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle Kampfsportschule.stil
CREATE TABLE IF NOT EXISTS `stil` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Stilbezeichnung` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle Kampfsportschule.stil: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `stil` DISABLE KEYS */;
/*!40000 ALTER TABLE `stil` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle Kampfsportschule.training
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle Kampfsportschule.training: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
/*!40000 ALTER TABLE `training` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

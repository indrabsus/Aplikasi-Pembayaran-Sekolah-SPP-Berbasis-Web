# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.39)
# Database: webku
# Generation Time: 2023-02-03 14:57:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table kelas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(30) DEFAULT NULL,
  `kompetensi_keahlian` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`)
VALUES
	(1,'XI AKL 1','Akuntansi Keuangan');

/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pembayaran
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_petugas` int(11) unsigned DEFAULT NULL,
  `nisn` char(20) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `bulan_dibayar` varchar(15) DEFAULT NULL,
  `tahun_dibayar` varchar(4) DEFAULT NULL,
  `id_spp` int(11) unsigned DEFAULT NULL,
  `jumlah_bayar` int(30) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `pembayaran_siswa` (`id_spp`),
  KEY `pembayaran_petugas` (`id_petugas`),
  KEY `pebayaran_nisn` (`nisn`),
  CONSTRAINT `pebayaran_nisn` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_siswa` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table petugas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id_petugas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_petugas` varchar(35) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`)
VALUES
	(1,'indra','$2y$10$3WGn5CT8FKQJ6GxTJptPiuS/jXC8nE80bPIF0HOas19/.w3LdPGTW','Indra Batara','admin'),
	(2,'petugas','$2y$10$3WGn5CT8FKQJ6GxTJptPiuS/jXC8nE80bPIF0HOas19/.w3LdPGTW','Bendahara','petugas'),
	(3,'test','$2y$10$Tc99KV8WcB4OxKdFhTMaTu6ZA.iOqIT/WoM0JDUvQGmnzsl4xelVC','test','petugas');

/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table siswa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `nisn` char(20) NOT NULL DEFAULT '',
  `nis` char(20) NOT NULL DEFAULT '',
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(10) unsigned NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`nisn`),
  KEY `siswa_spp` (`id_spp`),
  KEY `siswa_kelas` (`id_kelas`),
  CONSTRAINT `siswa_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `siswa_spp` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`)
VALUES
	('14','12345678','Indra',1,'Jalan anggrek','081380837591',1),
	('15','87654321','Batara',1,'Jalan Pesantren','085156564659',1);

/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table spp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spp`;

CREATE TABLE `spp` (
  `id_spp` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  PRIMARY KEY (`id_spp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `spp` WRITE;
/*!40000 ALTER TABLE `spp` DISABLE KEYS */;

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`)
VALUES
	(1,2023,150000);

/*!40000 ALTER TABLE `spp` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

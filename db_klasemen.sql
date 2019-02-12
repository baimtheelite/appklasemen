# Host: localhost  (Version 5.5.5-10.1.13-MariaDB)
# Date: 2019-02-12 22:16:43
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "tbl_admin"
#

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tbl_admin"
#


#
# Structure for table "tbl_match_results"
#

DROP TABLE IF EXISTS `tbl_match_results`;
CREATE TABLE `tbl_match_results` (
  `id_match_results` int(11) NOT NULL AUTO_INCREMENT,
  `id_team_home` int(255) DEFAULT NULL,
  `id_team_away` int(255) DEFAULT NULL,
  `skor_home` int(255) DEFAULT NULL,
  `skor_away` int(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_match_results`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_match_results"
#

INSERT INTO `tbl_match_results` VALUES (1,1,5,2,1,'2019-02-07'),(2,5,1,1,0,'2019-02-07'),(3,2,4,1,2,'2019-02-07'),(4,4,2,1,1,'2019-02-08'),(5,29,4,2,0,'2019-02-12');

#
# Structure for table "tbl_match_results_detail"
#

DROP TABLE IF EXISTS `tbl_match_results_detail`;
CREATE TABLE `tbl_match_results_detail` (
  `id_match_result_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemain` int(11) DEFAULT NULL,
  `goal` int(11) DEFAULT NULL,
  `assist` int(11) DEFAULT NULL,
  `owngoal` int(255) DEFAULT NULL,
  `side` varchar(255) DEFAULT NULL,
  `id_match_results` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_match_result_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_match_results_detail"
#

INSERT INTO `tbl_match_results_detail` VALUES (71,1,0,0,0,'home',1),(72,3,0,0,0,'home',1),(73,4,2,0,0,'home',1),(74,5,0,0,0,'home',1),(75,6,0,1,0,'home',1),(76,2,1,0,0,'away',1),(77,7,0,0,0,'away',1),(78,8,0,0,0,'away',1),(79,9,0,0,0,'away',1),(80,10,0,0,0,'away',1),(81,2,0,0,0,'home',2),(82,7,0,0,0,'home',2),(83,8,1,0,0,'home',2),(84,9,0,0,0,'home',2),(85,10,0,0,0,'home',2),(86,1,0,0,0,'away',2),(87,3,0,0,0,'away',2),(88,4,0,0,0,'away',2),(89,5,0,0,0,'away',2),(90,6,0,0,0,'away',2),(91,16,1,0,0,'home',3),(92,17,0,0,0,'home',3),(93,18,0,0,0,'home',3),(94,19,0,0,0,'home',3),(95,20,0,0,0,'home',3),(96,11,1,0,0,'away',3),(97,12,0,1,0,'away',3),(98,13,1,0,0,'away',3),(99,14,0,0,0,'away',3),(100,15,0,0,0,'away',3),(101,11,0,0,0,'home',4),(102,12,0,0,0,'home',4),(103,13,0,1,0,'home',4),(104,14,1,0,0,'home',4),(105,15,0,0,0,'home',4),(106,16,0,0,0,'away',4),(107,17,1,0,0,'away',4),(108,18,0,0,0,'away',4),(109,19,0,0,0,'away',4),(110,20,0,0,0,'away',4),(111,77,2,0,0,'home',5),(112,78,0,0,0,'home',5),(113,79,0,0,0,'home',5),(114,11,0,0,0,'away',5),(115,12,0,0,0,'away',5),(116,13,0,0,0,'away',5),(117,14,0,0,0,'away',5),(118,15,0,0,0,'away',5);

#
# Structure for table "tbl_pemain"
#

DROP TABLE IF EXISTS `tbl_pemain`;
CREATE TABLE `tbl_pemain` (
  `id_pemain` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemain` varchar(255) DEFAULT NULL,
  `nomor_punggung` varchar(255) DEFAULT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `goal` int(11) DEFAULT '0',
  `assist` int(11) DEFAULT '0',
  `owngoal` int(11) DEFAULT '0',
  `id_team` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pemain`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_pemain"
#

INSERT INTO `tbl_pemain` VALUES (1,'Ibrahim','7','Tengah',0,0,0,1),(2,'Harry Kane','10','Striker',1,0,0,5),(3,'Bailey','3','Belakang',0,0,0,1),(4,'Rashford','10','Striker',2,0,0,1),(5,'De Gea','1','Kiper',0,0,0,1),(6,'Pogba','6','Tengah',0,1,0,1),(7,'Scott Parker','8','Tengah',0,0,0,5),(8,'Dele Ali','23','Striker',1,0,0,5),(9,'Kyle Walker','2','Belakang',0,0,0,5),(10,'Lloris','1','Kiper',0,0,0,5),(11,'Aguero','10','Striker',1,0,0,4),(12,'Kevin De Bruyne','17','Tengah',0,1,0,4),(13,'David Silva','21','Tengah',1,1,0,4),(14,'Vincent Kompany','5','Belakang',1,0,0,4),(15,'Benjamin Mendy','22 ','Belakang',0,0,0,4),(16,'Eden Hazard','10','Striker',1,0,0,2),(17,'David Luiz','5','Belakang',1,0,0,2),(18,'Alvaro Morata','9','Striker',0,0,0,2),(19,'Kante','23','Tengah',0,0,0,2),(20,'Kepa Arizabalaga','1','Kiper',0,0,0,2),(72,'Hafizh','7','Belakang',0,0,0,6),(73,'Fauzi','9','Striker',0,0,0,6),(74,'Imad','1','Kiper',0,0,0,6),(75,'Ilham','8','Tengah',0,0,0,6),(76,'Eka','6','Tengah',0,0,0,6),(77,'Ibra','7','Tengah',2,0,0,29),(78,'Don Aria','10','Striker',0,0,0,29),(79,'Ramdan','16','Kiper',0,0,0,29);

#
# Structure for table "tbl_team"
#

DROP TABLE IF EXISTS `tbl_team`;
CREATE TABLE `tbl_team` (
  `id_team` int(11) NOT NULL AUTO_INCREMENT,
  `kode_team` varchar(3) DEFAULT NULL,
  `nama_team` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `menang` int(11) DEFAULT '0',
  `seri` int(11) DEFAULT '0',
  `kalah` int(11) DEFAULT '0',
  `goal_for` int(11) DEFAULT '0',
  `goal_against` int(11) DEFAULT '0',
  `goal_difference` int(11) DEFAULT '0',
  `points` int(11) DEFAULT '0',
  PRIMARY KEY (`id_team`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_team"
#

INSERT INTO `tbl_team` VALUES (1,'MUN','Manchester United','manchester-united.png',1,0,1,2,2,0,3),(2,'CHE','Chelsea FC','chelsea.png',0,1,1,2,3,-1,1),(3,'LIV','Liverpoll FC','liverpool.jpg',0,0,0,0,0,0,0),(4,'MCI','Manchester City','manchester-city.png',1,1,1,3,4,-1,4),(5,'TOT','Tottenham Hotspurs','tottenham-hotspur.png',1,0,1,2,2,0,3),(28,'6','Fortisimo FC','images15.jpg',0,0,0,0,0,0,0),(29,'FFC','FORSED FC','forsed7.jpg',1,0,0,2,0,2,3);

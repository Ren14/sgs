/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.6.26 : Database - sgs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sgs` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sgs`;

/*Table structure for table `lotes` */

DROP TABLE IF EXISTS `lotes`;

CREATE TABLE `lotes` (
  `id` char(36) NOT NULL,
  `numero` int(10) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `socio_id` char(36) NOT NULL,
  `fraccion` int(11) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `entre_calle_1` varchar(255) DEFAULT NULL,
  `entre_calle_2` varchar(255) DEFAULT NULL,
  `padron_rentas` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `socio_id` (`socio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

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

/*Table structure for table `bitacoras` */

DROP TABLE IF EXISTS `bitacoras`;

CREATE TABLE `bitacoras` (
  `id` char(36) NOT NULL,
  `numero` int(15) NOT NULL AUTO_INCREMENT,
  `accion` varchar(255) NOT NULL,
  `user_id` char(36) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Table structure for table `cuota_aguas` */

DROP TABLE IF EXISTS `cuota_aguas`;

CREATE TABLE `cuota_aguas` (
  `id` char(36) NOT NULL,
  `numero` int(12) NOT NULL AUTO_INCREMENT,
  `lote_id` char(36) NOT NULL,
  `recibo_id` char(36) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `cantidad` int(4) NOT NULL,
  `monto` double(10,2) DEFAULT '0.00',
  `fecha_pago` date DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `cuotas` */

DROP TABLE IF EXISTS `cuotas`;

CREATE TABLE `cuotas` (
  `id` char(36) NOT NULL,
  `numero` int(8) NOT NULL AUTO_INCREMENT,
  `lote_id` char(36) NOT NULL,
  `recibo_id` char(36) NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `monto` double(10,2) DEFAULT '0.00',
  `recibo` int(8) DEFAULT NULL COMMENT 'Es el numero de recibo',
  `estado` int(1) NOT NULL DEFAULT '1',
  `anio_pago` int(4) NOT NULL,
  `mes_desde` int(2) NOT NULL COMMENT 'Mes de inicio al que corresponde el pago',
  `mes_hasta` int(2) NOT NULL COMMENT 'Mes de fin al que corresponde el pago',
  `activo` int(1) NOT NULL DEFAULT '1',
  `observaciones` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `lotes` */

DROP TABLE IF EXISTS `lotes`;

CREATE TABLE `lotes` (
  `id` char(36) NOT NULL,
  `numero` int(10) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `socio_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `socio_id` (`socio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `parametros` */

DROP TABLE IF EXISTS `parametros`;

CREATE TABLE `parametros` (
  `id` char(36) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `recibos` */

DROP TABLE IF EXISTS `recibos`;

CREATE TABLE `recibos` (
  `id` char(36) NOT NULL,
  `numero` int(10) NOT NULL AUTO_INCREMENT,
  `lote_id` char(36) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `socios` */

DROP TABLE IF EXISTS `socios`;

CREATE TABLE `socios` (
  `id` char(36) NOT NULL,
  `numero` int(8) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL COMMENT 'Es el domicilio real del socio',
  `telefono` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activo` int(1) DEFAULT '1',
  `user_id` char(36) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` int(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

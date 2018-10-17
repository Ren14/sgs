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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bitacoras` */

insert  into `bitacoras`(`id`,`numero`,`accion`,`user_id`,`created`,`modified`) values 
('5a5fb501-7974-494d-9ec9-18cc81834945',1,'Login','5a5fb4f3-b290-45bf-ad45-18cc81834945','2018-01-17 21:41:37','2018-01-17 21:41:37'),
('5a5fb523-29bc-451d-a826-18cc81834945',2,'Crear nuevo Usuario: 35927919. Crear nuevo Socio: Ontivero, Renzo Mauro','5a5fb4f3-b290-45bf-ad45-18cc81834945','2018-01-17 21:42:11','2018-01-17 21:42:11'),
('5a5fb56c-2e50-466e-a178-18cc81834945',3,'Crear nuevo Lote: #1','5a5fb4f3-b290-45bf-ad45-18cc81834945','2018-01-17 21:43:24','2018-01-17 21:43:24'),
('5a5fb605-c75c-47f2-a4c9-18cc81834945',4,'Agregar Cuota Agua #1','5a5fb4f3-b290-45bf-ad45-18cc81834945','2018-01-17 21:45:57','2018-01-17 21:45:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `cuota_aguas` */

insert  into `cuota_aguas`(`id`,`numero`,`lote_id`,`recibo_id`,`estado`,`cantidad`,`monto`,`fecha_pago`,`activo`,`created`,`modified`) values 
('5a5fb605-d314-4e95-895f-18cc81834945',1,'5a5fb56c-b0c8-44a2-910d-18cc81834945','5a5fb605-b818-4ca2-ac1d-18cc81834945',1,12,1200.00,'2018-01-17',1,'2018-01-17 21:45:57','2018-01-17 21:45:57');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuotas` */

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

/*Data for the table `lotes` */

insert  into `lotes`(`id`,`numero`,`fecha_adquisicion`,`activo`,`socio_id`,`created`,`modified`) values 
('5a5fb56c-b0c8-44a2-910d-18cc81834945',1,'2013-01-01',1,'5a5fb523-a2c8-4d0f-8b25-18cc81834945','2018-01-17 21:43:24','2018-01-17 21:43:24');

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

/*Data for the table `parametros` */

insert  into `parametros`(`id`,`nombre`,`valor`,`activo`,`created`,`modified`) values 
('5a5fb5de-d3f4-4388-a6b9-18cc81834945','cuota_agua','100',NULL,'2018-01-17 21:45:18','2018-01-17 21:45:18');

/*Table structure for table `recibo_detalles` */

DROP TABLE IF EXISTS `recibo_detalles`;

CREATE TABLE `recibo_detalles` (
  `id` char(36) NOT NULL,
  `recibo_id` char(36) NOT NULL,
  `cuota_agua_id` char(36) DEFAULT NULL,
  `cuota_id` char(36) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `recibo_detalles` */

insert  into `recibo_detalles`(`id`,`recibo_id`,`cuota_agua_id`,`cuota_id`,`activo`,`created`,`modified`) values 
('5a5fb605-5d68-4b6f-8fea-18cc81834945','5a5fb605-b818-4ca2-ac1d-18cc81834945','5a5fb605-d314-4e95-895f-18cc81834945',NULL,1,'2018-01-17 21:45:57','2018-01-17 21:45:57');

/*Table structure for table `recibos` */

DROP TABLE IF EXISTS `recibos`;

CREATE TABLE `recibos` (
  `id` char(36) NOT NULL,
  `numero` int(10) NOT NULL AUTO_INCREMENT,
  `lote_id` char(36) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` int(1) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `recibos` */

insert  into `recibos`(`id`,`numero`,`lote_id`,`activo`,`tipo`,`monto`,`created`,`modified`) values 
('5a5fb605-b818-4ca2-ac1d-18cc81834945',1,'5a5fb56c-b0c8-44a2-910d-18cc81834945',1,1,1200,'2018-01-17 21:45:57','2018-01-17 21:45:57');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `socios` */

insert  into `socios`(`id`,`numero`,`apellido`,`nombre`,`domicilio`,`telefono`,`celular`,`email`,`activo`,`user_id`,`created`,`modified`) values 
('5a5fb523-a2c8-4d0f-8b25-18cc81834945',1,'Ontivero','Renzo Mauro','RÃ­o Pilcomayo 2016, BÂº Capilla del Rosario, Villa Nueva, GllÃ©n.','02615398997','0261 5398997','renn.carp@gmail.com',1,'5a5fb523-85b8-481e-92f4-18cc81834945','2018-01-17 21:42:11','2018-01-17 21:42:11');

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

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`rol`,`activo`,`created`,`modified`) values 
('5a5fb4f3-b290-45bf-ad45-18cc81834945','admin','$2a$10$Y6Nvsj2pUF4rZ.Cg7h2VNekL8CaYo0wC0C8V.ywjIQphye6kXQMMC',3,1,'2018-01-17 21:41:23','2018-01-17 21:41:23'),
('5a5fb523-85b8-481e-92f4-18cc81834945','35927919','$2a$10$AF86YqdpU7rk9bSp9atRduOv1LQ5nPkE4KzMZa7wmyjR9etyXYLNq',1,1,'2018-01-17 21:42:11','2018-01-17 21:42:11');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

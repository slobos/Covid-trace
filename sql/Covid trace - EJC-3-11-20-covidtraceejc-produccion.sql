# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: mysql.juarezcelman.gob.ar (MySQL 5.7.28-log)
# Base de datos: covidtraceejc
# Tiempo de Generación: 2020-11-03 03:47:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla logins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logins`;

CREATE TABLE `logins` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(16) DEFAULT NULL,
  `user` varchar(16) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT NULL,
  `ip` varchar(39) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla pacientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pacientes`;

CREATE TABLE `pacientes` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(16) DEFAULT NULL,
  `nombreapellido` varchar(60) DEFAULT NULL,
  `edad` varchar(4) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `calle` varchar(120) DEFAULT NULL,
  `numeracion` varchar(6) DEFAULT NULL,
  `barrio` varchar(45) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `lugar` varchar(60) DEFAULT NULL,
  `patologiasprevias` varchar(5) DEFAULT NULL,
  `observaciones` text,
  `date` datetime DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lon` varchar(20) DEFAULT NULL,
  `dni` varchar(30) DEFAULT NULL,
  `sexo` varchar(15) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla profesionales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profesionales`;

CREATE TABLE `profesionales` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(16) DEFAULT NULL,
  `nombre` varchar(120) DEFAULT NULL,
  `apellido` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `level` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla seguimientos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seguimientos`;

CREATE TABLE `seguimientos` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(16) DEFAULT NULL,
  `paciente` varchar(16) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `situacion` varchar(30) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` text,
  `viacontacto` varchar(30) DEFAULT NULL,
  `profesional` varchar(120) DEFAULT NULL,
  `fechaalta` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(16) DEFAULT NULL,
  `user` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `update_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

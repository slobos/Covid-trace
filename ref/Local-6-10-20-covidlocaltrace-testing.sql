# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Base de datos: covidlocaltrace
# Tiempo de Generación: 2020-10-06 17:51:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;

INSERT INTO `pacientes` (`id`, `transactionid`, `nombreapellido`, `edad`, `telefono`, `celular`, `calle`, `numeracion`, `barrio`, `tipo`, `fecha`, `lugar`, `patologiasprevias`, `observaciones`, `date`, `lat`, `lon`)
VALUES
	(00000000001,'i2QtC3TIUJ96jKXS','Nicolás Rodriguez','54','NULL','3518075016','Los Paraisos','111','Villa Los Llanos','Positivo','2020-09-29','Rawson','No','Vive con la hija que dio negativo pero comparten casa con pisos separados. El está aislado solo en la planta alta. La hija también está cumpliendo la cuarentena. Arrancó el lunes con sintomas  trabaja en albanileria en barrio Rivera Indarte  obras particulares   con su hermano quien tambien está haciendo la cuarentena. Se siente bien  ahora no está con fiebre y está tomando paracetamol 1 gr. cada 8hs.','2020-10-06 01:48:33','-31.2760265','-64.1626385'),
	(00000000002,'y7ncC5b6HFOryNyI','Maximiliano Rodriguez','29','NULL','3512688294','Los Paraisos','111','Villa Los Llanos','Positivo','2020-09-30','Lase laboratorio privado','No','Vive con la sra. las hijas están con los abuelos desde el viernes. No tiene fiebre  tiene tos  picazón de garganta  dolor muscular. Contacto con un positivo día domingo que es papá (Rodriguez Nicolás  vive al lado  ya fue registrado). Trabaja en Mayorista de arte  no fue a trabajar desde el viernes. Paracetamol 1gr cada 8 hs.','2020-10-06 10:04:40','-31.2760265','-64.1626385'),
	(00000000003,'yiHfIv3zpH05LvX1','Hector daniel Ramón Alvarez','46','NULL','3512304514','Esmeralda','302','Almirante Brown','Positivo','2020-10-01','Frigorifico de tirolesa','Si','vive solo. Sabado a la tarde dolor de cuerpo y cabeza  no fiebre  Paracetamol 1gr. No ha tenido contacto con nadie en el barrio.','2020-10-06 10:06:20','-31.4238401','-64.2231022'),
	(00000000004,'FCB9Dms5Serquuxt','Victor Hugo Alvarez','40','NULL','3834368350','Manzana 40','Lote 4','Ciudad de los Niños','Positivo','2020-10-01','Cantonatti Frigorifico Tirolesa','No','Vive con una bebé de 1 año  10  12 y 6 y la sra. Dolor de cabeza  hace del viernes pasado  compartieron bebida del pico de la botella con la cuñada que es de guinuzu  le recalqué que ella debe hacer el aislamiento.  A la sra le están haciendo estudios en un hospital ya que está muy decaída desde hace un tiempo y no se puede hacer cargo de los niños por lo que él deberá hacerlo con todas las medidas preventivas.','2020-10-06 10:07:47','-31.2959199','-64.1773656'),
	(00000000005,'Pkb0kWP3DiLgwS6p','Lucas Ambrosi','42','NULL','3512032908','Leopoldo Lugones','78','Barrio Parque Norte','Positivo','2020-09-30','Clinica Don Bosco','Si','Dieron positivos 4 adultos de la casa. El sr. está asintomático  su esposa la Sra Roxana Ledezma 44 años  sin patologia previa  dolor de cabeza y atras de los ojos  fumadora  hoy presenta moco y pérdida del gusto. viven 3 niños mas de 25  18 y 15 años ninguno tiene síntomas. estan cursando el dia 7/8 de la infección según lo que le informaron con el estudio de sangre. Todos en aislamiento. Los otros dos positivos de la vivienda son los cuñados.','2020-10-06 10:09:17','-31.2808921','-64.1645643'),
	(00000000006,'uduO5u3TBF1xbeni','Micaela Tula','23','NULL','3517346401','Leopoldo Lugones','78','Barrio Parque Norte','Positivo','2020-10-01','Clinica Don Bosco','No','Embarazada de 32 semanas. Se atiende en el centro de salud de Hipolito Yrigoyen. tiene el número de su obstetra y mañana se contacta con ella  no tiene sintomas. Trabaja en un bar familiar. Están todos en aislamiento. El marido también es positivo  asintomático y trabaja en el centro de distribucion de Mariano Max desde donde lo mandaron a hisopar.','2020-10-06 10:10:33','-31.2808921','-64.1645643'),
	(00000000007,'oa0eZ3AUHFy9o5Lx','Vivas Marcelo Javier','39','NULL','3515180221','Manzana 27','Lote 7','Ciudad de los Niños','Positivo','2020-10-01','Cantonatti Frigorifico Tirolesa','No','Vive con su señora y los 2 hijos de 13 y 15 años. Lunes empezó con dolor de cuerpo  escalofrios. Es el único que tiene síntomas en la familia.','2020-10-06 10:12:13','-31.2959199','-64.1773656'),
	(00000000008,'qcSjPfiynXAtU0Xl','Maria Laura Rodriguez','24','NULL','3515201025','Los Ceibos','532','Villa Los Llanos','Positivo','2020-10-01','Terminal de Obnibus','No','Tuvo fiebre el domingo. Ya avisaron a una familia amiga con la que tuvieron contacto estrecho para que haga la cuarentena. Vive con papá  mamá y hermano que están los 3 esperando el resultado del hisopado.','2020-10-06 10:14:00','-31.2752817','-64.1680404'),
	(00000000009,'gqNiWgzRYzar96sj','Ibarra Pablo','33','NULL','3512731123','10 de Junio','149','Barrio Parque Norte','Positivo','2020-10-01','9 de julio 941. Laboratorio EMS cordoba','No','Vive la sra con 3 niños de 10  7 y 2 años. esta medicado con paracetamol 1 gr. dolor de espalda y cabeza. La sra y la nena de 10 años están con tos y dolor de cuerpo.','2020-10-06 10:15:03','-31.2999937','-64.1770609'),
	(00000000010,'NuLrFFTdtqtKOd7C','Ludueña Marcos ','40','NULL','3515550599','Leopoldo Lugones','633','Villa Los Llanos','Positivo','2020-10-01','Laboratorio Lace','Si','HTA. no esta tomando nada  tiene fiebre. Vive con la mujer y 5 hijos de 23 22 19 17 y 16 años. La sra. tiene dolor de cabeza  de espalda  de ojos. el de 22 tiene dolor de garganta y fiebre.\r\nSu papá falleció el 24/09 por covid y sus hermanos también son positivos (ninguno de ellos residentes de la localidad). \r\nTrabaja en Centro América donde han dado positivos varios compañeros de trabajo. ','2020-10-06 10:16:24','-31.2808921','-64.1645643'),
	(00000000011,'mDrBbL0Hh4vOoYUk','Arroyo Perales Rodolfo','36','NULL','3517314693','Los Platanos','372','Villa Los Llanos','Positivo','2020-09-30','Laboratorio Lace','No','Trabaja en Indacor. En este momento está sin sintomas y tomando paracetamol 1gr.\r\nGrupo conviviente:  la sra  la hija y el yerno. La sra y la hija empezaron con dolor de cabeza  de cuerpo y picazón de ojos hoy. ','2020-10-06 10:17:37','-31.273606','-64.156307');

/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;


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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

LOCK TABLES `seguimientos` WRITE;
/*!40000 ALTER TABLE `seguimientos` DISABLE KEYS */;

INSERT INTO `seguimientos` (`id`, `transactionid`, `paciente`, `tipo`, `situacion`, `fecha`)
VALUES
	(00000000001,'5wEh2MWZULWZGPeJ','i2QtC3TIUJ96jKXS','Positivo','Domiclio','2020-10-06 01:48:33'),
	(00000000002,'oxPmSgUkuQSxDJVc','y7ncC5b6HFOryNyI','Positivo','Domiclio','2020-10-06 10:04:40'),
	(00000000003,'bDK3PWAATYev06eR','yiHfIv3zpH05LvX1','Positivo','Domiclio','2020-10-06 10:06:20'),
	(00000000004,'ooAjGb4k569txmZw','FCB9Dms5Serquuxt','Positivo','Domiclio','2020-10-06 10:07:47'),
	(00000000005,'Zu2kNFRaYoZsA8ik','Pkb0kWP3DiLgwS6p','Positivo','Domiclio','2020-10-06 10:09:17'),
	(00000000006,'YVwTzzrdvEWZ8yfC','uduO5u3TBF1xbeni','Positivo','Domiclio','2020-10-06 10:10:33'),
	(00000000007,'4L2BYtEk4ocKvcKK','oa0eZ3AUHFy9o5Lx','Positivo','Domiclio','2020-10-06 09:12:13'),
	(00000000008,'j0Dym1bYzkewOeTy','qcSjPfiynXAtU0Xl','Positivo','Domiclio','2020-10-06 10:14:00'),
	(00000000009,'gvY5ExssaNpKS7OJ','gqNiWgzRYzar96sj','Positivo','Domiclio','2020-10-06 10:15:03'),
	(00000000010,'ktOBgubjxoVjQZMY','NuLrFFTdtqtKOd7C','Positivo','Domiclio','2020-10-06 10:16:24'),
	(00000000011,'anJNAQf3iCt1KFLX','mDrBbL0Hh4vOoYUk','Positivo','Domiclio','2020-10-06 10:17:37'),
	(00000000012,'ooAjGb4k569txmZw','FCB9Dms5Serquuxt','Positivo','Domiclio','2020-10-06 11:07:47'),
	(00000000013,'4L2BYtEk4ocKvcKK','oa0eZ3AUHFy9o5Lx','Positivo','Domiclio','2020-10-06 12:12:13');

/*!40000 ALTER TABLE `seguimientos` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Base de datos: covidlocaltrace
# Tiempo de Generación: 2020-10-07 10:18:54 +0000
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

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;

INSERT INTO `logins` (`id`, `transactionid`, `user`, `datetime`, `ip`)
VALUES
	(00000000001,'mYamWripwODPmmkl','asdasda22','2020-10-07 00:46:22','::1'),
	(00000000002,'aV1io2mUHXDk5kaI','asdasda22','2020-10-07 00:46:38','::1'),
	(00000000003,'NaKRxFJuy0XkfLIM','asdasda22','2020-10-07 00:47:35','::1'),
	(00000000004,'z1eRLjzU1kggD9xp','asdasda22','2020-10-07 00:47:47','::1'),
	(00000000005,'7DH9NdQqw4iAcWJG','asdasda22','2020-10-07 00:48:20','::1'),
	(00000000006,'9XZkhSWP6H9t9S0r','asdasda22','2020-10-07 00:50:13','::1'),
	(00000000007,'NN1pMIqD7JC6Gtod','asdasda22','2020-10-07 00:50:40','::1'),
	(00000000008,'KCthpPWzXPVbBXFK','asdasda22','2020-10-07 00:54:10','::1'),
	(00000000009,'YU0sMvDGYVswEf9u','asdasda22','2020-10-07 00:55:27','::1'),
	(00000000010,'Cg7X93nRhyEvd4h5','asdasda22','2020-10-07 01:03:54','::1'),
	(00000000011,'JLLpqgdSYIzFNUPV','asdasda22','2020-10-07 01:05:48','::1'),
	(00000000012,'b1VgdkEW3SyUU5zZ','asdasda22','2020-10-07 01:07:44','::1'),
	(00000000013,'h5JmPYNT7fgHNxrK','asdasda22','2020-10-07 01:08:35','::1'),
	(00000000014,'lad5DGDoBbQGo656','asdasda22','2020-10-07 01:08:59','::1'),
	(00000000015,'I7ia1mK5xmoZAZta','asdasda22','2020-10-07 01:11:00','::1'),
	(00000000016,'ykgsyBPgCMIFU7sP','asdasda22','2020-10-07 01:20:09','::1'),
	(00000000017,'InSSFRmkhEDzVZM4','asdasda22','2020-10-07 06:36:55','::1'),
	(00000000018,'WL29ZDi4zoWeYEcB','asdasda22','2020-10-07 07:10:49','::1'),
	(00000000019,'TXX9NaMb7zzaS5cn','asdasda22','2020-10-07 07:13:26','::1'),
	(00000000020,'1Fn43TtdXRrURewj','asdasda22','2020-10-07 07:15:14','::1'),
	(00000000021,'3eAPRHSGqIRaI8u5','asdasda22','2020-10-07 07:16:18','::1');

/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;

INSERT INTO `pacientes` (`id`, `transactionid`, `nombreapellido`, `edad`, `telefono`, `celular`, `calle`, `numeracion`, `barrio`, `tipo`, `fecha`, `lugar`, `patologiasprevias`, `observaciones`, `date`, `lat`, `lon`)
VALUES
	(00000000001,'i2QtC3TIUJ96jKXS','Nicolás Rodriguez','54','NULL','3518075016','Los Paraisos','111','Villa Los Llanos','Positivo','2020-09-15','Rawson','No','','2020-10-06 01:48:33','-31.2760265','-64.1626385'),
	(00000000002,'y7ncC5b6HFOryNyI','Maximiliano Rodriguez','29','NULL','3512688294','Los Paraisos','111','Villa Los Llanos','Positivo','2020-09-30','Lase laboratorio privado','No','','2020-10-06 10:04:40','-31.2760265','-64.1626385'),
	(00000000003,'yiHfIv3zpH05LvX1','Hector daniel Ramón Alvarez','46','NULL','3512304514','Esmeralda','302','Almirante Brown','Positivo','2020-10-01','Frigorifico de tirolesa','Si','','2020-10-06 10:06:20','-31.4238401','-64.2231022'),
	(00000000004,'FCB9Dms5Serquuxt','Victor Hugo Alvarez','40','NULL','3834368350','Manzana 40','Lote 4','Ciudad de los Niños','Positivo','2020-10-01','Cantonatti Frigorifico Tirolesa','No','','2020-10-06 10:07:47','-31.2959199','-64.1773656'),
	(00000000005,'Pkb0kWP3DiLgwS6p','Lucas Ambrosi','42','NULL','3512032908','Leopoldo Lugones','78','Barrio Parque Norte','Positivo','2020-09-30','Clinica Don Bosco','Si','','2020-10-06 10:09:17','-31.2808921','-64.1645643'),
	(00000000006,'uduO5u3TBF1xbeni','Micaela Tula','23','NULL','3517346401','Leopoldo Lugones','78','Barrio Parque Norte','Positivo','2020-10-01','Clinica Don Bosco','No','','2020-10-06 10:10:33','-31.2808921','-64.1645643'),
	(00000000007,'oa0eZ3AUHFy9o5Lx','Vivas Marcelo Javier','39','NULL','3515180221','Manzana 27','Lote 7','Ciudad de los Niños','Positivo','2020-10-01','Cantonatti Frigorifico Tirolesa','No','','2020-10-06 10:12:13','-31.2959199','-64.1773656'),
	(00000000008,'qcSjPfiynXAtU0Xl','Maria Laura Rodriguez','24','NULL','3515201025','Los Ceibos','532','Villa Los Llanos','Positivo','2020-10-01','Terminal de Obnibus','No','','2020-10-06 10:14:00','-31.2752817','-64.1680404'),
	(00000000009,'gqNiWgzRYzar96sj','Ibarra Pablo','33','NULL','3512731123','10 de Junio','149','Barrio Parque Norte','Positivo','2020-10-01','9 de julio 941. Laboratorio EMS cordoba','No','','2020-10-06 10:15:03','-31.2999937','-64.1770609'),
	(00000000010,'NuLrFFTdtqtKOd7C','Ludueña Marcos ','40','NULL','3515550599','Leopoldo Lugones','633','Villa Los Llanos','Positivo','2020-10-01','Laboratorio Lace','Si','','2020-10-06 10:16:24','-31.2808921','-64.1645643'),
	(00000000011,'mDrBbL0Hh4vOoYUk','Arroyo Perales Rodolfo','36','NULL','3517314693','Los Platanos','372','Villa Los Llanos','Positivo','2020-09-30','Laboratorio Lace','No','','2020-10-06 10:17:37','-31.273606','-64.156307');

/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla profesionales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profesionales`;

CREATE TABLE `profesionales` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(16) DEFAULT NULL,
  `nombre` varchar(120) DEFAULT NULL,
  `apellido` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `profesionales` WRITE;
/*!40000 ALTER TABLE `profesionales` DISABLE KEYS */;

INSERT INTO `profesionales` (`id`, `transactionid`, `nombre`, `apellido`, `email`)
VALUES
	(00000000001,'asdasda22','Santiago','Lobos','slobos@gmail.com');

/*!40000 ALTER TABLE `profesionales` ENABLE KEYS */;
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
  `observaciones` text,
  `viacontacto` varchar(30) DEFAULT NULL,
  `profesional` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `seguimientos` WRITE;
/*!40000 ALTER TABLE `seguimientos` DISABLE KEYS */;

INSERT INTO `seguimientos` (`id`, `transactionid`, `paciente`, `tipo`, `situacion`, `fecha`, `observaciones`, `viacontacto`, `profesional`)
VALUES
	(00000000001,'5wEh2MWZULWZGPeJ','i2QtC3TIUJ96jKXS','Positivo','Domicilio','2020-10-05 01:48:33','Vive con la hija que dio negativo pero comparten casa con pisos separados. El está aislado solo en la planta alta. La hija también está cumpliendo la cuarentena. Arrancó el lunes con sintomas  trabaja en albanileria en barrio Rivera Indarte  obras particulares   con su hermano quien tambien está haciendo la cuarentena. Se siente bien  ahora no está con fiebre y está tomando paracetamol 1 gr. cada 8hs.',NULL,NULL),
	(00000000002,'oxPmSgUkuQSxDJVc','y7ncC5b6HFOryNyI','Positivo','Domicilio','2020-10-05 10:04:40','Vive con la sra. las hijas están con los abuelos desde el viernes. No tiene fiebre  tiene tos  picazón de garganta  dolor muscular. Contacto con un positivo día domingo que es papá (Rodriguez Nicolás  vive al lado  ya fue registrado). Trabaja en Mayorista de arte  no fue a trabajar desde el viernes. Paracetamol 1gr cada 8 hs.',NULL,NULL),
	(00000000003,'bDK3PWAATYev06eR','yiHfIv3zpH05LvX1','Contacto estrecho','Domicilio','2020-10-05 10:06:20','vive solo. Sabado a la tarde dolor de cuerpo y cabeza  no fiebre  Paracetamol 1gr. No ha tenido contacto con nadie en el barrio.',NULL,NULL),
	(00000000004,'ooAjGb4k569txmZw','FCB9Dms5Serquuxt','Positivo','Hospitalizado','2020-10-05 10:07:47','Vive con una bebé de 1 año  10  12 y 6 y la sra. Dolor de cabeza  hace del viernes pasado  compartieron bebida del pico de la botella con la cuñada que es de guinuzu  le recalqué que ella debe hacer el aislamiento.  A la sra le están haciendo estudios en un hospital ya que está muy decaída desde hace un tiempo y no se puede hacer cargo de los niños por lo que él deberá hacerlo con todas las medidas preventivas.',NULL,NULL),
	(00000000005,'Zu2kNFRaYoZsA8ik','Pkb0kWP3DiLgwS6p','Positivo','Domicilio','2020-10-05 10:09:17','Dieron positivos 4 adultos de la casa. El sr. está asintomático  su esposa la Sra Roxana Ledezma 44 años  sin patologia previa  dolor de cabeza y atras de los ojos  fumadora  hoy presenta moco y pérdida del gusto. viven 3 niños mas de 25  18 y 15 años ninguno tiene síntomas. estan cursando el dia 7/8 de la infección según lo que le informaron con el estudio de sangre. Todos en aislamiento. Los otros dos positivos de la vivienda son los cuñados.',NULL,NULL),
	(00000000006,'YVwTzzrdvEWZ8yfC','uduO5u3TBF1xbeni','Positivo','Domicilio','2020-10-05 10:10:33','Embarazada de 32 semanas. Se atiende en el centro de salud de Hipolito Yrigoyen. tiene el número de su obstetra y mañana se contacta con ella  no tiene sintomas. Trabaja en un bar familiar. Están todos en aislamiento. El marido también es positivo  asintomático y trabaja en el centro de distribucion de Mariano Max desde donde lo mandaron a hisopar.',NULL,NULL),
	(00000000007,'4L2BYtEk4ocKvcKK','oa0eZ3AUHFy9o5Lx','Positivo','Domicilio','2020-10-05 09:12:13','Vive con su señora y los 2 hijos de 13 y 15 años. Lunes empezó con dolor de cuerpo  escalofrios. Es el único que tiene síntomas en la familia.',NULL,NULL),
	(00000000008,'j0Dym1bYzkewOeTy','qcSjPfiynXAtU0Xl','Positivo','Alta','2020-10-05 10:14:00','Tuvo fiebre el domingo. Ya avisaron a una familia amiga con la que tuvieron contacto estrecho para que haga la cuarentena. Vive con papá  mamá y hermano que están los 3 esperando el resultado del hisopado.',NULL,NULL),
	(00000000009,'gvY5ExssaNpKS7OJ','gqNiWgzRYzar96sj','Positivo','Domicilio','2020-10-06 10:15:03','Vive la sra con 3 niños de 10  7 y 2 años. esta medicado con paracetamol 1 gr. dolor de espalda y cabeza. La sra y la nena de 10 años están con tos y dolor de cuerpo.',NULL,NULL),
	(00000000010,'ktOBgubjxoVjQZMY','NuLrFFTdtqtKOd7C','Positivo','Fallecido','2020-10-06 10:16:24','HTA. no esta tomando nada  tiene fiebre. Vive con la mujer y 5 hijos de 23 22 19 17 y 16 años. La sra. tiene dolor de cabeza  de espalda  de ojos. el de 22 tiene dolor de garganta y fiebre.\r\nSu papá falleció el 24/09 por covid y sus hermanos también son positivos (ninguno de ellos residentes de la localidad). \r\nTrabaja en Centro América donde han dado positivos varios compañeros de trabajo. ',NULL,NULL),
	(00000000011,'anJNAQf3iCt1KFLX','mDrBbL0Hh4vOoYUk','Positivo','Domicilio','2020-10-06 10:17:37','Trabaja en Indacor. En este momento está sin sintomas y tomando paracetamol 1gr.\r\nGrupo conviviente:  la sra  la hija y el yerno. La sra y la hija empezaron con dolor de cabeza  de cuerpo y picazón de ojos hoy. ',NULL,NULL),
	(00000000012,'ooAjGb4k569txmZw','FCB9Dms5Serquuxt','Positivo','Domicilio','2020-10-06 11:07:47','OTRA OBSERVACION',NULL,NULL),
	(00000000013,'4L2BYtEk4ocKvcKK','oa0eZ3AUHFy9o5Lx','Positivo','Domicilio','2020-10-06 12:12:13','OTRA OBSERVACION',NULL,NULL),
	(00000000014,'74SjSrN1w5FDtL9z','FCB9Dms5Serquuxt','NULL','Hospitalizado','2020-10-06 22:12:34','asdasdasd','Llamado telefónico','Santiago Lobos'),
	(00000000015,'eOoldmCmggNbB7qx','y7ncC5b6HFOryNyI','Positivo','Hospitalizado','2020-10-06 22:14:45','asdasdasdasd','Llamado telefónico','Santiago Lobos'),
	(00000000016,'xcZ6cFVyXcGIyQAw','yiHfIv3zpH05LvX1','Contacto estrecho','Fallecido','2020-10-06 22:17:05','Fallecio lamentalbmente','Visita presencial','Santiago Lobos'),
	(00000000017,'eI4rFHVugaEIpNhm','oa0eZ3AUHFy9o5Lx','Positivo','Fallecido','2020-10-06 22:17:48','Nos enteramos por whatsapp','Mensajería Whatsapp','Santiago Lobos');

/*!40000 ALTER TABLE `seguimientos` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `transactionid`, `user`, `password`, `update_ts`)
VALUES
	(00000000001,'asdasda22','slobos@gmail.com','canavis','2020-10-06 22:59:17');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

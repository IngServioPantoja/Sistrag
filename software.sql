-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2014 a las 02:56:47
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `software`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `programa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `programa_id` (`programa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `programa_id`) VALUES
(1, 'TICs', '', 1),
(3, 'Gestión de la información', '', 1),
(4, 'Matematícas aplicadas', '', 1),
(5, 'Administración BIG DATA', 'Todo lo relacionado con grandes tamaño de información en cada una de sus ramas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE IF NOT EXISTS `conceptos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `nombre`) VALUES
(1, 'Aprobado'),
(2, 'No Aprobado'),
(3, 'Aprobado con correcciones');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `contenido por items`
--
CREATE TABLE IF NOT EXISTS `contenido por items` (
`nombre` char(60)
,`texto` text
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controles`
--

CREATE TABLE IF NOT EXISTS `controles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `rol_id` int(11) NOT NULL,
  `estandar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  KEY `estandar_id` (`estandar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `controles`
--

INSERT INTO `controles` (`id`, `fecha`, `rol_id`, `estandar_id`) VALUES
(2, '2014-07-29', 2, 2),
(9, '2014-07-31', 1, 2),
(10, '2014-07-31', 1, 2),
(11, '2014-07-31', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentregas`
--

CREATE TABLE IF NOT EXISTS `detalleentregas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrega_id` int(11) DEFAULT NULL,
  `personas_proyecto_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_estado` date NOT NULL,
  `parametro_veredicto_id` int(11) DEFAULT NULL,
  `correcciones` int(11) DEFAULT NULL,
  `comentarios` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `entrega_id` (`entrega_id`),
  KEY `personas_proyecto_id` (`personas_proyecto_id`),
  KEY `estado_id` (`estado_id`),
  KEY `parametro_veredicto_id` (`parametro_veredicto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Volcado de datos para la tabla `detalleentregas`
--

INSERT INTO `detalleentregas` (`id`, `entrega_id`, `personas_proyecto_id`, `estado_id`, `fecha_estado`, `parametro_veredicto_id`, `correcciones`, `comentarios`) VALUES
(67, 3290, 53, 1, '2014-07-22', NULL, NULL, ''),
(68, 3290, 54, 1, '2014-07-22', NULL, NULL, ''),
(69, 3291, 56, 3, '2014-07-24', 1, NULL, 'Esta es la evaluación del documento de trabajo de grado de sistragasdasdssdasd'),
(70, 3292, 50, 1, '2014-07-22', NULL, NULL, ''),
(71, 3293, 56, 1, '2014-07-30', NULL, NULL, ''),
(72, 3294, 50, 1, '2014-07-30', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_guardado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enlace` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `enviado` tinyint(1) NOT NULL DEFAULT '0',
  `estandar_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estandar_id` (`estandar_id`),
  KEY `proyecto_id` (`proyecto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=110 ;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `fecha_guardado`, `enlace`, `enviado`, `estandar_id`, `proyecto_id`) VALUES
(107, '2014-07-22 06:06:40', '', 1, 2, 109),
(108, '2014-07-22 08:55:23', '', 1, 2, 108),
(109, '2014-07-29 10:19:29', '', 1, 2, 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE IF NOT EXISTS `entregas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` date NOT NULL,
  `rol_id` int(11) NOT NULL,
  `documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documento_id` (`documento_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3295 ;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `fecha_entrega`, `rol_id`, `documento_id`) VALUES
(3289, '2014-07-22', 2, 107),
(3290, '2014-07-22', 1, 107),
(3291, '2014-07-22', 1, 108),
(3292, '2014-07-22', 2, 108),
(3293, '2014-07-30', 1, 109),
(3294, '2014-07-30', 2, 109);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Sin ver'),
(2, 'Visto'),
(3, 'Revisado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estandares`
--

CREATE TABLE IF NOT EXISTS `estandares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(70) COLLATE utf8_unicode_ci NOT NULL,
  `inicio vigencia` date NOT NULL,
  `fin vigencia` date DEFAULT NULL,
  `programa_id` int(11) NOT NULL,
  `tiposestandar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tiposestandar_id` (`tiposestandar_id`),
  KEY `programa_id` (`programa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estandares`
--

INSERT INTO `estandares` (`id`, `nombre`, `inicio vigencia`, `fin vigencia`, `programa_id`, `tiposestandar_id`) VALUES
(2, 'Trabajo de grado', '2014-03-04', '2014-03-19', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items_documento_id` int(11) NOT NULL,
  `detalles_entrega_id` int(11) NOT NULL,
  `parametro_concepto_id` int(11) NOT NULL,
  `comentarios` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parametro_concepto_id` (`parametro_concepto_id`),
  KEY `detalles_entrega_id` (`detalles_entrega_id`),
  KEY `items_documento_id` (`items_documento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1232 ;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `items_documento_id`, `detalles_entrega_id`, `parametro_concepto_id`, `comentarios`) VALUES
(1142, 1550, 67, 3, ''),
(1143, 1551, 67, 3, ''),
(1144, 1552, 67, 3, ''),
(1145, 1553, 67, 3, ''),
(1146, 1554, 67, 3, ''),
(1147, 1555, 67, 3, ''),
(1148, 1556, 67, 3, ''),
(1149, 1557, 67, 3, ''),
(1150, 1558, 67, 3, ''),
(1151, 1559, 67, 3, ''),
(1152, 1560, 67, 3, ''),
(1153, 1561, 67, 3, ''),
(1154, 1562, 67, 3, ''),
(1155, 1563, 67, 3, ''),
(1156, 1564, 67, 3, ''),
(1157, 1550, 68, 3, ''),
(1158, 1551, 68, 3, ''),
(1159, 1552, 68, 3, ''),
(1160, 1553, 68, 3, ''),
(1161, 1554, 68, 3, ''),
(1162, 1555, 68, 3, ''),
(1163, 1556, 68, 3, ''),
(1164, 1557, 68, 3, ''),
(1165, 1558, 68, 3, ''),
(1166, 1559, 68, 3, ''),
(1167, 1560, 68, 3, ''),
(1168, 1561, 68, 3, ''),
(1169, 1562, 68, 3, ''),
(1170, 1563, 68, 3, ''),
(1171, 1564, 68, 3, ''),
(1172, 1566, 69, 3, ''),
(1173, 1567, 69, 1, 'servio adnres pantoja troserasdndjdjisk'),
(1174, 1568, 69, 3, 'asdasd'),
(1175, 1569, 69, 3, 'asdasd'),
(1176, 1570, 69, 1, 'asd'),
(1177, 1571, 69, 1, 'asd'),
(1178, 1572, 69, 3, 'asd'),
(1179, 1573, 69, 1, '123'),
(1180, 1574, 69, 1, '123123'),
(1181, 1575, 69, 3, '123'),
(1182, 1576, 69, 1, '123'),
(1183, 1577, 69, 1, '123123'),
(1184, 1578, 69, 3, ''),
(1185, 1579, 69, 3, '12312'),
(1186, 1580, 69, 3, 'asdasdssdssssdddsdssdsdddasdasdsadsadasdasdasdassdasdssssssssasddaaasdasdsdsdasdasdasdasdasdasdasdasdasdaasdasdsdsadasdasdasdasdaasdsaasdsddasdasdasd'),
(1187, 1566, 70, 3, ''),
(1188, 1567, 70, 3, ''),
(1189, 1568, 70, 3, ''),
(1190, 1569, 70, 3, ''),
(1191, 1570, 70, 3, ''),
(1192, 1571, 70, 3, ''),
(1193, 1572, 70, 3, ''),
(1194, 1573, 70, 3, ''),
(1195, 1574, 70, 3, ''),
(1196, 1575, 70, 3, ''),
(1197, 1576, 70, 3, ''),
(1198, 1577, 70, 3, ''),
(1199, 1578, 70, 3, ''),
(1200, 1579, 70, 3, ''),
(1201, 1580, 70, 3, ''),
(1202, 1582, 71, 3, ''),
(1203, 1583, 71, 3, ''),
(1204, 1584, 71, 3, ''),
(1205, 1585, 71, 3, ''),
(1206, 1586, 71, 3, ''),
(1207, 1587, 71, 3, ''),
(1208, 1588, 71, 3, ''),
(1209, 1589, 71, 3, ''),
(1210, 1590, 71, 3, ''),
(1211, 1591, 71, 3, ''),
(1212, 1592, 71, 3, ''),
(1213, 1593, 71, 3, ''),
(1214, 1594, 71, 3, ''),
(1215, 1595, 71, 3, ''),
(1216, 1596, 71, 3, ''),
(1217, 1582, 72, 3, ''),
(1218, 1583, 72, 3, ''),
(1219, 1584, 72, 3, ''),
(1220, 1585, 72, 3, ''),
(1221, 1586, 72, 3, ''),
(1222, 1587, 72, 3, ''),
(1223, 1588, 72, 3, ''),
(1224, 1589, 72, 3, ''),
(1225, 1590, 72, 3, ''),
(1226, 1591, 72, 3, ''),
(1227, 1592, 72, 3, ''),
(1228, 1593, 72, 3, ''),
(1229, 1594, 72, 3, ''),
(1230, 1595, 72, 3, ''),
(1231, 1596, 72, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE IF NOT EXISTS `facultades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Ingeniería', 'La Facultad de Ingeniería de la Institución Universitaria CESMAG, desde el 2005 hace parte de la Asociación Colombiana de Facultades de Ingeniería, y siempre ha propiciado la formación de profesionales integrales en Ingeniería de alta calidad, comprometidos con el desarrollo sostenible y tecnológico del medio regional, nacional o internacional; por lo cual, lleva a cabo un conjunto de acciones para la construcción, transferencia, y apropiación social del conocimiento científico y tecnológico, en coherencia con los requerimientos de la sociedad moderna y dentro de un contexto de globalización, con liderazgo y compromiso de responsabilidad social.\r\nLa Facultad cuenta con dos programas académicos: \r\n*Ingeniería de Sistemas.\r\n*Ingeniería Electrónica.\r\nlos cuales tienen registro calificado hasta el 2017. En ambos, se trabajan actividades relacionadas con la docencia, la investigación y la proyección social, utilizando tecnologías y metodologías pertinentes en educación, generando un ambiente de trabajo apropiado para generar conocimiento.'),
(2, 'Arquitectura y Bellas Artes', 'En los programas que hacen parte de la Facultad de Arquitectura y Bellas Artes, el trabajo de construcción de conocimiento como una propuesta creativa y continua, se ha dado siempre en todo el proceso de formación; la creatividad en los procesos educativos es de suma importancia, se constituye en el detonante de lo configurador y resolutivo, es el motor que prevé el delineamiento de las fronteras del saber haciendo posible cosechar los frutos en las diferentes áreas, disciplinas y componentes, por lo tanto, la implementación de un plan de estudios basado en competencias busca fortalecer el desarrollo del individuo a través de la reafirmación de su ser y el encuentro con los otros, utilizando la reflexión meta cognitiva, el diálogo ínter subjetivo, la convivencia y la comunicación generando nuevas estrategias metodológicas y evaluativas en el proceso de enseñanza – aprendizaje.'),
(3, 'Ciencias Administrativas y Contables', 'La Facultad de Ciencias Administrativas y Contables, consciente de las necesidades locales y regionales y fiel a los principios que le dieron origen y al compromiso de inculcar valores éticos y morales, desarrolla fundamentalmente su actividad educativa con la vinculación al sector productivo sobre la base de la formación, en procura por fortalecer el desarrollo profesional, social, cultural e intelectual de sus estudiantes. Incentiva la investigación, mediante los semilleros de investigación como pilar fundamental, que dará al estudiante nuevas visiones e interpretaciones al conocimiento acumulado, a partir de las problemáticas sociopolíticas y económicas y de las realidades particulares de la región y del mundo.'),
(4, 'Ciencias Sociales y Humanas', 'Como unidad académico administrativa Integrada por los programa de DERECHO Y PSICOLOGÍA y a través del desarrollo de procesos propios de la investigación, docencia y extensión en las disciplinas de las ciencias sociales y humanas busca coadyuvar la formación de profesionales competentes para abordar los retos actuales de la posmodernidad, a la luz de los principios institucionales.'),
(5, 'Educación', 'La Facultad de Educación de la Institución Universitaria CESMAG es una organización administrativa, académica e investigativa que tiene la misión de formar a los nuevos maestros y maestras en las áreas de Educación Preescolar y Educación Física. \r\nEs una Facultad pinera en el departamento de Nariño, por cuanto sus dos licenciaturas se ofrecen como únicas a nivel presencial y gracias a su presencia durante 30 años ha posibilitado que la Educación Preescolar surja exitosamente en todos los municipios que hacen parte de la geografía nariñense; así mismo los talentos deportivos y la cultura física ocupan sitiales de prestigio gracias a la intervención pedagógica de la licenciatura en Educación Física. \r\nLa Facultad de Educación dirige todos sus esfuerzos en ofrecer una sólida formación pedagógica, metodológica y didáctica como soporte clave para el desempeño profesional con calidad y calidez. También tiene claro que en su proceso de formación el maestro debe asumir escenarios de investigación y de proyección social. La formación de maestros como líderes sociales y pedagógicos es la nuestra gran responsabilidad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `extencion_caracteres` int(10) NOT NULL,
  `extencion_lineas` int(11) NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `programa_id` (`programa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `nombre`, `extencion_caracteres`, `extencion_lineas`, `programa_id`) VALUES
(29, 'INTRODUCCIÓN', 2258, 31, 1),
(32, 'EL PROBLEMA DE INVESTIGACIÓN', 10000, 1000, 1),
(33, 'OBJETO O TEMA DE ESTUDIO', 146, 2, 1),
(34, 'ÁREA DE INVESTIGACIÓN', 728, 10, 1),
(35, 'LÍNEA DE INVESTIGACIÓN', 728, 10, 1),
(36, 'PLANTEAMIENTO DEL PROBLEMA', 2258, 31, 1),
(37, 'FORMULACIÓN DEL PROBLEMA', 364, 5, 1),
(38, 'OBJETIVOS DE LA INVESTIGACIÓN', 2000, 20, 1),
(39, 'Objetivo general', 219, 3, 1),
(40, 'Objetivos específicos', 1093, 15, 1),
(41, 'JUSTIFICACIÓN', 2258, 31, 1),
(42, 'VIABILIDAD O FACTIBILIDAD', 1457, 20, 1),
(49, 'DELIMITACIÓN', 364, 5, 1),
(50, 'TÓPICOS DEL MARCO TEÓRICO', 10000, 1000, 1),
(51, 'ANTECEDENTES', 4516, 62, 1),
(54, 'SUPUESTOS TEÓRICOS', 11291, 155, 1),
(56, 'INTRODUCCIÓN', 0, 0, 1),
(57, 'EL PROBLEMA DE INVESTIGACIÓN', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_contenidos`
--

CREATE TABLE IF NOT EXISTS `items_contenidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipo` tinytext NOT NULL,
  `items_documento_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `items_documento_id` (`items_documento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8291 ;

--
-- Volcado de datos para la tabla `items_contenidos`
--

INSERT INTO `items_contenidos` (`id`, `texto`, `tipo`, `items_documento_id`, `orden`) VALUES
(8033, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1549, 1),
(8034, 'Figura 3 Modelo en V.', '3', 1549, 2),
(8035, '107/1.png', '6', 1549, 3),
(8036, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1549, 4),
(8037, 'Continuando con el contenido que se plantea', '2', 1549, 5),
(8038, 'Otra línea de texto.', '2', 1549, 6),
(8039, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1551, 1),
(8040, 'Figura 3 Modelo en V.', '3', 1551, 2),
(8041, '107/2.png', '6', 1551, 3),
(8042, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1551, 4),
(8043, 'Continuando con el contenido que se plantea', '2', 1551, 5),
(8044, 'Otra línea de texto.', '2', 1551, 6),
(8045, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1552, 1),
(8046, 'Figura 3 Modelo en V.', '3', 1552, 2),
(8047, '107/3.png', '6', 1552, 3),
(8048, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1552, 4),
(8049, 'Continuando con el contenido que se plantea', '2', 1552, 5),
(8050, 'Otra línea de texto.', '2', 1552, 6),
(8051, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1553, 1),
(8052, 'Figura 3 Modelo en V.', '3', 1553, 2),
(8053, '107/4.png', '6', 1553, 3),
(8054, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1553, 4),
(8055, 'Continuando con el contenido que se plantea', '2', 1553, 5),
(8056, 'Otra línea de texto.', '2', 1553, 6),
(8057, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1554, 1),
(8058, 'Figura 3 Modelo en V.', '3', 1554, 2),
(8059, '107/5.png', '6', 1554, 3),
(8060, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1554, 4),
(8061, 'Continuando con el contenido que se plantea', '2', 1554, 5),
(8062, 'Otra línea de texto.', '2', 1554, 6),
(8063, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1555, 1),
(8064, 'Figura 3 Modelo en V.', '3', 1555, 2),
(8065, '107/6.png', '6', 1555, 3),
(8066, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1555, 4),
(8067, 'Continuando con el contenido que se plantea', '2', 1555, 5),
(8068, 'Otra línea de texto.', '2', 1555, 6),
(8069, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1556, 1),
(8070, 'Figura 3 Modelo en V.', '3', 1556, 2),
(8071, '107/7.png', '6', 1556, 3),
(8072, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1556, 4),
(8073, 'Continuando con el contenido que se plantea', '2', 1556, 5),
(8074, 'Otra línea de texto.', '2', 1556, 6),
(8075, 'Descripción del contenido del ítem.', '2', 1557, 1),
(8076, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1557, 2),
(8077, 'Figura 3 Modelo en V.', '3', 1557, 3),
(8078, '107/8.png', '6', 1557, 4),
(8079, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1557, 5),
(8080, 'Continuando con el contenido que se plantea', '2', 1557, 6),
(8081, 'Otra línea de texto.', '2', 1557, 7),
(8082, 'Descripción del contenido del ítem.', '2', 1558, 1),
(8083, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1558, 2),
(8084, 'Figura 3 Modelo en V.', '3', 1558, 3),
(8085, '107/9.png', '6', 1558, 4),
(8086, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1558, 5),
(8087, 'Continuando con el contenido que se plantea', '2', 1558, 6),
(8088, 'Otra línea de texto.', '2', 1558, 7),
(8089, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1559, 1),
(8090, 'Figura 3 Modelo en V.', '3', 1559, 2),
(8091, '107/10.png', '6', 1559, 3),
(8092, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1559, 4),
(8093, 'Continuando con el contenido que se plantea', '2', 1559, 5),
(8094, 'Otra línea de texto.', '2', 1559, 6),
(8095, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1560, 1),
(8096, 'Figura 3 Modelo en V.', '3', 1560, 2),
(8097, '107/11.png', '6', 1560, 3),
(8098, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1560, 4),
(8099, 'Continuando con el contenido que se plantea', '2', 1560, 5),
(8100, 'Otra línea de texto.', '2', 1560, 6),
(8101, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1561, 1),
(8102, 'Figura 3 Modelo en V.', '3', 1561, 2),
(8103, '107/12.png', '6', 1561, 3),
(8104, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1561, 4),
(8105, 'Continuando con el contenido que se plantea', '2', 1561, 5),
(8106, 'Otra línea de texto.', '2', 1561, 6),
(8107, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1563, 1),
(8108, 'Figura 3 Modelo en V.', '3', 1563, 2),
(8109, '107/13.png', '6', 1563, 3),
(8110, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1563, 4),
(8111, 'Continuando con el contenido que se plantea', '2', 1563, 5),
(8112, 'Otra línea de texto.', '2', 1563, 6),
(8113, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1564, 1),
(8114, 'Figura 3 Modelo en V.', '3', 1564, 2),
(8115, '107/14.png', '6', 1564, 3),
(8116, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1564, 4),
(8117, 'Continuando con el contenido que se plantea', '2', 1564, 5),
(8118, 'Otra línea de texto.', '2', 1564, 6),
(8119, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1565, 1),
(8120, 'Figura 3 Modelo en V.', '3', 1565, 2),
(8121, '108/1.png', '6', 1565, 3),
(8122, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1565, 4),
(8123, 'Continuando con el contenido que se plantea', '2', 1565, 5),
(8124, 'Otra línea de texto.', '2', 1565, 6),
(8125, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1567, 1),
(8126, 'Figura 3 Modelo en V.', '3', 1567, 2),
(8127, '108/2.png', '6', 1567, 3),
(8128, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1567, 4),
(8129, 'Continuando con el contenido que se plantea', '2', 1567, 5),
(8130, 'Otra línea de texto.', '2', 1567, 6),
(8131, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1568, 1),
(8132, 'Figura 3 Modelo en V.', '3', 1568, 2),
(8133, '108/3.png', '6', 1568, 3),
(8134, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1568, 4),
(8135, 'Continuando con el contenido que se plantea', '2', 1568, 5),
(8136, 'Otra línea de texto.', '2', 1568, 6),
(8137, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1569, 1),
(8138, 'Figura 3 Modelo en V.', '3', 1569, 2),
(8139, '108/4.png', '6', 1569, 3),
(8140, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1569, 4),
(8141, 'Continuando con el contenido que se plantea', '2', 1569, 5),
(8142, 'Otra línea de texto.', '2', 1569, 6),
(8143, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1570, 1),
(8144, 'Figura 3 Modelo en V.', '3', 1570, 2),
(8145, '108/5.png', '6', 1570, 3),
(8146, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1570, 4),
(8147, 'Continuando con el contenido que se plantea', '2', 1570, 5),
(8148, 'Otra línea de texto.', '2', 1570, 6),
(8149, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1571, 1),
(8150, 'Figura 3 Modelo en V.', '3', 1571, 2),
(8151, '108/6.png', '6', 1571, 3),
(8152, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1571, 4),
(8153, 'Continuando con el contenido que se plantea', '2', 1571, 5),
(8154, 'Otra línea de texto.', '2', 1571, 6),
(8155, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1572, 1),
(8156, 'Figura 3 Modelo en V.', '3', 1572, 2),
(8157, '108/7.png', '6', 1572, 3),
(8158, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1572, 4),
(8159, 'Continuando con el contenido que se plantea', '2', 1572, 5),
(8160, 'Otra línea de texto.', '2', 1572, 6),
(8161, 'Descripción del contenido del ítem.', '2', 1573, 1),
(8162, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1573, 2),
(8163, 'Figura 3 Modelo en V.', '3', 1573, 3),
(8164, '108/8.png', '6', 1573, 4),
(8165, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1573, 5),
(8166, 'Continuando con el contenido que se plantea', '2', 1573, 6),
(8167, 'Otra línea de texto.', '2', 1573, 7),
(8168, 'Descripción del contenido del ítem.', '2', 1574, 1),
(8169, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1574, 2),
(8170, 'Figura 3 Modelo en V.', '3', 1574, 3),
(8171, '108/9.png', '6', 1574, 4),
(8172, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1574, 5),
(8173, 'Continuando con el contenido que se plantea', '2', 1574, 6),
(8174, 'Otra línea de texto.', '2', 1574, 7),
(8175, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1575, 1),
(8176, 'Figura 3 Modelo en V.', '3', 1575, 2),
(8177, '108/10.png', '6', 1575, 3),
(8178, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1575, 4),
(8179, 'Continuando con el contenido que se plantea', '2', 1575, 5),
(8180, 'Otra línea de texto.', '2', 1575, 6),
(8181, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1576, 1),
(8182, 'Figura 3 Modelo en V.', '3', 1576, 2),
(8183, '108/11.png', '6', 1576, 3),
(8184, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1576, 4),
(8185, 'Continuando con el contenido que se plantea', '2', 1576, 5),
(8186, 'Otra línea de texto.', '2', 1576, 6),
(8187, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1577, 1),
(8188, 'Figura 3 Modelo en V.', '3', 1577, 2),
(8189, '108/12.png', '6', 1577, 3),
(8190, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1577, 4),
(8191, 'Continuando con el contenido que se plantea', '2', 1577, 5),
(8192, 'Otra línea de texto.', '2', 1577, 6),
(8193, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1579, 1),
(8194, 'Figura 3 Modelo en V.', '3', 1579, 2),
(8195, '108/13.png', '6', 1579, 3),
(8196, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1579, 4),
(8197, 'Continuando con el contenido que se plantea', '2', 1579, 5),
(8198, 'Otra línea de texto.', '2', 1579, 6),
(8199, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1580, 1),
(8200, 'Figura 3 Modelo en V.', '3', 1580, 2),
(8201, '108/14.png', '6', 1580, 3),
(8202, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1580, 4),
(8203, 'Continuando con el contenido que se plantea', '2', 1580, 5),
(8204, 'Otra línea de texto.', '2', 1580, 6),
(8205, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1581, 1),
(8206, 'Figura 3 Modelo en V.', '3', 1581, 2),
(8207, '109/1.png', '6', 1581, 3),
(8208, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1581, 4),
(8209, 'Continuando con el contenido que se plantea', '2', 1581, 5),
(8210, 'Otra línea de texto.', '2', 1581, 6),
(8211, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1583, 1),
(8212, 'Figura 3 Modelo en V.', '3', 1583, 2),
(8213, '109/2.png', '6', 1583, 3),
(8214, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1583, 4),
(8215, 'Continuando con el contenido que se plantea', '2', 1583, 5),
(8216, 'Otra línea de texto.', '2', 1583, 6),
(8217, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1584, 1),
(8218, 'Figura 3 Modelo en V.', '3', 1584, 2),
(8219, '109/3.png', '6', 1584, 3),
(8220, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1584, 4),
(8221, 'Continuando con el contenido que se plantea', '2', 1584, 5),
(8222, 'Otra línea de texto.', '2', 1584, 6),
(8223, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1585, 1),
(8224, 'Figura 3 Modelo en V.', '3', 1585, 2),
(8225, '109/4.png', '6', 1585, 3),
(8226, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1585, 4),
(8227, 'Continuando con el contenido que se plantea', '2', 1585, 5),
(8228, 'Otra línea de texto.', '2', 1585, 6),
(8229, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1586, 1),
(8230, 'Figura 3 Modelo en V.', '3', 1586, 2),
(8231, '109/5.png', '6', 1586, 3),
(8232, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1586, 4),
(8233, 'Continuando con el contenido que se plantea', '2', 1586, 5),
(8234, 'Otra línea de texto.', '2', 1586, 6),
(8235, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1587, 1),
(8236, 'Figura 3 Modelo en V.', '3', 1587, 2),
(8237, '109/6.png', '6', 1587, 3),
(8238, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1587, 4),
(8239, 'Continuando con el contenido que se plantea', '2', 1587, 5),
(8240, 'Otra línea de texto.', '2', 1587, 6),
(8241, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1588, 1),
(8242, 'Figura 3 Modelo en V.', '3', 1588, 2),
(8243, '109/7.png', '6', 1588, 3),
(8244, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1588, 4),
(8245, 'Continuando con el contenido que se plantea', '2', 1588, 5),
(8246, 'Otra línea de texto.', '2', 1588, 6),
(8247, 'Descripción del contenido del ítem.', '2', 1589, 1),
(8248, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1589, 2),
(8249, 'Figura 3 Modelo en V.', '3', 1589, 3),
(8250, '109/8.png', '6', 1589, 4),
(8251, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1589, 5),
(8252, 'Continuando con el contenido que se plantea', '2', 1589, 6),
(8253, 'Otra línea de texto.', '2', 1589, 7),
(8254, 'Descripción del contenido del ítem.', '2', 1590, 1),
(8255, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1590, 2),
(8256, 'Figura 3 Modelo en V.', '3', 1590, 3),
(8257, '109/9.png', '6', 1590, 4),
(8258, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1590, 5),
(8259, 'Continuando con el contenido que se plantea', '2', 1590, 6),
(8260, 'Otra línea de texto.', '2', 1590, 7),
(8261, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1591, 1),
(8262, 'Figura 3 Modelo en V.', '3', 1591, 2),
(8263, '109/10.png', '6', 1591, 3),
(8264, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1591, 4),
(8265, 'Continuando con el contenido que se plantea', '2', 1591, 5),
(8266, 'Otra línea de texto.', '2', 1591, 6),
(8267, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1592, 1),
(8268, 'Figura 3 Modelo en V.', '3', 1592, 2),
(8269, '109/11.png', '6', 1592, 3),
(8270, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1592, 4),
(8271, 'Continuando con el contenido que se plantea', '2', 1592, 5),
(8272, 'Otra línea de texto.', '2', 1592, 6),
(8273, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1593, 1),
(8274, 'Figura 3 Modelo en V.', '3', 1593, 2),
(8275, '109/12.png', '6', 1593, 3),
(8276, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1593, 4),
(8277, 'Continuando con el contenido que se plantea', '2', 1593, 5),
(8278, 'Otra línea de texto.', '2', 1593, 6),
(8279, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1595, 1),
(8280, 'Figura 3 Modelo en V.', '3', 1595, 2),
(8281, '109/13.png', '6', 1595, 3),
(8282, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1595, 4),
(8283, 'Continuando con el contenido que se plantea', '2', 1595, 5),
(8284, 'Otra línea de texto.', '2', 1595, 6),
(8285, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1596, 1),
(8286, 'Figura 3 Modelo en V.', '3', 1596, 2),
(8287, '109/14.png', '6', 1596, 3),
(8288, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1596, 4),
(8289, 'Continuando con el contenido que se plantea', '2', 1596, 5),
(8290, 'Otra línea de texto.', '2', 1596, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_documento`
--

CREATE TABLE IF NOT EXISTS `items_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caracteres` int(11) DEFAULT NULL,
  `documento_id` int(11) NOT NULL,
  `items_estandar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documento_id` (`documento_id`),
  KEY `items_estandar_id` (`items_estandar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1597 ;

--
-- Volcado de datos para la tabla `items_documento`
--

INSERT INTO `items_documento` (`id`, `caracteres`, `documento_id`, `items_estandar_id`) VALUES
(1549, 243, 107, 30),
(1550, 0, 107, 33),
(1551, 243, 107, 34),
(1552, 243, 107, 35),
(1553, 243, 107, 36),
(1554, 243, 107, 37),
(1555, 243, 107, 38),
(1556, 243, 107, 39),
(1557, 281, 107, 40),
(1558, 281, 107, 41),
(1559, 243, 107, 42),
(1560, 243, 107, 43),
(1561, 243, 107, 50),
(1562, 0, 107, 51),
(1563, 243, 107, 52),
(1564, 243, 107, 55),
(1565, 243, 108, 30),
(1566, 0, 108, 33),
(1567, 243, 108, 34),
(1568, 243, 108, 35),
(1569, 243, 108, 36),
(1570, 243, 108, 37),
(1571, 243, 108, 38),
(1572, 243, 108, 39),
(1573, 281, 108, 40),
(1574, 281, 108, 41),
(1575, 243, 108, 42),
(1576, 243, 108, 43),
(1577, 243, 108, 50),
(1578, 0, 108, 51),
(1579, 243, 108, 52),
(1580, 243, 108, 55),
(1581, 243, 109, 30),
(1582, 0, 109, 33),
(1583, 243, 109, 34),
(1584, 243, 109, 35),
(1585, 243, 109, 36),
(1586, 243, 109, 37),
(1587, 243, 109, 38),
(1588, 243, 109, 39),
(1589, 281, 109, 40),
(1590, 281, 109, 41),
(1591, 243, 109, 42),
(1592, 243, 109, 43),
(1593, 243, 109, 50),
(1594, 0, 109, 51),
(1595, 243, 109, 52),
(1596, 243, 109, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_estandares`
--

CREATE TABLE IF NOT EXISTS `items_estandares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items_estandar_id` int(11) DEFAULT '0',
  `nivel` int(11) DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `estandar_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estandar_id` (`estandar_id`),
  KEY `item_id` (`item_id`),
  KEY `items_estandar_id` (`items_estandar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `items_estandares`
--

INSERT INTO `items_estandares` (`id`, `items_estandar_id`, `nivel`, `orden`, `item_id`, `estandar_id`) VALUES
(0, NULL, 0, 0, NULL, NULL),
(30, 0, 0, 0, 29, 2),
(33, 0, 1, 1, 32, 2),
(34, 33, 2, 1, 33, 2),
(35, 33, 2, 2, 34, 2),
(36, 33, 2, 3, 35, 2),
(37, 33, 2, 4, 36, 2),
(38, 33, 2, 5, 37, 2),
(39, 33, 2, 6, 38, 2),
(40, 39, 3, 1, 39, 2),
(41, 39, 3, 2, 40, 2),
(42, 33, 2, 7, 41, 2),
(43, 33, 2, 8, 42, 2),
(50, 33, 2, 9, 49, 2),
(51, 0, 1, 2, 50, 2),
(52, 51, 2, 1, 51, 2),
(55, 51, 2, 2, 54, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE IF NOT EXISTS `lineas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `area_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`id`, `nombre`, `descripcion`, `area_id`) VALUES
(1, 'TICs aplicadas a la educación', 'Se denomina Tecnologías de la Información y la Comunicación al conjunto de procesos y productos, basados en herramientas de hardware y software para el almacenamiento, procesamiento, gestión y transmisión de información, experimentando un espacio de reflexión en torno a la educación como proceso de formación  del  hombre bajo el concepto de un ser multidimensional.', 1),
(3, 'Herramientas virtuales', '', 1),
(4, 'Mundos virtuales', '', 1),
(5, 'Seguridad informática', 'La seguridad en la informática abarca los conceptos de seguridad física y seguridad lógica. La seguridad física se refiere a la protección del hardware y de los soportes de datos, así como a la de los edificios e instalaciones que los albergan. Contempla las situaciones de incendios, sabotajes, robos, catástrofes naturales, etc. ', 3),
(6, 'Auditoría informática y de sistemas', 'La auditoria está encaminada a un objetivo específico que es el de evaluar la eficiencia y eficacia con que se está operando, por medio del señalamiento de cursos alternativos de acción, para que se tomen decisiones que permitan corregir los errores, en caso de que existan, o bien mejorar la forma de actuación.', 3),
(7, 'Análisis numérico', 'El análisis numérico se puede definir como la disciplina ocupada de describir, analizar y crear algoritmos numéricos que permitan resolver problemas matemáticos, en los que estén involucradas cantidades numéricas, con una precisión determinada.', 4),
(8, 'Aplicativos para la gestión de la información', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vinculo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `icono` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `texto`, `vinculo`, `icono`, `estado`, `menu_id`) VALUES
(1, 'Index', '/', '', 0, 0),
(2, 'Usuarios', '/personas', 'icon-group', 0, 1),
(5, 'Items', '/items', '', 0, 1),
(8, 'Estandares', '/estandares', 'icon-file-settings', 0, 1),
(11, 'Institución', '/administracion', 'icon-library', 0, 1),
(14, 'Programas', '/programas', '', 0, 1),
(17, 'Proyectos', '/proyectos', 'icon-suitcase', 0, 1),
(20, 'Controles', '/controles', '', 0, 1),
(23, 'Reportes', '/reportes', 'icon-stats', 0, 1),
(26, 'Notificaciones', '/notificaciones/index', 'icon-earth', 0, 1),
(27, 'Documentos', '/documentos', '', 0, 1),
(30, 'Entregas', '/entregas', '', 0, 1),
(33, 'Conogramas', '/controles/cronogramas', 'icon-calendar', 0, 1),
(34, 'Proyectos Asesorados', '/proyectos/asesor', 'icon-batman', 0, 1),
(35, 'Proyectos A Evaluar', '/proyectos/jurado', 'icon-auction', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus_niveles`
--

CREATE TABLE IF NOT EXISTS `menus_niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `menus_niveles`
--

INSERT INTO `menus_niveles` (`id`, `menu_id`, `nivel_id`, `orden`, `estado`) VALUES
(1, 2, 1, 1, 0),
(47, 8, 1, 2, 0),
(48, 11, 1, 3, 0),
(49, 17, 1, 4, 0),
(50, 23, 1, 5, 0),
(51, 26, 1, 6, 0),
(52, 33, 1, 7, 0),
(53, 34, 1, 8, 0),
(54, 35, 1, 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE IF NOT EXISTS `niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Tiene acceso total.'),
(2, 'Administrador facultad', 'Gestiones de facultad.'),
(3, 'Administrador programa', 'Gestiones de programa.'),
(4, 'Profesional', 'Corrección y seguimiento de trabajo de grado.'),
(5, 'Estudiante', 'Presentación de trabajo de grado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tiposparametro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tiposparametro_id` (`tiposparametro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `nombre`, `valor`, `tiposparametro_id`) VALUES
(1, 'Aprobado', '2EFE2E', 1),
(2, 'Aprobado con correcciones', 'FE9A2E', 1),
(3, 'No aprobado', '882222', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'recursos/escudo400.png',
  `identificacion` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `programa_id` int(11) DEFAULT NULL,
  `facultad_id` int(11) DEFAULT NULL,
  `tiposusuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tiposusuario_id` (`tiposusuario_id`),
  KEY `programa_Id` (`programa_id`),
  KEY `facultad_id` (`facultad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=176 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `avatar`, `identificacion`, `nombre`, `apellido`, `email`, `programa_id`, `facultad_id`, `tiposusuario_id`) VALUES
(1, '1.jpg', '24', 'Gerson', 'Eraso Torres', 'geraso@hotmail.com', NULL, 1, 1),
(2, '1.jpg', '1085288762', 'Manuel', 'Calvache', 'mcalvache@hotmail.com', 1, 1, 2),
(3, '1.jpg', '1085288768', 'Luis Carlos', 'Revelo Tobar', 'lrevelo@hotmail.com', 1, 1, 3),
(4, '', '2312', 'Arturo', 'Eraso Torres', 'aeraso@hotmail.com', 1, 1, 4),
(5, '', '12213', 'Servio', 'Pantoja', 'spantoja@hotmail.com', 1, 1, 5),
(161, '1.jpg', '222', 'francisco', 'rojas', '22@hotmail.com', 1, 1, 5),
(162, '1.jpg', '12312', 'Mauricio', 'Cassanova', 'aaa@hotmail.com', 1, 1, 4),
(164, '1.jpg', '1212', 'Mayrita', 'Meneses', 'MMENESES@hotmail.com', 1, 1, 5),
(165, '1.jpg', '12', '12', '12', '121qho@hotmal.com', NULL, NULL, 1),
(166, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(167, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(168, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(169, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(170, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(171, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(172, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(173, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(174, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1),
(175, '1.jpg', '123', '123', '123', '12@hotmail.com', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_proyectos`
--

CREATE TABLE IF NOT EXISTS `personas_proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_id` (`proyecto_id`),
  KEY `persona_id` (`persona_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Volcado de datos para la tabla `personas_proyectos`
--

INSERT INTO `personas_proyectos` (`id`, `proyecto_id`, `persona_id`, `rol_id`) VALUES
(33, 107, 164, 3),
(35, 107, 2, 1),
(36, 107, 1, 1),
(49, 108, 164, 3),
(50, 108, 165, 2),
(51, 109, 5, 3),
(52, 109, 161, 3),
(53, 109, 3, 1),
(54, 109, 162, 1),
(55, 109, 4, 2),
(56, 108, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE IF NOT EXISTS `programas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo SNIES` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `facultad_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo SNIES` (`codigo SNIES`),
  KEY `facultad_id` (`facultad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `codigo SNIES`, `nombre`, `descripcion`, `facultad_id`) VALUES
(1, '90715', 'Ingeniería de sistemas', 'La Ingeniería de Sistemas de la Institución Universitaria CESMAG está orientada hacia el procesamiento, análisis, diseño, control, distribución, seguridad e interpretación de toda clase de información, para ser utilizada confiable y eficientemente en procesos de desarrollo de software, que permitan aportar en la innovación tecnológica bajo criterios de competitividad y responsabilidad social, en los diferentes ámbitos de orden regional, nacional e internacional. ', 1),
(3, '90716', 'Arquitectura', NULL, 2),
(5, '90718', 'Diseño grafico', NULL, 2),
(6, '90719', 'Administración de Empresas', NULL, 3),
(7, '90711', 'Contaduría Pública', NULL, 3),
(8, '90712', 'Tec. Contabilidad y Finanzas', NULL, 3),
(9, '90713', 'Tec. Gestión Financiera', NULL, 3),
(14, '90714', 'Lic. en Educación Fí­sica', NULL, 5),
(15, '90725', 'Lic. en Educación Preescolar', NULL, 5),
(16, '90724', 'Derecho', NULL, 4),
(17, '90722', 'Psicología', NULL, 4),
(18, '90723', 'Ingeniería electrónica', 'Ingeniería Electrónica de la Institución Universitaria CESMAG se propone como un programa académico que busca explotar la creatividad de sus estudiantes en la resolución de problemas, necesidades o requerimientos del contexto regional, nacional e internacional a través de la concepción, el diseño, la implementación y la operación de los dispositivos electrónicos (objeto de estudio). ', 1),
(19, '90731', 'Ingeniería mecanica', 'asdsadsa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `programa` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `linea_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`),
  KEY `linea_id` (`linea_id`),
  KEY `codigo` (`codigo`),
  KEY `programa` (`programa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=110 ;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `codigo`, `titulo`, `programa`, `area_id`, `linea_id`) VALUES
(107, '1', 'Proyecto CSS3 orientado a objetos', 1, 3, 6),
(108, '1', 'Sistema de información para el cafe SISPRO', 1, 1, 1),
(109, 'ST001', 'SISTRAG: Sistema de información para el control de trabajos de grado.', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Jurado'),
(2, 'Asesor'),
(3, 'Investigador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposestandares`
--

CREATE TABLE IF NOT EXISTS `tiposestandares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tiposestandares`
--

INSERT INTO `tiposestandares` (`id`, `nombre`) VALUES
(1, 'Propuesta'),
(2, 'Proyecto'),
(3, 'Informe Final');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposparametros`
--

CREATE TABLE IF NOT EXISTS `tiposparametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tiposparametros`
--

INSERT INTO `tiposparametros` (`id`, `nombre`) VALUES
(1, 'Conceptos evaluativos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposusuarios`
--

CREATE TABLE IF NOT EXISTS `tiposusuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(40) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tiposusuarios`
--

INSERT INTO `tiposusuarios` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrativo institucional', NULL),
(2, 'Administrativo facultad', NULL),
(3, 'Administrativo programa', NULL),
(4, 'Docente', NULL),
(5, 'Estudiante', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(30) CHARACTER SET latin1 NOT NULL,
  `password` char(50) CHARACTER SET latin1 NOT NULL,
  `persona_id` int(11) NOT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `persona_id` (`persona_id`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=176 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `persona_id`, `nivel_id`) VALUES
(1, 'administrador', '4df2135580d23c4003d9275d67328babd46a1c50', 1, 1),
(2, 'decano', '4df2135580d23c4003d9275d67328babd46a1c50', 2, 2),
(3, 'director', '4df2135580d23c4003d9275d67328babd46a1c50', 3, 3),
(4, 'docente', '4df2135580d23c4003d9275d67328babd46a1c50', 4, 4),
(5, 'estudiante', '4df2135580d23c4003d9275d67328babd46a1c50', 5, 5),
(161, '123', '4df2135580d23c4003d9275d67328babd46a1c50', 161, 1),
(162, 'aaa', 'aaa', 162, 1),
(164, 'MMeneses', 'MMeneses', 164, 5),
(165, '123', '123', 165, 1),
(166, '123', '123', 166, 1),
(167, '123', '123', 167, 1),
(168, '123', '123', 168, 1),
(169, '123', '123', 169, 1),
(170, '123', '123', 170, 1),
(171, '123', '123', 171, 1),
(172, '123', '123', 172, 1),
(173, '123', '123', 173, 1),
(174, '123', '123', 174, 1),
(175, '123', '123', 175, 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `contenido por items`
--
DROP TABLE IF EXISTS `contenido por items`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contenido por items` AS select `items`.`nombre` AS `nombre`,`items_contenidos`.`texto` AS `texto` from (((`items_documento` join `items_contenidos` on((`items_documento`.`id` = `items_contenidos`.`items_documento_id`))) join `items_estandares` on((`items_documento`.`items_estandar_id` = `items_estandares`.`id`))) join `items` on((`items`.`id` = `items_estandares`.`item_id`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `controles`
--
ALTER TABLE `controles`
  ADD CONSTRAINT `controles_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `controles_ibfk_2` FOREIGN KEY (`estandar_id`) REFERENCES `estandares` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleentregas`
--
ALTER TABLE `detalleentregas`
  ADD CONSTRAINT `detalleentregas_ibfk_1` FOREIGN KEY (`entrega_id`) REFERENCES `entregas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleentregas_ibfk_2` FOREIGN KEY (`personas_proyecto_id`) REFERENCES `personas_proyectos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleentregas_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `veredicto_fk` FOREIGN KEY (`parametro_veredicto_id`) REFERENCES `parametros` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`estandar_id`) REFERENCES `estandares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entregas_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `estandares`
--
ALTER TABLE `estandares`
  ADD CONSTRAINT `estandares_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estandares_ibfk_3` FOREIGN KEY (`tiposestandar_id`) REFERENCES `tiposestandares` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_1` FOREIGN KEY (`parametro_concepto_id`) REFERENCES `parametros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluaciones_ibfk_2` FOREIGN KEY (`items_documento_id`) REFERENCES `items_documento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluaciones_ibfk_3` FOREIGN KEY (`detalles_entrega_id`) REFERENCES `detalleentregas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `items_contenidos`
--
ALTER TABLE `items_contenidos`
  ADD CONSTRAINT `items_contenidos_ibfk_1` FOREIGN KEY (`items_documento_id`) REFERENCES `items_documento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `items_documento`
--
ALTER TABLE `items_documento`
  ADD CONSTRAINT `items_documento_ibfk_1` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_documento_ibfk_2` FOREIGN KEY (`items_estandar_id`) REFERENCES `items_estandares` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `items_estandares`
--
ALTER TABLE `items_estandares`
  ADD CONSTRAINT `items_estandares_ibfk_3` FOREIGN KEY (`estandar_id`) REFERENCES `estandares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_estandares_ibfk_5` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_estandares_ibfk_6` FOREIGN KEY (`items_estandar_id`) REFERENCES `items_estandares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `menus_niveles`
--
ALTER TABLE `menus_niveles`
  ADD CONSTRAINT `menus_niveles_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menus_niveles_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD CONSTRAINT `parametros_ibfk_1` FOREIGN KEY (`tiposparametro_id`) REFERENCES `tiposparametros` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_ibfk_3` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_ibfk_4` FOREIGN KEY (`tiposusuario_id`) REFERENCES `tiposusuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_proyectos`
--
ALTER TABLE `personas_proyectos`
  ADD CONSTRAINT `personas_proyectos_ibfk_3` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_proyectos_ibfk_4` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_proyectos_ibfk_5` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_ibfk_1` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `proyectos_ibfk_3` FOREIGN KEY (`programa`) REFERENCES `programas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

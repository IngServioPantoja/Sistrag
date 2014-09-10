-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2014 a las 03:28:47
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `programa_id`) VALUES
(1, 'TICs', '', 1),
(3, 'Gestión de la información', '', 1),
(4, 'Matematícas aplicadas', '', 1),
(5, 'Administración BIG DATA', 'Todo lo relacionado con grandes tamaño de información en cada una de sus ramas', 1),
(6, 'Arquitectura empresarial', '', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Volcado de datos para la tabla `detalleentregas`
--

INSERT INTO `detalleentregas` (`id`, `entrega_id`, `personas_proyecto_id`, `estado_id`, `fecha_estado`, `parametro_veredicto_id`, `correcciones`, `comentarios`) VALUES
(76, 3298, NULL, 1, '2014-08-01', NULL, NULL, ''),
(77, 3299, NULL, 2, '2014-08-02', NULL, NULL, ''),
(78, 3299, 58, 2, '2014-09-03', NULL, NULL, ''),
(79, 3300, NULL, 1, '2014-08-01', NULL, NULL, ''),
(80, 3301, NULL, 2, '2014-08-11', NULL, NULL, ''),
(81, 3301, 58, 2, '2014-09-03', NULL, NULL, ''),
(82, 3302, NULL, 1, '2014-08-03', NULL, NULL, ''),
(83, 3303, NULL, 2, '2014-08-08', NULL, NULL, ''),
(84, 3303, 58, 2, '2014-09-03', NULL, NULL, ''),
(85, 3304, 53, 3, '2014-09-02', NULL, NULL, 'aaaasd'),
(86, 3304, 54, 1, '2014-08-18', NULL, NULL, ''),
(87, 3307, 53, 3, '2014-09-03', NULL, NULL, 'ssasasdasd'),
(88, 3307, 54, 1, '2014-08-18', NULL, NULL, ''),
(89, 3309, 53, 3, '2014-08-18', 1, NULL, ''),
(90, 3309, 54, 1, '2014-08-18', NULL, NULL, ''),
(91, 3310, 53, 3, '2014-09-03', NULL, NULL, 'qweqwe');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=120 ;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `fecha_guardado`, `enlace`, `enviado`, `estandar_id`, `proyecto_id`) VALUES
(113, '2014-08-01 09:48:09', '', 1, 2, 108),
(114, '2014-08-01 10:56:34', '', 1, 3, 108),
(115, '2014-08-03 10:06:48', '', 1, 2, 108),
(116, '2014-08-18 10:32:33', '', 1, 4, 109),
(117, '2014-08-18 10:37:05', '', 1, 4, 109),
(118, '2014-08-18 11:10:26', '', 1, 4, 109),
(119, '2014-08-28 08:57:10', '', 1, 3, 109);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3312 ;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `fecha_entrega`, `rol_id`, `documento_id`) VALUES
(3298, '2014-08-01', 2, 113),
(3299, '2014-08-01', 1, 113),
(3300, '2014-08-01', 2, 114),
(3301, '2014-08-01', 1, 114),
(3302, '2014-08-03', 2, 115),
(3303, '2014-08-03', 1, 115),
(3304, '2014-08-18', 1, 116),
(3305, '2014-08-18', 2, 116),
(3306, '2014-08-18', 2, 117),
(3307, '2014-08-18', 1, 117),
(3308, '2014-08-18', 2, 118),
(3309, '2014-08-18', 1, 118),
(3310, '2014-08-28', 1, 119),
(3311, '2014-08-28', 2, 119);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `estandares`
--

INSERT INTO `estandares` (`id`, `nombre`, `inicio vigencia`, `fin vigencia`, `programa_id`, `tiposestandar_id`) VALUES
(2, 'Trabajo de grado', '2014-03-04', '2014-03-19', 1, 2),
(3, 'Trabajo de grado', '2014-07-17', '2014-07-25', 1, 1),
(4, 'Trabajo de grado', '0000-00-00', '0000-00-00', 1, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1413 ;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `items_documento_id`, `detalles_entrega_id`, `parametro_concepto_id`, `comentarios`) VALUES
(1263, 1631, 76, 3, ''),
(1264, 1632, 76, 3, ''),
(1265, 1633, 76, 3, ''),
(1266, 1634, 76, 3, ''),
(1267, 1635, 76, 3, ''),
(1268, 1636, 76, 3, ''),
(1269, 1637, 76, 3, ''),
(1270, 1638, 76, 3, ''),
(1271, 1639, 76, 3, ''),
(1272, 1640, 76, 3, ''),
(1273, 1641, 76, 3, ''),
(1274, 1642, 76, 3, ''),
(1275, 1643, 76, 3, ''),
(1276, 1644, 76, 3, ''),
(1277, 1645, 76, 3, ''),
(1278, 1631, 77, 3, ''),
(1279, 1632, 77, 1, 'Observaciones, mejor dicho debe de hacerlo mucho mejor tiene problemas de redaccion y otras coas peores no se entiende queq ueire decir..'),
(1280, 1633, 77, 1, 'asdasd'),
(1281, 1634, 77, 1, 'asd'),
(1282, 1635, 77, 1, 'asd'),
(1283, 1636, 77, 3, ''),
(1284, 1637, 77, 3, ''),
(1285, 1638, 77, 3, ''),
(1286, 1639, 77, 3, ''),
(1287, 1640, 77, 3, ''),
(1288, 1641, 77, 3, ''),
(1289, 1642, 77, 3, ''),
(1290, 1643, 77, 3, ''),
(1291, 1644, 77, 3, ''),
(1292, 1645, 77, 3, ''),
(1293, 1631, 78, 3, ''),
(1294, 1632, 78, 3, ''),
(1295, 1633, 78, 3, ''),
(1296, 1634, 78, 3, ''),
(1297, 1635, 78, 3, ''),
(1298, 1636, 78, 3, ''),
(1299, 1637, 78, 3, ''),
(1300, 1638, 78, 3, ''),
(1301, 1639, 78, 3, ''),
(1302, 1640, 78, 3, ''),
(1303, 1641, 78, 3, ''),
(1304, 1642, 78, 3, ''),
(1305, 1643, 78, 3, ''),
(1306, 1644, 78, 3, ''),
(1307, 1645, 78, 3, ''),
(1308, 1647, 79, 3, ''),
(1309, 1648, 79, 3, ''),
(1310, 1649, 79, 3, ''),
(1311, 1650, 79, 3, ''),
(1312, 1651, 79, 3, ''),
(1313, 1652, 79, 3, ''),
(1314, 1653, 79, 3, ''),
(1315, 1654, 79, 3, ''),
(1316, 1655, 79, 3, ''),
(1317, 1656, 79, 3, ''),
(1318, 1647, 80, 3, ''),
(1319, 1648, 80, 3, ''),
(1320, 1649, 80, 3, ''),
(1321, 1650, 80, 3, ''),
(1322, 1651, 80, 3, ''),
(1323, 1652, 80, 3, ''),
(1324, 1653, 80, 3, ''),
(1325, 1654, 80, 3, ''),
(1326, 1655, 80, 3, ''),
(1327, 1656, 80, 3, ''),
(1328, 1647, 81, 3, ''),
(1329, 1648, 81, 3, ''),
(1330, 1649, 81, 3, ''),
(1331, 1650, 81, 3, ''),
(1332, 1651, 81, 3, ''),
(1333, 1652, 81, 3, ''),
(1334, 1653, 81, 3, ''),
(1335, 1654, 81, 3, ''),
(1336, 1655, 81, 3, ''),
(1337, 1656, 81, 3, ''),
(1338, 1658, 82, 3, ''),
(1339, 1659, 82, 3, ''),
(1340, 1660, 82, 3, ''),
(1341, 1661, 82, 3, ''),
(1342, 1662, 82, 3, ''),
(1343, 1663, 82, 3, ''),
(1344, 1664, 82, 3, ''),
(1345, 1665, 82, 3, ''),
(1346, 1666, 82, 3, ''),
(1347, 1667, 82, 3, ''),
(1348, 1668, 82, 3, ''),
(1349, 1669, 82, 3, ''),
(1350, 1670, 82, 3, ''),
(1351, 1671, 82, 3, ''),
(1352, 1672, 82, 3, ''),
(1353, 1658, 83, 3, ''),
(1354, 1659, 83, 3, ''),
(1355, 1660, 83, 3, ''),
(1356, 1661, 83, 3, ''),
(1357, 1662, 83, 3, ''),
(1358, 1663, 83, 3, ''),
(1359, 1664, 83, 3, ''),
(1360, 1665, 83, 3, ''),
(1361, 1666, 83, 3, ''),
(1362, 1667, 83, 3, ''),
(1363, 1668, 83, 3, ''),
(1364, 1669, 83, 3, ''),
(1365, 1670, 83, 3, ''),
(1366, 1671, 83, 3, ''),
(1367, 1672, 83, 3, ''),
(1368, 1658, 84, 3, ''),
(1369, 1659, 84, 3, ''),
(1370, 1660, 84, 3, ''),
(1371, 1661, 84, 3, ''),
(1372, 1662, 84, 3, ''),
(1373, 1663, 84, 3, ''),
(1374, 1664, 84, 3, ''),
(1375, 1665, 84, 3, ''),
(1376, 1666, 84, 3, ''),
(1377, 1667, 84, 3, ''),
(1378, 1668, 84, 3, ''),
(1379, 1669, 84, 3, ''),
(1380, 1670, 84, 3, ''),
(1381, 1671, 84, 3, ''),
(1382, 1672, 84, 3, ''),
(1383, 1674, 85, 3, ''),
(1384, 1675, 85, 3, ''),
(1385, 1676, 85, 3, ''),
(1386, 1677, 85, 3, ''),
(1387, 1678, 85, 3, ''),
(1388, 1674, 86, 3, ''),
(1389, 1675, 86, 3, ''),
(1390, 1676, 86, 3, ''),
(1391, 1677, 86, 3, ''),
(1392, 1678, 86, 3, ''),
(1393, 1680, 87, 3, ''),
(1394, 1681, 87, 3, ''),
(1395, 1682, 87, 3, ''),
(1396, 1683, 87, 3, ''),
(1397, 1684, 87, 3, ''),
(1398, 1680, 88, 3, ''),
(1399, 1681, 88, 3, ''),
(1400, 1682, 88, 3, ''),
(1401, 1683, 88, 3, ''),
(1402, 1684, 88, 3, ''),
(1403, 1686, 89, 3, 'asd'),
(1404, 1687, 89, 3, 'asd'),
(1405, 1688, 89, 3, 'asdadsa'),
(1406, 1689, 89, 3, 'asd'),
(1407, 1690, 89, 3, 'asdasdas'),
(1408, 1686, 90, 3, ''),
(1409, 1687, 90, 3, ''),
(1410, 1688, 90, 3, ''),
(1411, 1689, 90, 3, ''),
(1412, 1690, 90, 3, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

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
(57, 'EL PROBLEMA DE INVESTIGACIÓN', 0, 0, 1),
(58, 'a', 0, 0, 1),
(59, 'b', 0, 0, 1),
(60, 'c', 0, 0, 1),
(61, 'd', 0, 0, 1),
(62, 'e', 0, 0, 1),
(63, 'f', 0, 0, 1),
(66, 'aa', 0, 0, 1),
(68, 'bb', 0, 0, 1),
(69, 'cc', 0, 0, 1),
(70, 'dd', 0, 0, 1),
(71, 'eee', 0, 0, 1),
(72, 'ff', 0, 0, 1),
(73, '1', 0, 0, 1),
(74, '2', 0, 0, 1),
(75, '3', 0, 0, 1),
(76, '4', 0, 0, 1),
(77, '5', 0, 0, 1),
(78, '6', 0, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8735 ;

--
-- Volcado de datos para la tabla `items_contenidos`
--

INSERT INTO `items_contenidos` (`id`, `texto`, `tipo`, `items_documento_id`, `orden`) VALUES
(8419, 'Esto depende del proyecto qdasddddddddddddddddddddddddddasdddddddddddddddddddddddddue se está desarrollando por parte de los autores. ', '2', 1630, 1),
(8420, 'Figura 3 Modelo en V.', '3', 1630, 2),
(8421, '113/1.png', '6', 1630, 3),
(8422, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1630, 4),
(8423, 'Continuando con el contdasddddddddddddddddddddddddddasddddddddddddddddddddddddddasdddddddddddddddddddddddddenido que se plantea', '2', 1630, 5),
(8424, 'Otra línea de texto.', '2', 1630, 6),
(8425, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1632, 1),
(8426, 'Figura 3 Modelo en V.', '3', 1632, 2),
(8427, '113/2.png', '6', 1632, 3),
(8428, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1632, 4),
(8429, 'Continuando con el contdasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasdddddddddddddddddddddddddenido que se plantea', '2', 1632, 5),
(8430, 'Otra línea de texto.', '2', 1632, 6),
(8431, 'Esto depende del proyecto qdasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasdddddddddddddddddddddddddue se está desarrollando por parte de los autores. ', '2', 1633, 1),
(8432, 'Figura 3 Modelo en V.', '3', 1633, 2),
(8433, '113/3.png', '6', 1633, 3),
(8434, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1633, 4),
(8435, 'Continuando con el contenido dasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasdddddddddddddddddddddddddque se plantea', '2', 1633, 5),
(8436, 'Otra línea de texto.', '2', 1633, 6),
(8437, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1634, 1),
(8438, 'Figura 3 Modelo en V.', '3', 1634, 2),
(8439, '113/4.png', '6', 1634, 3),
(8440, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1634, 4),
(8441, 'Continuando con el contenido qudasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddde se plantea', '2', 1634, 5),
(8442, 'Otra línea de texto.', '2', 1634, 6),
(8443, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1635, 1),
(8444, 'Figura 3 Modelo en V.', '3', 1635, 2),
(8445, '113/5.png', '6', 1635, 3),
(8446, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1635, 4),
(8447, 'Continuando con el contendasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasdddddddddddddddddddddddddido que se plantea', '2', 1635, 5),
(8448, 'Otra línea de texto.', '2', 1635, 6),
(8449, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1636, 1),
(8450, 'Figura 3 Modelo en V.', '3', 1636, 2),
(8451, '113/6.png', '6', 1636, 3),
(8452, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1636, 4),
(8453, 'Continuando con el contenido que se plantea', '2', 1636, 5),
(8454, 'Otra línea de texto.', '2', 1636, 6),
(8455, 'Esto depende del proyectodasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddd que se está desarrollando por parte de los autores. ', '2', 1637, 1),
(8456, 'Figura 3 Modelo en V.', '3', 1637, 2),
(8457, '113/7.png', '6', 1637, 3),
(8458, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1637, 4),
(8459, 'Continuando con el contenido qudasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddde se plantea', '2', 1637, 5),
(8460, 'Otra línea de texto.', '2', 1637, 6),
(8461, 'Descripción del contenido del ítem.', '2', 1638, 1),
(8462, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1638, 2),
(8463, 'Figura 3 Modelo en V.', '3', 1638, 3),
(8464, '113/8.png', '6', 1638, 4),
(8465, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1638, 5),
(8466, 'Continuando con el contenido qudasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddde se plantea', '2', 1638, 6),
(8467, 'Otra línea de texto.', '2', 1638, 7),
(8468, 'Descripción del contenido del ítem.', '2', 1639, 1),
(8469, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1639, 2),
(8470, 'Figura 3 Modelo en V.', '3', 1639, 3),
(8471, '113/9.png', '6', 1639, 4),
(8472, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1639, 5),
(8473, 'Continuando con el contenido qdasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasdddddddddddddddddddddddddue se plantea', '2', 1639, 6),
(8474, 'Otra línea de texto.', '2', 1639, 7),
(8475, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1640, 1),
(8476, 'Figura 3 Modelo en V.', '3', 1640, 2),
(8477, '113/10.png', '6', 1640, 3),
(8478, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1640, 4),
(8479, 'Continuando con el contenido qudasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddddasddddddddddddddddddddddddd se plantea', '2', 1640, 5),
(8480, 'Otra línea de texto.', '2', 1640, 6),
(8481, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1641, 1),
(8482, 'Figura 3 Modelo en V.', '3', 1641, 2),
(8483, '113/11.png', '6', 1641, 3),
(8484, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1641, 4),
(8485, 'Continuando con el contenido que se plantea', '2', 1641, 5),
(8486, 'Otra línea de texto.', '2', 1641, 6),
(8487, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1642, 1),
(8488, 'Figura 3 Modelo en V.', '3', 1642, 2),
(8489, '113/12.png', '6', 1642, 3),
(8490, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1642, 4),
(8491, 'Continuando con el contenido que se plantea', '2', 1642, 5),
(8492, 'Otra línea de texto.', '2', 1642, 6),
(8493, 'Esto depende del proyecto que se está desardasdddddddddddddddddddddddddrollando por parte de los autores. ', '2', 1644, 1),
(8494, 'Figura 3 Modelo en V.', '3', 1644, 2),
(8495, '113/13.png', '6', 1644, 3),
(8496, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1644, 4),
(8497, 'Continuando con el conteniddasddddddddddddddddddddddddddasdddddddddddddddddddddddddo que se plantea', '2', 1644, 5),
(8498, 'Otra línea de texto.', '2', 1644, 6),
(8499, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1645, 1),
(8500, 'Figura 3 Modelo en V.', '3', 1645, 2),
(8501, '113/14.png', '6', 1645, 3),
(8502, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1645, 4),
(8503, 'Continuando con el contenido que se plantea', '2', 1645, 5),
(8504, 'Otra línea de texto.', '2', 1645, 6),
(8505, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1646, 1),
(8506, 'Figura 3 Modelo en V.', '3', 1646, 2),
(8507, '114/1.png', '6', 1646, 3),
(8508, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1646, 4),
(8509, 'Continuando con el contenido que se plantea', '2', 1646, 5),
(8510, 'Otra línea de texto.', '2', 1646, 6),
(8511, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1648, 1),
(8512, 'Figura 3 Modelo en V.', '3', 1648, 2),
(8513, '114/2.png', '6', 1648, 3),
(8514, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1648, 4),
(8515, 'Continuando con el contenido que se plantea', '2', 1648, 5),
(8516, 'Otra línea de texto.', '2', 1648, 6),
(8517, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1650, 1),
(8518, 'Figura 3 Modelo en V.', '3', 1650, 2),
(8519, '114/3.png', '6', 1650, 3),
(8520, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1650, 4),
(8521, 'Continuando con el contenido que se plantea', '2', 1650, 5),
(8522, 'Otra línea de texto.', '2', 1650, 6),
(8523, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1652, 1),
(8524, 'Figura 3 Modelo en V.', '3', 1652, 2),
(8525, '114/4.png', '6', 1652, 3),
(8526, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1652, 4),
(8527, 'Continuando con el contenido que se plantea', '2', 1652, 5),
(8528, 'Otra línea de texto.', '2', 1652, 6),
(8529, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1654, 1),
(8530, 'Figura 3 Modelo en V.', '3', 1654, 2),
(8531, '114/5.png', '6', 1654, 3),
(8532, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1654, 4),
(8533, 'Continuando con el contenido que se plantea', '2', 1654, 5),
(8534, 'Otra línea de texto.', '2', 1654, 6),
(8535, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1656, 1),
(8536, 'Figura 3 Modelo en V.', '3', 1656, 2),
(8537, '114/6.png', '6', 1656, 3),
(8538, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1656, 4),
(8539, 'Continuando con el contenido que se plantea', '2', 1656, 5),
(8540, 'Otra línea de texto.', '2', 1656, 6),
(8541, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1657, 1),
(8542, 'Figura 3 Modelo en V.', '3', 1657, 2),
(8543, '115/1.png', '6', 1657, 3),
(8544, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1657, 4),
(8545, 'Continuando con el contenido que se plantea', '2', 1657, 5),
(8546, 'Otra línea de texto.', '2', 1657, 6),
(8547, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1659, 1),
(8548, 'Figura 3 Modelo en V.', '3', 1659, 2),
(8549, '115/2.png', '6', 1659, 3),
(8550, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1659, 4),
(8551, 'Continuando con el contenido que se plantea', '2', 1659, 5),
(8552, 'Otra línea de texto.', '2', 1659, 6),
(8553, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1660, 1),
(8554, 'Figura 3 Modelo en V.', '3', 1660, 2),
(8555, '115/3.png', '6', 1660, 3),
(8556, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1660, 4),
(8557, 'Continuando con el contenido que se plantea', '2', 1660, 5),
(8558, 'Otra línea de texto.', '2', 1660, 6),
(8559, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1661, 1),
(8560, 'Figura 3 Modelo en V.', '3', 1661, 2),
(8561, '115/4.png', '6', 1661, 3),
(8562, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1661, 4),
(8563, 'Continuando con el contenido que se plantea', '2', 1661, 5),
(8564, 'Otra línea de texto.', '2', 1661, 6),
(8565, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1662, 1),
(8566, 'Figura 3 Modelo en V.', '3', 1662, 2),
(8567, '115/5.png', '6', 1662, 3),
(8568, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1662, 4),
(8569, 'Continuando con el contenido que se plantea', '2', 1662, 5),
(8570, 'Otra línea de texto.', '2', 1662, 6),
(8571, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1663, 1),
(8572, 'Figura 3 Modelo en V.', '3', 1663, 2),
(8573, '115/6.png', '6', 1663, 3),
(8574, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1663, 4),
(8575, 'Continuando con el contenido que se plantea', '2', 1663, 5),
(8576, 'Otra línea de texto.', '2', 1663, 6),
(8577, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1664, 1),
(8578, 'Figura 3 Modelo en V.', '3', 1664, 2),
(8579, '115/7.png', '6', 1664, 3),
(8580, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1664, 4),
(8581, 'Continuando con el contenido que se plantea', '2', 1664, 5),
(8582, 'Otra línea de texto.', '2', 1664, 6),
(8583, 'Descripción del contenido del ítem.', '2', 1665, 1),
(8584, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1665, 2),
(8585, 'Figura 3 Modelo en V.', '3', 1665, 3),
(8586, '115/8.png', '6', 1665, 4),
(8587, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1665, 5),
(8588, 'Continuando con el contenido que se plantea', '2', 1665, 6),
(8589, 'Otra línea de texto.', '2', 1665, 7),
(8590, 'Descripción del contenido del ítem.', '2', 1666, 1),
(8591, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1666, 2),
(8592, 'Figura 3 Modelo en V.', '3', 1666, 3),
(8593, '115/9.png', '6', 1666, 4),
(8594, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1666, 5),
(8595, 'Continuando con el contenido que se plantea', '2', 1666, 6),
(8596, 'Otra línea de texto.', '2', 1666, 7),
(8597, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1667, 1),
(8598, 'Figura 3 Modelo en V.', '3', 1667, 2),
(8599, '115/10.png', '6', 1667, 3),
(8600, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1667, 4),
(8601, 'Continuando con el contenido que se plantea', '2', 1667, 5),
(8602, 'Otra línea de texto.', '2', 1667, 6),
(8603, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1668, 1),
(8604, 'Figura 3 Modelo en V.', '3', 1668, 2),
(8605, '115/11.png', '6', 1668, 3),
(8606, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1668, 4),
(8607, 'Continuando con el contenido que se plantea', '2', 1668, 5),
(8608, 'Otra línea de texto.', '2', 1668, 6),
(8609, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1669, 1),
(8610, 'Figura 3 Modelo en V.', '3', 1669, 2),
(8611, '115/12.png', '6', 1669, 3),
(8612, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1669, 4),
(8613, 'Continuando con el contenido que se plantea', '2', 1669, 5),
(8614, 'Otra línea de texto.', '2', 1669, 6),
(8615, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1671, 1),
(8616, 'Figura 3 Modelo en V.', '3', 1671, 2),
(8617, '115/13.png', '6', 1671, 3),
(8618, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1671, 4),
(8619, 'Continuando con el contenido que se plantea', '2', 1671, 5),
(8620, 'Otra línea de texto.', '2', 1671, 6),
(8621, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1672, 1),
(8622, 'Figura 3 Modelo en V.', '3', 1672, 2),
(8623, '115/14.png', '6', 1672, 3),
(8624, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1672, 4),
(8625, 'Continuando con el contenido que se plantea', '2', 1672, 5),
(8626, 'Otra línea de texto.', '2', 1672, 6),
(8627, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1673, 1),
(8628, 'Figura 3 Modelo en V.', '3', 1673, 2),
(8629, '116/1.png', '6', 1673, 3),
(8630, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1673, 4),
(8631, 'Continuando con el contenido que se plantea', '2', 1673, 5),
(8632, 'Otra línea de texto.', '2', 1673, 6),
(8633, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1674, 1),
(8634, 'Figura 3 Modelo en V.', '3', 1674, 2),
(8635, '116/2.png', '6', 1674, 3),
(8636, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1674, 4),
(8637, 'Continuando con el contenido que se plantea', '2', 1674, 5),
(8638, 'Otra línea de texto.', '2', 1674, 6),
(8639, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1675, 1),
(8640, 'Figura 3 Modelo en V.', '3', 1675, 2),
(8641, '116/3.png', '6', 1675, 3),
(8642, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1675, 4),
(8643, 'Continuando con el contenido que se plantea', '2', 1675, 5),
(8644, 'Otra línea de texto.', '2', 1675, 6),
(8645, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1676, 1),
(8646, 'Figura 3 Modelo en V.', '3', 1676, 2),
(8647, '116/4.png', '6', 1676, 3),
(8648, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1676, 4),
(8649, 'Continuando con el contenido que se plantea', '2', 1676, 5),
(8650, 'Otra línea de texto.', '2', 1676, 6),
(8651, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1677, 1),
(8652, 'Figura 3 Modelo en V.', '3', 1677, 2),
(8653, '116/5.png', '6', 1677, 3),
(8654, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1677, 4),
(8655, 'Continuando con el contenido que se plantea', '2', 1677, 5),
(8656, 'Otra línea de texto.', '2', 1677, 6),
(8657, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1678, 1),
(8658, 'Figura 3 Modelo en V.', '3', 1678, 2),
(8659, '116/6.png', '6', 1678, 3),
(8660, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1678, 4),
(8661, 'Continuando con el contenido que se plantea', '2', 1678, 5),
(8662, 'Otra línea de texto.', '2', 1678, 6),
(8663, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1679, 1),
(8664, 'Figura 3 Modelo en V.', '3', 1679, 2),
(8665, '117/1.png', '6', 1679, 3),
(8666, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1679, 4),
(8667, 'Continuando con el contenido que se plantea', '2', 1679, 5),
(8668, 'Otra línea de texto.', '2', 1679, 6),
(8669, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1680, 1),
(8670, 'Figura 3 Modelo en V.', '3', 1680, 2),
(8671, '117/2.png', '6', 1680, 3),
(8672, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1680, 4),
(8673, 'Continuando con el contenido que se plantea', '2', 1680, 5),
(8674, 'Otra línea de texto.', '2', 1680, 6),
(8675, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1681, 1),
(8676, 'Figura 3 Modelo en V.', '3', 1681, 2),
(8677, '117/3.png', '6', 1681, 3),
(8678, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1681, 4),
(8679, 'Continuando con el contenido que se plantea', '2', 1681, 5),
(8680, 'Otra línea de texto.', '2', 1681, 6),
(8681, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1682, 1),
(8682, 'Figura 3 Modelo en V.', '3', 1682, 2),
(8683, '117/4.png', '6', 1682, 3),
(8684, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1682, 4),
(8685, 'Continuando con el contenido que se plantea', '2', 1682, 5),
(8686, 'Otra línea de texto.', '2', 1682, 6),
(8687, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1683, 1),
(8688, 'Figura 3 Modelo en V.', '3', 1683, 2),
(8689, '117/5.png', '6', 1683, 3),
(8690, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1683, 4),
(8691, 'Continuando con el contenido que se plantea', '2', 1683, 5),
(8692, 'Otra línea de texto.', '2', 1683, 6),
(8693, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1684, 1),
(8694, 'Figura 3 Modelo en V.', '3', 1684, 2),
(8695, '117/6.png', '6', 1684, 3),
(8696, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1684, 4),
(8697, 'Continuando con el contenido que se plantea', '2', 1684, 5),
(8698, 'Otra línea de texto.', '2', 1684, 6),
(8699, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1685, 1),
(8700, 'Figura 3 Modelo en V.', '3', 1685, 2),
(8701, '118/1.png', '6', 1685, 3),
(8702, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1685, 4),
(8703, 'Continuando con el contenido que se plantea', '2', 1685, 5),
(8704, 'Otra línea de texto.', '2', 1685, 6),
(8705, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1686, 1),
(8706, 'Figura 3 Modelo en V.', '3', 1686, 2),
(8707, '118/2.png', '6', 1686, 3),
(8708, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1686, 4),
(8709, 'Continuando con el contenido que se plantea', '2', 1686, 5),
(8710, 'Otra línea de texto.', '2', 1686, 6),
(8711, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1687, 1),
(8712, 'Figura 3 Modelo en V.', '3', 1687, 2),
(8713, '118/3.png', '6', 1687, 3),
(8714, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1687, 4),
(8715, 'Continuando con el contenido que se plantea', '2', 1687, 5),
(8716, 'Otra línea de texto.', '2', 1687, 6),
(8717, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1688, 1),
(8718, 'Figura 3 Modelo en V.', '3', 1688, 2),
(8719, '118/4.png', '6', 1688, 3),
(8720, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1688, 4),
(8721, 'Continuando con el contenido que se plantea', '2', 1688, 5),
(8722, 'Otra línea de texto.', '2', 1688, 6),
(8723, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1689, 1),
(8724, 'Figura 3 Modelo en V.', '3', 1689, 2),
(8725, '118/5.png', '6', 1689, 3),
(8726, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1689, 4),
(8727, 'Continuando con el contenido que se plantea', '2', 1689, 5),
(8728, 'Otra línea de texto.', '2', 1689, 6),
(8729, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1690, 1),
(8730, 'Figura 3 Modelo en V.', '3', 1690, 2),
(8731, '118/6.png', '6', 1690, 3),
(8732, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1690, 4),
(8733, 'Continuando con el contenido que se plantea', '2', 1690, 5),
(8734, 'Otra línea de texto.', '2', 1690, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1691 ;

--
-- Volcado de datos para la tabla `items_documento`
--

INSERT INTO `items_documento` (`id`, `caracteres`, `documento_id`, `items_estandar_id`) VALUES
(1630, 383, 113, 30),
(1631, 0, 113, 33),
(1632, 411, 113, 34),
(1633, 467, 113, 35),
(1634, 355, 113, 36),
(1635, 411, 113, 37),
(1636, 243, 113, 38),
(1637, 607, 113, 39),
(1638, 617, 113, 40),
(1639, 561, 113, 41),
(1640, 578, 113, 42),
(1641, 243, 113, 43),
(1642, 243, 113, 50),
(1643, 0, 113, 51),
(1644, 327, 113, 52),
(1645, 243, 113, 55),
(1646, 243, 114, 56),
(1647, 0, 114, 57),
(1648, 243, 114, 66),
(1649, 0, 114, 58),
(1650, 243, 114, 67),
(1651, 0, 114, 59),
(1652, 243, 114, 68),
(1653, 0, 114, 60),
(1654, 243, 114, 69),
(1655, 0, 114, 61),
(1656, 243, 114, 70),
(1657, 243, 115, 30),
(1658, 0, 115, 33),
(1659, 243, 115, 34),
(1660, 243, 115, 35),
(1661, 243, 115, 36),
(1662, 243, 115, 37),
(1663, 243, 115, 38),
(1664, 243, 115, 39),
(1665, 281, 115, 40),
(1666, 281, 115, 41),
(1667, 243, 115, 42),
(1668, 243, 115, 43),
(1669, 243, 115, 50),
(1670, 0, 115, 51),
(1671, 243, 115, 52),
(1672, 243, 115, 55),
(1673, 243, 116, 71),
(1674, 243, 116, 72),
(1675, 243, 116, 73),
(1676, 243, 116, 74),
(1677, 243, 116, 75),
(1678, 243, 116, 76),
(1679, 243, 117, 71),
(1680, 243, 117, 72),
(1681, 243, 117, 73),
(1682, 243, 117, 74),
(1683, 243, 117, 75),
(1684, 243, 117, 76),
(1685, 243, 118, 71),
(1686, 243, 118, 72),
(1687, 243, 118, 73),
(1688, 243, 118, 74),
(1689, 243, 118, 75),
(1690, 243, 118, 76);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

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
(55, 51, 2, 2, 54, 2),
(56, 0, 0, 0, 58, 3),
(57, 0, 1, 1, 59, 3),
(58, 0, 1, 2, 60, 3),
(59, 0, 1, 3, 61, 3),
(60, 0, 1, 4, 62, 3),
(61, 0, 1, 5, 63, 3),
(66, 57, 2, 1, 68, 3),
(67, 58, 2, 1, 69, 3),
(68, 59, 2, 1, 70, 3),
(69, 60, 2, 1, 71, 3),
(70, 61, 2, 1, 72, 3),
(71, 0, 0, 0, 73, 4),
(72, 0, 0, 0, 74, 4),
(73, 0, 0, 0, 75, 4),
(74, 0, 0, 0, 76, 4),
(75, 0, 0, 0, 77, 4),
(76, 0, 0, 0, 78, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(8, 'Aplicativos para la gestión de la información', NULL, 3),
(9, 'Arquitectura interna', '', 6);

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
(5, 'Items', '/items', 'glyphicon-sort-by-alphabet-alt glyphicon', 0, 1),
(8, 'Estandares', '/estandares', 'icon-file-settings', 0, 1),
(11, 'Institución', '/administracion', 'icon-library', 0, 1),
(14, 'Programas', '/programas', 'glyphicon-bookmark glyphicon', 0, 1),
(17, 'Proyectos', '/proyectos', 'icon-suitcase', 0, 1),
(20, 'Controles', '/controles', 'glyphicon-calendar glyphicon', 0, 1),
(23, 'Reportes', '/reportes', 'icon-stats', 0, 1),
(26, 'Notificaciones', '/notificaciones/index', 'icon-earth', 0, 1),
(27, 'Documentos', '/documentos', 'glyphicon-book glyphicon', 0, 1),
(30, 'Entregas', '/detalleentregas', 'glyphicon-open glyphicon', 0, 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

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
(54, 35, 1, 9, 0),
(55, 2, 2, 0, 0),
(56, 8, 2, 0, 0),
(57, 11, 2, 0, 0),
(58, 14, 2, 0, 0),
(59, 17, 2, 0, 0),
(60, 20, 2, 0, 0),
(61, 23, 2, 0, 0),
(62, 26, 2, 0, 0),
(63, 27, 2, 0, 0),
(64, 30, 2, 0, 0),
(65, 33, 2, 0, 0),
(66, 34, 2, 0, 0),
(67, 35, 2, 0, 0),
(68, 2, 3, 0, 0),
(69, 5, 3, 0, 0),
(70, 8, 3, 0, 0),
(72, 14, 3, 0, 0),
(73, 17, 3, 0, 0),
(74, 20, 3, 0, 0),
(75, 23, 3, 0, 0),
(76, 26, 3, 0, 0),
(77, 27, 3, 0, 0),
(78, 30, 3, 0, 0),
(79, 33, 3, 0, 0),
(80, 34, 3, 0, 0),
(81, 35, 3, 0, 0),
(82, 8, 4, 5, 0),
(85, 23, 4, 4, 0),
(86, 26, 4, 3, 0),
(89, 33, 4, 6, 0),
(90, 34, 4, 1, 0),
(91, 35, 4, 2, 0),
(93, 17, 5, 1, 1),
(95, 26, 5, 3, 1),
(98, 33, 5, 2, 1),
(99, 30, 4, 3, 0);

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
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `parametro_estado_id` int(11) NOT NULL,
  `parametro_tipo_notificacion` int(11) NOT NULL,
  `url_action` varchar(200) NOT NULL,
  `url_controlador` varchar(200) NOT NULL,
  `url_valor` varchar(200) NOT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parametro_estado_id` (`parametro_estado_id`),
  KEY `parametro_tipo_notificacion` (`parametro_tipo_notificacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `fecha`, `parametro_estado_id`, `parametro_tipo_notificacion`, `url_action`, `url_controlador`, `url_valor`, `persona_id`) VALUES
(1, '0000-00-00', 4, 7, 'documentos', 'proyectos', '115', 1),
(2, '2014-08-29', 5, 7, 'documentos', 'proyectos', '111', 1),
(3, '2014-08-29', 5, 7, 'documentos', 'proyectos', '108', 1),
(4, '2014-08-29', 5, 7, 'documentos', 'proyectos', '107', 1),
(5, '2014-08-29', 5, 7, 'documentos', 'proyectos', '114', 1),
(6, '2014-08-30', 4, 8, 'documentos', 'proyectos', '108', 1),
(7, '2014-09-02', 4, 8, 'documentos', 'proyectos', '108', 161);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_documentos`
--

CREATE TABLE IF NOT EXISTS `orden_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orden` int(11) NOT NULL,
  `tiposestandar_id` int(11) NOT NULL,
  `programa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tiposestandar_id` (`tiposestandar_id`),
  KEY `programa_id` (`programa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `nombre`, `valor`, `tiposparametro_id`) VALUES
(1, 'Aprobado', '2EFE2E', 1),
(2, 'Aprobado con correcciones', 'FE9A2E', 1),
(3, 'No aprobado', '882222', 1),
(4, 'Visto', NULL, 2),
(5, 'Sin ver', NULL, 2),
(6, 'Nueva entrega', NULL, 3),
(7, 'Designación como jurado', NULL, 3),
(8, 'Designación como asesor', NULL, 3),
(9, 'Fecha limite de entrega', NULL, 3),
(10, 'Designado como Investigador', NULL, 3),
(11, 'Respuesta de jurados', NULL, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=167 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `avatar`, `identificacion`, `nombre`, `apellido`, `email`, `programa_id`, `facultad_id`, `tiposusuario_id`) VALUES
(1, '1.jpg', '24', 'Gerson', 'Eraso Torres', 'geraso@hotmail.com', NULL, 1, 1),
(2, '1.jpg', '1085288762', 'Manuel', 'Calvache', 'mcalvache@hotmail.com', 1, 1, 2),
(3, '1.jpg', '1085288768', 'Luis Carlos', 'Revelo Tobar', 'lrevelo@hotmail.com', 1, 1, 3),
(5, '', '12213', 'Servio', 'Pantoja', 'spantoja@hotmail.com', 1, 1, 5),
(161, '1.jpg', '222', 'francisco', 'rojas', '22@hotmail.com', 1, 1, 4),
(162, '1.jpg', '12312', 'Mauricio', 'Cassanova', 'aaa@hotmail.com', 1, 1, 4),
(164, '1.jpg', '1212', 'Mayrita', 'Meneses', 'MMENESES@hotmail.com', 1, 1, 5),
(166, '1.jpg', '123', 'asd', 'asd', 'asd@hotmail.com', NULL, NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Volcado de datos para la tabla `personas_proyectos`
--

INSERT INTO `personas_proyectos` (`id`, `proyecto_id`, `persona_id`, `rol_id`) VALUES
(33, 107, 164, 3),
(35, 107, 2, 1),
(49, 108, 164, 3),
(51, 109, 5, 3),
(52, 109, 161, 3),
(53, 109, 3, 1),
(54, 109, 162, 1),
(58, 108, 3, 1),
(59, 112, 161, 2),
(71, 115, 1, 1),
(72, 111, 1, 1),
(74, 107, 1, 2),
(75, 114, 1, 2),
(76, 108, 1, 2),
(77, 108, 161, 2);

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
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`),
  KEY `linea_id` (`linea_id`),
  KEY `codigo` (`codigo`),
  KEY `programa` (`programa`),
  KEY `estado_id` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=116 ;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `codigo`, `titulo`, `programa`, `area_id`, `linea_id`, `estado_id`) VALUES
(107, '1', 'Proyecto CSS3 orientado a objetos', 1, 3, 6, 1),
(108, '1', 'Sistema de información para el cafe SISPRO', 1, 1, 1, 2),
(109, 'ST001', 'SISTRAG: Sistema de información para el control de trabajos de grado.', 1, 1, 1, 3),
(111, '123123123', 'Proyecto de arquitectura', 3, 6, 9, NULL),
(112, '', '', 1, 1, 1, NULL),
(113, 's', '', 1, 1, 1, NULL),
(114, 's', 'as', 1, 1, 1, NULL),
(115, 'ASD', 'ASD', 6, 1, 1, 1);

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
  `programa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `programa_id` (`programa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tiposestandares`
--

INSERT INTO `tiposestandares` (`id`, `nombre`, `programa_id`) VALUES
(1, 'Propuesta', 1),
(2, 'Proyecto', 1),
(3, 'Informe Final', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposparametros`
--

CREATE TABLE IF NOT EXISTS `tiposparametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tiposparametros`
--

INSERT INTO `tiposparametros` (`id`, `nombre`) VALUES
(1, 'Conceptos evaluativos'),
(2, 'Estado notificación'),
(3, 'Tipo de notificación');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=167 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `persona_id`, `nivel_id`) VALUES
(1, 'administrador', '4df2135580d23c4003d9275d67328babd46a1c50', 1, 1),
(2, 'decano', '4df2135580d23c4003d9275d67328babd46a1c50', 2, 2),
(3, 'director', '4df2135580d23c4003d9275d67328babd46a1c50', 3, 3),
(5, 'estudiante', '4df2135580d23c4003d9275d67328babd46a1c50', 5, 5),
(161, 'docente', '4df2135580d23c4003d9275d67328babd46a1c50', 161, 4),
(162, 'aaa', 'aaa', 162, 1),
(164, 'MMeneses', 'MMeneses', 164, 5),
(166, 'lol', '123', 166, 1);

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
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`parametro_estado_id`) REFERENCES `parametros` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`parametro_tipo_notificacion`) REFERENCES `parametros` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `proyectos_ibfk_3` FOREIGN KEY (`programa`) REFERENCES `programas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `proyectos_ibfk_4` FOREIGN KEY (`estado_id`) REFERENCES `tiposestandares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tiposestandares`
--
ALTER TABLE `tiposestandares`
  ADD CONSTRAINT `tiposestandares_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

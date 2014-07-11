-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2014 a las 06:59:37
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentregas`
--

CREATE TABLE IF NOT EXISTS `detalleentregas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrega_id` int(11) NOT NULL,
  `personas_proyecto_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_estado` date NOT NULL,
  `veredicto` tinyint(4) NOT NULL DEFAULT '0',
  `correciones` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `entrega_id` (`entrega_id`),
  KEY `personas_proyecto_id` (`personas_proyecto_id`),
  KEY `estado_id` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `detalleentregas`
--

INSERT INTO `detalleentregas` (`id`, `entrega_id`, `personas_proyecto_id`, `estado_id`, `fecha_estado`, `veredicto`, `correciones`) VALUES
(1, 3250, 55, 1, '2014-07-02', 0, 0),
(2, 3251, 53, 1, '2014-07-02', 0, 0),
(3, 3251, 54, 1, '2014-07-02', 0, 0),
(4, 3252, 50, 1, '2014-07-11', 0, 0),
(5, 3253, 47, 1, '2014-07-11', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=97 ;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `fecha_guardado`, `enlace`, `enviado`, `estandar_id`, `proyecto_id`) VALUES
(95, '2014-07-02 09:57:37', '', 1, 2, 109),
(96, '2014-07-11 11:53:10', '', 1, 2, 108);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3254 ;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `fecha_entrega`, `rol_id`, `documento_id`) VALUES
(3250, '2014-07-02', 2, 95),
(3251, '2014-07-02', 1, 95),
(3252, '2014-07-11', 2, 96),
(3253, '2014-07-11', 1, 96);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `items_documento_id`, `detalles_entrega_id`, `parametro_concepto_id`, `comentarios`) VALUES
(1, 1357, 1, 3, 'Primer come'),
(2, 1358, 1, 2, 'Segundo com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7173 ;

--
-- Volcado de datos para la tabla `items_contenidos`
--

INSERT INTO `items_contenidos` (`id`, `texto`, `tipo`, `items_documento_id`, `orden`) VALUES
(7001, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1357, 1),
(7002, 'Figura 3 Modelo en V.', '3', 1357, 2),
(7003, '95/1.png', '6', 1357, 3),
(7004, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1357, 4),
(7005, 'Continuando con el contenido que se plantea', '2', 1357, 5),
(7006, 'Otra línea de texto.', '2', 1357, 6),
(7007, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1359, 1),
(7008, 'Figura 3 Modelo en V.', '3', 1359, 2),
(7009, '95/2.png', '6', 1359, 3),
(7010, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1359, 4),
(7011, 'Continuando con el contenido que se plantea', '2', 1359, 5),
(7012, 'Otra línea de texto.', '2', 1359, 6),
(7013, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1360, 1),
(7014, 'Figura 3 Modelo en V.', '3', 1360, 2),
(7015, '95/3.png', '6', 1360, 3),
(7016, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1360, 4),
(7017, 'Continuando con el contenido que se plantea', '2', 1360, 5),
(7018, 'Otra línea de texto.', '2', 1360, 6),
(7019, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1361, 1),
(7020, 'Figura 3 Modelo en V.', '3', 1361, 2),
(7021, '95/4.png', '6', 1361, 3),
(7022, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1361, 4),
(7023, 'Continuando con el contenido que se plantea', '2', 1361, 5),
(7024, 'Otra línea de texto.', '2', 1361, 6),
(7025, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1362, 1),
(7026, 'Figura 3 Modelo en V.', '3', 1362, 2),
(7027, '95/5.png', '6', 1362, 3),
(7028, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1362, 4),
(7029, 'Continuando con el contenido que se plantea', '2', 1362, 5),
(7030, 'Otra línea de texto.', '2', 1362, 6),
(7031, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1363, 1),
(7032, 'Figura 3 Modelo en V.', '3', 1363, 2),
(7033, '95/6.png', '6', 1363, 3),
(7034, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1363, 4),
(7035, 'Continuando con el contenido que se plantea', '2', 1363, 5),
(7036, 'Otra línea de texto.', '2', 1363, 6),
(7037, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1364, 1),
(7038, 'Figura 3 Modelo en V.', '3', 1364, 2),
(7039, '95/7.png', '6', 1364, 3),
(7040, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1364, 4),
(7041, 'Continuando con el contenido que se plantea', '2', 1364, 5),
(7042, 'Otra línea de texto.', '2', 1364, 6),
(7043, 'Descripción del contenido del ítem.', '2', 1365, 1),
(7044, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1365, 2),
(7045, 'Figura 3 Modelo en V.', '3', 1365, 3),
(7046, '95/8.png', '6', 1365, 4),
(7047, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1365, 5),
(7048, 'Continuando con el contenido que se plantea', '2', 1365, 6),
(7049, 'Otra línea de texto.', '2', 1365, 7),
(7050, 'Descripción del contenido del ítem.', '2', 1366, 1),
(7051, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1366, 2),
(7052, 'Figura 3 Modelo en V.', '3', 1366, 3),
(7053, '95/9.png', '6', 1366, 4),
(7054, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1366, 5),
(7055, 'Continuando con el contenido que se plantea', '2', 1366, 6),
(7056, 'Otra línea de texto.', '2', 1366, 7),
(7057, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1367, 1),
(7058, 'Figura 3 Modelo en V.', '3', 1367, 2),
(7059, '95/10.png', '6', 1367, 3),
(7060, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1367, 4),
(7061, 'Continuando con el contenido que se plantea', '2', 1367, 5),
(7062, 'Otra línea de texto.', '2', 1367, 6),
(7063, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1368, 1),
(7064, 'Figura 3 Modelo en V.', '3', 1368, 2),
(7065, '95/11.png', '6', 1368, 3),
(7066, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1368, 4),
(7067, 'Continuando con el contenido que se plantea', '2', 1368, 5),
(7068, 'Otra línea de texto.', '2', 1368, 6),
(7069, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1369, 1),
(7070, 'Figura 3 Modelo en V.', '3', 1369, 2),
(7071, '95/12.png', '6', 1369, 3),
(7072, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1369, 4),
(7073, 'Continuando con el contenido que se plantea', '2', 1369, 5),
(7074, 'Otra línea de texto.', '2', 1369, 6),
(7075, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1371, 1),
(7076, 'Figura 3 Modelo en V.', '3', 1371, 2),
(7077, '95/13.png', '6', 1371, 3),
(7078, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1371, 4),
(7079, 'Continuando con el contenido que se plantea', '2', 1371, 5),
(7080, 'Otra línea de texto.', '2', 1371, 6),
(7081, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1372, 1),
(7082, 'Figura 3 Modelo en V.', '3', 1372, 2),
(7083, '95/14.png', '6', 1372, 3),
(7084, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1372, 4),
(7085, 'Continuando con el contenido que se plantea', '2', 1372, 5),
(7086, 'Otra línea de texto.', '2', 1372, 6),
(7087, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1373, 1),
(7088, 'Figura 3 Modelo en V.', '3', 1373, 2),
(7089, '96/1.png', '6', 1373, 3),
(7090, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '2', 1373, 4),
(7091, 'Continuando con el contenido que se plantea', '2', 1373, 5),
(7092, 'Otra línea de texto.', '2', 1373, 6),
(7093, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1375, 1),
(7094, 'Figura 3 Modelo en V.', '3', 1375, 2),
(7095, '96/2.png', '6', 1375, 3),
(7096, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1375, 4),
(7097, 'Continuando con el contenido que se plantea', '2', 1375, 5),
(7098, 'Otra línea de texto.', '2', 1375, 6),
(7099, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1376, 1),
(7100, 'Figura 3 Modelo en V.', '3', 1376, 2),
(7101, '96/3.png', '6', 1376, 3),
(7102, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1376, 4),
(7103, 'Continuando con el contenido que se plantea', '2', 1376, 5),
(7104, 'Otra línea de texto.', '2', 1376, 6),
(7105, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1377, 1),
(7106, 'Figura 3 Modelo en V.', '3', 1377, 2),
(7107, '96/4.png', '6', 1377, 3),
(7108, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1377, 4),
(7109, 'Continuando con el contenido que se plantea', '2', 1377, 5),
(7110, 'Otra línea de texto.', '2', 1377, 6),
(7111, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1378, 1),
(7112, 'Figura 3 Modelo en V.', '3', 1378, 2),
(7113, '96/5.png', '6', 1378, 3),
(7114, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1378, 4),
(7115, 'Continuando con el contenido que se plantea', '2', 1378, 5),
(7116, 'Otra línea de texto.', '2', 1378, 6),
(7117, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1379, 1),
(7118, 'Figura 3 Modelo en V.', '3', 1379, 2),
(7119, '96/6.png', '6', 1379, 3),
(7120, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1379, 4),
(7121, 'Continuando con el contenido que se plantea', '2', 1379, 5),
(7122, 'Otra línea de texto.', '2', 1379, 6),
(7123, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1380, 1),
(7124, 'Figura 3 Modelo en V.', '3', 1380, 2),
(7125, '96/7.png', '6', 1380, 3),
(7126, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1380, 4),
(7127, 'Continuando con el contenido que se plantea', '2', 1380, 5),
(7128, 'Otra línea de texto.', '2', 1380, 6),
(7129, 'Descripción del contenido del ítem.', '2', 1381, 1),
(7130, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1381, 2),
(7131, 'Figura 3 Modelo en V.', '3', 1381, 3),
(7132, '96/8.png', '6', 1381, 4),
(7133, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1381, 5),
(7134, 'Continuando con el contenido que se plantea', '2', 1381, 6),
(7135, 'Otra línea de texto.', '2', 1381, 7),
(7136, 'Descripción del contenido del ítem.', '2', 1382, 1),
(7137, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1382, 2),
(7138, 'Figura 3 Modelo en V.', '3', 1382, 3),
(7139, '96/9.png', '6', 1382, 4),
(7140, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico, pág 31.', '4', 1382, 5),
(7141, 'Continuando con el contenido que se plantea', '2', 1382, 6),
(7142, 'Otra línea de texto.', '2', 1382, 7),
(7143, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1383, 1),
(7144, 'Figura 3 Modelo en V.', '3', 1383, 2),
(7145, '96/10.png', '6', 1383, 3),
(7146, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1383, 4),
(7147, 'Continuando con el contenido que se plantea', '2', 1383, 5),
(7148, 'Otra línea de texto.', '2', 1383, 6),
(7149, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1384, 1),
(7150, 'Figura 3 Modelo en V.', '3', 1384, 2),
(7151, '96/11.png', '6', 1384, 3),
(7152, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1384, 4),
(7153, 'Continuando con el contenido que se plantea', '2', 1384, 5),
(7154, 'Otra línea de texto.', '2', 1384, 6),
(7155, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1385, 1),
(7156, 'Figura 3 Modelo en V.', '3', 1385, 2),
(7157, '96/12.png', '6', 1385, 3),
(7158, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1385, 4),
(7159, 'Continuando con el contenido que se plantea', '2', 1385, 5),
(7160, 'Otra línea de texto.', '2', 1385, 6),
(7161, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1387, 1),
(7162, 'Figura 3 Modelo en V.', '3', 1387, 2),
(7163, '96/13.png', '6', 1387, 3),
(7164, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1387, 4),
(7165, 'Continuando con el contenido que se plantea', '2', 1387, 5),
(7166, 'Otra línea de texto.', '2', 1387, 6),
(7167, 'Esto depende del proyecto que se está desarrollando por parte de los autores. ', '2', 1388, 1),
(7168, 'Figura 3 Modelo en V.', '3', 1388, 2),
(7169, '96/14.png', '6', 1388, 3),
(7170, 'Fuente: PRESSMAN, Roger. Ingeniería de software: Un enfoque práctico pág 31.', '4', 1388, 4),
(7171, 'Continuando con el contenido que se plantea', '2', 1388, 5),
(7172, 'Otra línea de texto.', '2', 1388, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1389 ;

--
-- Volcado de datos para la tabla `items_documento`
--

INSERT INTO `items_documento` (`id`, `caracteres`, `documento_id`, `items_estandar_id`) VALUES
(1357, 243, 95, 30),
(1358, 0, 95, 33),
(1359, 243, 95, 34),
(1360, 243, 95, 35),
(1361, 243, 95, 36),
(1362, 243, 95, 37),
(1363, 243, 95, 38),
(1364, 243, 95, 39),
(1365, 281, 95, 40),
(1366, 281, 95, 41),
(1367, 243, 95, 42),
(1368, 243, 95, 43),
(1369, 243, 95, 50),
(1370, 0, 95, 51),
(1371, 243, 95, 52),
(1372, 243, 95, 55),
(1373, 243, 96, 30),
(1374, 0, 96, 33),
(1375, 243, 96, 34),
(1376, 243, 96, 35),
(1377, 243, 96, 36),
(1378, 243, 96, 37),
(1379, 243, 96, 38),
(1380, 243, 96, 39),
(1381, 281, 96, 40),
(1382, 281, 96, 41),
(1383, 243, 96, 42),
(1384, 243, 96, 43),
(1385, 243, 96, 50),
(1386, 0, 96, 51),
(1387, 243, 96, 52),
(1388, 243, 96, 55);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

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
(33, 'Conogramas', '/cronogramas', 'icon-calendar', 0, 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `personas_proyectos`
--

INSERT INTO `personas_proyectos` (`id`, `proyecto_id`, `persona_id`, `rol_id`) VALUES
(33, 107, 164, 3),
(35, 107, 2, 1),
(36, 107, 1, 1),
(47, 108, 1, 1),
(49, 108, 164, 3),
(50, 108, 165, 2),
(51, 109, 5, 3),
(52, 109, 161, 3),
(53, 109, 3, 1),
(54, 109, 162, 1),
(55, 109, 4, 2);

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
  ADD CONSTRAINT `detalleentregas_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `evaluaciones_ibfk_2` FOREIGN KEY (`items_documento_id`) REFERENCES `items_documento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluaciones_ibfk_3` FOREIGN KEY (`detalles_entrega_id`) REFERENCES `detalleentregas` (`id`) ON UPDATE CASCADE;

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

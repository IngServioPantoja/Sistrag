-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2014 a las 03:51:20
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_guardado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enlace` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `estandar_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estandar_id` (`estandar_id`),
  KEY `proyecto_id` (`proyecto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `fecha_guardado`, `enlace`, `estandar_id`, `proyecto_id`) VALUES
(9, '2014-01-14 01:03:07', '', 2, 1),
(10, '2014-01-14 01:12:42', '', 2, 1),
(11, '2014-01-14 01:13:23', '', 2, 1),
(12, '2014-01-14 01:13:27', '', 2, 1),
(13, '2014-01-14 01:13:38', '', 2, 1),
(14, '2014-01-14 01:15:06', '', 2, 1),
(15, '2014-01-14 01:15:50', '', 2, 1),
(16, '2014-01-14 01:16:41', '', 2, 1),
(17, '2014-01-14 01:16:44', '', 2, 1),
(18, '2014-01-14 01:18:18', '', 2, 1),
(20, '2014-01-14 02:08:31', '', 5, 1),
(24, '2014-01-14 08:29:02', '', 2, 1),
(25, '2014-01-14 08:29:09', '', 2, 1),
(26, '2014-01-14 08:29:56', '', 2, 1),
(27, '2014-01-14 08:30:25', '', 2, 1),
(29, '2014-01-14 08:34:53', '', 2, 1),
(30, '2014-01-14 08:35:02', '', 2, 1),
(31, '2014-01-14 20:45:28', '', 2, 1),
(32, '2014-01-14 20:51:08', '', 2, 1),
(33, '2014-01-15 04:15:44', '', 2, 1),
(34, '2014-01-15 08:48:23', '', 2, 1),
(35, '2014-01-19 05:53:40', '', 2, 1),
(36, '2014-01-19 05:55:09', '', 2, 1),
(37, '2014-01-19 06:25:40', '', 2, 1),
(38, '2014-01-21 01:31:00', '', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE IF NOT EXISTS `entregas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` date NOT NULL,
  `fecha_estado` date NOT NULL,
  `rol_id` int(11) NOT NULL,
  `documento_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documento_id` (`documento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(1, 'Sin leer'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `estandares`
--

INSERT INTO `estandares` (`id`, `nombre`, `inicio vigencia`, `fin vigencia`, `programa_id`, `tiposestandar_id`) VALUES
(2, 'Trabajo de grado diseño', '2014-03-04', '2014-03-19', 5, 2),
(3, 'Trabajo de grado Arquitectura', '0000-00-00', '0000-00-00', 3, 1),
(4, 'Trabajo de grado Ingenieria de sistemas', '2014-03-19', '2016-03-21', 1, 1),
(5, 'Trabajo de grado conta', '0000-00-00', '0000-00-00', 8, 3),
(6, 'Trabajo de grado admi', '0000-00-00', '0000-00-00', 6, 3),
(17, 'Trabajo de grado', '2014-03-28', '2016-03-28', 1, 3),
(18, 'Trabajo de grado', '2014-03-28', '2016-03-28', 18, 1),
(19, 'Trabajo de grado', '2014-03-28', '2016-03-28', 18, 2),
(20, 'Trabajo de grado', '2014-03-28', '2016-03-28', 18, 3),
(21, 'Trabajo de grado', '2014-03-28', '2016-03-28', 19, 1),
(22, 'Trabajo de grado', '2014-03-28', '2016-03-28', 19, 2),
(23, 'Trabajo de grado', '2014-03-28', '2016-03-28', 19, 3),
(24, 'Trabajo de grado', '2014-03-28', '2016-03-28', 1, 2),
(25, 'Trabajo de grado', '2014-03-28', '2016-03-28', 8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemestandar_id` int(11) NOT NULL,
  `concepto_id` int(11) NOT NULL,
  `comentarios` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `descripcion` text COLLATE utf8_unicode_ci,
  `programa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `programa_id` (`programa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `nombre`, `extencion_caracteres`, `extencion_lineas`, `descripcion`, `programa_id`) VALUES
(8, 'El problema de investigación', 0, 5000, '', 1),
(9, 'Topicos del marco teorico', 0, 5000, '', 1),
(10, 'Metodologia', 0, 5000, '', 1),
(11, 'Recurso de la investigación', 0, 5000, '', 1),
(12, 'Objetivos', 0, 5000, '', 1),
(13, 'Objetivo General', 0, 5000, '', 1),
(14, 'Planteamiento del problema', 0, 5000, '', 1),
(18, 'Presentación', 1, 1, 'PresentaciÃ³n de la investigación aplicable solo a propuestas', 1),
(20, 'Objeto o tema de investigación', 146, 2, '', 1),
(21, 'Área de investigación', 728, 10, '', 1),
(22, 'Línea de investigación', 728, 10, '', 1),
(23, 'Justificación', 2258, 31, '', 1),
(24, 'Viabilidad', 1093, 15, '', 1),
(25, 'Talento humano', 364, 5, '', 1),
(26, 'Recursos fisicos', 1093, 15, '', 1),
(27, 'Presupuesto consolidado', 2258, 31, '', 1),
(28, 'Cronograma de actividades', 2258, 31, '', 1),
(29, 'Introducción', 2258, 31, '', 1),
(30, 'Formulación del problema', 364, 5, '', 1),
(33, 'Objetivos Especí­ficos', 12312, 12, '211212', 1),
(34, 'Delimitación', 12312, 12, '211212', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_estandares`
--

CREATE TABLE IF NOT EXISTS `items_estandares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items_estandar_id` int(11) DEFAULT '0',
  `orden` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `estandar_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estandar_id` (`estandar_id`),
  KEY `items_estandar_id` (`items_estandar_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `items_estandares`
--

INSERT INTO `items_estandares` (`id`, `items_estandar_id`, `orden`, `item_id`, `estandar_id`) VALUES
(0, 0, 0, NULL, NULL),
(2, 0, 1, 8, 2),
(3, 2, 1, 20, 2),
(4, 2, 2, 21, 2),
(5, 2, 3, 22, 2),
(6, 2, 4, 14, 2),
(7, 2, 5, 30, 2),
(8, 2, 6, 12, 2),
(9, 8, 1, 13, 2),
(10, 8, 2, 33, 2),
(11, 2, 7, 23, 2),
(12, 2, 8, 24, 2),
(13, 2, 9, 34, 2),
(14, 0, 0, 29, 2);

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
(1, '1.jpg', '24', 'Gerson', 'Eraso', 'geraso@hotmail.com', NULL, 1, 1),
(2, '1.jpg', '1085288762', 'Manuel', 'Calvache', 'mcalvache@hotmail.com', 1, 1, 2),
(3, '1.jpg', '1085288768', 'Luis Carlos', 'Revelo Tobar', 'lrevelo@hotmail.com', 1, 1, 3),
(4, '', '2312', 'Arturo', 'Eraso', 'aeraso@hotmail.com', 1, 1, 4),
(5, '', '12213', 'Servio', 'Pantoja', 'spantoja@hotmail.com', 1, 1, 5),
(161, '1.jpg', '222', 'francisco', 'rojas', '22@hotmail.com', 1, 1, 5),
(162, '1.jpg', '12312', 'Mauricio', 'Cassanova', 'aaa@hotmail.com', 1, 1, 4),
(163, '1.jpg', '223232', 'RAMAIEE', 'IUCESMAG', '123123@HOTMAIL.COM', 1, 1, 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `personas_proyectos`
--

INSERT INTO `personas_proyectos` (`id`, `proyecto_id`, `persona_id`, `rol_id`) VALUES
(28, 1, 5, 3),
(29, 1, 161, 3),
(30, 1, 4, 2),
(32, 1, 3, 1),
(33, 107, 164, 3),
(34, 107, 163, 2),
(35, 107, 2, 1),
(36, 107, 1, 1),
(37, 1, 162, 1),
(39, 3, 164, 3),
(40, 3, 163, 2),
(41, 3, 2, 1),
(42, 3, 1, 1),
(47, 108, 1, 1),
(48, 108, 163, 1),
(49, 108, 164, 3),
(50, 108, 165, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=111 ;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `codigo`, `titulo`, `programa`, `area_id`, `linea_id`) VALUES
(1, 'a1', 'Sistrag sistema de informacion para el control de trabajos de grado', 1, 1, 1),
(3, 'ST001', 'SISTRAG: Sistema de información para el control de trabajos de grado.', 1, 3, 3),
(107, '1', 'Proyecto CSS3 orientado a objetos', 1, 3, 6),
(108, '1', 'Sistema de información para el cafe SISPRO', 1, 1, 1),
(109, 'ST001', 'SISTRAG: Sistema de información para el control de trabajos de grado.', 1, 1, 1),
(110, 'ST001', 'SISTRAG: Sistema de información para el control de trabajos de grado.', 1, 3, 8);

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
(163, '123', '123', 163, 1),
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
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`estandar_id`) REFERENCES `estandares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estandares`
--
ALTER TABLE `estandares`
  ADD CONSTRAINT `estandares_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estandares_ibfk_3` FOREIGN KEY (`tiposestandar_id`) REFERENCES `tiposestandares` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `items_estandares`
--
ALTER TABLE `items_estandares`
  ADD CONSTRAINT `items_estandares_ibfk_3` FOREIGN KEY (`estandar_id`) REFERENCES `estandares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_estandares_ibfk_4` FOREIGN KEY (`items_estandar_id`) REFERENCES `items_estandares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `items_estandares_ibfk_5` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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

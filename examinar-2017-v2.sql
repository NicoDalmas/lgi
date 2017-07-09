-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2017 a las 21:39:56
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examinar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera-materia`
--

CREATE TABLE `carrera-materia` (
  `idCarrera_materia` int(11) NOT NULL,
  `idCarrera` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `idCarrera` int(11) NOT NULL,
  `nom_carrera` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`idCarrera`, `nom_carrera`) VALUES
(1, 'matematicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` text,
  `id_materia` int(11) NOT NULL,
  `tiempo` int(3) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id`, `nombre`, `descripcion`, `id_materia`, `tiempo`, `activo`) VALUES
(4, 'computacion', 'ej cuestionario', 20, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ex_clientes`
--

CREATE TABLE `ex_clientes` (
  `id` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ex_clientes`
--

INSERT INTO `ex_clientes` (`id`, `id_examen`, `id_cliente`, `id_solicitud`) VALUES
(1, 4, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ex_codigos`
--

CREATE TABLE `ex_codigos` (
  `id` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `codigoExamen` varchar(15) NOT NULL,
  `passwordExamen` varchar(8) NOT NULL,
  `utilizado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ex_codigos`
--

INSERT INTO `ex_codigos` (`id`, `idExamen`, `codigoExamen`, `passwordExamen`, `utilizado`) VALUES
(1, 4, '10E001', 'Jf8rMy1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ex_solicitados`
--

CREATE TABLE `ex_solicitados` (
  `id` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idExamen` int(11) DEFAULT NULL,
  `tipoDeExamen` varchar(7) NOT NULL,
  `tiempo` int(3) NOT NULL,
  `comentarios` text,
  `cantidadEncuestados` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ex_solicitados`
--

INSERT INTO `ex_solicitados` (`id`, `idCliente`, `idMateria`, `idExamen`, `tipoDeExamen`, `tiempo`, `comentarios`, `cantidadEncuestados`) VALUES
(1, 7, 20, NULL, 'online', 5, '', 10),
(2, 7, 19, NULL, 'online', 8, '', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMateria` int(11) NOT NULL,
  `materia` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMateria`, `materia`, `descripcion`) VALUES
(5, 'Cs Naturales', 'Cs Naturales'),
(6, 'Matematica', 'Matematica'),
(8, 'LGI', 'LGI'),
(19, 'Lengua', 'Lengua'),
(20, 'PHP', 'PHP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_unidad`
--

CREATE TABLE `materia_unidad` (
  `idMateria_Unidad` int(11) NOT NULL,
  `idMateria` int(11) DEFAULT NULL,
  `idUnidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `descripcion`) VALUES
(1, 'alumno'),
(2, 'cliente'),
(3, 'administrador'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `pregunta` varchar(150) NOT NULL,
  `resp1` varchar(50) DEFAULT NULL,
  `resp2` varchar(50) DEFAULT NULL,
  `resp3` varchar(50) DEFAULT NULL,
  `resp4` varchar(50) DEFAULT NULL,
  `resp5` varchar(50) DEFAULT NULL,
  `respcorrecta` int(1) DEFAULT NULL,
  `tipoPregunta` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `titulo`, `descripcion`, `precio`) VALUES
(1, 'Promo 1: 2 Encuestas Online', 'Consta de 2 encuestas online para 100 encuestados cada una. Este servicio incluye correcciÃ³n de las evaluaciones, disposiciÃ³n de las notas de cada alumno, tiempo lÃ­mite de encuesta, formato multiple-choice y/o verdadero o falso.', 175),
(2, 'Promo 2: 2 Encuestas Offline', 'Consta de 2 encuestas offline. Con esto, usted posee la libertar de corregir los exÃ¡menes y ser libre de distribuir la cantidad que desee. Este tipo de evaluaciones cuenta con formato multiple-choice, verdadero o falso y libre respuesta.', 175),
(3, 'Promo 3: 1 Encuesta Online + 1 Encuesta Offline', 'Consta de 2 exÃ¡menes de modalidades diferentes. Ambas, con todas sus caracterÃ­sticas incluÃ­das.', 175),
(4, 'Promo 4: Encuesta Online Mini', 'Consta de 1 encuesta online para 50 encuestados. Este servicio incluye correcciÃ³n de las evaluaciones, disposiciÃ³n de las notas de cada alumno, tiempo lÃ­mite de encuesta, formato multiple-choice y/o verdadero o falso.', 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `nota` decimal(3,2) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `terminada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id`, `id_cliente`, `id_alumno`, `id_examen`, `nota`, `estado`, `inicio`, `terminada`) VALUES
(2, 1, 6, 1, '9.99', 1, '2015-09-16 14:30:00', '2015-09-16 15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `idUnidad` int(11) NOT NULL,
  `nom_unidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(25) NOT NULL,
  `idAcceso` int(1) NOT NULL,
  `activo` int(1) NOT NULL,
  `dni` int(7) NOT NULL,
  `razon` varchar(50) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `idAcceso`, `activo`, `dni`, `razon`, `sexo`, `nombre`, `apellido`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 4, 1, 0, '', '', '', ''),
(2, 'loco', 'loco@loco.com', 'loco', 3, 1, 0, '', '', '', ''),
(3, 'magiio', 'magiio@magiio.com', 'magiio', 2, 1, 0, '', '', '', ''),
(4, 'meli', 'meli@meli', 'meli', 1, 1, 0, '', '', '', ''),
(5, 'asdasdasd', 'asd.@', 'asdasdasd', 2, 1, 0, 'asdasdasd', 'h', 'asdasdasd', 'asdasdasd'),
(6, 'Franco', 'magiio.74@hotmail.com', 'asdasdasd', 1, 1, 37450240, '', 'h', 'Franco', 'Maggioni'),
(7, 'melina', 'melinagaleano@hotmail.com', 'melina123', 2, 0, 37572588, '', 'm', 'Melina', 'Galeano'),
(8, 'melina123', 'meli@hotmail.com', 'melina123', 1, 1, 37572588, '', 'F', 'Melina', 'Galeano'),
(9, 'melinaasd', 'asd@asd.com', 'melinaasd', 1, 0, 78945612, '', 'm', 'Meli', 'Meli');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera-materia`
--
ALTER TABLE `carrera-materia`
  ADD PRIMARY KEY (`idCarrera_materia`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idMateria` (`idMateria`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `ex_clientes`
--
ALTER TABLE `ex_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ex_codigos`
--
ALTER TABLE `ex_codigos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ex_solicitados`
--
ALTER TABLE `ex_solicitados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`);

--
-- Indices de la tabla `materia_unidad`
--
ALTER TABLE `materia_unidad`
  ADD PRIMARY KEY (`idMateria_Unidad`),
  ADD KEY `idMateria` (`idMateria`),
  ADD KEY `idUnidad` (`idUnidad`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`idUnidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAcceso` (`idAcceso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera-materia`
--
ALTER TABLE `carrera-materia`
  MODIFY `idCarrera_materia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ex_clientes`
--
ALTER TABLE `ex_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ex_codigos`
--
ALTER TABLE `ex_codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ex_solicitados`
--
ALTER TABLE `ex_solicitados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrera-materia`
--
ALTER TABLE `carrera-materia`
  ADD CONSTRAINT `carrera-materia_ibfk_1` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`idCarrera`),
  ADD CONSTRAINT `carrera-materia_ibfk_2` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`);

--
-- Filtros para la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD CONSTRAINT `examenes_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`idMateria`);

--
-- Filtros para la tabla `materia_unidad`
--
ALTER TABLE `materia_unidad`
  ADD CONSTRAINT `materia_unidad_ibfk_1` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`),
  ADD CONSTRAINT `materia_unidad_ibfk_2` FOREIGN KEY (`idUnidad`) REFERENCES `unidades` (`idUnidad`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idAcceso`) REFERENCES `permisos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

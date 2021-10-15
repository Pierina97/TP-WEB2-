-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2021 a las 04:10:37
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_carreras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `duracion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre`, `duracion`) VALUES
(1, 'Ingenieria en Sistemas', 5),
(2, 'TUDAI', 2.5),
(3, 'TUPAR', 2.5),
(4, 'TUARI', 2.5),
(5, 'DUIA', 0.7),
(6, 'Profesorado en Informatica', 4),
(7, 'Dota2', 10),
(11, 'DUGAR', 0.5),
(12, 'Experiencias Digitales', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `profesor` varchar(45) NOT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre`, `profesor`, `id_carrera`) VALUES
(1, 'Algebra Lineal', 'Karina Paz', 1),
(2, 'POO', 'Luis Berdun', 1),
(6, 'Web2', 'Javier Romero', 2),
(7, 'Deep learning', 'Giru', 5),
(8, 'Integracion continua', 'Roco el Barbaro', 3),
(9, 'Procesamiento del lenguaje natural', 'Andres Dias Pace', 5),
(10, 'Tecnologias Web', 'Pollo Lopez', 4),
(11, 'Comunicacion de Datos', 'Hugo Curti', 1),
(12, 'Programacion 3', 'Laura Felice', 2),
(13, 'POO', 'Luis Berdun', 2),
(14, 'Web1', 'Roco Miraginai', 3),
(15, 'Web2', 'Javier Romario', 4),
(16, 'Comunicacion de Datos', 'El pimpollo feroz', 2),
(17, 'Programacion 3', 'Laura Felice', 4),
(28, 'Pickoff', 'Necro phos', 7),
(29, 'Maps awareness', 'BSJ', 7),
(30, 'Itemization', 'D bowie', 7),
(31, 'Ingenieria de Software', 'Quirque', 1),
(44, 'Redes hogareñas', 'Rolo Carretto', 11),
(45, 'Soporte previsorio', 'Epicuro Gomez', 11),
(46, 'Ergonomia', 'Ricardo Schelotto', 12),
(47, 'Accesibilidad WEB', 'Anastasio Iñaki', 12),
(48, 'Tecnologia educativa', 'Guillermo Conti', 6),
(50, 'Matematica discreta', 'Emilio Alfaro', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(45) NOT NULL DEFAULT 'NOT NULL',
  `rol` varchar(20) DEFAULT NULL,
  `passwd` varchar(120) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `rol`, `passwd`, `email`) VALUES
('admin', 'admin', '$2y$10$8aqvcd2yKKn/H9mD4PSsJereiRwTrwqb602Ag0h9zFCSssEFQPR2S', 'admin@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `fk_carrera_materia` (`id_carrera`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_carrera_materia` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

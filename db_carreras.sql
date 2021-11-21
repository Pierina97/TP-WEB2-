-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2021 a las 19:51:23
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
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(20) NOT NULL,
  `puntaje` int(1) NOT NULL,
  `id_materia` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `comentario`, `puntaje`, `id_materia`, `id_usuario`, `fecha`) VALUES
(1, 'muy buena materia', 2, 9, 2, '2021-11-06 18:23:03'),
(16, 'muy buena materia', 5, 9, 2, '2021-11-06 18:29:40'),
(20, 'muy buena materia', 5, 1, 2, '2021-11-06 18:38:28'),
(21, 'muy buena materia', 3, 7, 2, '2021-11-06 18:38:33'),
(22, 'muy buena materia', 2, 7, 2, '2021-11-06 18:38:37'),
(24, 'muy buena materia', 2, 7, 2, '2021-11-11 15:28:52'),
(127, 'test2', 4, 1, 1, '2021-11-15 09:34:57'),
(159, 'prueba3', 3, 1, 1, '2021-11-16 10:01:47'),
(160, 'prueba1', 2, 8, 1, '2021-11-16 10:04:49'),
(161, 'prueba1', 3, 1, 1, '2021-11-16 16:22:09'),
(164, 'prueba2', 3, 1, 1, '2021-11-16 19:01:39'),
(165, 'genial', 3, 1, 1, '2021-11-17 12:09:20'),
(166, 'test3', 2, 1, 1, '2021-11-18 20:44:34'),
(167, 'test4', 5, 1, 1, '2021-11-18 20:45:30'),
(168, 'test5', 1, 1, 1, '2021-11-18 21:00:52'),
(169, 'test6', 3, 1, 1, '2021-11-19 13:33:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `profesor` varchar(45) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre`, `profesor`, `imagen`, `id_carrera`) VALUES
(1, 'Algebra Lineal', 'Karina Paz', 'algebralineal1.png', 1),
(2, 'POO', 'Luis Berdun', 'poo.jpeg', 1),
(3, 'Web2', 'Javier Romero', 'web2.png', 2),
(7, 'Deep learning', 'Giru', 'DeepLearning.jpg', 5),
(8, 'Integracion continua', 'Roco el Barbaro', 'Continuous-Integration.png', 3),
(9, 'Procesamiento del lenguaje natural', 'Andres Dias Pace', '', 5),
(10, 'Tecnologias Web', 'Pollo Lopez', '', 4),
(11, 'Comunicacion de Datos', 'Hugo Curti', '', 1),
(12, 'Programacion 3', 'Laura Felice', '', 2),
(13, 'POO', 'Luis Berdun', '', 2),
(14, 'Web1', 'Roco Miraginai', '', 3),
(15, 'Web2', 'Javier Romero', '', 4),
(16, 'Comunicacion de Datos', 'El pimpollo feroz', '', 2),
(17, 'Programacion 3', 'Laura Felice', '', 4),
(18, 'Pickoff', 'Necro phos', '', 7),
(19, 'Maps awareness', 'BSJ', '', 7),
(20, 'Itemization', 'D bowie', '', 7),
(21, 'Ingenieria de Software', 'Quirque', '', 1),
(22, 'Redes hogareñas', 'Rolo Carretto', '', 11),
(23, 'Soporte previsorio', 'Epicuro Gomez', '', 11),
(24, 'Ergonomia', 'Ricardo Schelotto', '', 12),
(25, 'Accesibilidad WEB', 'Anastasio Iñaki', '', 12),
(26, 'Tecnologia educativa', 'Guillermo Conti', '', 6),
(27, 'Matematica discreta', 'Emilio Alfaro', '', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(50) NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT 'NOT NULL',
  `rol` varchar(20) DEFAULT 'usuario',
  `passwd` varchar(120) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `rol`, `passwd`, `email`) VALUES
(1, 'admin', 'admin', '$argon2id$v=19$m=65536,t=4,p=1$TFdHQVpEV2VxU0NtU0pBLg$xSv/VFYUWROATCzaExI1KnB3E2kWjKGhqPX6hfS7c5Y', 'admin@gmail.com'),
(2, 'pierina97', 'usuario', '$argon2id$v=19$m=65536,t=4,p=1$T1ZaZk03Sm1Wb0ZSd2dWbg$J9qEL121MJe991v8gt64ZN6pgxGlFyB05weuQbu0VJc', 'pierina97@hotmail.com'),
(3, 'usuario', 'usuario', '$argon2id$v=19$m=65536,t=4,p=1$QXhqNkZUSUhFcVFqaUtqbA$sEcfj8ctrfS0sQsxX0o8/pwh0PVhrddBLRP/3WVrnoA', 'usuario@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_usuario_comentario` (`id_usuario`),
  ADD KEY `fk_materia_comentario` (`id_materia`);

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
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_materia_comentario` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `fk_usuario_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_carrera_materia` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

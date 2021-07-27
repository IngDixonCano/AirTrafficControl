-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-07-2021 a las 09:51:54
-- Versión del servidor: 8.0.26-0ubuntu0.20.04.2
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `air_traffic_control`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aircraft`
--

CREATE TABLE `aircraft` (
  `id` int NOT NULL COMMENT 'This field will store the AC id',
  `type_id` int NOT NULL COMMENT 'Emergency, VIP, Passenger, or Cargo',
  `size_id` int NOT NULL COMMENT 'Small or Large',
  `state` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `aircraft`
--

INSERT INTO `aircraft` (`id`, `type_id`, `size_id`, `state`, `date`) VALUES
(17, 1, 2, 1, '2021-07-27 11:19:46'),
(18, 3, 1, 1, '2021-07-27 11:46:41'),
(19, 1, 1, 0, '2021-07-27 12:41:16'),
(20, 1, 1, 1, '2021-07-27 12:43:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `name` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'Small'),
(2, 'Large');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE `type` (
  `id` int NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Emergency'),
(2, 'VIP'),
(3, 'Passenger'),
(4, 'Cargo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aircraft_type_FK` (`type_id`),
  ADD KEY `aircraft_size_FK` (`size_id`);

--
-- Indices de la tabla `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'This field will store the AC id', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aircraft`
--
ALTER TABLE `aircraft`
  ADD CONSTRAINT `aircraft_size_FK` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `aircraft_type_FK` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-07-2021 a las 12:56:47
-- Versión del servidor: 8.0.25-0ubuntu0.20.04.1
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
  `id` int NOT NULL COMMENT 'i.This field will store the AC id',
  `type` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'i.Emergency, VIP, Passenger, or Cargo',
  `size` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'i.Small or Large'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `aircraft`
--

INSERT INTO `aircraft` (`id`, `type`, `size`) VALUES
(4, 'Passenger', 'Small'),
(6, 'VIP', 'Large'),
(7, 'Emergency', 'Small'),
(8, 'Emergency', 'Small'),
(9, 'Emergency', 'Small'),
(10, 'Emergency', 'Small'),
(11, 'Emergency', 'Small'),
(12, 'Emergency', 'Small'),
(13, 'VIP', 'Small');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'i.This field will store the AC id', AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-06-2022 a las 13:31:26
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siip`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculaciones`
--

DROP TABLE IF EXISTS `vinculaciones`;
CREATE TABLE IF NOT EXISTS `vinculaciones` (
  `id_vinculacion` int NOT NULL AUTO_INCREMENT,
  `id_programa` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `responsable` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `instancias` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `beneficios` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_vinculacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-09-2011 a las 01:13:15
-- Versión del servidor: 5.1.54
-- Versión de PHP: 5.3.5-1ubuntu7.2

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `txinbometro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `txinbometro_gasolina`
--

CREATE TABLE IF NOT EXISTS `txinbometro_gasolina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) DEFAULT NULL,
  `km` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `litros` double NOT NULL,
  `coste` double NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `gasolinera` varchar(255) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `IDX_C8330ECF25F7D575` (`vehiculo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `txinbometro_gasto`
--

CREATE TABLE IF NOT EXISTS `txinbometro_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) DEFAULT NULL,
  `km` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `coste` double NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `IDX_32B69B0625F7D575` (`vehiculo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `txinbometro_usuario`
--

CREATE TABLE IF NOT EXISTS `txinbometro_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ultimo_vehiculo` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `algorithm` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5B4A2D7D92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_5B4A2D7DA0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_5B4A2D7D3109FA40` (`ultimo_vehiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `txinbometro_vehiculo`
--

CREATE TABLE IF NOT EXISTS `txinbometro_vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `compra` date NOT NULL,
  `coste` double NOT NULL,
  `km_iniciales` int(11) NOT NULL,
  `capacidad` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F2ED1956DB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `txinbometro_gasolina`
--
ALTER TABLE `txinbometro_gasolina`
  ADD CONSTRAINT `txinbometro_gasolina_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `txinbometro_vehiculo` (`id`);

--
-- Filtros para la tabla `txinbometro_gasto`
--
ALTER TABLE `txinbometro_gasto`
  ADD CONSTRAINT `txinbometro_gasto_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `txinbometro_vehiculo` (`id`);

--
-- Filtros para la tabla `txinbometro_vehiculo`
--
ALTER TABLE `txinbometro_vehiculo`
  ADD CONSTRAINT `txinbometro_vehiculo_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `txinbometro_usuario` (`id`);

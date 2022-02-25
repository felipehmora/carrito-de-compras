-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2021 a las 00:56:12
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdphp3_20210614`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_agregar_carrito`
--

CREATE TABLE `tbl_agregar_carrito` (
  `session_id` varchar(26) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compra`
--

CREATE TABLE `tbl_compra` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(8) UNSIGNED DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_compra`
--

INSERT INTO `tbl_compra` (`id_usuario`, `id_producto`, `cantidad`, `fecha`) VALUES
(1, 2, 3, '2021-06-18 14:38:10'),
(1, 4, 1, '2021-06-18 14:38:10'),
(1, 3, 2, '2021-06-18 14:38:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(40) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `nombre_archivo` varchar(80) DEFAULT NULL,
  `precio` decimal(13,2) DEFAULT NULL,
  `existencia` int(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `nombre_producto`, `descripcion`, `nombre_archivo`, `precio`, `existencia`) VALUES
(1, 'CASCO CICLISTA', 'CASCO PARA CICLISTAS MARCA TAMANACO', 'articulos/1.jpg', '100.00', 12),
(2, 'TOALLAS', 'TOALLAS PARA ATLETAS, MARCA AMA DE CASA.', 'articulos/2.jpg', '15.00', 24),
(3, 'LIGAS DE CALESTENIA', 'LIGAS DE CALESTENIA, PARA ATLETAS DE ALTO RENDIMIENTO, MARCA EVERLAST.', 'articulos/3.jpg', '65.00', 36),
(4, 'BALON DE FUTBOL #5', 'BALON DE FUTBOL #5, MARCA SPALDING', 'articulos/4.jpg', '100.00', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `nombre_apellido` varchar(60) DEFAULT NULL,
  `correo` varchar(40) DEFAULT NULL,
  `clave` varchar(32) DEFAULT NULL,
  `tipo_usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `cedula`, `nombre_apellido`, `correo`, `clave`, `tipo_usuario`) VALUES
(1, 'V1234', 'JOSE PEREZ', 'JPEREZ@GMAIL.COM', 'd5df2f60445674b3127d6732805b1bc4', 'ADMINISTRADOR'),
(2, 'V5678', 'VANESSA PEÑA', 'VP@HOTMAIL.COM', '2a624357f99dfd99b9435034bf8def92', 'VISITANTE'),
(4, 'V9012', 'YOLANDA TORTOZA', 'YTORTOZA@GMAIL.COM', '0403e6c75f7a22d83e38c5d97b212ad1', 'VISITANTE');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

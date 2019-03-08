-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2019 a las 12:54:02
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `lineasCatalogo` (`id_c` INT)  SELECT p.id_linea_producto, COUNT(*) FROM `productos_catalogo` as pc JOIN productos AS p ON pc.id_producto = p.id WHERE pc.id_catalogo = id_c GROUP BY p.id_linea_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `producto` (IN `p_id` INT)  NO SQL
SELECT p.id, p.nombre_producto, p.precio_producto, p.descripcion_producto, p.imageng_producto, p.id_linea_producto, 
	tv.id AS id_tipo_variable, v.descripcion_tipo_variable, vp.id_variable AS id_variable_producto, vp.afecta_precio, vp.precio
FROM productos AS p 
	JOIN variables_producto as vp ON vp.id_producto = p.id 
	JOIN variables AS v ON vp.id_variable = v.id 
	JOIN tipos_variable AS tv ON tv.id = v.id_tipo_variable 
WHERE p.id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productosCatalogo` (IN `c_id` INT)  SELECT pc.id_producto, p.nombre_producto, p.precio_producto, p.imagenm_producto, p.id_linea_producto, 
	v.id, tv.id AS id_tipo_variable, v.descripcion_tipo_variable, vp.id_variable AS id_variable_producto, 
	vp.afecta_precio, vp.precio
FROM `productos_catalogo` AS pc 
	JOIN productos AS p ON pc.id_producto = p.id 
	LEFT JOIN variables_producto as vp ON vp.id_producto = p.id 
	LEFT JOIN variables AS v ON vp.id_variable = v.id 
	LEFT JOIN tipos_variable AS tv ON tv.id = v.id_tipo_variable 
WHERE id_catalogo = c_id ORDER BY pc.posicion$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogos`
--

CREATE TABLE `catalogos` (
  `id` int(11) NOT NULL,
  `nombre_catalogo` varchar(30) NOT NULL,
  `orden_catalogo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogos`
--

INSERT INTO `catalogos` (`id`, `nombre_catalogo`, `orden_catalogo`) VALUES
(2, 'Catalogo principal', 2),
(4, 'Bebidas y acompañamientos', 1),
(5, 'Tragaperras', 1),
(6, 'Tragaperras2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `nombre_ciudad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre_ciudad`) VALUES
(1, 'Cali');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos_promocionales`
--

CREATE TABLE `codigos_promocionales` (
  `id` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `valor` double NOT NULL,
  `mensaje` varchar(280) NOT NULL,
  `valido_desde` date NOT NULL,
  `valido_hasta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codigos_promocionales`
--

INSERT INTO `codigos_promocionales` (`id`, `codigo`, `tipo`, `valor`, `mensaje`, `valido_desde`, `valido_hasta`) VALUES
(1, 'KAKA', 1, 10, 'Obtienes un 10% de descuento en tu proxíma compra en el FEPADE', '2019-03-03', '2019-03-10'),
(2, 'FA', 2, 2000, 'LOL', '2019-03-03', '2019-03-10'),
(3, 'HELLOMOTO', 1, 50, 'V', '2019-03-03', '2019-03-04'),
(4, 'TRANFUGO', 1, 20, 'TRAIDOR HPTA', '2019-03-03', '2019-03-24'),
(5, 'MELAPELAS', 2, 35000, 'Ves, me la pelas', '2019-03-03', '2019-03-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cookies`
--

CREATE TABLE `cookies` (
  `id_usuario` int(11) NOT NULL,
  `cadena_cookie` varchar(300) NOT NULL,
  `fecha_creacion_cookie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cookies`
--

INSERT INTO `cookies` (`id_usuario`, `cadena_cookie`, `fecha_creacion_cookie`) VALUES
(1, '2,1:1,2:3*1', '2018-12-26'),
(15, '1,1:1,2:3*1;3,2:3*1', '2019-03-06'),
(17, '1,1:1,2:3*1;2,1:1,2:3*1', '2018-12-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id_pedido` int(11) NOT NULL,
  `descripcion_detalle` varchar(100) NOT NULL,
  `valor_unitario_detalle` float NOT NULL,
  `cantidad_detalle` int(11) NOT NULL,
  `foto_detalle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id_pedido`, `descripcion_detalle`, `valor_unitario_detalle`, `cantidad_detalle`, `foto_detalle`) VALUES
(7, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(8, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(8, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(9, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(9, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(10, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(10, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(11, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(11, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 2, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(12, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(12, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 2, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(13, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(13, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(14, 'Ceviche del Perú 340 Gr.,Galletas Saltin', 13400, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(14, 'Ceviche del Perú infiuse coco 340 Gr.,Galletas Saltin', 13400, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(15, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(16, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(17, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(17, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 2, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(18, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 2, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(18, 'Ceviche del Perú infiuse coco 170 Gr.,Platanitos', 7800, 2, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(18, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(19, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 2, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(19, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(20, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(22, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(22, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(23, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(24, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(25, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(25, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(26, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(27, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(28, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(30, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(31, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(32, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(33, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(34, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(35, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(35, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(36, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(36, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(37, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(37, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(38, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(38, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(39, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(39, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(40, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(40, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(41, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(41, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(42, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(42, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(43, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(43, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(44, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(44, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(45, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(45, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(46, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(46, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(47, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(47, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(48, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(48, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(49, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(49, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(50, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(50, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(51, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(51, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(52, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(52, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(53, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(53, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(54, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(54, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(55, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(55, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(56, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(56, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(57, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(57, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(58, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(58, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(59, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(59, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(60, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(60, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(61, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(61, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(62, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(62, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(63, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(63, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(64, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(64, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(65, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(65, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(66, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(66, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(67, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(67, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(67, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(68, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(68, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(68, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(69, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(69, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(69, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(70, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(70, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(70, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(71, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(71, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(71, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(72, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(72, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(72, 'Ceviche de pescado 170 Gr.,Galletas Saltin', 28300, 1, 'productos/3/Ceviche-de-Pescado-70px.png'),
(73, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(74, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(75, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 7800, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(76, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 2, 'productos/1/Ceviche-Peruano-70px.png'),
(77, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(78, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(79, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(80, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(81, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(82, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(83, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(84, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(85, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(86, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(87, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(88, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(89, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(90, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(91, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(92, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(93, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(94, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(95, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(96, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(97, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(98, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(99, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(100, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 1, 'productos/1/Ceviche-Peruano-70px.png'),
(101, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png'),
(102, 'Ceviche del Perú 170 Gr.,Galletas Saltin', 16300, 1, 'productos/1/Ceviche-Peruano-70px.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `nombre_direccion` varchar(30) NOT NULL,
  `ciudad_direccion` int(11) NOT NULL,
  `linea1_direccion` varchar(100) NOT NULL,
  `linea2_direccion` varchar(100) DEFAULT NULL,
  `telefono_direccion` varchar(20) NOT NULL,
  `usuario_direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `nombre_direccion`, `ciudad_direccion`, `linea1_direccion`, `linea2_direccion`, `telefono_direccion`, `usuario_direccion`) VALUES
(3, 'Casa', 1, 'Calle 62B #1A9-205', 'Sector 4 Agrupación 6 Torre E Apartamento 6E23', '3176483290', 1),
(8, 'Casa', 1, 'Calle 62B #1A9-205', 'Sector 4 Agrupación 6 Torre E Apartamento 6E23', '3176483290', 10),
(9, 'Casa', 1, 'Calle 62B #1A9-205', 'Sector 4 Agrupación 6 Torre E Apartamento 6E23', '3176483290', 16),
(10, 'Oficina', 1, 'Calle 39 #48-96', '', '3176483290', 16),
(11, 'Casa de mi novi@', 1, 'Aveninda 6N #56-23', '', '3176483290', 16),
(12, 'Casa de mi novi@', 1, 'Aveninda 6N #56-23', '', '3176483290', 16),
(13, 'Rafiki', 1, 'Av 3 #54B-22', '', '3176483290', 16),
(14, 'Mario', 1, 'Cr 23 #59-33', '', '8563620', 16),
(15, 'Mario', 1, 'Cr 23 #59-33', '', '8563620', 16),
(16, 'Mario', 1, 'Cr 23 #59-33', '', '8563620', 16),
(17, 'Juan David', 1, 'Calle 38  #19-31', 'Ap 402', '3176483290', 16),
(18, 'Oficina', 1, 'Av 6N #52-30', 'Of 903', '3176483290', 1),
(19, 'Casa', 1, 'Calle 23', 'Ap 301', '3015269832', 17),
(20, 'Casa', 1, 'Calle 25 #32-98', 'Ap 580', '3176483290', 18),
(21, 'Casa de mi novi@', 1, 'Circular 24 #30-26', '', '3225660302', 1),
(22, 'Casa', 1, 'Calle 62B #1A9-205', 'Sector 4 Agrupación 6 Torre E Apartamento 6E23', '3176483290', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_producto`
--

CREATE TABLE `lineas_producto` (
  `id` int(11) NOT NULL,
  `nombre_linea_producto` varchar(30) NOT NULL,
  `descripcion_linea_producto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas_producto`
--

INSERT INTO `lineas_producto` (`id`, `nombre_linea_producto`, `descripcion_linea_producto`) VALUES
(1, 'Linea de mariscos', 'Cada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.'),
(2, 'Linea de pescados', 'Cada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.'),
(3, 'Linea Vegetariana', 'Nuestros ceviches veggie son una opción saludable, vegana y gourmet para tu día a día. Cada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.'),
(4, 'Kits', 'Cada Kit de Ceviche incluye servilletas, 11 cucharas, 11 copas de 170gr, sal, pimienta, salsa de ají (por separado), limones y 11 paquetes personales de Galletas de Soda.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `valor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `descripcion`, `valor`) VALUES
(1, 'CATALAGO_PRINCIPAL', '2'),
(2, 'CATALAGO_CARRITO', ' '),
(3, 'HORA_APERTURA', '8:00 a.m.'),
(4, 'HORA_CIERRE', '8:00 p.m.'),
(5, 'client_id_mu', '5b3d1c49d5608_murbanos'),
(6, 'client_secret_mu', '4b51943fda751148483027219396c113c23755d2'),
(7, 'id_user_mu', '145138'),
(8, 'usuario_mu', 'dlondono@cevicheymar.com'),
(9, 'access_token_mu', '625a2fb8e913164b055d5ef6b0e1d6d024f8af8a'),
(10, 'ciudad_mu', 'cali'),
(11, 'ciudad_id_mu', '2'),
(12, 'valor_domicilio', '4900'),
(13, 'store_id', '1189');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario_pedido` int(11) NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  `estado_pedido` varchar(30) NOT NULL,
  `direccion_pedido` varchar(220) NOT NULL,
  `medio_pago_pedido` varchar(30) NOT NULL,
  `cookie_pedido` varchar(300) NOT NULL,
  `codigo_promocional_pedido` varchar(30) DEFAULT NULL,
  `descuento_pedido` float NOT NULL,
  `luigi_pedido` varchar(6) NOT NULL,
  `domicilio_pedido` float DEFAULT NULL,
  `id_codigo_pedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario_pedido`, `fecha_pedido`, `estado_pedido`, `direccion_pedido`, `medio_pago_pedido`, `cookie_pedido`, `codigo_promocional_pedido`, `descuento_pedido`, `luigi_pedido`, `domicilio_pedido`, `id_codigo_pedido`) VALUES
(7, 1, '2018-12-14 19:21:49', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(8, 1, '2018-12-14 22:21:21', 'Preparando', 'Cali: Av 6N #52-30 Of 903 Tel:3176483290', 'Efectivo', '2,1:1,2:3*1;1,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(9, 1, '2018-12-14 22:23:56', 'Preparando', 'Cali: Av 6N #52-30 Of 903 Tel:3176483290', 'Efectivo', '2,1:1,2:3*1;1,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(10, 10, '2018-12-14 22:24:53', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(11, 10, '2018-12-14 22:26:31', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*2;2,1:1,2:3*2', NULL, 0, '', NULL, NULL),
(12, 10, '2018-12-14 22:27:07', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*2;2,1:1,2:3*2', NULL, 0, '', NULL, NULL),
(13, 10, '2018-12-14 22:36:31', 'Despachado', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(14, 10, '2018-12-14 22:48:19', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:2,2:3*1;2,1:2,2:3*1', NULL, 0, '', NULL, NULL),
(15, 10, '2018-12-14 22:50:51', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*2', NULL, 0, '', NULL, NULL),
(16, 17, '2018-12-15 01:03:25', 'Preparando', 'Cali: Calle 23 Ap 301 Tel:3015269832', 'Efectivo', '1,1:1,2:3*2', NULL, 0, '', NULL, NULL),
(17, 18, '2018-12-15 01:29:05', 'Despachado', 'Cali: Calle 25 #32-98 Ap 580 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*2', NULL, 0, '', NULL, NULL),
(18, 1, '2018-12-21 20:22:06', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '2,1:1,2:3*2;2,1:1,2:4*2;3,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(19, 1, '2018-12-26 02:47:07', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '2,1:1,2:3*2;3,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(20, 1, '2018-12-26 16:03:18', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1', NULL, 0, '', NULL, NULL),
(21, 1, '2018-12-26 19:20:12', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'P', NULL, NULL),
(22, 1, '2018-12-26 19:44:18', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'KCXDU', NULL, NULL),
(23, 15, '2019-01-09 20:07:33', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'L2VSL', NULL, NULL),
(24, 15, '2019-01-09 23:44:57', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'L35UX', NULL, NULL),
(25, 15, '2019-01-09 23:50:33', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'L3649', NULL, NULL),
(26, 15, '2019-01-16 20:33:09', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'LFVN9', NULL, NULL),
(27, 15, '2019-01-16 21:00:53', 'Preparando', '22', 'PayU', '1,1:1,2:3*1', NULL, 0, 'LFWXH', NULL, NULL),
(28, 15, '2019-01-16 21:54:29', 'Preparando', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'PayU', '1,1:1,2:3*1', NULL, 0, 'LFZET', NULL, NULL),
(29, 15, '2019-01-28 19:46:33', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'M21HL', NULL, NULL),
(30, 15, '2019-01-28 19:47:06', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'M21II', NULL, NULL),
(31, 15, '2019-01-28 19:47:36', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'M21JC', NULL, NULL),
(32, 15, '2019-01-28 19:48:08', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'M21K8', NULL, NULL),
(33, 15, '2019-01-28 19:48:27', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'M21KR', NULL, NULL),
(34, 15, '2019-01-28 20:07:43', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'M22GV', NULL, NULL),
(35, 15, '2019-01-28 20:13:22', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M22QA', NULL, NULL),
(36, 15, '2019-01-28 20:16:10', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M22UY', NULL, NULL),
(37, 15, '2019-01-28 20:17:48', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M22XO', NULL, NULL),
(38, 15, '2019-01-28 20:18:03', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M22Y3', NULL, NULL),
(39, 15, '2019-01-28 20:18:34', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M22YY', NULL, NULL),
(40, 15, '2019-01-28 20:18:49', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M22ZD', NULL, NULL),
(41, 15, '2019-01-28 20:23:18', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M236U', NULL, NULL),
(42, 15, '2019-01-28 20:24:35', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M238Z', NULL, NULL),
(43, 15, '2019-01-28 20:32:28', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M23M4', NULL, NULL),
(44, 15, '2019-01-28 20:34:26', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M23PE', NULL, NULL),
(45, 15, '2019-01-28 21:07:52', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M2594', NULL, NULL),
(46, 15, '2019-01-28 21:09:01', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25B1', NULL, NULL),
(47, 15, '2019-01-28 21:11:02', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25EE', NULL, NULL),
(48, 15, '2019-01-28 21:11:32', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25F8', NULL, NULL),
(49, 15, '2019-01-28 21:12:08', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25G8', NULL, NULL),
(50, 15, '2019-01-28 21:13:05', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25HT', NULL, NULL),
(51, 15, '2019-01-28 21:16:06', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25MU', NULL, NULL),
(52, 15, '2019-01-28 21:18:37', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25R1', NULL, NULL),
(53, 15, '2019-01-28 21:21:31', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25VV', NULL, NULL),
(54, 15, '2019-01-28 21:22:13', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25X1', NULL, NULL),
(55, 15, '2019-01-28 21:22:31', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M25XJ', NULL, NULL),
(56, 15, '2019-01-28 21:25:38', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M262Q', NULL, NULL),
(57, 15, '2019-01-28 21:32:48', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M26EO', NULL, NULL),
(58, 15, '2019-01-28 21:36:03', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M26K3', NULL, NULL),
(59, 15, '2019-01-28 21:45:53', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M270H', NULL, NULL),
(60, 15, '2019-01-28 21:47:09', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M272L', NULL, NULL),
(61, 15, '2019-01-28 21:57:38', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M27K2', NULL, NULL),
(62, 15, '2019-01-28 21:58:42', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M27LU', NULL, NULL),
(63, 15, '2019-01-28 21:59:31', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M27N7', NULL, NULL),
(64, 15, '2019-01-28 21:59:54', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M27NU', NULL, NULL),
(65, 15, '2019-01-28 22:00:42', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M27P6', NULL, NULL),
(66, 15, '2019-01-28 22:02:37', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', NULL, 0, 'M27SD', NULL, NULL),
(67, 15, '2019-02-04 15:36:26', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'MEOKQ', NULL, NULL),
(68, 15, '2019-02-04 15:37:27', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'MEOMF', NULL, NULL),
(69, 15, '2019-02-04 15:40:00', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'MEOQO', NULL, NULL),
(70, 15, '2019-02-04 15:40:15', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'MEOR3', NULL, NULL),
(71, 15, '2019-02-04 15:40:28', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'MEORG', NULL, NULL),
(72, 15, '2019-02-04 15:41:05', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', NULL, 0, 'MEOSH', NULL, NULL),
(73, 15, '2019-02-04 15:42:28', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MEOUS', NULL, NULL),
(74, 15, '2019-02-04 15:42:57', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MEOVL', NULL, NULL),
(75, 15, '2019-02-04 15:43:36', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'MEOWO', NULL, NULL),
(76, 15, '2019-02-06 17:01:51', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*2', NULL, 0, 'MIHV3', 4900, NULL),
(77, 15, '2019-02-06 17:06:33', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'MII2X', 4900, NULL),
(78, 15, '2019-02-06 17:13:57', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'MIIF9', 4900, NULL),
(79, 15, '2019-02-06 17:44:13', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIJTP', 4900, NULL),
(80, 15, '2019-02-06 17:45:20', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIJVK', 4900, NULL),
(81, 15, '2019-02-06 17:46:16', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIJX4', 4900, NULL),
(82, 15, '2019-02-06 17:47:38', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIJZE', 4900, NULL),
(83, 15, '2019-02-06 17:48:24', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIK0O', 4900, NULL),
(84, 15, '2019-02-06 17:48:33', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIK0X', 4900, NULL),
(85, 15, '2019-02-06 17:48:58', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIK1M', 4900, NULL),
(86, 15, '2019-02-06 17:49:32', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIK2K', 4900, NULL),
(87, 15, '2019-02-06 17:58:09', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIKGX', 4900, NULL),
(88, 15, '2019-02-06 18:15:22', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIL9M', 4900, NULL),
(89, 15, '2019-02-06 18:19:22', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MILGA', 4900, NULL),
(90, 15, '2019-02-06 18:37:07', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIM9V', 4900, NULL),
(91, 15, '2019-02-06 18:51:13', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIMXD', 4900, NULL),
(92, 15, '2019-02-06 18:56:33', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIN69', 4900, NULL),
(93, 15, '2019-02-06 19:00:36', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MIND0', 4900, NULL),
(94, 15, '2019-02-06 19:04:30', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MINJJ', 4900, NULL),
(95, 15, '2019-02-06 19:07:25', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MINOD', 4900, NULL),
(96, 15, '2019-02-06 19:09:41', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MINS5', 4900, NULL),
(97, 15, '2019-02-06 19:13:17', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'MINY5', 4900, NULL),
(98, 15, '2019-02-06 19:14:37', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'MIO0D', 4900, NULL),
(99, 15, '2019-02-06 19:18:31', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'MIO6V', 4900, NULL),
(100, 15, '2019-02-10 18:11:36', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'MPZRC', 4900, NULL),
(101, 15, '2019-02-17 16:45:51', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '2,1:1,2:3*1', NULL, 0, 'N2UGF', 4900, NULL),
(102, 15, '2019-03-06 17:36:18', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1', NULL, 0, 'NYE4I', 4900, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `precio_producto` decimal(10,0) NOT NULL,
  `calorias_producto` int(11) NOT NULL,
  `imageng_producto` varchar(255) DEFAULT NULL,
  `imagenm_producto` varchar(255) DEFAULT NULL,
  `imagenp_producto` varchar(255) DEFAULT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `id_linea_producto` int(11) NOT NULL,
  `estado_producto` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `calorias_producto`, `imageng_producto`, `imagenm_producto`, `imagenp_producto`, `id_tipo_producto`, `id_linea_producto`, `estado_producto`) VALUES
(1, 'Ceviche del Perú', 'Calamares, Camarones Tigre y trocitos de pescado preparados en leche de tigre. Con cebolla morada, pimentón rojo caramelizado, tomate picado, aceite de oliva extra virgen y cilantro fresco.', '7800', 654, 'Ceviche-Peruano-500px.png', 'Ceviche-Peruano-300px.png', 'Ceviche-Peruano-70px.png', 1, 1, 1),
(2, 'Ceviche del Perú infiuse coco', 'Nuestra leche de Coco le da un toque único al Ceviche del Perú y sus Calamares, Camarón Tigre y trocitos de pescado. Hecho con nuestra mezcla de cebolla morada, pimentón rojo caramelizado, tomate picado, aceite de oliva extra virgen y cilantro fresco.\r\n\r\nCada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.', '7800', 682, 'Ceviche-Peruano-Infuse-Coco-500px.png', 'Ceviche-Peruano-Infuse-Coco-300px.png', 'Ceviche-Peruano-Infuse-Coco-70px.png', 1, 1, 1),
(3, 'Ceviche de pescado', 'Pescado Blanco mezclado con gengibre, ají, limón, pimienta molida, cebolla morada, pimentón rojo caramelizado, tomate picado, aceite de oliva extra virgen y cilantro fresco.', '28300', 310, 'Ceviche-de-Pescado-500px.png', 'Ceviche-de-Pescado-300px.png', 'Ceviche-de-Pescado-70px.png', 1, 2, 1),
(4, 'Prueba', 'Hola fresas', '18000', 20, NULL, NULL, NULL, 1, 1, 0),
(6, 'Prueba', 'Hola fresas', '18000', 20, 'Prueba500px.png', 'Prueba300px.png', 'Prueba70px.png', 1, 1, 1),
(7, 'Ceviche Pacífico Rojo', 'Nuestra versión del Ceviche de Camarón Tigre Colombiano: con salsa de tomate, jengibre, ají, limón, cebolla morada, tomate picado, pimentón rojo caramelizado, aceite de oliva extra virgen y cilantro fresco.', '15600', 616, 'Ceviche-Pacífico-Rojo500px.png', 'Ceviche-Pacífico-Rojo300px.png', 'Ceviche-Pacífico-Rojo70px.png', 1, 1, 1),
(8, 'Test', 'Esto es una prueba', '18000', 250, NULL, 'Test300px.png', 'Test70px.png', 1, 1, 1),
(9, 'Otra prueba', 'Hello moto', '23000', 3, NULL, NULL, NULL, 1, 1, 0),
(10, 'Mou ichido', 'jojo', '56000', 560, NULL, NULL, NULL, 1, 1, 0),
(11, 'LOL', 'Que cosa?', '0', 69, NULL, NULL, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_catalogo`
--

CREATE TABLE `productos_catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_catalogo`
--

INSERT INTO `productos_catalogo` (`id_catalogo`, `id_producto`, `posicion`) VALUES
(2, 1, 3),
(2, 2, 2),
(2, 3, 1),
(2, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_pedido`
--

CREATE TABLE `programacion_pedido` (
  `id_pedido` int(11) NOT NULL,
  `fecha_programada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programacion_pedido`
--

INSERT INTO `programacion_pedido` (`id_pedido`, `fecha_programada`) VALUES
(24, '2019-01-10 10:00:00'),
(25, '2019-01-10 19:00:00'),
(27, '0000-00-00 00:00:00'),
(28, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_mu`
--

CREATE TABLE `servicios_mu` (
  `id_pedido` int(11) NOT NULL,
  `uuid` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `total` float NOT NULL,
  `date` datetime NOT NULL,
  `distance` int(11) NOT NULL,
  `error` varchar(100) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios_mu`
--

INSERT INTO `servicios_mu` (`id_pedido`, `uuid`, `status`, `total`, `date`, `distance`, `error`, `task_id`) VALUES
(75, '5c584f9edfd4a', 1, 0, '2019-02-04 09:43:42', 0, '0', 0),
(76, '5c5b04f7e1a3e', 1, 0, '2019-02-06 11:01:59', 0, '0', 0),
(99, '5c5b24ff498ca', 1, 0, '2019-02-06 13:18:39', 0, '0', 0),
(100, '5c605b53cc61d', 1, 300, '2019-02-10 12:11:47', 0, '0', 2985971);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal_pedido`
--

CREATE TABLE `temporal_pedido` (
  `id` int(11) NOT NULL,
  `direccion` varchar(270) NOT NULL,
  `medio_pago` varchar(30) NOT NULL,
  `items_string` varchar(300) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `codigo_promocional_id` int(11) DEFAULT NULL,
  `id_codigo_pedido` int(11) DEFAULT NULL,
  `id_pedido_finalizado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `temporal_pedido`
--

INSERT INTO `temporal_pedido` (`id`, `direccion`, `medio_pago`, `items_string`, `fecha`, `codigo_promocional_id`, `id_codigo_pedido`, `id_pedido_finalizado`) VALUES
(1, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(2, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(3, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(4, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(5, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(6, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(7, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(8, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(9, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(10, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(11, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(12, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(13, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(14, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(15, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(16, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(17, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(18, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(19, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(20, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(21, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(22, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(23, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(24, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(25, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(26, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(27, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(28, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(29, '22', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(30, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(31, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(32, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(33, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(34, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(35, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(36, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(37, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(38, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(39, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(40, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(41, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(42, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(43, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(44, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(45, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(46, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(47, '22', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(48, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(49, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(50, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(51, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(52, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1;2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(53, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1;2,1:1,2:3*1;3,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(54, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(55, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(56, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(57, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(58, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(59, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(60, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(61, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(62, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*2', '0000-00-00 00:00:00', NULL, NULL, NULL),
(63, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(64, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(65, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(66, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(67, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(68, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(69, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(70, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(71, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(72, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(73, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(74, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '2', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, 0),
(75, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(76, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '2,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(77, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(78, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(79, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(80, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(81, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(82, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(83, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(84, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(85, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(86, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(87, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(88, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(89, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(90, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(91, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(92, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(93, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(94, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(95, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1;3,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(96, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1;3,1:1,2:3*1', '0000-00-00 00:00:00', NULL, NULL, NULL),
(97, 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', '1', '1,1:1,2:3*1;3,1:1,2:3*1', '0000-00-00 00:00:00', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_producto`
--

CREATE TABLE `tipos_producto` (
  `id` int(11) NOT NULL,
  `nombre_tipo_producto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_producto`
--

INSERT INTO `tipos_producto` (`id`, `nombre_tipo_producto`) VALUES
(1, 'Ceviches'),
(2, 'Acompañamientos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_variable`
--

CREATE TABLE `tipos_variable` (
  `id` int(11) NOT NULL,
  `nombre_tipo_variable` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_variable`
--

INSERT INTO `tipos_variable` (`id`, `nombre_tipo_variable`) VALUES
(1, 'Tamaño Ceviche'),
(2, 'Acompañante Ceviche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones_payu`
--

CREATE TABLE `transacciones_payu` (
  `id_temporal` int(11) NOT NULL,
  `state_pol` varchar(32) DEFAULT NULL,
  `response_code_pol` varchar(255) DEFAULT NULL,
  `reference_pol` varchar(255) DEFAULT NULL,
  `payment_method_type` int(11) DEFAULT NULL,
  `additional_value` float DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `cus` varchar(64) DEFAULT NULL,
  `test` tinyint(1) DEFAULT NULL,
  `administrative_fee` float DEFAULT NULL,
  `administrative_fee_base` float DEFAULT NULL,
  `administrative_fee_tax` float DEFAULT NULL,
  `commision_pol` float DEFAULT NULL,
  `commision_pol_currency` varchar(3) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `value` float DEFAULT NULL,
  `post` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variables`
--

CREATE TABLE `variables` (
  `id` int(11) NOT NULL,
  `id_tipo_variable` int(11) NOT NULL,
  `descripcion_tipo_variable` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variables`
--

INSERT INTO `variables` (`id`, `id_tipo_variable`, `descripcion_tipo_variable`) VALUES
(1, 1, '170 Gr.'),
(2, 1, '340 Gr.'),
(3, 2, 'Galletas Saltin'),
(4, 2, 'Platanitos'),
(5, 1, '100 Gr.'),
(6, 1, '600 Gr.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variables_producto`
--

CREATE TABLE `variables_producto` (
  `id_producto` int(11) NOT NULL,
  `id_tipo_variable` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  `afecta_precio` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variables_producto`
--

INSERT INTO `variables_producto` (`id_producto`, `id_tipo_variable`, `id_variable`, `afecta_precio`, `precio`) VALUES
(1, 1, 1, 1, '16300'),
(1, 1, 2, 1, '28300'),
(1, 1, 6, 1, '54300'),
(1, 2, 3, 0, '0'),
(1, 2, 4, 0, '0'),
(2, 1, 1, 1, '7800'),
(2, 1, 2, 1, '13400'),
(2, 2, 3, 0, '0'),
(2, 2, 4, 0, '0'),
(3, 2, 3, 0, '0'),
(3, 2, 4, 0, '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogos`
--
ALTER TABLE `catalogos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codigos_promocionales`
--
ALTER TABLE `codigos_promocionales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cookies`
--
ALTER TABLE `cookies`
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_producto`
--
ALTER TABLE `lineas_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_codigo_pedido` (`id_codigo_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_ibfk_1` (`id_tipo_producto`),
  ADD KEY `productos_ibfk_2` (`id_linea_producto`);

--
-- Indices de la tabla `productos_catalogo`
--
ALTER TABLE `productos_catalogo`
  ADD PRIMARY KEY (`id_producto`,`id_catalogo`),
  ADD KEY `productos_catalogo_ibfk_2` (`id_catalogo`);

--
-- Indices de la tabla `programacion_pedido`
--
ALTER TABLE `programacion_pedido`
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `servicios_mu`
--
ALTER TABLE `servicios_mu`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `temporal_pedido`
--
ALTER TABLE `temporal_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_codigo_pedido` (`id_codigo_pedido`),
  ADD KEY `codigos_promocionales_fk` (`codigo_promocional_id`);

--
-- Indices de la tabla `tipos_producto`
--
ALTER TABLE `tipos_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_variable`
--
ALTER TABLE `tipos_variable`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `variables`
--
ALTER TABLE `variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variables_ibfk_1` (`id_tipo_variable`);

--
-- Indices de la tabla `variables_producto`
--
ALTER TABLE `variables_producto`
  ADD PRIMARY KEY (`id_producto`,`id_tipo_variable`,`id_variable`),
  ADD KEY `variables_producto_ibfk_2` (`id_tipo_variable`),
  ADD KEY `variables_producto_ibfk_3` (`id_variable`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogos`
--
ALTER TABLE `catalogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `codigos_promocionales`
--
ALTER TABLE `codigos_promocionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `lineas_producto`
--
ALTER TABLE `lineas_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `temporal_pedido`
--
ALTER TABLE `temporal_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `tipos_producto`
--
ALTER TABLE `tipos_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_variable`
--
ALTER TABLE `tipos_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `variables`
--
ALTER TABLE `variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `detalles_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tipos_producto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_linea_producto`) REFERENCES `lineas_producto` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_catalogo`
--
ALTER TABLE `productos_catalogo`
  ADD CONSTRAINT `productos_catalogo_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_catalogo_ibfk_2` FOREIGN KEY (`id_catalogo`) REFERENCES `catalogos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `programacion_pedido`
--
ALTER TABLE `programacion_pedido`
  ADD CONSTRAINT `programacion_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `servicios_mu`
--
ALTER TABLE `servicios_mu`
  ADD CONSTRAINT `servicios_mu_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `temporal_pedido`
--
ALTER TABLE `temporal_pedido`
  ADD CONSTRAINT `codigos_promocionales_fk` FOREIGN KEY (`codigo_promocional_id`) REFERENCES `codigos_promocionales` (`id`),
  ADD CONSTRAINT `temporal_pedido_ibfk_1` FOREIGN KEY (`id_codigo_pedido`) REFERENCES `codigos_promocionales` (`id`);

--
-- Filtros para la tabla `variables`
--
ALTER TABLE `variables`
  ADD CONSTRAINT `variables_ibfk_1` FOREIGN KEY (`id_tipo_variable`) REFERENCES `tipos_variable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `variables_producto`
--
ALTER TABLE `variables_producto`
  ADD CONSTRAINT `variables_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `variables_producto_ibfk_2` FOREIGN KEY (`id_tipo_variable`) REFERENCES `tipos_variable` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `variables_producto_ibfk_3` FOREIGN KEY (`id_variable`) REFERENCES `variables` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

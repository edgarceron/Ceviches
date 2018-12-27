-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2018 a las 14:08:33
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `productosCatalogo` (`c_id` INT)  SELECT pc.id_producto, p.nombre_producto, p.precio_producto, p.imagenm_producto, p.id_linea_producto, v.id, tv.id as id_tipo_variable, v.descripcion_tipo_variable, vp.id_variable as id_variable_producto, vp.afecta_precio, vp.precio FROM `productos_catalogo` as pc JOIN productos as p ON pc.id_producto = p.id JOIN variables_producto as vp ON vp.id_producto = p.id JOIN variables as v on vp.id_variable = v.id JOIN tipos_variable as tv ON tv.id = v.id_tipo_varible WHERE id_catalogo = c_id ORDER BY p.id_linea_producto, pc.id_producto$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogos`
--

CREATE TABLE `catalogos` (
  `id` int(11) NOT NULL,
  `nombre_catalogo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogos`
--

INSERT INTO `catalogos` (`id`, `nombre_catalogo`) VALUES
(1, 'Catalogo principal'),
(4, 'Bebidas y acompañamientos');

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
(22, 'Ceviche del Perú infiuse coco 170 Gr.,Galletas Saltin', 7800, 1, 'productos/2/Ceviche-Peruano-Infuse-Coco-70px.png');

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
(21, 'Casa de mi novi@', 1, 'Circular 24 #30-26', '', '3225660302', 1);

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
(2, 'Linea de pescados', 'Cada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.');

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
(1, 'CATALAGO_PRINCIPAL', '1'),
(2, 'CATALAGO_CARRITO', ' '),
(3, 'HORA_APERTURA', '8:00 a.m.'),
(4, 'HORA_CIERRE', '8:00 p.m.');

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
  `luigi_pedido` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario_pedido`, `fecha_pedido`, `estado_pedido`, `direccion_pedido`, `medio_pago_pedido`, `cookie_pedido`, `luigi_pedido`) VALUES
(7, 1, '2018-12-14 19:21:49', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1', ''),
(8, 1, '2018-12-14 22:21:21', 'Preparando', 'Cali: Av 6N #52-30 Of 903 Tel:3176483290', 'Efectivo', '2,1:1,2:3*1;1,1:1,2:3*1', ''),
(9, 1, '2018-12-14 22:23:56', 'Preparando', 'Cali: Av 6N #52-30 Of 903 Tel:3176483290', 'Efectivo', '2,1:1,2:3*1;1,1:1,2:3*1', ''),
(10, 10, '2018-12-14 22:24:53', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', ''),
(11, 10, '2018-12-14 22:26:31', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*2;2,1:1,2:3*2', ''),
(12, 10, '2018-12-14 22:27:07', 'Preparando', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*2;2,1:1,2:3*2', ''),
(13, 10, '2018-12-14 22:36:31', 'Despachado', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', ''),
(14, 10, '2018-12-14 22:48:19', 'Recibido', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:2,2:3*1;2,1:2,2:3*1', ''),
(15, 10, '2018-12-14 22:50:51', 'Recibido', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*2', ''),
(16, 17, '2018-12-15 01:03:25', 'Recibido', 'Cali: Calle 23 Ap 301 Tel:3015269832', 'Efectivo', '1,1:1,2:3*2', ''),
(17, 18, '2018-12-15 01:29:05', 'Despachado', 'Cali: Calle 25 #32-98 Ap 580 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*2', ''),
(18, 1, '2018-12-21 20:22:06', 'Recibido', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '2,1:1,2:3*2;2,1:1,2:4*2;3,1:1,2:3*1', ''),
(19, 1, '2018-12-26 02:47:07', 'Recibido', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '2,1:1,2:3*2;3,1:1,2:3*1', ''),
(20, 1, '2018-12-26 16:03:18', 'Recibido', 'Cali: Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Tel:3176483290', 'Efectivo', '1,1:1,2:3*1', ''),
(21, 1, '2018-12-26 19:20:12', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', 'P'),
(22, 1, '2018-12-26 19:44:18', 'Recibido', 'Calle 62B #1A9-205 Sector 4 Agrupación 6 Torre E Apartamento 6E23 Telefono: 3176483290 Ciudad: Cali', 'Efectivo', '1,1:1,2:3*1;2,1:1,2:3*1', 'KCXDU');

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
  `imageng_producto` varchar(255) NOT NULL,
  `imagenm_producto` varchar(255) NOT NULL,
  `imagenp_producto` varchar(255) NOT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `id_linea_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `calorias_producto`, `imageng_producto`, `imagenm_producto`, `imagenp_producto`, `id_tipo_producto`, `id_linea_producto`) VALUES
(1, 'Ceviche del Perú', 'Nuestra leche de tigre le da un toque cítrico a Calamares, Camarones Tigre y trocitos de pescado. Hecho con cebolla morada, pimentón rojo caramelizado, tomate picado, aceite de oliva extra virgen y cilantro fresco.\r\n\r\nCada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.', '7800', 654, 'Ceviche-Peruano-500px.png', 'Ceviche-Peruano-300px.png', 'Ceviche-Peruano-70px.png', 1, 1),
(2, 'Ceviche del Perú infiuse coco', 'Nuestra leche de Coco le da un toque único al Ceviche del Perú y sus Calamares, Camarón Tigre y trocitos de pescado. Hecho con nuestra mezcla de cebolla morada, pimentón rojo caramelizado, tomate picado, aceite de oliva extra virgen y cilantro fresco.\r\n\r\nCada porción incluye servilletas, cuchara, sal, pimienta, salsa de ají (por separado), limón y su respectivo paquete personal de Galletas de Sal® de acuerdo al número de porciones que escojas.\r\n\r\nSellado con film de bioseguridad.', '7800', 682, 'Ceviche-Peruano-Infuse-Coco-500px.png', 'Ceviche-Peruano-Infuse-Coco-300px.png', 'Ceviche-Peruano-Infuse-Coco-70px.png', 1, 1),
(3, 'Ceviche de pescado', 'Pescado Blanco mezclado con gengibre, ají, limón, pimienta molida, cebolla morada, pimentón rojo caramelizado, tomate picado, aceite de oliva extra virgen y cilantro fresco.', '28300', 310, 'Ceviche-de-Pescado-500px.png', 'Ceviche-de-Pescado-300px.png', 'Ceviche-de-Pescado-70px.png', 1, 2);

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
(1, 1, 1),
(1, 2, 2),
(1, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_pedido`
--

CREATE TABLE `programacion_pedido` (
  `id_pedido` int(11) NOT NULL,
  `fecha_programada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Ceviche');

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
(1, 'Tamaño ceviche'),
(2, 'Acompañante ceviche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variables`
--

CREATE TABLE `variables` (
  `id` int(11) NOT NULL,
  `id_tipo_varible` int(11) NOT NULL,
  `descripcion_tipo_variable` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variables`
--

INSERT INTO `variables` (`id`, `id_tipo_varible`, `descripcion_tipo_variable`) VALUES
(1, 1, '170 Gr.'),
(2, 1, '340 Gr.'),
(3, 2, 'Galletas Saltin'),
(4, 2, 'Platanitos');

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
(1, 1, 1, 1, '7800'),
(1, 1, 2, 1, '13400'),
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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `variables_ibfk_1` (`id_tipo_varible`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `lineas_producto`
--
ALTER TABLE `lineas_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_producto`
--
ALTER TABLE `tipos_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipos_variable`
--
ALTER TABLE `tipos_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `variables`
--
ALTER TABLE `variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `variables`
--
ALTER TABLE `variables`
  ADD CONSTRAINT `variables_ibfk_1` FOREIGN KEY (`id_tipo_varible`) REFERENCES `tipos_variable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

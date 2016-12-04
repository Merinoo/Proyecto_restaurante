-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2016 a las 17:57:07
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cesta`
--

CREATE TABLE `cesta` (
  `Usuarios_idusuario` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cesta`
--

INSERT INTO `cesta` (`Usuarios_idusuario`, `Producto_IdProducto`, `Cantidad`) VALUES
(8, 34, 1),
(8, 35, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `Cantidad` int(11) DEFAULT NULL,
  `codlinea` int(11) NOT NULL,
  `Pedidos_Num_pedido` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`Cantidad`, `codlinea`, `Pedidos_Num_pedido`, `Producto_IdProducto`) VALUES
(1, 6, 4, 35),
(1, 7, 4, 42),
(1, 8, 5, 37),
(1, 10, 6, 49),
(3, 11, 7, 35),
(4, 12, 8, 35),
(1, 13, 9, 34),
(3, 14, 9, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Num_pedido` int(11) NOT NULL,
  `Usuario_idusuario` int(11) NOT NULL,
  `Fecha_pedido` date DEFAULT NULL,
  `Coste_total` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Num_pedido`, `Usuario_idusuario`, `Fecha_pedido`, `Coste_total`) VALUES
(4, 7, '2016-03-01', '4.60'),
(5, 7, '2016-03-01', '4.50'),
(6, 8, '2016-03-01', '4.00'),
(7, 8, '2016-03-01', '3.00'),
(8, 8, '2016-03-02', '4.00'),
(9, 8, '2016-03-03', '4.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `Tipo_producto` varchar(45) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Precio` decimal(6,2) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Imagen` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Tipo_producto`, `Nombre`, `Precio`, `Cantidad`, `Imagen`) VALUES
(33, 'Bebidas', 'Coca Cola', '1.00', 100, 'cocacola.jpg'),
(34, 'Bebidas', 'Fanta Naranja', '1.00', 100, 'fanta.jpg'),
(35, 'Bebidas', 'Aquarius LimÃ³n', '1.00', 100, 'aquarius.jpg'),
(36, 'Bebidas', 'Nestea', '1.20', 100, 'nestea.jpg'),
(37, 'Bebidas', 'Pepsi', '1.00', 100, 'pepsi.jpg'),
(38, 'Comida', 'Hamburguesa', '3.50', 104, 'Hamburguesa.jpg'),
(41, 'Comida', 'Sandwich', '2.70', 100, 'Sandwich.jpg'),
(42, 'Comida', 'Serranito', '3.60', 100, 'Serranito.jpg'),
(43, 'Comida', 'Baguette-Pollo', '2.90', 100, 'Baguette_pollo.jpg'),
(44, 'Postres', 'Magnum Blanco', '2.00', 100, 'magnum-blanco.png'),
(45, 'Postres', 'Magnum Frac', '2.00', 100, 'magnum-frac.png'),
(46, 'Postres', 'Magnum Doble Chocolate', '2.40', 100, 'magnum-double-chocolate.png'),
(47, 'Postres', 'Magnum Pink', '2.10', 100, 'magnum-pink.png'),
(48, 'Postres', 'Magnum Almendrado', '2.00', 100, 'magnum-almendrado.png'),
(49, 'Complementos', 'Ensalada del chef', '4.00', 100, 'ensalada del chef.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `Username` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Actividad` varchar(45) DEFAULT NULL,
  `Tipo` varchar(45) DEFAULT NULL,
  `Dni_usuario` varchar(9) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Cpostal` int(5) DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Sexo` varchar(6) DEFAULT NULL,
  `FNacimiento` date DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Tema` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `Username`, `Password`, `Email`, `Actividad`, `Tipo`, `Dni_usuario`, `Nombre`, `Apellidos`, `Cpostal`, `Telefono`, `Sexo`, `FNacimiento`, `Direccion`, `Tema`) VALUES
(7, 'japon', '81dc9bdb52d04dc20036dbd8313ed055', 'japon@email.com', 'Activo', 'user', '78945621L', 'Juan Antonio', 'Japon', 41900, 987654321, 'Hombre', '0000-00-00', 'C/japon', 1),
(8, 'juandiuser', '81dc9bdb52d04dc20036dbd8313ed055', 'pekechis@gmail.com', 'Activo', 'user', '11888459A', 'Juan Diego', 'Perez', 41914, 654358742, 'Hombre', '0000-00-00', 'C/Triana', 1),
(9, 'juandiadmin', '81dc9bdb52d04dc20036dbd8313ed055', 'pekechis@gmail.com', 'Activo', 'admin', '7867687D', 'Juan Diego', 'Perez', 41914, 987654321, 'Hombre', '0000-00-00', 'C/Triana', 3),
(11, 'peke1', '0e8623fe6fa3bb3440825081c8c2ad05', 'pekechis@gmail.com', 'Activo', 'user', 'sdfsdafsa', 'sdafsadf', 'sdfsad', 34534, 444444444, 'Mujer', '0000-00-00', 'sadfas', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`Usuarios_idusuario`,`Producto_IdProducto`),
  ADD KEY `fk_Cesta_Producto1_idx` (`Producto_IdProducto`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`codlinea`,`Pedidos_Num_pedido`,`Producto_IdProducto`),
  ADD KEY `fk_Detalle pedido_Producto1_idx` (`Producto_IdProducto`),
  ADD KEY `fk_Detalle pedido_Pedidos1` (`Pedidos_Num_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Num_pedido`,`Usuario_idusuario`),
  ADD KEY `fk_Pedidos_Usuario_idx` (`Usuario_idusuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `Dni_usuario_UNIQUE` (`Dni_usuario`),
  ADD UNIQUE KEY `Username_UNIQUE` (`Username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `codlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Num_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_Detalle pedido_Pedidos1` FOREIGN KEY (`Pedidos_Num_pedido`) REFERENCES `pedidos` (`Num_pedido`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Detalle pedido_Producto1` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

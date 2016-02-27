-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2016 a las 19:58:50
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cesta`
--

CREATE TABLE IF NOT EXISTS `cesta` (
  `Usuarios_idusuario` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `Cantidad` int(11) DEFAULT NULL,
  `codlinea` int(11) NOT NULL,
  `Pedidos_Num_pedido` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `Num_pedido` int(11) NOT NULL,
  `Usuario_idusuario` int(11) NOT NULL,
  `Fecha_pedido` date DEFAULT NULL,
  `Coste_total` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `IdProducto` int(11) NOT NULL,
  `Tipo_producto` varchar(45) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Precio` decimal(6,2) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Imagen` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Tipo_producto`, `Nombre`, `Precio`, `Cantidad`, `Imagen`) VALUES
(16, 'Bebidas', 'Coca cola', '1.20', 100, 'cocacola.jpg'),
(17, 'Bebidas', 'Fanta', '1.20', 100, 'fanta.jpg'),
(18, 'Bebidas', 'Nestea', '1.00', 100, 'nestea.jpg'),
(19, 'Bebidas', 'Pepsi', '1.00', 100, 'pepsi.jpg'),
(20, 'Bebidas', 'Aquarius', '1.50', 100, 'aquarius.jpg'),
(21, 'Comida', 'Hamburguesa', '2.50', 100, 'Hamburguesa.jpg'),
(22, 'Comida', 'Pizza', '3.50', 100, 'Pizza.jpeg'),
(23, 'Comida', 'Sandwich', '2.00', 100, 'Sandwich.jpg'),
(24, 'Comida', 'Serranito', '3.50', 100, 'Serranito.jpg'),
(25, 'Comida', 'Baguette-pollo', '2.70', 100, 'Baguette_pollo.jpg'),
(26, 'Postres', 'Magnum-almendrado', '2.00', 100, 'magnum-almendrado.png'),
(27, 'Postres', 'Magnum-Frac', '2.00', 100, 'magnum-frac.png'),
(28, 'Postres', 'Magnum-Blanco', '2.00', 100, 'magnum-blanco.png'),
(29, 'Postres', 'Magnum-pink', '2.50', 100, 'magnum-pink.png'),
(30, 'Postres', 'Magnum-Doble-Chocolate', '2.50', 100, 'magnum-double-chocolate.png'),
(31, 'Complementos', 'Ensalada del chef', '3.50', 50, 'ensalada del chef.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
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
  `Direccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `Username`, `Password`, `Email`, `Actividad`, `Tipo`, `Dni_usuario`, `Nombre`, `Apellidos`, `Cpostal`, `Telefono`, `Sexo`, `FNacimiento`, `Direccion`) VALUES
(3, 'japon', '827ccb0eea8a706c4c34a16891f84e7b', 'juanantoniojapon@gmail.com', 'Activo', 'user', '5741852B', 'Juan Antonio', 'Japon', 41896, 603746949, 'Hombre', '2016-02-02', 'C/San Vicente de Paul'),
(4, 'merino', '81dc9bdb52d04dc20036dbd8313ed055', 'amerino96@gmail.com', 'Activo', 'admin', '53344470H', 'Antonio Manuel', 'Merino Soto', 41900, 679210535, 'Hombre', '0000-00-00', 'C/Argantonio Nº6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`Usuarios_idusuario`,`Producto_IdProducto`), ADD KEY `fk_Cesta_Producto1_idx` (`Producto_IdProducto`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`codlinea`,`Pedidos_Num_pedido`,`Producto_IdProducto`), ADD KEY `fk_Detalle pedido_Producto1_idx` (`Producto_IdProducto`), ADD KEY `fk_Detalle pedido_Pedidos1` (`Pedidos_Num_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Num_pedido`,`Usuario_idusuario`), ADD KEY `fk_Pedidos_Usuario_idx` (`Usuario_idusuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`), ADD UNIQUE KEY `Dni_usuario_UNIQUE` (`Dni_usuario`), ADD UNIQUE KEY `Username_UNIQUE` (`Username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `codlinea` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Num_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cesta`
--
ALTER TABLE `cesta`
ADD CONSTRAINT `fk_Cesta_Producto1` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Cesta_Usuarios1` FOREIGN KEY (`Usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
ADD CONSTRAINT `fk_Detalle pedido_Pedidos1` FOREIGN KEY (`Pedidos_Num_pedido`) REFERENCES `pedidos` (`Num_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Detalle pedido_Producto1` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
ADD CONSTRAINT `fk_Pedidos_Usuario` FOREIGN KEY (`Usuario_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

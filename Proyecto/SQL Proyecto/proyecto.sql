-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2016 a las 20:51:10
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
-- Estructura de tabla para la tabla `detalle pedido`
--

CREATE TABLE IF NOT EXISTS `detalle pedido` (
  `Cantidad` int(11) DEFAULT NULL,
  `codlinea` int(11) NOT NULL,
  `Pedidos_Num_pedido` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `Num_pedido` int(11) NOT NULL,
  `Usuario_idusuario` int(11) NOT NULL,
  `Empleados_idEmpleado` int(11) NOT NULL,
  `Fecha_pedido` date DEFAULT NULL,
  `Coste_total` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Tipo_producto`, `Nombre`, `Precio`, `Cantidad`, `Imagen`) VALUES
(13, 'Comida', 'hg', '4.00', 4, 'fz___lancer_by_janemere-d4ibhbh.png.jpg'),
(14, 'Bebida', 'fanta', '1.40', 10, '542272_379562578747521_507750072_n.jpg'),
(15, 'Comida', 'hamburguesa', '2.00', 10, 'comidas.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `Username`, `Password`, `Email`, `Actividad`, `Tipo`, `Dni_usuario`, `Nombre`, `Apellidos`, `Cpostal`, `Telefono`, `Sexo`, `FNacimiento`, `Direccion`) VALUES
(3, 'japon', '827ccb0eea8a706c4c34a16891f84e7b', 'juanantoniojapon@gmail.com', 'Activo', 'user', '5741852B', 'Juan Antonio', 'Japon', 41896, 603746949, 'Hombre', '2016-02-02', 'C/San Vicente de Paul'),
(4, 'merino', '81dc9bdb52d04dc20036dbd8313ed055', 'amerino96@gmail.com', 'Activo', 'admin', '53344470H', 'Antonio Manuel', 'Merino Soto', 41900, 679210535, 'Hombre', '0000-00-00', 'C/Argantonio NÂº6'),
(6, 'b', '81dc9bdb52d04dc20036dbd8313ed055', 'b@gmail.com', 'Activo', 'user', '8767678d', 'b', 'b', 33333, 444444444, 'Hombre', '0000-00-00', 'b');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`Usuarios_idusuario`,`Producto_IdProducto`), ADD KEY `fk_Cesta_Producto1_idx` (`Producto_IdProducto`);

--
-- Indices de la tabla `detalle pedido`
--
ALTER TABLE `detalle pedido`
  ADD PRIMARY KEY (`codlinea`,`Pedidos_Num_pedido`,`Producto_IdProducto`), ADD KEY `fk_Detalle pedido_Producto1_idx` (`Producto_IdProducto`), ADD KEY `fk_Detalle pedido_Pedidos1` (`Pedidos_Num_pedido`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Num_pedido`,`Usuario_idusuario`,`Empleados_idEmpleado`), ADD KEY `fk_Pedidos_Usuario_idx` (`Usuario_idusuario`), ADD KEY `fk_Pedidos_Empleados1_idx` (`Empleados_idEmpleado`);

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
-- AUTO_INCREMENT de la tabla `detalle pedido`
--
ALTER TABLE `detalle pedido`
  MODIFY `codlinea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Num_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
-- Filtros para la tabla `detalle pedido`
--
ALTER TABLE `detalle pedido`
ADD CONSTRAINT `fk_Detalle pedido_Pedidos1` FOREIGN KEY (`Pedidos_Num_pedido`) REFERENCES `pedidos` (`Num_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Detalle pedido_Producto1` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
ADD CONSTRAINT `fk_Pedidos_Empleados1` FOREIGN KEY (`Empleados_idEmpleado`) REFERENCES `empleados` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Pedidos_Usuario` FOREIGN KEY (`Usuario_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

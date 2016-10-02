<?php



$connection->query("CREATE TABLE IF NOT EXISTS `cesta` (
  `Usuarios_idusuario` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`Usuarios_idusuario`,`Producto_IdProducto`),
  KEY `fk_Cesta_Producto1_idx` (`Producto_IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


$connection->query("INSERT INTO `cesta` (`Usuarios_idusuario`, `Producto_IdProducto`, `Cantidad`) VALUES
(8, 34, 1),
(8, 35, 1);");


$connection->query("CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `Cantidad` int(11) DEFAULT NULL,
  `codlinea` int(11) NOT NULL AUTO_INCREMENT,
  `Pedidos_Num_pedido` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL,
  PRIMARY KEY (`codlinea`,`Pedidos_Num_pedido`,`Producto_IdProducto`),
  KEY `fk_Detalle pedido_Producto1_idx` (`Producto_IdProducto`),
  KEY `fk_Detalle pedido_Pedidos1` (`Pedidos_Num_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;");


$connection->query("INSERT INTO `detalle_pedido` (`Cantidad`, `codlinea`, `Pedidos_Num_pedido`, `Producto_IdProducto`) VALUES
(1, 6, 4, 35),
(1, 7, 4, 42),
(1, 8, 5, 37),
(1, 10, 6, 49),
(3, 11, 7, 35),
(4, 12, 8, 35),
(1, 13, 9, 34),
(3, 14, 9, 37);");


$connection->query("CREATE TABLE IF NOT EXISTS `pedidos` (
  `Num_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_idusuario` int(11) NOT NULL,
  `Fecha_pedido` date DEFAULT NULL,
  `Coste_total` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`Num_pedido`,`Usuario_idusuario`),
  KEY `fk_Pedidos_Usuario_idx` (`Usuario_idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;");


$connection->query("INSERT INTO `pedidos` (`Num_pedido`, `Usuario_idusuario`, `Fecha_pedido`, `Coste_total`) VALUES
(4, 7, '2016-03-01', '4.60'),
(5, 7, '2016-03-01', '4.50'),
(6, 8, '2016-03-01', '4.00'),
(7, 8, '2016-03-01', '3.00'),
(8, 8, '2016-03-02', '4.00'),
(9, 8, '2016-03-03', '4.00');");


$connection->query("CREATE TABLE IF NOT EXISTS `producto` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_producto` varchar(45) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Precio` decimal(6,2) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Imagen` varchar(300) NOT NULL,
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;");


$connection->query("INSERT INTO `producto` (`IdProducto`, `Tipo_producto`, `Nombre`, `Precio`, `Cantidad`, `Imagen`) VALUES
(33, 'Bebidas', 'Coca Cola', '1.00', 100, 'cocacola.jpg'),
(34, 'Bebidas', 'Fanta Naranja', '1.00', 100, 'fanta.jpg'),
(35, 'Bebidas', 'Aquarius Limón', '1.00', 100, 'aquarius.jpg'),
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
(49, 'Complementos', 'Ensalada del chef', '4.00', 100, 'ensalada del chef.jpg');");

$connection->query("CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `Dni_usuario_UNIQUE` (`Dni_usuario`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;");


$connection->query("INSERT INTO `usuarios` (`idusuario`, `Username`, `Password`, `Email`, `Actividad`, `Tipo`, `Dni_usuario`, `Nombre`, `Apellidos`, `Cpostal`, `Telefono`, `Sexo`, `FNacimiento`, `Direccion`) VALUES
(7, 'japon', '81dc9bdb52d04dc20036dbd8313ed055', 'japon@email.com', 'Activo', 'user', '78945621L', 'Juan Antonio', 'Japon', 41900, 987654321, 'Hombre', '0000-00-00', 'C/japon'),
(8, 'juandiuser', '81dc9bdb52d04dc20036dbd8313ed055', 'pekechis@gmail.com', 'Activo', 'user', '11888459A', 'Juan Diego', 'Perez', 41914, 654358742, 'Hombre', '0000-00-00', 'C/Triana'),
(9, 'juandiadmin', '81dc9bdb52d04dc20036dbd8313ed055', 'pekechis@gmail.com', 'Activo', 'admin', '7867687D', 'Juan Diego', 'Perez', 41914, 987654321, 'Hombre', '0000-00-00', 'C/Triana'),
(11, 'peke1', '0e8623fe6fa3bb3440825081c8c2ad05', 'pekechis@gmail.com', 'Activo', 'user', 'sdfsdafsa', 'sdafsadf', 'sdfsad', 34534, 444444444, 'Mujer', '0000-00-00', 'sadfas');");


$connection->query("ALTER TABLE `cesta`
  ADD CONSTRAINT `fk_Cesta_Producto1` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cesta_Usuarios1` FOREIGN KEY (`Usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE NO ACTION;");


$connection->query("ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_Detalle pedido_Pedidos1` FOREIGN KEY (`Pedidos_Num_pedido`) REFERENCES `pedidos` (`Num_pedido`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Detalle pedido_Producto1` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE NO ACTION;");


$connection->query("ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_Pedidos_Usuario` FOREIGN KEY (`Usuario_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE NO ACTION;");





 ?>

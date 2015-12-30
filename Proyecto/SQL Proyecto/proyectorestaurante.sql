-- MySQL Script generated by MySQL Workbench
-- 12/27/15 00:39:34
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema proyecto
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema proyecto
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET utf8 ;
USE `proyecto` ;

-- -----------------------------------------------------
-- Table `proyecto`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`Usuarios` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NULL,
  `Apellidos` VARCHAR(45) NULL,
  `C.postal` INT(5) NULL,
  `Telefono` INT(9) NULL,
  `Sexo` VARCHAR(6) NULL,
  `F.Nacimiento` DATE NULL,
  `Email` VARCHAR(100) NULL,
  `Direccion` VARCHAR(100) NULL,
  `Tipo` VARCHAR(45) NULL,
  `Actividad` VARCHAR(45) NULL,
  `Username` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  `Dni_usuario` VARCHAR(9) NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `Dni_usuario_UNIQUE` (`Dni_usuario` ASC),
  UNIQUE INDEX `Username_UNIQUE` (`Username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`Producto` (
  `IdProducto` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Precio` DECIMAL(9,2) NULL,
  `Cantidad` INT NULL,
  `Tipo_producto` VARCHAR(45) NULL,
  PRIMARY KEY (`IdProducto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`Cesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`Cesta` (
  `Usuarios_idusuario` INT NOT NULL,
  `Producto_IdProducto` INT NOT NULL,
  `Cantidad` INT NULL,
  PRIMARY KEY (`Usuarios_idusuario`, `Producto_IdProducto`),
  INDEX `fk_Cesta_Producto1_idx` (`Producto_IdProducto` ASC),
  CONSTRAINT `fk_Cesta_Usuarios1`
    FOREIGN KEY (`Usuarios_idusuario`)
    REFERENCES `proyecto`.`Usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cesta_Producto1`
    FOREIGN KEY (`Producto_IdProducto`)
    REFERENCES `proyecto`.`Producto` (`IdProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`Empleados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`Empleados` (
  `idEmpleado` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellidos` VARCHAR(45) NULL,
  `Telefono` INT(9) NULL,
  `Email` VARCHAR(45) NULL,
  PRIMARY KEY (`idEmpleado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`Pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`Pedidos` (
  `Fecha_pedido` DATE NULL,
  `Coste_total` DECIMAL(9,2) NULL,
  `Usuario_idusuario` INT NOT NULL,
  `Num_pedido` INT NOT NULL AUTO_INCREMENT,
  `Empleados_idEmpleado` INT NOT NULL,
  PRIMARY KEY (`Num_pedido`, `Usuario_idusuario`, `Empleados_idEmpleado`),
  INDEX `fk_Pedidos_Usuario_idx` (`Usuario_idusuario` ASC),
  INDEX `fk_Pedidos_Empleados1_idx` (`Empleados_idEmpleado` ASC),
  CONSTRAINT `fk_Pedidos_Usuario`
    FOREIGN KEY (`Usuario_idusuario`)
    REFERENCES `proyecto`.`Usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedidos_Empleados1`
    FOREIGN KEY (`Empleados_idEmpleado`)
    REFERENCES `proyecto`.`Empleados` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyecto`.`Detalle pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`Detalle pedido` (
  `Cantidad` INT NULL,
  `codlinea` INT NOT NULL AUTO_INCREMENT,
  `Pedidos_Num_pedido` INT NOT NULL,
  `Producto_IdProducto` INT NOT NULL,
  PRIMARY KEY (`codlinea`, `Pedidos_Num_pedido`, `Producto_IdProducto`),
  INDEX `fk_Detalle pedido_Producto1_idx` (`Producto_IdProducto` ASC),
  CONSTRAINT `fk_Detalle pedido_Pedidos1`
    FOREIGN KEY (`Pedidos_Num_pedido`)
    REFERENCES `proyecto`.`Pedidos` (`Num_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle pedido_Producto1`
    FOREIGN KEY (`Producto_IdProducto`)
    REFERENCES `proyecto`.`Producto` (`IdProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

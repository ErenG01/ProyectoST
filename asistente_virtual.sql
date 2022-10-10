-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2021 a las 00:36:52
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistente_virtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_categoria` int(15) NOT NULL,
  `Desc_categ` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id_categoria`, `Desc_categ`) VALUES
(1, 'MotherBoards'),
(2, 'Tarjetas Graficas'),
(3, 'Memorias Ram'),
(4, 'Refrigeración'),
(5, 'Chasis '),
(6, 'HardDisk'),
(7, 'Discos Solidos'),
(8, 'Fuentes de Poder');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cedula`
--

CREATE TABLE `cedula` (
  `Id_cedula` int(11) NOT NULL,
  `tipo_documento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cedula`
--

INSERT INTO `cedula` (`Id_cedula`, `tipo_documento`) VALUES
(1, 'Tarjeta de Identidad'),
(2, 'Cedula de Ciudadania'),
(3, 'Registro Civil'),
(4, 'Cedula de Extranjería'),
(5, 'Libreta Militar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `numero_documento` int(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `fecha_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(15) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cedula`, `numero_documento`, `nombre`, `correo`, `telefono`, `direccion`, `fecha_add`, `usuario_id`, `estatus`) VALUES
(3, 2, 2147483647, 'Maicol Poloche', 'jose@gmail.com', 2147483647, 'carrera 1 ', '2021-06-23 14:54:32', 3, 1),
(5, 2, 46874243, 'Jose Miguel', 'jose@gmail.com', 348543548, 'carrera 15', '2021-06-28 07:49:34', 3, 1),
(7, 3, 354321534, 'Karen Giraldo', 'karencita@gmail.com', 856465486, 'carrera 20 norte', '2021-06-28 08:23:18', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_pro`
--

CREATE TABLE `comentarios_pro` (
  `Id_comentario` int(20) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `Comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coment_registro`
--

CREATE TABLE `coment_registro` (
  `correlativo` bigint(11) NOT NULL,
  `Id_comentario` int(20) NOT NULL,
  `Id_usuario` int(15) NOT NULL,
  `fecha_coment` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `correlativo` bigint(11) NOT NULL,
  `nofactura` bigint(11) NOT NULL,
  `Id_prod` int(13) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciototal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` bigint(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Id_usuario` int(15) NOT NULL,
  `Id_cliente` int(11) NOT NULL,
  `total_factura` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(13) NOT NULL,
  `id_categoria` int(15) NOT NULL,
  `id_proveedor` int(15) NOT NULL,
  `nomb_prod` varchar(50) NOT NULL,
  `desc_prod` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_prod`, `id_categoria`, `id_proveedor`, `nomb_prod`, `desc_prod`, `precio`, `cantidad`, `foto`) VALUES
(1, 2, 2, 'Tarjeta grafica rtx1060', 'Muy buena tarjeta grafica', '1500000.00', 10, 'imagenes/tarjetagrafica1.png'),
(2, 3, 1, 'Memorias RAM 16GB', 'Memorias de 16GB de RAM y RGB', '350000.00', 30, 'imagenes/ram_Memoria.png'),
(5, 1, 3, 'Memorias RAM 16GB', 'Memorias de 16GB de RAM y RGB', '500000.00', 10, 'img/uploads/BoardAsusPrimeX570-P.png'),
(9, 1, 1, 'Tarjeta madre', 'Tarjeta madre asus', '1000000.00', 50, 'img/uploads/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(15) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `fecha_add` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(15) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `contacto`, `telefono`, `direccion`, `fecha_add`, `id_usuario`, `estatus`) VALUES
(1, 'Asus', 'Maicol Poloche', 46874324, 'CARRERA 32 ', '2021-06-25 08:19:32', 3, 1),
(2, 'Razer', 'Brayan Cardozo', 857648461, 'carrera 15 numero 20-18', '2021-06-25 09:20:16', 3, 1),
(3, 'Intel', 'Jose Miguel', 54684163, 'carrera 2 numero50-20', '2021-06-25 09:29:46', 3, 1),
(4, 'Asus', 'Shirley Velasquez', 146354854, 'transversal 20', '2021-06-27 20:15:59', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_sesion`
--

CREATE TABLE `registro_sesion` (
  `Id_usuario` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_sesion`
--

INSERT INTO `registro_sesion` (`Id_usuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'Lucas', 'lucas_d@gmail.com', 'pato lucas', 'b5bc58989e75ca2cc4ff3dd81a769be1', 1, 1),
(3, 'Michael Ortega', 'Michael2021@gmail.com', 'Don Pajaro', 'b5bc58989e75ca2cc4ff3dd81a769be1', 1, 1),
(5, 'Juan Jose', 'JJ_ponce@gmail.com', 'JJ_Tovar', '42ec364ffd19cff6321d803bdcedec81', 1, 1),
(7, 'Cristian', 'cristian_parlon@gmail.com', 'Cristiano', 'f4762d59c7a9b269f6764e8b8d0ad640', 3, 1),
(8, 'Julian', 'julian@gmail.com', 'J_Loud', 'b5bc58989e75ca2cc4ff3dd81a769be1', 3, 1),
(9, 'Isabella', 'Isabella_bella@gmail.com', 'Isa', '0ec4ea08aa80f63837682d90704cf3ab', 2, 1),
(10, 'Jose Miguel', 'jose@gmail.com', 'Jose', '25f9e794323b453885f5181f1b624d0b', 3, 1),
(11, 'Maicol Poloche', 'eren_g@gmail.com', 'ErenG', '6ebe76c9fb411be97b3b0d48b791a7c9', 1, 1),
(12, 'Luisa', 'luisa@gmail.com', 'Luisa', 'f878ea295591a3df1cc03de1da85c209', 3, 1),
(13, 'Carlos ', 'carlos@gmail.com', 'Carlitos', 'eec4f29f9693da477a748c9ac24bbf69', 2, 1),
(14, 'Karen Giraldo', 'karen@gmail.com', 'karencita', '04c036b017a05d0a8e685f5f1adafa7a', 3, 1),
(15, 'Brayan Lopez', 'brayan@gmail.com', 'el Brayan', 'b8acfbe7cda8d59e0d6b03326e598815', 1, 1),
(16, 'Jennifer Maldonado', 'j_maldonado@gmail.com', 'Jenni', 'ed3e663c86505bd50ee75e6f323ed9ca', 3, 1),
(17, 'Valentina Vargas', 'valen_v@gmail.com', 'Valen', 'e020e8840ff6fc0519cb2e9c47e37e20', 2, 1),
(18, 'Albeiro Gomez', 'albeiro2000@gmail.com', 'Albeiro ', 'b0d793edefd91d5f6fa6e8b1fe553576', 2, 1),
(19, 'Tito Perez', 'tito_p@gmail.com', 'Tito', '827ccb0eea8a706c4c34a16891f84e7b', 3, 1),
(20, 'Diego Arboleda', 'arboliggy@gmail.com', 'Piggy', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1),
(21, 'Mickey mouse', 'Mickeydrogo@gmail.com', 'El Mickey', 'c6c0329bba537835e48e2be9a8e9c8f7', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Proveedor'),
(4, 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_categoria`);

--
-- Indices de la tabla `cedula`
--
ALTER TABLE `cedula`
  ADD PRIMARY KEY (`Id_cedula`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `comentarios_pro`
--
ALTER TABLE `comentarios_pro`
  ADD PRIMARY KEY (`Id_comentario`);

--
-- Indices de la tabla `coment_registro`
--
ALTER TABLE `coment_registro`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `Id_comentario` (`Id_comentario`,`Id_usuario`),
  ADD KEY `Id_usuario` (`Id_usuario`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `nofactura` (`nofactura`,`Id_prod`),
  ADD KEY `Id_prod` (`Id_prod`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `idusuario` (`Id_usuario`),
  ADD KEY `Id_cliente` (`Id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `id_categoria` (`id_categoria`,`id_proveedor`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `registro_sesion`
--
ALTER TABLE `registro_sesion`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD KEY `Rol` (`rol`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_categoria` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cedula`
--
ALTER TABLE `cedula`
  MODIFY `Id_cedula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comentarios_pro`
--
ALTER TABLE `comentarios_pro`
  MODIFY `Id_comentario` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `coment_registro`
--
ALTER TABLE `coment_registro`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro_sesion`
--
ALTER TABLE `registro_sesion`
  MODIFY `Id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `cedula` (`Id_cedula`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `registro_sesion` (`Id_usuario`);

--
-- Filtros para la tabla `coment_registro`
--
ALTER TABLE `coment_registro`
  ADD CONSTRAINT `coment_registro_ibfk_1` FOREIGN KEY (`Id_usuario`) REFERENCES `registro_sesion` (`Id_usuario`),
  ADD CONSTRAINT `coment_registro_ibfk_2` FOREIGN KEY (`Id_comentario`) REFERENCES `comentarios_pro` (`Id_comentario`);

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`Id_prod`) REFERENCES `productos` (`id_prod`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`Id_usuario`) REFERENCES `registro_sesion` (`Id_usuario`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`Id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `registro_sesion` (`Id_usuario`);

--
-- Filtros para la tabla `registro_sesion`
--
ALTER TABLE `registro_sesion`
  ADD CONSTRAINT `registro_sesion_ibfk_1` FOREIGN KEY (`Rol`) REFERENCES `rol` (`idrol`),
  ADD CONSTRAINT `registro_sesion_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

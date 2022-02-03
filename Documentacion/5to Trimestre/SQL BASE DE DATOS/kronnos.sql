-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2021 a las 17:35:06
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kronnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaproducto`
--

CREATE TABLE `categoriaproducto` (
  `idCategoriaP` int(11) NOT NULL,
  `nombreCategoría` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoriaproducto`
--

INSERT INTO `categoriaproducto` (`idCategoriaP`, `nombreCategoría`) VALUES
(1, 'Sabanas'),
(2, 'Cubrelechos'),
(3, 'Tapetes Baños'),
(4, 'Cortinas'),
(5, 'Tapete para sala'),
(6, 'Tapete para Habitacion'),
(7, 'Cojines'),
(8, 'Toallas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idCiudad` int(11) NOT NULL,
  `nombreCiudad` varchar(45) NOT NULL,
  `Dpto_idDpto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `nombreCiudad`, `Dpto_idDpto`) VALUES
(1, 'Bogotá', 1),
(2, 'LETICIA', 2),
(3, 'EL ENCANTO', 2),
(4, 'LA CHORRERA', 2),
(5, 'LA PEDRERA', 2),
(6, 'LA VICTORIA', 2),
(7, 'MIRITI - PARANA', 2),
(8, 'PUERTO ALEGRIA', 2),
(9, 'PUERTO ARICA', 2),
(10, 'PUERTO NARIÑO', 2),
(11, 'PUERTO SANTANDER', 2),
(12, 'TARAPACA', 2),
(13, 'MEDELLIN', 3),
(14, 'ABEJORRAL', 3),
(15, 'ABRIAQUI', 3),
(16, 'ALEJANDRIA', 3),
(17, 'AMAGA', 3),
(18, 'AMALFI', 3),
(19, 'ANDES', 3),
(20, 'ANGELOPOLIS', 3),
(21, 'ANGOSTURA', 3),
(22, 'ANORI', 3),
(23, 'SANTAFE DE ANTIOQUIA', 3),
(24, 'ANZA', 3),
(25, 'APARTADO', 3),
(26, 'ARBOLETES', 3),
(27, 'ARGELIA', 3),
(28, 'ARMENIA', 3),
(29, 'BARBOSA', 3),
(30, 'BELMIRA', 3),
(31, 'BELLO', 3),
(32, 'BETANIA', 3),
(33, 'BETULIA', 3),
(34, 'CIUDAD BOLIVAR', 3),
(35, 'BRICEÑO', 3),
(36, 'BURITICA', 3),
(37, 'CACERES', 3),
(38, 'CAICEDO', 3),
(39, 'CALDAS', 3),
(40, 'CAMPAMENTO', 3),
(41, 'CAÑASGORDAS', 3),
(42, 'CARACOLI', 3),
(43, 'CARAMANTA', 3),
(44, 'CAREPA', 3),
(45, 'EL CARMEN DE VIBORAL', 3),
(46, 'CAROLINA', 3),
(47, 'CAUCASIA', 3),
(48, 'CHIGORODO', 3),
(49, 'CISNEROS', 3),
(50, 'COCORNA', 3),
(51, 'CONCEPCION', 3),
(52, 'CONCORDIA', 3),
(53, 'COPACABANA', 3),
(54, 'DABEIBA', 3),
(55, 'DON MATIAS', 3),
(56, 'EBEJICO', 3),
(57, 'EL BAGRE', 3),
(58, 'ENTRERRIOS', 3),
(59, 'ENVIGADO', 3),
(60, 'FREDONIA', 3),
(61, 'FRONTINO', 3),
(62, 'GIRALDO', 3),
(63, 'GIRARDOTA', 3),
(64, 'GOMEZ PLATA', 3),
(65, 'GRANADA', 3),
(66, 'GUADALUPE', 3),
(67, 'GUARNE', 3),
(68, 'GUATAPE', 3),
(69, 'HELICONIA', 3),
(70, 'HISPANIA', 3),
(71, 'ITAGUI', 3),
(72, 'ITUANGO', 3),
(73, 'JARDIN', 3),
(74, 'JERICO', 3),
(75, 'LA CEJA', 3),
(76, 'LA ESTRELLA', 3),
(77, 'LA PINTADA', 3),
(78, 'LA UNION', 3),
(79, 'LIBORINA', 3),
(80, 'MACEO', 3),
(81, 'MARINILLA', 3),
(82, 'MONTEBELLO', 3),
(83, 'MURINDO', 3),
(84, 'MUTATA', 3),
(85, 'NARIÑO', 3),
(86, 'NECOCLI', 3),
(87, 'NECHI', 3),
(88, 'OLAYA', 3),
(89, 'PEÐOL', 3),
(90, 'PEQUE', 3),
(91, 'PUEBLORRICO', 3),
(92, 'PUERTO BERRIO', 3),
(93, 'PUERTO NARE', 3),
(94, 'PUERTO TRIUNFO', 3),
(95, 'REMEDIOS', 3),
(96, 'RETIRO', 3),
(97, 'RIONEGRO', 3),
(98, 'SABANALARGA', 3),
(99, 'SABANETA', 3),
(100, 'SALGAR', 3),
(101, 'SAN ANDRES DE CUERQUIA', 3),
(102, 'SAN CARLOS', 3),
(103, 'SAN FRANCISCO', 3),
(104, 'SAN JERONIMO', 3),
(105, 'SAN JOSE DE LA MONTAÑA', 3),
(106, 'SAN JUAN DE URABA', 3),
(107, 'SAN LUIS', 3),
(108, 'SAN PEDRO', 3),
(109, 'SAN PEDRO DE URABA', 3),
(110, 'SAN RAFAEL', 3),
(111, 'SAN ROQUE', 3),
(112, 'SAN VICENTE', 3),
(113, 'SANTA BARBARA', 3),
(114, 'SANTA ROSA DE OSOS', 3),
(115, 'SANTO DOMINGO', 3),
(116, 'EL SANTUARIO', 3),
(117, 'SEGOVIA', 3),
(118, 'SONSON', 3),
(119, 'SOPETRAN', 3),
(120, 'TAMESIS', 3),
(121, 'TARAZA', 3),
(122, 'TARSO', 3),
(123, 'TITIRIBI', 3),
(124, 'TOLEDO', 3),
(125, 'TURBO', 3),
(126, 'URAMITA', 3),
(127, 'URRAO', 3),
(128, 'VALDIVIA', 3),
(129, 'VALPARAISO', 3),
(130, 'VEGACHI', 3),
(131, 'VENECIA', 3),
(132, 'VIGIA DEL FUERTE', 3),
(133, 'YALI', 3),
(134, 'YARUMAL', 3),
(135, 'YOLOMBO', 3),
(136, 'YONDO', 3),
(137, 'ZARAGOZA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dpto`
--

CREATE TABLE `dpto` (
  `idDpto` int(11) NOT NULL,
  `nombreDpto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dpto`
--

INSERT INTO `dpto` (`idDpto`, `nombreDpto`) VALUES
(1, 'Bogotá D.C'),
(2, 'AMAZONAS'),
(3, 'ANTIOQUIA'),
(4, 'ARAUCA'),
(5, 'ATLANTICO'),
(7, 'BOLIVAR'),
(8, 'BOYACA'),
(9, 'CALDAS'),
(10, 'CAQUETA'),
(11, 'CASANARE'),
(12, 'CAUCA'),
(13, 'CESAR'),
(14, 'CHOCO'),
(15, 'CORDOBA'),
(16, 'CUNDINAMARCA'),
(17, 'GUAINIA'),
(18, 'GUAVIARE'),
(19, 'HUILA'),
(20, 'LA GUAJIRA'),
(21, 'MAGDALENA'),
(22, 'META'),
(23, 'N. DE SANTANDER'),
(24, 'NARIÑO'),
(25, 'PUTUMAYO'),
(26, 'QUINDIO'),
(27, 'RISARALDA'),
(28, 'SAN ANDRES'),
(29, 'SANTANDER'),
(30, 'SUCRE'),
(31, 'TOLIMA'),
(32, 'VALLE DEL CAUCA'),
(33, 'VAUPES'),
(34, 'VICHADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `FacturaDetalle_idFacturaDetalle` int(11) NOT NULL,
  `idVendedor` varchar(20) NOT NULL,
  `Usuario_Cedula1` varchar(20) NOT NULL,
  `subTotal` int(11) NOT NULL,
  `iva` int(11) NOT NULL COMMENT 'puede ser un campo calculado\n',
  `total` int(11) NOT NULL,
  `fechaExpedicion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `FacturaDetalle_idFacturaDetalle`, `idVendedor`, `Usuario_Cedula1`, `subTotal`, `iva`, `total`, `fechaExpedicion`) VALUES
(3, 5, '1', '2', 10000, 1800, 11800, '2021-06-23 18:43:15'),
(4, 3, '1', '2', 30000, 4600, 34600, '2021-06-23 18:43:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturadetalle`
--

CREATE TABLE `facturadetalle` (
  `idFacturaDetalle` int(11) NOT NULL,
  `cantidadProductos` varchar(45) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturadetalle`
--

INSERT INTO `facturadetalle` (`idFacturaDetalle`, `cantidadProductos`, `idProducto`) VALUES
(2, '2', 1),
(3, '2', 2),
(4, '3', 3),
(5, '1', 2),
(6, '5', 3),
(7, '4', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialcredito`
--

CREATE TABLE `historialcredito` (
  `idHistorialCredito` int(11) NOT NULL,
  `estadoCredito` varchar(45) NOT NULL,
  `saldoPendiente` varchar(45) NOT NULL COMMENT 'se podría calcular en el programa',
  `valorFactura` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historialcredito`
--

INSERT INTO `historialcredito` (`idHistorialCredito`, `estadoCredito`, `saldoPendiente`, `valorFactura`) VALUES
(1, 'Cerrado', '0', '150000'),
(2, 'Abierto', '60000', '250000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialnomina`
--

CREATE TABLE `historialnomina` (
  `idHistorialNomina` int(11) NOT NULL,
  `idUsuario` varchar(20) NOT NULL,
  `fechaPago` datetime NOT NULL,
  `montoPagado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historialnomina`
--

INSERT INTO `historialnomina` (`idHistorialNomina`, `idUsuario`, `fechaPago`, `montoPagado`) VALUES
(1, '2', '2021-06-23 10:30:50', 25000),
(2, '1', '2021-06-23 10:30:50', 30000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialventas`
--

CREATE TABLE `historialventas` (
  `idHistorialVentas` int(11) NOT NULL,
  `CedulaCliente` varchar(20) NOT NULL,
  `CedulaVendedor` varchar(20) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `idTipoA` int(11) NOT NULL,
  `HistorialCredito_idHistorialCredito` int(11) NOT NULL,
  `fechaVenta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historialventas`
--

INSERT INTO `historialventas` (`idHistorialVentas`, `CedulaCliente`, `CedulaVendedor`, `idFactura`, `idTipoA`, `HistorialCredito_idHistorialCredito`, `fechaVenta`) VALUES
(1, '2', '1', 3, 1, 1, '2021-06-24 10:33:41'),
(2, '2', '1', 4, 3, 2, '2021-06-24 10:33:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idInventario`, `idProducto`, `stock`) VALUES
(1, 1, 5),
(2, 1, 5),
(3, 2, 10),
(4, 3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `idCategoriaP` int(11) NOT NULL,
  `fotoP` mediumblob NOT NULL,
  `nombreP` varchar(60) NOT NULL,
  `descripcionP` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `idCategoriaP`, `fotoP`, `nombreP`, `descripcionP`) VALUES
(1, 3, '', 'Cortina Baño', 'Platica'),
(2, 1, '', 'Sabana sencilla', 'Cama 120 m'),
(3, 1, '', 'Sabana doble', 'Cama 140 m');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoxproveedor`
--

CREATE TABLE `productoxproveedor` (
  `Producto_idProducto` int(11) NOT NULL,
  `Proveedor_idProveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productoxproveedor`
--

INSERT INTO `productoxproveedor` (`Producto_idProducto`, `Proveedor_idProveedor`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nomProveedor` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Telefono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nomProveedor`, `Direccion`, `Telefono`) VALUES
(1, 'Sabanas Buenas', 'Calle con avenida', '3110252454'),
(2, 'Anto Grande Baños', 'Calle con avenida', '3502484522'),
(3, 'Linceria al por mayor', 'Calle con avenida', '3162309840'),
(4, 'Districasa', 'Calle con avenida', '3214205789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Admin'),
(2, 'Cliente'),
(3, 'Vendedor'),
(4, 'Cobrador'),
(5, 'Contador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoabono`
--

CREATE TABLE `tipoabono` (
  `idTipoAbono` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoabono`
--

INSERT INTO `tipoabono` (`idTipoAbono`, `Nombre`) VALUES
(1, 'Contado'),
(2, 'Abono Credito'),
(3, 'Credito'),
(4, 'Transferencia Bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Cedula` varchar(20) NOT NULL,
  `Ciudad_idCiudad` int(11) NOT NULL,
  `Rol_idRol` int(11) NOT NULL,
  `Nombre` varchar(35) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Celular` varchar(10) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL DEFAULT 'abc1234'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Cedula`, `Ciudad_idCiudad`, `Rol_idRol`, `Nombre`, `Apellido`, `Direccion`, `Celular`, `Correo`, `Contraseña`) VALUES
('1', 1, 1, 'Cristian', 'Güiza', 'Calle 59 Sur No. 93 C 46', '3023793075', 'crisandrey5@gmail.com', 'abc123'),
('2', 1, 2, 'ccliente', 'aCliente', 'xaaaaa', '465465', 'asdsa', 'abc123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  ADD PRIMARY KEY (`idCategoriaP`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `fk_Ciudad_Dpto_idx` (`Dpto_idDpto`);

--
-- Indices de la tabla `dpto`
--
ALTER TABLE `dpto`
  ADD PRIMARY KEY (`idDpto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_FacturaDetalle1_idx` (`FacturaDetalle_idFacturaDetalle`),
  ADD KEY `fk_Factura_Usuario1_idx` (`idVendedor`),
  ADD KEY `fk_Factura_Usuario2_idx` (`Usuario_Cedula1`);

--
-- Indices de la tabla `facturadetalle`
--
ALTER TABLE `facturadetalle`
  ADD PRIMARY KEY (`idFacturaDetalle`),
  ADD KEY `fk_FacturaDetalle_Producto1_idx` (`idProducto`);

--
-- Indices de la tabla `historialcredito`
--
ALTER TABLE `historialcredito`
  ADD PRIMARY KEY (`idHistorialCredito`);

--
-- Indices de la tabla `historialnomina`
--
ALTER TABLE `historialnomina`
  ADD PRIMARY KEY (`idHistorialNomina`),
  ADD KEY `fk_HistorialNomina_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `historialventas`
--
ALTER TABLE `historialventas`
  ADD PRIMARY KEY (`idHistorialVentas`),
  ADD KEY `fk_HistorialVentas_Usuario1_idx` (`CedulaCliente`),
  ADD KEY `fk_HistorialVentas_Usuario2_idx` (`CedulaVendedor`),
  ADD KEY `fk_HistorialVentas_Factura1_idx` (`idFactura`),
  ADD KEY `fk_HistorialVentas_TipoAbono1_idx` (`idTipoA`),
  ADD KEY `fk_HistorialVentas_HistorialCredito1_idx` (`HistorialCredito_idHistorialCredito`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `fk_Inventario_Producto1_idx` (`idProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_Producto_CategoriaProducto1_idx` (`idCategoriaP`);

--
-- Indices de la tabla `productoxproveedor`
--
ALTER TABLE `productoxproveedor`
  ADD PRIMARY KEY (`Producto_idProducto`,`Proveedor_idProveedor`),
  ADD KEY `fk_Producto_has_Proveedor_Proveedor1_idx` (`Proveedor_idProveedor`),
  ADD KEY `fk_Producto_has_Proveedor_Producto1_idx` (`Producto_idProducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tipoabono`
--
ALTER TABLE `tipoabono`
  ADD PRIMARY KEY (`idTipoAbono`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Cedula`),
  ADD KEY `fk_Usuario_Ciudad1_idx` (`Ciudad_idCiudad`),
  ADD KEY `fk_Usuario_Rol1_idx` (`Rol_idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `idCategoriaP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de la tabla `dpto`
--
ALTER TABLE `dpto`
  MODIFY `idDpto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `facturadetalle`
--
ALTER TABLE `facturadetalle`
  MODIFY `idFacturaDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historialcredito`
--
ALTER TABLE `historialcredito`
  MODIFY `idHistorialCredito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historialnomina`
--
ALTER TABLE `historialnomina`
  MODIFY `idHistorialNomina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historialventas`
--
ALTER TABLE `historialventas`
  MODIFY `idHistorialVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipoabono`
--
ALTER TABLE `tipoabono`
  MODIFY `idTipoAbono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_Ciudad_Dpto` FOREIGN KEY (`Dpto_idDpto`) REFERENCES `dpto` (`idDpto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_FacturaDetalle1` FOREIGN KEY (`FacturaDetalle_idFacturaDetalle`) REFERENCES `facturadetalle` (`idFacturaDetalle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Usuario1` FOREIGN KEY (`idVendedor`) REFERENCES `usuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Usuario2` FOREIGN KEY (`Usuario_Cedula1`) REFERENCES `usuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturadetalle`
--
ALTER TABLE `facturadetalle`
  ADD CONSTRAINT `fk_FacturaDetalle_Producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historialnomina`
--
ALTER TABLE `historialnomina`
  ADD CONSTRAINT `fk_HistorialNomina_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historialventas`
--
ALTER TABLE `historialventas`
  ADD CONSTRAINT `fk_HistorialVentas_Factura1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistorialVentas_HistorialCredito1` FOREIGN KEY (`HistorialCredito_idHistorialCredito`) REFERENCES `historialcredito` (`idHistorialCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistorialVentas_TipoAbono1` FOREIGN KEY (`idTipoA`) REFERENCES `tipoabono` (`idTipoAbono`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistorialVentas_Usuario1` FOREIGN KEY (`CedulaCliente`) REFERENCES `usuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistorialVentas_Usuario2` FOREIGN KEY (`CedulaVendedor`) REFERENCES `usuario` (`Cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_Inventario_Producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_CategoriaProducto1` FOREIGN KEY (`idCategoriaP`) REFERENCES `categoriaproducto` (`idCategoriaP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productoxproveedor`
--
ALTER TABLE `productoxproveedor`
  ADD CONSTRAINT `fk_Producto_has_Proveedor_Producto1` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_Proveedor_Proveedor1` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Ciudad1` FOREIGN KEY (`Ciudad_idCiudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

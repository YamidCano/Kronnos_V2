-- Crear Base de datos Kronnos

CREATE DATABASE kronnos;

-- Ingresamos a la Base de datos Kronnos

use kronnos;

-- Crear tabla categoriaproducto

CREATE TABLE categoriaproducto (
  idCategoriaP int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombreCategoría varchar(45) NOT NULL
);

-- Crear tabla dpto

CREATE TABLE dpto (
  idDpto int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombreDpto varchar(25) NOT NULL
);

-- Crear tabla  ciudad

CREATE TABLE ciudad (
  idCiudad int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombreCiudad varchar(45) NOT NULL,
  Dpto_idDpto int NOT NULL,
  KEY fk_Ciudad_Dpto_idx (Dpto_idDpto),
  CONSTRAINT fk_Ciudad_Dpto FOREIGN KEY (Dpto_idDpto) REFERENCES dpto (idDpto) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear tabla rol

CREATE TABLE rol (
  idRol int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombreRol varchar(45) NOT NULL
);

-- Crear tabla tipoabono

CREATE TABLE tipoabono (
  idTipoAbono int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  Nombre varchar(25) NOT NULL
);

-- Crear tabla usuario

CREATE TABLE usuario (
  Cedula varchar(20) PRIMARY KEY NOT NULL,
  Ciudad_idCiudad int NOT NULL,
  Rol_idRol int NOT NULL,
  Nombre varchar(35) NOT NULL,
  Apellido varchar(45) NOT NULL,
  Direccion varchar(45) NOT NULL,
  Celular varchar(10) NOT NULL,
  Correo varchar(45) NOT NULL,
  Contraseña varchar(45) NOT NULL DEFAULT 'abc1234',
  KEY fk_Usuario_Ciudad1_idx (Ciudad_idCiudad),
  KEY fk_Usuario_Rol1_idx (Rol_idRol),
  CONSTRAINT fk_Usuario_Ciudad1 FOREIGN KEY (Ciudad_idCiudad) REFERENCES ciudad (idCiudad) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_Usuario_Rol1 FOREIGN KEY (Rol_idRol) REFERENCES rol (idRol) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear tabla historialcredito

CREATE TABLE historialcredito (
  idHistorialCredito int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  estadoCredito varchar(45) NOT NULL,
  saldoPendiente varchar(45) NOT NULL COMMENT 'se podría calcular en el programa',
  valorFactura varchar(45) NOT NULL
);

-- Crear historialnomina

CREATE TABLE historialnomina (
  idHistorialNomina int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  idUsuario varchar(20) NOT NULL,
  fechaPago datetime NOT NULL,
  montoPagado int NOT NULL,
  KEY fk_HistorialNomina_Usuario1_idx (idUsuario),
  CONSTRAINT fk_HistorialNomina_Usuario1 FOREIGN KEY (idUsuario) REFERENCES usuario (Cedula) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear proveedor

CREATE TABLE proveedor (
  idProveedor int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nomProveedor varchar(45) NOT NULL,
  Direccion varchar(45) NOT NULL,
  Telefono varchar(45) NOT NULL
);

-- Crear tabla producto

CREATE TABLE producto (
  idProducto int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  idCategoriaP int NOT NULL,
  fotoP mediumblob NOT NULL,
  nombreP varchar(60) NOT NULL,
  descripcionP mediumtext NOT NULL,
  KEY fk_Producto_CategoriaProducto1_idx (idCategoriaP),
  CONSTRAINT fk_Producto_CategoriaProducto1 
  FOREIGN KEY (idCategoriaP) 
  REFERENCES categoriaproducto (idCategoriaP) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear tabla productoxproveedor

CREATE TABLE productoxproveedor (
  Producto_idProducto int NOT NULL,
  Proveedor_idProveedor int NOT NULL,
  PRIMARY KEY (Producto_idProducto,Proveedor_idProveedor),
  KEY fk_Producto_has_Proveedor_Proveedor1_idx (Proveedor_idProveedor),
  KEY fk_Producto_has_Proveedor_Producto1_idx (Producto_idProducto),  
  CONSTRAINT fk_Producto_has_Proveedor_Producto1 
  FOREIGN KEY (Producto_idProducto) 
  REFERENCES producto (idProducto) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_Producto_has_Proveedor_Proveedor1 
  FOREIGN KEY (Proveedor_idProveedor) 
  REFERENCES proveedor (idProveedor) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear tabla inventario

CREATE TABLE inventario (
  idInventario int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  idProducto int NOT NULL,
  stock int NOT NULL,
  KEY fk_Inventario_Producto1_idx (idProducto),
  CONSTRAINT fk_Inventario_Producto1 
  FOREIGN KEY (idProducto) 
  REFERENCES producto (idProducto) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear facturadetalle

CREATE TABLE facturadetalle (
  idFacturaDetalle int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  cantidadProductos varchar(45) NOT NULL,
  idProducto int NOT NULL,
  KEY fk_FacturaDetalle_Producto1_idx (idProducto),
  CONSTRAINT fk_FacturaDetalle_Producto1 
  FOREIGN KEY (idProducto) 
  REFERENCES producto (idProducto) ON DELETE NO ACTION ON UPDATE NO ACTION
);

--Crear factura

CREATE TABLE factura (
  idFactura int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  FacturaDetalle_idFacturaDetalle int NOT NULL,
  idVendedor varchar(20) NOT NULL,
  Usuario_Cedula1 varchar(20) NOT NULL,
  subTotal int NOT NULL,
  iva int NOT NULL COMMENT 'puede ser un campo calculado\n',
  total int NOT NULL,
  fechaExpedicion datetime NOT NULL,
  KEY fk_Factura_FacturaDetalle1_idx (FacturaDetalle_idFacturaDetalle),
  KEY fk_Factura_Usuario1_idx (idVendedor),
  KEY fk_Factura_Usuario2_idx (Usuario_Cedula1),
  CONSTRAINT fk_Factura_FacturaDetalle1 
  FOREIGN KEY (FacturaDetalle_idFacturaDetalle) 
  REFERENCES facturadetalle (idFacturaDetalle) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_Usuario1 
  FOREIGN KEY (idVendedor) 
  REFERENCES usuario (Cedula) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_Usuario2 
  FOREIGN KEY (Usuario_Cedula1) 
  REFERENCES usuario (Cedula) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Crear historialventas

CREATE TABLE historialventas (
  idHistorialVentas int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  CedulaCliente varchar(20) NOT NULL,
  CedulaVendedor varchar(20) NOT NULL,
  idFactura int NOT NULL,
  idTipoA int NOT NULL,
  HistorialCredito_idHistorialCredito int NOT NULL,
  fechaVenta datetime NOT NULL,
  KEY fk_HistorialVentas_Usuario1_idx (CedulaCliente),
  KEY fk_HistorialVentas_Usuario2_idx (CedulaVendedor),
  KEY fk_HistorialVentas_Factura1_idx (idFactura),
  KEY fk_HistorialVentas_TipoAbono1_idx (idTipoA),
  KEY fk_HistorialVentas_HistorialCredito1_idx (HistorialCredito_idHistorialCredito),
  CONSTRAINT fk_HistorialVentas_Factura1 FOREIGN KEY (idFactura) REFERENCES factura (idFactura) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_HistorialVentas_HistorialCredito1 FOREIGN KEY (HistorialCredito_idHistorialCredito) REFERENCES historialcredito (idHistorialCredito) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_HistorialVentas_TipoAbono1 FOREIGN KEY (idTipoA) REFERENCES tipoabono (idTipoAbono) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_HistorialVentas_Usuario1 FOREIGN KEY (CedulaCliente) REFERENCES usuario (Cedula) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_HistorialVentas_Usuario2 FOREIGN KEY (CedulaVendedor) REFERENCES usuario (Cedula) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- ------------------------------------------------------------------------------------------------------------------------

-- Insertar datos a la tabla categoriaproducto

INSERT INTO categoriaproducto (idCategoriaP, nombreCategoría) VALUES
(NULL, 'Sabanas'),
(NULL, 'Cubrelechos'),
(NULL, 'Tapetes Baños'),
(NULL, 'Cortinas'),
(NULL, 'Tapete para sala'),
(NULL, 'Tapete para Habitacion'),
(NULL, 'Cojines'),
(NULL, 'Toallas');

-- Insertar datos a la tabla dpto

INSERT INTO dpto (idDpto, nombreDpto) VALUES
(NULL, 'Bogotá D.C'),
(NULL, 'AMAZONAS'),
(NULL, 'ANTIOQUIA'),
(NULL, 'ARAUCA'),
(NULL, 'ATLANTICO'),
(NULL, 'BOLIVAR'),
(NULL, 'BOYACA'),
(NULL, 'CALDAS'),
(NULL, 'CAQUETA'),
(NULL, 'CASANARE'),
(NULL, 'CAUCA'),
(NULL, 'CESAR'),
(NULL, 'CHOCO'),
(NULL, 'CORDOBA'),
(NULL, 'CUNDINAMARCA'),
(NULL, 'GUAINIA'),
(NULL, 'GUAVIARE'),
(NULL, 'HUILA'),
(NULL, 'LA GUAJIRA'),
(NULL, 'MAGDALENA'),
(NULL, 'META'),
(NULL, 'N. DE SANTANDER'),
(NULL, 'NARIÑO'),
(NULL, 'PUTUMAYO'),
(NULL, 'QUINDIO'),
(NULL, 'RISARALDA'),
(NULL, 'SAN ANDRES'),
(NULL, 'SANTANDER'),
(NULL, 'SUCRE'),
(NULL, 'TOLIMA'),
(NULL, 'VALLE DEL CAUCA'),
(NULL, 'VAUPES'),
(NULL, 'VICHADA');

--Insertar datos a la tabla ciudad

INSERT INTO ciudad (idCiudad, nombreCiudad, Dpto_idDpto) VALUES
(NULL, 'Bogotá', 1),
(NULL, 'LETICIA', 2),
(NULL, 'EL ENCANTO', 2),
(NULL, 'LA CHORRERA', 2),
(NULL, 'LA PEDRERA', 2),
(NULL, 'LA VICTORIA', 2),
(NULL, 'MIRITI - PARANA', 2),
(NULL, 'PUERTO ALEGRIA', 2),
(NULL, 'PUERTO ARICA', 2),
(NULL, 'PUERTO NARIÑO', 2),
(NULL, 'PUERTO SANTANDER', 2),
(NULL, 'TARAPACA', 2),
(NULL, 'MEDELLIN', 3),
(NULL, 'ABEJORRAL', 3),
(NULL, 'ABRIAQUI', 3),
(NULL, 'ALEJANDRIA', 3),
(NULL, 'AMAGA', 3),
(NULL, 'AMALFI', 3),
(NULL, 'ANDES', 3),
(NULL, 'ANGELOPOLIS', 3),
(NULL, 'ANGOSTURA', 3),
(NULL, 'ANORI', 3),
(NULL, 'SANTAFE DE ANTIOQUIA', 3),
(NULL, 'ANZA', 3),
(NULL, 'APARTADO', 3),
(NULL, 'ARBOLETES', 3),
(NULL, 'ARGELIA', 3),
(NULL, 'ARMENIA', 3),
(NULL, 'BARBOSA', 3),
(NULL, 'BELMIRA', 3),
(NULL, 'BELLO', 3),
(NULL, 'BETANIA', 3),
(NULL, 'BETULIA', 3),
(NULL, 'CIUDAD BOLIVAR', 3),
(NULL, 'BRICEÑO', 3),
(NULL, 'BURITICA', 3),
(NULL, 'CACERES', 3),
(NULL, 'CAICEDO', 3),
(NULL, 'CALDAS', 3),
(NULL, 'CAMPAMENTO', 3),
(NULL, 'CAÑASGORDAS', 3),
(NULL, 'CARACOLI', 3),
(NULL, 'CARAMANTA', 3),
(NULL, 'CAREPA', 3),
(NULL, 'EL CARMEN DE VIBORAL', 3),
(NULL, 'CAROLINA', 3),
(NULL, 'CAUCASIA', 3),
(NULL, 'CHIGORODO', 3),
(NULL, 'CISNEROS', 3),
(NULL, 'COCORNA', 3),
(NULL, 'CONCEPCION', 3),
(NULL, 'CONCORDIA', 3),
(NULL, 'COPACABANA', 3),
(NULL, 'DABEIBA', 3),
(NULL, 'DON MATIAS', 3),
(NULL, 'EBEJICO', 3),
(NULL, 'EL BAGRE', 3),
(NULL, 'ENTRERRIOS', 3),
(NULL, 'ENVIGADO', 3),
(NULL, 'FREDONIA', 3),
(NULL, 'FRONTINO', 3),
(NULL, 'GIRALDO', 3),
(NULL, 'GIRARDOTA', 3),
(NULL, 'GOMEZ PLATA', 3),
(NULL, 'GRANADA', 3),
(NULL, 'GUADALUPE', 3),
(NULL, 'GUARNE', 3),
(NULL, 'GUATAPE', 3),
(NULL, 'HELICONIA', 3),
(NULL, 'HISPANIA', 3),
(NULL, 'ITAGUI', 3),
(NULL, 'ITUANGO', 3),
(NULL, 'JARDIN', 3),
(NULL, 'JERICO', 3),
(NULL, 'LA CEJA', 3),
(NULL, 'LA ESTRELLA', 3),
(NULL, 'LA PINTADA', 3),
(NULL, 'LA UNION', 3),
(NULL, 'LIBORINA', 3),
(NULL, 'MACEO', 3),
(NULL, 'MARINILLA', 3),
(NULL, 'MONTEBELLO', 3),
(NULL, 'MURINDO', 3),
(NULL, 'MUTATA', 3),
(NULL, 'NARIÑO', 3),
(NULL, 'NECOCLI', 3),
(NULL, 'NECHI', 3),
(NULL, 'OLAYA', 3),
(NULL, 'PEÐOL', 3),
(NULL, 'PEQUE', 3),
(NULL, 'PUEBLORRICO', 3),
(NULL, 'PUERTO BERRIO', 3),
(NULL, 'PUERTO NARE', 3),
(NULL, 'PUERTO TRIUNFO', 3),
(NULL, 'REMEDIOS', 3),
(NULL, 'RETIRO', 3),
(NULL, 'RIONEGRO', 3),
(NULL, 'SABANALARGA', 3),
(NULL, 'SABANETA', 3),
(NULL, 'SALGAR', 3),
(NULL, 'SAN ANDRES DE CUERQUIA', 3),
(NULL, 'SAN CARLOS', 3),
(NULL, 'SAN FRANCISCO', 3),
(NULL, 'SAN JERONIMO', 3),
(NULL, 'SAN JOSE DE LA MONTAÑA', 3),
(NULL, 'SAN JUAN DE URABA', 3),
(NULL, 'SAN LUIS', 3),
(NULL, 'SAN PEDRO', 3),
(NULL, 'SAN PEDRO DE URABA', 3),
(NULL, 'SAN RAFAEL', 3),
(NULL, 'SAN ROQUE', 3),
(NULL, 'SAN VICENTE', 3),
(NULL, 'SANTA BARBARA', 3),
(NULL, 'SANTA ROSA DE OSOS', 3),
(NULL, 'SANTO DOMINGO', 3),
(NULL, 'EL SANTUARIO', 3),
(NULL, 'SEGOVIA', 3),
(NULL, 'SONSON', 3),
(NULL, 'SOPETRAN', 3),
(NULL, 'TAMESIS', 3),
(NULL, 'TARAZA', 3),
(NULL, 'TARSO', 3),
(NULL, 'TITIRIBI', 3),
(NULL, 'TOLEDO', 3),
(NULL, 'TURBO', 3),
(NULL, 'URAMITA', 3),
(NULL, 'URRAO', 3),
(NULL, 'VALDIVIA', 3),
(NULL, 'VALPARAISO', 3),
(NULL, 'VEGACHI', 3),
(NULL, 'VENECIA', 3),
(NULL, 'VIGIA DEL FUERTE', 3),
(NULL, 'YALI', 3),
(NULL, 'YARUMAL', 3),
(NULL, 'YOLOMBO', 3),
(NULL, 'YONDO', 3),
(NULL, 'ZARAGOZA', 3);

-- Insertar datos a la tabla rol

INSERT INTO rol (idRol, nombreRol) VALUES
(NULL, 'Admin'),
(NULL, 'Cliente'),
(NULL, 'Vendedor'),
(NULL, 'Cobrador'),
(NULL, 'Contador');

-- Insertar datos a la tabla tipoabono

INSERT INTO tipoabono (idTipoAbono, Nombre) VALUES
(NULL, 'Contado'),
(NULL, 'Abono Credito'),
(NULL, 'Credito'),
(NULL, 'Transferencia Bancaria');

-- Insertar datos a la tabla usuario

INSERT INTO usuario (Cedula, Ciudad_idCiudad, Rol_idRol, Nombre, Apellido, Direccion, Celular, Correo, Contraseña) VALUES 
('1', '1', '1', 'Cristian', 'Güiza', 'Calle 59 Sur No. 93 C 46', '3023793075', 'crisandrey5@gmail.com', 'abc1234'), 
('2', '1', '2', 'ccliente', 'aCliente', 'xaaaaa', '465465', 'asdsa', 'abc1234');

-- Insertar datos a la tabla historialcredito

INSERT INTO historialcredito (idHistorialCredito, estadoCredito, saldoPendiente, valorFactura) VALUES
(NULL, 'Cerrado', '0', '150000'),
(NULL, 'Abierto', '60000', '250000');

-- Insertar datos a la tabla historialnomina

INSERT INTO historialnomina (idHistorialNomina, idUsuario, fechaPago, montoPagado) VALUES
(NULL, '2', '2021-06-23 10:30:50', 25000),
(NULL, '1', '2021-06-23 10:30:50', 30000);

--Insertar datos a la tabla proveedor

INSERT INTO proveedor (idProveedor, nomProveedor, Direccion, Telefono) VALUES
(NULL, 'Sabanas Buenas', 'Calle con avenida', '3110252454'),
(NULL, 'Anto Grande Baños', 'Calle con avenida', '3502484522'),
(NULL, 'Linceria al por mayor', 'Calle con avenida', '3162309840'),
(NULL, 'Districasa', 'Calle con avenida', '3214205789');

-- Insertar datos a la tabla producto

INSERT INTO producto (idProducto, idCategoriaP, fotoP, nombreP, descripcionP) VALUES
(NULL, 3, '', 'Cortina Baño', 'Platica'),
(NULL, 1, '', 'Sabana sencilla', 'Cama 120 m'),
(NULL, 1, '', 'Sabana doble', 'Cama 140 m');

-- Insertar datos a la tabla productoxproveedor

INSERT INTO productoxproveedor (Producto_idProducto, Proveedor_idProveedor) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 4);

-- Insertar datos a la tabla  inventario

INSERT INTO inventario (idInventario, idProducto, stock) VALUES
(NULL, 1, 5),
(NULL, 1, 5),
(NULL, 2, 10),
(NULL, 3, 8);


-- Insertar datos a la tabla facturadetalle

INSERT INTO facturadetalle (idFacturaDetalle, cantidadProductos, idProducto) VALUES
(NULL, '2', 1),
(NULL, '2', 2),
(NULL, '3', 3),
(NULL, '1', 2),
(NULL, '5', 3),
(NULL, '4', 3);

-- Insertar datos a la tabla tabla factura

INSERT INTO factura (idFactura, FacturaDetalle_idFacturaDetalle, idVendedor, Usuario_Cedula1, subTotal, iva, total, fechaExpedicion) VALUES
(NULL, '5', '1', '2', 10000, 1800, 11800, '2021-06-23 18:43:15'),
(NULL, '3', '1', '2', 30000, 4600, 34600, '2021-06-23 18:43:15');

-- Insertar datos a la tabla historialventas

INSERT INTO historialventas (idHistorialVentas, CedulaCliente, CedulaVendedor, idFactura, idTipoA, HistorialCredito_idHistorialCredito, fechaVenta) VALUES
(NULL, '2', '1', '1', '1','1', '2021-06-24 10:33:41'),
(NULL, '2', '1', '2', '3', '2', '2021-06-24 10:33:41');

INSERT INTO `historialventas` (`idHistorialVentas`, `CedulaCliente`, `CedulaVendedor`, `idFactura`, `idTipoA`, `HistorialCredito_idHistorialCredito`, `fechaVenta`) VALUES 
(NULL, '1', '1', '1', '3', '2', '2021-06-24 10:33:41');


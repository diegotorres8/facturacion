-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2019 a las 16:56:59
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `ID_PRODUCTO` int(11) NOT NULL COMMENT 'codigo del articulo',
  `ID_CATEGORIA` int(11) NOT NULL COMMENT 'codigo de la categoria',
  `NOMBRE` varchar(50) NOT NULL COMMENT 'Nombre del articulo',
  `DESCRIPCION` varchar(50) DEFAULT NULL COMMENT 'Descripcion del articulo',
  `CANTIDAD` decimal(11,2) NOT NULL COMMENT 'cantidad del articulo',
  `PRECIO` decimal(11,2) NOT NULL COMMENT 'precio del articulo',
  `IVA` char(1) NOT NULL DEFAULT 'S' COMMENT 'El producto lleva Iva\r\n            S=Si\r\n            N=No',
  `ESTADO` char(1) NOT NULL DEFAULT 'A' COMMENT 'Estado del articulo\r\n            A=activo\r\n            I=Inactivo',
  `CANTIDAD_MINIMA` int(11) DEFAULT NULL,
  `CANTIDAD_MAXIMO` int(11) DEFAULT NULL,
  `FECHA_CREA` date DEFAULT NULL COMMENT 'fecha de creacion del registro',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'usuario crea el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'fecha modifica el registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'usuario modifica el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los articulos';

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`ID_PRODUCTO`, `ID_CATEGORIA`, `NOMBRE`, `DESCRIPCION`, `CANTIDAD`, `PRECIO`, `IVA`, `ESTADO`, `CANTIDAD_MINIMA`, `CANTIDAD_MAXIMO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
(1, 1, 'LECHE DESCREMADA ', 'LECHE DESCREMANDACARTON', '13.00', '1.00', 'S', 'A', 10, 100, '2019-06-26', '1', NULL, NULL),
(1, 2, 'QUESONORMAL', 'QUESO NORMAL', '4.00', '0.50', 'S', 'A', 50, 100, '2019-06-26', '1', NULL, NULL),
(1, 3, 'YOGURT', 'YOGURT', '50.00', '2.80', 'S', 'A', 50, 200, '2019-06-26', '1', NULL, NULL),
(2, 1, 'Leche normal', 'leche normal', '9.00', '1.20', 'S', 'A', 10, 50, '2019-07-18', '1', NULL, NULL),
(2, 2, 'queso normal', 'queso normal', '150.00', '20.00', 'S', 'A', 10, 20, '2019-07-18', '1', NULL, NULL),
(2, 3, 'en funda', 'en funda', '100.00', '1.50', 'S', 'A', 10, 100, '2019-07-21', '1', NULL, NULL),
(3, 1, 'leche funda', 'leche funda', '4.00', '2.00', 'S', 'A', 1, 20, '2019-07-18', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL COMMENT 'codigo de la categoria',
  `NOMBRE` varchar(50) NOT NULL COMMENT 'nombre de la categoria',
  `ESTADO` char(1) NOT NULL DEFAULT 'A' COMMENT 'Estado de la categoria\r\n            A=Activo\r\n            I=Inactivo',
  `FECHA_CREA` date DEFAULT NULL COMMENT 'Fecha de creacion del registro',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'Usuario crea el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'Fecha de modificacion del registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'Usuario modifica  el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena las categorias de los articulos';

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `NOMBRE`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
(1, 'LECHE', 'A', '2019-06-25', ' admin', NULL, NULL),
(2, 'QUESO', 'A', '2019-06-25', ' admin', NULL, NULL),
(3, 'YOGURT', 'A', '2019-06-25', ' admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `ID_CIUDAD` int(11) NOT NULL COMMENT 'codigo de la ciudad',
  `ID_PAIS` int(11) NOT NULL COMMENT 'Codigo del pais',
  `NOMBRE_CIUDAD` varchar(100) NOT NULL COMMENT 'Nombre de la Ciudad',
  `ESTADO` char(1) DEFAULT 'A' COMMENT 'Estado de la ciudad\r\n            A=activo\r\n            I=Inactivo',
  `FECHA_NEW` date DEFAULT NULL COMMENT 'Fecha creacion del registro',
  `USUARIO_NEW` varchar(50) DEFAULT NULL COMMENT 'Usuario crea  el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'Fecha modificacion del registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'Usuario modifica el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se alamacena la ciudades donde opera la empresa';

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_CIUDAD`, `ID_PAIS`, `NOMBRE_CIUDAD`, `ESTADO`, `FECHA_NEW`, `USUARIO_NEW`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
(1, 593, 'QUITO', 'A', NULL, NULL, NULL, NULL),
(2, 593, 'LOJA', 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CEDULA` varchar(13) NOT NULL COMMENT 'Identificacion del cliente',
  `ID_PERFIL` varchar(5) DEFAULT NULL COMMENT 'Codigo del perfil\r\n            Adm=Administrador\r\n            Ven=Vendedor\r\n            Rep=Repartido\r\n            Clie=Cliente',
  `NOMBRE` varchar(500) NOT NULL COMMENT 'nombre del cliente',
  `APELLIDO` varchar(500) NOT NULL COMMENT 'apellido del cliente',
  `CALLE_PRINCIPAL` varchar(500) NOT NULL COMMENT 'calle principal del cliente',
  `NUMERO_DE_CASA` varchar(50) NOT NULL COMMENT 'numero de casa del cliente',
  `CALLE_SECUNDARIA` varchar(500) NOT NULL COMMENT 'calle secundaria cliente',
  `EMAIL` varchar(50) NOT NULL COMMENT 'email del cliente',
  `TELEFONO` varchar(10) DEFAULT NULL COMMENT 'telefono del cliente',
  `ESTADO` char(1) DEFAULT 'A' COMMENT 'Estado del cliente\r\n            A=activo\r\n            I=inactivo',
  `FECHA_CREA` date DEFAULT NULL COMMENT 'fecha de creacion del cliente',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'usuario  crea del cliente',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'fecha de modificacion del cliente',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'usuario  modifica del cliente',
  `clave` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los clientes';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`CEDULA`, `ID_PERFIL`, `NOMBRE`, `APELLIDO`, `CALLE_PRINCIPAL`, `NUMERO_DE_CASA`, `CALLE_SECUNDARIA`, `EMAIL`, `TELEFONO`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`, `clave`) VALUES
('1715339519', 'CLI', 'Diego', 'Torres', 'Calle B', 'N2526', 'Eucalipto', 'diegotorres_8@hotmail.com', '022950525', 'A', '2019-07-28', 'admin', '2019-07-28', 'admin', '8cb2237d0679ca88db6464eac60da96345513964'),
('1715777500', 'CLI', 'Patricia', 'Vasquez', 'Rios', 'N589', 'Olmedoasq', 'pvasquez@hotmail.com', '022765665', 'A', '2019-07-28', 'admin', NULL, NULL, '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_ventas`
--

CREATE TABLE IF NOT EXISTS `despacho_ventas` (
  `ID_DESPACHO` int(11) NOT NULL,
  `ID_VENTA` varchar(50) NOT NULL DEFAULT '' COMMENT 'codigo de la venta',
  `ID_CIUDAD` int(11) DEFAULT NULL COMMENT 'codigo de la ciudad',
  `ID_SECTOR` char(2) DEFAULT NULL COMMENT 'codigo del sector\r\n            NO=Norte\r\n            CE=Centro\r\n            SU=Sur\r\n            Va=Valles\r\n            ',
  `ESTADO` char(1) DEFAULT 'A' COMMENT 'Estado del despacho\r\n            A=Asignado\r\n            P=Proceso\r\n            E=Entregado\r\n            C=Cancelado\r\n            D=Devuelto',
  `FECHA_ASIGNADO` datetime DEFAULT NULL,
  `FECHA_ENTREGADO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena el despacho de ventas';

--
-- Volcado de datos para la tabla `despacho_ventas`
--

INSERT INTO `despacho_ventas` (`ID_DESPACHO`, `ID_VENTA`, `ID_CIUDAD`, `ID_SECTOR`, `ESTADO`, `FECHA_ASIGNADO`, `FECHA_ENTREGADO`) VALUES
(1, '1', 1, 'VA', 'A', '2019-07-28 15:43:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `ID_DETVEN` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) DEFAULT NULL COMMENT 'codigo del articulo',
  `ID_CATEGORIA` int(11) DEFAULT NULL COMMENT 'codigo de la categoria',
  `ID_VENTA` varchar(50) NOT NULL DEFAULT '' COMMENT 'codigo de la venta',
  `ID_SECTOR` char(2) DEFAULT NULL COMMENT 'codigo del sector\r\n            NO=Norte\r\n            CE=Centro\r\n            SU=Sur\r\n            Va=Valles\r\n            ',
  `ID_CIUDAD` int(11) DEFAULT NULL COMMENT 'codigo de la ciudad',
  `PRECIO` decimal(14,2) NOT NULL COMMENT 'Precio del producto',
  `DESCUENTO` decimal(14,2) NOT NULL COMMENT 'Descuento del Producto',
  `IVA` decimal(14,2) NOT NULL COMMENT 'valor del iva del producto',
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena el detalle de las ventas';

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`ID_DETVEN`, `ID_PRODUCTO`, `ID_CATEGORIA`, `ID_VENTA`, `ID_SECTOR`, `ID_CIUDAD`, `PRECIO`, `DESCUENTO`, `IVA`, `cantidad`) VALUES
(1, 1, 1, '1', 'VA', 1, '1.00', '0.00', '0.00', 1),
(2, 1, 2, '1', 'VA', 1, '0.50', '0.00', '0.00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `ID_IMAGEN` int(11) NOT NULL COMMENT 'Codigo de la imagen',
  `ID_PRODUCTO` int(11) DEFAULT NULL COMMENT 'codigo del articulo',
  `ID_CATEGORIA` int(11) DEFAULT NULL COMMENT 'codigo de la categoria',
  `NOMBRE` varchar(500) NOT NULL,
  `RUTA` varchar(500) NOT NULL,
  `ESTADO` char(1) NOT NULL,
  `FECHA_CREA` date DEFAULT NULL COMMENT 'fecha crea el registro',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'usuario crea el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'fecha modifica el registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'usuario modifica el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena las imagenes de los articulos';

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`ID_IMAGEN`, `ID_PRODUCTO`, `ID_CATEGORIA`, `NOMBRE`, `RUTA`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
(1, 1, 1, 'lecDesCart.jpg', '../../archivos/lecDesCart.jpg', '', '2019-06-26', '1', NULL, NULL),
(2, 1, 2, 'queNor.jpg', '../../archivos/queNor.jpg', '', '2019-06-26', '1', NULL, NULL),
(3, 1, 3, 'yogGuaFun.jpg', '../../archivos/yogGuaFun.jpg', '', '2019-06-26', '1', NULL, NULL),
(4, 2, 1, 'lecEntFun.jpg', '../../archivos/lecEntFun.jpg', '', '2019-07-18', '1', NULL, NULL),
(5, 2, 2, 'queNor.jpg', '../../archivos/queNor.jpg', '', '2019-07-18', '1', NULL, NULL),
(6, 3, 1, 'lecEntFun.jpg', '../../archivos/lecEntFun.jpg', '', '2019-07-18', '1', NULL, NULL),
(7, 2, 3, 'yogGuaFun.jpg', '../../archivos/yogGuaFun.jpg', '', '2019-07-21', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `ID_PAIS` int(11) NOT NULL COMMENT 'Codigo del pais',
  `NOMBRE_PAIS` varchar(100) NOT NULL COMMENT 'Nombre del pais',
  `ESTADO` char(1) DEFAULT 'A' COMMENT 'Estado del pais\r\n            A=Activo\r\n            I=Inactivo',
  `FECHA_CREA` date DEFAULT NULL COMMENT 'Fecha creacion del registro',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'Usuario crea  el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'Fecha modificacion del registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'Usuario modifica el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los paises donde puede operar la emp';

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`ID_PAIS`, `NOMBRE_PAIS`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
(593, 'ECUADOR', 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `ID_PERFIL` varchar(5) NOT NULL COMMENT 'Codigo del perfil\r\n            Adm=Administrador\r\n            Ven=Vendedor\r\n            Rep=Repartido\r\n            Clie=Cliente',
  `DESCRIPCION` varchar(100) NOT NULL COMMENT 'Descripcion del Perfil',
  `ESTADO` char(1) NOT NULL DEFAULT 'A',
  `FECHA_CREA` date DEFAULT NULL COMMENT 'Fecha creacion del registro',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'Usuario crea  el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'Fecha modificacion del registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'Usuario modifica el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los perfiles de los usuarios';

--
-- Volcado de datos para la tabla `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`ID_PERFIL`, `DESCRIPCION`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
('ADM', 'ADMINISTRADOR', 'A', '0000-00-00', NULL, NULL, NULL),
('BOD', 'BODEGUERO', 'A', NULL, NULL, NULL, NULL),
('CLI', 'CLIENTE', 'A', NULL, NULL, NULL, NULL),
('REP', 'REPARTIDO', 'A', NULL, NULL, NULL, NULL),
('VEN', 'VENDEDOR', 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidores`
--

CREATE TABLE IF NOT EXISTS `repartidores` (
  `ID_USUARIO` int(11) NOT NULL COMMENT 'codigo del usuario',
  `ID_SECTOR` char(2) NOT NULL COMMENT 'codigo del sector\r\n            NO=Norte\r\n            CE=Centro\r\n            SU=Sur\r\n            Va=Valles\r\n            ',
  `ID_CIUDAD` int(11) NOT NULL COMMENT 'codigo de la ciudad',
  `ESTADO` char(1) DEFAULT 'A',
  `FECHA_CREA` date DEFAULT NULL,
  `USUARIO_CREA` varchar(50) DEFAULT NULL,
  `FECHA_MOD` date DEFAULT NULL,
  `USUARIO_MOD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los despachadores de mercaderia';

--
-- Volcado de datos para la tabla `repartidores`
--

INSERT INTO `repartidores` (`ID_USUARIO`, `ID_SECTOR`, `ID_CIUDAD`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
(2, 'CE', 1, 'A', '2019-06-25', 'admin', '2019-07-28', 'admin'),
(4, 'VA', 1, 'A', '2019-07-28', 'admin', NULL, NULL),
(6, 'NO', 2, 'A', '2019-07-20', 'admin', '2019-07-21', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `ID_SECTOR` char(2) NOT NULL COMMENT 'codigo del sector\r\n            NO=Norte\r\n            CE=Centro\r\n            SU=Sur\r\n            Va=Valles\r\n            ',
  `ID_CIUDAD` int(11) NOT NULL COMMENT 'codigo de la ciudad',
  `NOMBRE_SECTOR` varchar(100) NOT NULL COMMENT 'Nombre del sector',
  `ESTADO` char(1) DEFAULT 'A' COMMENT 'Estado del sector\n\n            A=activo\r\n            I=Inactivo',
  `FECHA_CREA` date DEFAULT NULL COMMENT 'Fecha creacion del registro',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'Usuario crea  el registro',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'Fecha modificacion del registro',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'Usuario modifica el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacenan los sectores de una ciudad';

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`ID_SECTOR`, `ID_CIUDAD`, `NOMBRE_SECTOR`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
('CE', 1, 'CENTRO', 'A', NULL, NULL, NULL, NULL),
('CE', 2, 'CENTRO', 'A', NULL, NULL, NULL, NULL),
('NO', 1, 'NORTE', 'A', NULL, NULL, NULL, NULL),
('NO', 2, 'NORTE', 'A', NULL, NULL, NULL, NULL),
('SU', 1, 'SUR', 'A', NULL, NULL, NULL, NULL),
('VA', 1, 'VALLE', 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int(11) NOT NULL COMMENT 'codigo del usuario',
  `ID_PERFIL` varchar(5) DEFAULT NULL COMMENT 'Codigo del perfil\r\n            Adm=Administrador\r\n            Ven=Vendedor\r\n            Rep=Repartido\r\n            Clie=Cliente',
  `USUARIO` varchar(50) NOT NULL COMMENT 'identificacion del  usuario',
  `CLAVE` varchar(50) NOT NULL COMMENT 'clave del usuario',
  `NOMBRE` varchar(500) NOT NULL COMMENT 'nombre del usuario',
  `APELLIDO` varchar(500) NOT NULL COMMENT 'apellido del usuario',
  `FECHA_CREA` date DEFAULT NULL COMMENT 'fecha de creacion del usuario',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'usuario crea el usuario',
  `FECHA_MOD` date DEFAULT NULL COMMENT 'fecha de modificacion del usuario',
  `USUARIO_MOD` varchar(50) DEFAULT NULL COMMENT 'usuario modifica el usuario',
  `ESTADO` char(1) DEFAULT 'A' COMMENT 'Estado del usuario\r\n            A=activo\r\n            I=Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena los usuarios del sistema';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `ID_PERFIL`, `USUARIO`, `CLAVE`, `NOMBRE`, `APELLIDO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`, `ESTADO`) VALUES
(2, 'REP', 'fernando.granja', '8cb2237d0679ca88db6464eac60da96345513964', 'Fernando', 'Granja', '2019-06-22', 'fernado.granja', NULL, NULL, 'A'),
(3, 'BOD', 'patricio.vasquez', '38a78a91aee50eb5c9d3000ea0656bf6fc7a708a', 'Patricio', 'Vasquez', '2019-07-16', 'patricio.vasquez', NULL, NULL, 'A'),
(4, 'REP', 'juan.leon', '8cb2237d0679ca88db6464eac60da96345513964', 'Juann', 'Leon', '2019-07-16', 'juan.leon', NULL, NULL, 'A'),
(5, 'VEN', 'paul.torres', '8cb2237d0679ca88db6464eac60da96345513964', 'paul', 'torres', '2019-07-20', 'paul.torres', NULL, NULL, 'A'),
(6, 'REP', 'javier.leon', '8cb2237d0679ca88db6464eac60da96345513964', 'javier', 'leon', '2019-07-20', 'javier.leon', NULL, NULL, 'A'),
(7, 'ADM', 'Admin', '8cb2237d0679ca88db6464eac60da96345513964', 'Diego', 'Torres', '2019-07-21', 'Admin', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `ID_VENTA` varchar(50) NOT NULL COMMENT 'codigo de la venta',
  `CEDULA` varchar(13) NOT NULL COMMENT 'Identificacion del cliente',
  `ID_SECTOR` char(2) NOT NULL COMMENT 'codigo del sector\r\n            NO=Norte\r\n            CE=Centro\r\n            SU=Sur\r\n            Va=Valles\r\n            ',
  `ID_CIUDAD` int(11) NOT NULL COMMENT 'codigo de la ciudad',
  `PRECIO` decimal(14,2) NOT NULL COMMENT 'precio total de la venta',
  `IVA` decimal(14,2) NOT NULL COMMENT 'valor total del iva de la venta',
  `DESCUENTO` decimal(14,2) NOT NULL COMMENT 'descuento total de la venta',
  `TIPO` char(3) NOT NULL DEFAULT 'FAC' COMMENT 'Tipo de movimiento\r\n            Fac=Factura\r\n            Dev=Nota de Credito',
  `LATITUD` varchar(200) NOT NULL,
  `LONGITUD` varchar(200) NOT NULL,
  `CALLE_PRINCIPAL` varchar(50) DEFAULT NULL COMMENT 'calle principal de entrega',
  `NUMERO_CASA` varchar(50) DEFAULT NULL COMMENT 'numero de casa de entrega',
  `CALLE_SECUNDARIA` varchar(50) DEFAULT NULL COMMENT 'calle secundaria de entrega',
  `ORIGEN` char(1) DEFAULT 'V' COMMENT 'Donde se origina la venta\n\n            L=Linea\r\n            V=Vendedor',
  `ESTADO` char(1) NOT NULL DEFAULT 'S' COMMENT 'Estado del movimiento\r\n            S=Solicitada\r\n            F=Facturada\r\n            P=Por Entregar\r\n            E=Entregada\r\n            C=Cancelada\r\n            D=Devuelta\r\n            ',
  `FECHA_CREA` datetime DEFAULT NULL COMMENT 'Fecha de creacion de la venta',
  `USUARIO_CREA` varchar(50) DEFAULT NULL COMMENT 'Usuario crea la venta',
  `FECHA_MOD` datetime DEFAULT NULL COMMENT 'Fecha de modificacion de la venta',
  `USUARIO_MOD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla donde se almacena la venta';

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`ID_VENTA`, `CEDULA`, `ID_SECTOR`, `ID_CIUDAD`, `PRECIO`, `IVA`, `DESCUENTO`, `TIPO`, `LATITUD`, `LONGITUD`, `CALLE_PRINCIPAL`, `NUMERO_CASA`, `CALLE_SECUNDARIA`, `ORIGEN`, `ESTADO`, `FECHA_CREA`, `USUARIO_CREA`, `FECHA_MOD`, `USUARIO_MOD`) VALUES
('1', '1715339519', 'VA', 1, '3.50', '0.00', '0.00', 'FAC', '-0.25486348064724496', '-79.16807707993166', 'CALLE B ', 'N2560', 'Eucalipto', 'V', 'S', '2019-07-28 15:43:48', 'admin', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`ID_PRODUCTO`,`ID_CATEGORIA`),
  ADD KEY `FK_ARTI_CATG` (`ID_CATEGORIA`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ID_CIUDAD`),
  ADD UNIQUE KEY `IND_CIUD` (`ID_CIUDAD`,`ID_PAIS`),
  ADD KEY `FK_REFERENCE_9` (`ID_PAIS`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CEDULA`),
  ADD KEY `FK_CLI_PERF` (`ID_PERFIL`);

--
-- Indices de la tabla `despacho_ventas`
--
ALTER TABLE `despacho_ventas`
  ADD PRIMARY KEY (`ID_DESPACHO`,`ID_VENTA`),
  ADD UNIQUE KEY `IND_DESP_VEN` (`ID_DESPACHO`,`ID_VENTA`) USING BTREE,
  ADD KEY `FK_REFERENCE_12` (`ID_VENTA`,`ID_SECTOR`,`ID_CIUDAD`),
  ADD KEY `ID_DESPACHO` (`ID_DESPACHO`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`ID_DETVEN`,`ID_VENTA`),
  ADD KEY `FK_REFERENCE_7` (`ID_PRODUCTO`,`ID_CATEGORIA`),
  ADD KEY `FK_REFERENCE_8` (`ID_VENTA`,`ID_SECTOR`,`ID_CIUDAD`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`ID_IMAGEN`),
  ADD KEY `FK_IMA_ART` (`ID_PRODUCTO`,`ID_CATEGORIA`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`ID_PAIS`),
  ADD UNIQUE KEY `IND_PAIS` (`ID_PAIS`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`ID_PERFIL`);

--
-- Indices de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD PRIMARY KEY (`ID_USUARIO`,`ID_SECTOR`,`ID_CIUDAD`),
  ADD UNIQUE KEY `IND_DESP` (`ID_USUARIO`,`ID_SECTOR`,`ID_CIUDAD`),
  ADD KEY `FK_REFERENCE_14` (`ID_SECTOR`,`ID_CIUDAD`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`ID_SECTOR`,`ID_CIUDAD`),
  ADD UNIQUE KEY `IND_SECT` (`ID_SECTOR`,`ID_CIUDAD`) USING BTREE,
  ADD KEY `FK_REFERENCE_10` (`ID_CIUDAD`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `FK_USU_PERF` (`ID_PERFIL`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ID_VENTA`,`ID_SECTOR`,`ID_CIUDAD`),
  ADD KEY `FK_REFERENCE_11` (`ID_SECTOR`,`ID_CIUDAD`),
  ADD KEY `FK_VEN_CLI` (`CEDULA`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `FK_ARTI_CATG` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `FK_REFERENCE_9` FOREIGN KEY (`ID_PAIS`) REFERENCES `pais` (`ID_PAIS`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_CLI_PERF` FOREIGN KEY (`ID_PERFIL`) REFERENCES `perfil_usuario` (`ID_PERFIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`ID_PRODUCTO`, `ID_CATEGORIA`) REFERENCES `articulos` (`ID_PRODUCTO`, `ID_CATEGORIA`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_IMA_ART` FOREIGN KEY (`ID_PRODUCTO`, `ID_CATEGORIA`) REFERENCES `articulos` (`ID_PRODUCTO`, `ID_CATEGORIA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD CONSTRAINT `FK_REFERENCE_13` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `FK_REFERENCE_14` FOREIGN KEY (`ID_SECTOR`, `ID_CIUDAD`) REFERENCES `sector` (`ID_SECTOR`, `ID_CIUDAD`);

--
-- Filtros para la tabla `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `FK_REFERENCE_10` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `ciudad` (`ID_CIUDAD`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USU_PERF` FOREIGN KEY (`ID_PERFIL`) REFERENCES `perfil_usuario` (`ID_PERFIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `FK_REFERENCE_11` FOREIGN KEY (`ID_SECTOR`, `ID_CIUDAD`) REFERENCES `sector` (`ID_SECTOR`, `ID_CIUDAD`),
  ADD CONSTRAINT `FK_VEN_CLI` FOREIGN KEY (`CEDULA`) REFERENCES `cliente` (`CEDULA`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

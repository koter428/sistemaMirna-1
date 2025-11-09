-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2024 a las 18:01:36
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_mirna`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajuste_stock`
--

CREATE TABLE `ajuste_stock` (
  `cod_ajuste_stock` int(11) NOT NULL,
  `tipo_ajuste` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha_ajuste` date NOT NULL,
  `cod_compra` int(11) NOT NULL,
  `cod_stock` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ajuste_stock`
--

INSERT INTO `ajuste_stock` (`cod_ajuste_stock`, `tipo_ajuste`, `fecha_ajuste`, `cod_compra`, `cod_stock`, `cod_usuario`, `id_sucursal`, `estado`) VALUES
(1, 'ENTRADA', '2024-12-15', 0, 0, 1, 1, 'ANULADO'),
(2, 'SALIDA', '2024-12-15', 0, 0, 1, 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apertura_cierre_caja`
--

CREATE TABLE `apertura_cierre_caja` (
  `cod_apertura_cierre` int(11) NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `ingreso_efectivo` int(11) NOT NULL,
  `ingreso_cheque` int(11) NOT NULL,
  `ingreso_tarjeta` int(11) NOT NULL,
  `monto_apertura` int(11) NOT NULL,
  `monto_cierre` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cod_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(50) NOT NULL,
  `descripcion_cat` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cod_categoria`, `nombre_cat`, `descripcion_cat`, `estado`) VALUES
(1, 'CATEGORIA 1', 'DES', 'ACTIVO'),
(2, 'CATEGORIA 2', 'DES', 'ACTIVO'),
(3, 'CATEGORIA 3', 'DES', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `cod_ciudad` int(11) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`cod_ciudad`, `descripcion`, `estado`) VALUES
(1, 'ITAUGUA', 'ACTIVO'),
(2, 'CAPIATA', 'ACTIVO'),
(3, 'ITA', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `apellido_cliente` varchar(50) NOT NULL,
  `cedula_cliente` int(11) NOT NULL,
  `telefono_cliente` varchar(10) NOT NULL,
  `cod_ciudad` int(11) NOT NULL,
  `direccion_cliente` varchar(100) NOT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nombre_cliente`, `apellido_cliente`, `cedula_cliente`, `telefono_cliente`, `cod_ciudad`, `direccion_cliente`, `estado`) VALUES
(3, 'Luis', 'Guzman', 1231244, '0971120', 2, 'ITAUGUA', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `cod_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `condicion` varchar(10) NOT NULL,
  `cod_tipo_pago` int(11) NOT NULL,
  `timbrado` int(11) NOT NULL,
  `fecha_venc_timbrado` date NOT NULL,
  `nro_factura` varchar(30) NOT NULL,
  `cod_orden_compra` int(11) NOT NULL,
  `cod_deposito` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL,
  `cod_proveedor` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`cod_compra`, `fecha_compra`, `condicion`, `cod_tipo_pago`, `timbrado`, `fecha_venc_timbrado`, `nro_factura`, `cod_orden_compra`, `cod_deposito`, `cod_usuario`, `cod_sucursal`, `cod_proveedor`, `estado`) VALUES
(1, '2024-12-15', 'CONTADO', 1, 12312, '2024-12-15', '1', 2, 1, 1, 1, 2, 'ANULADO'),
(2, '2024-12-15', 'CREDITO', 1, 12312, '2024-12-15', '1', 2, 1, 1, 1, 2, 'ACTIVO'),
(3, '2024-12-15', 'CREDITO', 1, 12312, '2024-12-15', '1', 2, 1, 1, 1, 2, 'ACTIVO'),
(4, '2024-12-15', 'CONTADO', 1, 444444, '2024-12-15', '1', 2, 1, 1, 1, 2, 'ACTIVO'),
(5, '2024-12-15', 'CONTADO', 1, 12312, '2024-12-15', '1', 2, 1, 1, 1, 2, 'ACTIVO'),
(6, '2024-12-15', 'CONTADO', 1, 12312, '2024-12-15', '1', 2, 1, 1, 1, 2, 'ACTIVO'),
(7, '2024-12-16', 'CONTADO', 1, 12312, '2024-12-16', '001-001-0002123', 2, 1, 1, 1, 2, 'ACTIVO');

--
-- Disparadores `compras`
--
DELIMITER $$
CREATE TRIGGER `anular_compra` AFTER UPDATE ON `compras` FOR EACH ROW IF NEW.estado = 'ANULADO' THEN
UPDATE stock 
join detalle_compras c on c.cod_compra = NEW.cod_compra
SET stock.cantidad = stock.cantidad - c.cantidad
WHERE stock.cod_deposito = NEW.cod_deposito and stock.cod_producto = c.cod_producto;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_pagar`
--

CREATE TABLE `cuenta_pagar` (
  `cod_cuenta_pagar` int(11) NOT NULL,
  `cod_compra` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `saldo` int(11) NOT NULL,
  `monto_pagar` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta_pagar`
--

INSERT INTO `cuenta_pagar` (`cod_cuenta_pagar`, `cod_compra`, `fecha_vencimiento`, `saldo`, `monto_pagar`, `estado`) VALUES
(1, 3, '2025-01-15', 264000, 264000, 'NO PAGADO'),
(2, 3, '2025-02-15', 264000, 264000, 'NO PAGADO'),
(3, 3, '2025-03-15', 264000, 264000, 'NO PAGADO'),
(4, 3, '2025-04-15', 264000, 264000, 'NO PAGADO'),
(5, 3, '2025-05-15', 264000, 264000, 'NO PAGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_recibir_cabecera`
--

CREATE TABLE `cuenta_recibir_cabecera` (
  `cod_cuenta_recibir` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deposito`
--

CREATE TABLE `deposito` (
  `cod_deposito` int(11) NOT NULL,
  `nombre_dep` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `deposito`
--

INSERT INTO `deposito` (`cod_deposito`, `nombre_dep`, `estado`, `cod_sucursal`) VALUES
(1, 'DEPOSITO 1', 'ACTIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ajuste_stock`
--

CREATE TABLE `detalle_ajuste_stock` (
  `cod_ajuste_stock` int(11) NOT NULL,
  `cantidad_nueva` int(11) NOT NULL,
  `id_deposito` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_ajuste_stock`
--

INSERT INTO `detalle_ajuste_stock` (`cod_ajuste_stock`, `cantidad_nueva`, `id_deposito`, `cod_producto`) VALUES
(1, 12, 1, 1),
(2, 1, 1, 1),
(2, 1, 1, 2),
(2, 13, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `cod_compra` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `iva5` decimal(10,0) NOT NULL,
  `iva10` decimal(10,0) NOT NULL,
  `exenta` decimal(10,0) NOT NULL,
  `costo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`cod_compra`, `cod_producto`, `cantidad`, `iva5`, `iva10`, `exenta`, `costo`) VALUES
(1, 2, 11, '0', '1320000', '0', 120000),
(2, 2, 11, '0', '1320000', '0', 120000),
(3, 2, 11, '0', '1320000', '0', 120000),
(4, 2, 11, '0', '1320000', '0', 120000),
(5, 2, 11, '0', '1320000', '0', 120000),
(6, 2, 11, '0', '1320000', '0', 120000),
(7, 2, 11, '0', '1320000', '0', 120000);

--
-- Disparadores `detalle_compras`
--
DELIMITER $$
CREATE TRIGGER `insert_compra` AFTER INSERT ON `detalle_compras` FOR EACH ROW UPDATE stock 
join compras c on c.cod_compra = NEW.cod_compra
SET stock.cantidad = stock.cantidad + NEW.cantidad
WHERE stock.cod_deposito = c.cod_deposito and stock.cod_producto = NEW.cod_producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuenta_recibir`
--

CREATE TABLE `detalle_cuenta_recibir` (
  `cod_cuenta_recibir` int(11) NOT NULL,
  `cod_apertura_cierre` int(11) NOT NULL,
  `cod_forma_cobro` int(11) NOT NULL,
  `nro_cuota` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `monto_pagar` int(11) NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `nro_recibo` int(11) NOT NULL,
  `cod_impuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_itinerario`
--

CREATE TABLE `detalle_itinerario` (
  `cod_itinerario` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `hora_estimada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota_compra`
--

CREATE TABLE `detalle_nota_compra` (
  `cod_nota_compra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `iva5` int(11) NOT NULL,
  `iva10` int(11) NOT NULL,
  `exenta` int(11) NOT NULL,
  `costo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_nota_compra`
--

INSERT INTO `detalle_nota_compra` (`cod_nota_compra`, `cantidad`, `cod_producto`, `iva5`, `iva10`, `exenta`, `costo`) VALUES
(1, 4, 2, 0, 480000, 0, 120000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota_vent`
--

CREATE TABLE `detalle_nota_vent` (
  `cod_nota_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cod_deposito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `cod_orden_compra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_orden`
--

INSERT INTO `detalle_orden` (`cod_orden_compra`, `cantidad`, `costo`, `cod_producto`) VALUES
(1, 11, 120000, 2),
(2, 11, 120000, 2),
(3, 1, 44000, 1),
(4, 8, 44000, 1),
(4, 1, 100000, 2),
(5, 1, 44000, 1),
(5, 1, 120000, 2),
(5, 1, 12000, 3),
(6, 1, 44000, 1),
(6, 1, 120000, 2),
(6, 1, 12000, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_serv`
--

CREATE TABLE `detalle_orden_serv` (
  `id_orden_serv` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido_cliente`
--

CREATE TABLE `detalle_pedido_cliente` (
  `cod_pedido_venta` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `cod_impuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido_compra`
--

CREATE TABLE `detalle_pedido_compra` (
  `cod_pedido_compra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_pedido_compra`
--

INSERT INTO `detalle_pedido_compra` (`cod_pedido_compra`, `cantidad`, `cod_producto`) VALUES
(1, 1, 1),
(1, 3, 2),
(2, 8, 1),
(2, 6, 2),
(2, 16, 3),
(3, 12, 2),
(3, 22, 3),
(4, 1, 1),
(4, 1, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_presupuesto_com`
--

CREATE TABLE `detalle_presupuesto_com` (
  `cod_presupuesto_compra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_presupuesto_com`
--

INSERT INTO `detalle_presupuesto_com` (`cod_presupuesto_compra`, `cantidad`, `costo`, `cod_producto`) VALUES
(1, 11, 120000, 2),
(2, 8, 44000, 1),
(3, 1, 44000, 1),
(3, 1, 120000, 2),
(3, 1, 12000, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prod_entregar`
--

CREATE TABLE `detalle_prod_entregar` (
  `id_prod_entregar` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_remision`
--

CREATE TABLE `detalle_remision` (
  `cod_remision` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cantidad_factura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_remision`
--

INSERT INTO `detalle_remision` (`cod_remision`, `cantidad`, `cod_producto`, `cantidad_factura`) VALUES
(2, 11, 2, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_remision_vent`
--

CREATE TABLE `detalle_remision_vent` (
  `cod_remision_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `cod_venta` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_deposito` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_cobros`
--

CREATE TABLE `forma_cobros` (
  `cod_forma_cobro` int(11) NOT NULL,
  `descripcion` varchar(40) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `ci` int(11) NOT NULL,
  `ruc` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `cod_vehi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `cod_impuesto` int(11) NOT NULL,
  `iva5` int(11) NOT NULL,
  `iva10` int(11) NOT NULL,
  `exenta` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerarios`
--

CREATE TABLE `itinerarios` (
  `cod_itinerario` int(11) NOT NULL,
  `fecha_itinerario` date NOT NULL,
  `hora_inicio` datetime NOT NULL,
  `hora_fin` datetime NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `id_perso_entreg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_compra`
--

CREATE TABLE `libro_compra` (
  `id_libro_compra` int(11) NOT NULL,
  `iva5` int(11) NOT NULL,
  `iva10` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cod_compra` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `grav5` int(11) DEFAULT NULL,
  `grav10` int(11) DEFAULT NULL,
  `exenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libro_compra`
--

INSERT INTO `libro_compra` (`id_libro_compra`, `iva5`, `iva10`, `fecha`, `cod_compra`, `total`, `grav5`, `grav10`, `exenta`) VALUES
(1, 0, 62857, '2024-12-15', 6, 62857, 0, 1200000, 0),
(2, 0, 62857, '2024-12-16', 7, 62857, 0, 1200000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_ventas`
--

CREATE TABLE `libro_ventas` (
  `id_libro_venta` int(11) NOT NULL,
  `iva5` int(11) NOT NULL,
  `iva10` int(11) NOT NULL,
  `total_iva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cod_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `cod_marca` int(11) NOT NULL,
  `descripcion_marc` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`cod_marca`, `descripcion_marc`, `estado`) VALUES
(1, 'MARCA 1', 'ACTIVO'),
(2, 'MARCA 2', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_compras`
--

CREATE TABLE `nota_compras` (
  `cod_nota_compra` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nro_nota` varchar(40) NOT NULL,
  `timbrado` int(11) NOT NULL,
  `fecha_venc_timbrado` date NOT NULL,
  `tipo_nota` varchar(20) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_compra` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nota_compras`
--

INSERT INTO `nota_compras` (`cod_nota_compra`, `fecha`, `nro_nota`, `timbrado`, `fecha_venc_timbrado`, `tipo_nota`, `estado`, `cod_compra`, `cod_usuario`, `cod_sucursal`, `motivo`) VALUES
(1, '2024-12-15', '001-001-0002123', 12312, '2024-12-15', 'CREDITO', 'ANULADO', 1, 1, 1, 'aaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_remision`
--

CREATE TABLE `nota_remision` (
  `cod_remision` int(11) NOT NULL,
  `nro_nota` varchar(30) NOT NULL,
  `timbrado` int(11) NOT NULL,
  `fecha_venc` date NOT NULL,
  `cod_vehi` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `punto_salida` varchar(100) NOT NULL,
  `punto_llegada` varchar(100) NOT NULL,
  `fecha_remision` date NOT NULL,
  `chofer` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_compra` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nota_remision`
--

INSERT INTO `nota_remision` (`cod_remision`, `nro_nota`, `timbrado`, `fecha_venc`, `cod_vehi`, `motivo`, `punto_salida`, `punto_llegada`, `fecha_remision`, `chofer`, `estado`, `cod_compra`, `cod_usuario`, `cod_sucursal`) VALUES
(1, '001-002-124423', 12312, '2024-12-15', 1, 'MOTIVO ', 'ITAUGUA', 'CAPIATA', '2024-12-15', 'jose', 'ACTIVO', 1, 1, 1),
(2, '001-002-124423', 12312, '2024-12-15', 1, 'MOTIVO ', 'ITAUGUA', 'CAPIATA', '2024-12-15', 'jose', 'ANULADO', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_remsion_venta`
--

CREATE TABLE `nota_remsion_venta` (
  `cod_remision_venta` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `punto_salida` varchar(40) NOT NULL,
  `punto_llegada` varchar(60) NOT NULL,
  `total_remision_ven` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_ventas`
--

CREATE TABLE `nota_ventas` (
  `cod_nota_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `timbrado` int(11) NOT NULL,
  `fecha_venc_timbrado` date NOT NULL,
  `nro_nota` int(11) NOT NULL,
  `tipo_nota` varchar(15) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_venta` int(11) NOT NULL,
  `cod_forma_cobro` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `cod_orden_compra` int(11) NOT NULL,
  `fecha_orden` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_presupuesto_compra` int(11) NOT NULL,
  `cod_proveedor` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`cod_orden_compra`, `fecha_orden`, `estado`, `cod_presupuesto_compra`, `cod_proveedor`, `cod_usuario`, `cod_sucursal`) VALUES
(1, '2024-12-04', 'ANULADO', 1, 2, 1, 1),
(2, '2024-12-15', 'PENDIENTE', 1, 2, 1, 1),
(3, '2024-12-16', 'PENDIENTE', 3, 2, 1, 1),
(4, '2024-12-16', 'PENDIENTE', 2, 2, 1, 1),
(5, '2024-12-16', 'PENDIENTE', 3, 2, 1, 1),
(6, '2024-12-16', 'APROBADO', 3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicio`
--

CREATE TABLE `orden_servicio` (
  `id_orden_serv` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_clientes`
--

CREATE TABLE `pedido_clientes` (
  `cod_pedido_venta` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `total_pedido` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_compra`
--

CREATE TABLE `pedido_compra` (
  `cod_pedido_compra` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido_compra`
--

INSERT INTO `pedido_compra` (`cod_pedido_compra`, `fecha_pedido`, `estado`, `cod_usuario`, `cod_sucursal`) VALUES
(1, '2024-12-04', 'PRESUPUESTADO', 1, 1),
(2, '2024-12-04', 'PRESUPUESTADO', 1, 1),
(3, '2024-12-04', 'ANULADO', 1, 1),
(4, '2024-12-16', 'PRESUPUESTADO', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_entregas`
--

CREATE TABLE `personal_entregas` (
  `id_perso_entreg` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nro_ci` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `salario` int(11) NOT NULL,
  `ruta_entrega` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_compra`
--

CREATE TABLE `presupuesto_compra` (
  `cod_presupuesto_compra` int(11) NOT NULL,
  `fecha_presu` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_pedido_compra` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL,
  `cod_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presupuesto_compra`
--

INSERT INTO `presupuesto_compra` (`cod_presupuesto_compra`, `fecha_presu`, `fecha_vencimiento`, `estado`, `cod_pedido_compra`, `cod_usuario`, `cod_sucursal`, `cod_proveedor`) VALUES
(1, 2024, '2024-12-04', 'ORDEN COMP', 1, 1, 1, 2),
(2, 2024, '2024-12-16', 'ORDEN COMP', 2, 1, 1, 2),
(3, 2024, '2024-12-16', 'ORDEN COMP', 4, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `cod_producto` int(11) NOT NULL,
  `nombre_prod` varchar(40) NOT NULL,
  `descripcion_prod` varchar(100) NOT NULL,
  `precio_prod` int(11) NOT NULL,
  `costo_prod` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_categoria` int(11) NOT NULL,
  `cod_tipo_prod` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `impuesto` int(11) DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`cod_producto`, `nombre_prod`, `descripcion_prod`, `precio_prod`, `costo_prod`, `estado`, `cod_categoria`, `cod_tipo_prod`, `cod_marca`, `impuesto`) VALUES
(1, 'PRODCTO 1', 'AAA', 560000, 44000, 'ACTIVO', 1, 1, 1, 5),
(2, 'PRODUCTO 22', 'zasaa', 450000, 120000, 'ACTIVO', 1, 1, 1, 10),
(3, 'PRODUCTO 11', 'zasaa', 45000, 12000, 'ACTIVO', 1, 1, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_entregar`
--

CREATE TABLE `productos_entregar` (
  `id_prod_entregar` int(11) NOT NULL,
  `id_orden_serv` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_salida` datetime NOT NULL,
  `hora_llegada` datetime NOT NULL,
  `estado` varchar(10) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `cod_vehi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `cod_proveedor` int(11) NOT NULL,
  `nombre_apellido_prov` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `ruc_prov` varchar(15) NOT NULL,
  `telefono_prov` varchar(20) NOT NULL,
  `direccion_prov` varchar(60) NOT NULL,
  `cod_ciudad` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`cod_proveedor`, `nombre_apellido_prov`, `razon_social`, `ruc_prov`, `telefono_prov`, `direccion_prov`, `cod_ciudad`, `estado`) VALUES
(2, 'Luis', 'PROVEEDOR  OC', '5431319-8', '0971120712', 'ITAUGUA', 1, 'ACTIVO'),
(3, 'Luis a', 'PROVEEDOR  OCASIONA', '80000024-2', '0971120712', 'ITAUGUA', 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos_cliente`
--

CREATE TABLE `reclamos_cliente` (
  `id_reclamo` int(11) NOT NULL,
  `motv_reclamo` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_reclamo` varchar(50) NOT NULL,
  `id_prod_entregar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `cod_rol` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`cod_rol`, `descripcion`, `estado`) VALUES
(1, 'ADMINSTRADOR', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `cod_stock` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cod_deposito` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`cod_stock`, `cantidad`, `cod_deposito`, `cod_producto`) VALUES
(1, 0, 1, 1),
(2, 44, 1, 2),
(3, 0, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `cod_sucursal` int(11) NOT NULL,
  `nombre_sucur` varchar(100) NOT NULL,
  `direccion_sucur` varchar(100) NOT NULL,
  `telefono_sucur` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`cod_sucursal`, `nombre_sucur`, `direccion_sucur`, `telefono_sucur`, `estado`) VALUES
(1, 'SUCURSAL 1', '-', '-', 'ACTIVO'),
(2, 'SUCURSAL 2', '-', '-', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `cod_tipo_pago` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`cod_tipo_pago`, `descripcion`, `estado`) VALUES
(1, 'EFECTIVO', 'ACTIVO'),
(2, 'CHEQUE', 'ACTIVO'),
(3, 'TARJETA', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `cod_tipo_prod` int(11) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`cod_tipo_prod`, `descripcion`, `estado`) VALUES
(1, 'TIPO 1', 'ACTIVO'),
(2, 'TIPO 2', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nom_apellido` varchar(50) NOT NULL,
  `nick_name` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `cod_rol` int(11) NOT NULL,
  `limite_intentos` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nom_apellido`, `nick_name`, `password`, `estado`, `cod_rol`, `limite_intentos`, `intentos`) VALUES
(1, 'Mirna Avalos', 'mirna', '202cb962ac59075b964b07152d234b70', 'ACTIVO', 1, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `cod_vehi` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ao` date NOT NULL,
  `chapa` varchar(20) NOT NULL,
  `tipo_vehiculo` varchar(40) NOT NULL,
  `capacidad_carga` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `kilometraje` int(11) NOT NULL,
  `fecha_prox_mantenim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`cod_vehi`, `marca`, `modelo`, `ao`, `chapa`, `tipo_vehiculo`, `capacidad_carga`, `estado`, `fecha_registro`, `kilometraje`, `fecha_prox_mantenim`) VALUES
(1, 'TOYOTA', 'INFINITI', '2020-01-01', 'ABC123', 'SCANIA', 100, 'ACTIVO', '2024-01-01', 56800, '2024-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `cod_venta` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `nro_factura` int(11) NOT NULL,
  `timbrado` int(11) NOT NULL,
  `fecha_venc_timbrado` date NOT NULL,
  `condicion` varchar(20) NOT NULL,
  `cod_forma_cobro` int(11) NOT NULL,
  `cod_pedido_venta` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_apertura_cierre` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajuste_stock`
--
ALTER TABLE `ajuste_stock`
  ADD PRIMARY KEY (`cod_ajuste_stock`);

--
-- Indices de la tabla `apertura_cierre_caja`
--
ALTER TABLE `apertura_cierre_caja`
  ADD PRIMARY KEY (`cod_apertura_cierre`),
  ADD KEY `usuarios_apertura_cierre_caja_fk` (`cod_usuario`),
  ADD KEY `sucursal_apertura_cierre_caja_fk` (`cod_sucursal`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`cod_ciudad`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`),
  ADD KEY `ciudades_clientes_fk` (`cod_ciudad`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`cod_compra`),
  ADD KEY `usuarios_compras_fk` (`cod_usuario`),
  ADD KEY `tipo_pago_compras_fk` (`cod_tipo_pago`),
  ADD KEY `sucursal_compras_fk` (`cod_sucursal`),
  ADD KEY `deposito_compras_fk` (`cod_deposito`),
  ADD KEY `orden_compra_compras_fk` (`cod_orden_compra`);

--
-- Indices de la tabla `cuenta_pagar`
--
ALTER TABLE `cuenta_pagar`
  ADD PRIMARY KEY (`cod_cuenta_pagar`),
  ADD KEY `compras_cuenta_pagar_fk` (`cod_compra`);

--
-- Indices de la tabla `cuenta_recibir_cabecera`
--
ALTER TABLE `cuenta_recibir_cabecera`
  ADD PRIMARY KEY (`cod_cuenta_recibir`),
  ADD KEY `ventas_cuenta_recibir_cabecera_fk` (`cod_venta`);

--
-- Indices de la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD PRIMARY KEY (`cod_deposito`),
  ADD KEY `sucursal_deposito_fk` (`cod_sucursal`);

--
-- Indices de la tabla `detalle_ajuste_stock`
--
ALTER TABLE `detalle_ajuste_stock`
  ADD PRIMARY KEY (`id_deposito`,`cod_producto`,`cod_ajuste_stock`) USING BTREE;

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`cod_compra`),
  ADD KEY `productos_detalle_compras_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_cuenta_recibir`
--
ALTER TABLE `detalle_cuenta_recibir`
  ADD PRIMARY KEY (`cod_cuenta_recibir`),
  ADD KEY `forma_cobros_detalle_cuenta_recibir_fk` (`cod_forma_cobro`),
  ADD KEY `impuestos_detalle_cuenta_recibir_fk` (`cod_impuesto`),
  ADD KEY `apertura_cierre_caja_detalle_cuenta_recibir_fk` (`cod_apertura_cierre`);

--
-- Indices de la tabla `detalle_itinerario`
--
ALTER TABLE `detalle_itinerario`
  ADD PRIMARY KEY (`cod_itinerario`);

--
-- Indices de la tabla `detalle_nota_compra`
--
ALTER TABLE `detalle_nota_compra`
  ADD PRIMARY KEY (`cod_nota_compra`),
  ADD KEY `productos_detalle_nota_compra_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_nota_vent`
--
ALTER TABLE `detalle_nota_vent`
  ADD PRIMARY KEY (`cod_nota_venta`),
  ADD KEY `deposito_detalle_nota_vent_fk` (`cod_deposito`),
  ADD KEY `productos_detalle_nota_vent_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`cod_orden_compra`,`cod_producto`) USING BTREE,
  ADD KEY `productos_detalle_orden_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_orden_serv`
--
ALTER TABLE `detalle_orden_serv`
  ADD PRIMARY KEY (`id_orden_serv`),
  ADD KEY `productos_detalle_orden_serv_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_pedido_cliente`
--
ALTER TABLE `detalle_pedido_cliente`
  ADD PRIMARY KEY (`cod_pedido_venta`),
  ADD KEY `impuestos_detalle_pedido_cliente_fk` (`cod_impuesto`),
  ADD KEY `productos_detalle_pedido_cliente_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_pedido_compra`
--
ALTER TABLE `detalle_pedido_compra`
  ADD PRIMARY KEY (`cod_pedido_compra`,`cod_producto`) USING BTREE,
  ADD KEY `productos_detalle_pedido_compra_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_presupuesto_com`
--
ALTER TABLE `detalle_presupuesto_com`
  ADD PRIMARY KEY (`cod_presupuesto_compra`,`cod_producto`) USING BTREE,
  ADD KEY `productos_detalle_presupuesto_com_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_prod_entregar`
--
ALTER TABLE `detalle_prod_entregar`
  ADD PRIMARY KEY (`id_prod_entregar`),
  ADD KEY `productos_detalle_prod_entregar_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_remision`
--
ALTER TABLE `detalle_remision`
  ADD PRIMARY KEY (`cod_remision`),
  ADD KEY `productos_detalle_remision_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_remision_vent`
--
ALTER TABLE `detalle_remision_vent`
  ADD PRIMARY KEY (`cod_remision_venta`),
  ADD KEY `productos_detalle_remision_vent_fk` (`cod_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`cod_venta`),
  ADD KEY `deposito_detalle_venta_fk` (`cod_deposito`),
  ADD KEY `productos_detalle_venta_fk` (`cod_producto`);

--
-- Indices de la tabla `forma_cobros`
--
ALTER TABLE `forma_cobros`
  ADD PRIMARY KEY (`cod_forma_cobro`);

--
-- Indices de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `cargos_funcionarios_fk` (`id_cargo`),
  ADD KEY `flota_vehiculo_funcionarios_fk` (`cod_vehi`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`cod_impuesto`);

--
-- Indices de la tabla `itinerarios`
--
ALTER TABLE `itinerarios`
  ADD PRIMARY KEY (`cod_itinerario`),
  ADD KEY `personal_entregas_itinerarios_fk` (`id_perso_entreg`);

--
-- Indices de la tabla `libro_compra`
--
ALTER TABLE `libro_compra`
  ADD PRIMARY KEY (`id_libro_compra`),
  ADD KEY `compras_libro_compra_fk` (`cod_compra`);

--
-- Indices de la tabla `libro_ventas`
--
ALTER TABLE `libro_ventas`
  ADD PRIMARY KEY (`id_libro_venta`),
  ADD KEY `ventas_libro_ventas_fk` (`cod_venta`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`cod_marca`);

--
-- Indices de la tabla `nota_compras`
--
ALTER TABLE `nota_compras`
  ADD PRIMARY KEY (`cod_nota_compra`),
  ADD KEY `usuarios_nota_compras_fk` (`cod_usuario`),
  ADD KEY `sucursal_nota_compras_fk` (`cod_sucursal`),
  ADD KEY `compras_nota_compras_fk` (`cod_compra`);

--
-- Indices de la tabla `nota_remision`
--
ALTER TABLE `nota_remision`
  ADD PRIMARY KEY (`cod_remision`),
  ADD KEY `vehiculo_remision_cabecera_fk` (`cod_vehi`),
  ADD KEY `usuarios_remision_cabecera_fk` (`cod_usuario`),
  ADD KEY `sucursal_remision_cabecera_fk` (`cod_sucursal`),
  ADD KEY `compras_remision_cabecera_fk` (`cod_compra`);

--
-- Indices de la tabla `nota_remsion_venta`
--
ALTER TABLE `nota_remsion_venta`
  ADD PRIMARY KEY (`cod_remision_venta`),
  ADD KEY `usuarios_nota_remsion_venta_fk` (`cod_usuario`),
  ADD KEY `sucursal_nota_remsion_venta_fk` (`cod_sucursal`),
  ADD KEY `clientes_nota_remsion_venta_fk` (`cod_cliente`);

--
-- Indices de la tabla `nota_ventas`
--
ALTER TABLE `nota_ventas`
  ADD PRIMARY KEY (`cod_nota_venta`),
  ADD KEY `usuarios_nota_ventas_fk` (`cod_usuario`),
  ADD KEY `forma_cobros_nota_ventas_fk` (`cod_forma_cobro`),
  ADD KEY `sucursal_nota_ventas_fk` (`cod_sucursal`),
  ADD KEY `ventas_nota_ventas_fk` (`cod_venta`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`cod_orden_compra`),
  ADD KEY `usuarios_orden_compra_fk` (`cod_usuario`),
  ADD KEY `sucursal_orden_compra_fk` (`cod_sucursal`),
  ADD KEY `proveedores_orden_compra_fk` (`cod_proveedor`),
  ADD KEY `presupuesto_compra_orden_compra_fk` (`cod_presupuesto_compra`);

--
-- Indices de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD PRIMARY KEY (`id_orden_serv`),
  ADD KEY `clientes_orden_servicio_fk` (`cod_cliente`);

--
-- Indices de la tabla `pedido_clientes`
--
ALTER TABLE `pedido_clientes`
  ADD PRIMARY KEY (`cod_pedido_venta`),
  ADD KEY `usuarios_pedido_clientes_fk` (`cod_usuario`),
  ADD KEY `sucursal_pedido_clientes_fk` (`cod_sucursal`),
  ADD KEY `clientes_pedido_clientes_fk` (`cod_cliente`);

--
-- Indices de la tabla `pedido_compra`
--
ALTER TABLE `pedido_compra`
  ADD PRIMARY KEY (`cod_pedido_compra`),
  ADD KEY `usuarios_pedido_compra_fk` (`cod_usuario`),
  ADD KEY `sucursal_pedido_compra_fk` (`cod_sucursal`);

--
-- Indices de la tabla `personal_entregas`
--
ALTER TABLE `personal_entregas`
  ADD PRIMARY KEY (`id_perso_entreg`);

--
-- Indices de la tabla `presupuesto_compra`
--
ALTER TABLE `presupuesto_compra`
  ADD PRIMARY KEY (`cod_presupuesto_compra`),
  ADD KEY `usuarios_presupuesto_compra_fk` (`cod_usuario`),
  ADD KEY `sucursal_presupuesto_compra_fk` (`cod_sucursal`),
  ADD KEY `pedido_compra_presupuesto_compra_fk` (`cod_pedido_compra`),
  ADD KEY `presupuesto_compra_proveedores_FK` (`cod_proveedor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`cod_producto`),
  ADD KEY `tipo_productos_productos_fk` (`cod_tipo_prod`),
  ADD KEY `categorias_productos_fk` (`cod_categoria`),
  ADD KEY `marcas_productos_fk` (`cod_marca`);

--
-- Indices de la tabla `productos_entregar`
--
ALTER TABLE `productos_entregar`
  ADD PRIMARY KEY (`id_prod_entregar`),
  ADD KEY `flota_vehiculo_productos_entregar_fk` (`cod_vehi`),
  ADD KEY `funcionarios_productos_entregar_fk` (`id_funcionario`),
  ADD KEY `usuarios_productos_entregar_fk` (`cod_usuario`),
  ADD KEY `orden_servicio_productos_entregar_fk` (`id_orden_serv`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`cod_proveedor`),
  ADD KEY `ciudades_proveedores_fk` (`cod_ciudad`);

--
-- Indices de la tabla `reclamos_cliente`
--
ALTER TABLE `reclamos_cliente`
  ADD PRIMARY KEY (`id_reclamo`),
  ADD KEY `productos_entregar_reclamos_cliente_fk` (`id_prod_entregar`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`cod_rol`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`cod_stock`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`cod_sucursal`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`cod_tipo_pago`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`cod_tipo_prod`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD KEY `roles_usuarios_fk` (`cod_rol`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`cod_vehi`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`cod_venta`),
  ADD KEY `usuarios_ventas_fk` (`cod_usuario`),
  ADD KEY `forma_cobros_ventas_fk` (`cod_forma_cobro`),
  ADD KEY `sucursal_ventas_fk` (`cod_sucursal`),
  ADD KEY `apertura_cierre_caja_ventas_fk` (`cod_apertura_cierre`),
  ADD KEY `clientes_ventas_fk` (`cod_cliente`),
  ADD KEY `pedido_clientes_ventas_fk` (`cod_pedido_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajuste_stock`
--
ALTER TABLE `ajuste_stock`
  MODIFY `cod_ajuste_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `apertura_cierre_caja`
--
ALTER TABLE `apertura_cierre_caja`
  MODIFY `cod_apertura_cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `cod_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `cod_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cuenta_pagar`
--
ALTER TABLE `cuenta_pagar`
  MODIFY `cod_cuenta_pagar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuenta_recibir_cabecera`
--
ALTER TABLE `cuenta_recibir_cabecera`
  MODIFY `cod_cuenta_recibir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deposito`
--
ALTER TABLE `deposito`
  MODIFY `cod_deposito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_itinerario`
--
ALTER TABLE `detalle_itinerario`
  MODIFY `cod_itinerario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_nota_vent`
--
ALTER TABLE `detalle_nota_vent`
  MODIFY `cod_nota_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `cod_orden_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_orden_serv`
--
ALTER TABLE `detalle_orden_serv`
  MODIFY `id_orden_serv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido_cliente`
--
ALTER TABLE `detalle_pedido_cliente`
  MODIFY `cod_pedido_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido_compra`
--
ALTER TABLE `detalle_pedido_compra`
  MODIFY `cod_pedido_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_presupuesto_com`
--
ALTER TABLE `detalle_presupuesto_com`
  MODIFY `cod_presupuesto_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_remision`
--
ALTER TABLE `detalle_remision`
  MODIFY `cod_remision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_remision_vent`
--
ALTER TABLE `detalle_remision_vent`
  MODIFY `cod_remision_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `cod_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `forma_cobros`
--
ALTER TABLE `forma_cobros`
  MODIFY `cod_forma_cobro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `cod_impuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `itinerarios`
--
ALTER TABLE `itinerarios`
  MODIFY `cod_itinerario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro_compra`
--
ALTER TABLE `libro_compra`
  MODIFY `id_libro_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libro_ventas`
--
ALTER TABLE `libro_ventas`
  MODIFY `id_libro_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `cod_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nota_compras`
--
ALTER TABLE `nota_compras`
  MODIFY `cod_nota_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nota_remision`
--
ALTER TABLE `nota_remision`
  MODIFY `cod_remision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nota_remsion_venta`
--
ALTER TABLE `nota_remsion_venta`
  MODIFY `cod_remision_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_ventas`
--
ALTER TABLE `nota_ventas`
  MODIFY `cod_nota_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `cod_orden_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  MODIFY `id_orden_serv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_clientes`
--
ALTER TABLE `pedido_clientes`
  MODIFY `cod_pedido_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_compra`
--
ALTER TABLE `pedido_compra`
  MODIFY `cod_pedido_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_entregas`
--
ALTER TABLE `personal_entregas`
  MODIFY `id_perso_entreg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuesto_compra`
--
ALTER TABLE `presupuesto_compra`
  MODIFY `cod_presupuesto_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `cod_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos_entregar`
--
ALTER TABLE `productos_entregar`
  MODIFY `id_prod_entregar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reclamos_cliente`
--
ALTER TABLE `reclamos_cliente`
  MODIFY `id_reclamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `cod_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `cod_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `cod_tipo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `cod_tipo_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `cod_vehi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `cod_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apertura_cierre_caja`
--
ALTER TABLE `apertura_cierre_caja`
  ADD CONSTRAINT `sucursal_apertura_cierre_caja_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_apertura_cierre_caja_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `ciudades_clientes_fk` FOREIGN KEY (`cod_ciudad`) REFERENCES `ciudades` (`cod_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `deposito_compras_fk` FOREIGN KEY (`cod_deposito`) REFERENCES `deposito` (`cod_deposito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_compra_compras_fk` FOREIGN KEY (`cod_orden_compra`) REFERENCES `orden_compra` (`cod_orden_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_compras_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tipo_pago_compras_fk` FOREIGN KEY (`cod_tipo_pago`) REFERENCES `tipo_pago` (`cod_tipo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_compras_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuenta_pagar`
--
ALTER TABLE `cuenta_pagar`
  ADD CONSTRAINT `compras_cuenta_pagar_fk` FOREIGN KEY (`cod_compra`) REFERENCES `compras` (`cod_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuenta_recibir_cabecera`
--
ALTER TABLE `cuenta_recibir_cabecera`
  ADD CONSTRAINT `ventas_cuenta_recibir_cabecera_fk` FOREIGN KEY (`cod_venta`) REFERENCES `ventas` (`cod_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD CONSTRAINT `sucursal_deposito_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `compras_detalle_compras_fk` FOREIGN KEY (`cod_compra`) REFERENCES `compras` (`cod_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_compras_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_cuenta_recibir`
--
ALTER TABLE `detalle_cuenta_recibir`
  ADD CONSTRAINT `apertura_cierre_caja_detalle_cuenta_recibir_fk` FOREIGN KEY (`cod_apertura_cierre`) REFERENCES `apertura_cierre_caja` (`cod_apertura_cierre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cuenta_recibir_cabecera_detalle_cuenta_recibir_fk` FOREIGN KEY (`cod_cuenta_recibir`) REFERENCES `cuenta_recibir_cabecera` (`cod_cuenta_recibir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `forma_cobros_detalle_cuenta_recibir_fk` FOREIGN KEY (`cod_forma_cobro`) REFERENCES `forma_cobros` (`cod_forma_cobro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `impuestos_detalle_cuenta_recibir_fk` FOREIGN KEY (`cod_impuesto`) REFERENCES `impuestos` (`cod_impuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_itinerario`
--
ALTER TABLE `detalle_itinerario`
  ADD CONSTRAINT `itinerarios_detalle_itinerario_fk` FOREIGN KEY (`cod_itinerario`) REFERENCES `itinerarios` (`cod_itinerario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_nota_compra`
--
ALTER TABLE `detalle_nota_compra`
  ADD CONSTRAINT `nota_compras_detalle_nota_compra_fk` FOREIGN KEY (`cod_nota_compra`) REFERENCES `nota_compras` (`cod_nota_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_nota_compra_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_nota_vent`
--
ALTER TABLE `detalle_nota_vent`
  ADD CONSTRAINT `deposito_detalle_nota_vent_fk` FOREIGN KEY (`cod_deposito`) REFERENCES `deposito` (`cod_deposito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nota_ventas_detalle_nota_vent_fk` FOREIGN KEY (`cod_nota_venta`) REFERENCES `nota_ventas` (`cod_nota_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_nota_vent_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD CONSTRAINT `orden_compra_detalle_orden_fk` FOREIGN KEY (`cod_orden_compra`) REFERENCES `orden_compra` (`cod_orden_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_orden_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_orden_serv`
--
ALTER TABLE `detalle_orden_serv`
  ADD CONSTRAINT `orden_servicio_detalle_orden_serv_fk` FOREIGN KEY (`id_orden_serv`) REFERENCES `orden_servicio` (`id_orden_serv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_orden_serv_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_pedido_cliente`
--
ALTER TABLE `detalle_pedido_cliente`
  ADD CONSTRAINT `impuestos_detalle_pedido_cliente_fk` FOREIGN KEY (`cod_impuesto`) REFERENCES `impuestos` (`cod_impuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_clientes_detalle_pedido_cliente_fk` FOREIGN KEY (`cod_pedido_venta`) REFERENCES `pedido_clientes` (`cod_pedido_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_pedido_cliente_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_pedido_compra`
--
ALTER TABLE `detalle_pedido_compra`
  ADD CONSTRAINT `pedido_compra_detalle_pedido_compra_fk` FOREIGN KEY (`cod_pedido_compra`) REFERENCES `pedido_compra` (`cod_pedido_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_pedido_compra_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_presupuesto_com`
--
ALTER TABLE `detalle_presupuesto_com`
  ADD CONSTRAINT `presupuesto_compra_detalle_presupuesto_com_fk` FOREIGN KEY (`cod_presupuesto_compra`) REFERENCES `presupuesto_compra` (`cod_presupuesto_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_presupuesto_com_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_prod_entregar`
--
ALTER TABLE `detalle_prod_entregar`
  ADD CONSTRAINT `productos_detalle_prod_entregar_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_entregar_detalle_prod_entregar_fk` FOREIGN KEY (`id_prod_entregar`) REFERENCES `productos_entregar` (`id_prod_entregar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_remision`
--
ALTER TABLE `detalle_remision`
  ADD CONSTRAINT `productos_detalle_remision_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `remision_cabecera_detalle_remision_fk` FOREIGN KEY (`cod_remision`) REFERENCES `nota_remision` (`cod_remision`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_remision_vent`
--
ALTER TABLE `detalle_remision_vent`
  ADD CONSTRAINT `nota_remsion_venta_detalle_remision_vent_fk` FOREIGN KEY (`cod_remision_venta`) REFERENCES `nota_remsion_venta` (`cod_remision_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_remision_vent_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `deposito_detalle_venta_fk` FOREIGN KEY (`cod_deposito`) REFERENCES `deposito` (`cod_deposito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_detalle_venta_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ventas_detalle_venta_fk` FOREIGN KEY (`cod_venta`) REFERENCES `ventas` (`cod_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `cargos_funcionarios_fk` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `flota_vehiculo_funcionarios_fk` FOREIGN KEY (`cod_vehi`) REFERENCES `vehiculo` (`cod_vehi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `itinerarios`
--
ALTER TABLE `itinerarios`
  ADD CONSTRAINT `personal_entregas_itinerarios_fk` FOREIGN KEY (`id_perso_entreg`) REFERENCES `personal_entregas` (`id_perso_entreg`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libro_compra`
--
ALTER TABLE `libro_compra`
  ADD CONSTRAINT `compras_libro_compra_fk` FOREIGN KEY (`cod_compra`) REFERENCES `compras` (`cod_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libro_ventas`
--
ALTER TABLE `libro_ventas`
  ADD CONSTRAINT `ventas_libro_ventas_fk` FOREIGN KEY (`cod_venta`) REFERENCES `ventas` (`cod_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_compras`
--
ALTER TABLE `nota_compras`
  ADD CONSTRAINT `compras_nota_compras_fk` FOREIGN KEY (`cod_compra`) REFERENCES `compras` (`cod_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_nota_compras_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_nota_compras_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_remision`
--
ALTER TABLE `nota_remision`
  ADD CONSTRAINT `compras_remision_cabecera_fk` FOREIGN KEY (`cod_compra`) REFERENCES `compras` (`cod_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_remision_cabecera_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_remision_cabecera_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vehiculo_remision_cabecera_fk` FOREIGN KEY (`cod_vehi`) REFERENCES `vehiculo` (`cod_vehi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_remsion_venta`
--
ALTER TABLE `nota_remsion_venta`
  ADD CONSTRAINT `clientes_nota_remsion_venta_fk` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_nota_remsion_venta_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_nota_remsion_venta_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_ventas`
--
ALTER TABLE `nota_ventas`
  ADD CONSTRAINT `forma_cobros_nota_ventas_fk` FOREIGN KEY (`cod_forma_cobro`) REFERENCES `forma_cobros` (`cod_forma_cobro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_nota_ventas_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_nota_ventas_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ventas_nota_ventas_fk` FOREIGN KEY (`cod_venta`) REFERENCES `ventas` (`cod_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `presupuesto_compra_orden_compra_fk` FOREIGN KEY (`cod_presupuesto_compra`) REFERENCES `presupuesto_compra` (`cod_presupuesto_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `proveedores_orden_compra_fk` FOREIGN KEY (`cod_proveedor`) REFERENCES `proveedores` (`cod_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_orden_compra_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_orden_compra_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD CONSTRAINT `clientes_orden_servicio_fk` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido_clientes`
--
ALTER TABLE `pedido_clientes`
  ADD CONSTRAINT `clientes_pedido_clientes_fk` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_pedido_clientes_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_pedido_clientes_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido_compra`
--
ALTER TABLE `pedido_compra`
  ADD CONSTRAINT `sucursal_pedido_compra_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_pedido_compra_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `presupuesto_compra`
--
ALTER TABLE `presupuesto_compra`
  ADD CONSTRAINT `pedido_compra_presupuesto_compra_fk` FOREIGN KEY (`cod_pedido_compra`) REFERENCES `pedido_compra` (`cod_pedido_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `presupuesto_compra_proveedores_FK` FOREIGN KEY (`cod_proveedor`) REFERENCES `proveedores` (`cod_proveedor`),
  ADD CONSTRAINT `sucursal_presupuesto_compra_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_presupuesto_compra_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `categorias_productos_fk` FOREIGN KEY (`cod_categoria`) REFERENCES `categorias` (`cod_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `marcas_productos_fk` FOREIGN KEY (`cod_marca`) REFERENCES `marcas` (`cod_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tipo_productos_productos_fk` FOREIGN KEY (`cod_tipo_prod`) REFERENCES `tipo_productos` (`cod_tipo_prod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_entregar`
--
ALTER TABLE `productos_entregar`
  ADD CONSTRAINT `flota_vehiculo_productos_entregar_fk` FOREIGN KEY (`cod_vehi`) REFERENCES `vehiculo` (`cod_vehi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `funcionarios_productos_entregar_fk` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_servicio_productos_entregar_fk` FOREIGN KEY (`id_orden_serv`) REFERENCES `orden_servicio` (`id_orden_serv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_productos_entregar_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `ciudades_proveedores_fk` FOREIGN KEY (`cod_ciudad`) REFERENCES `ciudades` (`cod_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reclamos_cliente`
--
ALTER TABLE `reclamos_cliente`
  ADD CONSTRAINT `productos_entregar_reclamos_cliente_fk` FOREIGN KEY (`id_prod_entregar`) REFERENCES `productos_entregar` (`id_prod_entregar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `roles_usuarios_fk` FOREIGN KEY (`cod_rol`) REFERENCES `roles` (`cod_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `apertura_cierre_caja_ventas_fk` FOREIGN KEY (`cod_apertura_cierre`) REFERENCES `apertura_cierre_caja` (`cod_apertura_cierre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `clientes_ventas_fk` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `forma_cobros_ventas_fk` FOREIGN KEY (`cod_forma_cobro`) REFERENCES `forma_cobros` (`cod_forma_cobro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_clientes_ventas_fk` FOREIGN KEY (`cod_pedido_venta`) REFERENCES `pedido_clientes` (`cod_pedido_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_ventas_fk` FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_ventas_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

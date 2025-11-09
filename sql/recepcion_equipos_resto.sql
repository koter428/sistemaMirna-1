SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Tabla para el modelo de equipos
CREATE TABLE `modelo_equipo` (
    `cod_modelo` int(11) NOT NULL AUTO_INCREMENT,
    `descripcion` varchar(100) NOT NULL,
    `marca` varchar(100) NOT NULL,
    `estado` varchar(10) DEFAULT 'ACTIVO',
    PRIMARY KEY (`cod_modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla para los equipos
CREATE TABLE `equipos` (
    `cod_equipo` int(11) NOT NULL AUTO_INCREMENT,
    `descripcion` varchar(200) NOT NULL,
    `cod_modelo` int(11),
    `estado` varchar(10) DEFAULT 'ACTIVO',
    PRIMARY KEY (`cod_equipo`),
    FOREIGN KEY (`cod_modelo`) REFERENCES `modelo_equipo` (`cod_modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla principal de recepción de equipos
CREATE TABLE `recepcion_equipo` (
    `cod_recepcion` int(11) NOT NULL AUTO_INCREMENT,
    `cod_cliente` int(11) NOT NULL,
    `cod_tecnico` int(11) NOT NULL,
    `nro_serie` varchar(50) NOT NULL,
    `fecha_recepcion` date NOT NULL,
    `cod_estado` int(11) NOT NULL,
    `cod_sucursal` int(11) NOT NULL,
    `cod_usuario` int(11) NOT NULL,
    `estado` varchar(10) DEFAULT 'ACTIVO',
    PRIMARY KEY (`cod_recepcion`),
    FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`),
    FOREIGN KEY (`cod_estado`) REFERENCES `estado_equipo` (`cod_estado`),
    FOREIGN KEY (`cod_sucursal`) REFERENCES `sucursal` (`cod_sucursal`),
    FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de detalles de recepción
CREATE TABLE `detalle_recepcion` (
    `cod_detalle_recepcion` int(11) NOT NULL AUTO_INCREMENT,
    `cod_recepcion` int(11) NOT NULL,
    `cod_equipo` int(11) NOT NULL,
    `observacion` text,
    `estado` varchar(10) DEFAULT 'ACTIVO',
    PRIMARY KEY (`cod_detalle_recepcion`),
    FOREIGN KEY (`cod_recepcion`) REFERENCES `recepcion_equipo` (`cod_recepcion`),
    FOREIGN KEY (`cod_equipo`) REFERENCES `equipos` (`cod_equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar estados básicos
INSERT INTO `estado_equipo` (`descripcion`) VALUES 
('Pendiente de diagnóstico'),
('En diagnóstico'),
('Esperando aprobación'),
('En reparación'),
('Reparado'),
('Entregado'),
('Cancelado');
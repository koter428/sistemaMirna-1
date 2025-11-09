-- phpMyAdmin SQL Dump
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

USE `sistema_mirna`;

-- Tabla para el estado de los equipos
CREATE TABLE IF NOT EXISTS estado (
    idEstado INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla para el modelo de equipos
CREATE TABLE IF NOT EXISTS modelo (
    idModelo INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL
)//

-- Tabla para los equipos
CREATE TABLE IF NOT EXISTS equipo (
    idEquipo INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(200) NOT NULL,
    idModelo INT,
    FOREIGN KEY (idModelo) REFERENCES modelo(idModelo)
);

-- Tabla principal de recepción de equipos
CREATE TABLE IF NOT EXISTS recepcion_equipo (
    idRecepcion INT AUTO_INCREMENT PRIMARY KEY,
    idCliente INT NOT NULL,
    idTecnico INT NOT NULL,
    numeroSerial VARCHAR(50) NOT NULL,
    fechaRecepcion DATE NOT NULL,
    idEstado INT NOT NULL,
    idSucursal INT NOT NULL,
    idUsuario INT NOT NULL,
    idempleado INT,
    FOREIGN KEY (idCliente) REFERENCES cliente(idCliente),
    FOREIGN KEY (idEstado) REFERENCES estado(idEstado),
    FOREIGN KEY (idSucursal) REFERENCES sucursal(idSucursal),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

-- Tabla de detalles de recepción
CREATE TABLE IF NOT EXISTS detalle_recepcion (
    idDetalleRecepcion INT AUTO_INCREMENT PRIMARY KEY,
    idRecepcion INT NOT NULL,
    idEquipo INT NOT NULL,
    observacion TEXT,
    FOREIGN KEY (idRecepcion) REFERENCES recepcion_equipo(idRecepcion),
    FOREIGN KEY (idEquipo) REFERENCES equipo(idEquipo)
);

-- Insertar estados básicos
INSERT INTO estado (descripcion) VALUES 
('Pendiente de diagnóstico'),
('En diagnóstico'),
('Esperando aprobación'),
('En reparación'),
('Reparado'),
('Entregado'),
('Cancelado');

-- Crear índices para mejorar el rendimiento
CREATE INDEX idx_recepcion_cliente ON recepcion_equipo(idCliente);
CREATE INDEX idx_recepcion_estado ON recepcion_equipo(idEstado);
CREATE INDEX idx_recepcion_fecha ON recepcion_equipo(fechaRecepcion);
CREATE INDEX idx_detalle_recepcion ON detalle_recepcion(idRecepcion);
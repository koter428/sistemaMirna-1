-- Verificar y modificar la tabla usuarios para incluir el campo rol
-- Añadir columnas a tablas si no existen (compatible con versiones antiguas de MySQL/MariaDB)
-- Insertar usuarios iniciales en la tabla usuario
INSERT INTO `usuario` (`nom_apellido`, `usuario`, `clave`, `rol`, `estado`) VALUES
('Administrador Sistema', 'admin', '$2y$10$yIp9ljXPQmKmk0qpmMKjZueOolZa9YLGdMvBWsZuQC6TjrdKY5wEy', 'admin', 'ACTIVO'),
('Tecnico 1', 'tecnico1', '$2y$10$yIp9ljXPQmKmk0qpmMKjZueOolZa9YLGdMvBWsZuQC6TjrdKY5wEy', 'tecnico', 'ACTIVO'),
('Tecnico 2', 'tecnico2', '$2y$10$yIp9ljXPQmKmk0qpmMKjZueOolZa9YLGdMvBWsZuQC6TjrdKY5wEy', 'tecnico', 'ACTIVO');
('Admin Sistema', 'admin', '$2y$10$yIp9ljXPQmKmk0qpmMKjZueOolZa9YLGdMvBWsZuQC6TjrdKY5wEy', 'admin', 'ACTIVO'),
('Técnico 1', 'tecnico1', '$2y$10$yIp9ljXPQmKmk0qpmMKjZueOolZa9YLGdMvBWsZuQC6TjrdKY5wEy', 'tecnico', 'ACTIVO'),
('Técnico 2', 'tecnico2', '$2y$10$yIp9ljXPQmKmk0qpmMKjZueOolZa9YLGdMvBWsZuQC6TjrdKY5wEy', 'tecnico', 'ACTIVO');

DELIMITER $$
DROP PROCEDURE IF EXISTS add_column_if_not_exists$$
CREATE PROCEDURE add_column_if_not_exists(tbl VARCHAR(64), col VARCHAR(64), coldef TEXT)
BEGIN
	IF NOT EXISTS(
		SELECT * FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = tbl AND COLUMN_NAME = col
	) THEN
		SET @s = CONCAT('ALTER TABLE `', tbl, '` ADD COLUMN ', coldef);
		PREPARE stmt FROM @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END IF;
END$$
DELIMITER ;
CALL add_column_if_not_exists('usuarios', 'rol', '`rol` VARCHAR(20) DEFAULT \'USUARIO\'');
CALL add_column_if_not_exists('usuarios', 'estado', '`estado` VARCHAR(10) DEFAULT \'ACTIVO\'');

-- Actualizar usuarios existentes como técnicos (ajusta los IDs según tus usuarios)
UPDATE `usuarios` SET `rol` = 'tecnico' WHERE `cod_usuario` IN (1, 2, 3);

-- Añadir columna `estado` a `equipos` si no existe
CALL add_column_if_not_exists('equipos', 'estado', '`estado` VARCHAR(10) DEFAULT \'ACTIVO\'');

-- Eliminar el procedimiento auxiliar
DROP PROCEDURE IF EXISTS add_column_if_not_exists;

-- Asegurarnos que la tabla `estado` exista y tenga los campos necesarios
CREATE TABLE IF NOT EXISTS `estado` (
	`cod_estado` int(11) NOT NULL AUTO_INCREMENT,
	`descripcion` varchar(100) NOT NULL,
	`estado` varchar(10) DEFAULT 'ACTIVO',
	PRIMARY KEY (`cod_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `estado` (`descripcion`, `estado`) VALUES 
('Pendiente de diagnóstico', 'ACTIVO'),
('En diagnóstico', 'ACTIVO'),
('Esperando aprobación', 'ACTIVO'),
('En reparación', 'ACTIVO'),
('Reparado', 'ACTIVO'),
('Entregado', 'ACTIVO'),
('Cancelado', 'ACTIVO');

-- Asegurarnos que la tabla equipos tenga el campo estado
-- (La columna `estado` en `equipos` se añade arriba mediante el procedimiento add_column_if_not_exists)

-- Insertar algunos equipos de ejemplo si no hay
INSERT IGNORE INTO `modelo` (`descripcion`, `marca`, `estado`) VALUES 
('Laptop 15"', 'HP', 'ACTIVO'),
('PC Desktop', 'Dell', 'ACTIVO'),
('Impresora Láser', 'Epson', 'ACTIVO'),
('Monitor LED 24"', 'Samsung', 'ACTIVO');

-- Insertar equipos de ejemplo vinculados a los modelos
INSERT IGNORE INTO `equipos` (`descripcion`, `cod_modelo`, `estado`) VALUES 
('Laptop HP Pavilion', 1, 'ACTIVO'),
('PC Dell Optiplex', 2, 'ACTIVO'),
('Impresora Epson L355', 3, 'ACTIVO'),
('Monitor Samsung F24', 4, 'ACTIVO');

-- Verificar los usuarios técnicos
SELECT cod_usuario, nombre, rol, estado FROM usuarios WHERE rol = 'tecnico';

-- Verificar los estados
SELECT * FROM estado WHERE estado = 'ACTIVO';

-- Verificar los equipos
SELECT e.*, m.descripcion as modelo, m.marca 
FROM equipos e 
JOIN modelo m ON e.cod_modelo = m.cod_modelo 
WHERE e.estado = 'ACTIVO';
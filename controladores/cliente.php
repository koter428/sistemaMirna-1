<?php

require_once '../conexion/db.php';

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    try {
        $query = $base_datos->conectar()->prepare("SELECT cod_cliente, nombre_cliente, apellido_cliente, cedula_cliente, telefono_cliente, cod_ciudad, direccion_cliente, estado FROM clientes WHERE estado = 'ACTIVO'");
        $query->execute();
        $datos = $query->fetchAll(PDO::FETCH_OBJ);
        if (empty($datos)) {
            error_log("[dameActivos] No se encontraron clientes activos.");
        }
        echo json_encode($datos);
    } catch (Exception $e) {
        error_log("[dameActivos] Error: " . $e->getMessage());
        echo json_encode([]);
    }
}

if (isset($_POST['dame_todo'])) {
    dameTodo();
}

function dameTodo() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT cl.cod_cliente, cl.nombre_cliente, cl.apellido_cliente, cl.cedula_cliente, cl.telefono_cliente, cl.cod_ciudad, c.descripcion, cl.direccion_cliente, cl.estado, c.descripcion as ciudad FROM clientes cl JOIN ciudades c ON c.cod_ciudad = cl.cod_ciudad ");

    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}

//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------

if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    //crea un arreglo del texto que se le pasa
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    session_start();
    $query = $base_datos->conectar()->prepare("INSERT INTO clientes
	( nombre_cliente, 
	apellido_cliente, cedula_cliente, 
	telefono_cliente, cod_ciudad, direccion_cliente,
	 estado)
	VALUES ( :nombre_cliente, :apellido_cliente, :cedula_cliente, :telefono_cliente, 
        :cod_ciudad, :direccion_cliente, :estado)");

    $query->execute($json_datos);
}

//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
if (isset($_POST['desactivar'])) {
    desactivar($_POST['desactivar']);
}

function desactivar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE clientes SET estado = 'INACTIVO'"
            . " WHERE cod_cliente = $id");

    $query->execute();
}
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
if (isset($_POST['eliminar'])) {
    eliminar($_POST['eliminar']);
}

function eliminar($id) {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("DELETE FROM clientes "
            . " WHERE cod_cliente = $id");

    $query->execute();
}

//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------


if (isset($_POST['registroPorId'])) {
    //ejecutar funcion
    registroPorId($_POST['registroPorId']);
}

function registroPorId($id) {
    $base_datos = new DB();

    $query = $base_datos->conectar()->prepare("SELECT  cl.cod_cliente, 
        cl.nombre_cliente,
         cl.apellido_cliente, 
         cl.cedula_cliente,
          cl.telefono_cliente,
          cl.cod_ciudad,
          c.descripcion, 
          cl.direccion_cliente,
           cl.estado
	FROM clientes cl
	JOIN ciudades c
	ON c.cod_ciudad = cl.cod_ciudad 
	WHERE cl.cod_cliente = $id");

    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetch(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}

if (isset($_POST['actualizar'])) {
    actualizar($_POST['actualizar']);
}

function actualizar($lista) {
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE clientes
	SET
		nombre_cliente= :nombre_cliente,
		apellido_cliente= :apellido_cliente,
		cedula_cliente= :cedula_cliente,
		telefono_cliente= :telefono_cliente,
		cod_ciudad= :cod_ciudad,
		direccion_cliente= :direccion_cliente,
		estado= :estado
	WHERE cod_cliente = :cod_cliente");
    
    $query->execute($json_datos);
}

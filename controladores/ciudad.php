<?php

require_once '../conexion/db.php';

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `cod_ciudad`, `descripcion`, `estado`
FROM `ciudades`
WHERE estado = 'ACTIVO'");

    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}

if (isset($_POST['dame_todo'])) {
    dameTodo();
}

function dameTodo() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `cod_ciudad`, `descripcion`, `estado`
FROM `ciudades`");

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
    $query = $base_datos->conectar()->prepare("INSERT INTO `ciudades`( `descripcion`, `estado`) 
VALUES (:descripcion, :estado)");

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
    $query = $base_datos->conectar()->prepare("UPDATE ciudades SET estado = 'INACTIVO'"
            . " WHERE cod_ciudad = $id");

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
    $query = $base_datos->conectar()->prepare("DELETE FROM ciudades "
            . " WHERE cod_ciudad = $id");

    $query->execute();
}

//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
if (isset($_POST['buscar_nombre'])) {
    buscarPorDescripcion($_POST['buscar_nombre']);
}

function buscarPorDescripcion($descripcion) {
    $base_datos = new DB();

    $query = $base_datos->conectar()->prepare("SELECT `cod_ciudad`, `descripcion`, `estado` 
FROM `ciudades`
WHERE CONCAT(`cod_ciudad`, `descripcion`, `estado` ) LIKE '%$descripcion%'");
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}

if (isset($_POST['registroPorId'])) {
    //ejecutar funcion
    registroPorId($_POST['registroPorId']);
}

function registroPorId($id) {
    $base_datos = new DB();

    $query = $base_datos->conectar()->prepare("SELECT `cod_ciudad`, `descripcion`, `estado` 
FROM `ciudades`
WHERE cod_ciudad =  $id");

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
    $query = $base_datos->conectar()->prepare("UPDATE `ciudades` 
    SET `descripcion`= :descripcion,`estado`= :estado
    WHERE `cod_ciudad`= :cod_ciudad");
    
    $query->execute($json_datos);
}

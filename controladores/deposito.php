<?php

require_once '../conexion/db.php';

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
d.cod_deposito,
d.nombre_dep,
d.estado,
s.nombre_sucur
FROM deposito d
join sucursal s
on s.cod_sucursal = d.cod_sucursal
	where d.estado = 'ACTIVO'");

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
    $query = $base_datos->conectar()->prepare("SELECT 
d.cod_deposito,
d.nombre_dep,
d.estado,
s.nombre_sucur
FROM deposito d
join sucursal s
on s.cod_sucursal = d.cod_sucursal");

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
    $query = $base_datos->conectar()->prepare("INSERT INTO `deposito`
    (`nombre_dep`, `estado`, `cod_sucursal`)
     VALUES (:nombre_dep, :estado, :cod_sucursal)");

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
    $query = $base_datos->conectar()->prepare("UPDATE deposito SET estado = 'INACTIVO'"
            . " WHERE cod_deposito = $id");

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
    $query = $base_datos->conectar()->prepare("DELETE FROM deposito "
            . " WHERE cod_deposito = $id");

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

    $query = $base_datos->conectar()->prepare("SELECT 
d.cod_deposito,
d.nombre_dep,
d.estado,
s.cod_sucursal,
s.nombre_sucur
FROM deposito d
join sucursal s
on s.cod_sucursal = d.cod_sucursal 
	WHERE d.cod_deposito = $id");

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
    $query = $base_datos->conectar()->prepare("UPDATE deposito
	SET
		nombre_dep= :nombre_dep,
		estado= :estado,
		cod_sucursal= :cod_sucursal
		
	WHERE cod_deposito = :cod_deposito");
    
    $query->execute($json_datos);
}

<?php

require_once '../conexion/db.php';

if (isset($_POST['leer_activo'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT cod_proveedor,
        nombre_apellido_prov, razon_social, ruc_prov, 
        telefono_prov, direccion_prov, cod_ciudad, estado
FROM proveedores
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
    $query = $base_datos->conectar()->prepare("SELECT p.cod_proveedor,
        p.nombre_apellido_prov, p.razon_social, p.ruc_prov, p.telefono_prov,
        p.direccion_prov, p.cod_ciudad, p.estado, c.descripcion  as ciudad
FROM proveedores p 
join ciudades c on c.cod_ciudad  = p.cod_proveedor 
");

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
    $query = $base_datos->conectar()->prepare("INSERT INTO proveedores
(nombre_apellido_prov, razon_social, ruc_prov, telefono_prov, 
direccion_prov, cod_ciudad, estado)
VALUES(:nombre_apellido_prov, :razon_social, :ruc_prov, :telefono_prov, 
:direccion_prov, :cod_ciudad, :estado);");

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
    $query = $base_datos->conectar()->prepare("UPDATE proveedores SET estado = 'INACTIVO'"
            . " WHERE cod_proveedor = $id");

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
    $query = $base_datos->conectar()->prepare("DELETE FROM proveedores "
            . " WHERE cod_proveedor = $id");

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

    $query = $base_datos->conectar()->prepare("SELECT cod_proveedor, nombre_apellido_prov,
        razon_social, ruc_prov, telefono_prov, direccion_prov, cod_ciudad, estado
FROM proveedores 
WHERE cod_proveedor =  $id");

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
    $query = $base_datos->conectar()->prepare("UPDATE proveedores
SET 
    nombre_apellido_prov=:nombre_apellido_prov,
    razon_social=:razon_social,
    ruc_prov=:ruc_prov, 
    telefono_prov=:telefono_prov, 
    direccion_prov=:direccion_prov, 
    cod_ciudad=:cod_ciudad, 
    estado=:estado
WHERE cod_proveedor=:cod_proveedor;");
    
    $query->execute($json_datos);
}

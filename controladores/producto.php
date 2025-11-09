<?php

require_once '../conexion/db.php';

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT cod_producto, nombre_prod, 
descripcion_prod, precio_prod, costo_prod, 
estado, cod_categoria, cod_tipo_prod, cod_marca
	FROM productos 
	estado = 'ACTIVO'");

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
    $query = $base_datos->conectar()->prepare("SELECT p.cod_producto, p.nombre_prod, 
p.descripcion_prod, p.precio_prod, p.costo_prod, 
p.estado, p.cod_categoria, p.cod_tipo_prod, p.cod_marca,
m.descripcion_marc,
tp.descripcion AS tipo_producto,
c.nombre_cat
	FROM productos p 
	JOIN marcas m 
	ON m.cod_marca =  p.cod_marca
	JOIN tipo_productos tp 
	ON tp.cod_tipo_prod =  p.cod_tipo_prod
	JOIN categorias c 
	ON c.cod_categoria =  p.cod_categoria ");

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
    $query = $base_datos->conectar()->prepare("INSERT INTO productos
	( nombre_prod, descripcion_prod, 
	precio_prod, costo_prod, estado, cod_categoria, 
	cod_tipo_prod, cod_marca)
	VALUES (:nombre_prod, :descripcion_prod, :precio_prod, :costo_prod, 
        :estado, :cod_categoria, :cod_tipo_prod, :cod_marca)");

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
    $query = $base_datos->conectar()->prepare("UPDATE productos SET estado = 'INACTIVO'"
            . " WHERE cod_producto = $id");

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
    $query = $base_datos->conectar()->prepare("DELETE FROM productos "
            . " WHERE cod_producto = $id");

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

    $query = $base_datos->conectar()->prepare("SELECT cod_producto, nombre_prod,
 descripcion_prod, precio_prod, 
 costo_prod, estado, cod_categoria,
  cod_tipo_prod, cod_marca
	FROM productos
	WHERE cod_producto = $id");

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
    $query = $base_datos->conectar()->prepare("UPDATE productos
	SET
		nombre_prod= :nombre_prod,
		descripcion_prod= :descripcion_prod,
		precio_prod= :precio_prod,
		costo_prod= :costo_prod,
		estado= :estado,
		cod_categoria= :cod_categoria,
		cod_tipo_prod= :cod_tipo_prod,
		cod_marca= :cod_marca
	WHERE cod_producto = :cod_producto");
    
    $query->execute($json_datos);
}



if (isset($_POST['leer_producto_activos'])) {
    leer_producto_activos();
}

function leer_producto_activos() {
//    $json_datos = json_decode($lista, true);
    $base_datos = new DB();

    $query = $base_datos->conectar()->prepare("SELECT cod_producto, nombre_prod, 
       descripcion_prod, precio_prod, costo_prod, 
       estado, cod_categoria, cod_tipo_prod, cod_marca
FROM productos
WHERE estado = 'ACTIVO';

");

    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
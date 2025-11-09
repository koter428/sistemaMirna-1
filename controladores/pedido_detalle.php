<?php

require_once '../conexion/db.php';
//aasda
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    //crea un arreglo del texto que se le pasa
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO `detalle_pedido_compra`(
     `cod_pedido_compra`, `cod_producto`,
      `cantidad`) 
    VALUES (:cod_pedido_compra , :cod_producto , :cantidad  )");

    $query->execute($json_datos);
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------

if(isset($_POST['leer'])){
    leer();
}

function leer(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
dpc.cod_pedido_compra,
dpc.cantidad,
m.nombre_material,
m.cod_material
FROM detalle_pedido_compra dpc
join materiales m 
on m.cod_material = dpc.cod_material");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
if(isset($_POST['id'])){
    id($_POST['id']);
}

function id($id){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("select 
        p.cod_producto as cod_material,
        p.costo_prod  as costo_material,
        p.nombre_prod  as nombre_material,
        tp.descripcion  as tipo_material,
        dpc.cantidad,
        dpc.cantidad * p.costo_prod as total
        from detalle_pedido_compra dpc 
        join productos p on p.cod_producto  =  dpc.cod_producto 
        join tipo_productos tp on tp.cod_tipo_prod = p.cod_tipo_prod 
        where dpc.cod_pedido_compra = $id");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
if(isset($_POST['id_cabecera'])){
    id_cabecera($_POST['id_cabecera']);
}

function id_cabecera($id){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
        dpc.cod_pedido_compra,
        dpc.cantidad,
        m.nombre_prod ,
        m.cod_producto ,
        tp.descripcion  as tipo
        FROM detalle_pedido_compra dpc
        join productos  m 
        on m.cod_producto = dpc.cod_producto 
        join tipo_productos tp on tp.cod_tipo_prod  =  m.cod_tipo_prod 
        WHERE dpc.cod_pedido_compra = $id");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------
if(isset($_POST['actualizar'])){
    actualizar($_POST['actualizar']);
}

function actualizar($lista){
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `detalle_pedido_compra`
     SET `cod_material`=:cod_material,`cantidad`=:cantidad,
     WHERE `cod_pedido_compra` = :cod_pedido_compra");

    $query->execute($json_datos);
}

if(isset($_POST['eliminar'])){
    eliminar($_POST['eliminar']);
}

function eliminar($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("DELETE FROM `detalle_pedido_compra` where cod_pedido_compra = $id");

    $query->execute();
}


if (isset($_POST["leer_descripcion_materiales"])) {
    
    leer_descripcion_materiales($_POST["leer_descripcion_materiales"]);
   }
   function leer_descripcion_materiales ($nombre_material){
       $base = new DB();
       $query = $base ->conectar()->prepare("SELECT 
dpc.cod_pedido_compra,
dpc.cantidad,
m.nombre_material,
m.cod_material
FROM detalle_pedido_compra dpc
join materiales m 
on m.cod_material = dpc.cod_material
WHERE CONCAT(cod_pedido_compra,' ', nombre_material) LIKE '%$nombre_material%'");
       $query ->execute ();
       
      if ($query->rowCount()) {
           print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
       } else {
           echo '0';
       }
   }
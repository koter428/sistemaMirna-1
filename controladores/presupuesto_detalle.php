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
    $query = $base_datos->conectar()->prepare("INSERT INTO detalle_presupuesto_com
(cod_producto, cod_presupuesto_compra, cantidad, costo)
VALUES(:cod_material, :cod_presupuesto_comp, :cantidad, :costo);");

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
    $query = $base_datos->conectar()->prepare("SELECT 
dpc.cod_presupuesto_compra as cod_presupuesto_comp,
dpc.cantidad,
dpc.costo ,
m.nombre_prod as nombre_material,
m.cod_producto as cod_material,
tm.descripcion  as tipo_material,
dpc.cantidad * dpc.costo  as total
FROM detalle_presupuesto_com   dpc
join productos  m 
on m.cod_producto = dpc.cod_producto 
join tipo_productos tm on tm.cod_tipo_prod = m.cod_tipo_prod 
WHERE dpc.cod_presupuesto_compra = $id ");
    
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
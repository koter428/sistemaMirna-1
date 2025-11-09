<?php

require_once '../conexion/db.php';
//aasda
if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    //crea un arreglo del texto que se le pasa
    session_start();
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("INSERT INTO detalle_compras
(cod_compra, cod_producto, cantidad, iva5, iva10, exenta, costo)
VALUES(:cod_compra, :cod_material, :cantidad, :iva5, :iva10, :exenta, :costo);");

    $query->execute($json_datos);
    

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
 m.cod_producto  as cod_material,
 m.nombre_prod  as nombre_material,
 m.impuesto,
 tm.descripcion  as tipo_material,
 dpc.cantidad ,
 dpc.costo,
 dpc.iva5 ,
 dpc.costo ,
 dpc.iva10,
 dpc.exenta 
 from detalle_compras   dpc 
 join productos  m ON m.cod_producto  = dpc.cod_producto 
 join tipo_productos  tm on tm.cod_tipo_prod  = m.cod_producto 
 where dpc.cod_compra = $id");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
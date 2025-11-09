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
    $query = $base_datos->conectar()->prepare("INSERT INTO detalle_nota_compra
(`cod_producto`, `cod_nota_compra`, `cantidad`, `iva5`, `iva10`, `exenta`, costo)
VALUES(:cod_material, :cod_nota_compra, :cantidad, :iva_5, :iva_10, :exenta, :costo);");

    $query->execute($json_datos);
    


}

//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------


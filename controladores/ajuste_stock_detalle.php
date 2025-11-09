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
    $query = $base_datos->conectar()->prepare("INSERT INTO detalle_ajuste_stock
(cod_ajuste_stock, cantidad_nueva, id_deposito, cod_producto)
VALUES(:cod_ajuste_stock, :cantidad_nueva, :id_deposito, :cod_material);");

    $query->execute($json_datos);
}

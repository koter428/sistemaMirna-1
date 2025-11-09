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
    $query = $base_datos->conectar()->prepare("INSERT INTO libro_compra
(id_libro_compra, cod_compra, iva5, iva10, fecha, exenta, total, grav5, grav10)
VALUES((SELECT COALESCE(MAX(c.id_libro_compra), 0) + 1 FROM libro_compra c), :cod_compra, 
:iva5, :iva10, :fecha, :exenta, :total, :grav5, :grav10);");

    $query->execute($json_datos);
    

}
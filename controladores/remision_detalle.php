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
    $query = $base_datos->conectar()->prepare("INSERT INTO detalle_remision
(cod_remision, cantidad, cod_producto, cantidad_factura)
VALUES(:cod_nota_remision, :cantidad, :cod_material, :cantidad_factura);");

    $query->execute($json_datos);
    

}


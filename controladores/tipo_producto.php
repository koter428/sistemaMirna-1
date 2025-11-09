<?php

require_once '../conexion/db.php';

if (isset($_POST['dame_activos'])) {
    dameActivos();
}

function dameActivos() {

    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT `cod_tipo_prod`, `descripcion`, `estado` 
FROM `tipo_productos` 
WHERE estado = 'ACTIVO'");

    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}


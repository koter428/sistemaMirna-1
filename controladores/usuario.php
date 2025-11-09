<?php
require_once '../conexion/db.php';

if(isset($_POST['leer_tecnicos'])){
    leer_tecnicos();
}

function leer_tecnicos(){
    $base_datos = new DB();
    try {
        $query = $base_datos->conectar()->prepare("SELECT cod_usuario, nom_apellido FROM usuarios WHERE estado = 'ACTIVO' AND rol = 'tecnico'");
        $query->execute();
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($datos)) {
            error_log("[leer_tecnicos] No se encontraron técnicos activos.");
        }
        echo json_encode($datos);
    } catch (Exception $e) {
        error_log("[leer_tecnicos] Error: " . $e->getMessage());
        echo json_encode([]);
    }
}
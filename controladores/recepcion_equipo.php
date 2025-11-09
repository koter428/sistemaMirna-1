<?php
require_once '../conexion/db.php';

if (isset($_POST['guardar'])) {
    guardar($_POST['guardar']);
}

function guardar($lista) {
    session_start();
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();

    // Validar que cod_tecnico y cod_cliente existen
    $validar_tecnico = $base_datos->conectar()->prepare("SELECT cod_usuario FROM usuarios WHERE cod_usuario = :cod_tecnico AND estado = 'ACTIVO'");
    $validar_tecnico->execute(['cod_tecnico' => $json_datos['cod_tecnico']]);
    if ($validar_tecnico->rowCount() === 0) {
        echo json_encode(['error' => 'El técnico seleccionado no es válido.']);
        return;
    }

    $validar_cliente = $base_datos->conectar()->prepare("SELECT cod_cliente FROM clientes WHERE cod_cliente = :cod_cliente AND estado = 'ACTIVO'");
    $validar_cliente->execute(['cod_cliente' => $json_datos['cod_cliente']]);
    if ($validar_cliente->rowCount() === 0) {
        echo json_encode(['error' => 'El cliente seleccionado no es válido.']);
        return;
    }

    // Insertar en la tabla recepcion_equipo
    $query = $base_datos->conectar()->prepare("INSERT INTO recepcion_equipo
    (cod_cliente, cod_tecnico, nro_serie, fecha_recepcion, 
    cod_estado, cod_sucursal, cod_usuario, estado)
    VALUES(:cod_cliente, :cod_tecnico, :nro_serie, :fecha_recepcion,
    :cod_estado, :cod_sucursal, ".$_SESSION['id_user'].", 'ACTIVO')");

    $query->execute($json_datos);

    // Obtener el último ID insertado
    $cod_recepcion = $base_datos->conectar()->lastInsertId();

    // Guardar detalles si existen
    if (isset($json_datos['detalles']) && is_array($json_datos['detalles'])) {
        foreach ($json_datos['detalles'] as $detalle) {
            $query_detalle = $base_datos->conectar()->prepare("INSERT INTO detalle_recepcion
            (cod_recepcion, cod_equipo, observacion, estado)
            VALUES(:cod_recepcion, :cod_equipo, :observacion, 'ACTIVO')");

            $query_detalle->execute([
                'cod_recepcion' => $cod_recepcion,
                'cod_equipo' => $detalle['cod_equipo'],
                'observacion' => $detalle['observacion']
            ]);
        }
    }
}

if(isset($_POST['leer_activo'])){
    leer_activo();
}

function leer_activo(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
        r.cod_recepcion,
        r.fecha_recepcion,
        r.nro_serie,
        r.estado,
        c.nombre_cliente,
        c.apellido_cliente,
        e.descripcion as estado_equipo,
        s.nombre_sucur as sucursal,
        u.nombre as usuario
    FROM recepcion_equipo r
    INNER JOIN clientes c ON r.cod_cliente = c.cod_cliente
    INNER JOIN estado e ON r.cod_estado = e.cod_estado
    INNER JOIN sucursal s ON r.cod_sucursal = s.cod_sucursal
    INNER JOIN usuarios u ON r.cod_usuario = u.cod_usuario
    WHERE r.estado = 'ACTIVO'
    ORDER BY r.cod_recepcion DESC");
    
    $query->execute();
    $datos = $query->fetchAll();
    echo json_encode($datos);
}

if(isset($_POST['buscar_por_id'])){
    buscar_por_id($_POST['buscar_por_id']);
}

function buscar_por_id($cod_recepcion){
    $base_datos = new DB();
    // Consulta principal
    $query = $base_datos->conectar()->prepare("SELECT 
        r.*,
        c.nombre_cliente,
        c.apellido_cliente,
        e.descripcion as estado_equipo,
        s.nombre_sucur as sucursal
    FROM recepcion_equipo r
    INNER JOIN clientes c ON r.cod_cliente = c.cod_cliente
    INNER JOIN estado e ON r.cod_estado = e.cod_estado
    INNER JOIN sucursal s ON r.cod_sucursal = s.cod_sucursal
    WHERE r.cod_recepcion = :cod_recepcion");
    
    $query->execute(['cod_recepcion' => $cod_recepcion]);
    $recepcion = $query->fetch(PDO::FETCH_ASSOC);
    
    // Consulta detalles
    $query_detalles = $base_datos->conectar()->prepare("SELECT 
        d.*,
        e.descripcion as equipo_descripcion
    FROM detalle_recepcion d
    INNER JOIN equipos e ON d.cod_equipo = e.cod_equipo
    WHERE d.cod_recepcion = :cod_recepcion");
    
    $query_detalles->execute(['cod_recepcion' => $cod_recepcion]);
    $detalles = $query_detalles->fetchAll(PDO::FETCH_ASSOC);
    
    $resultado = [
        'recepcion' => $recepcion,
        'detalles' => $detalles
    ];
    
    echo json_encode($resultado);
}

if(isset($_POST['anular'])){
    anular($_POST['anular']);
}

function anular($cod_recepcion){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE recepcion_equipo SET estado = 'ANULADO' WHERE cod_recepcion = :cod_recepcion");
    $query->execute(['cod_recepcion' => $cod_recepcion]);
    
    // También anular los detalles
    $query_detalles = $base_datos->conectar()->prepare("UPDATE detalle_recepcion SET estado = 'ANULADO' WHERE cod_recepcion = :cod_recepcion");
    $query_detalles->execute(['cod_recepcion' => $cod_recepcion]);
}

if(isset($_POST['ultimo_registro'])){
    ultimo_registro();
}

function ultimo_registro(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->query("SELECT MAX(cod_recepcion) as ultimo FROM recepcion_equipo");
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
}

if(isset($_POST['listar_estados'])){
    listar_estados();
}

function listar_estados(){
    $base_datos = new DB();
    try {
        $query = $base_datos->conectar()->prepare("SELECT cod_estado, descripcion FROM estado WHERE estado = 'ACTIVO'");
        $query->execute();
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($datos)) {
            error_log("[listar_estados] No se encontraron estados activos.");
        }
        echo json_encode($datos);
    } catch (Exception $e) {
        error_log("[listar_estados] Error: " . $e->getMessage());
        echo json_encode([]);
    }
}

if(isset($_POST['listar_equipos'])){
    listar_equipos();
}

function listar_equipos(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT cod_equipo, descripcion FROM equipos WHERE estado = 'ACTIVO'");
    $query->execute();
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
}
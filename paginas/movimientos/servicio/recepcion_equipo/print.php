<?php
require_once '../conexion/db.php';

$cod_recepcion = $_GET['cod_recepcion'];
$base_datos = new DB();

// Obtener datos de la recepción
$query = $base_datos->conectar()->prepare("SELECT 
    r.*,
    c.nombre_cliente,
    c.apellido_cliente,
    c.cedula_cliente,
    c.telefono_cliente,
    e.descripcion as estado_equipo,
    s.nombre_sucur as sucursal,
    u.nombre as usuario
FROM recepcion_equipo r
INNER JOIN clientes c ON r.cod_cliente = c.cod_cliente
INNER JOIN estado e ON r.cod_estado = e.cod_estado
INNER JOIN sucursal s ON r.cod_sucursal = s.cod_sucursal
INNER JOIN usuarios u ON r.cod_usuario = u.cod_usuario
WHERE r.cod_recepcion = :cod_recepcion");

$query->execute(['cod_recepcion' => $cod_recepcion]);
$recepcion = $query->fetch(PDO::FETCH_ASSOC);

// Obtener detalles
$query_detalles = $base_datos->conectar()->prepare("SELECT 
    d.*,
    e.descripcion as equipo_descripcion
FROM detalle_recepcion d
INNER JOIN equipos e ON d.cod_equipo = e.cod_equipo
WHERE d.cod_recepcion = :cod_recepcion");

$query_detalles->execute(['cod_recepcion' => $cod_recepcion]);
$detalles = $query_detalles->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recepción de Equipo #<?php echo $cod_recepcion; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info-cliente {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Comprobante de Recepción de Equipo</h2>
        <h3>N° <?php echo $cod_recepcion; ?></h3>
    </div>

    <div class="info-cliente">
        <p><strong>Fecha:</strong> <?php echo $recepcion['fecha_recepcion']; ?></p>
        <p><strong>Cliente:</strong> <?php echo $recepcion['nombre_cliente'] . ' ' . $recepcion['apellido_cliente']; ?></p>
        <p><strong>Cédula:</strong> <?php echo $recepcion['cedula_cliente']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $recepcion['telefono_cliente']; ?></p>
        <p><strong>N° Serie:</strong> <?php echo $recepcion['nro_serie']; ?></p>
        <p><strong>Estado:</strong> <?php echo $recepcion['estado_equipo']; ?></p>
        <p><strong>Sucursal:</strong> <?php echo $recepcion['sucursal']; ?></p>
    </div>

    <h4>Detalles del Equipo</h4>
    <table>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?php echo $detalle['equipo_descripcion']; ?></td>
                <td><?php echo $detalle['observacion']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>_____________________</p>
        <p>Firma del Cliente</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
<?php
require_once '../../../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare(" SELECT
LPAD(pc.cod_orden_compra , 7, '0') as nro,
pc.fecha_orden ,
pc.estado,
pv.razon_social_prov ,
pv.ruc_prov,
pv.nom_ape_prov,
pv.cod_proveedor,
u.nombre_apellido,
SUM(dp.cantidad * dp.costo) as total,
s.suc_descripcion 
from orden_compra pc
join proveedor pv 
on pv.cod_proveedor = pc.cod_proveedor 
join usuarios u 
on u.cod_usuario = pc.cod_usuario
join detalle_orden  dp 
on dp.cod_orden_compra  = pc.cod_orden_compra 
join sucursal s 
on s.id_sucursal  =  pc.id_sucursal 
where pc.cod_orden_compra =  :id
group by dp.cod_orden_compra 
order by  pc.cod_orden_compra  desc");

$detalle = $base_datos->conectar()->prepare("select 
 m.nombre_material ,
 tm.descripcion  as tipo_material,
 dpc.cantidad ,
 dpc.costo ,
 dpc.cantidad  * dpc.costo  as total
 from detalle_orden  dpc 
 join materiales m ON m.cod_material  = dpc.cod_material 
 join tipo_material tm on tm.cod_tipo_material  = m.cod_tipo_material 
 where dpc.cod_orden_compra =:id");

$query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$detalle->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$query->execute();
$detalle->execute();
$arreglo = $query->fetch(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Orden de Compra</title>
        <link href="../../../../assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
        <style>
            @media print {
                .no-print {
                    display: none;
                }
                .print-only {
                    display: block;
                }
                body {
                    font-size: 12pt;
                    margin: 0;
                }
                .container {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                }
            }
            body {
                margin: 20px;
                font-family: Arial, sans-serif;
                background-color: #fff;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .header img {
                width: 80%;
                margin-bottom: 20px;
            }
            .header h3 {
                font-weight: bold;
            }
            .table th, .table td {
                vertical-align: middle;
                text-align: center;
            }
            .table tfoot {
                font-weight: bold;
                font-size: 18px;
            }
            .total-general {
                text-align: right;
                font-size: 24px;
                margin-top: 20px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="../../../../img/membrete.png" alt="Membrete">
                <h3>Orden de Compra</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <label>Nro de Presupuesto:</label>
                    <span><?= $arreglo->nro ?></span>
                </div>
               
                <div class="col-md-3 text-right">
                    <label>Fecha:</label>
                    <span><?= $arreglo->fecha_orden ?></span>
                </div>
                <div class="col-md-3 ">
                    <label>Proveedor:</label>
                    <span><?= $arreglo->razon_social_prov ?></span>
                </div>
                <div class="col-md-3 ">
                    <label>Ruc:</label>
                    <span><?= $arreglo->ruc_prov ?></span>
                </div>
            </div>
            
            <hr>
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Descripcion</th>
                            <th>Tipo Material</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       $total = 0;
                        if ($detalle->rowCount()) {
                            foreach ($detalle as $fila) {
                                
                                ?>
                                <tr>
                                    <td><?= $fila['nombre_material'] ?></td>
                                    <td><?= $fila['tipo_material'] ?></td>
                                    <td><?= number_format($fila['cantidad'], 0, ',', '.') ?></td>
                                    <td><?= number_format($fila['costo'], 0, ',', '.') ?></td>
                                    <td><?= number_format($fila['total'], 0, ',', '.') ?></td>
                                </tr>

                                <?php
                               $total += intval($fila['total']);
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align: left;">Total</th>
                            <th><?=number_format($total, 0, ',', '.')?></th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>
        
        <script src="../../../../assets/plugins/bootstrap/bootstrap.min.js"></script>
        <script>
            window.print();
        </script>
    </body>
</html>

<?php
require_once '../../../../conexion/db.php';

$base_datos = new DB();
$query = $base_datos->conectar()->prepare("  
  select 
 c.cod_compra ,
 c.fecha_compra ,
  c.estado ,
 c.condicion ,
 c.nro_factura,
 sum(dc.iva5 + dc.iva10 + dc.exenta) as total,
 p.razon_social  as razon_social_prov,
 s.nombre_sucur  as suc_descripcion,
 c.timbrado ,
 p.ruc_prov,
 c.fecha_venc_timbrado 
 from compras  c  
 join detalle_compras  dc on dc.cod_compra  = c.cod_compra 
 join proveedores  p on p.cod_proveedor  = c.cod_proveedor 
 join sucursal  s on s.cod_sucursal  =  c.cod_sucursal 
 where c.cod_compra = :id
 group by c.cod_compra 
 order by  c.cod_compra  desc");

$detalle = $base_datos->conectar()->prepare(" select 
 m.nombre_prod  as nombre_material,
 tm.descripcion  as tipo_material,
 dpc.cantidad ,
 dpc.iva5 ,
 dpc.costo ,
 dpc.iva10,
 dpc.exenta 
 from detalle_compras  dpc 
 join productos  m ON m.cod_producto  = dpc.cod_producto 
 join tipo_productos  tm on tm.cod_tipo_prod  = m.cod_tipo_prod  
 where dpc.cod_compra =  :id");

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
        <title>Factura de Compra</title>
       <link href="../../../../assets/bootstrap/bootstrap.min.css" rel="stylesheet">
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
            <table class="table">
                <style>
                    br{
                         display: block;
                        margin-top: 2px; /* Ajusta el espacio encima */
                        margin-bottom: 2px; /* Ajusta el espacio debajo */
                    }
                </style>
                <thead>
                    <tr>
                        <th style="width: 60%;"><img style="width: 100%;" src="../../../../assets/images/membrete.png" alt="Membrete"></th>
                        <th style="width: 40%;">
                            <span style="text-align: center; font-size: 11px; line-height: 0;"> Timbrado <br>
                                <?= $arreglo->timbrado ?> 
                                Fecha Vencimiento <br>
                                <?= $arreglo->fecha_venc_timbrado ?> <br></span>
                            <span style="font-size: 20px;"> Nro Factura <br>
                                <?= $arreglo->nro_factura ?></span>


                        </th>
                    </tr>
                </thead>
            </table>

            <hr>
            <div class="row">
                
                <div class="col-md-3">
                    <label>Fecha:</label>
                    <span><?= $arreglo->fecha_compra ?></span>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-5 ">
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
                            <th>Exenta</th>
                            <th>I.V.A. 5%</th>
                            <th>I.V.A. 10%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $totalexenta = 0;
                        $totaliva5 = 0;
                        $totaliva10 = 0;
                        if ($detalle->rowCount()) {
                            foreach ($detalle as $fila) {
                                $totalexenta += intval($fila['exenta']);
                                $totaliva5 += intval($fila['iva5']);
                                $totaliva10 += intval($fila['iva10']);
                                $total += intval($fila['iva10']) + intval($fila['iva5']) + intval($fila['exenta']);
                                
                                ?>
                                <tr>
                                    <td><?= $fila['nombre_material'] ?></td>
                                    <td><?= $fila['tipo_material'] ?></td>
                                    <td><?= number_format($fila['cantidad'], 0, ',', '.') ?></td>
                                    <td><?= number_format($fila['costo'], 0, ',', '.') ?></td>
                                    <td><?= number_format($fila['exenta'], 0, ',', '.') ?></td>
                                    <td><?= number_format($fila['iva5'], 0, ',', '.') ?></td>
                                    <td><?= number_format($fila['iva10'], 0, ',', '.') ?></td>
                                </tr>

                                <?php
                               
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align: left;">Total</th>
                            <th><?= number_format($totalexenta, 0, ',', '.') ?></th>
                            <th><?= number_format($totaliva5, 0, ',', '.') ?></th>
                            <th><?= number_format($totaliva10, 0, ',', '.') ?></th>
                        </tr>
                        <tr style="font-size: 12px;">
                            <th colspan="2" style="text-align: left;">Impuestos</th>
                            <th colspan="2" >I.V.A. 5% (<?= number_format(round($totaliva5 / 21), 0, ',', '.')  ?>) </th>
                            <th colspan="2"> I.V.A. 10% (<?= number_format(round($totaliva10 / 11), 0, ',', '.') ?>) </th>
                            <th > TOTAL I.V.A. (<?= number_format(round($totaliva10 / 11) + round($totaliva5 / 21), 0, ',', '.') ?>) </th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>

        <script src="../../../../assets/bootstrap/bootstrap.min.js"></script>
        <script>
            window.print();
        </script>
    </body>
</html>

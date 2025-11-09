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
    $query = $base_datos->conectar()->prepare("INSERT INTO detalle_orden
(cod_orden_compra, cod_producto, cantidad, costo)
VALUES(:cod_orden_compra, :cod_material, :cantidad, :costo);");

    $query->execute($json_datos);
}

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------
 if(isset($_POST['id'])){
     id($_POST['id']);
 }

 function id($id){
     $base_datos = new DB();
     $query = $base_datos->conectar()->prepare("select
         m.cod_producto AS cod_material,
 m.nombre_prod as nombre_material ,
 tm.descripcion  as tipo_material,
 dpc.cantidad ,
 dpc.costo ,
 dpc.cantidad  * dpc.costo  as total,
 if(m.impuesto = 10, dpc.cantidad  * dpc.costo, 0) as iva10,
        if(m.impuesto = 5, dpc.cantidad  * dpc.costo, 0) as iva5,
        if(m.impuesto = 0, dpc.cantidad  * dpc.costo, 0) as exenta
 from detalle_orden  dpc 
 join productos  m ON m.cod_producto  = dpc.cod_producto 
 join tipo_productos tm on tm.cod_tipo_prod  = m.cod_tipo_prod 
 where dpc.cod_orden_compra  = $id ");
    
     $query->execute();

     if ($query->rowCount()) {
         print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
     } else {
         echo '0';
     }
 }

// //----------------------------------------------------------------
// //----------------------------------------------------------------
// //----------------------------------------------------------------
// if(isset($_POST['actualizar'])){
//     actualizar($_POST['actualizar']);
// }

// function actualizar($lista){
//     $json_datos = json_decode($lista, true);
//     $base_datos = new DB();
//     $query = $base_datos->conectar()->prepare("UPDATE `orden_compra`
//      SET `fecha_orden`=:fecha_orden,`estado`=:estado ,`cod_presupuesto_comp`=:cod_presupuesto_comp ,
//      `cod_proveedor`=:cod_proveedor , `cod_usuario`=:cod_usuario, `id_sucursal` = :id_sucursal
//      WHERE `cod_orden_compra`=:cod_orden_compra,");

//     $query->execute($json_datos);
// }

// if(isset($_POST['eliminar'])){
//     eliminar($_POST['eliminar']);
// }

// function eliminar($id){
   
//     $base_datos = new DB();
//     $query = $base_datos->conectar()->prepare("DELETE FROM `orden_compra` where cod_orden_compra = $id");

//     $query->execute();
// }


// if (isset($_POST["leer_descripcion_materiales"])) {
    
//     leer_descripcion_materiales($_POST["leer_descripcion_materiales"]);
//    }
//    function leer_descripcion_materiales ($nombre_apellido){
//        $base = new DB();
//        $query = $base ->conectar()->prepare("SELECT 
// pc.cod_pedido_compra,
// pc.fecha_pedido,
// pc.estado,
// u.nombre_apellido,
// u.cod_usuario,
// s.suc_descripcion,
// s.id_sucursal
// from pedido_compra pc
// join usuarios u 
// on u.cod_usuario = pc.cod_usuario 
// JOIN sucursal s 
// on s.id_sucursal = pc.id_sucursal
// WHERE CONCAT(cod_pedido_compra,' ', nombre_apellido) LIKE '%$nombre_apellido%'");
//        $query ->execute ();
       
//       if ($query->rowCount()) {
//            print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
//        } else {
//            echo '0';
//        }
//    }
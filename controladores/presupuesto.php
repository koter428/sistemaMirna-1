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
    $query = $base_datos->conectar()->prepare("INSERT INTO `presupuesto_compra`
    (`cod_presupuesto_compra`, `fecha_presu`, 
    `fecha_vencimiento`, `estado`, `cod_pedido_compra`, `cod_proveedor`, 
     `cod_usuario`, cod_sucursal)
     VALUES (:cod_presupuesto_comp, :fecha_presu,
     :fecha_vencimiento, :estado, :cod_pedido_compra,
     :cod_proveedor, ".$_SESSION['cod_usuario'].", :cod_sucursal);");

    $query->execute($json_datos);
    
     $query2 = $base_datos->conectar()->prepare("UPDATE pedido_compra SET estado = 'PRESUPUESTADO'"
             . " WHERE cod_pedido_compra = :id_pedido ");

     $query2->execute([
         'id_pedido' => $json_datos['cod_pedido_compra']
     ]);
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------

if(isset($_POST['leer'])){
    leer();
}

function leer(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
pc.cod_presupuesto_compra as cod_presupuesto_comp,
pc.fecha_presu,
pc.fecha_vencimiento,
pc.estado,
pv.razon_social as nom_ape_prov,
pv.cod_proveedor,
u.nom_apellido as nombre_apellido,
SUM(dp.cantidad * dp.costo) as total,
s.nombre_sucur as suc_descripcion 
from presupuesto_compra pc
join proveedores  pv 
on pv.cod_proveedor = pc.cod_proveedor
join usuarios u 
on u.cod_usuario = pc.cod_usuario
join detalle_presupuesto_com  dp 
on dp.cod_presupuesto_compra  = pc.cod_presupuesto_compra 
join sucursal s 
on s.cod_sucursal  =  pc.cod_sucursal 
group by dp.cod_presupuesto_compra 
order by  pc.cod_presupuesto_compra  desc 
");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------

if(isset($_POST['ultimo_registro'])){
    ultimo_registro();
}

function ultimo_registro(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
pc.cod_presupuesto_compra
from presupuesto_compra pc
order by pc.cod_presupuesto_compra DESC limit 1");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetch(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------
if(isset($_POST['id'])){
    id($_POST['id']);
}

function id($id){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
pc.cod_presupuesto_compra as cod_presupuesto_comp,
pc.fecha_presu,
pc.fecha_vencimiento,
pc.estado,
pv.razon_social as nom_ape_prov,
pv.cod_proveedor,
pdc.cod_pedido_compra,
u.nom_apellido as nombre_apellido
from presupuesto_compra pc
join pedido_compra pdc
on pdc.cod_pedido_compra = pc.cod_pedido_compra
join proveedores  pv 
on pv.cod_proveedor = pc.cod_proveedor
join usuarios u 
on u.cod_usuario = pc.cod_usuario
 WHERE pc.cod_presupuesto_compra = $id ");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetch(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}

//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------
if(isset($_POST['actualizar'])){
    actualizar($_POST['actualizar']);
}

function actualizar($lista){
    $json_datos = json_decode($lista, true);
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `presupuesto_compra`
     SET `fecha_presu`=:fecha_presu,
     `fecha_vencimiento`=:fecha_vencimiento,`estado`=:estado ,`cod_pedido_compra`=:cod_pedido_compra ,
     `cod_proveedor`=:cod_proveedor , `estado`=:estado
     WHERE `cod_presupuesto_comp` = :cod_presupuesto_comp");

    $query->execute($json_datos);
}

if(isset($_POST['eliminar'])){
    eliminar($_POST['eliminar']);
}

function eliminar($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("DELETE FROM `presupuesto_compra` where cod_presupuesto_comp = $id");

    $query->execute();
}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
if(isset($_POST['anular'])){
    anular($_POST['anular']);
}

function anular($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE  `presupuesto_compra` SET estado = 'ANULADO'"
            . " where cod_presupuesto_compra = $id");

    $query->execute();
}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
if(isset($_POST['aprobar'])){
    aprobar($_POST['aprobar']);
}

function aprobar($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE  `presupuesto_compra` SET estado = 'APROBADO'"
            . " where cod_presupuesto_compra = $id");

    $query->execute();
}


if (isset($_POST["leer_descripcion_materiales"])) {
    
    leer_descripcion_materiales($_POST["leer_descripcion_materiales"]);
   }
   function leer_descripcion_materiales ($nombre_apellido){
       $base = new DB();
       $query = $base ->conectar()->prepare("SELECT 
pc.cod_pedido_compra,
pc.fecha_pedido,
pc.estado,
u.nombre_apellido,
u.cod_usuario,
s.suc_descripcion,
s.id_sucursal
from pedido_compra pc
join usuarios u 
on u.cod_usuario = pc.cod_usuario 
JOIN sucursal s 
on s.id_sucursal = pc.id_sucursal
WHERE CONCAT(cod_pedido_compra,' ', nombre_apellido) LIKE '%$nombre_apellido%'");
       $query ->execute ();
       
      if ($query->rowCount()) {
           print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
       } else {
           echo '0';
       }
   }
   
   if(isset($_POST['presupuesto_pendientes'])){
    presupuesto_pendientes();
}

function presupuesto_pendientes(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT
pc.cod_presupuesto_compra as cod_presupuesto_comp,
pc.fecha_presu,
pc.fecha_vencimiento,
pc.estado,
pv.razon_social as nom_ape_prov,
pv.cod_proveedor as cod_proveedor,
u.nom_apellido as nombre_apellido,
SUM(dp.cantidad * dp.costo) as total
from presupuesto_compra pc
join proveedores  pv 
on pv.cod_proveedor = pc.cod_proveedor
join usuarios u 
on u.cod_usuario = pc.cod_usuario
join detalle_presupuesto_com  dp 
on dp.cod_presupuesto_compra  = pc.cod_presupuesto_compra 
WHERE pc.estado = 'APROBADO'
group  by pc.cod_presupuesto_compra 
");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
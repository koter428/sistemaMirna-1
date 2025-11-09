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
    $query = $base_datos->conectar()->prepare("INSERT INTO compras
(cod_compra, fecha_compra, condicion, timbrado, 
fecha_venc_timbrado, nro_factura, cod_proveedor, cod_orden_compra, cod_deposito, cod_sucursal, cod_usuario, cod_tipo_pago)
VALUES(:cod_compra, :fecha_compra, :condicion, :timbrado, :fecha_venc_timbrado, 
:nro_factura, :cod_proveedor, :cod_orden_compra, :cod_deposito, :id_sucursal, ".$_SESSION['id_user'].", :cod_tipo_pago);");

    $query->execute($json_datos);
    
    
//    $query2 = $base_datos->conectar()->prepare("UPDATE orden_compra set 
//        estado = 'UTILIZADO' 
//        WHERE cod_orden_compra = :cod");
//
//    $query2->execute([
//        'cod' => $json_datos['cod_orden_compra']
//    ]);
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------

if(isset($_POST['leer_activo'])){
    leer_activo();
}

function leer_activo(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("   select 
 c.cod_compra ,
 c.fecha_compra ,
  c.estado ,
 c.condicion ,
 c.nro_factura,
 sum(dc.iva5 + dc.iva10 + dc.exenta) as total,
 p.razon_social  as razon_social_prov,
 s.nombre_sucur  as suc_descripcion
 from compras  c  
 join detalle_compras  dc on dc.cod_compra  = c.cod_compra 
 join proveedores  p on p.cod_proveedor  = c.cod_proveedor 
 join sucursal  s on s.cod_sucursal  =  c.cod_sucursal 
 WHERE c.estado = 'ACTIVO'
 group by c.cod_compra 
 order by  c.cod_compra  desc
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

if(isset($_POST['leer_activo_remision'])){
    leer_activo_remision();
}

function leer_activo_remision(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(" select 
 c.cod_compra ,
 c.fecha_compra ,
  c.estado ,
 c.condicion ,
 c.nro_factura,
 sum(dc.iva5 + dc.iva10 + dc.exenta) as total,
 p.razon_social  as razon_social_prov,
 s.nombre_sucur  as suc_descripcion
 from compras  c  
 join detalle_compras  dc on dc.cod_compra  = c.cod_compra 
 join proveedores  p on p.cod_proveedor  = c.cod_proveedor 
 join sucursal  s on s.cod_sucursal  =  c.cod_sucursal 
 WHERE c.estado = 'ACTIVO' and c.cod_compra not in (select nr.cod_compra from nota_remision nr where nr.estado = 'ACTIVO')
 group by c.cod_compra 
 order by  c.cod_compra  desc 
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
if(isset($_POST['leer'])){
    leer();
}

function leer(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("  select 
 c.cod_compra ,
 c.fecha_compra ,
  c.estado ,
 c.condicion ,
 c.nro_factura,
 sum(dc.iva5 + dc.iva10 + dc.exenta) as total,
 p.razon_social  as razon_social_prov,
 s.nombre_sucur  as suc_descripcion
 from compras  c  
 join detalle_compras  dc on dc.cod_compra  = c.cod_compra 
 join proveedores  p on p.cod_proveedor  = c.cod_proveedor 
 join sucursal  s on s.cod_sucursal  =  c.cod_sucursal 
 group by c.cod_compra 
 order by  c.cod_compra  desc 
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
oc.cod_compra
FROM compras oc
order by oc.cod_compra DESC limit 1");
    
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
    $query = $base_datos->conectar()->prepare("  select 
 c.cod_compra ,
 c.fecha_compra ,
  c.estado ,
 c.condicion ,
 c.nro_factura,
 sum(dc.iva5 + dc.iva10 + dc.exenta) as total,
 p.razon_social  as razon_social_prov,
 s.nombre_sucur  as suc_descripcion
 from compras  c  
 join detalle_compras  dc on dc.cod_compra  = c.cod_compra 
 join proveedores  p on p.cod_proveedor  = c.cod_proveedor 
 join sucursal  s on s.cod_sucursal  =  c.cod_sucursal 
 where c.cod_compra = $id
 group by c.cod_compra 
 order by  c.cod_compra  desc");
    
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
    $query = $base_datos->conectar()->prepare("UPDATE `orden_compra`
     SET `fecha_orden`=:fecha_orden,`estado`=:estado ,`cod_presupuesto_comp`=:cod_presupuesto_comp ,
     `cod_proveedor`=:cod_proveedor , `cod_usuario`=:cod_usuario, `id_sucursal` = :id_sucursal
     WHERE `cod_orden_compra`=:cod_orden_compra,");

    $query->execute($json_datos);
}

if(isset($_POST['eliminar'])){
    eliminar($_POST['eliminar']);
}

function eliminar($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("DELETE FROM `orden_compra` where cod_orden_compra = $id");

    $query->execute();
}

if(isset($_POST['anular'])){
    anular($_POST['anular']);
}

function anular($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `compras` set estado = 'ANULADO' where cod_compra = $id");

    $query->execute();
}


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
    $query = $base_datos->conectar()->prepare("INSERT INTO `orden_compra`
    (`cod_orden_compra`, `fecha_orden`, `estado`,
     `cod_presupuesto_compra`, `cod_proveedor`, `cod_usuario`,
      `cod_sucursal`) VALUES (:cod_orden_compra, :fecha_orden, :estado, 
      :cod_presupuesto_comp, :cod_proveedor, ".$_SESSION['cod_usuario'].",
       :id_sucursal) ");

    $query->execute($json_datos);
    
    
    $query2 = $base_datos->conectar()->prepare("UPDATE presupuesto_compra set 
        estado = 'ORDEN COMPRA' 
        WHERE cod_presupuesto_compra = :cod_presupuesto_comp");

    $query2->execute([
        'cod_presupuesto_comp' => $json_datos['cod_presupuesto_comp']
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
oc.cod_orden_compra,
oc.fecha_orden,
oc.estado,
pvc.razon_social as nom_ape_prov,
u.nom_apellido as nombre_apellido,
s.nombre_sucur as suc_descripcion,
SUM(do.cantidad * do.costo) as total
FROM orden_compra oc
join detalle_orden do 
on do.cod_orden_compra  = oc.cod_orden_compra 
join proveedores  pvc
on pvc.cod_proveedor = oc.cod_proveedor
join usuarios u 
on u.cod_usuario = oc.cod_usuario
join sucursal  s 
on s.cod_sucursal = oc.cod_sucursal 
group by oc.cod_orden_compra
order by  oc.cod_orden_compra  desc  
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
oc.cod_orden_compra
FROM orden_compra oc
order by oc.cod_orden_compra DESC limit 1");
    
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
oc.cod_orden_compra,
oc.fecha_orden,
oc.estado,
pvc.cod_proveedor,
pvc.razon_social as nom_ape_prov,
u.nom_apellido as nombre_apellido,
s.nombre_sucur as suc_descripcion,
SUM(do.cantidad * do.costo) as total
FROM orden_compra oc
join detalle_orden do 
on do.cod_orden_compra  = oc.cod_orden_compra 
join proveedores  pvc
on pvc.cod_proveedor = oc.cod_proveedor
join usuarios u 
on u.cod_usuario = oc.cod_usuario
join sucursal  s 
on s.cod_sucursal = oc.cod_orden_compra   
 WHERE oc.cod_orden_compra  = $id ");
    
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
    $query = $base_datos->conectar()->prepare("UPDATE `orden_compra`"
            . " set estado = 'ANULADO' where cod_orden_compra = $id");

    $query->execute();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
if(isset($_POST['aprobar'])){
    aprobar($_POST['aprobar']);
}

function aprobar($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE `orden_compra`"
            . " set estado = 'APROBADO' where cod_orden_compra = $id");

    $query->execute();
}



if(isset($_POST['pendientes'])){
    Orden_pendientes();
}
function Orden_pendientes(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
oc.cod_orden_compra,
oc.fecha_orden,
oc.estado,
pvc.razon_social as nom_ape_prov,
u.nom_apellido as nombre_apellido,
s.nombre_sucur as suc_descripcion,
SUM(do.cantidad * do.costo) as total
FROM orden_compra oc
join detalle_orden do 
on do.cod_orden_compra  = oc.cod_orden_compra 
join proveedores  pvc
on pvc.cod_proveedor = oc.cod_proveedor
join usuarios u 
on u.cod_usuario = oc.cod_usuario
join sucursal  s 
on s.cod_sucursal = oc.cod_orden_compra
where oc.estado = 'PENDIENTE'
group by oc.cod_orden_compra
order by  oc.cod_orden_compra  desc  
");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}


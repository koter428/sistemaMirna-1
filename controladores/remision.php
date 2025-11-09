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
    $query = $base_datos->conectar()->prepare("INSERT INTO nota_remision
(cod_remision, fecha_remision, nro_nota, timbrado,
fecha_venc, motivo, punto_salida, punto_llegada, chofer, estado,
cod_compra, cod_usuario, cod_vehi, cod_sucursal)
VALUES(:cod_nota_remision, :fecha_registro, :nro_nota, :timbrado, :vencimiento, 
:motivo, :punto_salida, :punto_llegada, :chofer, :estado, :cod_compra, ".$_SESSION['id_user'].", :cod_vehiculo, :cod_sucursal);");

    $query->execute($json_datos);
}
//aasda
if (isset($_POST['anular'])) {
    anular($_POST['anular']);
}

function anular($id) {
    //crea un arreglo del texto que se le pasa
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("UPDATE  nota_remision SET
estado = 'ANULADO' 
WHERE cod_remision = $id");

    $query->execute();
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------

if(isset($_POST['leer'])){
    leer();
}

function leer(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare(" select 
nr.cod_remision  as cod_nota_remision,
nr.fecha_remision  as fecha_registro,
nr.nro_nota ,
p.razon_social as razon_social_prov,
nr.estado ,
nr.punto_salida ,
nr.punto_llegada ,
nr.motivo ,
nr.chofer  as nom_ape
from nota_remision nr 
join compras c on c.cod_compra  = nr.cod_compra 
join proveedores  p on p.cod_proveedor  = c.cod_compra 
order by nr.cod_remision  desc 
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
    $query = $base_datos->conectar()->prepare("SELECT cod_remision
FROM nota_remision 
ORDER BY cod_remision DESC LIMIT 1");
    
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
 WHERE cod_pedido_compra  = $id ");
    
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
    $query = $base_datos->conectar()->prepare("UPDATE `pedido_compra`
     SET `fecha_pedido`=:fecha_pedido,`estado`=:estado,
     `cod_usuario`=:cod_usuario,`id_sucursal`=:id_sucursal
     WHERE `cod_pedido_compra` = :cod_pedido_compra");

    $query->execute($json_datos);
}

if(isset($_POST['eliminar'])){
    eliminar($_POST['eliminar']);
}

function eliminar($id){
   
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("DELETE FROM `pedido_compra` where cod_pedido_compra = $id");

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

   if (isset($_POST['leer_pedidos_activos'])) {
    $stmt = $pdo->prepare("SELECT 
            pc.cod_pedido_compra,
            DATE_FORMAT(pc.fecha_pedido, '%d/%m/%Y') AS fecha_pedido,
            pc.estado,
            u.nombre_apellido,
            u.cod_usuario,
            s.suc_descripcion,
            s.id_sucursal
        FROM 
            pedido_compra pc
        JOIN 
            usuarios u ON u.cod_usuario = pc.cod_usuario
        JOIN 
            sucursal s ON s.id_sucursal = pc.id_sucursal
    ");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------

if(isset($_POST['pedidos_pendientes'])){
    pedidos_pendientes();
}

function pedidos_pendientes(){
    $base_datos = new DB();
    $query = $base_datos->conectar()->prepare("SELECT 
    pc.cod_pedido_compra,
    DATE_FORMAT(pc.fecha_pedido, '%d/%m/%Y') AS fecha_pedido,
    pc.estado,
    u.nombre_apellido,
    u.cod_usuario,
    s.suc_descripcion,
    s.id_sucursal
FROM 
    pedido_compra pc
JOIN 
    usuarios u 
ON 
    u.cod_usuario = pc.cod_usuario 
JOIN 
    sucursal s 
ON 
    s.id_sucursal = pc.id_sucursal
    WHERE pc.estado = 'PENDIENTE'

");
    
    $query->execute();

    if ($query->rowCount()) {
        print_r(json_encode($query->fetchAll(PDO::FETCH_OBJ)));
    } else {
        echo '0';
    }
}
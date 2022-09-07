<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_detallePedido.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$idPedido = $_POST['idPedido'];
$articulo = $_POST['txtArticulo'];
$color = $_POST['txtColor'];
$rollos = $_POST['txtRollos'];
$rib = $_POST['txtRib'];
$malla = $_POST['txtMalla'];
$ancho = $_POST['txtAncho'];
$precio = $_POST['txtPrecio'];
$fecha = $_POST['txtFecha'];



$sentencia = $bd->prepare("UPDATE detalle_pedido SET id_pedido=?,id_articulo=?,id_color=?,cantidad_rollos_art=?,cantidad_rollos_rib=?,long_malla=?,ancho=?,precio_kg=?,fecha_entrega=? where id_detalle=?;");
$resultado = $sentencia->execute([$idPedido,$articulo,$color,$rollos,$rib,$malla,$ancho,$precio,$fecha,$codigo]);

if ($resultado===true) {
    header('Location: listar_detallePedido.php?mensaje=editado');
} else {
    header('Location: listar_detallePedido.php?mensaje=error');
    exit();
}

?>
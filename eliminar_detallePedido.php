<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_detallePedido.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from detalle_pedido where id_detalle=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_detallePedido.php?mensaje=eliminado');
} else {
    header('Location: listar_detallePedido.php?mensaje=error');
}

?>
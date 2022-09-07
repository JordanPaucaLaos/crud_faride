<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_pedido.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from pedido where id_pedido=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_pedido.php?mensaje=eliminado');
} else {
    header('Location: listar_pedido.php?mensaje=error');
}

?>
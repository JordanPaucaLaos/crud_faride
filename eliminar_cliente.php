<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_cliente.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from cliente where id_cliente=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_cliente.php?mensaje=eliminado');
} else {
    header('Location: listar_cliente.php?mensaje=error');
}

?>
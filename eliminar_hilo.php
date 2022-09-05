<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_hilo.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from hilo where id_hilo=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_hilo.php?mensaje=eliminado');
} else {
    header('Location: listar_hilo.php?mensaje=error');
}

?>
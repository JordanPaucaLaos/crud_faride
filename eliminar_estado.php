<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_estado.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from estado where id_estado=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_estado.php?mensaje=eliminado');
} else {
    header('Location: listar_estado.php?mensaje=error');
}

?>
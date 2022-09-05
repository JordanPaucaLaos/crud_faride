<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_tipo_insumo.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from tipo_insumo where id_tipo_insumo=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_tipo_insumo.php?mensaje=eliminado');
} else {
    header('Location: listar_tipo_insumo.php?mensaje=error');
}

?>
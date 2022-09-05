<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_insumo.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from insumos where id_insumo=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_insumo.php?mensaje=eliminado');
} else {
    header('Location: listar_insumo.php?mensaje=error');
}

?>
<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_proveedor.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from proveedor where id_proveedor=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_proveedor.php?mensaje=eliminado');
} else {
    header('Location: listar_proveedor.php?mensaje=error');
}

?>
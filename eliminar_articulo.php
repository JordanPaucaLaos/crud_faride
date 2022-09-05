<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_articulo.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from articulo where id_articulo=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_articulo.php?mensaje=eliminado');
} else {
    header('Location: listar_articulo.php?mensaje=error');
}

?>
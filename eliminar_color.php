<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_color.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from color where id_color=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: listar_color.php?mensaje=eliminado');
} else {
    header('Location: listar_color.php?mensaje=error');
}

?>
<?php
if(!isset($_GET['codigo'])){
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("DELETE from empleado where id_empleado=?;");
$resultado = $sentencia->execute([$codigo]);

if ($resultado===true) {
    header('Location: index.php?mensaje=eliminado');
} else {
    header('Location: index.php?mensaje=error');
}

?>
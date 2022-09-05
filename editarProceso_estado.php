<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_estado.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$nombres = $_POST['txtNombre'];


$sentencia = $bd->prepare("UPDATE estado SET desc_estado=? where id_estado=?;");
$resultado = $sentencia->execute([$nombres,$codigo]);

if ($resultado===true) {
    header('Location: listar_estado.php?mensaje=editado');
} else {
    header('Location: listar_estado.php?mensaje=error');
    exit();
}
 
?>
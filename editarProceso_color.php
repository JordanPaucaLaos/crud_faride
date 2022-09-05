<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_color.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$nombres = $_POST['txtNombre'];


$sentencia = $bd->prepare("UPDATE color SET descripcion=? where id_color=?;");
$resultado = $sentencia->execute([$nombres,$codigo]);

if ($resultado===true) {
    header('Location: listar_color.php?mensaje=editado');
} else {
    header('Location: listar_color.php?mensaje=error');
    exit();
}

?>
<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_hilo.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$nombres = $_POST['txtNombre'];


$sentencia = $bd->prepare("UPDATE hilo SET desc_hilo=? where id_hilo=?;");
$resultado = $sentencia->execute([$nombres,$codigo]);

if ($resultado===true) {
    header('Location: listar_hilo.php?mensaje=editado');
} else {
    header('Location: listar_hilo.php?mensaje=error');
    exit();
}
 
?>
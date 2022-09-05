<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_tipo_insumo.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$nombres = $_POST['txtNombre'];


$sentencia = $bd->prepare("UPDATE tipo_insumo SET desc_tipo_insumo=? where id_tipo_insumo=?;");
$resultado = $sentencia->execute([$nombres,$codigo]);

if ($resultado===true) {
    header('Location: listar_tipo_insumo.php?mensaje=editado');
} else {
    header('Location: listar_tipo_insumo.php?mensaje=error');
    exit();
}
 
?>
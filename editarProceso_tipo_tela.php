<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_tipo_tela.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$nombres = $_POST['txtNombre'];


$sentencia = $bd->prepare("UPDATE tipo_tela SET desc_tipo_tela=? where id_tipo_tela=?;");
$resultado = $sentencia->execute([$nombres,$codigo]);

if ($resultado===true) {
    header('Location: listar_tipo_tela.php?mensaje=editado');
} else {
    header('Location: listar_tipo_tela.php?mensaje=error');
    exit();
}
 
?>
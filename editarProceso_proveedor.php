<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_proveedor.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$id_usuario=1;
$nombres = $_POST['txtNombres'];
$ruc = $_POST['txtRuc'];
$distrito = $_POST['txtDistrito'];
$ciudad = $_POST['txtCiudad'];
$provincia = $_POST['txtProvincia'];
$telefono = $_POST['txtTelefono'];
$email = $_POST['txtEmail'];

$sentencia = $bd->prepare("UPDATE proveedor SET desc_proveedor=?,ruc=?,distrito=?,ciudad=?,provincia=?,telefono=?,email=? where id_proveedor=?;");
$resultado = $sentencia->execute([$nombres,$ruc,$distrito,$ciudad,$provincia,$telefono,$email,$codigo]);

if ($resultado===true) {
    header('Location: listar_proveedor.php?mensaje=editado');
} else {
    header('Location: listar_proveedor.php?mensaje=error');
    exit();
}

?>
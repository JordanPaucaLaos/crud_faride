<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_cliente.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$id_usuario=1;
$nombres = $_POST['txtNombres'];
$ruc_dni = $_POST['txtRucDni'];
$distrito = $_POST['txtDistrito'];
$ciudad = $_POST['txtCiudad'];
$provincia = $_POST['txtProvincia'];
$telefono = $_POST['txtTelefono'];
$email = $_POST['txtEmail'];

$sentencia = $bd->prepare("UPDATE cliente SET id_usuario=?,nombre=?,ruc_dni=?,distrito=?,ciudad=?,provincia=?,telefono=?,email=? where id_cliente=?;");
$resultado = $sentencia->execute([$id_usuario,$nombres,$ruc_dni,$distrito,$ciudad,$provincia,$telefono,$email,$codigo]);

if ($resultado===true) {
    header('Location: listar_cliente.php?mensaje=editado');
} else {
    header('Location: listar_cliente.php?mensaje=error');
    exit();
}

?>
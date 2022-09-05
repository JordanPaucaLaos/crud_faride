<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: index.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$id_usuario=1;
$nombres = $_POST['txtNombres'];
$apellidos = $_POST['txtApellidos'];
$dni = $_POST['txtDni'];
$direccion = $_POST['txtDireccion'];
$telefono = $_POST['txtTelefono'];
$email = $_POST['txtEmail'];

$sentencia = $bd->prepare("UPDATE empleado SET id_usuario=?,nombres=?,apellidos=?,dni=?,direccion=?,telefono=?,email=? where id_empleado=?;");
$resultado = $sentencia->execute([$id_usuario,$nombres,$apellidos,$dni,$direccion,$telefono,$email,$codigo]);

if ($resultado===true) {
    header('Location: index.php?mensaje=editado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}

?>
<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_pedido.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$cliente = $_POST['txtCliente'];
$fecha = $_POST['txtFecha'];
$estado = $_POST['txtEstado'];



$sentencia = $bd->prepare("UPDATE pedido SET id_cliente=?,fecha_pedido=?,id_estado=? where id_pedido=?;");
$resultado = $sentencia->execute([$cliente,$fecha,$estado,$codigo]);

if ($resultado===true) {
    header('Location: listar_pedido.php?mensaje=editado');
} else {
    header('Location: listar_pedido.php?mensaje=error');
    exit();
}

?>
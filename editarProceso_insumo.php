<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_insumo.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$nombre = $_POST['txtNombre'];
$stock = $_POST['txtStock'];
$precio = $_POST['txtPrecio'];
$tipo_insumo = $_POST['txtTipo_insumo'];
$proveedor = $_POST['txtProveedor'];


$sentencia = $bd->prepare("UPDATE insumos SET desc_insumo=?,stock_kg=?,precio_kg=?,id_tipo_insumo=?,id_proveedor=? where id_insumo=?;");
$resultado = $sentencia->execute([$nombre,$stock,$precio,$tipo_insumo,$proveedor,$codigo]);

if ($resultado===true) {
    header('Location: listar_insumo.php?mensaje=editado');
} else {
    header('Location: listar_insumo.php?mensaje=error');
    exit();
}

?>
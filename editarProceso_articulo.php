<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: listar_articulo.php?mensaje=error');
}

include 'model/conexion.php';
$codigo = $_POST['codigo'];
$id_tipo_tela = $_POST['txtTipo_tela'];
$id_hilo = $_POST['txtHilo'];
$desc_articulo = $_POST['txtArticulo'];
$malla = $_POST['txtLongMalla'];
$ancho = $_POST['txtAncho'];


$sentencia = $bd->prepare("UPDATE articulo SET id_tipo_tela=?,id_hilo=?,desc_articulo=?,longitud_malla=?,ancho=? where id_articulo=?;");
$resultado = $sentencia->execute([$id_tipo_tela,$id_hilo,$desc_articulo,$malla,$ancho,$codigo]);

if ($resultado===true) {
    header('Location: listar_articulo.php?mensaje=editado');
} else {
    header('Location: listar_articulo.php?mensaje=error');
    exit();
}

?>
<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombre"])){
        
        header('Location: listar_tipo_insumo.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    
    
    $nombres=$_POST['txtNombre'];    

    $sentencia = $bd->prepare("INSERT INTO tipo_insumo(desc_tipo_insumo) VALUES(?);");
    $resultado = $sentencia->execute([$nombres]);

    if ($resultado===true) {
        header('Location: listar_tipo_insumo.php?mensaje=registrado');
    } else {
        header('Location: listar_tipo_insumo.php?mensaje=error');
        exit();
    }
    
?>
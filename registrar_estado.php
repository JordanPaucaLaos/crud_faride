<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombre"])){
        
        header('Location: listar_estado.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    
    
    $nombres=$_POST['txtNombre'];
    
    

    $sentencia = $bd->prepare("INSERT INTO estado(desc_estado) VALUES(?);");
    $resultado = $sentencia->execute([$nombres]);

    if ($resultado===true) {
        header('Location: listar_estado.php?mensaje=registrado');
    } else {
        header('Location: listar_estado.php?mensaje=error');
        exit();
    }
    
?>
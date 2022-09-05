<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombre"])){
        
        header('Location: listar_hilo.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    
    
    $nombres=$_POST['txtNombre'];    

    $sentencia = $bd->prepare("INSERT INTO hilo(desc_hilo) VALUES(?);");
    $resultado = $sentencia->execute([$nombres]);

    if ($resultado===true) {
        header('Location: listar_hilo.php?mensaje=registrado');
    } else {
        header('Location: listar_hilo.php?mensaje=error');
        exit();
    }
    
?>
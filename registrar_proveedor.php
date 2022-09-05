<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtRuc"]) || empty($_POST["txtDistrito"]) || empty($_POST["txtCiudad"]) || empty($_POST["txtProvincia"]) || empty($_POST["txtTelefono"]) || empty($_POST["txtEmail"])){
        
        header('Location: listar_proveedor.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    
    
    $nombres=$_POST['txtNombres'];
    $ruc=$_POST['txtRuc'];
    $distrito=$_POST['txtDistrito'];
    $ciudad=$_POST['txtCiudad'];
    $provincia=$_POST['txtProvincia'];
    $telefono=$_POST['txtTelefono'];
    $email=$_POST['txtEmail'];
    

    $sentencia = $bd->prepare("INSERT INTO proveedor(desc_proveedor,ruc,distrito,ciudad,provincia,telefono,email) VALUES(?,?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$nombres,$ruc,$distrito,$ciudad,$provincia,$telefono,$email]);

    if ($resultado===true) {
        header('Location: listar_proveedor.php?mensaje=registrado');
    } else {
        header('Location: listar_proveedor.php?mensaje=error');
        exit();
    }
    
?>
<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtRucDni"]) || empty($_POST["txtDistrito"]) || empty($_POST["txtCiudad"]) || empty($_POST["txtProvincia"]) || empty($_POST["txtTelefono"]) || empty($_POST["txtEmail"])){
        
        header('Location: listar_cliente.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    
    $id_usuario=2;
    $nombres=$_POST['txtNombres'];
    $ruc_dni=$_POST['txtRucDni'];
    $distrito=$_POST['txtDistrito'];
    $ciudad=$_POST['txtCiudad'];
    $provincia=$_POST['txtProvincia'];
    $telefono=$_POST['txtTelefono'];
    $email=$_POST['txtEmail'];
    

    $sentencia = $bd->prepare("INSERT INTO cliente(id_usuario,nombre,ruc_dni,distrito,ciudad,provincia,telefono,email) VALUES(?,?,?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$id_usuario,$nombres,$ruc_dni,$distrito,$ciudad,$provincia,$telefono,$email]);

    if ($resultado===true) {
        header('Location: listar_cliente.php?mensaje=registrado');
    } else {
        header('Location: listar_cliente.php?mensaje=error');
        exit();
    }
    
?>
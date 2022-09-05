<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApellidos"]) || empty($_POST["txtDni"]) || empty($_POST["txtDireccion"]) || empty($_POST["txtTelefono"]) || empty($_POST["txtEmail"])){
        
        header('Location: index.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    
    $id_usuario=1;
    $nombres=$_POST['txtNombres'];
    $apellidos=$_POST['txtApellidos'];
    $dni=$_POST['txtDni'];
    $direccion=$_POST['txtDireccion'];
    $telefono=$_POST['txtTelefono'];
    $email=$_POST['txtEmail'];
    

    $sentencia = $bd->prepare("INSERT INTO empleado(id_usuario,nombres,apellidos,dni,direccion,telefono,email) VALUES(?,?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$id_usuario,$nombres,$apellidos,$dni,$direccion,$telefono,$email]);

    if ($resultado===true) {
        header('Location: index.php?mensaje=registrado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
    
?>
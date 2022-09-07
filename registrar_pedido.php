<?php
    //var_dump($_POST);
    print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtCliente"]) || empty($_POST["txtFecha"]) || empty($_POST["txtEstado"])){
        
        header('Location: listar_pedido.php?mensaje=falta');
        exit();
    }

include_once 'model/conexion.php';
    
    
    $cliente=$_POST['txtCliente'];
    $fecha=$_POST['txtFecha'];
    $estado=$_POST['txtEstado'];
   
   
    

    $sentencia = $bd->prepare("INSERT INTO pedido(id_cliente,fecha_pedido,id_estado) VALUES(?,?,?);");
    $resultado = $sentencia->execute([$cliente,$fecha,$estado]);

    if ($resultado===true) {
        header('Location: listar_pedido.php?mensaje=registrado');
    } else {
        header('Location: listar_pedido.php?mensaje=error');
        exit();
    }



    
    
?>


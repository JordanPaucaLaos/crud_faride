<?php
    //var_dump($_POST);
    print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtStock"]) || empty($_POST["txtPrecio"]) || empty($_POST["txtTipo_insumo"]) || empty($_POST["txtProveedor"])){
        
        header('Location: listar_insumo.php?mensaje=falta');
        exit();
    }

include_once 'model/conexion.php';
    
    
    $nombre=$_POST['txtNombre'];
    $stock=$_POST['txtStock'];
    $precio=$_POST['txtPrecio'];
    $tipo_insumo=$_POST['txtTipo_insumo'];
    $proveedor=$_POST['txtProveedor'];
   
    

    $sentencia = $bd->prepare("INSERT INTO insumos(desc_insumo,stock_kg,precio_kg,id_tipo_insumo,id_proveedor) VALUES(?,?,?,?,?);");
    $resultado = $sentencia->execute([$nombre,$stock,$precio,$tipo_insumo,$proveedor]);

    if ($resultado===true) {
        header('Location: listar_insumo.php?mensaje=registrado');
    } else {
        header('Location: listar_insumo.php?mensaje=error');
        exit();
    }



    
    
?>


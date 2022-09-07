<?php
    var_dump($_POST);
    print_r($_POST);
    if(empty($_POST["idPedido"]) || empty($_POST["txtArticulo"]) || empty($_POST["txtColor"]) || empty($_POST["txtRollos"]) || empty($_POST["txtRib"]) || empty($_POST["txtMalla"]) || empty($_POST["txtAncho"]) || empty($_POST["txtPrecio"]) || empty($_POST["txtFecha"])){
        
        header('Location: listar_detallePedido.php?mensaje=falta');
        exit();
    }

include_once 'model/conexion.php';
    
    
 
    $idPedido=$_POST['idPedido'];
    $articulo=$_POST['txtArticulo'];
    $color=$_POST['txtColor'];
    $rollos=$_POST['txtRollos'];
    $rib=$_POST['txtRib'];
    $malla=$_POST['txtMalla'];
    $ancho=$_POST['txtAncho'];
    $precio=$_POST['txtPrecio'];  
    $fecha=$_POST['txtFecha'];  
    

    $sentencia = $bd->prepare("INSERT INTO detalle_pedido(id_pedido,id_articulo,id_color,cantidad_rollos_art,cantidad_rollos_rib,long_malla,ancho,precio_kg,fecha_entrega) VALUES(?,?,?,?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$idPedido,$articulo,$color,$rollos,$rib,$malla,$ancho,$precio,$fecha]);

    if ($resultado===true) {
        header('Location: listar_detallePedido.php?mensaje=registrado');
    } else {
        header('Location: listar_detallePedido.php?mensaje=error');
        exit();
    }



    
    
?>


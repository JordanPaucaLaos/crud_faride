<?php
    //var_dump($_POST);
    print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtTipoTela"]) || empty($_POST["txtHilo"]) || empty($_POST["txtDescArticulo"]) || empty($_POST["txtLongMalla"]) || empty($_POST["txtAncho"]) ){
        
        header('Location: listar_articulo.php?mensaje=falta');
        exit();
    }

include_once 'model/conexion.php';
    
    
    $tipo_tela=$_POST['txtTipoTela'];
    $hilo=$_POST['txtHilo'];
    $articulo=$_POST['txtDescArticulo'];
    $malla=$_POST['txtLongMalla'];
    $ancho=$_POST['txtAncho'];
   
    

    $sentencia = $bd->prepare("INSERT INTO articulo(id_tipo_tela,id_hilo,desc_articulo,longitud_malla,ancho) VALUES(?,?,?,?,?);");
    $resultado = $sentencia->execute([$tipo_tela,$hilo,$articulo,$malla,$ancho]);

    if ($resultado===true) {
        header('Location: listar_articulo.php?mensaje=registrado');
    } else {
        header('Location: listar_articulo.php?mensaje=error');
        exit();
    }



    
    
?>


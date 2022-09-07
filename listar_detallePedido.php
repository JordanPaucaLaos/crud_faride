<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("SELECT detalle_pedido.id_detalle,detalle_pedido.id_pedido ,detalle_pedido.id_articulo, articulo.desc_articulo, detalle_pedido.id_color, color.descripcion, detalle_pedido.cantidad_rollos_art, detalle_pedido.cantidad_rollos_rib, detalle_pedido.long_malla, detalle_pedido.ancho, detalle_pedido.precio_kg,detalle_pedido.fecha_entrega 
FROM detalle_pedido 
INNER JOIN articulo ON detalle_pedido.id_articulo=articulo.id_articulo 
INNER JOIN color ON detalle_pedido.id_color=color.id_color 
ORDER BY detalle_pedido.id_detalle ASC;");
$detalle_pedido = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <!--inicio alerta-->
    <?php
        if(isset($_GET['mensaje']) and $_GET['mensaje']=='falta'){
    ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Rellene todos los campos
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        }
    ?>


    <?php
        if(isset($_GET['mensaje']) and $_GET['mensaje']=='registrado'){
    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Registrado!</strong> Se agregaron los datos
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        }
    ?>

    <?php
        if(isset($_GET['mensaje']) and $_GET['mensaje']=='error'){
    ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> vuelve a intentar
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        }
    ?>

    <?php
        if(isset($_GET['mensaje']) and $_GET['mensaje']=='editado'){
    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Editado!</strong> Los datos fueron actualizados exitosamente
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        }
    ?>

    <?php
        if(isset($_GET['mensaje']) and $_GET['mensaje']=='eliminado'){
    ?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Eliminado!</strong> Los datos fueron eliminados
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        }
    ?>


    <!--fin alerta-->
            <div class="card">
                <div class="card-header bg-light">
                    Lista de Detalle Pedido
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Rollos</th>
                                    <th scope="col">Rib</th>
                                    <th scope="col">Long. Malla</th>                                    
                                    <th scope="col">Ancho</th>  
                                    <th scope="col">Precio</th>  
                                    <th scope="col">Fec. Entrega Est.</th>  
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($detalle_pedido as $dato){                    

                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->id_detalle; ?></td>
                                    <td><?php echo $dato->desc_articulo; ?></td>                                    
                                    <td><?php echo $dato->descripcion; ?></td>
                                    <td><?php echo $dato->cantidad_rollos_art; ?></td>
                                    <td><?php echo $dato->cantidad_rollos_rib; ?></td>
                                    <td><?php echo $dato->long_malla; ?></td>
                                    <td><?php echo $dato->ancho; ?></td>
                                    <td><?php echo $dato->precio_kg; ?></td>
                                    <td><?php echo $dato->fecha_entrega; ?></td>
                                    
                                    
                                    <td><a class="text-success" href="editar_detallePedido.php?codigo=<?php echo $dato->id_detalle;?>&id_articulo=<?php echo $dato->id_articulo;?>&id_color=<?php echo $dato->id_color;?>&id_pedido=<?php echo $dato->id_pedido;?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar_detallePedido.php?codigo=<?php echo $dato->id_detalle; ?>"><i class="bi bi-trash-fill"></i></a></td>
                                    

                                </tr>

                                <?php
                                    }
                                
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos:
                </div>
                <form class="p-4" method="POST" action="registrar_detallePedido.php">
                             
                    <div class="mb-3">
                    <label class="form-label">Articulo</label>
                    <select class="form-control" name="txtArticulo" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM articulo");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["id_articulo"].'">'.$valores["desc_articulo"].'</option>';
                    endforeach;
                    ?>
                    </select>
                    </div> 

                    <div class="mb-3">
                    <label class="form-label">Color</label>
                    <select class="form-control" name="txtColor" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM color");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["id_color"].'">'.$valores["descripcion"].'</option>';
                    endforeach;
                    ?>
                    </select>
                    </div>  

                    <div class="mb-3">
                        <label class="form-label">Rollos</label>
                        <input type="number" class="form-control" name="txtRollos" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rib</label>
                        <input type="number" class="form-control" name="txtRib"  required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Long. Malla</label>
                        <input type="number" step="any" class="form-control" name="txtMalla"  required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ancho</label>
                        <input type="number" class="form-control" name="txtAncho"  required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="any" class="form-control" name="txtPrecio"  required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha Entrega est.</label>
                        <input type="date" class="form-control" name="txtFecha"  required>
                    </div>
                                    
                    <div class="d-grid">
                        <input type="hidden" name="idPedido" value="<?php echo $dato->id_pedido;?>">
                        <input type="submit" class="btn btn-primary" value="Registrar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<?php include 'template/footer.php' ?>
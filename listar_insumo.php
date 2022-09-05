<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("SELECT insumos.id_insumo, insumos.desc_insumo, insumos.stock_kg, insumos.precio_kg, insumos.id_tipo_insumo, tipo_insumo.desc_tipo_insumo as nom_insumo, insumos.id_proveedor, proveedor.desc_proveedor as nom_proveedor
FROM insumos
INNER JOIN tipo_insumo ON insumos.id_tipo_insumo=tipo_insumo.id_tipo_insumo
INNER JOIN proveedor ON insumos.id_proveedor=proveedor.id_proveedor
ORDER BY insumos.id_insumo ASC;");
$insumos = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
                    Lista de insumos
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Tipo Insumo</th>
                                    <th scope="col">Proveedor</th>                                    
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($insumos as $dato){                    

                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->id_insumo; ?></td>
                                    <td><?php echo $dato->desc_insumo; ?></td>                                    
                                    <td><?php echo $dato->stock_kg; ?></td>
                                    <td><?php echo $dato->precio_kg; ?></td>
                                    <td><?php echo $dato->nom_insumo; ?></td>
                                    <td><?php echo $dato->nom_proveedor; ?></td>
                                    
                                    
                                    <td><a class="text-success" href="editar_insumo.php?codigo=<?php echo $dato->id_insumo;?>&id_tipo_insumo=<?php echo $dato->id_tipo_insumo;?>&id_proveedor=<?php echo $dato->id_proveedor;?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar_insumo.php?codigo=<?php echo $dato->id_insumo; ?>"><i class="bi bi-trash-fill"></i></a></td>
                                    

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
                <form class="p-4" method="POST" action="registrar_insumo.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" step="any" class="form-control" name="txtStock" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="any" class="form-control" name="txtPrecio" required>
                    </div>                  
                    
                    <div class="mb-3">
                    <label class="form-label">Tipo insumo</label>
                    <select class="form-control" name="txtTipo_insumo" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM tipo_insumo");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["id_tipo_insumo"].'">'.$valores["desc_tipo_insumo"].'</option>';
                    endforeach;
                    ?>
                    </select>
                    </div> 

                    <div class="mb-3">
                    <label class="form-label">Proveedor</label>
                    <select class="form-control" name="txtProveedor" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM proveedor");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["id_proveedor"].'">'.$valores["desc_proveedor"].'</option>';
                    endforeach;
                    ?>
                    </select>
                    </div>  
                                    
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<?php include 'template/footer.php' ?>
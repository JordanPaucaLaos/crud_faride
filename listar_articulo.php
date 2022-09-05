<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("SELECT articulo.id_articulo, articulo.id_tipo_tela, tipo_tela.desc_tipo_tela, articulo.id_hilo, hilo.desc_hilo,articulo.desc_articulo, articulo.longitud_malla, articulo.ancho
FROM articulo
INNER JOIN tipo_tela ON articulo.id_tipo_tela=tipo_tela.id_tipo_tela
INNER JOIN hilo ON articulo.id_hilo=hilo.id_hilo
ORDER BY articulo.id_articulo ASC;");
$articulo = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
                                    <th scope="col">Tipo tela</th>
                                    <th scope="col">Hilo</th>
                                    <th scope="col">Descripción articulo</th>
                                    <th scope="col">Long. malla</th>
                                    <th scope="col">Ancho</th>                                    
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($articulo as $dato){                    

                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->id_articulo; ?></td>
                                    <td><?php echo $dato->desc_tipo_tela; ?></td>                                    
                                    <td><?php echo $dato->desc_hilo; ?></td>
                                    <td><?php echo $dato->desc_articulo; ?></td>
                                    <td><?php echo $dato->longitud_malla; ?></td>
                                    <td><?php echo $dato->ancho; ?></td>
                                    
                                    
                                    <td><a class="text-success" href="editar_articulo.php?codigo=<?php echo $dato->id_articulo;?>&id_tipo_tela=<?php echo $dato->id_tipo_tela;?>&id_hilo=<?php echo $dato->id_hilo;?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar_articulo.php?codigo=<?php echo $dato->id_articulo; ?>"><i class="bi bi-trash-fill"></i></a></td>
                                    

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
                <form class="p-4" method="POST" action="registrar_articulo.php">
                    
                    <div class="mb-3">
                    <label class="form-label">Tipo tela</label>
                    <select class="form-control" name="txtTipoTela" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM tipo_tela");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["id_tipo_tela"].'">'.$valores["desc_tipo_tela"].'</option>';
                    endforeach;
                    ?>
                    </select>
                    </div> 

                   
                    <div class="mb-3">
                    <label class="form-label">Hilo</label>
                    <select class="form-control" name="txtHilo" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM hilo");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["id_hilo"].'">'.$valores["desc_hilo"].'</option>';
                    endforeach;
                    ?>
                    </select>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Desc. Articulo</label>
                        <input type="text" class="form-control" name="txtDescArticulo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Long. Malla</label>
                        <input type="number" step="any" class="form-control" name="txtLongMalla" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ancho</label>
                        <input type="number" step="any" class="form-control" name="txtAncho" required>
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
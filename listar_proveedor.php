<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("select * from proveedor");
$proveedor = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
                    Lista de Clientes
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">RUC</th>
                                    <th scope="col">Distrito</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">Provincia</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($proveedor as $dato){                    

                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->id_proveedor; ?></td>
                                    <td><?php echo $dato->desc_proveedor; ?></td>                                    
                                    <td><?php echo $dato->ruc; ?></td>
                                    <td><?php echo $dato->distrito; ?></td>
                                    <td><?php echo $dato->ciudad; ?></td>
                                    <td><?php echo $dato->provincia; ?></td>
                                    <td><?php echo $dato->telefono; ?></td>
                                    <td><?php echo $dato->email; ?></td>
                                    
                                    <td><a class="text-success" href="editar_proveedor.php?codigo=<?php echo $dato->id_proveedor; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar_proveedor.php?codigo=<?php echo $dato->id_proveedor; ?>"><i class="bi bi-trash-fill"></i></a></td>
                                    

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
                <form class="p-4" method="POST" action="registrar_proveedor.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombres" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">RUC</label>
                        <input type="number" class="form-control" name="txtRuc" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Distrito</label>
                        <input type="text" class="form-control" name="txtDistrito" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="txtCiudad" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Provincia</label>
                        <input type="text" class="form-control" name="txtProvincia" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="number" class="form-control" name="txtTelefono" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="txtEmail" required>
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
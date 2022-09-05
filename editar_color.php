<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_color.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia= $bd->prepare("select * from color where id_color=?;");
$sentencia->execute([$codigo]);
$color = $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_color.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombre" required 
                        value="<?php echo $color->descripcion; ?>">
                    </div>                    
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $color->id_color; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

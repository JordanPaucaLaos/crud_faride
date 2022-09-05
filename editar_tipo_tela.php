<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_tipo_tela.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia= $bd->prepare("select * from tipo_tela where id_tipo_tela=?;");
$sentencia->execute([$codigo]);
$tipo_tela= $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_tipo_tela.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombre" required 
                        value="<?php echo $tipo_tela->desc_tipo_tela; ?>">
                    </div>                    
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $tipo_tela->id_tipo_tela; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

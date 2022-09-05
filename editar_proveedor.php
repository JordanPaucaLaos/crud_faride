<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_proveedor.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia= $bd->prepare("select * from proveedor where id_proveedor=?;");
$sentencia->execute([$codigo]);
$proveedor = $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_proveedor.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombres" required 
                        value="<?php echo $proveedor->desc_proveedor; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">RUC</label>
                        <input type="number" class="form-control" name="txtRuc" required
                        value="<?php echo $proveedor->ruc; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Distrito</label>
                        <input type="text" class="form-control" name="txtDistrito" required
                        value="<?php echo $proveedor->distrito; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="txtCiudad" required
                        value="<?php echo $proveedor->ciudad; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Provincia</label>
                        <input type="text" class="form-control" name="txtProvincia" required
                        value="<?php echo $proveedor->provincia; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="number" class="form-control" name="txtTelefono" required
                        value="<?php echo $proveedor->telefono; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="txtEmail" required
                        value="<?php echo $proveedor->email; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $proveedor->id_proveedor; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

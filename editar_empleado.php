<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: index.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia= $bd->prepare("select * from empleado where id_empleado=?;");
$sentencia->execute([$codigo]);
$empleado = $sentencia->fetch(PDO::FETCH_OBJ);


?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_empleado.php">
                    <div class="mb-3">
                        <label class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="txtNombres" required 
                        value="<?php echo $empleado->nombres; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="txtApellidos" required
                        value="<?php echo $empleado->apellidos; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input type="number" class="form-control" name="txtDni" required
                        value="<?php echo $empleado->dni; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="txtDireccion" required
                        value="<?php echo $empleado->direccion; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="number" class="form-control" name="txtTelefono" required
                        value="<?php echo $empleado->telefono; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="txtEmail" required
                        value="<?php echo $empleado->email; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $empleado->id_empleado; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>
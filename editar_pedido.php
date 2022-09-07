<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_pedido.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
$idCliente = $_GET['id_cliente'];
$idEstado= $_GET['id_estado'];

$sentencia= $bd->prepare("SELECT pedido.id_pedido, pedido.id_cliente, cliente.nombre, pedido.fecha_pedido, pedido.id_estado, estado.desc_estado 
FROM pedido 
INNER JOIN cliente ON pedido.id_cliente=cliente.id_cliente 
INNER JOIN estado ON pedido.id_estado=estado.id_estado
WHERE pedido.id_pedido=?;");
$sentencia->execute([$codigo]);
$pedido = $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_pedido.php">
                                  

                    <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <select class="form-control" name="txtCliente" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM cliente");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                        if($valores["id_cliente"]==$idCliente){
                            echo "<option selected='selected' value='".$valores["id_cliente"]."'>".$valores["nombre"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores["id_cliente"]."'>".$valores["nombre"]."</option>"; 
                            }
                  
                    endforeach;
                    ?>
                    </select>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="txtFecha" required
                        value="<?php echo $pedido->fecha_pedido; ?>">
                    </div>


                    <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-control" name="txtEstado" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query2 = $bd->prepare("SELECT * FROM estado");
                    $query2->execute();
                    $data2 = $query2->fetchAll();

                    foreach ($data2 as $valores2):
                        if($valores2["id_estado"]==$idEstado){
                                echo "<option selected='selected' value='".$valores2["id_estado"]."'>".$valores2["desc_estado"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores2["id_estado"]."'>".$valores2["desc_estado"]."</option>"; 
                            }
                   
                    endforeach;
                    ?>
                    </select>
                    </div> 


                    



                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $pedido->id_pedido; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

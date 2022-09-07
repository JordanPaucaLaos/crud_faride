<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_detallePedido.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
$idArticulo = $_GET['id_articulo'];
$idColor= $_GET['id_color'];
$idPedido= $_GET['id_pedido'];

$sentencia= $bd->prepare("SELECT detalle_pedido.id_detalle,detalle_pedido.id_pedido ,detalle_pedido.id_articulo, articulo.desc_articulo, detalle_pedido.id_color, color.descripcion, detalle_pedido.cantidad_rollos_art, detalle_pedido.cantidad_rollos_rib, detalle_pedido.long_malla, detalle_pedido.ancho, detalle_pedido.precio_kg,detalle_pedido.fecha_entrega
FROM detalle_pedido
INNER JOIN articulo ON detalle_pedido.id_articulo=articulo.id_articulo
INNER JOIN color ON detalle_pedido.id_color=color.id_color
WHERE detalle_pedido.id_detalle=?;");
$sentencia->execute([$codigo]);
$detallePedido = $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_detallePedido.php">
                                                       
                    

                    <div class="mb-3">
                    <label class="form-label">Articulo</label>
                    <select class="form-control" name="txtArticulo" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM articulo");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                        if($valores["id_articulo"]==$idArticulo){
                            echo "<option selected='selected' value='".$valores["id_articulo"]."'>".$valores["desc_articulo"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores["id_articulo"]."'>".$valores["desc_articulo"]."</option>"; 
                            }
                  
                    endforeach;
                    ?>
                    </select>
                    </div> 


                    <div class="mb-3">
                    <label class="form-label">Color</label>
                    <select class="form-control" name="txtColor" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query2 = $bd->prepare("SELECT * FROM color");
                    $query2->execute();
                    $data2 = $query2->fetchAll();

                    foreach ($data2 as $valores2):
                        if($valores2["id_color"]==$idColor){
                                echo "<option selected='selected' value='".$valores2["id_color"]."'>".$valores2["descripcion"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores2["id_color"]."'>".$valores2["descripcion"]."</option>"; 
                            }
                   
                    endforeach;
                    ?>
                    </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rollos</label>
                        <input type="number" class="form-control" name="txtRollos" required 
                        value="<?php echo $detallePedido->cantidad_rollos_art; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rib</label>
                        <input type="number" class="form-control" name="txtRib" required 
                        value="<?php echo $detallePedido->cantidad_rollos_rib; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Malla</label>
                        <input type="number" step="any" class="form-control" name="txtMalla" required 
                        value="<?php echo $detallePedido->long_malla; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ancho</label>
                        <input type="number" class="form-control" name="txtAncho" required 
                        value="<?php echo $detallePedido->ancho; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="any" class="form-control" name="txtPrecio" required 
                        value="<?php echo $detallePedido->precio_kg; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha entrega</label>
                        <input type="date" class="form-control" name="txtFecha" required 
                        value="<?php echo $detallePedido->fecha_entrega; ?>">
                    </div>

                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                        <input type="hidden" name="idPedido" value="<?php echo $idPedido; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

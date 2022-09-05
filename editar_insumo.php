<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_insumo.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
$idTipoInsumo = $_GET['id_tipo_insumo'];
$id_proveedor= $_GET['id_proveedor'];

$sentencia= $bd->prepare("SELECT insumos.id_insumo, insumos.desc_insumo, insumos.stock_kg, insumos.precio_kg, insumos.id_tipo_insumo, tipo_insumo.desc_tipo_insumo as nom_insumo, proveedor.desc_proveedor as nom_proveedor
FROM insumos
INNER JOIN tipo_insumo ON insumos.id_tipo_insumo=tipo_insumo.id_tipo_insumo
INNER JOIN proveedor ON insumos.id_proveedor=proveedor.id_proveedor
WHERE insumos.id_insumo=?;");
$sentencia->execute([$codigo]);
$insumo = $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_insumo.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="txtNombre" required 
                        value="<?php echo $insumo->desc_insumo; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" step="any" class="form-control" name="txtStock" required
                        value="<?php echo $insumo->stock_kg; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="any" class="form-control" name="txtPrecio" required
                        value="<?php echo $insumo->precio_kg; ?>">
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
                        if($valores["id_tipo_insumo"]==$idTipoInsumo){
                            echo "<option selected='selected' value='".$valores["id_tipo_insumo"]."'>".$valores["desc_tipo_insumo"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores["id_tipo_insumo"]."'>".$valores["desc_tipo_insumo"]."</option>"; 
                            }
                  
                    endforeach;
                    ?>
                    </select>
                    </div> 


                    <div class="mb-3">
                    <label class="form-label">Proveedor</label>
                    <select class="form-control" name="txtProveedor" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query2 = $bd->prepare("SELECT * FROM proveedor");
                    $query2->execute();
                    $data2 = $query2->fetchAll();

                    foreach ($data2 as $valores2):
                        if($valores2["id_proveedor"]==$id_proveedor){
                                echo "<option selected='selected' value='".$valores2["id_proveedor"]."'>".$valores2["desc_proveedor"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores2["id_proveedor"]."'>".$valores2["desc_proveedor"]."</option>"; 
                            }
                   
                    endforeach;
                    ?>
                    </select>
                    </div> 


                    



                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $insumo->id_insumo; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

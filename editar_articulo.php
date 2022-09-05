<?php include 'template/header.php' ?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: listar_articulo.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
$idTipoTela = $_GET['id_tipo_tela'];
$idHilo = $_GET['id_hilo'];

$sentencia= $bd->prepare("SELECT articulo.id_articulo, articulo.id_tipo_tela, tipo_tela.desc_tipo_tela, articulo.id_hilo, hilo.desc_hilo,articulo.desc_articulo, articulo.longitud_malla, articulo.ancho
FROM articulo
INNER JOIN tipo_tela ON articulo.id_tipo_tela=tipo_tela.id_tipo_tela
INNER JOIN hilo ON articulo.id_hilo=hilo.id_hilo
WHERE articulo.id_articulo=?;");
$sentencia->execute([$codigo]);
$articulo = $sentencia->fetch(PDO::FETCH_OBJ);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso_articulo.php">
                    
                <div class="mb-3">
                    <label class="form-label">Tipo tela</label>
                    <select class="form-control" name="txtTipo_tela" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $bd->prepare("SELECT * FROM tipo_tela");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                        if($valores["id_tipo_tela"]==$idTipoTela){
                            echo "<option selected='selected' value='".$valores["id_tipo_tela"]."'>".$valores["desc_tipo_tela"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores["id_tipo_tela"]."'>".$valores["desc_tipo_tela"]."</option>"; 
                            }
                  
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
                        if($valores["id_hilo"]==$idHilo){
                            echo "<option selected='selected' value='".$valores["id_hilo"]."'>".$valores["desc_hilo"]."</option>";
                            }
                            else{
                                echo "<option value='".$valores["id_hilo"]."'>".$valores["desc_hilo"]."</option>"; 
                            }
                  
                    endforeach;
                    ?>
                    </select>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label">Articulo</label>
                        <input type="text" class="form-control" name="txtArticulo" required 
                        value="<?php echo $articulo->desc_articulo; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Long. Malla</label>
                        <input type="number" step="any" class="form-control" name="txtLongMalla" required 
                        value="<?php echo $articulo->longitud_malla; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ancho</label>
                        <input type="number" step="any" class="form-control" name="txtAncho" required 
                        value="<?php echo $articulo->ancho; ?>">
                    </div>


                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $articulo->id_articulo; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include 'template/footer.php' ?>

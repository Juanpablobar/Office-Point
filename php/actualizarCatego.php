<?php
include './conexion.php';
?>
        <select name="sub_catego" id="sub_catego" class="form-control sub_catego" required>
        <?php
         $resultado12 = $conexion ->query("SELECT * FROM subcategorias INNER JOIN categorias ON subcategorias.id_categoria = categorias.nombre WHERE categorias.nombre='".$_POST['id']."'")
         or die($conexion->error);	
         while ($f12 = mysqli_fetch_row($resultado12)){
        ?>
        <option value="<?php echo $f12[1] ?>"><?php echo $f12[1] ?></option>
        <?php } ?>
        </select>

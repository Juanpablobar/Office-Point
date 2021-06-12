<?php
include './conexion.php';
if(isset($_POST['id']) && isset($_POST['texto']) ){
			$conexion->query("update ventas set 
			visto='true'
			where id_venta=".$_POST['id']);
}
?>

        <span style="background:#009DE1;color:white;border-radius:100%;height:20px;width:20px;font-size:14px">
        <?php
                $resultado100 = $conexion->query("
                select * from
                ventas where status='".$_POST['texto']."' and visto='false'")or die($conexion->error);
                $fila100 = mysqli_num_rows($resultado100);
                if ($fila100 > 0) {
                    echo $fila100;
                }else{
                    echo '0';
                }
                ?>
        </span>
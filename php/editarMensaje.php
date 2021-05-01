<?php
include './conexion.php';
if(isset($_POST['id']) ){
			$conexion->query("update mensajes set 
			status='visto'
			where id=".$_POST['id']);
}
?>
<h1 class="m-0 messages_h1" style="color: #444;padding-top:.5em">Mensajes
                <?php
                $resultado2 = $conexion->query("
                select * from
                mensajes where status='pendiente'")or die($conexion->error);
                $fila2 = mysqli_num_rows($resultado2);
                if ($fila2 > 0) {
                    echo "(".$fila2.")";
                }else{
                    echo '(0)';
                }
                ?>
        </h1>
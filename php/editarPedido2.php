<?php
include './conexion.php';

if(isset($_POST['editar']) && isset($_POST['id'])){
    if ($_POST['editar'] == 'finalizada' || $_POST['editar'] == 'pendiente_envio') {
        $conexion->query("update ventas set 
        status='".$_POST['editar']."',
        visto='false'
        where id_venta=".$_POST['id']);

        $productos = $conexion->query("select * from productos_venta where id_venta=".$_POST['id'])or die($conexion->error);

        while ($productosIndv = mysqli_fetch_array($productos)) {

            $respuesta400 = $conexion->query("select * from cantidad_vendidos where id_producto='".$productosIndv[2]."'")or die($conexion->error);

            $fila400 = mysqli_fetch_array($respuesta400);
            
            if (mysqli_num_rows($respuesta400) == 0) {
                $conexion->query("insert into cantidad_vendidos (id_producto,vendidos) 
                values(
                    ".$productosIndv[2].",
                    ".$productosIndv[3]."
                    )")or die($conexion->error);
                } else {
                $vendidos = $fila400[1] + $productosIndv[3];

                $conexion->query("update cantidad_vendidos set 
            vendidos=".$vendidos."
            where id_producto=".$productosIndv[2]);
            }

            $respuesta200 = $conexion->query("select * from productos where id=".$productosIndv[2])or die($conexion->error);
    
            $fila200 = mysqli_fetch_array($respuesta200);
    
            $stock = $fila200[10] - $productosIndv[3];
    
            $conexion->query("update productos set 
                stock=".$stock."
                where id=".$productosIndv[2]);
        }

        header('Location: ../dashboard/pedidos?edit');
    } else {
        header('Location: ../dashboard/pedidos?edit');
    }
}

?>
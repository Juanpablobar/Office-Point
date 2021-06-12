<?php
include './conexion.php';

if(isset($_POST['editar']) && isset($_POST['id'])){
        $conexion->query("update ventas set 
        status='".$_POST['editar']."',
        visto='false'
        where id_venta=".$_POST['id']);
        header('Location: ../dashboard/pedidos?edit');
}
?>
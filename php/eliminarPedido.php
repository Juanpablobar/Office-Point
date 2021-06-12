<?php
include './conexion.php';

$fila = $conexion->query("select * from ventas where id=".$_POST['id']);
$id = mysqli_fetch_row($fila);

$conexion->query("delete from ventas where id_venta=".$_POST['id']);
$conexion->query("delete from direcciones_ventas where id_venta=".$_POST['id']);
$conexion->query("delete from productos_venta where id_venta=".$_POST['id']);
?>
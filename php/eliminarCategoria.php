<?php
include './conexion.php';

$fila = $conexion->query("select * from categorias where id=".$_POST['id']);
$id = mysqli_fetch_row($fila);
$conexion->query("delete from categorias where id=".$_POST['id']);
echo 'listo';
?>
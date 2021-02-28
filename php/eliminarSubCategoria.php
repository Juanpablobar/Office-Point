<?php
include './conexion.php';

$fila = $conexion->query("select * from subcategorias where id=".$_POST['id']);
$id = mysqli_fetch_row($fila);
$conexion->query("delete from subcategorias where id=".$_POST['id']);
echo 'listo';
?>
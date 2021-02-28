<?php
include './conexion.php';

$fila = $conexion->query("select * from tags where id=".$_POST['id']);
$id = mysqli_fetch_row($fila);
$conexion->query("delete from tags where id=".$_POST['id']);
echo 'listo';
?>
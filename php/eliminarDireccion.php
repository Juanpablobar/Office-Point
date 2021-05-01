<?php
include './conexion.php';

$fila = $conexion->query("select * from direcciones_usuarios where id_usuario=".$_POST['id']);
$id = mysqli_fetch_row($fila);
$conexion->query("delete from direcciones_usuarios where id_usuario=".$_POST['id']);
header("location: ../dashboard/mi-perfil.php");
?>
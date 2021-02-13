<?php
include './conexion.php';
$pass= $_POST['password'];
if(isset($_POST['register'])){
	$conexion->query("insert into usuario (nombre,correo,contraseña,perfil,nivel)
	values(
	'".$_POST['name']."',
	'".$_POST['email']."',
	'".sha1($pass)."',
	'default.jpg',
	'cliente'
	)
	")or die($conexion->error);
	header("Location: ../login.php?success=Usuario creado correctamente. Inicie Sesión");

}else{
	header("Location: ../index.php");

}
?>

<?php
session_start();
include './conexion.php';
if(isset($_POST['email']) && isset($_POST['password']) ){
	$resultado = $conexion->query("select * from usuarios where
	correo= '".$_POST['email']."' and
	contraseña= '".sha1($_POST['password'])."' ")or die($conexion->error);
	if(mysqli_num_rows($resultado)>0){
		$datos_usuario = mysqli_fetch_row($resultado);
		$nombre = $datos_usuario[1];
		$id_usuario = $datos_usuario[0];
		$email = $datos_usuario[2];
		$nivel = $datos_usuario[4];
		$metodo = $datos_usuario[5];
		$_SESSION['datos_login']= array(
		'nombre'=>$nombre,
		'id'=>$id_usuario,
		'correo'=>$email,
		'nivel'=>$nivel,
		'metodo'=>$metodo
		);
	header("Location: ../dashboard/");
	}else{
		header("Location: ../login.php?error");
	}
}else{
	header("../login.php");
}
	?>

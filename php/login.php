<?php
session_start();
include './conexion.php';
if(isset($_POST['email']) && isset($_POST['password']) ){
	$resultado = $conexion->query("select * from usuario where
	correo= '".$_POST['email']."' and
	contraseña= '".sha1($_POST['password'])."' ")or die($conexion->error);
	if(mysqli_num_rows($resultado)>0){
		$datos_usuario = mysqli_fetch_row($resultado);
		$nombre = $datos_usuario[1];
		$id_usuario = $datos_usuario[0];
		$email = $datos_usuario[2];
		$imagen = $datos_usuario[4];
		$nivel = $datos_usuario[5];
		$_SESSION['datos_login']= array(
		'nombre'=>$nombre,
		'id_usuario'=>$id_usuario,
		'email'=>$email,
		'imagen'=>$imagen,
		'nivel'=>$nivel
		);
	header("Location: ../dashboard/AdminLTE-3.1.0-rc/index.php");
	}else{
		header("Location: ../login.php?error=Credenciales incorrectas");
	}
}else{
	header("../login.php");
}
	?>

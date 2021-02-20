<?php

include './conexion.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])){
	if (comprobar_email($_POST['email'])){
   		$respuesta = $conexion->query("select * from usuarios where 	correo='".$_POST["email"]."'")or die($conexion->error);
	 	if(mysqli_num_rows($respuesta) == 0){
		$pass= $_POST['password'];
		$conexion->query("insert into usuarios (nombre,correo,contraseña,nivel,metodo)
		values(
		'".$_POST['name']."',
		'".$_POST['email']."',
		'".sha1($pass)."',
		'cliente',
		'Formulario'
		)
		")or die($conexion->error);
		header("Location: ../login?new_user");
	 }else{
	header("Location: ../register?already_register");
	 }
	}else{
	header("Location: ../register?invalid_email");
	}
}else{
	header("Location: ../register?invalid");

}





?>

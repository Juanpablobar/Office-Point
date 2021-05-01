<?php
include './conexion.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if(isset($_POST['enviar'])){
    if (comprobar_email($_POST['email'])){
	$conexion->query("insert into mensajes (nombre,correo,mensaje,dia,mes,año,status,tipo)
	values(
	'".$_POST['name']."',
    '".$_POST['email']."',
    '".$_POST['message']."',
    '".date('j')."',
    '".date('M')."',
    '".date('Y')."',
	'pendiente',
	'contact-form'
	)
	")or die($conexion->error);
			header('Location: ../contact?success');
        }else{
            header("Location: ../contact?invalid_email");
            }
}else{
    header("Location: ../contact?error=Favor de llenar todos los campos");
}


?>
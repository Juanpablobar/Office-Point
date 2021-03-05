<?php
include './conexion.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if(isset($_POST['send_mail'])){
    if (comprobar_email($_POST['mail'])){
    $date = date('j-M-Y');
	$conexion->query("insert into mensajes (nombre,correo,mensaje,dia,mes,año,status,tipo)
	values(
    '',
	'".$_POST['mail']."',
    '',
    '".date('j')."',
    '".date('M')."',
    '".date('Y')."',
	'pendiente',
	'footer-form'
	)
	")or die($conexion->error);
			header('Location: ../?success');
        }else{
            header("Location: ../?invalid_email");
            }
}else{
    header("Location: ../?error=Favor de llenar todos los campos");
}

?>
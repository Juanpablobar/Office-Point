<?php
include './conexion.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if(isset($_POST['send_email'])){
    if (comprobar_email($_POST['email'])){
    $date = date('j-M-Y');
	$conexion->query("insert into mensajes (nombre,correo,mensaje,dia,mes,año,status,tipo)
	values(
    '',
	'".$_POST['email']."',
    '',
    '".date('j')."',
    '".date('M')."',
    '".date('Y')."',
	'pendiente',
	'popup-form'
	)
	")or die($conexion->error);
			header('Location: ../shop.php');
        }else{
            header("Location: ../shop.php");
            }
}else{
    header("Location: ../shop.php");
}

?>
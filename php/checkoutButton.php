<?php
include './conexion.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if(isset($_POST['email'])){
    if (comprobar_email($_POST['email'])) {
		$respuesta = $conexion ->query("select * from usuarios where correo ='".$_POST['email']."'");
		if(mysqli_num_rows($respuesta) == 0){
			echo '<button type="submit" name="submit" class="email_button">COMPRAR</button>';	
		}else{
			echo '<button type="submit" class="email_button" disabled>COMPRAR</button>';
		}
    }else{
		echo '<button type="submit" class="email_button" disabled>COMPRAR</button>';
	}
}

?>
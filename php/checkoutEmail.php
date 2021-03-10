<?php
include './conexion.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if(isset($_POST['email'])){
    if (comprobar_email($_POST['email'])) {
		$respuesta = $conexion ->query("select * from usuarios where correo ='".$_POST['email']."'");
		if(mysqli_num_rows($respuesta) == 0){
			echo '<h2 class="email_h2">Contraseña<a>*</a></h2>
			<input class="email_ajax" type="text" name="password" placeholder="Introduce al menos 8 carácteres" minlength="8" required>';	
		}else{
			echo '<h4 class="email_h2 email_h4">Esta dirección de correo ya está siendo utilizada</h4>';
		}
    }else{
		echo '<h4 class="email_h2 email_h4">Introduce una dirección de correo válida</h4>';
	}
}

?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Iniciar Sesión</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/login.css?2.0"> 
	
</head>
<body>

<?php include ('./layouts/reload.php'); ?>

<div class="login">
	<div class="login-second">
	</div>
	<div class="login-first">
	<div class="login-cont">
		<a href="./"><img src="img/logo.png" title="Office Point Logo"></a>
		<h1>Iniciar Sesión</h1>
		<form action="#" method="post">
				<div class="login-input-item">
					<h2>Correo electrónico</h2>
					<input type="text" name="email" placeholder="nombre@ejemplo.com" required>
				</div>
				<div class="login-input-item">
					<div class="login-input-second">
					<h2>Contraseña</h2>
					<a href="#">¿Olvidaste tu contraseña?</a>
					</div>
					<input type="password" name="password" placeholder="Introduce 6 caracteres o más" required>
				</div>
				<button type="submit" name="send">INICIAR SESIÓN</button>
		</form>
		<h3>o</h3>
		<a class="button-facebook" href="#"><img src="img/facebook.svg"><h2>INICIAR SESIÓN CON FACEBOOK</h2></a>
		<a class="button-google" href="#"><img src="img/google.svg"><h2>INICIAR SESIÓN CON GOOGLE</h2></a>
		<h4>¿Aún no estás registrado? <a href="register">Regístrate</a></h4>
	</div>
	</div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
</body>
</html>

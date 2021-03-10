<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Próximamente</title>
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/layouts.css">
	<link rel="stylesheet" href="css/soon.css?1.0">
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
</head>

<body>
	<?php include ('./layouts/reload.php'); ?>
	<div class="soon">
		<div class="soon-second">
		</div>
		<div class="soon-first">
			<div class="soon-brand">
				<img src="img/logo.png" alt="Oficce Point Logo" title="Oficce Point Logo">
			</div>
			<h1>Nuestra Tienda en Línea estará disponible <a>pronto</a>, síguenos para recibir todas las actualizaciones.</h1>
			<form action="./php/soon-mail.php" method="post">
				<input type="text" placeholder="Nombre" name="name" required>
				<input type="text" placeholder="Correo Electrónico" name="email" required>
				<button type="submit">Suscribir</button>
			</form>
			<div class="buttons">
				<a href="https://m.facebook.com/officepointdistribuidora/" target="_blank"><span><i class="fab fa-facebook-f"></i></span></a>
				<a href="https://instagram.com/officepoint_distribuidora?igshid=1ustp92abik53" target="_blank"><span><i class="fab fa-instagram"></i></span></a>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/reload.js"></script>
	<script src="js/countdown4.js"></script>
	<script>
		$(document).ready(function() {
		$('#close').click(function(){
		$('.success-mail').fadeOut();
    });
	});
		</script>
</body>
</html>
<?php
	if(isset($_GET['success'])){
		echo "<div class='success-mail'>
		<div>
		<span id='close'><i class='fas fa-times'></i></span>
		<h1>Te notificaremos cuando nuestra Tienda en Línea ya esté funcionando<br>¡Gracias!</h1>
		</div>
		</div>
		";
	}else{
		echo '';
	}
	?>

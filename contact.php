<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Contacto</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/contact.css?2.0"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb">
	<h1>Contacto</h1>
	<h2><a href="./">Home</a> &mdash; Contacto</h2>
</div>

<div class="contact-icons">
	<div class="contact-icons-item">
		<span><?php echo $phone; ?></span>
		<h1>Teléfono</h1>
		<a href="#">+01-2-8888-6868</a>
	</div>
	<div class="contact-icons-item">
		<span><?php echo $map; ?></span>
		<h1>Dirección</h1>
		<a href="#">38 Block Street, Sydney, Australia</a>
	</div>
	<div class="contact-icons-item">
		<span><?php echo $clock; ?></span>
		<h1>Horario</h1>
		<a>10:00 am to 23:00 pm</a>
	</div>
	<div class="contact-icons-item">
		<span><?php echo $envelope; ?></span>
		<h1>Email</h1>
		<a href="#">info@officepoint.com</a>
	</div>
</div>

<div class="contact-map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60254.30986434574!2d-99.6785021047472!3d19.286959381157526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd89892a50ebb9%3A0xad3f4ad5550208c4!2sToluca%20de%20Lerdo%2C%20M%C3%A9x.!5e0!3m2!1ses!2smx!4v1613103161349!5m2!1ses!2smx" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>

<div class="contact-form">
	<h1>Déjanos un Mensaje</h1>
	<form action="#" method="post">
	<div class="contact-form-input">
			<input type="text" placeholder="Nombre" name="name" required>
			<input type="text" placeholder="Tu Correo" name="email" required>
			<input type="text" placeholder="Tu Mensaje" name="message" required>
		</div>
		<button type="submit" name="enviar">ENVIAR</button>
	</form>
</div>

<?php include ('./layouts/pre-footer.php'); ?>	
<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header.js" defer></script>
<script src="js/up2.js" defer></script>
</body>
</html>
 
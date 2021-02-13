<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Nosotros</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/about-us.css?2.0"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb">
	<h1>Nosotros</h1>
	<h2><a href="./">Home</a> &mdash; Nosotros</h2>
</div>

<div class="about-info">
	<div class="about-info-item">
		<img src="img/about%201.png">
		<h1>Quiénes Somos</h1>
		<h2>Lorem ipsum dolor sit amet, consectetur adispiscing elit. Aliqusm ne elit ultrices, congue ante equis, feguiat felis. Aenean pulvinar, erat et interdum iaculis, felis ex blandit eros, ac volutpat nibh orci id sapien. Mauris consequat nisl eu vulputate lacinia. Phasellus ut arcu auismod tortor condimentum elementum blandit at massa. Donec ullamcorper semper suscipit. Sed auctor varius diam et pharetra. Sed tincidunt urna.</h2>
	</div>
	<div class="about-info-item">
		<img src="img/about%202.png">
		<h1>Nuestra Visión</h1>
		<h2>Lorem ipsum dolor sit amet, consectetur adispiscing elit. Aliqusm ne elit ultrices, congue ante equis, feguiat felis. Aenean pulvinar, erat et interdum iaculis, felis ex blandit eros, ac volutpat nibh orci id sapien. Mauris consequat nisl eu vulputate lacinia. Phasellus ut arcu auismod tortor condimentum elementum blandit at massa. Donec ullamcorper semper suscipit. Sed auctor varius diam et pharetra. Sed tincidunt urna.</h2>
	</div>
</div>

<div class="about-why-us">
	<h1>¿Por qué Nosotros?</h1>
	<h2>Nuestros Beneficios</h2>
	<div class="about-why-us-benefits">
		<div class="about-why-us-video">
			<img src="img/why-us.png">
		</div>
		<div class="about-why-us-carac">
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $income; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Envío Gratis</h3>
					<h4>Envíos Gratis en pedidos a partir de %500.00 pesos</h4>
				</div>
			</div>
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $piggy_bank; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Ahorra tu Dinero</h3>
					<h4>Aprovecha Nuestros Precios y Grandes Ofertas</h4>
				</div>
			</div>
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $credit_card; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Pago Seguro</h3>
					<h4>Pago protegido por protocolo HTTPS</h4>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="about-brands">
	<h1>Nuestras Marcas</h1>
	<img src="img/pritt.png">
	<div class="about-brands-img">
		<img src="img/brands.png">
	</div>
</div>


<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header.js" defer></script>
<script src="js/up2.js" defer></script>
</body>
</html>
 
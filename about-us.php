<?php
session_start();
include './php/conexion.php';
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Nosotros</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/about-us.css?16.0"> 
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
	       <?php
                   $resultado = $conexion ->query("select * from nosotros_texto order by id"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
	<div class="about-info-item">
		<img src="img/<?php echo $fila[3]; ?>" alt="<?php echo $fila[4]; ?>" title="<?php echo $fila[4]; ?>">
		<h1><?php echo $fila[1]; ?></h1>
		<h2><?php echo $fila[2]; ?></h2>
	</div>
	<?php } ?>
</div>

<div class="about-why-us">
	<h1>¿Por qué Nosotros?</h1>
	<h2>Nuestros Beneficios</h2>
	<div class="about-why-us-benefits">
		<div class="about-why-us-video">
			<?php 
				$resultado = $conexion ->query("select * from nosotros_img where id='1'"); 
				$fila = mysqli_fetch_array($resultado);

				$resultado2 = $conexion ->query("select * from nosotros_img where id='2'"); 
				$fila2 = mysqli_fetch_array($resultado2);

				$resultado3 = $conexion ->query("select * from nosotros_img where id='3'"); 
				$fila3 = mysqli_fetch_array($resultado3);

				$resultado4 = $conexion ->query("select * from nosotros_img where id='4'"); 
				$fila4 = mysqli_fetch_array($resultado4);

				$resultado5 = $conexion ->query("select * from nosotros_img where id='5'"); 
				$fila5 = mysqli_fetch_array($resultado5);

				$resultado6 = $conexion ->query("select * from nosotros_img where id='6'"); 
				$fila6 = mysqli_fetch_array($resultado6);

				$resultado7 = $conexion ->query("select * from nosotros_img where id='7'"); 
				$fila7 = mysqli_fetch_array($resultado7);
			
			?>
			<img src="img/<?php echo $fila[1]; ?>" alt="<?php echo $fila[2] ?>" title="<?php echo $fila[2] ?>">
		</div>
		<div class="about-why-us-carac">
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $income; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Envío Gratis</h3>
					<h4>Envíos Gratis en pedidos a partir de $2,199 pesos</h4>
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
	<img src="img/<?php echo $fila2[1]; ?>" alt="<?php echo $fila2[2] ?>" title="<?php echo $fila2[2] ?>">
	<div class="about-brands-img-prev">
		<div class="about-brands-img">
			<img src="img/<?php echo $fila3[1]; ?>" alt="<?php echo $fila3[2] ?>" title="<?php echo $fila3[2] ?>">
			<img src="img/<?php echo $fila4[1]; ?>" alt="<?php echo $fila4[2] ?>" title="<?php echo $fila4[2] ?>">
			<img src="img/<?php echo $fila5[1]; ?>" alt="<?php echo $fila5[2] ?>" title="<?php echo $fila5[2] ?>">
			<img src="img/<?php echo $fila6[1]; ?>" alt="<?php echo $fila6[2] ?>" title="<?php echo $fila6[2] ?>">
			<img src="img/<?php echo $fila7[1]; ?>" alt="<?php echo $fila7[2] ?>" title="<?php echo $fila7[2] ?>">
		</div>
	</div>
</div>


<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
</body>
</html>
 
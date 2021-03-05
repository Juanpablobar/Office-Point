<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Inicio</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<noscript><link rel="stylesheet" href=".css/owl.carousel.css"></noscript>
    <link rel="preload" href="css/owl.theme.default.css?1.0" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="stylesheet" href="css/index.css?21.0">
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
    <link rel="preload" href="css/owl.carousel.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="css/owl.theme.default.css?1.0"></noscript>
	
</head> 
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>



<div class="index-carousel">
	<div class="owl-carousel owl-theme owl-carousel1">
	       <?php
                include("./php/conexion.php");
                   $resultado = $conexion ->query("select * from carousel_index order by id"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
		<div class="item">
		<div class="item-img">
			<img src="img/<?php echo $fila[1]; ?>">
			<img src="img/<?php echo $fila[15]; ?>">
		</div>
		<div class="item-text <?php echo $fila[2]; ?>">
		<div class="item-text-align">
		<span style="color: <?php echo $fila[14]; ?>;background:<?php echo $fila[13]; ?>">#<?php echo $fila[12]; ?></span>
		<h1 style="color: <?php echo $fila[4]; ?>"><?php echo $fila[3]; ?></h1>
		<h2 style="color: <?php echo $fila[6]; ?>"><?php echo $fila[5]; ?></h2>
		<a class="carousel-a" href="shop?search=<?php echo $fila[12]; ?>" style="color:<?php echo $fila[9]; ?>;border-color:<?php echo $fila[10]; ?>;background:<?php echo $fila[8]; ?>"><?php echo $fila[7]; ?></a>
		</div>
			</div>
	</div>
	<?php } ?>
</div>
	</div>
	
<div class="index-icons">
	<?php
		$resultado = $conexion ->query("select * from icons_index where id='1'"); 
		$fila = mysqli_fetch_array($resultado)
	?>
	<div class="index-icons-item">
	<div class="index-icons-cont">
		<span><img src="img/delivery.svg"></span>
		<h1><?php echo $fila[1]; ?></h1>
		<h2><?php echo $fila[2]; ?></h2>
	</div>
	</div>
	<?php
		$resultado2 = $conexion ->query("select * from icons_index where id='2'"); 
		$fila2 = mysqli_fetch_array($resultado2)
	?>
	<div class="index-icons-item">
	<div class="index-icons-cont">
		<span><img src="img/price-tag.svg"></span>
		<h1><?php echo $fila2[1]; ?></h1>
		<h2><?php echo $fila2[2]; ?></h2>
	</div>
	</div>
	<?php
		$resultado3 = $conexion ->query("select * from icons_index where id='3'"); 
		$fila3 = mysqli_fetch_array($resultado3)
	?>
	<div class="index-icons-item">
	<div class="index-icons-cont">
		<span><img src="img/medal.svg"></span>
		<h1><?php echo $fila3[1]; ?></h1>
		<h2><?php echo $fila3[2]; ?></h2>
	</div>
	</div>
</div>

<div class="index-categories">
	       <?php
                   $resultado = $conexion ->query("select * from categorias_index order by id"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
	<div class="index-categories-item <?php echo $fila[1]; ?> <?php echo $fila[2]; ?>" style="background-image: url('img/<?php echo $fila[3]; ?>');background-size:cover;">
		<div class="index-categories-text <?php echo $fila[4]; ?> <?php echo $fila[5]; ?>">
			<div class="index-categories-text-sub">
				<h2 style="text-transform:uppercase;color: <?php echo $fila[7]; ?>">#<?php echo $fila[6]; ?></h2>
				<h1 style="color: <?php echo $fila[9]; ?>"><?php echo $fila[8]; ?></h1>
				<a style="color: <?php echo $fila[10]; ?>" href="shop?search=<?php echo $fila[6]; ?>"><?php echo $fila[11]; ?> <?php echo $arrow_right; ?></a>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<div class="index-shop">
	<h1>Nuevos Productos</h1>
	<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</h2>
	
	<div class="index-shop-items">
	       <?php
                   $resultado = $conexion ->query("select * from productos order by id DESC limit 8"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
		<div class="item-shop">
			<div class="item-shop-cont">
			<div class="item-shop-prev">
					<div class="item-shop-img">
						<img src="img/<?php echo $fila[6]; ?>">
						<div class="item-shop-hide">
							<div class="item-shop-hide-top">
								<div class="item-shop-hide-a"><a href="wishlist?id=<?php echo $fila[0]; ?>&cant=1" title="Agregar a la lista de deseos"><?php echo $heart; ?></a></div>
								<div class="item-shop-hide-a"><a href="shop?search=<?php echo $fila['categoria'] ?>" title="Buscar productos similares"><?php echo $loupe; ?></a></div>
							</div>
							<div class="item-shop-hide-bottom">
								<div class="item-shop-hide-a"><a href="cart?id=<?php echo $fila[0]; ?>&cant=1" title="Agregar al carrito"><?php echo $bag; ?></a></div>
							</div>
						</div>
						<?php
						$fecha = date("Y-m-d");
						if($fila[4] < $fecha || $fila[4] == 0){
							$update = $conexion ->query("UPDATE productos SET descuento='0' WHERE id=".$fila[0])or die($conexion->error);
						}else{
						$date = $fila[4];
						echo "<div class='item-shop-clock' id='countdown".$fila[0]."'>
						<script>
						var end".$fila[0]." = new Date('".$date." 11:59 PM'); 

							var _second = 1000;
							var _minute = _second * 60;
							var _hour = _minute * 60;
							var _day = _hour * 24;
							var timer;

							function showRemaining() {
								var now = new Date();
								var distance = end".$fila[0]." - now;
								if (distance < 0) {

									clearInterval(timer);
									document.getElementById('countdown".$fila[0]."').remove();
									return;
								}
								var days = Math.floor(distance / _day);
								var hours = Math.floor((distance % _day) / _hour);
								var minutes = Math.floor((distance % _hour) / _minute);
								var seconds = Math.floor((distance % _minute) / _second);

								document.getElementById('countdown".$fila[0]."').innerHTML = 
									'<div><h1>' + days + '</h1><h2>DÍAS</h2></div> : ';
								document.getElementById('countdown".$fila[0]."').innerHTML += 
									'<div><h1>' + hours + '</h1><h2>HORAS</h2></div> : ';
								document.getElementById('countdown".$fila[0]."').innerHTML += 
									'<div><h1>' + minutes + '</h1><h2>MINS</h2></div> :';
								document.getElementById('countdown".$fila[0]."').innerHTML +=
									'<div><h1>' + seconds + '</h1><h2>SECS</h2></div>';
							}

							timer = setInterval(showRemaining, 1000);
														</script> 
								</div>";						}
					
						if($fila[5] == 'si'){
						echo '<div class="item-shop-new">
							<span>New</span>
						</div>';
						}else{
							echo '';
						}
					
						if($fila[3] > 0){
						echo '<div class="item-shop-discounts">
							<span>-'.$fila[3].'%</span>
						</div>';
						}else{
							echo '';
						}
						?>
					</div>
					<div class="item-shop-text">
						<a href="shop-single?name=<?php echo $fila[1];?>&id=<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></a>
						<?php
								$percent = round($fila[3]/100*$fila[2]);
							if($fila[3] > 0){
								echo '<h2 class="item-shop-h2-first">$'.$fila[2].'.00</h2>';
								echo '<h2 class="item-shop-h2-second	" style="color:#ff6363">$'.($fila[2] - $percent).'.00</h2>';
							}else{
							echo '<h2>$'.$fila[2].'.00</h2>'; 
							}
							?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<div class="index-clock">
	       <?php
                $resultado = $conexion ->query("select * from reloj_index order by id"); 
                while($fila = mysqli_fetch_array($resultado)){
                ?>
    <div class="index-clock-cont">
		<div class="index-clock-img">
			<img src="img/<?php echo $fila[1]; ?>">
		</div>
		<div class="index-clock-text-flex">
			<div class="index-clock-text">
				<h4 style="background: <?php echo $fila[2]; ?>;color: <?php echo $fila[3] ;?>">#<?php echo $fila[4]; ?></h4>
				<h1>Ofertas de la Semana</h1>
				<div class="index-clock-clock">
	<?php
							if($fila[5] > 0){
							$date = $fila[5];
							echo "<div class='item-shop-clock' id='clock'>
							<script>
							var end_clock = new Date('".$date." 12:00 AM'); 

								var _second = 1000;
								var _minute = _second * 60;
								var _hour = _minute * 60;
								var _day = _hour * 24;
								var timer;

								function showRemaining() {
									var now = new Date();
									var distance = end_clock - now;
									if (distance < 0) {

										clearInterval(timer);
										document.getElementById('clock').remove();

										return;
									}
									var days = Math.floor(distance / _day);
									var hours = Math.floor((distance % _day) / _hour);
									var minutes = Math.floor((distance % _hour) / _minute);
									var seconds = Math.floor((distance % _minute) / _second);

									document.getElementById('clock').innerHTML = 
										'<div><div><h1>' + days + '</h1><h2>Días</h2></div></div>';
									document.getElementById('clock').innerHTML += 
										'<div><div><h1>' + hours + '</h1><h2>Horas</h2></div></div>';
									document.getElementById('clock').innerHTML += 
										'<div><div><h1>' + minutes + '</h1><h2>Mins</h2></div></div>';
									document.getElementById('clock').innerHTML +=
										'<div><div><h1>' + seconds + '</h1><h2>Secs</h2></div></div>';
								}

								timer = setInterval(showRemaining, 1000);
															</script> 
									</div>";
							}else{
								echo '';
							}
							?>
							</div>
				<a class="clock-a" href="shop?search=<?php echo $fila[9]; ?>" style="background:<?php echo $fila[6]; ?>;color: <?php echo $fila[7]; ?>;border-color: <?php echo $fila[8]; ?>">COMPRAR <?php echo $arrow_right; ?></a>
				<style>
					.clock-a:hover{
						background: <?php echo $fila[8]; ?> !important;
						color: <?php echo $fila[6]; ?> !important;
					}
					.clock-a svg{
						transition: none !important; 
					}
				</style>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<?php
    if (isset($_GET['success'])) {
        ?>
<div class="modal-contact">
	<div class="modal-contact-cont">
		<div class="modal-contact-text">
			<div class="modal-contact-span">
				<span class="modal_span"><i class="fa fa-times"></i></span>
			</div>
			<div class="modal-contact-h2">
				<h2>Gracias por regístrarte, nos pondremos en contacto contigo lo antes posible.<br> ¡Gracias!</h2>
			</div>
		</div>
	</div>
</div>
<?php
    }elseif(isset($_GET['invalid_email'])){
?>
<div class="modal-contact">
	<div class="modal-contact-cont">
		<div class="modal-contact-text">
			<div class="modal-contact-span">
				<span class="modal_span"><i class="fa fa-times"></i></span>
			</div>
			<div class="modal-contact-h2">
				<h2 style="color:#FF6363">Por favor introduce un correo electrónico válido</h2>
			</div>
		</div>
	</div>
</div>
<?php
	}elseif(isset($_GET['error'])){
?>
<div class="modal-contact">
	<div class="modal-contact-cont">
		<div class="modal-contact-text">
			<div class="modal-contact-span">
				<span class="modal_span"><i class="fa fa-times"></i></span>
			</div>
			<div class="modal-contact-h2">
				<h2 style="color:#FF6363">Por favor llena todos los campos</h2>
			</div>
		</div>
	</div>
</div>
<?php
	}else{
		echo '';
	}
?>


<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>

<script defer>
    $('.owl-carousel1').owlCarousel({
    loop:true,
    margin:0,
    items: 1,
    autoplay: true,
    touchDrag: true,
	mouseDrag: true,
	dots: false,
	autoplayTimeout: 5000,
	autoplayHoverPause: true,
	navText: ['<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>','<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>'],
	responsive: {
		0:{
			nav: false
		},
		600:{
			nav: true
		}
	}
});

    </script>
<script defer>
	$(document).ready(function(){
	$(".index-categories-item").click(function(){
	window.location = $(this).find("div:first a:first").attr("href");
	});
	$(".item-shop-img").click(function(){
	window.location = $(this).parent("div").find(".item-shop-text a:first").attr("href");
	});
});
	</script>
<script>
	$(document).ready(function(){
		$('.modal_span').click(function(){
			$('.modal-contact').fadeOut();
		})
	})
</script>
</body>
</html>
 
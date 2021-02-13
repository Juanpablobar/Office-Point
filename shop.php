<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Tienda</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/shop.css"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb breadcrumb-shop">
	<h1>Artículos de Oficina</h1>
	<h2><a href="./">Home</a> &mdash; Tienda</h2>
</div>

<div class="shop-filter">
	<div class="shop-filter-cont">
		<div class="shop-filter-first">
		   <select onchange="location = this.options[this.selectedIndex].value;">
			   <option value="shop">Filtrar</option>
			   <option value="shop?orderby=popularity">Ordenar por popularidad</option>
			   <option value="shop?orderby=calification">Ordenar por calificación promedio</option>
			   <option value="shop?orderby=last">Ordenar por último</option>
			   <option value="shop?orderby=lowerprice">Ordenar por precio: de menor a mayor</option>
			   <option value="shop?orderby=higherprice">Ordenar por precio: de mayor a menor</option>
		   </select>
		</div>
		<div class="shop-filter-second">
			<h2>Mostrar 1-12 de 45</h2>
		</div>
		<div class="shop-filter-third">
			<h2> Ver <a href="#">12</a> <a href="#">24</a> <a href="#">Todo</a></h2>
		</div>
		<div class="shop-filter-fourth">
	   <select onchange="location = this.options[this.selectedIndex].value;">
		   <option value="shop">Filtrar por</option>
		   <option value="shop?orderby=popularity">Ordenar por popularidad</option>
		   <option value="shop?orderby=calification">Ordenar por calificación promedio</option>
		   <option value="shop?orderby=last">Ordenar por último</option>
		   <option value="shop?orderby=lowerprice">Ordenar por precio: de menor a mayor</option>
		   <option value="shop?orderby=higherprice">Ordenar por precio: de mayor a menor</option>
	   </select>
	   <span><?php echo $grid; ?></span>
	   <span><?php echo $list; ?></span>
	</div>
	</div>
</div>

<div class="shop-products">
	<div class="shop-products-first">
		<div class="shop-categories">
			<h1>Categorías</h1>
			<a href="#">Oficina</a>
			<a href="#">Escolar</a>
			<a href="#">Papel</a>
			<a href="#">Colores</a>
			<a href="#">Lápices</a>
			<a href="#">Marcadores</a>
			<a href="#">Gomas</a>
		</div>
		<div class="shop-price">
			<h1>Precio</h1>
			<input type="range">
			<h2>$15 - $540</h2>
		</div>
		<div class="shop-colors">
			<h1>Colores</h1>
			<h2><span></span> Blanco</h2>
			<h2><span></span> Gris</h2>
			<h2><span></span> Rojo</h2>
			<h2><span></span> Negro</h2>
			<h2><span></span> Azul</h2>
			<h2><span></span> Verde</h2>
		</div>
		<div class="shop-size">
			<h1>Tamaños</h1>
			<div class="shop-size-items">
				<h2>L</h2>
				<h2>M</h2>
				<h2>S</h2>
				<h2>XL</h2>
				<h2>XXL</h2>
				<h2>Todos</h2>
			</div>
		</div>
		<div class="shop-recents">
			<h1>Recientes</h1>
		</div>
		<div class="shop-tags">
			<h1>Etiquetas</h1>
			<div class="shop-tag-items">
				<h2>LOREM</h2>
				<h2>LOREM</h2>
				<h2>LOREM</h2>
				<h2>LOREM</h2>
				<h2>LOREM</h2>
				<h2>LOREM</h2>
				<h2>LOREM</h2>
				<h2>LOREM</h2>
			</div>
		</div>
	</div>
	<div class="shop-products-second">
	       <?php
				include("./php/conexion.php");
                   $resultado = $conexion ->query("select * from productos order by id DESC"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
		<div class="item-shop">
			<div class="item-shop-cont">
			<div class="item-shop-prev">
					<div class="item-shop-img">
						<img src="img/<?php echo $fila[6]; ?>">
						<div class="item-shop-hide">
							<div class="item-shop-hide-top">
								<div class="item-shop-hide-a"><a href="#" title="Agregar a la lista de deseos"><?php echo $heart; ?></a></div>
								<div class="item-shop-hide-a"><a href="#" title="Buscar productos similares"><?php echo $loupe; ?></a></div>
							</div>
							<div class="item-shop-hide-bottom">
								<div class="item-shop-hide-a"><a href="#" title="Agregar al carrito"><?php echo $bag; ?></a></div>
							</div>
						</div>
						<?php
						if($fila[4] > 0){
						$update = $conexion ->query("UPDATE productos SET descuento='0' WHERE id='$fila[0]'");

						$date = $fila[4] ;
						echo "<div class='item-shop-clock' id='countdown".$fila[0]."'>
						<script>
						var end".$fila[0]." = new Date('".$date." 12:00 AM'); 

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
								</div>";
						}else{
							echo '';
						}
						if($fila[5] == 'true'){
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
						<a href="shop-single?id=<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></a>
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



<?php include ('./layouts/pre-footer.php'); ?>	

<?php include ('./layouts/footer.php'); ?>	
	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header.js" defer></script>
<script src="js/up2.js" defer></script>

<script defer>
	$(document).ready(function(){
	$(".item-shop").click(function(){
	window.location = $(this).find(".item-shop-text a:first").attr("href");
	});
});
	</script>
</body>
</html>
 
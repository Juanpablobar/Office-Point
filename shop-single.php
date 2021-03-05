<?php
session_start();
include("./php/conexion.php");
if( isset($_GET["id"])){
    $resultado = $conexion ->query("select * from productos where id=".$_GET["id"])or die($conexion->error);
    if(mysqli_num_rows($resultado) > 0){
        $fila = mysqli_fetch_row($resultado);    
    
}else{
    header("Location: ./shop");
    }
}else{
    //redireccionar
    header("Location: ./shop");
}
	$resultado2 = $conexion ->query("SELECT * FROM comentarios INNER JOIN productos ON comentarios.id_producto = productos.id WHERE productos.id=".$_GET['id'])
	or die($conexion->error);		
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Search Engine -->
	<meta name="description" content="<?php echo $fila[9]; ?>">
	<meta name="image" content="https://equipamostuoficina.com/img/logo.png">
	<!-- Schema.org for Google -->
	<meta itemprop="name" content="Comprar <?php echo $fila[1]; ?>">
	<meta itemprop="description" content="<?php echo $fila[9]; ?>">
	<meta itemprop="image" content="https://equipamostuoficina.com/img/logo.png">
	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Comprar <?php echo $fila[1]; ?>">
	<meta name="twitter:description" content="<?php echo $fila[9]; ?>">
	<meta name="twitter:image:src" content="https://equipamostuoficina.com/img/<?php echo $fila[6]; ?>">
	<!-- Twitter - Product (e-commerce) -->
	<!-- Open Graph general (Facebook, Pinterest & Google+) -->
	<meta property="og:title" content="Comprar <?php echo $fila[1]; ?>">
	<meta property="og:description" content="<?php echo $fila[9]; ?>">
	<meta property="og:image" content="https://equipamostuoficina.com/img/<?php echo $fila[6]; ?>">
	<meta property="og:image:width" content="200">
	<meta property="og:image:height" content="200">
	<meta property="og:type" content="product">
	<meta property="og:url" content="https://equipamostuoficina.com/shop-single?id=<?php echo $fila[0]; ?>">
	<meta property="og:site_name" content="Office Point">
	<meta property="og:locale" content="es_ES">
	<meta property="og:type" content="product">
	<!-- Open Graph - Product (e-commerce) -->
	<meta name="product:price:currency" content="MX">
	<meta name="product:price:amount" content="<?php echo $fila[2]; ?>">    
   
    <title>Office Point | Comprar <?php echo $fila[1]; ?></title>
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/shop-single.css?16.0"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	<link rel="preload" href="css/owl.carousel.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="css/owl.carousel.css"></noscript>
	<link rel="preload" href="css/owl.theme.default.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="css/owl.theme.default.css"></noscript>
    <noscript><link rel="stylesheet" href="icofont/icofont.min.css"></noscript>    <link rel="preload" href="fancybox-master/dist/jquery.fancybox.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb breadcrumb-shop-single">
	<h1>Detalles del Producto</h1>
	<h2><a href="./">Home</a> &mdash; <a href="shop">Tienda</a> &mdash; <?php echo $fila[1]; ?></h2>
</div>

<div class="single-product">
	<div class="single-product-img">
		<div class="owl-carousel owl-carousel1 owl-theme">
			<div class="owl-item" data-hash="one">
				<a data-fancybox="gallery" data-type="image" rel="group1" href="img/<?php echo $fila[6]; ?>" data-caption="<?php echo $fila[1]; ?>">
				<img src="img/<?php echo $fila[6]; ?>">
				</a>	
				<div class="heart-hide">
					<a href="wishlist?id=<?php echo $fila[0]; ?>"><?php echo $heart ?></a>
				</div>
			</div>
			<div class="owl-item" data-hash="two">
				<a data-fancybox="gallery" data-type="image" rel="group1" href="img/<?php echo $fila[7]; ?>" data-caption="<?php echo $fila[1]; ?>">
				<img src="img/<?php echo $fila[7]; ?>">
				</a>	
				<div class="heart-hide">
					<a href="wishlist?id=<?php echo $fila[0]; ?>"><?php echo $heart ?></a>
				</div>
			</div>
			<div class="owl-item" data-hash="three">
				<a data-fancybox="gallery" data-type="image" rel="group1" href="img/<?php echo $fila[8]; ?>" data-caption="<?php echo $fila[1]; ?>">
				<img src="img/<?php echo $fila[8]; ?>">
				</a>	
				<div class="heart-hide">
					<a href="wishlist?id=<?php echo $fila[0]; ?>"><?php echo $heart ?></a>
				</div>
			</div>
		</div>
		<div class="single-product-img-links">
			<a href="#one"><img src="img/<?php echo $fila[6]; ?>"></a>
			<a href="#two"><img src="img/<?php echo $fila[7]; ?>"></a>
			<a href="#three"><img src="img/<?php echo $fila[8]; ?>"></a>
		</div>
	</div>
	<div class="single-product-text">
		<div class="single-product-span">
			<h1><?php echo $fila[1]; ?></h1>
			<?php
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
		<div class="single-product-stars">
			<div class="single-product-stars-icons">
				<?php
				$resultado3 = $conexion ->query("SELECT SUM(calificacion) as mtotal FROM comentarios where id_producto=".$_GET['id'])
				or die($conexion->error);	
				$resultado4 = mysqli_fetch_array($resultado3, MYSQLI_ASSOC);
				$calificacion = $resultado4['mtotal'] / mysqli_num_rows($resultado2);
				if($calificacion == 5){
					echo $star_fill_5;
				}elseif($calificacion < 5 && $calificacion >= 4.5){
					echo $star_half9;
				}elseif($calificacion < 4.5 && $calificacion >= 4){
					echo $star_half8;
				}elseif($calificacion < 4 && $calificacion >= 3.5){
					echo $star_half7;
				}elseif($calificacion < 3.5 && $calificacion >= 3){
					echo $star_half6;
				}elseif($calificacion < 3 && $calificacion >= 2.5){
					echo $star_half5;
				}elseif($calificacion < 2.5 && $calificacion >= 2){
					echo $star_half4;
				}elseif($calificacion < 2 && $calificacion >= 1.5){
					echo $star_half3;
				}elseif($calificacion < 1.5 && $calificacion >= 1){
					echo $star_half2;
				}elseif($calificacion < 1 && $calificacion >= 0.5){
					echo $star_half1;
				}else{
					echo $star_5;
				}
				?>
			</div>
			<h2>(<?php
				if(mysqli_num_rows($resultado2) == 1){
					echo mysqli_num_rows($resultado2).' calificación';
				}else{
					echo mysqli_num_rows($resultado2).' calificaciones';
				} 
				?>
			)</h2>
		</div>
	<div class="single-if-discount">
		<?php
			if($fila[3] > 0){
			$percent = round($fila[3]/100*$fila[2]);			
			echo '<a>$'.$fila[2].'.00</a> <h3>$'.($fila[2]-$percent).'.00</h3>';
			}else{
				echo '<h3>$'.$fila[2].'.00</h3>';
			}  
			?>
	</div>
		<h4><?php echo $fila[9]; ?></h4>
		<form action="./php/wishlist_cart.php" method="post">
        <input type="hidden" value="<?php echo $fila[0]; ?>" name="id">
		<div class="input-group">
            <div class="input-group-prepend">
                <button class="js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="text" class="form-control" value="1" name="cant" readonly>
              <div class="input-group-append">
                <button class="js-btn-plus" type="button">&plus;</button>
              </div>
			</div>
              
              <?php
				if($fila[10] > 0){
              echo "<button type='submit' name='cart' title='Añadir al carrito'>Agregar al carro</button>
              <button type='submit' name='wishlist' title='Añadir a la lista de deseos'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-heart-fill' viewBox='0 0 16 16'>
			<path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
			</svg></button>";
				}else{
			echo "<button class='disabled' type='submit' name='cart' title='Añadir al carrito' disabled>No Disponible</button>
              <button class='disabled' type='submit' name='wishlist' title='Añadir a la lista de deseos' disabled><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-heart-fill' viewBox='0 0 16 16'>
			<path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z'/>
			</svg></button>";				}
				  ?>
		</form>
		<div class="single-text-desc single-text-desc1">
			<h5>Disponibilidad:</h5>
			<h6>
			<?php
				if($fila[10] > 0){
					echo 'En Stock';
				}else{
					echo 'No Disponible';
				}
			?>
			</h6>
		</div>
		<div class="single-text-desc">
			<h5>Dimensiones:</h5>
			<h6><?php echo $fila[11]; ?></h6>
		</div>
		<div class="single-text-desc">
			<h5>Peso:</h5>
			<h6><?php echo $fila[12]; ?></h6>
		</div>
		<div class="single-text-desc">
			<h5>Compartir:</h5>
			<div class="single-social">
				<a href="https://www.facebook.com/sharer/sharer.php?u=https://equipamostuoficina.com/shop-single.php?id=<?php echo $fila[0];?>" target="_blank" title="Compartir en Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
				<a href="https://twitter.com/intent/tweet?text=Checa%20este%20producto%20que%20me%20encontré%20en%20Office%20Point=https://equipamostuoficina.com/shop-single.php?id=<?php echo $fila[0];?>" target="_blank" title="Compartir en Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
				<a href="https://pinterest.com/pin/create/button/?url=https%3A//equipamostuoficina.com/shop-single?id=<?php echo $fila[0]; ?>&media=https%3A//equipamostuoficina.com/img/<?php echo $fila[6]; ?>&description=<?php echo $fila[9]; ?>" target="_blank" title="Compartir en Pinterest"><i class="fab fa-pinterest-square" aria-hidden="true"></i></a>
				<a href="whatsapp://send?text=https%3A%2F%2Fequipamostuoficina.com/shop-single?id=<?php echo $fila[0]; ?>" target="_blank" title="Compartir en Whatsapp"><i class="fab fa-whatsapp"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="single-description">
	<div class="single-descriptions-links">
		<a href="#description" id="desc" class="single-descriptions-a">Descripción</a>
		<a href="#information" id="info">Información</a>
		<a href="#reviews" id="rev">Opiniones (<?php echo mysqli_num_rows($resultado2);?>)</a>
	</div>
	<div class="owl-carousel owl-carousel2 owl-theme">
		<div class="owl-item" data-hash="description">
			<h1>Descripción del producto</h1>
			<h2><?php echo $fila[13] ;?></h2>
			<h1>Materiales Usados</h1>
			<h2><?php echo $fila[14] ;?></h2>
		</div>
		<div class="owl-item" data-hash="information">
			<h1>Información del producto</h1>
			<h2><?php echo $fila[15] ?></h2>
		</div>
		<div class="owl-item" data-hash="reviews">
			<?php
				if(mysqli_num_rows($resultado2) == 0){
					echo 
					'<h2 class="no-reviews">Aún no hay reseñas</h2>
					<h1>Sé el primero en valorar "'.$fila[1].'"</h1>
					';
				}else{
				while ($f = mysqli_fetch_row($resultado2)){
					?>
					<div class="single-description-reviews">
						<div class="single-description-img">
							<span><?php echo substr($f[1],0,1) ?></span>
						</div>
						<div class="single-description-text">
							<div class="single-descriptions-text-sub">
								<div class="single-descriptions-name">
								<h3><?php echo $f[1]; ?> - <?php echo $f[6].' de '.$f[7].' del '.$f[8] ?></h3>
								</div>
								<div class="single-descriptions-stars">
									<?php
										if($f[4] == 5){
											echo $star_fill_5;
										}elseif($f[4] == 4){
											echo $star_half8;
										}elseif($f[4] == 3){
											echo $star_half6;
										}elseif($f[4] == 2){
											echo $star_half4;
										}else{
											echo $star_half2;
										}
									?>
								</div>
							</div>
							<div class="single-descriptions-comment">
								<h3><?php echo $f[3] ?></h3>
							</div>
						</div>
					</div>
					<?php } echo '<h1>Agrega una reseña</h1>
					<h2 style="margin-bottom:2em">Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados con un *.</h2>'; }?>
			<form action="./php/reviews.php" method="post">
			<input name="id" value="<?php echo $fila[0]; ?>" type="hidden">
			<h3>Tu calificación *</h3>
			<div class="reviews-stars">
				<input id="radio1" type="radio" name="estrellas" value="5">
				<label for="radio1"><?php echo $star_fill; ?></label>
				<input id="radio2" type="radio" name="estrellas" value="4">
				<label for="radio2"><?php echo $star_fill; ?></label>
				<input id="radio3" type="radio" name="estrellas" value="3">
				<label for="radio3"><?php echo $star_fill; ?></label>
				<input id="radio4" type="radio" name="estrellas" value="2">
				<label for="radio4"><?php echo $star_fill; ?></label>
				<input id="radio5" type="radio" name="estrellas" value="1" required>
				<label for="radio5"><?php echo $star_fill; ?></label>
 			</div>
 			<h3>Tu reseña *</h3>
 			<input type="text" name="review" class="input-message" required>
 			<h3>Nombre *</h3>
 			<input type="text" name="name" required>
 			<h3>Correo electrónico *</h3>
 			<input type="text" name="email" required>
 			<button type="submit" name="send">Enviar</button>
			</form>
		</div>
	</div>
</div>

<div class="single-features">
	<h1>Productos Similares</h1>
	<div class="owl-carousel owl-carousel3 owl-theme">
	   <?php
			   $resultado = $conexion ->query("select * from productos order by id DESC"); 

			while($fila = mysqli_fetch_array($resultado)){
			?>
		<div class="owl-item">
			<div class="item-shop">
				<div class="item-shop-cont">
				<div class="item-shop-prev">
						<div class="item-shop-img">
							<img src="img/<?php echo $fila[7]; ?>">
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
		</div>
		<?php } ?>
	</div>
   	<div class="single-features-second">
	   <?php
			   $resultado = $conexion ->query("select * from productos order by id DESC limit 4"); 

			while($fila = mysqli_fetch_array($resultado)){
			?>
			<div class="item-shop">
				<div class="item-shop-cont">
				<div class="item-shop-prev">
						<div class="item-shop-img">
							<img src="img/<?php echo $fila[7]; ?>">
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
				<div class="heart-hide heart-hide-second">
					<a href="wishlist?id=<?php echo $fila[0]; ?>"><?php echo $heart ?></a>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>


<?php include ('./layouts/pre-footer.php'); ?>	
<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/reload.js" defer></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
<script src="fancybox-master/dist/jquery.fancybox.min.js" defer></script>
<script>
    $('.owl-carousel1').owlCarousel({
    loop:false,
    margin:0,
    items: 1,
    autoplay: false,
    touchDrag: false,
	mouseDrag: false,
	dots: false,
	nav: false,
	URLhashListener: true,
	smartSpeed: 0,
	startPosition: 2
	});
    $('.owl-carousel2').owlCarousel({
    loop:false,
    margin:0,
    items: 1,
    autoplay: false,
    touchDrag: false,
	mouseDrag: false,
	dots: false,
	nav: false,
	URLhashListener: true,
	smartSpeed: 0,
	autoHeight: true
	});
    $('.owl-carousel3').owlCarousel({
    loop:false,
    margin:0,
    autoplay: false,
    touchDrag: true,
	mouseDrag: true,
	dots: false,
	margin: 20,
	nav:true,
	navText: ['<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>','<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>'],
	responsive: {
		0:{
			items:2
		},
		700:{
			items:3
		},
		900:{
			items: 4
		}
	}
});
	var sitePlusMinus=function(){$(".js-btn-minus").on("click",function(n){n.preventDefault(),1!=$(this).closest(".input-group").find(".form-control").val()?$(this).closest(".input-group").find(".form-control").val(parseInt($(this).closest(".input-group").find(".form-control").val())-1):$(this).closest(".input-group").find(".form-control").val(parseInt(1))}),$(".js-btn-plus").on("click",function(n){n.preventDefault(),$(this).closest(".input-group").find(".form-control").val(parseInt($(this).closest(".input-group").find(".form-control").val())+1)})};sitePlusMinus();

	</script>
<script defer>
      $(document).ready(function(){
   $('#cantidad').val().length < 1{
       return false;
   }

   $('#cantidad').keypress(function(tecla){
      if(tecla.charCode < 48 || tecla.charCode > 57)
      {
         return false;
      }

   });
});
</script>
<script defer>
	$(document).ready(function(){
	$('#desc').click(function(){
		$('#desc').addClass('single-descriptions-a');
		$('#info').removeClass('single-descriptions-a');
		$('#rev').removeClass('single-descriptions-a');
	});
	$('#info').click(function(){
		$('#info').addClass('single-descriptions-a');
		$('#desc').removeClass('single-descriptions-a');
		$('#rev').removeClass('single-descriptions-a');
	});
	$('#rev').click(function(){
		$('#rev').addClass('single-descriptions-a');
		$('#info').removeClass('single-descriptions-a');
		$('#desc').removeClass('single-descriptions-a');
	})
	$(".item-shop-img").click(function(){
	window.location = $(this).parent("div").find(".item-shop-text a:first").attr("href");
	});
	})
	</script>
</body>
</html>
 
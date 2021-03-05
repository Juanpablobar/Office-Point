<?php
session_start();
include("./php/conexion.php");

 ?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Tienda</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/popup.css"> 
	<link rel="stylesheet" href="css/shop.css?20.0"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	<link rel="preload" href="css/jquery.range.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="css/jquery.range.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb breadcrumb-shop">
	<?php
	$resultado25 = $conexion ->query("select max(precio) as precio from productos");
	$q1 = mysqli_fetch_array($resultado25);
	$resultado26 = $conexion ->query("select min(precio) as precio from productos");
	$q2 = mysqli_fetch_array($resultado26);
	if(isset($_GET['orderby']) || isset($_GET['search'])){
						if($_GET['orderby'] == 'lowerprice'){
							echo '<h6>Ordenar por:</h6>
							<h1 style="text-transform: capitalize;">Menor Precio</h1>';
						}elseif($_GET['orderby'] == 'higherprice') {
							echo '<h6>Ordenar por:</h6>
							<h1 style="text-transform: capitalize;">Mayor Precio</h1>';
						}elseif($_GET['orderby'] == 'last') {
							echo '<h6>Ordenar por:</h6>
							<h1 style="text-transform: capitalize;">Últimos</h1>';
						}elseif($_GET['orderby'] == 'higherdiscount') {
							echo '<h6>Ordenar por:</h6>
							<h1 style="text-transform: capitalize;">Mayores Descuentos</h1>';
						}elseif($_GET['orderby'] == 'newer') {
							echo '
							<h6>Ordenar por:</h6>
							<h1 style="text-transform: capitalize;">Más Recientes</h1>';
						}elseif($_GET['search'] != '') {
							echo '
							<h1 style="text-transform: capitalize;">'.$_GET['search'].'</h1>';
						}else{
							echo '<h1 style="text-transform: capitalize;">Tienda</h1>';
						}
					}else{
						echo '<h1 style="text-transform: capitalize;">Tienda</h1>';
					}
	 ?>
	<h2><a href="./">Home</a> &mdash; Tienda</h2>
</div>
<?php
					if(isset($_GET['orderby'])){
				   		$cuantos = mysqli_fetch_assoc($resultado2);
						if($_GET['orderby'] == 'lowerprice'){
							$order = 'precio Asc';
						}elseif($_GET['orderby'] == 'higherprice') {
							$order = 'precio desc';
						}elseif($_GET['orderby'] == 'last') {
							$order = 'id desc';
						}elseif($_GET['orderby'] == 'higherdiscount') {
							$order = 'descuento desc';
						}elseif($_GET['orderby'] == 'newer') {
							$order = 'nuevo desc';
						}else{
							$order = 'id Asc';
							}
					}else{
						$order = 'id Asc';
					}
?>
<div class="shop-filter">
	<div class="shop-filter-cont">
		<div class="shop-filter-first">
		   <select onchange="location = this.options[this.selectedIndex].value;">
			   <option value="shop">Filtrar</option>
			   <option value="shop?orderby=last">Ordenar por último</option>
			   <option value="shop?orderby=newer">Ordenar por más recientes</option>
			   <option value="shop?orderby=higherdiscount">Ordenar por mayor descuento</option>
			   <option value="shop?orderby=lowerprice">Ordenar por precio: de menor a mayor</option>
			   <option value="shop?orderby=higherprice">Ordenar por precio: de mayor a menor</option>
		   </select>
		</div>
		<div class="shop-filter-second">
			<h2 id="innerPrice">Mostrar 1-12 de
					<?php
					$betweenPrice = "'0' and '1000000'" ;
					$wherePrice = "and precio between ".$betweenPrice." or " ;
					if(isset($_GET['search'])){
						if($_GET['search'] != ''){
						$resultado = $conexion ->query("select * from productos
						where 
						nombre like '%".$_GET['search']."%'
						".$wherePrice."
						categoria like '%".$_GET['search']."%'
						".$wherePrice."
						subcategoria like '%".$_GET['search']."%' 
						".$wherePrice."
						tag1 like '%".$_GET['search']."%' 
						".$wherePrice."
						tag2 like '%".$_GET['search']."%'
						".$wherePrice."
						tag3 like '%".$_GET['search']."%' 
						and precio between ".$betweenPrice."
						order by id")or die($conexion -> error); 
						echo mysqli_num_rows($resultado);

						}else{
							$resultado2 = $conexion ->query("select count(*) id from productos order by ".$order." limit 12");
							$resultado = $conexion ->query("select * from productos where precio between ".$betweenPrice." order by ".$order." limit 12");
							$q = mysqli_fetch_assoc($resultado2);
							echo $q['id'];
							}
					}else{
                        $resultado2 = $conexion ->query("select count(*) id from productos order by ".$order." limit 12");
                        $resultado = $conexion ->query("select * from productos where precio between ".$betweenPrice." order by ".$order." limit 12");
						$q = mysqli_fetch_assoc($resultado2);
						echo $q['id'];

                    }			 ?>
					</h2>
		</div>
		<div class="shop-filter-fourth">
	   <span id="grid" class="span-list"><?php echo $grid; ?></span>
	   <span id="list"><?php echo $list; ?></span>
	</div>
	</div>
</div>

<div class="shop-products">
	<div class="shop-products-first">
		<div class="shop-categories">
			<h1>Categorías</h1>
			<?php
            $resultado11 = $conexion ->query("select * from categorias order by id"); 
            while ($fila11 = mysqli_fetch_array($resultado11)) {
                ?>
			<div class="shop-categories-dropdown">
				<div class="shop-categories-dropdown-i">
					<a href="shop?search=<?php echo $fila11[1]; ?>"><?php echo $fila11[1]; ?></a> <i class="fa fa-chevron-down iconDropDown"></i>
				</div>
			<div class="shop-categories-cont">
				<?php
				 $resultado12 = $conexion ->query("select * FROM subcategorias INNER JOIN categorias ON subcategorias.id_categoria = categorias.nombre WHERE categorias.nombre='".$fila11[1]."'")
				 or die($conexion->error);	
				 while ($f12 = mysqli_fetch_row($resultado12)){
				?>
					<a href="shop?search=<?php echo $f12[1] ?>"><?php echo $f12[1] ?></a>
					<?php } ?>
			</div>
			</div>
			<?php } ?>
		</div>
		<div class="shop-price">
			<h1>Precio</h1>
			<p><input type="hidden" class="price_range" value="0,<?php echo $q1['precio']; ?>" /></p>
        <input type="button" id="priceClick" value="FILTRAR" />
		</div>
		<div class="shop-recents">
			<h1>Recientes</h1>
			<?php
			$resultado27 = $conexion ->query("select * from productos order by rand() limit 3");
			while ($fila27 = $resultado27->fetch_assoc()) {
			?>
			<div class="shop-recents-item">
				<div class="shop-recents-img">
					<img src="/img/<?php echo $fila27['img2'] ?>" alt="<?php echo $fila27['nombre'] ?>" title="<?php echo $fila27['nombre'] ?>">
				</div>
				<div class="shop-recents-text">
					<a href="shop-single?name=<?php echo $fila27['nombre'] ?>&id=<?php echo $fila27['id'] ?>"><?php echo $fila27['nombre'] ?></a>
					<h4>$<?php echo $fila27['precio'] ?>.00</h4>
			<div class="single-product-stars-icons">
				<?php
				$resultado3 = $conexion ->query("SELECT SUM(calificacion) as mtotal FROM comentarios where id_producto=".$fila27['id'])
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

				</div>
			</div>
			<?php } ?>
		</div>
		<div class="shop-tags">
			<h1>Tags</h1>
			<div class="shop-tags-item">
			<?php
			$resultado28 = $conexion ->query("select * from tags order by rand() limit 10");
			while ($fila28 = $resultado28->fetch_assoc()) {
			?>
				<a href="shop?search=<?php echo $fila28['nombre'] ?>">#<?php echo $fila28['nombre'] ?></a>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="shop-products-second" id="postList">
	       <?php
                   if ($resultado->num_rows > 0) {
                       while ($fila = $resultado->fetch_assoc()) {
                           $postID = $fila['id']; ?>
		<div class="item-shop">
			<div class="item-shop-cont">
			<div class="item-shop-prev">
					<div class="item-shop-img">
						<img src="img/<?php echo $fila['img2']; ?>">
						<div class="item-shop-hide">
							<div class="item-shop-hide-top">
								<div class="item-shop-hide-a"><a href="wishlist?id=<?php echo $fila['id']; ?>" title="Agregar a la lista de deseos"><?php echo $heart; ?></a></div>
								<div class="item-shop-hide-a"><a href="shop?search=<?php echo $fila['categoria'] ?>" title="Buscar productos similares"><?php echo $loupe; ?></a></div>
							</div>
							<div class="item-shop-hide-bottom">
								<div class="item-shop-hide-a"><a href="cart?id=<?php echo $fila['id']; ?>&cant=1" title="Agregar al carrito"><?php echo $bag; ?></a></div>
							</div>
						</div>
						<?php
                        if ($fila['nuevo'] == 'si') {
                            echo '<div class="item-shop-new">
							<span>New</span>
						</div>';
                        } else {
                            echo '';
                        }
                    
                           if ($fila['descuento'] > 0) {
                               echo '<div class="item-shop-discounts">
							<span>-'.$fila['descuento'].'%</span>
						</div>';
                           } else {
                               echo '';
                           } ?>
					</div>
					<div class="item-shop-text-list">
					<a href="shop-single?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a>
					<h3><?php echo substr($fila['descripcion'],0,75); ?>...</h3>
					</div>
					<div class="item-shop-text">
						<a href="shop-single?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a>
						<?php
                                $percent = round($fila['descuento']/100*$fila['precio']);
                           if ($fila['descuento'] > 0) {
                               echo '<h2 class="item-shop-h2-first">$'.$fila['precio'].'.00</h2>';
                               echo '<h2 class="item-shop-h2-second	" style="color:#ff6363">$'.($fila['precio'] - $percent).'.00</h2>';
                           } else {
                               echo '<h2>$'.$fila['precio'].'.00</h2>';
                           } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php
        if ($_GET['search'] != '') {
            echo '';
        }else{
            ?>
           <div class="shop-button-charge">
            <button type="button" class="load-more" data-lastid="<?php echo $postID; ?>"><i class="fa fa-spinner"></i> CARGAR MÁS
               </button>
			   </div>
			   <?php
        } ?>
		<?php
                   }else{ ?>
					  <h2 class="empty">No se encontraron resultados, prueba buscando de nuevo</h2>
					  <?php
					   $resultado = $conexion ->query("select * from productos order by id limit 12");
                   if ($resultado->num_rows > 0) {
                       while ($fila = $resultado->fetch_assoc()) {
                           $postID = $fila['id']; ?>
		<div class="item-shop">
			<div class="item-shop-cont">
			<div class="item-shop-prev">
					<div class="item-shop-img">
						<img src="img/<?php echo $fila['img2']; ?>">
						<div class="item-shop-hide">
							<div class="item-shop-hide-top">
								<div class="item-shop-hide-a"><a href="wishlist?id=<?php echo $fila['id']; ?>" title="Agregar a la lista de deseos"><?php echo $heart; ?></a></div>
								<div class="item-shop-hide-a"><a href="shop?search=
								<?php echo $fila['categoria']; ?>
								" title="Buscar productos similares"><?php echo $loupe; ?></a></div>
							</div>
							<div class="item-shop-hide-bottom">
								<div class="item-shop-hide-a"><a href="cart?id=<?php echo $fila['id']; ?>&cant=1" title="Agregar al carrito"><?php echo $bag; ?></a></div>
							</div>
						</div>
						<?php
                        if ($fila['nuevo'] == 'si') {
                            echo '<div class="item-shop-new">
							<span>New</span>
						</div>';
                        } else {
                            echo '';
                        }
                    
                           if ($fila['descuento'] > 0) {
                               echo '<div class="item-shop-discounts">
							<span>-'.$fila['descuento'].'%</span>
						</div>';
                           } else {
                               echo '';
                           } ?>
					</div>
					<div class="item-shop-text-list">
					<a href="shop-single?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a>
					<h3><?php echo substr($fila['descripcion'], 0, 100); ?>...</h3>
					</div>
					<div class="item-shop-text">
						<a href="shop-single?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a>
						<?php
                                $percent = round($fila['descuento']/100*$fila['precio']);
                           if ($fila['descuento'] > 0) {
                               echo '<h2 class="item-shop-h2-first">$'.$fila['precio'].'.00</h2>';
                               echo '<h2 class="item-shop-h2-second	" style="color:#ff6363">$'.($fila['precio'] - $percent).'.00</h2>';
                           } else {
                               echo '<h2>$'.$fila['precio'].'.00</h2>';
                           } ?>
					</div>
				</div>
			</div>
		</div>
		<?php
                       } ?>
           <div class="shop-button-charge">
            <button type="button" class="load-more" data-lastid="<?php echo $postID; ?>"><i class="fa fa-spinner"></i> CARGAR MÁS
               </button>
			   </div>
		<?php } } ?>
	</div>
</div>


<?php
	$resultado = $conexion ->query("select * from popup where id=1");
	$popup = mysqli_fetch_array($resultado);
if(isset($_SESSION['popup'])){
	echo '';
}else{
    ?>
<div class="popup">
	<div class="popup-cont">
		<div class="popup-img">
			<img src="img/<?php echo $popup[1]; ?>">
		</div>
		<div class="popup-text">
			<div class="popup-close">
				<span id="popup_close"><i class="fa fa-times"></i></span>
			</div>
			<span><?php echo $popup[2]; ?></span>
			<h1><?php echo $popup[3]; ?></h1>
			<h2><?php echo $popup[4]; ?></h2>
			<form action="./php/mailPopup.php" method="post">
				<input type="text" name="email" placeholder="Dirección de correo" required>
				<button type="submit" name="send_email">Suscribir</button>
			</form>
		</div>
	</div>
</div>
<?php
$_SESSION['popup'] = '';
}
?>

<?php include ('./layouts/pre-footer.php'); ?>	

<?php include ('./layouts/footer.php'); ?>	
	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
<script src="js/jquery.range.js"></script>

<script defer>
	$(document).ready(function(){
	$(".item-shop").click(function(){
	window.location = $(this).find(".item-shop-text a:first").attr("href");
	})
	$("#list").click(function(){
		$("#postList").addClass("shop-products-list");
		$("#list").addClass("span-list");
		$("#grid").removeClass("span-list");
	});
	$("#grid").click(function(){
		$("#postList").removeClass("shop-products-list");
		$("#grid").addClass("span-list");
		$("#list").removeClass("span-list");
	});
	$(".iconDropDown").click(function(){
		$(this).parent('div').parent('div').find('.shop-categories-cont').slideToggle('linear');
	});
	$("#popup_close").click(function(){
		$(".popup").fadeOut('linear');
	})
});
	</script>
<script> 
$('.price_range').jRange({
    from: 0,
    to: <?php echo $q1['precio']; ?>,
    step: 1,
    format: '%s MX',
    width: 200,
    showLabels: true,
    isRange : true
});
</script>
	<script>
	$(document).ready(function(){
		var id=$(".load-more").data("lastid");
	$(".load-more").click(function(){
  	$.ajax({
    	type:"POST",
    	url:"./php/loadMore.php",
    	data:{
			id:id
	},
		beforeSend:function(id){
      	$(".shop-button-charge").fadeIn("slow")
		},
      	success:function(id){
		$(".shop-button-charge").remove(),
		$("#postList").append(id)
      	},
	})
	}),
	$("#priceClick").click(function(){
    var price_range = $('.price_range').val();
    $.ajax({
        type: 'POST',
        url: './php/precioProductos.php',
        data:{
			price_range:price_range
        }
    }).done(function(html){
			$(".item-shop").remove();
			$("#postList").html(html);
		})
})
});
	</script>
</body>
</html>
 
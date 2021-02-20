<?php
error_reporting(0); 
$archivo_actual = basename($_SERVER["PHP_SELF"]); //Regresa el nombre del archivo actual

switch($archivo_actual) //Valido en que archivo estoy para generar mi CSS de selección
 {
	 case "index2.php":
	 $a = "class='nav-a'";
	 break;
	 case "categories.php":
	 $b = "class='nav-a'";
	 break;
	  case "shop.php":
	 $c = "class='nav-a'";
	 break; 
	  case "about-us.php":
	 $d = "class='nav-a'";
	 break; 
	  case "contact.php":
	 $e = "class='nav-a'";
	 break; 
 }

include './layouts/icons.php';

?>
<header id="header">
	<nav class="nav nav1">
		<!-- Botón desplegable  -->
		<div class="nav-toggle">
			<a class="nav-toggle-button" id="toggle_sidebar">
				<span></span>
				<span></span>
				<span></span>
			</a>
		</div>
		<!-- Logo  -->
		<div class="nav-brand">
			<a href="./"><img src="./img/logo.png" alt="Office Point Logo"  title="Office Point Logo"></a>
		</div>
		<!-- Links  -->
		<div class="nav-links">
			<a href="./" <?php echo $a ?>>HOME</a>
			<a href="categories" <?php echo $b ?>>CATEGORÍAS</a>
			<a href="shop" <?php echo $c ?>>TIENDA</a>
			<a href="about-us" <?php echo $d ?>>NOSOTROS</a>
			<a href="contact" <?php echo $e ?>>CONTACTO</a>
		</div>
		<!-- Íconos  -->
		<div class="nav-icons">
		<form action="shop" method="GET">
			<div class="nav-search">
			<label>
				<input type="text" placeholder="Iniciar búsqueda..." name="search" id="search" required>
				</label>
				<button type="submit" id="button_search"><?php echo $loupe; ?></button> 
			</div>
		</form>
		<a href="wishlist" title="Tienes <?php echo count($_SESSION["wishlist"]); ?> artículos en tu lista de deseos">
			<?php echo $heart; ?>
			<span>
				<?php 
					if(isset($_SESSION["wishlist"])){
					echo count($_SESSION["wishlist"]);
					}else{
					echo 0;
					}
				?>
			</span>
		</a>
			<?php
				$items = 0;
					$arreglocarrito =$_SESSION["carrito"];
					for($i=0;$i<count($arreglocarrito);$i++){ 
					$items += $arreglocarrito[$i]['Cantidad']; 
					}
			?>
		<a href="cart" title="Tienes <?php echo $items; ?> artículos en tu carrito">
			<?php echo $bag; ?>
			<span>
			<?php
				if(isset($_SESSION["carrito"])){ 
					echo $items; 
				}else{
					echo '0'; 
				}
				?>
			</span>
		</a>
		<h1>Total: <a href="cart">$<?php
		$total = 0;
		if(isset($_SESSION["total"])){
				echo $_SESSION["total"];
		}else{
			echo '0';
		}
			?></a></h1>
		</div>
		
		<div class="nav-search-responsive">
		<form action="shop" method="GET">
			<div class="nav-search">
			<label>
				<input type="text" placeholder="Iniciar búsqueda..." name="search" id="search" required>
				</label>
				<button type="submit" id="button_search"><?php echo $loupe; ?></button> 
			</div>
		</form>
		</div>
		
		<div class="nav-toggle-responsive">
			<a id="nav-toggle-responsive">
				<span></span>
				<span></span>
				<span></span>
			</a>
		</div>
	</nav>
</header>   




<div class="sidebar" id="sidebar"></div>
	<div class="sidebar-content" id="sidebar_content">
	<div class="sidebar-first">
		<h1>Categorías</h1>
		<span id="sidebar_close"><i class="fa fa-times"></i></span>
	</div>
		<div class="sidebar-category">
		<div class="sidebar-category-first">
			<div class="sidebar-plus" id="sidebar_span1">
				<span></span>
			</div>
			<div class="sidebar-text">
				<a href="#">Escolar</a>
			</div>
			</div>
			<div class="sub-category-prev" id="sidebar_sub_category1">
			<div class="sidebar-subcategory">
				<a href="#">Libretas</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Lápices</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Colores</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Crayones</a>
			</div>
			</div>
		</div>
		<div class="sidebar-category">
		<div class="sidebar-category-first">
			<div class="sidebar-plus" id="sidebar_span2">
				<span></span>
			</div>
			<div class="sidebar-text">
				<a href="#">Papelería</a>
			</div>
			</div>
			<div class="sub-category-prev" id="sidebar_sub_category2">
			<div class="sidebar-subcategory">
				<a href="#">Libretas</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Lápices</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Colores</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Crayones</a>
			</div>
			</div>
		</div>
		<div class="sidebar-category">
		<div class="sidebar-category-first">
			<div class="sidebar-plus" id="sidebar_span3">
				<span></span>
			</div>
			<div class="sidebar-text">
				<a href="#">Escolar</a>
			</div>
			</div>
			<div class="sub-category-prev" id="sidebar_sub_category3">
			<div class="sidebar-subcategory">
				<a href="#">Libretas</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Lápices</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Colores</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Crayones</a>
			</div>
		</div>
		</div>
		<div class="sidebar-category">
		<div class="sidebar-category-first">
			<div class="sidebar-plus" id="sidebar_span4">
				<span></span>
			</div>
			<div class="sidebar-text">
				<a href="#">Escolar</a>
			</div>
			</div>
			<div class="sub-category-prev" id="sidebar_sub_category4">
			<div class="sidebar-subcategory">
				<a href="#">Libretas</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Lápices</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Colores</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Crayones</a>
			</div>
			</div>
		</div>
		<div class="sidebar-category">
		<div class="sidebar-category-first">
			<div class="sidebar-plus" id="sidebar_span5">
				<span></span>
			</div>
			<div class="sidebar-text">
				<a href="#">Papelería</a>
			</div>
			</div>
			<div class="sub-category-prev" id="sidebar_sub_category5">
			<div class="sidebar-subcategory">
				<a href="#">Libretas</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Lápices</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Colores</a>
			</div>
			<div class="sidebar-subcategory">
				<a href="#">Crayones</a>
			</div>
		</div>
		</div>
	</div>
	
	
	<div class="sidebar-second-black" id="sidebar_second_black"></div>
	<div class="sidebar-second" id="sidebar_second">
		<div class="sidebar-second-content">
			<div class="sidebar-second-item">
				<a href="./"><i class="fas fa-home"></i> Inicio</a>
			</div>
			<div class="sidebar-second-item">
				<a href="categories"><i class="fas fa-list-alt"></i> Categorías</a>
			</div>
			<div class="sidebar-second-item">
				<a href="shop"><i class="fas fa-pencil-ruler"></i> Tienda</a>
			</div>
			<div class="sidebar-second-item">
				<a href="about-us"><i class="fas fa-user-friends"></i> Nosotros</a>
			</div>
			<div class="sidebar-second-item">
				<a href="contact"><?php echo $headphones ?> Contacto</a>
			</div>
			<div class="sidebar-second-item">
				<a href="wishlist"><?php echo $heart ?> Lista de Deseos <span><?php echo count($_SESSION["wishlist"]);?></span></a>
			</div>
			<?php
				$items = 0;
					$arreglocarrito =$_SESSION["carrito"];
					for($i=0;$i<count($arreglocarrito);$i++){ 
					$items += $arreglocarrito[$i]['Cantidad']; 
					}
			?>
			<div class="sidebar-second-item">
				<a href="cart"><?php echo $bag ?> Carrito <span><?php echo $items; ?></span></a>
			</div>
		</div>
	</div>

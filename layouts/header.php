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

include './php/icons.php';

?>
<header>
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
		<form action="#" method="GET">
			<div class="nav-search">
			<label>
				<input type="text" placeholder="Iniciar búsqueda..." name="search" required>
				</label>
				<button type="submit"><?php echo $loupe; ?></button> 
			</div>
		</form>
		<a href="wishlist">
			<?php echo $heart; ?>
			<span>1</span>
		</a>
		<a href="cart">
			<?php echo $bag; ?>
			<span>2</span>
		</a>
		<h1>Total: <a href="cart">$245</a></h1>
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

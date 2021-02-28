<?php
session_start();
include("./php/conexion.php");
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Categorías</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/categories.css"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb">
	<h1>Categorías</h1>
	<h2><a href="./">Home</a> &mdash; Categorías</h2>
</div>

<div class="categories">
<?php
    $resultado = $conexion ->query("select * from categorias order by id"); 
    while($fila = mysqli_fetch_array($resultado)){
?>
    <div class="categories-item">
        <div class="categories-img">
            <img src="img/<?php echo $fila[2]; ?>" alt="<?php echo $fila[1]; ?>" title="<?php echo $fila[1]; ?>">
        </div>
        <div class="categories-text">
            <a href="shop.php?search=<?php echo $fila[1]; ?>"><?php echo $fila[1]; ?></a>
            <h2><?php echo substr($fila[3],0,75); ?>...</h2>
        </div>
        <div class="categories-shadow"></div>
    </div>
    <?php } ?>
</div>

<?php include ('./layouts/pre-footer.php'); ?>	
<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
<script defer>
	$(document).ready(function(){
	$(".categories-item").click(function(){
	window.location = $(this).find(".categories-text a:first").attr("href");
	});
});
	</script>

</body>
</html>
 
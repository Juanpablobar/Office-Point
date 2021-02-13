<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Error 404</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/error.css?1.0"> 	
</head>
<body>

<?php include ('./layouts/reload.php'); ?>

<div class="error">
<div class="error-content">
		<img src="img/404.svg">
		<img src="img/error%20404-1.png">
		<h2>Página No Encontrada</h2>
		<h3>La página que está buscando no existe</h3>
		<a href="./">Regresar a casa</a>
	</div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
</body>
</html>
 
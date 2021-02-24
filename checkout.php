<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Checkout</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="./css/checkout.css"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb breadcrumb-checkout">
	<h1>Checkout</h1>
	<h2><a href="./">Home</a> &mdash; Checkout</h2>
</div>
	<?php
        include("./php/conexion.php");
    ?>
<form action="#" method="POST">

    <div class="checkout">
        <div class="checkout-first">
            <h1>Detalles de Facturación</h1>
            <div class="checkout-inputs">
                <div class="checkout-inputs-item">
                    <h2>Nombres<a>*<a></h2>
                    <input type="text" name="first-name" placeholder="Nombres" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Appellidos<a>*<a></h2>
                    <input type="text" name="last-name" placeholder="Apellidos" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>País<a>*<a></h2>
                    <input type="text" name="country" placeholder="País" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Dirección<a>*<a></h2>
                    <input type="text" name="address1" placeholder="Calle" required>
                    <input type="text" name="address2" placeholder="Apartamento, unidad, etc (opcional)">
                </div>
                <div class="checkout-inputs-item">
                    <h2>Ciudad<a>*<a></h2>
                    <input type="text" name="city" placeholder="Ciudad"> required
                </div>
                <div class="checkout-inputs-item">
                    <h2>Estado<a>*<a></h2>
                    <input type="text" name="state" placeholder="Estado" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Código Postal<a>*<a></h2>
                    <input type="text" name="zip" placeholder="Código Postal" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Teléfono<a>*<a></h2>
                    <input type="text" name="phone" placeholder="Teléfono" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Correo Electrónico<a>*<a></h2>
                    <input type="text" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Correo Electrónico<a>*<a></h2>
                    <input type="text" name="email" placeholder="Correo Electrónico" required>
                </div>
            </div>
        </div>

        <div class="checkout-second">
        </div>

    </div>

</form>


<?php include ('./layouts/pre-footer.php'); ?>	
<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
</body>
</html>
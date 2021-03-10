<?php
session_start();
if(isset($_SESSION["carrito"])){
    //si existe buscamos si ya estaba agregado ese producto 
    if(isset($_GET["id"])){
        $arreglo =$_SESSION["carrito"];
        $encontro=false;
        $numero = 0;
        for($i=0;$i<count($arreglo);$i++){
            if($arreglo[$i]["Id"] == $_GET["id"]){
                $encontro=true;
                $numero=$i;
            }
        }
        if($encontro == true){
            $arreglo[$numero]["Cantidad"]=$arreglo[$numero]["Cantidad"]+$_GET["cant"];
            $_SESSION["carrito"]=$arreglo;
            header("Location: ./cart");
        }else{
            /// no estaba el registro
        $nombre ="";
        $imagen ="";
        $precio ="";
		$stock="";
        $res    = $conexion->query("select * from productos where id=".$_GET["id"])or die($conexion->error);
        $fila = mysqli_fetch_row($res);
        $nombre = $fila[1];
        $imagen = $fila[7];
        $precio = $fila[2];
        $stock = $fila[10];
        $arregloNuevo = array(
                    "Id" => $_GET["id"],
                    "Nombre" => $nombre,
                    "Imagen" => $imagen,
                    "Precio" => $precio,
                    "Stock"  => $stock,
                    "Cantidad" => $_GET["cant"]
        );
        
            array_push($arreglo, $arregloNuevo);
            $_SESSION["carrito"]=$arreglo;
            header("Location: ./cart");
        }
    }
    }else{
        header('Location: ./cart');
}
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Facturación</title>
	
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
	<h1>Facturación</h1>
	<h2><a href="./">Home</a> &mdash; Facturación</h2>
</div>
	<?php
        include("./php/conexion.php");
    ?>
<form action="checkout-payment" method="POST">

    <div class="checkout">
        <div class="checkout-first">
            <h1>Detalles de Facturación</h1>
            <?php
                $arregloUsuario = $_SESSION['datos_login'];
                if (isset($_SESSION['datos_login'])) {
                    $resultado = $conexion->query("
                    select * from
                    direcciones_usuarios where id_usuario='".$arregloUsuario["id"]."'")or die($conexion->error);
                    $fila = mysqli_fetch_array($resultado);
                    ?>
            <div class="checkout-inputs">
                <div class="checkout-inputs-item">
                    <h2>Nombres<a>*</a></h2>
                    <input type="text" name="first-name" placeholder="Nombres" value="<?php echo $fila[1]; ?>" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Apellidos<a>*</a></h2>
                    <input type="text" name="last-name" placeholder="Apellidos" value="<?php echo $fila[2]; ?>" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>País<a>*</a></h2>
                    <input type="text" name="country" placeholder="País" value="<?php echo $fila[3]; ?>" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Dirección<a>*</a></h2>
                    <input type="text" name="address1" placeholder="Calle" value="<?php echo $fila[4]; ?>" required>
                    <input type="text" name="address2" placeholder="Apartamento, unidad, etc (opcional)" value="<?php echo $fila[5]; ?>">
                </div>
                <div class="checkout-inputs-item">
                    <h2>Ciudad<a>*</a></h2>
                    <input type="text" name="city" placeholder="Ciudad" value="<?php echo $fila[6]; ?>" required> 
                </div>
                <div class="checkout-inputs-item">
                    <h2>Estado<a>*</a></h2>
                    <input type="text" name="state" placeholder="Estado" value="<?php echo $fila[7]; ?>" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Código Postal<a>*</a></h2>
                    <input type="text" name="zip" placeholder="Código Postal" value="<?php echo $fila[8]; ?>" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Teléfono<a>*</a></h2>
                    <input type="text" name="phone" placeholder="Teléfono" value="<?php echo $fila[9]; ?>" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Correo Electrónico<a>*</a></h2>
                    <input type="text" name="email" placeholder="Correo Electrónico" id="email" value="<?php echo $fila[10]; ?>" readonly>
                </div>

                <?php }else { ?>

                <div class="checkout-inputs">
                <div class="checkout-inputs-item">
                    <h2>Nombres<a>*</a></h2>
                    <input type="text" name="first-name" placeholder="Nombres" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Apellidos<a>*</a></h2>
                    <input type="text" name="last-name" placeholder="Apellidos" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>País<a>*</a></h2>
                    <input type="text" name="country" placeholder="País" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Dirección<a>*</a></h2>
                    <input type="text" name="address1" placeholder="Calle" required>
                    <input type="text" name="address2" placeholder="Apartamento, unidad, etc (opcional)">
                </div>
                <div class="checkout-inputs-item">
                    <h2>Ciudad<a>*</a></h2>
                    <input type="text" name="city" placeholder="Ciudad" required> 
                </div>
                <div class="checkout-inputs-item">
                    <h2>Estado<a>*</a></h2>
                    <input type="text" name="state" placeholder="Estado" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Código Postal<a>*</a></h2>
                    <input type="text" name="zip" placeholder="Código Postal" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Teléfono<a>*</a></h2>
                    <input type="text" name="phone" placeholder="Teléfono" required>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Correo Electrónico<a>*</a></h2>
                    <input type="text" name="email" placeholder="Correo Electrónico" id="email" required>
                </div>
                <?php } ?>
                <div class="checkout-inputs-item">
                    <div class="checkout-label">
                        <input type="checkbox" id="checkbox1">
                        <label class="label1" for="checkbox1"></label>
                        <label for="checkbox1" id="label2">¿Crear una cuenta?</label>
                    </div>
                    <?php
                        $arregloUsuario = $_SESSION['datos_login'];
                        if (isset($_SESSION['datos_login'])) {
                            ?>
                        <h4>Ya has iniciado sesión como <a><?php echo $arregloUsuario['nombre']; ?></a> con el correo <a><?php echo $arregloUsuario['correo'] ?></a>, ahí podrás ver el status de tu pedido y tu historial de compras.</h4>
                        <?php
                        }else{
                            ?>
                        <h3>Si aún no has creado una cuenta, es el momento de hacerlo, esto te permitirá seguir el status de tu pedido y llevar un registro de todas tus compras. Si ya la has creado solo <a href="login?checkout">Inicia Sesión</a></h3>
                        <div class="checkout-acount-pass">
                        <h2 class="email_h2">Contraseña<a>*</a></h2>
                        <input class="email_ajax" minlength="8" type="text" name="password" placeholder="Introduce al menos 8 carácteres" required>
                        </div>
                        <?php } ?>
                </div>
                <div class="checkout-inputs-item">
                    <h2>Notas sobre su pedido</h2>
                    <input type="text" name="notas" placeholder="Notas sobre su orden, ej. Notas para la entrega">
                </div>

            </div>
        </div>

        <div class="checkout-second">
            <div class="checkout-second-cont">
                <h1>Tu Orden</h1>
                <div class="checkout-second-products">
                    <div class="checkout-second-products-item">
                        <h2>Productos</h2>
                        <h2>Total</h2>
                    </div>
                    <?php
                        $total = 0;
                        if (isset($_SESSION["carrito"])) {
                            $arreglocarrito =$_SESSION["carrito"];
                            for ($i=0;$i<count($arreglocarrito);$i++) {
                                $totalIndividual= $arreglocarrito[$i]['Precio'] * $arreglocarrito[$i]['Cantidad'];
                                ?>
                    <div class="checkout-second-products-item">
                        <h3><?php echo $arreglocarrito[$i]['Nombre'] ?> <span><?php echo $arreglocarrito[$i]['Cantidad'] ?></span></h3>
                        <h4>$<?php
                            $resultado = $conexion ->query("select * from productos where id=".$arreglocarrito[$i]['Id']); 
                            $fila = mysqli_fetch_array($resultado);
                            if($fila[3] <= 0){
                                echo $arreglocarrito[$i]['Precio'] * $arreglocarrito[$i]['Cantidad'];
                                $costo2 = $fila[2];
                            }else{
                                $percent = round($fila[3]/100*$fila[2]);
                                $costo = $arreglocarrito[$i]['Precio']-$percent;
                                $costo = $costo * $arreglocarrito[$i]['Cantidad'];
                                echo $costo ;
                                $costo2 = $fila[2]-$percent;
                            } 
                                $total= $total + ($costo2 * $arreglocarrito[$i]["Cantidad"])
                                ?>.00</h4>
                    </div>
                    <?php
                            }
                        } ?>
                </div>
                <div class="checkout-second-products">
                    <div class="checkout-second-products-item">
                        <h2>Subtotal</h2>
                        <h4>$<?php echo $total ?>.00</h4>
                    </div>
                    <div class="checkout-second-products-item">
                        <h3>Envío</h3>
                        <h4>$67.00</h4>
                    </div>
                </div>
                <div class="checkout-second-products">
                    <div class="checkout-second-products-item">
                        <h2>Total</h2>
                        <h4 class="total">$<?php echo $_SESSION['total'] ?>.00</h4>
                    </div>
                </div>
                <button type="submit" name="submit" class="email_button">COMPRAR</button>
            </div>
        </div>

    </div>

</form>


<?php include ('./layouts/pre-footer.php'); ?>	
<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
<script>
    $(document).ready(function(){
        $(".checkout-acount-pass").hide();
        $(function(){
            $('#checkbox1').change(function(){
                if ($(this).is(':checked')){
                   $(".checkout-acount-pass").show();
                }else{
                    $(".checkout-acount-pass").hide();
                }
            });
        });
        var controladorTiempo = "";
        function codigoAJAX() {
            var email = $("#email").val();
            $.ajax({
				url: "./php/checkoutEmail.php",
				data:{
					email:email
				},
				method: 'POST'
			}).done(function(respuesta){
                $(".email_h2").remove();
                $(".email_ajax").remove();
                $(".checkout-acount-pass").append(respuesta);
			})
        }   

        function codigoButton() {
            var email = $("#email").val();
            $.ajax({
				url: "./php/checkoutButton.php",
				data:{
					email:email
				},
				method: 'POST'
			}).done(function(respuesta2){
                $(".email_button").remove();
                $(".checkout-second-cont").append(respuesta2);
			})
        }   
        $("#email").on("keyup" ,function(){
            clearTimeout(controladorTiempo);
            controladorTiempo = setTimeout(codigoAJAX, 2000);
            controladorTiempo = setTimeout(codigoButton, 2000);
        })
    })
</script>
</body>
</html>
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
if(!isset($_POST['submit'])){
    header("Location: ./checkout");
}else{
    $nombre = $_POST['first-name'];
    $apellido = $_POST['last-name'];
    $pais = $_POST['country'];
    $calle = $_POST['address1'];
    $apartamento = $_POST['address2'];
    $ciudad = $_POST['city'];
    $estado = $_POST['state'];
    $cp = $_POST['zip'];
    $telefono = $_POST['phone'];
    $correo = $_POST['email'];
}
if(isset($_POST['password'])){
    $pass = $_POST['password'];
}
if(isset($_POST['notas'])){
    $notas = $_POST['notas'];
}
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Facturación</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/checkout.css?13.0"> 
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
<form action="#" method="POST">

    <div class="checkout">
        <div class="checkout-first">
            <h1>Escoge un Método de Pago</h1>
        </div>

        <div class="checkout-second">
            <div class="checkout-second-address">
                <div class="checkout-second-address-edit">
                    <h1>Datos de Envío</h1>
                    <a href="javascript: history.go(-1)"><i class="fa fa-edit"></i> Editar</a>
                </div>
                <div class="checkout-second-address-item">
                    <h3>A nombre de: <a><?php echo $nombre.' '.$apellido ?></a></h3>
                    <h3>Dirección: <a><?php echo $calle.', '.$apartamento.' '.$cp.', '.$ciudad.', '.$estado.', '.$pais ?></a></h3>
                    <h3>Contacto: <a><?php echo $telefono.', '.$correo; ?></a></h3>
                    <?php
                    if(isset($_POST['notas'])){
                        if($_POST['notas'] != ''){
                    ?>
                    <h3>Notas :<a><?php echo $notas; ?></a></h3>
                    <?php } } ?>
                </div>
            </div>
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
                <button type="submit">Finalizar Compra</button>
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
</body>
</html>
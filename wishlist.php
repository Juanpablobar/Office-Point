<?php
session_start();
include "./php/conexion.php";
if(isset($_SESSION["wishlist"])){
    //si existe buscamos si ya estaba agregado ese producto 
    if(isset($_GET["id"])){
        $arreglo =$_SESSION["wishlist"];
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
            $_SESSION["wishlist"]=$arreglo;
            header("Location: ./wishlist");
        }else{
            /// no estaba el registro
        $nombre ="";
        $imagen ="";
        $precio ="";
        $stock ="";
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
                    "Stock" => $stock,
                    "Cantidad" => $_GET["cant"]
        );
        
            array_push($arreglo, $arregloNuevo);
            $_SESSION["wishlist"]=$arreglo;
            header("Location: ./wishlist");
        }
    }
    }else{
    //creamos la variable de sesión
    if (isset($_GET["id"])){
        $nombre ="";
        $imagen ="";
        $precio ="";
        $stock ="";
        $res    = $conexion->query("select * from productos where id=".$_GET["id"])or die($conexion->error);
        $fila = mysqli_fetch_row($res);
        $nombre = $fila[1];
        $imagen = $fila[7];
        $precio = $fila[2];
        $stock = $fila[10];
        $arreglo[] = array(
                    "Id" => $_GET["id"],
                    "Nombre" => $nombre,
                    "Imagen" => $imagen,
                    "Precio" => $precio,
                    "Stock" => $stock,
                    "Cantidad" => $_GET["cant"]
        );
        $_SESSION["wishlist"]=$arreglo;
        header("Location: ./wishlist");
    }
}
?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Lista de Deseos</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/wishlist.css?16.0"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/reload.php'); ?>

<?php include ('./layouts/up.php'); ?>

<div class="breadcrumb breadcrumb-wishlist">
	<h1>Lista de Deseos</h1>
	<h2><a href="./">Home</a> &mdash; Lista de Deseos</h2>
</div>
<?php
	if(count($_SESSION["wishlist"]) == 0){
		echo 
		'<div class="wishlist-empty">
			<img src="img/empty-cart.png">
			<h1>No hay artículos en la lista de deseos</h1>
			<h2>Te recomendamos agregar los artículos que deseas comprar</h2>
			<a href="./shop">Volver a la tienda</a>
		</div>';
	}else{
?>

<div class="wishlist">
	<div class="wishlist-head">
		<div class="wishlist-head-item">
			<h2>Productos</h2>
		</div>
		<div class="wishlist-head-item">
			<h2>Precio</h2>
		</div>
		<div class="wishlist-head-item">
			<h2>Stock</h2>
		</div>
	</div>
	<?php 
		$total = 0;
		if(isset($_SESSION["wishlist"])){
		$arreglowishlist =$_SESSION["wishlist"];
		for($i=0;$i<count($arreglowishlist);$i++){
		$total= $total + ($arreglowishlist[$i]["Precio"] * $arreglowishlist[$i]["Cantidad"]);
    ?>
	<div class="wishlist-product">
		<div class="wishlist-product-item">
			<div class="wishlist-product-img">
				<a href="shop-single?name=<?php echo $arreglowishlist[$i]['Nombre']; ?>&id=<?php echo $arreglowishlist[$i]['Id']; ?>"><img src="img/<?php echo $arreglowishlist[$i]['Imagen']; ?>" title="<?php echo $arreglowishlist[$i]['Nombre']; ?>"></a>
			</div>
			<div class="wishlist-product-name">
				<a href="shop-single?name=<?php echo $arreglowishlist[$i]['Nombre']; ?>&id=<?php echo $arreglowishlist[$i]['Id']; ?>"><?php echo $arreglowishlist[$i]['Nombre']; ?></a>
			</div>
		</div>
		<div class="wishlist-product-item">
			<h3>$<?php echo $arreglowishlist[$i]['Precio']; ?>.00</h3>
		</div>
		<div class="wishlist-product-item">
			<?php
			$resultado = $conexion ->query("select * from productos where id=".$arreglowishlist[$i]['Id']); 
            $fila = mysqli_fetch_array($resultado);
			if($fila[10] <= 0){
				echo '<h3 class="no-dis">No Disponible</h3>';
			}else{
				echo '<h3>En Stock</h3>';
			}
			?>
		</div>
		<form action="./php/addCart" method="post">
		<input type="hidden" name="id" value="<?php echo $arreglowishlist[$i]['Id'];?>">
		<input type="hidden" name="cant" value="1">
		<?php
			if($fila[10] <= 0){
				echo '<button name="sendcart" type="submit" class="button-no-dis" disabled>No Disponible</button>';
				echo '<span data-id="'.$arreglowishlist[$i]['Id'].'" class="wish-close"><i class="fa fa-times"></i></span>';
			}else{
				echo '<button name="sendcart" id="wish-button" type="submit">CARRITO</button>';
				echo '<span data-id="'.$arreglowishlist[$i]['Id'].'" class="wish-close"><i class="fa fa-times"></i></span>';
			}
			?>
			</form>
	</div>
	<?php } }?>
</div>

<div class="wishlist-second">
	<?php 
		$total = 0;
		if(isset($_SESSION["wishlist"])){
		$arreglowishlist =$_SESSION["wishlist"];
		for($i=0;$i<count($arreglowishlist);$i++){
		$total= $total + ($arreglowishlist[$i]["Precio"] * $arreglowishlist[$i]["Cantidad"]);
    ?>
	<div class="wishlist-second-product">
		<div class="wishlist-second-img">
			<a href="shop-single?name=<?php echo $arreglowishlist[$i]['Nombre']; ?>&id=<?php echo $arreglowishlist[$i]['Id']; ?>"><img src="img/<?php echo $arreglowishlist[$i]['Imagen']; ?>" title="<?php echo $arreglowishlist[$i]['Nombre']; ?>"></a>
		</div>
		<div class="wishlist-second-text">
			<a href="shop-single?name=<?php echo $arreglowishlist[$i]['Nombre']; ?>&id=<?php echo $arreglowishlist[$i]['Id']; ?>"><?php echo $arreglowishlist[$i]['Nombre']; ?></a>
			<?php
			$resultado = $conexion ->query("select * from productos where id=".$arreglowishlist[$i]['Id']); 
            $fila = mysqli_fetch_array($resultado);
			if($fila[10] <= 0){
				echo '<h3 class="no-dis">No Disponible</h3>';
			}else{
				echo '<h3>En Stock</h3>';
			}
			?>
		</div>
		<form action="./php/addCart" method="post">
		<input type="hidden" name="id" value="<?php echo $arreglowishlist[$i]['Id'];?>">
		<?php
			if($fila[10] <= 0){
				echo '<button name="sendcart" type="submit" class="button-no-dis" disabled>No Disponible</button>';
				echo '<span data-id="'.$arreglowishlist[$i]['Id'].'" class="wish-close"><i class="fa fa-times"></i></span>';
			}else{
				echo '<button name="sendcart" id="wish-button" type="submit">CARRITO</button>';
				echo '<span data-id="'.$arreglowishlist[$i]['Id'].'" class="wish-close"><i class="fa fa-times"></i></span>';
			}
			?>
			</form>
		</div>
	<?php } }?>
</div>
<?php } ?>

<?php include ('./layouts/pre-footer.php'); ?>	
<?php include ('./layouts/footer.php'); ?>	
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/reload.js"></script>
<script src="js/header2.js" defer></script>
<script src="js/up3.js" defer></script>
<script>
      $(document).ready(function(){
          $(".wish-close").click(function(event){
              event.preventDefault();
              var id = $(this).data("id");
              var boton = $(this);
              $.ajax({
                  method:"POST",
                  url:"./php/eliminarWishList.php",
                  data:{
                      id:id
                  }
              }).done(function(respuesta){
                  boton.parent("form").parent("div").remove();
              });
          });
      });

	</script>
</body>
</html>

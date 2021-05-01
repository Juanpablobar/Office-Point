<?php
session_start();
include "./php/conexion.php";
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
    //creamos la variable de sesión
    if (isset($_GET["id"])){
        $nombre ="";
        $imagen ="";
        $precio ="";
        $stock  ="";
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
        $_SESSION["carrito"]=$arreglo;
        header("Location: ./cart");
    }
}

?>


<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Carrito</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/wishlist.css?16.0"> 
	<link rel="stylesheet" href="css/cart.css?16.0"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>
	
</head>
<body>

<?php include ('./layouts/header.php'); ?>

<?php include ('./layouts/up.php'); ?>
<section id="content">
	<section id="section">
<div class="breadcrumb breadcrumb-wishlist">
	<h1>Carrito</h1>
	<h2><a href="./">Home</a> &mdash; Carrito</h2>
</div>
<?php
	if(count($_SESSION["carrito"]) == 0){
		echo 
		'<div class="wishlist-empty">
			<img src="img/empty-cart.webp">
			<h1>No hay artículos en el carrito</h1>
			<h2>Te recomendamos agregar los artículos que deseas comprar</h2>
			<a href="./shop">Volver a la tienda</a>
		</div>';
		$_SESSION['total'] = 0;

	}else{
?>

<div class="wishlist cart">
	<div class="wishlist-head">
		<div class="wishlist-head-item">
			<h2>Productos</h2>
		</div>
		<div class="wishlist-head-item">
			<h2>Precio</h2>
		</div>
		<div class="wishlist-head-item">
			<h2>Cantidad</h2>
		</div>
		<div class="wishlist-head-item">
			<h2>Total</h2>
		</div>
	</div>
	<?php 
		$total = 0;
		if(isset($_SESSION["carrito"])){
		$arreglocarrito =$_SESSION["carrito"];
		for($i=0;$i<count($arreglocarrito);$i++){
		$total= $total + ( $costo * $arreglocarrito[$i]["Cantidad"]);
    ?>
	<div class="wishlist-product">
		<div class="wishlist-product-item">
			<div class="wishlist-product-img">
				<a href="shop-single?name=<?php echo $arreglocarrito[$i]['Nombre']; ?>&id=<?php echo $arreglocarrito[$i]['Id']; ?>"><img src="img/<?php echo $arreglocarrito[$i]['Imagen']; ?>" title="<?php echo $arreglocarrito[$i]['Nombre']; ?>"></a>
			</div>
			<div class="wishlist-product-name">
				<a href="shop-single?name=<?php echo $arreglocarrito[$i]['Nombre']; ?>&id=<?php echo $arreglocarrito[$i]['Id']; ?>"><?php echo $arreglocarrito[$i]['Nombre']; ?></a>
			</div>
		</div>
		<?php
			?>
		<div class="wishlist-product-item">
			<?php
			$resultado = $conexion ->query("select * from productos where id=".$arreglocarrito[$i]['Id']); 
            $fila = mysqli_fetch_array($resultado);
			if($fila[3] <= 0){
				$costo = $fila[2];
				echo '<h3>$'.$costo.".00</h3>" ;
			}else{
				$percent = round($fila[3]/100*$fila[2]);
				$costo = $fila[2]-$percent;
				echo '<h3 style="color:#aaa;text-decoration:line-through">$'.$fila[2].'.00</h3> <h3>$'.$costo.".00</h3>" ;
			}
			?>
		</div>
		<div class="wishlist-product-item">
			<div class="input-group">
            	<div class="input-group-prepend">
                	<button class="js-btn-minus btnIncrementar" type="button">&minus;</button>
            	</div>
            		<input type="number" class="form-control txtCantidad" name="cant" data-stock="<?php echo $arreglocarrito[$i]["Stock"]  ?>" data-precio="<?php echo $costo; ?>"
                        data-id="<?php echo $arreglocarrito[$i]["Id"]; ?>" value="<?php echo $arreglocarrito[$i]["Cantidad"]; ?>" readonly>
              	<div class="input-group-append">
                	<button class="js-btn-plus btnIncrementar" type="button">&plus;</button>
              	</div>
			</div>
		</div>
		<div class="wishlist-product-item">
			<h3 class="cant<?php echo $arreglocarrito[$i]['Id']; ?>">$<?php echo $costo * $arreglocarrito[$i]["Cantidad"]; ?>.00</h3>
			<span data-id="<?php echo $arreglocarrito[$i]['Id']; ?>" class="wish-close"><i class="fa fa-times"></i></span>
		</div>
	</div>
	<?php } }?>
</div>

<div class="wishlist cart-second">
	<?php 
		$total = 0;
		if(isset($_SESSION["carrito"])){
		$arreglocarrito =$_SESSION["carrito"];
		for($i=0;$i<count($arreglocarrito);$i++){
    ?>
	<div class="cart-second-product">
		<div class="cart-second-img">
			<a href="shop-single?name=<?php echo $arreglocarrito[$i]['Nombre']; ?>&id=<?php echo $arreglocarrito[$i]['Id']; ?>"><img src="img/<?php echo $arreglocarrito[$i]['Imagen']; ?>" title="<?php echo $arreglocarrito[$i]['Nombre']; ?>"></a>
		</div>
		<div class="cart-second-name">
			<a href="shop-single?name=<?php echo $arreglocarrito[$i]['Nombre']; ?>&id=<?php echo $arreglocarrito[$i]['Id']; ?>"><?php echo $arreglocarrito[$i]['Nombre']; ?></a>
			<h2>Cantidad:</h2>
			<div class="input-group">
            	<div class="input-group-prepend">
                	<button class="js-btn-minus btnIncrementar" type="button">&minus;</button>
            	</div>
            	<?php
			$resultado = $conexion ->query("select * from productos where id=".$arreglocarrito[$i]['Id']); 
            $fila = mysqli_fetch_array($resultado);
			if($fila[3] <= 0){
				$costo = $fila[2];
			}else{
				$percent = round($fila[3]/100*$fila[2]);
				$costo = $fila[2]-$percent;
			}
					$costoEnvio = $fila[21];
					$envioInicial = 0;
					$total= $total + ($costo * $arreglocarrito[$i]["Cantidad"]);
					$envio = $envio + ($costoEnvio * $arreglocarrito[$i]["Cantidad"]); 
					$final = $total + $envio

				?>
            		<input type="number" class="form-control txtCantidad" name="cant" data-precio="<?php echo $costo; ?>"
					data-stock="<?php echo $arreglocarrito[$i]["Stock"] ?>"
                        data-id="<?php echo $arreglocarrito[$i]["Id"]; ?>" value="<?php echo $arreglocarrito[$i]["Cantidad"]; ?>" readonly>
              	<div class="input-group-append">
                	<button class="js-btn-plus btnIncrementar" type="button">&plus;</button>
              	</div>
			</div>
		</div>
		<div class="cart-second-price">
			<h3 class="cant<?php echo $arreglocarrito[$i]['Id']; ?>">$<?php echo $costo * $arreglocarrito[$i]["Cantidad"]; ?>.00</h3>
			<span data-id="<?php echo $arreglocarrito[$i]['Id']; ?>" class="wish-close"><i class="fa fa-times"></i></span>
		</div>
	</div>
	<?php } }?>
</div>

<div class="cart-buttons">
	<a href="shop">Continuar Comprando</a>
	<a href="cart"><i class="fas fa-redo-alt"></i> Actualizar Cesta</a>
</div>

<div class="cart-finish">
	<div class="cart-coupons">
		<h1>Código de Descuento</h1>
		<form>
			<input type="text" name="coupon" placeholder="Introduce tu Código" id="coupon_input">
			<button type="button" name="send_coupon" id="coupon">Aplicar Código</button>
		</form>
		<h2 id="error" style="display:none"></h2>
		<h2 id="success" style="display:none"></h2>
	</div>
	<div class="cart-total">
		<h1>Total</h1>
		<div class="cart-total-item">
			<h2>Subtotal</h2>
			<h3>$<?php echo $total; ?>.00</h3>
		</div>
		<div class="cart-total-item cart-item-border">
			<h2>Envío</h2>
		<?php
		if($total >= 2199 && $total < 5999){
			echo "<h3 style='display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$".$envio.".00</p>Gratis</h3>";
			$final = $total;
			echo "
			</div>
			<div class='cart-total-item cart-total-item-coupon' style='display:none'>
				<h2>Cupón de Descuento<br><p></p></h2>
				<h3></h3>
				<span id='coupon-remove'>x</span>
				</div>
			<div class='cart-total-item'>
			<h2>Total</h2>
			<script>
			let codigo = sessionStorage.getItem('codigo');
			let tipo = sessionStorage.getItem('tipo');
			let valor = sessionStorage.getItem('valor');
			total = sessionStorage.getItem('total');

			if(codigo === null && tipo === null && valor === null){
				document.write(`<h3>$".$final.".00</h3>`);
				sessionStorage.setItem('final',total)
			}else{
				let finalS = 0;
				if(tipo === 'porcentaje'){
					let percent = Math.round(total/100 * valor);
					finalS = total - percent;
				}else{
					finalS = total - valor;
				}
				document.write(`<h3 style='display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$` + total + `.00</p>$`+ finalS +`.00</h3>`);
				sessionStorage.setItem('final',finalS)
			}
			</script>
			
			";
			} else if ($total >= 5999){
				echo "<h3 style='display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$".$envio.".00</p>Gratis</h3>";				$percent = round($total/100*10);
				$final = $total - $percent;
				echo "
				</div>
				<div class='cart-total-item cart-total-item-coupon-two'>
					<h2>Descuento por Mayoreo</h2>
					<h3>-10%</h3>
				</div>
				<div class='cart-total-item cart-total-item-coupon' style='display:none'>
					<h2>Cupón de Descuento<br><p></p></h2>
					<h3></h3>
					<span id='coupon-remove'>x</span>
				</div>
					<div class='cart-total-item'>
				<h2>Total</h2>
			<script>
			let codigo = sessionStorage.getItem('codigo');
			let tipo = sessionStorage.getItem('tipo');
			let valor = sessionStorage.getItem('valor');
			total = sessionStorage.getItem('total');

			if(codigo === null && tipo === null && valor === null){
				document.write(`<h3 style='display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$".$total.".00</p>$".$final.".00</h3>`);
				sessionStorage.setItem('final',total)
			}else{
				let finalS = 0;
				if(tipo === 'porcentaje'){
					let percent = Math.round(total/100 * valor);
					finalS = total - percent;
				}else{
					finalS = total - valor;
				}
				document.write(`<h3 style='display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$${total}.00</p>$`+ finalS +`.00</h3>`);
				sessionStorage.setItem('final',finalS)
			}
			</script>

				";
			} else { 
				echo '<h3>$'. $envio .'.00</h3>';
				echo "
				</div>
				<div class='cart-total-item cart-total-item-coupon' style='display:none'>
					<h2>Cupón de Descuento<br><p></p></h2>
					<h3></h3>
					<span id='coupon-remove'>x</span>
				</div>
					<div class='cart-total-item'>
				<h2>Total</h2>
			<script>
			let codigo = sessionStorage.getItem('codigo');
			let tipo = sessionStorage.getItem('tipo');
			let valor = sessionStorage.getItem('valor');
			total = sessionStorage.getItem('total');

			if(codigo === null && tipo === null && valor === null){
				document.write(`<h3>$".$final.".00</h3>`);
				sessionStorage.setItem('final',total)
			}else{
				let finalS = 0;
				if(tipo === 'porcentaje'){
					let percent = Math.round(total/100 * valor);
					finalS = total - percent;
				}else{
					finalS = total - valor;
				}
				document.write(`<h3 style='display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$${final}.00</p>$`+ finalS +`.00</h3>`);
				sessionStorage.setItem('final',finalS)
			}
			</script>
				";
			} ?>
			</div>
		<a href="" id='proceder'>Proceder al Pago</a>
		</div>
	</div>
</div>
<?php
	$_SESSION['total'] = $final;
	echo '<script>let total = sessionStorage.setItem("total", '.$final.')</script>'
	?>
<?php } ?>
		
		</section>
		</section>

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
                  url:"./php/eliminarCarrito.php",
                  data:{
                      id:id
                  }
              }).done(function(respuesta){
                  boton.parent("div").parent("div").remove();
				  location.reload()
              });
          });
          $(".txtCantidad").keyup(function(){
             var cantidad = $(this).val();
              var precio = $(this).data("precio");
              var id = $(this).data("id");
              incrementar(cantidad,precio,id);
          });
          $(".btnIncrementar").click(function(){
             var precio = $(this).parent('div').parent('div').find('input').data("precio");
              var id = $(this).parent('div').parent('div').find('input').data("id");
              var cantidad = $(this).parent('div').parent('div').find('input').val();
              incrementar(cantidad,precio,id);
          });
          function incrementar(cantidad, precio, id){
              var mult = parseFloat(cantidad)* parseFloat(precio);
              $(".cant"+id).text("$"+mult+".00");
              $.ajax({
                  method:"POST",
                  url:"./php/actualizar.php",
                  data:{
                      id:id,
                      cantidad:cantidad
                  }
              }).done(function(respuesta){
				location.reload()
				sessionStorage.setItem('reload','false')
            	boton.parent("div").parent("div").remove();
              });
          }
      });
	</script>
<script>
	var sitePlusMinus = function() {
		$('.js-btn-minus').on('click', function(e){
			e.preventDefault();
			if ( $(this).closest('.input-group').find('.form-control').val() != 1 ) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(1));
			}
		});
		$('.js-btn-plus').on('click', function(e){
			e.preventDefault();
			if($(this).closest('.input-group').find('.form-control').val() >= $(this).closest('.input-group').find('.form-control').data("stock")){
				return false
			}else{
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
			}
		});
	};
	sitePlusMinus();
</script>
<script>
	$(document).ready(function(){
		$('body').append("<div class='reload-ajax'><div class='reload-ajax-content'><div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div>")
		window.onload = function(){
 	   		$(".reload-ajax").remove();
		}

		let reload = sessionStorage.getItem('reload')

		$("#proceder").click(function(){
			if(reload === null || reload == 'false'){
				sessionStorage.setItem('reload','true')
				$("#proceder").attr('href','')
			}else{
				sessionStorage.removeItem('reload')
				$("#proceder").attr('href','checkout.php')
			}
		})

		$("#coupon").click(function(){
			var codigo = $("#coupon_input").val()
			$('body').append("<div class='reload-ajax'><div class='reload-ajax-content'><div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div>")
			$.ajax({
				url: "./php/validarcodigo.php",
				data:{
					codigo:codigo
				},
				method: 'POST'
			}).done(function(respuesta){
				$(".reload-ajax").hide()
				if(respuesta === "Error"){
					$("#error").css('display','block');
					$("#error").text("Error")
				} else if (respuesta === "Código no Válido" ) {
					$("#error").css('display','block');
					$("#error").text('Código No Valido')
				} else if (respuesta === "Cupón Vencido" ) {
					$("#error").css('display','block');
					$("#error").text('Cupón Caducado')
				} else if (respuesta === "Ingresa un Código" ) {
					$("#error").css('display','block');
					$("#error").text('Ingresa un Código')
				} else {
					let json_string = JSON.parse(respuesta)
					let codigo = sessionStorage.getItem('codigo')
					let tipo = sessionStorage.getItem('tipo')
					let valor = sessionStorage.getItem('valor')

					if(codigo === null && tipo === null && valor === null){
						sessionStorage.setItem('codigo',json_string.codigo)
						sessionStorage.setItem('tipo',json_string.tipo)
						sessionStorage.setItem('valor',json_string.valor)
						codigo = json_string.codigo
						tipo = json_string.tipo
						valor = json_string.valor

						$("#success").css('display','block');
						$("#success").text('Cupón Aplicado')
						$(".cart-total-item-coupon").show()
						$(".cart-total-item-coupon").find('h2').find('p').text(`${codigo}`)
						if(tipo === 'moneda'){
							$(".cart-total-item-coupon").find('h3').text('-$' + valor + '.00')
						}else{
							$(".cart-total-item-coupon").find('h3').text('-' + valor + '%')
						}

					}else{
						sessionStorage.setItem('codigo',json_string.codigo)
						sessionStorage.setItem('tipo',json_string.tipo)
						sessionStorage.setItem('valor',json_string.valor)

						$("#success").css('display','block');
						$("#success").text('Cupón Aplicado')
						$(".cart-total-item-coupon").show()
						$(".cart-total-item-coupon").find('h2').find('p').text(`${codigo}`)
						if(tipo === 'moneda'){
							$(".cart-total-item-coupon").find('h3').text('-$' + valor + '.00')
						}else{
							$(".cart-total-item-coupon").find('h3').text('-' + valor + '%')
					}
					}
					location.reload()
					$("#success").css('display','block');
					$("#success").text('Cupón Aplicado')
					$(".cart-total-item-coupon").show()
					$(".cart-total-item-coupon").find('h2').find('p').text(`${codigo}`)
					if(tipo === 'moneda'){
						$(".cart-total-item-coupon").find('h3').text('-$' + valor + '.00')
					}else{
						$(".cart-total-item-coupon").find('h3').text('-' + valor + '%')
					}
					$("#coupon-remove").click(function(){
					$(this).parent().hide()
					sessionStorage.clear()
					location.reload()
		})

				}
			})
		});
		let codigo = sessionStorage.getItem('codigo')
		let tipo = sessionStorage.getItem('tipo')
		let valor = sessionStorage.getItem('valor')
		if(codigo === null && tipo === null && valor === null){
			return true;
		}else{
			$(".cart-total-item-coupon").show()
			$(".cart-total-item-coupon").find('h2').find('p').text(`${codigo}`)	;
			if(tipo === 'moneda'){
				$(".cart-total-item-coupon").find('h3').text('-$' + valor + '.00')
			}else{
				$(".cart-total-item-coupon").find('h3').text('-' + valor + '%')
			}
		}
		$("#coupon-remove").click(function(){
			$(this).parent().hide()
			sessionStorage.clear()
			location.reload()
		})

			$("#coupon_input").keyup(function(){
			$("#error").hide();
			$("#success").hide();
		})
	})
	</script>
</body>
</html>

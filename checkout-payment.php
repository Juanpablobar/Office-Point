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
if(isset($_POST['address2'])){
    $apartamento = $_POST['address2'];
}
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Facturación</title>
	
	<link rel="icon shortcut" href="./img/logo.png">
	<link rel="stylesheet" href="css/checkout-payment.css"> 
	<link rel="preload" href="fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="fontawesome-free/css/all.min.css"></noscript>	
</head>
<body>

<script src="https://www.paypal.com/sdk/js?client-id=AShrBRyeyhp7u0w8QepYw0I3tFSVEBhh5e_KFZPFgpcTAJDaixJ9VSNP4X7XkwCtUyCynUVG9nB0XcHP&currency=MXN&components=buttons,funding-eligibility,marks"> // Replace YOUR_CLIENT_ID with your sandbox client ID &components=buttons,funding-eligibility
    </script>

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
<form action="php/compraFinalizada.php" method="POST" style="padding-bottom:5em" id='compraForm'>

    <div class="checkout">
        <div class="checkout-first">
            <h1>Escoge un Método de Pago</h1>
            <div class="checkout-methods">
                <div class="checkout-methods-item checkout-methods-item-checked" id="credit-card">
                    <div class="chekout-item-img">
                        <img src="./img/credit-card.png" alt="Déposito Bancario" title="Déposito Bancario">
                    </div>
                </div>
                <div class="checkout-methods-item" id="paypal-card">
                    <div class="chekout-item-img">
                        <img src="./img/paypal-card.png" alt="Pago con PayPal" title="Pago con PayPal">
                    </div>
                </div>
                <div class="checkout-methods-item" id="oxxo">
                    <div class="chekout-item-img">
                        <img src="./img/Oxxo.svg" alt="Déposito en Oxxo" title="Déposito en Oxxo">
                    </div>
                </div>
            </div>

                <div class="checkout-slidedown-item" id='slideDown-credit-card'>
                    <div class='checkout-slidedown-item-cont'>
                        <div id="paypal-button-container-card"></div>
                        <p>Al realizar la compra aceptas los <a href='conditions-of-use'>Términos y Condiciones</a> y el <a href='notice-of-privacy'>Aviso de Pivacidad</a> establecidos por <a>Office Point</a></p>
                    </div>
                </div>
                <div class="checkout-slidedown-item" id='slideDown-paypal'>
                    <div class='checkout-slidedown-item-cont'>
                        <div id="paypal-button-container"></div>
                        <p>Al realizar la compra aceptas los <a href='conditions-of-use'>Términos y Condiciones</a> y el <a href='notice-of-privacy'>Aviso de Pivacidad</a> establecidos por <a>Office Point</a></p>
                    </div>
                    
                </div>
                <div class="checkout-slidedown-item" id='slideDown-oxxo'>
                    <div class='checkout-slidedown-item-cont'>

                    <div class="opps">
			<div class="opps-header">
				<div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
				<div class="opps-reference">
					<h3>Cuenta Bancaria</h3>
					<h1>4152-3137-9303-1431 <a>BANCOMER</a></h1>
				</div>
			</div>
			<div class="opps-instructions">
				<h3>Instrucciones</h3>
                <p>Realiza el pago en cualquier sucursal Oxxo o realiza una tranferencia bancaria a esta cuenta.</p>
                <p>Guarda el recibo que te proporcionarán.</p>
                <p>Envía una foto de tu recibo a este número de <a href="https://wa.link/s61nrc">whatsapp</a> o a este <a href="mailto:equipamostuoficinadistribuidora@gmail.com">correo eléctrónico</a>. Además puedes integrar una foto de tu pedido, que se generará más adelante o el ID de tu compra.</p>
                <p>Al confirmar tu pago, se aprobará tu pedido y se enviará de inmediato.</p>
                <button type="submit" name='oxxoSubmit' form="compraForm">Escoger este Método de Pago</button>
			</div>
		</div>
                    <p>Al realizar la compra aceptas los <a href='conditions-of-use'>Términos y Condiciones</a> y el <a href='notice-of-privacy'>Aviso de Pivacidad</a> establecidos por <a>Office Point</a></p>
                    </div>
                </div>

        </div>

        <div class="checkout-second">
            <div class="checkout-second-address">
                <div class="checkout-second-address-edit">
                    <h1>Datos de Envío</h1>
                    <a href="javascript: history.go(-1)"><i class="fa fa-edit"></i> Editar</a>
                </div>
                <div class="checkout-second-address-item">
                    <h3>A nombre de: <a><?php echo $nombre.' '.$apellido ?></a></h3>
                    <h3>Dirección: <a><?php echo $calle.', '
                    ?>
                    <?php
                    if(isset($_POST['address2'])){
                        echo $apartamento;
                    }
                    ?>
                    <?php
                    echo ', '.$cp.', '.$ciudad.', '.$estado.', '.$pais ?></a></h3>
                    <h3>Contacto: <a><?php echo $telefono.', '.$correo; ?></a></h3>
                    <?php
                    if(isset($_POST['notas'])){
                        if($_POST['notas'] != ''){
                    ?>
                    <h3>Notas :<a><?php echo $notas; ?></a></h3>
                    <?php } } ?>

                    <input type="hidden" value="<?php echo $calle; ?>" name="calle">
                    <input type="hidden" value="" name="precio" id='precio'>
                    <input type="hidden" value="<?php echo $cp; ?>" name="cp">
                    <input type="hidden" value="<?php echo $ciudad; ?>" name="ciudad">
                    <input type="hidden" value="<?php echo $estado; ?>" name="estado">
                    <input type="hidden" value="<?php echo $pais; ?>" name="pais">
                    <input type="hidden" value="<?php echo $apellido; ?>" name="apellidos">
                    <input type="hidden" value="<?php echo $nombre; ?>" name="nombres">
                    <input type="hidden" value="<?php echo $correo; ?>" name="correo">
                    <?php
                    if(isset($_POST['password'])){
                    ?>
                    <input type="hidden" value="<?php echo $pass; ?>" name="contraseña">
                    <?php
                    } else {
                        echo '';
                    }

                    if(isset($_POST['notas'])){
                     ?>
                    <input type="hidden" value="<?php echo $notas; ?>" name="notas">
                    <?php
                    } else {
                        echo '';
                    }
                    if(isset($_POST['address2'])){
                    ?>
                    <input type="hidden" value="<?php echo $apartamento; ?>" name="apartamento">
                    <?php 
                    } else{
                        echo '';
                    } 
                    ?>
                    <input type="hidden" value="<?php echo $telefono; ?>" name="telefono">
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
                                $costoEnvio = $fila[21];
                                $envioInicial = 0;
                                $envio = $envio + ($costoEnvio * $arreglocarrito[$i]["Cantidad"]); 
                                $total= $total + ($costo2 * $arreglocarrito[$i]["Cantidad"]);
                                $final = $total + $envio;
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
                        <?php
                        if($total >= 2199 && $total < 5999){
                            $final = $final - $envio;
                            echo "<div class='checkout-second-products-item'>
                            <h2>Envío</h2>
                            <h4 style='color:#FF6363;display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$".$envio .".00<p>Gratis</h4>";
                            echo '
                            </div>
                            <script>
                            let codigo = sessionStorage.getItem("codigo");
                            let tipo = sessionStorage.getItem("tipo");
                            let valor = sessionStorage.getItem("valor");
                            total = sessionStorage.getItem("total");
                            let final = sessionStorage.getItem("final");
                
                            if(codigo === null && tipo === null && valor === null){
                                document.write(`
                                <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$'.$total.'.00</p>$` + total + `.00</h4>
                                `);
                            }else{
                                if(tipo === "porcentaje"){
                                    document.write(`<div class="checkout-second-products-item">
                                    <h2>Cupón de Descuento<br><p>` + codigo +`</p></h2>
                                    <h4 style="color:#ff6363">-` + valor +`%</h4>
                                    </div>
                                    <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$'.$total.'.00</p>$` + final + `.00</h4>
                                    `);

                                }else{
                                    document.write(`<div class="checkout-second-products-item">
                                    <h2>Cupón de Descuento<br><p>` + codigo +`</p></h2>
                                    <h4 style="color:#ff6363">-$` + valor + `.00</h4>
                                    </div>
                                    </div>
                                    <div class="checkout-second-products">
                                        <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$'.$total.'.00</p>$` + final + `.00</h4>
                                    `);
                                    }
                                }
                            </script>
                            ';
                        }elseif($total >= 5999){
                            $percent = round($total/100*10);
                            $final = $total - $percent;                            
                            echo "<div class='checkout-second-products-item'>
                            <h2>Envío</h2>
                            <h4 style='color:#FF6363;display:flex;align-items:center'><p style='text-decoration:line-through;margin-right:1em;color:#999'>$".$envio .".00<p>Gratis</h4>
                            
                            ";
                            echo '
                            </div>
                            <div class="checkout-second-products-item">
                                <h2>Descuento por Mayoreo</h2>
                                <h4 style="color:#ff6363">-10%</h4>
                            </div>
                            <script>
                            let codigo = sessionStorage.getItem("codigo");
                            let tipo = sessionStorage.getItem("tipo");
                            let valor = sessionStorage.getItem("valor");
                            total = sessionStorage.getItem("total");
                            let final = sessionStorage.getItem("final");
                
                            if(codigo === null && tipo === null && valor === null){
                                document.write(`
                                <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$'.$total.'.00</p>$` + total + `.00</h4>
                                `);
                            }else{
                                if(tipo === "porcentaje"){
                                    document.write(`<div class="checkout-second-products-item">
                                    <h2>Cupón de Descuento<br><p>` + codigo +`</p></h2>
                                    <h4 style="color:#ff6363">-` + valor +`%</h4>
                                    </div>
                                    <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$'.$total.'.00</p>$` + final + `.00</h4>
                                    `);

                                }else{
                                    document.write(`<div class="checkout-second-products-item">
                                    <h2>Cupón de Descuento<br><p>` + codigo +`</p></h2>
                                    <h4 style="color:#ff6363">-$` + valor + `.00</h4>
                                    </div>
                                    </div>
                                    <div class="checkout-second-products">
                                        <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$'.$total.'.00</p>$` + final + `.00</h4>
                                    `);
                                    }
                                }
                            </script>
                            ';
                        }else{
                            echo "<div class='checkout-second-products-item'>
                            <h2>Envío</h2>
                            <h4>$".$envio.".00</h4>";
                            echo '
                            </div>
                            <script>
                            let codigo = sessionStorage.getItem("codigo");
                            let tipo = sessionStorage.getItem("tipo");
                            let valor = sessionStorage.getItem("valor");
                            total = sessionStorage.getItem("total");
                            let final = sessionStorage.getItem("final");
                
                            if(codigo === null && tipo === null && valor === null){
                                document.write(`
                                </div>
                                <div class="checkout-second-products">
                                    <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4>$` + total + `.00</h4>
                                `);
                            }else{
                                if(tipo === "porcentaje"){
                                    document.write(`<div class="checkout-second-products-item">
                                    <h2>Cupón de Descuento<br><p>` + codigo +`</p></h2>
                                    <h4 style="color:#ff6363">-` + valor +`%</h4>
                                    </div>
                                    </div>
                                    <div class="checkout-second-products">
                                    <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p style="text-decoration:line-through;margin-right:1em;color:#999">$` + total + `.00</p>$` + final + `.00</h4>
                                    `);

                                }else{
                                    document.write(`<div class="checkout-second-products-item">
                                    <h2>Cupón de Descuento<br><p>` + codigo +`</p></h2>
                                    <h4 style="color:#ff6363">-$` + valor + `.00</h4>
                                    </div>
                                    </div>
                                    <div class="checkout-second-products">
                                        <div class="checkout-second-products-item">
                                            <h2>Total</h2>
                                            <h4 class="total" style="display:flex;align-items:center"><p    style="text-decoration:line-through;margin-right:1em;color:#999">$` + total + `.00</p>$` + final + `.00</h4>
                                    `);
                                    }
                                }
                            </script>
                            ';
                        }
                        ?>
                    </div>
                </div>
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

        $("#slideDown-credit-card").css('display','block')

        $('#credit-card').click(function(){
            $('#credit-card').addClass('checkout-methods-item-checked')
            $("#paypal-card").removeClass("checkout-methods-item-checked")
            $("#oxxo").removeClass("checkout-methods-item-checked")

            $("#slideDown-credit-card").css('display','block')
            $("#slideDown-paypal").css('display','none')
            $("#slideDown-oxxo").css('display','none')

        })

        $('#paypal-card').click(function(){
            $('#credit-card').removeClass('checkout-methods-item-checked')
            $("#paypal-card").addClass("checkout-methods-item-checked")
            $("#oxxo").removeClass("checkout-methods-item-checked")

            $("#slideDown-credit-card").css('display','none')
            $("#slideDown-paypal").css('display','block')
            $("#slideDown-oxxo").css('display','none')

        })

        $('#oxxo').click(function(){
            $('#credit-card').removeClass('checkout-methods-item-checked')
            $("#paypal-card").removeClass("checkout-methods-item-checked")
            $("#oxxo").addClass("checkout-methods-item-checked")

            $("#slideDown-credit-card").css('display','none')
            $("#slideDown-paypal").css('display','none')
            $("#slideDown-oxxo").css('display','block')

        })
    })
</script>
<script>

let precioTotal = sessionStorage.getItem('total')
let precioFinal = sessionStorage.getItem('final')
let cupon = sessionStorage.getItem('codigo')
let input = document.getElementById('precio')

let costoFinal = 0

if(precioFinal === null){
    costoFinal = precioTotal
    input.value = costoFinal
} else {
    costoFinal = precioFinal
    input.value = costoFinal
}
// Initialize the buttons
var button = paypal.Buttons({
    fundingSource: paypal.FUNDING.PAYPAL,
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: costoFinal
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            if(details.status == 'COMPLETED'){
                document.getElementById('compraForm').submit();
          } else {
              alert('Error');
          }
          });
        }
      })

// Check if the button is eligible
if (button.isEligible()) {

    // Render the standalone button for that funding source
    button.render('#paypal-button-container');
}

// Initialize the buttons
var buttonCard = paypal.Buttons({
    fundingSource: paypal.FUNDING.CARD,
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: costoFinal
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            if(details.status == 'COMPLETED'){
                document.getElementById('compraForm').submit();
          } else {
              alert('Error');
          }
          });
        }
      })

// Check if the button is eligible
if (buttonCard.isEligible()) {

    // Render the standalone buttonCard for that funding source
    buttonCard.render('#paypal-button-container-card');
}

    </script>
</body>
</html>
<?php
include ('./php/conexion.php');
?>
<div class="pre-footer-newsletter">
	<h1>Newsletter</h1>
	<h2>Suscríbete a nuestro boletín</h2>
	<form action="#" method="post">	
		<div class="pre-footer-newsletter-input">
		<input type="text" placeholder="Email" name="email">
		<button type="submit"><i class="far fa-paper-plane"></i></button>
		</div>	
	</form>
</div>


<footer>
	
	<div class="footer">
		<div class="footer-links">
			<div class="footer-links-item">
				<h1>Office Point</h1>
				<?php
                $resfooter1 = $conexion ->query("select * from footer where id=1");
                $footer1 = mysqli_fetch_array($resfooter1);
                ?>
				<h2>Dirección: <a><?php echo $footer1[1]; ?></a></h2>
				<?php
				$resfooter2 = $conexion ->query("select * from footer where id=2");
                $footer2 = mysqli_fetch_array($resfooter2);
				?>
				<h2>Teléfono: <a href="tel:<?php echo $footer2[1]; ?>"><?php echo $footer2[1] ?></a></h2>
				<?php
				$resfooter3 = $conexion ->query("select * from footer where id=3");
                $footer3 = mysqli_fetch_array($resfooter3);
				?>
				<h2>Email: <a href="mailto:<?php echo $footer3[1]; ?>"><?php echo $footer3[1]; ?></a></h2>
			</div>
			<div class="footer-links-item">
				<h1>Compañia</h1>
				<a href="shop">Tienda</a>
				<a href="categories">Categorías</a>
				<a href="about-us">Sobre Nosotros</a>
				<a href="contact">Contacto</a>
			</div>
			<div class="footer-links-item">
				<h1>Vínculos Rápidos</h1>
				<a href="login">Iniciar Sesión</a>
				<a href="notice-of-privacy">Aviso de Privacidad</a>
				<a href="privacy-policy">Política de Privacidad</a>
				<a href="terms-and-conditions">Términos y Condiciones</a>
			</div>
			<div class="footer-links-item">
				<h1>Boletín</h1>
				<h2>Suscríbete a nuestro boletín</h2>
				<form action="./php/mailFooter.php" method="post">
					<div class="footer-input">
						<input type="text" name="mail" placeholder="Email" required>
						<button name="send_mail" type="submit"><i class="far fa-paper-plane"></i></button>
					</div>
				</form>
			</div>
		</div>
		<div class="footer-last">
			<div class="footer-last-text">
				<h3><a>Copyright &copy; <?php echo date('Y'); ?></a> Office Point. Todos los Derechos Reservados</h3>
			</div>
			<div class="footer-last-cards">
			<!-- Estas son las imágenes para computadora -->
				<div class="footer-last-cards-img">
					<img src="./img/tarjetas%203.webp" width="42px">
					<img src="./img/tarjetas%204.webp" width="42px">
					<img src="./img/tarjetas%201.webp" width="42px">
				</div>
				<!-- Estos son los íconos para móvil -->
				<div class="footer-last-cards-icons">
					<span><?php echo $mastercard ?></span>
					<span><?php echo $visa ?></span>
				</div>
			</div>
		</div>
	</div>
	
</footer> 
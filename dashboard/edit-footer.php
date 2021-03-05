<?php
session_start();
include '../php/conexion.php';
if(!isset($_SESSION['datos_login'])){
	header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'admin'){
	header('Location: ./');
}
$resultado = $conexion->query("
select * from
footer")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Office Point | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="icon shortcut" href="../img/logo.png">

   <link rel="stylesheet" href="../css/dashboard-footer.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

	<?php include ('./header.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <?php
		  if(isset($_GET['edit'])){
		  ?>
		<div class="alert alert-success" role="alert">
		  Se ha editado correctamente
		</div>
          <?php } ?>
          <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color:#444">Editar Pie de Página</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<footer>
	
	<div class="footer">
		<div class="footer-links">
			<div class="footer-links-item">
				<h1>Office Point</h1>
				<?php
                $resfooter1 = $conexion ->query("select * from footer where id=1");
                $footer1 = mysqli_fetch_array($resfooter1);
                ?>
				<h2>      
                    <button class="btn btn-primary btn-small btnEditar" 
              data-id="<?php echo $footer1[0] ?>"
              data-texto="<?php echo $footer1[1] ?>"
              data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
            Dirección: <a><?php echo $footer1[1]; ?></a></h2>
                
				<?php
				$resfooter2 = $conexion ->query("select * from footer where id=2");
                $footer2 = mysqli_fetch_array($resfooter2);
				?>
				<h2>                    <button class="btn btn-primary btn-small btnEditar" 
              data-id="<?php echo $footer2[0] ?>"
              data-texto="<?php echo $footer2[1] ?>"
              data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
 Teléfono: <a href="tel:<?php echo $footer2[1]; ?>"><?php echo $footer2[1] ?></a></h2>
				<?php
				$resfooter3 = $conexion ->query("select * from footer where id=3");
                $footer3 = mysqli_fetch_array($resfooter3);
				?>
				<h2>                    <button class="btn btn-primary btn-small btnEditar" 
              data-id="<?php echo $footer3[0] ?>"
              data-texto="<?php echo $footer3[1] ?>"
              data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
 Email: <a href="mailto:<?php echo $footer3[1]; ?>"><?php echo $footer3[1]; ?></a></h2>
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
				<a href="#" target="_blank">Privacy Protection</a>
				<a href="#" target="_blank">Terms of Service</a>
				<a href="#" target="_blank">Privacy Policy</a>
			</div>
			<div class="footer-links-item">
				<h1>Boletín</h1>
				<h2>Suscríbete a nuestro boletín</h2>
				<form action="#" method="post">
				<div class="footer-input">
					<input type="text" name="footer_mail" placeholder="Email">
					<button name="footer_send_mail" type="submit"><i class="far fa-paper-plane"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
</footer> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarFooter.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <input type="hidden" name="id" placeholder="id" id="idEdit" class="form-control">
        <label for="">Texto</label>
        <input type="text" name="texto" placeholder="Texto" id="textoEdit" class="form-control" required>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
		</form>
    </div>
  </div>
</div>


<!-- Modal editar -->
  <?php include ('./footer.php'); ?>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script>
$(document).ready(function(){
    $('.btnEditar').click(function(){
        var idEditar=$(this).data('id');
        var texto=$(this).data('texto');
        $('#idEdit').val(idEditar);
        $('#textoEdit').val(texto);
    });
});
	</script>
</body>
</html>

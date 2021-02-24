<?php
session_start();
include '../php/conexion.php';
include '../layouts/icons.php';
if(!isset($_SESSION['datos_login'])){
  header('Location: ../');
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'admin'){
  header('Location: ./');
}
$resultado = $conexion->query("
select * from
contacto order by id")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Office Point | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

   <link rel="icon shortcut" href="../img/logo.png">
   
   <link rel="stylesheet" href="../css/dashboard-contact.css">
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
            <h1 class="m-0" style="color:#444">Contacto</h1>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <div class="contact-icons">
	<div class="contact-icons-item">
		<?php 
        $resultado = $conexion ->query("select * from contacto where id='1'"); 
        $fila = mysqli_fetch_array($resultado)
			?>
		<span><?php echo $phone; ?></span>
		<h1>Teléfono</h1>
		<a><?php echo $fila[1]; ?>
		</a>
        <button style="margin-bottom:1em" class="btn btn-primary btn-small btnEditar" 
        data-id="1"
        data-texto="<?php echo $fila['texto'] ?>"
    	data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
	</div>
	<div class="contact-icons-item">
		<?php 
        $resultado2 = $conexion ->query("select * from contacto where id='2'"); 
        $fila2 = mysqli_fetch_array($resultado2)
			?>
		<span><?php echo $map; ?></span>
		<h1>Dirección</h1>
		<a><?php echo $fila2[1]; ?></a>
        <button style="margin-bottom:1em" class="btn btn-primary btn-small btnEditar" 
        data-id="2"
        data-texto="<?php echo $fila2['texto'] ?>"
    	data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
	</div>
	<div class="contact-icons-item">
		<?php 
        $resultado3 = $conexion ->query("select * from contacto where id='3'"); 
        $fila3 = mysqli_fetch_array($resultado3)
			?>
		<span><?php echo $clock; ?></span>
		<h1>Horario</h1>
		<a><?php echo $fila3[1]; ?></a>
        <button style="margin-bottom:1em" class="btn btn-primary btn-small btnEditar" 
        data-id="3"
        data-texto="<?php echo $fila3['texto'] ?>"
    	data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
	</div>
	<div class="contact-icons-item">
		<?php 
        $resultado4 = $conexion ->query("select * from contacto where id='4'"); 
        $fila4 = mysqli_fetch_array($resultado4)
			?>
		<span><?php echo $envelope; ?></span>
		<h1>Email</h1>
		<a><?php echo $fila4[1]; ?></a>
        <button style="margin-bottom:1em" class="btn btn-primary btn-small btnEditar" 
        data-id="4"
        data-texto="<?php echo $fila4['texto'] ?>"
    	data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>

	</div>
</div>    <!-- /.content-header -->
  </div>
  <!-- /.content-wrapper -->
<!-- Modal editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarcontacto.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit" name="id">
      <div class="form-group">
        <input type="text" name="texto" placeholder="Nombre" id="textoEdit" class="form-control" required>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary editar">Guardar</button>
      </div>
		</form>
    </div>
  </div>
</div>
  <?php include ('./footer.php'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
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
		var idEditar = -1;
		var fila;
		$('.btnEditar').click(function(){
			var id=$(this).data('id');
			var texto=$(this).data('texto');
			$('#idEdit').val(id);
			$('#textoEdit').val(texto);
		});
	});
	</script>

</body>
</html>

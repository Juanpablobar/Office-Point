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
popup where id=1")or die($conexion->error);
$popup = mysqli_fetch_array($resultado);
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

   <link rel="stylesheet" href="../css/dashboard-popup.css">
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
            <h1 class="m-0" style="color:#444">Editar Anuncio Emergente</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
<button type="button" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#modalEditar"
data-etiqueta="<?php echo $popup[2]; ?>"
data-texto1="<?php echo $popup[3]; ?>"
data-texto2="<?php echo $popup[4]; ?>"
>
  	<i class="fa fa-edit"></i> Editar Anuncio
</button>          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="popup">
	<div class="popup-cont">
		<div class="popup-img">
			<img src="../img/<?php echo $popup[1]; ?>">
		</div>
		<div class="popup-text">
			<div class="popup-close">
				<span id="popup_close"><i class="fa fa-times"></i></span>
			</div>
			<span><?php echo $popup[2]; ?></span>
			<h1><?php echo $popup[3]; ?></h1>
			<h2><?php echo $popup[4]; ?></h2>
			<form action="#" method="post">
				<input type="text" name="email" placeholder="Dirección de correo" required>
				<button type="submit" name="send_email">Suscribir</button>
			</form>
		</div>
	</div>
</div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarPopup.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Anuncio Emergente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <input type="hidden" name="id" placeholder="id" id="idEdit" class="form-control">
        <label for="">Imagen</label>
        <input type="file" name="imagen" class="form-control">
      </div>
          <div class="form-group">
          <input type="hidden" name="id" placeholder="id" id="idEdit" class="form-control">
        <label for="">Etiqueta</label>
        <input type="text" name="etiqueta" id="etiquetaEdit" class="form-control" required>
      </div>
          <div class="form-group">
          <input type="hidden" name="id" placeholder="id" id="idEdit" class="form-control">
        <label for="">Texto 1</label>
        <input type="text" name="texto1" id="texto1Edit" class="form-control" required>
      </div>
          <div class="form-group">
          <input type="hidden" name="id" placeholder="id" id="idEdit" class="form-control">
        <label for="">Texto2</label>
        <input type="text" name="texto2" id="texto2Edit" class="form-control" required>
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
    $('.btnEditar').click(function(){
			var etiqueta=$(this).data('etiqueta');
			var texto1=$(this).data('texto1');
			var texto2=$(this).data('texto2');
			$('#etiquetaEdit').val(etiqueta);
			$('#texto1Edit').val(texto1);
			$('#texto2Edit').val(texto2);
		});
});
	</script>
</body>
</html>

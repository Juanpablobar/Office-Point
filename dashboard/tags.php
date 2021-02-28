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
tags order by id desc")or die($conexion->error);
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

   <link rel="stylesheet" href="../css/dashboard-tags.css">
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
		  if(isset($_GET['success'])){
		  ?>
		<div class="alert alert-success" role="alert">
		  Se ha insertado correctamente
		</div>
          <?php } ?>
          <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color:#444">Tags/Etiquetas (
              <?php
              if(mysqli_num_rows($resultado) > 0){
              echo mysqli_num_rows($resultado);
              }else{
                echo '0';
              }
            ?>
            )</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  	<i class="fa fa-plus"></i> Crear Etiqueta
</button>          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="tags">
<?php
    $resultado = $conexion ->query("select * from tags order by id"); 
    while($fila = mysqli_fetch_array($resultado)){
?>
    <a><?php echo  $fila[1] ?>             
    <button title="Eliminar Tag" class="btn btn-danger btn-small btnEliminar" data-id="<?php echo $fila[0] ?>" data-toggle="modal" data-target="#modalEliminar">
            <i class="fa fa-trash"></i>
            </button>
</a>
    <?php } ?>
</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/insertarTag.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Etiqueta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Nombre</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Una vez creada la Etiqueta aparecerá en la tienda y podrá ligarla a los productos correspondientes.</h6>
        <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
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

<!-- Modal eliminar -->
 <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Etiqueta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar la etiqueta?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" data-dismiss="modal" class="btn btn-danger eliminar">Eliminar</button>
      </div>
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
		var idEliminar = -1;
		var fila;
		$(".btnEliminar").click(function(){
		idEliminar = $(this).data('id');
		fila=$(this).parent('a');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '../php/eliminarTag.php',
				method: 'POST',
				data:{
					id:idEliminar
				}
			}).done(function(res){
				$(fila).fadeOut(1000);
			});
		});
	});
	</script>
</body>
</html>

<?php
session_start();
include '../php/conexion.php';
if(!isset($_SESSION['datos_login'])){
	header("Location: ../login.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'admin'){
	header('Location: ./');
}
$resultado = $conexion->query("
select * from usuarios order by nivel ASC")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Office Point | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="icon shortcut" href="../img/logo%20img.png">
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
            <h1 class="m-0">Usuarios (<?php echo $f=mysqli_num_rows($resultado) ?>)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content content-fluid">
    	<div class="content-fluid">
<div id="accordion">
 <?php
	while($f=mysqli_fetch_array($resultado)){
	?>
  <div class="card">
    <div class="card-header" id="heading<?php echo $f['id'] ?>">
      <h5 class="mb-0">
        <button style="text-transform: capitalize;color:#444" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $f['id'] ?>">
          <?php echo $f['nombre'] .' - '. $f['nivel'] ?>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $f['id'] ?>" class="collapse" aria-labelledby="heading<?php echo $f['id'] ?>" data-parent="#accordion">
      <div class="card-body">
		  <p>Id de Usuario: <?php echo $f['id'] ?></p>
		  <p>Nombre del Usuario: <?php echo $f['nombre'] ?></p>
		  <p>Correo del Usuario: <?php echo $f['correo'] ?></p>
		  <p>Contraseña encriptada: <?php echo $f['contraseña'] ?></p>
      <p>Método de ingreso: <?php echo $f['metodo']; ?></p>
		  <p>Nivel de acceso: <?php echo $f['nivel'] ?></p>
     <p>    					<button class="btn btn-primary btn-small btnEditar" data-id="<?php echo $f['id'] ?>"
    					data-id="<?php echo $f['id'] ?>"
    					data-nombre="<?php echo $f['nombre'] ?>"
    					data-perfil="<?php echo $f['perfil'] ?>"
    					data-nivel="<?php echo $f['nivel'] ?>"
    					  data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
</p>
      </div>
    </div>
  </div>
  <?php } ?>
</div>    	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal -->

<!-- Modal eliminar -->

<!-- Modal editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarUsuario.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Cambiar nivel de acceso</label>
        <input name="id_user" type="hidden" value="<?php echo $arregloUsuario['id']; ?>">
        <select class="form-control" name="user_nvl" required>
        <option value="cliente">Cliente</option>
        <option value="admin">Admin</option>
        </select>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="user" class="btn btn-primary editar">Guardar</button>
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
</body>
</html>

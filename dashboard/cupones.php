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
cupones order by id desc")or die($conexion->error);
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
            <h1 class="m-0" style="color:#444">Cupones</h1>
            <h6 style="margin-top:.5em:color:#444">Activos (
              <?php
              $resultado2 = $conexion->query("
              select * from
              cupones where status='activo'")or die($conexion->error);
              if(mysqli_num_rows($resultado2) > 0){
                echo mysqli_num_rows($resultado2) ;
              }else{
                echo '0';
              }
            ?>
            )</h6>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  	<i class="fa fa-plus"></i> Crear Cupón
</button>          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content content-fluid">
    	<div class="content-fluid">
    		<table class="table">
    			<thead>
    			<tr>
    				<th style="color:#444">Id</th>
    				<th style="color:#444">Código</th>
    				<th style="color:#444">Status</th>
    				<th style="color:#444">Tipo </th>
    				<th style="color:#444">Valor</th>
    				<th style="color:#444">Fecha de Vencimiento</th>
    				<th></th>
					</tr>
    			</thead>
    			<tbody>
    			<tr>
    			<?php
					while($f = mysqli_fetch_array($resultado)){
            if(strtotime($f['fecha_de_vencimiento']) < strtotime(date("Y-m-d"))){
              $conexion->query("update cupones set 
              status='vencido'
              where id=".$f['id']);
                    }else{
              echo '';
            }
					?>
    				<td><?php echo $f['id']; ?></td>
    				<td><?php echo $f['codigo']; ?></td>
    				<td><?php echo $f['status']; ?></td>
    				<td><?php echo $f['tipo']; ?></td>
    				<td><?php echo $f['valor']; ?></td>
    				<td><?php echo $f['fecha_de_vencimiento']; ?></td>
    				<td>
      					<button class="btn btn-danger btn-small btnEliminar" data-id="<?php echo $f['id'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></button>
    				</td>
					</tr>
   			<?php } ?>
    			</tbody>
    		</table>
    	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action=".././php/insertarcupon.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Cupón</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Código</label>
        <div class="row">
        	<div class="col-9">
        <input type="text" name="codigo" placeholder="Código" id="codigo" class="form-control" required>
        	</div>
        	<div class="col-3">
        		<button class="btn btn-primary btn-small col-12" id="generar">Generar</button>
        	</div>
        </div>
      </div>
      <div class="form-group">
        <label for="">Tipo</label>
        <select name="tipo" placeholder="Tipo" id="tipo" class="form-control" required>
        <option value="moneda">Moneda</option>
        <option value="porcentaje">Porcentaje</option>
		  </select>
      </div>
      <div class="form-group">
        <label for="">Valor del cupón</label>
        <input type="number" min="0" name="valor" placeholder="Valor del cupón" id="valor" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Fecha de vencimiento</label>
        <input type="date" min="0" name="fecha" placeholder="Fecha de vencimiento" id="fecha" class="form-control" required> 
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
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar el producto?
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
		$("#generar").click(function(){
							var num = Math.floor( Math.random()*900000)+100000;
		$("#codigo").val(num);
							})
		$(".btnEliminar").click(function(){
		idEliminar = $(this).data('id');
		fila=$(this).parent('td').parent('tr');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '.././php/eliminarCupon.php',
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

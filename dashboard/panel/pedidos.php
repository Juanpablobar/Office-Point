<?php
session_start();
include '../.././php/conexion.php';
$resultado = $conexion->query("
select ventas.*, envios.nombre, envios.correo, envios.calle, envios.apartamento, envios.cp, envios.ciudad, envios.estado, envios.pais, envios.envio from ventas inner join envios on   ventas.id = envios.id_venta")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grodel | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="icon shortcut" href="../../img/logo%20img.png">
    <link rel="stylesheet" href="../../css/login.css">
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
		  if(isset($_GET['error'])){
		  ?>
		<div class="alert alert-danger" role="alert">
		  <?php echo $_GET['error']; ?>
		</div>
          <?php } ?>
       <?php
		  if(isset($_GET['success'])){
		  ?>
		<div class="alert alert-success" role="alert">
		  Se ha insertado correctamente
		</div>
          <?php } ?>
       <?php
		  if(isset($_GET['edit'])){
		  ?>
		<div class="alert alert-success" role="alert">
		  Se ha editado correctamente
		</div>
          <?php } ?>
           <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pedidos</h1>
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
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $f['id'] ?>">
          <?php echo $f['fecha']. '-'.$f['nombre'] ?>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $f['id'] ?>" class="collapse" aria-labelledby="heading<?php echo $f['id'] ?>" data-parent="#accordion">
      <div class="card-body">
		  <p>Nombre del Cliente: <?php echo $f['nombre'] ?></p>
		  <p>Correo del Cliente: <?php echo $f['correo'] ?></p>
     		<p class="h6">Datos de envío</p>

     		<p>Dirección: <?php echo $f['calle'] ?></p>
     		<p>Apartamento: <?php echo $f['apartamento'] ?></p>
     		<p>Código Postal: <?php echo $f['cp'] ?></p>
     		<p>Ciudad: <?php echo $f['ciudad'] ?></p>
     		<p>Estado: <?php echo $f['estado'] ?></p>
     		<p>País: <?php echo $f['pais'] ?></p>
     		<p>Envío: <?php echo $f['envio'] ?></p>
    		<table class="table">
    			<thead>
    			<tr>
    				<th>Id</th>
    				<th>Nombre</th>
    				<th>Precio</th>
    				<th>Material</th>
    				<th>Marca</th>
    				<th>Cantidad</th>
    				<th>Subtotal</th>
    				<th></th>
					</tr>
    			</thead>
    			<tbody>
    			<tr>
    			<?php
		$re=$conexion->query("select productos_venta.*, productos.nombre, productos.material, productos.marca from productos_venta inner join productos on productos_venta.id_producto = productos.id where productos_venta.id_producto= productos.id")or die($conexion->error);
					while($f2 = mysqli_fetch_array($re)){
					?>
    				<td><?php echo $f2['id']; ?></td>
    				<td><?php echo $f2['nombre']; ?></td>
    				<td><?php echo $f2['precio']; ?></td>
    				<td><?php echo $f2['material']; ?></td>
    				<td><?php echo $f2['marca']; ?></td>
    				<td><?php echo $f2['cantidad']; ?></td>
    				<td><?php echo $f['subtotal']; ?></td>
					</tr>
   			<?php } ?>
    			</tbody>
    		</table>
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
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../.././php/insertarproducto.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insertar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Imagen</label>
        <input type="file" name="imagen" placeholder="Imagen" id="imagen" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Precio</label>
        <input type="text" name="precio" placeholder="Precio" id="precio" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Tamaño</label>
        <input type="text" name="tamaño" placeholder="Tamaño" id="tamaño" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Material</label>
        <input type="text" name="material" placeholder="Material" id="material" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Marca</label>
        <input type="text" name="marca" placeholder="Marca" id="marca" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Stock</label>
        <input type="text" name="stock" placeholder="Stock" id="stock" class="form-control" required>
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
 <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../.././php/editarproducto.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit" name="id">
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre" id="nombreEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Imagen</label>
        <input type="file" name="imagen" placeholder="Imagen" id="imagenEdit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Precio</label>
        <input type="text" name="precio" placeholder="Precio" id="precioEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Tamaño</label>
        <input type="text" name="tamaño" placeholder="Tamaño" id="tamañoEdit" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Material</label>
        <input type="text" name="material" placeholder="Material" id="materialEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Marca</label>
        <input type="text" name="marca" placeholder="Marca" id="marcaEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Stock</label>
        <input type="text" name="stock" placeholder="Stock" id="stockEdit" class="form-control" required>
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
		var idEliminar = -1;
		var idEditar = -1;
		var fila;
		$(".btnEliminar").click(function(){
		idEliminar = $(this).data('id');
		fila=$(this).parent('td').parent('tr');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '../.././php/eliminarproducto.php',
				method: 'POST',
				data:{
					id:idEliminar
				}
			}).done(function(res){
				$(fila).fadeOut(1000);
			});
		});
		$('.btnEditar').click(function(){
			idEditar=$(this).data('id');
			var nombre=$(this).data('nombre');
			var imagen=$(this).data('imagen');
			var precio=$(this).data('precio');
			var tamaño=$(this).data('tamaño');
			var material=$(this).data('material');
			var marca=$(this).data('marca');
			var stock=$(this).data('stock');
			$('#nombreEdit').val(nombre);
			$('#imagenEdit').val(imagen);
			$('#precioEdit').val(precio);
			$('#tamañoEdit').val(tamaño);
			$('#materialEdit').val(material);
			$('#marcaEdit').val(marca);
			$('#stockEdit').val(stock);
			$('#idEdit').val(idEditar);
		});
	});
	</script>
</body>
</html>

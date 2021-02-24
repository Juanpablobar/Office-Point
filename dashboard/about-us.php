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
   
   <link rel="stylesheet" href="../css/dashboard-about-us.css">
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
            <h1 class="m-0" style="color:#444">Sobre Nosotros</h1>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <div class="about-info">
	       <?php
                   $resultado10 = $conexion ->query("select * from nosotros_texto order by id"); 
                
                while($fila10 = mysqli_fetch_array($resultado10)){
                ?>
	<div class="about-info-item">
		<img src="../img/<?php echo $fila10[3]; ?>" alt="<?php echo $fila10[4]; ?>" title="<?php echo $fila10[4]; ?>">
		<h1><?php echo $fila10[1]; ?></h1>
		<h2><?php echo $fila10[2]; ?></h2>
        <button style="margin-bottom:1em" class="btn btn-primary btn-small btnEditar" data-id="<?php echo $fila10['id'] ?>"
        data-titulo="<?php echo $fila10['titulo']; ?>"
        data-texto="<?php echo $fila10['texto']; ?>"
        data-img="<?php echo $fila10['img']; ?>"
        data-alt="<?php echo $fila10['alt']; ?>"
        data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>

	</div>
	<?php } ?>
</div>
<div class="about-why-us">
	<h1>¿Por qué Nosotros?</h1>
	<h2>Nuestros Beneficios</h2>
	<div class="about-why-us-benefits">
		<div class="about-why-us-video">
			<?php 
				$resultado = $conexion ->query("select * from nosotros_img where id='1'"); 
				$fila = mysqli_fetch_array($resultado);

				$resultado2 = $conexion ->query("select * from nosotros_img where id='2'"); 
				$fila2 = mysqli_fetch_array($resultado2);

			
			?>
			<img src="../img/<?php echo $fila[1]; ?>" alt="<?php echo $fila[2] ?>" title="<?php echo $fila[2] ?>" style="display:block">
      <button style="margin-bottom:1em;display:block" class="btn btn-primary btn-small btnEditar2" data-id="<?php echo $fila['id'] ?>"
        data-img="<?php echo $fila['img']; ?>"
        data-alt="<?php echo $fila['alt']; ?>"
        data-toggle="modal" data-target="#modalEditar2"><i class="fa fa-edit"></i></button>
		</div>
		<div class="about-why-us-carac">
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $income; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Envío Gratis</h3>
					<h4>Envíos Gratis en pedidos a partir de %500.00 pesos</h4>
				</div>
			</div>
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $piggy_bank; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Ahorra tu Dinero</h3>
					<h4>Aprovecha Nuestros Precios y Grandes Ofertas</h4>
				</div>
			</div>
			<div class="about-why-us-item">
				<div class="about-why-us-icon">
					<span><?php echo $credit_card; ?></span>
				</div>
				<div class="about-why-us-text">
					<h3>Pago Seguro</h3>
					<h4>Pago protegido por protocolo HTTPS</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="about-brands">
	<h1>Nuestras Marcas</h1>
	<img src="../img/<?php echo $fila2[1]; ?>" alt="<?php echo $fila2[2] ?>" title="<?php echo $fila2[2] ?>">
  <button style="margin-bottom:1em;display:block" class="btn btn-primary btn-small btnEditar3" data-id="<?php echo $fila2['id'] ?>"
        data-img="<?php echo $fila2['img']; ?>"
        data-alt="<?php echo $fila2['alt']; ?>"
        data-toggle="modal" data-target="#modalEditar3"><i class="fa fa-edit"></i></button>

	<div class="about-brands-img-prev">
		<div class="about-brands-img">
      <?php
      $resultado4 = $conexion ->query("select * from nosotros_img where id in (3,4,5,6,7)");
      while ($fila4 = mysqli_fetch_array($resultado4)) {
          ?>
			<img src="../img/<?php echo $fila4[1]; ?>" alt="<?php echo $fila4[2] ?>" title="<?php echo $fila4[2] ?>">
      <button style="margin-bottom:1em;display:block" class="btn btn-primary btn-small btnEditar4" data-id="<?php echo $fila4['id'] ?>"
        data-img="<?php echo $fila4['img']; ?>"
        data-alt="<?php echo $fila4['alt']; ?>"
        data-toggle="modal" data-target="#modalEditar4"><i class="fa fa-edit"></i></button>

      <?php
      } ?>
		</div>
	</div>
</div>


  </div>
  <!-- /.content-wrapper -->
<!-- Modal editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarAbout-Us.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit" name="id">
      <div class="form-group">
        <label for="">Sub-Título</label>
        <input type="text" name="titulo" placeholder="Sub-Título" id="tituloEdit" class="form-control" min="0" required>
      </div>
      <div class="form-group">
        <label for="">Texto</label>
        <input type="text" name="texto" placeholder="Escriba el texto de este sub-título" id="textoEdit" class="form-control" min="0" required>
      </div>
      <div class="form-group">
        <label for="">Imagen</label>
        <input type="file" name="imagen" placeholder="Imagen" id="imagenEdit" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label for="">Alt</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Esto se mostrará cuando la imagen no se pueda cargar</h6>
        <input type="text" name="alt" placeholder="Alt" id="altEdit" class="form-control" min="0" required>
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

<div class="modal fade" id="modalEditar2" tabindex="-1" role="dialog" aria-labelledby="modalEditar2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarAbout-Us2.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit2" name="id">
      <div class="form-group">
        <label for="">Imagen</label>
        <input type="file" name="imagen" placeholder="Imagen" id="imagenEdit2" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label for="">Alt</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Esto se mostrará cuando la imagen no se pueda cargar</h6>
        <input type="text" name="alt" placeholder="Alt" id="altEdit2" class="form-control" min="0" required>
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

<div class="modal fade" id="modalEditar3" tabindex="-1" role="dialog" aria-labelledby="modalEdita3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarAbout-Us2.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar3">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit3" name="id">
      <div class="form-group">
        <label for="">Imagen</label>
        <input type="file" name="imagen" placeholder="Imagen" id="imagenEdit3" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label for="">Alt</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Esto se mostrará cuando la imagen no se pueda cargar</h6>
        <input type="text" name="alt" placeholder="Alt" id="altEdit3" class="form-control" min="0" required>
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

<div class="modal fade" id="modalEditar4" tabindex="-1" role="dialog" aria-labelledby="modalEdita4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarAbout-Us2.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar4">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit4" name="id">
      <div class="form-group">
        <label for="">Imagen</label>
        <input type="file" name="imagen" placeholder="Imagen" id="imagenEdit4" class="form-control" min="0">
      </div>
      <div class="form-group">
        <label for="">Alt</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Esto se mostrará cuando la imagen no se pueda cargar</h6>
        <input type="text" name="alt" placeholder="Alt" id="altEdit4" class="form-control" min="0" required>
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
			var titulo=$(this).data('titulo');
			var texto=$(this).data('texto');
			var alt=$(this).data('alt');
			var imagen=$(this).data('imagen');
			$('#idEdit').val(id);
			$('#tituloEdit').val(titulo);
			$('#textoEdit').val(texto);
			$('#altEdit').val(alt);
			$('#imagenEdit').val(imagen);
		});
		$('.btnEditar2').click(function(){
			var id=$(this).data('id');
			var alt=$(this).data('alt');
			$('#idEdit2').val(id);
			$('#altEdit2').val(alt);
    });
		$('.btnEditar3').click(function(){
			var id=$(this).data('id');
			var alt=$(this).data('alt');
			$('#idEdit3').val(id);
			$('#altEdit3').val(alt);
		});
		$('.btnEditar4').click(function(){
			var id=$(this).data('id');
			var alt=$(this).data('alt');
			$('#idEdit4').val(id);
			$('#altEdit4').val(alt);
		});
	});
	</script>

</body>
</html>

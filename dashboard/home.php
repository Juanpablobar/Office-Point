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
carousel_index order by id desc")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Office Point | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="icon shortcut" href="../../img/logo.png">
    <link rel="stylesheet" href="../css/dashboard-home.css">
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
            <h6 class="close-menu" style="color:#999">Te recomendamos cerrar el menú para visualizar correctamente</h6>
            <h1 class="m-0" style="color: #444;">Carrusel de imágenes 
            <?php
             if(mysqli_num_rows($resultado) > 1){
                  echo '('.mysqli_num_rows($resultado).' diapositivas)';
             }else{
              echo '('.mysqli_num_rows($resultado).' diapositiva)';
            }
             ?>
             </h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right ml-auto" style="margin-top:1em;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  	<i class="fa fa-plus"></i> Insertar Diapositiva
</button>          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="index-carousel">
	<div class="owl-carousel owl-theme owl-carousel1">
	       <?php
                   $resultado = $conexion ->query("select * from carousel_index order by id"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
		<div class="item">
		<div class="item-img">
			<img src="../img/<?php echo $fila[1]; ?>">
			<img src="../img/<?php echo $fila[15]; ?>">
		</div>
		<div class="item-text <?php echo $fila[2]; ?>">
		<div class="item-text-align">
		<span style="color: <?php echo $fila[14]; ?>;background:<?php echo $fila[13]; ?>">#<?php echo $fila[12]; ?></span>
		<h1 style="color: <?php echo $fila[4]; ?>"><?php echo $fila[3]; ?></h1>
		<h2 style="color: <?php echo $fila[6]; ?>"><?php echo $fila[5]; ?></h2>
		<a class="carousel-a" href="<?php echo $fila[12]; ?>" style="color:<?php echo $fila[9]; ?>;border-color:<?php echo $fila[10]; ?>;background:<?php echo $fila[8]; ?>"><?php echo $fila[7]; ?></a>
		</div>
			</div>
      <div class="carousel-buttons">
      <button class="btn btn-primary btn-small btnEditar" 
              data-id="<?php echo $fila[0] ?>"
              data-p-texto="<?php echo $fila[2] ?>"
              data-titulo="<?php echo $fila[3] ?>"
              data-c-titulo="<?php echo $fila[4] ?>"
              data-texto="<?php echo $fila[5] ?>"
              data-c-texto="<?php echo $fila[6] ?>"
              data-t-boton="<?php echo $fila[7] ?>"
              data-cr-boton="<?php echo $fila[8] ?>"
              data-cl-boton="<?php echo $fila[9] ?>"
              data-cb-boton="<?php echo $fila[10] ?>"
              data-t-etiqueta="<?php echo $fila[12] ?>"
              data-cr-etiqueta="<?php echo $fila[13] ?>"
              data-cl-etiqueta="<?php echo $fila[14] ?>"
              data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
    					<button class="btn btn-danger btn-small btnEliminar" data-id="<?php echo $fila['id'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></button>
    </div>

	</div>
	<?php } ?>
  <div class="content-header">
      <div class="container-fluid">
           <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: #444;">íconos</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="index-icons">
	<?php
		$resultado = $conexion ->query("select * from icons_index where id='1'"); 
		$fila = mysqli_fetch_array($resultado)
	?>
	<div class="index-icons-item">
	<div class="index-icons-cont">
		<span><img src="../img/delivery.svg"></span>
		<h1><?php echo $fila[1]; ?></h1>
		<h2><?php echo $fila[2]; ?></h2>
    <button class="btn btn-primary btn-small btnEditar2" 
              data-id="<?php echo $fila[0] ?>"
              data-texto1="<?php echo $fila[1] ?>"
              data-texto2="<?php echo $fila[2] ?>"
              data-toggle="modal" data-target="#modalEditar2"><i class="fa fa-edit"></i></button>
	</div>
	</div>
	<?php
		$resultado2 = $conexion ->query("select * from icons_index where id='2'"); 
		$fila2 = mysqli_fetch_array($resultado2)
	?>
	<div class="index-icons-item">
	<div class="index-icons-cont">
		<span><img src="../img/price-tag.svg"></span>
		<h1><?php echo $fila2[1]; ?></h1>
		<h2><?php echo $fila2[2]; ?></h2>
    <button class="btn btn-primary btn-small btnEditar2" 
              data-id="<?php echo $fila2[0] ?>"
              data-texto1="<?php echo $fila2[1] ?>"
              data-texto2="<?php echo $fila2[2] ?>"
              data-toggle="modal" data-target="#modalEditar2"><i class="fa fa-edit"></i></button>
	</div>
	</div>
	<?php
		$resultado3 = $conexion ->query("select * from icons_index where id='3'"); 
		$fila3 = mysqli_fetch_array($resultado3)
	?>
	<div class="index-icons-item">
	<div class="index-icons-cont">
		<span><img src="../img/medal.svg"></span>
		<h1><?php echo $fila3[1]; ?></h1>
		<h2><?php echo $fila3[2]; ?></h2>
    <button class="btn btn-primary btn-small btnEditar2" 
              data-id="<?php echo $fila3[0] ?>"
              data-texto1="<?php echo $fila3[1] ?>"
              data-texto2="<?php echo $fila3[2] ?>"
              data-toggle="modal" data-target="#modalEditar2"><i class="fa fa-edit"></i></button>

	</div>
	</div>
</div>

<div class="content-header">
      <div class="container-fluid">
           <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: #444;margin-top:1em">Categorías</h1>
          </div>
          <div class="col-sm-6 text-right ml-auto" style="margin-top:1em;">
            <button type="button" class="btn btn-primary btn-small" 
              data-id="<?php echo $fila10[0] ?>"
              data-t_tag="<?php echo $fila10[4] ?>"
              data-cr_tag="<?php echo $fila10[2] ?>"
              data-cl_tag="<?php echo $fila10[3] ?>"
              data-fecha="<?php echo $fila10[5] ?>"
              data-cr_boton="<?php echo $fila10[6] ?>"
              data-cl_boton="<?php echo $fila10[7]; ?>"
              data-cb_boton="<?php echo $fila10[8] ?>"
               data-toggle="modal" data-target="#modalCatego">
            <i class="fa fa-edit"></i> Agregar Enlace a Categoría
            </button>
          </div>
        </div>
      </div>
    </div>
<div class="index-categories">
	       <?php
                   $resultado = $conexion ->query("select * from categorias_index order by id"); 
                
                while($fila = mysqli_fetch_array($resultado)){
                ?>
	<div class="index-categories-item <?php echo $fila[1]; ?> <?php echo $fila[2]; ?>" style="background-image: url('../img/<?php echo $fila[3]; ?>');background-size:cover;">
		<div class="index-categories-text <?php echo $fila[4]; ?> <?php echo $fila[5]; ?>">
			<div class="index-categories-text-sub">
				<h2 style="color: <?php echo $fila[7]; ?>">#<?php echo $fila[6]; ?></h2>
				<h1 style="color: <?php echo $fila[9]; ?>"><?php echo $fila[8]; ?></h1>
				<a style="color: <?php echo $fila[10]; ?>"><?php echo $fila[11]; ?> <?php echo $arrow_right; ?></a>
        <button class="btn btn-primary btn-small btnEditarCatego" 
              data-id="<?php echo $fila[0] ?>"
              data-alto="<?php echo $fila[1] ?>"
              data-ancho="<?php echo $fila[2] ?>"
              data-vertical="<?php echo $fila[4] ?>"
              data-horizontal="<?php echo $fila[5] ?>"
              data-t_tag="<?php echo $fila[6] ?>"
              data-cl_tag="<?php echo $fila[7] ?>"
              data-texto="<?php echo $fila[8] ?>"
              data-c_texto="<?php echo $fila[9] ?>"
              data-t_boton="<?php echo $fila[11] ?>"
              data-cl_boton="<?php echo $fila[10] ?>"
              data-toggle="modal" data-target="#modalEditarCatego"><i class="fa fa-edit"></i></button>
    					<button class="btn btn-danger btn-small btnEliminarCatego" data-id="<?php echo $fila[0] ?>" data-toggle="modal" data-target="#modalEliminarCatego"><i class="fa fa-trash"></i></button>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<br><br>
<br><br>
<?php
                $resultado10 = $conexion ->query("select * from reloj_index order by id"); 
                $fila10 = mysqli_fetch_array($resultado10);
?>
<div class="content-header">
      <div class="container-fluid">
           <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: #444;margin-top:1em">Reloj de Descuentos</h1>
          </div>
          <div class="col-sm-6 text-right ml-auto" style="margin-top:1em;">
            <button type="button" class="btn btn-primary btn-small btnEditar3" 
              data-id="<?php echo $fila10[0] ?>"
              data-t_tag="<?php echo $fila10[4] ?>"
              data-cr_tag="<?php echo $fila10[2] ?>"
              data-cl_tag="<?php echo $fila10[3] ?>"
              data-fecha="<?php echo $fila10[5] ?>"
              data-cr_boton="<?php echo $fila10[6] ?>"
              data-cl_boton="<?php echo $fila10[7]; ?>"
              data-cb_boton="<?php echo $fila10[8] ?>"
               data-toggle="modal" data-target="#modalEditar3">
            <i class="fa fa-edit"></i>  Editar Reloj
            </button>
          </div>
        </div>
      </div>
    </div>

<div class="index-clock">
    <div class="index-clock-cont">
		<div class="index-clock-img">
			<img src="../img/<?php echo $fila10[1]; ?>">
		</div>
		<div class="index-clock-text-flex">
			<div class="index-clock-text">
				<h4 style="background: <?php echo $fila10[2]; ?>;color: <?php echo $fila10[3] ;?>">#<?php echo $fila10[4]; ?></h4>
				<h1>Ofertas de la Semana</h1>
				<div class="index-clock-clock">
	<?php
							if($fila10[5] > 0){
							$date = $fila10[5];
							echo "<div class='item-shop-clock' id='clock'>
							<script>
							var end_clock = new Date('".$date." 12:00 AM'); 

								var _second = 1000;
								var _minute = _second * 60;
								var _hour = _minute * 60;
								var _day = _hour * 24;
								var timer;

								function showRemaining() {
									var now = new Date();
									var distance = end_clock - now;
									if (distance < 0) {

										clearInterval(timer);
										document.getElementById('clock').remove();

										return;
									}
									var days = Math.floor(distance / _day);
									var hours = Math.floor((distance % _day) / _hour);
									var minutes = Math.floor((distance % _hour) / _minute);
									var seconds = Math.floor((distance % _minute) / _second);

									document.getElementById('clock').innerHTML = 
										'<div><div><h1>' + days + '</h1><h2>Días</h2></div></div>';
									document.getElementById('clock').innerHTML += 
										'<div><div><h1>' + hours + '</h1><h2>Horas</h2></div></div>';
									document.getElementById('clock').innerHTML += 
										'<div><div><h1>' + minutes + '</h1><h2>Mins</h2></div></div>';
									document.getElementById('clock').innerHTML +=
										'<div><div><h1>' + seconds + '</h1><h2>Secs</h2></div></div>';
								}

								timer = setInterval(showRemaining, 1000);
															</script> 
									</div>";
							}else{
								echo '';
							}
							?>
							</div>
				<a class="clock-a" href="<?php echo $fila10[9]; ?>" style="background:<?php echo $fila10[6]; ?>;color: <?php echo $fila10[7]; ?>;border-color: <?php echo $fila10[8]; ?>">COMPRAR <?php echo $arrow_right; ?></a>
				<style>
					.clock-a:hover{
						background: <?php echo $fila10[8]; ?> !important;
						color: <?php echo $fila10[6]; ?> !important;
					}
					.clock-a svg{
						transition: none !important; 
					}
				</style>
			</div>
		</div>
	</div>
</div>
</div>
	</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/insertarCarousel.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insertar Diapositiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Imagen Principal</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Está imagen se visualizará para computadoras y tablets, por lo que debe ser una imagen amplia</h6>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen" placeholder="Imagen Principal" id="imagen" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Imagen para Teléfonos</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Está imagen se visualizará únicamente para celulares, por lo que debe ser una pequeña, quizá una fracción de la imagen anterior</h6>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen2" placeholder="Imagen para Teléfonos" id="imagen2" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Posición del texto horizontalmente</label>
        <select name="p_texto" placeholder="Posición del Texto" id="p_texto" class="form-control" required>
          <option value="derecha">Derecha</option>
          <option value="izquierda">Izquierda</option>
          <option value="centro">Centro</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Título</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es el texto con letras más grandes</h6>
        <input type="text" name="titulo" placeholder="Título" id="titulo" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del título</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escribe el color de las letras del título, si deseas que sean blancas pon 'white' o negras 'black', puedes poner cualquier color en inglés o el código hexadecimal de ellos como '#000000' para negro o '#ffffff' para blanco, puedes visitar <a href="https://www.color-hex.com/">Color Hex</a> para guiarte.</h6>
        <input type="text" name="c_titulo" placeholder="Color del título" id="c_titulo" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es el texto con letras más pequeñas</h6>
        <input type="text" name="texto" placeholder="Texto" id="texto" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del texto</label>
        <input type="text" name="c_texto" placeholder="Color del Texto" id="c_texto" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto del botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es le texto que irá dentro del botón, por ejemplo, 'Comprar' o 'Ver Más', trata de que sea corto.</h6>
        <input type="text" name="t_boton" placeholder="Texto dentro del botón" id="t_boton" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de relleno del botón</label>     
        <input type="text" name="cr_boton" placeholder="Color de relleno del botón" id="cr_boton" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de las letras del botón</label>
        <input type="text" name="cl_boton" placeholder="Color de las letras del botón" id="cl_boton" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del borde del botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Debe ser del mismo color que las letras.</h6>
        <input type="text" name="cb_boton" placeholder="Color del border del botón" id="cb_boton" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Texto de la etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escoge una de las categorías que aparecerá en la etiqueta y a la que dirigira al usuario cuando de click al botón.</h6>
        <select name="t_etiqueta"id="t_etiqueta" class="form-control" required>
        <?php
          $resultado30 = $conexion ->query("select * from categorias order by id"); 
          while($fila30 = mysqli_fetch_array($resultado30)){
          ?>
          <option value="<?php echo $fila30['nombre']; ?>"><?php echo $fila30['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado31 = $conexion ->query("select * from subcategorias order by id"); 
          while($fila31 = mysqli_fetch_array($resultado31)){
          ?>
          <option value="<?php echo $fila31['nombre']; ?>"><?php echo $fila31['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado32 = $conexion ->query("select * from tags order by id"); 
          while($fila32 = mysqli_fetch_array($resultado32)){
          ?>
          <option value="<?php echo $fila32['nombre']; ?>"><?php echo $fila32['nombre'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Color de las letras de la etiqueta</label>
        <input type="text" name="cl_etiqueta" placeholder="Color de las letras de la etiqueta" id="cl_etiqueta" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de relleno de la etiqueta</label>
        <input type="text" name="cr_etiqueta" placeholder="Color de relleno de la etiqueta" id="cr_etiqueta" class="form-control" required>
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

<div class="modal fade" id="modalCatego" tabindex="-1" role="dialog" aria-labelledby="modalCategoTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/insertarIndexCatego.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insertar Enlace a Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Imagen</label>
      <input type="file" name="imagen" placeholder="Imagen" id="imagenCatego" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Alto</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Determina si el elemento abarcará uno o dos espacios de altura</h6>
        <select name="alto" placeholder="Altura del elemento" id="alto" class="form-control" required>
          <option value="categories-height1">1</option>
          <option value="categories-height2">2</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Ancho</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Determina si el elemento abarcará uno, dos, tres o cuatro espacios de ancho</h6>
        <select name="ancho" placeholder="Anchura del elemento" id="ancho" class="form-control" required>
          <option value="categories-width1">1</option>
          <option value="categories-width2">2</option>
          <option value="categories-width3">3</option>
          <option value="categories-width4">4</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Posición del Texto Verticalmente</label>
        <select name="vertical" placeholder="Posición del Texto Verticalmente" id="vertical" class="form-control" required>
          <option value="index-categories-text-top">Arriba</option>
          <option value="index-categories-text-center">Centro</option>
          <option value="index-categories-text-bottom">Abajo</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Posición del Texto Horizontalmente</label>
        <select name="horizontal" placeholder="Posición del Texto Horizontalmente" id="horizontal" class="form-control" required>
          <option value="index-categories-text-left">Izquierda</option>
          <option value="index-categories-text-center">Centro</option>
          <option value="index-categories-text-right">Derecha</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Texto de la Etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escoge una de las categorías que aparecerá en la etiqueta y a la que dirigira al usuario cuando de click al botón.</h6>
        <select name="t_tag" placeholder="Texto de la Etiqueta" id="t_tag" class="form-control" required>
        <?php
          $resultado30 = $conexion ->query("select * from categorias order by id"); 
          while($fila30 = mysqli_fetch_array($resultado30)){
          ?>
          <option value="<?php echo $fila30['nombre']; ?>"><?php echo $fila30['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado31 = $conexion ->query("select * from subcategorias order by id"); 
          while($fila31 = mysqli_fetch_array($resultado31)){
          ?>
          <option value="<?php echo $fila31['nombre']; ?>"><?php echo $fila31['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado32 = $conexion ->query("select * from tags order by id"); 
          while($fila32 = mysqli_fetch_array($resultado32)){
          ?>
          <option value="<?php echo $fila32['nombre']; ?>"><?php echo $fila32['nombre'] ?></option>
          <?php } ?>        </select>
      </div>
      <div class="form-group">
        <label for="">Color de letras de la Etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escribe el color de las letras de la etiqueta, si deseas que sean blancas pon 'white' o negras 'black', puedes poner cualquier color en inglés o el código hexadecimal de ellos como '#000000' para negro o '#ffffff' para blanco, puedes visitar <a href="https://www.color-hex.com/">Color Hex</a> para guiarte.</h6>
        <input type="text" name="cl_tag" placeholder="Color de letras de la Etiqueta" id="cl_tag" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto</label>
        <input type="text" name="texto" placeholder="Texto" id="texto" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del texto</label>
        <input type="text" name="c_texto" placeholder="Color del Texto" id="c_texto" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto del botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es le texto que irá dentro del botón, por ejemplo, 'Comprar' o 'Ver Más', trata de que sea corto.</h6>
        <input type="text" name="t_boton" placeholder="Texto dentro del botón" id="t_boton" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de las letras del botón</label>
        <input type="text" name="cl_boton" placeholder="Color de las letras del botón" id="cl_boton" class="form-control" required>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Diapositiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar la diapositiva?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" data-dismiss="modal" class="btn btn-danger eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEliminarCatego" tabindex="-1" role="dialog" aria-labelledby="modalEliminarCategoLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Enlace a Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar este enlace a una categoría?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" data-dismiss="modal" class="btn btn-danger eliminarCatego">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarCarousel.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Diapositiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit" name="id">
      <div class="form-group">
        <label for="">Imagen Principal</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Está imagen se visualizará para computadoras y tablets, por lo que debe ser una imagen amplia.</h6>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen" placeholder="Imagen Principal" id="imagenEdit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Imagen para Teléfonos</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Está imagen se visualizará únicamente para celulares, por lo que debe ser una pequeña, quizá una fracción de la imagen anterior</h6>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen2" placeholder="Imagen para Teléfonos" id="imagen2Edit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Posición del texto horizontalmente</label>
        <select name="p_texto" placeholder="Posición del Texto" id="p_textoEdit" class="form-control" required>
          <option value="derecha">Derecha</option>
          <option value="izquierda">Izquierda</option>
          <option value="centro">Centro</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Título</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es el texto con letras más grandes</h6>
        <input type="text" name="titulo" placeholder="Título" id="tituloEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del título</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escribe el color de las letras del título, si deseas que sean blancas pon 'white' o negras 'black', puedes poner cualquier color en inglés o el código hexadecimal de ellos como '#000000' para negro o '#ffffff' para blanco, puedes visitar <a href="https://www.color-hex.com/">Color Hex</a> para guiarte.</h6>
        <input type="text" name="c_titulo" placeholder="Color del título" id="c_tituloEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es el texto con letras más pequeñas</h6>
        <input type="text" name="texto" placeholder="Texto" id="textoEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del texto</label>
        <input type="text" name="c_texto" placeholder="Color del Texto" id="c_textoEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto del botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es le texto que irá dentro del botón, por ejemplo, 'Comprar' o 'Ver Más', trata de que sea corto.</h6>
        <input type="text" name="t_boton" placeholder="Texto dentro del botón" id="t_botonEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de relleno del botón</label>     
        <input type="text" name="cr_boton" placeholder="Color de relleno del botón" id="cr_botonEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de las letras del botón</label>
        <input type="text" name="cl_boton" placeholder="DColor de las letras del botón" id="cl_botonEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del borde del botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Debe ser del mismo color que las letras.</h6>
        <input type="text" name="cb_boton" placeholder="Color del border del botón" id="cb_botonEdit" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Texto de la etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escoge una de las categorías que aparecerá en la etiqueta y a la que dirigira al usuario cuando de click al botón.</h6>
        <select name="t_etiqueta" placeholder="Texto de la etiqueta" id="t_etiquetaEdit" class="form-control" required>
        <?php
          $resultado30 = $conexion ->query("select * from categorias order by id"); 
          while($fila30 = mysqli_fetch_array($resultado30)){
          ?>
          <option value="<?php echo $fila30['nombre']; ?>"><?php echo $fila30['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado31 = $conexion ->query("select * from subcategorias order by id"); 
          while($fila31 = mysqli_fetch_array($resultado31)){
          ?>
          <option value="<?php echo $fila31['nombre']; ?>"><?php echo $fila31['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado32 = $conexion ->query("select * from tags order by id"); 
          while($fila32 = mysqli_fetch_array($resultado32)){
          ?>
          <option value="<?php echo $fila32['nombre']; ?>"><?php echo $fila32['nombre'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Color de las letras de la etiqueta</label>
        <input type="text" name="cl_etiqueta" placeholder="Color de las letras de la etiqueta" id="cl_etiquetaEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de relleno de la etiqueta</label>
        <input type="text" name="cr_etiqueta" placeholder="Color de relleno de la etiqueta" id="cr_etiquetaEdit" class="form-control" required>
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
     <form action="../php/editarIcons.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar2">Editar Texto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit2" name="id">
      <div class="form-group">
        <label for="">Sub-Título</label>
        <input type="text" name="sub-titulo" placeholder="Sub-Título" id="sub-tituloEdit2" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto</label>
        <input type="text" name="texto" placeholder="Texto" id="textoEdit2" class="form-control" required>
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

<div class="modal fade" id="modalEditar3" tabindex="-1" role="dialog" aria-labelledby="modalEditar3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarReloj.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar3">Editar Reloj</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit3" name="id">
      <div class="form-group">
        <label for="">Imagen de Fondo</label>
        <input type="file" name="imagen" placeholder="Imagen de fondo" id="imagenEdit3" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Texto de la Etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escoge una de las categorías que aparecerá como etiqueta en el reloj, además será a esta categoría a la que se conducirá al usuario cunado de click al botón</h6>
        <select name="t_tag" id="t_tagEdit3" class="form-control" required>
        <?php
          $resultado30 = $conexion ->query("select * from categorias order by id"); 
          while($fila30 = mysqli_fetch_array($resultado30)){
          ?>
          <option value="<?php echo $fila30['nombre']; ?>"><?php echo $fila30['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado31 = $conexion ->query("select * from subcategorias order by id"); 
          while($fila31 = mysqli_fetch_array($resultado31)){
          ?>
          <option value="<?php echo $fila31['nombre']; ?>"><?php echo $fila31['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado32 = $conexion ->query("select * from tags order by id"); 
          while($fila32 = mysqli_fetch_array($resultado32)){
          ?>
          <option value="<?php echo $fila32['nombre']; ?>"><?php echo $fila32['nombre'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Color de Relleno de la Etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escribe el color de las letras del título, si deseas que sean blancas pon 'white' o negras 'black', puedes poner cualquier color en inglés o el código hexadecimal de ellos como '#000000' para negro o '#ffffff' para blanco, puedes visitar <a href="https://www.color-hex.com/">Color Hex</a> para guiarte.</h6>
        <input type="text" name="cr_tag" placeholder="Color de Relleno de la Etiqueta" id="cr_tagEdit3" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de las letras de la Etiqueta</label>
        <input type="text" name="cl_tag" placeholder="Color de las letras de la Etiqueta" id="cl_tagEdit3" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Fecha de Terminación</label>
        <input type="date" name="fecha" placeholder="Fecha de terminación" id="fechaEdit3" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de relleno del Botón</label>
        <input type="text" name="cr_boton" placeholder="Color de relleno del botón" id="cr_botonEdit3" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de letras del botón</label>
        <input type="text" name="cl_boton" placeholder="Color de letras del botón" id="cl_botonEdit3" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del borde del Botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">El color del borde debe ser del mismo color que las letras.</h6>
        <input type="text" name="cb_boton" placeholder="Color del borde de los botones" id="cb_botonEdit3" class="form-control" required>
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

<div class="modal fade" id="modalEditarCatego" tabindex="-1" role="dialog" aria-labelledby="modalEditarCatego" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarIndexCatego.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar3">Editar Enlace a Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idCatego" name="id">
      <div class="form-group">
        <label for="">Imagen</label>
      <input type="file" name="imagen" placeholder="Imagen" id="imagenCatego" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Alto</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Determina si el elemento abarcará uno o dos espacios de altura</h6>
        <select name="alto" placeholder="Altura del elemento" id="altoCatego" class="form-control" required>
          <option value="categories-height1">1</option>
          <option value="categories-height2">2</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Ancho</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Determina si el elemento abarcará uno, dos, tres o cuatro espacios de ancho</h6>
        <select name="ancho" placeholder="Anchura del elemento" id="anchoCatego" class="form-control" required>
          <option value="categories-width1">1</option>
          <option value="categories-width2">2</option>
          <option value="categories-width3">3</option>
          <option value="categories-width4">4</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Posición del Texto Verticalmente</label>
        <select name="vertical" placeholder="Posición del Texto Verticalmente" id="verticalCatego" class="form-control" required>
          <option value="index-categories-text-top">Arriba</option>
          <option value="index-categories-text-center">Centro</option>
          <option value="index-categories-text-bottom">Abajo</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Posición del Texto Horizontalmente</label>
        <select name="horizontal" placeholder="Posición del Texto Horizontalmente" id="horizontalCatego" class="form-control" required>
          <option value="index-categories-text-left">Izquierda</option>
          <option value="index-categories-text-center">Centro</option>
          <option value="index-categories-text-right">Derecha</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Texto de la Etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escoge una de las categorías que aparecerá en la etiqueta y a la que dirigira al usuario cuando de click al botón.</h6>
        <select name="t_tag" placeholder="Texto de la Etiqueta" id="t_tagCatego" class="form-control" required>
        <?php
          $resultado30 = $conexion ->query("select * from categorias order by id"); 
          while($fila30 = mysqli_fetch_array($resultado30)){
          ?>
          <option value="<?php echo $fila30['nombre']; ?>"><?php echo $fila30['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado31 = $conexion ->query("select * from subcategorias order by id"); 
          while($fila31 = mysqli_fetch_array($resultado31)){
          ?>
          <option value="<?php echo $fila31['nombre']; ?>"><?php echo $fila31['nombre'] ?></option>
          <?php } ?>
        <?php
          $resultado32 = $conexion ->query("select * from tags order by id"); 
          while($fila32 = mysqli_fetch_array($resultado32)){
          ?>
          <option value="<?php echo $fila32['nombre']; ?>"><?php echo $fila32['nombre'] ?></option>
          <?php } ?>        </select>
      </div>
      <div class="form-group">
        <label for="">Color de letras de la Etiqueta</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Escribe el color de las letras de la etiqueta, si deseas que sean blancas pon 'white' o negras 'black', puedes poner cualquier color en inglés o el código hexadecimal de ellos como '#000000' para negro o '#ffffff' para blanco, puedes visitar <a href="https://www.color-hex.com/">Color Hex</a> para guiarte.</h6>
        <input type="text" name="cl_tag" placeholder="Color de letras de la Etiqueta" id="cl_tagCatego" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto</label>
        <input type="text" name="texto" placeholder="Texto" id="textoCatego" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color del texto</label>
        <input type="text" name="c_texto" placeholder="Color del Texto" id="c_textoCatego" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Texto del botón</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Este es le texto que irá dentro del botón, por ejemplo, 'Comprar' o 'Ver Más', trata de que sea corto.</h6>
        <input type="text" name="t_boton" placeholder="Texto dentro del botón" id="t_botonCatego" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Color de las letras del botón</label>
        <input type="text" name="cl_boton" placeholder="Color de las letras del botón" id="cl_botonCatego" class="form-control" required>
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
		fila=$(this).parent('div').parent('div');
	});		
  $(".btnEliminarCatego").click(function(){
		idEliminarCatego = $(this).data('id');
		fila=$(this).parent('div').parent('div').parent('div');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '../../php/eliminarCarousel.php',
				method: 'POST',
				data:{
					id:idEliminar
				}
			}).done(function(res){
				$(fila).fadeOut(1000);
			});
		});
    	$(".eliminarCatego").click(function(){
			$.ajax({
				url: '../../php/eliminarIndexCatego.php',
				method: 'POST',
				data:{
					id:idEliminarCatego
				}
			}).done(function(res){
				$(fila).fadeOut(1000);
			});
		});
		$('.btnEditar').click(function(){
			idEditar=$(this).data('id');
			var p_texto=$(this).data('p-texto');
			var titulo=$(this).data('titulo');
			var c_titulo=$(this).data('c-titulo');
			var texto=$(this).data('texto');
			var c_texto=$(this).data('c-texto');
			var t_boton=$(this).data('t-boton');
			var cr_boton=$(this).data('cr-boton');
			var cl_boton=$(this).data('cl-boton');
			var cb_boton=$(this).data('cb-boton');
			var t_etiqueta=$(this).data('t-etiqueta');
			var cr_etiqueta=$(this).data('cr-etiqueta');
			var cl_etiqueta=$(this).data('cl-etiqueta');
			$('#idEdit').val(idEditar);
			$('#p_textoEdit').val(p_texto);
			$('#tituloEdit').val(titulo);
			$('#c_tituloEdit').val(c_titulo);
			$('#textoEdit').val(texto);
			$('#c_textoEdit').val(c_texto);
			$('#t_botonEdit').val(t_boton);
			$('#cr_botonEdit').val(cr_boton);
			$('#cl_botonEdit').val(cl_boton);
			$('#cb_botonEdit').val(cb_boton);
			$('#t_etiquetaEdit').val(t_etiqueta);
			$('#cr_etiquetaEdit').val(cr_etiqueta);
			$('#cl_etiquetaEdit').val(cl_etiqueta);
		});
		$('.btnEditar2').click(function(){
			idEditar2=$(this).data('id');
			var sub_titulo=$(this).data('texto1');
			var texto=$(this).data('texto2');
			$('#idEdit2').val(idEditar2);
			$('#sub-tituloEdit2').val(sub_titulo);
			$('#textoEdit2').val(texto);
		});
		$('.btnEditar3').click(function(){
			idEditar3=$(this).data('id');
			var t_tag=$(this).data('t_tag');
			var cr_tag=$(this).data('cr_tag');
			var cl_tag=$(this).data('cl_tag');
			var fecha=$(this).data('fecha');
			var cr_boton=$(this).data('cr_boton');
			var cl_boton=$(this).data('cl_boton');
			var cb_boton=$(this).data('cb_boton');
			$('#idEdit3').val(idEditar3);
			$('#t_tagEdit3').val(t_tag);
			$('#cr_tagEdit3').val(cr_tag);
			$('#cl_tagEdit3').val(cl_tag);
			$('#fechaEdit3').val(fecha);
			$('#cr_botonEdit3').val(cr_boton);
			$('#cl_botonEdit3').val(cl_boton);
			$('#cb_botonEdit3').val(cb_boton);
		});
		$('.btnEditarCatego').click(function(){
			idCatego=$(this).data('id');
			var alto=$(this).data('alto');
			var ancho=$(this).data('ancho');
			var vertical=$(this).data('vertical');
			var horizontal=$(this).data('horizontal');
			var t_tag=$(this).data('t_tag');
			var cl_tag=$(this).data('cl_tag');
			var texto=$(this).data('texto');
			var c_texto=$(this).data('c_texto');
			var t_boton=$(this).data('t_boton');
			var cl_boton=$(this).data('cl_boton');
			$('#idCatego').val(idCatego);
			$('#altoCatego').val(alto);
			$('#anchoCatego').val(ancho);
			$('#verticalCatego').val(vertical);
			$('#horizontalCatego').val(horizontal);
			$('#t_tagCatego').val(t_tag);
			$('#cl_tagCatego').val(cl_tag);
			$('#textoCatego').val(texto);
			$('#c_textoCatego').val(c_texto);
			$('#t_botonCatego').val(t_boton);
			$('#cl_botonCatego').val(cl_boton);
		});
	});
	</script>
</body>
</html>

<?php
session_start();

include '../php/conexion.php';
$arregloUsuario = $_SESSION['datos_login'];
if(!isset($_SESSION['datos_login'])){
	header("Location: ../login.php");
}
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
    <link rel="stylesheet" href="../../css/login.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../css/dashboard-index.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

	<?php include('./header.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Panel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
    if ($arregloUsuario['nivel'] == 'admin') {
        ?>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                <?php
                   $resultado2 = $conexion->query("
                   select * from
                   ventas where status='pendiente_envio'")or die($conexion->error);
                   $fila2 = mysqli_num_rows($resultado2);
                   if ($fila2 > 0) {
                       echo $fila2;
                   }else{
                       echo '0';
                   }
                   ?>

                </h3>
                <p>Pedidos Pendientes de Envío</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="pedidos" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>        
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                <?php
                   $resultado2 = $conexion->query("
                   select * from
                   ventas where status='finalizada' or status='pendiente_envio'")or die($conexion->error);
                   $fila2 = mysqli_num_rows($resultado2);
                   if ($fila2 > 0) {
                       echo $fila2;
                   }else{
                       echo '0';
                   }
                   ?>

                </h3>
                <p>Ventas Realizadas</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="pedidos" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php
                $resultado2 = $conexion->query("
                select * from productos ")or die($conexion->error);
                ?>
                <h3><?php echo mysqli_num_rows($resultado2) ?></h3>

                <p>Productos en Venta</p>
              </div>
              <div class="icon">
                <i class="ion ion-grid"></i>
              </div>
              <a href="productos" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $resultado1 = $conexion->query("
                select * from usuarios order by nivel ASC")or die($conexion->error);
                ?>
                <h3><?php echo mysqli_num_rows($resultado1) ?></h3>
                <p>Usuarios Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="usuarios" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
        
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php
                $resultado2 = $conexion->query("
                select * from mensajes ")or die($conexion->error);
                ?>
                <h3><?php echo mysqli_num_rows($resultado2) ?></h3>

                <p>Mensajes Recibidos</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatbox"></i>
              </div>
              <a href="mensajes" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php
                $resultado2 = $conexion->query("
                select * from categorias ")or die($conexion->error);
                ?>
                <h3><?php echo mysqli_num_rows($resultado2) ?></h3>

                <p>Categorías Existentes</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list-outline"></i>
              </div>
              <a href="productos" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $resultado1 = $conexion->query("
                select * from tags")or die($conexion->error);
                ?>
                <h3><?php echo mysqli_num_rows($resultado1) ?></h3>
                <p>Etiquetas Creadas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetag"></i>
              </div>
              <a href="usuarios" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php
                $resultado2 = $conexion->query("
                select * from cupones where status='activo' ")or die($conexion->error);
                ?>
                <h3><?php echo mysqli_num_rows($resultado2) ?></h3>

                <p>Cupones Activos</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-remove-circle"></i>
              </div>
              <a href="mensajes" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
    } else { ?>
      <!-- aqui va el contenido de inicio para los clientes -->
      <h2 style="padding-left:.65em;color:#333;font-size:25px;">¡Hola! Bienvenido <?php echo $arregloUsuario['nombre']; ?></h2>
      <h2 class="home-h2" style="padding-left:1em;color:#555;font-size:17px;width:70%;line-height:26px;margin-top:1em;">En esta sección podrás conocer el estatus de tus pedidos en tiempo real y ver tu actividad en la plataforma como tus reseñas de nuestros productos.<br><br>¿Qué deseas hacer?</h2>
      <style>
        @media screen and (max-width:500px){
          .home-h2{
            width: 95% !important;
          }
        }
      </style>
      <div class="index-block">
      <div class="index-block-item">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Mis Pedidos</h3>

                <p>Checar Mis Pedidos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="mis-pedidos" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="index-block-item">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Mis Reseñas</h3>

                <p>Leer Mis Reseñas</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatbox"></i>
              </div>
              <a href="reseñas" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="index-block-item">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Mi Perfil</h3>

                <p>Modificar Mi Perfil</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="mi-perfil" class="small-box-footer">Ver Más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
      <?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
	
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./dist/js/pages/dashboard.js"></script>
</body>
</html>

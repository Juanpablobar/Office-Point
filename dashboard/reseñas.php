<?php
session_start();
include '../php/conexion.php';
include '../layouts/icons.php';
if(!isset($_SESSION['datos_login'])){
  header('Location: ../');
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'cliente'){
  header('Location: ./');
}
$resultado = $conexion->query("
select * from
comentarios where correo='".$arregloUsuario['correo']."'")or die($conexion->error);
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
    <link rel="stylesheet" href="../css/dashboard-reviews.css">
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
           <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color:#444">Mis Reseñas (
                <?php
                 if( mysqli_num_rows($resultado) > 0){
                     echo mysqli_num_rows($resultado);
                 } else{
                     echo '0';
                 }
                ?>
                )</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
        if(mysqli_num_rows($resultado) == 0){
            echo '
            <div class="sin-reseñas" style="width:100%;height:50vh;display:flex;justify-content:center;align-items:center;">
                <h1 style="color:#aaa;font-size:18px;line-height:30px;text-align:center">Las reseñas que hagas de tus productos favoritos aparecerán aquí</h1>
            </div>';
        }else{
            ?>
    <section class="content content-fluid">
    	<div class="content-fluid">
        <?php
            while ($f = mysqli_fetch_array($resultado)) {
                        ?>
                        <h6 style="margin-left:2%;color:#777;margin-bottom:-1em;">Ésta fue tu opinión respecto a 
                            <?php
                            	$resultado2 = $conexion ->query("SELECT * FROM productos INNER JOIN comentarios ON productos.id = comentarios.id_producto WHERE productos.id=".$f['id_producto'])
                                or die($conexion->error);
                                $f2 = mysqli_fetch_array($resultado2);
                                echo '<a href="../shop-single?id='.$f2[0].'" style="color:#000">'.$f2[1].'</a>';
                            ?>
                        </h6>
					<div class="single-description-reviews">
						<div class="single-description-img">
							<span><?php echo substr($f[1],0,1) ?></span>
						</div>
						<div class="single-description-text">
							<div class="single-descriptions-text-sub">
								<div class="single-descriptions-name">
								<h3><?php echo $f[1]; ?> - <?php echo $f[6].' de '.$f[7].' del '.$f[8] ?></h3>
								</div>
								<div class="single-descriptions-stars">
									<?php
										if($f[4] == 5){
											echo $star_fill_5;
										}elseif($f[4] == 4){
											echo $star_half8;
										}elseif($f[4] == 3){
											echo $star_half6;
										}elseif($f[4] == 2){
											echo $star_half4;
										}else{
											echo $star_half2;
										}
									?>
								</div>
							</div>
							<div class="single-descriptions-comment">
								<h3><?php echo $f[3] ?></h3>
							</div>
						</div>
					</div>
            <?php } ?>
    	</div>
    </section>
    <?php
        } ?>
    <!-- /.content -->
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

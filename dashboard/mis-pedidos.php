<?php
session_start();
include '../php/conexion.php';
include '../layouts/icons.php';
if(!isset($_SESSION['datos_login'])){
  header('Location: ../login.php');
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'cliente'){
  header('Location: ./');
}
$resultado = $conexion->query("
select * from
ventas where id_usuario='".$arregloUsuario['id']."' order by id_venta desc")or die($conexion->error)

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
    <link rel="stylesheet" href="../css/dashboard-pedidos.css">
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
            <h1 class="m-0" style="color:#444">Mis Pedidos (
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
                <h1 style="color:#aaa;font-size:18px;line-height:30px;text-align:center">Aquí se mostrarán todos los pedidos que hayas hecho con nosotros y el estatus de cada uno</h1>
            </div>';
        }else {
          while ($fila = mysqli_fetch_array($resultado)) {
            $resultado2 = $conexion->query("
            select * from
            direcciones_ventas where id_venta='".$fila[0]."'")or die($conexion->error);
            $fila2 = mysqli_fetch_array($resultado2);

            $resultado3 = $conexion->query("
            select * from
            productos_venta where id_venta='".$fila[0]."'")or die($conexion->error);
            ?>
            <div class='pedidos'>
            <?php
            $fecha = $fila[3];
            $fecha = explode(',',$fecha);
            $fecha = $fecha[0].','.$fecha[1];
            ?>
              <h3 class='fecha'>Fecha: <a><?php echo $fecha; ?></a></h3>
              <div class="ready" id="ready">
                    <div class="ready-first">
                        <h1>Datos de Compra</h1>
                    </div>
                    <div class="ready-cont ready-compra">
                        <h3>Identificador de Compra: <a>#<?php echo $fila[0]; ?></a></h3>                        
                        <h3 class='status'>Estatus de Compra: 
                        <?php
                          if($fila[4] == 'pendiente_envio'){
                            echo '<a>Envío en proceso</a>'; 
                          } else if($fila[4] == 'pendiente_pago'){
                            echo '<a>Pendiente de Pago</a><br><a style="font-size:12px;font-weight:500">Si ya has realizado tu pago y aún no se aprueba tu compra, puedes ponerte en contacto al siguiente número de <a style="color:#009DE1;font-size:12px;font-weight:500" href="https://wa.link/s61nrc">Whatsapp</a></a>';
                          } else {
                            echo '<a>Compra Finalizada</a>';
                          }
                        ?>
                        </h3>
                        <div class="ready-first">
                          <h1>Productos</h1>
                        </div>
                        <?php
                          while ($fila3 = mysqli_fetch_array($resultado3)) {
                            $resultado4 = $conexion->query("
                            select * from
                            productos where id='".$fila3[2]."'")or die($conexion->error);
                            $fila4 = mysqli_fetch_array($resultado4)
                        ?>
                        <div class='ready-products'>
                              <h3>Nombre: <a><?php echo $fila4[1] ?></a></h3>
                              <h3>Cantidad: <a><?php echo $fila3[3] ?></a></h3>
                              <h3>Costo: <a>$<?php echo $fila3[5] ?>.00</a></h3>
                        </div>
                        <?php
                          } ?>
                        <h3>Total: <a>$<?php echo $fila[2]; ?>.00</a><br><a style='font-size:12px'>Incluyendo envío, descuentos y cupones</a></h3>
                    </div>
                    <div class="ready-first">
                        <h1>Datos de Envío</h1>
                    </div>
                    <div class="ready-cont">
                        <h3>A nombre de: <a><?php echo $fila2[3].' '.$fila2[4]; ?></a></h3>
                        <h3>Con dirección: <a><?php echo $fila2[6].', '.$fila2[7].' '.$fila2[10].', '.$fila2[8].', '.$fila2[9].', '.$fila2[5] ?></a></h3>
                        <h3>Datos de contacto: <a><?php echo $fila2[11].', '.$fila2[12]; ?></a></h3>
                        <?php
                        if($fila2[13] === ''){
                          echo '';
                        } else {
                        ?>
                        <h3>Notas: <a><?php echo $fila2[13]; ?></a></h3>
                        <?php } ?>
                    </div>
              </div>
            </div>
    <?php
        } } ?>
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

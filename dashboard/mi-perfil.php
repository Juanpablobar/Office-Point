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
direcciones_usuarios where id_usuario='".$arregloUsuario["id"]."'")or die($conexion->error);
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
    <link rel="stylesheet" href="../css/dashboard-perfil.css">
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
            <h1 class="m-0" style="color:#444">Mi Perfil</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
        if(mysqli_num_rows($resultado) == 0){
    ?>   
    <div class="añadir" id="añadir">
            <h2><i class="fa fa-plus"></i> Añadir Dirección</h2>
            <h3>Esta se tomará en cuenta automáticamente cuando realices pedidos</h3>
    </div>
    <div class="direccion" id="direccion">
        <h1>Datos de Envío</h1>
        <form action="../php/insertarDireccion.php" method="post">
            <div class="direccion-item">
                <h2>Nombre<a>*</a></h2>
                <input type="text" name="first-name" placeholder="Nombres" required>
            </div>
            <div class="direccion-item">
                <h2>Apellidos<a>*</a></h2>
                <input type="text" name="last-name" placeholder="Apellidos" required>
            </div>
            <div class="direccion-item">
                <h2>País<a>*</a></h2>
                <input type="text" name="country" placeholder="País" required>
            </div>
            <div class="direccion-item">
                <h2>Ciudad<a>*</a></h2>
                <input type="text" name="city" placeholder="Ciudad" required>
            </div>
            <div class="direccion-item">
                <h2>Dirección<a>*</a></h2>
                <input type="text" name="address1" placeholder="Calle" required>
                <input type="text" name="address2" placeholder="Apartamento, unidad, etc (opcional)">
            </div>
            <div class="direccion-item">
                <h2>Estado<a>*</a></h2>
                <input type="text" name="state" placeholder="Estado" required>
            </div>
            <div class="direccion-item">
                <h2>Código Postal<a>*</a></h2>
                <input type="text" name="zip" placeholder="Código Postal" required>
            </div>
            <div class="direccion-item">
                <h2>Teléfono<a>*</a></h2>
                <input type="text" name="phone" placeholder="Teléfono" required>
            </div>
            <div class="direccion-item">
                <h2>Correo Electrónico<a>*</a></h2>
                <input type="text" name="email" placeholder="Correo Electrónico" value="<?php echo $arregloUsuario['correo'];  ?>"  readonly>
                <input type="hidden" name="id" value="<?php echo $arregloUsuario['id'];  ?>">
            </div>
            <div class="direccion-button">
                <button type="submit">Agregar Dirección</button>
            </div>
        </form>
    </div>
    <?php
        }else{
            ?>
       <div class="ready" id="ready">
            <div class="ready-first">
                <h1>Datos de Envío</h1>
                <h2 id="editar"><i class="fa fa-edit"></i> Editar</h2>
            </div>
            <?php
            $fila = mysqli_fetch_array($resultado);
            ?>
            <div class="ready-cont">
                <h3>A nombre de: <a><?php echo $fila[1].' '.$fila[2]; ?></a></h3>
                <h3>Con dirección: <a><?php echo $fila[4].', '.$fila[5].' '.$fila[8].', '.$fila[6].', '.$fila[7].', '.$fila[3] ?></a></h3>
                <h3>Datos de contacto: <a><?php echo $fila[9].', '.$fila[10]; ?></a></h3>
                <form class="ready-eliminar" action="../php/eliminarDireccion.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $arregloUsuario['id'] ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </div>
       </div>
       <div class="direccion" id="direccion_ready">
        <h1>Datos de Envío</h1>
        <form action="../php/insertarDireccion.php" method="post">
            <div class="direccion-item">
                <h2>Nombre<a>*</a></h2>
                <input type="text" name="first-name" value="<?php echo $fila[1]; ?>" placeholder="Nombres" required>
            </div>
            <div class="direccion-item">
                <h2>Apellidos<a>*</a></h2>
                <input type="text" name="last-name" value="<?php echo $fila[2]; ?>" placeholder="Apellidos" required>
            </div>
            <div class="direccion-item">
                <h2>País<a>*</a></h2>
                <input type="text" name="country" placeholder="País" value="<?php echo $fila[3]; ?>" required>
            </div>
            <div class="direccion-item">
                <h2>Ciudad<a>*</a></h2>
                <input type="text" name="city" placeholder="Ciudad" value="<?php echo $fila[6]; ?>" required>
            </div>
            <div class="direccion-item">
                <h2>Dirección<a>*</a></h2>
                <input type="text" name="address1" placeholder="Calle" value="<?php echo $fila[4]; ?>" required>
                <input type="text" name="address2" placeholder="Apartamento, unidad, etc (opcional)" value="<?php echo $fila[5]; ?>">
            </div>
            <div class="direccion-item">
                <h2>Estado<a>*</a></h2>
                <input type="text" name="state" placeholder="Estado" value="<?php echo $fila[7]; ?>" required>
            </div>
            <div class="direccion-item">
                <h2>Código Postal<a>*</a></h2>
                <input type="text" name="zip" placeholder="Código Postal" value="<?php echo $fila[8]; ?>" required>
            </div>
            <div class="direccion-item">
                <h2>Teléfono<a>*</a></h2>
                <input type="text" name="phone" placeholder="Teléfono" value="<?php echo $fila[9]; ?>" required>
            </div>
            <div class="direccion-item">
                <h2>Correo Electrónico<a>*</a></h2>
                <input type="text" name="email" placeholder="Correo Electrónico" value="<?php echo $arregloUsuario['correo'];  ?>"  readonly>
                <input type="hidden" name="id" value="<?php echo $arregloUsuario['id'];  ?>">
            </div>
            <div class="direccion-button">
                <button type="submit">Editar Dirección</button>
            </div>
        </form>
    </div>

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
<script>
    $(document).ready(function(){
        $("#direccion").hide();
        $("#añadir").click(function(){
            $("#añadir").hide();
            $("#direccion").show();
        })
        $("#editar").click(function(){
            $("#ready").hide();
            $("#direccion_ready").show();
        })
    })
</script>
</body>
</html>

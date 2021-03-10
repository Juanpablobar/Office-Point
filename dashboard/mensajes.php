<?php
session_start();
include '../php/conexion.php';
include '../layouts/icons.php';
if(!isset($_SESSION['datos_login'])){
  header('Location: ../login.php');
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'admin'){
  header('Location: ./');
}
$resultado = $conexion->query("
select * from
mensajes order by id desc")or die($conexion->error);
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
           <div class="row mb-2">
          <div class="col-sm-6 messages_inner">
            <h1 class="m-0 messages_h1" style="color: #444;padding-top:.5em">Mensajes
                <?php
                $resultado2 = $conexion->query("
                select * from
                mensajes where status='pendiente'")or die($conexion->error);
                $fila2 = mysqli_num_rows($resultado2);
                if ($fila2 > 0) {
                    echo "(".$fila2.")";
                }else{
                    echo '(0)';
                }
                ?>
        </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="messages">
        <?php
        while($fila = mysqli_fetch_array($resultado)){
        ?>
          <div id="accordion">
            <div style="position:relative" class="card 
            <?php
            if($fila[7] == 'pendiente'){
              echo 'card-link';
            }
            ?>
            ">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                
                  <button class="btn 
                  <?php
                  if($fila[7] == 'pendiente'){
                    echo "btn-link";
                  }else{
                    echo 'btn-other';
                  }
                   ?>" data-id="<?php echo $fila[0]; ?>" data-toggle="collapse" data-target="#collapse<?php echo $fila[0]; ?>" aria-expanded="true" aria-controls="collapseOne">
                    <?php
                    if($fila[8] == 'contact-form'){
                      echo '<a>Tienes un nuevo mensaje desde el formulario de contacto</a>';
                      echo '<a>'.$fila[4].' de '.$fila[5].' del '.$fila[6].'</a>';
                    } elseif ($fila[8] == 'footer-form'){
                      echo '<a>Un usuario ha registrado su correo electrónico</a>';
                      echo '<a>'.$fila[4].' de '.$fila[5].' del '.$fila[6].'</a>';
                    }else{
                      echo '<a>Un usuario ha registrado su correo electrónico</a>';
                      echo '<a>'.$fila[4].' de '.$fila[5].' del '.$fila[6].'</a>';
                    }
                    ?>

                  </button>
                </h5>
              </div>            
              <a title="Eliminar Mensaje" style="font-size:10px;outline:none;border:none;" class="btnEliminar" data-id="<?php echo $fila[0] ?>" data-toggle="modal" data-target="#modalEliminar">Eliminar
              </a>
              <div id="collapse<?php echo $fila[0]; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <?php
                  if($fila[8] == 'contact-form'){
                    echo 'Un usuario ha rellenado el formulario de contacto con los siguientes datos:<br><br>';
                    echo '<a style="font-weight:bold">Nombre:</a><br>';
                    echo $fila[1] ;                    
                    echo '<br><br><a style="font-weight:bold">Correo electrónico:</a><br>';
                    echo $fila[2] ;
                    echo '<br><br><a style="font-weight:bold">Mensaje:</a><br>';
                    echo $fila[3].'<br>';
                  } elseif ($fila[8] == 'footer-form'){
                    echo 'Un usuario ha registrado su correo electrónico desde el campo de texto del pie de página:' ;
                    echo '<br><br><a style="font-weight:bold">Correo electrónico:</a><br>';
                    echo $fila[2] ;
                  }else{
                    echo 'Un usuario ha registrado su correo electrónico desde el campo de texto del anuncio emergente:' ;
                    echo '<br><br><a style="font-weight:bold">Correo electrónico:</a><br>';
                    echo $fila[2] ;
                  }
                  ?>
                </div>
              </div>
            </div>
            </div>
            <?php } ?>
          </div>
    </div>
</div>
<style>
  .btn-other{
    color: #555 !important;
  }
  .card-link{
    border-left: 5px solid #1873BE;
  }
  .card button{
    display: flex !important;
    justify-content: space-between !important;
    width: 100% !important;
  }
  .card button a{
    display: block !important;
  }
  .btnEliminar{
    width: auto !important;
    padding: 0 1em 0 1em !important;
    display: block !important;
    position: absolute !important;
    right: 0 !important;
    text-align: center !important;
    background: white !important;
    color: #DC3545 !important;
    font-weight: 800;
    cursor:pointer;
    bottom: .5em !important;
  }
</style>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- Modal eliminar -->
 <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar el mensaje?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" data-dismiss="modal" class="btn btn-danger eliminar">Eliminar</button>
      </div>
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
		var idCambiar = -1;
		var fila;
		$(".card").click(function(){
		idCambiar = $(this).find('button:first').data('id');
		fila=$(this).find('button:first');
		fila_card=$(this);
	});		
		$(".card").click(function(){
			$.ajax({
				url: '../php/editarMensaje.php',
				method: 'POST',
				data:{
					id:idCambiar
				}
			}).done(function(res){
				$(fila).removeClass('btn-link');
				$(fila_card).removeClass('card-link');
				$('.messages_h1').remove();
				$('.messages_inner').append(res);
			});
		});
    $(".btnEliminar").click(function(){
		idEliminar = $(this).data('id');
		filaEliminar=$(this).parent('div').parent('div');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '../php/eliminarMensaje.php',
				method: 'POST',
				data:{
					id:idEliminar
				}
			}).done(function(res){
				$(filaEliminar).fadeOut(1000);
			});
		});

	});
	</script>
</body>
</html>

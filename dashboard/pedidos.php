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
ventas where status='pendiente_envio' order by id_venta desc")or die($conexion->error);

$resultado5 = $conexion->query("
select * from
ventas where status='pendiente_envio' and visto='false' order by id_venta desc")or die($conexion->error);
$fila5 = mysqli_num_rows($resultado5);

$resultado3 = $conexion->query("
select * from
ventas where status='finalizada' order by id_venta desc")or die($conexion->error);

$resultado6 = $conexion->query("
select * from
ventas where status='finalizada' and visto='false' order by id_venta desc")or die($conexion->error);
$fila6 = mysqli_num_rows($resultado6);


$resultado4 = $conexion->query("
select * from
ventas where status='pendiente_pago' order by id_venta desc")or die($conexion->error);

$resultado7 = $conexion->query("
select * from
ventas where status='pendiente_pago' and visto='false' order by id_venta desc")or die($conexion->error);
$fila7 = mysqli_num_rows($resultado7);


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
    <link rel="stylesheet" href="../css/dashboard-adminPedidos.css">
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
            <h1 class="m-0 messages_h1" style="color: #444;padding-top:.5em">Pedidos</h1>
            <h3 class="" style="color: #444;padding-top:.5em;font-size:16px">Existen tres Estatus para los pedidos, <strong>Pago Pendiente</strong>, <strong>Envío Pendientes</strong> y <strong>Compra Finalizada</strong>. Esta sección está dividida en estas tres categorías, además se puede modificar el estatus de cada una según el proceso del pedido vaya cambiando.</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="messages">
          <div id="accordion3">
            <div style="position:relative" class="card card-parent
            ">
              <div class="card-header" id="headingThree" style='background:#e9e9e9'>
                <h5 class="mb-0">
                
                  <button class="btn btnSpan" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  Pedidos Pendientes de Pago <span style="background:#009DE1;color:white;border-radius:100%;height:20px;width:20px;font-size:14px">
                  <?php
                    if($fila7 > 0){
                      echo $fila7;
                    } else {
                      echo '0';
                    }
                  ?>
                  </span>
                  </button>
                </h5>
              </div>            
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion3">
              <div class="card-body">
                <?php
                  while($fila4 = mysqli_fetch_array($resultado4)){
                      ?>
                      <div class="messages">
                        <div id="accordion<?php echo 'envio'.$fila4[0]; ?>">
                          <div style="position:relative" class="card card-visto 
                          ">
                            <div class="card-header" id="heading<?php echo 'envio'.$fila4[0]; ?>"
                            <?php
                            if($fila4[5] == 'false'){
                              echo "style='background:#f3f3f3'";
                            } else {
                              echo '';
                            }
                            ?>
                            >
                              <h5 class="mb-0">
                              
                                <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo 'envio'.$fila4[0]; ?>" aria-expanded="true" aria-controls="collapse<?php echo 'envio'.$fila4[0]; ?>">
                                <?php
                                $resultado8 = $conexion->query("
                                select * from
                                direcciones_ventas where id_venta=".$fila4[0])or die($conexion->error);
                                $fila8 = mysqli_fetch_array($resultado8);
                                $fecha = $fila4[3];
                                $fecha = explode(',',$fecha);
                                $fecha = $fecha[0].','.$fecha[1];
                                echo $fecha.", ".$fila8[3]." ".$fila8[4]."&nbsp;&nbsp;&nbsp;&nbsp;Total: $".$fila4[2].".00";
                                ?>
                                <?php
                                if($fila4[5] == 'false'){
                                  echo '<span style="color:#fff;background:#009DE1;padding: 2px 5px;font-size:14px">Nuevo</span>';
                                } else {
                                  echo '';
                                }
                                ?>
                                </button>
                              </h5>
                            </div>            
                            <a title="Eliminar Pedido" style="font-size:10px;outline:none;border:none;background-color:transparent !important" class="btnEliminar" data-id="<?php echo $fila4[0] ?>" data-toggle="modal" data-target="#modalEliminar">Eliminar
                            </a>
                            <div id="collapse<?php echo 'envio'.$fila4[0]; ?>" class="collapse" aria-labelledby="heading<?php echo 'envio'.$fila4[0]; ?>" data-parent="#accordion<?php echo 'envio'.$fila4[0]; ?>">
                              <div class="card-body">
                              <div class='pedidos'>
                                  <h3 class='fecha'>Fecha: <a><?php echo $fecha; ?></a></h3>
                                  <div class="ready" id="ready">
                                        <div class="ready-first">
                                            <h1>Datos de Compra</h1>
                                        </div>
                                        <div class="ready-cont ready-compra">
                                            <h3>Identificador de Compra: <a>#<?php echo $fila4[0]; ?></a></h3>                        
                                            <h3 class='status'>Estatus de Compra: 
                                            <a style='display:flex'>Pendiente de Pago
                                            <button title='Editar Estatus de Compra' style='width:25px !important;height:25px !important;display:flex !important;align-items:center !important;justify-content:center !important;font-size:12px !important;margin-left: 1em' data-texto='<?php echo $fila4[4] ?>' data-id='<?php echo $fila4[0]; ?>' type="button" class="btn btnEditar btnVisto btn-primary" data-target="#modalEditar2" data-toggle="modal"><i class='fa fa-edit'></i></button>
                                            </a>
                                            </h3>
                                            <div class="ready-first">
                                              <h1>Productos</h1>
                                            </div>
                                            <?php
                                              $resultado9 = $conexion->query("
                                              select * from
                                              productos_venta where id_venta=".$fila4[0])or die($conexion->error);
                                              while ($fila9 = mysqli_fetch_array($resultado9)) {
                                                $resultado10 = $conexion->query("
                                                select * from
                                                productos where id='".$fila9[2]."'")or die($conexion->error);
                                                $fila10 = mysqli_fetch_array($resultado10)
                                            ?>
                                            <div class='ready-products'>
                                                  <h3>Nombre: <a><?php echo $fila10[1] ?></a></h3>
                                                  <h3>Cantidad: <a><?php echo $fila9[3] ?></a></h3>
                                                  <h3>Costo: <a>$<?php echo $fila9[5] ?>.00</a></h3>
                                            </div>
                                            <?php
                                              } ?>
                                            <h3>Total: <a>$<?php echo $fila4[2]; ?>.00</a><br><a style='font-size:12px'>Incluyendo envío, descuentos y cupones</a></h3>
                                        </div>
                                        <div class="ready-first">
                                            <h1>Datos de Envío</h1>
                                        </div>
                                        <div class="ready-cont">
                                            <h3>A nombre de: <a><?php echo $fila8[3].' '.$fila8[4]; ?></a></h3>
                                            <h3>Con dirección: <a><?php echo $fila8[6].', '.$fila8[7].' '.$fila8[10].', '.$fila8[8].', '.$fila8[9].', '.$fila8[5] ?></a></h3>
                                            <h3>Datos de contacto: <a><?php echo $fila8[11].', '.$fila8[12]; ?></a></h3>
                                            <?php
                                            if($fila8[13] === ''){
                                              echo '';
                                            } else {
                                            ?>
                                            <h3>Notas: <a><?php echo $fila8[13]; ?></a></h3>
                                            <?php } ?>
                                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                <?php
                  } ?>
                </div>
              </div>
            </div>
            </div>
          </div>
    <div class="messages">
          <div id="accordion">
            <div style="position:relative" class="card card-parent
            ">
              <div class="card-header" id="headingOne" style='background:#f3f3f3'>
                <h5 class="mb-0">
                
                  <button class="btn btnSpan" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseOne">
                  Pedidos Pendientes de Envío <span style="background:#009DE1;color:white;border-radius:100%;height:20px;width:20px;font-size:14px">
                  <?php
                    if($fila5 > 0){
                      echo $fila5;
                    } else {
                      echo '0';
                    }
                  ?>
                  </span>
                  </button>
                </h5>
              </div>            
              <div id="collapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                <?php
                  while($fila = mysqli_fetch_array($resultado)){
                      ?>
                      <div class="messages">
                        <div id="accordion<?php echo 'envio'.$fila[0]; ?>">
                          <div style="position:relative" class="card card-visto 
                          ">
                            <div class="card-header" id="heading<?php echo 'envio'.$fila[0]; ?>"
                            <?php
                            if($fila[5] == 'false'){
                              echo "style='background:#f3f3f3'";
                            } else {
                              echo '';
                            }
                            ?>
                            >
                              <h5 class="mb-0">
                              
                                <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo 'envio'.$fila[0]; ?>" aria-expanded="true" aria-controls="collapse<?php echo 'envio'.$fila[0]; ?>">
                                <?php
                                $resultado8 = $conexion->query("
                                select * from
                                direcciones_ventas where id_venta=".$fila[0])or die($conexion->error);
                                $fila8 = mysqli_fetch_array($resultado8);
                                $fecha = $fila[3];
                                $fecha = explode(',',$fecha);
                                $fecha = $fecha[0].','.$fecha[1];
                                echo $fecha.", ".$fila8[3]." ".$fila8[4]."&nbsp;&nbsp;&nbsp;&nbsp;Total: $".$fila[2].".00";
                                ?>
                                <?php
                                if($fila[5] == 'false'){
                                  echo '<span style="color:#fff;background:#009DE1;padding: 2px 5px;font-size:14px">Nuevo</span>';
                                } else {
                                  echo '';
                                }
                                ?>
                                </button>
                              </h5>
                            </div>            
                            <a title="Eliminar Pedido" style="font-size:10px;outline:none;border:none;background-color:transparent !important" class="btnEliminar" data-id="<?php echo $fila[0] ?>" data-toggle="modal" data-target="#modalEliminar">Eliminar
                            </a>
                            <div id="collapse<?php echo 'envio'.$fila[0]; ?>" class="collapse" aria-labelledby="heading<?php echo 'envio'.$fila[0]; ?>" data-parent="#accordion<?php echo 'envio'.$fila[0]; ?>">
                              <div class="card-body">
                              <div class='pedidos'>
                                  <h3 class='fecha'>Fecha: <a><?php echo $fecha; ?></a></h3>
                                  <div class="ready" id="ready">
                                        <div class="ready-first">
                                            <h1>Datos de Compra</h1>
                                        </div>
                                        <div class="ready-cont ready-compra">
                                            <h3>Identificador de Compra: <a>#<?php echo $fila[0]; ?></a></h3>                        
                                            <h3 class='status'>Estatus de Compra: 
                                            <a style='display:flex'>Envío en Proceso 
                                            <button title='Editar Estatus de Compra' style='width:25px !important;height:25px !important;display:flex !important;align-items:center !important;justify-content:center !important;font-size:12px !important;margin-left: 1em' data-texto='<?php echo $fila[4] ?>' data-id='<?php echo $fila[0]; ?>' type="button" class="btn btnEditar btnVisto btn-primary" data-target="#modalEditar" data-toggle="modal"><i class='fa fa-edit'></i></button>
                                            </a>
                                            </h3>
                                            <div class="ready-first">
                                              <h1>Productos</h1>
                                            </div>
                                            <?php
                                              $resultado9 = $conexion->query("
                                              select * from
                                              productos_venta where id_venta=".$fila[0])or die($conexion->error);
                                              while ($fila9 = mysqli_fetch_array($resultado9)) {
                                                $resultado10 = $conexion->query("
                                                select * from
                                                productos where id='".$fila9[2]."'")or die($conexion->error);
                                                $fila10 = mysqli_fetch_array($resultado10)
                                            ?>
                                            <div class='ready-products'>
                                                  <h3>Nombre: <a><?php echo $fila10[1] ?></a></h3>
                                                  <h3>Cantidad: <a><?php echo $fila9[3] ?></a></h3>
                                                  <h3>Costo: <a>$<?php echo $fila9[5] ?>.00</a></h3>
                                            </div>
                                            <?php
                                              } ?>
                                            <h3>Total: <a>$<?php echo $fila[2]; ?>.00</a><br><a style='font-size:12px'>Incluyendo envío, descuentos y cupones</a></h3>
                                        </div>
                                        <div class="ready-first">
                                            <h1>Datos de Envío</h1>
                                        </div>
                                        <div class="ready-cont">
                                            <h3>A nombre de: <a><?php echo $fila8[3].' '.$fila8[4]; ?></a></h3>
                                            <h3>Con dirección: <a><?php echo $fila8[6].', '.$fila8[7].' '.$fila8[10].', '.$fila8[8].', '.$fila8[9].', '.$fila8[5] ?></a></h3>
                                            <h3>Datos de contacto: <a><?php echo $fila8[11].', '.$fila8[12]; ?></a></h3>
                                            <?php
                                            if($fila8[13] === ''){
                                              echo '';
                                            } else {
                                            ?>
                                            <h3>Notas: <a><?php echo $fila8[13]; ?></a></h3>
                                            <?php } ?>
                                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                <?php
                  } ?>
                </div>
              </div>
            </div>
            </div>
          </div>
    <div class="messages">
          <div id="accordion2">
            <div style="position:relative" class="card card-parent
            ">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                
                  <button class="btn btnSpan" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Pedidos Finalizados <span style="background:#009DE1;color:white;border-radius:100%;height:20px;width:20px;font-size:14px">
                  <?php
                    if($fila6 > 0){
                      echo $fila6;
                    } else {
                      echo '0';
                    }
                  ?>
                  </span>
                  </button>
                </h5>
              </div>            
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
              <div class="card-body">
                <?php
                  while($fila3 = mysqli_fetch_array($resultado3)){
                      ?>
                      <div class="messages">
                        <div id="accordion<?php echo 'envio'.$fila3[0]; ?>">
                          <div style="position:relative" class="card card-visto 
                          ">
                            <div class="card-header" id="heading<?php echo 'envio'.$fila3[0]; ?>"
                            <?php
                            if($fila3[5] == 'false'){
                              echo "style='background:#f3f3f3'";
                            } else {
                              echo '';
                            }
                            ?>
                            >
                              <h5 class="mb-0">
                              
                                <button class="btn" data-toggle="collapse" data-target="#collapse<?php echo 'envio'.$fila3[0]; ?>" aria-expanded="true" aria-controls="collapse<?php echo 'envio'.$fila3[0]; ?>">
                                <?php
                                $resultado8 = $conexion->query("
                                select * from
                                direcciones_ventas where id_venta=".$fila3[0])or die($conexion->error);
                                $fila8 = mysqli_fetch_array($resultado8);
                                $fecha = $fila3[3];
                                $fecha = explode(',',$fecha);
                                $fecha = $fecha[0].','.$fecha[1];
                                echo $fecha.", ".$fila8[3]." ".$fila8[4]."&nbsp;&nbsp;&nbsp;&nbsp;Total: $".$fila3[2].".00";
                                ?>
                                <?php
                                if($fila3[5] == 'false'){
                                  echo '<span style="color:#fff;background:#009DE1;padding: 2px 5px;font-size:14px">Nuevo</span>';
                                } else {
                                  echo '';
                                }
                                ?>
                                </button>
                              </h5>
                            </div>            
                            <a title="Eliminar Pedido" style="font-size:10px;outline:none;border:none;background-color:transparent !important" class="btnEliminar" data-id="<?php echo $fila3[0] ?>" data-toggle="modal" data-target="#modalEliminar">Eliminar
                            </a>
                            <div id="collapse<?php echo 'envio'.$fila3[0]; ?>" class="collapse" aria-labelledby="heading<?php echo 'envio'.$fila3[0]; ?>" data-parent="#accordion<?php echo 'envio'.$fila3[0]; ?>">
                              <div class="card-body">
                              <div class='pedidos'>
                                  <h3 class='fecha'>Fecha: <a><?php echo $fecha; ?></a></h3>
                                  <div class="ready" id="ready">
                                        <div class="ready-first">
                                            <h1>Datos de Compra</h1>
                                        </div>
                                        <div class="ready-cont ready-compra">
                                            <h3>Identificador de Compra: <a>#<?php echo $fila3[0]; ?></a></h3>                        
                                            <h3 class='status'>Estatus de Compra: 
                                            <a style='display:flex'>Pedido Finalizado 
                                            <button title='Editar Estatus de Compra' style='width:25px !important;height:25px !important;display:flex !important;align-items:center !important;justify-content:center !important;font-size:12px !important;margin-left: 1em' data-texto='<?php echo $fila3[4] ?>' data-id='<?php echo $fila3[0]; ?>' type="button" class="btn btnEditar btnVisto btn-primary" data-target="#modalEditar" data-toggle="modal"><i class='fa fa-edit'></i></button>
                                            </a>
                                            </h3>
                                            <div class="ready-first">
                                              <h1>Productos</h1>
                                            </div>
                                            <?php
                                              $resultado9 = $conexion->query("
                                              select * from
                                              productos_venta where id_venta=".$fila3[0])or die($conexion->error);
                                              while ($fila9 = mysqli_fetch_array($resultado9)) {
                                                $resultado10 = $conexion->query("
                                                select * from
                                                productos where id='".$fila9[2]."'")or die($conexion->error);
                                                $fila10 = mysqli_fetch_array($resultado10)
                                            ?>
                                            <div class='ready-products'>
                                                  <h3>Nombre: <a><?php echo $fila10[1] ?></a></h3>
                                                  <h3>Cantidad: <a><?php echo $fila9[3] ?></a></h3>
                                                  <h3>Costo: <a>$<?php echo $fila9[5] ?>.00</a></h3>
                                            </div>
                                            <?php
                                              } ?>
                                            <h3>Total: <a>$<?php echo $fila3[2]; ?>.00</a><br><a style='font-size:12px'>Incluyendo envío, descuentos y cupones</a></h3>
                                        </div>
                                        <div class="ready-first">
                                            <h1>Datos de Envío</h1>
                                        </div>
                                        <div class="ready-cont">
                                            <h3>A nombre de: <a><?php echo $fila8[3].' '.$fila8[4]; ?></a></h3>
                                            <h3>Con dirección: <a><?php echo $fila8[6].', '.$fila8[7].' '.$fila8[10].', '.$fila8[8].', '.$fila8[9].', '.$fila8[5] ?></a></h3>
                                            <h3>Datos de contacto: <a><?php echo $fila8[11].', '.$fila8[12]; ?></a></h3>
                                            <?php
                                            if($fila8[13] === ''){
                                              echo '';
                                            } else {
                                            ?>
                                            <h3>Notas: <a><?php echo $fila8[13]; ?></a></h3>
                                            <?php } ?>
                                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                <?php
                  } ?>
                </div>
              </div>
            </div>
            </div>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar el Pedido?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" data-dismiss="modal" class="btn btn-danger eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarPedido.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Estatus de Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit" name="id">
      <div class="form-group">
      <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Cambia el estatus de la compra para que este actualizado, si el pago ya se realizó cámbialo a 'Pendiente de Envío' y si el envío ya se entrego cámbialo a 'Compra Finalizada'</h6>
        <select class='form-control' id='editarEdit' name='editar' required>
          <option value='pendiente_pago'>Pendiente de Pago</option>
          <option value='pendiente_envio'>Envío en Proceso</option>
          <option value='finalizada'>Compra Finalizada</option>
        </select>
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
     <form action="../php/editarPedido2.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar2">Editar Estatus de Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit2" name="id">
      <div class="form-group">
      <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Cambia el estatus de la compra para que este actualizado, si el pago ya se realizó cámbialo a 'Pendiente de Envío' y si el envío ya se entrego cámbialo a 'Compra Finalizada'</h6>
        <select class='form-control' id='editarEdit2' name='editar' required>
          <option value='pendiente_pago'>Pendiente de Pago</option>
          <option value='pendiente_envio'>Envío en Proceso</option>
          <option value='finalizada'>Compra Finalizada</option>
        </select>
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
    $(".btnEliminar").click(function(){
		idEliminar = $(this).data('id');
		filaEliminar=$(this).parent('div').parent('div').parent('div');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '../php/eliminarPedido.php',
				method: 'POST',
				data:{
					id:idEliminar
				}
			}).done(function(res){
				$(filaEliminar).fadeOut(1000);
			});
		});
    $(".card-visto").click(function(){
      let idCambiar = $(this).find('.btnVisto').data('id');
      let idTexto = $(this).find('.btnVisto').data('texto');
      let fila = $(this).find('.card-header');
      let span = $(this).find('button').find('span')
      let parent = $(this).parent('div').parent('div').parent('div').parent('div').parent('div').find('.btnSpan')
			$.ajax({
				url: '../php/vistoPedido.php',
				method: 'POST',
				data:{
					id:idCambiar,
          texto: idTexto
				}
			}).done(function(res){
				$(fila).css('background-color','white');
				$(span).remove()
        $(parent).find('span').remove()
        $(parent).append(res)
				// $(fila_card).removeClass('card-link');
				// $('.messages_h1').remove();
				// $('.messages_inner').append(res);
			});
		});

		$('.btnEditar').click(function(){
			var id=$(this).data('id');
			var edit=$(this).data('texto');
			$('#editarEdit').val(edit);
			$('#editarEdit2').val(edit);
			$('#idEdit').val(id);
			$('#idEdit2').val(id);
			$('#idEdit2').val(id);
		});

	});
	</script>
</body>
</html>

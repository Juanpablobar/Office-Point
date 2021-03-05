<?php
include '../php/conexion.php';
?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background:#814090">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:white"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index" style="color:white" class="nav-link">Casa</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../categories" style="color:white" class="nav-link">Categorías</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../shop" style="color:white" class="nav-link">Tienda</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../about-us" style="color:white" class="nav-link">Nosotros</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../contact" style="color:white" class="nav-link">Contacto</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" style="color:white" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="background:#814090">
    <!-- Brand Logo -->
    <a class="brand-link" style="background: white;">
      <img src="../../img/logo.png" alt="Office Point Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text" style="color:#333">Office Point</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <span style="text-transform:uppercase;display:flex;justify-content:center;align-items:center;background:#FFF;border-radius:10em;height:35px;width:35px;color:#666;font-size:18px;font-weight:500;"><?php echo substr($arregloUsuario['nombre'],0,1) ?></span>
        </div>
        <div class="info">
          <a class="d-block" style="text-transform:capitalize;color:white"><?php echo $arregloUsuario['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <style>
        .mt-2 .nav-pills a:hover{
          background: #8E549B !important
        }
      </style>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if(($arregloUsuario['nivel'] == 'admin')){ ?>
            <li class="nav-item">
            <a href="./" class="nav-link" style="color:white">
              <i class="fas fa-chart-pie"></i>
              <p>
                 Página Principal
              </p>
            </a>
          </li>
          <li class="nav-item" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <a class="nav-link" style="color:white;background:#814090;cursor:pointer">
              <i class="fa fa-cog"></i>
                <p >
                Administrar Contenido
                </p>
              <div class="collapse" id="collapseExample">
                <div>
                  <a href="home" style="display:block;padding:.5em;border-radius:.35em;margin-top:-2em;padding-left:1.5em;color:white"><i class="fa fa-home"></i> Inicio</a>
                  <a href="contact" style="display:block;padding:.5em;border-radius:.35em;padding-left:1.5em;color:white"><i class="fa fa-headset"></i> Contacto</a>
                  <a href="about-us" style="display:block;padding:.5em;border-radius:.35em;padding-left:1.5em;color:white"><i class="fa fa-users"></i> Sobre Nosotros</a>
                  <a href="edit-footer" style="display:block;padding:.5em;border-radius:.35em;padding-left:1.5em;color:white"><i class="fa fa-shoe-prints"></i> Pie de Página</a>
                  <a href="popup" style="display:block;padding:.5em;border-radius:.35em;padding-left:1.5em;margin-bottom:1em;color:white"><i class="fa fa-bullhorn"></i> Anuncio Emergente</a>
                </div>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a href="pedidos" class="nav-link" style="color:white">
              <i class="fas fa-money-check-alt"></i>
              <p>
                 Pedidos
              </p>
            </a>
          </li>
          <li class="nav-item nav-span">
            <a href="mensajes" class="nav-link" style="color:white">
              <i class="fas fa-envelope"></i>
              <p>
                 Mensajes <span>
                   <?php
                   $resultado2 = $conexion->query("
                   select * from
                   mensajes where status='pendiente'")or die($conexion->error);
                   $fila2 = mysqli_num_rows($resultado2);
                   if ($fila2 > 0) {
                       echo $fila2;
                   }else{
                       echo '0';
                   }
                   ?>
                 </span>
                 <style>
                   .nav-span p{
                     position: relative;
                   }
                   .nav-span span{
                     width: 15px !important;
                     height: 15px !important;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     position: absolute;
                     top:0;
                     right: -1.5em;
                     background: white;
                     font-size: 13px;
                     color: #333;
                     border-radius: 10em;
                   }
                   </style>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="productos" class="nav-link" style="color:white">
              <i class="fas fa-cart-arrow-down"></i>
              <p>
                 Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categories" class="nav-link" style="color:white">
              <i class="fas fa-list"></i>
              <p>
                 Categorías
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tags" class="nav-link" style="color:white">
              <i class="fas fa-tag"></i>
              <p>
                 Tags/Etiquetas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cupones" class="nav-link" style="color:white">
              <i class="fas fa-ticket-alt"></i>
              <p>
                 Cupones
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usuarios" class="nav-link" style="color:white">
              <i class="fas fa-users"></i>
              <p>
                 Usuarios
              </p>
            </a>
          </li>
          <?php }else{ ?>
            <li class="nav-item">
            <a href="./" class="nav-link" style="color:white">
            <i class="fas fa-home"></i>
              <p>
                 Inicio
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="mis-pedidos" class="nav-link" style="color:white">
            <i class="fas fa-shopping-basket"></i>
              <p>
                 Mis Pedidos
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="reseñas" class="nav-link" style="color:white">
            <i class="fas fa-comments"></i>
              <p>
                 Mis Reseñas
              </p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="../php/cerrar_sesion" class="nav-link" style="color:white">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                 Salir
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

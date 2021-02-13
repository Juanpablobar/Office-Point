  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../.././index.php" class="nav-link">Casa</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../.././contact.php" class="nav-link">Contacto</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item"><img src="../.././img/logo.png"></li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Clinika Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GRODEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../img/deafult.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $arregloUsuario['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-home"></i>
              <p>
                 Inicio
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./pedidos.php" class="nav-link">
              <i class="fas fa-money-check-alt"></i>
              <p>
                 Pedidos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./productos.php" class="nav-link">
              <i class="fas fa-cart-arrow-down"></i>
              <p>
                 Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./cupones.php" class="nav-link">
              <i class="fas fa-ticket-alt"></i>
              <p>
                 Cupones
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./usuarios.php" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
                 Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../php/cerrar_sesion.php" class="nav-link">
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

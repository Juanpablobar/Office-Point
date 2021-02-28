<?php
session_start();
include '../php/conexion.php';
if(!isset($_SESSION['datos_login'])){
  header('Location: ../');
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel'] != 'admin'){
  header('Location: ./');
}
$resultado = $conexion->query("
select * from
productos order by id")or die($conexion->error);
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
          <style>
            table tr{
              color:#444;
              font-size: 14px;;
            }
          </style>
           <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color:#444">Productos (<?php echo mysqli_num_rows($resultado) ?>)</h1>
          </div><!-- /.col -->
        </div>
        <div class="col-sm-6 text-right ml-auto" style="margin-top:1em;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  	<i class="fa fa-plus"></i> Insertar Producto
</button>          </div><!-- /.col -->
<!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content content-fluid">
    	<div class="content-fluid">
    		<table class="table">
    			<thead class="thead">
    			<tr>
    				<th>Id</th>
    				<th>Nombre</th>
    				<th>Precio</th>
    				<th>Descuento</th>
    				<th>Duración Descuento</th>
    				<th>Nuevo</th>
    				<th>Imagen1</th>
    				<th>Imagen2</th>
    				<th>Imagen3</th>
    				<th>Descripción Sencilla</th>
    				<th>Descripción Amplia</th>
    				<th>Información</th>
    				<th>Stock</th>
    				<th>Dimensiones</th>
    				<th>Peso</th>
    				<th>Materiales</th>
    				<th>Categoría</th>
    				<th>Sub-Categoría</th>
    				<th>Tag1</th>
    				<th>Tag2</th>
    				<th>Tag3</th>
    				<th></th>
					</tr>
    			</thead>
    			<tbody>
    			<tr>
    			<?php
					while($f = mysqli_fetch_array($resultado)){
					?>
    				<td><?php echo $f['id']; ?></td>
    				<td><?php echo $f['nombre']; ?></td>
    				<td><?php echo $f['precio']; ?></td>
    				<td><?php echo $f['descuento']; ?></td>
    				<td><?php echo $f['tiempo_descuento']; ?></td>
    				<td><?php echo $f['nuevo']; ?></td>
    				<td><img width="50px" heigth="50px" src="../img/<?php echo $f['img']; ?>"></td>
    				<td><img width="50px" heigth="50px" src="../img/<?php echo $f['img2']; ?>"></td>
    				<td><img width="50px" heigth="50px" src="../img/<?php echo $f['img3']; ?>"></td>
    				<td><?php echo substr($f['descripcion'],0,50).'...'; ?></td>
    				<td><?php echo substr($f['descripcion_amplia'],0,50).'...'; ?></td>
    				<td><?php echo substr($f['informacion_amplia'],0,50).'...'; ?></td>
    				<td><?php echo $f['stock']; ?></td>
    				<td><?php echo $f['dimensiones']; ?></td>
    				<td><?php echo $f['peso']; ?></td>
    				<td><?php echo substr($f['materiales'],0,50).'...'; ?></td>
    				<td><?php echo $f['categoria']; ?></td>
    				<td><?php echo $f['subcategoria']; ?></td>
    				<td><?php echo $f['tag1']; ?></td>
    				<td><?php echo $f['tag2']; ?></td>
    				<td><?php echo $f['tag3']; ?></td>
    				<td>
    					<button style="margin-bottom:1em" class="btn btn-primary btn-small btnEditar" data-id="<?php echo $f['id'] ?>"
    					data-nombre="<?php echo $f['nombre']; ?>"
    					data-precio="<?php echo $f['precio']; ?>"
    					data-descuento="<?php echo $f['descuento']; ?>"
    					data-d_descuento="<?php echo $f['tiempo_descuento']; ?>"
    					data-nuevo="<?php echo $f['nuevo']; ?>"
    					data-des1="<?php echo $f['descripcion']; ?>"
    					data-des2="<?php echo $f['descripcion_amplia']; ?>"
    					data-informacion="<?php echo $f['informacion_amplia']; ?>"
    					data-stock="<?php echo $f['stock']; ?>"
    					data-peso="<?php echo $f['peso']; ?>"
    					data-materiales="<?php echo $f['materiales']; ?>"
    					data-dimensiones="<?php echo $f['dimensiones']; ?>"
    					data-categoria="<?php echo $f['categoria']; ?>"
    					data-subcategoria="<?php echo $f['subcategoria']; ?>"
    					data-tag1="<?php echo $f['tag1']; ?>"
    					data-tag2="<?php echo $f['tag2']; ?>"
    					data-tag3="<?php echo $f['tag3']; ?>"
    					  data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
    					<button class="btn btn-danger btn-small btnEliminar" data-id="<?php echo $f['id'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></button>
    				</td>
					</tr>
   			<?php } ?>
    			</tbody>
    		</table>
    	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <style>
  table tr:nth-child(2n+1){
    background: #e6e6e6 
  }
  table thead tr:nth-child(1) {
    background: #F4F6F9 !important
  }
  </style>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/insertarproducto.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insertar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Precio</label>
        <input type="number" name="precio" placeholder="Precio" id="precio" class="form-control" min="0" required>
      </div>
      <div class="form-group">
        <label for="">Descuento</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Si desea que no tenga descuenta solo ponga 0</h6>
        <input type="number" name="descuento" placeholder="Descuento" min="0" max="100" id="descuento" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Duración Descuento</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Incluya la fecha hasta la cual estará vigente el descuento</h6>
        <input type="date" name="d_descuento" placeholder="Duración del Descuento" id="d_descuento" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Nuevo</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Si el producto es nuevo se mostrará una etiqueta mostrándolo</h6>
        <select name="nuevo" id="nuevo" class="form-control" required>
          <option value="si">Si</option>
          <option value="no">No</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Imagen1</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Ésta será la imagen principal, las siguientes dos se mostrarán como alternativas</h6>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen1" placeholder="Imagen1" id="imagen1" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Imagen2</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen2" placeholder="Imagen2" id="imagen2" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Imagen3</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen3" placeholder="Imagen3" id="imagen3" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Descripción Sencilla</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Ésta descripción se mostrará al inicio, mientras qué la descripción amplia y la información se mostrarán junto con las reseñas casi al final del producto</h6>
        <input type="text" name="des1" placeholder="Descripción Sencilla" id="des1" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Descripción Amplia</label>
        <input type="text" name="des2" placeholder="Descripción Amplia" id="des2" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Información</label>
        <input type="text" name="informacion" placeholder="Información" id="informacion" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Stock</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">El stock se irá descontando automáticamente</h6>
        <input type="number" min="0" name="stock" placeholder="Stock" id="stock" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Dimensiones</label>
        <input type="text" name="dimensiones" placeholder="Ej. 10cm de alto, 15cm de ancho" id="dimensiones" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Peso</label>
        <input type="text" name="peso" placeholder="Ej. 10gr" id="peso" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Materiales</label>
        <input type="text" name="materiales" placeholder="Materiales" id="materiales" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Categoría</label>
        <select name="catego" id="catego" class="form-control catego" required>
          <?php
            $resultado11 = $conexion ->query("select * from categorias order by id"); 
            while ($fila11 = mysqli_fetch_array($resultado11)) {
                ?>
          <option  class="optionCatego" data-id="<?php echo $fila11[0] ?>" value="<?php echo $fila11[1]; ?>"><?php echo $fila11[1]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Sub-categoría</label>
        <div class="insert">
        <select name="sub_catego" id="sub_catego" class="form-control sub_catego" required>
        <?php
            $var = 1;

         $resultado12 = $conexion ->query("SELECT * FROM subcategorias INNER JOIN categorias ON subcategorias.id_categoria = categorias.nombre WHERE categorias.id=".$var)
         or die($conexion->error);	
         while ($f12 = mysqli_fetch_row($resultado12)){
        ?>
        <option value="<?php echo $f12[1] ?>"><?php echo $f12[1] ?></option>
        <?php } ?>
        </select>
         </div>
      </div>
      <div class="form-group">
        <label for="">Tag1</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Los tags o etiquetas ayudan a organizar los productos en Nuevas Categorías.</h6>
        <select name="tag1" placeholder="Ej. Lo Más Nuevo" id="tag1" class="form-control">
          <?php
            $resultado13 = $conexion ->query("select * from tags order by id"); 
            while ($fila13 = mysqli_fetch_array($resultado13)) {
                ?>
              <option value="<?php echo $fila13[1] ?>"><?php echo $fila13[1] ?></option>
              <?php
            } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Tag2</label>
        <select name="tag2" placeholder="Ej. Tendencias" id="tag2" class="form-control">
        <?php
            $resultado13 = $conexion ->query("select * from tags order by id"); 
            while ($fila13 = mysqli_fetch_array($resultado13)) {
                ?>
              <option value="<?php echo $fila13[1] ?>"><?php echo $fila13[1] ?></option>
              <?php
            } ?>

        </select>
      </div>
      <div class="form-group">
        <label for="">Tag3</label>
        <select name="tag3" placeholder="Ej. Lo Más Vendido" id="tag3" class="form-control">
        <?php
            $resultado13 = $conexion ->query("select * from tags order by id"); 
            while ($fila13 = mysqli_fetch_array($resultado13)) {
                ?>
              <option value="<?php echo $fila13[1] ?>"><?php echo $fila13[1] ?></option>
              <?php
            } ?>

        </select>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar el producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" data-dismiss="modal" class="btn btn-danger eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="../php/editarproducto.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="idEdit" name="id">
      <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre" id="nombreEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Precio</label>
        <input type="number" name="precio" placeholder="Precio" id="precioEdit" class="form-control" min="0" required>
      </div>
      <div class="form-group">
        <label for="">Descuento</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Si desea que no tenga descuenta solo ponga 0</h6>
        <input type="number" name="descuento" placeholder="Descuento" min="0" max="100" id="descuentoEdit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Duración Descuento</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Incluya la fecha hasta la cual estará vigente el descuento</h6>
        <input type="date" name="d_descuento" placeholder="Duración del Descuento" id="d_descuentoEdit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Nuevo</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Si el producto es nuevo se mostrará una etiqueta mostrándolo</h6>
        <select name="nuevo" id="nuevoEdit" class="form-control" required>
          <option value="si">Si</option>
          <option value="no">No</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Imagen1</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Ésta será la imagen principal, las siguientes dos se mostrarán como alternativas</h6>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen1" placeholder="Imagen1" id="imagen1Edit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Imagen2</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen2" placeholder="Imagen2" id="imagen2Edit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Image3</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#FF6363">Te recomendamos subir cada imagen por separado para que se visualicen correctamente</h6>
        <input type="file" name="imagen3" placeholder="Imagen3" id="imagen3Edit" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Descripción Sencilla</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Ésta descripción se mostrará al inicio, mientras qué la descripción amplia y la información se mostrarán junto con las reseñas casi al final del producto</h6>
        <input type="text" name="des1" placeholder="Descripción Sencilla" id="des1Edit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Descripción Amplia</label>
        <input type="text" name="des2" placeholder="Descripción Amplia" id="des2Edit" class="form-control" required> 
      </div>
      <div class="form-group">
        <label for="">Información</label>
        <input type="text" name="informacion" placeholder="Información" id="informacionEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Stock</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">El stock se irá descontando automáticamente</h6>
        <input type="number" min="0" name="stock" placeholder="Stock" id="stockEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Dimensiones</label>
        <input type="text" name="dimensiones" placeholder="Ej. 10cm de alto, 15cm de ancho" id="dimensionesEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Peso</label>
        <input type="text" name="peso" placeholder="Ej. 10gr" id="pesoEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Materiales</label>
        <input type="text" name="materiales" placeholder="Materiales" id="materialesEdit" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="">Categoría</label>
        <select name="catego" id="categoEdit" class="form-control catego" required>
          <?php
            $resultado11 = $conexion ->query("select * from categorias order by id"); 
            while ($fila11 = mysqli_fetch_array($resultado11)) {
                ?>
          <option  class="optionCatego" data-id="<?php echo $fila11[0] ?>" value="<?php echo $fila11[1]; ?>"><?php echo $fila11[1]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Sub-categoría</label>
        <div class="insert">
        <select name="sub_catego" id="subcategoEdit" class="form-control sub_catego" required>
        <?php
            $var = 1;

         $resultado12 = $conexion ->query("SELECT * FROM subcategorias INNER JOIN categorias ON subcategorias.id_categoria = categorias.nombre WHERE categorias.id=".$var)
         or die($conexion->error);	
         while ($f12 = mysqli_fetch_row($resultado12)){
        ?>
        <option value="<?php echo $f12[1] ?>"><?php echo $f12[1] ?></option>
        <?php } ?>
        </select>
         </div>
      </div>

      <div class="form-group">
        <label for="">Tag1</label>
        <h6 style="margin-bottom:.5em;margin-top:-.5em;font-size:12px;color:#999">Los tags o etiquetas ayudan a organizar los productos en Nuevas categorías.</h6>
        <select name="tag1" placeholder="Ej. Lo Más Vendido" id="tag1Edit" class="form-control">
        <?php
            $resultado13 = $conexion ->query("select * from tags order by id"); 
            while ($fila13 = mysqli_fetch_array($resultado13)) {
                ?>
              <option value="<?php echo $fila13[1] ?>"><?php echo $fila13[1] ?></option>
              <?php
            } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Tag2</label>
        <select name="tag2" placeholder="Ej. Tendencias" id="tag2Edit" class="form-control">
        <?php
            $resultado13 = $conexion ->query("select * from tags order by id"); 
            while ($fila13 = mysqli_fetch_array($resultado13)) {
                ?>
              <option value="<?php echo $fila13[1] ?>"><?php echo $fila13[1] ?></option>
              <?php
            } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Tag3</label>
        <select name="tag3" placeholder="Ej. Lo Más Nuevo" id="tag3Edit" class="form-control">
        <?php
            $resultado13 = $conexion ->query("select * from tags order by id"); 
            while ($fila13 = mysqli_fetch_array($resultado13)) {
                ?>
              <option value="<?php echo $fila13[1] ?>"><?php echo $fila13[1] ?></option>
              <?php
            } ?>
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
		var idEliminar = -1;
		var idEditar = -1;
		var fila;
		$(".btnEliminar").click(function(){
		idEliminar = $(this).data('id');
		fila=$(this).parent('td').parent('tr');
	});
		$(".eliminar").click(function(){
			$.ajax({
				url: '../php/eliminarproducto.php',
				method: 'POST',
				data:{
					id:idEliminar
				}
			}).done(function(res){
				$(fila).fadeOut(1000);
			});
		});
		$('.btnEditar').click(function(){
			var id=$(this).data('id');
			var nombre=$(this).data('nombre');
			var precio=$(this).data('precio');
			var descuento=$(this).data('descuento');
			var d_descuento=$(this).data('d_descuento');
			var nuevo=$(this).data('nuevo');
			var des1=$(this).data('des1');
			var des2=$(this).data('des2');
			var informacion=$(this).data('informacion');
			var stock=$(this).data('stock');
			var dimensiones=$(this).data('dimensiones');
			var peso=$(this).data('peso');
			var materiales=$(this).data('materiales');
			var tag1=$(this).data('tag1');
			var tag2=$(this).data('tag2');
			var tag3=$(this).data('tag3');
			$('#idEdit').val(id);
			$('#nombreEdit').val(nombre);
			$('#precioEdit').val(precio);
			$('#descuentoEdit').val(descuento);
			$('#d_descuentoEdit').val(d_descuento);
			$('#nuevoEdit').val(nuevo);
			$('#des1Edit').val(des1);
			$('#des2Edit').val(des2);
			$('#informacionEdit').val(informacion);
			$('#stockEdit').val(stock);
			$('#dimensionesEdit').val(dimensiones);
			$('#pesoEdit').val(peso);
			$('#materialesEdit').val(materiales);
			$('#categoriaEdit').val(materiales);
			$('#subcategoriaEdit').val(materiales);
			$('#tag1Edit').val(tag1);
			$('#tag2Edit').val(tag2);
			$('#tag3Edit').val(tag3);
		});
      $(".catego").change(function(){
      idCatego = $(this).val();
      $.ajax({
				url: '../php/actualizarCatego.php',
				method: 'POST',
				data:{
					id:idCatego
				}
			}).done(function(id){
        $('.sub_catego').remove();
        $('.insert').append(id);
	})
  });
});
	</script>
</body>
</html>

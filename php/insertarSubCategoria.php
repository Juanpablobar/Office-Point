<?php
include './conexion.php';
if (isset($_POST['nombre']) && isset($_POST['id_catego'])) {
    $conexion->query("insert into subcategorias
			(nombre,id_categoria) values(
			'".$_POST['nombre']."',
			'".$_POST['id_catego']."'
			)
			")or die($conexion->error);
    header('Location: ../dashboard/categories.php?success');
}else{
	header('Location: ../dashboard/categories.php?error=Favor de llenar todos los campos');
}
?>

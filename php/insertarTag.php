<?php
include './conexion.php';
if(isset($_POST['nombre'])){
	
	$conexion->query("insert into tags
		(nombre) values(
			'".$_POST['nombre']."'
			)
			")or die($conexion->error);
			header('Location: ../dashboard/tags.php?success');
}else{
	header('Location: ../dashboard/tags.php?error=Favor de llenar todos los campos');
}
?>

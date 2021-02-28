<?php
include './conexion.php';
if(isset($_POST['nombre']) && isset($_POST['des'])){
	
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;


	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$conexion->query("insert into categorias
			(nombre,imagen,descripcion) values(
			'".$_POST['nombre']."',
			'$nombrefinal',
			'".$_POST['des']."'
			)
			")or die($conexion->error);
			header('Location: ../dashboard/categories.php?success');
		}else{
			header('Location: ../dashboard/categories.php?error=No se pudo subir la imagen');
		}
	}else{
			header('Location: ../dashboard/categories.php?error=Favor de subir una imagen válida');
	}
	
}else{
	header('Location: ../dashboard/categories.php?error=Favor de llenar todos los campos');
}
?>

<?php
include './conexion.php';
if(isset($_POST['alto']) && isset($_POST['ancho']) && isset($_POST['vertical']) && isset($_POST['horizontal']) && isset($_POST['t_tag']) && isset($_POST['cl_tag']) && isset($_POST['texto']) && isset($_POST['c_texto']) && isset($_POST['t_boton']) && isset($_POST['cl_boton'])){
	
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;


	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$conexion->query("insert into categorias_index
			(alto,ancho,img,posicion_texto_vertical,posicion_texto_horizontal,contenido_tag,color_tag,contenido_texto,color_texto,color_boton,contenido_boton,enlace) values(
			'".$_POST['alto']."',
			'".$_POST['ancho']."',
			'$nombrefinal',
			'".$_POST['vertical']."',
			'".$_POST['horizontal']."',
			'".$_POST['t_tag']."',
			'".$_POST['cl_tag']."',
			'".$_POST['texto']."',
			'".$_POST['c_texto']."',
			'".$_POST['cl_boton']."',
			'".$_POST['t_boton']."',
			'".$_POST['t_tag']."'
			)
			")or die($conexion->error);
			header('Location: ../dashboard/home.php?success');
		}else{
			header('Location: ../dashboard/home.php?error=No se pudo subir la imagen');
		}
	}else{
			header('Location: ../dashboard/home.php?error=Favor de subir una imagen válida');
	}
	
}else{
	header('Location: ../dashboard/home.php?error=Favor de llenar todos los campos');
}
?>

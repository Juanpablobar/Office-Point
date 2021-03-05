<?php
include './conexion.php';
if(isset($_POST['p_texto']) && isset($_POST['titulo']) && isset($_POST['c_titulo']) && isset($_POST['texto']) && isset($_POST['c_texto']) && isset($_POST['t_boton']) && isset($_POST['cr_boton']) && isset($_POST['cl_boton']) && isset($_POST['cb_boton']) && isset($_POST['t_etiqueta']) && isset($_POST['cl_etiqueta']) && isset($_POST['cr_etiqueta'])){
	
	$carpeta = "../img/";
	if(isset($_POST['imagen2'])){
		$nombre = $_FILES['imagen2']['name'];
	}else{
        $nombre = $_FILES['imagen']['name'];
    }
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$conexion->query("insert into carousel_index
			(img,posicion_texto,contenido_texto1,color_texto1,contenido_texto2,color_texto2,contenido_boton,color_boton,color_letras_boton,color_borde_boton,enlace_boton,contenido_tag,color_tag,color_letras_tag,img2) values(
			'$nombrefinal',
			'".$_POST['p_texto']."',
			'".$_POST['titulo']."',
			'".$_POST['c_titulo']."',
			'".$_POST['texto']."',
			'".$_POST['c_texto']."',
			'".$_POST['t_boton']."',
			'".$_POST['cr_boton']."',
			'".$_POST['cl_boton']."',
			'".$_POST['cb_boton']."',
			'".$_POST['t_etiqueta']."',
			'".$_POST['t_etiqueta']."',
			'".$_POST['cr_etiqueta']."',
			'".$_POST['cl_etiqueta']."',
			'$nombrefinal2'
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

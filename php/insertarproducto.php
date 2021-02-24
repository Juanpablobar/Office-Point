<?php
include './conexion.php';
if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['nuevo']) && isset($_POST['des1']) && isset($_POST['des2']) && isset($_POST['informacion']) && isset($_POST['stock']) && isset($_POST['dimensiones']) && isset($_POST['peso']) && isset($_POST['materiales']) && isset($_POST['tag1'])){
	
	$carpeta = "../img/";
	$nombre = $_FILES['imagen1']['name'];
	$nombre2 = $_FILES['imagen2']['name'];
	$nombre3 = $_FILES['imagen3']['name'];
	
	$temp= explode( '.', $nombre);
	$temp2= explode( '.', $nombre2);
	$temp3= explode( '.', $nombre3);
	$extension= end($temp);
	$extension2= end($temp2);
	$extension3= end($temp3);
	$nombrefinal = time().'.'.$extension;
	$nombrefinal2 = time().'.'.$extension2;
	$nombrefinal3 = time().'.'.$extension3;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg' && ($extension2== 'jpg' || $extension2 == 'png' || $extension2 == 'jpge' || $extension2 == '' || $extension2== 'webp' || $extension2 == 'svg') && ($extension3== 'jpg' || $extension3 == 'png' || $extension3 == 'jpge' || $extension3== 'webp' || $extension3 == 'svg' || $extension3 == '')){
		if(move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta.$nombrefinal) && move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta.$nombrefinal2) && move_uploaded_file($_FILES['imagen3']['tmp_name'], $carpeta.$nombrefinal3)){
			$conexion->query("insert into productos
			(nombre,precio,descuento,tiempo_descuento,nuevo,img,img2,img3,descripcion,stock,dimensiones,peso,descripcion_amplia,materiales,informacion_amplia,tag1,tag2,tag3) values(
			'".$_POST['nombre']."',
			".$_POST['precio'].",
			".$_POST['descuento'].",
			'".$_POST['d_descuento']."',
			'".$_POST['nuevo']."',
			'$nombrefinal',
			'$nombrefinal2',
			'$nombrefinal3',
			'".$_POST['des1']."',
			'".$_POST['stock']."',
			'".$_POST['dimensiones']."',
			'".$_POST['peso']."',
			'".$_POST['des2']."',
			'".$_POST['materiales']."',
			'".$_POST['informacion']."',
			'".$_POST['tag1']."',
			'".$_POST['tag2']."',
			'".$_POST['tag3']."'
			)
			")or die($conexion->error);
			header('Location: ../dashboard/productos.php?success');
		}else{
			header('Location: ../dashboard/productos.php?error=No se pudo subir la imagen');
		}
	}else{
			header('Location: ../dashboard/productos.php?error=Favor de subir una imagen válida');
	}
	
}else{
	header('Location: ../dashboard/productos.php?error=Favor de llenar todos los campos');
}
?>

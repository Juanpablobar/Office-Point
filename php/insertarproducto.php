<?php
include './conexion.php';
if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['tamaño']) && isset($_POST['material']) && isset($_POST['marca']) && isset($_POST['stock'])){
	
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$conexion->query("insert into productos
			(nombre,img,img2,vendidos,horas,descripcion,precio,tamaño,tamaño2,material,material2,marca,tipo,stock) values(
			'".$_POST['nombre']."',
			'$nombrefinal',
			'product25.png',
			'24',
			'12',
			'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ejercicio ullamco laboris nisi ut ...',
			'".$_POST['precio']."',
			'".$_POST['tamaño']."',
			'S',
			'".$_POST['material']."',
			'Acero',
			'".$_POST['marca']."',
			'Tubo',
			'".$_POST['stock']."'
			)
			")or die($conexion->error);
			header('Location: ../dashboard/AdminLTE-3.1.0-rc/productos.php?success');
		}else{
			header('Location: ../dashboard/AdminLTE-3.1.0-rc/productos.php?error=No se pudo subir la imagen');
		}
	}else{
			header('Location: ../dashboard/AdminLTE-3.1.0-rc/productos.php?error=Favor de subir una imagen válida');
	}
	
}else{
	header('Location: ../dashboard/AdminLTE-3.1.0-rc/productos.php?error=Favor de llenar todos los campos');
}
?>

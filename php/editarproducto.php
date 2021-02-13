<?php
include './conexion.php';
if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['tamaño']) && isset($_POST['material']) && isset($_POST['marca']) && isset($_POST['stock'])){
	if(isset($_POST['imagen'])){
		if($_POST['imagen']!=''){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select imagen from productos where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update productos set imagen='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
	}
			$conexion->query("update productos set 
			nombre='".$_POST['nombre']."',
			precio=".$_POST['precio'].",
			tamaño='".$_POST['tamaño']."',
			material='".$_POST['material']."',
			marca='".$_POST['marca']."',
			stock='".$_POST['stock']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/AdminLTE-3.1.0-rc/productos.php?edit');
}
?>
<?php
include './conexion.php';

if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['nuevo']) && isset($_POST['des1']) && isset($_POST['des2']) && isset($_POST['informacion']) && isset($_POST['stock']) && isset($_POST['dimensiones']) && isset($_POST['peso']) && isset($_POST['materiales']) && isset($_POST['tag1'])){
	
		if($_FILES['imagen1']['name']!='' ){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen1']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select img from productos where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update productos set img='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
		if($_FILES['imagen2']['name']!='' ){
	$carpeta = "../img/";
	$nombre2 = $_FILES['imagen2']['name'];
	
	$temp= explode( '.', $nombre2);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select img2 from productos where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update productos set img2='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
		if($_FILES['imagen3']['name']!='' ){
	$carpeta = "../img/";
	$nombre3 = $_FILES['imagen3']['name'];
	
	$temp= explode( '.', $nombre3);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen3']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select img3 from productos where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update productos set img3='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
			$conexion->query("update productos set 
			nombre='".$_POST['nombre']."',
			precio=".$_POST['precio'].",
			descuento=".$_POST['descuento'].",
			tiempo_descuento='".$_POST['d_descuento']."',
			nuevo='".$_POST['nuevo']."',
			descripcion='".$_POST['des1']."',
			stock=".$_POST['stock'].",
			dimensiones='".$_POST['dimensiones']."',
			peso='".$_POST['peso']."',
			descripcion_amplia='".$_POST['des2']."',
			materiales='".$_POST['materiales']."',
			informacion_amplia='".$_POST['informacion']."',
			tag1='".$_POST['tag1']."',
			tag2='".$_POST['tag2']."',
			tag3='".$_POST['tag3']."',
			categoria='".$_POST['catego']."',
			subcategoria='".$_POST['sub_catego']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/productos.php?edit');
}
?>
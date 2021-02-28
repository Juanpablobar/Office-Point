<?php
include './conexion.php';

if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['des'])){
	
		if($_FILES['imagen']['name']!='' ){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select imagen from categorias where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update categorias set imagen='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
			$conexion->query("update categorias set 
			nombre='".$_POST['nombre']."',
			descripcion='".$_POST['des']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/categories.php?edit');
}
?>
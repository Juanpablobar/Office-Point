<?php
include './conexion.php';

if(isset($_POST['alt'])){
	
		if($_FILES['imagen']['name']!='' ){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select img from nosotros_img where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update nosotros_img set img='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
			$conexion->query("update nosotros_img set 
			alt='".$_POST['alt']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/about-us.php?edit');
}
?>
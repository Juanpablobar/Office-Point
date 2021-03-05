<?php
include './conexion.php';

if(isset($_POST['etiqueta']) && isset($_POST['texto1']) && isset($_POST['texto2'])){
	
		if($_FILES['imagen']['name']!='' ){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select imagen from popup where id=1');
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update popup set imagen='".$nombrefinal."' where id=1");
		}
	}
		}
			$conexion->query("update popup set 
			texto1='".$_POST['etiqueta']."',
			texto2='".$_POST['texto1']."',
			texto3='".$_POST['texto2']."'
			where id=1");
			header('Location: ../dashboard/popup.php?edit');
}
?>
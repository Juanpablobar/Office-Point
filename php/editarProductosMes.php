<?php
include './conexion.php';

if(isset($_POST['id']) && isset($_POST['t_tag']) && isset($_POST['titulo']) && isset($_POST['textoDes'])){
	
	if($_FILES['imagen1']['name']!='' ){
		$carpeta = "../img/";
		$nombre = $_FILES['imagen1']['name'];
		
		$temp= explode( '.', $nombre);
		$extension= end($temp);
		$nombrefinal = time().'.'.$extension;
		
		if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
			if(move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta.$nombrefinal)){
				$fila = $conexion->query('select img from productos_del_mes where id='.$_POST['id']);
				$id = mysqli_fetch_row($fila);
				if(file_exists('../img/'.$id[0])){
					unlink('../img/'.$id[0]);
				}
				$conexion->query("update productos_del_mes set img='".$nombrefinal."' where id=".$_POST['id']);
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
				$fila = $conexion->query('select img2 from productos_del_mes where id='.$_POST['id']);
				$id = mysqli_fetch_row($fila);
				if(file_exists('../img/'.$id[0])){
					unlink('../img/'.$id[0]);
				}
				$conexion->query("update productos_del_mes set img2='".$nombrefinal."' where id=".$_POST['id']);
			}
		}
			}

			$conexion->query("update productos_del_mes set 
			texto='".$_POST['titulo']."',
			texto2='".$_POST['textoDes']."',
			enlace='".$_POST['t_tag']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/home.php?edit');
}
?>
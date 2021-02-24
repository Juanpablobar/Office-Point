<?php
include './conexion.php';

if(isset($_POST['id']) && isset($_POST['t_tag']) && isset($_POST['cr_tag']) && isset($_POST['cl_tag']) && isset($_POST['fecha']) && isset($_POST['cr_boton']) && isset($_POST['cl_boton']) && isset($_POST['cb_boton'])){
	
		if($_FILES['imagen']['name']!='' ){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select imagen from reloj_index where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update reloj_index set imagen='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
			$conexion->query("update reloj_index set 
			color_tag='".$_POST['cr_tag']."',
			color_letras_tag='".$_POST['cl_tag']."',
			contenido_tag='".$_POST['t_tag']."',
			fecha='".$_POST['fecha']."',
			color_boton='".$_POST['cr_boton']."',
			color_letras_boton='".$_POST['cl_boton']."',
			color_border_boton='".$_POST['cb_boton']."',
			enlace_boton='".$_POST['t_tag']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/home.php?edit');
}
?>
<?php
include './conexion.php';

if(isset($_POST['alto']) && isset($_POST['alto']) && isset($_POST['ancho']) && isset($_POST['vertical']) && isset($_POST['horizontal']) && isset($_POST['t_tag']) && isset($_POST['cl_tag']) && isset($_POST['texto']) && isset($_POST['c_texto']) && isset($_POST['t_boton']) && isset($_POST['cl_boton'])){
	
		if($_FILES['imagen']['name']!='' ){
	$carpeta = "../img/";
	$nombre = $_FILES['imagen']['name'];
	
	$temp= explode( '.', $nombre);
	$extension= end($temp);
	$nombrefinal = time().'.'.$extension;
	
	if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
			$fila = $conexion->query('select img from categorias_index where id='.$_POST['id']);
			$id = mysqli_fetch_row($fila);
			if(file_exists('../img/'.$id[0])){
				unlink('../img/'.$id[0]);
			}
			$conexion->query("update categorias_index set img='".$nombrefinal."' where id=".$_POST['id']);
		}
	}
		}
			$conexion->query("update categorias_index set 
			alto='".$_POST['alto']."',
			ancho='".$_POST['ancho']."',
			posicion_texto_vertical='".$_POST['vertical']."',
			posicion_texto_horizontal='".$_POST['horizontal']."',
			contenido_tag='".$_POST['t_tag']."',
			color_tag='".$_POST['cl_tag']."',
			contenido_texto='".$_POST['texto']."',
			color_texto='".$_POST['c_texto']."',
			color_boton='".$_POST['cl_boton']."',
			contenido_texto='".$_POST['t_boton']."',
			enlace='".$_POST['t_tag']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/home.php?edit');
}
?>
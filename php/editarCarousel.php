<?php
include './conexion.php';

if(isset($_POST['p_texto']) && isset($_POST['titulo']) && isset($_POST['c_titulo']) && isset($_POST['texto']) && isset($_POST['c_texto']) && isset($_POST['t_boton']) && isset($_POST['cr_boton']) && isset($_POST['cl_boton']) && isset($_POST['cb_boton']) && isset($_POST['t_etiqueta']) && isset($_POST['cl_etiqueta']) && isset($_POST['cr_etiqueta'])){
	
    if($_FILES['imagen']['name']!='' ){
        $carpeta = "../img/";
        $nombre = $_FILES['imagen']['name'];
        
        $temp= explode( '.', $nombre);
        $extension= end($temp);
        $nombrefinal = time().'.'.$extension;
        
        if($extension== 'jpg' || $extension == 'png' || $extension == 'jpge' || $extension== 'webp' || $extension == 'svg'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
                $fila = $conexion->query('select img from carousel_index where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../img/'.$id[0])){
                    unlink('../img/'.$id[0]);
                }
                $conexion->query("update carousel_index set img='".$nombrefinal."' where id=".$_POST['id']);
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
                $fila = $conexion->query('select img2 from carousel_index where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../img/'.$id[0])){
                    unlink('../img/'.$id[0]);
                }
                $conexion->query("update carousel_index set img2='".$nombrefinal."' where id=".$_POST['id']);
            }
        }
            }
                $conexion->query("update carousel_index set 
			posicion_texto='".$_POST['p_texto']."',
			contenido_texto1='".$_POST['titulo']."',
			color_texto1='".$_POST['c_titulo']."',
			contenido_texto2='".$_POST['texto']."',
			color_texto2='".$_POST['c_texto']."',
			contenido_boton='".$_POST['t_boton']."',
			color_boton='".$_POST['cr_boton']."',
			color_letras_boton='".$_POST['cl_boton']."',
			color_borde_boton='".$_POST['cb_boton']."',
			enlace_boton='".$_POST['t_etiqueta']."',
			contenido_tag='".$_POST['t_etiqueta']."',
			color_tag='".$_POST['cr_etiqueta']."',
			color_letras_tag='".$_POST['cl_etiqueta']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/home.php?edit');
}
?>
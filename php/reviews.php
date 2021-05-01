<?php 
include './conexion.php';
if(isset($_POST["send"])){
    $resultado = $conexion ->query("insert into comentarios
	(nombre,correo,reseña,calificacion,id_producto,dia,mes,año)
	values(
	'".$_POST['name']."',
	'".$_POST['email']."',
	'".$_POST['review']."',
	'".$_POST['estrellas']."',
	'".$_POST['id']."',
	'".date("j")."',
	'".date("M")."',
	'".date("Y")."'
	)"
    )or die($conexion->error);
    if(mysqli_num_rows($resultado) > 0){
        $fila = mysqli_fetch_row($resultado);    
    
	}
	header('Location: ../shop-single?id='.$_POST['id']);
}else{
	header('Location: ../shop-single?id='.$_POST['id']);
}
?>
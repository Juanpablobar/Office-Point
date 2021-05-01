<?php
include './conexion.php';
if(isset($_POST['id']) ){
			$conexion->query("update icons_index set 
			texto1='".$_POST['sub-titulo']."',
			texto2='".$_POST['texto']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/home.php?edit');
}
?>
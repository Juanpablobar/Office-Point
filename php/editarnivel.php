<?php
include './conexion.php';
if(isset($_POST['nivel']) ){
			$conexion->query("update usuario set 
			nivel='".$_POST['nivel']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/AdminLTE-3.1.0-rc/usuarios.php?edit');
}
?>
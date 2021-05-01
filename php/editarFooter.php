<?php
include './conexion.php';

if(isset($_POST['id']) && isset($_POST['texto'])){
	
			$conexion->query("update footer set 
			texto='".$_POST['texto']."'
			where id=".$_POST['id']);
			header('Location: ../dashboard/edit-footer.php?edit');
}
?>
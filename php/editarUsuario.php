<?php
include './conexion.php';
        if(isset($_POST['user'])){
			$conexion->query("update usuarios set 
			nivel='".$_POST['user_nvl']."'
			where id=".$_POST['id_user']);
			header('Location: ../dashboard/usuarios.php?edit');
}else{
    header('Location: ../dashboard/usuarios');
}
?>
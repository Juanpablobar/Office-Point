<?php
include './conexion.php';
if(isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['address1']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['id'])){

    $resultado = $conexion->query("
    select * from
    direcciones_usuarios where id_usuario='".$_POST["id"]."'")or die($conexion->error);
    
    if (mysqli_num_rows($resultado) == 0) {
        $conexion->query("insert into direcciones_usuarios
		(nombres,apellidos,pais,calle,apartamento,ciudad,estado,cp,telefono,correo,id_usuario) values(
			'".$_POST['first-name']."',
			'".$_POST['last-name']."',
			'".$_POST['country']."',
			'".$_POST['address1']."',
			'".$_POST['address2']."',
			'".$_POST['city']."',
			'".$_POST['state']."',
			'".$_POST['zip']."',
			'".$_POST['phone']."',
			'".$_POST['email']."',
			".$_POST['id']."
			)
			")or die($conexion->error);
        header('Location: ../dashboard/mi-perfil.php?success');
    }else{
        $conexion->query("update direcciones_usuarios set 
        nombres='".$_POST['first-name']."',
        apellidos='".$_POST['last-name']."',
        pais='".$_POST['country']."',
        calle='".$_POST['address1']."',
        apartamento='".$_POST['address2']."',
        ciudad='".$_POST['city']."',
        estado='".$_POST['state']."',
        cp='".$_POST['zip']."',
        telefono='".$_POST['phone']."',
        correo='".$_POST['email']."'
        where id_usuario=".$_POST['id']);
        header('Location: ../dashboard/mi-perfil.php?edit');
    }
}else{
	header('Location: ../dashboard/mi-perfil.php?error=Favor de llenar todos los campos');
}
?>

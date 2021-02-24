<?php
include './conexion.php';
if(isset($_POST['codigo']) && isset($_POST['tipo']) && isset($_POST['valor'])){
	$conexion->query("insert into cupones (codigo,tipo,valor,status,fecha_de_vencimiento)
	values(
	'".$_POST['codigo']."',
	'".$_POST['tipo']."',
	'".$_POST['valor']."',
	'activo',
	'".$_POST['fecha']."'
	)
	")or die($conexion->error);
			header('Location: ../dashboard/cupones.php?success');
}else{
	
}
?>
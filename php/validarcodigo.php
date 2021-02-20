<?php
include './conexion.php';
if(isset($_POST['codigo'])){
	$respuesta = $conexion ->query("select * from cupones where codigo ='".$_POST['codigo']."'");
		if(mysqli_num_rows($respuesta) == 0){
			echo "código no válido";
		}else{
			$datos = mysqli_fetch_row($respuesta);
			$arreglo = array(
						'id' => $datos[0],
						'codigo' => $datos[1],
						'status' => $datos[2],
						'tipo' => $datos[3],
						'valor' => $datos[4],
						'fecha_de_vencimiento' => $datos[5]
			);
			echo json_encode($arreglo);
		}
}else{
	echo "error";
}

?>
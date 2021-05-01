<?php
include './conexion.php';
if(isset($_POST['codigo'])){
    if ($_POST['codigo'] != '') {
        $respuesta = $conexion ->query("select * from cupones where codigo ='".$_POST['codigo']."'");
        $fila = mysqli_fetch_array($respuesta);
        if (mysqli_num_rows($respuesta) == 0) {
            echo "Código no Válido";
        } else {
            if ($fila[2] == 'activo') {
                $arreglo = array(
                            'id' => $fila[0],
                            'codigo' => $fila[1],
                            'status' => $fila[2],
                            'tipo' => $fila[3],
                            'valor' => $fila[4],
                            'fecha_de_vencimiento' => $fila[5]
                        );
                        echo json_encode($arreglo);
            } else {
                echo 'Cupón Vencido';
            }
        }
    } else{
		echo 'Ingresa un Código';
	}
}else{
	echo "Error";
}

?>
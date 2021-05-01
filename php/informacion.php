<?php
session_start();
error_reporting(0);
include ('./conexion.php');

if(!isset($_POST['continuar'])){
  header("Location: ../shop");
}else{
    
$arreglo = $_SESSION['carrito'];
$total = 0;
$envio = 0;
for($i=0; $i<count($arreglo);$i++){
    $total = $total+($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}
$total = 0;
                    $items = 0;
                    if(isset($_SESSION["carrito"])){
                    $arreglocarrito =$_SESSION["carrito"];
                    for($i=0;$i<count($arreglocarrito);$i++){
                    $total= $total + ($arreglocarrito[$i]["Precio"] * $arreglocarrito[$i]["Cantidad"]);
                    $items += $arreglocarrito[$i]['Cantidad'];
                    }}
                    if($total > 2499):
                            $envio = 0;
                    elseif($items > 30):
                            $envio = 750;
                    elseif($items > 23):
                            $envio = 625;
                    elseif($items > 17):
                            $envio = 500;
                    elseif($items > 11):
                            $envio = 375;
                    elseif($items > 5):
                            $envio = 250;
                    else:
                            $envio = 120;
                        endif;
$totalfinal = $total + $envio;
$imagen = $arreglo[$i]["Imagen"];
$fecha = date("Y-m-d h:m:s");
$conexion -> query("insert into ventas(subtotal,envio,total,fecha,status) values(
$total,
$envio,
$totalfinal,
'$fecha',
'Preparación'
)")or die($conexion->error);
$id_venta = $conexion ->insert_id;
for($i=0; $i<count($arreglo);$i++){
    $conexion -> query("insert into productos_venta (id_venta,id_producto,cantidad,precio,subtotal)
    values(
    $id_venta,
    ".$arreglo[$i]["Id"].",
    ".$arreglo[$i]["Cantidad"].",
    ".$arreglo[$i]["Precio"].",
    ".$arreglo[$i]["Cantidad"]*$arreglo[$i]["Precio"]."
    )")or die($conexion->error);
}
$id_venta_se = sha1($id_venta);
$id_venta_pre = '_';
header("Location: ../thankyou?id_shipping=".$id_venta_se.$id_venta_pre.$id_venta."&"."order_id=".$id_venta);



$conexion->query("insert into envios(correo,nombre,calle,apartamento,cp,ciudad,estado,pais,envio,id_venta)values (
    
    '".$_POST['correo']."',
    '".$_POST['fname']."',
    '".$_POST['calle']."',
    '".$_POST['apartamento']."',
    '".$_POST['cp']."',
    '".$_POST['ciudad']."',
    '".$_POST['estado']."',
    '".$_POST['pais']."',
    'estandar',
    $id_venta

)")or die($conexion->error);

unset($_SESSION['carrito']);
}
?>


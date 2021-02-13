<?php
session_start();
$arreglo = $_SESSION["carrito"];
for($i=0;$i<count($arreglo);$i++){
    if($arreglo[$i]["Id"] != $_POST["id"]){
        $arregloNuevo[]= array(
        "Id" =>$arreglo[$i]["Id"],
        "Nombre" =>  $arreglo[$i]["Nombre"],
        "Imagen" =>  $arreglo[$i]["Imagen"],
        "Tamaño" =>  $arreglo[$i]["Tamaño"],
        "Material" =>  $arreglo[$i]["Material"],
        "Precio" =>  $arreglo[$i]["Precio"],
        "Precio" =>  $arreglo[$i]["Precio"],
        "Cantidad" =>$arreglo[$i]["Cantidad"],
        );
    }
}
if(isset($arregloNuevo)){
    $_SESSION["carrito"]=$arregloNuevo;
}else{
    //quiere decir que el registro a eliminar es el unico que habia
    unset($_SESSION["carrito"]);
}
echo "listo";
?>
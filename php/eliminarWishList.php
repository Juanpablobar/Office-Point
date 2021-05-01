<?php
session_start();
$arreglo = $_SESSION["wishlist"];
for($i=0;$i<count($arreglo);$i++){
    if($arreglo[$i]["Id"] != $_POST["id"]){
        $arregloNuevo[]= array(
        "Id" =>$arreglo[$i]["Id"],
        "Nombre" =>  $arreglo[$i]["Nombre"],
        "Imagen" =>  $arreglo[$i]["Imagen"],
        "Precio" =>  $arreglo[$i]["Precio"],
        "Stock" =>  $arreglo[$i]["Stock"],
        "Cantidad" =>$arreglo[$i]["Cantidad"]
        );
    }
}
if(isset($arregloNuevo)){
    $_SESSION["wishlist"]=$arregloNuevo;
}else{
    //quiere decir que el registro a eliminar es el unico que habia
    unset($_SESSION["wishlist"]);
}
?>
<?php
session_start();
include './conexion.php';

if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['precio']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['pais']) && isset($_POST['calle']) && isset($_POST['ciudad']) && isset($_POST['estado']) && isset($_POST['cp'])){
?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Office Point | Facturación</title>
	
	<link rel="icon shortcut" href="../img/logo.png">
	<link rel="stylesheet" href="../css/checkout-payment.css"> 
	<link rel="preload" href="../fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="../fontawesome-free/css/all.min.css"></noscript>	
</head>
<body>
<?php include ('../layouts/reload.php'); ?>
</body>
</html>
<?php
// variables

$arreglo = $_SESSION['carrito'];
$total = 0;
for($i=0; $i<count($arreglo);$i++){
    $total = $total+($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}

$items = 0;
if(isset($_SESSION["carrito"])){
    $arreglocarrito =$_SESSION["carrito"];
    for($i=0;$i<count($arreglocarrito);$i++){
        $total= $total + ($arreglocarrito[$i]["Precio"] * $arreglocarrito[$i]["Cantidad"]);
        $items += $arreglocarrito[$i]['Cantidad'];
    }
}

if(isset($_POST['contraseña'])){
    $contraseña = $_POST['contraseña'];
} else {
    null;
}

if(isset($_POST['notas'])){
    $notas = $_POST['notas'];
} else {
    null;
}

if(isset($_POST['apartamento'])){
    $apartamento = $_POST['apartamento'];
} else {
    null;
}

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$calle = $_POST['calle'];
$cp = $_POST['cp'];
$estado = $_POST['estado'];
$precioFinal = $_POST['precio'];

// variables

//crear usuario si no existe
$respuesta = $conexion->query("select * from usuarios where correo='".$_POST["correo"]."'")or die($conexion->error);

if(mysqli_num_rows($respuesta) == 0){
    $conexion->query("insert into usuarios (nombre,correo,contraseña,nivel,metodo)
    values(
    '".$_POST['nombres']."'  '".$_POST['apellidos']."',
    '".$_POST['correo']."',
    '".sha1($contraseña)."',
    'cliente',
    'Formulario'
    )
    ")or die($conexion->error);

    $id_usuario = $conexion ->insert_id;

    $_SESSION['datos_login']= array(
        'nombre'=> $_POST['nombres'],
        'id'=>$id_usuario,
        'correo'=>$_POST['correo'],
        'nivel'=> 'cliente',
        'metodo'=>'formulario'
        );


    $resultado = $conexion->query("insert into direcciones_usuarios (nombres,apellidos,pais,calle,apartamento,ciudad,estado,cp,telefono,correo,id_usuario)
    values(
        '".$nombres."',
        '".$apellidos."',
        '".$pais."',
        '".$calle."',
        '".$apartamento."',
        '".$ciudad."',
        '".$estado."',
        '".$cp."',
        '".$telefono."',
        '".$correo."',
        '".$id_usuario."'
        )
    ")or die($conexion->error);

    if(isset($_POST['oxxoSubmit'])){
        $conexion->query("insert into ventas (id_usuario,total,fecha,status,visto)
        values(
        '".$id_usuario."',
        '".$precioFinal."',
        '".date("F j, Y, g:i a")."',
        'pendiente_pago',
        'false'
        )
        ")or die($conexion->error);
    
        $id_venta = $conexion -> insert_id;
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


    }else{
        $conexion->query("insert into ventas (id_usuario,total,fecha,status,visto)
        values(
        '".$id_usuario."',
        '".$precioFinal."',
        '".date("F j, Y, g:i a")."',
        'pendiente_envio',
        'false'
        )
        ")or die($conexion->error);
    
        $id_venta = $conexion -> insert_id;

        for($i=0; $i<count($arreglo);$i++){
            $conexion -> query("insert into productos_venta (id_venta,id_producto,cantidad,precio,subtotal)
            values(
            $id_venta,
            ".$arreglo[$i]["Id"].",
            ".$arreglo[$i]["Cantidad"].",
            ".$arreglo[$i]["Precio"].",
            ".$arreglo[$i]["Cantidad"]*$arreglo[$i]["Precio"]."
            )")or die($conexion->error);            
            
            $respuesta2 = $conexion->query("select * from cantidad_vendidos where id_producto='".$arreglo[$i]["Id"]."'")or die($conexion->error);
            $fila2 = mysqli_fetch_array($respuesta2);
            
            if (mysqli_num_rows($respuesta2) == 0) {
                $conexion->query("insert into cantidad_vendidos (id_producto,vendidos) 
                values(
                    ".$arreglo[$i]["Id"].",
                    ".$arreglo[$i]["Cantidad"]."
                    )")or die($conexion->error);
                } else {
                    $vendidos = $fila2[1] + $arreglo[$i]["Cantidad"];
                    
                $conexion->query("update cantidad_vendidos set 
            vendidos=".$vendidos."
            where id_producto=".$arreglo[$i]["Id"]);
            }
            
            $respuesta = $conexion->query("select * from productos where id='".$arreglo[$i]["Id"]."'")or die($conexion->error);
    
            $fila = mysqli_fetch_array($respuesta);
    
            $stock = $fila[10] - $arreglo[$i]["Cantidad"];
    
            $conexion->query("update productos set 
                stock=".$stock."
                where id=".$arreglo[$i]["Id"]);
    
            }      

    }
    
        $conexion->query("insert into direcciones_ventas (id_usuario,id_venta,nombres,apellidos,pais,calle,apartamento,ciudad,estado,cp,telefono,correo,notas)
        values(
        ".$id_usuario.",
        ".$id_venta.",
        '".$nombres."',
        '".$apellidos."',
        '".$pais."',
        '".$calle."',
        '".$apartamento."',
        '".$ciudad."',
        '".$estado."',
        '".$cp."',
        '".$telefono."',
        '".$correo."',
        '".$notas."'
        )
        ")or die($conexion->error);
    
    $_SESSION['total'] = 0;
    $_SESSION['carrito'] = [];
    ?>
    <script>
        sessionStorage.setItem('total', 0);
        sessionStorage.setItem('final', 0);
    </script>
    <?php
    header('Location: ../dashboard/mis-pedidos.php');

}else{





    
    if (isset($_POST['oxxoSubmit'])) {
        $conexion->query("insert into ventas (id_usuario,total,fecha,status,visto)
        values(
        '".$_SESSION['datos_login']['id']."',
        '".$precioFinal."',
        '".date("F j, Y, g:i a")."',
        'pendiente_pago',
        'false'
        )
        ")or die($conexion->error);
    
        $id_venta = $conexion -> insert_id;

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


        } else {
            $conexion->query("insert into ventas (id_usuario,total,fecha,status,visto)
        values(
        '".$_SESSION['datos_login']['id']."',
        '".$precioFinal."',
        '".date("F j, Y, g:i a")."',
        'pendiente_envio',
        'false'
        )
        ")or die($conexion->error);
    
            $id_venta = $conexion -> insert_id;
            for($i=0; $i<count($arreglo);$i++){
                $conexion -> query("insert into productos_venta (id_venta,id_producto,cantidad,precio,subtotal)
                values(
                $id_venta,
                ".$arreglo[$i]["Id"].",
                ".$arreglo[$i]["Cantidad"].",
                ".$arreglo[$i]["Precio"].",
                ".$arreglo[$i]["Cantidad"]*$arreglo[$i]["Precio"]."
                )")or die($conexion->error);            
                
                $respuesta2 = $conexion->query("select * from cantidad_vendidos where id_producto='".$arreglo[$i]["Id"]."'")or die($conexion->error);
                $fila2 = mysqli_fetch_array($respuesta2);
                
                if (mysqli_num_rows($respuesta2) == 0) {
                    $conexion->query("insert into cantidad_vendidos (id_producto,vendidos) 
                    values(
                        ".$arreglo[$i]["Id"].",
                        ".$arreglo[$i]["Cantidad"]."
                        )")or die($conexion->error);
                    } else {
                        $vendidos = $fila2[1] + $arreglo[$i]["Cantidad"];
                        
                    $conexion->query("update cantidad_vendidos set 
                vendidos=".$vendidos."
                where id_producto=".$arreglo[$i]["Id"]);
                }
                
                $respuesta = $conexion->query("select * from productos where id='".$arreglo[$i]["Id"]."'")or die($conexion->error);
        
                $fila = mysqli_fetch_array($respuesta);
        
                $stock = $fila[10] - $arreglo[$i]["Cantidad"];
        
                $conexion->query("update productos set 
                    stock=".$stock."
                    where id=".$arreglo[$i]["Id"]);
        
                }      
        
        }
    
        $conexion->query("insert into direcciones_ventas (id_usuario,id_venta,nombres,apellidos,pais,calle,apartamento,ciudad,estado,cp,telefono,correo,notas)
        values(
        ".$_SESSION['datos_login']['id'].",
        ".$id_venta.",
        '".$nombres."',
        '".$apellidos."',
        '".$pais."',
        '".$calle."',
        '".$apartamento."',
        '".$ciudad."',
        '".$estado."',
        '".$cp."',
        '".$telefono."',
        '".$correo."',
        '".$notas."'
        )
        ")or die($conexion->error);
    

    $_SESSION['total'] = 0;
    $_SESSION['carrito'] = [];
    ?>
    <script>
    sessionStorage.setItem('total', 0);
    sessionStorage.setItem('final', 0);
    </script>
    <?php
    header('Location: ../dashboard/mis-pedidos.php');

}
//crear usuario si no existe


}else{
    header('Location: ../checkout-payment');
}

?>
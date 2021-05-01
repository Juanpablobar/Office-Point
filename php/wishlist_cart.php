<?php

if(isset($_POST['cart'])){
	header('Location: ../cart?id='.$_POST['id'].'&cant='.$_POST['cant']);
}
if(isset($_POST['wishlist'])){
	header('Location: ../wishlist?id='.$_POST['id'].'&cant='.$_POST['cant']);
}

?>
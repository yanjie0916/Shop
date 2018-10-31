<?php
require_once("cartModel.php");
//require_once("userModel.php");

$ID = (int)$_GET['id'];
removeCartItem($ID);
header("Location: showCart.php");
?>
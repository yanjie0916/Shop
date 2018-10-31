<?php
require_once("cartModel.php");
require_once("userModel.php");

$prdID = (int)$_GET['id'];
add2Cart($prdID, getCurrentUser());
header("Location: showCart.php");
?>
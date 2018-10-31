<?php
require_once("cartModel.php");
require_once("userModel.php");
require_once("orderModel.php");
$uID=getCurrentUser();
$orderID= newOrder($uID);
$result=showCart($uID);
while ($rs = mysqli_fetch_assoc($result)) 
{
    addOrderItem($orderID, $rs["prdID"], $rs["amount"]);
}
removeAllItems($uID);
header("Location: showCart.php");
?>

<?php
require("dbconfig.php");
function showCart($uID) 
{
    global $db;
    if ($uID> 0) {
        $sql = "select cartitem.*, product.name, product.price from cartitem, product where cartitem.prdID=product.prdID and cartitem.uID=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $uID);
        mysqli_stmt_execute($stmt); //執行SQL
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    } 
    return NULL;
}


?>

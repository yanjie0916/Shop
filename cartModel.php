<?php
require_once("dbconfig.php");
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

function add2Cart($prdID, $uID)
{
    global $db;
    $sql = "insert into cartitem (prdID, uID, amount) values (?,?,1)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $prdID,$uID);
    mysqli_stmt_execute($stmt); //執行SQL
    return;
}

function removeCartItem($ID) 
{
    global $db;
    $sql = "delete from cartitem where serno=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt); //執行SQL
    return;
}
?>

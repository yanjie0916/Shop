<?php
require_once("dbconfig.php");
function newOrder($uID) 
{
    global $db;
    if ($uID> 0) {
        $sql = "insert into ord (uID, status) values (?, 0);";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $uID);
        mysqli_stmt_execute($stmt); //執行SQL
        return mysqli_stmt_insert_id($stmt );
    } 
    return NULL;
}
function addOrderItem($orderID, $prdID, $amount)
{
    global $db;
    $sql = "insert into orderitem (prdID, oID, amount) values (?,?,?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $prdID,$orderID, $amount);
    mysqli_stmt_execute($stmt); //執行SQL
    return;
}
function getOrderList()
{
    global $db;
    $sql = "select orderitem.*, product.name, product.price from orderitem, product where orderitem.prdID=product.prdID order by oID, prdID";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
?>
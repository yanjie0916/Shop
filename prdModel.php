<?php
require_once("dbconfig.php");
function getPrdList() 
{
    global $db;
        $sql = "select * from product";
        $stmt = mysqli_prepare($db, $sql);
        //mysqli_stmt_bind_param($stmt, "ss", $id, $pwd);
        mysqli_stmt_execute($stmt); //執行SQL
        $result = mysqli_stmt_get_result($stmt); 
        return $result;
}

?>

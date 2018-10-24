<?php
require("userModel.php");

$userName = $_POST['id'];
$passWord = $_POST['pwd'];
if (login($userName, $passWord)==1) {
    header("Location: index.php" );
} else {
    header("Location: loginView.php");
}
?>
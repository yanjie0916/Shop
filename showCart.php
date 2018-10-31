<?php
require("cartModel.php");
require("userModel.php");
//checkLogin();
$result=showCart(getCurrentUser());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

<p>my shopping cart !!</p>
<hr />
<table width="200" border="1" class="">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>unit price</td>
    <td>amount</td>
    <td>total</td>
<td>XXX</td>
  </tr>
<?php
$tot=0;
while (	$rs = mysqli_fetch_assoc($result)) {

	echo "<tr><td>" , $rs['prdID'] ,
	"</td><td>" , $rs['name'],
	"</td><td>" , $rs['price'],
	"</td><td>" , $rs['amount'],
	"</td><td>" , $rs['price'] * $rs['amount'];
    $tot += $rs['price'] * $rs['amount'];
    $id=$rs['serno'];
    //echo '<td><a href="03.delete.php?id=', $rs['id'], '">刪</a> </td></tr>';
    echo "<td><a href='removeFromCart.php?id=$id'>刪</a>";
}
echo "<tr><td>Total: $tot</td><td><a href='checkout.php'>結帳</a></td></tr>";
?>
</table>
</body>
</html>

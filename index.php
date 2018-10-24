<?php
require("dbconfig.php");
checkLogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

<p>my guest book !! <a href="01.addform.php">新增留言</a></p>
<hr />
<table width="200" border="1" class="">
  <tr>
    <td>id</td>
    <td>category</td>
    <td>title</td>
    <td>message</td>
    <td>name</td>
<td>XXX</td>
  </tr>
<?php

$sql = "select * from guestbook;";
$stmt = mysqli_prepare($db, $sql );
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); 

while (	$rs = mysqli_fetch_assoc($result)) {

	echo "<tr><td>" , $rs['id'] ,
	"</td><td>" , $rs['cate'],
	"</td><td>" , $rs['title'],
	"</td><td>" , $rs['msg'], 
	"<td>", $rs['name'],"</td>";
$id=$rs['id'];
$likes=$rs['likes'];
//echo '<td><a href="03.delete.php?id=', $rs['id'], '">刪</a> </td></tr>';
echo "<td><a href='05.like.php?id=$id'>讚($likes)</a>";
echo " - <a href='03.delete.php?id=$id'>刪</a>";
echo " - <a href='04.editform.php?id=$id'>改</a> </td></tr>";

}
?>
</table>
</body>
</html>

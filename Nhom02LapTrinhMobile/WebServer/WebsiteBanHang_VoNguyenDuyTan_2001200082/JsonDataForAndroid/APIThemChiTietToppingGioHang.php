<?php
require("..//Model/Connection.php");
$ID=$_POST['ID'];
$MaTopping=$_POST['MaTopping'];
$Gia=$_POST['Gia'];

$connection=new Connection();
$sql="INSERT INTO `chitiettoppinggiohang`(`ID`, `MaTopping`, `Gia`) VALUES (".$ID.",".$MaTopping.",".$Gia.");";

$kq=$connection->excuteUpdate($sql);
echo $kq;

?>
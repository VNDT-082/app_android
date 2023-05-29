<?php
require("..//Model/Connection.php");
$connection=new Connection();
$maSanPham=$_GET['MaSanPham'];
$sql="SELECT * FROM `sanpham` WHERE MaSanPham='$maSanPham'";
$sp=$connection->SelectAll($sql);
echo json_encode($sp);

?>
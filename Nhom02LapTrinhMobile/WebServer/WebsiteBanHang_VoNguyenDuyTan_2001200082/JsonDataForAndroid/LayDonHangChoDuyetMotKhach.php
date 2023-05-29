<?php
require("..//HomeController.php");
$MaNguoiDung=$_GET['MaNguoiDung'];
$ds=DatHang::LayTatCaDonCuaMotKhachHang($MaNguoiDung);
echo json_encode($ds);


?>
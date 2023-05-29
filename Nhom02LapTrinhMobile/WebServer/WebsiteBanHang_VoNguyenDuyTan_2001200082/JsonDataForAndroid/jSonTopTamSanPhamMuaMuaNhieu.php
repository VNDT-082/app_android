<?php
require("..//Model/SanPham.php");
require("..//Model/Connection.php");
$DanhSachMuaNhieu=SanPham::LayTamSanPhamMuaNhieu();
echo json_encode($DanhSachMuaNhieu);

?>
<?php
require("..//HomeController.php");
$Id=$_POST["ID"];
$kq=ChiTietToppingGioHang::XoaHetToppingKhoiSanPham($Id);
if($kq>0)
{
    $kq=GioHang::XoaMotSanPhamKhoiGioHang($Id);
}
echo $kq;
?>
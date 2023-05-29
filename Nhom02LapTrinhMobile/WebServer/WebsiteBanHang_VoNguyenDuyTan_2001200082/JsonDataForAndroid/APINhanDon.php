<?php
require("..//HomeController.php");
$MaDonHag=$_POST["MaDonHang"];
$donhang=DatHang::LayMotDonDatBangMaDonHang($MaDonHag);
$kq=$donhang->DuyetDon();
echo $kq;

?>
<?php
require("..//Model/Connection.php");
$MaDonHang=$_GET["MaDonHang"];
$connection=new Connection();
$sql="SELECT chitietdathang.MaSanPham,sanpham.TenSanPham, chitietdathang.MaDonHang, chitietdathang.SoLuong, chitietdathang.GiaBan,"
." chitietdathang.KhuyenMai, chitietdathang.GiamCon, chitietdathang.MaSize, chitietdathang.LuongDuong, chitietdathang.LuongDa ".
"FROM chitietdathang , sanpham WHERE chitietdathang.MaSanPham=sanpham.MaSanPham AND chitietdathang.MaDonHang=".$MaDonHang.";";
$ds=$connection->excuteQuery($sql);
if($ds!=null)
{
    echo json_encode($ds);
}
else{
    echo json_encode(null);
}

?>